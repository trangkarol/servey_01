<!DOCTYPE html>
<html>
<head>
    <title>{{ trans('messages.email.invite') }}</title>
    <style>
        .content {
            background: #1ab9a7;
            padding: 50px;
            font-size: 19px;
            font-family: arial;
        }
        .register {
            display: block;
            margin: 50px auto;
            background: white;
            max-width: 500px;
            padding: 15px;
            box-shadow: 5px 5px 2px rgba(54, 69, 70, 0.66);
        }
        .register .heding {
            text-align: center;
            font-size: 35px;
            font-family: VnBodoni;
            color: #697b79;
            margin-top: 4%;
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
        .hr-body-footer {
            border: 1px solid darkcyan;
        }
        .box-info .head {
            text-align: center;
        }
        .content-survey {
            padding-left: 3%;
            padding-right: 3%;
            margin-top: -3%;
        }
        a {
            word-wrap: break-word;
            color: #f15e10;
        }
    </style>
</head>
<body>
<div class="content">
    <div class="register">
        <div class="heding">
            {{ trans('temp.name') }}
        </div>
        <div class="body">
            <p>{{ trans('temp.reanswer') }}</p>
            <p>{{ trans('messages.email.from') . $email . '(' . $senderName . ')' }} </p>
        <hr>
        </div>
        <div class="content-survey">
            <p>{{ trans('temp.title') . $survey->title }}</p>
            <p>{{ trans('temp.description') . $survey->description }}</p>
            <div class="hr-heading-body">
                <p>{{ trans('temp.link') }}</p>
                <a href="{{ $link }}">{{ $link }}</a>
            </div>
        </div>
        <hr class="hr-body-footer">
    </div>
</div>
</body>
</html>
