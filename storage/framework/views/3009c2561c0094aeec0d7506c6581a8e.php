
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
                    

                    <div class="row mb-3">
                        <div class="col-md-6 form-group">
                            <?php echo e(html()->label('Service Name')->for('name')); ?>

                            <?php echo e(html()->text('name')
                                ->class('form-control')
                                ->required()
                                ->placeholder('Enter service name')
                                ->value(old('name'))); ?>

                            <?php $__errorArgs = ['name'];
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
                           
                                <?php echo e(html()->label('Service Status')->for('service_status')); ?>

                                <?php echo e(html()->select('service_status', ['active' => 'Active', 'inactive' => 'Inactive'])
                                    ->class('form-control')
                                    ->required()
                                    ->placeholder('Select Status')
                                    ->value(old('service_status'))); ?>

                                <?php $__errorArgs = ['service_status'];
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
                            <?php echo e(html()->submit('Create')->class('btn btn-primary')); ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php echo e(html()->form()->close()); ?>








<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/services/create.blade.php ENDPATH**/ ?>