import React, { FormEvent, useState } from 'react';
import EmployerLayout from '../../Layouts/EmployerLayout';
import { router } from '@inertiajs/react';

export default function CreateJob() {
    const [formData, setFormData] = useState({
        title: '',
        deadline: '',
        field_type: '',
        job_type: '',
        location: '',
        salary_range: 'Negotiable',
        description: '',
        requirements: '',
    });

    const handleSubmit = (e: FormEvent) => {
        e.preventDefault();
        router.post('/headhunting/post-job', formData);
    };

    const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement | HTMLTextAreaElement>) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value,
        });
    };

    return (
        <EmployerLayout>
            <div className="content-header">
                <h1>Create New Job</h1>
                <p>Fill in the details to post a new job vacancy</p>
            </div>

            <div className="card">
                <div className="card-body">
                    <form onSubmit={handleSubmit}>
                        <div className="row">
                            <div className="col-md-6 form-group">
                                <label>
                                    Job Title <span className="text-danger">*</span>
                                </label>
                                <input
                                    type="text"
                                    name="title"
                                    className="form-control"
                                    required
                                    placeholder="e.g. Senior Software Engineer"
                                    value={formData.title}
                                    onChange={handleChange}
                                />
                            </div>
                            <div className="col-md-6 form-group">
                                <label>Deadline</label>
                                <input
                                    type="date"
                                    name="deadline"
                                    className="form-control"
                                    value={formData.deadline}
                                    onChange={handleChange}
                                />
                            </div>
                        </div>

                        <div className="row">
                            <div className="col-md-6 form-group">
                                <label>
                                    Field Type <span className="text-danger">*</span>
                                </label>
                                <select
                                    name="field_type"
                                    className="form-control"
                                    required
                                    value={formData.field_type}
                                    onChange={handleChange}
                                >
                                    <option value="">Select Field</option>
                                    <option value="IT">IT & Software</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="HR">Human Resources</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Design">Design</option>
                                    <option value="Sales">Sales</option>
                                    <option value="Engineering">Engineering</option>
                                </select>
                            </div>
                            <div className="col-md-6 form-group">
                                <label>
                                    Job Type <span className="text-danger">*</span>
                                </label>
                                <select
                                    name="job_type"
                                    className="form-control"
                                    required
                                    value={formData.job_type}
                                    onChange={handleChange}
                                >
                                    <option value="">Select Type</option>
                                    <option value="Full Time">Full Time</option>
                                    <option value="Part Time">Part Time</option>
                                    <option value="Remote">Remote</option>
                                    <option value="Freelance">Freelance</option>
                                    <option value="Internship">Internship</option>
                                </select>
                            </div>
                        </div>

                        <div className="row">
                            <div className="col-md-6 form-group">
                                <label>Location</label>
                                <input
                                    type="text"
                                    name="location"
                                    className="form-control"
                                    placeholder="e.g. Dhaka, Bangladesh"
                                    value={formData.location}
                                    onChange={handleChange}
                                />
                            </div>
                            <div className="col-md-6 form-group">
                                <label>Salary Range</label>
                                <select
                                    name="salary_range"
                                    className="form-control"
                                    value={formData.salary_range}
                                    onChange={handleChange}
                                >
                                    <option value="Negotiable">Negotiable</option>
                                    <option value="10k - 20k">10k - 20k</option>
                                    <option value="20k - 30k">20k - 30k</option>
                                    <option value="30k - 50k">30k - 50k</option>
                                    <option value="50k - 80k">50k - 80k</option>
                                    <option value="80k - 100k">80k - 100k</option>
                                    <option value="100k+">100k+</option>
                                </select>
                            </div>
                        </div>

                        <div className="form-group">
                            <label>
                                Job Description <span className="text-danger">*</span>
                            </label>
                            <textarea
                                name="description"
                                className="form-control"
                                rows={5}
                                required
                                placeholder="Describe the job role, responsibilities, etc."
                                value={formData.description}
                                onChange={handleChange}
                            />
                        </div>

                        <div className="form-group">
                            <label>Requirements</label>
                            <textarea
                                name="requirements"
                                className="form-control"
                                rows={5}
                                placeholder="List the skills, qualifications, and experience required..."
                                value={formData.requirements}
                                onChange={handleChange}
                            />
                        </div>

                        <div className="form-actions">
                            <a href="/headhunting/post-job" className="btn-secondary">
                                Cancel
                            </a>
                            <button type="submit" className="btn-primary">
                                Post Job
                            </button>
                        </div>
                    </form>
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

                .row {
                    display: flex;
                    gap: 1.5rem;
                    margin-bottom: 1rem;
                }

                .col-md-6 {
                    flex: 1;
                }

                .form-group {
                    margin-bottom: 1.5rem;
                }

                .form-group label {
                    display: block;
                    margin-bottom: 0.5rem;
                    color: rgba(255, 255, 255, 0.8);
                    font-size: 0.9rem;
                }

                .text-danger {
                    color: #ef4444;
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

                .form-actions {
                    display: flex;
                    gap: 1rem;
                    margin-top: 2rem;
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
                    text-decoration: none;
                }

                .btn-primary:hover {
                    background: #00a5bb;
                    transform: translateY(-1px);
                }

                .btn-secondary {
                    background: transparent;
                    color: rgba(255, 255, 255, 0.7);
                    border: 1px solid rgba(255, 255, 255, 0.2);
                    padding: 0.75rem 2rem;
                    border-radius: 6px;
                    font-weight: 600;
                    cursor: pointer;
                    transition: all 0.3s ease;
                    text-decoration: none;
                    display: inline-flex;
                    align-items: center;
                }

                .btn-secondary:hover {
                    background: rgba(255, 255, 255, 0.05);
                    color: white;
                }

                @media (max-width: 768px) {
                    .row {
                        flex-direction: column;
                        gap: 0;
                    }
                }
            `}</style>
        </EmployerLayout>
    );
}
