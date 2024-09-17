@extends('admin.layouts.master')


@section('main')
<div class="row justify-content-center py-5">
                    <div class="col-xl-4 text-center">
                        <div class="error-500 position-relative">
                            <img src="{{asset('admin-assets/images/error500.png')}}" alt="" class="img-fluid error-500-img error-img">
                            <h1 class="title text-muted">500</h1>
                        </div>
                        <div>
                            <h4>Internal Server Error!</h4>
                            <p class="text-muted w-75 mx-auto">Server Error 500. We're not exactly sure what happened, but our servers say something is wrong.</p>
                            <a href="javascript:void(0)" class="btn btn-success"><i class="fs-16 mdi mdi-phone me-1 position-relative" style="top:2px;"></i>Please Contact Your Developer</a>
                        </div>
                    </div><!-- end col-->
                </div>
@endsection

