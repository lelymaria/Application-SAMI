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
                        Monitoring P4MP
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
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="table table-responsive-md" style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Auditee</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($getAuditee as $index => $auditee)
                        <tr>
                            <td>{{ ($getAuditee->currentPage() - 1) * $getAuditee->perPage() + $index + 1 }}
                            </td>
                            <td>
                                @if ($auditee->dataProdi)
                                {{ $auditee->dataProdi->nama_prodi }}
                                @endif
                                @if ($auditee->layananAkademik)
                                {{ $auditee->layananAkademik->nama_layanan }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('monitoring-p4mp.show', $auditee->id) }}"
                                    class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-plus"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">Data tidak tersedia!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $getAuditee->links() }}
            </div>
        </div>
    </div>
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
