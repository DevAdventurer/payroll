@extends('admin.layouts.master')
@push('links')
@endpush




@section('main')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{ Str::title(str_replace('-', ' ', request()->segment(2))) }}</h4>
                @can(['browse_employee', 'add_employee', 'edit'])

                    <div class="page-title-right btn-group" role="group">
                        <a id="clientGroup" href="javascript:void(0);"
                            class="dropdown-toggle btn-sm btn btn-secondary btn-label" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="align-middle bx bx-user-plus label-icon fs-16 me-2"></i>
                             {{ Str::title(str_replace('-', ' ', request()->segment(2))) }}
                        </a>
                        <div class="p-0 dropdown-menu" aria-labelledby="clientGroup" data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(0px, 39.5px, 0px);">
                            @can('add_employee')
                                <a class="dropdown-item" href="{{ route('admin.' . request()->segment(2) . '.index') }}">All {{ Str::title(str_replace('-', ' ', request()->segment(2))) }}s List</a>
                            @endcan
                            <div class="m-0 dropdown-divider"></div>
                            @can('add_employee')
                                <a class="dropdown-item" href="{{ route('admin.' . request()->segment(2) . '.create') }}">Add New {{ Str::title(str_replace('-', ' ', request()->segment(2))) }}</a>
                            @endcan
                            <div class="m-0 dropdown-divider"></div>
                            @can('edit_employee')
                                <a class="dropdown-item" href="{{ route('admin.' . request()->segment(2) . '.edit', $employee->id) }}">Edit This {{ Str::title(str_replace('-', ' ', request()->segment(2))) }}</a>
                            @endcan
                        </div>
                    </div>
                @endcan

            </div>
        </div>
    </div>
    <!-- end page title -->




    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header bg-info-subtle">
                    <h5 class="mb-0 card-title">Personal Details</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle table-sm border-info table-bordered nowrap" style="width:100%">
                            <tr>
                                <th>Owner Name</th>
                                <td>{{ $employee->full_name }}</td>
                            </tr>
                            <tr>
                                <th>Company Name</th>
                                <td>{{ $employee->company_name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $employee->email }}</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>{{ $employee->mobile }}</td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td>{{ $employee->city->name }}</td>
                            </tr>
                            <tr>
                                <th>Logo</th>
                                <td>
                                    @if($employee->media)
                                        <div class="rounded avatar-title bg-light">
                                            <img src="{{asset($employee->media->file)}}" alt="" height="50">
                                        </div>
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-header bg-info-subtle">
                    <h5 class="mb-0 card-title">Address</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 align-middle table-sm border-info table-bordered nowrap" style="width:100%">
                            <tr>
                                <th>GST</th>
                                <td>{{ $employee->gst }}</td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td>{{ $employee->state->name }}</td>
                            </tr>
                            <tr>
                                <th>District</th>
                                <td>{{ $employee->district->name }}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{ $employee->city->name }}</td>
                            </tr>
                            <tr>
                                <th>Locality</th>
                                <td>{{ $employee->locality }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $employee->address }}</td>
                            </tr>
                            <tr>
                                <th>Landmark</th>
                                <td>{{ $employee->landmark??'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

        </div><!--end col-->
    </div><!--end row-->
@endsection


@push('scripts')
@endpush
