<nav class=" bg-white shadow mb-6">
    <div class="container mx-auto px-4 py-6 flex justify-between items-center">
        <a href="{{ url('/') }}" class=" text-2xl font-bold text-blue-700">My Library</a>
        <div class="flex items-center space-x-4">

            <form action="{{ route('books.search', ['title' => 'all']) }}" method="GET" class=" flex">
                <input type="text" name="search" placeholder="Search Books..." 
                class=" border w-[22rem] rounded-l px-3 py-2 focus:outline-none" value="{{ request('search') }}">
                
                <button type="submit" class=" bg-blue-500 text-white px-4 rounded-r hover:bg-blue-600">Search</button>
            </form>
            <a href="{{ route('login') }}" class=" text-white bg-blue-500 px-4 py-2 hover:bg-blue-600 font-bold rounded-md">Login</a>
            <a href="{{ route('register') }}" class=" text-white bg-amber-500 px-4 py-2 hover:bg-amber-600 font-bold rounded-md">Register</a>
        </div>
    </div>
</nav>