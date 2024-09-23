<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">
<head>

    <meta charset="utf-8" />
    <title><?php echo e(get_app_setting('title')); ?> | <?php echo e(Str::title(str_replace('-', ' ', request()->segment(2)))); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset(get_app_setting('favicon'))); ?>">

    <!-- Layout config Js -->
    <script src="<?php echo e(asset('admin-assets/js/layout.js')); ?>"></script>
    <!-- Bootstrap Css -->
    <link href="<?php echo e(asset('admin-assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?php echo e(asset('admin-assets/css/icons.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?php echo e(asset('admin-assets/css/app.min.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?php echo e(asset('admin-assets/css/custom.min.css')); ?>" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- auth-page wrapper -->
    <div class="py-5 auth-page-wrapper auth-bg-cover d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="overflow-hidden auth-page-content pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="overflow-hidden card card-bg-fill galaxy-border-none">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="p-4 p-lg-5 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="index.html" class="d-block">
                                                    <img alt="<?php echo e(get_app_setting('title')); ?>" src="<?php echo e(asset(get_app_setting('logo'))); ?>" alt="" height="18">
                                                </a>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-success"></i>
                                                </div>

                                                <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="pb-5 text-center carousel-inner text-white-50">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" The theme is really great with an amazing customer support."</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">" Great! Clean code, clean design, easy for customization. Thanks very much! "</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end carousel -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="p-4 p-lg-5">
                                        <div>
                                            <h5 class="text-primary">Welcome Back !</h5>
                                            <p class="text-muted">Sign in to continue to Velzon.</p>
                                        </div>

                                        <div class="mt-4">
                                           
                                            <?php echo e(html()->form('POST')->route('admin.login.post')->id('loginform')->open()); ?>


                                                <div class="mb-3 <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                                    <?php echo e(html()->label('Email')->for('email')->class('form-label')); ?>

                                                    <?php echo e(html()->email('email')->class('form-control')->id('email')->placeholder('Email')); ?>

                                                    <small class="text-danger"><?php echo e($errors->first('email')); ?></small>
                                                </div>


                                                <div class="mb-3 <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                                    <?php echo e(html()->label('Password')->for('password')->class('form-label')); ?>

                                                    <div class="mb-3 position-relative auth-pass-inputgroup">
                                                        <?php echo e(html()->password('password')->class('form-control password-input')->id('password-input')->placeholder('Password')); ?>

                                                        <button class="top-0 btn btn-link position-absolute end-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="align-middle ri-eye-fill"></i></button>
                                                        <small class="text-danger"><?php echo e($errors->first('password')); ?></small>
                                                    </div>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                                    <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                                </div>

                                                <div class="mt-4">
                                                    <?php echo e(html()->button('Sign In')
                                                    ->type('button')
                                                    ->class('loginBtn btn btn-success w-100')); ?>

                                                </div>

                                            <?php echo e(html()->form()->close()); ?>

                                        </div>

                                       
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer galaxy-border-none">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">&copy;
                               2023 <?php echo e(get_app_setting('title')); ?>. Crafted with <i class="mdi mdi-heart text-danger"></i> AR Technology
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JAVASCRIPT -->
    <script src="<?php echo e(asset('admin-assets/libs/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin-assets/libs/feather-icons/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin-assets/js/pages/plugins/lord-icon-2.1.0.js')); ?>"></script>
    <script src="<?php echo e(asset('admin-assets/js/plugins.js')); ?>"></script>
    <script src="<?php echo e(asset('admin-assets/js/pages/notifications.init.js')); ?>"></script>
    <script src="<?php echo e(asset('admin-assets/js/custom.js')); ?>"></script>
    
    <!-- password-addon init -->
    <script src="<?php echo e(asset('admin-assets/js/pages/password-addon.init.js')); ?>"></script>

    <?php if(Session::has('message')): ?>
        <script type="text/javascript">
            Toastify({
                text: "<?php echo e(Session::get('message')); ?>",
                duration: 3000,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
               className: "<?php echo e(Session::get('class')); ?>",

            }).showToast();
           // Command: toastr["<?php echo e(Session::get('class')); ?>"](" <?php echo e(Session::get('message')); ?>")
        </script>
    <?php endif; ?>

    <script>

        $('body').on('click', '.loginBtn', function(){
            var element = this;
            var button = new Button(element);
            button.process();
            clearErrors();
            var requestData,otpdata,data;
            formData = new FormData(document.querySelector('#loginform'));
            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url:'<?php echo e(route('admin.login.post')); ?>',
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
                        className: response.class,

                    }).showToast();
                    button.normal();
                    if(response.error == false){
                        window.location.href = "<?php echo e(route('admin.dashboard.index')); ?>";
                    }
                },
                error:function(error){
                    button.normal();
                    handleErrors(error.responseJSON);
                }
            });
        });

        
    </script>
</body>
</html><?php /**PATH C:\Users\HP\Desktop\New folder\payrolloriginal\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>