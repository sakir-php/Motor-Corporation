@extends('layouts.backend.app')

@section('title') Expense Create @endsection

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Expense Create Page</h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Expense Create Page</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="mb-0 text-white">Create Expense</h4>
                </div>
                <form action="{{ route('backend.expense.store') }}" method="POST" class="form-horizontal form-material"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-body">
                        <div class="card-body">
                            <div class="row pt-3">
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label class="form-label" for="amount">Amount <b
                                                class="text-danger">*</b></label>
                                        <input type="number" step="any" id="amount" name="amount"
                                            class="form-control form-control-danger" placeholder="Amount"
                                            value="{{ old('amount') }}" required>
                                        @error('amount')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label class="form-label">Expense Category <b
                                                class="text-danger">*</b></label>
                                        <select name="category_id" class="form-select col-12" id="category_id" required>
                                            <option value="">--Select Category--</option>
                                            @foreach ($expenseCategories as $expenseCategory)
                                                <option value="{{ $expenseCategory->id }}">{{ $expenseCategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="alert alert-danger" role="alert">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group has-danger">
                                        <label for="example-month-input2" class="col-4 col-form-label">Description</label>
                                        <div class="col-10">
                                            <textarea class="form-control" id="description" name="description" rows="3"
                                                placeholder="Expense Description"></textarea>
                                            @error('description')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="recurring" value="variable"
                                            id="recurring1">
                                            <label class="form-check-label" for="recurring1">
                                           Variable Cost
                                        </label>
</div>
<div class="form-check">

                                            <input class="form-check-input" type="radio" name="recurring" value="fixed"
                                            id="recurring2">
                                        <label class="form-check-label" for="recurring2">
                                            Fixed Cost
                                        </label>
                                        @error('recurring')
                                        <div class="alert alert-danger" role="alert">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="card-body">
                                <button type="submit" class="btn btn-success text-white"> <i class="fa fa-check"></i>
                                    Save</button>
                                <button type="reset" class="btn btn-danger">Reset form</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('head')

@endpush

@push('foot')

@endpush
