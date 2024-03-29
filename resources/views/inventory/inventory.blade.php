<div class="container">
    <div class="card">
        <div class="card-body">
        <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('user.inventory.fuel') }}">
                <div class="card card-icon mb-4">
                    <div class="card-body text-center">
                        <img src="<?= asset('assets') ?>/images/fuel.png" class="mb-1" alt="" width="35">
                        <p class="text-muted mt-2 mb-2"><strong>Fuel</strong></p>
                        <p class="lead text-22 m-0"></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('user.inventory.tyres') }}">
                <div class="card card-icon mb-4">
                    <div class="card-body text-center">
                        <img src="<?= asset('assets') ?>/images/tyre.png" class="mb-1" alt="" width="35">
                        <p class="text-muted mt-2 mb-2"><strong>Tyres</strong></p>
                        <p class="lead text-22 m-0"></p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('user.inventory.spare_parts') }}">
                <div class="card card-icon mb-4">
                    <div class="card-body text-center">
                        <img src="<?= asset('assets') ?>/images/spare-parts.png" alt="" class="mb-1" width="35">
                        <p class="text-muted mt-2 mb-2"><strong>Spare Parts</strong></p>
                        <p class="lead text-22 m-0"></p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('user.inventory.tools') }}">
                <div class="card card-icon mb-4">
                    <div class="card-body text-center">
                        <img src="<?= asset('assets') ?>/images/tools.png" alt="" class="mb-1" width="35">
                        <p class="text-muted mt-2 mb-2"><strong>Tools</strong></p>
                        <p class="lead text-22 m-0"></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('user.inventory.vehicle') }}">
                <div class="card card-icon mb-4">
                    <div class="card-body text-center">
                        <i class="nav-icon  i-Truck" style="
                            font-size: 39px;
                        "></i>
                        <p class="text-muted mt-2 mb-2"><strong>Vehicle</strong></p>
                        <p class="lead text-22 m-0"></p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('user.inventory.uncategorized') }}">
                <div class="card card-icon mb-4">
                    <div class="card-body text-center">
                        <img src="<?= asset('assets') ?>/images/tools.png" alt="" class="mb-1" width="35">
                        <p class="text-muted mt-2 mb-2"><strong>Uncategorized  Purchased Data</strong></p>
                        <p class="lead text-22 m-0"></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
        </div>
    </div>
   
</div>