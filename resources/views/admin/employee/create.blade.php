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

                {{ html()->form('POST', route('admin.'.request()->segment(2).'.store'))->class('form-horizontal')->attribute('id', 'employeeForm')->attribute('files', true)->open() }}

                <div class="row my-1">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary">Employee Information</h5>
                                </div>
                                <div class="card-body">
                
                                    <!-- Role Selection -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Role')->for('role_id') }}
                                            {{ html()->select('role_id', $roles->pluck('name', 'id'))->class('form-control')->required()->placeholder('Select Role')->value(old('role_id')) }}
                                            @error('role_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Company')->for('company_id') }}
                                            {{ html()->select('company_id', $companies->pluck('name', 'id'))->class('form-control')->required()->placeholder('Select Company')->value(old('company_id')) }}
                                            @error('company_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                
                                    <!-- Employee Name -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Employee Name')->for('employee_name') }}
                                            {{ html()->text('employee_name')->class('form-control')->required()->placeholder('Employee Name')->value(old('employee_name')) }}
                                            @error('employee_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <!-- Father or Husband Name -->
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Father or Husband Name')->for('father_or_husband_name') }}
                                            {{ html()->text('father_or_husband_name')->class('form-control')->required()->placeholder('Father or Husband Name')->value(old('father_or_husband_name')) }}
                                            @error('father_or_husband_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                
                                    <!-- Email Field -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Email')->for('email') }}
                                            {{ html()->email('email')->class('form-control')->required()->placeholder('Email')->value(old('email')) }}
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                
                                    <!-- Gender and Aadhar No -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Gender')->for('gender') }}
                                            {{ html()->select('gender', ['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'])->class('form-control')->required()->placeholder('Select Gender')->value(old('gender')) }}
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Aadhar No')->for('aadhar_no') }}
                                            {{ html()->text('aadhar_no')->class('form-control')->required()->placeholder('Aadhar No')->value(old('aadhar_no')) }}
                                            @error('aadhar_no')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                
                                    <!-- Mobile and Bank Account No -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Mobile No')->for('mobile') }}
                                            {{ html()->text('mobile')->class('form-control')->required()->placeholder('Mobile No')->value(old('mobile')) }}
                                            @error('mobile')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Bank Account No')->for('bank_account_no') }}
                                            {{ html()->text('bank_account_no')->class('form-control')->required()->placeholder('Bank Account No')->value(old('bank_account_no')) }}
                                            @error('bank_account_no')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                
                                    <!-- Bank Name and IFSC Code -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Bank Name')->for('bank_name') }}
                                            {{ html()->text('bank_name')->class('form-control')->required()->placeholder('Bank Name')->value(old('bank_name')) }}
                                            @error('bank_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('IFSC Code')->for('ifsc_code') }}
                                            {{ html()->text('ifsc_code')->class('form-control')->required()->placeholder('IFSC Code')->value(old('ifsc_code')) }}
                                            @error('ifsc_code')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                
                                    <!-- ESIC No and PF No -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('ESIC No')->for('esic_no') }}
                                            {{ html()->text('esic_no')->class('form-control')->placeholder('ESIC No')->value(old('esic_no')) }}
                                            @error('esic_no')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('PF No')->for('pf_no') }}
                                            {{ html()->text('pf_no')->class('form-control')->placeholder('PF No')->value(old('pf_no')) }}
                                            @error('pf_no')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                
                                    <!-- Date of Birth, Joining, Relieving -->
                                    <div class="row">
                                        <div class="col-md-4 mb-3 form-group">
                                            {{ html()->label('Date of Birth')->for('date_of_birth') }}
                                            {{ html()->date('date_of_birth')->class('form-control')->required()->value(old('date_of_birth')) }}
                                            @error('date_of_birth')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-4 mb-3 form-group">
                                            {{ html()->label('Date of Joining')->for('date_of_joining') }}
                                            {{ html()->date('date_of_joining')->class('form-control')->required()->value(old('date_of_joining')) }}
                                            @error('date_of_joining')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-4 mb-3 form-group">
                                            {{ html()->label('Date of Relieving')->for('date_of_relieving') }}
                                            {{ html()->date('date_of_relieving')->class('form-control')->placeholder('Optional')->value(old('date_of_relieving')) }}
                                            @error('date_of_relieving')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                
                                    <!-- Location and Nationality -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Location')->for('location') }}
                                            {{ html()->text('location')->class('form-control')->required()->placeholder('Location')->value(old('location')) }}
                                            @error('location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Nationality')->for('nationality') }}
                                            {{ html()->text('nationality')->class('form-control')->required()->placeholder('Nationality')->value(old('nationality')) }}
                                            @error('nationality')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                
                                    <!-- Submit Button -->
                                    <div class="row">
                                        <div class="col-md-12 mb-3 form-group">
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