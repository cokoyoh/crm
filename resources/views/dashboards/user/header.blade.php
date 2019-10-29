<div class="flex items-center justify-between -mt-12 py-4">
    <div class="flex items-center justify-between">
        <button class="btn-default">User
        </button>
        <svg class="h-5 w-5 ml-2 fill-current text-gray-700 font-thin" viewBox="0 0 20 20">
            <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/>
        </svg>
        <h3 class="ml-2 text-gray-700">{!! $user->name !!}</h3>
    </div>

    <div>
        <button class="btn btn-success">Add Client</button>
    </div>
</div>
