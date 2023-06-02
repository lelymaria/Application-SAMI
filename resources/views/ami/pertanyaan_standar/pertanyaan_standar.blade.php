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

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pertanyaan Standar</h4>
                @if ($pertanyaan->count()>0)
                <a href="{{ url('/ami/data_standar/update_pertanyaan/' . $standar->id) }}"
                    class="btn btn-rounded btn-secondary btn-xs"><span class="btn-icon-start text-secondary"><i
                            class="fa fa-plus color-secondary"></i>
                    </span>Update</a>
                @else
                <a href="{{ url('/ami/data_standar/tambah_pertanyaan/' . $standar->id) }}"
                    class="btn btn-rounded btn-secondary btn-xs"><span class="btn-icon-start text-secondary"><i
                            class="fa fa-plus color-secondary"></i>
                    </span>Add</a>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display" style="min-width: 845px">
                        <tbody>
                            @foreach ($pertanyaan as $pertanyaan)
                                <p>
                                    {!! $pertanyaan->list_pertanyaan_standar !!}
                                </p>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
