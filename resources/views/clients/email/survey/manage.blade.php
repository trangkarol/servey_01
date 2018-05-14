<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>{{ trans('email.title_web') }}</title>
        <meta name="viewport" content="width=device-width" />
        <style type="text/css">
            .content-body {
                background: #e6e6e6;
                margin: 0;
                padding: 5px 120px;
            }

            table.content {
               margin: 50px auto;
               border-collapse: collapse;
               width: 100%;
               max-width: 700px;
            }

            table.content > tbody tr td {
                padding: 20px 40px 0px 40px;
                color: #555555;
                font-family: Arial, sans-serif;
                font-size: 17px;
                line-height: 30px;
                background: white;
            }

            table.content > tbody tr.tr-1 > td {
                background: #404040;
                text-align: center;
                padding: 20px 40px 20px 40px;
                color: #ffffff;
                font-family: VnBodoni;
                font-size: 36px;
                font-weight: bold;
            }

            table.content > tbody tr.tr-3 > td {
                padding: 0 40px 20px 40px;
                color: #555555;
                font-family: Arial, sans-serif;
                font-size: 15px;
                line-height: 24px;
                border-bottom: 1px solid #f6f6f6;
            }

            table.content > tbody tr.tr-5 > td {
                padding: 10px 40px 0px 40px;
                font-family: Arial, sans-serif;
                font-size: 20px;
            }

            table.content > tbody tr.tr-6 > td {
                background: white;
                padding: 0 40px 20px 40px;
                font-family: Arial, sans-serif;
                line-height: 24px;
                border-bottom: 20px solid #e6e6e6;
            }

            .footer-mail-content {
                border-bottom: none !important;
            }

            table.content > tbody tr.tr-7 > td {
                background: #404040;
                padding: 25px 20px;
                font-family: Arial, sans-serif;
            }

            .img-mail {
                box-shadow: 0 1px 1px 0 rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12), 0 1px 3px 0 rgba(0,0,0,0.2);
                width: 100%;
                height: auto;
            }

            .img-invite {
                width:200px;
                height: 200px;
                display:block;
                margin: auto;
                margin-top: 20px;
            }

            h1.logo {
                font-family: "Russo One", arial, sans-serif;
                margin-top: 0;
                margin-bottom: 0;
                font-weight: bold;
                font-size: 3vw;
                line-height: 1.8;
            }

            h1.logo a {
                text-decoration: none;
                color: #fff;
            }

            h1.logo a .highlight {
                color: #71c4e0;
            }

            .thanks-title {
                color: #53c2e8;
                text-shadow: 3px 3px 3px rgba(17, 17, 17, 0.3);
                text-align: center;
                font-family: "Monsterrat", sans-serif;
                font-weight: 900;
                text-transform: uppercase;
                font-size: 68px;
                margin-bottom: 15px;
            }

            .thanks-title span {
                border-top: 5px solid rgba(131, 210, 214, 0.52);
                border-bottom: 5px solid rgba(131, 210, 214, 0.52);
            }
        </style>
    </head>
    <body>
        <div class="content-body">
            <div>
                <table align="center" border="0" cellpadding="0" cellspacing="0" class="content">
                    <tbody>
                        <tr class="tr-1">
                            <td>
                                <h1 class="logo">
                                    <a href="{{ route('home') }}">{!! config('settings.logo_content') !!}</a>
                                </h1>
                            </td>
                        </tr>
                        @foreach (config('settings.locale') as $lang)
                            <tr class="tr-2">
                                <td>
                                    <h4>{{ Lang::choice('email.dear', 0, [], $lang) . ', ' . $name . '.' }}</h4>
                                    <b>
                                        {{ Lang::choice('email.thank_participation', 0, [], $lang) }}
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td class="tr-3">
                                    <h1 class="thanks-title">
                                        <span>{{ Lang::choice('email.thank_you', 0, [], $lang) }}!</span>
                                    </h1>
                                </td>
                            </tr>
                            <tr>
                                <td class="tr-4">
                                    <p>{{ Lang::choice('email.create_success', 0, [], $lang) }}</p>
                                    <p>{{ Lang::choice('email.below', 0, [], $lang) }}</p>
                                    <p>{{ Lang::choice('email.access_link', 0, [], $lang) }}</p>
                                    <a href="{{ $linkManage }}">{{ $linkManage }}</a>
                                    <hr>
                                </td>
                            </tr>
                            <tr class="tr-5">
                                <td>
                                    <b>{{ Lang::choice('email.your_survey', 0, [], $lang) }}</b>
                                </td>
                            </tr>
                            <tr class="tr-6">
                                <td class="{{ (count(config('settings.locale')) == $loop->iteration) ? 'footer-mail-content' : '' }}">
                                    <p>{{ Lang::choice('email.title', 0, [], $lang) . ': ' . $title }}</p>
                                    <p>{{ Lang::choice('email.description', 0, [], $lang) . ': ' .
                                        ($description ?: Lang::choice('email.no_description', 0, [], $lang)) }}</p>
                                    <div class="hr-heading-body">
                                        <p>{{ Lang::choice('email.tag_send_user', 0, [], $lang) }}</p>
                                        <a href="{{ $link }}">{{ $link }}</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <tr class="tr-7"><td></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
