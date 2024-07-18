 <div class="col-12">
    <div class="border-0 shadow-sm card">
        <div class="card-body">
            <h5 class="mb-0">Berita Acara Pengumuman</h5>
            <hr>
            <div class="border shadow-none card">
                <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="d-flex justify-content-center">
                        <form action="{{ route('paket.upload_berita_acara_3') }}" enctype="multipart/form-data" method="POST" class="d-flex align-items-center">
                            @csrf
                            <input type="hidden" name="paket_id" value="{{ $paket->id }}">
                            <div class="input-group">
                                <input type="file" class="form-control" name="dokumen" style="max-width: 300px;">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-file-pdf"></i>
                                    Upload berita acara pengumuman
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
