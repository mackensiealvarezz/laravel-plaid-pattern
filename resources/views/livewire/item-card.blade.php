<div class="flex items-center justify-between p-4 bg-gray-200 shadow-lg ">
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
