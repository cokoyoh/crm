<div class="flex items-center justify-between mt-3">
    <div class="w-1/4 rounded bg-white px-5 pt-2 shadow-md leading-relaxed">
        <h4 class="text-gray-600 text-sm font-medium">Total Companies</h4>
        <h2 class="text-gray-700 text-xl font-light"> {!! $companiesCount !!} {!! pluralise('Company', $companiesCount) !!}</h2>
        <div
            class="mt-5 text-gray-700 bg-gray-100 hover:bg-gray-200 active:bg-gray-300 -mx-5 pb-2 text-center rounded-b">
            <a href="{!! route('companies.index') !!}">
                <button class="inline-flex items-center text-sm focus:outline-none">
                    View all companies
                    <span>
                        <svg class="h-4 v-4 fill-current"
                             viewBox="0 0 20 20">
                            <path
                                d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/>
                        </svg>
                    </span>
                </button>
            </a>
        </div>
    </div>

    <div class="w-1/4 rounded bg-white px-5 pt-2 shadow-md leading-relaxed">
        <h4 class="text-gray-600 text-sm font-medium">Total Users</h4>
        <h2 class="text-gray-700 text-xl font-light">{!! $usersCount !!} {!!  pluralise('User', $usersCount) !!}</h2>
        <div
            class="mt-5 text-gray-700 bg-gray-100 hover:bg-gray-200 active:bg-gray-300 -mx-5 pb-2 text-center rounded-b">
            <a href="{!! route('users.index') !!}">
                <button class="inline-flex items-center text-sm focus:outline-none">
                    View all users
                    <span>
                        <svg class="h-4 v-4 fill-current"
                             viewBox="0 0 20 20">
                            <path
                                d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/>
                        </svg>
                    </span>
                </button>
            </a>
        </div>
    </div>

    <div class="w-1/4 rounded bg-white px-5 pt-2 shadow-md leading-relaxed">
        <h4 class="text-gray-600 text-sm font-medium">Total Deals</h4>
        <h2 class="text-gray-700 text-xl font-light">{!! formatCurrency(\CRM\Models\Deal::won()->sum('amount'), true) !!}</h2>
        <div
            class="mt-5 text-gray-700 bg-gray-100 hover:bg-gray-200 active:bg-gray-300 -mx-5 pb-2 text-center rounded-b">
            <a href="{!! route('deals.index') !!}">
                <button class="inline-flex items-center text-sm focus:outline-none">
                    View all deals
                    <span>
                        <svg class="h-4 v-4 fill-current"
                             viewBox="0 0 20 20">
                            <path
                                d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/>
                        </svg>
                    </span>
                </button>
            </a>
        </div>
    </div>
</div>
