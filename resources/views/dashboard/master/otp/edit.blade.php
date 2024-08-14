@method('patch')


<x-ui.input label="Nama opd" id="nama" name="nama" required placeholder="Nama"
    value="{{ old('nama', $opd->nama) }}" />
