@extends('backend.app')

@section('title', (env('APP_NAME') ?? 'Jefferi') . ' || Dashboard')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        --accent-gradient: linear-gradient(135deg, #3b82f6 0%, #2dd4bf 100%);
        --surface-card: #ffffff;
        --surface-glass: rgba(255, 255, 255, 0.7);
        --text-main: #1e293b;
        --text-muted: #64748b;
        --shadow-premium: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .dashboard-wrapper {
        padding: 2.5rem;
        background: #fdfdff;
        min-height: 100vh;
    }

    .premium-welcome {
        background: var(--primary-gradient);
        border-radius: 2rem;
        padding: 3rem;
        position: relative;
        overflow: hidden;
        color: white;
        margin-bottom: 2.5rem;
        box-shadow: 0 25px 50px -12px rgba(99, 102, 241, 0.25);
    }

    .premium-welcome::before {
        content: '';
        position: absolute;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        top: -100px;
        right: -100px;
        border-radius: 50%;
    }

    .glass-stat-card {
        background: var(--surface-glass);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 1.5rem;
        padding: 1.75rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: var(--shadow-premium);
    }

    .glass-stat-card:hover {
        transform: translateY(-10px) scale(1.02);
        background: white;
        box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.08);
    }

    .stat-circle {
        width: 60px;
        height: 60px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-bottom: 1.25rem;
        transition: transform 0.3s ease;
    }

    .glass-stat-card:hover .stat-circle {
        transform: rotate(12deg);
    }

    .smart-card {
        background: white;
        border-radius: 2rem;
        border: none;
        box-shadow: var(--shadow-premium);
        overflow: hidden;
    }

    .deliverable-row {
        transition: background 0.3s ease;
        cursor: pointer;
    }

    .deliverable-row:hover {
        background: #f8fafc;
    }

    .insight-pill {
        padding: 0.5rem 1rem;
        border-radius: 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: #f1f5f9;
        color: #475569;
    }

    .activity-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        position: relative;
    }

    .activity-dot::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: inherit;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); opacity: 0.8; }
        100% { transform: scale(2.5); opacity: 0; }
    }

    .floating-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .animate-reveal {
        opacity: 0;
        transform: translateY(30px);
        animation: reveal 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @keyframes reveal {
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area">
        <div class="dashboard-inner px-4 pt-3 pb-5">
            <div class="container-fluid">
                
                <!-- Welcome Header -->
                <div class="premium-welcome animate-reveal">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <span class="badge bg-white text-primary mb-3 px-3 py-2 rounded-pill fw-bold small">SYSTEM STATUS: OPTIMAL</span>
                            <h1 class="display-5 fw-800 mb-2 mt-2">Good Evening, {{ explode(' ', auth()->user()->name ?? 'Admin')[0] }}! ✨</h1>
                            <p class="fs-5 opacity-90 mb-0">Your workspace is looking great. You've completed <span class="fw-bold">85%</span> of your weekly goals.</p>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                            <div class="d-flex gap-2 justify-content-lg-end">
                                <button class="btn btn-white btn-lg rounded-pill px-4 fw-bold shadow-sm" style="background: white; color: #6366f1;">
                                    <i class="bi bi-gear-fill me-2"></i>Configure
                                </button>
                                <button class="btn btn-glass btn-lg rounded-pill px-4 fw-bold text-white border-white" style="background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.4);">
                                    <i class="bi bi-lightning-charge-fill me-2"></i>Quick Action
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metrics Grid -->
                <div class="row g-4 mb-5">
                    <div class="col-xl-3 col-md-6 animate-reveal" style="animation-delay: 0.1s;">
                        <div class="glass-stat-card">
                            <div class="stat-circle bg-primary-soft text-primary shadow-sm" style="background: #eef2ff;">
                                <i class="bi bi-stack"></i>
                            </div>
                            <span class="text-muted fw-semibold small">ACTIVE PROJECTS</span>
                            <h2 class="fw-800 mt-1 mb-0">32</h2>
                            <div class="mt-3 d-flex align-items-center gap-2">
                                <span class="text-success small fw-bold"><i class="bi bi-graph-up-arrow"></i> +4.2%</span>
                                <span class="text-muted small">vs last month</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 animate-reveal" style="animation-delay: 0.2s;">
                        <div class="glass-stat-card">
                            <div class="stat-circle bg-success-soft text-success shadow-sm" style="background: #ecfdf5;">
                                <i class="bi bi-check2-circle"></i>
                            </div>
                            <span class="text-muted fw-semibold small">COMPLETED TASKS</span>
                            <h2 class="fw-800 mt-1 mb-0">1,204</h2>
                            <div class="mt-3 d-flex align-items-center gap-2">
                                <div class="progress flex-grow-1" style="height: 6px; border-radius: 3px; background: #e2e8f0;">
                                    <div class="progress-bar bg-success" style="width: 72%"></div>
                                </div>
                                <span class="text-success small fw-bold">72%</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 animate-reveal" style="animation-delay: 0.3s;">
                        <div class="glass-stat-card">
                            <div class="stat-circle bg-warning-soft text-warning shadow-sm" style="background: #fffbeb;">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <span class="text-muted fw-semibold small">AVG. RESPONSE TIME</span>
                            <h2 class="fw-800 mt-1 mb-0">2.4<span class="fs-6 fw-normal"> hrs</span></h2>
                            <div class="mt-3 d-flex align-items-center gap-2">
                                <span class="insight-pill"><i class="bi bi-stars"></i> Smart Insight: Faster than avg.</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 animate-reveal" style="animation-delay: 0.4s;">
                        <div class="glass-stat-card">
                            <div class="stat-circle bg-danger-soft text-danger shadow-sm" style="background: #fef2f2;">
                                <i class="bi bi-shield-exclamation"></i>
                            </div>
                            <span class="text-muted fw-semibold small">SYSTEM REPORTS</span>
                            <h2 class="fw-800 mt-1 mb-0">0</h2>
                            <div class="mt-3 d-flex align-items-center gap-2">
                                <div class="activity-dot bg-success"></div>
                                <span class="text-success small fw-bold">Everything is fine</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Smart Intelligence Section -->
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="smart-card p-4 mb-4 animate-reveal" style="animation-delay: 0.5s;">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div>
                                    <h4 class="fw-800 mb-1">Growth & Efficiency</h4>
                                    <p class="text-muted small mb-0">Live data tracking for Q2 performance</p>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-light rounded-pill px-3" data-bs-toggle="dropdown">
                                        Export <i class="bi bi-chevron-down small ms-1"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="growthChart" style="min-height: 400px;"></div>
                        </div>

                        <div class="smart-card animate-reveal" style="animation-delay: 0.6s;">
                            <div class="p-4 d-flex justify-content-between align-items-center border-bottom">
                                <h4 class="fw-800 mb-0">Critical Deliverables</h4>
                                <div class="d-flex gap-2">
                                    <span class="badge bg-light text-dark rounded-pill px-3 py-2 border">Priority</span>
                                    <span class="badge bg-light text-dark rounded-pill px-3 py-2 border">Due Soon</span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0 align-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="px-4 py-3">PARTNER NAME</th>
                                            <th class="py-3 text-center">STRENGTH</th>
                                            <th class="py-3">DEADLINE</th>
                                            <th class="py-3">PROGRESS</th>
                                            <th class="py-3 text-end px-4">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="deliverable-row">
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary text-white rounded-3 p-2 me-3 shadow-sm">
                                                        <i class="bi bi-google"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-800 text-dark">Google Cloud Sync</div>
                                                        <div class="text-muted small">Infrastructure</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge rounded-pill bg-success px-3">High</span>
                                            </td>
                                            <td>Apr 24, 2026</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="progress flex-grow-1" style="height: 6px; border-radius: 3px;">
                                                        <div class="progress-bar bg-primary" style="width: 85%"></div>
                                                    </div>
                                                    <span class="small fw-bold">85%</span>
                                                </div>
                                            </td>
                                            <td class="text-end px-4">
                                                <button class="btn btn-icon btn-light rounded-circle"><i class="bi bi-three-dots"></i></button>
                                            </td>
                                        </tr>
                                        <tr class="deliverable-row">
                                            <td class="px-4 py-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-dark text-white rounded-3 p-2 me-3 shadow-sm">
                                                        <i class="bi bi-apple"></i>
                                                    </div>
                                                    <div>
                                                        <div class="fw-800 text-dark">iOS Native Bridge</div>
                                                        <div class="text-muted small">Mobile Dev</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge rounded-pill bg-warning px-3">Medium</span>
                                            </td>
                                            <td>May 02, 2026</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="progress flex-grow-1" style="height: 6px; border-radius: 3px;">
                                                        <div class="progress-bar bg-warning" style="width: 45%"></div>
                                                    </div>
                                                    <span class="small fw-bold">45%</span>
                                                </div>
                                            </td>
                                            <td class="text-end px-4">
                                                <button class="btn btn-icon btn-light rounded-circle"><i class="bi bi-three-dots"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="smart-card p-4 mb-4 animate-reveal" style="animation-delay: 0.7s;">
                            <h4 class="fw-800 mb-4">Task Optimization</h4>
                            <div id="optimizationChart"></div>
                            <div class="mt-4 p-3 bg-light rounded-4">
                                <div class="d-flex gap-3">
                                    <div class="fs-3 text-primary"><i class="bi bi-lightbulb"></i></div>
                                    <div>
                                        <div class="fw-bold text-dark">Pro Tip</div>
                                        <p class="small text-muted mb-0">Automate your report generation to save up to 4 hours per week.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="smart-card p-4 animate-reveal" style="animation-delay: 0.8s;">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="fw-800 mb-0">Audit Timeline</h4>
                                <span class="activity-dot bg-primary"></span>
                            </div>
                            <div class="timeline ms-2 border-start ps-4 position-relative">
                                <div class="mb-4 position-relative">
                                    <div class="position-absolute start-0 translate-middle-x bg-white" style="margin-left: -29px; width: 12px; height: 12px; border: 3px solid #6366f1; border-radius: 50%;"></div>
                                    <div class="fw-800 small text-dark">Security Patch Applied</div>
                                    <div class="text-muted tiny">14:24 • System Engine</div>
                                </div>
                                <div class="mb-4 position-relative">
                                    <div class="position-absolute start-0 translate-middle-x bg-white" style="margin-left: -29px; width: 12px; height: 12px; border: 3px solid #10b981; border-radius: 50%;"></div>
                                    <div class="fw-800 small text-dark">New Global Admin Joined</div>
                                    <div class="text-muted tiny">09:12 • User Management</div>
                                </div>
                                <div class="position-relative">
                                    <div class="position-absolute start-0 translate-middle-x bg-white" style="margin-left: -29px; width: 12px; height: 12px; border: 3px solid #f59e0b; border-radius: 50%;"></div>
                                    <div class="fw-800 small text-dark">Backup Sync Initiated</div>
                                    <div class="text-muted tiny">Yesterday • Database</div>
                                </div>
                            </div>
                            <button class="btn btn-outline-primary w-100 mt-4 rounded-pill fw-bold">Open Full Logs</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Project Growth Chart
    const growthOptions = {
        series: [{
            name: 'Growth',
            data: [31, 40, 28, 51, 42, 109, 100]
        }, {
            name: 'Efficiency',
            data: [11, 32, 45, 32, 34, 52, 41]
        }],
        chart: {
            height: 380,
            type: 'area',
            toolbar: { show: false },
            fontFamily: 'Plus Jakarta Sans',
            sparkline: { enabled: false },
        },
        colors: ['#6366f1', '#10b981'],
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 3 },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.45,
                opacityTo: 0.05,
                stops: [20, 100, 100, 100]
            }
        },
        grid: {
            borderColor: '#f1f5f9',
            strokeDashArray: 4,
        },
        xaxis: {
            categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            axisBorder: { show: false },
            axisTicks: { show: false },
        },
        yaxis: {
            labels: {
                formatter: function (val) { return val + "%" }
            }
        },
        tooltip: {
            theme: 'light',
            x: { show: false },
        },
        legend: { position: 'top', horizontalAlign: 'right' }
    };

    const growthChart = new ApexCharts(document.querySelector("#growthChart"), growthOptions);
    growthChart.render();

    // Task Optimization Chart
    const optimizationOptions = {
        series: [44, 55, 13, 33],
        chart: {
            type: 'donut',
            height: 320,
            fontFamily: 'Plus Jakarta Sans',
        },
        labels: ['Automated', 'Manual', 'Pending', 'Delegated'],
        colors: ['#6366f1', '#10b981', '#f59e0b', '#ef4444'],
        plotOptions: {
            pie: {
                donut: {
                    size: '80%',
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Tasks',
                            fontSize: '16px',
                            fontWeight: 600,
                        }
                    }
                }
            }
        },
        dataLabels: { enabled: false },
        legend: { position: 'bottom' },
        stroke: { show: false }
    };

    const optimizationChart = new ApexCharts(document.querySelector("#optimizationChart"), optimizationOptions);
    optimizationChart.render();
});
</script>
@endpush
