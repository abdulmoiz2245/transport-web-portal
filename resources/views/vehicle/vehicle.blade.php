
<div class="card">
    <div class="card-body">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{ route('user.vehicle.register_new_vehicle') }}">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center">
                                <img src="<?= asset('assets') ?>/images/fuel.png" class="mb-1" alt="" width="35">
                                <p class="text-muted mt-2 mb-2"><strong>Register New Vehicle</strong></p>
                                <p class="lead text-22 m-0"></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                <form id="own_vechicle" action="{{ route( 'user.vehicle.own_new_vehicle') }}" method="post" class="d-inline">
                @csrf
                <a onclick="document.getElementById('own_vechicle').submit();">     
                    <div class="card card-icon mb-4">
                        <div class="card-body text-center">
                            <img src="<?= asset('assets') ?>/images/fuel.png" class="mb-1" alt="" width="35">
                            <p class="text-muted mt-2 mb-2"><strong>View Vehicles</strong></p>
                            <p class="lead text-22 m-0"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>