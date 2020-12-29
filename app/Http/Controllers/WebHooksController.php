<?php

namespace App\Http\Controllers;

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

                //   await handleTransactionsUpdate(plaidItemId, startDate, endDate);
                //   const { id: itemId } = await retrieveItemByPlaidItemId(plaidItemId);
                //   serverLogAndEmitSocket(`${newTransactions} transactions to add.`, itemId);

                $startDate = Carbon::now()->subDays(30)->format('YYYY-MM-DD');
                $endDate = Carbon::now()->format('YYYY-MM-DD');



                break;
        }
    }
}
