import React, { useState } from 'react';
import EmployerLayout from '../../Layouts/EmployerLayout';
import { router } from '@inertiajs/react';

interface Job {
    id: number;
    title: string;
    field_type: string;
    job_type: string;
    status: string;
    created_at: string;
}

interface PostJobProps {
    jobs: Job[];
    filters: {
        search?: string;
        field_type?: string;
        job_type?: string;
        status?: string;
    };
}

export default function PostJob({ jobs, filters }: PostJobProps) {
    const [isMobileSidebarOpen, setIsMobileSidebarOpen] = useState(false);

    const handleFilterChange = (name: string, value: string) => {
        router.get(
            '/headhunting/post-job',
            { ...filters, [name]: value },
            { preserveState: true, replace: true }
        );
    };

    const clearFilters = () => {
        router.get('/headhunting/post-job', {}, { replace: true });
    };

    const handleDelete = (jobId: number) => {
        if (confirm('Are you sure you want to delete this job?')) {
            router.delete(`/headhunting/job/${jobId}`, {
                preserveScroll: true,
            });
        }
    };

    const handleToggleStatus = (jobId: number, currentStatus: string) => {
        const newStatus = currentStatus === 'active' ? 'closed' : 'active';
        router.post(`/headhunting/job/${jobId}/toggle-status`, { status: newStatus }, {
            preserveScroll: true,
        });
    };

    const hasFilters = filters.search || filters.field_type || filters.job_type || filters.status;

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
                        <h1>Job Directory</h1>
                        <p>Manage and filter your job postings</p>
                    </div>
                </div>
            </div>

            {/* Filter Section */}
            <div className="card mb-4">
                <div className="card-body">
                    <div className="filter-form">
                        <div className="filter-group search-group">
                            <div className="search-input-wrapper">
                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    strokeWidth="2"
                                    className="search-icon"
                                >
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                                <input
                                    type="text"
                                    className="form-control search-control"
                                    placeholder="Search by job title..."
                                    value={filters.search || ''}
                                    onChange={(e) => handleFilterChange('search', e.target.value)}
                                />
                            </div>
                        </div>

                        <div className="filter-group">
                            <select
                                className="form-control"
                                value={filters.field_type || ''}
                                onChange={(e) => handleFilterChange('field_type', e.target.value)}
                            >
                                <option value="">All Fields</option>
                                <option value="Accounting">Accounting</option>
                                <option value="Administration">Administration</option>
                                <option value="Agriculture">Agriculture</option>
                                <option value="Architecture">Architecture</option>
                                <option value="Armed Forces">Armed Forces</option>
                                <option value="Aviation">Aviation</option>
                                <option value="Banking">Banking</option>
                                <option value="Business">Business</option>
                                <option value="Call Center / Customer Service">Call Center / Customer Service</option>
                                <option value="Civil Engineering">Civil Engineering</option>
                                <option value="Construction">Construction</option>
                                <option value="Consulting">Consulting</option>
                                <option value="Data Entry">Data Entry</option>
                                <option value="Defense">Defense</option>
                                <option value="Driving / Transport">Driving / Transport</option>
                                <option value="Education">Education</option>
                                <option value="Electrical Engineering">Electrical Engineering</option>
                                <option value="Engineering (General)">Engineering (General)</option>
                                <option value="Freelancing">Freelancing</option>
                                <option value="Garments / Textile">Garments / Textile</option>
                                <option value="Government Service">Government Service</option>
                                <option value="Graphic Design">Graphic Design</option>
                                <option value="Healthcare">Healthcare</option>
                                <option value="Hospitality / Tourism">Hospitality / Tourism</option>
                                <option value="Human Resources">Human Resources</option>
                                <option value="Import / Export">Import / Export</option>
                                <option value="Information Technology (IT)">Information Technology (IT)</option>
                                <option value="Journalism / Media">Journalism / Media</option>
                                <option value="Law / Legal">Law / Legal</option>
                                <option value="Manufacturing">Manufacturing</option>
                                <option value="Marketing / Sales">Marketing / Sales</option>
                                <option value="Mechanical Engineering">Mechanical Engineering</option>
                                <option value="NGO / Development">NGO / Development</option>
                                <option value="Nursing">Nursing</option>
                                <option value="Pharmacy">Pharmacy</option>
                                <option value="Police">Police</option>
                                <option value="Private Service">Private Service</option>
                                <option value="Public Service">Public Service</option>
                                <option value="Real Estate">Real Estate</option>
                                <option value="Research">Research</option>
                                <option value="Retail / Shopkeeping">Retail / Shopkeeping</option>
                                <option value="Security Service">Security Service</option>
                                <option value="Self-Employed">Self-Employed</option>
                                <option value="Shipping / Logistics">Shipping / Logistics</option>
                                <option value="Software Development">Software Development</option>
                                <option value="Teaching">Teaching</option>
                                <option value="Telecommunications">Telecommunications</option>
                                <option value="Trading">Trading</option>
                                <option value="Transport / Logistics">Transport / Logistics</option>
                            </select>
                        </div>

                        <div className="filter-group">
                            <select
                                className="form-control"
                                value={filters.job_type || ''}
                                onChange={(e) => handleFilterChange('job_type', e.target.value)}
                            >
                                <option value="">All Job Types</option>
                                <option value="Full Time">Full Time</option>
                                <option value="Part Time">Part Time</option>
                                <option value="Remote">Remote</option>
                                <option value="Freelance">Freelance</option>
                                <option value="Internship">Internship</option>
                            </select>
                        </div>

                        <div className="filter-group">
                            <select
                                className="form-control"
                                value={filters.status || ''}
                                onChange={(e) => handleFilterChange('status', e.target.value)}
                            >
                                <option value="">All Status</option>
                                <option value="active">Active</option>
                                <option value="closed">Closed</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>

                        <a href="/headhunting/create-job" className="btn-primary create-btn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Create New Job
                        </a>
                    </div>
                </div>
            </div>

            {/* Job Listing Table */}
            <div className="card">
                <div className="card-header">
                    <h3>Posted Jobs ({jobs.length})</h3>
                    {hasFilters && (
                        <button onClick={clearFilters} className="btn-text">
                            Clear Filters
                        </button>
                    )}
                </div>
                <div className="card-body p-0">
                    {jobs.length > 0 ? (
                        <div className="table-responsive">
                            <table className="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Field</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {jobs.map((job) => (
                                        <tr key={job.id}>
                                            <td>{new Date(job.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })}</td>
                                            <td>{job.title}</td>
                                            <td>{job.field_type}</td>
                                            <td>
                                                <span className="badge badge-blue">{job.job_type}</span>
                                            </td>
                                            <td>
                                                <span
                                                    className={`badge ${job.status === 'active' ? 'badge-green' : 'badge-gray'
                                                        }`}
                                                >
                                                    {job.status.charAt(0).toUpperCase() + job.status.slice(1)}
                                                </span>
                                            </td>
                                            <td>
                                                <div className="action-buttons">
                                                    <a
                                                        href={`/headhunting/job/${job.id}`}
                                                        className="btn-icon"
                                                        title="View"
                                                    >
                                                        <svg
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            strokeWidth="2"
                                                        >
                                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                            <circle cx="12" cy="12" r="3"></circle>
                                                        </svg>
                                                    </a>
                                                    <a
                                                        href={`/headhunting/job/${job.id}/edit`}
                                                        className="btn-icon"
                                                        title="Edit"
                                                    >
                                                        <svg
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            strokeWidth="2"
                                                        >
                                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                        </svg>
                                                    </a>
                                                    <button
                                                        onClick={() => handleToggleStatus(job.id, job.status)}
                                                        className={`btn-icon ${job.status === 'active' ? 'text-warning' : 'text-success'}`}
                                                        title={job.status === 'active' ? 'Deactivate' : 'Activate'}
                                                    >
                                                        {job.status === 'active' ? (
                                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                                            </svg>
                                                        ) : (
                                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                                                <path d="M7 11V7a5 5 0 0 1 9.9-1"></path>
                                                            </svg>
                                                        )}
                                                    </button>
                                                    <button
                                                        onClick={() => handleDelete(job.id)}
                                                        className="btn-icon text-danger"
                                                        title="Delete"
                                                    >
                                                        <svg
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            strokeWidth="2"
                                                        >
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    ) : (
                        <div className="empty-list">
                            <p>No jobs found.</p>
                            {hasFilters ? (
                                <p>
                                    <button onClick={clearFilters} style={{ color: '#00d4ff', background: 'none', border: 'none', cursor: 'pointer', textDecoration: 'underline' }}>
                                        Clear filters
                                    </button>{' '}
                                    to see all jobs.
                                </p>
                            ) : (
                                <a
                                    href="/headhunting/create-job"
                                    className="btn-primary"
                                    style={{ marginTop: '1rem', display: 'inline-flex' }}
                                >
                                    Create Your First Job
                                </a>
                            )}
                        </div>
                    )}
                </div>
            </div>

            <style>{`
                .card {
                    background: rgba(255, 255, 255, 0.05);
                    border: 1px solid rgba(255, 255, 255, 0.1);
                    border-radius: 12px;
                    overflow: hidden;
                }

                .card-header {
                    padding: 1.5rem;
                    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                    background: rgba(255, 255, 255, 0.02);
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }

                .card-header h3 {
                    margin: 0;
                    font-size: 1.1rem;
                    font-weight: 600;
                    color: #fff;
                }

                .card-body {
                    padding: 1.5rem;
                }

                .card-body.p-0 {
                    padding: 0;
                }

                .filter-form {
                    display: flex;
                    gap: 1rem;
                    align-items: center;
                }

                .filter-group {
                    flex: 1;
                    min-width: 150px;
                }

                .search-group {
                    flex: 2;
                    min-width: 250px;
                }

                .search-input-wrapper {
                    position: relative;
                }

                .search-icon {
                    position: absolute;
                    left: 12px;
                    top: 50%;
                    transform: translateY(-50%);
                    width: 18px;
                    height: 18px;
                    color: rgba(255, 255, 255, 0.4);
                }

                .search-control {
                    padding-left: 2.5rem !important;
                }

                .form-control {
                    width: 100%;
                    padding: 0.6rem 1rem;
                    background: rgba(15, 23, 42, 0.5);
                    border: 1px solid rgba(255, 255, 255, 0.1);
                    border-radius: 6px;
                    color: white;
                    font-size: 0.95rem;
                    transition: all 0.3s ease;
                    height: 42px;
                }

                .form-control:focus {
                    outline: none;
                    border-color: #00d4ff;
                    box-shadow: 0 0 0 2px rgba(0, 212, 255, 0.1);
                }

                .btn-primary {
                    background: #10b981;
                    color: white;
                    border: none;
                    padding: 0 1.5rem;
                    height: 42px;
                    border-radius: 6px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                    gap: 0.5rem;
                    font-size: 0.9rem;
                    white-space: nowrap;
                }

                .create-btn {
                    flex: 0 0 auto;
                }

                .btn-primary svg {
                    width: 18px;
                    height: 18px;
                }

                .btn-primary:hover {
                    background: #059669;
                    transform: translateY(-1px);
                }

                .btn-text {
                    color: rgba(255, 255, 255, 0.6);
                    text-decoration: none;
                    font-size: 0.85rem;
                    background: none;
                    border: none;
                    cursor: pointer;
                }

                .btn-text:hover {
                    color: white;
                    text-decoration: underline;
                }

                .table {
                    width: 100%;
                    border-collapse: collapse;
                }

                .table th {
                    text-align: left;
                    padding: 1rem 1.5rem;
                    color: rgba(255, 255, 255, 0.6);
                    font-weight: 500;
                    font-size: 0.85rem;
                    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                }

                .table td {
                    padding: 1rem 1.5rem;
                    color: white;
                    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
                    vertical-align: middle;
                }

                .table tr:last-child td {
                    border-bottom: none;
                }

                .badge {
                    padding: 0.25rem 0.6rem;
                    border-radius: 4px;
                    font-size: 0.75rem;
                    font-weight: 600;
                }

                .badge-blue {
                    background: rgba(0, 212, 255, 0.15);
                    color: #00d4ff;
                }

                .badge-green {
                    background: rgba(16, 185, 129, 0.15);
                    color: #10b981;
                }

                .badge-gray {
                    background: rgba(148, 163, 184, 0.15);
                    color: #94a3b8;
                }

                .action-buttons {
                    display: flex;
                    gap: 0.5rem;
                }

                .btn-icon {
                    background: transparent;
                    border: none;
                    color: rgba(255, 255, 255, 0.6);
                    cursor: pointer;
                    padding: 4px;
                    transition: color 0.2s;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .btn-icon svg {
                    width: 18px;
                    height: 18px;
                }

                .btn-icon:hover {
                    color: #00d4ff;
                }

                .text-warning {
                    color: #fbbf24 !important;
                }

                .text-warning:hover {
                    color: #fbbf24 !important;
                }

                .text-success {
                    color: #10b981 !important;
                }

                .text-success:hover {
                    color: #10b981 !important;
                }

                .btn-icon.text-danger:hover {
                    color: #ef4444;
                }

                .empty-list {
                    padding: 3rem;
                    text-align: center;
                    color: rgba(255, 255, 255, 0.5);
                }

                .mb-4 {
                    margin-bottom: 1.5rem;
                }

                .mobile-menu-btn {
                    display: none;
                }

                @media (max-width: 1024px) {
                    .filter-form {
                        flex-wrap: wrap;
                    }

                    .search-group {
                        flex: 1 1 100%;
                        min-width: 100%;
                    }

                    .filter-group {
                        flex: 1 1 calc(33% - 1rem);
                    }

                    .create-btn {
                        flex: 1 1 100%;
                        justify-content: center;
                    }

                    .header-with-menu {
                        display: flex;
                        align-items: flex-start;
                        gap: 1rem;
                    }

                    .mobile-menu-btn {
                        display: block;
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
                        text-align: right;
                    }

                    .header-content h1 {
                        text-align: right;
                    }

                    .header-content p {
                        text-align: right;
                    }
                }

                @media (max-width: 768px) {
                    .filter-group {
                        flex: 1 1 100%;
                    }

                    .table-responsive {
                        overflow-x: auto;
                    }
                }
            `}</style>
        </EmployerLayout>
    );
}
