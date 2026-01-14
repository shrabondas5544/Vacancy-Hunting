@extends('layouts.public')

@section('title', $employer->company_name . ' - Company Profile')

@section('content')
<!-- Add FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="company-profile-page">
    <!-- Hero Banner Section -->
    <div class="hero-banner-section">
        @if($employer->hero_banner)
            <img src="{{ asset('storage/' . $employer->hero_banner) }}" alt="{{ $employer->company_name }}" class="hero-banner-img">
        @else
            <div class="hero-banner-placeholder"></div>
        @endif
        <div class="hero-overlay"></div>
    </div>

    <!-- Company Header -->
    <div class="company-header-container">
        <div class="container">
            <div class="company-header-content">
                <div class="company-logo-section">
                    @if($employer->profile_picture)
                        <img src="{{ asset('storage/' . $employer->profile_picture) }}" alt="{{ $employer->company_name }}" class="company-logo-main">
                    @else
                        <div class="company-logo-placeholder-main">
                            {{ strtoupper(substr($employer->company_name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="company-info-section">
                    <h1 class="company-name-title">{{ $employer->company_name }}</h1>
                    <div class="company-meta">
                        @if($employer->company_type)
                            <span class="meta-badge">{{ $employer->company_type }}</span>
                        @endif
                        @if($employer->establishment_year)
                            <span class="meta-item">
                                <i class="fas fa-calendar-alt"></i> Est. {{ $employer->establishment_year }}
                            </span>
                        @endif
                        @if($employer->employee_count)
                            <span class="meta-item">
                                <i class="fas fa-users"></i> {{ $employer->employee_count }} Employees
                            </span>
                        @endif
                    </div>
                    
                    <!-- Social Links -->
                    @if($employer->website_url || $employer->linkedin_url || $employer->facebook_url || $employer->twitter_url || $employer->instagram_url || $employer->youtube_url)
                        <div class="social-links">
                            @if($employer->website_url)
                                <a href="{{ $employer->website_url }}" target="_blank" class="social-link" title="Website">
                                    <i class="fas fa-globe"></i>
                                </a>
                            @endif
                            @if($employer->linkedin_url)
                                <a href="{{ $employer->linkedin_url }}" target="_blank" class="social-link" title="LinkedIn">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            @endif
                            @if($employer->facebook_url)
                                <a href="{{ $employer->facebook_url }}" target="_blank" class="social-link" title="Facebook">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            @endif
                            @if($employer->twitter_url)
                                <a href="{{ $employer->twitter_url }}" target="_blank" class="social-link" title="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            @endif
                            @if($employer->instagram_url)
                                <a href="{{ $employer->instagram_url }}" target="_blank" class="social-link" title="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            @endif
                            @if($employer->youtube_url)
                                <a href="{{ $employer->youtube_url }}" target="_blank" class="social-link" title="YouTube">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container company-content">
        <div class="content-grid">
            <!-- Left Column - Main Info -->
            <div class="main-column">
                <!-- About Section -->
                @if($employer->company_description)
                    <div class="content-card">
                        <h2 class="section-title">About Us</h2>
                        <p class="text-content">{{ $employer->company_description }}</p>
                    </div>
                @endif

                <!-- Mission & Vision -->
                @if($employer->mission_statement || $employer->vision_statement)
                    <div class="content-card">
                        <h2 class="section-title">Mission & Vision</h2>
                        @if($employer->mission_statement)
                            <div class="mission-vision-item">
                                <h3 class="subsection-title">Our Mission</h3>
                                <p class="text-content">{{ $employer->mission_statement }}</p>
                            </div>
                        @endif
                        @if($employer->vision_statement)
                            <div class="mission-vision-item">
                                <h3 class="subsection-title">Our Vision</h3>
                                <p class="text-content">{{ $employer->vision_statement }}</p>
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Company Values -->
                @if($employer->company_values && is_array($employer->company_values) && count($employer->company_values) > 0)
                    <div class="content-card">
                        <h2 class="section-title">Our Values</h2>
                        <div class="values-grid">
                            @foreach($employer->company_values as $value)
                                <div class="value-item">
                                    <i class="fas fa-check-circle"></i>
                                    <span>{{ $value }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Products & Services -->
                @if($employer->products_services)
                    <div class="content-card">
                        <h2 class="section-title">Products & Services</h2>
                        <p class="text-content">{{ $employer->products_services }}</p>
                    </div>
                @endif

                <!-- Media Gallery -->
                @if($employer->media && $employer->media->count() > 0)
                    <div class="content-card">
                        <h2 class="section-title">Gallery</h2>
                        <div class="media-gallery">
                            @foreach($employer->media as $mediaItem)
                                @if($mediaItem->media_type === 'image')
                                    <div class="gallery-item">
                                        <img src="{{ asset('storage/' . $mediaItem->file_path) }}" alt="{{ $mediaItem->caption ?? 'Company image' }}">
                                        @if($mediaItem->caption)
                                            <p class="gallery-caption">{{ $mediaItem->caption }}</p>
                                        @endif
                                    </div>
                                @elseif($mediaItem->media_type === 'video')
                                    <div class="gallery-item">
                                        <video controls>
                                            <source src="{{ asset('storage/' . $mediaItem->file_path) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        @if($mediaItem->caption)
                                            <p class="gallery-caption">{{ $mediaItem->caption }}</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Team Members -->
                @if($employer->teamMembers && $employer->teamMembers->count() > 0)
                    <div class="content-card">
                        <h2 class="section-title">Our Team</h2>
                        <div class="team-grid">
                            @foreach($employer->teamMembers as $member)
                                <div class="team-member-card">
                                    @if($member->photo)
                                        <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="team-photo">
                                    @else
                                        <div class="team-photo-placeholder">
                                            {{ strtoupper(substr($member->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <h3 class="team-name">{{ $member->name }}</h3>
                                    @if($member->designation)
                                        <p class="team-designation">{{ $member->designation }}</p>
                                    @endif
                                    @if($member->bio)
                                        <p class="team-bio">{{ $member->bio }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Active Job Postings -->
                @if($employer->jobs && $employer->jobs->count() > 0)
                    <div class="content-card">
                        <h2 class="section-title">Current Openings ({{ $employer->jobs->count() }})</h2>
                        <div class="jobs-list">
                            @foreach($employer->jobs as $job)
                                <div class="job-listing-item">
                                    <div class="job-listing-content">
                                        <h3 class="job-listing-title">{{ $job->title }}</h3>
                                        <div class="job-listing-meta">
                                            <span class="job-meta-item">
                                                <i class="fas fa-briefcase"></i> {{ $job->job_type }}
                                            </span>
                                            @if($job->location)
                                                <span class="job-meta-item">
                                                    <i class="fas fa-map-marker-alt"></i> {{ $job->location }}
                                                </span>
                                            @endif
                                            @if($job->salary_range)
                                                <span class="job-meta-item">
                                                    <i class="fas fa-money-bill-wave"></i> {{ $job->salary_range }}
                                                </span>
                                            @endif
                                            @if($job->deadline)
                                                <span class="job-meta-item">
                                                    <i class="fas fa-clock"></i> Deadline: {{ \Carbon\Carbon::parse($job->deadline)->format('M d, Y') }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <a href="{{ route('employer.show-job', $job->id) }}" class="btn-apply">View Details</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Column - Sidebar -->
            <div class="sidebar-column">
                <!-- Company Information Card -->
                <div class="content-card sticky-card">
                    <h2 class="section-title">Company Information</h2>
                    
                    @if($employer->company_address || $employer->street || $employer->city)
                        <div class="info-item">
                            <i class="fas fa-map-marker-alt info-icon"></i>
                            <div class="info-content">
                                <span class="info-label">Address</span>
                                <p class="info-value">
                                    @if($employer->company_address)
                                        {{ $employer->company_address }}
                                    @endif
                                    @if($employer->street)
                                        <br>{{ $employer->street }}
                                    @endif
                                    @if($employer->city || $employer->state || $employer->zip_code)
                                        <br>{{ $employer->city }}
                                        @if($employer->state), {{ $employer->state }}@endif
                                        @if($employer->zip_code) {{ $employer->zip_code }}@endif
                                    @endif
                                    @if($employer->country)
                                        <br>{{ $employer->country }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endif

                    @if($employer->contact_number)
                        <div class="info-item">
                            <i class="fas fa-phone info-icon"></i>
                            <div class="info-content">
                                <span class="info-label">Phone</span>
                                <p class="info-value">{{ $employer->contact_number }}</p>
                            </div>
                        </div>
                    @endif

                    @if($employer->user && $employer->user->email)
                        <div class="info-item">
                            <i class="fas fa-envelope info-icon"></i>
                            <div class="info-content">
                                <span class="info-label">Email</span>
                                <p class="info-value">{{ $employer->user->email }}</p>
                            </div>
                        </div>
                    @endif

                    @if($employer->company_ownership)
                        <div class="info-item">
                            <i class="fas fa-building info-icon"></i>
                            <div class="info-content">
                                <span class="info-label">Ownership</span>
                                <p class="info-value">{{ $employer->company_ownership }}</p>
                            </div>
                        </div>
                    @endif

                    @if($employer->trade_license_no)
                        <div class="info-item">
                            <i class="fas fa-file-contract info-icon"></i>
                            <div class="info-content">
                                <span class="info-label">Trade License</span>
                                <p class="info-value">{{ $employer->trade_license_no }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Locations Card -->
                @if($employer->locations && $employer->locations->count() > 0)
                    <div class="content-card">
                        <h2 class="section-title">Our Locations</h2>
                        @foreach($employer->locations as $location)
                            <div class="location-item">
                                <h3 class="location-name">{{ $location->name }}</h3>
                                @if($location->address)
                                    <p class="location-address">{{ $location->address }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.company-profile-page {
    min-height: 100vh;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
}

.hero-banner-section {
    position: relative;
    height: 300px;
    overflow: hidden;
}

.hero-banner-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.hero-banner-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.hero-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 60%;
    background: linear-gradient(to top, rgba(15, 23, 42, 1), transparent);
}

.company-header-container {
    margin-top: -80px;
    position: relative;
    z-index: 10;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.company-header-content {
    display: flex;
    gap: 2rem;
    align-items: flex-start;
}

.company-logo-section {
    flex-shrink: 0;
}

.company-logo-main {
    width: 120px;
    height: 120px;
    border-radius: 16px;
    border: 4px solid rgba(0, 212, 255, 0.4);
    background: white;
    object-fit: cover;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

.company-logo-placeholder-main {
    width: 120px;
    height: 120px;
    border-radius: 16px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 3rem;
    font-weight: 700;
    border: 4px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

.company-info-section {
    flex: 1;
    padding-top: 1rem;
}

.company-name-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: white;
    margin: 0 0 1rem 0;
}

.company-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.meta-badge {
    padding: 0.5rem 1rem;
    background: rgba(0, 212, 255, 0.15);
    color: #00d4ff;
    border: 1px solid rgba(0, 212, 255, 0.3);
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.95rem;
}

.meta-item i {
    color: #00d4ff;
}

.social-links {
    display: flex;
    gap: 0.75rem;
}

.social-link {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    transition: all 0.3s ease;
    text-decoration: none;
}

.social-link:hover {
    background: rgba(0, 212, 255, 0.2);
    border-color: #00d4ff;
    transform: translateY(-2px);
}

.company-content {
    padding: 3rem 2rem;
}

.content-grid {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 2rem;
}

.content-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    backdrop-filter: blur(10px);
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: white;
    margin: 0 0 1.5rem 0;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid rgba(0, 212, 255, 0.3);
}

.subsection-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #00d4ff;
    margin: 0 0 0.5rem 0;
}

.text-content {
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.8;
    margin: 0;
}

.mission-vision-item {
    margin-bottom: 1.5rem;
}

.mission-vision-item:last-child {
    margin-bottom: 0;
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
}

.value-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.3);
    border-radius: 8px;
    color: rgba(255, 255, 255, 0.9);
}

.value-item i {
    color: #10b981;
    font-size: 1.1rem;
}

.media-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.5rem;
}

.gallery-item {
    border-radius: 12px;
    overflow: hidden;
    background: rgba(0, 0, 0, 0.3);
}

.gallery-item img,
.gallery-item video {
    width: 100%;
    height: 200px;
    object-fit: cover;
    display: block;
}

.gallery-caption {
    padding: 0.75rem;
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
    margin: 0;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1.5rem;
}

.team-member-card {
    text-align: center;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.team-member-card:hover {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(0, 212, 255, 0.3);
}

.team-photo {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin: 0 auto 1rem;
    border: 3px solid rgba(0, 212, 255, 0.4);
}

.team-photo-placeholder {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin: 0 auto 1rem;
    border: 3px solid rgba(255, 255, 255, 0.2);
}

.team-name {
    font-size: 1.1rem;
    font-weight: 600;
    color: white;
    margin: 0 0 0.25rem 0;
}

.team-designation {
    color: #00d4ff;
    font-size: 0.9rem;
    margin: 0 0 0.5rem 0;
}

.team-bio {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.85rem;
    margin: 0;
    line-height: 1.5;
}

.jobs-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.job-listing-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1.5rem;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.job-listing-item:hover {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(0, 212, 255, 0.3);
}

.job-listing-content {
    flex: 1;
}

.job-listing-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: white;
    margin: 0 0 0.75rem 0;
}

.job-listing-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.job-meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.85rem;
}

.job-meta-item i {
    color: #00d4ff;
}

.btn-apply {
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #00d4ff, #00bcd4);
    color: white;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.btn-apply:hover {
    background: linear-gradient(135deg, #00bcd4, #00a5bb);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 212, 255, 0.3);
}

.sidebar-column {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.sticky-card {
    position: sticky;
    top: 100px;
}

.info-item {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.info-item:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.info-icon {
    color: #00d4ff;
    font-size: 1.2rem;
    width: 24px;
    flex-shrink: 0;
}

.info-content {
    flex: 1;
}

.info-label {
    display: block;
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.85rem;
    margin-bottom: 0.25rem;
    font-weight: 500;
}

.info-value {
    color: white;
    font-size: 0.95rem;
    margin: 0;
    line-height: 1.6;
}

.location-item {
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.location-item:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}

.location-name {
    font-size: 1rem;
    font-weight: 600;
    color: white;
    margin: 0 0 0.5rem 0;
}

.location-address {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.9rem;
    margin: 0;
    line-height: 1.6;
}

@media (max-width: 1024px) {
    .content-grid {
        grid-template-columns: 1fr;
    }

    .sticky-card {
        position: static;
    }
}

@media (max-width: 768px) {
    .hero-banner-section {
        height: 200px;
    }

    .company-header-container {
        margin-top: -60px;
    }

    .company-header-content {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .company-logo-main,
    .company-logo-placeholder-main {
        width: 100px;
        height: 100px;
    }

    .company-name-title {
        font-size: 1.8rem;
    }

    .company-meta {
        justify-content: center;
    }

    .social-links {
        justify-content: center;
    }

    .company-content {
        padding: 2rem 1rem;
    }

    .content-card {
        padding: 1.5rem;
    }

    .values-grid,
    .team-grid {
        grid-template-columns: 1fr;
    }

    .job-listing-item {
        flex-direction: column;
        align-items: flex-start;
    }

    .btn-apply {
        width: 100%;
        text-align: center;
    }
}
</style>
@endsection
