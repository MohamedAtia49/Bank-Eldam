@extends('layouts.app')

@section('page_title')
    Users
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Edit User</h2>
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
        <form action="{{ route('users.update',$record->id) }}" method="post">
            @csrf
            @method('put')
            <label class="text-center">User Name</label>
            <input type="text" name="name" value="{{ $record->name }}" class="form-control form-control-lg mb-3" placeholder="User Name">
            <label class="text-center">User Email</label>
            <input type="text" name="email" value="{{ $record->email }}" class="form-control form-control-lg mb-3" placeholder="User Email">
            <label class="text-center">User Password</label>
            <input type="password" name="password" class="form-control form-control-lg mb-3" placeholder="User Password">
            <label class="text-center">User Roles</label><br>
            <input id="selectAll" type="checkbox"><label for='selectAll'> Select All </label>
            <div class="row mb-2">
                @foreach ($roles as $role)
                    <div class="col-sm-3">
                        <label class="text-danger">
                            <input type="checkbox" value={{ $role->id }} name="roles[]" @if ($record->hasAnyRole($role->id)) checked @endif >
                             {{ $role->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary btn-outline-warning">Update</button>
          </form>
    </div> <!-- card-body -->
</div> <!-- card -->
</div> <!-- col-md-8 -->
</div> <!-- row -->
</div>
@endsection

@push('scripts')
    <script>
        $("#selectAll").click(function() {
        $("input[type=checkbox]").prop("checked", $(this).prop("checked"));
        });
    </script>
@endpush
