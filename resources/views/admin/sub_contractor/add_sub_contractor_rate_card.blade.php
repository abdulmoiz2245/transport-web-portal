
<?php 
use App\Models\Company_name;
use App\Models\Customer_info;

use App\Models\User;


?>

<div class="container">
    <div class="mb-4 text-right">
        <a href="{{ route( 'admin.sub_contractor.sub_contractor_rate_card') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
</div>
<div class="container">
    <form action="{{ route('admin.sub_contractor.save_sub_contractor_rate_card') }}" method="post" id="sub_contractor_rate_card">
        @csrf

        <div class="row">

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Select Customer</label>
                    <select name="customer_id" class="form-control customer" required>
                        @foreach($data['customer_info'] as $customer)
                        @if($customer->status == 'approved')
                        <option value="{{ $customer->id }}"  >{{ $customer->name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >From Location </label>
                    <input type="text" name="from" class="form-control customer_from readonly"   required>
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >To Location </label>
                    <input type="text" name="to" class="form-control customer_to readonly"  required>
                    
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
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
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Other Charges </label>
                    <input type="text" name="other_carges" class="form-control" >
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Other Charges Description </label>
                    <input type="text" name="other_des" class="form-control" >
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Rate Type</label>
                    <select name="rate" class="form-control" >
                        <option value="per_ton">Per Ton</option>
                        <option value="per_trip">Per Trip</option>
                        <option value="per_day_12hr">Per Day 12hr</option>
                        <option value="per_day_24hr">Per Day 24hr</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Rate </label>
                    <input type="text" name="rate_price" class="form-control"  >
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Ap Km </label>
                    <input type="number" name="ap_km" class="form-control">
                </div>
            </div>
            
        </div>
        <input name="submit" type="submit" value="Submit">
    </form>
</div>

<script>
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
                    console.log(data[0].to);
                    // document.getElementsByClassName('customer_to').value = "Something"; 
                    // $('.customer_to').val(data.to);
                    $('.customer_to').attr( 'value',data[0].to);
                    $('.customer_from').attr( 'value',data[0].from);
                    // $('.customer_from').val(data.from);
                    
                },
                error: function (){    
                    alert('Technical Error (contact to web master)');
                }
            });
</script>