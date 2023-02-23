@extends('layouts.app')

@section('page_title')
    Posts
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Edit Post</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div> <!-- card-header -->

                <div class="card-body text-center">
                    <form action="{{ route('posts.update',$record->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <label class="text-center">Category</label>
                        <select name="category_id" class="form-control form-select-lg mb-3">
                            <option>Category</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <label class="text-center">Post Title</label>
                        <input type="text" name="title" value="{{ $record->title }}" class="form-control form-control-lg mb-3" placeholder="Post Title">

                        <label class="text-center">Post Image</label>
                        <input type="file" name="image" value="{{ $record->image }}" class="form-control form-control-file form-control-lg mb-3">

                        <label class="text-center">Post Content</label>
                        <textarea name="content" value="{{ $record->content }}" rows="4" class="form-control form-control-lg mb-3" placeholder="Post Content"></textarea>

                        <button type="submit" class="btn btn-primary btn-lg mb-3">Add Post</button>
                    </form>
    </div> <!-- card-body -->
</div> <!-- card -->
</div> <!-- col-md-8 -->
</div> <!-- row -->
</div>
@endsection
