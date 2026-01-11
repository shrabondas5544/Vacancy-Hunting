import React, { ReactNode } from 'react';

interface EmployerLayoutProps {
    children: ReactNode;
}

export default function EmployerLayout({ children }: EmployerLayoutProps) {
    // Get current route to highlight active sidebar link
    const currentRoute = window.location.pathname;

    return (
        <>
            {/* Main content wrapper */}
            <div className="employer-wrapper">
                <div className="employer-container">
                    {/* Sidebar */}
                    <aside className="employer-sidebar">
                        <div className="sidebar-header">
                            <h2>Employer Portal</h2>
                        </div>
                        <nav className="sidebar-nav">
                            <a
                                href="/headhunting/dashboard"
                                className={`sidebar-link ${currentRoute.includes('/dashboard') ? 'active' : ''
                                    }`}
                            >
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>
                                <span>Dashboard</span>
                            </a>
                            <a
                                href="/headhunting/post-job"
                                className={`sidebar-link ${currentRoute.includes('/post-job') ? 'active' : ''
                                    }`}
                            >
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                    <path d="M12 5v14M5 12h14"></path>
                                </svg>
                                <span>Post a Job</span>
                            </a>
                        </nav>
                    </aside>

                    {/* Main Content */}
                    <main className="employer-content">{children}</main>
                </div>
            </div>
        </>
    );
}
