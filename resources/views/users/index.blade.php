@extends('layouts.app')

@section('page_title')
    Users
@endsection

@section('content')
    @if (session('not_deleted')){
        <div class="alert alert-danger text-center p-2">
            <h1 class="text-success text-light">{{ session('not_deleted') }}</h1>
        </div>
    }
    @endif

    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Permissions</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $record->name }}</td>
                <td>{{ $record->email }}</td>
                <td>
                    @if ($record->id == 1)
                        <span class="badge text-sm bg-yellow text-dark">Big Bors</span>
                    @endif
                    @foreach($record->roles as $role)
                        <span class="badge text-sm bg-primary text-dark">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td>
                    @foreach($record->roles as $role)
                        @foreach ($role->permissions as $permission)
                            <span class="badge text-sm bg-gradient-maroon text-dark">{{ $permission->name }}</span>
                        @endforeach
                    @endforeach

                </td>
                <td><a href="{{ route('users.edit', $record->id) }}" class="btn btn-success">Edit</a></td>
                <td><form action="{{ route('users.destroy', $record->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="w-50 mx-auto">{{ $records->links() }}</div>
@endsection
