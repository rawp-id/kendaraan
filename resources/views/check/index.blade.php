@extends('layout.app')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Check Approval</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

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
                    <th scope="col">Approved</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    @if ($booking->status == 'approved')
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
                            <td class="text-warning">pending</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-success d-inline" data-bs-toggle="modal"
                                    data-bs-target="#approve{{ $booking->id }}"><i class="bi bi-check-lg"></i></button>
                                <button type="button" class="btn btn-sm btn-danger d-inline" data-bs-toggle="modal"
                                    data-bs-target="#reject{{ $booking->id }}"><i class="bi bi-x-lg"></i></button>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="approve{{ $booking->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Message
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Data Sudah Benar?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <form action="/approvals" method="POST">
                                            @csrf
                                            <input type="text" name="booking_id" value="{{ $booking->id }}" hidden>
                                            <input type="text" name="status" value="approved" hidden>
                                            <input type="datetime" name="approved_at" value="{{ now() }}" hidden>
                                            <button type="submit" class="btn btn-success">Yes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="reject{{ $booking->id }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Message
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Data Sudah Benar?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        <form action="/approvals" method="POST">
                                            @csrf
                                            <input type="text" name="booking_id" value="{{ $booking->id }}" hidden>
                                            <input type="text" name="status" value="rejected" hidden>
                                            <input type="datetime" name="approved_at" value="{{ now() }}" hidden>
                                            <button type="submit" class="btn btn-danger">Yes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
