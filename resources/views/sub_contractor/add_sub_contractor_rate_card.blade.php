
<?php 
use App\Models\Company_name;
use App\Models\Customer_info;

use App\Models\User;


?>

<div class="container">
    <div class="mb-4 text-left">
        <a href="{{ route( 'admin.sub_contractor.sub_contractor_rate_card' , $data['sub_contractor_id']) }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
</div>
<div class="container">
    <form action="{{ route( 'user.sub_contractor.save_sub_contractor_rate_card') }}" method="post" id="sub_contractor_rate_card">
        @csrf

        <input type="text" name="sub_contractor_id" value="{{ $data['sub_contractor_id'] }}" class="d-none" required >
        <div class="row">

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Select Customer</label>
                    <select name="customer_id" class="form-control customer" id="customer_id" required>
                        @foreach(Customer_info::all() as $customer)
                        @if($customer->status == 'approved' && $customer->row_status != 'deleted')
                        <option value="{{ $customer->id }}"  >{{ $customer->name }}</option>
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
                    <input type="number" name="other_carges" class="form-control" >
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
                    <input type="number" name="rate_price" class="form-control"  required>
                </div>
            </div>

            <div class="col-md-6 col-12 mb-3">
                <div class=" col-md-6 col-12 mb-3">
                    <label >Ap Km </label>
                    <input type="number" name="ap_km" class="form-control" required>
                </div>
            </div>
            
        </div>
        <div class="text-center">
            <input name="submit" type="submit" value="Submit" class="btn "> 
        </div>
    </form>
</div>

<script>

    $( document ).ready(function() {
        
    
    var customer_id = $('.customer').val();
    var customer = new FormData();
    customer.append('customer_id', customer_id);
    customer.append('_token', '{{ csrf_token() }}');

    $.ajax({
            type: 'post',
            url: "{{ route( 'user.sub_contractor.get_customer_rate_card') }}",
            data: customer,
            processData: false,
            contentType: false,
            success: function (data) {
                if(data){
                    data.forEach(function (element) { 
                        console.log(element.from);
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

    $('#customer_id').change(function() {
        var customer_id1 = $(this).val();
        var customer1 = new FormData();
        customer1.append('customer_id', customer_id1);
        customer1.append('_token', '{{ csrf_token() }}');
        $.ajax({
            type: 'post',
            url: "{{ route( 'user.sub_contractor.get_customer_rate_card') }}",
            data: customer1,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                if(data){
                    $('#From option').remove();
                    $('#To option').remove();

                    data.forEach(function (element) { 
                        console.log(element.from);
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