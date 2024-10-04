
<?php $__env->startPush('links'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin-assets/libs/dropify/css/dropify.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>

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
                <?php if (\Illuminate\Support\Facades\Blade::check('can', 'add_salary')): ?>
                <div class="page-title-right">
                    <a href="<?php echo e(route('admin.'.request()->segment(2).'.allsalary')); ?>" class="btn-sm btn btn-primary btn-label rounded-pill">
                        <i class="bx bx-plus label-icon align-middle rounded-pill fs-16 me-2"></i>
                        Export Company <?php echo e(Str::title(str_replace('-', ' ', request()->segment(2)))); ?> Sheet
                    </a>
                </div>
                <?php endif; ?>

                <div class="row my-1">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header bg-transparent border-primary">
                                <h5 class="my-0 text-primary">Upload Salary Sheet</h5>
                            </div>
                        </div>
                    </div>
                </div>

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
                            'January' => 'January',
                            'February' => 'February',
                            'March' => 'March',
                            'April' => 'April',
                            'May' => 'May',
                            'June' => 'June',
                            'July' => 'July',
                            'August' => 'August',
                            'September' => 'September',
                            'October' => 'October',
                            'November' => 'November',
                            'December' => 'December',
                        ];
                    ?>

                    <div class="row mb-3">
                        <div class="col-md-6 form-group">
                            <?php echo e(html()->label('Select Year')->for('year')); ?>

                            <?php echo e(html()->select('year', array_combine($years, $years))
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

                            <?php echo e(html()->select('month', $months)
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
                                <th>Action</th>
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
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

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
<?php endif; ?>

<?php if(session('not_found_aadhars')): ?>
    <div class="alert alert-warning">
        <strong>Not Found Aadhar Numbers:</strong>
        <ul>
            <?php $__currentLoopData = session('not_found_aadhars'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aadhar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($aadhar); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

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
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // For Bootstrap 5 modals, we use the following initialization
        const employeeDetailsModal = new bootstrap.Modal(document.getElementById('employeeDetailsModal'));

        // Handle click events on all 'view-details' buttons
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', function() {
                const adminId = this.dataset.id;

                // Fetch employee details
                fetch(`/admin/salary/details/${adminId}`)
                    .then(response => response.json())
                    .then(data => {
                        // console.log(data);
                        if ( data.employee.length > 0) {
                            const employee = data.employee[0];
                            const details = `
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Employee Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4"><p><strong>Name:</strong> ${employee.employee.name}</p></div>
                                            <div class="col-md-4"><p><strong>Email:</strong> ${employee.employee.email}</p></div>
                                            <div class="col-md-4"><p><strong>Mobile:</strong> ${employee.employee.mobile}</p></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mt-3">
                                    <div class="card-header bg-info text-white">
                                        <h5>Salary Details</h5>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Working Days</th>
                                                    <th>Total Amount</th>
                                                    <th>Total Deductions</th>
                                                    <th>Net Payable</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>${employee.working_days}</td>
                                                    <td>${employee.total_amount}</td>
                                                    <td>${employee.total_deductions}</td>
                                                    <td>${employee.net_payable}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>`;

                            document.getElementById('employee-details-content').innerHTML = details;

                            // Show the modal using Bootstrap 5 method
                            employeeDetailsModal.show();
                        } else {
                            // Display an alert if no data is found
                            alert('Employee details not found.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while fetching employee details.');
                    });
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/salary/create.blade.php ENDPATH**/ ?>