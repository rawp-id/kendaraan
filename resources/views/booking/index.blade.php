@extends('layout.app')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Booking</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            {{-- <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div> --}}
            <button type="button" class="btn btn-sm btn-primary d-flex align-items-center gap-1 mx-2" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop">
                <i class="bi bi-plus-circle"></i>
                Add
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Form</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="/bookings">
                                @csrf
                                <input type="text" name="user_id" value="1" hidden>
                                <div class="mb-3">
                                    <label class="form-label">Driver</label>
                                    <select class="form-select" aria-label="Default select example" name="driver_id"
                                        required>
                                        <option>Open this select menu</option>
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}"
                                                @if (old('driver') == $driver->id) selected @endif>
                                                {{ $driver->name }}
                                                @if ($driver->license)
                                                    <span>(License Active)</span>
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Vehicle</label>
                                    <select class="form-select" aria-label="Default select example" name="vehicle_id"
                                        required>
                                        <option>Open this select menu</option>
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}"
                                                @if (old('vehicle') == $vehicle->id) selected @endif>
                                                {{ $vehicle->merk }} ({{ $vehicle->type }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Start</label>
                                    <input type="datetime-local"
                                        class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                                        value="{{ old('start_date') }}" required>
                                    @error('start_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">End</label>
                                    <input type="datetime-local"
                                        class="form-control @error('end_date') is-invalid @enderror" name="end_date"
                                        value="{{ old('end_date') }}" required>
                                    @error('end_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="" method="GET">
        <div class="input-group mb-3">
            <input type="date" class="form-control" name="date">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Filter</button>
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Export</button>
        </div>
        {{-- <button type="button" class="btn btn-lg d-flex align-items-center">
            <input type="date" class="form-control" name="date">
        </button> --}}
    </form>

    <div class="table-responsive mt-3">
        <table id="example" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Driver</th>
                    <th scope="col">Car</th>
                    <th scope="col">Type</th>
                    <th scope="col">Start</th>
                    <th scope="col">End</th>
                    <th scope="col">Status</th>
                    <th scope="col">Approval</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->driver->name }}
                            @if ($booking->driver->license)
                                <i class="bi bi-patch-check-fill"></i>
                            @endif
                        </td>
                        <td>{{ $booking->vehicle->merk }}</td>
                        <td>{{ $booking->vehicle->type }}</td>
                        <td>{{ $booking->start_date }}</td>
                        <td>{{ $booking->end_date }}</td>
                        <td
                            class="@if ($booking->status == 'pending') text-warning
                        @elseif ($booking->status == 'approved')
                        text-success
                        @else
                        text-danger @endif
                        ">
                            {{ $booking->status }}
                        </td>
                        <td>
                            @if ($booking->status == 'pending')
                                <button type="button" class="btn btn-sm btn-success d-inline" data-bs-toggle="modal"
                                    data-bs-target="#approvebooking{{ $booking->id }}"><i
                                        class="bi bi-check-lg"></i></button>
                                <button type="button" class="btn btn-sm btn-danger d-inline" data-bs-toggle="modal"
                                    data-bs-target="#rejectbooking{{ $booking->id }}"><i class="bi bi-x-lg"></i></button>
                            @endif
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="approvebooking{{ $booking->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Message</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Data Sudah Benar?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    <a href="/bookings/status/{{ $booking->id }}?status=approved"
                                        class="btn btn-success">Yes</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="rejectbooking{{ $booking->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Message</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Data Sudah Benar?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    <a href="/bookings/status/{{ $booking->id }}?status=rejected"
                                        class="btn btn-danger">Yes</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
