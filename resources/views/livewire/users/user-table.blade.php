<div>
    {{-- each row --}}
    <div class="space-y-8">
        @foreach ($users as $user)
        <div class="flex items-center justify-between px-3 py-2 bg-white rounded-md shadow-xl shadow-b">
            <div class="px-2 py-4">
                <span class="block text-xs font-bold text-blue-900">USER_ID</span>
                <span class="block font-light text-blue-900">{{ $user->id }}</span>
            </div>
            <div class="px-2 py-4">
                <span class="block text-xs font-bold text-blue-900">USER_NAME</span>
                <span class="block font-light text-blue-900">{{ $user->username }}</span>
            </div>
            <div class="px-2 py-4">
                <span class="block text-xs font-bold text-blue-900">CREATED_AT</span>
                <span class="block font-light text-blue-900">{{ $user->created_at }}</span>
            </div>
            <div class="px-2 py-4" x-data>
                <button class="block px-4 py-3 text-right bg-blue-900 rounded-sm text-blue-50 text-md" @click="
                        token = $wire.createLinkToken({{ $user->id }});
                        token.then(function(response){
                            console.log('link token: ' + response);
                            handler = Plaid.create({
                                token: response,
                                onSuccess: (public_token, metadata) => {
                                    console.log(public_token);
                                },
                                onLoad: () => {
                                    console.log('plaid link is being loaded');
                                },
                                onExit: (err, metadata) => {},
                                onEvent: (eventName, metadata) => {},
                                receivedRedirectUri: null,
                            });
                            handler.open();
                        });
                ">Link an Item</button>
            </div>
        </div>
        @endforeach
    </div>
</div>
