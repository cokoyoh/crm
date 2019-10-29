<div class="mt-8 w-full">
    <div class="flex items-center justify-between">
        <div class="flex items-center justify-between w-1/2">
            <input
                class="border border-gray-500 text-sm px-1 py-1 text-gray-700 rounded text-center focus:outline-none"
                type="date" name="start_date" value="{!! now()->subWeek()->toDateString() !!}">
            <span class="ml-1 font-semibold text-gray-700 ">-</span>
            <input
                class="border border-gray-500 text-sm px-1 py-1 text-gray-700 rounded text-center focus:outline-none ml-1"
                type="date" name="end_date" value="{!! now()->toDateString() !!}">

            <select name="status" id="status"
                    class="block h-8 bg-white border border-gray-500 text-sm text-gray-700 px-2 py-4 rounded focus:outline-none focus:bg-white focus:border-gray-500 ml-3">
                <option value="">All Statuses</option>
                <option value="">Upcoming</option>
                <option value="">Completed</option>
                <option value="">In Progress</option>
            </select>

            <button type="submit" class="flex items-center ml-3 btn-default">
                <svg class="h-3 w-3 fill-current font-medium" viewBox="0 0 20 20">
                    <path d="M13 8V2H7v6H2l8 8 8-8h-5zM0 18h20v2H0v-2z"/>
                </svg>
                <span class="ml-2">Export</span>
            </button>
        </div>

        <button class="flex items-center btn btn-success">
            <svg class="h-4 w-4 fill-current font-medium" viewBox="0 0 20 20">
                <path
                    d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/>
            </svg>
            <span class="ml-1 font-medium">Schedule</span>
        </button>
    </div>

    <div class="mt-8">
        <table class="rounded-b-lg table-auto w-full px-2">
            <tbody>
            @foreach(range(0, 5) as $index)
                <tr class="border border-gray-300 px-2 h-16 @if($index > 1) bg-white @endif ">
                    <td class="pl-4">
                        @if($index < 2)
                            <span class="badge-default badge-default-success uppercase">completed</span>
                        @else
                            <span class="badge-default badge-default-indigo uppercase">In Progress</span>
                        @endif
                    </td>
                    <td class="text-sm text-gray-600 font-medium">{!! now()->toFormattedDateString() !!}</td>
                    <td class="text-sm text-gray-600 font-normal">{!! now()->subRealMinutes(4)->format('H:i a')!!} - {!! now()->format('H:i a')!!} </td>
                    <td class="leading-snug">
                        <p class="uppercase text-xs text-gray-600 font-semibold">Some Title</p>
                        <p class="text-gray-700 text-sm font-semibold">Some Name</p>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
