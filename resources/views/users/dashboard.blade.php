@extends('layouts.user')
@section('content')

@guest
    <div class="bg-white rounded-lg shadow mx-auto max-w-7xl p-8 text-black text-center">
        <h1 class=" text-3xl font-bold mb-2">Welcome!</h1>
        <p class=" text-lg">Happy Reading and Managing Your Library at <span class=" font-semibold">My Library</span></p>
        <p class=" text-sm mt-4">Please <a href="{{ route('login') }}" class=" text-blue-600 hover:underline">Login</a> 
            or <a href="{{ route('register') }}" class=" text-amber-600 hover:underline">Register</a> 
            to Access Your library</p>
    </div>

@else
    <div class=" bg-white rounded-lg shadow mx-auto max-w-7xl p-8 text-black text-center">
        <h1 class=" text-3xl font-bold mb-2">Welcome, {{ auth()->user()->name }}!</h1>
        <p class=" text-lg">Happy Reading and Managing Your Library at My Library</p>
    </div>
@endguest

<div class="max-w-7xl mx-auto mt-10">
    <h1 class=" text-2xl font-bold mb-6">{{ isset($selectedGenre) ? 'books in genre: ' . $selectedGenre->name : 'all books' }}</h1>
    <div class="mb-6">
        <span class=" font-semibold mr-2">Filter By Genre: </span>
        @foreach ($genres as $genre)
            <a href="{{ route('books.byGenre', $genre->name) }}"
                class=" inline-block px-3 py-1 rounded bg-gray-200 text-gray-700 hover:bg-blue-500 hover:text-white
                transition mr-2 mb-2">{{ $genre->name }}</a>            
        @endforeach

        <a href="{{ route('dashboard') }}" class=" inline-block px-3 py-1 rounded text-gray-700 hover:bg-blue-500
        hover:text-white transition mb-2">All</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse ($books as $book)
            <a href="{{ route('books.show', $book->id) }}" class=" bg-white rounded shadow p-4 flex flex-col hover:shadow-lg 
            transition ease-in-out duration-200 hover:scale-105">
            @if ($book->image_url)
                <img src="{{ asset($book->image_url) }}" alt="{{ $book->title }}" class=" h-40 object-cover
                mb-3 rounded">

            @else
                <div class="h-40 bg-gray-200 flex items-center justify-center mb-3 rounded text-gray-500">No Image</div>
            @endif

            <div class="flex-1">
                <h2 class=" text-2xl font-semibold mb-2">{{ $book->title }}</h2>
                <p class=" text-sm text-gray-600 mb-1">By {{ $book->author }}</p>
                <p class=" text-sm text-gray-500 mb-1">Genre:  {{ $book->genre->name }}</p>
                <p class="text-sm text-gray-500 mb-1">Status: <span class=" font-semibold">{{ $book->status }}</span></p>
                <p class="text-xs text-gray-400 mb-2">Publish: {{ $book->published_date ? \Carbon\Carbon::parse($book->published_date)->format('d M Y'): '-' }}</p>
                <p class="text-sm">{{ Str::limit($book->description, 100) }}</p>
            </div>
            </a>            
        @empty
            <div class="col-span-3 text-center text-gray-500">No Books Found!</div>    

        @endforelse
    </div>
</div>

@endsection