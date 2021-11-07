
<?php 
use App\Models\Company_name;
use App\Models\Customer_info;

use App\Models\User;


?>

<div class="container">
    <div class="mb-4">
        <a href="{{ route( 'admin.hr_pro.trade_license__sponsors__partners') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
</div>
<div class="container">
    <form action="{{ route('admin.hr_pro.save_trade_license_partners') }}" method="post" id="customer_rate_card " enctype="multipart/form-data">
        @csrf
        <div class="row">

            <input type="text" name="trade_id" value="{{ $data['trade_id'] }}" class="d-none" required >

            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Upload ID</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload ID</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="id_copy">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Passport Upload</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Passport</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="passport_copy">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Visa Upload</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload visa</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="visa_copy">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Other</label>
                    <input name="other" class="form-control" type="text">
                </div>
           </div>

        </div>
        <input name="submit" type="submit" value="Submit" class="btn ">
    </form>
</div>

<script>

    $( document ).ready(function() {
        // $('#Ap_Fuel_as_per_trip').attr('required' , true);
        // $('#Ap_Km_as_per_trip').attr('required' , true);
        // $('#Ap_Diesel_as_per_trip').attr('required' , true);

        // $('#with_fuel').change(function() {
        //     if($(this).val() == 'with_fuel'){

        //         $('#Ap_Fuel_as_per_trip').attr('required' , true);
        //         $('#Ap_Km_as_per_trip').attr('required' , true);
        //         $('#Ap_Diesel_as_per_trip').attr('required' , true);

        //     }else if($(this).val() == 'without_fuel'){
        //         $('#Ap_Fuel_as_per_trip').attr('required' , false);
        //         $('#Ap_Km_as_per_trip').attr('required' , false);
        //         $('#Ap_Diesel_as_per_trip').attr('required' , false);
        //     }
        // });
    });

   
</script>