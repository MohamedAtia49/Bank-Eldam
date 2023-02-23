@extends('layouts.app')

@section('page_title')
    Change Password
@endsection


@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h1 class="text-secondary">Change Password</h1>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('message'))
                    <div class="alert alert-success text-center p-2">
                        <h1 class="text-success text-light">{{ session('message') }}</h1>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger text-center p-2">
                        <h4 class="text-success text-light">{{ session('error') }}</h4>
                    </div>
                @endif
            </div><!-- card-header -->
            <div class="card-body text-center">
                <form action="{{ route('profile.password.save') }}" method="post">
                    @csrf
                    <label for="">Old Password</label>
                    <input type="password" name="password-old" class="form-control form-control-lg mb-2">
                    <label for="">New Password</label>
                    <input type="password" name="password" class="form-control form-control-lg mb-2">
                    <label for="">Confirm new Password</label>
                    <input type="password" name="password_confirmation" class="form-control form-control-lg mb-2">
                    <button type="submit" class="btn btn-danger">Save</button>
                </form>
            </div><!-- card-body -->
        </div> <!-- card -->
    </div><!-- container -->
@endsection
