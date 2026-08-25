<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <style>
        html {
            visibility: hidden;
        }

        html.css-ready {
            visibility: visible;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <link rel="stylesheet"
          href="{{ asset('css/notification.css') }}">

</head>

<body>

    @yield('content')

    <script>
        document.documentElement.classList.add('css-ready');
    </script>

</body>
</html>