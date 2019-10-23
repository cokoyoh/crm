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

            @can('manageUsers', \CRM\Models\User::class)
                <th class="text-left p-3 px-5">Action</th>
            @endcan


            <th></th>
        </tr>
        @foreach($users as $user)
            <tr class="border-b hover:bg-gray-200 {!! $user->id % 2 == 0 ? 'bg-gray-100' : '' !!}">
                <td class="p-3 px-5">{!! $user->name !!}</td>
                <td class="p-3 px-5">{!! $user->email !!}</td>
                <td class="td p-3 px-5 text-left">
                    <select class="w-2/3 pr-5 bg-transparent focus:outline-none rounded focus:shadow-outline">
                        @foreach($user->roles() as $roleUser)
                            <option value="{!! $roleUser->id !!}" class="text-left">{!! $roleUser->role->name !!}</option>
                        @endforeach
                    </select>
                </td>
                <td class="p-3 px-5 text-left">
                    <span class="badge {!! $user->deactivated_at ? 'badge-danger' : 'badge-success' !!}">{!! $user->status !!}</span>
                </td>

                @canany(['manageUsers', 'delete'], $user)
                    <td class="p-3 px-5 text-left">
                        <form action="{!! route('users.destroy', $user) !!}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                @endcanany

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
