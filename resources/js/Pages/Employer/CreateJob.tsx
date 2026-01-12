import React, { FormEvent, useState } from 'react';
import EmployerLayout from '../../Layouts/EmployerLayout';
import { router } from '@inertiajs/react';

export default function CreateJob() {
    const [formData, setFormData] = useState({
        title: '',
        deadline: '',
        field_type: '',
        job_type: '',
        experience_level: '',
        location: '',
        division: '',
        vacancies: '',
        salary_range: 'Negotiable',
        description: '',
        educational_qualifications: '',
        experience: '',
        required_skills: '',
        job_benefits: '',
    });

    const [skillInput, setSkillInput] = useState('');
    const [skills, setSkills] = useState<string[]>([]);

    const commonSkills = [
        // --- 1. Advanced Tech & AI (High Demand Globally) ---
        'Generative AI', 'Prompt Engineering', 'AI Ethics', 'Machine Learning Ops (MLOps)', 'Blockchain', 'Smart Contracts', 'Solidity', 'Web3', 'Internet of Things (IoT)', 'Cloud Architecture', 'Serverless Computing', 'Microservices', 'API Development', 'Virtual Reality (VR)', 'Augmented Reality (AR)', 'Unreal Engine', 'Unity',
        // --- 2. Core Engineering & Manufacturing (Top for BD & Export) ---
        'Textile Engineering', 'Apparel Merchandising', 'Industrial Engineering', 'Garment Production Management', 'Quality Assurance (QA)', 'Supply Chain Management', 'Logistics', 'Procurement', 'Inventory Management', 'Lean Manufacturing', 'Six Sigma', 'AutoCAD', 'Revit', 'BIM (Building Information Modeling)', 'PLC Programming', 'Automation',
        // --- 3. Skilled Trades & Vocational (Crucial for Migration/Middle East/Europe) ---
        'Electrical Installation', 'HVAC (Heating, Ventilation, and Air Conditioning)', 'Plumbing', 'Pipefitting', 'Welding (Arc & Gas)', 'Masonry', 'Carpentry', 'Steel Fixing', 'Automotive Repair', 'Heavy Equipment Operation', 'Forklift Driving', 'Tiles & Marble Fitting', 'Scaffolding', 'Safety Officer (HSE)',
        // --- 4. Healthcare & Medical (High Migration Potential to UK/Germany/Japan) ---
        'Nursing', 'Patient Care', 'Elderly Care', 'Clinical Research', 'Pharmacy', 'Medical Laboratory Technology', 'Radiology', 'Physiotherapy', 'Nutrition', 'Public Health', 'Medical Coding', 'First Aid & CPR',
        // --- 5. Finance, Accounting & Legal ---
        'Financial Modeling', 'Risk Management', 'Taxation', 'Auditing', 'Bookkeeping', 'QuickBooks', 'Xero', 'Tally', 'SAP FICO', 'Corporate Law', 'Contract Management', 'Compliance', 'Intellectual Property Rights',
        // --- 6. Digital Marketing & Growth ---
        'Search Engine Optimization (SEO)', 'Content Strategy', 'Social Media Management', 'Google Ads', 'Meta Ads (Facebook/Instagram)', 'Email Marketing', 'Conversion Rate Optimization (CRO)', 'Affiliate Marketing', 'E-commerce Management (Shopify/WooCommerce)', 'Influencer Marketing',
        // --- 7. Creative, Media & Education ---
        'Video Editing (Premiere Pro/DaVinci)', 'Motion Graphics', '2D/3D Animation', 'Graphic Design', 'UI/UX Research', 'Copywriting', 'Technical Writing', 'Journalism', 'Curriculum Development', 'Instructional Design', 'Teaching (TESOL/TEFL)',
        // --- 8. Languages (Essential for Abroad) ---
        'English (IELTS/TOEFL)', 'German (B1/B2 Level)', 'Japanese (JLPT)', 'Korean (EPS-TOPIK)', 'Arabic', 'French', 'Mandarin Chinese',
        // --- 9. Soft Skills (Universal Requirements) ---
        'Adaptability', 'Emotional Intelligence (EQ)', 'Conflict Resolution', 'Cross-Cultural Communication', 'Active Listening', 'Strategic Thinking', 'Negotiation', 'Public Speaking', 'Mentoring', 'Resilience'
    ];

    const handleSubmit = (e: FormEvent) => {
        e.preventDefault();
        const submitData = {
            ...formData,
            required_skills: skills.join(', ')
        };
        router.post('/headhunting/post-job', submitData);
    };

    const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement | HTMLTextAreaElement>) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value,
        });
    };

    const addSkill = (skill: string) => {
        if (skill && !skills.includes(skill)) {
            setSkills([...skills, skill]);
            setSkillInput('');
        }
    };

    const removeSkill = (skillToRemove: string) => {
        setSkills(skills.filter(skill => skill !== skillToRemove));
    };

    const handleSkillInputKeyDown = (e: React.KeyboardEvent<HTMLInputElement>) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            addSkill(skillInput);
        }
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
                                <label>
                                    Deadline <span className="text-danger">*</span>
                                </label>
                                <input
                                    type="date"
                                    name="deadline"
                                    className="form-control"
                                    required
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
                                <label>Experience Level</label>
                                <select
                                    name="experience_level"
                                    className="form-control"
                                    value={formData.experience_level}
                                    onChange={handleChange}
                                >
                                    <option value="">Select Experience Level</option>
                                    <option value="Beginner">Beginner</option>
                                    <option value="Intermediate">Intermediate</option>
                                    <option value="Experienced">Experienced</option>
                                    <option value="Expert">Expert</option>
                                </select>
                            </div>
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
                        </div>

                        <div className="row">
                            <div className="col-md-6 form-group">
                                <label>Division</label>
                                <select
                                    name="division"
                                    className="form-control"
                                    value={formData.division}
                                    onChange={handleChange}
                                >
                                    <option value="">Select Division</option>
                                    <option value="Barisal">Barisal</option>
                                    <option value="Chattogram">Chattogram</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Mymensingh">Mymensingh</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Sylhet">Sylhet</option>
                                </select>
                            </div>
                        </div>

                        <div className="row">
                            <div className="col-md-6 form-group">
                                <label>Vacancies</label>
                                <input
                                    type="number"
                                    name="vacancies"
                                    className="form-control"
                                    placeholder="Number of positions"
                                    min="1"
                                    value={formData.vacancies}
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

                        <div className="requirements-section">
                            <h3>Requirements</h3>

                            <div className="form-group">
                                <label>Educational Qualifications</label>
                                <textarea
                                    name="educational_qualifications"
                                    className="form-control"
                                    rows={3}
                                    placeholder="e.g. Bachelor's degree in Computer Science or related field"
                                    value={formData.educational_qualifications}
                                    onChange={handleChange}
                                />
                            </div>

                            <div className="form-group">
                                <label>Experience</label>
                                <textarea
                                    name="experience"
                                    className="form-control"
                                    rows={3}
                                    placeholder="e.g. 3-5 years of experience in software development"
                                    value={formData.experience}
                                    onChange={handleChange}
                                />
                            </div>

                            <div className="form-group">
                                <label>Required Skills</label>
                                <div className="skills-input-wrapper">
                                    <input
                                        type="text"
                                        className="form-control"
                                        placeholder="Type a skill and press Enter"
                                        value={skillInput}
                                        onChange={(e) => setSkillInput(e.target.value)}
                                        onKeyDown={handleSkillInputKeyDown}
                                    />
                                    <div className="skills-suggestions">
                                        {skillInput && commonSkills
                                            .filter(skill =>
                                                skill.toLowerCase().includes(skillInput.toLowerCase()) &&
                                                !skills.includes(skill)
                                            )
                                            .slice(0, 5)
                                            .map(skill => (
                                                <div
                                                    key={skill}
                                                    className="skill-suggestion"
                                                    onClick={() => addSkill(skill)}
                                                >
                                                    {skill}
                                                </div>
                                            ))
                                        }
                                    </div>
                                    <div className="skills-tags">
                                        {skills.map(skill => (
                                            <span key={skill} className="skill-tag">
                                                {skill}
                                                <button
                                                    type="button"
                                                    onClick={() => removeSkill(skill)}
                                                    className="remove-skill"
                                                >
                                                    ×
                                                </button>
                                            </span>
                                        ))}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="form-group">
                            <label>Job Benefits</label>
                            <textarea
                                name="job_benefits"
                                className="form-control"
                                rows={4}
                                placeholder="e.g. Health insurance, performance bonus, flexible working hours, professional development opportunities"
                                value={formData.job_benefits}
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

                .requirements-section {
                    background: rgba(255, 255, 255, 0.02);
                    padding: 1.5rem;
                    border-radius: 8px;
                    margin: 2rem 0;
                    border: 1px solid rgba(255, 255, 255, 0.05);
                }

                .requirements-section h3 {
                    color: white;
                    font-size: 1.1rem;
                    margin-bottom: 1.5rem;
                }

                .skills-input-wrapper {
                    position: relative;
                }

                .skills-suggestions {
                    position: absolute;
                    top: 100%;
                    left: 0;
                    right: 0;
                    background: rgba(15, 23, 42, 0.95);
                    border: 1px solid rgba(255, 255, 255, 0.1);
                    border-radius: 6px;
                    margin-top: 0.25rem;
                    max-height: 200px;
                    overflow-y: auto;
                    z-index: 10;
                }

                .skill-suggestion {
                    padding: 0.75rem 1rem;
                    color: white;
                    cursor: pointer;
                    transition: background 0.2s ease;
                }

                .skill-suggestion:hover {
                    background: rgba(0, 212, 255, 0.1);
                }

                .skills-tags {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 0.5rem;
                    margin-top: 0.75rem;
                }

                .skill-tag {
                    display: inline-flex;
                    align-items: center;
                    gap: 0.5rem;
                    background: rgba(0, 212, 255, 0.2);
                    color: #00d4ff;
                    padding: 0.5rem 0.75rem;
                    border-radius: 4px;
                    font-size: 0.9rem;
                }

                .remove-skill {
                    background: none;
                    border: none;
                    color: #00d4ff;
                    cursor: pointer;
                    font-size: 1.2rem;
                    line-height: 1;
                    padding: 0;
                    margin: 0;
                }

                .remove-skill:hover {
                    color: #ef4444;
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
