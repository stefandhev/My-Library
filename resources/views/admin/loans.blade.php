@extends('layouts.admin')
@section('title', 'Manage Loans')
@section('content')
<div class="max-w-7xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Loans List</h1>
    @if(session('success'))
        <div class="mb-4 p-3 text-green-600">
            {{ session('success') }}
        </div>
    @endif
    <table class="min-w-full bg-white rounded shadow">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b">ID</th>
                <th class="px-4 py-2 border-b">User</th>
                <th class="px-4 py-2 border-b">Book</th>
                <th class="px-4 py-2 border-b">Borrowed At</th>
                <th class="px-4 py-2 border-b">Due At</th>
                <th class="px-4 py-2 border-b">Returned At</th>
                <th class="px-4 py-2 border-b">Status</th>
                <th class="px-4 py-2 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($loans as $loan)
                <tr>
                    <td class="border-b px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border-b px-4 py-2">{{ $loan->user->name }}</td>
                    <td class="border-b px-4 py-2">{{ $loan->book->title }}</td>
                    <td class="border-b px-4 py-2">{{ $loan->borrowed_at }}</td>
                    <td class="border-b px-4 py-2">{{ $loan->due_date }}</td>
                    <td class="border-b px-4 py-2">
                        @if($loan->returned_at)
                            {{ $loan->returned_at }}
                        @else
                            <span class="text-gray-500">Not Returned</span>
                        @endif
                    </td>
                    <td class="border-b px-4 py-2">
                        <span class="px-2 py-1 rounded
                            @if($loan->status == 'borrowed') bg-yellow-200 text-yellow-800
                            @elseif($loan->status == 'late') bg-red-200 text-red-800
                            @else bg-green-200 text-green-800
                            @endif">
                            {{ ucfirst($loan->status) }}
                        </span>
                    </td>
                    <td class="border-b px-4 py-2">
                        <a href="{{ route('admin.loans.show', $loan->id) }}" class="text-blue-600 hover:underline">Detail</a>
                        |
                        <a href="{{ route('admin.loans.edit', $loan->id) }}" class="text-green-600 hover:underline">Edit</a>
                        |
                        <form action="{{ route('admin.loans.destroy', $loan->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center px-4 py-2">No loans available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection