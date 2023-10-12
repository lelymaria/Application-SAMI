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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="table table-responsive-md" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Data Dukung <br> (@if ($user->akunAuditee->dataProdi)
                                        {{ $user->akunAuditee->dataProdi->nama_prodi }}
                                    @else
                                        {{ $user->akunAuditee->layanan_akademik->nama_layanan }}
                                    @endif)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->tugasStandarAktif as $tugasStandar)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tugasStandar->standar->nama_standar }}</td>
                                    <td>
                                        @if(!$user->dataDukungAuditee)
                                        <button type="button" class="btn btn-secondary shadow btn-xs sharp me-1" data-bs-toggle="modal" data-bs-target="#modalNotFound{{ $tugasStandar->id }}">
                                            <i class="las la-download"></i>
                                        </button>
                                        @else
                                        <a target="_blank"
                                            href="{{ url('/ami/historiami/data_auditee/download/data_dukung/' . $tugasStandar->id) }}"
                                            class="btn btn-secondary shadow btn-xs sharp me-1">
                                            <i class="las la-download"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                <div class="modal fade" id="modalNotFound{{ $tugasStandar->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h4>Oops.. Data belum tersedia</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
