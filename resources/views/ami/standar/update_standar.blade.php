<div class="mb-3 row">
    <label class="col-lg-4 col-form-label" for="validationCustom07">Pilih Kop Surat
    </label>
    <div class="col-lg-8">
        <select class="default-select wide form-control" id="validationCustom05" name="nama_formulir">
            <option data-display="Select" disabled>Please select</option>
            @foreach ($kop_surat as $kop)
                <option value="{{ $kop->id }}" {{ $kop->id == $update_standar->id_kop_surat ? 'selected' : '' }}>
                    {{ $kop->nama_formulir }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="mb-3 row">
    <label class="col-lg-4 col-form-label" for="validationCustom07">Standar
    </label>
    <div class="col-lg-8">
        <input type="text" class="form-control" id="validationCustom07" name="nama_standar" required
            value="{{ $update_standar->nama_standar }}">
    </div>
</div>
