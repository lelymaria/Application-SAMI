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
                            <li class="nav-item"><a
                                    href="{{ url('/dokumentasiAmi/' . $undanganAmi->id . '/daftar_hadir_ami') }}"
                                    class="nav-link">Daftar Hadir</a>
                            </li>
                            <li class="nav-item"><a
                                    href="{{ url('/dokumentasiAmi/' . $undanganAmi->id . '/foto_kegiatan_ami') }}"
                                    class="nav-link">Foto Kegiatan</a>
                            </li>
                            </li>
                            <li class="nav-item"><a
                                    href="{{ url('/dokumentasiAmi/' . $undanganAmi->id . '/notulensi_ami') }}"
                                    class="nav-link active show">Notulensi</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="absensi" class="tab-pane fade active show">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-rounded btn-secondary btn-xs"
                                                    data-bs-toggle="modal" data-bs-target="#basicModal"><span
                                                        class="btn-icon-start text-secondary"><i
                                                            class="fa fa-plus color-secondary"></i>
                                                    </span>Add
                                                </button>
                                            </div>
                                            {{-- Modal --}}
                                            <div class="modal fade" id="basicModal">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Upload Notulensi</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-validate">
                                                                <form class="needs-validation" novalidate=""
                                                                    action="{{ url('/dokumentasiAmi/' . $undanganAmi->id . '/notulensi_ami') }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="input-group mb-3">
                                                                            <div class="form-file">
                                                                                <input type="file"
                                                                                    class="form-file-input form-control"
                                                                                    name="file_notulensi_ami">
                                                                            </div>
                                                                            <span class="input-group-text">Upload</span>
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger light"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
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
                                                            @foreach ($notulensiAmi as $notulensi)
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $notulensi->file_nama }}</td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <a href="#"
                                                                            data-url="{{ url('/dokumentasiAmi/notulensi_ami/' . $notulensi->id) }}"
                                                                            class="btn btn-primary shadow btn-xs sharp me-1 btn-edit"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#updateNotulensi"><i
                                                                                class="fas fa-pencil-alt"></i></a>
                                                                        <form
                                                                            action="{{ url('/dokumentasiAmi/notulensi_ami/' . $notulensi->id) }}"
                                                                            method="post">
                                                                            @method('delete')
                                                                            @csrf
                                                                            <button
                                                                                class="btn btn-danger shadow btn-xs sharp"><i
                                                                                    class="fa fa-trash"></i></button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
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

    {{-- update --}}
    <div class="modal fade" id="updateNotulensi">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Daftar Hadir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body" id="editModalBody">
                    <div class="form-validate">
                        <form class="needs-validation" novalidate=""
                            action="{{ url('/dokumentasiAmi/daftar_hadir_ami/') }}" method="post"
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
