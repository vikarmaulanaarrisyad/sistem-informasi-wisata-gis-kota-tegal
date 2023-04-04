<x-modal data-backdrop="static" data-keyboard="false">
    <x-slot name="title">
        Tambah Daftar Kategori
    </x-slot>

    @method('POST')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" name="name" autocomplete="off">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="image">Gambar</label>
                <input type="file" name="image" id="image" class="form-control">
                <span class="text-sm text-warning">Gambar harus bertipe jpg, jpeg dan png, ukuran gambar maksimal 2
                    MB</span>
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <button type="button" onclick="submitForm(this.form)" class="btn btn-sm btn-primary" id="submitBtn">
            <span id="spinner-border" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <i class="fas fa-save mr-1"></i>
            Simpan</button>
    </x-slot>

</x-modal>
