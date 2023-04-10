<x-modal data-backdrop="static" data-keyboard="false" size="modal-lg">
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
                <label for="categories">Kategori</label>
                <select name="categories" id="categories" class="custom-select">
                    <option disabled selected>Pilih salah satu</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
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

    <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" cols="30" rows="10" class="form-control"></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
            <label for="address">Alamat</label>
            <textarea name="address" id="address" cols="30" rows="10" class="form-control"></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
            <label for="open">Hari Buka</label>
            <input type="text" name="open" class="form-control" autocomplete="off">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
            <label for="close">Hari Tutup</label>
            <input type="text" name="close" class="form-control" autocomplete="off">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
            <label for="district">Kecamatan</label>
            <input type="text" name="district" class="form-control" autocomplete="off">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
            <label for="village">Kelurahan/Desa</label>
            <input type="text" name="village" class="form-control" autocomplete="off">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
            <label for="phone">Nomor Telepon</label>
            <input type="text" name="phone" class="form-control" autocomplete="off">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
            <label for="website">Website</label>
            <input type="text" name="website" class="form-control" autocomplete="off">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <label for="location">Latitude dan Longitude</label>
            <input type="text" name="location" id="location" class="form-control" autocomplete="off"
                placeholder="contoh -6.867188302152268, 109.13814360229158">
        </div>
    </div>

    <x-slot name="footer">
        <button type="button" onclick="submitForm(this.form)" class="btn btn-sm btn-primary" id="submitBtn">
            <span id="spinner-border" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <i class="fas fa-save mr-1"></i>
            Simpan</button>
    </x-slot>
</x-modal>
