@extends('front.master')

@section('content')
    <div class="form">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تسجيل الدخول</li>
                    </ol>
                </nav>
            </div>
            <div class="signin-form">
                <form action="{{ route('client.login') }}" method="POST">
                    @csrf
                    <div class="logo mt-5 text-center">
                        <img width="350px" height="100px" src="{{ asset('front/imgs/logo.png') }}">
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            <h4 class="text-lightblue text-center">{{ session('error') }}</h4>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger text-center text-lightblue">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li><h4>{{ $error }}</h4></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="form-group mt-5">
                        <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الايميل">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور">
                    </div>
                    <div class="row options">
                        <div class="col-md-6 remember">
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">تذكرنى</label>
                            </div>
                        </div>
                        <div class="col-md-6 forgot">
                            <img height="20px" src="{{ asset('front/imgs/complain.png') }}">
                            <a href="#">هل نسيت كلمة المرور</a>
                        </div>
                    </div>
                    <div class="row buttons">
                        <div class="col-md-1 right">
                            <button type="submit" class="btn btn-success btn-lg mb-3">دخول</button>
                        </div>
                        <div class="col-md-6 left">
                            <a href="{{ route('client.get.register') }}" class="btn btn-secondary btn-lg mb-3">انشاء حساب جديد</a>
                         </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
