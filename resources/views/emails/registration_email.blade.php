@component('mail::message')

Congratulations <strong>{{ $name }} {{ $surname }}</strong> ! You are now enrolled with ORACADEMY.
Your login details details are as follow: username: <strong>{{ $email }} </strong> password: <strong>{{ $username }}</strong>
Please reset your password as soon as possible.


@component('mail::button', ['url' => 'www.oracademy.co.za/login'])
Click the link to log in
@endcomponent
<img src="{{URL::asset('/storage/assets/images/logo.jpg')}}" class="logo" alt="OR academy Logo">
Thanks,<br>
{{ config('app.name') }}
@endcomponent
