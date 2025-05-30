@extends('layouts.admin')
@section('title', 'Admin Dashboard')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <div class="bg-white rounded shadow p-8">
            <h1 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}</h1>
            <p class="mb-6 text-gray-700">You are logged in as <span class="font-semibold">{{ Auth::user()->role }}</span>.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('admin.users') }}" class="block bg-blue-600 text-white p-6 rounded shadow hover:scale-[1.04] hover:shadow-md hover:bg-blue-700 transition">
                    <div class="text-xl font-semibold mb-2">Manage Users</div>
                    <div>View, add, edit, or delete users.</div>
                </a>
                <a href="{{ route('admin.books') }}" class="block bg-green-600 text-white p-6 rounded shadow hover:scale-[1.04] hover:shadow-md hover:bg-green-700 transition">
                    <div class="text-xl font-semibold mb-2">Manage Books</div>
                    <div>View, add, edit, or delete books.</div>
                </a>
                <a href="{{ route('admin.genres') }}" class="block bg-slate-600 text-white p-6 rounded shadow hover:scale-[1.04] hover:shadow-md hover:bg-slate-700 transition">
                    <div class="text-xl font-semibold mb-2">Manage Genre</div>
                    <div>View, add, edit, or delete genres.</div>
                </a>
                <a href="{{ route('admin.loans') }}" class="block bg-amber-600 text-white p-6 rounded shadow hover:scale-[1.04] hover:shadow-md hover:bg-amber-700 transition">
                    <div class="text-xl font-semibold mb-2">Manage Loans</div>
                    <div>View, add, edit, or delete loans.</div>
                </a>
            </div>
        </div>
    </div>
@endsection