<div class="col-12">
    <div class="border-0 shadow-sm card">
        <div class="card-body">
            <h5 class="text-center mb-0">Aktivitas Paket</h5>
            <hr>
            <div class="border shadow-none card">
                <div class="card-body">
                    <div class="text-center">
                        <ul class="list-group list-group-flush">
                            @forelse ($paketHistories as $history)
                                <li class="bg-transparent list-group-item d-flex justify-content-between align-items-center border-top">
                                    <label class="form-label small"><i class="bi bi-clock-history"></i>&nbsp;{{ $history->message }}</label>
                                    <span class="text-muted small">{{ $history->created_at->format('d-m-Y H:i:s') }}</span>
                                </li>
                            @empty
                            <div class="col-md-12 mt-3">
                                <p class="text-center fw-bold small">Tidak ada riwayat</p>
                            </div>
                            @endforelse
                        </ul>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $paketHistories->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
