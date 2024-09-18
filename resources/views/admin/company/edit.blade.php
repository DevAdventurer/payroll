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

                {{ html()->form('PUT', route('admin.'.request()->segment(2).'.update', $company->id))->attribute('files', true)->open() }}

                <div class="row my-1">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary">Company Information</h5>
                                </div>
                                <div class="card-body">
                
                                    <!-- Existing Fields -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Company Name')->for('company_name') }}
                                            {{ html()->text('company_name')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Company Name')
                                                ->value(old('company_name', $company->name)) }}
                                            @error('company_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Email')->for('email') }}
                                            {{ html()->email('email')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Email')
                                                ->value(old('email', $company->email)) }}
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Type')->for('type') }}
                                            {{ html()->text('type')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Type')
                                                ->value(old('type', $company->details->type ?? '')) }}
                                            @error('type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Owner Name')->for('owner_name') }}
                                            {{ html()->text('owner_name')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Owner Name')
                                                ->value(old('owner_name', $company->details->owner_name ?? '')) }}
                                            @error('owner_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Contact No.')->for('contact_no') }}
                                            {{ html()->text('contact_no')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Contact No.')
                                                ->value(old('contact_no', $company->mobile ?? '')) }}
                                            @error('contact_no')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('State')->for('state_id') }}
                                            {{ html()->select('state', $states, old('state_id', $company->details->state_id ?? ''))
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Select State') }}
                                            @error('state_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                        
                                    </div>
                
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('District')->for('district_id') }}
                                            {{ html()->select('distt',  ['' => 'Select District'] + $district, old('district_id', $company->details->district_id ?? ''))
                                                ->class('form-control')
                                                ->required()
                                                ->attribute('id', 'district') }}
                                            @error('distt')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('City')->for('city') }}
                                            {{ html()->select('city', ['' => 'Select City']+ $city, old('city_id', $company->details->city_id ?? ''))
                                                ->class('form-control')
                                                ->required()
                                                ->attribute('id', 'city') }}
                                            @error('city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        
                                    </div>
                
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Address')->for('address') }}
                                            {{ html()->textarea('address')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Address')
                                                ->rows(2)
                                                ->value(old('address', $company->details->address ?? '')) }}
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('GST No.')->for('gst_no') }}
                                            {{ html()->text('gst_no')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('GST No.')
                                                ->value(old('gst_no', $company->details->gst_no ?? '')) }}
                                            @error('gst_no')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                
                                    <!-- Other fields -->
                
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Bank Name')->for('bank_name') }}
                                            {{ html()->text('bank_name')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Bank Name')
                                                ->value(old('bank_name', $company->details->bank_name ?? '')) }}
                                            @error('bank_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Account No.')->for('ac_no') }}
                                            {{ html()->text('ac_no')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Account No.')
                                                ->value(old('ac_no', $company->details->ac_no ?? '')) }}
                                            @error('ac_no')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('IFS Code')->for('ifs_code') }}
                                            {{ html()->text('ifs_code')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('IFS Code')
                                                ->value(old('ifs_code', $company->details->ifs_code ?? '')) }}
                                            @error('ifs_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->submit('Update Company')->class('btn btn-soft-secondary waves-effect waves-light') }}
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
<script>
$(document).ready(function() {
    $('#state').change(function() {
        var stateId = $(this).val();
        if (stateId) {
            $.ajax({
                url: '/get-districts/' + stateId,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#district').empty();
                    $('#district').append('<option value="">Select District</option>');
                    $.each(data, function(key, value) {
                        $('#district').append('<option value="' + key + '">' + value + '</option>');
                    });
                    // Clear city options when state changes
                    $('#city').empty();
                    $('#city').append('<option value="">Select City</option>');
                }
            });
        } else {
            $('#district').empty();
            $('#district').append('<option value="">Select District</option>');
            $('#city').empty();
            $('#city').append('<option value="">Select City</option>');
        }
    });

    $('#district').change(function() {
        var districtId = $(this).val();
        if (districtId) {
            $.ajax({
                url: '/get-cities/' + districtId,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#city').empty();
                    $('#city').append('<option value="">Select City</option>');
                    $.each(data, function(key, value) {
                        $('#city').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        } else {
            $('#city').empty();
            $('#city').append('<option value="">Select City</option>');
        }
    });
});
</script>
@endpush