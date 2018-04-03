@php
    $style = [
        'email-footer' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;background: #343d49',
        'email-footer_cell' => 'color: #AEAEAE; padding: 35px; text-align: center;',
        'anchor' => 'color: #3869D4;',
    ];
    $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;';
@endphp

<tr style="background-color:#343d49;">
    <td>
        <table style="{{ $style['email-footer'] }}" align="center" width="570" cellpadding="0" cellspacing="0">
            <tr>
                <td style="{{ $fontFamily }} {{ $style['email-footer_cell'] }}">
                    <p style="color: #fff;">
                        &copy; {{ date('Y') }}
                        <a style="{{ $style['anchor'] }}" href="{{ url('/') }}" target="_blank">{{ config('settings.fsurvey') }}</a>.
                        All rights reserved.
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>
