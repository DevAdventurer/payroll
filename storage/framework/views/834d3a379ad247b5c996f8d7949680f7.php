
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
.required-label .text-danger {
    font-weight: bold;
    color: red; /* Change the color as needed */
}

</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <?php echo e(html()->form('POST', route('admin.'.request()->segment(2).'.store'))->class('form-horizontal')->attribute('id', 'employeeForm')->attribute('files', true)->open()); ?>


<div class="row my-1">
    <div class="col-lg-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header bg-transparent border-primary">
                    <h5 class="my-0 text-primary">Employee Information</h5>
                </div>
                <div class="card-body">

                    <!-- Role Selection -->
                    <div class="row">
                        <div class="col-md-6 mb-3 form-group">
                            <?php echo e(html()->label('Role <span class="text-danger">*</span>')->for('role_id')->class('required-label')); ?>

                            <?php echo e(html()->select('role_id', $roles->pluck('name', 'id'))->class('form-control')->required()->placeholder('Select Role')->value(old('role_id'))); ?>

                            <?php $__errorArgs = ['role_id'];
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
                            <?php echo e(html()->label('Company <span class="text-danger">*</span>')->for('company_id')->class('required-label')); ?>

                            <?php echo e(html()->select('company_id', $companies->pluck('name', 'id'))->class('form-control')->required()->placeholder('Select Company')->value(old('company_id'))); ?>

                            <?php $__errorArgs = ['company_id'];
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

                    <!-- Employee Name -->
                    <div class="row">
                        <div class="col-md-6 mb-3 form-group">
                            <?php echo e(html()->label('Employee Name <span class="text-danger">*</span>')->for('employee_name')->class('required-label')); ?>

                            <?php echo e(html()->text('employee_name')->class('form-control')->required()->placeholder('Employee Name')->value(old('employee_name'))); ?>

                            <?php $__errorArgs = ['employee_name'];
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

                        <!-- Father or Husband Name -->
                        <div class="col-md-6 mb-3 form-group">
                            <?php echo e(html()->label('Father or Husband Name <span class="text-danger">*</span>')->for('father_or_husband_name')->class('required-label')); ?>

                            <?php echo e(html()->text('father_or_husband_name')->class('form-control')->required()->placeholder('Father or Husband Name')->value(old('father_or_husband_name'))); ?>

                            <?php $__errorArgs = ['father_or_husband_name'];
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

                    <!-- Email Field -->
                    <div class="row">
                        <div class="col-md-6 mb-3 form-group">
                            <?php echo e(html()->label('Email <span class="text-danger">*</span>')->for('email')->class('required-label')); ?>

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
                        <div class="col-md-6 mb-3 form-group">
                            <?php echo e(html()->label('Skill <span class="text-danger">*</span>')->for('skill')->class('required-label')); ?>

                            <?php echo e(html()->select('skill') 
                                ->class('form-control')->placeholder('Select Skill')
                                ->required()
                                ->options($skills->pluck('skill_level', 'skill_level')->toArray())); ?>

                            <?php $__errorArgs = ['skill'];
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

                    <!-- Gender and Aadhar No -->
                    <div class="row">
                        <div class="col-md-6 mb-3 form-group">
                            <?php echo e(html()->label('Gender <span class="text-danger">*</span>')->for('gender')->class('required-label')); ?>

                            <?php echo e(html()->select('gender', ['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'])->class('form-control')->required()->placeholder('Select Gender')->value(old('gender'))); ?>

                            <?php $__errorArgs = ['gender'];
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
                            <?php echo e(html()->label('Aadhar No <span class="text-danger">*</span>')->for('aadhar_no')->class('required-label')); ?>

                            <?php echo e(html()->text('aadhar_no')->class('form-control')->required()->placeholder('Aadhar No')->value(old('aadhar_no'))); ?>

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

                    <!-- Mobile and Bank Account No -->
                    <div class="row">
                        <div class="col-md-6 mb-3 form-group">
                            <?php echo e(html()->label('Mobile No <span class="text-danger">*</span>')->for('mobile')->class('required-label')); ?>

                            <?php echo e(html()->text('mobile')->class('form-control')->required()->placeholder('Mobile No')->value(old('mobile'))); ?>

                            <?php $__errorArgs = ['mobile'];
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
                            <?php echo e(html()->label('Bank Account No <span class="text-danger">*</span>')->for('bank_account_no')->class('required-label')); ?>

                            <?php echo e(html()->text('bank_account_no')->class('form-control')->required()->placeholder('Bank Account No')->value(old('bank_account_no'))); ?>

                            <?php $__errorArgs = ['bank_account_no'];
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

                    <!-- Bank Name and IFSC Code -->
                    <div class="row">
                        <div class="col-md-6 mb-3 form-group">
                            <?php echo e(html()->label('Bank Name <span class="text-danger">*</span>')->for('bank_name')->class('required-label')); ?>

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
                            <?php echo e(html()->label('IFSC Code <span class="text-danger">*</span>')->for('ifsc_code')->class('required-label')); ?>

                            <?php echo e(html()->text('ifsc_code')->class('form-control')->required()->placeholder('IFSC Code')->value(old('ifsc_code'))); ?>

                            <?php $__errorArgs = ['ifsc_code'];
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

                    <!-- ESIC No and PF No -->
                    <div class="row">
                        <div class="col-md-6 mb-3 form-group">
                            <?php echo e(html()->label('ESIC No')->for('esic_no')); ?>

                            <?php echo e(html()->text('esic_no')->class('form-control')->placeholder('ESIC No')->value(old('esic_no'))); ?>

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

                        <div class="col-md-6 mb-3 form-group">
                            <?php echo e(html()->label('PF No')->for('pf_no')); ?>

                            <?php echo e(html()->text('pf_no')->class('form-control')->placeholder('PF No')->value(old('pf_no'))); ?>

                            <?php $__errorArgs = ['pf_no'];
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

                    <!-- Date of Birth, Joining, Relieving -->
                    <div class="row">
                        <div class="col-md-4 mb-3 form-group">
                            <?php echo e(html()->label('Date of Birth <span class="text-danger">*</span>')->for('date_of_birth')->class('required-label')); ?>

                            <?php echo e(html()->date('date_of_birth')->class('form-control')->required()->value(old('date_of_birth'))); ?>

                            <?php $__errorArgs = ['date_of_birth'];
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

                        <div class="col-md-4 mb-3 form-group">
                            <?php echo e(html()->label('Date of Joining <span class="text-danger">*</span>')->for('date_of_joining')->class('required-label')); ?>

                            <?php echo e(html()->date('date_of_joining')->class('form-control')->required()->value(old('date_of_joining'))); ?>

                            <?php $__errorArgs = ['date_of_joining'];
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

                    <!-- State, District, City -->
                    <div class="row">
                        <div class="col-md-4 mb-3 form-group">
                            <?php echo e(html()->label('State <span class="text-danger">*</span>')->for('state')->class('required-label')); ?>

                            <?php echo e(html()->select('state', ['' => 'Select State'] + $state->pluck('state_title', 'id')->toArray())->class('form-control')->required()->attribute('id', 'state')); ?>

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

                        <div class="col-md-4 mb-3 form-group">
                            <?php echo e(html()->label('District <span class="text-danger">*</span>')->for('distt')->class('required-label')); ?>

                            <select name="distt" id="distt" class="form-control" required>
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

                        <div class="col-md-4 mb-3 form-group">
                            <?php echo e(html()->label('City <span class="text-danger">*</span>')->for('city')->class('required-label')); ?>

                            <select name="city" id="city" class="form-control" required>
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

                    <!-- Location -->
                    <div class="row">
                        <div class="col-md-6 mb-3 form-group">
                            <?php echo e(html()->label('Location <span class="text-danger">*</span>')->for('location')->class('required-label')); ?>

                            <?php echo e(html()->text('location')->class('form-control')->required()->placeholder('Location')->value(old('location'))); ?>

                            <?php $__errorArgs = ['location'];
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

                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-md-12 mb-3 form-group">
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/employee/create.blade.php ENDPATH**/ ?>