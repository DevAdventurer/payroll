
<?php $__env->startPush('links'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin-assets/libs/dropify/css/dropify.min.css')); ?>"> 
<?php $__env->stopPush(); ?>

<?php $__env->startSection('main'); ?>

<style>
    /* Style for invalid feedback messages */
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        display: block;
        margin-top: 0.25rem;
    }

    /* Optional: Style for form control elements with errors */
    .is-invalid {
        border-color: #dc3545;
        padding-right: calc(1.5em + .75rem);
    }

    /* Ensure table stays responsive */
    .table-responsive {
        overflow-x: auto;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <!-- Title Outside the Form -->
                    <div class="row my-1">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary">Upload Salary Sheet</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Starts Here -->
                    <?php echo e(html()->form('POST', route('admin.'.request()->segment(2).'.import'))
                        ->class('form-horizontal')
                        ->attribute('id', 'wageform')
                        ->attribute('enctype', 'multipart/form-data')
                        ->open()); ?>


                    <div class="row my-1">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3 form-group">
                                                <?php echo e(html()->label('Upload Company Detail Excel Sheet')->for('company_excel')); ?>

                                                <?php echo e(html()->file('company_excel')
                                                    ->class('form-control dropify')
                                                    ->required()
                                                    ->accept('.xlsx, .xls, .csv')); ?>

                                                <?php $__errorArgs = ['company_excel'];
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

                                        <!-- Save Button -->
                                        <div class="row">
                                            <div class="col-md-12 mb-3 form-group text-end">
                                                <?php echo e(html()->submit('Upload')->class('btn btn-primary')); ?>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php echo e(html()->form()->close()); ?>


                    <!-- Temporary Company Details Table -->
                    <div class="row my-1">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header bg-transparent border-primary">
                                    <h5 class="my-0 text-primary">Temporary Company Details</h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Company Name</th>
                                                    <th>Type</th>
                                                    <th>Owner Name</th>
                                                    <th>Contact No</th>
                                                    <th>City</th>
                                                    <th>District</th>
                                                    <th>State</th>
                                                    <th>Address</th>
                                                    <th>GST No</th>
                                                    <th>PAN No</th>
                                                    <th>Aadhar No</th>
                                                    <th>Udyam No</th>
                                                    <th>CIN No</th>
                                                    <th>EPF No</th>
                                                    <th>ESIC No</th>
                                                    <th>Bank Name</th>
                                                    <th>Account No</th>
                                                    <th>IFSC Code</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $tempCompanies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td><?php echo e($company->company_name); ?></td>
                                                    <td><?php echo e($company->type); ?></td>
                                                    <td><?php echo e($company->owner_name); ?></td>
                                                    <td><?php echo e($company->contact_no); ?></td>
                                                    <td><?php echo e($company->city); ?></td>
                                                    <td><?php echo e($company->distt); ?></td>
                                                    <td><?php echo e($company->state); ?></td>
                                                    <td><?php echo e($company->address); ?></td>
                                                    <td><?php echo e($company->gst_no); ?></td>
                                                    <td><?php echo e($company->pan_no); ?></td>
                                                    <td><?php echo e($company->aadhar_no); ?></td>
                                                    <td><?php echo e($company->udyam_no); ?></td>
                                                    <td><?php echo e($company->cin_no); ?></td>
                                                    <td><?php echo e($company->epf_no); ?></td>
                                                    <td><?php echo e($company->esic_no); ?></td>
                                                    <td><?php echo e($company->bank_name); ?></td>
                                                    <td><?php echo e($company->ac_no); ?></td>
                                                    <td><?php echo e($company->ifs_code); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary" id="verifyInsertBtn">Verify and Insert</button>
                                    </div>

                                    <!-- Pagination (if applicable) -->
                                    <?php echo e($tempCompanies->links()); ?>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('admin-assets/libs/dropify/js/dropify.min.js')); ?>"></script>
<script>
    $('.dropify').dropify();
</script>
<script>
    $('#verifyInsertBtn').on('click', function () {
        // Send AJAX request to verify and insert companies
        $.ajax({
            url: '<?php echo e(route("admin.company.verify")); ?>', // Update with your route
            method: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>'
            },
            beforeSend: function () {
                // Optional: Add a loading indicator
                $('#verifyInsertBtn').text('Processing...').attr('disabled', true);
            },
            success: function (response) {
                // Handle the success response
                if (response.success) {
                    alert(response.message);
                } else {
                    alert('Some companies already exist: ' + response.existing_companies.join(', '));
                }
                location.reload();
            },
            error: function (xhr) {
                // Handle the error response
                alert('An error occurred. Please try again.');
            },
            complete: function () {
                // Reset the button after the request completes
                $('#verifyInsertBtn').text('Verify and Insert').attr('disabled', false);
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/company/import.blade.php ENDPATH**/ ?>