<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        <!-- Display badge only if notifications are >= 10 -->
        <span class="badge bg-danger" style="display: none;">10</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end px-3">
        <!-- Notification Items -->
        @if (session()->has('notifikasi'))
            @forelse (session('notifikasi') as $notif)
                <li>
                    <a class="dropdown-item px-2" href="{{ $notif->target_url }}">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-envelope me-2"></i>
                            <div class="ms-2">
                                <h6 class="mb-0">{{ $notif->message }}</h6>
                                <small class="text-secondary">{{ $notif->message }}</small>
                            </div>
                        </div>
                    </a>
                </li>
            @empty
                <li>
                    <div class="dropdown-item px-2">
                        <div class="d-flex align-items-center">
                            <div class="ms-2">
                                <h6 class="mb-0">Tidak ada Pemberitahuan Terbaru</h6>
                            </div>
                        </div>
                    </div>
                </li>
            @endforelse
        @endif
        <!-- Mark as Read Button -->
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <a class="dropdown-item p-2 text-center" href="#" id="markAsRead">
                Tandai telah dibaca
            </a>
        </li>
    </ul>
</li>
