<div class="mt-3">
    <div class="mb-3 text-gray-800 font-semibold">Users</div>

    @forelse($latestUsers as $user)
        <div class="flex items-center border-b border-gray-300 py-2">
            <img class="object-scale-down h-10 w-10 rounded-full border border-gray-400" src="/images/default.png" alt="default image">
            <div class="flex-1 ml-2 leading-normal">
                <h6 class="text-blue-600 text-sm">{!! $user->name !!}</h6>
                <p class="text-gray-600 text-xs italic">{!! $user->company->name !!}</p>
            </div>
            <svg class="h-4 w-4" viewBox="0 0 20 20">
                <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-1-7.59V4h2v5.59l3.95 3.95-1.41 1.41L9 10.41z"/>
            </svg>
        </div>
    @empty
        <div class="border-t border-gray-400 mt-3 -ml-2 -mr-2 px-3 py-3 text-gray-600 text-md">
            No user record found
        </div>
    @endforelse
</div>
