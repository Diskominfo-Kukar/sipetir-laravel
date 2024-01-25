@method('patch')




<x-ui.input label="NIK " id="nik" name="nik" required placeholder="nik" value="{{ old('nik', $ppk->nik) }}" />
<x-ui.input label="NIP " id="nip" name="nip" required placeholder="nip" value="{{ old('nip', $ppk->nip) }}" />
<x-ui.input label="Nama ppk" id="nama" name="nama" required placeholder="Nama" value="{{ $ppk->nama }}" />
<label for="opd_id" class="form-label">Pilih Opd</label>
<select required name="opd_id" class="form-control" id="ppk-edit">
    <option></option>
    @foreach ($dataOpd as $opd)
        <option {{ old('opd_id', $ppk->opd_id) == $opd->id ? 'selected' : '' }} value="{{ $opd->id }}">
            {{ ucwords($opd->nama) }}</option>
    @endforeach
</select>
</div>
<x-ui.input label="NO HP" id="no_hp" name="no_hp" required placeholder="no_hp"
    value="{{ old('no_hp', $ppk->no_hp) }}" />
<x-ui.input label="Email" id="email" name="email" required placeholder="email" type="email"
    value="{{ old('email', $ppk->email) }}" />

<x-ui.input label="Username" id="username" name="username" required placeholder="username"
    value="{{ old('username', $ppk->username) }}" />

<x-ui.input label="Password" id="password" name="password" type="password" required placeholder="password"
    value="{{ old('password') }}" />
