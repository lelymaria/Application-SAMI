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
                        <div class="col-lg-6 pt-2">
                            {{ $user->akunAuditee->jadwal->historiAmi->tahun_ami }}
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
                                <th>Ketersediaan Dokumen (@if ($user->akunAuditee->dataProdi)
                                        {{ $user->akunAuditee->dataProdi->nama_prodi }}
                                    @else
                                        {{ $user->akunAuditee->layanan_akademik->nama_layanan }}
                                    @endif)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->tugasStandar as $tugasStandar)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tugasStandar->standar->nama_standar }}</td>
                                    <td><a href="{{ url('/ami/historiami/data_auditee/download/ketersediaan/' . $tugasStandar->standar->id) }}"
                                            class="btn btn-secondary shadow btn-xs sharp me-1"><i
                                                class="las la-download"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
