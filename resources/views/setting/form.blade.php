<x-modal data-backdrop="static" data-keyboard="false" size="modal-lg">
    <x-slot name="title">
        Tambah Tentang
    </x-slot>

    @method('POST')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title">Judul</label>
                <input type="text" class="form-control" name="title" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" cols="30" rows="30" class="form-control"></textarea>
        </div>
    </div>

    <x-slot name="footer">
        <button type="button" onclick="submitForm(this.form)" class="btn btn-sm btn-primary" id="submitBtn">
            <span id="spinner-border" class="spinner-border spinner-border-sm" role="status"
                aria-hidden="true"></span>
            <i class="fas fa-save mr-1"></i>
            Simpan</button>
    </x-slot>
</x-modal>
