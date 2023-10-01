<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
    <link rel="icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="/node_modules/stimulus/dist/stimulus.umd.js"></script>
    <script type="module" src="{{ asset('trix_controller.js') }}"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <script>
        tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#ef3b2d",
                        },
                    },
                },
            };
    </script>
    <x-rich-text-trix-styles />
    <title>Forum o istoriji</title>
</head>

<x-flash-message />

<body class="relative pb-40" style="box-sizing: border-box;">
    <nav class="flex justify-between items-center mb-4">
        <a href="/"><img class="w-24" src="{{ asset('images/logo.png') }}" alt="" class="logo" /></a>
        <ul class="flex space-x-6 mr-6 text-lg">
            @auth
            <li>
                <span class="font-bold uppercase">
                    {{ auth()->user()->name }}, preciznost:
                    @if (auth()->user()->attempts > 0)
                    {{ number_format((auth()->user()->completions / auth()->user()->attempts) * 100, 2) }}%
                    ({{ auth()->user()->completions }} / {{ auth()->user()->attempts }})
                    @else
                    N/A
                    @endif
                </span>

            </li>
            @if (auth()->user()->role == "teacher" | auth()->user()->role == "admin")
            <li>
                <a href="/courses/create" class=" top-1/3 left-10 bg-black text-white py-2 px-5">Kreiraj Kurs</a>
            </li>
            @endif
            <li>

                @if (auth()->user()->role == "teacher" | auth()->user()->role == "admin")

                <button id="optionsButton" type="button" class="hover:text-laravel text-lg relative">
                    <i class="fa-solid fa-gear"></i> Options
                </button>
                <div id="optionsMenu"
                    class="hidden absolute right-50 w-70 py-2 bg-white border border-gray-300 rounded-lg shadow-lg">

                    <a href="/courses/manage" class="hover:text-laravel">
                        Upravljanje Kursevima</a>
                        @if (auth()->user()->role == "admin")
                        <a href="/courses/manage" class="hover:text-laravel">
                            Upravljanje Zahtevima</a>
                        @endif
                </div>
                @endif
            </li>
            <li>
                <form class="inline" method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="hover:text-laravel">
                        <i class="fa-solid fa-door-closed"></i> Logout
                    </button>
                </form>
            </li>
            @else
            <li>
                <a href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a>
            </li>
            <li>
                <a href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Login</a>
            </li>
            @endauth
        </ul>

    </nav>
    <main>
        {{ $slot }}
    </main>
    <footer
        class="absolute bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center">
        <p class="ml-2">Copyright &copy; 2023, All Rights reserved</p>
    </footer>
</body>

</html>