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
            <li class="breadcrumb-item"><a href="javascript:void(0)">Standar</a></li>
        </ol>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Standar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($standar as $standar)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $standar->nama_standar }}</td>
                                    <td>
                                        @can('lead')
                                            <a href="{{ url('/ami/checklist_audit/' . $standar->id) }}"
                                                class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-plus"></i></a>
                                        @endcan
                                        @can('anggota')
                                            <a href="{{ url('/ami/checklist_audit/' . $standar->id) }}"
                                                class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-plus"></i></a>
                                        @endcan
                                        @can('auditee')
                                            <a href="{{ url('/ami/tanggapan_audit/' . $standar->id) }}"
                                                class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-plus"></i></a>
                                        @endcan
                                    </td>
                            @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
