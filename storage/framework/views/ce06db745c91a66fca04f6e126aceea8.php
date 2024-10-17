
<?php $__env->startPush('links'); ?>

<?php $__env->stopPush(); ?>




<?php $__env->startSection('main'); ?>


                  <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><?php echo e(Str::title(str_replace('-', ' ', request()->segment(2)))); ?></h4>

                    <div class="page-title-right">
                        <a href="<?php echo e(route('admin.'.request()->segment(2).'.create')); ?>"  class="btn-sm btn btn-primary btn-label rounded-pill">
                            <i class="bx bx-plus label-icon align-middle rounded-pill fs-16 me-2"></i>
                            Add <?php echo e(Str::title(str_replace('-', ' ', request()->segment(2)))); ?>

                        </a>
                    </div>

                </div>
            </div>
        </div>
        <?php echo Html::form()->route('admin.role.store')->open(); ?>

    <!-- Menu Name -->
    <div class="form-group">
        <?php echo Html::label('name', 'Menu Name', ['class' => 'control-label']); ?>

        <?php echo Html::text('name')->class('form-control'); ?>

        <b class="text-danger"><?php echo e($errors->first('name')); ?></b>
    </div>

    <!-- Icon -->
    <div class="form-group mb-3">
        <?php echo Html::label('Display Name', 'display_name', ['class' => 'control-label']); ?>

        <?php echo Html::text('display_name')->class('form-control'); ?>

        <b class="text-danger"><?php echo e($errors->first('name')); ?></b>
    </div>

   

    <!-- Submit Button -->
    <div class="form-group">
        <?php echo Html::button('Create')
            ->type('submit')
            ->class('btn btn-success')
            ->style('margin-right: 14px; padding: 7px; width: 71px; background: #dcd7d7;'); ?>

    </div>
<?php echo Html::form()->close(); ?> 
        <!-- end page title -->



<?php $__env->stopSection(); ?>




<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/role/create.blade.php ENDPATH**/ ?>