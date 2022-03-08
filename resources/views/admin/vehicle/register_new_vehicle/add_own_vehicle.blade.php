<div class="container mt-3">
    <div class="mb-5">
            <a href="{{route('admin.vehicle.register_new_vehicle.own_vehicle')}}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
    </div>
    <form action="{{ route('admin.hr_pro.save_mobile_civil_defence') }}" method="post" enctype="multipart/form-data">
        @csrf

        <h4> Vehicle Details  </h4>
        <div class="row">
            <div class="form-group col-md-6 col-12">
                <label for="vehicle-number">Vehicle Number</label>
                <input type="text" name="vehicle_number" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="company-name">Company Name</label>
                <input type="text" name="company_name" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
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
            <div class="form-group col-md-6 col-12">
                <label for="engine-number">Engine Number</label>
                <input type="text" name="engine_number" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="chassis-number">Chassis Number</label>
                <input type="text" name="chassis_number" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
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
            <div class="form-group col-md-6 col-12">
                <label >Vehicle  Suspension</label>
                <select name="vehicle_suspension" id="" class="form-control" >
                        <option value="0" selected="selected">Booster</option>
                        <option value="1">Kamani</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Salik</label>
                <select name="salik" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Trailer Type</label>
                <select name="trailer_type" id="" class="form-control" >
                    <option value="0" selected="selected">Flat</option>
                    <option value="1">Curtain Side</option>
                    <option value="1">Tipper</option>
                    <option value="1">Other</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Trailer  Suspension</label>
                <select name="trailer_suspension" id="" class="form-control" >
                        <option value="0" selected="selected">Booster</option>
                        <option value="1">Kamani</option>
                </select>
            </div>

            <div class="form-group col-md-6 col-12">
                <label for="size">Size(meter/feet)</label>
                <input type="text" name="size" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Axle</label>
                <select name="axle" id="" class="form-control" >
                        <option value="0" selected="selected">1</option>
                        <option value="1">2</option>
                        <option value="1">3</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="ton-capacity">Maximum Ton Capacity</label>
                <input type="text" name="ton_capacity" class="form-control" required>
            </div>
        </div>

        <hr class="mt-4">
        <h4>Vehicle Pass/Tags/Stickers/Insurance Details</h4>

        <div class="row">
            <div class="form-group col-md-6 col-12">
                <label >Vehicle Insurance</label>
                <select name="vehicle_insurance" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="policy-number">Policy Number</label>
                <input type="text" name="policy_number" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="insurance-expiry">Insurance Expiry Date</label>
                <input type="date" name="insurance_expiry" class="form-control" required>
            </div>
            <div class=" col-md-6 col-12">
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
            <div class="form-group col-md-6 col-12">
                <label >other Insurance</label>
                <select name="other_insurance" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="other-insurance-expiry">Other Insurance Expiry Date</label>
                <input type="date" name="other_insurance_expiry" class="form-control" required>
            </div>
            <div class=" col-md-6 col-12">
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
            <div class="form-group col-md-6 col-12">
                <label for="other-insurance-descripiton">Other Insurance Description</label>
                <input type="text" name="other_insurance_description" class="form-control" required>
            </div>

            <!-- Tags -->

            <div class="form-group col-md-6 col-12">
                <label >J-Ali Tag</label>
                <select name="j_ali_tag" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="j-ali-tag-expiry">J-Ali Tag Expiry Date</label>
                <input type="date" name="j_ali_tag_expiry" class="form-control" required>
            </div>
            <div class=" col-md-6 col-12">
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
                <select name="kp_tag" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="kp-tag-expiry">KP Tag Expiry Date</label>
                <input type="date" name="kp_tag_expiry" class="form-control" required>
            </div>
            <div class=" col-md-6 col-12">
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
                <select name="other_tag" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="other-tag-description">Other Tag Description</label>
                <input type="text" name="other_tag_description" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="other-tag-expiry">Other Tag Expiry Date</label>
                <input type="date" name="other_tag_expiry" class="form-control" required>
            </div>
            <div class=" col-md-6 col-12">
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
                <select name="sticker" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Sticker Description</label>
                <select name="sticker_description" id="" class="form-control" >
                        <option value="0" selected="selected">Salik</option>
                        <option value="1">Darb</option>
                        <option value="2">AD Ports</option>
                        <option value="3">Others</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="sticker-validity">Sticker Validity</label>
                <input type="date" name="sticker_validity" class="form-control" required>
            </div>
            <div class=" col-md-6 col-12">
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
                <select name="pass" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Sticker Description</label>
                <select name="sticker_description" id="" class="form-control" >
                        <option value="0" selected="selected">Food Pass</option>
                        <option value="1">J-Ali Pass</option>
                        <option value="2">Emal Pass</option>
                        <option value="3">Dubal Pass</option>
                        <option value="3">KP Pass</option>
                        <option value="3">Mina Zayed Pass</option>
                        <option value="3">Other Pass</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Food Pass</label>
                <select name="sticker_description" id="" class="form-control" >
                        <option value="0" selected="selected">Abu Dhabi</option>
                        <option value="1">Dubai</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="sticker-validity">Sticker Validity</label>
                <input type="date" name="sticker_validity" class="form-control" required>
            </div>
            <div class=" col-md-6 col-12">
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

        </div>


        
        

        <div class="text-center mt-5">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
    </form>
</div>

<script>


    $('#vehicle_type').on('change', function()
        {
            console.log("Hassan");
            if(this.value == '0'){
                $('.truck_type').show();
                $('.pickup_weight').val('')
                $('.pickup_weight').hide();
                $('.pickup_shape').val('')
                $('.pickup_shape').hide();
                $('.car_description').val('')
                $('.car_description').hide();
            }

            if(this.value == '1'){
                $('.pickup_weight').show();
                $('.pickup_shape').show();
                $('.truck_type').val('')
                $('.truck_type').hide();
                $('.car_description').val('')
                $('.car_description').hide();
            }
            if(this.value == '2'){
                $('.car_description').show();
                $('.pickup_weight').val('')
                $('.pickup_weight').hide();
                $('.pickup_shape').val('')
                $('.pickup_shape').hide();
                $('.truck_type').val('')
                $('.truck_type').hide();
            }
            
        });

</script>