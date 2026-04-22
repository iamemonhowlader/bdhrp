<div class="app-menu">
    <!-- Sidebar -->
    <div class="navbar-vertical navbar nav-dashboard border-end">
        <div class="h-100" data-simplebar>
            <!-- Brand Area -->
            <div class="brand-area p-4 border-bottom mb-3">
                <a class="navbar-brand p-0 m-0 border-0" href="{{ route('dashboard', [], false) }}" style="display: flex; align-items: center; gap: 0.75rem;">
                   <div class="p-2 bg-white rounded-3 shadow-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                       <i class="bi bi-shield-check text-primary" style="font-size: 1.4rem;"></i>
                   </div>
                   <span class="fw-bold text-white" style="font-size: 1.15rem; letter-spacing: 0.5px;">Jefferi Admin</span>
                </a>
                <div class="mt-3">
                    <a href="/" target="_blank" class="btn btn-sm btn-glass w-100 py-1" style="font-size: 0.75rem; color: white; background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.2);">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Public Website
                    </a>
                </div>
            </div>
            
            <ul class="navbar-nav flex-column px-2" id="sideNavbar">
                <!-- MAIN DASHBOARD -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active': '' }}" href="{{ route('dashboard', [], false) }}">
                        <i class="bi bi-grid-1x2 nav-icon"></i> Dashboard
                    </a>
                </li>

                <!-- WEBSITE CONTENT -->
                <li class="nav-item">
                    <div class="navbar-heading">Website Editor</div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.hero.*') ? 'active' : '' }}" href="{{ route('admin.hero.edit', [], false) }}">
                        <i class="bi bi-window-stack nav-icon"></i> Hero Management
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.about.*') ? 'active' : '' }}" href="{{ route('admin.about.edit', [], false) }}">
                        <i class="bi bi-info-square nav-icon"></i> About Stats
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.about-sections.*') ? 'active' : '' }}" href="{{ route('admin.about-sections.index', [], false) }}">
                        <i class="bi bi-collection nav-icon"></i> About Sections
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/articles*') ? 'active' : '' }}" href="{{ route('admin.articles.index', [], false) }}">
                        <i class="bi bi-newspaper nav-icon"></i> Latest News
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/articles_videos*') ? 'active' : '' }}" href="{{ route('admin.articles_videos.index', [], false) }}">
                        <i class="bi bi-play-btn nav-icon"></i> Video Reports
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/districts*') ? 'active' : '' }}" href="{{ route('admin.districts.index', [], false) }}">
                        <i class="bi bi-geo-alt nav-icon"></i> Bangladesh Geography
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/topics*') ? 'active' : '' }}" href="{{ route('admin.topics.index', [], false) }}">
                        <i class="bi bi-tags nav-icon"></i> Topics Manager
                    </a>
                </li>

                <!-- PEOPLE & ORG -->
                <li class="nav-item">
                    <div class="navbar-heading">Organization</div>
                </li>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#!" data-bs-toggle="collapse" data-bs-target="#navOrg" aria-expanded="false">
                        <i class="bi bi-layers nav-icon"></i> Regional Hub
                    </a>
                    <div id="navOrg" class="collapse" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link" href="#">Divisions</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Committees</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.team-members.*') ? '' : 'collapsed' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navTeam" aria-expanded="{{ request()->routeIs('admin.team-members.*') ? 'true' : 'false' }}">
                        <i class="bi bi-people nav-icon"></i> Team Center
                    </a>
                    <div id="navTeam" class="collapse {{ request()->routeIs('admin.team-members.*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.team-members.index') ? 'active' : '' }}" href="{{ route('admin.team-members.index', [], false) }}">All Members</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.team-members.create') ? 'active' : '' }}" href="{{ route('admin.team-members.create', [], false) }}">Add Member</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- SYSTEM SETUP -->
                <li class="nav-item">
                    <div class="navbar-heading">Configuration</div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/system/users*') ? '' : 'collapsed' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navAuth" aria-expanded="{{ request()->is('admin/system/users*') ? 'true' : 'false' }}">
                        <i class="bi bi-shield-lock nav-icon"></i> Access Control
                    </a>
                    <div id="navAuth" class="collapse {{ request()->is('admin/system/users*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/system/users') ? 'active' : '' }}" href="{{ route('admin.user.index', [], false) }}">Admin Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Permissions</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/system/config*') ? '' : 'collapsed' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navSettings" aria-expanded="{{ request()->is('admin/system/config*') ? 'true' : 'false' }}">
                        <i class="bi bi-gear nav-icon"></i> Global Settings
                    </a>
                    <div id="navSettings" class="collapse {{ request()->is('admin/system/config*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item"><a class="nav-link" href="#">General Config</a></li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('v1.setting.mail.show') ? 'active' : '' }}" href="{{ route('v1.setting.mail.show', [], false) }}">Mail Server</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#">Social Links</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item pb-5"></li>
            </ul>
        </div>
    </div>
</div>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
/* Modern & Smart Sidebar Styling */
:root {
    --side-primary: #6366f1;
    --side-gradient: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    --side-hover-bg: #f8fafc;
    --side-active-bg: rgba(99, 102, 241, 0.08);
    --side-text: #475569;
    --side-text-bold: #1e293b;
    --side-font: 'Plus Jakarta Sans', sans-serif;
}

.nav-dashboard {
    background-color: #ffffff;
    border-right: 1px solid #f1f5f9;
    font-family: var(--side-font);
}

.nav-dashboard .brand-area {
    background: var(--side-gradient);
    box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.1);
}

.nav-dashboard .navbar-heading {
    font-size: 0.7rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: #94a3b8;
    padding: 1.75rem 1.25rem 0.5rem;
}

.nav-dashboard .nav-link {
    font-weight: 600;
    font-size: 0.9rem;
    padding: 0.75rem 1.25rem;
    color: var(--side-text);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 12px;
    margin: 0.2rem 0.75rem;
    display: flex;
    align-items: center;
}

.nav-dashboard .nav-link:hover {
    background-color: var(--side-hover-bg);
    color: var(--side-primary);
    transform: translateX(4px);
}

.nav-dashboard .nav-link.active {
    background-color: var(--side-active-bg);
    color: var(--side-primary);
    font-weight: 700;
}

.nav-dashboard .nav-link.active::before {
    content: '';
    position: absolute;
    left: 0;
    height: 20px;
    width: 4px;
    background: var(--side-primary);
    border-radius: 0 4px 4px 0;
}

.nav-dashboard .nav-link .nav-icon {
    font-size: 1.15rem;
    margin-right: 0.85rem;
    transition: transform 0.3s ease;
}

.nav-dashboard .nav-link:hover .nav-icon {
    transform: scale(1.1);
}

.nav-dashboard .nav-link[data-bs-toggle="collapse"]::after {
    display: inline-block;
    width: 0.8rem;
    height: 0.8rem;
    content: "";
    background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: center;
    background-size: 100%;
    margin-left: auto;
    transition: transform .25s ease;
}

.nav-dashboard .nav-link[data-bs-toggle="collapse"][aria-expanded="true"]::after {
    transform: rotate(180deg);
}

.nav-dashboard .collapse .nav-item .nav-link {
    padding-left: 3.25rem;
    font-size: 0.85rem;
    color: #64748b;
}

/* Custom Scrollbar */
.simplebar-scrollbar:before {
    background: #e2e8f0 !important;
    width: 4px;
}
</style>
