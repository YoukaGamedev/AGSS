@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<style>
    /* User Avatar */
    .user-avatar {
        height: 2.5rem;
        width: 2.5rem;
        border-radius: 50%;
        background-color: #e0e7ff;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .user-avatar-text {
        color: #4f46e5;
        font-weight: 500;
        font-size: 1.125rem;
    }
    
    .user-name {
        font-size: 0.875rem;
        font-weight: 500;
        color: #111827;
    }
    
    .badge-you {
        font-size: 0.75rem;
        background-color: #d1fae5;
        color: #047857;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        margin-left: 0.5rem;
    }
    
    /* Role Badges */
    .role-badge {
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        font-weight: 600;
        border-radius: 9999px;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .role-badge.admin {
        background-color: #f3e8ff;
        color: #7c3aed;
    }
    
    .role-badge.user {
        background-color: #f3f4f6;
        color: #1f2937;
    }
    
    /* Table Styles */
    .table-custom {
        margin-bottom: 0;
    }
    
    .table-custom thead {
        background-color: #f9fafb;
    }
    
    .table-custom th {
        padding: 0.75rem 1.5rem;
        text-align: left;
        font-size: 0.75rem;
        font-weight: 500;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .table-custom td {
        padding: 1rem 1.5rem;
        white-space: nowrap;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .table-custom tbody tr:hover {
        background-color: #f9fafb;
    }
    
    .table-text-sm {
        font-size: 0.875rem;
        color: #111827;
    }
    
    .table-text-muted {
        font-size: 0.875rem;
        color: #6b7280;
    }
    
    /* Action Buttons */
    .btn-action {
        color: #4f46e5;
        text-decoration: none;
        font-size: 1rem;
    }
    
    .btn-action:hover {
        color: #4338ca;
    }
    
    .btn-action.text-danger {
        color: #dc2626;
    }
    
    .btn-action.text-danger:hover {
        color: #b91c1c;
    }
    
    .btn-add-user {
        background-color: #4f46e5;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: background-color 0.15s ease-in-out;
    }
    
    .btn-add-user:hover {
        background-color: #4338ca;
        color: white;
    }
</style>

<div class="container py-4">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="display-6 fw-bold text-dark">User Management</h1>
            <p class="text-muted mt-2">Manage all users and their permissions</p>
        </div>
        <a href="{{ route('users.create') }}" class="btn-add-user">
            <i class="bi bi-person-plus"></i> Add New User
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Games</th>
                            <th>Joined</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="user-avatar">
                                            <span class="user-avatar-text">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <div class="user-name">
                                            {{ $user->name }}
                                            @if($user->id === auth()->id())
                                            <span class="badge-you">You</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="table-text-sm">{{ $user->email }}</div>
                            </td>
                            <td>
                                @if($user->role === 'admin')
                                <span class="role-badge admin">
                                    <i class="bi bi-shield-fill-check"></i> Admin
                                </span>
                                @else
                                <span class="role-badge user">
                                    <i class="bi bi-person"></i> User
                                </span>
                                @endif
                            </td>
                            <td class="table-text-muted">
                                <i class="bi bi-controller me-1"></i> {{ $user->games->count() }} games
                            </td>
                            <td class="table-text-muted">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('users.edit', $user) }}" 
                                    class="btn btn-warning text-white py-3">
                                        <i class="fas fa-edit me-2"></i> Edit
                                    </a>
                                    @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" id="deleteForm">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" class="btn btn-danger w-100 py-3" onclick="openDeleteModal()">
                                            <i class="bi bi-trash me-2"></i> Delete
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                No users found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection