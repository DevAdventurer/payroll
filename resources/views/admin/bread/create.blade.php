@extends('admin.layouts.master')
@push('links')

@endpush




@section('main')


        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">{{Str::title(str_replace('-', ' ', request()->segment(2)))}}</h4>

                    <div class="page-title-right">
                        <a href="{{ route('admin.'.request()->segment(2).'.create') }}"  class="btn-sm btn btn-primary btn-label rounded-pill">
                            <i class="bx bx-plus label-icon align-middle rounded-pill fs-16 me-2"></i>
                            Add {{Str::title(str_replace('-', ' ', request()->segment(2)))}}
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-3 col-sm-12"></div>
            <div class="col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        {!! Html::form()->route('admin.bread.store')->open() !!}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} mb-3">
        {!! Html::label('name', 'Name') !!}
        {!! Html::text('name')->class('form-control')->placeholder('Name') !!}
        <small class="text-danger">{{ $errors->first('name') }}</small>
    </div>

    <div class="form-group ">
        {!! Html::submit('Create')->class('btn btn-soft-secondary waves-effect waves-light') !!}
    </div>

{!! Html::form()->close() !!}

                    
                    </div>
                </div>
            </div><!--end col-->
            <div class="col-md-3 col-sm-12"></div>
        </div><!--end row-->



@endsection


@push('scripts')

@endpush