<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function createNewAdmin() {
        return view('admin.addAdmin');
    }


    public function storeNewAdmin(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20'
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $validated['role'] = 'admin';

        User::create($validated);

        return redirect()->route('admin.users');
    }


    public function index() {
        return view('admin.dashboard');
    }


    public function books() {
        $books = Book::all();
        $genres = Genre::all();

        return view('admin.books', compact('books', 'genres'));
    }


    public function genres() {
        $genres = Genre::all();

        return view('admin.genres', compact('genres'));
    }


    public function users() {
        $users = User::all();

        return view('admin.users', compact('users'));
    }


    public function userDestroy($id) {
        $users = User::findOrFail($id);

        $users->delete();

        return redirect()->route('admin.users');
    }
}
