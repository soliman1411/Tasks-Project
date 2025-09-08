@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary">{{ __('messages.AllUsers') }}</h2>



    {{-- البحث وزر إنشاء مهمة جديدة --}}
   <form action="{{ route('users.index') }}" method="get">
    @csrf
     <div class="row mb-4">
        <div class="col-md-8 d-flex">
            <input type="text" name="search" id="search" value="{{ request()->search }}"
                   class="form-control form-control-lg me-2" placeholder="🔍 {{ __('messages.searchUsersWithName') }}">
            <button type="submit" class="btn btn-primary btn-lg">{{ __('messages.search') }}</button>
        </div>
   </form>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="{{ route('tasks.create') }}" class="btn btn-success btn-lg">
                +{{ __('messages.CreateNewUser') }}
            </a>
        </div>

    </div>

    {{-- جدول المهام --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.name') }}</th>
                    <th>{{ __('messages.email') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td class="d-flex justify-content-center gap-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                {{ __('messages.edit') }}
                            </a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
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
                        <td colspan="4">{{ __('messages.noUsersFound') }}.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
