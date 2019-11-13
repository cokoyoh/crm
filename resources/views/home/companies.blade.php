<div class="mt-8 flex items-center justify-between">
    <h3 class="text-sm text-gray-900 font-medium">Registered Companies</h3>
    <button
        class="mt-1 flex items-center text-xs text-gray-700 bg-gray-300 hover:bg-gray-200 active:bg-gray-400 rounded px-2 py-1 focus:outline-none">
                    <span>
                        View all users
                    </span>
        <span>
                        <svg class="h-4 v-4 fill-current"
                             viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                   </span>
    </button>
</div>

<div class="mt-5">
    <table class="rounded-b-lg table-auto w-full px-2 bg-gray-100">
        <tbody>
            @foreach($companies as $company)
                <tr class="border border-gray-300 px-2 h-16 @if( $company['id'] % 2 == 0) bg-white @endif ">
                    <td class="pl-4">
                        @if($company['status'] == 'Active')
                            <span class="badge-default badge-default-success">Active</span>
                        @elseif($company['status'] =='Inactive')
                            <span class="badge-default lead-lost">Inactive</span>
                        @elseif($company['status'] =='Unverified')
                            <span class="badge-default badge-default-indigo">Unverified</span>
                        @endif
                    </td>
                    <td class="text-sm text-gray-600 font-normal">{!! $company['date'] !!}</td>
                    <td class="leading-snug">
                        <p class="uppercase text-xs text-gray-600 font-semibold">{!! $company['name'] !!}</p>
                        <p class="text-gray-700 text-sm font-semibold">{!! $company['email'] !!}</p>
                    </td>
                    <td class="leading-snug">
                        <p class="uppercase text-xs text-gray-600 font-normal">{!! $company['admin_name'] !!}</p>
                        <p class="text-gray-700 text-sm font-normal">{!! $company['admin_email'] !!}</p>
                    </td>

                    <td>
                        <span class="bg-gray-300 rounded-full py-1 px-2 text-xs text-gray-700 font-medium">{!! $company['users_count'] !!} {!! pluralise('User', $company['users_count']) !!}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
