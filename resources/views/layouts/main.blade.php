<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/bootstrap.js'])
</head>
<body>
<main>
    @include('blocks.header')
    <div class="container">
        @yield('content')
    </div>
</main>
@include('blocks.footer')
</body>
</html>
