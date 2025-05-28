<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class=" bg-gray-100 flex items-center justify-center min-h-screen">
    <div class=" p-8 w-full max-w-md bg-white rounded shadow">
        <h2 class=" text-2xl font-bold mb-6 text-center">Register</h2>
        @if ($errors->any())
            <div class=" mb-4 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>                    
                @endforeach
            </ul>
            </div>            
        @endif

        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data" class=" space-y-4">
        @csrf
            <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required class=" w-full px-3 py-2 border rounded" />
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required class=" w-full px-3 py-2 border rounded" />
            <input type="password" name="password" placeholder="Password" required class=" w-full px-3 py-2 border rounded" />
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required class=" w-full px-3 py-2 border rounded" />
            <input type="file" name="profile_image" class=" w-full px-3 py-2 border rounded" />
            <input type="text" name="address" placeholder="address" value="{{ old('address') }}" class=" w-full px-3 py-2 border rounded" />
            <input type="text" name="phone" placeholder="phone" value="{{ old('phone') }}" class=" w-full px-3 py-2 border rounded" />
            <button type="submit" class=" w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Register</button>
        </form>
    </div>
</body>
</html>