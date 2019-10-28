@extends('emails.default')

@section('content')
    <div class="email_body">
        <p>Dear {!! $firstname !!},</p>

        <p>
            This is to notify you that you have been designated as the <strong>{!! $role !!}</strong> for
            <strong>{!! $companyName !!}</strong> effective immediately.
        </p>

        <p>
            Kindly ensure you attend to the duties required of you in your new role.
        </p>
    </div>
@endsection
