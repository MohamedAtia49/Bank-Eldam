<x-mail::message>
# Blood Bank

Hello : Mr. {{ $user->name }}

<x-mail::button :url="'http://ipda3.com/'">
Reset Password
</x-mail::button>


Thanks,<br>
Mr . {{ $user->name }}
</x-mail::message>
