<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class=" bg-gray-100 min-h-screen">
    {{-- <div class=" absolute inset-[-1] bg-black">

    </div> --}}

    @guest
        <header>
            @include('components.guest_navbar')
        </header>
        @else
        <header>
            @include('components.user_navbar', ['user' => auth()->user()])
        </header>
    @endguest

    <div class=" mx-auto py-4">
        @yield('content')
    </div>
    <x-footer/>
</body>
</html>