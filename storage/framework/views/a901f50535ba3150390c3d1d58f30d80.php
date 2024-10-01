
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

               
                <?php echo e(html()->form('POST', route('admin.' . request()->segment(2) . '.salary', $id))->class('form-horizontal')->attribute('id', 'employeeForm')->attribute('files', true)->open()); ?>


                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="card-header bg-transparent border-primary">
                            <h5 class="my-0 text-primary">Salary Details</h5>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-4 mb-3 form-group">
                        <?php echo e(html()->label('Designation')->for('designation')); ?>

                        <?php echo e(html()->text('designation')->class('form-control')->required()->placeholder('Enter Designation')->value(old('designation', $salary->designation))); ?>

                        <?php $__errorArgs = ['designation'];
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
                    <div class="col-md-4 mb-3 form-group">
                        <?php echo e(html()->label('Basic Salary')->for('basic')); ?>

                        <?php echo e(html()->text('basic')->class('form-control')->required()->placeholder('Basic Salary')->value(old('basic', $salary->basic))); ?>

                        <?php $__errorArgs = ['basic'];
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
                    <div class="col-md-4 mb-3 form-group">
                        <?php echo e(html()->label('PF Basic')->for('pf_basic')); ?>

                        <?php echo e(html()->text('pf_basic')->class('form-control')->required()->placeholder('PF Basic')->value(old('pf_basic', $salary->pf_basic))); ?>

                        <?php $__errorArgs = ['pf_basic'];
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
                    <div class="col-md-4 mb-3 form-group">
                        <?php echo e(html()->label('HRA')->for('hra')); ?>

                        <?php echo e(html()->text('hra')->class('form-control')->required()->placeholder('HRA')->value(old('hra', $salary->hra))); ?>

                        <?php $__errorArgs = ['hra'];
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
                    <div class="col-md-4 mb-3 form-group">
                        <?php echo e(html()->label('Allowance')->for('allowance')); ?>

                        <?php echo e(html()->text('allowance')->class('form-control')->required()->placeholder('Allowance')->value(old('allowance', $salary->allowance))); ?>

                        <?php $__errorArgs = ['allowance'];
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
                    <div class="col-md-4 mb-3 form-group">
                        <?php echo e(html()->label('LWF')->for('lwf')); ?>

                        <?php echo e(html()->text('lwf')->class('form-control')->required()->placeholder('LWF')->value(old('lwf', $salary->lwf))); ?>

                        <?php $__errorArgs = ['lwf'];
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
                    <div class="col-md-4 mb-3 form-group">
                        <?php echo e(html()->label('Deduction')->for('deduction')); ?>

                        <?php echo e(html()->select('deduction', ['PF' => 'PF', 'ESI' => 'ESI', 'PF+ESI' => 'PF+ESI', 'PDST' => 'PDST', 'NONE' => 'NONE'])->class('form-control')->required()->value(old('deduction', $salary->deduction))); ?>

                        <?php $__errorArgs = ['deduction'];
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
                    <div class="col-md-4 mb-3 form-group">
                        <?php echo e(html()->label('Conveyance')->for('conveyance')); ?>

                        <?php echo e(html()->text('conveyance')->class('form-control')->required()->placeholder('Conveyance')->value(old('conveyance', $salary->conveyance))); ?>

                        <?php $__errorArgs = ['conveyance'];
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
            
                <!-- Submit Button -->
                <div class="row">
                    <div class="col-md-12 mb-3 form-group">
                        <?php echo e(html()->submit('Update')->class('btn btn-primary')); ?>

                    </div>
                </div>
            
            <?php echo e(html()->form()->close()); ?>

            



                


            

                
    </div>
</div>
</div>
</div>



<?php $__env->stopSection(); ?>




<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/employee/salary.blade.php ENDPATH**/ ?>