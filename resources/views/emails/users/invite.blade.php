@extends('emails.default')

@section('content')
    <div class="email_body">
        <p>Dear {!! $firstname !!},</p>

        <p>
            This is to notify you that an account has been created for you in {!! config('app.name') !!} as
            a {!! $role !!}. The details of the account are as indicated below,
        </p>

        <table class="crm-table">
            <thead>
               <tr>
                   <th></th>
                   <th>Name</th>
                   <th>Email</th>
               </tr>
            </thead>
            <tbody>
            <tr>
                <td>Company</td>
                <td>{!! $companyName !!}</td>
                <td>{!! $companyEmail !!}</td>
            </tr>
            <tr>
                <td>Invited By</td>
                <td>{!! $adminName !!}</td>
                <td>{!! $adminEmail !!}</td>
            </tr>
            <tr>
                <td>Role</td>
                <td colspan="2">{!! $role !!}</td>
            </tr>
            </tbody>
        </table>

        <p>
            Kindly use this <a
                href="{{ URL::to(route('users.profile', $id)) }}"> link </a>to
            complete your profile and begin using the platform. Please note, that this link can only be used once.
        </p>
    </div>
@endsection
