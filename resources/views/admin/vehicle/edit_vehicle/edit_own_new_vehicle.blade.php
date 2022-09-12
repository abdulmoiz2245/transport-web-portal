<?php use App\Models\Company_name; ?>
<div class="container mt-3">
    <div class="mb-5">
            <a href="{{route('admin.vehicle.vehicle_fleet')}}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
    </div>
    <form action="{{ route('admin.vehicle.update_vehicle') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="id" value="{{ $data['vehicle']->id }}" class="d-none">
    <div id="smartwizard">
        <ul class="nav">
            <li>
                <a class="nav-link" href="#step-1">
                    VEHICLE DETAILS 

                </a>
            </li>

            @if($data['vehicle']->haired_sub_contractor_vehicle == '0')
            <li>
                <a class="nav-link" href="#step-2">
                    PASS/TAG/INSURANCE DETAILS  
                </a>
            </li>
            <!-- <li >
                <a class="nav-link" href="#step-3">
                    EQUIPMENT DETAILS 
                </a>
            </li> -->
            <li>
                <a class="nav-link" href="#step-4">
                    VEHICLE PHOTOS 
                </a>
            </li>
            <li>
                <a class="nav-link" href="#step-5">
                    EQUIPMENT PHOTOS 
                </a>
            </li>
            @endif
            <li>
                <a class="nav-link" href="#step-6">
                    Admin Status <span class="badge badge-pill badge-warning"><?php if( $data['vehicle']->status == 'pending' ){ ?> Pending <?php }else if($data['vehicle']->status == 'approved'){ ?> Approved <?php } ?></span>
                </a>
            </li>
        </ul>
        <div class="tab-content">
           
            <div id="step-1" class="tab-pane" role="tabpanel">
                <div class="row">

                    <div class="form-group col-md-6 col-12" >
                        <label >Registration Type</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->registration_type != $data['vehicle_history']->registration_type )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->registration_type}} </div> 
                        @endif
                        <select name="registration_type" id="registration_type" class="form-control" placeholder="" >
                                <option value="vehicle" <?php if($data['vehicle']->registration_type == 'vehicle'){ ?> selected="selected" <?php } ?> disabled>Vehicle</option>
                                <option value="trailer" <?php if($data['vehicle']->registration_type == 'trailer'){ ?> selected="selected" <?php } ?> disabled>Trailer</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 vehicle_number">
                        <label for="vehicle-number">Vehicle Number</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->vehicle_number != $data['vehicle_history']->vehicle_number )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->vehicle_number}} </div> 
                        @endif
                        <input type="text" name="vehicle_number" class="form-control" value="{{ $data['vehicle']->vehicle_number }}" >
                    </div>

                    <div class="form-group col-md-6 col-12">
                        <label for="company-name">Company Name</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->company_id != $data['vehicle_history']->company_id )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->company_id}} </div> 
                        @endif
                        <select name="company_id" class="form-control" required>
                            @foreach(Company_name::all() as $company)
                            <option value="{{ $company->id }}" <?php if($company->id ==$data['vehicle']->company_id ) {?> <?php  } ?> >{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 approx_value">
                        <label for="approx-value">Approx. Value</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->approx_value != $data['vehicle_history']->approx_value )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->approx_value}} </div> 
                        @endif
                        <input type="text" name="approx_value" class="form-control" value="{{ $data['vehicle']->approx_value }}" required>
                    </div>

                    <div class="form-group col-md-6 col-12">
                        
                        <label for="registration-date">Registration Date</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->registration_date != $data['vehicle_history']->registration_date )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->registration_date}} </div> 
                        @endif
                        <input type="date" name="registration_date" class="form-control" value="{{ $data['vehicle']->registration_date }}" required>
                    </div>

                    <div class="form-group col-md-6 col-12">
                        <label for="registration-expiry-date">Registration Expiry Date</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->registration_exp_date != $data['vehicle_history']->registration_exp_date )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->registration_exp_date}} </div> 
                        @endif
                        
                        <input type="date" name="registration_exp_date" class="form-control" value = "{{ $data['vehicle']->registration_exp_date }}" required>
                    </div>

                   

                    <div class="col-md-6 col-12">
                        @if( $data['vehicle']->regisration_form != null)
                            <!-- <div class="col-4">
                                <h5 class=""><b> TRN Copy :</b></h5>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Replace Registration Copy</label>

                                        @if($data['vehicle_history'] != null && $data['vehicle']->regisration_form != $data['vehicle_history']->regisration_form )
                                            <div class="edit-badge"> Edited </div> 
                                            <div class="old-value"> Old file : 
                                                <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle_history']->regisration_form}}" >
                                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                </a>
                                            </div> 
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-11 form-group">  
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload Registration</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="regisration_form">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->regisration_form}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                    <!-- <a  href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->regisration_form}}" download>
                                        <button class="btn">
                                            Download Document
                                        </button>
                                    </a>                                    -->
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Upload Registration</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Registration</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="regisration_form">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 col-12 make">
                        <label for="make">Make</label>
                         
                        @if($data['vehicle_history'] != null && $data['vehicle']->make != $data['vehicle_history']->make )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->make}} </div> 
                        @endif
                        <input type="text" name="make" class="form-control" value = "{{ $data['vehicle']->make}}" required>
                    </div>

                    <div class="form-group col-md-6 col-12 model ">
                        <label for="model">Model</label>
                        
                        @if($data['vehicle_history'] != null && $data['vehicle']->model != $data['vehicle_history']->model )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->model}} </div> 
                        @endif
                        <input type="text" name="model" class="form-control" value = "{{ $data['vehicle']->model}}" required>
                    </div>

                    <div class="form-group col-md-6 col-12 color">
                        <label for="colour">Color</label>
                        
                        @if($data['vehicle_history'] != null && $data['vehicle']->colour != $data['vehicle_history']->colour )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->colour}} </div> 
                        @endif
                        <input type="text" name="colour" class="form-control" value = "{{ $data['vehicle']->colour}}" required>
                    </div>

                    <div class="form-group col-md-6 col-12 engine_number">
                        <label for="engine-number">Engine Number</label>
                        
                        @if($data['vehicle_history'] != null && $data['vehicle']->engine_number != $data['vehicle_history']->engine_number )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->engine_number}} </div> 
                        @endif
                        <input type="text" name="engine_number" value = "{{ $data['vehicle']->engine_number}}" class="form-control" >
                    </div>

                    <div class="form-group col-md-6 col-12 chassis_number">
                        <label for="chassis-number">Chassis Number</label>
                        
                        @if($data['vehicle_history'] != null && $data['vehicle']->chassis_number != $data['vehicle_history']->chassis_number )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->chassis_number}} </div> 
                        @endif
                        <input type="text" name="chassis_number" value = "{{ $data['vehicle']->chassis_number}}" class="form-control" >
                    </div>
                    
                    <div class="form-group col-md-6 col-12 vehicle_type">
                        <label >Vehicle Type</label>
                        
                        @if($data['vehicle_history'] != null && $data['vehicle']->vehicle_type != $data['vehicle_history']->vehicle_type )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->vehicle_type}} </div> 
                        @endif
                        <select name="vehicle_type" id="vehicle_type" class="form-control" >
                                <option value="truck" <?php if($data['vehicle']->vehicle_type == 'truck'){ ?> selected="selected" <?php } ?>>Truck</option>
                                <option value="pickup" <?php if($data['vehicle']->vehicle_type == 'pickup'){ ?> selected="selected" <?php } ?>>Pickup</option>
                                <option value="car" <?php if($data['vehicle']->vehicle_type == 'car'){ ?> selected="selected" <?php } ?> >Car</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 truck_type">
                        <label >Truck</label>
                        
                        @if($data['vehicle_history'] != null && $data['vehicle']->truck_type != $data['vehicle_history']->truck_type )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->truck_type}} </div> 
                        @endif
                        <select name="truck_type" id="truck_type" class="form-control" >
                            <option value="flatbed" <?php if($data['vehicle']->truck_type == 'flatbed"'){ ?> selected="selected" <?php } ?>>FLATBED</option>
                            <option value="curtain_side" <?php if($data['vehicle']->truck_type == 'curtain_side'){ ?> selected="selected" <?php } ?>>Curtain Side</option>
                            <option value="tripper_2xl" <?php if($data['vehicle']->truck_type == 'tripper_2xl'){ ?> selected="selected" <?php } ?>>Tipper 2XL</option>
                            <option value="tripper_3xl" <?php if($data['vehicle']->truck_type == 'tripper_3xl'){ ?> selected="selected" <?php } ?>>Tipper 3XL</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 pickup_weight">
                        <label >Pickup (weight)</label>
                        
                        @if($data['vehicle_history'] != null && $data['vehicle']->truck_type != $data['vehicle_history']->truck_type )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->truck_type}} </div> 
                        @endif
                        <select name="pickup_weight" id="pickup_weight" class="form-control" >
                                <option value="1_tone" <?php if($data['vehicle']->pickup_weight == '1_tone'){ ?> selected="selected" <?php } ?> >1 Ton</option>
                                <option value="3_tone" <?php if($data['vehicle']->pickup_weight == '3_tone'){ ?> selected="selected" <?php } ?>>3 Ton</option>
                                <option value="7_tone" <?php if($data['vehicle']->pickup_weight == '7_tone'){ ?> selected="selected" <?php } ?>>  7 Ton</option>
                                <option value="10_tone" <?php if($data['vehicle']->pickup_weight == '10_tone'){ ?> selected="selected" <?php } ?>>10 Ton</option>
                                <option value="15_tone" <?php if($data['vehicle']->pickup_weight == '15_tone'){ ?> selected="selected" <?php } ?>>15 Ton</option>

                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 pickup_shape">
                        <label >Pickup (shape)</label>
                        
                        @if($data['vehicle_history'] != null && $data['vehicle']->pickup_shape != $data['vehicle_history']->pickup_shape )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->pickup_shape}} </div> 
                        @endif
                        <select name="pickup_shape" id="pickup_weight" class="form-control" >
                                <option value="side_grill" <?php if($data['vehicle']->pickup_shape == 'side_grill'){ ?> selected="selected" <?php } ?>>Side Grill</option>
                                <option value="dry_box" <?php if($data['vehicle']->pickup_shape == 'dry_box'){ ?> selected="selected" <?php } ?>>Dry Box</option>
                                <option value="chiller" <?php if($data['vehicle']->pickup_shape == 'chiller'){ ?> selected="selected" <?php } ?>>Chiller</option>
                                <option value="freezer" <?php if($data['vehicle']->pickup_shape == 'freezer'){ ?> selected="selected" <?php } ?>>Freezer</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 car_description">
                        <label for="car-description">Car Description</label>
                        
                        @if($data['vehicle_history'] != null && $data['vehicle']->car_description != $data['vehicle_history']->car_description )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->car_description}} </div> 
                        @endif
                        <input type="text" value = "{{ $data['vehicle']->car_description}}" name="car_description" class="form-control" >
                    </div>

                    <div class="form-group col-md-6 col-12 vehicle_suspension">
                        <label >Vehicle  Suspension</label>
                        
                        @if($data['vehicle_history'] != null && $data['vehicle']->vehicle_suspension != $data['vehicle_history']->vehicle_suspension )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->vehicle_suspension}} </div> 
                        @endif
                        <select name="vehicle_suspension" id="" class="form-control" >
                            <option value="booster" <?php if($data['vehicle']->vehicle_suspension == 'booster'){ ?> selected="selected" <?php } ?> >Booster</option>
                            <option value="kamani" <?php if($data['vehicle']->vehicle_suspension == 'kamani'){ ?> selected="selected" <?php } ?>>Kamani</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 salik">
                        <label >Salik</label>
                        
                        @if($data['vehicle_history'] != null && $data['vehicle']->salik != $data['vehicle_history']->salik )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->salik}} </div> 
                        @endif
                        <select name="salik" id="" class="form-control" >
                                <option value="0" <?php if($data['vehicle']->salik == '0'){ ?> selected="selected" <?php } ?>>Yes</option>
                                <option value="1" <?php if($data['vehicle']->salik == '1'){ ?> selected="selected" <?php } ?>>No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 trailer_type">
                        <label >Trailer Type</label>
                        
                        @if($data['vehicle_history'] != null && $data['vehicle']->trailer_type != $data['vehicle_history']->trailer_type )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->trailer_type}} </div> 
                        @endif
                        <select name="trailer_type" id="" class="form-control" >
                            <option value="flatbed" <?php if($data['vehicle']->trailer_type == 'flatbed'){ ?> selected="selected" <?php } ?> >FLATBED</option>
                            <option value="curtain_side" <?php if($data['vehicle']->trailer_type == 'curtain_side'){ ?> selected="selected" <?php } ?>>Curtain Side</option>
                            <option value="tripper_2xl" <?php if($data['vehicle']->trailer_type == 'tripper_2xl'){ ?> selected="selected" <?php } ?>>Tipper 2XL</option>
                            <option value="tripper_3xl" <?php if($data['vehicle']->trailer_type == 'tirpper_3xl'){ ?> selected="selected" <?php } ?>>Tipper 3XL</option>

                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 trailer_suspension">
                        <label >Trailer  Suspension</label>
                        
                        @if($data['vehicle_history'] != null && $data['vehicle']->trailer_suspension != $data['vehicle_history']->trailer_suspension )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->trailer_suspension}} </div> 
                        @endif
                        <select name="trailer_suspension" id="" class="form-control" >
                                <option value="booster" <?php if($data['vehicle']->trailer_suspension == 'curtain_side'){ ?> selected="selected" <?php } ?>>Booster</option>
                                <option value="kamani" <?php if($data['vehicle']->trailer_suspension == 'curtain_side'){ ?> selected="selected" <?php } ?>>Kamani</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 size">
                        <label for="size">Size(meter/feet)</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->trailer_size != $data['vehicle_history']->trailer_size )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->trailer_size}} </div> 
                        @endif
                        <input type="text" value = "{{ $data['vehicle']->trailer_size}}" name="trailer_size" class="form-control" >
                    </div>

                    <div class="form-group col-md-6 col-12 axle">
                        <label >Axle</label>
                        
                        @if($data['vehicle_history'] != null && $data['vehicle']->axle != $data['vehicle_history']->axle )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->axle}} </div> 
                        @endif
                        <input type="number" value = "{{ $data['vehicle']->axle}}" name="axle" class="form-control" >

                    </div>

                    <div class="form-group col-md-6 col-12 ton_capacity">
                        <label for="ton-capacity">Maximum Ton Capacity</label>
                        
                        @if($data['vehicle_history'] != null && $data['vehicle']->ton_capacity != $data['vehicle_history']->ton_capacity )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->ton_capacity}} </div> 
                        @endif
                        <input type="text" value = "{{ $data['vehicle']->ton_capacity}}" name="ton_capacity" class="form-control" >
                    </div>
                </div>
            </div>

            <div id="step-2" class="tab-pane" role="tabpanel">
                <div class="row">
                    <div class="form-group col-md-6 col-12 vehicle_insurance">
                        <label >Vehicle Insurance</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->vehicle_insurance != $data['vehicle_history']->vehicle_insurance)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : 
                                @if(  $data['vehicle_history']->vehicle_insurance == '0')
                                    YES
                                @else
                                    No
                                @endif
                            </div> 
                        @endif
                        <select name="vehicle_insurance" id="vehicle_insurance" class="form-control" >
                                <option value="0"  <?php if($data['vehicle']->vehicle_insurance == '0'){ ?> selected="selected" <?php } ?>>Yes</option>
                                <option value="1"  <?php if($data['vehicle']->vehicle_insurance == '1'){ ?> selected="selected" <?php } ?>>No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 policy_number">
                        <label for="policy-number">Policy Number</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->insurance_policy_number != $data['vehicle_history']->insurance_policy_number)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->insurance_policy_number }} </div> 
                        @endif
                        <input type="text" name="insurance_policy_number" value="{{ $data['vehicle']->insurance_policy_number }}" class="form-control" >
                    </div>

                    <div class="form-group col-md-6 col-12 insurance_expiry">
                        <label for="insurance-expiry">Insurance Expiry Date</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->insurance_expiry != $data['vehicle_history']->insurance_expiry)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->insurance_expiry }} </div> 
                        @endif
                        <input type="date" name="insurance_expiry" value="{{ $data['vehicle']->insurance_expiry }}" class="form-control" >
                    </div>

                    <div class="col-md-6 col-12 insurance_form">
                        @if( $data['vehicle']->insurance_form != null)
                            <!-- <div class="col-4">
                                <h5 class=""><b> TRN Copy :</b></h5>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Replace Insurance Form Copy</label>

                                        @if($data['vehicle_history'] != null && $data['vehicle']->insurance_form != $data['vehicle_history']->insurance_form )
                                            <div class="edit-badge"> Edited </div> 
                                            <div class="old-value"> Old file : 
                                                <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle_history']->insurance_form}}" >
                                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                </a>
                                            </div> 
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-11 form-group">  
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload Insurance Form</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="insurance_form">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->insurance_form}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Upload Insurance Form</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Insurance Form</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="insurance_form">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 col-12 other_insurance">
                        <label >other Insurance</label>

                        @if($data['vehicle_history'] != null && $data['vehicle']->other_insurance != $data['vehicle_history']->other_insurance)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : 
                                @if(  $data['vehicle_history']->other_insurance== '0')
                                    YES
                                @else
                                    No
                                @endif
                            </div> 
                        @endif

                        <select name="other_insurance" id="other_insurance" class="form-control" >
                                <option value="0"  <?php if($data['vehicle']->other_insurance == '0'){ ?> selected="selected" <?php } ?>>Yes</option>
                                <option value="1"  <?php if($data['vehicle']->other_insurance == '1'){ ?> selected="selected" <?php } ?>>No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 other_insurance_expiry">
                        <label for="other-insurance-expiry">Other Insurance Expiry Date</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->other_insurance_form != $data['vehicle_history']->other_insurance_form)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->other_insurance_form }} </div> 
                        @endif
                        <input type="date" name="other_insurance_expiry" class="form-control" >
                    </div>


                    <div class="col-md-6 col-12 other_insurance_form">
                        @if( $data['vehicle']->other_insurance_form != null)
                            <!-- <div class="col-4">
                                <h5 class=""><b> TRN Copy :</b></h5>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Replace Other Insurance form Copy</label>

                                        @if($data['vehicle_history'] != null && $data['vehicle']->other_insurance_form != $data['vehicle_history']->other_insurance_form )
                                            <div class="edit-badge"> Edited </div> 
                                            <div class="old-value"> Old file : 
                                                <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle_history']->other_insurance_form}}" >
                                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                </a>
                                            </div> 
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-11 form-group">  
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload onthre insurance form</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="other_insurance_form">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->other_insurance_form}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Upload other_insurance_form</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload other_insurance_form</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="other_insurance_form">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 col-12 other_insurance_description">
                        <label for="other-insurance-descripiton">Other Insurance Description</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->other_insurance_form != $data['vehicle_history']->other_insurance_form)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->other_insurance_form }} </div> 
                        @endif
                        <input type="text" value="{{ $data['vehicle']->other_insurance_description }}" name="other_insurance_description" class="form-control" >
                    </div>

                    <!-- Tags -->

                    <div class="form-group col-md-6 col-12">
                        <label >J-Ali Tag</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->j_ali_tag != $data['vehicle_history']->j_ali_tag)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : 
                                @if(  $data['vehicle_history']->j_ali_tag== '0')
                                    YES
                                @else
                                    No
                                @endif
                            </div> 
                        @endif
                        <select name="j_ali_tag" id="j_ali_tag" class="form-control" >
                                <option value="0"  <?php if($data['vehicle']->j_ali_tag == '0'){ ?> selected="selected" <?php } ?>>Yes</option>
                                <option value="1"  <?php if($data['vehicle']->j_ali_tag == '1'){ ?> selected="selected" <?php } ?>>No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 j_ali_tag_expiry">
                        <label for="j-ali-tag-expiry">J-Ali Tag Expiry Date</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->j_ali_tag_expiry != $data['vehicle_history']->j_ali_tag_expiry)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->j_ali_tag_expiry }} </div> 
                        @endif
                        <input type="date" value="{{ $data['vehicle']->j_ali_tag_expiry }}" name="j_ali_tag_expiry" class="form-control" >
                    </div>

                    <div class="col-md-6 col-12 j_ali_tag_upload">
                        @if( $data['vehicle']->j_ali_tag_upload != null)
                            <!-- <div class="col-4">
                                <h5 class=""><b> TRN Copy :</b></h5>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Replace j_ali_tag_upload Copy</label>

                                        @if($data['vehicle_history'] != null && $data['vehicle']->j_ali_tag_upload != $data['vehicle_history']->j_ali_tag_upload )
                                            <div class="edit-badge"> Edited </div> 
                                            <div class="old-value"> Old file : 
                                                <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle_history']->j_ali_tag_upload}}" >
                                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                </a>
                                            </div> 
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-11 form-group">  
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload j_ali_tag_upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="j_ali_tag_upload">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->j_ali_tag_upload}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Upload j_ali_tag_upload</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload j_ali_tag_upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="j_ali_tag_upload">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="form-group col-md-6 col-12 kp_tag">
                        <label >KP Tag</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->kp_tag != $data['vehicle_history']->kp_tag)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : 
                                @if(  $data['vehicle_history']->kp_tag== '0')
                                    YES
                                @else
                                    No
                                @endif
                            </div> 
                        @endif
                        <select name="kp_tag" id="kp_tag" class="form-control" >
                                <option value="0"  <?php if($data['vehicle']->kp_tag == '0'){ ?> selected="selected" <?php } ?>>Yes</option>
                                <option value="1"  <?php if($data['vehicle']->kp_tag == '1'){ ?> selected="selected" <?php } ?>>No</option>
                        </select>
                    </div>


                    <div class="form-group col-md-6 col-12 kp_tag_expiry">
                        <label for="kp-tag-expiry">KP Tag Expiry Date</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->kp_tag_expiry != $data['vehicle_history']->kp_tag_expiry)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->kp_tag_expiry }} </div> 
                        @endif
                        <input type="date" value="{{$data['vehicle']->kp_tag_expiry  }}" name="kp_tag_expiry" class="form-control" >
                    </div>

                    

                    <div class="col-md-6 col-12 kp_tag_upload">
                        @if( $data['vehicle']->kp_tag_upload != null)
                            <!-- <div class="col-4">
                                <h5 class=""><b> TRN Copy :</b></h5>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Replace Kp Tag Copy</label>

                                        @if($data['vehicle_history'] != null && $data['vehicle']->kp_tag_upload != $data['vehicle_history']->kp_tag_upload )
                                            <div class="edit-badge"> Edited </div> 
                                            <div class="old-value"> Old file : 
                                                <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle_history']->kp_tag_upload}}" >
                                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                </a>
                                            </div> 
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-11 form-group">  
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload Kp Tag</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="kp_tag_upload">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->kp_tag_upload}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Upload Kp Tag</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Kp Tag</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="kp_tag_upload">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>


                    <div class="form-group col-md-6 col-12">
                        <label >Other Tag</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->other_tag != $data['vehicle_history']->other_tag)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : 
                                @if(  $data['vehicle_history']->other_tag== '0')
                                    YES
                                @else
                                    No
                                @endif
                            </div> 
                        @endif
                        <select name="other_tag" id="other_tag" class="form-control" >
                                <option value="0"  <?php if($data['vehicle']->other_tag == '0'){ ?> selected="selected" <?php } ?> >Yes</option>
                                <option value="1"  <?php if($data['vehicle']->other_tag == '1'){ ?> selected="selected" <?php } ?>>No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 other_tag_description">
                        <label for="other-tag-description">Other Tag Description</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->other_tag_description != $data['vehicle_history']->other_tag_description)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->other_tag_description }} </div> 
                        @endif
                        <input type="text" value="{{$data['vehicle']->other_tag_description  }}" name="other_tag_description" class="form-control" >
                    </div>

                    <div class="form-group col-md-6 col-12 other_tag_expiry">
                        <label for="other-tag-expiry">Other Tag Expiry Date</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->other_tag_expiry != $data['vehicle_history']->other_tag_expiry)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->other_tag_expiry }} </div> 
                        @endif
                        <input type="date" value="{{$data['vehicle']->other_tag_expiry  }}" name="other_tag_expiry" class="form-control" >
                    </div>


                    <div class="col-md-6 col-12 other_tag_upload">
                        @if( $data['vehicle']->other_tag_upload != null)
                            <!-- <div class="col-4">
                                <h5 class=""><b> TRN Copy :</b></h5>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Replace Other Tag Copy</label>

                                        @if($data['vehicle_history'] != null && $data['vehicle']->other_tag_upload != $data['vehicle_history']->other_tag_upload )
                                            <div class="edit-badge"> Edited </div> 
                                            <div class="old-value"> Old file : 
                                                <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle_history']->other_tag_upload}}" >
                                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                </a>
                                            </div> 
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-11 form-group">  
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload Other Tag </span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="other_tag_upload">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->other_tag_upload}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Upload other_tag_upload</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Other Tag </span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="other_tag_upload">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- Stickers -->

                    <div class="form-group col-md-6 col-12">
                        <label >Sticker</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->sticker != $data['vehicle_history']->sticker)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : 
                                @if(  $data['vehicle_history']->sticker== '0')
                                    YES
                                @else
                                    No
                                @endif
                            </div> 
                        @endif
                        <select name="sticker" id="sticker" class="form-control" >
                                <option value="0"  <?php if($data['vehicle']->sticker == '0'){ ?> selected="selected" <?php } ?>>Yes</option>
                                <option value="1"  <?php if($data['vehicle']->sticker == '1'){ ?> selected="selected" <?php } ?>>No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 sticker_description">
                        <label >Sticker Description</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->sticker_description != $data['vehicle_history']->sticker_description)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->sticker_description }} </div> 
                        @endif
                        <select name="sticker_description" id="sticker_description" class="form-control" >
                                <option value="salik"  <?php if($data['vehicle']->sticker_description == 'salik'){ ?> selected="selected" <?php } ?>>Salik</option>
                                <option value="darb"  <?php if($data['vehicle']->sticker_description == 'darb'){ ?> selected="selected" <?php } ?>>Darb</option>
                                <option value="ad_port"  <?php if($data['vehicle']->sticker_description == 'ad_port'){ ?> selected="selected" <?php } ?>>AD Ports</option>
                                <option value="other"  <?php if($data['vehicle']->sticker_description == 'other'){ ?> selected="selected" <?php } ?>>Others</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 describe_other_sticker">
                        <label for="describe-other-sticker">Describe Other Sticker</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->describe_other_sticker != $data['vehicle_history']->describe_other_sticker)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->describe_other_sticker }} </div> 
                        @endif
                        <input type="text" value="{{ $data['vehicle']->describe_other_sticker }}" name="describe_other_sticker" class="form-control" >
                    </div>

                    <div class="form-group col-md-6 col-12 sticker_validity">
                        <label for="sticker-validity">Sticker Validity</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->sticker_validity != $data['vehicle_history']->sticker_validity)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->sticker_validity }} </div> 
                        @endif
                        <input type="date" value="{{$data['vehicle']->sticker_validity   }}" name="sticker_validity" class="form-control" >
                    </div>

                    <div class="col-md-6 col-12 sticker_upload">
                        @if( $data['vehicle']->sticker_upload != null)
                            <!-- <div class="col-4">
                                <h5 class=""><b> TRN Copy :</b></h5>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Replace Sticker Copy</label>

                                        @if($data['vehicle_history'] != null && $data['vehicle']->sticker_upload != $data['vehicle_history']->sticker_upload )
                                            <div class="edit-badge"> Edited </div> 
                                            <div class="old-value"> Old file : 
                                                <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle_history']->sticker_upload}}" >
                                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                </a>
                                            </div> 
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-11 form-group">  
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload Sticker</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="sticker_upload">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->sticker_upload}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Upload sticker_upload</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Sticker</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="sticker_upload">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Passes -->

                    <div class="form-group col-md-6 col-12">
                        <label >Pass</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->pass != $data['vehicle_history']->pass)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : 
                                @if(  $data['vehicle_history']->pass== '0')
                                    YES
                                @else
                                    No
                                @endif
                            </div> 
                        @endif
                        <select name="pass" id="pass" class="form-control" >
                                <option value="0" <?php if($data['vehicle']->pass == '0'){ ?> selected="selected" <?php } ?>>Yes</option>
                                <option value="1"  <?php if($data['vehicle']->pass == '1'){ ?> selected="selected" <?php } ?> >No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 pass_description">
                        <label >Pass Description</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->pass_description != $data['vehicle_history']->pass_description)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->pass_description }} </div> 
                        @endif
                        <select name="pass_description" id="pass_description" class="form-control" >
                                <option value="food_pass"  <?php if($data['vehicle']->pass_description == 'food_pass'){ ?> selected="selected" <?php } ?>>Food Pass</option>
                                <option value="j_ali"  <?php if($data['vehicle']->pass_description == 'j_ali'){ ?> selected="selected" <?php } ?>>J-Ali Pass</option>
                                <option value="emal"  <?php if($data['vehicle']->pass_description == 'emal'){ ?> selected="selected" <?php } ?>>Emal Pass</option>
                                <option value="dubal"  <?php if($data['vehicle']->pass_description == 'dubal'){ ?> selected="selected" <?php } ?>>Dubal Pass</option>
                                <option value="kp"  <?php if($data['vehicle']->pass_description == 'kp'){ ?> selected="selected" <?php } ?>>KP Pass</option>
                                <option value="mina_zayed"  <?php if($data['vehicle']->pass_description == 'main_zayed'){ ?> selected="selected" <?php } ?>>Mina Zayed Pass</option>
                                <option value="other" <?php if($data['vehicle']->pass_description == 'other'){ ?> selected="selected" <?php } ?>>Other Pass</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 describe_other_pass">
                        <label for="describe-other-pass">Describe Other Pass</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->describe_other_pass != $data['vehicle_history']->describe_other_pass)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->describe_other_pass }} </div> 
                        @endif
                        <input type="text" value= "{{ $data['vehicle']->describe_other_pass  }}" name="describe_other_pass" class="form-control" >
                    </div>

                    <div class="form-group col-md-6 col-12 food_pass">
                        <label >Food Pass</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->food_pass != $data['vehicle_history']->food_pass)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : 
                                @if(  $data['vehicle_history']->food_pass== '0')
                                    YES
                                @else
                                    No
                                @endif
                            </div> 
                        @endif
                        <select name="food_pass" id="food_pass" class="form-control" >
                                <option value="0"  <?php if($data['vehicle']->food_pass == '0'){ ?> selected="selected" <?php } ?>>Abu Dhabi</option>
                                <option value="1"  <?php if($data['vehicle']->food_pass == '1'){ ?> selected="selected" <?php } ?>>Dubai</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 pass_validity">
                        <label for="pass-validity">Pass Validity</label>
                        @if($data['vehicle_history'] != null && $data['vehicle']->pass_validity != $data['vehicle_history']->pass_validity)
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : {{ $data['vehicle_history']->pass_validity }} </div> 
                        @endif
                        <input type="date" value="{{ $data['vehicle']->pass_validity }}" name="pass_validity" class="form-control" >
                    </div>

                    <div class="col-md-6 col-12 pass_upload">
                        @if( $data['vehicle']->pass_upload != null)
                            <!-- <div class="col-4">
                                <h5 class=""><b> TRN Copy :</b></h5>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Replace Pass Copy</label>

                                        @if($data['vehicle_history'] != null && $data['vehicle']->pass_upload != $data['vehicle_history']->pass_upload )
                                            <div class="edit-badge"> Edited </div> 
                                            <div class="old-value"> Old file : 
                                                <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle_history']->pass_upload}}" >
                                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                </a>
                                            </div> 
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-11 form-group">  
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload Pass</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="pass_upload">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->pass_upload}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Upload pass_upload</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Pass</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="pass_upload">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            <div id="step-3" class="tab-pane" role="tabpanel">
                <div class="row" >

                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Medical Kit</label>

                            @if($data['equipment']['medical_kit'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['medical_kit'] }} </div> 
                            @endif
                        </div>
                        <select name="medical_kit" id="medical_kit" class="form-control" >
                                <option value="0" <?php if($data['equipment']['medical_kit'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 medical_kit_expiry">
                        <label for="medical-kit-expiry">Medical Kit Expiry Date</label>
                        <input type="date" name="medical_kit_expiry" class="form-control" >
                    </div>

                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Fire Extinguisher</label>
                            @if($data['equipment']['fire_extinguisher'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['fire_extinguisher'] }} </div> 
                            @endif
                        </div>
                        <select name="fire_ext" id="fire_ext" class="form-control" >
                                <option value="0" <?php if($data['equipment']['fire_extinguisher'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 fire_ext_weight">
                        <label for="fire-ext-weight">Fire Extinguisher Weight</label>
                        <input type="text" name="fire_ext_weight" class="form-control" >
                    </div>

                    <div class="form-group col-md-6 col-12 fire_ext_expiry">
                        <label for="fire-ext-expiry">Fire Extinguisher Expiry Date</label>
                        <input type="date" name="fire_ext_expiry" class="form-control" >
                    </div>

                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Jack</label>

                            @if($data['equipment']['jack'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['jack'] }} </div> 
                            @endif
                        </div>
                        <select name="jack" id="" class="form-control" >
                                <option value="0" <?php if($data['equipment']['jack'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12">
                        <label >Spare Wheel</label>
                        
                        <select name="spare_wheel" id="spare_wheel" class="form-control" >
                                <option value="0" >Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 spare_wheel_quantity">
                        <label for="spare-wheel-quantity">Spare Wheel Quantity</label>
                        <input type="text" name="spare_wheel_quantity" class="form-control" >
                    </div>

                    <div class="form-group col-md-6 col-12 spare_wheel_size">
                        <label for="spare-wheel-size">Spare Wheel Size</label>
                        <input type="text"  name="spare_wheel_size" class="form-control" >
                    </div>
                    
                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Safety Triangle</label>

                            @if($data['equipment']['safety_triangle'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['safety_triangle'] }} </div> 
                            @endif
                        </div>
                        <select name="safety_triangle" id="" class="form-control" >
                                <option value="0" <?php if($data['equipment']['safety_triangle'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Extra Emergency Light</label>

                            @if($data['equipment']['emergency_light'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['emergency_light'] }} </div> 
                            @endif
                        </div>
                        <select name="extra_emergency_light" id="" class="form-control" >
                                <option value="0" <?php if($data['equipment']['emergency_light'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Safety Shoes</label>

                            @if($data['equipment']['safety_shoes'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['safety_shoes'] }} </div> 
                            @endif
                        </div>
                        <select name="safety_shoes" id="" class="form-control" >
                                <option value="0" <?php if($data['equipment']['safety_shoes'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Safety Helemt</label>


                            @if($data['equipment']['safety_helemt'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['safety_helemt'] }} </div> 
                            @endif
                        </div>
                        <select name="safety_helmet" id="" class="form-control" >
                                <option value="0" <?php if($data['equipment']['safety_helemt'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Safety Gloves</label>


                            @if($data['equipment']['safety_gloves'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['safety_gloves'] }} </div> 
                            @endif
                        </div>
                        <select name="safety_gloves" id="" class="form-control" >
                                <option value="0" <?php if($data['equipment']['safety_gloves'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Safety Jacket</label>



                            @if($data['equipment']['safety_jacket'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['safety_jacket'] }} </div> 
                            @endif
                        </div>
                        <select name="safety_jacket" id="" class="form-control" >
                                <option value="0" <?php if($data['equipment']['safety_jacket'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Safety Ear Plug</label>



                            @if($data['equipment']['safety_ear_plug'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['safety_ear_plug'] }} </div> 
                            @endif
                        </div>
                        <select name="safety_ear_plug" id="" class="form-control" >
                                <option value="0" <?php if($data['equipment']['safety_ear_plug'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Lashing Belt</label>



                            @if($data['equipment']['lashing_belt_long'] >-1 || $data['equipment']['lashing_belt_short'] >-1)
                                <div class="edit-badge"> Inventory (Long) </div> 
                                <div class="old-value"> {{ $data['equipment']['lashing_belt_long'] }} </div> 

                                <div class="edit-badge"> Inventory (Short) </div> 
                                <div class="old-value"> {{ $data['equipment']['lashing_belt_short'] }} </div>
                            @endif
                        </div>
                        <select name="lashing_belt" id="lashing_belt" class="form-control" >
                                <option value="0" <?php if($data['equipment']['lashing_belt_long'] <=0 || $data['equipment']['lashing_belt_short'] <=0  ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 lashing_belt_quantity_long">
                        <label for="lashing-belt-quantity-long">Lashing Belt Quantity (Long)</label>
                        <input type="text" name="lashing_belt_quantity_long" class="form-control" <?php if($data['equipment']['lashing_belt_long'] <=0 ) { ?> disabled <?php } ?>>
                    </div>
                    <div class="form-group col-md-6 col-12 lashing_belt_quantity_short">
                        <label for="lashing-belt-quantity-short">Lashing Belt Quantity (Short)</label>
                        <input type="text" name="lashing_belt_quantity_short" class="form-control" <?php if($data['equipment']['lashing_belt_short'] <=0  ) { ?> disabled <?php } ?>>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Lashing Chain</label>

                            @if($data['equipment']['lashing_chain'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['lashing_chain'] }} </div> 
                            @endif
                        </div>
                        <select name="lashing_chain" id="lashing_chain" class="form-control" >
                                <option value="0" <?php if($data['equipment']['lashing_chain'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 lashing_chain_quantity">
                        <div class="d-flex">
                            <label for="lashing-chain-quantity">Lashing Chain Quantity</label>
                        </div>
                        <input type="text" name="lashing_chain_quantity" class="form-control" >
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Side Grill</label>


                            @if($data['equipment']['side_grill'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['side_grill'] }} </div> 
                            @endif
                        </div>
                        <select name="side_grill" id="side_grill" class="form-control" >
                                <option value="0" <?php if($data['equipment']['side_grill'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 side_grill_quantity">
                        <label for="side-grill-quantity">Side Grill Quantity</label>
                        <input type="text" name="side_grill_quantity" class="form-control" >
                    </div>
                    <div class="form-group col-md-6 col-12 side_grill_height">
                        <label for="side-grill-height">Side Grill Height</label>
                        <input type="text" name="side_grill_height" class="form-control" >
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Container Lock</label>

                            @if($data['equipment']['container_lock'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['container_lock'] }} </div> 
                            @endif
                        </div>
                        <select name="container_lock" id="" class="form-control" >
                                <option value="0" <?php if($data['equipment']['container_lock'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Rope Seal</label>

                            @if($data['equipment']['rope_seal'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['rope_seal'] }} </div> 
                            @endif
                        </div>
                        <select name="rope_seal" id="" class="form-control" >
                                <option value="0" <?php if($data['equipment']['rope_seal'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Lashing Angle</label>

                            @if($data['equipment']['lashing_angle'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['lashing_angle'] }} </div> 
                            @endif
                        </div>
                        <select name="lashing_angle" id="lashing_angle" class="form-control" >
                                <option value="0" <?php if($data['equipment']['lashing_angle'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 lashing_angle_quantity">
                        <label for="lashing-angle-quantity">Lashing Angle Quantity</label>
                        <input type="text" name="lashing_angle_quantity" class="form-control" >
                    </div>
                    <div class="form-group col-md-6 col-12 lashing_angle_size">
                        <label for="lashing-angle-size">Lashing Angle Size</label>
                        <input type="text" name="lashing_angle_size" class="form-control" >
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Tarpaulin</label>

                            @if($data['equipment']['tarpaulin'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['tarpaulin'] }} </div> 
                            @endif
                        </div>
                        <select name="tarpaulin" id="tarpaulin" class="form-control" >
                                <option value="0" <?php if($data['equipment']['tarpaulin'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 tarpaulin_type">
                        <label for="tarpaulin-type">Tarpaulin Type</label>
                        <input type="text" name="tarpaulin_type" class="form-control" >
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Tail Lift</label>

                            @if($data['equipment']['tail_lift'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['tail_lift'] }} </div> 
                            @endif
                        </div>
                        <select name="tail_lift" id="" class="form-control" >
                                <option value="0" <?php if($data['equipment']['tail_lift'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <div class="d-flex">
                            <label >Trolly</label>

                            @if($data['equipment']['trolly'] >-1)
                                <div class="edit-badge"> Inventory </div> 
                                <div class="old-value"> {{ $data['equipment']['trolly'] }} </div> 
                            @endif
                        </div>
                        <select name="trolly" id="" class="form-control" >
                                <option value="0" <?php if($data['equipment']['trolly'] <= 0 ) { ?> disabled <?php } ?>>Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>


                </div>
            </div>

            <div id="step-4" class="tab-pane" role="tabpanel">
                <div class="row">
                    <div class="col-md-6 col-12 ">
                        @if( $data['vehicle']->front_photo != null)
                            <!-- <div class="col-4">
                                <h5 class=""><b> TRN Copy :</b></h5>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Replace Front Photo Copy</label>

                                        @if($data['vehicle_history'] != null && $data['vehicle']->front_photo != $data['vehicle_history']->front_photo )
                                            <div class="edit-badge"> Edited </div> 
                                            <div class="old-value"> Old file : 
                                                <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle_history']->front_photo}}" >
                                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                </a>
                                            </div> 
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-11 form-group">  
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload Front Photo</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="front_photo">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->front_photo}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Upload front_photo</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Front Photo</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="front_photo">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>


                    <div class="col-md-6 col-12 ">
                        @if( $data['vehicle']->right_photo != null)
                            <!-- <div class="col-4">
                                <h5 class=""><b> TRN Copy :</b></h5>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Replace Right Photo Copy</label>

                                        @if($data['vehicle_history'] != null && $data['vehicle']->right_photo != $data['vehicle_history']->right_photo )
                                            <div class="edit-badge"> Edited </div> 
                                            <div class="old-value"> Old file : 
                                                <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle_history']->right_photo}}" >
                                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                </a>
                                            </div> 
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-11 form-group">  
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload Right Photo</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="right_photo">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->right_photo}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Upload right_photo</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Right Photo</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="right_photo">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-6 col-12 ">
                        @if( $data['vehicle']->left_photo != null)
                            <!-- <div class="col-4">
                                <h5 class=""><b> TRN Copy :</b></h5>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Replace Left Photo Copy</label>

                                        @if($data['vehicle_history'] != null && $data['vehicle']->left_photo != $data['vehicle_history']->left_photo )
                                            <div class="edit-badge"> Edited </div> 
                                            <div class="old-value"> Old file : 
                                                <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle_history']->left_photo}}" >
                                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                </a>
                                            </div> 
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-11 form-group">  
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload Left Photo</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="left_photo">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->left_photo}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Upload left_photo</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Left Photo</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="left_photo">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    
                    <div class="col-md-6 col-12 ">
                        @if( $data['vehicle']->back_photo != null)
                            <!-- <div class="col-4">
                                <h5 class=""><b> TRN Copy :</b></h5>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Replace Back Photo Copy</label>

                                        @if($data['vehicle_history'] != null && $data['vehicle']->back_photoo != $data['vehicle_history']->back_photo )
                                            <div class="edit-badge"> Edited </div> 
                                            <div class="old-value"> Old file : 
                                                <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle_history']->back_photo}}" >
                                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                </a>
                                            </div> 
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-11 form-group">  
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload Back Photo</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="back_photo">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->back_photo}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Upload Back Photo</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Back Photo</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="back_photo">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            <div id="step-5" class="tab-pane" role="tabpanel">
                <div class="row">
                    
                    <div class="col-md-6 col-12 insurance_form">
                        @if( $data['vehicle']->equipment_photo != null)
                            <!-- <div class="col-4">
                                <h5 class=""><b> TRN Copy :</b></h5>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Replace Equipment Photo Copy</label>

                                        @if($data['vehicle_history'] != null && $data['vehicle']->equipment_photo != $data['vehicle_history']->equipment_photo )
                                            <div class="edit-badge"> Edited </div> 
                                            <div class="old-value"> Old file : 
                                                <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle_history']->equipment_photo}}" >
                                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                </a>
                                            </div> 
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-11 form-group">  
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload Equipment Photo</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="equipment_photo">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->equipment_photo}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Upload Equipment Photo</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Equipment Photo</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="equipment_photo">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

            <div id="step-6" class="tab-pane" role="tabpanel">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value='approved' <?php if($data['vehicle']->status == 'approved') echo 'selected="selected"' ?> >Approved</option>
                                <option value='rejected' <?php if($data['vehicle']->status == 'rejected') echo 'selected="selected"' ?>>Rejected</option>
                                <option value='pending' <?php if($data['vehicle']->status == 'pending') echo 'selected="selected"' ?>>Pending</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>


        </div>
    </div>
    </form>
    

       
        
        


        
        

        
        
</div>

<script>
     $('#smartwizard').smartWizard({
            theme: 'default',
            toolbarSettings: {
                toolbarPosition: 'bottom', // none, top, bottom, both
                toolbarButtonPosition: 'right', // left, right, center
                showNextButton: true, // show/hide a Next button
                showPreviousButton: true, // show/hide a Previous button
                toolbarExtraButtons: [] ,// Extra buttons to show on toolbar, array of jQuery input/buttons elements
               
            },
            anchorSettings: {
                    anchorClickable: true, // Enable/Disable anchor navigation
                    enableAllAnchors: true, // Activates all anchors clickable all times
                    markDoneStep: true, // Add done css
                    markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                    removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                    enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                    },
    });

    $('#smartwizard').smartWizard("reset");

        $( "#select_vehicle" ).change(function() 
        {
            $.ajax({
                    url: "{{ route('admin.purchase.get_purchase_vehicle') }}",
                    type: 'GET',
                    data: { id: $(this).val() },
                    success: function(data)
                    {
                        $('.approx_value').show();
                    $('.approx_value input').val(data.total_amount);
                    $(".approx_value input").prop("readonly", true);

                    $('.make').show();
                    $('.make input').val(data.make);
                    $(".make input").prop("readonly", true);

                    $('.model').show();
                    $('.model input').val(data.model);
                    $(".model input").prop("readonly", true);

                    $('.color').show();
                    $('.color input').val(data.color);
                    $(".color input").prop("readonly", true);
                    $("#registration_type  option").removeAttr('selected', true);

                    $("#registration_type  option[value='"+data.vechicle_type+"']").attr('selected', true);


                    if(data.vechicle_type == 'vehicle'){
                        $('#equipment_detail').show();
                        $('.vehicle_number').show();

                       

                        $('.engine_number').show();
                        $('.engine_number input').val(data.engine_number);
                        $(".engine_number input").prop("readonly", true);

                        
                        $('.vehicle_suspension').show();
                        $(".vehicle_suspension select option[value='"+data.vehicle_suspension+"']").prop('selected', true);

                        $('.chassis_number').hide();

                        $('.vehicle_type').show();

                        $('.truck_type').show();
                        $('.pickup_weight').show();
                        $('.pickup_shape').show();
                        $('.car_description').show();
                        $('.salik').show();
                        $('.trailer_type').val('');
                        $('.trailer_type').hide();
                        $('.trailer_suspension').val('');
                        $('.trailer_suspension').hide();
                        $('.size').val('');
                        $('.size').hide();
                        $('.axle').val('');
                        $('.axle').hide();
                        $('.ton_capacity').val('');
                        $('.ton_capacity').hide();
                        $('.vehicle_insurance').show();
                        $('.policy_number').show();
                        $('.insurance_expiry').show();
                        $('.insurance_form').show();
                        $('.other_insurance').show();
                        $('.other_insurance_expiry').show();
                        $('.other_insurance_form').show();
                        $('.other_insurance_description').show();
                    }

                    if(data.vechicle_type == 'trailer'){
                        $('#equipment_detail').hide();


                        $('.chassis_number').show();
                        $('.chassis_number input').val(data.chassis_no);
                        $(".chassis_number input").prop("readonly", true);

                        $('.size').show();
                        $('.size input').val(data.size);
                        $(".size input").prop("readonly", true);

                        $('.axle').show();
                        $('.axle input').val(data.axle);
                        $(".axle input").prop("readonly", true);

                        $('.trailer_type').show();
                        $(".trailer_type select option[value='"+data.trailer_type+"']").prop('selected', true);

                        $('.trailer_suspension').show();
                        $(".trailer_suspension select option[value='"+data.vehicle_suspension+"']").prop('selected', true);


                        $('.vehicle_number').val('');
                        $('.vehicle_number').hide();
                        
                        $('.engine_number').val('');
                        $('.engine_number').hide();

                        $('.vehicle_type').val('');
                        $('.vehicle_type').hide();

                        $('.truck_type').val('');
                        $('.truck_type').hide();

                        $('.pickup_weight').val('');
                        $('.pickup_weight').hide();

                        $('.pickup_shape').val('');
                        $('.pickup_shape').hide();

                        $('.car_description').val('');
                        $('.car_description').hide();

                        $('.vehicle_suspension').val('');
                        $('.vehicle_suspension').hide();

                        $('.salik').val('');
                        $('.salik').hide();

                        

                        
                        $('.ton_capacity').show();
                        $('.vehicle_insurance').val('');
                        $('.vehicle_insurance').hide();
                        $('.policy_number').val('');
                        $('.policy_number').hide();
                        $('.insurance_expiry').val('');
                        $('.insurance_expiry').hide();
                        $('.insurance_form').val('');
                        $('.insurance_form').hide();
                        $('.other_insurance').val('');
                        $('.other_insurance').hide();
                        $('.other_insurance_expiry').val('');
                        $('.other_insurance_expiry').hide();
                        $('.other_insurance_form').val('');
                        $('.other_insurance_form').hide();
                        $('.other_insurance_description').val('');
                        $('.other_insurance_description').hide();
                    }
                }
        });
    });


    $('#vehicle_type').on('change', function()

        {
            if(this.value == 'truck'){
                $('.truck_type').show();
                $('.pickup_weight').val('');
                $('.pickup_weight').hide();
                $('.pickup_shape').val('');
                $('.pickup_shape').hide();
                $('.car_description').val('');
                $('.car_description').hide();
            }

            if(this.value == 'pickup'){
                $('.pickup_weight').show();
                $('.pickup_shape').show();
                $('.truck_type').val('');
                $('.truck_type').hide();
                $('.car_description').val('');
                $('.car_description').hide();
            }
            if(this.value == 'car'){
                $('.car_description').show();
                $('.pickup_weight').val('');
                $('.pickup_weight').hide();
                $('.pickup_shape').val('');
                $('.pickup_shape').hide();
                $('.truck_type').val('');
                $('.truck_type').hide();
            }
            
        });

    $('#registration_type').on('change', function()
    {
        if(this.value == 'vehicle'){
            $('#equipment_detail').show();
            $('.vehicle_number').show();
            
            $('.engine_number').show();
            $('.vehicle_type').show();
            $('.truck_type').show();
            $('.pickup_weight').show();
            $('.pickup_shape').show();
            $('.car_description').show();
            $('.vehicle_suspension').show();
            $('.salik').show();
            $('.trailer_type').val('');
            $('.trailer_type').hide();
            $('.trailer_suspension').val('');
            $('.trailer_suspension').hide();
            $('.size').val('');
            $('.size').hide();
            $('.axle').val('');
            $('.axle').hide();
            $('.ton_capacity').val('');
            $('.ton_capacity').hide();
            $('.vehicle_insurance').show();
            $('.policy_number').show();
            $('.insurance_expiry').show();
            $('.insurance_form').show();
            $('.other_insurance').show();
            $('.other_insurance_expiry').show();
            $('.other_insurance_form').show();
            $('.other_insurance_description').show();
        }

        if(this.value == 'trailer'){
            $('#equipment_detail').hide();

            $('.vehicle_number').val('');
            $('.vehicle_number').hide();
            
            $('.engine_number').val('');
            $('.engine_number').hide();
            $('.vehicle_type').val('');
            $('.vehicle_type').hide();
            $('.truck_type').val('');
            $('.truck_type').hide();
            $('.pickup_weight').val('');
            $('.pickup_weight').hide();
            $('.pickup_shape').val('');
            $('.pickup_shape').hide();
            $('.car_description').val('');
            $('.car_description').hide();
            $('.vehicle_suspension').val('');
            $('.vehicle_suspension').hide();
            $('.salik').val('');
            $('.salik').hide();
            $('.trailer_type').show();
            $('.trailer_suspension').show();
            $('.size').show();
            $('.axle').show();
            $('.ton_capacity').show();
            $('.vehicle_insurance').val('');
            $('.vehicle_insurance').hide();
            $('.policy_number').val('');
            $('.policy_number').hide();
            $('.insurance_expiry').val('');
            $('.insurance_expiry').hide();
            $('.insurance_form').val('');
            $('.insurance_form').hide();
            $('.other_insurance').val('');
            $('.other_insurance').hide();
            $('.other_insurance_expiry').val('');
            $('.other_insurance_expiry').hide();
            $('.other_insurance_form').val('');
            $('.other_insurance_form').hide();
            $('.other_insurance_description').val('');
            $('.other_insurance_description').hide();
        }
    });

    $('#vehicle_insurance').on('change', function()
    {
        if(this.value == '0'){
            $('.policy_number').show();
            $('.insurance_expiry').show();
            $('.insurance_form').show();
            $('.other_insurance').show();
            $('.other_insurance_expiry').show();
            $('.other_insurance_form').show();
            $('.other_insurance_description').show();
        }

        if(this.value == '1'){
            $('.policy_number').val('');
            $('.policy_number').hide();
            $('.insurance_expiry').val('');
            $('.insurance_expiry').hide();
            $('.insurance_form').val('');
            $('.insurance_form').hide();
            $('.other_insurance').val('');
            $('.other_insurance').hide();
            $('.other_insurance_expiry').val('');
            $('.other_insurance_expiry').hide();
            $('.other_insurance_form').val('');
            $('.other_insurance_form').hide();
            $('.other_insurance_description').val('');
            $('.other_insurance_description').hide();
        }
    });


    $('#other_insurance').on('change', function()
    {
        if(this.value == '0'){
            $('.other_insurance_expiry').show();
            $('.other_insurance_form').show();
            $('.other_insurance_description').show();
        }

        if(this.value == '1'){
            $('.other_insurance_expiry').val('');
            $('.other_insurance_expiry').hide();
            $('.other_insurance_form').val('');
            $('.other_insurance_form').hide();
            $('.other_insurance_description').val('');
            $('.other_insurance_description').hide();
        }
    });

    $('#j_ali_tag').on('change', function()
    {
        if(this.value == '0'){
            $('.j_ali_tag_expiry').show();
            $('.j_ali_tag_upload').show();
        }

        if(this.value == '1'){
            $('.j_ali_tag_expiry').val('');
            $('.j_ali_tag_expiry').hide();
            $('.j_ali_tag_upload').val('');
            $('.j_ali_tag_upload').hide();
        }
    });

    $('#kp_tag').on('change', function()
    {
        if(this.value == '0'){
            $('.kp_tag_expiry').show();
            $('.kp_tag_upload').show();
        }

        if(this.value == '1'){
            $('.kp_tag_expiry').val('');
            $('.kp_tag_expiry').hide();
            $('.kp_tag_upload').val('');
            $('.kp_tag_upload').hide();
        }
    });

    $('#other_tag').on('change', function()
    {
        if(this.value == '0'){
            $('.other_tag_description').show();
            $('.other_tag_expiry').show();
            $('.other_tag_upload').show();
        }

        if(this.value == '1'){
            $('.other_tag_description').val('');
            $('.other_tag_description').hide();
            $('.other_tag_expiry').val('');
            $('.other_tag_expiry').hide();
            $('.other_tag_upload').val('');
            $('.other_tag_upload').hide();
        }
    });

    $('#sticker').on('change', function()
    {
        if(this.value == '0'){
            $('.sticker_description').show();
            $('.sticker_validity').show();
            $('.sticker_upload').show();
        }

        if(this.value == '1'){
            $('.sticker_description').val('');
            $('.sticker_description').hide();
            $('.sticker_validity').val('');
            $('.sticker_validity').hide();
            $('.sticker_upload').val('');
            $('.sticker_upload').hide();
        }
    });

    $('#pass').on('change', function()
    {
        if(this.value == '0'){
            $('.pass_description').show();
            $('.food_pass').show();
            $('.pass_validity').show();
            $('.pass_upload').show();
        }

        if(this.value == '1'){
            $('.pass_description').val('');
            $('.pass_description').hide();
            $('.food_pass').val('');
            $('.food_pass').hide();
            $('.pass_validity').val('');
            $('.pass_validity').hide();
            $('.pass_upload').val('');
            $('.pass_upload').hide();
            
        }
    });

    $('#pass_description').on('change', function()
    {
        if(this.value == '0'){         
            $('.food_pass').show();
        }
        else{          
            $('.food_pass').val('');
            $('.food_pass').hide();
        }

        if(this.value == '6'){
            $('.describe_other_pass').show();
        }
        else{
            $('.describe_other_pass').val('');
            $('.describe_other_pass').hide();
        }
    });

    $('#sticker_description').on('change', function()
    {
        if(this.value == '3'){         
            $('.describe_other_sticker').show();
        }
        else{          
            $('.describe_other_sticker').val('');
            $('.describe_other_sticker').hide();
        }
    });

    $('#medical_kit').on('change', function()
    {
        if(this.value == '0'){         
            $('.medical_kit_expiry').show();
        }
        else{          
            $('.medical_kit_expiry').val('');
            $('.medical_kit_expiry').hide();
        }
    });

    $('#fire_ext').on('change', function()
    {
        if(this.value == '0'){         
            $('.fire_ext_weight').show();
            $('.fire_ext_expiry').show();
        }
        else{          
            $('.fire_ext_weight').val('');
            $('.fire_ext_weight').hide();
            $('.fire_ext_expiry').val('');
            $('.fire_ext_expiry').hide();
        }
    });

    $('#spare_wheel').on('change', function()
    {
        if(this.value == '0'){         
            $('.spare_wheel_quantity').show();
            $('.spare_wheel_size').show();
        }
        else{          
            $('.spare_wheel_quantity').val('');
            $('.spare_wheel_quantity').hide();
            $('.spare_wheel_size').val('');
            $('.spare_wheel_size').hide();
        }
    });

    $('#lashing_belt').on('change', function()
    {
        if(this.value == '0'){         
            $('.lashing_belt_quantity_long').show();
            $('.lashing_belt_quantity_short').show();
        }
        else{          
            $('.lashing_belt_quantity_long').val('');
            $('.lashing_belt_quantity_long').hide();
            $('.lashing_belt_quantity_short').val('');
            $('.lashing_belt_quantity_short').hide();
        }
    });

    $('#lashing_chain').on('change', function()
    {
        if(this.value == '0'){         
            $('.lashing_chain_quantity').show();
        }
        else{          
            $('.lashing_chain_quantity').val('');
            $('.lashing_chain_quantity').hide();
        }
    });

    $('#side_grill').on('change', function()
    {
        if(this.value == '0'){         
            $('.side_grill_quantity').show();
            $('.side_grill_height').show();
        }
        else{          
            $('.side_grill_quantity').val('');
            $('.side_grill_quantity').hide();
            $('.side_grill_height').val('');
            $('.side_grill_height').hide();
        }
    });

    $('#lashing_angle').on('change', function()
    {
        if(this.value == '0'){         
            $('.lashing_angle_quantity').show();
            $('.lashing_angle_size').show();
        }
        else{          
            $('.lashing_angle_quantity').val('');
            $('.lashing_angle_quantity').hide();
            $('.lashing_angle_size').val('');
            $('.lashing_angle_size').hide();
        }
    });

    $('#lashing_angle').on('change', function()
    {
        if(this.value == '0'){         
            $('.lashing_angle_quantity').show();
            $('.lashing_angle_size').show();
        }
        else{          
            $('.lashing_angle_quantity').val('');
            $('.lashing_angle_quantity').hide();
            $('.lashing_angle_size').val('');
            $('.lashing_angle_size').hide();
        }
    });

    $('#tarpaulin').on('change', function()
    {
        if(this.value == '0'){         
            $('.tarpaulin_type').show();
        }
        else{          
            $('.tarpaulin_type').val('');
            $('.tarpaulin_type').hide();
        }
    });


    

</script> 