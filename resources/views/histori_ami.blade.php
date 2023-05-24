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
            <li class="breadcrumb-item"><a href="javascript:void(0)">Histori AMI</a></li>
        </ol>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="col-xl-12">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label" for="validationCustom05">Periode
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <select class="default-select wide form-control" id="validationCustom05">
                                <option data-display="Select">Please select</option>
                                <option value="html">HTML</option>
                                <option value="css">CSS</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a one.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
