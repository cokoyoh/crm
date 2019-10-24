<div class="flex justify-between items-end">
    <h3 class="text-lg text-gray-700 font-normal mt-20">Companies</h3>
    <a href="{!! route('companies.create') !!}" class="btn btn-blue ml-4">Add Company</a>
</div>

<div class="flex justify-between w-full mt-4 py-4">
    <table class="crm-table table-auto">
        <tbody>
        <tr class="border-b">
            <th class="text-left p-3 px-5">Company Name</th>
            <th class="text-left p-3 px-5">Company Email</th>
            <th class="text-left p-3 px-5">Admin</th>
            <th class="text-left p-3 px-5">Admin Email</th>
            <th class="text-left p-3 px-5">Users</th>
        </tr>
        @foreach($companies as $company)
            <tr class="border-b hover:bg-gray-200 {!! $company->id % 2 == 0 ? 'bg-gray-100' : '' !!}">
                <td class="p-3 px-5">{!! $company->name !!}</td>
                <td class="p-3 px-5">{!! $company->email !!}</td>
                <td class="p-3 px-5">{!! $company->admin->name !!}</td>
                <td class="p-3 px-5">{!! $company->admin->email !!}</td>
                <td class="p-3 px-5 text-left">
                    <span class="badge badge-success ">{!! $company->users()->count() !!}</span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
