@component('mail::message')

Dear <strong>{{ $name }} {{ $surname }}</strong> !
Thank you for applying to our institution. We have received your application for <strong>{{ $course_apply }}</strong>

You will shortly hear from us.


@component('mail::button', ['url' => 'www.oracademy.co.za'])
Click the link to visit our website.
@endcomponent
<img src="{{URL::asset('/storage/assets/images/logo.jpg')}}" class="logo" alt="OR academy Logo">
Thanks,<br>
{{ config('app.name') }}
@endcomponent
