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
            <li class="breadcrumb-item"><a href="javascript:void(0)">Draft Temuan AMI</a></li>
        </ol>
    </div>

    <div class="col-12">
        <form action="{{ url('/ami/uraian_ami/create/'.$standar->id) }}" method="post">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Uraian Ketidaksesuaian</h4>
                    <button type="submit" class="btn btn-rounded btn-primary btn-xs">Simpan</button>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="col-lg-2 col-form-label" for="validationCustom02">Uraian Ketidaksesuaian<span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" rows="5" name="uraian_ketidaksesuaian"></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
