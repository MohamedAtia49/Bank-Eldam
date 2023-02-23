@extends('layouts.app')

@section('page_title')
    Profile
@endsection


@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center text-secondary">Profile Information</h1>
            </div><!-- card-header -->
            <div class="card-body text-center">
                <h4 class="text-secondary">Account Name</h4>
                <input type="text" class="form-control text-center mb-2" disabled value="{{ $user->name }}">
                <h4 class="text-secondary">Account Email</h4>
                <input type="text" class="form-control text-center mb-2" disabled value="{{ $user->email }}">
                <h4 class="text-danger text-bold">Change Password</h4>
                <a href="{{ route('profile.change.password') }}" class="btn btn-danger btn-outline-warning">Change</a>
            </div><!-- card-body -->
        </div> <!-- card -->
    </div><!-- container -->
@endsection
