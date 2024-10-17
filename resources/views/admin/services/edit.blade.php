@extends('admin.layouts.master')
@push('links')
<link rel="stylesheet" href="{{asset('admin-assets/libs/dropify/css/dropify.min.css')}}"> 
@endpush




@section('main')


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">{{Str::title(str_replace('-', ' ', request()->segment(2)))}}</h4>
            @can('add_client')
            <div class="page-title-right">
                <a href="{{ route('admin.'.request()->segment(2).'.create') }}"  class="btn-sm btn btn-primary btn-label rounded-pill">
                    <i class="bx bx-plus label-icon align-middle rounded-pill fs-16 me-2"></i>
                    Add {{Str::title(str_replace('-', ' ', request()->segment(2)))}}
                </a>
            </div>
            @endcan

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                {{ html()->form('PUT', route('admin.' . request()->segment(2) . '.update', $service->id))
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
                                ->value(old('name', $service->name)) }}  <!-- Use existing value -->
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            {{ html()->label('Service Status')->for('service_status') }}
                            {{ html()->select('service_status', ['active' => 'Active', 'inactive' => 'Inactive'])
                                ->class('form-control')
                                ->required()
                                ->value(old('service_status', $service->status)) }} <!-- Use existing value -->
                            @error('service_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3 form-group text-end">
                            {{ html()->submit('Update')->class('btn btn-primary') }} <!-- Change button text -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{ html()->form()->close() }}

             
    </div>
</div>
</div>
</div>



@endsection




@push('scripts')
<script src="{{asset('admin-assets/libs/dropify/js/dropify.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin-assets/libs/dropify/dropify.js')}}"></script>

@endpush