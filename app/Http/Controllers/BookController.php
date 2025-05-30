<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;

class BookController extends Controller
{
    public function index() {
        $genres = Genre::all();

        $books = Book::all();

        return view('users.dashboard', compact('books', 'genres'));
    }


    public function getBookByName(Request $request) {
        $search = $request->input('search');
        $genres = \App\Models\Genre::all();
        $books = \App\Models\Book::where('title', 'like', '%'. $search. '%')->get();

        return view('users.dashboard', compact('books', 'genres'));
    }


    public function show($id) {
        $book = Book::with('genre')->findOrFail($id);

        return view('users.showBook', compact('book'));
    }


    public function genreBook($genre_name) {
        $genres = Genre::all();

        $selectedGenre = $genres->where('name',$genre_name)->firstOrFail();

        $books = Book::with('genre')->whereHas('genre', function ($query) use ($selectedGenre) {
            $query->where('id', $selectedGenre->id);
        })->get();

        return view('users.dashboard', compact('books', 'genres', 'selectedGenre'));
    }


    public function create() {
        $genres = Genre::all();

        return view('admin.createBook', compact('genres'));
    }


    public function bookStore(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'publish_date' => 'nullable|date',
            'genre_id' => 'sometimes|required|exists:genres,id',
            'description' => 'nullable|string',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');

            $validated['image_url'] = $imagePath;
        }
        else {
            $validated['image_url'] = null;
        }

        Book::create($validated);
        return redirect()->route('admin.books');
    }


    public function bookEdit($id) {
        $book = Book::findOrFail($id);
        $genres = Genre::all();

        return view('admin.editBook', compact('book', 'genres'));
    }


    public function bookUpdate(Request $request, $id) {
        $book = Book::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'publish_date' => 'nullable|date',
            'genre_id' => 'sometimes|required|exists:genres,id',
            'description' => 'nullable|string',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'sometimes|required|in:tersedia,dipinjam'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');

            $validated['image_url'] = $imagePath;
        }

        $book->update($validated);

        return redirect()->route('admin.books');
    }


    public function bookDelete($id) {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('admin.books');
    }

}
