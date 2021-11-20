<div class="container">


    <div class="mb-5">
            <a href="{{ route( 'user.inventory.fuel.readings') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
    </div>
    <form action="{{ route('admin.hr_pro.update_mobile_civil_defence') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
            <div class="col-12">
                <h4 class="w-100">Non-Mobile Tank 1 </h4>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="admin-status">Daily Readings</label>
                <input type="text" name="non_mob1_daily_readings" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="admin-status">Refill Amount</label>
                <input type="text" name="non_mob1_refill_amount" class="form-control" required>
            </div>
            <div class="col-12">
                <hr>
                <h4 class="w-100">Inter Tank Transfer </h4>
            </div>
            <div class=" col-md-6 col-12 mb-3">
                <label >Inter Tank Transfer</label>
                <select name="is_transfer" id="transfer" class="form-control" >
                        <option value="0" selected="selected">No Transfer</option>
                        <option value="1">Transfer From Tank 1 to Tank 2</option>
                        <option value="2">Transfer From Tank 2 to Tank 1</option>
                </select>
            </div>
            <div class="transfer_amount form-group col-md-6 col-12">
                <label for="admin-status">Transfer Amount</label>
                <input type="text" name="transfer_amount" class="form-control" required>
            </div>
            <div class="col-12">
                <hr>
                <h4 class="w-100">Non-Mobile Tank 2 </h4>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="admin-status">Daily Readings</label>
                <input type="text" name="non_mob2_daily_readings" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="admin-status">Refill Amount</label>
                <input type="text" name="non_mob2_refill_amount" class="form-control" required>
            </div>
            <div class="col-12">
                <hr>
                <h4 class="w-100">Mobile Tank 1 </h4>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="admin-status">Daily Readings</label>
                <input type="text" name="mob1_daily_readings" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="admin-status">Refill Amount</label>
                <input type="text" name="mob1_refill_amount" class="form-control" required>
            </div>
            <div class="col-12">
                <hr>
                <h4 class="w-100">Mobile Tank 2 </h4>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="admin-status">Daily Readings</label>
                <input type="text" name="mob2_daily_readings" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="admin-status">Refill Amount</label>
                <input type="text" name="mob2_refill_amount" class="form-control" required>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="admin-status">Fuel Entry</label>
                <input type="text" name="fuel_entry" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="admin-status">Vehicle Fuel Consumption Details</label>
                <input type="text" name="fuel_entry" class="form-control" required>
            </div>          
        </div>
        <div class="text-center mt-5">
            <button type="submit" class="btn btn-primary">Update</button>
        </div> 
    </form>
</div>

<script>

    $('#transfer').on('change', function()
        {
            if(this.value == '1' || this.value == '2'){
                $('.transfer_amount').show();
            }

            if(this.value == '0'){
                $('.transfer_amount').val('')
                $('.transfer_amount').hide();
            }
            
        });

    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    
    console.log($("[type='date']").attr("min",new_date) );

</script>