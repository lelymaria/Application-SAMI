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
            <li class="breadcrumb-item"><a href="javascript:void(0)">Standar</a></li>
        </ol>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="table table-responsive-md" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Standar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($standar as $standar)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $standar->nama_standar }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{  url('/ami/ketersediaan_dokumen_preview/'.$standar->id) }}" class="btn btn-secondary shadow btn-xs sharp me-1" target="_blank"><i
                                                    class="fa fa-file-invoice"></i></a>
                                            <a href="{{ url('/ami/ketersediaan_dokumen/' . $standar->id) }}"
                                                class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                    class="fa fa-plus"></i></a>
                                        </div>
                </div>
                </td>
                @endforeach
                </tr>
                </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
@endsection
