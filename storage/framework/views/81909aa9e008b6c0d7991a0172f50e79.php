
<?php $__env->startPush('links'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0"><?php echo e(Str::title(str_replace('-', ' ', request()->segment(2)))); ?></h4>
            <?php if (\Illuminate\Support\Facades\Blade::check('can', 'add_admin')): ?>
            <div class="page-title-right">
                <a href="<?php echo e(route('admin.'.request()->segment(2).'.create')); ?>" class="btn-sm btn btn-primary btn-label rounded-pill">
                    <i class="bx bx-plus label-icon align-middle rounded-pill fs-16 me-2"></i>
                    Add/Update <?php echo e(Str::title(str_replace('-', ' ', request()->segment(2)))); ?>

                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <table id="datatable" class="datatable table table-bordered nowrap align-middle" style="width:100%">
                    <thead class="gridjs-thead">
                        <tr>
                            <th style="width:12px">Si</th>
                            <th>Skill Level</th>
                            <th>Wages</th>
                            <th>Status</th>
                            <!-- Removed the Action column -->
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div><!--end col-->
</div><!--end row-->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script type="text/javascript">
$(document).ready(function() {
    var table2 = $('#datatable').DataTable({
        "processing": true,
        "serverSide": true,
        'ajax': {
            'url': '<?php echo e(route('admin.'.request()->segment(2).'.index')); ?>',
            'data': function(d) {
                d._token = '<?php echo e(csrf_token()); ?>';
                d._method = 'PATCH';
            }
        },
        "columns": [
            { "data": "sn" },
            { "data": "name" },
            { "data": "amount" },
            { "data": "status" },
            // Removed the Action column from here as well
        ]
    });
    console.log(table2);
});
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/minimum_wages/list.blade.php ENDPATH**/ ?>