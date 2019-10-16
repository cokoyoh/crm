@extends('emails.default')

@section('content')
    <div class="email_body">
        <p>Dear Customer,</p>

        <p>
            This is to notify you that your company <strong>{!! $companyName !!}</strong> has been registered to
            use {!! config('app.name') !!}. We are happy and ready to serve you.
        </p>

        <p>
            Kindly use this <a
                href="{{ URL::to(route('companies.complete-profile', $id)) }}">link </a>to
            complete your company profile and begin using the platform. Please note that this link can only be used once.
        </p>

        <p>Thank you.</p>

        Regards,<br/>

        {!! config('app.name') !!}<br/>
        -------------------------------------------
    </div>
@endsection
