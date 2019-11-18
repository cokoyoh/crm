<div class="flex items-center justify-between">
    <button class="focus:outline-none">
        <svg class="h-5 w-5 fill-current text-gray-500 hover:text-teal-700">
            <path d="M6 8v7h8V8a4 4 0 1 0-8 0zm2.03-5.67a2 2 0 1 1 3.95 0A6 6 0 0 1 16 8v6l3 2v1H1v-1l3-2V8a6 6 0 0 1 4.03-5.67zM12 18a2 2 0 1 1-4 0h4z"/>
        </svg>
    </button>

    <form action="{!! route('logout') !!}" method="post">
        @csrf
        <button
            class="ml-3 text-sm font-medium text-gray-700 bg-gray-200 px-2 py-1 rounded hover:bg-gray-100 focus:outline-none active:bg-gray-300 active:text-gray-900"
            type="submit"
        >Log out</button>
    </form>
</div>
