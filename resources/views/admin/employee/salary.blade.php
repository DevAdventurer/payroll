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

               
                {{ html()->form('POST', route('admin.' . request()->segment(2) . '.salary', $id))->class('form-horizontal')->attribute('id', 'employeeForm')->attribute('files', true)->open() }}

                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="card-header bg-transparent border-primary">
                            <h5 class="my-0 text-primary">Salary Details</h5>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4 mb-3 form-group">
                        {{ html()->label('Designation')->for('designation') }}
                        {{ html()->text('designation')->class('form-control')->required()->placeholder('Enter Designation')->value(old('designation', $salary->designation)) }}
                        @error('designation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3 form-group">
                        {{ html()->label('Basic Salary')->for('basic') }}
                        {{ html()->text('basic')->class('form-control')->required()->placeholder('Basic Salary')->value(old('basic', $salary->basic)) }}
                        @error('basic')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3 form-group">
                        {{ html()->label('PF Basic')->for('pf_basic') }}
                        {{ html()->text('pf_basic')->class('form-control')->required()->placeholder('PF Basic')->value(old('pf_basic', $salary->pf_basic)) }}
                        @error('pf_basic')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3 form-group">
                        {{ html()->label('HRA')->for('hra') }}
                        {{ html()->text('hra')->class('form-control')->required()->placeholder('HRA')->value(old('hra', $salary->hra)) }}
                        @error('hra')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3 form-group">
                        {{ html()->label('Allowance')->for('allowance') }}
                        {{ html()->text('allowance')->class('form-control')->required()->placeholder('Allowance')->value(old('allowance', $salary->allowance)) }}
                        @error('allowance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3 form-group">
                        {{ html()->label('LWF')->for('lwf') }}
                        {{ html()->text('lwf')->class('form-control')->required()->placeholder('LWF')->value(old('lwf', $salary->lwf)) }}
                        @error('lwf')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3 form-group">
                        {{ html()->label('Deduction')->for('deduction') }}
                        {{ html()->select('deduction', ['PF' => 'PF', 'ESI' => 'ESI', 'PF+ESI' => 'PF+ESI', 'PDST' => 'PDST', 'NONE' => 'NONE'])->class('form-control')->required()->value(old('deduction', $salary->deduction)) }}
                        @error('deduction')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
               
                <div class="row">
                    <div class="col-md-4 mb-3 form-group">
                        {{ html()->label('Conveyance')->for('conveyance') }}
                        {{ html()->text('conveyance')->class('form-control')->required()->placeholder('Conveyance')->value(old('conveyance', $salary->conveyance)) }}
                        @error('conveyance')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <!-- Submit Button -->
                <div class="row">
                    <div class="col-md-12 mb-3 form-group">
                        {{ html()->submit('Update')->class('btn btn-primary') }}
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