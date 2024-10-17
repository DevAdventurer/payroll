

<?php $__env->startPush('links'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0"><?php echo e(Str::title(str_replace('-', ' ', request()->segment(2)))); ?></h4>
                <div class="page-title-right">
                    <a href="<?php echo e(route('admin.' . request()->segment(2) . '.create')); ?>" class="btn-sm btn btn-primary btn-label rounded-pill">
                        <i class="bx bx-plus label-icon align-middle rounded-pill fs-16 me-2"></i>
                        Add <?php echo e(Str::title(str_replace('-', ' ', request()->segment(2)))); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <?php echo e(html()->modelForm($role, 'PUT', route('admin.' . request()->segment(2) . '.update', $role->id))->open()); ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-2 col-sm-12"></div>
                            <div class="form-group col-md-6">
                                <?php echo e(html()->text('name')
                                    ->value($role->name)
                                    ->class('form-control')
                                    ->placeholder('Input field')); ?>

                            </div>
                            <div class="form-group col-md-2 col-sm-6 col-xs-12 text-right">
                                <button type="button" class="permission-select-all btn btn-success btn-icon waves-effect waves-light">
                                    <i class="ri-check-double-line"></i>
                                </button>
                                <button type="button" class="permission-deselect-all btn btn-danger btn-icon waves-effect waves-light">
                                    <i class="ri-delete-bin-5-line"></i>
                                </button>
                            </div>
                            <div class="form-group col-md-2 col-sm-12"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table => $groupPermission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <ul class="permissions list-group list-group-flush">
                            <li class="list-group-item">
                                <?php echo e(html()->checkbox('permission-group')->class('permission-group')); ?>

                                <label class="m-0" for="<?php echo e($table); ?>">
                                    <strong><?php echo e(Str::title(str_replace('_', ' ', $table))); ?></strong>
                                </label>
                                <ul class="list-group list-group-flush">
                                    <?php $__currentLoopData = $groupPermission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="list-group-item">
                                        <?php echo e(html()->checkbox('permissions[]', $permission->checked, $permission->permission_key)
                                            ->id('permission-' . $permission->permission_key)
                                            ->class('the-permission')); ?>

                                        <label class="m-0" for="permission-<?php echo e($permission->permission_key); ?>">
                                            <?php echo e(Str::title(str_replace('_', ' ', $permission->permission_key))); ?>

                                        </label>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="col-md-12 text-right">
            <br>
            <div class="form-group" style="position: fixed; bottom: 50px; right: 25px;">
                <?php echo e(html()->button('Save Permissions')->class('btn btn-primary')); ?>

            </div>
        </div>
    </div>
    <?php echo e(html()->form()->close()); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('admin-assets/js/jquery.matchHeight.js')); ?>"></script>
<script>
    $(document).ready(function () {
        $('.permissions').matchHeight({ property: 'min-height' });

        $('.permission-group').on('change', function(){
            $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
        });

        $('.permission-select-all').on('click', function(){
            $('ul.permissions').find("input[type='checkbox']").prop('checked', true);
            return false;
        });

        $('.permission-deselect-all').on('click', function(){
            $('ul.permissions').find("input[type='checkbox']").prop('checked', false);
            return false;
        });

        function parentChecked(){
            $('.permission-group').each(function(){
                var allChecked = true;
                $(this).siblings('ul').find("input[type='checkbox']").each(function(){
                    if(!this.checked) allChecked = false;
                });
                $(this).prop('checked', allChecked);
            });
        }

        parentChecked();

        $('.the-permission').on('change', function(){
            parentChecked();
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/role/edit.blade.php ENDPATH**/ ?>