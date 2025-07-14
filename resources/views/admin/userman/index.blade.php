@extends('layout.Admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold text-primary mb-6">User Management</h1>

    <!-- Filter Section -->
    <div class="mb-4 flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <label for="roleFilter" class="text-lg text-secondary">Filter berdasarkan Role:</label>
            <form action="{{ route('admin.user-management.index') }}" method="GET" class="flex items-center space-x-2">
                <select id="roleFilter" name="role" class="bg-quinary text-primary border border-quaternary rounded-md py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" onchange="this.form.submit()">
                    <option value="">All Roles</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="owner" {{ request('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                </select>
            </form>
        </div>
        {{-- <button class="bg-primary text-white px-4 py-2 rounded-md hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-primary">Add User</button> --}}
    </div>

    <!-- User Table -->
    <div class="overflow-x-auto bg-quinary rounded-lg shadow-md">
        <table class="w-full table-auto">
            <thead class="bg-primary text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Role</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @foreach($users as $user)
                <tr class="hover:bg-quaternary transition-all">
                    <td class="px-6 py-4">{{ $user->name }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-block bg-secondary text-primary px-3 py-1 rounded-md">{{ ucfirst($user->role) }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-block {{ $user->status_verification == 'verified' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }} px-3 py-1 rounded-md">{{ ucfirst($user->status_verification) }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.user-management.edit', $user->user_id) }}" class="text-primary hover:text-secondary">Edit</a> | 
                        <a href="{{ route('admin.user-management.show', $user->user_id) }}" class="text-primary hover:text-secondary">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
