<?php 
use App\Models\Company_name;
use App\Models\Customer_info;

use App\Models\User;


?>
<div class="container">
    <div class="mb-4 text-right">
        <a href="{{ route( 'admin.sub_contractor.sub_contractor_rate_card' ,  $data['customer_rate_card']->sub_contractor_id )  }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
</div>
<div class="container">
    @if($data['customer_rate_card'] != null)
    <form action="{{ route('admin.sub_contractor.update_sub_contractor_rate_card') }}" method="post" id="sub_contractor_rate_card">
        @csrf
        <input type="text" name="id" value="{{ $data['customer_rate_card']->id }}" class="d-none">
        <input type="text" name="sub_contractor_id" value="{{ $data['customer_rate_card']->sub_contractor_id }}" class="d-none">

        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Admin Notes</label>
                    <textarea name="status_message" class="form-control form-control-rounded"  placeholder="Enter Admin Notes">{{ $data['customer_rate_card']->status_message }}</textarea>
                    
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value='pending' <?php if($data['customer_rate_card']->status == 'pending') echo 'selected="selected"' ?> >Pending</option>
                        <option value='approved' <?php if($data['customer_rate_card']->status == 'approved') echo 'selected="selected"' ?> >Approved</option>
                        <option value='rejected' <?php if($data['customer_rate_card']->status == 'rejected') echo 'selected="selected"' ?>>Rejected</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Select Customer</label>
                    <select name="customer_id" class="form-control customer" id="customer_id" required>
                        @foreach(Customer_info::all() as $customer)
                        @if($customer->status == 'approved')
                        <option value="{{ $customer->id }}" <?php if($data['customer_rate_card']->customer_id == $customer->id ) echo 'selected' ?> >{{ $customer->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >From</label>
                    <select name="from" class="form-control customer" id="from_select" required>
                      
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >To</label>
                    <select name="to" class="form-control customer" id="to_select" required>
                        
                    </select>
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

            <!-- <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Driver Comission </label>
                    <input type="number" value="{{ $data['customer_rate_card']->driver_comission}}" name="driver_comission" class="form-control" >
                </div>
            </div>

            <div class="col-12">
                <hr>
                <h4 class="w-100">DETENTION CHARGE </h4>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Select Per Day / Per Hour</label>
                    <select name="detention" class="form-control" >
                        <option value="per_day"  <?php if($data['customer_rate_card']->detention == 'per_day') echo 'selected' ?>>Per Day</option>
                        <option value="per_hour"  <?php if($data['customer_rate_card']->detention == 'per_hour') echo 'selected' ?>>Per Hour</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Days / Hours</label>
                    <input  type="number"  value="{{ $data['customer_rate_card']->time}}" name="time" class="form-control">
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Per Days Charges / Per Hours Charges</label>
                    <input type="number"  value="{{ $data['customer_rate_card']->charges}}" name="charges" class="form-control">
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Select Trip</label>
                    <select name="trip" class="form-control" >
                        <option value="round_trip" <?php if($data['customer_rate_card']->trip == 'round_trip') echo 'selected' ?>>ROUND TRIP </option>
                        <option value="single_trip" <?php if($data['customer_rate_card']->trip == 'single_trip') echo 'selected' ?>>SINGLE TRIP </option>
                        <option value="return_trip" <?php if($data['customer_rate_card']->trip == 'return_trip') echo 'selected' ?>>RETURN TRIP </option>
                    </select>
                </div>
            </div> -->

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Ap Km as per trip</label>
                    <input type="number"  value="{{ $data['customer_rate_card']->ap_km}}" name="ap_km" class="form-control">
                </div>
            </div>

            <!-- <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Ap Diesel as per trip</label>
                    <input type="number"  value="{{ $data['customer_rate_card']->ap_diesel}}" name="ap_diesel" class="form-control">
                </div>
            </div> -->
            
        </div>
        <div class="text-center">
            <input name="submit" type="submit" class="btn" value="Update">
        </div>
    </form>
    @endif
</div>

<script>

    $( document ).ready(function() {
        
    
    var customer_id = $('.customer').val();
    var customer = new FormData();
    customer.append('customer_id', customer_id);
    customer.append('_token', '{{ csrf_token() }}');

    $.ajax({
            type: 'post',
            url: "{{ route('admin.sub_contractor.get_customer_rate_card') }}",
            data: customer,
            processData: false,
            contentType: false,
            success: function (data) {
                if(data){
                    data.forEach(function (element) { 
                        document.getElementById("From").add(new Option(element.from, element.from));
                        document.getElementById("To").add(new Option(element.to, element.to));
                    });
                    console.log('call 1');

                    $('#From option[value="<?= $data['customer_rate_card']->from ?>"]').attr('selected','selected');

                    $('#To option[value="<?= $data['customer_rate_card']->to ?>"]').attr('selected','selected');

                }
                
            },
            error: function (){    
                alert('Technical Error (contact to web master)');
            }
    });
    

    var fist_change = 0;

    $('#customer_id').change(function(e) {
         if (fist_change < 6) {
            
            $('#From option[value="<?= $data['customer_rate_card']->from ?>"]').attr('selected','selected');
            $('#To option[value="<?= $data['customer_rate_card']->to ?>"]').attr('selected','selected');
          

            fist_change ++;
            return;
        }
        var customer_id1 = $(this).val();
        var customer1 = new FormData();
        customer1.append('customer_id', customer_id1);
        customer1.append('_token', '{{ csrf_token() }}');
        $.ajax({
            type: 'post',
            url: "{{ route('admin.sub_contractor.get_customer_rate_card') }}",
            data: customer1,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log('data');

                if(data){
                    $('#From option').remove();
                    $('#To option').remove();

                    data.forEach(function (element) { 
                        // console.log(element.from);
                        // $('#from').append(`<option value="${element.from}">
                        //                ${element.from}
                        //           </option>`);
                        // $('#to').append(`<option value="${element.to}">
                        //     ${element.to}
                        // </option>`);

                        document.getElementById("From").add(new Option(element.from, element.from));
                        document.getElementById("To").add(new Option(element.to, element.to));

                    });


                }
                
                
            },
            error: function (){    
                alert('Technical Error (contact to web master)');
            }
        });
    });

    });

</script>