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
                            @forelse ($pertanyaan as $index => $data_pertanyaan)
                                <tr>
                                    <td>{{ ($pertanyaan->currentPage() - 1) * $pertanyaan->perPage() + $index + 1 }}</td>
                                    <td>{!! Str::limit($data_pertanyaan->list_pertanyaan_standar, 100, '...') !!}</td>
                                    <td>
                                        @if ($data_pertanyaan->ketersediaanDokumen)
                                            <a href="{{ url('/ami/ketersediaan_dokumen/update/' . $data_pertanyaan->ketersediaanDokumen?->id) }}"
                                                class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                    class="fa fa-pencil-alt"></i></a>
                                        @else
                                            <a href="{{ url('/ami/ketersediaan_dokumen/create/' . $data_pertanyaan->id) }}"
                                                class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                    class="fa fa-plus"></i></a>
                                        @endif
                                    </td>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">Data tidak tersedia!</td>
                                </tr>
                            @endforelse
                            </tr>
                        </tbody>
                    </table>
                    {{ $pertanyaan->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
