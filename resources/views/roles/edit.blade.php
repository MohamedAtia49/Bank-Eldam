@extends('layouts.app')

@section('page_title')
    Roles
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Edit Role</h2>
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
        <form action="{{ route('roles.update', $record->id) }}" method="post">
            @csrf
            @method('put')
            <label class="text-center">Role Name</label>
            <input type="text" name="name" value="{{ $record->name }}" class="form-control form-control-lg mb-3" placeholder="Role Name">
            <label class="text-center">Permission</label> <br>
            <input id="selectAll" type="checkbox"><label for='selectAll'> Select All </label>
            <div class="row mb-2">
                @foreach ($permissions as $permission)
                    <div class="col-sm-3">
                        <label class="text-danger">
                            <input type="checkbox" value={{ $permission->id }} name="permissions[]" @if ($record->hasPermissionTo($permission->id)) checked @endif >
                                {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary btn-outline-warning">Save</button>
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
