@extends('admin.layouts.master')


@section('main')
<div class="row justify-content-center py-5">
                    <div class="col-xl-7 col-lg-8">
                        <div class="text-center">
                            <img src="{{asset('admin-assets/images/error400-cover.png')}}" alt="error img" class="img-fluid">
                            <div class="mt-3">
                                <h3 class="text-uppercase">Sorry, Page not Found 😭</h3>
                                <p class="text-muted mb-4">The page you are looking for not available!</p>
                                <a href="{{route('admin.dashboard.index')}}" class="btn btn-success"><i class="mdi mdi-home me-1"></i>Back to home</a>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div>	
@endsection

