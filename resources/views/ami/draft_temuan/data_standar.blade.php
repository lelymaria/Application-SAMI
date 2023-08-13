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
        @if (session('error'))
            <div class="d-flex justify-content-center">
                <div class="alert alert-danger left-icon-big alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"><span><i
                                class="mdi mdi-btn-close"></i></span>
                    </button>
                    <div class="media">
                        <div class="alert-left-icon-big">
                        </div>
                        <div class="media-body">
                            <h5 class="mt-1 mb-2">Ooops!</h5>
                            <p class="mb-0">{{ session('error') }}</p>
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
                    <table id="example3" class="table table-responsive-md" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Standar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($standar as $index => $data_standar)
                                <tr>
                                    <td>{{ ($standar->currentPage() - 1) * $standar->perPage() + $index + 1 }}</td>
                                    <td>{{ $data_standar->nama_standar }}</td>
                                    <td>
                                        <a href="{{ url('/ami/draft_temuan_ami_preview/'. $data_standar->id) }}" class="btn btn-secondary shadow btn-xs sharp me-1"><i
                                            class="fa fa-file-invoice"></i></a>
                                        @can('ketuaP4mp')
                                            @if ($data_standar->verifikasiKp4mp()->where('id_user', auth()->user()->id)->first())
                                                <a href="{{ url('/ami/verifikasi_ami/update/' . $data_standar->verifikasiKp4mp?->id) }}"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fa fa-pencil-alt"></i></a>
                                            @else
                                                <a href="{{ url('/ami/verifikasi_ami/create/' . $data_standar->id) }}"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fa fa-plus"></i></a>
                                            @endif
                                        @endcan
                                        @can('lead')
                                            @if ($data_standar->uraianTemuanAmi()->where('id_user', auth()->user()->id)->first())
                                                <a href="{{ url('/ami/uraian_ami/update/' . $data_standar->uraianTemuanAmi?->id) }}"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fa fa-pencil-alt"></i></a>
                                            @else
                                                <a href="{{ url('/ami/uraian_ami/create/' . $data_standar->id) }}"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fa fa-plus"></i></a>
                                            @endif
                                        @endcan
                                        @can('anggota')
                                            @if ($data_standar->uraianTemuanAmi()->where('id_user', auth()->user()->id)->first())
                                                <a href="{{ url('/ami/uraian_ami/update/' . $data_standar->uraianTemuanAmi?->id) }}"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fa fa-pencil-alt"></i></a>
                                            @else
                                                <a href="{{ url('/ami/uraian_ami/create/' . $data_standar->id) }}"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fa fa-plus"></i></a>
                                            @endif
                                        @endcan
                                        @can('auditee')
                                            @if ($data_standar->analisaTindakanAmi()->where('id_user', auth()->user()->id)->first())
                                                <a href="{{ url('/ami/analisa_tindakan_ami/update/' . $data_standar->analisaTindakanAmi?->id) }}"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fa fa-pencil-alt"></i></a>
                                            @else
                                                <a href="{{ url('/ami/analisa_tindakan_ami/create/' . $data_standar->id) }}"
                                                    class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                        class="fa fa-plus"></i></a>
                                            @endif
                                        @endcan
                                    </td>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">Data tidak tersedia!</td>
                                </tr>
                            @endforelse
                            </tr>
                        </tbody>
                    </table>
                    {{ $standar->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
