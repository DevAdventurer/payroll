
<?php $__env->startPush('links'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('admin-assets/libs/nestable/jquery.nestable.css')); ?>" />
<?php $__env->stopPush(); ?>




<?php $__env->startSection('main'); ?>


                    <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0"><?php echo e(Str::title(str_replace('-', ' ', request()->segment(2)))); ?></h4>

                    <div class="page-title-right">
                        <a href="<?php echo e(route('admin.'.request()->segment(2).'.create')); ?>"  class="btn-sm btn btn-primary btn-label rounded-pill">
                            <i class="align-middle bx bx-plus label-icon rounded-pill fs-16 me-2"></i>
                            Add <?php echo e(Str::title(str_replace('-', ' ', request()->segment(2)))); ?>

                        </a>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->



            <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    
                    <div class="card-body">
                      

                      <div class="dd" id="nestable_list_2">
            <ol class="dd-list">
                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="dd-item dd3-item" data-id="<?php echo e($menu->slug); ?>">
                    <div class="dd-handle dd3-handle"></div>
                    <div class="dd3-content"><?php echo e($menu->name); ?>

                        <?php if (\Illuminate\Support\Facades\Blade::check('can', 'edit_menu')): ?>
                        <a href="<?php echo e(route('admin.menu.edit',$menu->slug)); ?>" class="btn btn-link pull-right" style="padding: 0px 6px; margin-top: -2px;">Edit</a>
                        <?php endif; ?>
                        <?php if (\Illuminate\Support\Facades\Blade::check('can', 'delete_menu')): ?>
                        <?php if($menu->childs->isEmpty()): ?>
                        <span style="margin:0px 10px 0px 10px" class="pull-right">/</span>
                        <button onclick="deleteAjax('<?php echo e(route('admin.menu.destroy',$menu->slug)); ?>',function(){window.location.reload(); })" class="btn btn-link pull-right" style="padding: 0px 6px; margin-top: -2px;">Delete</button>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php if($menu->childs->count()): ?>
                    <ol class="dd-list" id="<?php echo e($menu->slug); ?>">
                        <?php $__currentLoopData = $menu->childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="dd-item dd3-item" data-id="<?php echo e($child->slug); ?>">
                            <div class="dd-handle dd3-handle"></div>
                            <div class="dd3-content"><?php echo e($child->name); ?>

                                <?php if (\Illuminate\Support\Facades\Blade::check('can', 'edit_menu')): ?>
                                <a href="<?php echo e(route('admin.menu.edit',$child->slug)); ?>" class="btn btn-link pull-right" style="padding: 0px 6px; margin-top: -2px;">Edit</a>
                                <?php endif; ?>
                                <?php if (\Illuminate\Support\Facades\Blade::check('can', 'delete_menu')): ?>
                                <span style="margin:0px 10px 0px 10px" class="pull-right">/</span>
                                <button onclick="deleteAjax('<?php echo e(route('admin.menu.destroy',$child->slug)); ?>',function(){window.location.reload(); })" class="btn btn-link pull-right" style="padding: 0px 6px; margin-top: -2px;">Delete</button>
                                <?php endif; ?>
                            </div>

                            <?php if($child->grands->count()): ?>
                                <ol class="dd-list" id="<?php echo e($child->slug); ?>">
                                    <?php $__currentLoopData = $child->grands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $grandChild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="dd-item dd3-item" data-id="<?php echo e($grandChild->slug); ?>">
                                        <div class="dd-handle dd3-handle"></div>
                                        <div class="dd3-content"><?php echo e($grandChild->name); ?>

                                            <?php if (\Illuminate\Support\Facades\Blade::check('can', 'edit_menu')): ?>
                                            <a href="<?php echo e(route('admin.menu.edit',$grandChild->slug)); ?>" class="btn btn-link pull-right" style="padding: 0px 6px; margin-top: -2px;">Edit</a>
                                            <?php endif; ?>
                                            <?php if (\Illuminate\Support\Facades\Blade::check('can', 'delete_menu')): ?>
                                            <span style="margin:0px 10px 0px 10px" class="pull-right">/</span>
                                            <button onclick="deleteAjax('<?php echo e(route('admin.menu.destroy',$grandChild->slug)); ?>',function(){window.location.reload(); })" class="btn btn-link pull-right" style="padding: 0px 6px; margin-top: -2px;">Delete</button>
                                            <?php endif; ?>
                                        </div>
                                    </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ol>
                                <?php endif; ?>


                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>
                    <?php endif; ?>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ol>
        </div>

                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->

        



<?php $__env->stopSection(); ?>




<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('admin-assets/libs/nestable/jquery.nestable.js')); ?>"></script>

<script>
var updateOutput = function(e) {
    var list = e.length ? e : $(e.target),
        output = list.data('output');
    output.val(JSON.stringify(list.nestable('serialize')));
};
$('#nestable_list_2').nestable({
    group: 1,
    maxDepth: 3
}).on('change', function(e) {
    var list = e.length ? e : $(e.target),
        output = list.data('output');
    var data = list.nestable('serialize');
    <?php if (\Illuminate\Support\Facades\Blade::check('can', 'edit_menu')): ?>
    $.ajax({
        url: '<?php echo e(route('admin.menu.update','')); ?>/1',
        data: {
            'data': list.nestable('serialize'),
            '_method': 'put',
            '_token': '<?php echo e(csrf_token()); ?>',
            '_list': 'nestable'
        },
        method: 'post',
        success: function(response) {

            Toastify({
                text: response.message,
                duration: 800,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                className: "success",

            }).showToast();

           // toastr.success(response.message);
            setTimeout(function() {
                window.location.reload();
            }, 800);
        },
        error: function(response) {
            Toastify({
                text: response.message,
                duration: 3000,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                className: "error",

            }).showToast();
            //toastr.error(response.message);
        }
    });
    <?php endif; ?>
});
</script>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/menu/list.blade.php ENDPATH**/ ?>