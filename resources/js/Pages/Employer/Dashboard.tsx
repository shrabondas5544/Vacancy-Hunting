import React, { useState } from 'react';
import EmployerLayout from '../../Layouts/EmployerLayout';

interface Stats {
    total_jobs: number;
    active_jobs: number;
    total_applications: number;
    pending_applications: number;
}

interface DashboardProps {
    stats: Stats;
}

export default function Dashboard({ stats }: DashboardProps) {
    const [isMobileSidebarOpen, setIsMobileSidebarOpen] = useState(false);

    return (
        <EmployerLayout
            isMobileSidebarOpen={isMobileSidebarOpen}
            setIsMobileSidebarOpen={setIsMobileSidebarOpen}
        >
            <div className="content-header">
                <div className="header-with-menu">
                    <button
                        className="mobile-menu-btn"
                        onClick={() => setIsMobileSidebarOpen(true)}
                        aria-label="Open menu"
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                        </svg>
                    </button>
                    <div className="header-content">
                        <h1>Dashboard</h1>
                        <p>Welcome to your employer portal</p>
                    </div>
                </div>
            </div>

            <div className="stats-grid">
                <div className="stat-card">
                    <h3>Total Jobs Posted</h3>
                    <div className="stat-value">{stats.total_jobs}</div>
                </div>
                <div className="stat-card">
                    <h3>Active Jobs</h3>
                    <div className="stat-value">{stats.active_jobs}</div>
                </div>
                <div className="stat-card">
                    <h3>Total Applications</h3>
                    <div className="stat-value">{stats.total_applications}</div>
                </div>
                <div className="stat-card">
                    <h3>Pending Applications</h3>
                    <div className="stat-value">{stats.pending_applications}</div>
                </div>
            </div>

            <div className="empty-state">
                <h2>Dashboard Statistics Coming Soon</h2>
                <p>
                    This section will display detailed analytics and insights about your job postings
                    and applications.
                </p>
            </div>

            <style>{`
                .header-with-menu {
                    display: flex;
                    align-items: flex-start;
                    gap: 1rem;
                }

                .mobile-menu-btn {
                    display: none;
                    background: transparent;
                    border: none;
                    color: white;
                    cursor: pointer;
                    padding: 0.5rem;
                    margin-top: -0.5rem;
                }

                .mobile-menu-btn svg {
                    width: 24px;
                    height: 24px;
                }

                .header-content {
                    flex: 1;
                }

                @media (max-width: 1024px) {
                    .mobile-menu-btn {
                        display: block;
                    }

                    .header-content {
                        text-align: right;
                    }

                    .header-content h1 {
                        text-align: right;
                    }

                    .header-content p {
                        text-align: right;
                    }
                }
            `}</style>
        </EmployerLayout>
    );
}
