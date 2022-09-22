<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    @yield('meta_tags')

    @vite(['resources/css/fonts.css', 'resources/js/app.js',])

    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id="app" class="backgroundGlobal">
          <div class="contentBlur">
               @yield('content')
          </div>
    </div>
</body>
</html>