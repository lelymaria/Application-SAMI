<div class="mb-3 row">
    <label class="col-lg-4 col-form-label" for="validationCustom07">Pilih Jurusan
        <span class="text-danger">*</span>
    </label>
    <div class="col-lg-8">
        <select class="default-select wide form-control" id="validationCustom05" name="nama_jurusan">
            <option data-display="Select">Please select</option>
            @foreach ($jurusan as $jurusan)
                <option value="{{ $jurusan->id }}" {{ $jurusan->id==$update_prodi->id_jurusan?"selected":"" }}>{{ $jurusan->nama_jurusan }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="mb-3 row">
    <label class="col-lg-4 col-form-label" for="validationCustom07">Nama Prodi
        <span class="text-danger">*</span>
    </label>
    <div class="col-lg-8">
        <input type="text" class="form-control" id="validationCustom07" name="nama_prodi" required
            value="{{ $update_prodi->nama_prodi }}">
    </div>
</div>
