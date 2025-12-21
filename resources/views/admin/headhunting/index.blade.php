@extends('admin.headhunting.layout')

@section('page-title', 'Dashboard')

@section('page-styles')
<style>
    .dashboard-hero {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #0f172a 100%);
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

    .stat-icon.purple {
        background-color: rgba(139, 92, 246, 0.15);
        color: #8b5cf6;
    }

    .stat-icon.blue {
        background-color: rgba(59, 130, 246, 0.15);
        color: #3b82f6;
    }

    .stat-icon.green {
        background-color: rgba(34, 197, 94, 0.15);
        color: #22c55e;
    }

    .stat-icon.orange {
        background-color: rgba(249, 115, 22, 0.15);
        color: #f97316;
    }

    .stat-icon.cyan {
        background-color: rgba(6, 182, 212, 0.15);
        color: #06b6d4;
    }

    .stat-icon.pink {
        background-color: rgba(236, 72, 153, 0.15);
        color: #ec4899;
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

    .chart-title-icon.purple {
        background-color: rgba(139, 92, 246, 0.15);
        color: #8b5cf6;
    }

    .chart-title-icon.green {
        background-color: rgba(34, 197, 94, 0.15);
        color: #22c55e;
    }

    .chart-title-icon.cyan {
        background-color: rgba(6, 182, 212, 0.15);
        color: #06b6d4;
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

    .legend-dot.candidates {
        background-color: #8b5cf6;
    }

    .legend-dot.employers {
        background-color: #22c55e;
    }

    .legend-dot.blogs {
        background-color: #06b6d4;
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
        <h1 class="hero-title">Welcome to Headhunting</h1>
        <p class="hero-subtitle">Manage executive search and specialized recruitment services from this dashboard.</p>
    </div>
</div>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon purple">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['total_candidates'] ?? 0 }}</h3>
            <p>Total Candidates</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon blue">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['recent_candidates'] ?? 0 }}</h3>
            <p>New Candidates (30d)</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon green">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 21h18"></path>
                <path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"></path>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['total_employers'] ?? 0 }}</h3>
            <p>Total Employers</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon orange">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['pending_employers'] ?? 0 }}</h3>
            <p>Pending Approval</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon cyan">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['total_blogs'] ?? 0 }}</h3>
            <p>Total Blog Posts</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon pink">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="20" x2="12" y2="10"></line>
                <line x1="18" y1="20" x2="18" y2="4"></line>
                <line x1="6" y1="20" x2="6" y2="16"></line>
            </svg>
        </div>
        <div class="stat-info">
            <h3>{{ $stats['recent_blogs'] ?? 0 }}</h3>
            <p>New Posts (30d)</p>
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
                <span>Account Registrations & Blog Posts Over Time</span>
            </div>
        </div>
        <div class="combined-chart-container">
            <canvas id="combinedChart"></canvas>
        </div>
        <div class="chart-legend">
            <div class="legend-item">
                <span class="legend-dot candidates"></span>
                <span>Candidates</span>
            </div>
            <div class="legend-item">
                <span class="legend-dot employers"></span>
                <span>Employers</span>
            </div>
            <div class="legend-item">
                <span class="legend-dot blogs"></span>
                <span>Blog Posts</span>
            </div>
        </div>
    </div>

    <!-- Individual Charts -->
    <div class="charts-grid">
        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <div class="chart-title-icon purple">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <span>Candidates</span>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="candidatesChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <div class="chart-title-icon green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 21h18"></path>
                            <path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"></path>
                        </svg>
                    </div>
                    <span>Employers</span>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="employersChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <div class="chart-header">
                <div class="chart-title">
                    <div class="chart-title-icon cyan">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                        </svg>
                    </div>
                    <span>Blog Posts</span>
                </div>
            </div>
            <div class="chart-container">
                <canvas id="blogsChart"></canvas>
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
        <a href="{{ route('admin.headhunting.candidates') }}" class="action-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
            View All Candidates
        </a>
        <a href="{{ route('admin.headhunting.employers') }}" class="action-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 21h18"></path>
                <path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"></path>
            </svg>
            View All Employers
        </a>
        <a href="{{ route('admin.headhunting.blogs') }}" class="action-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
            </svg>
            View All Blogs
        </a>
        <a href="{{ route('admin.headhunting.employers') }}?status=pending" class="action-link">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
            </svg>
            Pending Employers
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
                    label: 'Candidates',
                    data: chartData.candidates,
                    borderColor: '#8b5cf6',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                },
                {
                    label: 'Employers',
                    data: chartData.employers,
                    borderColor: '#22c55e',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                },
                {
                    label: 'Blog Posts',
                    data: chartData.blogs,
                    borderColor: '#06b6d4',
                    backgroundColor: 'rgba(6, 182, 212, 0.1)',
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

    // Candidates Chart
    const candidatesCtx = document.getElementById('candidatesChart').getContext('2d');
    new Chart(candidatesCtx, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Candidates',
                data: chartData.candidates,
                backgroundColor: 'rgba(139, 92, 246, 0.7)',
                borderColor: '#8b5cf6',
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

    // Employers Chart
    const employersCtx = document.getElementById('employersChart').getContext('2d');
    new Chart(employersCtx, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Employers',
                data: chartData.employers,
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

    // Blogs Chart
    const blogsCtx = document.getElementById('blogsChart').getContext('2d');
    new Chart(blogsCtx, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Blog Posts',
                data: chartData.blogs,
                backgroundColor: 'rgba(6, 182, 212, 0.7)',
                borderColor: '#06b6d4',
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
</script>
@endsection
