<div class="container">
    <div class="mb-4">
        <a href="{{ route( 'user.customer.customer_rate_card' , $data['customer_rate_card']->customer_id  ) }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
</div>
<div class="container">
    <form action="{{ route( 'user.customer.update_customer_rate_card') }}" method="post" id="customer_rate_card">
        @csrf
        <input type="text" name="id" value="{{ $data['customer_rate_card']->id }}" class="d-none">
        <input type="text" name="customer_id" value="{{ $data['customer_rate_card']->customer_id }}" class="d-none">

        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Admin Notes</label>
                    <textarea name="status_message" class="form-control form-control-rounded"  placeholder="Enter Admin Notes">{{ $data['customer_rate_card']->status_message }}</textarea>
                    
                </div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >From Location </label>
                    <input type="text" value="{{ $data['customer_rate_card']->from}}" name="from" class="form-control" >
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >To Location </label>
                    <input type="text" value="{{ $data['customer_rate_card']->to}}" name="to" class="form-control" >
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >VEHICLE TYPE </label>
                    <select name="vechicle_type" class="form-control" >
                        <option value="flatbed" <?php if($data['customer_rate_card']->vechicle_type == 'flatbed') echo 'selected' ?>>FLATBED</option>
                        <option value="curtainside" <?php if($data['customer_rate_card']->vechicle_type == 'curtainside') echo 'selected' ?>>CURTAINSIDE</option>
                        <option value="tipper" <?php if($data['customer_rate_card']->vechicle_type == 'tipper') echo 'selected' ?>>TIPPER</option>
                        <option value="3_ton_chiller" <?php if($data['customer_rate_card']->vechicle_type == '3_ton_chiller') echo 'selected' ?>>3TON CHILLER</option>
                        <option value="7_ton" <?php if($data['customer_rate_card']->vechicle_type == '7_ton') echo 'selected' ?>>7TON</option>
                        <option value="10_ton" <?php if($data['customer_rate_card']->vechicle_type == '10_ton') echo 'selected' ?>>10-TON</option>
                        <option value="3_ton_grill" <?php if($data['customer_rate_card']->vechicle_type == '3_ton_grill') echo 'selected' ?>>3TON GRILL</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Other Charges </label>
                    <input type="text" value="{{ $data['customer_rate_card']->other_carges}}" name="other_carges" class="form-control" >
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Other Charges Description </label>
                    <input type="text"  value="{{ $data['customer_rate_card']->other_des}}"name="other_des" class="form-control" >
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Rate Type</label>
                    <select name="rate" class="form-control" >
                        <option value="per_ton" <?php if($data['customer_rate_card']->rate == 'per_ton') echo 'selected' ?>>Per Ton</option>
                        <option value="per_trip" <?php if($data['customer_rate_card']->rate == 'per_trip') echo 'selected' ?>>Per Trip</option>
                        <option value="per_day_12hr" <?php if($data['customer_rate_card']->rate == 'per_day_12hr') echo 'selected' ?>>Per Day 12hr</option>
                        <option value="per_day_24hr" <?php if($data['customer_rate_card']->rate == 'per_day_24hr') echo 'selected' ?>>Per Day 24hr</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Rate </label>
                    <input type="text" name="rate_price" class="form-control" value="{{$data['customer_rate_card']->rate_price}}" >
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Driver Comission </label>
                    <input type="number" value="{{ $data['customer_rate_card']->driver_comission}}" name="driver_comission" class="form-control" >
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >With Fuel / Without Fuel</label>
                    <select name="trip" class="form-control" >
                        <option value="with_fuel">With Fuel</option>
                        <option value="without_fuel">Without Fuel </option>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Ap Fuel as per trip</label>
                    <input type="number" id="Ap_Fuel_as_per_trip" value="{{ $data['customer_rate_card']->ap_fuel}}" name="ap_fuel" class="form-control">
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Ap Km as per trip</label>
                    <input type="number" id="Ap_Km_as_per_trip"  value="{{ $data['customer_rate_card']->ap_km}}" name="ap_km" class="form-control">
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Ap Diesel as per trip</label>
                    <input type="number" id="Ap_Diesel_as_per_trip"  value="{{ $data['customer_rate_card']->ap_diesel}}" name="ap_diesel" class="form-control">
                </div>
            </div>

            <div class="col-12">
                <hr>
                <h4 class="w-100">DETENTION CHARGE </h4>
            </div>

            <div class="col-md-6 col-12 mb-3">
                    <label >Enter Days</label>
                    <input  type="number"  value="{{ $data['customer_rate_card']->detention_days}}" name="detention_days" class="form-control" >
            </div>

            <div class="col-md-6 col-12 mb-3">
                    <label >Enter Hours</label>
                    <input  type="number"  value="{{ $data['customer_rate_card']->detention_hours	}}" name="detention_hours" class="form-control" >
            </div>

            <div class="col-md-6 col-12 mb-3">
                    <label >Per Days Charges</label>
                    <input type="number"  value="{{ $data['customer_rate_card']->detention_charges_days}}" name="detention_charges_days" class="form-control" required>
            </div>

            <div class="col-md-6 col-12 mb-3">
                    <label>  Per Hours Charges </label>
                    <input type="number"  value="{{ $data['customer_rate_card']->detention_charges_hours}}" name="detention_charges_hours" class="form-control" required>
            </div>

            
        </div>
        <div class="text-center">
            <input name="submit" type="submit" class="btn" value="Update">
        </div>
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