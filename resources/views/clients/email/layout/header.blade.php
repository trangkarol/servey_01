@php
    $style = [
        'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;',
    ];
    $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;';
@endphp

<tr style="background:#343d49;">
    <td style="text-align:center;">
        <a style="{{ $fontFamily }} {{ $style['email-masthead_name'] }}" href="{{ route('home') }}" target="_blank">
            <h2 style="color:#fff;">{{ config('settings.fsurvey') }}</h2>
        </a>
    </td>
</tr>
