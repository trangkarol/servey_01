<table align="center" border="0" cellpadding="0" cellspacing="0" class="content">
    <tbody>
        <tr class="tr-1">
            <td>
                {{ Html::image(config('app.url') . config('settings.image_path_system') . 'thank.png', '', [
                    'class' => 'img-invite',
                ]) }}
                <br/>
                {{ trans('temp.title_web') }}
            </td>
        </tr>
        <tr class="tr-2">
            <td>
                <h4>{{ trans('temp.dear') . ',' . $name }}</h4>
                <b>
                    {{ Lang::choice('temp.thank_participation', 0, [], $lang) }}
                </b>
            </td>
        </tr>
        <tr>
            <td class="tr-3">
                {{ Html::image(config('app.url') . config('settings.image_path_system') . 'sv.jpg', '', [
                    'class' => 'img-mail',
                ]) }}
            </td>
        </tr>
        <tr>
            <td class="tr-4">
                <p>{{ Lang::choice('temp.create_success', 0, [], $lang) }}</p>
                <p>{{ Lang::choice('temp.below', 0, [], $lang) }}</p>
                <p>{{ Lang::choice('temp.access_link', 0, [], $lang) }}</p>
                <a href="{{ $linkManage }}">{{ $linkManage }}</a>
                <hr>
            </td>
        </tr>
        <tr class="tr-5">
            <td>
                <b>{{ Lang::choice('temp.your_survey', 0, [], $lang) }}</b>
            </td>
        </tr>
        <tr class="tr-6">
            <td>
                <p>{{ trans('temp.title') . ':' . $title }}</p>
                <p>{{ trans('temp.description') . ':' . $description }}</p>
                <div class="hr-heading-body">
                    <p>{{ trans('temp.tag_send_user') }}</p>
                    <a href="{{ $link }}">{{ $link }}</a>
                </div>
            </td>
        </tr>
        <tr class="tr-7"><td></td></tr>
    </tbody>
</table>
