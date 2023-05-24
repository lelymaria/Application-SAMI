@push('header')
    <!--**********************************
Header start
***********************************-->
    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">
                        <div class="dashboard_bar">
                            Audit Mutu Internal
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
<!--**********************************
Header end ti-comment-alt
***********************************-->
@endpush
@extends('layouts.main')
@section('content') 
@include('layouts.navbar')

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Audit Mutu Internal</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pedoman AMI</a></li>
        </ol>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="d-xl-flex d-block align-items-start description-bx">
                    <div>
                        <h4 class="card-title">Description</h4>
                        <span class="fs-12">Lorem ipsum dolor sit amet, consectetur</span>
                        <p class="description mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint
                            occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum
                        </p>
                    </div>
                </div>
                <div class="d-flex mb-3">
                    <a href="javascript:void(0);" class="btn btn-primary"><i
                            class="las la-download scale5 me-3"></i>Download Pedoman</a>
                </div>
            </div>
        </div>
    </div>
@endsection
