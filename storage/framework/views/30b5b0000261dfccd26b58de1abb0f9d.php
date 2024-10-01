
<?php $__env->startPush('links'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin-assets/libs/dropify/css/dropify.min.css')); ?>"> 
<?php $__env->stopPush(); ?>




<?php $__env->startSection('main'); ?>


<style>
    /* Style for invalid feedback messages */
.invalid-feedback {
    color: #dc3545; /* Bootstrap's red color for error messages */
    font-size: 0.875rem; /* Slightly smaller font size */
    display: block; /* Ensure the message is displayed as a block element */
    margin-top: 0.25rem; /* Space above the message */
}

/* Optional: Style for form control elements with errors */
.is-invalid {
    border-color: #dc3545; /* Red border for invalid fields */
    padding-right: calc(1.5em + .75rem); /* Space for the error icon if needed */
}

</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <?php echo e(html()->form('POST', route('admin.'.request()->segment(2).'.store'))->class('form-horizontal')->attribute('id', 'companyform')->attribute('files', true)->open()); ?>


    <div class="row my-1">
        <div class="col-lg-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-header bg-transparent border-primary">
                        <h5 class="my-0 text-primary">Company Information</h5>
                    </div>
                    <div class="card-body">
                       

                        <!-- Existing Fields -->
                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('Company Name')->for('company_name')); ?><span class="text-danger">*</span>
                                <?php echo e(html()->text('company_name')->class('form-control')->required()->placeholder('Company Name')->value(old('company_name'))); ?>

                                <?php $__errorArgs = ['company_name'];
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

                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('Email')->for('email')); ?><span class="text-danger">*</span>
                                <?php echo e(html()->email('email')->class('form-control')->required()->placeholder('Email')->value(old('email'))); ?>

                                <?php $__errorArgs = ['email'];
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
<?php
    $companyTypes = [
    'Private Limited Company (Pvt. Ltd.)',
    'Public Limited Company (Ltd.)',
    'One Person Company (OPC)',
    'Partnership Firm',
    'Limited Liability Partnership (LLP)',
    'Sole Proprietorship',
    'Section 8 Company (Non-Profit Organization)',
    'Joint Venture Company',
    'Public Sector Undertaking (PSU) or Government Company',
    'Holding and Subsidiary Companies',
];

