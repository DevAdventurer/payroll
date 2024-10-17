
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

                <?php echo e(html()->form('PUT', route('admin.'.request()->segment(2).'.update', $company->id))->attribute('files', true)->open()); ?>


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
                                            <?php echo e(html()->text('company_name')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Company Name')
                                                ->value(old('company_name', $company->name))); ?>

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
                                            <?php echo e(html()->email('email')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Email')
                                                ->value(old('email', $company->email))); ?>

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
        <?php echo e(html()->select('type', array_combine($companyTypes, $companyTypes), old('type', $company->details->type ?? ''))
            ->class('form-control')
            ->required() ->id('company-type')
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
                                            <?php echo e(html()->text('owner_name')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Owner Name')
                                                ->value(old('owner_name', $company->details->owner_name ?? ''))); ?>

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
                                            <?php echo e(html()->text('contact_no')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Contact No.')
                                                ->value(old('contact_no', $company->mobile ?? ''))); ?>

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
                                            <?php echo e(html()->label('State')->for('state_id')); ?><span class="text-danger">*</span>
                                            <?php echo e(html()->select('state', $states, old('state_id', $company->details->state_id ?? ''))
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
                                        
                                        
                                    </div>
                
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            <?php echo e(html()->label('District')->for('district_id')); ?><span class="text-danger">*</span>
                                            <?php echo e(html()->select('distt',  ['' => 'Select District'] + $district, old('district_id', $company->details->district_id ?? ''))
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
                
                                        <div class="col-md-6 mb-3 form-group">
                                            <?php echo e(html()->label('City')->for('city')); ?><span class="text-danger">*</span>
                                            <?php echo e(html()->select('city', ['' => 'Select City']+ $city, old('city_id', $company->details->city_id ?? ''))
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
                
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            <?php echo e(html()->label('Address')->for('address')); ?><span class="text-danger">*</span>
                                            <?php echo e(html()->textarea('address')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Address')
                                                ->rows(2)
                                                ->value(old('address', $company->details->address ?? ''))); ?>

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
                                            <?php echo e(html()->text('gst_no')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('GST No.')
                                                ->value(old('gst_no', $company->details->gst_no ?? ''))); ?>

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
                                            <?php echo e(html()->text('pan_no')->class('form-control')->required()->placeholder('PAN No.')->value(old('pan_no',$company->details->pan_no ?? ''))); ?>

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
                                            <?php echo e(html()->text('aadhar_no')->class('form-control')->required()->placeholder('Aadhar No.')->value(old('aadhar_no',$company->details->aadhar_no ?? ''))); ?>

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
                                            <?php echo e(html()->text('udyam_no')->class('form-control')->placeholder('Enter your 19 digit Udyam Registration number')->value(old('udyam_no',$company->details->udyam_no ?? ''))); ?>

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
            
                                        <div id="cin-field" class="col-md-6 mb-3 form-group" style="display: none;">
                                            <?php echo e(html()->label('CIN No.')->for('cin_no')); ?><span class="text-danger">*</span>
                                            <?php echo e(html()->text('cin_no')
                                                ->class('form-control')
                                                ->placeholder('Enter your 21 digit CIN No.')
                                                ->value(old('cin_no', $company->details->cin_no ?? ''))); ?>

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
                                            <?php echo e(html()->text('epf_no')->class('form-control')->placeholder('Enter ypur 15 digit EPF No.')->value(old('epf_no',$company->details->epf_no ?? ''))); ?>

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
                                            <?php echo e(html()->text('esic_no')->class('form-control')->placeholder('Enter ypur 17 digit ESIC No.')->value(old('esic_no',$company->details->esic_no ?? ''))); ?>

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
                                    <!-- Other fields -->
                
                                    <div class="row">
                                        <div class="col-md-6 mb-3 form-group">
                                            <?php echo e(html()->label('Bank Name')->for('bank_name')); ?><span class="text-danger">*</span>
                                            <?php echo e(html()->text('bank_name')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Bank Name')
                                                ->value(old('bank_name', $company->details->bank_name ?? ''))); ?>

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
                                            <?php echo e(html()->text('ac_no')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('Account No.')
                                                ->value(old('ac_no', $company->details->ac_no ?? ''))); ?>

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
                                            <?php echo e(html()->label('IFS Code')->for('ifs_code')); ?><span class="text-danger">*</span>
                                            <?php echo e(html()->text('ifs_code')
                                                ->class('form-control')
                                                ->required()
                                                ->placeholder('IFS Code')
                                                ->value(old('ifs_code', $company->details->ifs_code ?? ''))); ?>

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
                <hr>
                <!-- New Field: Select Multiple Services -->
                <div class="row mb-3">
                    <div class="col-md-6 form-group">
                        <?php echo e(html()->label('Select Services')->for('services')); ?>

<?php echo e(html()->select('services[]', $services->pluck('name', 'id')->toArray(), $company->services)
    ->class('form-control select2 js-example-basic-multiple-limit')
    ->required()
    ->multiple()); ?>


                        <?php $__errorArgs = ['services'];
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
<script>
$(".js-example-basic-multiple-limit").select2({
placeholder: "Select Services",
allowClear: true
});
</script>
                    <!-- New Field: Monthly Charges -->
                    <div class="col-md-6 form-group">
                        <?php echo e(html()->label('Monthly Charges (₹)')->for('monthly_charges')); ?><span class="text-danger">*</span>
                        <?php echo e(html()->number('monthly_charges')
                            ->class('form-control')
                            ->required()
                            ->placeholder('Enter monthly charges')
                            ->value(old('monthly_charges', $company->monthly_fees ?? ''))
                            ->attribute('min', 1)); ?>

                        <?php $__errorArgs = ['monthly_charges'];
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
                                        <div class="col-md-6 mb-3 form-group">
                                            <?php echo e(html()->submit('Update Company')->class('btn btn-soft-secondary waves-effect waves-light')); ?>

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
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        // Function to show/hide CIN No. field based on company type
        function toggleCinField() {
            var companyType = document.getElementById('company-type').value;
            var cinField = document.getElementById('cin-field');
            
            if (companyType === 'Limited Liability Partnership (LLP)') {
                cinField.style.display = 'none'; // Hide CIN No. field
            } else {
                cinField.style.display = 'block'; // Show CIN No. field
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
<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/company/edit.blade.php ENDPATH**/ ?>