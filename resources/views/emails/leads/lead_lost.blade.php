@extends('emails.default')

@section('content')
    <div class="email_body">
        <p>Dear {!! $firstname !!},</p>

        <p>
            This is to notify you that the following lead has been marked as <strong>lost</strong> by {!! auth()->user()->name !!}.
        </p>

        <table class="crm-table">
            <tbody>
            <tr>
                <td>Lead</td>
                <td>{!! $lead->name !!}</td>
                <td>{!! $lead->email !!}</td>
            </tr>
            <tr>
                <td>Assignee</td>
                <td>{!! $assignee->name !!}</td>
                <td>{!! $assignee->email !!}</td>
            </tr>
            <tr>
                <td>Immediate Lead Stage</td>
                <td colspan="2">{!! $stage !!}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
