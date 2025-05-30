@extends('layouts.admin')
@section('title', 'Add Admin')
@section('content')
<div>
    <form action="{{ route('admin.store.admin') }}" method="post" class="max-w-md mx-auto bg-white p-8 rounded shadow">
        @csrf
        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required class="w-full px-3 py-2 border rounded mb-4" />
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required class="w-full px-3 py-2 border rounded mb-4" />
        <input type="password" name="password" placeholder="Password" required class="w-full px-3 py-2 border rounded mb-4" />
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="w-full px-3 py-2 border rounded mb-4" />
        <button type="submit" class=" bg-blue-800 hover:bg-blue-900 text-white py-2 px-4 rounded">Add Admin</button>
    </form>
</div>
@endsection