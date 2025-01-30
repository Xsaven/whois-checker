<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col">
        @include('layouts.parts.app.header')

        <main class="flex-grow container mx-auto p-6  flex justify-center items-center">
            {{ $slot }}
        </main>

        @include('layouts.parts.app.footer')
    </div>
</body>
</html>
