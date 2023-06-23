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
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Data</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Standar</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pertanyaan Standar</a></li>
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
            <form action="{{ url('/ami/data_standar/pertanyaan/'.$standar->id) }}" method="post">
                @csrf
                <div class="card-header">
                    <h4 class="card-title">Tambah Pertanyaan Standar</h4>
                    <button type="submit" class="btn btn-rounded btn-primary btn-xs">Simpan</button>
                </div>
                <div class="card-body">
                    <textarea class="form-control" rows="15" name="list_pertanyaan_standar"></textarea>
                </div>
            </form>
        </div>
    </div>
@endsection
