@extends('admin.layouts.master')
@push('links')

@endpush

@section('main')



<div class="gap-1 p-1 chat-wrapper d-lg-flex mx-n4 mt-n4">
    <div class="file-manager-sidebar minimal-border">
        <div class="p-3 d-flex flex-column h-100">
            <div class="mb-3">
                <h5 class="mb-0 fw-semibold">My Drive</h5>
            </div>
            <div class="search-box">
                <input type="text" class="form-control bg-light border-light" placeholder="Search here...">
                <i class="ri-search-2-line search-icon"></i>
            </div>
            <div class="px-4 mt-3 mx-n4 file-menu-sidebar-scroll" data-simplebar>
                <ul class="list-unstyled file-manager-menu">
                    <li>
                        <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true" aria-controls="collapseExample">
                            <i class="align-bottom ri-folder-2-line me-2"></i> <span class="file-list-link">My Drive</span>
                        </a>
                        <div class="collapse show" id="collapseExample">
                            <ul class="sub-menu list-unstyled">
                                <li>
                                    <a href="#!">Assets</a>
                                </li>
                                <li>
                                    <a href="#!">Marketing</a>
                                </li>
                                <li>
                                    <a href="#!">Personal</a>
                                </li>
                                <li>
                                    <a href="#!">Projects</a>
                                </li>
                                <li>
                                    <a href="#!">Templates</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#!"><i class="align-bottom ri-file-list-2-line me-2"></i> <span class="file-list-link">Documents</span></a>
                    </li>
                    <li>
                        <a href="#!"><i class="align-bottom ri-image-2-line me-2"></i> <span class="file-list-link">Media</span></a>
                    <li>
                        <a href="#!"><i class="align-bottom ri-history-line me-2"></i> <span class="file-list-link">Recent</span></a>
                    </li>
                    <li>
                        <a href="#!"><i class="align-bottom ri-star-line me-2"></i> <span class="file-list-link">Important</span></a>
                    </li>
                    </li>
                    <li>
                        <a href="#!"><i class="align-bottom ri-delete-bin-line me-2"></i> <span class="file-list-link">Deleted</span></a>
                    </li>
                </ul>
            </div>


            <div class="mt-auto">
                <h6 class="mb-3 fs-11 text-muted text-uppercase">Storage Status</h6>
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <i class="ri-database-2-line fs-17"></i>
                    </div>
                    <div class="overflow-hidden flex-grow-1 ms-3">
                        <div class="mb-2 progress progress-sm">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="text-muted fs-12 d-block text-truncate"><b>47.52</b>GB used of <b>119</b>GB</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-3 py-0 file-manager-content minimal-border w-100">
        <div class="px-4 pt-4 mx-n3 file-manager-content-scroll" data-simplebar>
            <div id="folder-list" class="mb-2">
                <div class="mb-3 row justify-content-beetwen g-2">

                    <div class="col">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2 d-block d-lg-none">
                                <button type="button" class="btn btn-soft-success btn-icon btn-sm fs-16 file-menu-btn">
                                    <i class="align-bottom ri-menu-2-fill"></i>
                                </button>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="mb-0 fs-16">Folders</h5>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-auto">
                        <div class="gap-2 d-flex align-items-start">
                            <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="file-type">
                                <option value="">File Type</option>
                                <option value="All" selected>All</option>
                                <option value="Video">Video</option>
                                <option value="Images">Images</option>
                                <option value="Music">Music</option>
                                <option value="Documents">Documents</option>
                            </select>

                            <button class="flex-shrink-0 btn btn-success w-sm create-folder-modal" data-bs-toggle="modal" data-bs-target="#createFolderModal"><i class="align-bottom ri-add-line me-1"></i> Create Folders</button>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                <div class="row" id="folderlist-data">
                    <div class="col-xxl-3 col-6 folder-card">
                        <div class="shadow-none card bg-light" id="folder-1">
                            <div class="card-body">
                                <div class="mb-1 d-flex">
                                    <div class="mb-3 form-check form-check-danger fs-15 flex-grow-1">
                                        <input class="form-check-input" type="checkbox" value="" id="folderlistCheckbox_1" checked>
                                        <label class="form-check-label" for="folderlistCheckbox_1"></label>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-ghost-primary btn-icon btn-sm dropdown material-shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="align-bottom ri-more-2-fill fs-16"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item view-item-btn" href="javascript:void(0);">Open</a></li>
                                            <li><a class="dropdown-item edit-folder-list" href="#createFolderModal" data-bs-toggle="modal" role="button">Rename</a></li>
                                            <li><a class="dropdown-item" href="#removeFolderModal" data-bs-toggle="modal" role="button">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <div class="mb-2">
                                        <i class="align-bottom ri-folder-2-fill text-warning display-5"></i>
                                    </div>
                                    <h6 class="fs-15 folder-name">Projects</h6>
                                </div>
                                <div class="mt-4 hstack text-muted">
                                    <span class="me-auto"><b>349</b> Files</span>
                                    <span><b>4.10</b>GB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-3 col-6 folder-card">
                        <div class="shadow-none card bg-light" id="folder-2">
                            <div class="card-body">
                                <div class="mb-1 d-flex">
                                    <div class="mb-3 form-check form-check-danger fs-15 flex-grow-1">
                                        <input class="form-check-input" type="checkbox" value="" id="folderlistCheckbox_2">
                                        <label class="form-check-label" for="folderlistCheckbox_2"></label>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-ghost-primary btn-icon btn-sm dropdown material-shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="align-bottom ri-more-2-fill fs-16"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item view-item-btn" href="javascript:void(0);">Open</a></li>
                                            <li><a class="dropdown-item edit-folder-list" href="#createFolderModal" data-bs-toggle="modal" role="button">Rename</a></li>
                                            <li><a class="dropdown-item" href="#removeFolderModal" data-bs-toggle="modal" role="button">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <div class="mb-2">
                                        <i class="align-bottom ri-folder-2-fill text-warning display-5"></i>
                                    </div>
                                    <h6 class="fs-15 folder-name">Documents</h6>
                                </div>
                                <div class="mt-4 hstack text-muted">
                                    <span class="me-auto"><b>2348</b> Files</span>
                                    <span><b>27.01</b>GB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-3 col-6 folder-card">
                        <div class="shadow-none card bg-light" id="folder-3">
                            <div class="card-body">
                                <div class="mb-1 d-flex">
                                    <div class="mb-3 form-check form-check-danger fs-15 flex-grow-1">
                                        <input class="form-check-input" type="checkbox" value="" id="folderlistCheckbox_3">
                                        <label class="form-check-label" for="folderlistCheckbox_3"></label>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-ghost-primary btn-icon btn-sm dropdown material-shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="align-bottom ri-more-2-fill fs-16"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item view-item-btn" href="javascript:void(0);">Open</a></li>
                                            <li><a class="dropdown-item edit-folder-list" href="#createFolderModal" data-bs-toggle="modal" role="button">Rename</a></li>
                                            <li><a class="dropdown-item" href="#removeFolderModal" data-bs-toggle="modal" role="button">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="text-center">
                                    <div class="mb-2">
                                        <i class="align-bottom ri-folder-2-fill text-warning display-5"></i>
                                    </div>
                                    <h6 class="fs-15 folder-name">Media</h6>
                                </div>
                                <div class="mt-4 hstack text-muted">
                                    <span class="me-auto"><b>12480</b> Files</span>
                                    <span><b>20.87</b>GB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-3 col-6 folder-card">
                        <div class="shadow-none card bg-light" id="folder-4">
                            <div class="card-body">
                                <div class="mb-1 d-flex">
                                    <div class="mb-3 form-check form-check-danger fs-15 flex-grow-1">
                                        <input class="form-check-input" type="checkbox" value="" id="folderlistCheckbox_4" checked>
                                        <label class="form-check-label" for="folderlistCheckbox_4"></label>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-ghost-primary btn-icon btn-sm dropdown material-shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="align-bottom ri-more-2-fill fs-16"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item view-item-btn" href="javascript:void(0);">Open</a></li>
                                            <li><a class="dropdown-item edit-folder-list" href="#createFolderModal" data-bs-toggle="modal" role="button">Rename</a></li>
                                            <li><a class="dropdown-item" href="#removeFolderModal" data-bs-toggle="modal" role="button">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="mb-2">
                                        <i class="align-bottom ri-folder-2-fill text-warning display-5"></i>
                                    </div>
                                    <h6 class="fs-15 folder-name">Velzon v1.7.0</h6>
                                </div>
                                <div class="mt-4 hstack text-muted">
                                    <span class="me-auto"><b>180</b> Files</span>
                                    <span><b>478.65</b>MB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <div>
                <div class="mb-3 d-flex align-items-center">
                    <h5 class="mb-0 flex-grow-1 fs-16" id="filetype-title">Recent File</h5>
                    <div class="flex-shrink-0">
                        <button class="btn btn-success createFile-modal" data-bs-toggle="modal" data-bs-target="#createFileModal"><i class="align-bottom ri-add-line me-1"></i> Create File</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 align-middle table-nowrap">
                        <thead class="table-active">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">File Item</th>
                                <th scope="col">File Size</th>
                                <th scope="col">Recent Date</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="file-list"></tbody>
                    </table>
                </div>
                <ul id="pagination" class="pagination pagination-lg"></ul>
                <div class="mt-2 text-center align-items-center row g-3 text-sm-start">
                    <div class="col-sm">
                        <div class="text-muted">Showing<span class="fw-semibold">4</span> of <span class="fw-semibold">125</span> Results
                        </div>
                    </div>
                    <div class="col-sm-auto">
                        <ul class="mb-0 pagination pagination-separated pagination-sm justify-content-center justify-content-sm-start">
                            <li class="page-item disabled">
                                <a href="#" class="page-link">←</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li class="page-item active">
                                <a href="#" class="page-link">2</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">3</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">→</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="p-3 py-0 file-manager-detail-content minimal-border">
        <div class="px-3 pt-3 mx-n3 file-detail-content-scroll" data-simplebar>
            <div id="folder-overview">
                <div class="pb-3 d-flex align-items-center border-bottom border-bottom-dashed">
                    <h5 class="mb-0 flex-grow-1 fw-semibold">Overview</h5>
                    <div>
                        <button type="button" class="btn btn-soft-danger btn-icon btn-sm fs-16 close-btn-overview">
                            <i class="align-bottom ri-close-fill"></i>
                        </button>
                    </div>
                </div>
                <div id="simple_dount_chart" data-colors='["--vz-info", "--vz-danger", "--vz-primary", "--vz-success"]' class="mt-3 apex-charts" dir="ltr"></div>
                <div class="mt-4">
                    <ul class="gap-4 list-unstyled vstack">
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-xs">
                                        <div class="rounded avatar-title bg-secondary-subtle text-secondary">
                                            <i class="ri-file-text-line fs-17"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1 fs-15">Documents</h5>
                                    <p class="mb-0 fs-12 text-muted">2348 files</p>
                                </div>
                                <b>27.01 GB</b>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-xs">
                                        <div class="rounded avatar-title bg-success-subtle text-success">
                                            <i class="ri-gallery-line fs-17"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1 fs-15">Media</h5>
                                    <p class="mb-0 fs-12 text-muted">12480 files</p>
                                </div>
                                <b>20.87 GB</b>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-xs">
                                        <div class="rounded avatar-title bg-warning-subtle text-warning">
                                            <i class="ri-folder-2-line fs-17"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1 fs-15">Projects</h5>
                                    <p class="mb-0 fs-12 text-muted">349 files</p>
                                </div>
                                <b>4.10 GB</b>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avatar-xs">
                                        <div class="rounded avatar-title bg-primary-subtle text-primary">
                                            <i class="ri-error-warning-line fs-17"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="mb-1 fs-15">Others</h5>
                                    <p class="mb-0 fs-12 text-muted">9873 files</p>
                                </div>
                                <b>33.54 GB</b>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="pb-3 mt-auto">
                    <div class="mb-0 alert alert-danger d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="align-bottom ri-cloud-line text-danger display-5"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="text-danger fs-14">Upgrade to Pro</h5>
                            <p class="mb-2 text-muted">Get more space for your...</p>
                            <button class="btn btn-sm btn-danger"><i class="align-bottom ri-upload-cloud-line"></i> Upgrade Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="file-overview" class="h-100">
                <div class="d-flex h-100 flex-column">
                    <div class="gap-2 pb-3 mb-3 d-flex align-items-center border-bottom border-bottom-dashed">
                        <h5 class="mb-0 flex-grow-1 fw-semibold">File Preview</h5>
                        <div>
                            <button type="button" class="btn btn-ghost-primary btn-icon btn-sm fs-16 favourite-btn">
                                <i class="align-bottom ri-star-fill"></i>
                            </button>
                            <button type="button" class="btn btn-soft-danger btn-icon btn-sm fs-16 close-btn-overview">
                                <i class="align-bottom ri-close-fill"></i>
                            </button>
                        </div>
                    </div>

                    <div class="pb-3 mb-3 border-bottom border-bottom-dashed">
                        <div class="p-3 mb-3 text-center border file-details-box bg-light rounded-3 border-light">
                            <div class="display-4 file-icon">
                                <i class="ri-file-text-fill text-secondary"></i>
                            </div>
                        </div>
                        <button type="button" class="btn btn-icon btn-sm btn-ghost-success float-end fs-16"><i class="ri-share-forward-line"></i></button>
                        <h5 class="mb-1 fs-16 file-name">html.docx</h5>
                        <p class="mb-0 text-muted fs-12"><span class="file-size">0.3 KB</span>, <span class="create-date">19 Apr, 2022</span></p>
                    </div>
                    <div>
                        <h5 class="mb-3 fs-12 text-uppercase text-muted">File Description :</h5>

                        <div class="table-responsive">
                            <table class="table table-borderless table-nowrap table-sm">
                                <tbody>
                                    <tr>
                                        <th scope="row" style="width: 35%;">File Name :</th>
                                        <td class="file-name">html.docx</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">File Type :</th>
                                        <td class="file-type">Documents</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Size :</th>
                                        <td class="file-size">0.3 KB</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Created :</th>
                                        <td class="create-date">19 Apr, 2022</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Path :</th>
                                        <td class="file-path"><div class="user-select-all text-truncate">*:\projects\src\assets\images</div></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <h5 class="mb-3 fs-12 text-uppercase text-muted">Share Information:</h5>
                            <div class="table-responsive">
                                <table class="table table-borderless table-nowrap table-sm">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 35%;">Share Name :</th>
                                            <td class="share-name">\\*\Projects</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Share Path :</th>
                                            <td class="share-path">velzon:\Documents\</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="py-3 mt-auto border-top border-top-dashed">
                        <div class="gap-2 hstack">
                            <button type="button" class="btn btn-soft-primary w-100"><i class="align-bottom ri-download-2-line me-1"></i> Download</button>
                            <button type="button" class="btn btn-soft-danger w-100 remove-file-overview" data-remove-id="" data-bs-toggle="modal" data-bs-target="#removeFileItemModal"><i class="align-bottom ri-close-fill me-1"></i> Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection


@push('scripts')
@endpush