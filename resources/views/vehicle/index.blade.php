@extends('layout.app')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Driver</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            {{-- <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div> --}}
            {{-- <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                <svg class="bi">
                    <use xlink:href="#calendar3" />
                </svg>
                This week
            </button> --}}
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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
                            <form method="POST" action="/vehicles">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Number Vehicle</label>
                                    <input type="text"
                                        class="form-control @error('number_vehicle') is-invalid @enderror "
                                        name="number_vehicle" value="{{ old('number_vehicle') }}" required>
                                    @error('number_vehicle')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Merk</label>
                                    <input type="text" class="form-control @error('merk') is-invalid @enderror "
                                        name="merk" value="{{ old('merk') }}" required>
                                    @error('merk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Vehicle</label>
                                    <select class="form-select" aria-label="Default select example" name="type" required>
                                        <option>Open this select menu</option>
                                        <option value="personnel" @if (old('type') == 'personnel') selected @endif>
                                            Personnel</option>
                                        <option value="cargo" @if (old('type') == 'cargo') selected @endif>Cargo
                                        </option>
                                    </select>
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

    <div class="table-responsive mt-3">
        <table id="example" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Number Vehicle</th>
                    <th scope="col">Name</th>
                    <th scope="col">Type</th>
                    <th scope="col">Status</th>
                    <th scope="col">Last Service</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicles as $vehicle)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $vehicle->number_vehicle ?? '-' }}</td>
                        <td>{{ $vehicle->merk }}</td>
                        <td>{{ $vehicle->type }}</td>
                        <td
                            class="@if ($vehicle->status == 'available') text-success
                            @elseif ($vehicle->status == 'in-service')
                            text-warning
                            @else
                            text-danger @endif
                            ">
                            {{ $vehicle->status }}
                        </td>
                        <td>{{ $vehicle->last_service_date ?? '-' }}</td>
                        <td>
                            {{-- <button type="button" class="btn btn-sm btn-info"><i class="bi bi-pencil-square"></i></button> --}}
                            <button type="button" class="btn btn-sm btn-danger"><i class="bi bi-trash"
                                    data-bs-toggle="modal" data-bs-target="#deleteVehicle{{ $vehicle->id }}"></i></button>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteVehicle{{ $vehicle->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Message</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Data Yang Anda Hapus Sudah Benar?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    <form action="/vehicles/{{ $vehicle->id }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
