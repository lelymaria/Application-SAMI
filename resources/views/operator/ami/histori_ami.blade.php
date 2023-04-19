@extends('layouts.main')
@section('content')
    @include('layouts.navbar')

    <div class="row page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Audit Mutu Internal</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Histori AMI</a></li>
        </ol>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="col-xl-12">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-form-label" for="validationCustom05">Periode
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-lg-6">
                            <select class="default-select wide form-control" id="validationCustom05">
                                <option data-display="Select">Please select</option>
                                <option value="html">HTML</option>
                                <option value="css">CSS</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a one.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <label class="col-md-2 form-control-static">Periode</label>
        <div class="col-md-4">
            <select name="krs_id" class="form-control select-2" data-placeholder="-- Pilih Periode --">
                <option value=""></option>
                <option value="2020080370K007202001">SEMESTER 1 GANJIL TAHUN 2020 / 2021</option>
                <option value="2020080370K010202002">SEMESTER 2 GENAP TAHUN 2020 / 2021</option>
                <option value="2020080370K010202103">SEMESTER 3 GANJIL TAHUN 2021/2022</option>
                <option value="2020080370K010202104">SEMESTER 4 GENAP TAHUN 2021/2022</option>
                <option value="2020080370K010202205">SEMESTER 5 GANJIL TAHUN 2022/2023</option>
                <option value="2020080370K010202206" selected="selected">SEMESTER 6 GENAP TAHUN 2022/2023</option>
            </select>
        </div> --}}
    @endsection
