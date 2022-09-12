<div class="container">
<div class="d-flex mt-3 mb-3" style="justify-content: space-between;">
    <div>
        <a href="{{ route( 'admin.account') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
        
</div>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route( 'admin.account.reciveable_invoice') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0" style="
                                font-size: 16px;
                            ">Due</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route( 'admin.account.reciveable_invoice_over_due') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0" style="
                                font-size: 16px;
                            ">Over Due</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route( 'admin.account.recived_invoice') }}">
                <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                    <div class="card-body text-center">
                        <i class="i-Add-User"></i>
                        <div class="content">
                            <p class="text-muted mt-2 mb-0" style="
                                font-size: 16px;
                            ">Recived</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>

  

    </div>
</div>
