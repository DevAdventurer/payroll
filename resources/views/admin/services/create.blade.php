@extends('admin.layouts.master')
@push('links')
<link rel="stylesheet" href="{{ asset('admin-assets/libs/dropify/css/dropify.min.css') }}">
@endpush

@section('main')

<style>
    .modal {
        --vz-modal-width: 800px !important;
    }
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        display: block;
        margin-top: 0.25rem;
    }
    .is-invalid {
        border-color: #dc3545;
        padding-right: calc(1.5em + .75rem);
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @can('add_salary')
                <div class="page-title-right">
                    {{-- <a href="{{ route('admin.'.request()->segment(2).'.allsalary') }}" class="btn-sm btn btn-primary btn-label rounded-pill">
                        <i class="bx bx-plus label-icon align-middle rounded-pill fs-16 me-2"></i>
                        Export Company {{ Str::title(str_replace('-', ' ', request()->segment(2))) }} Sheet
                    </a> --}}
                </div>
                @endcan

                <div class="row my-1">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header bg-transparent border-primary">
                                <h5 class="my-0 text-primary">Upload Salary Sheet</h5>
                            </div>
                        </div>
                    </div>
                </div>

                {{ html()->form('POST', route('admin.' . request()->segment(2) . '.store'))
                    ->class('form-horizontal')
                    ->attribute('id', 'wageform')
                    ->attribute('enctype', 'multipart/form-data')
                    ->open() }}

<div class="row my-1">
    <div class="col-lg-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    

                    <div class="row mb-3">
                        <div class="col-md-6 form-group">
                            {{ html()->label('Service Name')->for('name') }}
                            {{ html()->text('name')
                                ->class('form-control')
                                ->required()
                                ->placeholder('Enter service name')
                                ->value(old('name')) }}
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                           
                                {{ html()->label('Service Status')->for('service_status') }}
                                {{ html()->select('service_status', ['active' => 'Active', 'inactive' => 'Inactive'])
                                    ->class('form-control')
                                    ->required()
                                    ->placeholder('Select Status')
                                    ->value(old('service_status')) }}
                                @error('service_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                           
                            
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-md-12 mb-3 form-group text-end">
                            {{ html()->submit('Create')->class('btn btn-primary') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{ html()->form()->close() }}







@endsection

@push('scripts')

@endpush

