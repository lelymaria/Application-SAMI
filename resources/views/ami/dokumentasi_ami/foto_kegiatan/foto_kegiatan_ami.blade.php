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
                            <li class="nav-item"><a
                                    href="{{ url('/dokumentasiAmi/' . $undanganAmi->id . '/daftar_hadir_ami') }}"
                                    class="nav-link">Daftar Hadir</a>
                            </li>
                            <li class="nav-item"><a
                                    href="{{ url('/dokumentasiAmi/' . $undanganAmi->id . '/foto_kegiatan_ami') }}"
                                    class="nav-link active show">Foto Kegiatan</a>
                            </li>
                            <li class="nav-item"><a
                                    href="{{ url('/dokumentasiAmi/' . $undanganAmi->id . '/notulensi_ami') }}"
                                    class="nav-link">Notulensi</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="foto_kegiatan" class="tab-pane fade active show">
                                <form action="{{ url('/dokumentasiAmi/' . $undanganAmi->id . '/foto_kegiatan_ami') }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    @can('operator')
                                    <div class="post-input">
                                        <textarea name="caption_foto_kegiatan_ami" id="textarea" cols="30" rows="5"
                                            class="form-control bg-transparent" placeholder="Please type what you want...."></textarea>
                                        <a href="#" class="btn btn-primary light me-1 px-3" data-bs-toggle="modal"
                                            data-bs-target="#cameraModal"><i class="fa fa-camera m-0"></i> </a>
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
                                                                <input type="file" class="form-file-input form-control"
                                                                    name="foto_kegiatan_ami[]" multiple>
                                                            </div>
                                                        </div>
                                                        <small class="text-danger">Maksimal size file: 3MB</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Post</button>
                                    </div>
                                    @endcan
                                </form>

                                <div class="row">
                                    @foreach ($foto_kegiatan_ami as $kegiatan)
                                        <div class="col-xl-4 col-lg-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="new-arrival-product">
                                                        <div class="bootstrap-carousel">
                                                            <div id="carouselExampleIndicators2" class="carousel slide"
                                                                data-bs-ride="carousel">
                                                                <div class="carousel-indicators">
                                                                    @php
                                                                        $file_foto_kegiatan_ami = json_decode($kegiatan->file_foto_kegiatan_ami);
                                                                    @endphp
                                                                    @foreach ($file_foto_kegiatan_ami as $index => $foto)
                                                                        <button type="button"
                                                                            data-bs-target="#carouselExampleIndicators2"
                                                                            data-bs-slide-to="{{ $index }}"
                                                                            class="{{ $index == 0 ? 'active' : '' }}"
                                                                            aria-label="Slide {{ $index + 1 }}"></button>
                                                                    @endforeach
                                                                </div>
                                                                <div class="carousel-inner">
                                                                    @foreach ($file_foto_kegiatan_ami as $index => $foto)
                                                                        <div
                                                                            class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                                            <img class="d-block w-100"
                                                                                src="{{ asset('storage/' . $foto) }}"
                                                                                alt="Slide {{ $index + 1 }}">
                                                                        </div>
                                                                    @endforeach

                                                                </div>
                                                                <button class="carousel-control-prev" type="button"
                                                                    data-bs-target="#carouselExampleIndicators2"
                                                                    data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button"
                                                                    data-bs-target="#carouselExampleIndicators2"
                                                                    data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="new-arrival-content text-left mt-3">
                                                            <p>
                                                                {{ $kegiatan->caption_foto_kegiatan_ami }}
                                                            </p>
                                                            <span><i class="fa fa-calendar"></i>
                                                                {{ $kegiatan->created_at->format('l, d F Y') }}</span>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <a href="{{ url('/dokumentasiAmi/download_foto_kegiatan_ami/' . $kegiatan->id) }}"
                                                                class="btn btn-secondary shadow btn-xs sharp me-1"><i
                                                                    class="las la-download"></i></a>
                                                                    @can('operator')
                                                                    <a href="#"
                                                                        data-url="{{ url('/dokumentasiAmi/foto_kegiatan_ami/' . $kegiatan->id) }}"
                                                                        class="btn btn-primary shadow btn-xs sharp me-1 btn-edit"
                                                                        data-bs-toggle="modal" data-bs-target="#updateFotoAmi"><i
                                                                            class="fas fa-pencil-alt"></i></a>
                                                                    <button class="btn btn-danger shadow btn-xs sharp btn-delete"
                                                                        data-url="{{ url('/dokumentasiAmi/foto_kegiatan_ami/' . $kegiatan->id) }}"><i
                                                                            class="fa fa-trash"></i></button>
                                                                    @endcan
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- update --}}
    <div class="modal fade" id="updateFotoAmi">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Foto Kegiatan AMI</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body" id="editModalBody">
                    <div class="form-validate">
                        <form class="needs-validation" novalidate=""
                            action="{{ url('/dokumentasiAmi/foto_kegiatan_ami/' . $undanganAmi->id) }}" method="post"
                            enctype="multipart/form-data">
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
