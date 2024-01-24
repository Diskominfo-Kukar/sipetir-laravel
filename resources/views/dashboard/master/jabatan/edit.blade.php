@method('patch')


<x-ui.input label="Nama Jabatan" id="nama" name="nama" required placeholder="Nama"
    value="{{ old('nama', $jabatan->nama) }}" />
