
<div class="card">
    <div class="card-body">
        <div class="container">
            <div class="mb-4">
                <a href="{{ route( 'admin.workshop') }}">
                    <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
                </a>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.workshop.vehicle_oil_change_detail') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <i class="nav-icon  i-Truck" style="
                                    font-size: 39px;
                                "></i>
                                <p class="text-muted mt-2 mb-2"><strong>Vehicle Oil Change Detail</strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.workshop.add_preventive_check_list') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <i class="nav-icon  i-Truck" style="
                                    font-size: 39px;
                                "></i>
                                <p class="text-muted mt-2 mb-2"><strong>Add preventive check list</strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.workshop.preventive_check_list') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <i class="nav-icon  i-Truck" style="
                                    font-size: 39px;
                                "></i>
                                <p class="text-muted mt-2 mb-2"><strong>vehicle preventive check details </strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>