@extends('layouts.app')
{{-- @inject('record', 'App\Models\Setting') --}}

@section('page_title')
    Settings
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Edit Settings</h2>
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

                </div> <!-- card-header -->

    <div class="card-body text-center">
       <form action="{{ route('settings.update', 1) }}" method="post">
            @csrf
            @method('put')
            <label>Project Email</label>
            <input type="text" value="{{ $record->email }}" name="email" class="form-control form-control-lg mb-2" placeholder="Project-Email">
            <label>Project Phone</label>
            <input type="text" value="{{ $record->phone }}" name="phone" class="form-control form-control-lg mb-2" placeholder="Project-Phone">
            <label>Facebook link</label>
            <input type="text" value="{{ $record->fb_link }}" name="fb_link" class="form-control form-control-lg mb-2" placeholder="Facebook-link">
            <label>Twitter link</label>
            <input type="text" value="{{ $record->tw_link }}" name="tw_link" class="form-control form-control-lg mb-2" placeholder="Twitter-link">
            <label>Instagram link</label>
            <input type="text" value="{{ $record->insta_link }}" name="insta_link" class="form-control form-control-lg mb-2" placeholder="Instagram-link">
            <label>Notification Settings Text</label>
            <textarea type="text" name="notification_settings_id" rows="5" class="form-control mb-2">{{ old('notification_settings_id',$record->notification_settings_id) }}</textarea>
            <label>About App</label>
            <textarea type="text" name="about_app" rows="5" class="form-control mb-2">{{ old('about_app',$record->about_app) }}</textarea>

            <button type="submit" class="btn btn-primary btn-lg">Save</button>
       </form>
    </div> <!-- card-body -->
</div> <!-- card -->
</div> <!-- col-md-8 -->
</div> <!-- row -->
</div>
@endsection
