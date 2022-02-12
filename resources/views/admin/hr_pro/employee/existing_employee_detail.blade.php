<div class="container">
    <div class="mb-3">
            <a href="{{ route( 'admin.hr_pro.employee') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
            
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.hr_pro.existing_employee') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <!-- <img src="<?= asset('assets') ?>/images/fuel.png" class="mb-1" alt="" width="35"> -->
                                <i class="nav-icon  i-Business-Man" style="
                                    font-size: 39px;
                                "></i>
                                <p class="text-muted mt-2 mb-2"><strong>Existing Employee</strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.hr_pro.employee_attendence') }}">
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
                    <a href="{{ route('admin.hr_pro.employee_attendence_report') }}">
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
                    <a href="{{ route('admin.hr_pro.employee_leave') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <img src="<?= asset('assets') ?>/images/leave_clender.png" class="mb-1" alt="" width="35">
                            
                                <p class="text-muted mt-2 mb-2"><strong> Employee Leaves </strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.hr_pro.employee_absent') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <img src="<?= asset('assets') ?>/images/leave_clender.png" class="mb-1" alt="" width="35">
                                
                                <p class="text-muted mt-2 mb-2"><strong> Absent Employee</strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div> -->

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.hr_pro.employee_terminate') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <!-- <img src="<?= asset('assets') ?>/images/leave_clender.png" class="mb-1" alt="" width="35"> -->
                                <i class="nav-icon  i-Business-Man" style="
                                    font-size: 39px;
                                "></i>
                                <p class="text-muted mt-2 mb-2"><strong> Employee Termination</strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.hr_pro.employee_suspension') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <!-- <img src="<?= asset('assets') ?>/images/leave_clender.png" class="mb-1" alt="" width="35"> -->
                                <i class="nav-icon  i-Business-Man" style="
                                    font-size: 39px;
                                "></i>
                                <p class="text-muted mt-2 mb-2"><strong> Employee Suspension</strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.hr_pro.employee_renewals') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <!-- <img src="<?= asset('assets') ?>/images/leave_clender.png" class="mb-1" alt="" width="35"> -->
                                <i class="nav-icon  i-Business-Man" style="
                                    font-size: 39px;
                                "></i>
                                <p class="text-muted mt-2 mb-2"><strong> Employee Renewals</strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.hr_pro.employee_increments') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <!-- <img src="<?= asset('assets') ?>/images/leave_clender.png" class="mb-1" alt="" width="35"> -->
                                <i class="nav-icon  i-Business-Man" style="
                                    font-size: 39px;
                                "></i>
                                <p class="text-muted mt-2 mb-2"><strong> Increments </strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.hr_pro.employee_deduction') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <!-- <img src="<?= asset('assets') ?>/images/leave_clender.png" class="mb-1" alt="" width="35"> -->
                                <i class="nav-icon  i-Business-Man" style="
                                    font-size: 39px;
                                "></i>
                                <p class="text-muted mt-2 mb-2"><strong> Deduction </strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>

                
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.hr_pro.employee_other') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <!-- <img src="<?= asset('assets') ?>/images/leave_clender.png" class="mb-1" alt="" width="35"> -->
                                <i class="nav-icon  i-Business-Man" style="
                                    font-size: 39px;
                                "></i>
                                <p class="text-muted mt-2 mb-2"><strong> Other </strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>