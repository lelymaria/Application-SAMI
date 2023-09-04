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
                        </label>
                        <div class="col-lg-6">
                            <select class="default-select wide form-control" id="dataAuditee" name="id_tahun_ami">
                                <option data-display="Select" disabled selected>Please select
                                </option>
                                @foreach ($pelaksanaan_ami as $pelaksanaan)
                                    <option value="{{ $pelaksanaan->id }}">
                                        {{ $pelaksanaan->tahun_ami }}
                                    </option>
                                @endforeach
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

    <div id="data">

    </div>
@endsection

@push('js')
    <script>
        $('body').on('change', '#dataAuditee', function(e) {
            $.ajax({
                url: '/ami/historiami/' + e.target.value,
                type: 'GET',
                success: function(data) {
                    $('#data').html(data);
                }
            })
            console.log();
        })
    </script>
@endpush
