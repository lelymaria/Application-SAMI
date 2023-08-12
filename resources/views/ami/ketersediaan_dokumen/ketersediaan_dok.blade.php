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
            <li class="breadcrumb-item"><a href="javascript:void(0)">Ketersediaan Dokumen AMI</a></li>
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

    <div class="col-12">
        <form action="{{ url('/ami/ketersediaan_dokumen/create/'.$pertanyaan->id) }}" method="post">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ketersediaan Dokumen</h4>
                    <button type="submit" class="btn btn-rounded btn-primary btn-xs">Simpan</button>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <small class="text-danger">Field dengan tanda (*) wajib diisi!</small>
                    </div>
                    <div class="mb-3">
                        <label class="col-lg-2 col-form-label" for="validationCustom02">Pertanyaan Standar
                        </label>
                        <textarea class="form-control" rows="10" name="list_pertanyaan_standar" disabled>{{ $pertanyaan->list_pertanyaan_standar }}</textarea>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label" for="validationCustom02">Pilih Kop
                            Surat
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <select class="default-select wide form-control" id="validationCustom05"
                                name="nama_formulir">
                                <option data-display="Select" disabled selected>Please select
                                </option>
                                @foreach ($kop_surat as $kop)
                                    <option value="{{ $kop->id }}">{{ $kop->nama_formulir }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label" for="validationCustom02">Tanggal Input Ketersediaan <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input type="date" class="form-control" id="validationCustom02"
                                name="tanggal_input_dokKetersediaan" value="">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label" for="validationCustom02">No. Audit <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="validationCustom02"
                                name="no_audit" value="" placeholder="Masukan No. Audit...">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label" for="validationCustom02">Ketersediaan Dokumen <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="ketersediaan_dokumen" value="ya">Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="ketersediaan_dokumen" value="tidak">Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label" for="validationCustom02">PIC <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="validationCustom02"
                                name="pic" value="" placeholder="Masukan PIC...">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="col-lg-2 col-form-label" for="validationCustom02">Nama Dokumen <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" rows="5" name="nama_dokumen" placeholder="Masukan Nama Dokumen..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="col-lg-2 col-form-label" for="validationCustom02">Catatan <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" rows="5" name="catatan" placeholder="Masukan Catatan..."></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
