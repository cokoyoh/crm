@extends('emails.default')

@section('content')
    <p>Dear {!! $firstname !!};</p>

    <p>
        {!! $content !!}
    </p>
@endsection
