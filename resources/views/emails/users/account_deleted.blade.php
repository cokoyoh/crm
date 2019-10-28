@extends('emails.default')

@section('content')
    <div class="email_body">
        <p>Dear {!! $firstname !!},</p>

        <p>This is to notify you that your account in {!! config('app.name') !!} has been deleted. This action was
            performed by the admin who details are provided below.</p>

        <table class="crm-table">
            <tbody>
            <tr>
                <td>Admin Name</td>
                <td>{!! $adminName !!}</td>
            </tr>
            <tr>
                <td>Admin Email</td>
                <td>{!! $adminEmail !!}</td>
            </tr>
            </tbody>
        </table>

        <p>Should you have any queries feel free to contact us through the email address, <strong><a
                    href="mailto:{!! $companyEmail !!}">.</a></strong></p>
    </div>
@endsection
