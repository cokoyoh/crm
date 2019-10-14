<div class="flex justify-between items-end">
    <h3 class="text-lg text-gray-700 font-normal mt-20">Users</h3>
    <a href="{!! $company->path() .'/edit' !!}" class="button ml-4">Add User</a>
</div>

<div class="flex justify-between w-full card mt-4">
    <div class="px-3 py-4 flex justify-center">
        <table class="table-auto w-full text-md shadow rounded mb-4">
            <tbody>
            <tr class="border-b">
                <th class="text-left p-3 px-5">Name</th>
                <th class="text-left p-3 px-5">Email</th>
                <th class="text-left p-3 px-5">Role</th>
                <th class="text-left p-3 px-5">Status</th>
                <th class="text-left p-3 px-5">Action</th>
                <th></th>
            </tr>
            <tr class="border-b hover:bg-orange-100 bg-gray-100">
                <td class="p-3 px-5"><input type="text" value="user.name" class="bg-transparent"></td>
                <td class="p-3 px-5"><input type="text" value="user.email" class="bg-transparent"></td>
                <td class="p-3 px-5">
                    <select value="user.role" class="bg-transparent">
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                    </select>
                </td>
                <td class="p-3 px-5"><input type="text" value="user.status" class="bg-transparent"></td>
                <td class="p-3 px-5 flex justify-end">
                    <button type="button"
                            class="text-xs bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded-lg focus:outline-none focus:shadow-outline">
                        Delete
                    </button>
                </td>
            </tr>
            <tr class="border-b hover:bg-orange-100">
                <td class="p-3 px-5"><input type="text" value="user.name" class="bg-transparent"></td>
                <td class="p-3 px-5"><input type="text" value="user.email" class="bg-transparent"></td>
                <td class="p-3 px-5">
                    <select value="user.role" class="bg-transparent">
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                    </select>
                </td>
                <td class="p-3 px-5"><input type="text" value="user.status" class="bg-transparent"></td>
                <td class="p-3 px-5 flex justify-end">
                    <button type="button"
                            class="text-xs bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded-lg focus:outline-none focus:shadow-outline">
                        Delete
                    </button>
                </td>
            </tr>

            <tr class="border-b hover:bg-orange-100">
                <td class="p-3 px-5"><input type="text" value="user.name" class="bg-transparent"></td>
                <td class="p-3 px-5"><input type="text" value="user.email" class="bg-transparent"></td>
                <td class="p-3 px-5">
                    <select value="user.role" class="bg-transparent">
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                    </select>
                </td>
                <td class="p-3 px-5"><input type="text" value="user.status" class="bg-transparent"></td>
                <td class="p-3 px-5 flex justify-end">
                    <button type="button"
                            class="text-xs bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded-lg focus:outline-none focus:shadow-outline">
                        Delete
                    </button>
                </td>
            </tr>
            <tr class="border-b hover:bg-orange-100 bg-gray-100">
                <td class="p-3 px-5"><input type="text" value="user.name" class="bg-transparent"></td>
                <td class="p-3 px-5"><input type="text" value="user.email" class="bg-transparent"></td>
                <td class="p-3 px-5">
                    <select value="user.role" class="bg-transparent">
                        <option value="user">user</option>
                        <option value="admin">admin</option>
                    </select>
                </td>
                <td class="p-3 px-5"><input type="text" value="user.status" class="bg-transparent"></td>
                <td class="p-3 px-5 flex justify-end">
                    <button type="button"
                            class="text-xs bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded-lg focus:outline-none focus:shadow-outline">
                        Delete
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

</div>
