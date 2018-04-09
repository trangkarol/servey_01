<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Pankaj Taneja">
    <title>{{ trans('view.404') }}</title>
    {!! Html::style(asset(config('settings.plugins') . 'bootstrap/bootstrap.min.css')) !!}
    {!! Html::style(elixir('/user/errors/404.css')) !!}
</head>
<body class="blue-bg">
    <div class="col-md-12 content-error">
        <div class="meow">
            <div class="cat">
                <div class="cat-inner"></div>
                <div class="cat-head">
                    <div class="cat-ear"></div>
                    <div class="cat-ear2"></div>
                    <div class="cat-nose"></div>
                    <div class="cat-mouth"><div class="cat-meow"></div></div>
                    <div class="cateye">
                        <div class="cateye inner"></div>
                        <div class="cateye inner inner-2"></div>
                        <div class="cateyelid top"></div>
                        <div class="cateyelid bottom"></div>
                    </div>
                    <div class="cateye2">
                        <div class="cateye inner"></div>
                        <div class="cateye inner inner-2"></div>
                        <div class="cateyelid top"></div>
                        <div class="cateyelid bottom"></div>
                    </div>
                </div>
                <div class="cat-leg"></div>
                <div class="cat-foot"></div>
                <div class="cat-leg-front"></div>
                <div class="cat-foot-front"></div>
                <div class="cat-hind-leg"></div>
                <div class="cat-hind-leg-top"></div>
                <div class="cat-hind-foot"></div>
                <div class="cat-hind-paw"></div>
                <div class="cat-hind-leg2"></div>
                <div class="cat-hind-leg-top2"></div>
                <div class="cat-hind-foot2"></div>
                <div class="cat-hind-paw2"></div>
                <div class="cat-tail"></div>
                <div class="cat-tail-end"></div>
            </div>
            <h1>@lang('lang.404')</h1>
        </div>
        </div>
        <div class="col-md-12">
        <div class="message">
            <h2>@lang('lang.error')</h2>
            <p>@lang('lang.404_message')</p><br>
            <div class="btndiv">
                <div class="btn">
                    <a href="{{ route('home') }}">
                        @lang('lang.go_home')
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
