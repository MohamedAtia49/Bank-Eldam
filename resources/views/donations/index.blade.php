@extends('layouts.app')

@section('page_title')
    Donations Requests
@endsection

@section('content')

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <form action="" class="d-flex" role="search" method="get">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control me-2" type="search" value="{{ request('search') }}" placeholder="Search" aria-label="Search">
                    <select name="blood_type" class="custom-select" id="inputGroupSelect03" aria-label="Example select with button addon">
                        <option selected disabled>Blood Type</option>
                        @foreach ($bloodTypes as $bloodType)
                          <option value="{{ $bloodType->id }}" @if($bloodType->id == request('blood_type')) selected @endif>{{ $bloodType->name }}</option>
                        @endforeach
                      </select>
                      <select name="city" class="custom-select" id="inputGroupSelect03" aria-label="Example select with button addon">
                          <option selected disabled>City</option>
                          @foreach ($cities as $city)
                            <option value="{{ $city->id }}" @if($city->id == request('city')) selected @endif>{{ $city->name }}</option>
                          @endforeach
                        </select>
                    <button type="submit" class="btn btn-outline-success btn-sm">Search</button>
                </div>
            </form>
        </div>
    </nav>

    <table class="table table-striped table-hover table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Patient Name</th>
                <th>City</th>
                <th>Blood Type</th>
                <th>Details</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $record->patient_name}}</td>
                <td>{{ $record->city->name }}</td>
                <td>{{ $record->bloodtype->name }}</td>
                <td><a href="{{ route('donations.show', $record->id) }}" class="btn btn-success">Details</a></td>
                <td><form action="{{ route('donations.destroy', $record->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="w-50 mx-auto">{{ $records->links() }}</div>
@endsection
