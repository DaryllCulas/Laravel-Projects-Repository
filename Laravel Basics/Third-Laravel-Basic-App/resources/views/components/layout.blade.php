<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pixel Positions</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-950 text-white">
    <div class="px-10">
        <nav class="flex justify-between items-center py-4 border-b border-white/20">
            <div>
                <a href="/">
                    <img src="{{ \Illuminate\Support\Facades\Vite::asset('resources/images/logo.svg') }}" alt="">
                </a>
            </div>

            <div class="space-x-6 font-bold">
                <a href="#">Jobs</a>
                <a href="#">Careers</a>
                <a href="#">Salaries</a>
                <a href="#">Companies</a>
            </div>

            <div>
                <a href="#">Post a Job</a>
            </div>
        </nav>

        <main class="mt-10 max-w-[990ox] mx-auto">
            {{ $slot }}
        </main>
    </div>
</body>

</html>