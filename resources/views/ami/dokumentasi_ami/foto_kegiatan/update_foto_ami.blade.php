<div class="mb-3 row">
    <div class="col-lg-8">
        <textarea name="caption_foto_kegiatan_ami" id="textarea" rows="8" class="form-control bg-transparent" placeholder="Please type what you want....">{{ $update_foto_kegiatan_ami->caption_foto_kegiatan_ami }}</textarea>
    </div>
</div>
<div class="input-group mb-3">
    <div class="form-file">
        <input type="file" class="form-file-input form-control" name="foto_kegiatan_ami[]" multiple>
    </div>
    <span class="input-group-text">Upload</span>
</div>
<small class="text-danger">Maksimal size file: 3MB</small>
