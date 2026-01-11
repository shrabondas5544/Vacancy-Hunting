import React from 'react';
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

    const hasFilters = filters.search || filters.field_type || filters.job_type || filters.status;

    return (
        <EmployerLayout>
            <div className="content-header">
                <h1>Job Directory</h1>
                <p>Manage and filter your job postings</p>
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
                                <option value="IT">IT & Software</option>
                                <option value="Marketing">Marketing</option>
                                <option value="HR">Human Resources</option>
                                <option value="Finance">Finance</option>
                                <option value="Design">Design</option>
                                <option value="Sales">Sales</option>
                                <option value="Engineering">Engineering</option>
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
