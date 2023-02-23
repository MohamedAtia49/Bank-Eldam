@extends('front.master')

@section('content')
      <!--inside-article-->
      <div class="about-us">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item" aria-current="page">المقالات</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $post->category->name }}</li>
                    </ol>
                </nav>
            </div>
            <div class="details">
                <div class="logo text-center mt-3">
                    <img height="500" width="800" src="{{ Storage::url($post->image) }}">
                </div>
                <div class="bg-secondary p-2 mt-2">
                    <h4 class="font-weight-bold text-center">{{ $post->title }}</h4>
                </div>
                <div class="text blockquote mt-5">
                    <p class="mb-5">
                        {{ $post->content }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
