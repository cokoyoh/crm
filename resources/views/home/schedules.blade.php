<div class="mt-8 flex items-center justify-between">
    <h3 class="text-sm text-gray-900 font-medium">Recent Schedules</h3>

    @if(count($schedules) > 0)
        <button
            class="mt-1 flex items-center text-xs text-gray-700 bg-gray-300 hover:bg-gray-200 active:bg-gray-400 rounded px-2 py-1 focus:outline-none">
                <span>
                    View all schedules
                </span>
            <span>
                <svg class="h-4 v-4 fill-current"
                     viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                </svg>
            </span>
        </button>
    @endif
</div>

<div class="mt-5">
    <table class="rounded-b-lg table-auto w-full px-2 bg-gray-100">
        <tbody>
        @forelse($schedules as $schedule)
            <tr class="border border-gray-300 px-2 h-16 @if( $schedule['id'] % 2 == 0) bg-white @endif ">
                <td class="pl-4">
                    @if($schedule['status'] == 'completed')
                        <span class="badge-default badge-default-success">Completed</span>
                    @elseif($schedule['status'] =='in_progress')
                        <span class="badge-default lead-lost">In Progress</span>
                    @elseif($schedule['status'] =='upcoming')
                        <span class="badge-default badge-default-indigo">Upcoming</span>
                    @endif
                </td>
                <td class="text-sm text-gray-600 font-medium">{!! $schedule['date'] !!}</td>
                <td class="text-sm text-gray-600 font-normal">{!!  $schedule['startAt'] !!} - {!!  $schedule['endAt'] !!} </td>
                <td class="leading-snug">
                    <p class="uppercase text-xs text-gray-600 font-semibold">Some Title</p>
                    <p class="text-gray-700 text-sm font-semibold">{!! $schedule['leadName'] !!}</p>
                </td>
                <td>
                    <form action="{!! route('schedules.destroy', $schedule['id']) !!}" method="post">
                        @csrf
                        @method('delete')
                        <button
                            type="submit"
                            class="outline-none focus:outline-none">
                            <svg class="btn-delete"
                                 viewBox="0 0 20 20">
                                <path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z"/>
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <empty
                message = 'There are no schedules yet'
                date="{!! now()->toDateString() !!} at {!! now()->format('g:i a') !!}"
            ></empty>
        @endforelse
        </tbody>
    </table>

</div>
