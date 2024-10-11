@extends('layouts.user.backend.user-master')
@section('title')
    Dashboard
@endsection
@section('content')
<!-- Main Content -->
<main class="col-md-9 col-lg-10">
    <div class="dashboard-header">
        <h3>Dashboard</h3>
    </div>

    <div class="row">
        <!-- Dashboard Widgets -->
        <div class="col-md-4">
            <div class="dashboard-widget">
                <div class="widget-icon">
                    <i class="bi bi-book"></i>
                </div>
                <h5>5</h5>
                <p>Enrolled Courses</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-widget">
                <div class="widget-icon">
                    <i class="bi bi-person-check"></i>
                </div>
                <h5>5</h5>
                <p>Active Courses</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-widget">
                <div class="widget-icon">
                    <i class="bi bi-trophy"></i>
                </div>
                <h5>0</h5>
                <p>Completed Courses</p>
            </div>
        </div>
    </div>
</main>
@endsection