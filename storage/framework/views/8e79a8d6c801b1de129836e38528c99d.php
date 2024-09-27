
<?php $__env->startPush('links'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>

<style>
    body {
    overflow: auto; 
}
.card {
    overflow: visible; 
}
.card-body {
    max-height: 400px; 
    overflow-y: auto; 
}

</style>

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
        <div class="mb-3">
            <a href="<?php echo e(route('admin.salary.export', ['company' => $salaryDetails->first()->company_id, 'month' => $salaryDetails->first()->month, 'year' => $salaryDetails->first()->year])); ?>" class="btn btn-primary">
                Export to Excel
            </a>
            
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Working Days</th>
                            <th>Basic</th>
                            <th>PF Basic</th>
                            <th>HRA</th>
                            <th>Conveyance</th>
                            <th>Other Allowance</th>
                            <th>Total Amount</th>
                            <th>EPF (Employee)</th>
                            <th>EPF (Employer)</th>
                            <th>EPS (Employer)</th>
                            <th>ESI (Employee)</th>
                            <th>ESI (Employer)</th>
                            <th>Total Deductions</th>
                            <th>Net Payable</th>
                            <th>Advance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $salaryDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($detail->employee->name); ?></td>
                            <td><?php echo e($detail->year); ?></td>
                            <td><?php echo e($detail->month); ?></td>
                            <td><?php echo e($detail->working_days); ?></td>
                            <td><?php echo e(number_format($detail->basic, 2)); ?></td>
                            <td><?php echo e(number_format($detail->pf_basic, 2)); ?></td>
                            <td><?php echo e(number_format($detail->hra, 2)); ?></td>
                            <td><?php echo e(number_format($detail->conveyance, 2)); ?></td>
                            <td><?php echo e(number_format($detail->other_allowance, 2)); ?></td>
                            <td><?php echo e(number_format($detail->total_amount, 2)); ?></td>
                            <td><?php echo e(number_format($detail->epf_employee, 2)); ?></td>
                            <td><?php echo e(number_format($detail->epf_employer, 2)); ?></td>
                            <td><?php echo e(number_format($detail->eps_employer, 2)); ?></td>
                            <td><?php echo e(number_format($detail->esi_employee, 2)); ?></td>
                            <td><?php echo e(number_format($detail->esi_employer, 2)); ?></td>
                            <td><?php echo e(number_format($detail->total_deductions, 2)); ?></td>
                            <td><?php echo e(number_format($detail->net_payable, 2)); ?></td>
                            <td><?php echo e(number_format($detail->advance, 2)); ?></td>
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

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/salary/singlecompanysalary.blade.php ENDPATH**/ ?>