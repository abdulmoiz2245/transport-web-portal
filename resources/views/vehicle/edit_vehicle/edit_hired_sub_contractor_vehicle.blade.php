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

        <div class="row">
            <div class="form-group col-md-6 col-12">
                <label >Sub Contractor ID</label>
                <select name="sub_contractor_id" id="transfer" class="form-control" >
                        <option value="0" selected="selected">subcontractor 1</option>
                        <option value="1">subcontractor 2</option>
                        <option value="2">subcontractor 3</option>
                </select>
            </div>

            <div class="form-group col-md-6 col-12">
                <label for="vehicle-number">Vehicle Number</label>
                <input type="text" name="vehicle_number" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="registration-date">Registration Date</label>
                <input type="date" name="registration_date" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="registration-expiry-date">Registration Expiry Date</label>
                <input type="date" name="registration_exp_date" class="form-control" required>
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