?>
                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('Type')->for('type')); ?><span class="text-danger">*</span>
                                <?php echo e(html()->select('type', array_combine($companyTypes, $companyTypes), old('type'))
                                    ->class('form-control')
                                    ->required()
                                    ->id('company-type') 
                                    ->placeholder('Select Company Type')); ?>

                                <?php $__errorArgs = ['type'];
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

                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('Owner Name')->for('owner_name')); ?><span class="text-danger">*</span>
                                <?php echo e(html()->text('owner_name')->class('form-control')->required()->placeholder('Owner Name')->value(old('owner_name'))); ?>

                                <?php $__errorArgs = ['owner_name'];
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

                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('Contact No.')->for('contact_no')); ?><span class="text-danger">*</span>
                                <?php echo e(html()->text('contact_no')->class('form-control')->required()->placeholder('Contact No.')->value(old('contact_no'))); ?>

                                <?php $__errorArgs = ['contact_no'];
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

                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('State')->for('state')); ?><span class="text-danger">*</span>
                                <?php echo e(html()->select('state', ['' => 'Select State'] + $state->pluck('state_title', 'id')->toArray())->class('form-control')->value(old('state'))->required()->attribute('id', 'state')); ?>

                                <?php $__errorArgs = ['state'];
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

                        <div class="row">
                          
                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('District')->for('distt')); ?><span class="text-danger">*</span>
                                <select name="distt" id="distt" class="form-control" value="old('distt')" required>
                                    <option value="">Select District</option>
                                </select>
                                <?php $__errorArgs = ['distt'];
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
                            
                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('City')->for('city')); ?><span class="text-danger">*</span>
                                <select name="city" id="city" class="form-control" value="old('city')" required>
                                    <option value="">Select City</option>
                                </select>
                                <?php $__errorArgs = ['city'];
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

                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('Address')->for('address')); ?><span class="text-danger">*</span>
                                <?php echo e(html()->textarea('address')->class('form-control')->required()->placeholder('Address')->rows(2)->value(old('address'))); ?>

                                <?php $__errorArgs = ['address'];
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

                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('GST No.')->for('gst_no')); ?><span class="text-danger">*</span>
                                <?php echo e(html()->text('gst_no')->class('form-control')->required()->placeholder('GST No.')->value(old('gst_no'))); ?>

                                <?php $__errorArgs = ['gst_no'];
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

                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('PAN No.')->for('pan_no')); ?><span class="text-danger">*</span>
                                <?php echo e(html()->text('pan_no')->class('form-control')->required()->placeholder('PAN No.')->value(old('pan_no'))); ?>

                                <?php $__errorArgs = ['pan_no'];
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

                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('Aadhar No.')->for('aadhar_no')); ?><span class="text-danger">*</span>
                                <?php echo e(html()->text('aadhar_no')->class('form-control')->required()->placeholder('Aadhar No.')->value(old('aadhar_no'))); ?>

                                <?php $__errorArgs = ['aadhar_no'];
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

                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('Udyam No.')->for('udyam_no')); ?><span class="text-danger">*</span>
                                <?php echo e(html()->text('udyam_no')->class('form-control')->placeholder(' Udyam Registration number')->value(old('udyam_no'))); ?>

                                <?php $__errorArgs = ['udyam_no'];
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

                            <div class="col-md-6 mb-3 form-group" id="cin-field" style="display: none;">
                                <?php echo e(html()->label('CIN No.')->for('cin_no')); ?><span class="text-danger">*</span>
                                <?php echo e(html()->text('cin_no')->class('form-control')->placeholder(' digitCIN No.')->value(old('cin_no'))); ?>

                                <?php $__errorArgs = ['cin_no'];
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


                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('EPF No.')->for('epf_no')); ?><span class="text-danger">*</span>
                                <?php echo e(html()->text('epf_no')->class('form-control')->placeholder(' EPF No.')->value(old('epf_no'))); ?>

                                <?php $__errorArgs = ['epf_no'];
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

                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('ESIC No.')->for('esic_no')); ?><span class="text-danger">*</span>
                                <?php echo e(html()->text('esic_no')->class('form-control')->placeholder(' ESIC No.')->value(old('esic_no'))); ?>

                                <?php $__errorArgs = ['esic_no'];
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

                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('Bank Name')->for('bank_name')); ?><span class="text-danger">*</span>
                                <?php echo e(html()->text('bank_name')->class('form-control')->required()->placeholder('Bank Name')->value(old('bank_name'))); ?>

                                <?php $__errorArgs = ['bank_name'];
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

                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('Account No.')->for('ac_no')); ?><span class="text-danger">*</span>
                                <?php echo e(html()->text('ac_no')->class('form-control')->required()->placeholder('Enter your Account No.')->value(old('ac_no'))); ?>

                                <?php $__errorArgs = ['ac_no'];
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

                        <div class="row">
                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->label('IFSC Code')->for('ifs_code')); ?><span class="text-danger">*</span>
                                <?php echo e(html()->text('ifs_code')->class('form-control')->required()->placeholder('Enter ypur IFSC  Code')->value(old('ifs_code'))); ?>

                                <?php $__errorArgs = ['ifs_code'];
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

                            <div class="col-md-6 mb-3 form-group">
                                <?php echo e(html()->submit('Save')->class('btn btn-primary')); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php echo e(html()->form()->close()); ?>


                
    </div>
</div>
</div>
</div>




<?php $__env->stopSection(); ?>




<?php $__env->startPush('scripts'); ?>

<script>
    $(document).ready(function() {
        $('#state').change(function() {
            var stateId = $(this).val();
            console.log(stateId);
            if (stateId) {
                $.ajax({
                    url: '/get-districts/' + stateId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#distt').empty();
                        $('#distt').append('<option value="">Select District</option>');
                        $.each(data, function(key, value) {
                            $('#distt').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#distt').empty();
                $('#distt').append('<option value="">Select District</option>');
            }
        });
        //cities ajax
        $('#distt').change(function() {
            var districtId = $(this).val();
            
            if (districtId) {
                $.ajax({
                    url: '/get-cities/' + districtId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#city').empty();
                        $('#city').append('<option value="">Select City</option>');
                        $.each(data, function(key, value) {
                            $('#city').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#city').empty();
                $('#city').append('<option value="">Select City</option>');
            }
        });
    });
</script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        // Function to show/hide CIN No. field
        function toggleCinField() {
            var companyType = document.getElementById('company-type').value; // Get the selected value
            var cinField = document.getElementById('cin-field'); // Get the CIN No. field

            if (companyType === 'Limited Liability Partnership (LLP)') {
                cinField.style.display = 'none'; // Hide CIN No. field for LLP
            } else {
                cinField.style.display = 'block'; // Show CIN No. field for other types
            }
        }

        // Run the function on page load
        toggleCinField();

        // Run the function when the company type changes
        document.getElementById('company-type').addEventListener('change', function() {
            toggleCinField();
        });
    });
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/company/create.blade.php ENDPATH**/ ?>