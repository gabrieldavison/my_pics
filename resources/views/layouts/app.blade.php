<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="text-right">
    @guest
    <a href="/login">login</a>
    @endguest
    @auth
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <a href="route('logout')"
                onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
    </a>
    </form>
    @endauth
    </div>
    {{ $slot }}
</body>
</html>

