<div class="app-menu">
    <!-- Sidebar -->

    <div class="navbar-vertical navbar nav-dashboard">
        <div class="h-100" data-simplebar>
            <!-- Brand logo -->
            <a class="navbar-brand text-primary fw-bold" href="{{ route('dashboard') ?? '#' }}">
               <i class="bi bi-shield-check text-primary me-2"></i> BDHRP Admin
            </a>
            
            <!-- Navbar nav -->
            <ul class="navbar-nav flex-column" id="sideNavbar">

                <!-- MAIN DASHBOARD -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active': '' }}" href="{{ route('dashboard') ?? '#' }}">
                        <i data-feather="home" class="nav-icon me-2 icon-xxs"></i> Dashboard
                    </a>
                </li>

                <!-- ========================== -->
                <!-- CONTENT MANAGEMENT SECTION -->
                <!-- ========================== -->
                <li class="nav-item">
                    <div class="navbar-heading mt-3">Content Management</div>
                </li>

                <!-- News & Articles -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/news*') ? '' : 'collapsed' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navNews" aria-expanded="{{ request()->is('admin/news*') ? 'true' : 'false' }}" aria-controls="navNews">
                        <i data-feather="file-text" class="nav-icon me-2 icon-xxs"></i> News & Blog
                    </a>
                    <div id="navNews" class="collapse {{ request()->is('admin/news*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/news-categories*') ? 'active' : '' }}" href="#">Categories</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/news-tags*') ? 'active' : '' }}" href="#">Tags</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/news-articles*') ? 'active' : '' }}" href="#">All Articles</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- CMS Pages -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/pages*') ? 'active': '' }}" href="{{ route('admin.pages.index') }}">
                        <i data-feather="layout" class="nav-icon me-2 icon-xxs"></i> Static Pages
                    </a>
                </li>

                <!-- Gallery -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/gallery*') ? '' : 'collapsed' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navGallery" aria-expanded="{{ request()->is('admin/gallery*') ? 'true' : 'false' }}" aria-controls="navGallery">
                        <i data-feather="image" class="nav-icon me-2 icon-xxs"></i> Gallery Center
                    </a>
                    <div id="navGallery" class="collapse {{ request()->is('admin/gallery*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/gallery-albums*') ? 'active' : '' }}" href="#">Albums</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/gallery-items*') ? 'active' : '' }}" href="#">Photos</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- ========================== -->
                <!-- ORGANIZATION SECTION       -->
                <!-- ========================== -->
                <li class="nav-item">
                    <div class="navbar-heading mt-3">Organization</div>
                </li>

                <!-- Committees Structure -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/org*') ? '' : 'collapsed' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navOrg" aria-expanded="{{ request()->is('admin/org*') ? 'true' : 'false' }}" aria-controls="navOrg">
                        <i data-feather="map-pin" class="nav-icon me-2 icon-xxs"></i> Regional Setup
                    </a>
                    <div id="navOrg" class="collapse {{ request()->is('admin/org*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/org/divisions*') ? 'active' : '' }}" href="#">Divisions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/org/committees*') ? 'active' : '' }}" href="#">Committees</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/org/districts*') ? 'active' : '' }}" href="#">Districts</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Events & Activities -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/events*') ? 'active': '' }}" href="#">
                        <i data-feather="calendar" class="nav-icon me-2 icon-xxs"></i> Activities & Events
                    </a>
                </li>
                
                <!-- Topics -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/topics*') ? 'active': '' }}" href="#">
                        <i data-feather="hash" class="nav-icon me-2 icon-xxs"></i> Topics Framework
                    </a>
                </li>

                <!-- ========================== -->
                <!-- PEOPLE & ENGAGEMENT        -->
                <!-- ========================== -->
                <li class="nav-item">
                    <div class="navbar-heading mt-3">People & Engagement</div>
                </li>

                <!-- Team & Members -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/team*') ? '' : 'collapsed' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navTeam" aria-expanded="{{ request()->is('admin/team*') ? 'true' : 'false' }}" aria-controls="navTeam">
                        <i data-feather="users" class="nav-icon me-2 icon-xxs"></i> Team & Members
                    </a>
                    <div id="navTeam" class="collapse {{ request()->is('admin/team*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/team/roles*') ? 'active' : '' }}" href="#">People Roles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/team/people*') ? 'active' : '' }}" href="#">All People</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/team/committee-members*') ? 'active' : '' }}" href="#">Committee Leads</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Donations & Donors -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/fundraising*') ? '' : 'collapsed' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navDonations" aria-expanded="{{ request()->is('admin/fundraising*') ? 'true' : 'false' }}" aria-controls="navDonations">
                        <i data-feather="heart" class="nav-icon me-2 icon-xxs"></i> Fundraising
                    </a>
                    <div id="navDonations" class="collapse {{ request()->is('admin/fundraising*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/fundraising/donors*') ? 'active' : '' }}" href="#">Donors</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/fundraising/transactions*') ? 'active' : '' }}" href="#">Transactions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/fundraising/legacies*') ? 'active' : '' }}" href="#">Legacy Giving</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Newsletter -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/newsletter*') ? '' : 'collapsed' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navNewsletter" aria-expanded="{{ request()->is('admin/newsletter*') ? 'true' : 'false' }}" aria-controls="navNewsletter">
                        <i data-feather="send" class="nav-icon me-2 icon-xxs"></i> Newsletter
                    </a>
                    <div id="navNewsletter" class="collapse {{ request()->is('admin/newsletter*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/newsletter/subscribers*') ? 'active' : '' }}" href="#">Subscribers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/newsletter/issues*') ? 'active' : '' }}" href="#">Issues & Mailer</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Careers -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/careers*') ? '' : 'collapsed' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navCareers" aria-expanded="{{ request()->is('admin/careers*') ? 'true' : 'false' }}" aria-controls="navCareers">
                        <i data-feather="briefcase" class="nav-icon me-2 icon-xxs"></i> Careers
                    </a>
                    <div id="navCareers" class="collapse {{ request()->is('admin/careers*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/careers/jobs*') ? 'active' : '' }}" href="#">Job Listings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/careers/applications*') ? 'active' : '' }}" href="#">Applications</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- External Entities (Partners, Contact) -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/partners*') ? 'active': '' }}" href="#">
                        <i data-feather="link" class="nav-icon me-2 icon-xxs"></i> Partners
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/contact-messages*') ? 'active': '' }}" href="#">
                        <i data-feather="message-square" class="nav-icon me-2 icon-xxs"></i> Messages (Inbox)
                    </a>
                </li>


                <!-- ========================== -->
                <!-- SYSTEM SETTINGS            -->
                <!-- ========================== -->
                <li class="nav-item">
                    <div class="navbar-heading mt-3">System & Settings</div>
                </li>

                <!-- Admin Users & Roles -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/system/users*') ? '' : 'collapsed' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navAuth" aria-expanded="{{ request()->is('admin/system/users*') ? 'true' : 'false' }}" aria-controls="navAuth">
                        <i data-feather="shield" class="nav-icon me-2 icon-xxs"></i> Admin Access
                    </a>
                    <div id="navAuth" class="collapse {{ request()->is('admin/system/users*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/system/users') ? 'active' : '' }}" href="{{ route('admin.user.index') ?? '#' }}">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/system/roles') ? 'active' : '' }}" href="#">Roles & Permissions</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <!-- Global Config -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('admin/system/config*') ? '' : 'collapsed' }}" href="#!" data-bs-toggle="collapse" data-bs-target="#navSettings" aria-expanded="{{ request()->is('admin/system/config*') ? 'true' : 'false' }}" aria-controls="navSettings">
                        <i data-feather="settings" class="nav-icon me-2 icon-xxs"></i> Settings
                    </a>
                    <div id="navSettings" class="collapse {{ request()->is('admin/system/config*') ? 'show' : '' }}" data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/system/config/general') ? 'active' : '' }}" href="#">General Setup</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('v1.setting.mail.show') ? 'active' : '' }}" href="{{ route('v1.setting.mail.show') ?? '#' }}">Email Server Setup</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/system/config/financials') ? 'active' : '' }}" href="#">Financial Reports</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin/system/config/social') ? 'active' : '' }}" href="#">Social Media Links</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item pb-4"></li>
            </ul>
        </div>
    </div>
