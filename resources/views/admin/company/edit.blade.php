@extends('admin.layouts.master')
@push('links')
    <link rel="stylesheet" href="{{ asset('admin-assets/libs/select2/css/select2.min.css') }}">
    <style type="text/css">
        span.select2-selection.select2-selection--single,
        span.selection {
            height: 37px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            height: 37px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 37px;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-left: 14px;
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
@endpush




@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ Str::title(str_replace('-', ' ', request()->segment(2))) }}</h4>
                @can(['browse_company', 'add_company', 'read'])

                    <div class="page-title-right btn-group" role="group">
                        <a id="clientGroup" href="javascript:void(0);"
                            class="dropdown-toggle btn-sm btn btn-secondary btn-label" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="align-middle bx bx-user-plus label-icon fs-16 me-2"></i>
                             {{ Str::title(str_replace('-', ' ', request()->segment(2))) }}
                        </a>
                        <div class="p-0 dropdown-menu" aria-labelledby="clientGroup" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 39.5px, 0px);">
                            @can('add_company')
                                <a class="dropdown-item" href="{{ route('admin.' . request()->segment(2) . '.index') }}">All {{ Str::title(str_replace('-', ' ', request()->segment(2))) }}s List</a>
                            @endcan
                            <div class="m-0 dropdown-divider"></div>
                            @can('add_company')
                                <a class="dropdown-item" href="{{ route('admin.' . request()->segment(2) . '.create') }}">Add New {{ Str::title(str_replace('-', ' ', request()->segment(2))) }}</a>
                            @endcan
                            <div class="m-0 dropdown-divider"></div>
                            @can('edit_company')
                                <a class="dropdown-item" href="{{ route('admin.' . request()->segment(2) . '.show', $company->id) }}">View This {{ Str::title(str_replace('-', ' ', request()->segment(2))) }}</a>
                            @endcan
                        </div>
                    </div>
                @endcan
                
            </div>
        </div>
    </div>
    @php
        $countries = App\Models\Country::where('id', 101)->pluck('name', 'id');
        $states = App\Models\State::where('status_id', 11)->pluck('name', 'id');
    @endphp

    {{ html()->form('PUT', route('admin.' . request()->segment(2) . '.update', $company->id))->attribute('enctype', 'multipart/form-data')->id('store')->open() }}

    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="card">
                <div class="card-body">


                    <div class="row">

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                {{ html()->label('First Name', 'first_name') }}
                                {{ html()->text('first_name', $company->first_name)->class('form-control')->placeholder('First Name') }}
                                <small class="text-danger">{{ $errors->first('first_name') }}</small>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                {{ html()->label('Last Name', 'last_name') }}
                                {{ html()->text('last_name', $company->last_name)->class('form-control')->placeholder('Last Name') }}
                                <small class="text-danger">{{ $errors->first('last_name') }}</small>
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-12">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                {{ html()->label('Email Address', 'email') }}
                                {{ html()->email('email', $company->email)->class('form-control')->placeholder('eg: foo@bar.com') }}
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
                                {{ html()->label('Mobile Number', 'mobile_number') }}
                                {{ html()->text('mobile_number', $company->mobile)->class('form-control')->id('mobile_no')->placeholder('Mobile Number') }}
                                <small class="text-danger">{{ $errors->first('mobile_number') }}</small>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                {{ html()->label('Company Name', 'company_name') }}
                                {{ html()->text('company_name', $company->company_name)->class('form-control')->placeholder('Company Name') }}
                                <small class="text-danger">{{ $errors->first('company_name') }}</small>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group{{ $errors->has('gst') ? ' has-error' : '' }}">
                                {{ html()->label('GST', 'gst') }}
                                {{ html()->text('gst', $company->gst)->class('form-control')->placeholder('GST') }}
                                <small class="text-danger">{{ $errors->first('gst') }}</small>
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-12">
                            <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                                {{ html()->label('State', 'state') }}
                                {{ html()->select('state', $states, $company->state_id)->class('form-control states')->placeholder('Choose State') }}
                                <small class="text-danger">{{ $errors->first('state') }}</small>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group{{ $errors->has('district') ? ' has-error' : '' }}">
                                {{ html()->label('District', 'district') }}
                                {{ html()->select('district', App\Models\District::where('state_id', $company->state_id)->pluck('name', 'id'), $company->district_id)->class('form-control getDistrict')->placeholder('Choose district') }}
                                <small class="text-danger">{{ $errors->first('district') }}</small>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                {{ html()->label('City', 'city') }}
                                {{ html()->select('city', App\Models\City::where('district_id', $company->district_id)->pluck('name', 'id'), $company->city_id)->class('form-control getCity')->placeholder('Choose City') }}
                                <small class="text-danger">{{ $errors->first('city') }}</small>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group{{ $errors->has('locality') ? ' has-error' : '' }}">
                                {{ html()->label('Locality', 'locality') }}
                                {{ html()->text('locality', $company->locality)->class('form-control')->placeholder('Locality') }}
                                <small class="text-danger">{{ $errors->first('locality') }}</small>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                {{ html()->label('Address (Area and Street)', 'address') }}
                                {{ html()->textarea('address', $company->address)->class('form-control', $company->address)->placeholder('Address (Area and Street)')->rows(1) }}
                                <small class="text-danger">{{ $errors->first('address') }}</small>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group{{ $errors->has('pincode') ? ' has-error' : '' }}">
                                {{ html()->label('Pincode', 'pincode') }}
                                {{ html()->text('pincode', $company->pincode)->class('form-control')->placeholder('Pincode') }}
                                <small class="text-danger">{{ $errors->first('pincode') }}</small>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group{{ $errors->has('landmark') ? ' has-error' : '' }}">
                                {{ html()->label('Landmark', 'landmark') }}
                                {{ html()->text('landmark', $company->landmark)->class('form-control')->placeholder('Landmark') }}
                                <small class="text-danger">{{ $errors->first('landmark') }}</small>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                {{ html()->label('Password', 'password') }}
                                {{ html()->password('password')->class('form-control')->placeholder('Password')->attribute('autocomplete', 'new-password') }}
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                            </div>
                        </div>




                    </div>



                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            {{ html()->label('Status')->for('status') }}
                            {{ html()->select('status', App\Models\Status::whereIn('id', [12, 15])->pluck('name', 'id'), $company->status_id)->class('form-control')->id('status')->placeholder('Status') }}
                            <small class="text-danger">{{ $errors->first('status') }}</small>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <div class="mt-4 media-area form-control onFocus" file-name="logo">
                            <div class="media-file-value">
                                @if ($company->media)
                                    <input type="hidden" name="logo[]" value="{{ $company->media_id }}"
                                        class="fileid{{ $company->media_id }}">
                                @endif
                            </div>
                            <div class="media-file">
                                @if ($company->media)
                                    <div class="file-container d-inline-block fileid{{ $company->media_id }}">
                                        <span data-id="{{ $company->media_id }}" class="remove-file">✕</span>
                                        <img class="w-100 d-block img-thumbnail" src="{{ asset($company->media->file) }}"
                                            alt="{{ $company->media->name }}">
                                    </div>
                                @endif
                            </div>
                            <a class="text-secondary select-mediatype" href="javascript:void(0);" mediatype='single'
                                onclick="loadMediaFiles($(this))">Select Image</a>
                            <small class="text-danger">{{ $errors->first('logo') }}</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4 form-group">
                {{ html()->button('Save Client Details')->type('button')->class('btn btn-success bg-gradient')->attribute('onclick = store(this)') }}
            </div>
        </div>
    </div>
    {{ html()->form()->close() }}
