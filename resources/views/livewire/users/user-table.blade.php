<div>
    {{-- each row --}}
    <div class="space-y-8">
        @foreach ($users as $user)
        <div class="flex items-center justify-between px-3 py-2 bg-white rounded-md shadow-xl shadow-b"
            wire:key='{{ $user->id }}'>
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
                <div class="space-y-1">
                    <livewire:link :user="$user" :key="time().$user->id" />
                    @if ($user->items->count() > 0)
                    <a class="block text-sm text-gray-400 " href="#">View {{ $user->items->count() }} Linked Item
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
