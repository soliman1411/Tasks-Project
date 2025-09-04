@extends('layouts.admin')

@section('content')
<div class="container mt-5">

    <h2 class="mb-4 text-primary">{{ __('messages.AllUsers') }}</h2>

 <a href="{{ route('usersManegment.trashed') }}" class="btn btn-success btn-lg">
                        {{ __('messages.recycleBin') }}
</a>
    {{-- البحث وزر إنشاء مستخدم جديدة --}}
   <form action="{{ route('usersManegment.index') }}" method="get">
    @csrf
     <div class="row mb-4">
        <div class="col-md-8 d-flex">
            <input type="text" name="search" id="search" value="{{ request()->search }}"
                   class="form-control form-control-lg me-2" placeholder="🔍 Search Users With Name">
            <button type="submit" class="btn btn-primary btn-lg">{{ __('messages.search') }}</button>
        </div>
   </form>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="{{ route('usersManegment.create') }}" class="btn btn-success btn-lg">
                + {{ __('messages.CreateNewUser') }}
            </a>
        </div>
    </div>

    {{-- جدول المستخدمين --}}
    <div class="table">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.email') }}</th>
                    <th>{{ __('messages.tasks') }}</th>
                    <th>{{ __('messages.actions') }}</th>
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
                                 {{ __('messages.ShowTasks') }}
                            </a>
                        </td>
                        <td class="d-flex justify-content-center gap-2">
                            <a href="{{ route('usersManegment.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                {{ __('messages.edit') }}
                            </a>
                            <form action="{{ route('usersManegment.destroy', $user->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    {{ __('messages.delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">{{ __('messages.NoUsersFound') }}.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $users->withQueryString()->links() }}
@endsection
