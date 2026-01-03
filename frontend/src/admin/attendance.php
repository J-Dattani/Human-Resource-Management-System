<?php include '../includes/head.php'; ?>

<body>
    <div class="dashboard-wrapper">
        <?php include '../includes/sidebar.php'; ?>

        <!-- Main Content -->
        <main class="dashboard-main">
            <?php include '../includes/header.php'; ?>

            <!-- Page Content -->
            <div class="dashboard-content">
                <!-- Header & Controls -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                    <div>
                        <h1 class="h3 mb-1">Attendance</h1>
                        <p class="text-muted mb-0">Daily timesheet records.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <!-- Date Navigation -->
                        <div class="d-flex align-items-center bg-white border rounded shadow-sm overflow-hidden">
                            <button
                                class="btn btn-link text-dark px-3 border-end text-decoration-none hover-bg-light"><i
                                    class="bi bi-chevron-left">&lt;</i></button>
                            <div class="d-flex align-items-center px-3 gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-calendar3 text-muted" viewBox="0 0 16 16">
                                    <path
                                        d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                                    <path
                                        d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                </svg>
                                <span class="fw-semibold text-dark">Oct 24, 2026</span>
                            </div>
                            <button
                                class="btn btn-link text-dark px-3 border-start text-decoration-none hover-bg-light"><i
                                    class="bi bi-chevron-right">&gt;</i></button>
                        </div>
                        <button class="btn btn-white border shadow-sm">Today</button>
                    </div>
                </div>

                <!-- Search & Filters -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-3">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted ps-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </span>
                            <input type="text" class="form-control border-start-0 ps-2"
                                placeholder="Search employee...">
                        </div>
                    </div>
                </div>

                <!-- Timesheet Table -->
                <div class="card border-0 shadow-sm">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 text-uppercase text-muted small fw-bold ls-1">Employee</th>
                                    <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Check In</th>
                                    <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Check Out</th>
                                    <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Work Hours</th>
                                    <th class="pe-4 py-3 text-uppercase text-muted small fw-bold ls-1 text-end">Extra
                                        Hours</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-primary bg-opacity-10 text-primary rounded-circle me-2 d-flex align-items-center justify-content-center fw-bold"
                                                style="width: 32px; height: 32px;">JD</div>
                                            <div>
                                                <div class="fw-bold text-dark">John Doe</div>
                                                <div class="small text-muted">EMP-001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="fw-medium text-dark">10:00 AM</td>
                                    <td class="fw-medium text-dark">07:00 PM</td>
                                    <td><span class="badge bg-light text-dark border">09:00</span></td>
                                    <td class="pe-4 text-end"><span class="text-success fw-medium">+01:00</span></td>
                                </tr>
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-success bg-opacity-10 text-success rounded-circle me-2 d-flex align-items-center justify-content-center fw-bold"
                                                style="width: 32px; height: 32px;">JS</div>
                                            <div>
                                                <div class="fw-bold text-dark">Jane Smith</div>
                                                <div class="small text-muted">EMP-002</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="fw-medium text-dark">10:00 AM</td>
                                    <td class="fw-medium text-dark">07:00 PM</td>
                                    <td><span class="badge bg-light text-dark border">09:00</span></td>
                                    <td class="pe-4 text-end"><span class="text-success fw-medium">+01:00</span></td>
                                </tr>
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-warning bg-opacity-10 text-warning rounded-circle me-2 d-flex align-items-center justify-content-center fw-bold"
                                                style="width: 32px; height: 32px;">RK</div>
                                            <div>
                                                <div class="fw-bold text-dark">Rahul Kumar</div>
                                                <div class="small text-muted">EMP-003</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="fw-medium text-dark">09:30 AM</td>
                                    <td class="fw-medium text-dark">06:30 PM</td>
                                    <td><span class="badge bg-light text-dark border">09:00</span></td>
                                    <td class="pe-4 text-end"><span class="text-muted">-</span></td>
                                </tr>
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-danger bg-opacity-10 text-danger rounded-circle me-2 d-flex align-items-center justify-content-center fw-bold"
                                                style="width: 32px; height: 32px;">AS</div>
                                            <div>
                                                <div class="fw-bold text-dark">Alice Start</div>
                                                <div class="small text-muted">EMP-004</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-danger small">Absent</td>
                                    <td class="text-danger small">Absent</td>
                                    <td><span class="badge bg-danger-subtle text-danger">00:00</span></td>
                                    <td class="pe-4 text-end"><span class="text-muted">-</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php include '../includes/footer.php'; ?>