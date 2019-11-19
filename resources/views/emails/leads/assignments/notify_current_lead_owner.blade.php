@extends('emails.default')

@section('content')
    <div class="email_body">
        <p>Dear {!! $firstname !!},</p>

        <p>
            This is to notify you that the following lead has been reassigned to you,
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
                <td>Previous Assignee</td>
                <td>{!! $previousAssignee->name !!}</td>
                <td colspan="2">{!! $previousAssignee->email !!}</td>
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
