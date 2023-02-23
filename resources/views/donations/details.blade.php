@extends('layouts.app')

@section('page_title')
    Donations Requests
@endsection

@section('content')
    <table class="table table-striped table-hover table-bordered text-center">
        <thead>
            <tr>
                <th>#</th>
                <th>Client Name</th>
                <th>Client Email</th>
                <th>City</th>
                <th>Blood Type</th>
                <th>Bags Number</th>
                <th>Patient Name</th>
                <th>Patient Age</th>
                <th>Patient phone</th>
                <th>Hospital Address</th>
                <th>More Details</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->client->name }}</td>
                <td>{{ $record->client->email }}</td>
                <td>{{ $record->city->name }}</td>
                <td>{{ $record->bloodtype->name }}</td>
                <td>{{ $record->bags_num }}</td>
                <td>{{ $record->patient_name }}</td>
                <td>{{ $record->patient_age }}</td>
                <td>{{ $record->patient_phone }}</td>
                <td>{{ $record->hospital_address }}</td>
                <td>{{ $record->details }}</td>
            </tr>
        </tbody>
    </table>
@endsection
