<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') </title>
    <link rel="shortcut icon" href="{{ asset ('images/icon.png ') }}" type="image/x-icon">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="d-flex flez-nowrap min-vh-100">
    <x-sidebar/>
    <main class="container-fluid p-4 bg-light">
        <div class="bg-white p-3 shadow h-100">
            @yield('content')
        </div>
    </main>
</body>
</html>
