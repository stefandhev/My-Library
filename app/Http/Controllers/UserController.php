<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $books = Book::all();
        $genre = Genre::all();

        return view('users.dashboard', compact('books', 'genre'));
    }

    public function show($id) {
        $user = Auth::findOrFail($id);

        return view('users.showProfile', compact('user'));
    }

    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'profile_image' => 'nullable|image|max:2048',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'role' => 'nullable|in:user,admin,librarian',
            'is_active' => 'nullable|boolean',          
        ]);

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('avatar', 'public');

            $validated['profile_image'] = $imagePath;
        }
        else {
            $validated['profile_image'] = null;
        }

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        return redirect()->route('login')->with('success', 'Register Successfull. Please Login!');
    }

    public function showRegisterForm() {
        return view('auth.register');
    }

    public function login(Request $request) {
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome Admin!');
            }

            $user = Auth::user();

            return redirect()->route('users.index')->with('success', 'Welcome Back!');
        }

        return back()->withErrors([
            'email' => 'The Provided Credentials Do Not Match Our Records',
        ]);
    }

    public function showLoginForm() {
        return view('auth.login');
    }

    public function edit($id) {
        $user = User::findOrFail($id);

        return view('users.editProfile', compact('user'));
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'addres' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'profile_image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('avatar', 'public');

            $validated['profile_image'] = $imagePath;
        }
        else {
            $validated['profile_image'] = $user->profile_image;
        }

        $user->update($validated);

        return redirect()->route('users.show', $user->id)->with('success', 'Profile Update Success!');
    }

    public function changePassword(Request $request, $id) {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8',
        ]);

        if (!Hash::check($validated['current_password'], $user->password)) {
            return redirect()->back()->with('error', 'Current Password is Incorrect!');
        }

        $user->password = bcrypt($validated['new_password']);
        $user->save();

        return redirect()->back()->with('success', 'Password Change Success!');
    }

    
    public function logout() {
        Auth::logout();

        return redirect()->route('dashboard');
    }
    
    public function destroy($id) {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('users.dashboard');
    }
}
