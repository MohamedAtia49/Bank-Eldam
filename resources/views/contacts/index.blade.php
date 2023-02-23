@extends('layouts.app')

@section('page_title')
    Contacts
@endsection

@section('content')


    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <form action="" class="d-flex" role="search" method="get">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control me-2" type="search" value="{{ request('search') }}" placeholder="Search" aria-label="Search">
                    <button type="submit" class="btn btn-outline-success btn-sm">Search</button>
                </div>
            </form>
        </div>
    </nav>


    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $record->name }}</td>
                <td>{{ $record->email }}</td>
                <td>{{ $record->phone }}</td>
                <td>{{ $record->subject }}</td>
                <td>{{ $record->message }}</td>
                <td><form action="{{ route('contacts.destroy', $record->id) }}" method="post">
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
