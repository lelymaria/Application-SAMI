@php
    use Carbon\Carbon;
@endphp
<div class="mb-3 row">
    <label class="col-lg-4 col-form-label" for="validationCustom07">Nama Jadwal
    </label>
    <div class="col-lg-8">
        <input type="text" class="form-control" id="validationCustom07" name="nama_jadwal" placeholder="Masukan Nama Jadwal..."
            value="{{ $update_jadwal->nama_jadwal }}">
    </div>
</div>
<div class="mb-3 row">
    <label class="col-lg-4 col-form-label" for="validationCustom07">Jadwal Mulai
    </label>
    <div class="col-lg-8">
        <input type="date" class="form-control" id="validationCustom07" name="jadwal_mulai"
            value="{{ Carbon::createFromFormat('Y-m-d H:i:s', $update_jadwal->jadwal_mulai)->isoFormat('YYYY-MM-DD') }}">
    </div>
</div>
<div class="mb-3 row">
    <label class="col-lg-4 col-form-label" for="validationCustom07">Jadwal
        Selesai
    </label>
    <div class="col-lg-8">
        <input type="date" class="form-control" id="validationCustom07" name="jadwal_selesai"
        value="{{ Carbon::createFromFormat('Y-m-d H:i:s', $update_jadwal->jadwal_selesai)->isoFormat('YYYY-MM-DD') }}">
    </div>
</div>
<div class="mb-3 row">
    <label class="col-lg-4 col-form-label" for="validationCustom07">Tahun AMI
    </label>
    <div class="col-lg-8">
        <input type="text" class="form-control" id="validationCustom07" name="tahun_ami" placeholder="Contoh: Tahun 2022/2023(Ganjil)"
            value="{{ $update_jadwal->tahun_ami }}">
    </div>
</div>
