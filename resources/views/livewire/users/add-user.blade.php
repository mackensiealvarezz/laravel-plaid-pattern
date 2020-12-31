<div class="px-4 py-8 shadow-md" @added-user="openUser = false">
    <form wire:submit.prevent='save' class="flex items-center justify-between space-x-4 align-items-center">
        <div class="w-1/4 space-y-1">
            <label class="font-bold text-blue-900 text-md">ADD A NEW USER</label>
            <p class="text-sm font-light text-gray-500">Enter a name in the input field for your new user.</p>
        </div>

        <div class="w-1/3 space-y-2">
            <label class="block text-sm font-bold text-blue-900">USER_NAME</label>
            <input type="text" wire:model.lazy='user.username' placeholder="New user name"
                class="w-full p-2 border border-blue-900" />
            @error('user.username') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>
        <div class="flex-grow">
            <div class="flex space-x-3 align-items-center justify-content-center">
                <button class="w-1/2 px-4 py-2 text-black bg-gray-200 rounded-sm"
                    @click="openUser = false">Cancel</button>
                <button type='submit' class="w-1/2 px-4 py-2 text-gray-200 bg-blue-900 rounded-sm">Add User</button>
            </div>
        </div>
    </form>
</div>
