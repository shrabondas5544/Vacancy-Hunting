@extends('admin.layout')

@section('title', 'Career Counselling')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Career Counselling</h1>
            <p class="text-muted">Guidance and advisory for career paths</p>
        </div>
    </div>

    <!-- Coming Soon Card -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-tools fa-4x text-primary"></i>
                    </div>
                    <h3 class="mb-3">Under Development</h3>
                    <p class="text-muted mb-4">
                        This module is currently under development. Check back soon for updates!
                    </p>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
