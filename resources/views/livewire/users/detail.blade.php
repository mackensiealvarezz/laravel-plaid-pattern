<div class="px-40 py-28 ">
    <div class="container mx-auto">
        {{-- Top section --}}
        <div class="space-y-4">
            <a href="{{ route('welcome') }}" class="text-sm font-bold text-blue900"> BACK TO USERS</a>
            <h2 class="text-sm text-blue-900">SANDBOX USER</h2>
            <div class="flex justify-between">
                <h1 class="text-3xl text-blue-900">Plaid Pattern</h1>
                <button class="px-4 py-3 bg-blue-900 rounded-sm text-blue-50 text-md">Send Feedback</button>
            </div>
            <p class="text-lg font-light text-gray-500">Success! You can explore account and transaction details for the
                linked item</p>

            <hr class="mt-2" />
        </div>

        {{-- mid section --}}
        <div class="flex justify-between pb-10 mt-4 align-items-center">
            <div class="p-3">
                <h3 class="text-sm font-bold text-blue-900">USER_ID</h3>
                <p class="mt-1 text-base font-light text-gray-500">{{ $user->id }}</p>
            </div>
            <div class="p-3">
                <h3 class="text-sm font-bold text-blue-900">USER_NAME</h3>
                <p class="mt-1 text-base font-light text-gray-500">{{ $user->username }}</p>
            </div>
            <div class="p-3">
                <h3 class="text-sm font-bold text-blue-900">CREATED_AT</h3>
                <p class="mt-1 text-base font-light text-gray-500">{{ $user->created_at }}</p>
            </div>
        </div>

        <hr />

        {{-- users- we will use livewire for this  --}}
        <div class="flex justify-between py-6">
            <div class="space-y-1">
                <h2 class="text-xl text-blue-900 font-base">{{ $items->count() }} Item Linked</h2>
                <p class="text-lg font-light text-gray-500">Below is a list of all the items. Click on an item to
                    view its
                    associated accounts</p>
            </div>
            <button class="px-4 py-3 bg-blue-900 rounded-sm text-blue-50 text-md"> Add Another Item </button>
        </div>

        <div class="mt-10">
            @foreach ($items as $item)
            <livewire:item-card :item="$item" :key="$item->id" />
            @endforeach
        </div>

    </div>
</div>

@section('js')
<script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>
@endsection
