
<?php $__env->startPush('links'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin-assets/libs/dropify/css/dropify.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>

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
                <?php if (\Illuminate\Support\Facades\Blade::check('can', 'add_salary')): ?>
                <div class="page-title-right">
                    <a href="<?php echo e(route('admin.'.request()->segment(2).'.allsalary')); ?>"  class="btn-sm btn btn-primary btn-label rounded-pill">
                        <i class="bx bx-plus label-icon align-middle rounded-pill fs-16 me-2"></i>
                        Export Company  <?php echo e(Str::title(str_replace('-', ' ', request()->segment(2)))); ?> Sheet
                    </a>
                </div>
                
                <?php endif; ?>
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
                <?php echo e(html()->form('POST', route('admin.' . request()->segment(2) . '.store'))
    ->class('form-horizontal')
    ->attribute('id', 'wageform')
    ->attribute('enctype', 'multipart/form-data')
    ->open()); ?>


<div class="row my-1">
    <div class="col-lg-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <?php
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

                    ?>

                    <!-- Year and Month Selection in one row -->
                    <div class="row mb-3">
                        <div class="col-md-6 form-group">
                            <?php echo e(html()->label('Select Year')->for('year')); ?>

                            <?php echo e(html()->select('year', $years) // You need to provide a $years array with years
                                ->class('form-control')
                                ->required()
                                ->placeholder('Select Year')
                                ->value(old('year'))); ?>

                            <?php $__errorArgs = ['year'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-md-6 form-group">
                            <?php echo e(html()->label('Select Month')->for('month')); ?>

                            <?php echo e(html()->select('month', $months) // You need to provide a $months array with months
                                ->class('form-control')
                                ->required()
                                ->placeholder('Select Month')
                                ->value(old('month'))); ?>

                            <?php $__errorArgs = ['month'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Company Selection and Excel File Upload in one row -->
                    <div class="row mb-3">
                        <div class="col-md-6 form-group">
                            <?php echo e(html()->label('Select Company')->for('company_id')); ?>

                            <?php echo e(html()->select('company_id', $companies)
                                ->class('form-control')
                                ->required()
                                ->placeholder('Select Company')
                                ->value(old('company_id'))); ?>

                            <?php $__errorArgs = ['company_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="col-md-6 form-group">
                            <?php echo e(html()->label('Upload Wage Excel Sheet')->for('wage_excel')); ?>

                            <?php echo e(html()->file('wage_excel')
                                ->class('form-control')
                                ->required()
                                ->accept('.xlsx, .xls, .csv')); ?>

                            <?php $__errorArgs = ['wage_excel'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Save Button -->
                    <div class="row">
                        <div class="col-md-12 mb-3 form-group text-end">
                            <?php echo e(html()->submit('Upload')->class('btn btn-primary')); ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php echo e(html()->form()->close()); ?>



                <!-- Display Salary Data After the Form -->
                <?php if($tempsalary->isNotEmpty()): ?>
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
                                            <?php $__currentLoopData = $tempsalary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($salary->employee->name); ?></td>
                                                    <td><?php echo e($salary->employee->email); ?></td>
                                                    <td><?php echo e($salary->working_days); ?></td>
                                                    <td><?php echo e($salary->total_amount); ?></td>
                                                    <td><?php echo e($salary->total_deductions); ?></td>
                                                    <td><?php echo e($salary->net_payable); ?></td>
                                                    <td>
                                                        <button class="btn btn-info btn-sm view-details" 
                                                                data-id="<?php echo e($salary->admin_id); ?>">View Details</button>
                                                    </td> <!-- View Details Button -->
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>

                                    <!-- Action Buttons -->
                                    <div class="text-end">
                                        <form method="POST" action="<?php echo e(route('admin.' . request()->segment(2) . '.verify')); ?>">
                                            <?php echo csrf_field(); ?>
                                            
                                            <button type="submit" class="btn btn-success" id="verifyButton">Verify</button>
                                        </form>
                                        <form method="POST" action="<?php echo e(route('admin.' . request()->segment(2) . '.cancel')); ?>">
                                            <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-danger" id="cancelButton">Cancel</button>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?php if(session('not_found_aadhars')): ?>
    <div class="alert alert-warning">
        <strong>Not Found Aadhar Numbers:</strong>
        <ul>
            <?php $__currentLoopData = $notFoundAadhars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aadhar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($aadhar); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

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

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/salary/create.blade.php ENDPATH**/ ?>