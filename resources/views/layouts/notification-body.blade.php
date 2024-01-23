<div tabindex="-1" role="menu" aria-hidden="true" {{ $attributes }}>
    <div class="dropdown-menu-header mb-0">
        <div class="dropdown-menu-header-inner bg-deep-blue">
            <div class="menu-header-image opacity-1" style="background-image: url('{{ asset('assets/backend/images/dropdown-header/city3.jpg') }}');"></div>
            <div class="menu-header-content text-dark">
                <h5 class="menu-header-title">Notifications</h5>
                <h6 class="menu-header-subtitle">You have
                    <b>21</b> unread messages
                </h6>
            </div>
        </div>
    </div>
    <ul class="tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered p-3">
        <li class="nav-item">
            <a role="tab" class="nav-link active"
                data-bs-toggle="tab" href="#tab-belum-{{ $attributes['group'] }}">
                <span>Belum Dibaca</span>
            </a>
        </li>
        <li class="nav-item">
            <a role="tab" class="nav-link" data-bs-toggle="tab" href="#tab-sudah-{{ $attributes['group'] }}">
                <span>Sudah Dibaca</span>
            </a>
        </li>
        
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab-belum-{{ $attributes['group'] }}" role="tabpanel">
            <div class="scroll-area-sm">
                <div class="scrollbar-container">
                    <div class="p-3">
                        <div class="notifications-box">
                            <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title">All Hands Meeting</h4>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <p>
                                                Yet another one, at
                                                <span class="text-success">15:00 PM</span>
                                            </p>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-timeline-item dot-success vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title">
                                                Build the production release
                                                <span class="badge bg-danger ms-2">NEW</span>
                                            </h4>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="vertical-timeline-item dot-info vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title">This dot has an info state</h4>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title">All Hands Meeting</h4>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <p>
                                                Yet another one, at
                                                <span class="text-success">15:00 PM</span>
                                            </p>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-timeline-item dot-success vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title">
                                                Build the production release
                                                <span class="badge bg-danger ms-2">NEW</span>
                                            </h4>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="vertical-timeline-item dot-dark vertical-timeline-element">
                                    <div>
                                        <span class="vertical-timeline-element-icon bounce-in"></span>
                                        <div class="vertical-timeline-element-content bounce-in">
                                            <h4 class="timeline-title">This dot has a dark state</h4>
                                            <span class="vertical-timeline-element-date"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab-sudah-{{ $attributes['group'] }}" role="tabpanel">
            <div class="scroll-area-sm">
                <div class="scrollbar-container">
                    <div class="p-3">
                        <div class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                            <div class="vertical-timeline-item vertical-timeline-element">
                                <div>
                                    <span class="vertical-timeline-element-icon bounce-in">
                                        <i class="badge badge-dot badge-dot-xl bg-success"></i>
                                    </span>
                                    <div class="vertical-timeline-element-content bounce-in">
                                        <h4 class="timeline-title">All Hands Meeting</h4>
                                        <p>
                                            Lorem ipsum dolor sic amet, today at
                                            <a href="javascript:void(0);">12:00 PM</a>
                                        </p>
                                        <span class="vertical-timeline-element-date"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="vertical-timeline-item vertical-timeline-element">
                                <div>
                                    <span class="vertical-timeline-element-icon bounce-in">
                                        <i class="badge badge-dot badge-dot-xl bg-warning"></i>
                                    </span>
                                    <div class="vertical-timeline-element-content bounce-in">
                                        <p>
                                            Another meeting today, at
                                            <b class="text-danger">12:00 PM</b>
                                        </p>
                                        <p>Yet another one, at
                                            <span class="text-success">15:00 PM</span>
                                        </p>
                                        <span class="vertical-timeline-element-date"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="vertical-timeline-item vertical-timeline-element">
                                <div>
                                    <span class="vertical-timeline-element-icon bounce-in">
                                        <i class="badge badge-dot badge-dot-xl bg-danger"></i>
                                    </span>
                                    <div class="vertical-timeline-element-content bounce-in">
                                        <h4 class="timeline-title">Build the production release</h4>
                                        <p>
                                            Lorem ipsum dolor sit amit,consectetur eiusmdd tempor
                                            incididunt ut labore et dolore magna elit enim at
                                            minim veniam quis nostrud
                                        </p>
                                        <span class="vertical-timeline-element-date"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="vertical-timeline-item vertical-timeline-element">
                                <div>
                                    <span class="vertical-timeline-element-icon bounce-in">
                                        <i class="badge badge-dot badge-dot-xl bg-primary"></i>
                                    </span>
                                    <div class="vertical-timeline-element-content bounce-in">
                                        <h4 class="timeline-title text-success">Something not important</h4>
                                        <p>
                                            Lorem ipsum dolor sit amit,consectetur elit enim at
                                            minim veniam quis nostrud
                                        </p>
                                        <span class="vertical-timeline-element-date"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="vertical-timeline-item vertical-timeline-element">
                                <div>
                                    <span class="vertical-timeline-element-icon bounce-in">
                                        <i class="badge badge-dot badge-dot-xl bg-success"></i>
                                    </span>
                                    <div class="vertical-timeline-element-content bounce-in">
                                        <h4 class="timeline-title">All Hands Meeting</h4>
                                        <p>
                                            Lorem ipsum dolor sic amet, today at
                                            <a href="javascript:void(0);">12:00 PM</a>
                                        </p>
                                        <span class="vertical-timeline-element-date"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="vertical-timeline-item vertical-timeline-element">
                                <div>
                                    <span class="vertical-timeline-element-icon bounce-in">
                                        <i class="badge badge-dot badge-dot-xl bg-warning"></i>
                                    </span>
                                    <div class="vertical-timeline-element-content bounce-in">
                                        <p>
                                            Another meeting today, at
                                            <b class="text-danger">12:00 PM</b>
                                        </p>
                                        <p>Yet another one, at
                                            <span class="text-success">15:00 PM</span>
                                        </p>
                                        <span class="vertical-timeline-element-date"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="vertical-timeline-item vertical-timeline-element">
                                <div>
                                    <span class="vertical-timeline-element-icon bounce-in">
                                        <i class="badge badge-dot badge-dot-xl bg-danger"></i>
                                    </span>
                                    <div class="vertical-timeline-element-content bounce-in">
                                        <h4 class="timeline-title">Build the production release</h4>
                                        <p>
                                            Lorem ipsum dolor sit amit,consectetur eiusmdd tempor
                                            incididunt ut labore et dolore magna elit enim at
                                            minim veniam quis nostrud
                                        </p>
                                        <span class="vertical-timeline-element-date"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="vertical-timeline-item vertical-timeline-element">
                                <div>
                                    <span class="vertical-timeline-element-icon bounce-in">
                                        <i class="badge badge-dot badge-dot-xl bg-primary"></i>
                                    </span>
                                    <div class="vertical-timeline-element-content bounce-in">
                                        <h4 class="timeline-title text-success">Something not important</h4>
                                        <p>
                                            Lorem ipsum dolor sit amit,consectetur elit enim at
                                            minim veniam quis nostrud
                                        </p>
                                        <span class="vertical-timeline-element-date"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="tab-errors-header1" role="tabpanel">
            <div class="scroll-area-sm">
                <div class="scrollbar-container">
                    <div class="no-results pt-3 pb-0">
                        <div class="swal2-icon swal2-success swal2-animate-success-icon">
                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                            <span class="swal2-success-line-tip"></span>
                            <span class="swal2-success-line-long"></span>
                            <div class="swal2-success-ring"></div>
                            <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                            <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                        </div>
                        <div class="results-subtitle">All caught up!</div>
                        <div class="results-title">There are no system errors!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item-divider nav-item"></li>
        <li class="nav-item-btn text-center nav-item">
            <button class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">Lihat Semua Notifikasi</button>
        </li>
    </ul>
</div>