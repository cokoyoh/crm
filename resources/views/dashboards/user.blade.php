@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex items-center justify-between -mt-12 py-4">
            <div class="flex items-center justify-between">
                <button class="btn-default">User
                </button>
                <svg class="h-5 w-5 ml-2 fill-current text-gray-700 font-thin" viewBox="0 0 20 20">
                    <path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/>
                </svg>
                <h3 class="ml-2 text-gray-700">{!! $user->name !!}</h3>
            </div>

            <div>
                <button class="btn btn-success">Add Client</button>
            </div>
        </div>

        <div id="user-main" class="flex border-t border-gray-300 -px-4">
            <div class="w-1/4 block bg-white px-4 rounded-b border-r border-gray-300">
                <img class="border-b border-gray-300" src="/images/bg-hologram.png" alt="Default User Image">

                <div class="flex items-center py-4">
                    <h3 class="text-lg text-green-600 font-bold">{!! $user->name !!}</h3>
                    <span
                        class="badge-default badge-default-success">{!! $user->roles()[0]->role->name !!}</span>
                </div>

                <div class="flex items-center justify-between border-b border-gray-300 py-4">
                    <div class="flex items-center text-gray-500 uppercase text-xs font-semibold w-1/2">
                        <svg class="h-3 w-3 fill-current" viewBox="0 0 20 20">
                            <path d="M8 20H3V10H0L10 0l10 10h-3v10h-5v-6H8v6z"/>
                        </svg>
                        <h3 class="ml-1">Company</h3>
                    </div>
                    <div class="w-1/2 w-full text-left text-gray-800 text-sm">
                        <p>{!! $user->company->name !!}</p>
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
                        <p>{!! $user->email !!}</p>
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
                        <h3 class="ml-1">Since</h3>
                    </div>
                    <div class="w-1/2 w-full text-left text-gray-800 text-sm">
                        <p>{!! $user->created_at->toFormattedDateString() !!}</p>
                    </div>
                </div>

                <div class="py-4"></div>

            </div>

            <div class="w-3/4 px-5 py-5">
                <tabs>
                    <ul class="flex items-center justify-between w-3/4 mx-auto border rounded">
                        <li class="border-r bg-blue-600 px-8 py-2 font-medium text-sm text-white rounded">Schedules</li>
                        <li class="border-r px-8 py-2 font-medium text-sm text-gray-700">Clients</li>
                        <li class="border-r px-8 py-2 font-medium text-sm text-gray-700">Interactions</li>
                        <li class="border-r px-8 py-2 font-medium text-sm text-gray-700">Deals</li>
                        <li class="px-8 py-2 font-medium text-sm text-gray-700">Reports</li>
                    </ul>
                </tabs>

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

            </div>
        </div>
    </div>
@endsection
