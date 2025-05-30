@extends('layouts.admin')
@section('title', 'Edit Book')
@section('content')
<div class="max-w-xl mx-auto mt-10">
    <div class="bg-white rounded shadow p-8">
        <h1 class="text-2xl font-bold mb-6">Edit Book</h1>
        @if ($errors->any())
            <div class="mb-4 text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block mb-1 font-semibold">Title</label>
                <input type="text" name="title" class="w-full border rounded px-3 py-2" required value="{{ old('title', $book->title) }}">
            </div>
            <div>
                <label class="block mb-1 font-semibold">Author</label>
                <input type="text" name="author" class="w-full border rounded px-3 py-2" required value="{{ old('author', $book->author) }}">
            </div>
            <div>
                <label class="block mb-1 font-semibold">ISBN</label>
                <input type="text" name="isbn" class="w-full border rounded px-3 py-2" value="{{ old('isbn', $book->isbn) }}">
            </div>
            <div>
                <label class="block mb-1 font-semibold">Published Date</label>
                <input type="date" name="published_date" class="w-full border rounded px-3 py-2" value="{{ old('published_date', $book->published_date ? $book->published_date->format('Y-m-d') : '') }}">
            </div>
            <div>
                <label class="block mb-1 font-semibold">Genre</label>
                <select name="genre_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Select Genre --</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ (old('genre_id', $book->genre_id ?? $book->genre) == $genre->id) ? 'selected' : '' }}>
                            {{ $genre->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block mb-1 font-semibold">Description</label>
                <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $book->description) }}</textarea>
            </div>
            <div>
                <label class="block mb-1 font-semibold">Book Cover (Image)</label>
                <input type="file" name="image" class="w-full border rounded px-3 py-2">
                @if($book->image_url)
                    <div class="mt-2">
                        <img src="{{ $book->image_url }}" alt="Book Cover" class="h-24">
                    </div>
                @endif
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Update Book</button>
        </form>
    </div>
</div>
@endsection