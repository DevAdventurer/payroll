
<?php $__env->startPush('links'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin-assets/libs/dropify/css/dropify.min.css')); ?>"> 
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
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

                <!-- Title Outside the Form -->
                <div class="row my-1">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-header bg-transparent border-primary">
                                <h5 class="my-0 text-primary">Upload Employee Sheet</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if(session('warning')): ?>
                <div class="alert alert-warning">
                    <strong><?php echo e(session('warning')); ?></strong>
                    <ul>
                        <?php $__currentLoopData = session('existing_aadhars'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aadhar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($aadhar); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>
            
                <!-- Form Starts Here -->
                <div style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>Father/Husband Name</th>
                                <th>Gender</th>
                                <th>Aadhar No</th>
                                <th>Mobile</th>
                                <th>Bank Account No</th>
                                <th>Bank Name</th>
                                <th>IFSC Code</th>
                                <th>ESIC No</th>
                                <th>PF No</th>
                                <th>Date of Birth</th>
                                <th>Date of Joining</th>
                                <th>Date of Relieving</th>
                                <th>Location</th>
                                <th>Nationality</th>
                                <th>Designation</th>
                                <th>Basic</th>
                                <th>PF Basic</th>
                                <th>HRA</th>
                                <th>Allowance</th>
                                <th>LWF</th>
                                <th>Deduction</th>
                                <th>Conveyance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php echo e(isset($repeatedAadhars[$employee->aadhar_no]) ? 'table-warning' : (in_array($employee->aadhar_no, $existingAadhars) ? 'table-danger' : '')); ?>">
                                    <td><?php echo e($employee->employee_name); ?></td>
                                    <td><?php echo e($employee->father_or_husband_name); ?></td>
                                    <td><?php echo e($employee->gender); ?></td>
                                    <td><?php echo e($employee->aadhar_no); ?></td>
                                    <td><?php echo e($employee->mobile); ?></td>
                                    <td><?php echo e($employee->bank_account_no); ?></td>
                                    <td><?php echo e($employee->bank_name); ?></td>
                                    <td><?php echo e($employee->ifsc_code); ?></td>
                                    <td><?php echo e($employee->esic_no); ?></td>
                                    <td><?php echo e($employee->pf_no); ?></td>
                                    <td><?php echo e($employee->date_of_birth); ?></td>
                                    <td><?php echo e($employee->date_of_joining); ?></td>
                                    <td><?php echo e($employee->date_of_relieving); ?></td>
                                    <td><?php echo e($employee->location); ?></td>
                                    <td><?php echo e($employee->nationality); ?></td>
                                    <td><?php echo e($employee->designation); ?></td>
                                    <td><?php echo e($employee->basic); ?></td>
                                    <td><?php echo e($employee->pf_basic); ?></td>
                                    <td><?php echo e($employee->hra); ?></td>
                                    <td><?php echo e($employee->allowance); ?></td>
                                    <td><?php echo e($employee->lwf); ?></td>
                                    <td><?php echo e($employee->deduction); ?></td>
                                    <td><?php echo e($employee->conveyance); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <form action="<?php echo e(route('admin.employee.verify')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="company_id" value="<?php echo e($employee->company_id); ?>">
                        <input type="hidden" name="employee_data" value="<?php echo e(json_encode($employees)); ?>">
                        <button type="submit" class="btn btn-primary">Verify</button>
                        <a href="" class="btn btn-secondary">Cancel/Review Again</a>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/employee/uploadview.blade.php ENDPATH**/ ?>