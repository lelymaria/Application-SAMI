@extends('layouts.main')
@section('content')
    @include('layouts.navbar')

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Audit Mutu Internal</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Hasil Checklist AMI</a></li>
        </ol>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Standar</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Standar Sarana dan Prasarana</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-secondary shadow btn-xs sharp me-1"><i
                                                class="fa fa-file-invoice"></i></a>
                                        <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                class="fa fa-plus"></i></a>
                                        <a href="#" class="btn btn-success shadow btn-xs sharp me-1"><i
                                                class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-info shadow btn-xs sharp me-1"><i
                                                class="las la-download"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
