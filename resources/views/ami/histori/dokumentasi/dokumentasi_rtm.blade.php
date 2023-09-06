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
                                <th>Undangan RTM</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histori_ami->jadwal[0]->undanganRtm as $undangan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $undangan->file_nama }}</td>
                                    <td>
                                        <a href="{{ url('/ami/historiami/dokumentasi_rtm/download/' . $undangan->id) }}"
                                            class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                class="las la-download"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
