<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="mb-5">
                <a href="{{ route( 'admin.hr_pro') }}">
                    <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
                </a>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.hr_pro.mobile_muncipality') }}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Financial"></i>
                            <div class="content">
                                <!-- <p class="text-muted mt-2 mb-0">Sales</p> -->
                                <p class="text-primary text-16 line-height-1 mb-2">MUNCIPALITY DOCUMENTS</p>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.hr_pro.mobile_civil_defence') }}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Financial"></i>
                            <div class="content">
                                <!-- <p class="text-muted mt-2 mb-0">Sales</p> -->
                                <p class="text-primary text-16 line-height-1 mb-2">CIVIL DEFENSE DOCUMENTS</p>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.hr_pro.mobiles_trained_individual') }}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Financial"></i>
                            <div class="content">
                                <!-- <p class="text-muted mt-2 mb-0">Sales</p> -->
                                <p class="text-primary text-16 line-height-1 mb-2">TRAINED INDIVIDUAL</p>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>