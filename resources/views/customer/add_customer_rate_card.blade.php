
<?php 
use App\Models\Company_name;
use App\Models\Customer_info;

use App\Models\User;


?>

<div class="container">
    <div class="mb-4">
        <a href="{{ route( 'user.customer.customer_rate_card' , $data['customer_id']) }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
</div>
<div class="container">
    <form action="{{ route( 'user.customer.save_customer_rate_card') }}" method="post" id="customer_rate_card">
        @csrf
        <input type="text" name="customer_id" value="{{ $data['customer_id'] }}" class="d-none" required >
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Admin Notes</label>
                    <textarea name="status_message" class="form-control form-control-rounded"  placeholder="Enter Admin Notes"></textarea>
                    
                </div>
            </div>
        </div>
        <div class="row">


            <div class="col-md-6 col-12 mb-3">
                
                    <label >From Location </label>
                    <input type="text" name="from" class="form-control" >
                </div>

            <div class="col-md-6 col-12 mb-3">
                
                    <label >To Location </label>
                    <input type="text" name="to" class="form-control" >
                </div>

            <div class="col-md-6 col-12 mb-3">
                
                    <label >VEHICLE TYPE </label>
                    <select name="vechicle_type" class="form-control" >
                        <option value="flatbed">FLATBED</option>
                        <option value="curtainside">CURTAINSIDE</option>
                        <option value="tipper">TIPPER</option>
                        <option value="3_ton_chiller">3TON CHILLER</option>
                        <option value="7_ton">7TON</option>
                        <option value="10_ton">10-TON</option>
                        <option value="3_ton_grill">3TON GRILL</option>
                    </select>
                </div>

            <div class="col-md-6 col-12 mb-3">
                
                    <label >Other Charges </label>
                    <input type="text" name="other_carges" class="form-control" >
                </div>

            <div class="col-md-6 col-12 mb-3">
                
                    <label >Other Charges Description </label>
                    <input type="text" name="other_des" class="form-control" >
                </div>

            <div class="col-md-6 col-12 mb-3">
                
                    <label >Rate Type</label>
                    <select name="rate" class="form-control" >
                        <option value="per_ton">Per Ton</option>
                        <option value="per_trip">Per Trip</option>
                        <option value="per_day_12hr">Per Day 12hr</option>
                        <option value="per_day_24hr">Per Day 24hr</option>
                    </select>
                </div>

            <div class="col-md-6 col-12 mb-3">
                
                    <label >Rate </label>
                    <input type="text" name="rate_price" class="form-control"  >
                </div>

            <div class="col-md-6 col-12 mb-3">
                
                    <label >Driver Comission </label>
                    <input type="number" name="driver_comission" class="form-control" >
            </div>

            <div class="col-md-6 col-12 mb-3">
                
                <label >With Fuel / Without Fuel</label>
                <select name="trip" class="form-control" >
                    <option value="with_fuel">With Fuel</option>
                    <option value="without_fuel">Without Fuel </option>
                </select>
            </div>

            <div class="col-md-6 col-12 mb-3">
                
                    <label >Ap Fuel as per trip</label>
                    <input id="ap_fuel" type="number" name="ap_fuel" class="form-control" >
            </div>

            <div class="col-md-6 col-12 mb-3">
                
                    <label >Ap Km as per trip</label>
                    <input  id="ap_km" type="number" name="ap_km" class="form-control" >
            </div>

            <div class="col-md-6 col-12 mb-3">
                
                    <label >Ap Diesel as per trip</label>
                    <input  id="ap_diesel" type="number" name="ap_diesel" class="form-control" >
            </div>

            <div class="col-12">
                <hr>
                <h4 class="w-100">DETENTION CHARGE </h4>
            </div>

            <div class="col-md-6 col-12 mb-3">
                    <label >Enter Days</label>
                    <input  type="number"   name="detention_days" class="form-control" >
            </div>

            <div class="col-md-6 col-12 mb-3">
                    <label >Enter Hours</label>
                    <input  type="number"   name="detention_hours" class="form-control" >
            </div>

            <div class="col-md-6 col-12 mb-3">
                    <label >Per Days Charges</label>
                    <input type="number"   name="detention_charges_days" class="form-control" required>
            </div>

            <div class="col-md-6 col-12 mb-3">
                    <label>  Per Hours Charges </label>
                    <input type="number"   name="detention_charges_hours" class="form-control" required>
            </div>

            
            
        </div>
        <input name="submit" type="submit" value="Submit" class="btn ">
    </form>
</div>


<script>

    $( document ).ready(function() {
        $('#Ap_Fuel_as_per_trip').attr('required' , true);
        $('#Ap_Km_as_per_trip').attr('required' , true);
        $('#Ap_Diesel_as_per_trip').attr('required' , true);

        $('#with_fuel').change(function() {
            if($(this).val() == 'with_fuel'){

                $('#Ap_Fuel_as_per_trip').attr('required' , true);
                $('#Ap_Km_as_per_trip').attr('required' , true);
                $('#Ap_Diesel_as_per_trip').attr('required' , true);

            }else if($(this).val() == 'without_fuel'){
                $('#Ap_Fuel_as_per_trip').attr('required' , false);
                $('#Ap_Km_as_per_trip').attr('required' , false);
                $('#Ap_Diesel_as_per_trip').attr('required' , false);
            }
        });
    });

   
</script>