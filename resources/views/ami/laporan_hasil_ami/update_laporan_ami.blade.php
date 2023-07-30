<div class="mb-3 row">
    <label class="col-lg-4 col-form-label" for="validationCustom07">Save As
    </label>
    <div class="col-lg-8">
        <input type="text" class="form-control" id="validationCustom07" name="file_nama">
    </div>
</div>
<div class="input-group mb-3">
    <div class="form-file">
        <input type="file" class="form-file-input form-control" name="upload_laporan">
    </div>
    <span class="input-group-text">Upload</span>
</div>
<p>Dokumen sebelumnya <a href="{{ asset('storage/' . $update_laporan_ami->file_laporan_ami) }}" target="_blank">liat
        disini</a></p>
<br> <br>
<small class="text-danger">Maksimal size file: 3MB</small>
