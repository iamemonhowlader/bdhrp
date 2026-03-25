@extends('backend.app')

@section('title')
    {{ env('APP_NAME') }} || Dashboard
@endsection

@section('content')
    <div id="app-content">

        <!-- Container fluid -->
        <div class="app-content-area">
            <div class="bg-primary pt-10 pb-21 mt-n6 mx-n4"></div>
            <div class="container-fluid mt-n22 ">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Page header -->
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div class="mb-2 mb-lg-0">
                                <h3 class="mb-0 text-white">Dashboard Overview</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards Row -->
                <div class="row">
                    <!-- Card 1: Projects -->
                    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5">
                        <div class="card h-100 shadow-sm border-0 rounded-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h4 class="mb-0 text-muted fs-6">Projects</h4>
                                    </div>
                                    <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                        <i class="bi bi-briefcase fs-4"></i>
                                    </div>
                                </div>
                                <!-- <div class="d-flex align-items-center">
                                    <h2 class="fw-bold mb-0 display-4 text-dark">18</h2>
                                    <span class="text-success ms-3 fw-medium">
                                        <i class="bi bi-arrow-up-short me-1"></i>2 Completed
                                    </span>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Active Task -->
                    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5">
                        <div class="card h-100 shadow-sm border-0 rounded-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h4 class="mb-0 text-muted fs-6">Active Task</h4>
                                    </div>
                                    <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                        <i class="bi bi-list-task fs-4"></i>
                                    </div>
                                </div>
                                <!-- <div class="d-flex align-items-center">
                                    <h2 class="fw-bold mb-0 display-4 text-dark">132</h2>
                                    <span class="text-danger ms-3 fw-medium">
                                        <i class="bi bi-arrow-down-short me-1"></i>28+
                                    </span>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Teams -->
                    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5">
                        <div class="card h-100 shadow-sm border-0 rounded-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h4 class="mb-0 text-muted fs-6">Teams</h4>
                                    </div>
                                    <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                        <i class="bi bi-people fs-4"></i>
                                    </div>
                                </div>
                                <!-- <div class="d-flex align-items-center">
                                    <h2 class="fw-bold mb-0 display-4 text-dark">12</h2>
                                    <span class="text-success ms-3 fw-medium">
                                        <i class="bi bi-arrow-up-short me-1"></i>1 New
                                    </span>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <!-- Card 4: Productivity -->
                    <div class="col-xl-3 col-lg-6 col-md-12 col-12 mb-5">
                        <div class="card h-100 shadow-sm border-0 rounded-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h4 class="mb-0 text-muted fs-6">Productivity</h4>
                                    </div>
                                    <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                        <i class="bi bi-bullseye fs-4"></i>
                                    </div>
                                </div>
                                <!-- <div class="d-flex align-items-center">
                                    <h2 class="fw-bold mb-0 display-4 text-dark">76%</h2>
                                    <span class="text-success ms-3 fw-medium">
                                        <i class="bi bi-arrow-up-short me-1"></i>5%
                                    </span>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Overview Section -->
                <div class="row">
                    <!-- Active Projects Table -->
                    <div class="col-lg-8 col-12 mb-5">
                        <div class="card h-100 shadow-sm border-0 rounded-3">
                            <div class="card-header border-bottom-0 py-4 bg-white d-flex justify-content-between align-items-center">
                                <h4 class="mb-0 fw-bold">Active Projects</h4>
                                <a href="#" class="btn btn-outline-primary btn-sm rounded-pill">View All</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Project Name</th>
                                            <th>Hours</th>
                                            <th>Priority</th>
                                            <th>Members</th>
                                            <th>Progress</th>
                                        </tr>
                                    </thead>
                                    <!-- <tbody>
                                        <tr>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                                        <i class="bi bi-dropbox fs-4"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h5 class="fw-bold mb-1">Dropbox Design System</h5>
                                                        <p class="mb-0 text-muted fs-6">Web Design</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">34</td>
                                            <td class="align-middle"><span class="badge bg-light-warning text-warning rounded-pill">Medium</span></td>
                                            <td class="align-middle">
                                                <div class="avatar-group">
                                                    <span class="avatar avatar-sm rounded-circle bg-danger text-white d-flex align-items-center justify-content-center">HD</span>
                                                    <span class="avatar avatar-sm rounded-circle bg-success text-white d-flex align-items-center justify-content-center">AP</span>
                                                    <span class="avatar avatar-sm rounded-circle bg-info text-white d-flex align-items-center justify-content-center">+3</span>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <span class="me-2">15%</span>
                                                    <div class="progress w-100" style="height: 6px;">
                                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 15%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-shape icon-md bg-light-success text-success rounded-2">
                                                        <i class="bi bi-slack fs-4"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h5 class="fw-bold mb-1">Slack Team UI</h5>
                                                        <p class="mb-0 text-muted fs-6">Product Design</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">47</td>
                                            <td class="align-middle"><span class="badge bg-light-danger text-danger rounded-pill">High</span></td>
                                            <td class="align-middle">
                                                <div class="avatar-group">
                                                     <span class="avatar avatar-sm rounded-circle bg-primary text-white d-flex align-items-center justify-content-center">JK</span>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <span class="me-2">35%</span>
                                                    <div class="progress w-100" style="height: 6px;">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 35%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                         <tr>
                                             <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-shape icon-md bg-light-warning text-warning rounded-2">
                                                        <i class="bi bi-github fs-4"></i>
                                                    </div>
                                                    <div class="ms-3">
                                                        <h5 class="fw-bold mb-1">GitHub Satellite</h5>
                                                        <p class="mb-0 text-muted fs-6">Web Development</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">120</td>
                                            <td class="align-middle"><span class="badge bg-light-info text-info rounded-pill">Low</span></td>
                                            <td class="align-middle">
                                                 <div class="avatar-group">
                                                    <span class="avatar avatar-sm rounded-circle bg-dark text-white d-flex align-items-center justify-content-center">M</span>
                                                     <span class="avatar avatar-sm rounded-circle bg-warning text-white d-flex align-items-center justify-content-center">+2</span>
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <span class="me-2">75%</span>
                                                    <div class="progress w-100" style="height: 6px;">
                                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 75%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody> -->
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Tasks Performance Card -->
                     <div class="col-lg-4 col-12 mb-5">
                        <div class="card h-100 shadow-sm border-0 rounded-3">
                             <div class="card-header border-bottom-0 py-4 bg-white">
                                <h4 class="mb-0 fw-bold">Tasks Performance</h4>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-center mb-4 text-center">
                                    <div class="chart-box" style="width: 150px; height: 150px; background: conic-gradient(#624bff 0% 76%, #f5f7fa 76% 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative;">
                                         <div style="background: white; width: 120px; height: 120px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                             <span class="fw-bold fs-3">76%</span>
                                         </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h5 class="mb-0 text-muted fs-6"><i class="bi bi-circle-fill text-primary mt-1 me-2 fs-6"></i>Completed</h5>
                                        <span class="fw-bold">76%</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="mb-0 text-muted fs-6"><i class="bi bi-circle-fill text-light mt-1 me-2 fs-6"></i>In-Progress</h5>
                                        <span class="fw-bold">24%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
