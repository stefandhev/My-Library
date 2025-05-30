<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <nav class=" bg-blue-800 p-4 text-white flex justify-between items-center">
        <span class=" font-bold text-lg">Admin Panel</span>
        <div class="flex space-x-9">
            <a href="{{ route('admin.dashboard') }}" class=" hover:underline font-bold">Dashboard</a>
            <a href="{{ route('admin.users') }}" class=" hover:underline font-bold">Users</a>
            <a href="{{ route('admin.books') }}" class=" hover:underline font-bold">Books</a>
            <a href="{{ route('admin.genres') }}" class=" hover:underline font-bold">Genres</a>
            <a href="{{ route('admin.loans') }}" class=" hover:underline font-bold">Loans</a>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit" class=" bg-red-500 px-4 py-2 rounded hover:bg-red-600">Logout</button>
        </form>
    </nav>
    
    <div class="mx-auto py-8">
        @yield('content')
    </div>
</body>
</html>