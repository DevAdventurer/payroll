
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
                        <table class="table align-middle" style="width:100%">

                            <!-- Company Information -->
                            <tr>
                                <th width="25%">Company Name</th>
                                <td><?php echo e($admin->name); ?></td>
                                <th width="25%">Email</th>
                                <td><?php echo e($admin->email); ?></td>
                            </tr>
                        
                            <tr>
                                <th>Contact No.</th>
                                <td><?php echo e($admin->mobile); ?></td>
                                <th>Owner Name</th>
                                <td><?php echo e($adminDetail->owner_name); ?></td>
                            </tr>
                        
                            <tr>
                                <th>Address</th>
                                <td><?php echo e($adminDetail->address ?? 'N/A'); ?></td>
                                <th>City</th>
                                <td><?php echo e($city); ?></td>
                            </tr>
                            
                            <tr>
                                <th>District</th>
                                <td><?php echo e($district); ?></td>
                                <th>State</th>
                                <td><?php echo e($state); ?></td>
                            </tr>
                            
                        
                            <tr>
                                <th>GST No.</th>
                                <td><?php echo e($adminDetail->gst_no); ?></td>
                                <th>PAN No.</th>
                                <td><?php echo e($adminDetail->pan_no); ?></td>
                            </tr>
                        
                            <tr>
                                <th>Aadhar No.</th>
                                <td><?php echo e($adminDetail->aadhar_no); ?></td>
                                <th>Udyam No.</th>
                                <td><?php echo e($adminDetail->udyam_no); ?></td>
                            </tr>
                        
                            <tr>
                                <th>CIN No.</th>
                                <td><?php echo e($adminDetail->cin_no); ?></td>
                                <th>EPF No.</th>
                                <td><?php echo e($adminDetail->epf_no); ?></td>
                            </tr>
                        
                            <tr>
                                <th>ESIC No.</th>
                                <td><?php echo e($adminDetail->esic_no); ?></td>
                                <th>Bank Name</th>
                                <td><?php echo e($adminDetail->bank_name); ?></td>
                            </tr>
                        
                            <tr>
                                <th>Account No.</th>
                                <td><?php echo e($adminDetail->ac_no); ?></td>
                                <th>IFSC Code</th>
                                <td><?php echo e($adminDetail->ifs_code); ?></td>
                            </tr>
                        
                        </table>
                        
                        
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end row-->



<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>


<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/company/view.blade.php ENDPATH**/ ?>