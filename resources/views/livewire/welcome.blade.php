<div class="px-40 py-28 " x-data="{openUser: false }">
    <div class="container mx-auto">

        {{-- Top section --}}

        <div class="space-y-4">
            <h2 class="text-sm text-blue-900">SANDBOX USER</h2>
            <div class="flex justify-between">
                <h1 class="text-3xl text-blue-900">Plaid Pattern</h1>
                <button class="px-4 py-3 bg-blue-900 rounded-sm text-blue-50 text-md">Send Feedback</button>
            </div>
            <p class="text-lg font-light text-gray-500">This is an example app that outlines an end to end
                intergration with
                Plaid</p>

            <hr class="mt-2" />
        </div>

        {{-- mid section --}}
        <div class="flex justify-between pb-10 mt-4 align-items-center">
            <div class="p-3">
                <h3 class="text-sm font-bold text-blue-900">Step 1</h3>
                <p class="mt-1 text-base font-light text-gray-500">Add a user, and click the "Link an Item" button below
                    to
                    connect <a class="font-medium text-blue-500">Items</a> from the user.</p>
            </div>
            <div class="p-3">
                <h3 class="text-sm font-bold text-blue-900">Step 2</h3>
                <p class="mt-1 text-base font-light text-gray-500">Select an institution to add accounts. Given you are
                    in sandbox mode, <a class="font-medium text-blue-500">test credentials</a> are provided within Link
                    after
                    selecting an institution.</p>
            </div>
            <div class="p-3">
                <h3 class="text-sm font-bold text-blue-900">Step 3</h3>
                <p class="mt-1 text-base font-light text-gray-500">Upon completion, a public_token will be passed to the
                    server and exchanged for an access_token to get <a class="font-medium text-blue-500">account</a> and
                    <a class="font-medium text-blue-500">transaction</a> details</p>
            </div>

        </div>

        <hr />

        {{-- users- we will use livewire for this  --}}
        <div class="flex justify-between py-6">
            <h2 class="text-xl text-blue-900 font-base">{{ $user_count }} Users</h2>
            <button class="px-4 py-3 bg-blue-900 rounded-sm text-blue-50 text-md" @click="openUser = !openUser"> Add a
                New
                User
            </button>
        </div>

        <div class="pt-4" x-show="openUser">
            <livewire:users.add-user x-show="openUser" />
        </div>

        <div class="mt-10">
            <livewire:users.user-table />
        </div>

    </div>
</div>
@section('js')
<script src="https://cdn.plaid.com/link/v2/stable/link-initialize.js"></script>
@endsection
