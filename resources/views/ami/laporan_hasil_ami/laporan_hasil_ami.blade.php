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
            <li class="breadcrumb-item"><a href="javascript:void(0)">Laporan Hasil AMI</a></li>
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
            <div class="card-header">
                <h4 class="card-title">Laporan Hasil AMI</h4>
                @if ($laporanAmi->count() > 0)
                @else
                    @can('lead')
                        <button type="button" class="btn btn-rounded btn-secondary btn-xs" data-bs-toggle="modal"
                            data-bs-target="#basicModal"><span class="btn-icon-start text-secondary"><i
                                    class="fa fa-plus color-secondary"></i>
                            </span>Add</button>
                    @endcan
                    @can('anggota')
                        <button type="button" class="btn btn-rounded btn-secondary btn-xs" data-bs-toggle="modal"
                            data-bs-target="#basicModal"><span class="btn-icon-start text-secondary"><i
                                    class="fa fa-plus color-secondary"></i>
                            </span>Add</button>
                    @endcan
                @endif
                {{-- Modal --}}
                <div class="modal fade" id="basicModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Laporan Hasil AMI</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-validate">
                                    <form class="needs-validation" novalidate="" action="{{ url('/ami/laporan_ami/') }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom07">Save As
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="validationCustom07"
                                                        name="file_nama">
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input form-control"
                                                        name="upload_laporan">
                                                </div>
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                            <small class="text-danger">Maksimal size file: 3MB</small>
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
            <div class="card-body">
                @foreach ($laporanAmi as $laporan)
                    <div class="d-xl-flex d-block align-items-start description-bx">
                        <div>
                            <h4 class="card-title">{{ $laporan->file_nama }}</h4>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        @can('lead')
                            <a class="btn btn-dark light me-3 btn-edit" href="javascript:void(0);"
                                data-url="{{ url('/ami/laporan_ami/' . $laporan->id) }}" data-bs-toggle="modal"
                                data-bs-target="#updateLaporan"><i class="fas fa-pencil-alt me-3 scale4"></i>Update Pedoman</a>
                        @endcan
                        @can('anggota')
                            <a class="btn btn-dark light me-3 btn-edit" href="javascript:void(0);"
                                data-url="{{ url('/ami/laporan_ami/' . $laporan->id) }}" data-bs-toggle="modal"
                                data-bs-target="#updateLaporan"><i class="fas fa-pencil-alt me-3 scale4"></i>Update Pedoman</a>
                        @endcan
                        <a href="{{ asset('storage/' . $laporan->file_laporan_ami) }}" class="btn btn-primary" target="_blank"><i
                                class="las la-download scale5 me-3"></i>Download Pedoman</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- update --}}
    <div class="modal fade" id="updateLaporan">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Laporan Hasil AMI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body" id="editModalBody">
                    <div class="form-validate">
                        <form class="needs-validation" novalidate="" action="{{ url('/ami/laporan_ami/') }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row" id="formBodyEdit">

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
@endsection

@push('js')
    <script>
        $('body').on('click', '.btn-edit', function() {
            let url = $(this).data('url');
            console.log(url);
            $('#editModalBody form').attr('action', url)
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $('#editModalBody .row').html(data);
                }
            })
        })
    </script>
@endpush
