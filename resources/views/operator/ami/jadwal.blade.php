@extends('layouts.main')
@section('content')
@include('layouts.navbar')

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Audit Mutu Internal</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Jadwal AMI</a></li>
        </ol>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Jadwal</h4>
                <button type="button" class="btn btn-rounded btn-secondary btn-xs" data-bs-toggle="modal"
                    data-bs-target="#basicModal"><span class="btn-icon-start text-secondary"><i
                            class="fa fa-plus color-secondary"></i>
                    </span>Add</button>
                {{-- Modal --}}
                <div class="modal fade" id="basicModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Jadwal</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-validate">
                                    <form class="needs-validation" novalidate="">
                                        <div class="row">
                                            <div class="mb-3 row">
                                                <label class="col-lg-4 col-form-label" for="validationCustom07">Jadwal Mulai
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
                                                <label class="col-lg-4 col-form-label" for="validationCustom07">Jadwal Selesai
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
                                                <label class="col-lg-4 col-form-label" for="validationCustom07">Nama Jadwal
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
                                                <label class="col-lg-4 col-form-label" for="validationCustom07">Status
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">Proses</label>
                                                      </div>
                                                      <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">Pending</label>
                                                      </div>

                                                      <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">Selesai</label>
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
                                <th>Nama Jadwal</th>
                                <th>Pelaksanaan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Visitasi</td>
                                <td>13/02/2023 - 14/03/2023</td>
                                <td><a href="javascript:void(0);"><strong>Proses</strong></a></td>
                                <td>
                                    <div class="d-flex">
                                        <a href="#" class="btn btn-primary shadow btn-xs sharp me-1"><i
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
