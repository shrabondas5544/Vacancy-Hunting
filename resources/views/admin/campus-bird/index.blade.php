@extends('admin.campus-bird.layout')

@section('page-title', 'Dashboard')

@section('page-styles')
<style>
    .dashboard-hero {
        background: linear-gradient(135deg, #10b981 0%, #059669 50%, #064e3b 100%);
        border-radius: var(--radius);
        padding: 2.5rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .dashboard-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .dashboard-hero::after {
        content: '';
        position: absolute;
        bottom: -60%;
        left: 10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .hero-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .hero-subtitle {
        opacity: 0.85;
        font-size: 1rem;
        max-width: 500px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon svg {
        width: 24px;
        height: 24px;
    }

    .stat-icon.green {
        background-color: rgba(16, 185, 129, 0.15);
        color: #10b981;
    }

    .stat-icon.blue {
        background-color: rgba(59, 130, 246, 0.15);
        color: #3b82f6;
    }

    .stat-icon.orange {
        background-color: rgba(249, 115, 22, 0.15);
        color: #f97316;
    }

    .stat-icon.emerald {
        background-color: rgba(16, 185, 129, 0.15);
        color: #10b981;
    }

    .stat-icon.red {
        background-color: rgba(239, 68, 68, 0.15);
        color: #ef4444;
    }

    .stat-icon.purple {
        background-color: rgba(139, 92, 246, 0.15);
        color: #8b5cf6;
    }

    .stat-info h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-main);
        line-height: 1;
        margin-bottom: 0.25rem;
    }

    .stat-info p {
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    /* Charts Section */
    .charts-section {
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title svg {
        width: 20px;
        height: 20px;
        color: var(--primary);
    }

    .chart-card {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .chart-title {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .chart-title-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .chart-title-icon svg {
        width: 18px;
        height: 18px;
    }

    .chart-title-icon.green {
        background-color: rgba(6, 131, 233, 0.15);
        color: #075af3ff;
    }

    .chart-title-icon.orange {
        background-color: rgba(249, 115, 22, 0.15);
        color: #f97316;
    }

    .chart-title-icon.emerald {
        background-color: rgba(16, 185, 129, 0.15);
        color: #8cb910ff;
    }

    .chart-title-icon.purple {
        background-color: rgba(139, 92, 246, 0.15);
        color: #8b5cf6;
    }

    .chart-container {
        position: relative;
        height: 280px;
    }

    .charts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 1.5rem;
    }

    /* Combined Chart */
    .combined-chart-card {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .combined-chart-container {
        height: 350px;
        position: relative;
    }

    .chart-legend {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-top: 1rem;
        flex-wrap: wrap;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .legend-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
    }

    .legend-dot.applicants {
        background-color: #3b82f6;
    }

    .legend-dot.pending {
        background-color: #f97316;
    }

    .legend-dot.shortlisted {
        background-color: #22c55e;
    }

   .quick-actions {
        background-color: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 1.5rem;
    }

    .action-links {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .action-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem;
        background-color: var(--surface-hover);
        border-radius: 8px;
        color: var(--text-main);
        font-weight: 500;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .action-link:hover {
        background-color: var(--primary);
        color: white;
        transform: translateX(5px);
    }

    .action-link svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    @media (max-width: 768px) {
        .dashboard-hero {
            padding: 1.5rem;
        }

        .hero-title {
            font-size: 1.5rem;
        }

        .stats-grid {
            grid-template-columns: 1fr 1fr;
        }

        .charts-grid {
            grid-template-columns: 1fr;
        }

        .chart-container {
            height: 220px;
        }

        .combined-chart-container {
            height: 280px;
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('page-content')
<!-- Hero Section -->
<div class="dashboard-hero">
    <div class="hero-content">
        <h1 class="hero-title">Campus Bird Internship</h1>
        <p class="hero-subtitle">Manage internship programs, student applications, and campus activities.</p>
    </div>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon green">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['total_applicants'] ?? 0 }}</h3>
            <p>Total Applicants</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon blue">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['active_forms'] ?? 0 }}</h3>
            <p>Active Forms</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['pending_applications'] ?? 0 }}</h3>
            <p>Pending Applications</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon emerald">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['shortlisted_applications'] ?? 0 }}</h3>
            <p>Shortlisted</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon red">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['rejected_applications'] ?? 0 }}</h3>
            <p>Rejected</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon purple">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['recent_applicants'] ?? 0 }}</h3>
            <p>Last 30 Days</p>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="charts-section">
    <h2 class="section-title">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="20" x2="18" y2="10"></line>
            <line x1="12" y1="20" x2="12" y2="4"></line>
            <line x1="6" y1="20" x2="6" y2="14"></line>
        </svg>
        Growth Analytics (Last 12 Months)
    </h2>

    <!-- Combined Chart -->
    <div class="combined-chart-card">
        <div class="chart-header">
            <div class="chart-title">
                <span>Application Submissions & Status Over Time</span>
            </div>
        </div>
        <div class="combined-chart-container">
            <canvas id="combinedChart"></canvas>
        </div>
        <div class="chart-legend">
            <div class="legend-item">
                <span class="legend-dot applicants"></span>
                <span>All Applicants</span>
            </div>
            <div class="legend-item">
                <span class="legend-dot pending"></span>
                <span>Pending</span>
            </div>
            <div class="legend-item">
                <span class="legend-dot shortlisted"></span>
                <span>Shortlisted</span>
            </div>
        </div>
    </div>

    <!-- Individual Charts -->
    <div class="charts-grid">
        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <div class="chart-title-icon green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <span>Total Applicants</span>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="applicantsChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <div class="chart-title-icon orange">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                        </svg>
                    </div>
                    <span>Pending Applications</span>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="pendingChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <div class="chart-title-icon emerald">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                    </div>
                    <span>Shortlisted Applicants</span>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="shortlistedChart"></canvas>
            </div>
        </div>
    </div>
</div>


<!-- Alumni Analytics Section -->
<div class="charts-section">
    <h2 class="section-title">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
        </svg>
        Alumni Analytics
    </h2>

    <div class="charts-grid">
        <!-- Category Wise Pie Chart -->
        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <div class="chart-title-icon purple">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                            <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                        </svg>
                    </div>
                    <span>Alumni by Category</span>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>

        <!-- Program Wise Bar Chart -->
        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <div class="chart-title-icon blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="20" x2="18" y2="10"></line>
                            <line x1="12" y1="20" x2="12" y2="4"></line>
                            <line x1="6" y1="20" x2="6" y2="14"></line>
                        </svg>
                    </div>
                    <span>Top Programs</span>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="programChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <h2 class="section-title">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
        </svg>
        Quick Actions
    </h2>
    <div class="action-links">
        <a href="{{ route('admin.campus-bird.applicants') }}" class="action-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            View Applicants
        </a>
        <a href="{{ route('admin.campus-bird.forms.index') }}" class="action-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
            Manage Application Forms
        </a>
        <a href="{{ route('admin.campus-bird.applicants') }}?status=pending" class="action-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
            Pending Applications
        </a>
        <a href="{{ route('admin.dashboard') }}" class="action-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
            Back to Main Dashboard
        </a>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Chart data from controller
    const chartData = @json($chartData);

    // Chart.js default configuration for dark theme
    Chart.defaults.color = '#94a3b8';
    Chart.defaults.borderColor = 'rgba(148, 163, 184, 0.1)';

    // Combined Chart
    const combinedCtx = document.getElementById('combinedChart').getContext('2d');
    new Chart(combinedCtx, {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: [
                {
                    label: 'All Applicants',
                    data: chartData.applicants,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                },
                {
                    label: 'Pending',
                    data: chartData.pending,
                    borderColor: '#f97316',
                    backgroundColor: 'rgba(249, 115, 22, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                },
                {
                    label: 'Shortlisted',
                    data: chartData.shortlisted,
                    borderColor: '#22c55e',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleColor: '#fff',
                    bodyColor: '#94a3b8',
                    borderColor: 'rgba(148, 163, 184, 0.2)',
                    borderWidth: 1,
                    padding: 12,
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(148, 163, 184, 0.1)'
                    },
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Applicants Chart
    const applicantsCtx = document.getElementById('applicantsChart').getContext('2d');
    new Chart(applicantsCtx, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Applicants',
                data: chartData.applicants,
                backgroundColor: 'rgba(59, 130, 246, 0.7)',
                borderColor: '#3b82f6',
                borderWidth: 1,
                borderRadius: 4,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    padding: 12,
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(148, 163, 184, 0.1)' },
                    ticks: { stepSize: 1 }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    // Pending Chart
    const pendingCtx = document.getElementById('pendingChart').getContext('2d');
    new Chart(pendingCtx, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Pending',
                data: chartData.pending,
                backgroundColor: 'rgba(249, 115, 22, 0.7)',
                borderColor: '#f97316',
                borderWidth: 1,
                borderRadius: 4,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    padding: 12,
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(148, 163, 184, 0.1)' },
                    ticks: { stepSize: 1 }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    // Shortlisted Chart
    const shortlistedCtx = document.getElementById('shortlistedChart').getContext('2d');
    new Chart(shortlistedCtx, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Shortlisted',
                data: chartData.shortlisted,
                backgroundColor: 'rgba(34, 197, 94, 0.7)',
                borderColor: '#22c55e',
                borderWidth: 1,
                borderRadius: 4,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    padding: 12,
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(148, 163, 184, 0.1)' },
                    ticks: { stepSize: 1 }
                },
                x: {
                    grid: { display: false }
                }
            }
        }
    });

    // Alumni Category Pie Chart
    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    const alumniByCategory = @json($alumniByCategory ?? []);
    
    new Chart(categoryCtx, {
        type: 'pie',
        data: {
            labels: Object.keys(alumniByCategory),
            datasets: [{
                data: Object.values(alumniByCategory),
                backgroundColor: [
                    'rgba(59, 130, 246, 0.7)',
                    'rgba(16, 185, 129, 0.7)',
                    'rgba(249, 115, 22, 0.7)',
                    'rgba(139, 92, 246, 0.7)',
                    'rgba(236, 72, 153, 0.7)',
                    'rgba(234, 179, 8, 0.7)',
                    'rgba(6, 182, 212, 0.7)',
                    'rgba(99, 102, 241, 0.7)'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#94a3b8',
                        font: { size: 10 },
                        boxWidth: 10
                    }
                }
            }
        }
    });

    // Alumni Program Bar Chart
    const programCtx = document.getElementById('programChart').getContext('2d');
    const alumniByProgram = @json($alumniByProgram ?? []);
    
    new Chart(programCtx, {
        type: 'bar',
        data: {
            labels: Object.keys(alumniByProgram),
            datasets: [{
                label: 'Alumni Count',
                data: Object.values(alumniByProgram),
                backgroundColor: 'rgba(99, 102, 241, 0.7)',
                borderColor: '#6366f1',
                borderWidth: 1,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: { color: 'rgba(148, 163, 184, 0.1)' },
                    ticks: { stepSize: 1 }
                },
                y: {
                    grid: { display: false }
                }
            }
        }
    });
</script>
@endsection
