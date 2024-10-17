
<?php $__env->startPush('links'); ?>

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
                        <h4 class="mt-4">Transaction Details of  <b> <?php echo e($name); ?></b></h4>
                <table class="table align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Doc. No</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $totalFees = 0;
                            $totalPayments = 0;
                        ?>
                        <?php $__currentLoopData = $data['transactions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($transaction['date']); ?></td>
                                <td><?php echo e($transaction['type']); ?></td>
                                <td><?php echo e($transaction['doc_no'] ?? 'N/A'); ?></td>

                                <td><?php echo e(number_format($transaction['amount'], 2)); ?></td>
                            </tr>

                            <?php if($transaction['type'] == 'debit'): ?>
                                <?php $totalFees += $transaction['amount']; ?>
                            <?php elseif($transaction['type'] == 'credit'): ?>
                                <?php $totalPayments += $transaction['amount']; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>

                <h4 class="mt-4">Summary</h4>
                <table class="table align-middle" style="width:100%">
                    <tr>
                        <th>Total Amount</th>
                        <td><?php echo e(number_format($totalFees, 2)); ?></td>
                    </tr>
                    <tr>
                        <th>Total Received Payments</th>
                        <td><?php echo e(number_format($totalPayments, 2)); ?></td>
                    </tr>
                    <tr>
                        <th>Total Fees (Pending)</th>
                        <td><?php echo e(number_format($totalFees - $totalPayments, 2)); ?></td>
                    </tr>
                </table>
                        
                        
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->



<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/Fees/view.blade.php ENDPATH**/ ?>