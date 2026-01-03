<?php include '../includes/head.php'; ?>

<body>
    <div class="dashboard-wrapper">
        <?php include '../includes/sidebar_employee.php'; ?>
        <main class="dashboard-main">
            <?php include '../includes/header_employee.php'; ?>

            <!-- Page Content -->
            <div class="dashboard-content">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-1">Attendance</h1>
                        <p class="text-muted">Track your daily work hours.</p>
                    </div>
                    <div class="d-none d-md-block">
                        <span class="badge bg-light text-dark border p-2 fw-normal">Current Time: <span class="fw-bold"
                                id="clock">10:30 AM</span></span>
                    </div>
                </div>

                <!-- Stats Toolbar (Date Nav + Stats) -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-2">
                        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                            <!-- Date Control -->
                            <div class="d-flex align-items-center gap-2 p-2">
                                <button class="btn btn-sm btn-light border"><i
                                        class="bi bi-chevron-left">&lt;</i></button>
                                <span class="fw-bold text-dark mx-2">Oct 2026</span>
                                <button class="btn btn-sm btn-light border"><i
                                        class="bi bi-chevron-right">&gt;</i></button>
                            </div>

                            <div class="vr d-none d-md-block my-2"></div>

                            <!-- Stats Items -->
                            <div
                                class="d-flex flex-wrap gap-4 p-2 flex-grow-1 justify-content-around justify-content-md-end">
                                <div class="text-center text-md-end">
                                    <div class="small text-muted text-uppercase ls-1" style="font-size: 0.7rem;">Present
                                    </div>
                                    <div class="h5 fw-bold text-success mb-0">20 <span
                                            class="small text-muted fw-normal">days</span></div>
                                </div>
                                <div class="text-center text-md-end">
                                    <div class="small text-muted text-uppercase ls-1" style="font-size: 0.7rem;">Leaves
                                    </div>
                                    <div class="h5 fw-bold text-warning mb-0">02 <span
                                            class="small text-muted fw-normal">days</span></div>
                                </div>
                                <div class="text-center text-md-end">
                                    <div class="small text-muted text-uppercase ls-1" style="font-size: 0.7rem;">Working
                                    </div>
                                    <div class="h5 fw-bold text-dark mb-0">24 <span
                                            class="small text-muted fw-normal">days</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-4">

                    <!-- Left Column: Actions & Calendar -->
                    <div class="col-12 col-lg-5 order-lg-2">
                        <!-- Check-In/Out Card -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-4 text-center">
                                <h4 class="fw-bold mb-1">Today, Oct 24</h4>
                                <p class="text-muted small mb-4" id="realtime-clock">10:30:45 AM</p>

                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <button
                                            class="btn btn-success w-100 py-3 fw-bold shadow-sm d-flex flex-column align-items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" class="bi bi-box-arrow-in-right"
                                                viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                                                <path fill-rule="evenodd"
                                                    d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                            </svg>
                                            PUNCH IN
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button
                                            class="btn btn-outline-danger w-100 py-3 fw-bold opacity-50 d-flex flex-column align-items-center gap-1"
                                            disabled>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                                <path fill-rule="evenodd"
                                                    d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                            </svg>
                                            PUNCH OUT
                                        </button>
                                    </div>
                                </div>
                                <div class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                    Creating data for: <span class="fw-bold">24 Oct 2026</span>
                                </div>
                            </div>
                        </div>

                        <!-- Visual Calendar Grid -->
                        <div class="card border-0 shadow-sm">
                            <div
                                class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
                                <h6 class="mb-0 fw-bold">October 2026</h6>
                                <div class="d-flex align-items-center gap-1">
                                    <button class="btn btn-sm btn-light btn-icon border rounded-circle"><i
                                            class="bi bi-chevron-left">&lt;</i></button>
                                    <button class="btn btn-sm btn-light btn-icon border rounded-circle"><i
                                            class="bi bi-chevron-right">&gt;</i></button>
                                </div>
                            </div>
                            <div class="card-body p-3">
                                <!-- Days Header -->
                                <div class="d-grid text-center mb-2"
                                    style="grid-template-columns: repeat(7, 1fr); gap: 4px;">
                                    <small class="text-muted fw-bold">S</small>
                                    <small class="text-muted fw-bold">M</small>
                                    <small class="text-muted fw-bold">T</small>
                                    <small class="text-muted fw-bold">W</small>
                                    <small class="text-muted fw-bold">T</small>
                                    <small class="text-muted fw-bold">F</small>
                                    <small class="text-muted fw-bold">S</small>
                                </div>
                                <!-- Calendar Grid w/ Mock Data (colors: success=present, danger=absent, warning=half/late, light=weekend/future) -->
                                <div class="d-grid text-center"
                                    style="grid-template-columns: repeat(7, 1fr); gap: 6px;">
                                    <!-- Week 1 -->
                                    <div class="p-2 rounded bg-light text-muted opacity-25">28</div>
                                    <div class="p-2 rounded bg-light text-muted opacity-25">29</div>
                                    <div class="p-2 rounded bg-light text-muted opacity-25">30</div>
                                    <div class="p-2 rounded bg-success-subtle text-success fw-bold">1</div>
                                    <div class="p-2 rounded bg-success-subtle text-success fw-bold">2</div>
                                    <div class="p-2 rounded bg-success-subtle text-success fw-bold">3</div>
                                    <div class="p-2 rounded bg-light text-muted border">4</div> <!-- Weekend -->

                                    <!-- Week 2 -->
                                    <div class="p-2 rounded bg-light text-muted border">5</div> <!-- Weekend -->
                                    <div class="p-2 rounded bg-success-subtle text-success fw-bold">6</div>
                                    <div class="p-2 rounded bg-success-subtle text-success fw-bold">7</div>
                                    <div class="p-2 rounded bg-success-subtle text-success fw-bold">8</div>
                                    <div class="p-2 rounded bg-success-subtle text-success fw-bold">9</div>
                                    <div class="p-2 rounded bg-success-subtle text-success fw-bold">10</div>
                                    <div class="p-2 rounded bg-light text-muted border">11</div>

                                    <!-- Week 3 -->
                                    <div class="p-2 rounded bg-light text-muted border">12</div>
                                    <div class="p-2 rounded bg-success-subtle text-success fw-bold">13</div>
                                    <div class="p-2 rounded bg-danger-subtle text-danger fw-bold position-relative">
                                        14
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"
                                            style="width: 6px; height: 6px;"></span>
                                    </div>
                                    <div class="p-2 rounded bg-success-subtle text-success fw-bold">15</div>
                                    <div class="p-2 rounded bg-success-subtle text-success fw-bold">16</div>
                                    <div class="p-2 rounded bg-success-subtle text-success fw-bold">17</div>
                                    <div class="p-2 rounded bg-light text-muted border">18</div>

                                    <!-- Week 4 -->
                                    <div class="p-2 rounded bg-light text-muted border">19</div>
                                    <div class="p-2 rounded bg-warning-subtle text-warning-emphasis fw-bold"
                                        title="Late">20</div>
                                    <div class="p-2 rounded bg-success-subtle text-success fw-bold">21</div>
                                    <div class="p-2 rounded bg-success-subtle text-success fw-bold">22</div>
                                    <div
                                        class="p-2 rounded bg-success-subtle text-success fw-bold border border-primary">
                                        23</div> <!-- Today/Selected -->
                                    <div class="p-2 rounded bg-light text-muted">24</div>
                                    <div class="p-2 rounded bg-light text-muted">25</div>
                                </div>

                                <div class="d-flex justify-content-center gap-3 mt-3 small">
                                    <div class="d-flex align-items-center gap-1"><span
                                            class="bg-success-subtle rounded-circle"
                                            style="width: 8px; height: 8px;"></span> Present</div>
                                    <div class="d-flex align-items-center gap-1"><span
                                            class="bg-danger-subtle rounded-circle"
                                            style="width: 8px; height: 8px;"></span> Absent</div>
                                    <div class="d-flex align-items-center gap-1"><span
                                            class="bg-warning-subtle rounded-circle"
                                            style="width: 8px; height: 8px;"></span> Late</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: History List -->
                    <div class="col-12 col-lg-7 order-lg-1">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-white border-bottom py-3">
                                <h5 class="card-title mb-0 h6 fw-bold text-uppercase ls-1 text-muted">Timesheet History
                                </h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4 py-3 text-uppercase text-muted small fw-bold ls-1">Date</th>
                                            <th class="py-3 text-uppercase text-muted small fw-bold ls-1">In</th>
                                            <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Out</th>
                                            <th class="py-3 text-uppercase text-muted small fw-bold ls-1">Hrs</th>
                                            <th class="py-3 text-uppercase text-muted small fw-bold ls-1 text-end pe-4">
                                                Extra</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Mock Data -->
                                        <tr>
                                            <td class="ps-4 py-3 fw-medium text-dark">Oct 23</td>
                                            <td class="text-dark fw-bold">09:00</td>
                                            <td class="text-dark fw-bold">18:00</td>
                                            <td><span class="badge bg-light text-dark border">09:00</span></td>
                                            <td class="text-end pe-4 text-success fw-bold">01:00</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4 py-3 fw-medium text-dark">Oct 22</td>
                                            <td class="text-dark fw-bold">09:00</td>
                                            <td class="text-dark fw-bold">18:00</td>
                                            <td><span class="badge bg-light text-dark border">09:00</span></td>
                                            <td class="text-end pe-4 text-success fw-bold">01:00</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4 py-3 fw-medium text-dark">Oct 21</td>
                                            <td class="text-dark fw-bold">09:00</td>
                                            <td class="text-dark fw-bold">18:00</td>
                                            <td><span class="badge bg-light text-dark border">09:00</span></td>
                                            <td class="text-end pe-4 text-muted">-</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4 py-3 fw-medium text-dark">Oct 20</td>
                                            <td class="text-dark fw-bold">09:20</td>
                                            <td class="text-dark fw-bold">18:20</td>
                                            <td><span class="badge bg-warning-subtle text-warning-emphasis">09:00</span>
                                            </td>
                                            <td class="text-end pe-4 text-muted">-</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4 py-3 fw-medium text-dark">Oct 17</td>
                                            <td class="text-dark fw-bold">09:00</td>
                                            <td class="text-dark fw-bold">18:00</td>
                                            <td><span class="badge bg-light text-dark border">09:00</span></td>
                                            <td class="text-end pe-4 text-muted">-</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4 py-3 fw-medium text-dark">Oct 16</td>
                                            <td class="text-dark fw-bold">09:00</td>
                                            <td class="text-dark fw-bold">18:00</td>
                                            <td><span class="badge bg-light text-dark border">09:00</span></td>
                                            <td class="text-end pe-4 text-muted">-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>

    </div>
    <?php include '../includes/footer.php'; ?>