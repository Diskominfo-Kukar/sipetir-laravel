<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
        <i class="bi bi-bell"></i>
        <!-- Display badge only if notifications are >= 10 -->
        <span class="badge bg-danger" style="display: none;">10</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end px-3">
        <!-- Notification Items -->
        <li>
            <a class="dropdown-item px-2" href="#">
                <div class="d-flex align-items-center">
                    <i class="bi bi-envelope me-2"></i>
                    <div class="ms-2">
                        <h6 class="mb-0">New Message</h6>
                        <small class="text-secondary">You have a new message</small>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <a class="dropdown-item p-2" href="#">
                <div class="d-flex align-items-center">
                    <i class="bi bi-person-plus me-2"></i>
                    <div class="ms-2">
                        <h6 class="mb-0">New Follower</h6>
                        <small class="text-secondary">You have a new follower</small>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <a class="dropdown-item p-2" href="#">
                <div class="d-flex align-items-center">
                    <i class="bi bi-check2-circle me-2"></i>
                    <div class="ms-2">
                        <h6 class="mb-0">Task Completed</h6>
                        <small class="text-secondary">Your task is completed</small>
                    </div>
                </div>
            </a>
        </li>
        <!-- Mark as Read Button -->
        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <a class="dropdown-item p-2 text-center" href="#" id="markAsRead">
                Mark as Read
            </a>
        </li>
    </ul>
</li>
