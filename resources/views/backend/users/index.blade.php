@extends('layouts.backend')

@section('page-title')
    Users
@stop

@section('breadcrumb-title')
    Users <a href="{{ URL::route('admin.users.create') }}" class="btn btn-sm btn-primary">Create a new User</a>
@stop

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Member Since</th>
                <th>Actions</th>
            </tr>
        </thead>
    @forelse($users as $user)
        <tr>
            <td><img src="{{ $user->avatar }}?s=20" class="img-circle" alt="User Image"> {{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->created_at->diffForHumans() }}</td>
            <td><a href="{{ URL::route('admin.users.show', $user->id) }}" class="btn btn-info" target="_blank"><i class="fa fa-eye"></i> View</a>
            <a href="{{ URL::route('admin.users.edit', $user->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
            <a href="{{ URL::route('admin.users.destroy', $user->id) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>
        </tr>
    @empty
        <tr>
            <td colspan="6">No User were found.</td>
        </tr>
    @endforelse
    </table>
@stop
