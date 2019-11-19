@extends('emails.default')

@section('content')
    <div class="email_body">
        <p>Dear {!! $firstname !!},</p>

        <p>
            This is to notify you that the lead detailed below has been reassigned,
        </p>

        <table class="crm-table">
            <tbody>
            <tr>
                <td>Lead</td>
                <td>{!! $lead->name !!}</td>
                <td>{!! $lead->email !!}</td>
                <td>{!! $lead->phone !!}</td>
            </tr>
            <tr>
                <td>Reassigned To</td>
                <td>{!! $currentAssignee->name !!}</td>
                <td colspan="2">{!! $currentAssignee->email !!}</td>
            </tr>

            <tr>
                <td>Reassigned By</td>
                <td>{!! $admin->name !!}</td>
                <td colspan="2">{!! $admin->email !!}</td>
            </tr>

            </tbody>
        </table>
    </div>
@endsection
