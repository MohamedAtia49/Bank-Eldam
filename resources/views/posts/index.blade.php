@extends('layouts.app')

@section('page_title')
    Posts
@endsection

@section('content')
    <table class="table table-striped table-hover table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Image</th>
                <th>Content</th>
                <th>Category</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $record->title }}</td>
                <td><img src="{{ Storage::url($record->image) }}" width="50" height="50"></td>
                <td>{{ $record->content }}</td>
                <td>{{ $record->category->name }}</td>
                <td><a href="{{ route('posts.edit', $record->id) }}" class="btn btn-success">Edit</a></td>
                <td><form action="{{ route('posts.destroy', $record->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
