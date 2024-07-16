<div class="modal fade" id="modal-tte" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="
                    @if ($paket->status == 4)
                        {{ route('paket.review') }}
                    @elseif($paket->status == 6)
                        {{ route('paket.berita_acara_TTE_panitia') }}
                    @elseif ($paket->status == 7)
                        {{ route('paket.berita_acara_TTE_ppk') }}
                    @endif
                ">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <i class="bx bx-file"></i> <span id="judul">Tandatangan Secara Elektronik</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-primary">
                        <i class="fa fa-info-circle"></i> Info
                        <br>
                        Setelah berhasil menandatangani dokumen, Permohonan akan dilanjutkan ke tahap selanjutnya.
                    </div>
                    <x-ui.input
                        label="Nama"
                        id="nama"
                        name="nama"
                        required
                        placeholder=""
                        value="{{ $panitia }}"
                        type="text"
                        readonly
                    />
                    <x-ui.input
                        label="Jabatan"
                        id="jabatan"
                        name="jabatan"
                        required
                        placeholder=""
                        value="{{ $panitia_data->jabatan }}"
                        type="text"
                        readonly
                    />
                    <x-ui.input
                        label="NIP"
                        id="nip"
                        name="nip"
                        required
                        placeholder=""
                        value="{{ $panitia_data->nip }}"
                        type="text"
                        readonly
                    />
                    <x-ui.input
                        label="Passphrase"
                        id="passphrase"
                        name="passphrase"
                        required
                        placeholder="Passphrase Anda.."
                        type="password"
                        autocomplete="false"
                    />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                    <button type="submit" class="btn btn-success mx-2">Proses TTE</button>
                </div>
            </form>
        </div>
    </div>
</div>
