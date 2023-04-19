@extends('layouts.main')
@section('content')
    @include('layouts.navbar')

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Manage User</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Kepala P4MP</a></li>
        </ol>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Akun</h4>
                <button type="button" class="btn btn-rounded btn-secondary btn-xs" data-bs-toggle="modal"
                    data-bs-target="#basicModal"><span class="btn-icon-start text-secondary"><i
                            class="fa fa-plus color-secondary"></i>
                    </span>Add</button>
                {{-- Modal --}}
                <div class="modal fade" id="basicModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Akun Kepala P4MP</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-validate">
                                    <form class="needs-validation" novalidate="">
                                        <div class="row">

                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom06">Periode
                                                    Jabatan
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="validationCustom06"
                                                        placeholder="$21.60" required="">
                                                    <div class="invalid-feedback">
                                                        Please enter a Currency.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom07">Email
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="validationCustom07"
                                                        placeholder="http://example.com" required="">
                                                    <div class="invalid-feedback">
                                                        Please enter a url.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom08">NIP
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="validationCustom08"
                                                        placeholder="212-999-0000" required="">
                                                    <div class="invalid-feedback">
                                                        Please enter a phone no.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom09">Nama<span
                                                        class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="validationCustom09"
                                                        placeholder="5" required="">
                                                    <div class="invalid-feedback">
                                                        Please enter a digits.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
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
                                <th>NIP</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Periode Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Tiger Nixon</td>
                                <td>2003073</td>
                                <td>tiger@gmail.com</td>
                                <td><a href="javascript:void(0);"><strong>kepala p4mp</strong></a></td>
                                <td><a href="javascript:void(0);"><strong>2019 - 2023</strong></a></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="/updateakunkepalap4mp" class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                class="fas fa-pencil-alt"></i></a>
                                        <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                                class="fa fa-trash"></i></a>
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