</div>

<style>
/* Custom Navbar Styling to make it more elegant */
.nav-dashboard .navbar-heading {
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: #a0aec0;
    padding: 0 1.5rem 0.5rem;
    margin-bottom: 0;
}
.nav-dashboard .nav-link {
    font-weight: 500;
    font-size: 0.9rem;
    padding: 0.6rem 1.5rem;
    color: #4a5568;
    transition: all 0.3s ease;
    border-radius: 0.375rem;
    margin: 0.1rem 0.8rem;
}
.nav-dashboard .nav-link:hover {
    background-color: #f7fafc;
    color: #3182ce;
}
.nav-dashboard .nav-link.active {
    background-color: rgba(49, 130, 206, 0.1);
    color: #2b6cb0;
    font-weight: 600;
}
.nav-dashboard .nav-link .nav-icon {
    width: 18px;
    height: 18px;
    color: inherit;
}
.nav-dashboard .nav-link[data-bs-toggle="collapse"]::after {
    display: inline-block;
    width: 1em;
    height: 1em;
    content: "";
    background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23a0aec0' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: center;
    background-size: 100%;
    margin-left: auto;
    transition: transform .2s ease;
}
.nav-dashboard .nav-link[data-bs-toggle="collapse"][aria-expanded="true"]::after {
    transform: rotate(180deg);
}
.nav-dashboard .collapse .nav-item .nav-link {
    padding-left: 3rem;
    font-size: 0.85rem;
}
</style>
