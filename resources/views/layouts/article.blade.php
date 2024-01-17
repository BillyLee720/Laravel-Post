<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>PHP Post Web</title>
</head>
<body>
    <main class="m-4">
        @if(session()->has('notice'))
            <div class="bg-pink-300">
                {{session()->get('notice')}}
            </div>
        @endif
        @yield('main')
    </main>

</body>
</html>