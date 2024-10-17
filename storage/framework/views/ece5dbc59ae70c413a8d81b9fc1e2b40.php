

<?php $__env->startPush('links'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
<div class="content-header row">
    <div class="content-header-left col-md-6 col-12 mb-2">
        <h5 class="content-header-title mb-0">Create Menu</h5>
    </div>

    <div class="content-header-right col-md-6 col-12">
        <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
            <div class="btn-group" role="group">
                <?php if (\Illuminate\Support\Facades\Blade::check('can', 'add_menu')): ?>
                    <a href="<?php echo e(route('admin.menu.create')); ?>" class="btn btn-primary btn-sm">Add Menu</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-content">
        <div class="card-body">
            <?php echo e(html()->form('POST', route('admin.'.request()->segment(2).'.store'))->class('form-horizontal')->open()); ?>


            <div class="form-group">
                <?php echo e(html()->label('Menu Name')->for('name')->class('control-label')); ?>

                <?php echo e(html()->text('name')->class('form-control')->required()->placeholder('Enter Menu Name')->value(old('name'))); ?>

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

            <div class="form-group">
                <?php echo e(html()->label('Icon')->for('icon')->class('control-label')); ?>

                <?php echo e(html()->text('icon')->class('form-control')->required()->placeholder('Enter Icon')->value(old('icon'))); ?>

                <?php $__errorArgs = ['icon'];
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

            <div class="form-group">
                <?php echo e(html()->label('Status')->for('status')->class('control-label')); ?>

                <?php echo e(html()->select('status', [1 => 'Active', 0 => 'Deactive'])->class('form-control')->id('menu_status')->value(old('status'))); ?>

                <?php $__errorArgs = ['status'];
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

            <div class="form-group">
                <?php echo e(html()->submit('Create')->class('btn btn-primary')); ?>

            </div>

            <?php echo e(html()->form()->close()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/menu/create.blade.php ENDPATH**/ ?>