@extends('emails.default')

@section('content')
    <p>Dear {!! $firstname !!};</p>

    <p>Some paragraph here</p>

    <table class="crm-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Time</th>
            <th>View</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>John Doe</td>
            <td>john@exampl.com</td>
            <td>12.30pm</td>
            <td>{!! route('companies.index') !!}</td>
        </tr>
        </tbody>
    </table>

    <p>Thank you.</p>

    Regards,<br/>

    {!! config('app.name') !!}<br/>
    -------------------------------------------
@endsection
