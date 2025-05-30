<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class GenreController extends Controller
{
    public function create()
    {
        // Show the form to create a new genre
        return view('admin.addGenres');
    }

    public function store(Request $request)
    {
        // Validate and store the new genre
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Genre::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.genres')->with('success', 'Genre created successfully.');
    }

    public function edit($id)
    {
        // Logic to retrieve the genre by ID and show the edit form
        return view('admin.genres.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        $genre = Genre::findOrFail($id);

        // Validate and update the genre
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $genre->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.genres')->with('success', 'Genre updated successfully.');
    }

    public function destroy($id)
    {
        $genre = Genre::findOrFail($id);
        // Check if the genre is associated with any books
        if ($genre->books()->count() > 0) {
            return redirect()->route('admin.genres')->with('error', 'Genre cannot be deleted because it is associated with books.');
        }
        // Delete the genre
        $genre->delete();

        return redirect()->route('admin.genres')->with('success', 'Genre deleted successfully.');
    }
}