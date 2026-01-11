import React from 'react';
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
    return (
        <EmployerLayout>
            <div className="content-header">
                <h1>Dashboard</h1>
                <p>Welcome to your employer portal</p>
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
        </EmployerLayout>
    );
}
