<style>
    h5{
        font-size: 16px;
        font-weight: 600;
    }
    p{
        font-size: 14px;
    }
</style>
<div class="container   ">

    <div class="mb-5"> 
        <a href="{{ route( 'user.operations.manage_booking') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>

    <div class="row mb-3">
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Job Id :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->id }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Sr no :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->sr_no }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Company Name :</h5>

                </div>
                <div class="col-6">
                    @foreach($data['company_names'] as $company_name)
                        @if($company_name->id ==  $data['booking']->company_id)
                            <p>{{ $company_name->name }}</p>
                        @endif
                    @endforeach
                    
                </div>
            </div>
        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Booking Date :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->booking_date }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Loading Date :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->loading_date }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Off Loading Date :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->offloading_date }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Booking Status :</h5>

                </div>
                <div class="col-6">
                    <p>
                    <span class="badge badge-success ">{{ $data['booking']->booking_status }}</span></p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <hr>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Customer Name :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->customer_name }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Customer TRN :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->trn }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Own Vehicle/ Hired Vehicle :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->own_hired_vehicle }}</p>
                </div>
            </div>
        </div>
        @if($data['booking']->own_hired_vehicle == 'hired')
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Sub Contractor Number :</h5>

                </div>
                <div class="col-6">
                    <p>
                        @foreach($data['sub_contractor'] as $sub_contractor)
                            @if($sub_contractor->id == $data['booking']->sub_contractor_id)
                                <?php $check = 1 ?>
                                <span class="badge badge-success badge-outlined ">{{ $sub_contractor->name}}</span>
                            @endif
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
        @endif
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Vehicle Number :</h5>

                </div>
                <div class="col-6">
                    <p>
                        @foreach($data['vehicle'] as $vehicle)
                            @if($vehicle->id == $data['booking']->vehicle_id)
                                <?php $check = 1 ?>
                                <span class="badge badge-success badge-outlined ">{{ $vehicle->vehicle_number}}</span>
                            @endif
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Driver Name :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->driver_name }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Mobile Number :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->mobile_number }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">From Location :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->from_location }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">To Location :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->to_location }}</p>
                </div>
            </div>
        </div>

        @if($data['booking']->own_hired_vehicle == 'own')
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Ap Km :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->ap_km }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Ap Fuel :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->ap_fuel }}</p>
                </div>
            </div>
        </div>
        @endif
        <div class="col-12">
            <hr>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Status Update :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->status_update }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3">
            <hr>
            <h4>Booking Activity</h4>
        </div>

        <div class="col-12 mb-2">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Vehicle in transit for loading Date :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->vehicle_transit_loading_date }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Vehicle loaded :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->vehicle_loaded_date }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Vehicle in transit to make delievery :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->vehicle_transit_make_delivery_date }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Cargo off loaded  :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->cargo_off_loaded_date }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Vehicle break down  :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->vehicle_break_down_date }}</p>
                </div>
            </div>
        </div>

        <div class="col-12 mb-2">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Vehicle repaired   :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['booking']->vehicle_repaired_date }}</p>
                </div>
            </div>
        </div>
    </div>
</div>