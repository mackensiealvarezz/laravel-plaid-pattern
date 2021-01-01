<div class="item-card" x-data="{openAccounts : false }" @click="openAccounts = true">

    {{-- card --}}
    <div class="flex items-center justify-between p-4 bg-gray-200 shadow-lg cursor-pointer">
        <div class="flex items-center w-1/4 p-2 space-x-2 align-content-center">
            <img class="w-10 h-10 bg-red-800 rounded-full "
                src="data:image/png;base64,{{ $institution['institution']['logo'] }}" />
            <span class="text-lg text-blue-900">{{ $institution['institution']['name'] }}</span>
        </div>
        {{-- status --}}
        <div class="flex-none">
            <div class="px-3 py-2 text-center bg-green-100 border-2 border-green-300 rounded-lg">
                <span class="text-center text-green-600">Updated</span>
            </div>
        </div>

        <div class="px-4 py-4">
            <span class="block text-xs font-bold text-blue-900">ITEM_ID</span>
            <span class="block font-light text-blue-900">{{ $item->id }}</span>
        </div>

        <div class="px-4 py-4">
            <span class="block text-xs font-bold text-blue-900">Last_Updated</span>
            <span class="block font-light text-blue-900">{{ $item->updated_at->diffForHumans() }}</span>
        </div>
    </div>

    {{-- Acccounts --}}
    <div x-show="openAccounts" @click.away="openAccounts = false">
        {{-- account card --}}
        @foreach ($item->accounts as $account)
        <div x-data="{openTransactions : false }">
            <div
                class="flex items-center justify-between px-2 py-4 bg-white @if($loop->first) border-l-2 border-r-2  border-t-2   @else border-2 @endif border-gray-200 ">
                <div class="p-2">
                    <label class="block text-lg font-semibold text-left text-blue-900">{{ $account->name }}</label>
                    <span class="block font-light text-blue-800 text-md">{{ ucfirst($account->subtype) }} • Balance
                        ${{ $account->current_balance }} </span>
                </div>
                <div class="p-2">
                    <button class="px-3 py-2 text-gray-600 bg-gray-100 shadow-md"
                        @click="openTransactions = !openTransactions">View
                        Transactions</button>
                </div>
            </div>
            <div x-show="openTransactions" class="h-48 px-2 py-4 overflow-scroll bg-white border-2 border-gray-300">
                <table class="min-w-full divide-y divide-gray-200 ">
                    <thead>
                        <tr>
                            <th scope="col" class="px-6 py-2 text-left">Name</th>
                            <th scope="col" class="px-6 py-2 text-left">Category</th>
                            <th scope="col" class="px-6 py-2 text-left">Amount</th>
                            <th scope="col" class="px-6 py-2 text-left">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($account->transactions as $transaction)
                        <tr class="">
                            <td>{{ $transaction->name }}</td>
                            <td>{{ $transaction->category }}</td>
                            <td>${{ $transaction->amount }}</td>
                            <td>${{ $transaction->date }}</td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="4">
                                <span class="block p-4 text-lg font-bold text-center text-gray-400 ">No Transactions
                                    Available
                                    For
                                    This Account</span>
                            </td>

                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>


        @endforeach

    </div>


</div>