@endsection




@push('scripts')
    <script src="{{ asset('admin-assets/libs/select2/js/select2.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            var state = $('.states').val();
            var district = $('.getDistrict').val();

            $('.getDistrict').select2({
                placeholder: 'Choose District',
                allowClear: true,
                ajax: {
                    url: '{{ route('admin.common.district.list', '') }}/' + state,
                    dataType: 'json',
                    cache: true,
                    delay: 200,
                    data: function(params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    },
                }
            });


            $('.getCity').select2({
                placeholder: 'Choose City',
                allowClear: true,
                ajax: {
                    url: '{{ route('admin.common.city.list', '') }}/' + district,
                    dataType: 'json',
                    cache: true,
                    delay: 200,
                    data: function(params) {
                        return {
                            term: params.term || '',
                            page: params.page || 1
                        }
                    },
                }
            });



            $('.states').select2();


            $('body').on('change', '.states', function() {
                var state = $(this).val();
                $('.getDistrict').val(null).trigger('change');
                $('.getDistrict').select2({
                    placeholder: 'Choose District',
                    allowClear: true,
                    ajax: {
                        url: '{{ route('admin.common.district.list', '') }}/' + state,
                        dataType: 'json',
                        cache: true,
                        delay: 200,
                        data: function(params) {
                            return {
                                term: params.term || '',
                                page: params.page || 1
                            }
                        },
                    }
                });
            });


            $('body').on('change', '.getDistrict', function() {
                var district = $(this).val();
                $('.getCity').val(null).trigger('change');
                $('.getCity').select2({
                    placeholder: 'Choose City',
                    allowClear: true,
                    ajax: {
                        url: '{{ route('admin.common.city.list', '') }}/' + district,
                        dataType: 'json',
                        cache: true,
                        delay: 200,
                        data: function(params) {
                            return {
                                term: params.term || '',
                                page: params.page || 1
                            }
                        },
                    }
                });
            });
        });
    </script>
@endpush
