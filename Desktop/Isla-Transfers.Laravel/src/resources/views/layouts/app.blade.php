<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-blue-500 text-white p-4">
        <div class="container mx-auto">
            @yield('header')
        </div>
    </header>

    <main class="container mx-auto p-4">
        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white p-4 text-center">
        <p>&copy; {{ date('Y') }} My App</p>
    </footer>
</body>
</html>