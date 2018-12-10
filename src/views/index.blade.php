<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- This page only for admins and no need to index in search engines -->
    <meta name="robots" content="noindex">

    <link rel="stylesheet" href="{{asset('vendor/smsirlaravel/css/smsirlaravel-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/smsirlaravel/css/smsirlaravel-rtl.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/smsirlaravel/css/style.css')}}">
    <title>{{config('smsirlaravel.title')}}</title>
</head>
<body class="smsir-panel">
    <header>
        <div class="topbar container">
            <div class="row">
                <div class="top-title text-center">
                    <h2>{{config('smsirlaravel.title')}}</h2><br>
                    <h5>موجودی: {{$credit}} پیامک </h5>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <section class="sms-send-list">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <h3 class="panel-title">پیامک های ارسالی توسط وب سایت</h3>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-list">
                            <thead>
                            <tr>
                                <th><em class="fa fa-cog"></em></th>
                                <th>وضعیت</th>
                                <th>وضعیت ارسال</th>
                                <th>شماره موبایل</th>
                                <th>متن ارسالی</th>
                                <th>ارسال از طریق</th>
                                <th>زمان ارسال</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($smsirlaravel_logs as $log)
                                <tr>
                                    <td align="center">
                                        <a onclick="return confirm('حذف شود؟')" href="{{route('deleteLog',['log'=>$log])}}" class="btn btn-danger"><em class="fa fa-trash"></em></a>
                                    </td>
                                    <td>{!! $log->sendStatus() !!}</td>
                                    <td>{{$log->response}}</td>
                                    <td>{{$log->to}}</td>
                                    <td>{{$log->message}}</td>
                                    <td>{{$log->from}}</td>
                                    <td dir="ltr">{{$log->created_at->diffForHumans()}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            {{ $smsirlaravel_logs->links() }}
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
</html>
