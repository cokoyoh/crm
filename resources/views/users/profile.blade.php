@extends('layouts.app')

@section('content')
    <div class="lg:w-1/2 lg:mx-auto bg-white p-6 md:py-12 md:px-6 rounded shadow">
        <h1 class="text-2xl font-normal mb-10 text-center">
            Update User Profile
        </h1>

        <form method="post" action="{!! route('users.update', $user) !!}">
            @csrf
            <div class="w-full px-3 mb-4">
                <label for="name"
                       class=" label text-gray-600 font-semibold uppercase text-xs tracking-wider mb-2">Name</label>
                <input type="text" name="name"
                       placeholder="John Doe"
                       value="{!! $user->fullname !!}"
                       required
                       class=" w-full focus:outline-none focus:bg-white py-3 px-4  appearance-none border focus:border-blue-300 border-gray-200 text-sm text-gray-800 rounded mt-2">
                @if ($errors->has('name'))
                    <p class="text-red-500 text-xs italic mt-1 mb-1">{{ $errors->first('name') }}</p>
                @endif
            </div>

            <div class="w-full px-3 mb-4">
                <label for="email"
                       class=" label text-gray-600 font-semibold uppercase text-xs tracking-wider mb-2">Email</label>
                <input type="email" name="email"
                       placeholder="john@example.com"
                       value="{!! $user->email !!}"
                       required
                       class=" w-full focus:outline-none focus:bg-white py-3 px-4  appearance-none border focus:border-blue-300 border-gray-200 text-sm text-gray-800 rounded mt-2">
                @if ($errors->has('email'))
                    <p class="text-red-500 text-xs italic mt-1 mb-1">{{ $errors->first('email') }}</p>
                @endif
            </div>

            <div class="w-full px-3 mb-4">
                <label for="password"
                       class=" label text-gray-600 font-semibold uppercase text-xs tracking-wider mb-2">Password</label>
                <input type="password" name="password"
                       placeholder="***********"
                       required
                       class=" w-full focus:outline-none focus:bg-white py-3 px-4  appearance-none border focus:border-blue-300 border-gray-200 text-sm text-gray-800 rounded mt-2">
                @if ($errors->has('password'))
                    <p class="text-red-500 text-xs italic mt-1 mb-1">{{ $errors->first('password') }}</p>
                @endif
            </div>

            <div class="w-full px-3">
                <label for="password_confirmation"
                       class=" label text-gray-600 font-semibold uppercase text-xs tracking-wider mb-2">Confirm
                    Password</label>
                <input type="password" name="password_confirmation"
                       placeholder="***********"
                       required
                       class=" w-full focus:outline-none focus:bg-white py-3 px-4  appearance-none border focus:border-blue-300 border-gray-200 text-sm text-gray-800 rounded mt-2">
                @if ($errors->has('password_confirmation'))
                    <p class="text-red-500 text-xs italic mt-1 mb-1">{{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>

            <div class="control mt-2 px-3 py-4">
                <button class="btn btn-blue px-3 py-3">Submit</button>
            </div>

        </form>

    </div>
@endsection
