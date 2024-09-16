@extends('admin.layouts.master')
@push('links')
<link rel="stylesheet" href="{{asset('admin-assets/libs/dropify/css/dropify.min.css')}}"> 
@endpush




@section('main')


<style>
    /* Style for invalid feedback messages */
.invalid-feedback {
    color: #dc3545; /* Bootstrap's red color for error messages */
    font-size: 0.875rem; /* Slightly smaller font size */
    display: block; /* Ensure the message is displayed as a block element */
    margin-top: 0.25rem; /* Space above the message */
}

/* Optional: Style for form control elements with errors */
.is-invalid {
    border-color: #dc3545; /* Red border for invalid fields */
    padding-right: calc(1.5em + .75rem); /* Space for the error icon if needed */
}

</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                {{ html()->form('POST', route('admin.'.request()->segment(2).'.store'))->class('form-horizontal')->attribute('id', 'companyform')->attribute('files', true)->open() }}

    <div class="row my-1">
        <div class="col-lg-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header bg-transparent border-primary">
                        <h5 class="my-0 text-primary">Company Information</h5>
                    </div>
                    <div class="card-body">
                        <!-- Role Field -->
                        <div class="row">
                            <div class="col-md-12 mb-3 form-group">
                                {{ html()->hidden('role', 3) }}
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Existing Fields -->
                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('Company Name')->for('company_name') }}
                                {{ html()->text('company_name')->class('form-control')->required()->placeholder('Company Name')->value(old('company_name')) }}
                                @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('Email')->for('email') }}
                                {{ html()->email('email')->class('form-control')->required()->placeholder('Email')->value(old('email')) }}
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('Type')->for('type') }}
                                {{ html()->text('type')->class('form-control')->required()->placeholder('Type')->value(old('type')) }}
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('Owner Name')->for('owner_name') }}
                                {{ html()->text('owner_name')->class('form-control')->required()->placeholder('Owner Name')->value(old('owner_name')) }}
                                @error('owner_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('Contact No.')->for('contact_no') }}
                                {{ html()->text('contact_no')->class('form-control')->required()->placeholder('Contact No.')->value(old('contact_no')) }}
                                @error('contact_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('City')->for('city') }}
                                {{ html()->text('city')->class('form-control')->required()->placeholder('City')->value(old('city')) }}
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('District')->for('distt') }}
                                {{ html()->text('distt')->class('form-control')->required()->placeholder('District')->value(old('distt')) }}
                                @error('distt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('State')->for('state') }}
                                {{ html()->text('state')->class('form-control')->required()->placeholder('State')->value(old('state')) }}
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('Address')->for('address') }}
                                {{ html()->textarea('address')->class('form-control')->required()->placeholder('Address')->rows(2)->value(old('address')) }}
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('GST No.')->for('gst_no') }}
                                {{ html()->text('gst_no')->class('form-control')->required()->placeholder('GST No.')->value(old('gst_no')) }}
                                @error('gst_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('PAN No.')->for('pan_no') }}
                                {{ html()->text('pan_no')->class('form-control')->required()->placeholder('PAN No.')->value(old('pan_no')) }}
                                @error('pan_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('Aadhar No.')->for('aadhar_no') }}
                                {{ html()->text('aadhar_no')->class('form-control')->required()->placeholder('Aadhar No.')->value(old('aadhar_no')) }}
                                @error('aadhar_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('Udyam No.')->for('udyam_no') }}
                                {{ html()->text('udyam_no')->class('form-control')->placeholder('Udyam No.')->value(old('udyam_no')) }}
                                @error('udyam_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('CIN No.')->for('cin_no') }}
                                {{ html()->text('cin_no')->class('form-control')->placeholder('CIN No.')->value(old('cin_no')) }}
                                @error('cin_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('EPF No.')->for('epf_no') }}
                                {{ html()->text('epf_no')->class('form-control')->placeholder('EPF No.')->value(old('epf_no')) }}
                                @error('epf_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('ESIC No.')->for('esic_no') }}
                                {{ html()->text('esic_no')->class('form-control')->placeholder('ESIC No.')->value(old('esic_no')) }}
                                @error('esic_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('Bank Name')->for('bank_name') }}
                                {{ html()->text('bank_name')->class('form-control')->required()->placeholder('Bank Name')->value(old('bank_name')) }}
                                @error('bank_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('Account No.')->for('ac_no') }}
                                {{ html()->text('ac_no')->class('form-control')->required()->placeholder('Account No.')->value(old('ac_no')) }}
                                @error('ac_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->label('IFS Code')->for('ifs_code') }}
                                {{ html()->text('ifs_code')->class('form-control')->required()->placeholder('IFS Code')->value(old('ifs_code')) }}
                                @error('ifs_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3 form-group">
                                {{ html()->submit('Save')->class('btn btn-primary') }}
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
@endpush