<div class="flex justify-between items-end">
    <h3 class="text-lg text-gray-700 font-normal mt-20">Users</h3>
    <a href="{!! route('users.invite', $company) !!}" class="btn btn-blue ml-4">Add User</a>
</div>

<div class="flex justify-between w-full mt-4 py-4">
    <table class="crm-table table-auto">
        <tbody>
        <tr class="border-b">
            <th class="text-left p-3 px-5">Name</th>
            <th class="text-left p-3 px-5">Email</th>
            <th class="text-left p-3 px-5">Role</th>
            <th class="text-left p-3 px-5">Status</th>
            <th class="text-left p-3 px-5">Action</th>
            <th></th>
        </tr>
        @foreach($users as $user)
            <tr class="border-b hover:bg-gray-200 {!! $user->id % 2 == 0 ? 'bg-gray-100' : '' !!}">
                <td class="p-3 px-5">{!! $user->name !!}</td>
                <td class="p-3 px-5">{!! $user->email !!}</td>
                <td class="td p-3 px-5">
                    <select class="bg-transparent">
                        @foreach($user->roles() as $roleUser)
                            <option value="{!! $roleUser->id !!}" class="td">{!! $roleUser->role->name !!}</option>
                        @endforeach
                    </select>
                </td>
                <td class="p-3 px-5 text-left">
                    <span class="badge {!! $user->deactivated_at ? 'badge-danger' : 'badge-success' !!}">{!! $user->status !!}</span>
                </td>
                <td class="p-3 px-5 text-left flex justify-end">
                    <button type="button" class="btn-sm btn-danger">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
