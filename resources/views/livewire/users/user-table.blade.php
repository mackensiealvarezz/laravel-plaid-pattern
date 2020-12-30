<div>
    {{-- each row --}}
    <div class="space-y-8">
        @foreach ($users as $user)
        <div class="flex items-center justify-between px-3 py-2 bg-white rounded-md shadow-xl shadow-b"
            wire:key='{{ time().$user->id }}'>
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
            <div class="px-2 py-4">
                <livewire:link :user="$user" />
            </div>
        </div>
        @endforeach
    </div>
</div>
