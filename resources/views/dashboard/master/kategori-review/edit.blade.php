@method('patch')


<x-ui.input label="Kategori Review" id="nama" name="nama" required placeholder="Nama"
    value="{{ old('nama', $KategoriReview->nama) }}" />

<div class="mb-2">
    <label for="deskripsi" class="form-label">Deskripsi</label>
    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3"
        placeholder="deskripsi" required>{{ old('deskripsi', $KategoriReview->deskripsi) }}</textarea>
    @error('deskripsi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
