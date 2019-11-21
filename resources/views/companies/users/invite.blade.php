{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <div class="lg:w-1/2 lg:mx-auto bg-white p-6 md:py-12 md:px-6 rounded shadow">--}}
{{--        <h1 class="text-2xl font-normal mb-10 text-center">--}}
{{--            Add User Account--}}
{{--        </h1>--}}

{{--        <form method="post" action="{!! route('users.invite.store', $company) !!}">--}}
{{--             @csrf--}}
{{--            <div class="w-full px-3 mb-4">--}}
{{--                <label for="name"--}}
{{--                       class=" label text-gray-600 font-semibold uppercase text-xs tracking-wider mb-2">Name</label>--}}
{{--                <input type="text" name="name"--}}
{{--                       placeholder="John Doe"--}}
{{--                       required--}}
{{--                       class=" w-full focus:outline-none focus:bg-white py-3 px-4  appearance-none border focus:border-blue-300 border-gray-200 text-sm text-gray-800 rounded mt-2">--}}
{{--                @if ($errors->has('name'))--}}
{{--                    <p class="text-red-500 text-xs italic mt-1 mb-1">{{ $errors->first('name') }}</p>--}}
{{--                @endif--}}
{{--            </div>--}}

{{--            <div class="w-full px-3">--}}
{{--                <label for="email"--}}
{{--                       class=" label text-gray-600 font-semibold uppercase text-xs tracking-wider mb-2">Email</label>--}}
{{--                <input type="email" name="email"--}}
{{--                       placeholder="john@example.com"--}}
{{--                       required--}}
{{--                       class=" w-full focus:outline-none focus:bg-white py-3 px-4  appearance-none border focus:border-blue-300 border-gray-200 text-sm text-gray-800 rounded mt-2">--}}
{{--                @if ($errors->has('email'))--}}
{{--                    <p class="text-red-500 text-xs italic mt-1 mb-1">{{ $errors->first('email') }}</p>--}}
{{--                @endif--}}
{{--            </div>--}}

{{--            <div class="control mt-2 px-3 py-4">--}}
{{--                <button type="submit" class="btn btn-blue font-semibold mr-2">Send Invite</button>--}}
{{--                <button class="btn btn-gray font-semibold">--}}
{{--                    <a href="{!! route('companies.index') !!}">Cancel</a>--}}
{{--                </button>--}}
{{--            </div>--}}

{{--        </form>--}}

{{--    </div>--}}
{{--@endsection--}}


@extends('layouts.app')

@section('content')
    <div class="-mx-3 bg-gray-200 overflow-auto">
        <div class="mx-auto px-24 pt-1 pb-6 bg-white shadow-sm">
            <div class="flex items-center justify-between border-b pb-6">
                <div class="flex items-center">
                </div>
                <div class="flex items-center justify-between">
                    <button class="focus:outline-none">
                        <svg class="h-5 w-5 fill-current text-gray-500 hover:text-teal-700">
                            <path d="M6 8v7h8V8a4 4 0 1 0-8 0zm2.03-5.67a2 2 0 1 1 3.95 0A6 6 0 0 1 16 8v6l3 2v1H1v-1l3-2V8a6 6 0 0 1 4.03-5.67zM12 18a2 2 0 1 1-4 0h4z"/>
                        </svg>
                    </button>

                    <form action="{!! route('logout') !!}" method="post">
                        @csrf
                        <button
                            class="ml-3 text-sm font-medium text-gray-700 bg-gray-200 px-2 py-1 rounded hover:bg-gray-100 focus:outline-none active:bg-gray-300 active:text-gray-900"
                            type="submit"
                        >Log out</button>
                    </form>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-between">
                <p class="text-gray-900 text-lg font-medium">Add User Account</p>

                <a href="{!! route('users.index') !!}">
                    <button
                        class="ml-5 flex items-center pr-4 pl-2 py-2 text-sm font-medium text-white bg-gray-800 hover:bg-gray-700 rounded focus:outline-none">
                        <svg
                            class="fill-current h-4 w-4"
                            viewBox="0 0 20 20">
                            <path d="M3.828 9l6.071-6.071-1.414-1.414L0 10l.707.707 7.778 7.778 1.414-1.414L3.828 11H20V9H3.828z"/>
                        </svg>
                        <span class="ml-1">Back</span>
                    </button>
                </a>
            </div>
        </div>

        <div class="h-screen mx-auto px-24 pt-5">
            @include('flash.message')

            <form class="bg-gray-100 px-8 py-5 rounded"
                  method="post"
                  action="{!! route('users.invite.store', auth()->user()->company) !!}">
                @csrf
                <div class="field mb-6">
                    <label for="title" class="label text-sm mb-2 block">Name</label>

                    <div class="control">
                        <input type="text"
                               class="input appearance-none bg-transparent border border-gray-300 rounded py-2 px-3 text-sm w-full focus:outline-none focus:border-blue-300 focus:bg-white"
                               value=""
                               name="name"
                               required
                               autocomplete="no"
                               placeholder="John Doe">
                        @if ($errors->has('name'))
                            <p class="text-red-500 text-xs italic mt-1 mb-1">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                </div>

                <div class="field mb-6">
                    <label for="description" class="label text-sm mb-2 block">Email</label>

                    <div class="control">
                        <input type="email"
                               class="input appearance-none bg-transparent border border-gray-300 rounded py-2 px-3 text-sm w-full focus:outline-none focus:border-blue-300 focus:bg-white"
                               value=""
                               name="email"
                               autocomplete="no"
                               required
                               placeholder="lee@example.com">
                        @if ($errors->has('email'))
                            <p class="text-red-500 text-xs italic mt-1 mb-1">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                </div>

                <div class="field mb-6">
                    <button
                        class="flex items-center pr-4 pl-2 py-2 text-sm font-medium text-white bg-gray-800 hover:bg-gray-700 rounded focus:outline-none"
                    >
                        <span>Send Invite</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

