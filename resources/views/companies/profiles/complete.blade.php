@extends('layouts.app')


@section('content')
    <div class="container lg:w-2/3 lg:mx-auto bg-white shadow rounded pt-4 pb-2">
        <h1 class="text-2xl text-center font-normal py-2 mb-4">Complete Company Profile</h1>
        <form action="{!! route('companies.profiles.store', $company->id) !!}" method="post">
            @csrf
            <div class="control justify-between">
                <div class="w-full px-3 mb-4">
                    <label for="company_name" class="text-gray-600 font-semibold uppercase text-xs tracking-wider mb-3">Company
                        Name</label>
                    <input type="text" name="company_name" value="{!! $company->name !!}"
                           placeholder="Million Dollar LLC"
                           class=" w-full focus:outline-none focus:bg-white py-3 px-4  appearance-none border focus:border-blue-300 border-gray-200 text-sm text-gray-800 rounded mt-2">
                    @if ($errors->has('company_name'))
                        <p class="text-red-500 text-xs italic mt-1 mb-1">{{ $errors->first('company_name') }}</p>
                    @endif
                </div>

                <div class="w-full px-3 mb-12">
                    <label for="company_email"
                           class=" label text-gray-600 font-semibold uppercase text-xs tracking-wider mb-2">Company
                        Email</label>
                    <input type="email" name="company_email" value="{!! $company->email !!}"
                           placeholder="company@domain.com"
                           class=" w-full focus:outline-none focus:bg-white py-3 px-4  appearance-none border focus:border-blue-300 border-gray-200 text-sm text-gray-800 rounded mt-2">
                    @if ($errors->has('company_email'))
                        <p class="text-red-500 text-xs italic mt-1 mb-1">{{ $errors->first('company_email') }}</p>
                    @endif
                </div>

            </div>

            <div class="control flex justify-between mb-12">
                <div class="w-full px-3">
                    <label for="name" class="block text-gray-600  font-semibold uppercase text-xs tracking-wider mb-2">Admin</label>
                    <input type="text" name="name" placeholder="John Doe"
                           class="block w-full focus:outline-none focus:bg-white py-3 px-4  appearance-none border focus:border-blue-300 border-gray-200 text-sm text-gray-800 rounded">
                    @if ($errors->has('name'))
                        <p class="text-red-500 text-xs italic mt-1 mb-1">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="w-full px-3">
                    <label for="email"
                           class="block label text-gray-600  font-semibold uppercase text-xs tracking-wider mb-2">Email</label>
                    <input type="email" name="email" placeholder="john@example.com"
                           class="block w-full focus:outline-none focus:bg-white py-3 px-4  appearance-none border focus:border-blue-300 border-gray-200 text-sm text-gray-800 rounded">
                    @if ($errors->has('email'))
                        <p class="text-red-500 text-xs italic mt-1 mb-1">{{ $errors->first('email') }}</p>
                    @endif
                </div>
            </div>


            <div class="control flex justify-between">
                <div class="w-full px-3">
                    <label for="password"
                           class="block text-gray-600  font-semibold uppercase text-xs tracking-wider mb-2">Password</label>
                    <input type="password" name="password" placeholder="**********"
                           class="block w-full focus:outline-none focus:bg-white py-3 px-4  appearance-none border focus:border-blue-300 border-gray-200 text-sm text-gray-800 rounded">
                    @if ($errors->has('password'))
                        <p class="text-red-500 text-xs italic mt-1 mb-1">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <div class="w-full px-3">
                    <label for="password_confirmation"
                           class="block label text-gray-600  font-semibold uppercase text-xs tracking-wider mb-2">Confirm
                        Password</label>
                    <input type="password" name="password_confirmation" placeholder="***********"
                           class="block w-full focus:outline-none focus:bg-white py-3 px-4  appearance-none border focus:border-blue-300 border-gray-200 text-sm text-gray-800 rounded">
                    @if ($errors->has('password_confirmation'))
                        <p class="text-red-500 text-xs italic mt-1 mb-1">{{ $errors->first('password_confirmation') }}</p>
                    @endif
                </div>
            </div>

            <div class="control mt-4 px-3 py-4">
                <button class="button px-3 py-3 font-semibold focus:outline-none">Submit Profile</button>
            </div>

        </form>
    </div>
@endsection
