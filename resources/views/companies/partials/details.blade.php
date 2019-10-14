<div class="card bg-white">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <img class="w-10 h-10 rounded-full mr-4" src="/images/default.png" alt="Company Logo">
            <div class="text-sm">
                <p class="text-gray-900 leading-none py-2">{!! $company->name !!}</p>
                <p class="text-gray-600">Since {!! $company->created_at->toFormattedDateString() !!}</p>
            </div>
        </div>

        <div>
            <p class="text-grey-600 ml-2 text-sm font-normal">
                {{--            <i class="material-icons">--}}
                {{--                email--}}
                {{--            </i>--}}
                {!! $company->email !!}
            </p>
        </div>
    </div>
</div>
