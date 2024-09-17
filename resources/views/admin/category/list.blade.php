@extends('admin.layouts.master')
@push('links')
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/select2/css/select2.min.css') }}">
    <style type="text/css">
        span.select2-selection.select2-selection--single,
        span.selection {
            height: 37px !important;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            height: 37px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 37px !important;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 14px !important;
            font-size: .8125rem;
        }

        textarea {
            display: block;
            width: 100%;
            height: auto;
            resize: none;
            /* Disable the draggable resizer handle */
            overflow: hidden;
            /* Hide the scrollbar */
            min-height: 100px;
            /* Minimum height */
        }
    </style>




    @section('main')
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{ Str::title(str_replace('-', ' ', request()->segment(2))) }}</h4>
                    <button class="btn btn-success btn-label btn-sm" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="align-middle bx bx-slider-alt label-icon fs-16 me-2"></i>
                            </div>
                            <div class="flex-grow-1">
                                Filters
                            </div>
                        </div>
                    </button>

                    @can('add_district')
                        <div class="page-title-right">
                            <a onclick="create()" href="javascript:void(0);"
                                class="create btn-sm btn btn-primary btn-label rounded-pill">
                                <i class="align-middle bx bx-plus label-icon rounded-pill fs-16 me-2"></i>
                                Add {{ Str::title(str_replace('-', ' ', request()->segment(2))) }}
                            </a>
                        </div>
                    @endcan

                </div>
            </div>
        </div>
        <!-- end page title -->


        

            <div class="col-lg-8 col-sm-12 col-12">

                <div class="card">
                    <div class="card-body">

                     
                        <h1>Category List</h1>
                        @if ($categories->isNotEmpty())
                            @php
                                $controller = new App\Http\Controllers\Admin\CategoryController();
                                $controller->renderCategories($categories);
                            @endphp
                        @else
                            <p>No categories available.</p>
                        @endif
                 
                    </div>
                </div>



                @if ($categories->isNotEmpty())
                @php
                    $controller = new App\Http\Controllers\Admin\CategoryController();
                    $controller->renderCategoriesWithCheckbox($categories);
                @endphp
            @else
                <p>No categories available.</p>
            @endif
            @endsection


            @push('scripts')
                <script src="{{ asset('admin-assets/libs/select2/js/select2.min.js') }}" type="text/javascript"></script>


            @endpush
