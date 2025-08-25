@extends('layouts.admin')

@section('content')
<div class="container mt-5">

    <h2 class="mb-4 text-primary">All Users</h2>

 <a href="{{ route('usersManegment.trashed') }}" class="btn btn-success btn-lg">
                                سلة المحذوفات
                            </a>
    {{-- البحث وزر إنشاء مستخدم جديدة --}}
   <form action="{{ route('usersManegment.index') }}" method="get">
    @csrf
     <div class="row mb-4">
        <div class="col-md-8 d-flex">
            <input type="text" name="search" id="search" value="{{ request()->search }}"
                   class="form-control form-control-lg me-2" placeholder="🔍 Search Users With Name">
            <button type="submit" class="btn btn-primary btn-lg">Search</button>
        </div>
   </form>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="{{ route('usersManegment.create') }}" class="btn btn-success btn-lg">
                + Create New User
            </a>
        </div>
    </div>

    {{-- جدول المستخدمين --}}
    <div class="table">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Tasks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                             <a href="{{ route('admin.showTasks',$user->id) }}" class="btn btn-sm btn-primary">
                                Show Tasks
                            </a>
                        </td>
                        <td class="d-flex justify-content-center gap-2">
                            <a href="{{ route('usersManegment.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                Edit
                            </a>
                            <form action="{{ route('usersManegment.destroy', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No Users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $users->withQueryString()->links() }}
@endsection
