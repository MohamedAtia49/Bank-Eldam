@extends('front.master')

@section('content')
     <!--form-->
     <div class="form">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                        <li class="breadcrumb-item active" aria-current="page">انشاء حساب جديد</li>
                    </ol>
                </nav>
            </div>
            <div class="account-form">
                <form action="{{ route('client.register') }}" method="post">
                    @csrf
                    <input type="text" name="name" class="form-control mb-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الإسم">

                    <input type="email" name="email" class="form-control mb-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="البريد الإلكترونى">

                    <input placeholder="اخر تاريخ للتبرع" name="last_donation_date" class="form-control mb-2" type="text" onfocus="(this.type='date')" id="date">

                    <select name="blood_type_id" class="form-control mb-2">
                        <option  selected disabled hidden>فصيلة الدم</option>
                        @foreach ($bloodTypes as $bloodType)
                            <option value="{{ $bloodType->id }}">{{ $bloodType->name }}</option>
                        @endforeach
                    </select>

                    @inject('governorate', 'App\Models\Governorate')
                    {!! Form::select('governorate_id',$governorate->pluck('name', 'id')->toArray(),null,[
                        'class' => 'form-control mb-2',
                        'id' => 'governorates',
                        'placeholder' => 'اختر المحافظة',
                    ]) !!}

                    {!! Form::select('city_id',[],null,[
                        'class' => 'form-control mb-2',
                        'id' => 'cities',
                        'placeholder' => 'اختر المدينة',
                    ]) !!}

                    <input type="text" name="phone" class="form-control mb-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="رقم الهاتف">

                    <input placeholder="تاريخ الميلاد" name="d_o_b" class="form-control mb-2" type="text" onfocus="(this.type='date')" id="date">

                    <input type="password" name="password" class="form-control mb-2" id="exampleInputPassword1" placeholder="كلمة المرور">

                    <input type="password" name="password_confirmation" class="form-control mb-2" id="exampleInputPassword1" placeholder="تأكيد كلمة المرور">

                    <div class="mb-2 text-center">
                        <button class="btn btn-success btn-lg">انشاء</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts-front')
    <script>
    $("#governorates").change(function(e) {
        e.preventDefault();
        var governorate_id= $("#governorates").val();
        if(governorate_id)
        {
            $.ajax({
                url  : '{{url('api/v1/cities?governorate_id=')}}'+governorate_id,
                type : 'get',
                success : function (data){
                    if(data.status == 1){
                        $("#cities").empty();
                        var option = '<option value=""> المدينة </option>';
                        $("#cities").append(option);

                        $.each(data.data, function(index, city) {
                            var option = '<option value="' + city.id + '">' + city.name + '</option>';
                            $("#cities").append(option);
                        });
                    }
                },
                error :function(jqxhr , textStatus, errorMessages){
	                        alert(errorMessage);
                       }
            });
        }else{
                $("#cities").empty();
                var option = '<option value=""> المدينة </option>';
                $("#cities").append(option);
        }
    });
    </script>
@endpush

