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

<div class="col-xl-12">
    <div class="card">
        <div class="card-body">
            <div class="profile-tab">
                <div class="custom-tab-1">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a href="#undangan" data-bs-toggle="tab" class="nav-link active show">Undangan</a>
                        </li>
                        <li class="nav-item"><a href="#absensi" data-bs-toggle="tab" class="nav-link">Absensi</a>
                        </li>
                        <li class="nav-item"><a href="#foto-kegiatan" data-bs-toggle="tab" class="nav-link">Foto Kegiatan</a>
                        </li>
                        <li class="nav-item"><a href="#notulensi" data-bs-toggle="tab" class="nav-link">Notulensi</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="undangan" class="tab-pane fade active show">
                            @include('ami.dokumentasi_rtm.undangan.undangan_rtm')
                        </div>
                        <div id="absensi" class="tab-pane fade">
                            @include('ami.dokumentasi_rtm.absensi.absensi_rtm')
                        </div>
                        <div id="foto-kegiatan" class="tab-pane fade">
                            @include('ami.dokumentasi_rtm.foto_kegiatan.foto_kegiatan_rtm')
                        </div>
                        <div id="notulensi" class="tab-pane fade">
                            @include('ami.dokumentasi_rtm.notulensi.notulensi_rtm')
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="replyModal">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Post Reply</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <textarea class="form-control" rows="4">Message</textarea>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">btn-close</button>
                                <button type="button" class="btn btn-primary">Reply</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
