@extends('front.master')

@section('content')
    <div class="favourites">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">اعدادات الاشعارات</li>
                    </ol>
                </nav>
            </div> <!-- path -->
            <div class="view mt-3 mb-5">
                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text-center text-danger">اعدادات الاشعارات</h3>
                        </div><!-- card-header -->
                        <div class="card-body">
                            <p>
                                {{ $settings->notification_settings_id }}
                            </p>
                        </div> <!-- card-body -->
                    </div> <!-- card -->
                    <form action="" method="post">
                        <div class="card mt-5">
                            <div class="card-header bg-danger">
                                <h3 class="text-warning" style="font-weight: bold">فصائل الدم</h3>
                            </div><!-- card-header -->
                                <div class="card-body">
                                        @csrf
                                        <div class="row mb-2">
                                            @foreach ($bloodTypes as $bloodType)
                                                <div class="col-sm-3">
                                                    <label class="text-danger">
                                                        <input type="checkbox" value={{ $bloodType->id }} name="blood_types[]"
                                                        @if ($bloodType->has_any || $bloodType == $client_blood_type){
                                                            checked
                                                        }
                                                        @endif>
                                                        {{ $bloodType->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                </div> <!-- card-body -->
                        </div> <!-- card -->
                        <div class="card mt-5">
                            <div class="card-header bg-danger">
                                <h3 class="text-warning" style="font-weight: bold">المحافظات</h3>
                            </div><!-- card-header -->
                                <div class="card-body">
                                        @csrf
                                        <div class="row mb-2">
                                            @foreach ($governorates as $governorate)
                                                <div class="col-sm-3">
                                                    <label class="text-danger">
                                                        <input type="checkbox" value={{ $governorate->id }} name="governorates[]" @if ($governorate->has_any)
                                                        checked
                                                    @endif>
                                                        {{ $governorate->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                </div> <!-- card-body -->
                        </div> <!-- card -->
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success btn-lg">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- container -->
    </div>
@endsection
