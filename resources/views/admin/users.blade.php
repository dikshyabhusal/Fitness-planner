@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto p-4">
    <h1 class="text-2xl font-bold text-purple-700 mb-6">All Users</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4 shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full text-sm text-left text-gray-700">
            <thead class="bg-purple-700 text-white">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Gender</th>
                    <th class="px-4 py-3">Weight</th>
                    <th class="px-4 py-3">Height</th>
                    <th class="px-4 py-3">Age</th>
                    <th class="px-4 py-3 text-center">Role</th>
                    <th class="px-4 py-3">Change Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b hover:bg-purple-50 transition">
                    <td class="px-4 py-3">{{ $user->id }}</td>
                    <td class="px-4 py-3">{{ $user->name }}</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                    <td class="px-4 py-3 capitalize">{{ $user->gender }}</td>
                    <td class="px-4 py-3">{{ $user->weight }}</td>
                    <td class="px-4 py-3">{{ $user->height }}</td>
                    <td class="px-4 py-3">{{ $user->age }}</td>
                    <td class="px-4 py-3 text-center font-semibold text-purple-700">
                        {{ $user->getRoleNames()->first() ?? 'None' }}
                    </td>
                    <td class="px-4 py-3">
                        <form action="{{ route('admin.updateRole', $user->id) }}" method="POST" class="flex items-center space-x-2">
                            @csrf
                            @method('PUT')
                            <select name="role" class="border border-purple-300 rounded px-2 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-purple-500">
                                <option value="student" @if($user->hasRole('student')) selected @endif>Student</option>
                                <option value="trainer" @if($user->hasRole('trainer')) selected @endif>Trainer</option>
                                <option value="admin" @if($user->hasRole('admin')) selected @endif>Admin</option>
                            </select>
                            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-3 py-1 rounded text-xs shadow">
                                Update
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
