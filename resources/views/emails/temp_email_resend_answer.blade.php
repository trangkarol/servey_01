<table align="center" border="0" cellpadding="0" cellspacing="0" class="content">
    <tbody>
        <tr class="tr-1">
            <td>
                {{ Html::image(config('app.url') . config('settings.image_path_system') . 'answer.png', '', [
                    'class' => 'img-invite',
                ]) }}
                <br/>
                {{ trans('temp.title_web') }}
            </td>
        </tr>
        <tr class="tr-2">
            <td>
                <b>
                    {{ Lang::choice('temp.reanswer', 0, [], $lang) }}
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
                {{ trans('temp.from') . ':' . $emailSender . '(' . $name  . ')' }}
            </td>
        </tr>
        <tr class="tr-5">
            <td>
                <b>
                    {{ Lang::choice('temp.info_survey', 0, [], $lang) }}
                </b>
            </td>
        </tr>
        <tr class="tr-6">
            <td>
                <p>{{ trans('temp.title') . ':' . $title }}</p>
                <p>{{ trans('temp.description') . ':' . $description }}</p>
                <div class="hr-heading-body">
                    <p>
                        {{ Lang::choice('temp.click_participant', 0, [], $lang) }}
                    </p>
                    <a href="{{ $link }}">{{ $link }}</a>
                </div>
            </td>
        </tr>
        <tr class="tr-7"><td></td></tr>
    </tbody>
</table>
