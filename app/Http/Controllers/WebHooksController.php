<?php

namespace App\Http\Controllers;

use App\Events\TransactionsUpdated;
use App\Models\Account;
use App\Models\Item;
use App\Models\Transaction;
use App\Plaid\Plaid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebHooksController extends Controller
{

    //This function handles incoming webhooks
    public function handle(Request $request)
    {

        switch ($request['webhook_code']) {
            case 'INITIAL_UPDATE':
                // Fired when an Item's initial transaction pull is completed.
                // Note: The default pull is 30 days.
                $startDate = Carbon::now()->subDays(30)->format('Y-m-d');
                $endDate = Carbon::now()->format('Y-m-d');
                $this->handleTransactionsUpdate($request['item_id'], $startDate, $endDate);

                //Alert the frontend that it's been updated
                event(new TransactionsUpdated);
                break;
            case 'HISTORICAL_UPDATE':
                // Fired when an Item's historical transaction pull is completed. Plaid fetches as much
                // data as is available from the financial institution.
                $startDate = Carbon::now()->subYears(2)->format('Y-m-d');
                $endDate = Carbon::now()->format('Y-m-d');
                $this->handleTransactionsUpdate($request['item_id'], $startDate, $endDate);
                break;
            case 'DEFAULT_UPDATE':
                // Fired when new transaction data is available as Plaid performs its regular updates of
                // the Item. Since transactions may take several days to post, we'll fetch 14 days worth of
                // transactions from Plaid and reconcile them with the transactions we already have stored.
                $startDate = Carbon::now()->subDays(14)->format('Y-m-d');
                $endDate = Carbon::now()->format('Y-m-d');
                $this->handleTransactionsUpdate($request['item_id'], $startDate, $endDate);
                break;
        }
    }

    /**
     * Handles the fetching and storing of new transactions in response to an update webhook.
     *
     * @param {string} plaidItemId the Plaid ID for the item.
     * @param {string} startDate the earliest date to retrieve ('YYYY-MM-DD').
     * @param {string} endDate the latest date to retrieve ('YYYY-MM-DD').
     */
    public function handleTransactionsUpdate($plaidItemId, $startDate, $endDate)
    {
        $response = $this->fetchTransactions($plaidItemId, $startDate, $endDate);

        $transactionsToStore = collect($response['transactions']);

        $item = Item::where('plaid_item_id', $plaidItemId)->first();
        // Retrieve existing transactions from our db
        $existingTransactions = Transaction::whereHas('account', function ($q) use ($item) {
            $q->where('item_id', $item->id);
        })->whereBetween('date', [$startDate, $endDate])->get();

        //Removing existing transactions
        $transactionsToStore->reject(function ($transaction) use ($existingTransactions) {
            return $existingTransactions->where('plaid_transaction_id', $transaction['transaction_id'])->count() > 0;
        });

        $accountsToStore = collect($response['accounts']);
        //Mapping data
        $accountsToCreate = $accountsToStore->map(function ($account) use ($item) {
            return [
                'item_id' => $item->id,
                'plaid_account_id' => $account['account_id'],
                'name' =>  $account['name'],
                'mask' =>  $account['mask'],
                'official_name' =>  $account['official_name'],
                'current_balance' =>  $account['balances']['current'],
                'available_balance' =>  $account['balances']['available'],
                'iso_currency_code' => $account['balances']['iso_currency_code'],
                'unofficial_currency_code' => $account['balances']['unofficial_currency_code'],
                'type' => $account['type'],
                'subtype' => $account['subtype']
            ];
        });

        foreach ($accountsToCreate->all() as $account) {
            Account::updateOrCreate(['plaid_account_id' => $account['plaid_account_id']], $account);
        }
        //load all accounts
        $item->load('accounts');
        //Add transactions to account

        $transactionsToCreate = $transactionsToStore->map(function ($transaction) use ($item) {
            return [
                'account_id' => $item->accounts->where('plaid_account_id', $transaction['account_id'])->first()->id,
                'plaid_transaction_id' => $transaction['transaction_id'],
                'plaid_category_id' => $transaction['category_id'],
                'category' => implode(',', $transaction['category']),
                'subcategory' => implode(',', $transaction['category']),
                'type' => $transaction['transaction_type'],
                'name' => $transaction['name'],
                'amount' => $transaction['amount'],
                'iso_currency_code' => $transaction['iso_currency_code'],
                'unofficial_currency_code' => $transaction['unofficial_currency_code'],
                'date' => $transaction['date'],
                'pending' => $transaction['pending'],
                'account_owner' => $transaction['account_owner'],
            ];
        });
        Transaction::insert($transactionsToCreate->all());
    }







    /**
     * Fetches transactions from the Plaid API for a given item.
     *
     * @param {string} plaidItemId the Plaid ID for the item.
     * @param {string} startDate date string in the format 'YYYY-MM-DD'.
     * @param {string} endDate date string in the format 'YYYY-MM-DD'.
     * @returns {Object{}} an object containing transactions and accounts.
     */
    public function fetchTransactions($plaidItemId, $startDate, $endDate)
    {
        $plaid = new Plaid;

        $item = Item::where('plaid_item_id', $plaidItemId)->first();
        $accessToken = $item->plaid_access_token;

        $offset = 0;
        $batchSize = 100;
        $transactionsToFetch = true;
        $resultData = [];

        //Setup data
        $resultData['accounts'] = [];
        $resultData['transactions'] = [];

        while ($transactionsToFetch) {
            $response = $plaid->getTransactions($accessToken, $startDate, $endDate, [
                'count' => $batchSize,
                'offset' => $offset
            ]);

            $resultData['accounts'] = array_merge($resultData['accounts'], $response['accounts']);
            $resultData['transactions'] = array_merge($resultData['transactions'], $response['transactions']);

            //Check if we have all of them
            if (count($response['transactions']) === $batchSize) {
                $offset += $batchSize;
            } else {
                $transactionsToFetch = false;
            }
        }
        return $resultData;
    }
}
