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
                        @forelse ($akun_auditee as $index => $auditee)
                            <tr>
                                <td>{{ ($akun_auditee->currentPage() - 1) * $akun_auditee->perPage() + $index + 1 }}
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
                                    <a href="{{ url('/ami/historiami/'.$auditee->user->id.'/data_auditee') }}"
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
                {{ $akun_auditee->links() }}
            </div>
        </div>
    </div>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example3" class="table table-responsive-md" style="min-width: 845px">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Dokumentasi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Dokumentasi AMI</td>
                            <td><a href=""
                                class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-plus"></i></a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Dokumentasi RTM</td>
                            <td><a href=""
                                class="btn btn-primary shadow btn-xs sharp me-1"><i class="fa fa-plus"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
