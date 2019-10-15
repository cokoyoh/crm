@extends('emails.default')

@section('content')
    <p>Dear {!! $firstname !!};</p>

    <p>
        {!! $content !!}
    </p>

    <p>Thank you.</p>

    Regards,<br/>

    Jamiicare CRM<br/>
    -------------------------------------------
@endsection
