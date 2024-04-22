@extends('layout.app')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Approval</h1>
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
    </form>

    <div class="table-responsive mt-3">
        <table id="export" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Driver</th>
                    <th scope="col">Car</th>
                    <th scope="col">Type</th>
                    <th scope="col">Start</th>
                    <th scope="col">End</th>
                    <th scope="col">Status</th>
                    <th scope="col">Approved Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($approvals as $approval)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $approval->booking->driver->name }}
                            @if ($approval->booking->driver->license)
                                <i class="bi bi-patch-check-fill"></i>
                            @endif
                        </td>
                        <td>{{ $approval->booking->vehicle->merk }}</td>
                        <td>{{ $approval->booking->vehicle->type }}</td>
                        <td>{{ $approval->booking->start_date }}</td>
                        <td>{{ $approval->booking->end_date }}</td>
                        <td
                            class="@if ($approval->status == 'pending') text-warning
                                @elseif ($approval->status == 'approved')
                                text-success
                                @else
                                text-danger @endif
                                ">
                            {{ $approval->status }}
                        </td>
                        <td>{{ $approval->approved_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
