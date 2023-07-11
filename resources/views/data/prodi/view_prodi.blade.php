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
                            Data
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
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Data</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Data Program Studi</a></li>
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
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Prodi</h4>
                <button type="button" class="btn btn-rounded btn-secondary btn-xs" data-bs-toggle="modal"
                    data-bs-target="#basicModal"><span class="btn-icon-start text-secondary"><i
                            class="fa fa-plus color-secondary"></i>
                    </span>Add</button>
                {{-- Modal --}}
                <div class="modal fade" id="basicModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Prodi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-validate">
                                    <form class="needs-validation" novalidate="" action="{{ url('/data/dataprodi') }}"
                                        method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom07">Pilih
                                                    Jurusan
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select class="default-select wide form-control" id="validationCustom05"
                                                        name="nama_jurusan">
                                                        <option data-display="Select">Please select</option>
                                                        @foreach ($jurusan as $jurusan)
                                                            <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom07">Nama Prodi
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="validationCustom07"
                                                        name="nama_prodi" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="table table-responsive-md" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jurusan</th>
                                <th>Prodi</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prodi as $prodi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $prodi->jurusan->nama_jurusan }}</td>
                                    <td>{{ $prodi->nama_prodi }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="#" data-url="{{ url('/data/dataprodi/' . $prodi->id) }}"
                                                class="btn btn-primary shadow btn-xs sharp me-1 btn-edit"
                                                data-bs-toggle="modal" data-bs-target="#updateProdi"><i
                                                    class="fas fa-pencil-alt"></i></a>
                                            <form action="{{ url('/data/dataprodi/' . $prodi->id) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger shadow btn-xs sharp"><i
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
    {{-- update --}}
    <div class="modal fade" id="updateProdi">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Prodi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body" id="editModalBody">
                    <div class="form-validate">
                        <form class="needs-validation" novalidate="" action="{{ url('/data/dataprodi') }}"
                            method="post">
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
            $('#editModalBody form').attr('action', url)
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('#editModalBody .row').html(data);
                }
            })
        })
    </script>
@endpush
