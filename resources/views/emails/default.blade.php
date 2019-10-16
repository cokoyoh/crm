<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        .crm-table {
            border: solid 1px #006b5a;
            border-radius: 3px;
            border-spacing: 0;
            width: 80%;
            margin: auto;
            display: table;
            border-collapse: separate;
            font: normal 13px Arial, sans-serif;
        }

        .crm-table thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }

        .crm-table thead tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        .crm-table thead th {
            border: solid 1px #006b5a;
            color: #222222;
            padding: 4px;
            text-shadow: 1px 1px 1px #fff;
            border-spacing: 0;
            display: table-cell;
            vertical-align: inherit;
            text-align: -internal-center;
        }

        .crm-table tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }

        .crm-table tbody tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        .crm-table tbody td {
            border: solid 1px #006b5a;
            color: #333;
            padding: 4px;
            font-weight: 300;
            text-shadow: 1px 1px 1px #fff;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            min-width: 100px;
        }
    </style>
</head>
<body style="background-color: #E6E6E6;font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
<div style="margin-top:0;background-color: transparent;padding: 20px 0">
    <div style="width: 80%;display: block;margin:0 auto;">
    </div>
</div>
<div style="
            padding: 0 0 20px;
            background-clip: content-box;
            background-color: #fff;
            width: 80%;
            margin: auto;
            margin-bottom: 20px;">
    <div style="
        padding-top: 10px;
        padding-bottom: 10px;
            line-height: 1.5em;
            font-weight: 300;
             text-align: center;
             font-size: 24px;
            width: 100%;
            color: #176A5D;
            background: #f6f8fa">
        <p>{!! config('app.name') !!}</p>
    </div>
    <div style="padding: 10px;
            line-height: 1.5em;
            font-weight: 300;
             margin:auto;
            width: 80%;
            color: #565656;
            overflow: scroll">
        @yield('content')
    </div>
    <hr style="border:1px solid #afafaf;">
    <div style="padding: 10px;
            line-height: 1.5em;
            font-weight: 300;
            margin:auto;
            min-height: 100px;
            width: 80%;
            color: #565656;">
        <p style="margin: 0;">{!! config('app.name') !!}, HQ</p>
        <p style="margin: 0;">{!! config('company.address') !!}</p>
        <p style="margin: 0;">{!! \Illuminate\Support\Str::substr(config('app.url'), 8) !!}</p>
        <div style="border-top:1px solid #adb0b5;color:#adb0b5;margin-bottom:10px;margin-top:30px;padding-top:10px;width:97%">
            <div style="float:left;width:50%">
                <small style="font-size:10px"> &copy; {!!  now()->year !!} {!! config('app.name') !!} </small>
            </div>
            <div style="margin-left:50%;text-align:right">
                <small style="font-size:10px"> A product of <a href="{!! config('app.url') !!}" style="font-family:Helvetica Neue,Helvetica,Arial;font-size:inherit!important;font-weight:bold;text-decoration:none;color:inherit">{!! config('app.name') !!}</a> </small>
            </div>
            <div style="clear:both"></div>
        </div>
    </div>
</div>
</body>
</html>
