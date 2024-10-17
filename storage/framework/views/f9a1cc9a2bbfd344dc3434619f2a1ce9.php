
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
                                    <h5 class="my-0 text-primary">LWF Management</h5>
                                </div>
                                <div class="card-body">
                        
                                    <!-- Company Selection -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            <?php echo e(html()->label('Company')->for('company_id')); ?>

                                            <?php echo e(html()->select('company_id', $companies->pluck('name', 'id'))->class('form-control')->required()->placeholder('Select Company')->value(old('company_id'))); ?>

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
                                    </div>
                        
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            <?php echo e(html()->label('Duration')->for('duration')); ?>

                                            <?php echo e(html()->select('duration', [
                                                'April - September' => 'April - September', 'October - March' => 'October - March',
                                            ])->class('form-control')->required()->placeholder('Select Duration')->value(old('duration'))); ?>

                                            <?php $__errorArgs = ['duration'];
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
                
                                    
                
                                    <!-- Year Selection -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            <?php echo e(html()->label('Year')->for('year')); ?>

                                            <?php echo e(html()->select('year', array_combine(range(date('Y'), date('Y') - 5), range(date('Y'), date('Y') - 5)))
                                                ->class('form-control')->required()->placeholder('Select Year')->value(old('year'))); ?>

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
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/lwf/create.blade.php ENDPATH**/ ?>