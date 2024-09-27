
<?php $__env->startPush('links'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0"><?php echo e(Str::title(str_replace('-', ' ', request()->segment(2)))); ?></h4>
            <?php if (\Illuminate\Support\Facades\Blade::check('can', 'add_admin')): ?>
            <div class="page-title-right">
                <a href="<?php echo e(route('admin.'.request()->segment(2).'.index')); ?>" class="btn-sm btn btn-primary btn-label rounded-pill">
                    <i class="bx bx-plus label-icon align-middle rounded-pill fs-16 me-2"></i>
                    Upload <?php echo e(Str::title(str_replace('-', ' ', request()->segment(2)))); ?> Sheet
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
                <table class="table">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Select Month</th>
                            <th>Select Year</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($name); ?></td>
                            <td>
                                <select name="month[<?php echo e($id); ?>]" class="form-control" id="month_<?php echo e($id); ?>">
                                    <option value="">Select Month</option>
                                    <?php $__currentLoopData = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($month); ?>"><?php echo e($month); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td>
                                <select name="year[<?php echo e($id); ?>]" class="form-control" id="year_<?php echo e($id); ?>">
                                    <option value="">Select Year</option>
                                    <?php
                                        $currentYear = date('Y');
                                        $years = range($currentYear - 5, $currentYear);
                                    ?>
                                    <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td>
                                <form method="POST" action="<?php echo e(route('admin.salary.export', $id)); ?>" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-success">Export</button>
                                </form>
                                <a href="#" class="btn btn-info" onclick="return validateAndRedirect(<?php echo e($id); ?>);">
                                    View
                                </a>
                                
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--end col-->
</div><!--end row-->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script>
    function validateAndRedirect(companyId) {
        const monthSelect = document.querySelector(`select[name="month[${companyId}]"]`);
        const yearSelect = document.querySelector(`select[name="year[${companyId}]"]`);

        const selectedMonth = monthSelect.value;
        const selectedYear = yearSelect.value;

        // Check if month and year are selected
        if (!selectedMonth || !selectedYear) {
            alert('Please select both month and year before viewing salary details.');
            return false; // Stop redirect
        } else {
            // Redirect to the view salary page with selected month and year
            window.location.href = `<?php echo e(url('admin/salary/view')); ?>/${companyId}?month=${selectedMonth}&year=${selectedYear}`;
            return false; // Prevent default anchor behavior
        }
    }
</script>


<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/salary/allsalariesdetail.blade.php ENDPATH**/ ?>