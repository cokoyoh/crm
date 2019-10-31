<div class="flex items-center justify-between -mt-12 py-4">
    <div class="flex items-center justify-between">
        <button class="btn-default">User
        </button>
        <svg class="h-5 w-5 ml-2 fill-current text-gray-700 font-thin" viewBox="0 0 20 20">
            <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/>
        </svg>
        <h3 class="ml-2 text-gray-700">{!! $user->name !!}</h3>
    </div>

    <button class="flex items-center btn btn-success" @click="$modal.show('new-lead')">
        <svg class="h-4 w-4 fill-current font-medium" viewBox="0 0 20 20">
            <path
                d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/>
        </svg>
        <span class="ml-1 font-medium">Add Lead</span>
    </button>

    <new-lead-modal></new-lead-modal>
</div>
