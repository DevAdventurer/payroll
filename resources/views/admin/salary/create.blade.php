@extends('admin.layouts.master')
@push('links')
<link rel="stylesheet" href="{{ asset('admin-assets/libs/dropify/css/dropify.min.css') }}">
@endpush

@section('main')

<style>
    .modal{
        --vz-modal-width: 800px !important;
    }
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

                <!-- Title Outside the Form -->
                <div class="row my-1">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header bg-transparent border-primary">
                                <h5 class="my-0 text-primary">Upload Salary Sheet</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Starts Here -->
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
                    @php
                        $years = range(date('Y') - 5, date('Y'));
                        $months = [
    'January'   => 'January',
    'February'  => 'February',
    'March'     => 'March',
    'April'     => 'April',
    'May'       => 'May',
    'June'      => 'June',
    'July'      => 'July',
    'August'    => 'August',
    'September' => 'September',
    'October'   => 'October',
    'November'  => 'November',
    'December'  => 'December',
];

                    @endphp

                    <!-- Year and Month Selection in one row -->
                    <div class="row mb-3">
                        <div class="col-md-6 form-group">
                            {{ html()->label('Select Year')->for('year') }}
                            {{ html()->select('year', $years) // You need to provide a $years array with years
                                ->class('form-control')
                                ->required()
                                ->placeholder('Select Year')
                                ->value(old('year')) }}
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            {{ html()->label('Select Month')->for('month') }}
                            {{ html()->select('month', $months) // You need to provide a $months array with months
                                ->class('form-control')
                                ->required()
                                ->placeholder('Select Month')
                                ->value(old('month')) }}
                            @error('month')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Company Selection and Excel File Upload in one row -->
                    <div class="row mb-3">
                        <div class="col-md-6 form-group">
                            {{ html()->label('Select Company')->for('company_id') }}
                            {{ html()->select('company_id', $companies)
                                ->class('form-control')
                                ->required()
                                ->placeholder('Select Company')
                                ->value(old('company_id')) }}
                            @error('company_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            {{ html()->label('Upload Wage Excel Sheet')->for('wage_excel') }}
                            {{ html()->file('wage_excel')
                                ->class('form-control')
                                ->required()
                                ->accept('.xlsx, .xls, .csv') }}
                            @error('wage_excel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="row">
                        <div class="col-md-12 mb-3 form-group text-end">
                            {{ html()->submit('Upload')->class('btn btn-primary') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{ html()->form()->close() }}


                <!-- Display Salary Data After the Form -->
                @if ($tempsalary->isNotEmpty())
                    <div class="row my-1">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="my-0 text-primary">Salary Data</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Working Days</th>
                                                <th>Total Amount</th>
                                                <th>Total Deduction</th>
                                                <th>Total Payable</th>
                                                <th>Action</th> <!-- New Action Column -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tempsalary as $salary)
                                                <tr>
                                                    <td>{{ $salary->employee->name }}</td>
                                                    <td>{{ $salary->employee->email }}</td>
                                                    <td>{{ $salary->working_days }}</td>
                                                    <td>{{ $salary->total_amount }}</td>
                                                    <td>{{ $salary->total_deductions }}</td>
                                                    <td>{{ $salary->net_payable }}</td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm view-details" 
                                                                data-id="{{ $salary->admin_id }}">View Details</button>
                                                    </td> <!-- View Details Button -->
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <!-- Action Buttons -->
                                    <div class="text-end">
                                        <button type="button" class="btn btn-success" id="verifyButton">Verify</button>
                                        <button type="button" class="btn btn-danger" id="cancelButton">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row my-1">
                        <div class="col-lg-12">
                            <div class="alert alert-warning">
                                <strong>No salary data found.</strong> Please upload a wage sheet to display data.
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

@if(session('not_found_aadhars'))
    <div class="alert alert-warning">
        <strong>Not Found Aadhar Numbers:</strong>
        <ul>
            @foreach($notFoundAadhars as $aadhar)
                <li>{{ $aadhar }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Employee Details Modal -->
<div class="modal fade" id="employeeDetailsModal" tabindex="-1" role="dialog" aria-labelledby="employeeDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeDetailsModalLabel">Employee Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="employee-details-content">
                    <!-- Employee details will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.querySelectorAll('.view-details').forEach(button => {
        button.addEventListener('click', function() {
            const adminId = this.dataset.id;

            // Fetch employee details using AJAX
            fetch(`/admin/salary/details/${adminId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const employee = data.employee[0]; 
                       
                        // Update modal content with employee details
                        const details = `
    <div class="card">
        <div class="card-header">
            <h5>Employee Details</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <p><strong>Name:</strong> ${employee.employee.name}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Email:</strong> ${employee.employee.email}</p>
                </div>
                <div class="col-md-4">
                    <p><strong>Mobile:</strong> ${employee.employee.mobile}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header bg-info text-white">
            <h5>Salary Details</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <tbody>
                    <tr>
                        <th>Month</th>
                        <td>${employee.month}</td>
                        <th>Year</th>
                        <td>${employee.year}</td>
                        <th>Working Days</th>
                        <td>${employee.working_days}</td>
                    </tr>
                    <tr>
                        <th>Basic Salary</th>
                        <td>${employee.basic}</td>
                        <th>PF Basic</th>
                        <td>${employee.pf_basic}</td>
                        <th>HRA</th>
                        <td>${employee.hra}</td>
                    </tr>
                    <tr>
                        <th>Conveyance</th>
                        <td>${employee.conveyance}</td>
                        <th>Other Allowance</th>
                        <td>${employee.other_allowance}</td>
                        <th>Total Amount</th>
                        <td>${employee.total_amount}</td>
                    </tr>
                    <tr>
                        <th>Total Deductions</th>
                        <td>${employee.total_deductions}</td>
                        <th>Net Payable</th>
                        <td>${employee.net_payable}</td>
                        <th>EPF (Employee)</th>
                        <td>${employee.epf_employee}</td>
                    </tr>
                    <tr>
                        <th>EPF (Employer)</th>
                        <td>${employee.epf_employer}</td>
                        <th>EPS (Employer)</th>
                        <td>${employee.eps_employer}</td>
                        <th>ESI (Employee)</th>
                        <td>${employee.esi_employee}</td>
                    </tr>
                    <tr>
                        <th>ESI (Employer)</th>
                        <td>${employee.esi_employer}</td>
                        <th>Advance</th>
                        <td>${employee.advance}</td>
                        <th>Other Deductions</th>
                        <td>${employee.other_deductions || 0}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
`;

                        document.getElementById('employee-details-content').innerHTML = details;

                        // Show the modal
                        $('#employeeDetailsModal').modal('show');
                    }
                })
                .catch(error => console.error('Error fetching employee details:', error));
        });
    });
    

    document.addEventListener('DOMContentLoaded', function () {
    // Get the modal and close button elements
    var closeModalButton = document.querySelector('.close');

    // Add click event listener to the close button
    closeModalButton.addEventListener('click', function () {
        // Use Bootstrap's modal hide method
        $('#employeeDetailsModal').modal('hide');
    });
});

</script>
@endpush
