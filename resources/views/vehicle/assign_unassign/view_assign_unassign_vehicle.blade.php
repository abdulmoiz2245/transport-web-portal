<?php 
use App\Models\Company_name;
use App\Models\Purchase_mertial_data;
use App\Models\Employee;
use App\Models\Vehicle;


?>
<style>
    p , span{
        font-size:14px;
    }
    .badge{
        font-size:12px;

    }
</style>
<div class="container">

    <div class="mb-5"> 
        <a href="{{ route( 'user.vehicle.assign_vehicle') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>  
    <div class="row mb-3">
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Vehicle Number :</h5>

                </div>
                <div class="col-6">
                    @foreach(Vehicle::all() as $vehicle)
                        @if($vehicle->id ==  $data['assign_unassign_vehicle']->vehicle_id)
                            <p>{{ $vehicle->vehicle_number }}</p>
                        @endif
                    @endforeach
                    
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Driver Name :</h5>

                </div>
                <div class="col-6">
                    @foreach(Employee::all() as $driver)
                        @if($driver->id ==  $data['assign_unassign_vehicle']->driver_id)
                            <p>{{ $driver->name }}</p>
                        @endif
                    @endforeach
                    
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Trailer Chasis Number :</h5>

                </div>
                <div class="col-6">
                    @foreach(Vehicle::all() as $vehicle)
                        @if($vehicle->id ==  $data['assign_unassign_vehicle']->trailer_id)
                            <p>{{ $vehicle->chassis_number }}</p>
                        @endif
                    @endforeach
                    
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Vehicle Staus :</h5>
                </div>
                <div class="col-6">
                    @if($data['assign_unassign_vehicle']->vehicle_status == 'assigned')
                    <span class="badge badge-pill badge-success">{{ $data['assign_unassign_vehicle']->vehicle_status }}</span>
                    @else($data['assign_unassign_vehicle']->vehicle_status == 'unassigned')
                    <span class="badge badge-pill badge-danger">{{ $data['assign_unassign_vehicle']->vehicle_status }}</span>

                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Assign Date :</h5>
                </div>
                <div class="col-6">
                    <span class="badge badge-pill badge-warning"> {{ $data['assign_unassign_vehicle']->assign_date }} </span>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Unassign Date :</h5>
                </div>
                <div class="col-6">
                    <span class="badge badge-pill badge-warning"> {{ $data['assign_unassign_vehicle']->unassign_date }} </span>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-12 mt-2 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Handover Form:</h5>

                </div>
                <div class="col-8">
                    @if( $data['assign_unassign_vehicle']->handover_form == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->handover_form}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->handover_form}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mt-2 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Submission Form :</h5>

                </div>
                <div class="col-8">
                    @if( $data['assign_unassign_vehicle']->submission_form == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->submission_form}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->submission_form}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="col-12 mb-3">
            <hr>
            <h4>Vehicle Photos At Assign Time</h4>
        </div>
        
        <div class="col-md-6 col-12 mt-2 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Interior Photo:</h5>

                </div>
                <div class="col-8">
                    @if( $data['assign_unassign_vehicle']->assign_vehicle_interior_photo == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->assign_vehicle_interior_photo}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->assign_vehicle_interior_photo}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mt-2 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Exterior Photo :</h5>

                </div>
                <div class="col-8">
                    @if( $data['assign_unassign_vehicle']->assign_vehicle_exterior_photo == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->assign_vehicle_exterior_photo}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->assign_vehicle_exterior_photo}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="col-12 mb-3">
            <hr>
            <h4>Vehicle Photos At Unassign Time</h4>
        </div>
        
        <div class="col-md-6 col-12 mt-2 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Interior Photo:</h5>

                </div>
                <div class="col-8">
                    @if( $data['assign_unassign_vehicle']->unassign_vehicle_interior_photo == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->unassign_vehicle_interior_photo}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->unassign_vehicle_interior_photo}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mt-2 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Exterior Photo :</h5>

                </div>
                <div class="col-8">
                    @if( $data['assign_unassign_vehicle']->unassign_vehicle_exterior_photo == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->unassign_vehicle_exterior_photo}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->unassign_vehicle_exterior_photo}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="col-12 mb-3">
            <hr>
            <h4>Trailer Photo At Assign Time</h4>
        </div>
        
        <div class="col-md-6 col-12 mt-2 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Front Photo:</h5>

                </div>
                <div class="col-8">
                    @if( $data['assign_unassign_vehicle']->assign_trailer_front_photo == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->assign_trailer_front_photo}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->assign_trailer_front_photo}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mt-2 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Back Photo :</h5>

                </div>
                <div class="col-8">
                    @if( $data['assign_unassign_vehicle']->assign_trailer_back_photo == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->assign_trailer_back_photo}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->assign_trailer_back_photo}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mt-2 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Left Photo :</h5>

                </div>
                <div class="col-8">
                    @if( $data['assign_unassign_vehicle']->assign_trailer_left_photo == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->assign_trailer_left_photo}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->assign_trailer_left_photo}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mt-2 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Right Photo :</h5>

                </div>
                <div class="col-8">
                    @if( $data['assign_unassign_vehicle']->assign_trailer_right_photo == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->assign_trailer_right_photo}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->assign_trailer_right_photo}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="col-12 mb-3">
            <hr>
            <h4>Trailer Photo At Unassign Time</h4>
        </div>
        
        <div class="col-md-6 col-12 mt-2 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Front Photo:</h5>

                </div>
                <div class="col-8">
                    @if( $data['assign_unassign_vehicle']->unassign_trailer_front_photo == '')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->unassign_trailer_front_photo}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->unassign_trailer_front_photo}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mt-2 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Back Photo :</h5>

                </div>
                <div class="col-8">
                    @if( $data['assign_unassign_vehicle']->unassign_trailer_back_photo == '')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->unassign_trailer_back_photo}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->unassign_trailer_back_photo}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mt-2 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Left Photo :</h5>

                </div>
                <div class="col-8">
                    @if( $data['assign_unassign_vehicle']->unassign_trailer_left_photo == '')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->unassign_trailer_left_photo}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->unassign_trailer_left_photo}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mt-2 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Right Photo :</h5>

                </div>
                <div class="col-8">
                    @if( $data['assign_unassign_vehicle']->unassign_trailer_right_photo == '')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->unassign_trailer_right_photo}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a href="{{ asset('main_admin/vehicle/')}}/{{$data['assign_unassign_vehicle']->unassign_trailer_right_photo}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>

    </div>
</div>