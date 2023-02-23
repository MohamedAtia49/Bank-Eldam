@extends('layouts.app')

@section('page_title')
    Clients
@endsection

@section('content')

    <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <form action="" class="d-flex" role="search" method="get">
                    <input type="text" name="search" class="form-control me-2" type="search" value="{{ request('search') }}" placeholder="Search" aria-label="Search">
                    <div class="input-group mb-3">
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

    <table class="table table-striped table-hover table-bordered text-center mt-2">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Bloodtype</th>
                <th>Birth Date</th>
                <th>Last Donation Date</th>
                <th>City</th>
                <th>Active/De-active</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $record)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $record->name }}</td>
                <td>{{ $record->email }}</td>
                <td>{{ $record->phone }}</td>
                <td>{{ $record->bloodType->name }}</td>
                <td>{{ $record->d_o_b}}</td>
                <td>{{ $record->last_donation_date }}</td>
                <td>{{ $record->city->name }}</td>
                <td>
                    @if ($record->status == 1)
                        <form action="{{ route('client.DeActive', $record->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-warning">De-Active</button>
                        </form>
                    @else
                        <form action="{{ route('client.active', $record->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-success">Active</button>
                        </form>
                    @endif
                </td>
                <td><form action="{{ route('clients.destroy', $record->id) }}" method="post">
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
