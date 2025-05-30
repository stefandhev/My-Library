@extends('layouts.admin')
@section('title', 'Manage Genres')
@section('content')
<div class="max-w-7xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Genres List</h1>
    @if(session('success'))
        <div class="mb-4 p-3 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full text-center bg-white p-4 rounded shadow">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b">Name</th>
                <th class="px-4 py-2 border-b">Books Count</th>
                <th class="px-4 py-2 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($genres as $genre)
            <tr>
                <td class="border-b px-4 py-2">{{ $genre->name }}</td>
                <td class="border-b px-4 py-2">{{ $genre->book_count }}</td>
                <td class="border-b px-4 py-2">
                    <a href="{{ route('admin.genres.edit', $genre->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    |
                    <form action="{{ route('admin.genres.destroy', $genre->id) }}" method="POST" style="display:inline;">
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
@endsection