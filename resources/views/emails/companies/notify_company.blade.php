@extends('emails.default')

@section('content')
    <div class="email_body">
        <p>Dear {!! $firstname !!},</p>

        <p>This is to notify you that a few changes have been made to {!! $companyName !!} profile
            in {!! config('app.name') !!}. </p>

        <p>The changes include;</p>

        <table class="crm-table">
            <tbody>
            <tr>
                <td>Company Name</td>
                <td>{!! $companyName !!}</td>
            </tr>
            <tr>
                <td>Company Email</td>
                <td>{!! $companyEmail !!}</td>
            </tr>
            <tr>
                <td>Company Admin</td>
                <td>{!! $adminName !!}</td>
            </tr>
            <tr>
                <td>Admin Email</td>
                <td>{!! $adminEmail !!}</td>
            </tr>
            </tbody>
        </table>

        <p>Thank you.</p>

        Regards,<br/>

        {!! config('app.name') !!}<br/>
        -------------------------------------------
    </div>
@endsection
