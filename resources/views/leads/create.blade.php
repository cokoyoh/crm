@extends('layouts.app')

@section('content')
    <div class="-mx-3 bg-gray-200 overflow-auto">
        <div class="mx-auto px-24 pt-1 pb-6 bg-white shadow-sm">
            <div class="mt-4 flex items-center justify-between">
                <p class="text-gray-900 text-lg font-medium">Add New Lead</p>

                <button
                    class="ml-5 flex items-center pr-4 pl-2 py-2 text-sm font-medium text-white bg-gray-800 hover:bg-gray-700 rounded focus:outline-none">
                    <svg
                        class="fill-current h-4 w-4"
                        viewBox="0 0 20 20">
                        <path d="M3.828 9l6.071-6.071-1.414-1.414L0 10l.707.707 7.778 7.778 1.414-1.414L3.828 11H20V9H3.828z"/>
                    </svg>
                    <span class="ml-1">Back</span>
                </button>
            </div>
        </div>

        <div class="h-screen mx-auto px-24 pt-5">
            <lead-form></lead-form>
        </div>
    </div>
@endsection
