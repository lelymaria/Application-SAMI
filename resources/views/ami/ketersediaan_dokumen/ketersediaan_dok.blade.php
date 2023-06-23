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
            <li class="breadcrumb-item"><a href="javascript:void(0)">Ketersediaan Dokumen AMI</a></li>
        </ol>
    </div>

    <div class="col-12">
        <form action="{{ url('#') }}" method="post">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Ketersediaan Dokumen</h4>
                    <button type="submit" class="btn btn-rounded btn-primary btn-xs">Simpan</button>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="col-lg-2 col-form-label" for="validationCustom02">Pertanyaan Standar
                        </label>
                        <textarea class="form-control" rows="10" name="list_pertanyaan_standar"></textarea>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label" for="validationCustom02">Email
                        </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="validationCustom02"
                                name="email" value="">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label" for="validationCustom02">Ketersediaan Dokumen
                        </label>
                        <div class="col-lg-6">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" value="" checked="">Ya
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" value="">Tidak
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label" for="validationCustom02">PIC
                        </label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" id="validationCustom02"
                                name="email" value="">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="col-lg-2 col-form-label" for="validationCustom02">Catatan
                        </label>
                        <textarea id="ckeditor" name="list_pertanyaan_standar"></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
