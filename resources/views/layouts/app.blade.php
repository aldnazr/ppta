@props(['user' => 'mahasiswa', 'pageTitle' => ''])

<!DOCTYPE html>
<html lang="en" class="bg-gray-50">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $pageTitle }}</title>
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.1/css/all.css">
        <script src="https://cdn.jsdelivr.net/npm/alpinejs/dist/cdn.min.js"></script>
    </head>

    <body class="h-screen overflow-hidden">
        <x-navbar :user="$user">
            @yield('content')
        </x-navbar>
    </body>

</html>
