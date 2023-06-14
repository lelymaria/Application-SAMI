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
                            <li class="nav-item"><a href="#" data-bs-toggle="tab"
                                    class="nav-link active show">Absensi</a>
                            </li>
                            <li class="nav-item"><a href="#" data-bs-toggle="tab" class="nav-link ">Foto
                                    Kegiatan</a>
                            </li>
                            <li class="nav-item"><a href="#" data-bs-toggle="tab" class="nav-link">Notulensi</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="absensi" class="tab-pane fade active show">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-rounded btn-secondary btn-xs" data-bs-toggle="modal"
                                                    data-bs-target="#basicModal"><span class="btn-icon-start text-secondary"><i
                                                            class="fa fa-plus color-secondary"></i>
                                                    </span>Add
                                                </button>
                                            </div>
                                            {{-- Modal --}}
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="example3" class="display" style="min-width: 845px">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Febby</td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <a href="#" data-url="#"
                                                                        class="btn btn-primary shadow btn-xs sharp me-1 btn-edit" data-bs-toggle="modal"
                                                                        data-bs-target="#updateProdi"><i class="fas fa-pencil-alt"></i></a>
                                                                    <form action="#" method="post">
                                                                        <button class="btn btn-danger shadow btn-xs sharp"><i
                                                                                class="fa fa-trash"></i></button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="basicModal">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Upload Daftar Hadir</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-validate">
                                                        <form class="needs-validation" novalidate="" action="#" method="post"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="mb-3 row">
                                                                    <label class="col-lg-4 col-form-label" for="validationCustom07">Deskripsi
                                                                        <span class="text-danger">*</span>
                                                                    </label>
                                                                    <div class="col-lg-8">
                                                                        <textarea rows="8" class="form-control" name="deskripsi" placeholder="Deskripsi"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="input-group mb-3">
                                                                    <div class="form-file">
                                                                        <input type="file" class="form-file-input form-control" name="file_pedoman">
                                                                    </div>
                                                                    <span class="input-group-text">Upload</span>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                    <button type="button" class="btn btn-danger light"
                                        data-bs-dismiss="modal">btn-close</button>
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
