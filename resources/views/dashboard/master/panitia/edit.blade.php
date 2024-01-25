@method('patch')




<x-ui.input label="NIK " id="nik" name="nik" required placeholder="nik"
    value="{{ old('nik', $panitia->nik) }}" />
<x-ui.input label="NIP " id="nip" name="nip" required placeholder="nip"
    value="{{ old('nip', $panitia->nip) }}" />
<x-ui.input label="Nama Panitia" id="nama" name="nama" required placeholder="Nama"
    value="{{ $panitia->nama }}" />
<label for="jabatan_id" class="form-label">Pilih Jabatan</label>
<select required name="jabatan_id" class="form-control" id="panitia-edit">
    <option></option>
    @foreach ($dataJabatan as $jabatan)
        <option {{ old('jabatan_id', $panitia->jabatan_id) == $jabatan->id ? 'selected' : '' }}
            value="{{ $jabatan->id }}">
            {{ ucwords($jabatan->nama) }}</option>
    @endforeach
</select>
</div>
<x-ui.input label="NO HP" id="no_hp" name="no_hp" required placeholder="No HP"
    value="{{ old('no_hp', $panitia->no_hp) }}" />
<x-ui.input label="Email" id="email" name="email" required placeholder="email" type="email"
    value="{{ old('email', $panitia->email) }}" />

<x-ui.input label="Username" id="username" name="username" required placeholder="username"
    value="{{ old('username', $panitia->username) }}" />

<x-ui.input label="Password" id="password" name="password" type="password" required placeholder="password"
    value="{{ old('password') }}" />
