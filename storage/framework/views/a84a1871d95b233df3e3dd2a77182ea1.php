
<?php $__env->startPush('links'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin-assets/libs/dropify/css/dropify.min.css')); ?>"> 
<?php $__env->stopPush(); ?>




<?php $__env->startSection('main'); ?>


<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0"><?php echo e(Str::title(str_replace('-', ' ', request()->segment(2)))); ?></h4>
            <?php if (\Illuminate\Support\Facades\Blade::check('can', 'add_client')): ?>
            <div class="page-title-right">
                <a href="<?php echo e(route('admin.'.request()->segment(2).'.create')); ?>"  class="btn-sm btn btn-primary btn-label rounded-pill">
                    <i class="bx bx-plus label-icon align-middle rounded-pill fs-16 me-2"></i>
                    Add <?php echo e(Str::title(str_replace('-', ' ', request()->segment(2)))); ?>

                </a>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <?php echo e(html()->form('PUT', route('admin.' . request()->segment(2) . '.update', $service->id))
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
                                ->value(old('name', $service->name))); ?>  <!-- Use existing value -->
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
                                ->value(old('service_status', $service->status))); ?> <!-- Use existing value -->
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
                            <?php echo e(html()->submit('Update')->class('btn btn-primary')); ?> <!-- Change button text -->
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
<script src="<?php echo e(asset('admin-assets/libs/dropify/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('admin-assets/libs/dropify/dropify.js')); ?>"></script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/services/edit.blade.php ENDPATH**/ ?>