<?php 
use App\Models\Company_name;
?>
<div class="container mt-3">
    <div class="mb-5">
            <a href="{{route('admin.vehicle.register_new_vehicle')}}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
    </div>
    <form action="{{ route('admin.vehicle.save_vehicle') }}" method="post" enctype="multipart/form-data">
        @csrf
        <?php if( $data['vehicle_mode'] == 'own_vechicle'){  ?>
            <input type="text" name="own_vehicle" value="1" class="d-none">
        <?php } elseif ($data['vehicle_mode'] == 'new_vechicle') { ?>
            <input type="text" name="register_vehicle" value="1" class="d-none">
        <?php } ?>
    <div id="smartwizard">
        <ul class="nav">
            <li>
                <a class="nav-link" href="#step-1">
                    VEHICLE DETAILS 

                </a>
            </li>
            <li>
                <a class="nav-link" href="#step-2">
                    PASS/TAG/INSURANCE DETAILS  
                </a>
            </li>
            <li >
                <a class="nav-link" href="#step-3">
                    EQUIPMENT DETAILS 
                </a>
            </li>
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
        </ul>
        <div class="tab-content">
           
            <div id="step-1" class="tab-pane" role="tabpanel">
                <div class="row">
                    @if($data['vehicle_mode'] == 'new_vechicle')
                    <div class="form-group col-md-6 col-12">
                        <label >Select Vehicle or Trailer</label>
                        <select name="select_vehicle" id="select_vehicle" class="form-control" placeholder="" >
                            @foreach($data['purchase_vehicle'] as $purchase_vehicle)
                            @if($purchase_vehicle->status_admin == 'approved' && $purchase_vehicle->status_account == 'approved' && $purchase_vehicle->row_status != 'deleted')
                                <option value="{{ $purchase_vehicle->id }}" >{{ $purchase_vehicle->vechicle_type }} | 
                                    <?php if($purchase_vehicle->vechicle_type == 'vehicle'){ ?>Engine No <?php } else { ?>Chasis No <?php } ?>
                                    : <?php if($purchase_vehicle->vechicle_type == 'vehicle'){ ?> {{ $purchase_vehicle->engine_number }} <?php } else { ?>{{ $purchase_vehicle->chassis_no }} <?php } ?>
                                </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="form-group col-md-6 col-12 <?php if($data['vehicle_mode'] == 'new_vechicle'){ ?> d-none <?php } ?>" >
                        <label >Registration Type</label>
                        <select name="registration_type" id="registration_type" class="form-control" placeholder="" >
                                <option value="vehicle" >Vehicle</option>
                                <option value="trailer">Trailer</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 vehicle_number">
                        <label for="vehicle-number">Vehicle Number</label>
                        <input type="text" name="vehicle_number" class="form-control" >
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label for="company-name">Company Name</label>
                        <select name="company_id" class="form-control" required>
                            @foreach(Company_name::all() as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 approx_value">
                        <label for="approx-value">Approx. Value</label>
                        <input type="text" name="approx_value" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label for="registration-date">Registration Date</label>
                        <input type="date" name="registration_date" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label for="registration-expiry-date">Registration Expiry Date</label>
                        <input type="date" name="registration_exp_date" class="form-control" required>
                    </div>
                    <div class=" col-md-6 col-12">
                        <div class="form-group">
                            <label>Upload Registration</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload Registration</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="regisration_form" required>
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12 make">
                        <label for="make">Make</label>
                        <input type="text" name="make" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6 col-12 model">
                        <label for="model">Model</label>
                        <input type="text" name="model" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6 col-12 color">
                        <label for="colour">Color</label>
                        <input type="text" name="colour" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6 col-12 engine_number">
                        <label for="engine-number">Engine Number</label>
                        <input type="text" name="engine_number" class="form-control" >
                    </div>
                    <div class="form-group col-md-6 col-12 chassis_number">
                        <label for="chassis-number">Chassis Number</label>
                        <input type="text" name="chassis_number" class="form-control" >
                    </div>
                    <div class="form-group col-md-6 col-12 vehicle_type">
                        <label >Vehicle Type</label>
                        <select name="vehicle_type" id="vehicle_type" class="form-control" >
                                <option value="truck" selected="selected">Truck</option>
                                <option value="pickup">Pickup</option>
                                <option value="car">Car</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 truck_type">
                        <label >Truck</label>
                        <select name="truck_type" id="truck_type" class="form-control" >
                            <option value="flatbed" >FLATBED</option>
                            <option value="curtain_side">Curtain Side</option>
                            <option value="tripper_2xl">Tipper 2XL</option>
                            <option value="tripper_3xl">Tipper 3XL</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 pickup_weight">
                        <label >Pickup (weight)</label>
                        <select name="pickup_weight" id="pickup_weight" class="form-control" >
                                <option value="1_tone" >1 Ton</option>
                                <option value="3_tone" >3 Ton</option>
                                <option value="7_tone">7 Ton</option>
                                <option value="10_tone">10 Ton</option>
                                <option value="15_tone">15 Ton</option>

                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 pickup_shape">
                        <label >Pickup (shape)</label>
                        <select name="pickup_shape" id="pickup_weight" class="form-control" >
                                <option value="side_grill" >Side Grill</option>
                                <option value="dry_box">Dry Box</option>
                                <option value="chiller">Chiller</option>
                                <option value="freezer">Freezer</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 car_description">
                        <label for="car-description">Car Description</label>
                        <input type="text" name="car_description" class="form-control" >
                    </div>
                    <div class="form-group col-md-6 col-12 vehicle_suspension">
                        <label >Vehicle  Suspension</label>
                        <select name="vehicle_suspension" id="" class="form-control" >
                            <option value="booster" >Booster</option>
                            <option value="kamani">Kamani</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 salik">
                        <label >Salik</label>
                        <select name="salik" id="" class="form-control" >
                                <option value="0" selected="selected">Yes</option>
                                <option value="1">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 trailer_type">
                        <label >Trailer Type</label>
                        <select name="trailer_type" id="" class="form-control" >
                            <option value="flatbed" >FLATBED</option>
                            <option value="curtain_side">Curtain Side</option>
                            <option value="tripper_2xl">Tipper 2XL</option>
                            <option value="tripper_3xl">Tipper 3XL</option>

                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 trailer_suspension">
                        <label >Trailer  Suspension</label>
                        <select name="trailer_suspension" id="" class="form-control" >
                                <option value="booster" >Booster</option>
                                <option value="kamani">Kamani</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-12 size">
                        <label for="size">Size(meter/feet)</label>
                        <input type="text" name="trailer_size" class="form-control" >
                    </div>
                    <div class="form-group col-md-6 col-12 axle">
                        <label >Axle</label>
                        <input type="number" name="axle" class="form-control" >

                    </div>
                    <div class="form-group col-md-6 col-12 ton_capacity">
                        <label for="ton-capacity">Maximum Ton Capacity</label>
                        <input type="text" name="ton_capacity" class="form-control" >
                    </div>
                </div>
            </div>
            <div id="step-2" class="tab-pane" role="tabpanel">
                <div class="row">
                    <div class="form-group col-md-6 col-12 vehicle_insurance">
                        <label >Vehicle Insurance</label>
                        <select name="vehicle_insurance" id="vehicle_insurance" class="form-control" >
                                <option value="0" >Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 policy_number">
                        <label for="policy-number">Policy Number</label>
                        <input type="text" name="insurance_policy_number" class="form-control" >
                    </div>
                    <div class="form-group col-md-6 col-12 insurance_expiry">
                        <label for="insurance-expiry">Insurance Expiry Date</label>
                        <input type="date" name="insurance_expiry" class="form-control" >
                    </div>
                    <div class=" col-md-6 col-12 insurance_form">
                        <div class="form-group">
                            <label>Upload Insurance</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload Insurance</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="insurance_form" >
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12 other_insurance">
                        <label >other Insurance</label>
                        <select name="other_insurance" id="other_insurance" class="form-control" >
                                <option value="0" >Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 other_insurance_expiry">
                        <label for="other-insurance-expiry">Other Insurance Expiry Date</label>
                        <input type="date" name="other_insurance_expiry" class="form-control" >
                    </div>
                    <div class=" col-md-6 col-12 other_insurance_form">
                        <div class="form-group">
                            <label>Upload Other Insurance</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload Other Insurance</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="other_insurance_form" >
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6 col-12 other_insurance_description">
                        <label for="other-insurance-descripiton">Other Insurance Description</label>
                        <input type="text" name="other_insurance_description" class="form-control" >
                    </div>

                    <!-- Tags -->

                    <div class="form-group col-md-6 col-12">
                        <label >J-Ali Tag</label>
                        <select name="j_ali_tag" id="j_ali_tag" class="form-control" >
                                <option value="0">Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 j_ali_tag_expiry">
                        <label for="j-ali-tag-expiry">J-Ali Tag Expiry Date</label>
                        <input type="date" name="j_ali_tag_expiry" class="form-control" >
                    </div>
                    <div class=" col-md-6 col-12 j_ali_tag_upload">
                        <div class="form-group">
                            <label>Upload J-Ali Tag</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload J-Ali Tag</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="j_ali_tag_upload" >
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6 col-12">
                        <label >KP Tag</label>
                        <select name="kp_tag" id="kp_tag" class="form-control" >
                                <option value="0" >Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 kp_tag_expiry">
                        <label for="kp-tag-expiry">KP Tag Expiry Date</label>
                        <input type="date" name="kp_tag_expiry" class="form-control" >
                    </div>
                    <div class=" col-md-6 col-12 kp_tag_upload">
                        <div class="form-group">
                            <label>Upload KP Tag</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload KP Tag</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="kp_tag_upload" >
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-6 col-12">
                        <label >Other Tag</label>
                        <select name="other_tag" id="other_tag" class="form-control" >
                                <option value="0" >Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 other_tag_description">
                        <label for="other-tag-description">Other Tag Description</label>
                        <input type="text" name="other_tag_description" class="form-control" >
                    </div>
                    <div class="form-group col-md-6 col-12 other_tag_expiry">
                        <label for="other-tag-expiry">Other Tag Expiry Date</label>
                        <input type="date" name="other_tag_expiry" class="form-control" >
                    </div>
                    <div class=" col-md-6 col-12 other_tag_upload">
                        <div class="form-group">
                            <label>Upload Other Tag</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload Other Tag</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="other_tag_upload" >
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stickers -->

                    <div class="form-group col-md-6 col-12">
                        <label >Sticker</label>
                        <select name="sticker" id="sticker" class="form-control" >
                                <option value="0" >Yes</option>
                                <option value="1" selected="selected">No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 sticker_description">
                        <label >Sticker Description</label>
                        <select name="sticker_description" id="sticker_description" class="form-control" >
                                <option value="salik" selected="selected">Salik</option>
                                <option value="darb">Darb</option>
                                <option value="ad_port">AD Ports</option>
                                <option value="other">Others</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 describe_other_sticker">
                        <label for="describe-other-sticker">Describe Other Sticker</label>
                        <input type="text" name="describe_other_sticker" class="form-control" >
                    </div>
                    <div class="form-group col-md-6 col-12 sticker_validity">
                        <label for="sticker-validity">Sticker Validity</label>
                        <input type="date" name="sticker_validity" class="form-control" >
                    </div>
                    <div class=" col-md-6 col-12 sticker_upload">
                        <div class="form-group">
                            <label>Upload Sticker</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload Sticker</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="sticker_upload" >
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Passes -->

                    <div class="form-group col-md-6 col-12">
                        <label >Pass</label>
                        <select name="pass" id="pass" class="form-control" >
                                <option value="0" >Yes</option>
                                <option value="1" selected="selected" >No</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 pass_description">
                        <label >Pass Description</label>
                        <select name="pass_description" id="pass_description" class="form-control" >
                                <option value="food_pass" selected="selected">Food Pass</option>
                                <option value="j_ali">J-Ali Pass</option>
                                <option value="emal2">Emal Pass</option>
                                <option value="dubal">Dubal Pass</option>
                                <option value="kp">KP Pass</option>
                                <option value="mina_zayed">Mina Zayed Pass</option>
                                <option value="other">Other Pass</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 describe_other_pass">
                        <label for="describe-other-pass">Describe Other Pass</label>
                        <input type="text" name="describe_other_pass" class="form-control" >
                    </div>

                    <div class="form-group col-md-6 col-12 food_pass">
                        <label >Food Pass</label>
                        <select name="food_pass" id="food_pass" class="form-control" >
                                <option value="0" selected="selected">Abu Dhabi</option>
                                <option value="1">Dubai</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-12 pass_validity">
                        <label for="pass-validity">Pass Validity</label>
                        <input type="date" name="pass_validity" class="form-control" >
                    </div>
                    <div class=" col-md-6 col-12 pass_upload">
                        <div class="form-group">
                            <label>Upload Pass</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload Pass</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="pass_upload" >
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
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
                    <div class=" col-md-6 col-12">
                        <div class="form-group">
                            <label>Front Photo</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Front photo</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="front_photo" >
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-6 col-12">
                        <div class="form-group">
                            <label>Right Photo</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Right Photo</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="right_photo" >
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-6 col-12">
                        <div class="form-group">
                            <label>Left Photo</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Left Photo</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="left_photo" >
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" col-md-6 col-12">
                        <div class="form-group">
                            <label>Back Photo</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Back Photo</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="back_photo" >
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="step-5" class="tab-pane" role="tabpanel">
                <div class="row">
                    <div class=" col-md-6 col-12">
                        <div class="form-group">
                            <label>Equipment Photo</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Equipment Photo</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="equipment_photo">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
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