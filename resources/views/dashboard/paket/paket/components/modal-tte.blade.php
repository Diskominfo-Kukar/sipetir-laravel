<div class="modal fade" id="modal-tte" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Navigation Tabs -->
            <ul class="nav nav-tabs" id="tteTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tab-tte-1" data-bs-toggle="tab" href="#tte-1" role="tab" aria-controls="tte-1" aria-selected="true">
                        Verifikasi Tandatangan
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="tab-tte-2" data-bs-toggle="tab" href="#tte-2" role="tab" aria-controls="tte-2" aria-selected="false">
                        Upload Tandatangan
                    </a>
                </li>
            </ul>

            <div class="tab-content" id="tteTabContent">
                <!-- Form Tanda Tangan -->
                <div class="tab-pane fade show active" id="tte-1" role="tabpanel" aria-labelledby="tab-tte-1">
                    <form method="POST" action="
                        @if ($paket->status == 5)
                            {{ route('paket.review') }}
                        @elseif($paket->status == 8)
                            {{ route('paket.berita_acara_TTE_panitia') }}
                        @elseif ($paket->status == 9)
                            {{ route('paket.berita_acara_TTE_ppk') }}
                        @endif
                    ">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="bx bx-file"></i> <span id="judul">Tandatangan</span>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-primary">
                                <i class="fa fa-info-circle"></i> Info
                                <br>
                                Setelah berhasil menandatangani dokumen, permohonan akan dilanjutkan ke tahap selanjutnya.
                            </div>

                            <x-ui.input
                                label="Nama"
                                id="nama"
                                name="nama"
                                required
                                placeholder=""
                                value="{{ $panitia->nama }}"
                                type="text"
                                readonly
                            />
                            <x-ui.input
                                label="Jabatan"
                                id="jabatan"
                                name="jabatan"
                                required
                                placeholder=""
                                value="{{ $panitia->jabatan->nama }}"
                                type="text"
                                readonly
                            />
                            <x-ui.input
                                label="NIP"
                                id="nip"
                                name="nip"
                                required
                                placeholder=""
                                value="{{ $panitia->nip }}"
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
                            <input type="hidden" name="panitia_id" value="{{ $panitia->id }}">
                            <button type="submit" class="btn btn-success mx-2">Proses</button>
                        </div>
                    </form>
                </div>

                <!-- Form Upload -->
                <div class="tab-pane fade" id="tte-2" role="tabpanel" aria-labelledby="tab-tte-2">
                    <form  enctype="multipart/form-data" method="POST" action="{{ route('paket.uploadTtd') }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">
                                <i class="bx bx-upload"></i> <span id="judul">Tandatangan</span>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12 d-flex justify-content-center">
                                @if($panitia->ttd != null)
                                <img class="mb-3" style="width: 240px; height: 240px;" src="{{ asset('storage/' . $panitia->ttd) }}" alt="Tanda Tangan" />
                                @endif
                            </div>
                            <div class="col-12 d-flex justify-content-center">
                                <div class="mb-3 input-group">
                                    <input type="file" class="bg-black form-control" name="ttd">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <input type="hidden" name="panitia_id" value="{{ $panitia->id }}">
                            <button type="submit" class="input-group-text bg-warning border-0">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
