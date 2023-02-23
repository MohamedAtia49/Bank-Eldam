@extends('front.master')

@section('content')
    <div class="favourites">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">المفضلة</li>
                    </ol>
                </nav>
            </div>
            <div class="view mt-3 mb-5">
                <div class="container">
                    <div class="row">
                        <!-- Set up your HTML -->
                            <div class="owl-carousel articles-carousel">
                                @foreach ($posts as $post)
                                    <div class="card">
                                        <div class="photo">
                                            <img src="{{ Storage::url($post->image) }}" class="card-img-top" alt="...">
                                        </div>
                                        <div class="favourite">
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $post->title }}</h5>
                                            <p class="card-text" style="height: 150px">
                                                {{ $post->content }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
