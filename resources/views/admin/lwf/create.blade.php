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

                {{ html()->form('POST', route('admin.'.request()->segment(2).'.store'))->class('form-horizontal')->attribute('id', 'wageform')->open() }}

                <div class="row my-1">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary">LWF Management</h5>
                                </div>
                                <div class="card-body">
                        
                                    <!-- Company Selection -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Company')->for('company_id') }}
                                            {{ html()->select('company_id', $companies->pluck('name', 'id'))->class('form-control')->required()->placeholder('Select Company')->value(old('company_id')) }}
                                            @error('company_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                        
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Duration')->for('duration') }}
                                            {{ html()->select('duration', [
                                                'April - September' => 'April - September', 'October - March' => 'October - March',
                                            ])->class('form-control')->required()->placeholder('Select Duration')->value(old('duration')) }}
                                            @error('duration')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                
                                    
                
                                    <!-- Year Selection -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            {{ html()->label('Year')->for('year') }}
                                            {{ html()->select('year', array_combine(range(date('Y'), date('Y') - 5), range(date('Y'), date('Y') - 5)))
                                                ->class('form-control')->required()->placeholder('Select Year')->value(old('year')) }}
                                            @error('year')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                
                                    <!-- Save Button -->
                                    <div class="row">
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