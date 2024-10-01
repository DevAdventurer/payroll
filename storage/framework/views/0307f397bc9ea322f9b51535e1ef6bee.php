
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

                <?php echo e(html()->form('POST', route('admin.'.request()->segment(2).'.store'))->class('form-horizontal')->attribute('id', 'wageform')->open()); ?>


                <div class="row my-1">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary">Wage Management</h5>
                                </div>
                                <div class="card-body">
            
                                    <!-- Wage for UNSKILLED Workers -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            <?php echo e(html()->label('Unskilled Worker Wage')->for('unskilled_wage')); ?>

                                            <?php echo e(html()->text('unskilled_wage')->class('form-control')->required()->placeholder('Enter wage for unskilled workers')->value(old('unskilled_wage'))); ?>

                                            <?php $__errorArgs = ['unskilled_wage'];
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
            
                                    <!-- Wage for SEMI-SKILLED Workers -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            <?php echo e(html()->label('Semi-Skilled Worker Wage')->for('semi_skilled_wage')); ?>

                                            <?php echo e(html()->text('semi_skilled_wage')->class('form-control')->required()->placeholder('Enter wage for semi-skilled workers')->value(old('semi_skilled_wage'))); ?>

                                            <?php $__errorArgs = ['semi_skilled_wage'];
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
            
                                    <!-- Wage for SKILLED Workers -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            <?php echo e(html()->label('Skilled Worker Wage')->for('skilled_wage')); ?>

                                            <?php echo e(html()->text('skilled_wage')->class('form-control')->required()->placeholder('Enter wage for skilled workers')->value(old('skilled_wage'))); ?>

                                            <?php $__errorArgs = ['skilled_wage'];
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
                                        <div class="col-md-6 mb-3 form-group">
                                            <?php echo e(html()->submit('Save')->class('btn btn-primary')); ?>

                                        </div>
                                    </div>
            
                                </div>
                            </div>
                        </div>
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
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/minimum_wages/create.blade.php ENDPATH**/ ?>