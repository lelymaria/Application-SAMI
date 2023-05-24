@php
    use Carbon\Carbon;
@endphp
<div class="mb-3 row">
    <label class="col-lg-4 col-form-label" for="validationCustom07">Nama Jadwal
        <span class="text-danger">*</span>
    </label>
    <div class="col-lg-8">
        <input type="text" class="form-control" id="validationCustom07" name="nama_jadwal" required
            value="{{ $update_jadwal->nama_jadwal }}">
    </div>
</div>
<div class="mb-3 row">
    <label class="col-lg-4 col-form-label" for="validationCustom07">Jadwal Mulai
        <span class="text-danger">*</span>
    </label>
    <div class="col-lg-8">
        <input type="date" class="form-control" id="validationCustom07" name="jadwal_mulai" required
            value="{{ Carbon::createFromFormat('Y-m-d H:i:s', $update_jadwal->jadwal_mulai)->isoFormat('YYYY-MM-DD') }}">
    </div>
</div>
<div class="mb-3 row">
    <label class="col-lg-4 col-form-label" for="validationCustom07">Jadwal
        Selesai
        <span class="text-danger">*</span>
    </label>
    <div class="col-lg-8">
        <input type="date" class="form-control" id="validationCustom07" name="jadwal_selesai" required
        value="{{ Carbon::createFromFormat('Y-m-d H:i:s', $update_jadwal->jadwal_selesai)->isoFormat('YYYY-MM-DD') }}">
    </div>
</div>
<div class="mb-3 row">
    <label class="col-lg-4 col-form-label" for="validationCustom07">Tahun AMI
        <span class="text-danger">*</span>
    </label>
    <div class="col-lg-8">
        <input type="text" class="form-control" id="validationCustom07" name="tahun_ami" required
            value="{{ $update_jadwal->tahun_ami }}">
    </div>
</div>
<div class="mb-3 row">
    <label class="col-lg-4 col-form-label" for="validationCustom07">Status
        <span class="text-danger">*</span>
    </label>
    <div class="col-lg-8">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="status"
                value="proses" {{ $update_jadwal->status == "proses" ? 'checked' : '' }}>
            <label class="form-check-label" for="flexSwitchCheckDefault">Proses</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="status"
                value="pending" {{ $update_jadwal->status == "pending" ? 'checked' : '' }}>
            <label class="form-check-label" for="flexSwitchCheckChecked">Pending</label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="status"
                value="selesai" {{ $update_jadwal->status == "selesai" ? 'checked' : '' }}>
            <label class="form-check-label" for="flexSwitchCheckChecked">Selesai</label>
        </div>
    </div>
</div>
