@method('patch')


<x-ui.input label="Kategori Review" id="nama" name="nama" required placeholder="Nama"
    value="{{ old('nama', $question->nama) }}" />

<x-ui.input label="" id="kategori_id" name="kategori_id" type="hidden" value="{{ $kategori_id }}" />
