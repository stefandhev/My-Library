@extends('layouts.admin')
@section('title', 'Manage Users')
@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white rounded shadow p-8">
        <h1 class="text-2xl font-bold mb-4">Manage Users</h1>
        <a href="{{ route('admin.add.admin') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded mb-4">Add new admin</a>
        
        <table class="min-w-full bg-white mt-4">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Email</th>
                    <th class="py-2 px-4 border-b">Role</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $user->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                    <td class="py-2 px-4 border-b">{{ $user->role }}</td>
                    <td class="py-2 px-4 border-b">
                        @if($user->is_active)
                          <span class="text-green-600 font-semibold">Active</span>
                        @else
                            <span class="text-gray-400 font-semibold">Inactive</span>
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b">
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
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