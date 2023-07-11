@php
    use Illuminate\Support\Str;
@endphp
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
            <li class="breadcrumb-item"><a href="javascript:void(0)">Pertanyaan</a></li>
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
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="table table-responsive-md" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Daftar Pertanyaan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pertanyaan as $pertanyaan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{!! Str::limit($pertanyaan->list_pertanyaan_standar, 100, '...') !!}</td>
                                    <td>
                                        @if ($pertanyaan->ketersediaanDokumen)
                                            <a href="{{ url('/ami/ketersediaan_dokumen/update/' . $pertanyaan->ketersediaanDokumen?->id) }}"
                                                class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                    class="fa fa-pencil-alt"></i></a>
                                        @else
                                            <a href="{{ url('/ami/ketersediaan_dokumen/create/' . $pertanyaan->id) }}"
                                                class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                    class="fa fa-plus"></i></a>
                                        @endif
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
