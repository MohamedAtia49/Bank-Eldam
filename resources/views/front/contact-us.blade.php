@extends('front.master')

@section('content')
     <!--contact-us-->
     <div class="contact-now">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">تواصل معنا</li>
                    </ol>
                </nav>
            </div>
            <div class="row methods">
                <div class="col-md-6">
                    <div class="call">
                        <div class="title">
                            <h4 class="bg-secondary p-3 mt-3 text-center">اتصل بنا</h4>
                        </div>
                        <div class="content">
                            <div class="logo">
                                <img src="{{ asset('front/imgs/logo.png') }}">
                            </div>
                            <div class="details">
                                <ul class="mt-4">
                                    <li><span>الجوال:</span> {{ $settings->phone }}</li>
                                    <li><span>فاكس:</span> 234234234</li>
                                    <li><span>البريد الإلكترونى:</span> {{ $settings->email }}</li>
                                </ul>
                            </div>
                            <div class="social">
                                <h4 class="mt-5">تواصل معنا</h4>
                                <div class="icons" dir="ltr">
                                    <div class="out-icon">
                                        <a href="{{ $settings->fb_link }}" target="_blank"><img width="60px" height="50px" src="{{ asset('front/imgs/001-facebook.svg') }}"></a>

                                        <a href="{{ $settings->fb_link }}" target="_blank"><img width="60px" height="50px" src="{{ asset('front/imgs/002-twitter.svg') }}"></a>

                                        <a href="{{ $settings->fb_link }}" target="_blank"><img width="60px" height="50px" src="{{ asset('front/imgs/003-youtube.svg') }}"></a>

                                        <a href="{{ $settings->fb_link }}" target="_blank"><img width="60px" height="50px" src="{{ asset('front/imgs/004-instagram.svg') }}"></a>

                                        <a href="{{ $settings->fb_link }}" target="_blank"><img width="60px" height="50px" src="{{ asset('front/imgs/005-whatsapp.svg') }}"></a>

                                        <a href="{{ $settings->fb_link }}" target="_blank"><img width="60px" height="50px" src="{{ asset('front/imgs/006-google-plus.svg') }}"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <div class="title">
                            <h4 class="bg-secondary p-3 mt-3 text-center">تواصل معنا</h4>
                        </div>
                        <div class="fields">
                            <form>
                                <input type="text" class="form-control mt-4" id="exampleFormControlInput1" placeholder="الإسم" name="name">
                                <input type="email" class="form-control mt-2" id="exampleFormControlInput1" placeholder="البريد الإلكترونى" name="email">
                                <input type="text" class="form-control mt-2" id="exampleFormControlInput1" placeholder="الجوال" name="phone">
                                <input type="text" class="form-control mt-2" id="exampleFormControlInput1" placeholder="عنوان الرسالة" name="title">
                                <textarea placeholder="نص الرسالة" class="form-control mt-2" id="exampleFormControlTextarea1" rows="3" name="text"></textarea>
                                <div class="text-center mt-3 mb-4">
                                    <button type="submit" class="btn btn-success">ارسال</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
