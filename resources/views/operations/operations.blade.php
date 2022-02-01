<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('user.operations.complaints') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <!-- <img src="<?= asset('assets') ?>/images/fuel.png" class="mb-1" alt="" width="35"> -->
                                <i class="nav-icon  i-Business-Man" style="
                                    font-size: 39px;
                                "></i>
                                <p class="text-muted mt-2 mb-2"><strong>Complaints</strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('user.operations.employee_attendence') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <!-- <img src="<?= asset('assets') ?>/images/leave_clender.png" class="mb-1" alt="" width="35"> -->
                                <i class="nav-icon  i-Calendar-4" style="
                                    font-size: 39px;
                                "></i>
                                <p class="text-muted mt-2 mb-2"><strong>Attendence</strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('user.operations.absent') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <!-- <img src="<?= asset('assets') ?>/images/leave_clender.png" class="mb-1" alt="" width="35"> -->
                                <i class="nav-icon  i-Calendar-4" style="
                                    font-size: 39px;
                                "></i>
                                <p class="text-muted mt-2 mb-2"><strong>Absent Employees</strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('user.operations.employee_attendence_report') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <!-- <img src="<?= asset('assets') ?>/images/leave_clender.png" class="mb-1" alt="" width="35"> -->
                                <i class="nav-icon  i-Calendar-4" style="
                                    font-size: 39px;
                                "></i>
                                <p class="text-muted mt-2 mb-2"><strong>Attendence Report</strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('user.operations.employee_leave') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <img src="<?= asset('assets') ?>/images/leave_clender.png" class="mb-1" alt="" width="35">
                            
                                <p class="text-muted mt-2 mb-2"><strong> Employee Leaves </strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>