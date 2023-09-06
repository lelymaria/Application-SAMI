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
                        </label>
                        <div class="col-lg-6">
                            <select class="default-select wide form-control" id="dataAuditee" name="id_tahun_ami">
                                <option data-display="Select" disabled selected>Please select
                                </option>
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

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="table table-responsive-md" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Data Auditee(nama unit kerja nya)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Data Dukung</td>
                                <td><a href="{{ ('/ami/historiami/data_auditee/data_dukung') }}" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                            class="fa fa-plus"></i></a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Ketersediaan Dokumen</td>
                                <td><a href="{{ ('/ami/historiami/data_auditee/ketersediaan') }}" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                            class="fa fa-plus"></i></a></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Check List Audit</td>
                                <td><a href="{{ ('/ami/historiami/data_auditee/checklist') }}" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                            class="fa fa-plus"></i></a></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Draft Temuan AMI</td>
                                <td><a href="{{ ('/ami/historiami/data_auditee/temuan') }}" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                            class="fa fa-plus"></i></a></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Laporan Hasil AMI (Langsung Bisa Download perauditee nya)</td>
                                <td><a href=""
                                    class="btn btn-secondary shadow btn-xs sharp me-1"><i
                                        class="las la-download"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
