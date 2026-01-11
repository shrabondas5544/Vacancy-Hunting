import React from 'react';
import EmployerLayout from '../../Layouts/EmployerLayout';
import { router } from '@inertiajs/react';

interface Job {
    id: number;
    title: string;
    field_type: string;
    job_type: string;
    location?: string;
    salary_range?: string;
    status: string;
    description: string;
    requirements?: string;
    created_at: string;
    deadline?: string;
}

interface ShowJobProps {
    job: Job;
}

export default function ShowJob({ job }: ShowJobProps) {
    const handleDelete = () => {
        if (confirm('Are you sure you want to delete this job?')) {
            router.delete(`/headhunting/job/${job.id}`, {
                onSuccess: () => {
                    router.visit('/headhunting/post-job');
                },
            });
        }
    };

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('en-US', {
            month: 'short',
            day: 'numeric',
            year: 'numeric',
        });
    };

    return (
        <EmployerLayout>
            <div className="content-header">
                <div style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center' }}>
                    <div>
                        <h1>Job Details</h1>
                        <p>View your job posting details</p>
                    </div>
                    <div style={{ display: 'flex', gap: '1rem' }}>
                        <a href="/headhunting/post-job" className="btn-secondary">
                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                strokeWidth="2"
                                style={{ width: '18px', height: '18px', marginRight: '0.5rem' }}
                            >
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            Back to List
                        </a>
                        <button onClick={handleDelete} className="btn-danger">
                            Delete Job
                        </button>
                    </div>
                </div>
            </div>

            <div className="card">
                <div className="card-body">
                    <div className="job-header">
                        <div className="job-title-section">
                            <h2>{job.title}</h2>
                            <div className="job-meta">
                                <span className={`badge ${job.status === 'active' ? 'badge-green' : 'badge-gray'}`}>
                                    {job.status.charAt(0).toUpperCase() + job.status.slice(1)}
                                </span>
                                <span className="meta-item">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                    Posted {formatDate(job.created_at)}
                                </span>
                                {job.deadline && (
                                    <span className="meta-item text-warning">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <polyline points="12 6 12 12 16 14"></polyline>
                                        </svg>
                                        Deadline: {formatDate(job.deadline)}
                                    </span>
                                )}
                            </div>
                        </div>
                    </div>

                    <div className="job-details-grid">
                        <div className="detail-item">
                            <label>Field Type</label>
                            <div className="value">{job.field_type}</div>
                        </div>
                        <div className="detail-item">
                            <label>Job Type</label>
                            <div className="value">{job.job_type}</div>
                        </div>
                        <div className="detail-item">
                            <label>Location</label>
                            <div className="value">{job.location || 'Not specified'}</div>
                        </div>
                        <div className="detail-item">
                            <label>Salary Range</label>
                            <div className="value">{job.salary_range || 'Negotiable'}</div>
                        </div>
                    </div>

                    <div className="job-description-section">
                        <h3 className="section-title">Job Description</h3>
                        <div className="description-content">
                            {job.description.split('\n').map((line, index) => (
                                <React.Fragment key={index}>
                                    {line}
                                    <br />
                                </React.Fragment>
                            ))}
                        </div>
                    </div>

                    {job.requirements && (
                        <div className="job-description-section">
                            <h3 className="section-title">Requirements</h3>
                            <div className="description-content">
                                {job.requirements.split('\n').map((line, index) => (
                                    <React.Fragment key={index}>
                                        {line}
                                        <br />
                                    </React.Fragment>
                                ))}
                            </div>
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

                .card-body {
                    padding: 2rem;
                }

                .job-header {
                    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                    padding-bottom: 2rem;
                    margin-bottom: 2rem;
                }

                .job-title-section h2 {
                    font-size: 1.8rem;
                    margin: 0 0 1rem 0;
                    color: white;
                }

                .job-meta {
                    display: flex;
                    gap: 1.5rem;
                    align-items: center;
                    flex-wrap: wrap;
                }

                .meta-item {
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                    color: rgba(255, 255, 255, 0.6);
                    font-size: 0.9rem;
                }

                .meta-item svg {
                    width: 16px;
                    height: 16px;
                }

                .text-warning {
                    color: #fbbf24;
                }

                .badge {
                    padding: 0.4rem 0.8rem;
                    border-radius: 6px;
                    font-size: 0.8rem;
                    font-weight: 600;
                }

                .badge-green {
                    background: rgba(16, 185, 129, 0.15);
                    color: #10b981;
                }

                .badge-gray {
                    background: rgba(148, 163, 184, 0.15);
                    color: #94a3b8;
                }

                .job-details-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                    gap: 2rem;
                    margin-bottom: 3rem;
                    padding: 1.5rem;
                    background: rgba(255, 255, 255, 0.02);
                    border-radius: 8px;
                }

                .detail-item label {
                    display: block;
                    color: rgba(255, 255, 255, 0.5);
                    font-size: 0.85rem;
                    margin-bottom: 0.5rem;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                }

                .detail-item .value {
                    font-size: 1.1rem;
                    color: white;
                    font-weight: 500;
                }

                .section-title {
                    color: #00bcd4;
                    font-size: 1.2rem;
                    margin-bottom: 1rem;
                    padding-bottom: 0.5rem;
                    border-bottom: 1px solid rgba(0, 188, 212, 0.3);
                    display: inline-block;
                }

                .job-description-section {
                    margin-bottom: 2rem;
                }

                .description-content {
                    color: rgba(255, 255, 255, 0.9);
                    line-height: 1.7;
                    font-size: 1rem;
                }

                .btn-secondary {
                    background: rgba(255, 255, 255, 0.1);
                    color: white;
                    border: 1px solid rgba(255, 255, 255, 0.1);
                    padding: 0.6rem 1.2rem;
                    border-radius: 6px;
                    font-weight: 500;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                }

                .btn-secondary:hover {
                    background: rgba(255, 255, 255, 0.15);
                }

                .btn-danger {
                    background: rgba(239, 68, 68, 0.15);
                    color: #ef4444;
                    border: 1px solid rgba(239, 68, 68, 0.3);
                    padding: 0.6rem 1.2rem;
                    border-radius: 6px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: all 0.3s ease;
                }

                .btn-danger:hover {
                    background: #ef4444;
                    color: white;
                }
            `}</style>
        </EmployerLayout>
    );
}
