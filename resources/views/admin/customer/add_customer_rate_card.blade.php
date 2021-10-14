
<?php 
use App\Models\Company_name;
use App\Models\Customer_info;

use App\Models\User;


?>

<div class="container">
    <div class="mb-4 text-right">
        <a href="{{ route( 'admin.customer.customer') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
</div>
<div class="container">
    <form action="{{ route('admin.customer.save_customer_rate_card') }}" method="post" id="customer_rate_card">
        @csrf
        <div class="row">

            <input type="text" name="customer_id" value="{{ $data['customer_id'] }}" class="d-none" required >

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
                    <input type="number" name="other_carges" class="form-control" >
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
                    <input type="number" name="rate_price" class="form-control"  >
                </div>

            <div class="col-md-6 col-12 mb-3">
                
                    <label >Driver Comission </label>
                    <input type="number" name="driver_comission" class="form-control" >
                </div>

            <div class="col-12">
                <hr>
                <h4 class="w-100">DETENTION CHARGE </h4>
            </div>

            <div class="col-md-6 col-12 mb-3">
                
                    <label >Select Per Day / Per Hour</label>
                    <select name="detention" class="form-control" >
                        <option value="per_day">Per Day</option>
                        <option value="per_hour">Per Hour</option>
                    </select>
                </div>

            <div class="col-md-6 col-12 mb-3">
                
                    <label >Days / Hours</label>
                    <input type="number" name="time" class="form-control">
                </div>

            <div class="col-md-6 col-12 mb-3">
                
                    <label >Per Days Charges / Per Hours Charges</label>
                    <input type="number" name="charges" class="form-control">
                </div>

            <div class="col-md-6 col-12 mb-3">
                
                    <label >Select Trip</label>
                    <select name="trip" class="form-control" >
                        <option value="round_trip">ROUND TRIP </option>
                        <option value="single_trip">SINGLE TRIP </option>
                        <option value="return_trip">RETURN TRIP </option>
                    </select>
                </div>

            <div class="col-md-6 col-12 mb-3">
                
                    <label >Ap Km as per trip</label>
                    <input type="number" name="ap_km" class="form-control">
                </div>

            <div class="col-md-6 col-12 mb-3">
                
                    <label >Ap Diesel as per trip</label>
                    <input type="number" name="ap_diesel" class="form-control">
                </div>
            
        </div>
        <input name="submit" type="submit" value="Submit" class="btn ">
    </form>
</div>