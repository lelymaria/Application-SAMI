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
        @if (session('message'))
            <div class="d-flex justify-content-center">
                <div class="alert alert-success left-icon-big alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i
                                class="mdi mdi-btn-close"></i></span>
                    </button>
                    <div class="media">
                        <div class="alert-left-icon-big">
                            <span><i class="mdi mdi-check-circle-outline"></i></span>
                        </div>
                        <div class="media-body">
                            <h5 class="mt-1 mb-2">Congratulations!</h5>
                            <p class="mb-0">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
                                        @can('ketuaP4mp')
                                            @if ($standar->verifikasiKp4mp)
                                                <a href="{{ url('/ami/verifikasi_ami/update/' . $standar->verifikasiKp4mp?->id) }}"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fa fa-pencil-alt"></i></a>
                                            @else
                                                <a href="{{ url('/ami/verifikasi_ami/create/' . $standar->id) }}"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fa fa-plus"></i></a>
                                            @endif
                                        @endcan
                                        @can('lead')
                                            @if ($standar->uraianTemuanAmi)
                                                <a href="{{ url('/ami/uraian_ami/update/' . $standar->uraianTemuanAmi?->id) }}"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fa fa-pencil-alt"></i></a>
                                            @else
                                                <a href="{{ url('/ami/uraian_ami/create/' . $standar->id) }}"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fa fa-plus"></i></a>
                                            @endif
                                        @endcan
                                        @can('anggota')
                                            @if ($standar->uraianTemuanAmi)
                                                <a href="{{ url('/ami/uraian_ami/update/' . $standar->uraianTemuanAmi?->id) }}"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fa fa-pencil-alt"></i></a>
                                            @else
                                                <a href="{{ url('/ami/uraian_ami/create/' . $standar->id) }}"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fa fa-plus"></i></a>
                                            @endif
                                        @endcan
                                        @can('auditee')
                                            @if ($standar->analisaTindakanAmi)
                                                <a href="{{ url('/ami/analisa_tindakan_ami/update/' . $standar->analisaTindakanAmi?->id) }}"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fa fa-pencil-alt"></i></a>
                                            @else
                                                <a href="{{ url('/ami/analisa_tindakan_ami/create/' . $standar->id) }}"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fa fa-plus"></i></a>
                                            @endif
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
