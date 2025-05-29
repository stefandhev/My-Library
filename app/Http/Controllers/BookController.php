<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
        $genres = \App\Models\Genre::all();

        $books = \App\Models\Book::all();

        return view('users.dashboard', compact('books', 'genres'));
    }


    public function getBookByName(Request $request) {
        $search = $request->input('search');
        $genres = \App\Models\Genre::all();
        $books = \App\Models\Book::where('title', 'like', '%'. $search. '%')->get();

        return view('users.dashboard', compact('books', 'genres'));
    }

}
