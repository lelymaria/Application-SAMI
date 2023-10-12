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
        <li class="breadcrumb-item"><a href="javascript:void(0)">Tinjau Manajemen Pengendalian</a></li>
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
    <form
        action="{{ route('tinjau_manajemen_pengendalian.store', ['pertanyaan'=>$pertanyaan->id,'standar'=>$standar_id]) }}"
        method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tinjau Manajemen Pengendalian</h4>
                <button type="submit" class="btn btn-rounded btn-primary btn-xs">
                    @if($pertanyaan->tinjauanPengendalian()->where([['id_user',
                    auth()->user()->id],['id_pertanyaan',$pertanyaan->id]])->first())
                    Update
                    @else
                    Simpan
                    @endif
                </button>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <small class="text-danger">Field dengan tanda (*) wajib diisi!</small>
                </div>
                <div class="mb-3">
                    <label class="col-lg-2 col-form-label" for="validationCustom02">Pertanyaan Standar
                    </label>
                    <div class="card p-3">
                        <p>{!! $pertanyaan->list_pertanyaan_standar !!}</p>
                    </div>
                </div>
                <p>Audit Resiko (Eisenhower Matrix)</p>
                <div class="mb-3 row">
                    <label class="col-lg-2 col-form-label" for="validationCustom02">Importan/ Not Important
                    </label>
                    <div class="col-lg-6">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="audit_resiko_status" value="1" {{
                                    $pertanyaan->tinjauanPengendalian?->audit_resiko_status == '1' ? 'checked' : ''
                                }}>Important
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="audit_resiko_status" value="0" {{
                                    $pertanyaan->tinjauanPengendalian?->audit_resiko_status == '0' ? 'checked' : ''
                                }}>Not Important
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-2 col-form-label" for="validationCustom02">Urgent/ Not Urgent
                    </label>
                    <div class="col-lg-6">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="audit_resiko_situation" value="1" {{
                                    $pertanyaan->tinjauanPengendalian?->audit_resiko_situation == '1' ? 'checked' : ''
                                }}>Urgent
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="audit_resiko_situation" value="0" {{
                                    $pertanyaan->tinjauanPengendalian?->audit_resiko_situation == '0' ? 'checked' : ''
                                }}>Not Urgent
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-lg-2 col-form-label" for="validationCustom02">Anggaran/ Non Anggaran
                    </label>
                    <div class="col-lg-6">
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="anggaran_status" value="1" {{
                                    $pertanyaan->tinjauanPengendalian?->anggaran_status == '1' ? 'checked' : ''
                                }}>Anggaran
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="anggaran_status" value="0" {{
                                    $pertanyaan->tinjauanPengendalian?->anggaran_status == '0' ? 'checked' : '' }}>Non
                                Anggaran
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="col-lg-2 col-form-label" for="rencana_tindaklanjut">Rencana Tindak Lanjut Siklus
                        Berikutnya
                    </label>
                    <textarea class="form-control" rows="5" id="rencana_tindaklanjut" name="rencana_tindaklanjut"
                        required>{{ $pertanyaan->tinjauanPengendalian?->rencana_tindaklanjut }}</textarea>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
