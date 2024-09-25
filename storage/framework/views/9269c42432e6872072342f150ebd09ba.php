

<?php $__env->startPush('links'); ?>
<link rel="stylesheet" href="<?php echo e(asset('admin-assets/libs/dropify/css/dropify.min.css')); ?>">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>


<?php $__env->startSection('main'); ?>
<?php echo e(html()->form('POST', route('admin.site-setting.logo'))->class('form-horizontal')->attribute('id', 'appsetting')->attribute('files', true)->open()); ?>


<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18"><?php echo e(Str::title(str_replace('-', ' ', request()->segment(2)))); ?></h4>


            <?php if (\Illuminate\Support\Facades\Blade::check('can', 'logo_site_setting')): ?>
                <div class="page-title-right">
                    <div class="page-title-right">
                        <?php echo e(html()->submit('Update Setting')->class('btn-sm btn btn-primary rounded-pill')); ?>


                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<div class="row my-1">
    <div class="col-lg-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header bg-transparent border-primary">
                    <h5 class="my-0 text-primary">Site Details</h5>
                </div>

                <div class="card-body">

                    <div class="mb-3 form-group<?php echo e($errors->has('title') ? ' has-error' : ''); ?>">
                        <?php echo e(html()->label('Title')->for('title')); ?>

                        <?php echo e(html()->text('title', $logo->title)->class('form-control')->required()->placeholder('Title')); ?>

                        <small class="text-danger"><?php echo e($errors->first('title')); ?></small>
                    </div>

                    <div class="mb-3 form-group<?php echo e($errors->has('description') ? ' has-error' : ''); ?>">
                        <?php echo e(html()->label('Description')->for('description')); ?>

                        <?php echo e(html()->textarea('description', $logo->description)->class('form-control')->placeholder('Description')->rows(5)); ?>

                        <small class="text-danger"><?php echo e($errors->first('description')); ?></small>
                    </div>

                    <div class="media-area" file-name="logo">
                        <div class="media-file-value">
                            <?php if($logo->siteLogo): ?>
                                <input type="hidden" name="logo[]" value="<?php echo e($logo->logo); ?>" class="fileid<?php echo e($logo->logo); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="media-file">
                            <?php if($logo->siteLogo): ?>
                                <div class="file-container d-inline-block fileid<?php echo e($logo->logo); ?>">
                                    <span data-id="<?php echo e($logo->logo); ?>" class="remove-file">✕</span>
                                    <img class="w-100 d-block img-thumbnail" src="<?php echo e(asset($logo->siteLogo->file)); ?>" alt="<?php echo e($logo->title); ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                        <p><br></p>
                        <a class="text-secondary select-mediatype" href="javascript:void(0);" mediatype='single' onclick="loadMediaFiles($(this))">Select Logo</a>
                    </div>

                    <div class="media-area" file-name="favicon">
                        <div class="media-file-value">
                            <?php if($logo->siteFavicon): ?>
                                <input type="hidden" name="favicon[]" value="<?php echo e($logo->favicon); ?>" class="fileid<?php echo e($logo->favicon); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="media-file">
                            <?php if($logo->siteFavicon): ?>
                                <div class="file-container d-inline-block fileid<?php echo e($logo->favicon); ?>">
                                    <span data-id="<?php echo e($logo->favicon); ?>" class="remove-file">✕</span>
                                    <img class="w-100 d-block img-thumbnail" src="<?php echo e(asset($logo->siteFavicon->file)); ?>" alt="<?php echo e($logo->title); ?>">
                                </div>
                            <?php endif; ?>
                        </div>
                        <p><br></p>
                        <a class="text-secondary select-mediatype" href="javascript:void(0);" mediatype='single' onclick="loadMediaFiles($(this))">Select Favicon</a>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="col-lg-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-content">
                <div class="card-header bg-transparent border-primary">
                    <h5 class="my-0 text-primary">Site Information</h5>
                </div>

                <div class="card-body">
                    <div class="mb-3 form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                        <?php echo e(html()->label('Email')->for('email')); ?>

                        <?php echo e(html()->email('email', @$logo->email)->class('form-control')->placeholder('Email')); ?>

                        <small class="text-danger"><?php echo e($errors->first('email')); ?></small>
                    </div>

                    <div class="mb-3 form-group<?php echo e($errors->has('contact_no') ? ' has-error' : ''); ?>">
                        <?php echo e(html()->label('Contact No.')->for('contact_no')); ?>

                        <?php echo e(html()->text('contact_no', @$logo->contact_no)->class('form-control')->placeholder('Contact No.')); ?>

                        <small class="text-danger"><?php echo e($errors->first('contact_no')); ?></small>
                    </div>

                    <div class="mb-3 form-group<?php echo e($errors->has('country') ? ' has-error' : ''); ?>">
                        <?php echo e(html()->label('Country')->for('country')); ?>

                        <?php echo e(html()->text('country', @$logo->country)->class('form-control')->required()->placeholder('Country')); ?>

                        <small class="text-danger"><?php echo e($errors->first('country')); ?></small>
                    </div>

                    <div class="mb-3 form-group<?php echo e($errors->has('state') ? ' has-error' : ''); ?>">
                        <?php echo e(html()->label('State')->for('state')); ?>

                        <?php echo e(html()->text('state', @$logo->state)->class('form-control')->required()->placeholder('State')); ?>

                        <small class="text-danger"><?php echo e($errors->first('state')); ?></small>
                    </div>

                    <div class="mb-3 form-group<?php echo e($errors->has('city') ? ' has-error' : ''); ?>">
                        <?php echo e(html()->label('City')->for('city')); ?>

                        <?php echo e(html()->text('city', @$logo->city)->class('form-control')->required()->placeholder('City')); ?>

                        <small class="text-danger"><?php echo e($errors->first('city')); ?></small>
                    </div>

                    <div class="mb-3 form-group<?php echo e($errors->has('address') ? ' has-error' : ''); ?>">
                        <?php echo e(html()->label('Address')->for('address')); ?>

                        <?php echo e(html()->textarea('address', @$logo->address)->class('form-control')->placeholder('Address')->rows(5)); ?>

                        <small class="text-danger"><?php echo e($errors->first('address')); ?></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo e(html()->form()->close()); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('admin-assets/libs/dropify/js/dropify.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('admin-assets/libs/dropify/dropify.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script type="text/javascript">
    function appSettingUpdate(element){
        var button = new Button(element);
        button.process();
        clearErrors();

        var formData = new FormData(document.querySelector('#appsetting'));


        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url:'<?php echo e(route('admin.'.request()->segment(2).'.logo')); ?>',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success:function(response){
                Toastify({
                    text: response.message,
                    duration: 3000,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    className: "success",

                }).showToast();

                button.normal();
                document.querySelector('#appsetting').reset();
            },
            error:function(error){
                Toastify({
                    text: response.message,
                    duration: 3000,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    className: "error",

                }).showToast();
                button.normal();
                handleErrors(error.responseJSON);

            }
        });
    }


    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/site-setting/index.blade.php ENDPATH**/ ?>