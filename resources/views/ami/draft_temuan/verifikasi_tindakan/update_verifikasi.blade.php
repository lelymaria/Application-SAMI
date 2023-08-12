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
            <li class="breadcrumb-item"><a href="javascript:void(0)">Draft Temuan AMI</a></li>
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
        <form action="{{ url('/ami/verifikasi_ami/update/'.$verifikasiTemuan->id) }}" method="post">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Verifikasi Tindakan Koreksi</h4>
                    <button type="submit" class="btn btn-rounded btn-primary btn-xs">Simpan</button>
                </div>
                <div class="card-body">
                    @if ($verifikasiTemuan->standar->analisaTindakanAmi)
                        <div class="mb-3">
                            <label class="col-lg-2 col-form-label" for="validationCustom02">Analisa Masalah
                            </label>
                            <textarea class="form-control" rows="5" name="analisa_masalah" disabled>{{ $verifikasiTemuan->standar->analisaTindakanAmi?->analisa_masalah }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="col-lg-2 col-form-label" for="validationCustom02">Tindakan Koreksi
                            </label>
                            <textarea class="form-control" rows="5" name="tindakan_koreksi" disabled>{{ $verifikasiTemuan->standar->analisaTindakanAmi?->tindakan_koreksi }}</textarea>
                        </div>
                    @endif
                    @if ($verifikasiTemuan->standar->uraianTemuanAmi)
                        <div class="mb-3">
                            <label class="col-lg-2 col-form-label" for="validationCustom02">Uraian Ketidaksesuaian
                                Koreksi
                            </label>
                            <textarea class="form-control" rows="5" name="uraian_ketidaksesuaian" disabled>{{ $verifikasiTemuan->standar->uraianTemuanAmi?->uraian_ketidaksesuaian }}</textarea>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label class="col-lg-2 col-form-label" for="validationCustom02">Tanggal Verifikasi
                        </label>
                        <input type="date" class="form-control" id="validationCustom02" name="tanggal_verifikasi" value="{{ $verifikasiTemuan->tanggal_verifikasij }}">
                    </div>
                    <div class="mb-3">
                        <label class="col-lg-2 col-form-label" for="validationCustom02">Verifikasi Keefektifan Tindakan Koreksi
                        </label>
                        <textarea class="form-control" rows="5" name="verifikasi_kp4mp" placeholder="Masukan Verifikasi...">{{ $verifikasiTemuan->verifikasi_kp4mp }}</textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
