@extends('layouts.app')

@section('page_title')
    Governorates
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Add New Governorate</h2>
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
        <form action="{{ route('governorates.store') }}" method="post">
            @csrf
            <label class="text-center">Governorate Name</label>
            <input type="text" name="name" class="form-control form-control-lg mb-3" placeholder="Governorate Name">
            <button type="submit" class="btn btn-primary btn-outline-warning">Save</button>
          </form>
    </div> <!-- card-body -->
</div> <!-- card -->
</div> <!-- col-md-8 -->
</div> <!-- row -->
</div>
@endsection
