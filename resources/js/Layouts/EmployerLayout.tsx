import React, { ReactNode } from 'react';

interface EmployerLayoutProps {
    children: ReactNode;
    isMobileSidebarOpen?: boolean;
    setIsMobileSidebarOpen?: (isOpen: boolean) => void;
}

export default function EmployerLayout({
    children,
    isMobileSidebarOpen = false,
    setIsMobileSidebarOpen
}: EmployerLayoutProps) {
    // Get current route to highlight active sidebar link
    const currentRoute = window.location.pathname;

    return (
        <>
            {/* Mobile Sidebar Overlay */}
            {isMobileSidebarOpen && (
                <div
                    className="mobile-sidebar-overlay"
                    onClick={() => setIsMobileSidebarOpen?.(false)}
                />
            )}

            {/* Main content wrapper */}
            <div className="employer-wrapper">
                <div className="employer-container">
                    {/* Desktop Sidebar */}
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
                            <a
                                href="/headhunting/candidates"
                                className={`sidebar-link ${currentRoute.includes('/candidates') ? 'active' : ''
                                    }`}
                            >
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span>View Candidates</span>
                            </a>
                            <a
                                href="/headhunting/other-jobs"
                                className={`sidebar-link ${currentRoute.includes('/other-jobs') ? 'active' : ''
                                    }`}
                            >
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                                <span>Job Posts by Others</span>
                            </a>
                        </nav>
                    </aside>

                    {/* Mobile Sidebar Drawer */}
                    <aside className={`mobile-sidebar-drawer ${isMobileSidebarOpen ? 'open' : ''}`}>
                        <div className="sidebar-header">
                            <h2>Employer Portal</h2>
                            <button
                                className="close-btn"
                                onClick={() => setIsMobileSidebarOpen?.(false)}
                                aria-label="Close menu"
                            >
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
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
                            <a
                                href="/headhunting/candidates"
                                className={`sidebar-link ${currentRoute.includes('/candidates') ? 'active' : ''
                                    }`}
                            >
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span>View Candidates</span>
                            </a>
                            <a
                                href="/headhunting/other-jobs"
                                className={`sidebar-link ${currentRoute.includes('/other-jobs') ? 'active' : ''
                                    }`}
                            >
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                </svg>
                                <span>Job Posts by Others</span>
                            </a>
                        </nav>
                    </aside>

                    {/* Main Content */}
                    <main className="employer-content">{children}</main>
                </div>
            </div>

            <style>{`
                .mobile-sidebar-overlay {
                    display: none;
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.5);
                    z-index: 999;
                }

                .mobile-sidebar-drawer {
                    display: none;
                    position: fixed;
                    top: 70px;
                    left: -280px;
                    width: 280px;
                    height: calc(100vh - 70px);
                    background: rgba(15, 23, 42, 0.98);
                    background-image: 
                        radial-gradient(at 0% 0%, rgba(56, 189, 248, 0.15) 0px, transparent 50%), 
                        radial-gradient(at 100% 100%, rgba(30, 58, 138, 0.2) 0px, transparent 50%);
                    -webkit-backdrop-filter: blur(20px) saturate(180%);
                    backdrop-filter: blur(20px) saturate(180%);
                    border-right: 1px solid rgba(255, 255, 255, 0.1);
                    padding: 2rem 0;
                    z-index: 1000;
                    overflow-y: auto;
                    transition: left 0.3s ease;
                }

                .mobile-sidebar-drawer.open {
                    left: 0;
                }

                .mobile-sidebar-drawer .sidebar-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 0 1.5rem 1.5rem;
                    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                    margin-bottom: 1rem;
                }

                .mobile-sidebar-drawer .close-btn {
                    background: transparent;
                    border: none;
                    color: rgba(255, 255, 255, 0.7);
                    cursor: pointer;
                    padding: 0.5rem;
                    transition: color 0.2s;
                }

                .mobile-sidebar-drawer .close-btn:hover {
                    color: white;
                }

                .mobile-sidebar-drawer .close-btn svg {
                    width: 20px;
                    height: 20px;
                }

                @media (max-width: 1024px) {
                    .mobile-sidebar-overlay {
                        display: block;
                        top: 70px;
                    }

                    .mobile-sidebar-drawer {
                        display: block;
                    }
                }
            `}</style>
        </>
    );
}
