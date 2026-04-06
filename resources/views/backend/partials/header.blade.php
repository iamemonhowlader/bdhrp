<div class="header">
    <!-- navbar -->
    <div class="navbar-custom navbar navbar-expand-lg">
        <div class="container-fluid px-0">
            <a class="navbar-brand d-block d-md-none" href="#">
              <i class="bi bi-shield-check text-primary fs-2"></i>
            </a>

            <a id="nav-toggle" href="#!" class="ms-auto ms-md-0 me-0 me-lg-3 p-2 bg-light rounded-circle shadow-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                <i class="bi bi-list-nested text-dark fs-4"></i>
            </a>

            <div class="d-none d-md-none d-lg-block ms-4">
                <!-- Form -->
                <form action="#">
                    <div class="input-group search-premium">
                        <span class="input-group-text bg-transparent border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input class="form-control border-start-0 ps-0" type="search" value="" id="searchInput" placeholder="Search insights...">
                    </div>
                </form>
            </div>
            <!--Navbar nav -->
            <ul class="navbar-nav navbar-right-wrap ms-lg-auto d-flex nav-top-wrap align-items-center ms-4 ms-lg-0 gap-3">
                
                <li class="nav-item">
                    <div class="form-check form-switch theme-switch mb-0">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                    </div>
                </li>

                <!-- User Profile Dropdown -->
                <li class="dropdown">
                    <a class="rounded-pill p-1 d-flex align-items-center bg-light border text-decoration-none" href="#!" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar avatar-sm me-2">
                            @php
                                $user = auth()->user();
                                $name = $user->name ?? 'Admin';
                                $initial = strtoupper(substr($name, 0, 1));
                                $colors = ['primary', 'success', 'info', 'warning', 'danger', 'secondary'];
                                $colorIndex = ord($initial) % count($colors);
                            @endphp
                            <div class="rounded-pill bg-primary text-white d-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px; font-weight: 700; font-size: 14px;">
                                {{ $initial }}
                            </div>
                        </div>
                        <span class="d-none d-lg-inline-block fw-700 text-dark me-2 small">{{ explode(' ', $name)[0] }}</span>
                        <i class="bi bi-chevron-down small text-muted me-2"></i>
                    </a>
                    
                    <div class="dropdown-menu dropdown-menu-end p-2 shadow-lg border-0 rounded-4" style="min-width: 240px; margin-top: 1rem;">
                        <div class="px-3 pt-3 pb-2 text-center border-bottom mb-2">
                             <div class="rounded-pill bg-primary text-white d-inline-flex align-items-center justify-content-center mb-2 shadow" style="width: 60px; height: 60px; font-weight: 800; font-size: 24px;">
                                {{ $initial }}
                            </div>
                            <h6 class="mb-0 fw-800 text-dark">{{ $name }}</h6>
                            <p class="mb-0 text-muted small">{{ $user->email ?? 'Administrator' }}</p>
                        </div>

                        <ul class="list-unstyled mb-0">
                            <li><a class="dropdown-item rounded-3 py-2" href="#"><i class="bi bi-person me-2 small"></i> Profile Settings</a></li>
                            <li><a class="dropdown-item rounded-3 py-2" href="#"><i class="bi bi-shield-check me-2 small"></i> Security</a></li>
                            <div class="dropdown-divider"></div>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item rounded-3 py-2 text-danger fw-600" type="submit">
                                        <i class="bi bi-power me-2 small"></i> Sign Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<style>
/* Modern Header Styling */
.navbar-custom {
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid #f1f5f9;
    padding: 0.75rem 1.5rem;
}

.search-premium {
    background: #f8fafc;
    border-radius: 1rem;
    border: 1px solid #e2e8f0;
    transition: all 0.3s ease;
    overflow: hidden;
    width: 320px;
}

.search-premium:focus-within {
    background: white;
    box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    border-color: #6366f1;
}

.search-premium input {
    background: transparent;
    border: none;
    font-size: 0.875rem;
    padding: 0.6rem 0;
}

.search-premium input:focus {
    box-shadow: none;
}

.search-premium .input-group-text {
    border: none;
}

.dropdown-item {
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.dropdown-item:hover {
    background-color: #f1f5f9;
    color: #6366f1;
    transform: translateX(3px);
}

.avatar-indicators::before {
    bottom: 2px;
    right: 2px;
}

.fw-700 { font-weight: 700; }
.fw-800 { font-weight: 800; }
</style>
