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
                            Dokumentasi
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
    @include('layouts.navbar')

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Dokumentasi</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dokumentasi AMI</a></li>
        </ol>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="profile-tab">
                    <div class="custom-tab-1">
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a href="{{ url('/manage_user/lead_auditor/') }}" class="nav-link">Lead
                                    Auditor</a>
                            </li>
                            <li class="nav-item"><a href="{{ url('/manage_user/anggota_auditor/') }}"
                                    class="nav-link active show">Anggota
                                    Auditor</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="lead" class="tab-pane fade active show">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Data Akun Angoota</h4>
                                            <button type="button" class="btn btn-rounded btn-secondary btn-xs"
                                                data-bs-toggle="modal" data-bs-target="#basicModal"><span
                                                    class="btn-icon-start text-secondary"><i
                                                        class="fa fa-plus color-secondary"></i>
                                                </span>Add</button>
                                            {{-- Modal --}}
                                            <div class="modal fade" id="basicModal">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Tambah Akun Auditor</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal">
                                                            </button>
                                                        </div>
                                                        <form class="needs-validation" novalidate=""
                                                            action="{{ url('/manage_user/anggota_auditor') }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="form-validate">
                                                                    <div class="row">
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label"
                                                                                for="validationCustom05">Unit
                                                                                Kerja
                                                                                <span class="text-danger">*</span>
                                                                            </label>
                                                                            <div class="col-lg-6">
                                                                                <select
                                                                                    class="default-select wide form-control"
                                                                                    id="validationCustom05"
                                                                                    name="unit_kerja">
                                                                                    <option data-display="Select" disabled
                                                                                        selected>Please
                                                                                        select</option>
                                                                                    @foreach ($dataProdi as $dataProdi)
                                                                                        <option
                                                                                            value="{{ $dataProdi->id }}">
                                                                                            {{ $dataProdi->nama_prodi }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                    @foreach ($layananAkademik as $layananAkademik)
                                                                                        <option
                                                                                            value="{{ $layananAkademik->id }}">
                                                                                            {{ $layananAkademik->nama_layanan }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label"
                                                                                for="validationCustom07">Email
                                                                                <span class="text-danger">*</span>
                                                                            </label>
                                                                            <div class="col-lg-8">
                                                                                <input type="text" class="form-control"
                                                                                    id="validationCustom07" name="email">
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label"
                                                                                for="validationCustom08">NIP
                                                                                <span class="text-danger">*</span>
                                                                            </label>
                                                                            <div class="col-lg-8">
                                                                                <input type="text" class="form-control"
                                                                                    id="validationCustom08"
                                                                                    name="nip">
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3 row">
                                                                            <label class="col-lg-4 col-form-label"
                                                                                for="validationCustom09">Nama <span
                                                                                    class="text-danger">*</span>
                                                                            </label>
                                                                            <div class="col-lg-8">
                                                                                <input type="text" class="form-control"
                                                                                    id="validationCustom09"
                                                                                    name="nama">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger light"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="example3" class="table table-responsive-md"
                                                    style="min-width: 845px">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>NIP</th>
                                                            <th>Email</th>
                                                            <th>Type</th>
                                                            <th>Unit Kerja</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($akun_auditor as $akun_auditor)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $akun_auditor->akunAuditor?->nama }}</td>
                                                                <td>{{ $akun_auditor->nip }}</td>
                                                                <td>{{ $akun_auditor->akunAuditor?->email }}</td>
                                                                <td><strong>{{ $akun_auditor->levelRole->name }}</strong>
                                                                </td>
                                                                <td>
                                                                    @if ($akun_auditor->akunAuditor?->dataProdi)
                                                                        {{ $akun_auditor->akunAuditor?->dataProdi->nama_prodi }}
                                                                    @else
                                                                        {{ $akun_auditor->akunAuditor?->layananAkademik->nama_layanan }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <div class="d-flex">
                                                                            <a href="{{ url('/manage_user/anggota_auditor_edit/' . $akun_auditor->id) }}"
                                                                                class="btn btn-primary shadow btn-xs sharp me-1 btn-edit"><i
                                                                                    class="fas fa-pencil-alt"></i></a>
                                                                            <form
                                                                                action="{{ url('/manage_user/anggota_auditor/' . $akun_auditor->id) }}"
                                                                                method="post">
                                                                                @method('delete')
                                                                                @csrf
                                                                                <button
                                                                                    class="btn btn-danger shadow btn-xs sharp"><i
                                                                                        class="fa fa-trash"></i></button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
