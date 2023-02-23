@extends('front.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center text-secondary">Profile Information</h1>
            </div><!-- card-header -->
            <div class="card-body text-center">
                <h4 class="text-success" style="font-weight: bold" >Account Name</h4>
                <input type="text" class="form-control text-center mb-2" disabled value="{{ $client->name }}">
                <h4 class="text-success" style="font-weight: bold" >Account Email</h4>
                <input type="text" class="form-control text-center mb-2" disabled value="{{ $client->email }}">
                <h4 class="text-success" style="font-weight: bold" >Account Phone</h4>
                <input type="text" class="form-control text-center mb-2" disabled value="{{ $client->phone }}">
                <h4 class="text-danger text-bold" style="font-weight: bold">Change Password</h4>
                <a href="" class="btn btn-danger btn-outline-warning">Change</a>
            </div><!-- card-body -->
        </div> <!-- card -->
    </div><!-- container -->
@endsection
