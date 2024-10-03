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
.required-label .text-danger {
    font-weight: bold;
    color: red; /* Change the color as needed */
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
                            {{ html()->label('Role <span class="text-danger">*</span>')->for('role_id')->class('required-label') }}
                            {{ html()->select('role_id', $roles->pluck('name', 'id'))->class('form-control')->required()->placeholder('Select Role')->value(old('role_id')) }}
                            @error('role_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3 form-group">
                            {{ html()->label('Company <span class="text-danger">*</span>')->for('company_id')->class('required-label') }}
                            {{ html()->select('company_id', $companies->pluck('name', 'id'))->class('form-control')->required()->placeholder('Select Company')->value(old('company_id')) }}
                            @error('company_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Employee Name -->
                    <div class="row">
                        <div class="col-md-6 mb-3 form-group">
                            {{ html()->label('Employee Name <span class="text-danger">*</span>')->for('employee_name')->class('required-label') }}
                            {{ html()->text('employee_name')->class('form-control')->required()->placeholder('Employee Name')->value(old('employee_name')) }}
                            @error('employee_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Father or Husband Name -->
                        <div class="col-md-6 mb-3 form-group">
                            {{ html()->label('Father or Husband Name <span class="text-danger">*</span>')->for('father_or_husband_name')->class('required-label') }}
                            {{ html()->text('father_or_husband_name')->class('form-control')->required()->placeholder('Father or Husband Name')->value(old('father_or_husband_name')) }}
                            @error('father_or_husband_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div class="row">
                        <div class="col-md-6 mb-3 form-group">
                            {{ html()->label('Email <span class="text-danger">*</span>')->for('email')->class('required-label') }}
                            {{ html()->email('email')->class('form-control')->required()->placeholder('Email')->value(old('email')) }}
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3 form-group">
                            {{ html()->label('Skill <span class="text-danger">*</span>')->for('skill')->class('required-label') }}
                            {{ html()->select('skill') 
                                ->class('form-control')->placeholder('Select Skill')
                                ->required()
                                ->options($skills->pluck('skill_level', 'skill_level')->toArray()) 
                            }}
                            @error('skill')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Gender and Aadhar No -->
                    <div class="row">
                        <div class="col-md-6 mb-3 form-group">
                            {{ html()->label('Gender <span class="text-danger">*</span>')->for('gender')->class('required-label') }}
                            {{ html()->select('gender', ['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'])->class('form-control')->required()->placeholder('Select Gender')->value(old('gender')) }}
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3 form-group">
                            {{ html()->label('Aadhar No <span class="text-danger">*</span>')->for('aadhar_no')->class('required-label') }}
                            {{ html()->text('aadhar_no')->class('form-control')->required()->placeholder('Aadhar No')->value(old('aadhar_no')) }}
                            @error('aadhar_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Mobile and Bank Account No -->
                    <div class="row">
                        <div class="col-md-6 mb-3 form-group">
                            {{ html()->label('Mobile No <span class="text-danger">*</span>')->for('mobile')->class('required-label') }}
                            {{ html()->text('mobile')->class('form-control')->required()->placeholder('Mobile No')->value(old('mobile')) }}
                            @error('mobile')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3 form-group">
                            {{ html()->label('Bank Account No <span class="text-danger">*</span>')->for('bank_account_no')->class('required-label') }}
                            {{ html()->text('bank_account_no')->class('form-control')->required()->placeholder('Bank Account No')->value(old('bank_account_no')) }}
                            @error('bank_account_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Bank Name and IFSC Code -->
                    <div class="row">
                        <div class="col-md-6 mb-3 form-group">
                            {{ html()->label('Bank Name <span class="text-danger">*</span>')->for('bank_name')->class('required-label') }}
                            {{ html()->text('bank_name')->class('form-control')->required()->placeholder('Bank Name')->value(old('bank_name')) }}
                            @error('bank_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3 form-group">
                            {{ html()->label('IFSC Code <span class="text-danger">*</span>')->for('ifsc_code')->class('required-label') }}
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
                            {{ html()->label('Date of Birth <span class="text-danger">*</span>')->for('date_of_birth')->class('required-label') }}
                            {{ html()->date('date_of_birth')->class('form-control')->required()->value(old('date_of_birth')) }}
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3 form-group">
                            {{ html()->label('Date of Joining <span class="text-danger">*</span>')->for('date_of_joining')->class('required-label') }}
                            {{ html()->date('date_of_joining')->class('form-control')->required()->value(old('date_of_joining')) }}
                            @error('date_of_joining')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- State, District, City -->
                    <div class="row">
                        <div class="col-md-4 mb-3 form-group">
                            {{ html()->label('State <span class="text-danger">*</span>')->for('state')->class('required-label') }}
                            {{ html()->select('state', ['' => 'Select State'] + $state->pluck('state_title', 'id')->toArray())->class('form-control')->required()->attribute('id', 'state') }}
                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3 form-group">
                            {{ html()->label('District <span class="text-danger">*</span>')->for('distt')->class('required-label') }}
                            <select name="distt" id="distt" class="form-control" required>
                                <option value="">Select District</option>
                            </select>
                            @error('distt')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3 form-group">
                            {{ html()->label('City <span class="text-danger">*</span>')->for('city')->class('required-label') }}
                            <select name="city" id="city" class="form-control" required>
                                <option value="">Select City</option>
                            </select>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Location -->
                    <div class="row">
                        <div class="col-md-6 mb-3 form-group">
                            {{ html()->label('Location <span class="text-danger">*</span>')->for('location')->class('required-label') }}
                            {{ html()->text('location')->class('form-control')->required()->placeholder('Location')->value(old('location')) }}
                            @error('location')
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
<script>
    $(document).ready(function() {
        $('#state').change(function() {
            var stateId = $(this).val();
            console.log(stateId);
            if (stateId) {
                $.ajax({
                    url: '/get-districts/' + stateId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#distt').empty();
                        $('#distt').append('<option value="">Select District</option>');
                        $.each(data, function(key, value) {
                            $('#distt').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#distt').empty();
                $('#distt').append('<option value="">Select District</option>');
            }
        });
        //cities ajax
        $('#distt').change(function() {
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