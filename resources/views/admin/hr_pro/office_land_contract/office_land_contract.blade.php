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
                    <a href="{{ route('admin.hr_pro.office_contracts') }}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Financial"></i>
                            <div class="content">
                                <!-- <p class="text-muted mt-2 mb-0">Sales</p> -->
                                <p class="text-primary text-16 line-height-1 mb-2">Office Contract</p>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('admin.hr_pro.land_contracts') }}">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Financial"></i>
                            <div class="content">
                                <!-- <p class="text-muted mt-2 mb-0">Sales</p> -->
                                <p class="text-primary text-16 line-height-1 mb-2">Land Contract</p>
                            </div>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>