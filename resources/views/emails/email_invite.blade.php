<!DOCTYPE html>
<html>
<head>
    <title>{{ trans('messages.email.invite') }}</title>
    <style>
        .content {
            background: darkcyan;
            padding: 50px;
        }
        .register {
            display: block;
            margin: 50px auto;
            background: white;
            max-width: 500px;
            padding: 15px;
            box-shadow: 5px 5px 2px black;
        }
        .register .heding {
            text-align: center;
        }
        .register .body {
            padding:15px;
        }
        .dear {
            font-size: 20px;
        }
        .link-active {
            background: green;
            color: white;
            display: block;
            width: 200px;
            text-align: center;
            margin: 0 auto;
        }
        .hr-heading-body {
            width: 700px;
        }
        .hr-body-footer {
            border: 1px solid darkcyan;
        }
        .box-info .head {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="register">
        <div class="heding">
            <h2><b><p>{{ $title }}</p> {{ $email }} ( {{ $senderName }} )</b></h2>
        </div>

        <hr class="hr-heading-body">
        <div class="body">
            <p>{{ trans('messages.email.from') }} {{ $email }} ( {{ $senderName }} )

        </div>
        <div class="hr-heading-body">
            <a href="{{ $link }}">{{ $link }}</a>
        </div>
        <hr class="hr-body-footer">
    </div>
</div>
</body>
</html>
