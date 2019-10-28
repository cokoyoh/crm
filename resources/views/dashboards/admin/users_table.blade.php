<div class="flex justify-between items-end">
    <h3 class="text-lg text-gray-700 font-normal mt-20">Users</h3>
    <a href="{!! route('users.invite', $user->company) !!}" class="btn btn-blue ml-4">Add User</a>
</div>

<div class="flex justify-between w-full mt-4 py-4">
    <table class="crm-table table-auto">
        <tbody>
        <tr class="border-b">
            <th class="text-left p-3 px-5">Date</th>
            <th class="text-left p-3 px-5">Name</th>
            <th class="text-left p-3 px-5">Email</th>
            <th class="text-left p-3 px-5">Phone</th>
            <th class="text-left p-3 px-5">Role</th>
        </tr>
        @foreach($companyUsers as $user)
            <tr class="border-b hover:bg-gray-200">
                <td class="p-3 px-5">{!! $user->created_at->toFormattedDateString() !!}</td>
                <td class="p-3 px-5">{!! $user->name !!}</td>
                <td class="p-3 px-5">{!! $user->email !!}</td>
                <td class="p-3 px-5">{!! $user->phone !!}</td>
                <td class="p-3 px-5 text-left">
                    <span class="badge @if($user->roles()[0]->role->id == 1) badge-warning @elseif($user->roles()[0]->role->id == 2) badge-success @else  badge-primary @endif ">{!! $user->roles()[0]->role->name !!}</span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
