
<?php $__env->startPush('links'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin-assets/libs/dropify/css/dropify.min.css')); ?>"> 
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

                <?php echo e(html()->form('PUT', route('admin.' . request()->segment(2) . '.update', $employee->id))
                ->class('form-horizontal')
                ->attribute('id', 'employeeForm')
                ->attribute('files', true)
                ->open()); ?>

            
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
                                            <?php echo e(html()->label('Role')->for('role_id')); ?>

                                            <?php echo e(html()->select('role_id', $roles->pluck('name', 'id'))
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Select Role')
                                                ->value(old('role_id', $employee->role_id))); ?>

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
                                            <?php echo e(html()->label('Company')->for('company_id')); ?>

                                            <?php echo e(html()->select('company_id', $companies->pluck('name', 'id'))
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Select Company')
                                                ->value(old('company_id', $employee->company_id))); ?>

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
                                            <?php echo e(html()->label('Employee Name')->for('employee_name')); ?>

                                            <?php echo e(html()->text('employee_name')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Employee Name')
                                                ->value(old('employee_name', $employee->name))); ?>

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
                                            <?php echo e(html()->label('Father or Husband Name')->for('father_or_husband_name')); ?>

                                            <?php echo e(html()->text('father_or_husband_name')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Father or Husband Name')
                                                ->value(old('father_or_husband_name', $employee->employeedetail->father_or_husband_name))); ?>

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
                                            <?php echo e(html()->label('Email')->for('email')); ?>

                                            <?php echo e(html()->email('email')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Email')
                                                ->value(old('email', $employee->email))); ?>

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
            
                                    <!-- Gender and Aadhar No -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            <?php echo e(html()->label('Gender')->for('gender')); ?>

                                            <?php echo e(html()->select('gender', ['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'])
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Select Gender')
                                                ->value(old('gender', $employee->gender))); ?>

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
                                            <?php echo e(html()->label('Aadhar No')->for('aadhar_no')); ?>

                                            <?php echo e(html()->text('aadhar_no')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Aadhar No')
                                                ->value(old('aadhar_no', $employee->employeedetail->aadhar_no))); ?>

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
                                            <?php echo e(html()->label('Mobile No')->for('mobile')); ?>

                                            <?php echo e(html()->text('mobile')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Mobile No')
                                                ->value(old('mobile', $employee->mobile))); ?>

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
                                            <?php echo e(html()->label('Bank Account No')->for('bank_account_no')); ?>

                                            <?php echo e(html()->text('bank_account_no')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Bank Account No')
                                                ->value(old('bank_account_no', $employee->employeedetail->ac_no))); ?>

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
                                            <?php echo e(html()->label('Bank Name')->for('bank_name')); ?>

                                            <?php echo e(html()->text('bank_name')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Bank Name')
                                                ->value(old('bank_name', $employee->employeedetail->bank_name))); ?>

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
                                            <?php echo e(html()->label('IFSC Code')->for('ifsc_code')); ?>

                                            <?php echo e(html()->text('ifsc_code')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('IFSC Code')
                                                ->value(old('ifsc_code', $employee->employeedetail->ifs_code))); ?>

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

                                            <?php echo e(html()->text('esic_no')
                                                ->class('form-control')
                                                ->placeholder('ESIC No')
                                                ->value(old('esic_no', $employee->employeedetail->esic_no))); ?>

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

                                            <?php echo e(html()->text('pf_no')
                                                ->class('form-control')
                                                ->placeholder('PF No')
                                                ->value(old('pf_no', $employee->employeedetail->epf_no))); ?>

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
                                            <?php echo e(html()->label('Date of Birth')->for('date_of_birth')); ?>

                                            <?php echo e(html()->date('date_of_birth')
                                                ->class('form-control')
                                                ->required()
                                                ->value(old('date_of_birth', $employee->date_of_birth))); ?>

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
                                            <?php echo e(html()->label('Date of Joining')->for('date_of_joining')); ?>

                                            <?php echo e(html()->date('date_of_joining')
                                                ->class('form-control')
                                                ->required()
                                                ->value(old('date_of_joining', $employee->employeedetail->date_of_joining))); ?>

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
            
                                        <div class="col-md-4 mb-3 form-group">
                                            <?php echo e(html()->label('Date of Relieving')->for('date_of_relieving')); ?>

                                            <?php echo e(html()->date('date_of_relieving')
                                                ->class('form-control')
                                                ->placeholder('Optional')
                                                ->value(old('date_of_relieving', $employee->employeedetail->date_of_relieving))); ?>

                                            <?php $__errorArgs = ['date_of_relieving'];
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
                                        <div class="col-md-4 mb-3 form-group">
                                            <?php echo e(html()->label('State')->for('state_id')); ?>

                                            <?php echo e(html()->select('state', $states, old('state_id', $employee->employeedetail->state_id ?? ''))
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Select State')); ?>

                                            <?php $__errorArgs = ['state_id'];
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
                                            <?php echo e(html()->label('District')->for('district_id')); ?>

                                            <?php echo e(html()->select('distt',  ['' => 'Select District'] + $district, old('district_id', $employee->employeedetail->district_id ?? ''))
                                                ->class('form-control')
                                                ->required()
                                                ->attribute('id', 'district')); ?>

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
                                            <?php echo e(html()->label('City')->for('city')); ?>

                                            <?php echo e(html()->select('city', ['' => 'Select City']+ $city, old('city_id', $employee->employeedetail->city_id ?? ''))
                                                ->class('form-control')
                                                ->required()
                                                ->attribute('id', 'city')); ?>

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
                                    <!-- Location and Nationality -->
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            <?php echo e(html()->label('Location')->for('location')); ?>

                                            <?php echo e(html()->text('location')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Location')
                                                ->value(old('location', $employee->employeedetail->location))); ?>

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
            
                                        <div class="col-md-6 mb-3 form-group">
                                            <?php echo e(html()->label('Nationality')->for('nationality')); ?>

                                            <?php echo e(html()->text('nationality')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Nationality')
                                                ->value(old('nationality', $employee->employeedetail->nationality))); ?>

                                            <?php $__errorArgs = ['nationality'];
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
                                            <?php echo e(html()->submit('Update')->class('btn btn-primary')); ?>

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
<script src="<?php echo e(asset('admin-assets/libs/dropify/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('admin-assets/libs/dropify/dropify.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $('#state').change(function() {
            var stateId = $(this).val();
            if (stateId) {
                $.ajax({
                    url: '/get-districts/' + stateId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#district').empty();
                        $('#district').append('<option value="">Select District</option>');
                        $.each(data, function(key, value) {
                            $('#district').append('<option value="' + key + '">' + value + '</option>');
                        });
                        // Clear city options when state changes
                        $('#city').empty();
                        $('#city').append('<option value="">Select City</option>');
                    }
                });
            } else {
                $('#district').empty();
                $('#district').append('<option value="">Select District</option>');
                $('#city').empty();
                $('#city').append('<option value="">Select City</option>');
            }
        });
    
        $('#district').change(function() {
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
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/employee/edit.blade.php ENDPATH**/ ?>