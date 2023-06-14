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
                            <li class="nav-item"><a href="#" data-bs-toggle="tab" class="nav-link">Absensi</a>
                            </li>
                            <li class="nav-item"><a href="{{ url('/dokumentasiAmi.foto_kegiatan', ['id' => $undanganAmi->id]) }}"
                                    data-bs-toggle="tab" class="nav-link active show">Foto Kegiatan</a>
                            </li>
                            <li class="nav-item"><a href="#" data-bs-toggle="tab" class="nav-link">Notulensi</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="foto_kegiatan" class="tab-pane fade active show">
                                <form action="{{ url('/dokumentasiAmi/undangan/foto_kegiatan') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="post-input">
                                        <textarea name="caption_foto_kegiatan_ami" id="textarea" cols="30" rows="5" class="form-control bg-transparent"
                                            placeholder="Please type what you want...."></textarea>
                                        <a href="#" class="btn btn-primary light me-1 px-3"
                                            data-bs-toggle="modal" data-bs-target="#cameraModal"><i
                                                class="fa fa-camera m-0"></i> </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="cameraModal">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Upload images</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text">Upload</span>
                                                            <div class="form-file">
                                                                <input type="file" class="form-file-input form-control" name="foto_kegiatan_ami[]" multiple>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Post</button>
                                    </div>
                                </form>

                                <div class="row">
                                    <div class="col-xl-4 col-lg-6 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="new-arrival-product">
                                                    <div class="new-arrivals-img-contnent">
                                                        <img class="img-fluid" src="{{ asset('images/product/1.jpg') }}"
                                                            alt="" />
                                                    </div>
                                                    <div class="new-arrival-content text-left mt-3">
                                                        <p>
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing
                                                            elit. Veniam, deserunt Lorem ipsum dolor sit amet,
                                                            consectetur adipisicing elit. Nam unde vitae obcaecati
                                                            modi perferendis!
                                                        </p>
                                                        <span> <i class="fa fa-calendar"></i> 12-12-2021 </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="new-arrival-product">
                                                    <div class="new-arrivals-img-contnent">
                                                        <img class="img-fluid" src="{{ asset('images/product/1.jpg') }}"
                                                            alt="" />
                                                    </div>
                                                    <div class="new-arrival-content text-left mt-3">
                                                        <p>
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing
                                                            elit. Veniam, deserunt Lorem ipsum dolor sit amet,
                                                            consectetur adipisicing elit. Nam unde vitae obcaecati
                                                            modi perferendis!
                                                        </p>
                                                        <span> <i class="fa fa-calendar"></i> 12-12-2021 </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="new-arrival-product">
                                                    <div class="new-arrivals-img-contnent">
                                                        <img class="img-fluid" src="{{ asset('images/product/1.jpg') }}"
                                                            alt="" />
                                                    </div>
                                                    <div class="new-arrival-content text-left mt-3">
                                                        <p>
                                                            Lorem ipsum dolor, sit amet consectetur adipisicing
                                                            elit. Veniam, deserunt Lorem ipsum dolor sit amet,
                                                            consectetur adipisicing elit. Nam unde vitae obcaecati
                                                            modi perferendis!
                                                        </p>
                                                        <span> <i class="fa fa-calendar"></i> 12-12-2021 </span>
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
        </div>
    </div>
@endsection
