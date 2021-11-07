<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>What TO-DO</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .body-bg {
            background-color: #9921e8;
            background-image: linear-gradient(315deg, #9921e8 0%, #5f72be 74%);
        }
    </style>
</head>
<body class="antialiased">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <div class="mb-6 pt-3 rounded bg-green-600">
            @auth
                    <a href="{{ route('tasks.index') }}" class="text-lg text-gray-700 dark:text-gray-500">Go to app</a>
            @else
                    <a href="{{ route('login') }}" class="text-lg text-white dark:text-gray-500">Log in</a>

                @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-lg text-white dark:text-gray-500">Register</a>
                @endif
            @endauth
        </div>
        </div>
    @endif
        <img src="https://wallpaperaccess.com/full/1489353.jpg" width="100%" height="100%" alt="Error loading picture">
</body>
</html>
