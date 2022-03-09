<?php 
use App\Models\Purchase_mertial_data;
use App\Models\Supplier_info;
use App\Models\Company_name;

?>

<div class="container">
   
    <div class="row mb-5">
        <div class="col-4">
            <a href="{{ route( 'user.vehicle.view_vehicle') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>      
        </div>
    </div>
    <form action="{{ route('user.hr_pro.save_mobile_civil_defence') }}" method="post" enctype="multipart/form-data">
        @csrf

        <h4> Vehicle Details  </h4>
        <div class="row">
            <div class="form-group col-md-6 col-12">
                <label >Registration Type</label>
                <select name="registration_type" id="registration_type" class="form-control" >
                        <option value="0" selected="selected">Vehicle</option>
                        <option value="1">Trailer</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 vehicle_number">
                <label for="vehicle-number">Vehicle Number</label>
                <input type="text" name="vehicle_number" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="company-name">Company Name</label>
                <input type="text" name="company_name" class="form-control" required>
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
            <div class="form-group col-md-6 col-12">
                <label for="make">Make</label>
                <input type="text" name="make" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="model">Model</label>
                <input type="text" name="model" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="colour">Colour</label>
                <input type="text" name="colour" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12 engine_number">
                <label for="engine-number">Engine Number</label>
                <input type="text" name="engine_number" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="chassis-number">Chassis Number</label>
                <input type="text" name="chassis_number" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12 vehicle_type">
                <label >Vehicle Type</label>
                <select name="vehicle_type" id="vehicle_type" class="form-control" >
                        <option value="0" selected="selected">Truck</option>
                        <option value="1">Pickup</option>
                        <option value="2">Car</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 truck_type">
                <label >Truck</label>
                <select name="truck_type" id="truck_type" class="form-control" >
                        <option value="0" selected="selected">Tipper 2XL</option>
                        <option value="1">Tipper 3XL</option>
                        <option value="2">FLATBED</option>
                        <option value="2">Curtain</option>
                        <option value="2">Other</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 pickup_weight">
                <label >Pickup (weight)</label>
                <select name="pickup_weight" id="pickup_weight" class="form-control" >
                        <option value="0" selected="selected">3 Ton</option>
                        <option value="1">7 Ton</option>
                        <option value="2">10 Ton</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 pickup_shape">
                <label >Pickup (shape)</label>
                <select name="pickup_shape" id="pickup_weight" class="form-control" >
                        <option value="0" selected="selected">Side Grill</option>
                        <option value="1">Dry Box</option>
                        <option value="2">Chiller</option>
                        <option value="2">Freezer</option>
                        <option value="2">Other</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 car_description">
                <label for="car-description">Car Description</label>
                <input type="text" name="car_description" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12 vehicle_suspension">
                <label >Vehicle  Suspension</label>
                <select name="vehicle_suspension" id="" class="form-control" >
                        <option value="0" selected="selected">Booster</option>
                        <option value="1">Kamani</option>
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
                    <option value="0" selected="selected">Flat</option>
                    <option value="1">Curtain Side</option>
                    <option value="1">Tipper</option>
                    <option value="1">Other</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 trailer_suspension">
                <label >Trailer  Suspension</label>
                <select name="trailer_suspension" id="" class="form-control" >
                        <option value="0" selected="selected">Booster</option>
                        <option value="1">Kamani</option>
                </select>
            </div>

            <div class="form-group col-md-6 col-12 size">
                <label for="size">Size(meter/feet)</label>
                <input type="text" name="size" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12 axle">
                <label >Axle</label>
                <select name="axle" id="" class="form-control" >
                        <option value="0" selected="selected">1</option>
                        <option value="1">2</option>
                        <option value="1">3</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 ton_capacity">
                <label for="ton-capacity">Maximum Ton Capacity</label>
                <input type="text" name="ton_capacity" class="form-control" required>
            </div>
        </div>

        <hr class="mt-4">
        <h4>Vehicle Pass/Tags/Stickers/Insurance Details</h4>

        <div class="row">
            <div class="form-group col-md-6 col-12 vehicle_insurance">
                <label >Vehicle Insurance</label>
                <select name="vehicle_insurance" id="vehicle_insurance" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 policy_number">
                <label for="policy-number">Policy Number</label>
                <input type="text" name="policy_number" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12 insurance_expiry">
                <label for="insurance-expiry">Insurance Expiry Date</label>
                <input type="date" name="insurance_expiry" class="form-control" required>
            </div>
            <div class=" col-md-6 col-12 insurance_form">
                <div class="form-group">
                    <label>Upload Insurance</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Insurance</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="insurance_form" required>
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6 col-12 other_insurance">
                <label >other Insurance</label>
                <select name="other_insurance" id="other_insurance" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 other_insurance_expiry">
                <label for="other-insurance-expiry">Other Insurance Expiry Date</label>
                <input type="date" name="other_insurance_expiry" class="form-control" required>
            </div>
            <div class=" col-md-6 col-12 other_insurance_form">
                <div class="form-group">
                    <label>Upload Other Insurance</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Other Insurance</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="other_insurance_form" required>
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6 col-12 other_insurance_description">
                <label for="other-insurance-descripiton">Other Insurance Description</label>
                <input type="text" name="other_insurance_description" class="form-control" required>
            </div>

            <!-- Tags -->

            <div class="form-group col-md-6 col-12">
                <label >J-Ali Tag</label>
                <select name="j_ali_tag" id="j_ali_tag" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 j_ali_tag_expiry">
                <label for="j-ali-tag-expiry">J-Ali Tag Expiry Date</label>
                <input type="date" name="j_ali_tag_expiry" class="form-control" required>
            </div>
            <div class=" col-md-6 col-12 j_ali_tag_upload">
                <div class="form-group">
                    <label>Upload J-Ali Tag</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload J-Ali Tag</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="j_ali_tag_upload" required>
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-6 col-12">
                <label >KP Tag</label>
                <select name="kp_tag" id="kp_tag" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 kp_tag_expiry">
                <label for="kp-tag-expiry">KP Tag Expiry Date</label>
                <input type="date" name="kp_tag_expiry" class="form-control" required>
            </div>
            <div class=" col-md-6 col-12 kp_tag_upload">
                <div class="form-group">
                    <label>Upload KP Tag</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload KP Tag</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="kp_tag_upload" required>
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group col-md-6 col-12">
                <label >Other Tag</label>
                <select name="other_tag" id="other_tag" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 other_tag_description">
                <label for="other-tag-description">Other Tag Description</label>
                <input type="text" name="other_tag_description" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12 other_tag_expiry">
                <label for="other-tag-expiry">Other Tag Expiry Date</label>
                <input type="date" name="other_tag_expiry" class="form-control" required>
            </div>
            <div class=" col-md-6 col-12 other_tag_upload">
                <div class="form-group">
                    <label>Upload Other Tag</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Other Tag</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="other_tag_upload" required>
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stickers -->

            <div class="form-group col-md-6 col-12">
                <label >Sticker</label>
                <select name="sticker" id="sticker" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 sticker_description">
                <label >Sticker Description</label>
                <select name="sticker_description" id="sticker_description" class="form-control" >
                        <option value="0" selected="selected">Salik</option>
                        <option value="1">Darb</option>
                        <option value="2">AD Ports</option>
                        <option value="3">Others</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 describe_other_sticker">
                <label for="describe-other-sticker">Describe Other Sticker</label>
                <input type="text" name="describe_other_sticker" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12 sticker_validity">
                <label for="sticker-validity">Sticker Validity</label>
                <input type="date" name="sticker_validity" class="form-control" required>
            </div>
            <div class=" col-md-6 col-12 sticker_upload">
                <div class="form-group">
                    <label>Upload Sticker</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Sticker</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="sticker_upload" required>
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Passes -->

            <div class="form-group col-md-6 col-12">
                <label >Pass</label>
                <select name="pass" id="pass" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 pass_description">
                <label >Pass Description</label>
                <select name="pass_description" id="pass_description" class="form-control" >
                        <option value="0" selected="selected">Food Pass</option>
                        <option value="1">J-Ali Pass</option>
                        <option value="2">Emal Pass</option>
                        <option value="3">Dubal Pass</option>
                        <option value="4">KP Pass</option>
                        <option value="5">Mina Zayed Pass</option>
                        <option value="6">Other Pass</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 describe_other_pass">
                <label for="describe-other-pass">Describe Other Pass</label>
                <input type="text" name="describe_other_pass" class="form-control" required>
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
                <input type="date" name="pass_validity" class="form-control" required>
            </div>
            <div class=" col-md-6 col-12 pass_upload">
                <div class="form-group">
                    <label>Upload Pass</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Pass</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="pass_upload" required>
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <hr class="mt-4">
        <h4>Equipment Details</h4>

        <div class="row">
            <div class="form-group col-md-6 col-12">
                <label >Medical Kit</label>
                <select name="medical_kit" id="medical_kit" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 medical_kit_expiry">
                <label for="medical-kit-expiry">Medical Kit Expiry Date</label>
                <input type="date" name="medical_kit_expiry" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Fire Extinguisher</label>
                <select name="fire_ext" id="fire_ext" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 fire_ext_weight">
                <label for="fire-ext-weight">Fire Extinguisher Weight</label>
                <input type="text" name="fire_ext_weight" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12 fire_ext_expiry">
                <label for="fire-ext-expiry">Fire Extinguisher Expiry Date</label>
                <input type="date" name="fire_ext_expiry" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Jack</label>
                <select name="jack" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Spare Wheel</label>
                <select name="spare_wheel" id="spare_wheel" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 spare_wheel_quantity">
                <label for="spare-wheel-quantity">Spare Wheel Quantity</label>
                <input type="text" name="spare_wheel_quantity" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12 spare_wheel_size">
                <label for="spare-wheel-size">Spare Wheel Size</label>
                <input type="text" name="spare_wheel_size" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Safety Triangle</label>
                <select name="safety_triangle" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Extra Emergency Light</label>
                <select name="extra_emergency_light" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Safety Shoes</label>
                <select name="safety_shoes" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Safety Helemt</label>
                <select name="safety_helmet" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Safety Gloves</label>
                <select name="safety_gloves" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Safety Jacket</label>
                <select name="safety_jacket" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Safety Ear Plug</label>
                <select name="safety_ear_plug" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Lashing Belt</label>
                <select name="lashing_belt" id="lashing_belt" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 lashing_belt_quantity_long">
                <label for="lashing-belt-quantity-long">Lashing Belt Quantity (Long)</label>
                <input type="text" name="lashing_belt_quantity_long" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12 lashing_belt_quantity_short">
                <label for="lashing-belt-quantity-short">Lashing Belt Quantity (Short)</label>
                <input type="text" name="lashing_belt_quantity_short" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Lashing Chain</label>
                <select name="lashing_chain" id="lashing_chain" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 lashing_chain_quantity">
                <label for="lashing-chain-quantity">Lashing Chain Quantity</label>
                <input type="text" name="lashing_chain_quantity" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Side Grill</label>
                <select name="side_grill" id="side_grill" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 side_grill_quantity">
                <label for="side-grill-quantity">Side Grill Quantity</label>
                <input type="text" name="side_grill_quantity" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12 side_grill_height">
                <label for="side-grill-height">Side Grill Height</label>
                <input type="text" name="side_grill_height" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Container Lock</label>
                <select name="container_lock" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Rope Seal</label>
                <select name="rope_seal" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Lashing Angle</label>
                <select name="lashing_angle" id="lashing_angle" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 lashing_angle_quantity">
                <label for="lashing-angle-quantity">Lashing Angle Quantity</label>
                <input type="text" name="lashing_angle_quantity" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12 lashing_angle_size">
                <label for="lashing-angle-size">Lashing Angle Size</label>
                <input type="text" name="lashing_angle_size" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Tarpaulin</label>
                <select name="tarpaulin" id="tarpaulin" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 tarpaulin_type">
                <label for="tarpaulin-type">Tarpaulin Type</label>
                <input type="text" name="tarpaulin_type" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Tail Lift</label>
                <select name="tail_lift" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Trolly</label>
                <select name="trolly" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>


        </div>

        <hr class="mt-4">
        <h4>Vehicle Photos</h4>

        <div class="row">
            <div class=" col-md-6 col-12">
                <div class="form-group">
                    <label>Front Photo</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Front photo</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="front_photo" required>
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
                            <input type="file" class="custom-file-input"   name="right_photo" required>
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
                            <input type="file" class="custom-file-input"   name="left_photo" required>
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
                            <input type="file" class="custom-file-input"   name="back_photo" required>
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="mt-4">
        <h4>Equipment Photos</h4>

        <div class="row">
            <div class=" col-md-6 col-12">
                <div class="form-group">
                    <label>Equipment Photo</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Equipment Photo</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="equipment_photo" required>
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        
        

        <div class="text-center mt-5">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
    </form>
</div>

<script>


    $('#vehicle_type').on('change', function()

        {
            if(this.value == '0'){
                $('.truck_type').show();
                $('.pickup_weight').val('');
                $('.pickup_weight').hide();
                $('.pickup_shape').val('');
                $('.pickup_shape').hide();
                $('.car_description').val('');
                $('.car_description').hide();
            }

            if(this.value == '1'){
                $('.pickup_weight').show();
                $('.pickup_shape').show();
                $('.truck_type').val('');
                $('.truck_type').hide();
                $('.car_description').val('');
                $('.car_description').hide();
            }
            if(this.value == '2'){
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
        if(this.value == '0'){
            $('.vehicle_number').show();
            $('.approx_value').show();
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

        if(this.value == '1'){
            $('.vehicle_number').val('');
            $('.vehicle_number').hide();
            $('.approx_value').val('');
            $('.approx_value').hide();
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