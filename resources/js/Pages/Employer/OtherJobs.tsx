import { useState, useEffect } from 'react';
import EmployerLayout from '../../Layouts/EmployerLayout';
import { router } from '@inertiajs/react';

interface Job {
    id: number;
    title: string;
    field_type: string;
    job_type: string;
    experience_level?: string;
    location?: string;
    vacancies?: number;
    salary_range?: string;
    deadline?: string;
    status: string;
    created_at: string;
    employer: {
        id: number;
        company_name: string;
        profile_picture?: string;
        company_type?: string;
        ownership_type?: string;
    };
}

interface OtherJobsProps {
    jobs: Job[];
    filters: {
        company_type?: string;
        ownership_type?: string;
        field_type?: string;
        job_type?: string;
        division?: string;
    };
}

export default function OtherJobs({ jobs, filters }: OtherJobsProps) {
    const [isMobileSidebarOpen, setIsMobileSidebarOpen] = useState(false);
    const [isFilterModalOpen, setIsFilterModalOpen] = useState(false);
    const [tempFilters, setTempFilters] = useState(filters);

    // Helper function to calculate relative time
    const getTimeAgo = (dateString: string) => {
        const now = new Date();
        const posted = new Date(dateString);
        const diffMs = now.getTime() - posted.getTime();
        const diffMins = Math.floor(diffMs / 60000);
        const diffHours = Math.floor(diffMs / 3600000);
        const diffDays = Math.floor(diffMs / 86400000);
        const diffWeeks = Math.floor(diffDays / 7);
        const diffMonths = Math.floor(diffDays / 30);

        if (diffMins < 60) return diffMins <= 1 ? 'Just now' : `${diffMins} minutes ago`;
        if (diffHours < 24) return diffHours === 1 ? '1 hour ago' : `${diffHours} hours ago`;
        if (diffDays < 7) return diffDays === 1 ? '1 day ago' : `${diffDays} days ago`;
        if (diffWeeks < 4) return diffWeeks === 1 ? '1 week ago' : `${diffWeeks} weeks ago`;
        return diffMonths === 1 ? '1 month ago' : `${diffMonths} months ago`;
    };

    const handleFilterChange = (name: string, value: string) => {
        router.get(
            '/headhunting/other-jobs',
            { ...filters, [name]: value },
            { preserveState: true, replace: true }
        );
    };

    // Handle temp filter changes in modal (don't apply immediately)
    const handleTempFilterChange = (name: string, value: string) => {
        setTempFilters(prev => ({ ...prev, [name]: value }));
    };

    // Apply filters and close modal
    const applyFilters = () => {
        router.get(
            '/headhunting/other-jobs',
            tempFilters,
            { preserveState: true, replace: true }
        );
        setIsFilterModalOpen(false);
    };

    const clearFilters = () => {
        const emptyFilters = { company_type: '', ownership_type: '', field_type: '', job_type: '', division: '' };
        setTempFilters(emptyFilters);
        router.get('/headhunting/other-jobs', {}, { replace: true });
        setIsFilterModalOpen(false);
    };

    // Check if temp filters have changed from applied filters
    const hasTempChanges = () => {
        return tempFilters.company_type !== (filters.company_type || '') ||
            tempFilters.ownership_type !== (filters.ownership_type || '') ||
            tempFilters.field_type !== (filters.field_type || '') ||
            tempFilters.job_type !== (filters.job_type || '') ||
            tempFilters.division !== (filters.division || '');
    };

    const hasFilters = filters.company_type || filters.ownership_type || filters.field_type || filters.job_type || filters.division;

    // Sync tempFilters with applied filters when component updates
    useEffect(() => {
        setTempFilters(filters);
    }, [filters]);

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
                        <h1>Job Posts by Others</h1>
                        <p>Browse job opportunities posted by other companies</p>
                    </div>
                </div>
            </div>

            {/* Filter Modal for Mobile */}
            {isFilterModalOpen && (
                <>
                    <div className="filter-modal-overlay" onClick={() => setIsFilterModalOpen(false)}></div>
                    <div className="filter-modal">
                        <div className="filter-modal-header">
                            <h3>Filter Jobs</h3>
                            <button onClick={() => setIsFilterModalOpen(false)} className="close-modal-btn">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </div>
                        <div className="filter-modal-body">
                            <div className="filter-group">
                                <label>Company Type</label>
                                <select
                                    className="form-control"
                                    value={tempFilters.company_type || ''}
                                    onChange={(e) => handleTempFilterChange('company_type', e.target.value)}
                                >
                                    <option value="">All Types</option>
                                    <option value="Startup">Startup</option>
                                    <option value="SME">SME</option>
                                    <option value="Enterprise">Enterprise</option>
                                    <option value="MNC">MNC</option>
                                    <option value="Government">Government</option>
                                </select>
                            </div>

                            <div className="filter-group">
                                <label>Ownership Type</label>
                                <select
                                    className="form-control"
                                    value={tempFilters.ownership_type || ''}
                                    onChange={(e) => handleTempFilterChange('ownership_type', e.target.value)}
                                >
                                    <option value="">All Ownership</option>
                                    <option value="Private">Private</option>
                                    <option value="Public">Public</option>
                                </select>
                            </div>

                            <div className="filter-group">
                                <label>Job Field</label>
                                <select
                                    className="form-control"
                                    value={tempFilters.field_type || ''}
                                    onChange={(e) => handleTempFilterChange('field_type', e.target.value)}
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
                                <label>Job Type</label>
                                <select
                                    className="form-control"
                                    value={tempFilters.job_type || ''}
                                    onChange={(e) => handleTempFilterChange('job_type', e.target.value)}
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
                                <label>Division</label>
                                <select
                                    className="form-control"
                                    value={tempFilters.division || ''}
                                    onChange={(e) => handleTempFilterChange('division', e.target.value)}
                                >
                                    <option value="">All Divisions</option>
                                    <option value="Barishal">Barishal</option>
                                    <option value="Chattogram">Chattogram</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Mymensingh">Mymensingh</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Sylhet">Sylhet</option>
                                </select>
                            </div>

                            {hasTempChanges() ? (
                                <button onClick={applyFilters} className="btn-search-modal">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                    Search
                                </button>
                            ) : hasFilters ? (
                                <button onClick={clearFilters} className="btn-clear-modal">
                                    Clear All Filters
                                </button>
                            ) : (
                                <button onClick={() => setIsFilterModalOpen(false)} className="btn-close-modal">
                                    Close
                                </button>
                            )}
                        </div>
                    </div>
                </>
            )}

            {/* Filter Section - Desktop */}
            <div className="filter-card desktop-filters">
                <div className="filter-form">
                    <div className="filter-group">
                        <label>Company Type</label>
                        <select
                            className="form-control"
                            value={filters.company_type || ''}
                            onChange={(e) => handleFilterChange('company_type', e.target.value)}
                        >
                            <option value="">All Types</option>
                            <option value="Startup">Startup</option>
                            <option value="SME">SME</option>
                            <option value="Enterprise">Enterprise</option>
                            <option value="MNC">MNC</option>
                            <option value="Government">Government</option>
                        </select>
                    </div>

                    <div className="filter-group">
                        <label>Ownership Type</label>
                        <select
                            className="form-control"
                            value={filters.ownership_type || ''}
                            onChange={(e) => handleFilterChange('ownership_type', e.target.value)}
                        >
                            <option value="">All Ownership</option>
                            <option value="Private">Private</option>
                            <option value="Public">Public</option>
                        </select>
                    </div>

                    <div className="filter-group">
                        <label>Job Field</label>
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
                        <label>Job Type</label>
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
                        <label>Division</label>
                        <select
                            className="form-control"
                            value={filters.division || ''}
                            onChange={(e) => handleFilterChange('division', e.target.value)}
                        >
                            <option value="">All Divisions</option>
                            <option value="Barishal">Barishal</option>
                            <option value="Chattogram">Chattogram</option>
                            <option value="Dhaka">Dhaka</option>
                            <option value="Khulna">Khulna</option>
                            <option value="Mymensingh">Mymensingh</option>
                            <option value="Rajshahi">Rajshahi</option>
                            <option value="Rangpur">Rangpur</option>
                            <option value="Sylhet">Sylhet</option>
                        </select>
                    </div>

                    {hasFilters && (
                        <button onClick={clearFilters} className="btn-clear">
                            Clear Filters
                        </button>
                    )}
                </div>
            </div>

            {/* Jobs Count with Filter Button */}
            <div className="jobs-count-header">
                <h3>{jobs.length} Jobs Found</h3>
                <button
                    className="mobile-filter-btn"
                    onClick={() => setIsFilterModalOpen(true)}
                    aria-label="Open filters"
                >
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                    </svg>
                    {hasFilters && <span className="filter-indicator"></span>}
                </button>
            </div>

            {/* Jobs Grid */}
            {jobs.length > 0 ? (
                <div className="jobs-grid">
                    {jobs.map((job) => (
                        <div key={job.id} className="job-card">
                            {/* Header with Company Logo and Name */}
                            <div className="job-card-header">
                                <a href={`/company/${job.employer.id}/profile`} className="company-info-main">
                                    {job.employer.profile_picture ? (
                                        <img
                                            src={`/storage/${job.employer.profile_picture}`}
                                            alt={job.employer.company_name}
                                            className="company-logo-large"
                                        />
                                    ) : (
                                        <div className="company-logo-placeholder-large">
                                            {job.employer.company_name.charAt(0).toUpperCase()}
                                        </div>
                                    )}
                                    <div className="company-details">
                                        <span className="company-name-main">{job.employer.company_name}</span>
                                        <span className="time-ago">{getTimeAgo(job.created_at)}</span>
                                    </div>
                                </a>
                                {job.experience_level && (
                                    <span className="experience-badge">
                                        {job.experience_level}
                                    </span>
                                )}
                            </div>

                            {/* Job Title */}
                            <h3 className="job-title-main">{job.title}</h3>

                            {/* Job Info Grid */}
                            <div className="job-info-compact">
                                <div className="info-item">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                    </svg>
                                    <span>{job.job_type}</span>
                                </div>

                                <div className="info-item">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    <span>{job.location || 'Not specified'}</span>
                                </div>

                                {job.vacancies && (
                                    <div className="info-item">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="9" cy="7" r="4"></circle>
                                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        </svg>
                                        <span>{job.vacancies} {job.vacancies === 1 ? 'Position' : 'Positions'}</span>
                                    </div>
                                )}

                                <div className="info-item">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <text x="12" y="18" fontSize="16" textAnchor="middle" fontWeight="bold">৳</text>
                                    </svg>
                                    <span>{job.salary_range || 'Negotiable'}</span>
                                </div>
                            </div>

                            {/* Field Type Badge */}
                            <div className="job-field">
                                <span className="field-badge">{job.field_type}</span>
                            </div>

                            {/* Action Buttons */}
                            <div className="card-actions">
                                <a href={`/headhunting/other-jobs/${job.id}`} className="btn-view-details">
                                    View Details
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                        <polyline points="12 5 19 12 12 19"></polyline>
                                    </svg>
                                </a>
                                <button className="btn-share" onClick={() => navigator.share ? navigator.share({ title: job.title, url: window.location.origin + `/headhunting/other-jobs/${job.id}` }) : navigator.clipboard.writeText(window.location.origin + `/headhunting/other-jobs/${job.id}`)} title="Share">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <circle cx="18" cy="5" r="3"></circle>
                                        <circle cx="6" cy="12" r="3"></circle>
                                        <circle cx="18" cy="19" r="3"></circle>
                                        <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                        <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    ))}
                </div>
            ) : (
                <div className="empty-state">
                    <p>No jobs found matching your criteria.</p>
                    {hasFilters && (
                        <button onClick={clearFilters} className="btn-primary">
                            Clear Filters
                        </button>
                    )}
                </div>
            )}

            <style>{`
                .filter-modal-overlay {
                    display: none;
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.7);
                    z-index: 3999;
                }

                .filter-modal {
                    display: none;
                    position: fixed;
                    bottom: 0;
                    left: 0;
                    right: 0;
                    background: rgba(15, 23, 42, 0.98);
                    border-top-left-radius: 20px;
                    border-top-right-radius: 20px;
                    z-index: 4000;
                    max-height: 80vh;
                    overflow-y: auto;
                    -webkit-backdrop-filter: blur(20px) saturate(180%);
                    backdrop-filter: blur(20px) saturate(180%);
                    animation: slideUp 0.3s ease;
                }

                @keyframes slideUp {
                    from {
                        transform: translateY(100%);
                    }
                    to {
                        transform: translateY(0);
                    }
                }

                .filter-modal-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 1.5rem;
                    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                }

                .filter-modal-header h3 {
                    margin: 0;
                    color: white;
                    font-size: 1.2rem;
                }

                .close-modal-btn {
                    background: transparent;
                    border: none;
                    color: rgba(255, 255, 255, 0.7);
                    cursor: pointer;
                    padding: 0.5rem;
                }

                .close-modal-btn svg {
                    width: 24px;
                    height: 24px;
                }

                .filter-modal-body {
                    padding: 1.5rem;
                    display: flex;
                    flex-direction: column;
                    gap: 1.5rem;
                }

                .btn-clear-modal {
                    width: 100%;
                    background: #00bcd4;
                    color: white;
                    border: none;
                    padding: 0.75rem;
                    border-radius: 8px;
                    font-weight: 600;
                    cursor: pointer;
                    margin-top: 1rem;
                }

                .btn-search-modal {
                    width: 100%;
                    background: linear-gradient(135deg, #00d4ff, #00bcd4);
                    color: white;
                    border: none;
                    padding: 0.75rem 1rem;
                    border-radius: 8px;
                    font-weight: 600;
                    cursor: pointer;
                    margin-top: 1rem;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 0.5rem;
                    transition: all 0.3s ease;
                }

                .btn-search-modal svg {
                    width: 18px;
                    height: 18px;
                }

                .btn-search-modal:hover {
                    background: linear-gradient(135deg, #00bcd4, #00a5bb);
                    transform: translateY(-1px);
                }

                .btn-close-modal {
                    width: 100%;
                    background: rgba(255, 255, 255, 0.1);
                    color: rgba(255, 255, 255, 0.7);
                    border: 1px solid rgba(255, 255, 255, 0.2);
                    padding: 0.75rem;
                    border-radius: 8px;
                    font-weight: 600;
                    cursor: pointer;
                    margin-top: 1rem;
                    transition: all 0.3s ease;
                }

                .btn-close-modal:hover {
                    background: rgba(255, 255, 255, 0.15);
                    color: white;
                }

                .mobile-filter-btn {
                    display: none;
                    position: relative;
                    background: rgba(255, 255, 255, 0.1);
                    border: 1px solid rgba(255, 255, 255, 0.2);
                    color: white;
                    padding: 0.5rem;
                    border-radius: 8px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                }

                .mobile-filter-btn svg {
                    width: 20px;
                    height: 20px;
                }

                .mobile-filter-btn:hover {
                    background: rgba(255, 255, 255, 0.15);
                }

                .filter-indicator {
                    position: absolute;
                    top: 4px;
                    right: 4px;
                    width: 8px;
                    height: 8px;
                    background: #00d4ff;
                    border-radius: 50%;
                }

                .desktop-filters {
                    display: block;
                }

                .filter-card {
                    background: rgba(255, 255, 255, 0.05);
                    border: 1px solid rgba(255, 255, 255, 0.1);
                    border-radius: 12px;
                    padding: 1.5rem;
                    margin-bottom: 2rem;
                }

                .filter-form {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                    gap: 1.5rem;
                    align-items: end;
                }

                .filter-group {
                    display: flex;
                    flex-direction: column;
                    gap: 0.5rem;
                }

                .filter-group label {
                    color: rgba(255, 255, 255, 0.8);
                    font-size: 0.9rem;
                    font-weight: 500;
                }

                .form-control {
                    width: 100%;
                    padding: 0.75rem 1rem;
                    background: rgba(15, 23, 42, 0.5);
                    border: 1px solid rgba(255, 255, 255, 0.1);
                    border-radius: 6px;
                    color: white;
                    font-size: 0.95rem;
                    transition: all 0.3s ease;
                }

                .form-control:focus {
                    outline: none;
                    border-color: #00d4ff;
                    box-shadow: 0 0 0 2px rgba(0, 212, 255, 0.1);
                }

                .btn-clear {
                    background: rgba(255, 255, 255, 0.1);
                    color: white;
                    border: 1px solid rgba(255, 255, 255, 0.2);
                    padding: 0.75rem 1.5rem;
                    border-radius: 6px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    font-weight: 500;
                    white-space: nowrap;
                }

                .btn-clear:hover {
                    background: rgba(255, 255, 255, 0.15);
                }

                .jobs-count-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 1.5rem;
                }

                .jobs-count-header h3 {
                    color: rgba(255, 255, 255, 0.8);
                    font-size: 1.1rem;
                    font-weight: 600;
                    margin: 0;
                }

                .jobs-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
                    gap: 2rem;
                }

                .job-card {
                    background: rgba(255, 255, 255, 0.03);
                    border: 2px solid rgba(0, 212, 255, 0.2);
                    border-radius: 16px;
                    padding: 1.75rem;
                    transition: all 0.3s ease;
                    display: flex;
                    flex-direction: column;
                    gap: 1.25rem;
                    position: relative;
                }

                .job-card:hover {
                    border-color: rgba(0, 212, 255, 0.4);
                    box-shadow: 0 8px 24px rgba(0, 212, 255, 0.1);
                }

                .job-card-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: flex-start;
                    gap: 1rem;
                }

                .company-info-main {
                    display: flex;
                    align-items: center;
                    gap: 1rem;
                    text-decoration: none;
                    flex: 1;
                    transition: all 0.2s ease;
                }

                .company-info-main:hover {
                    opacity: 0.85;
                }

                .company-logo-large {
                    width: 56px;
                    height: 56px;
                    border-radius: 12px;
                    object-fit: cover;
                    border: 2px solid rgba(0, 212, 255, 0.3);
                    transition: all 0.3s ease;
                }

                .company-logo-large:hover {
                    border-color: rgba(0, 212, 255, 0.6);
                }

                .company-logo-placeholder-large {
                    width: 56px;
                    height: 56px;
                    border-radius: 12px;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: white;
                    font-weight: 700;
                    font-size: 1.5rem;
                    border: 2px solid rgba(255, 255, 255, 0.2);
                }

                .company-details {
                    display: flex;
                    flex-direction: column;
                    gap: 0.35rem;
                    flex: 1;
                }

                .company-name-main {
                    color: white;
                    font-size: 1rem;
                    font-weight: 600;
                    line-height: 1.3;
                }

                .time-ago {
                    color: rgba(255, 255, 255, 0.5);
                    font-size: 0.8rem;
                    font-weight: 500;
                }

                .experience-badge {
                    padding: 0.4rem 0.9rem;
                    border-radius: 8px;
                    font-size: 0.75rem;
                    font-weight: 700;
                    background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(5, 150, 105, 0.2));
                    color: #10b981;
                    border: 1.5px solid rgba(16, 185, 129, 0.4);
                    white-space: nowrap;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                }

                .job-title-main {
                    font-size: 1.25rem;
                    font-weight: 700;
                    color: white;
                    margin: 0;
                    line-height: 1.4;
                    display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;
                    overflow: hidden;
                }

                .job-info-compact {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
                    gap: 0.9rem;
                }

                .info-item {
                    display: flex;
                    align-items: center;
                    gap: 0.6rem;
                    color: rgba(255, 255, 255, 0.75);
                    font-size: 0.875rem;
                    font-weight: 500;
                }

                .info-item svg {
                    width: 18px;
                    height: 18px;
                    color: rgba(0, 212, 255, 0.7);
                    flex-shrink: 0;
                }

                .job-field {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 0.6rem;
                    padding-top: 0.5rem;
                    border-top: 1px solid rgba(255, 255, 255, 0.08);
                }

                .field-badge {
                    padding: 0.5rem 1rem;
                    border-radius: 8px;
                    font-size: 0.85rem;
                    font-weight: 600;
                    background: rgba(0, 212, 255, 0.12);
                    color: #00d4ff;
                    border: 1.5px solid rgba(0, 212, 255, 0.3);
                }

                .card-actions {
                    display: flex;
                    gap: 0.75rem;
                    margin-top: 0.5rem;
                }

                .btn-view-details {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    gap: 0.6rem;
                    background: linear-gradient(135deg, #00d4ff, #00bcd4);
                    color: white;
                    text-decoration: none;
                    font-size: 0.9rem;
                    font-weight: 600;
                    padding: 0.75rem 1.25rem;
                    border-radius: 10px;
                    transition: all 0.3s ease;
                    border: none;
                    flex: 1;
                }

                .btn-view-details:hover {
                    background: linear-gradient(135deg, #00bcd4, #00a5bb);
                    transform: translateY(-1px);
                }

                .btn-view-details svg {
                    width: 16px;
                    height: 16px;
                    transition: transform 0.3s ease;
                }

                .btn-view-details:hover svg {
                    transform: translateX(3px);
                }

                .btn-share {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background: rgba(255, 255, 255, 0.05);
                    border: 2px solid rgba(0, 212, 255, 0.3);
                    color: #00d4ff;
                    padding: 0.75rem;
                    border-radius: 10px;
                    cursor: pointer;
                    transition: all 0.3s ease;
                }

                .btn-share:hover {
                    background: rgba(0, 212, 255, 0.1);
                    border-color: rgba(0, 212, 255, 0.5);
                }

                .btn-share svg {
                    width: 18px;
                    height: 18px;
                }

                .empty-state {
                    text-align: center;
                    padding: 4rem 2rem;
                    color: rgba(255, 255, 255, 0.5);
                }

                .btn-primary {
                    background: #00bcd4;
                    color: white;
                    border: none;
                    padding: 0.75rem 2rem;
                    border-radius: 6px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    margin-top: 1rem;
                }

                .btn-primary:hover {
                    background: #00a5bb;
                }

                .mobile-menu-btn {
                    display: none;
                }

                @media (max-width: 1024px) {
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
                    .desktop-filters {
                        display: none;
                    }

                    .mobile-filter-btn {
                        display: block;
                    }

                    .filter-modal-overlay {
                        display: block;
                    }

                    .filter-modal {
                        display: block;
                    }

                    .jobs-grid {
                        grid-template-columns: 1fr;
                    }

                    .job-details-grid {
                        grid-template-columns: 1fr;
                    }
                }
            `}</style>
        </EmployerLayout>
    );
}
