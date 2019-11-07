<div class="w-1/4 block bg-white px-4 rounded-b border-r border-gray-300">
    <div class="flex w-full justify-between p-2">
        <svg
            class="h-32 w-32 fill-current text-gray-500 md:ml-12"
            viewBox="0 0 20 20">
            <path d="M10 20a10 10 0 1 1 0-20 10 10 0 0 1 0 20zM7 6v2a3 3 0 1 0 6 0V6a3 3 0 1 0-6 0zm-3.65 8.44a8 8 0 0 0 13.3 0 15.94 15.94 0 0 0-13.3 0z"/>
        </svg>

        <dropdown>
            <template v-slot:trigger>
                <button class="text-lg text-gray-900 outline-none focus:outline-none">
                    <svg class="h-4 w-4 fill-current text-gray-600"  viewBox="0 0 20 20"><path d="M4 12a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg>
                </button>
            </template>

            @can('manageLead', $lead)
                <li class="dropdown-menu-item"><a href="#">Edit</a></li>
            @endcan
            @can('convertLead', $lead)
                <li class="dropdown-menu-item"><a href="{!! route('leads.convert', $lead) !!}">Convert</a></li>
            @endcan
            @can('markAsLost', $lead)
                <li class="dropdown-menu-item"><a href="{!! route('leads.lost', $lead) !!}">Lost</a></li>
            @endcan
            @can('destroy', $lead)
                <form action="{!! route('leads.destroy', $lead) !!}" method="post">
                    @csrf
                    @method('delete')
                    <li class="dropdown-menu-item">
                        <button class="outline-none focus:outline-none" type="submit">Delete</button>
                    </li>
                </form>

            @endcan

        </dropdown>

    </div>


    <div class="flex items-center py-4">
        <h3 class="text-lg text-green-600 font-bold">{!! $lead->name !!}</h3>
        @if($lead->status == 'Prospect')
            <span class="badge-default lead-not-followed-up font-semibold">Prospect</span>
        @elseif($lead->status == 'Converted')
            <span class="badge-default lead-converted text-xs">Converted</span>
        @elseif($lead->status == 'Lost')
            <span class="badge-default lead-lost">Lost</span>
        @elseif($lead->status == 'New')
            <span class="badge-default lead-followed-up font-semibold">New</span>
        @endif
    </div>

    <div class="flex items-center justify-between border-b border-gray-300 py-4">
        <div class="flex items-center text-gray-500 uppercase text-xs font-semibold w-1/2">
            <svg class="h-3 w-3 fill-current" viewBox="0 0 20 20">
                <path d="M8 20H3V10H0L10 0l10 10h-3v10h-5v-6H8v6z"/>
            </svg>
            <h3 class="ml-1">Organization</h3>
        </div>
        <div class="w-1/2 w-full text-left text-gray-800 text-sm">
            <p>{!! $lead->organization !!}</p>
        </div>
    </div>

    <div class="flex items-center justify-between border-b border-gray-300 py-4">
        <div class="flex items-center text-gray-500 uppercase text-xs font-semibold w-1/2">
            <svg class="h-3 w-3 fill-current" viewBox="0 0 20 20">
                <path
                    d="M10 20S3 10.87 3 7a7 7 0 1 1 14 0c0 3.87-7 13-7 13zm0-11a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
            </svg>
            <h3 class="ml-1">Address</h3>
        </div>
        <div class="w-1/2 w-full text-left text-gray-800 text-sm">
            <p>221B Baker Street</p>
            <p>Mountain View, Ld, 99043</p>
        </div>
    </div>

    <div class="flex items-center justify-between border-b border-gray-300 py-4">
        <div class="flex items-center text-gray-500 uppercase text-xs font-semibold w-1/2">
            <svg class="h-3 w-3 fill-current" viewBox="0 0 20 20">
                <path
                    d="M18 2a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4c0-1.1.9-2 2-2h16zm-4.37 9.1L20 16v-2l-5.12-3.9L20 6V4l-10 8L0 4v2l5.12 4.1L0 14v2l6.37-4.9L10 14l3.63-2.9z"/>
            </svg>
            <h3 class="ml-1">Email</h3>
        </div>
        <div class="w-1/2 w-full text-left text-gray-800 text-sm">
            <p>{!! $lead->email !!}</p>
        </div>
    </div>

    <div class="flex items-center justify-between border-b border-gray-300 py-4">
        <div class="flex items-center text-gray-500 uppercase text-xs font-semibold w-1/2">
            <svg class="h-3 w-3 fill-current" viewBox="0 0 20 20">
                <path
                    d="M20 18.35V19a1 1 0 0 1-1 1h-2A17 17 0 0 1 0 3V1a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4c0 .56-.31 1.31-.7 1.7L3.16 8.84c1.52 3.6 4.4 6.48 8 8l2.12-2.12c.4-.4 1.15-.71 1.7-.71H19a1 1 0 0 1 .99 1v3.35z"/>
            </svg>
            <h3 class="ml-1">Phone</h3>
        </div>
        <div class="w-1/2 w-full text-left text-gray-800 text-sm">
            <p>+2457 123 456</p>
        </div>
    </div>

    <div class="flex items-center justify-between py-4">
        <div class="flex items-center text-gray-500 uppercase text-xs font-semibold w-1/2">
            <svg class="h-3 w-3 fill-current" viewBox="0 0 20 20">
                <path
                    d="M1 4c0-1.1.9-2 2-2h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4zm2 2v12h14V6H3zm2-6h2v2H5V0zm8 0h2v2h-2V0zM5 9h2v2H5V9zm0 4h2v2H5v-2zm4-4h2v2H9V9zm0 4h2v2H9v-2zm4-4h2v2h-2V9zm0 4h2v2h-2v-2z"/>
            </svg>
            <h3 class="ml-1">Added</h3>
        </div>
        <div class="w-1/2 w-full text-left text-gray-800 text-sm">
            <p>{!! $lead->created_at->toFormattedDateString() !!}</p>
        </div>
    </div>

    <div class="py-4"></div>

</div>
