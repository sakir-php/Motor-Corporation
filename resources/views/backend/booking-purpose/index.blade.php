@extends('layouts.backend.app')

@section('title') Booking Purpose @endsection
@section('content')

    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Booking Purpose</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Booking Purpose</li>
                </ol>
                <a href="{{ route('backend.bookingPurpose.create') }}" class="btn btn-info d-none d-lg-block m-l-15"><i
                        class="fa fa-plus-circle"></i> Create
                    New</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table color-bordered-table primary-bordered-table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Maximum Free Counter</th>
                                <th scope="col">Description</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookingPurposes as $bookingPurpose)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bookingPurpose->name }}</td>
                                    <td>{{ $bookingPurpose->max_free_counter }}</td>
                                    <td>{{ $bookingPurpose->description }}</td>
                                    <td>{{ $bookingPurpose->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <a class="btn btn-warning btn-circle" href="{{ route('backend.bookingPurpose.edit', $bookingPurpose) }}">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-circle delete-btn"
                                            value="{{ route('backend.bookingPurpose.destroy', $bookingPurpose) }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('head')

@endpush

@push('foot')

@endpush
