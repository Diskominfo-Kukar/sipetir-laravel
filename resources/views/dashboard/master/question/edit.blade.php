@method('patch')


<x-ui.input label="Kategori Review" id="nama" name="nama" required placeholder="Nama"
    value="{{ old('nama', $question->nama) }}" />
<div class="mb-2">
    <label for="deskripsi" class="form-label">Deskripsi</label>
    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3"
        placeholder="deskripsi" required>{{ old('deskripsi', $question->deskripsi) }}</textarea>
    @error('deskripsi')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<x-ui.input label="" id="kategori_id" name="kategori_id" type="hidden" value="{{ $kategori_id }}" />

<input id="kategori_id" type="hidden" name="kategori_id" value="{{ $kategori_id }}" />
<input id="parent_id" type="hidden" name="parent_id" value="{{ $parent_id }}">
