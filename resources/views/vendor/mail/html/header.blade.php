<tr>
<td class="header">
<a href="www.oracademy.co.za" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{URL::asset('/storage/assets/images/logo.jpg')}}" class="logo" alt="OR academy Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
