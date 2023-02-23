@extends('front.master')

@section('content')
      <!--inside-article-->
      <div class="about-us">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">عن بنك الدم</li>
                    </ol>
                </nav>
            </div>
            <div class="details">
                <div class="logo text-center mt-3">
                    <img src="{{ asset('front/imgs/logo.png') }}">
                </div>
                <div class="text blockquote mt-5">
                    <p class="mb-5">
                        {{ $settings->about_app }}
                    </p>
                    <p class="mb-5">
                        {{ $settings->about_app }}
                    </p>
                    <p class="mb-5">
                        {{ $settings->about_app }}
                    </p>
                    <p class="mb-5">
                        {{ $settings->about_app }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
