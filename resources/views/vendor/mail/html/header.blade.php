<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
  <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
  <img src="{{ env("MAIL_LOGO") }}" height="40" alt="APP Logo">
  <br>
  {{ $slot }}
@endif
</a>
</td>
</tr>
