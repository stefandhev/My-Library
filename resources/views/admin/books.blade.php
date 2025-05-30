@extends('layouts.admin')
@section('title', 'Manage Books')
@section('content')
<div class="max-w-7xl mx-auto mt-10">
    <div class="bg-white rounded shadow p-8">
        <h1 class="text-2xl font-bold mb-4">Manage Books</h1>
        <div class="mb-6">
            <a href="{{ route('admin.books.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Add New Book</a>
        </div>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Title</th>
                    <th class="py-2 px-4 border-b">Author</th>
                    <th class="py-2 px-4 border-b">ISBN</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Image</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $book)
                <tr>
                    <td class="py-2 text-center px-4 border-b">{{ $book->title }}</td>
                    <td class="py-2 text-center px-4 border-b">{{ $book->author }}</td>
                    <td class="py-2 text-center px-4 border-b">{{ $book->isbn }}</td>
                    <td class="py-2 text-center px-4 border-b">
                    @if($book->borrowed_status)
                        <span class="text-red-600 font-semibold">Borrowed</span>
                    @else
                        <span class="text-green-600 font-semibold">Available</span>
                    @endif
                    </td>
                    <td class="py-2 flex justify-self-center px-4 border-b">
                        <img src="{{ $book->image_url }}" alt="Book Cover" class="h-16 w-16 object-cover rounded">
                    </td>
                    <td class="py-2 text-center px-4 border-b">
                        <a href="{{ route('admin.books.edit', $book->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        |
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection