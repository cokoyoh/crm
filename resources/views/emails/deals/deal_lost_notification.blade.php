@extends('emails.default')

@section('content')
    <div class="email_body">
        <p>Dear {!! $firstname !!},</p>

        <p>
            This is to notify you that the following deal has been marked as <strong>lost</strong> by {!! auth()->user()->name !!}.
        </p>

        <table class="crm-table">
            <tbody>
            <tr>
                <td>Deal</td>
                <td>{!! $deal['name'] !!}</td>
            </tr>
            <tr>
                <td>Product</td>
                <td>{!! $deal['product'] !!}</td>
            </tr>
            <tr>
                <td>Client</td>
                <td>{!! $deal['client'] !!}</td>
            </tr>
            <tr>
                <td>Amount</td>
                <td>{!! $deal['amount'] !!}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
