@extends('front.master')

@section('content')

        <!--inside-article-->
        <div class="all-requests">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">طلبات التبرع</li>
                        </ol>
                    </nav>
                </div>

                <!--requests-->
                <div class="requests">
                    <div class="head-text">
                        <h2>طلبات التبرع</h2>
                    </div>
                    <div class="content">
                        <form class="row filter" method="get">
                            <div class="col-md-5 blood">
                                <div class="form-group">
                                    <div class="inside-select">
                                        <select name="blood_type" class="form-control" id="exampleFormControlSelect1">
                                            <option selected disabled>اختر فصيلة الدم</option>
                                            @foreach ($bloodTypes as $bloodType)
                                            <option value="{{ $bloodType->id }}"  @if($bloodType->id == request('blood_type')) selected @endif>{{ $bloodType->name }}</option>
                                            @endforeach
                                        </select>
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 city">
                                <div class="form-group">
                                    <div class="inside-select">
                                        <select name="city" class="form-control" id="exampleFormControlSelect1">
                                            <option selected disabled>اختر المدينة</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}"  @if($city->id == request('city')) selected @endif>{{ $city->name }}</option>
                                            @endforeach
                                        </select>
                                        <i class="fas fa-chevron-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 search">
                                <button type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                        <div class="patients">
                            @foreach ($records as $record)
                                <div class="details">
                                    <div class="blood-type">
                                        <h2 dir="ltr">{{ $record->bloodType->name }}</h2>
                                    </div>
                                    <ul>
                                        <li><span>اسم الحالة:</span> {{ $record->patient_name }}</li>
                                        <li><span>مستشفى:</span> {{ $record->hospital_name }}</li>
                                        <li><span>المدينة:</span> {{ $record->City->name }}</li>
                                    </ul>
                                    <a href="#">التفاصيل</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-50 mx-auto">{{ $records->links() }}</div>

@endsection
