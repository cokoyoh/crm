<div class="bg-white shadow rounded p-2 mt-8">
    <div class="flex items-center">
        <svg class="h-4 w-4 fill-current text-gray-700" viewBox="0 0 20 20">
            <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-1-7.59V4h2v5.59l3.95 3.95-1.41 1.41L9 10.41z"/>
        </svg>
        <span class="ml-1 text-gray-700 font-semibold">Recently Added</span>
    </div>

    <div class="border-t border-gray-400 mt-3 -ml-2 -mr-2 px-3 py-3 text-md">
        @include('dashboards.recent.recently_added_companies')
        @include('dashboards.recent.recently_added_users')
    </div>
</div>
