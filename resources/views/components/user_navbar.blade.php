<nav class=" bg-white p-4 text-gray-900 px-6 shadow flex justify-between items-center">
    <span class=" font-bold text-2xl px-6">
        My library
    </span>

    <div class=" flex space-x-9">
        <a href="" class="hover:underline">Dashboard</a>
        <a href="" class="hover:underline">All Books</a>
        <a href="" class="hover:underline">My Profile</a>
        <a href="" class="hover:underline">My Loan</a>
    </div>

    <form action="{{ route('logout') }}" method="POST" 
    class=" flex items-center space-x-2">
    @csrf
    <a href="{{ route('users.show', $user->id) }}"><img src="{{ $user->profile_image }}" alt="profile image"
        class=" w-10 h-10 rounded-full mr-2"></a>
    <button type="submit" class=" bg-red-500 px-4 py-2 rounded hover:bg-red-600 text-white font-bold">Logout</button>

    </form>
</nav>