<div class="container mt-3">
    <div class="mb-5">
            <a href="{{ route( 'user.inventory.fuel.readings') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
    </div>
    <form action="{{ route( 'user.inventory.fuel.readings.save_fuel_reading') }}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf

        <div class="row">
            <div class="form-group col-lg-12 col-md-6 col-12">
                <label for="reading-date">Reading Date</label>
                <input type="date" name="reading_date" class="form-control" id="reading_date" min="{{ $data['fuel_entery']->date}}">
                <div id="validationServerUsernameFeedback" class="invalid-tooltip">
                    Reading Date Must distint.
                </div>
            </div>

            <div class="col-12"> <!-- Non Mobile Tank 1 Reading -->
                <hr>
                <h4 class="w-100">Non-Mobile Tank 1 </h4>
            </div>
            <div class="form-group col-md-6 col-12 non_mobile_1_reading_group">
                <label for="user-status">Daily Readings </label>
                <span class="badge badge-pill badge-warning" style="
                    margin-left: 10px;
                ">Previous Value : {{ $data['fuel_entery']->non_mobile_1_reading }} </span>
                <input type="number" name="non_mobile_1_reading" class="form-control non_mobile_1_reading" >
            </div>
            <div class="form-group col-md-2 col-12"> 
                
                <label for="user-status">Refill From</label>
                <!-- <input type="number" name="non_mobile_1_refill_amount" class="form-control" value="0"> -->
                <select name="non_mobile_1_refill_from" id="" class="form-control non_mobile_1_refill_from">
                    <option value="0" selected>Direct</option>
                    <option value="2">From Tank 2</option>

                </select>
            </div>
            <div class="form-group col-md-4 col-12 non_mobile_1_refill_amount_group">
                <label for="user-status">Refill Amount</label>
                <input type="number" name="non_mobile_1_refill_amount" class="form-control non_mobile_1_refill_amount" value="0">
            </div> <!-- Non Mobile Tank 1 Reading End-->

            <div class="col-12">
                <hr>
                <h4 class="w-100">Inter Tank Transfer </h4>
            </div>
            <div class=" col-md-6 col-12 mb-3">
                <label >Inter Tank Transfer</label> 
                <select name="inter_tank_transfer_from" id="transfer" class="form-control" >
                        <option value="0" selected="selected">No Transfer</option>
                        <option value="2">Transfer From Non Mobile Tank 2 to Tank 1</option>
                </select>
            </div>
            <div class="transfer_amount form-group col-md-6 col-12 inte_transfer_amount_group">
                <label for="user-status">Transfer Amount</label> <span class="badge badge-pill badge-warning" style="
                    margin-left: 10px;
                ">Previous Value : {{ $data['fuel_entery']->inter_tank_transfer_amount }} </span>
                <input type="number" id="inte_transfer_amount"  name="inter_tank_transfer_amount" class="form-control inte_transfer_amount"  >
            </div>
            <div class="col-12">
                <hr>
                <h4 class="w-100">Non-Mobile Tank 2 </h4>
            </div>
            <div class="form-group col-md-6 col-12 non_mobile_2_reading_group">
                <label for="user-status">Daily Readings</label>
                <span class="badge badge-pill badge-warning" style="
                    margin-left: 10px;
                ">Previous Value : {{ $data['fuel_entery']->non_mobile_2_reading }} </span>
                <input type="number" name="non_mobile_2_reading" class="form-control non_mobile_2_reading" >
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="user-status">Refill Amount</label>
                <input type="number" name="non_mobile_2_refill_amount" class="form-control">
            </div>
            <div class="col-12">
                <hr>
                <h4 class="w-100">Mobile Tank 1 </h4>
            </div>
            <div class="form-group col-md-6 col-12 mobile_1_reading_group">
                <label for="user-status">Daily Readings</label>
                <span class="badge badge-pill badge-warning" style="
                    margin-left: 10px;
                ">Previous Value : {{ $data['fuel_entery']->mobile_1_reading }} </span>
                <input type="number" name="mobile_1_reading" class="form-control mobile_1_reading" >
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="user-status">Refill Amount</label>
                <input type="number" name="mobile_1_refill_amount" class="form-control" >
            </div>
            <div class="col-12">
                <hr>
                <h4 class="w-100">Mobile Tank 2 </h4>
            </div>
            <div class="form-group col-md-6 col-12 mobile_2_reading_group">
                <label for="user-status">Daily Readings</label>
                <span class="badge badge-pill badge-warning" style="
                    margin-left: 10px;
                ">Previous Value : {{ $data['fuel_entery']->mobile_2_reading }} </span>
                <input type="number" name="mobile_2_reading" class="form-control mobile_2_reading" >
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="user-status">Refill Amount</label>
                <input type="number" name="mobile_2_refill_amount" class="form-control" >
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="form-group col-md-6 col-12 fuel_entery_non_mobile_group">
                <label for="user-status">Fuel Entry From Non Mobile</label>
                <input type="number" name="fuel_entery_non_mobile" class="form-control fuel_entery_non_mobile" required>
            </div>

            <div class="form-group col-md-6 col-12 fuel_entery_mobile_group">
                <label for="user-status">Fuel Entry From  Mobile</label>
                <input type="number" name="fuel_entery_mobile" class="form-control fuel_entery_mobile" required>
            </div>

            <div class="form-group col-md-6 col-12">
                <label for="user-status">Vehicle Fuel Consumption </label>
                <input type="number" name="" class="form-control" disabled >
            </div>
        </div>

        <div class="text-center mt-5">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
    </form>
</div>

<script>


    $('#transfer').on('input', function()
    {
        if(this.value == '1' || this.value == '2'){
            $('.transfer_amount').show();
        }

        if(this.value == '0'){
            $('.transfer_amount').val('')
            $('.transfer_amount').hide();
        }
            
    });

    $('#reading_date').on('input', function()
    {
        if(this.value == '1' || this.value == '2'){
            $('.transfer_amount').show();
        }
        
        
        var url = '{{ route("user.inventory.fuel.readings.validate_reading_date", ":date") }}';
        url = url.replace(':date', this.value);
        $.get( url , function( data ) {
           if(data == '1'){
              
           }
        });
            
    });
    var non_mobile_1_reading = -1;
    var non_mobile_2_reading = -1;
    var non_mobile_fule_entery = -1;

    var mobile_1_reading = -1;
    var mobile_2_reading = -1;
    var mobile_fule_entery = -1;

    $('.non_mobile_1_reading').on('input', function()
    {
        var previous_reading =<?= (int)$data['fuel_entery']->non_mobile_1_reading ?>;
        if(this.value < previous_reading){
            var error = '<div id="validationServerUsernameFeedback" class="invalid-tooltip">Value must be equal or grater then previous value </div>';
	
            $( ".non_mobile_1_reading_group" ).append( error );
            $( ".non_mobile_1_reading" ).removeClass('is-valid');
            $( ".non_mobile_1_reading" ).addClass('is-invalid');

        }else{
            $( ".non_mobile_1_reading" ).removeClass('is-invalid');
            $( ".non_mobile_1_reading" ).addClass('is-valid');
            non_mobile_1_reading = this.value - previous_reading; 
        }


    });

    $('.non_mobile_2_reading').on('input', function()
    {
        var previous_reading =<?= (int)$data['fuel_entery']->non_mobile_2_reading ?>;
        if(this.value < previous_reading){
            var error = '<div id="validationServerUsernameFeedback" class="invalid-tooltip">Value must be equal or grater then previous value </div>';
	
            $( ".non_mobile_2_reading_group" ).append( error );
            $( ".non_mobile_2_reading" ).removeClass('is-valid');
            $( ".non_mobile_2_reading" ).addClass('is-invalid');

        }else{
            $( ".non_mobile_2_reading" ).removeClass('is-invalid');
            $( ".non_mobile_2_reading" ).addClass('is-valid');
            non_mobile_2_reading = this.value - previous_reading;
        }
    });

    $('.mobile_1_reading').on('input', function()
    {
        var previous_reading =<?= (int)$data['fuel_entery']->mobile_1_reading ?>;
        if(this.value < previous_reading){
            var error = '<div id="validationServerUsernameFeedback" class="invalid-tooltip">Value must be equal or grater then previous value </div>';
	
            $( ".mobile_1_reading_group" ).append( error );
            $( ".mobile_1_reading" ).removeClass('is-valid');
            $( ".mobile_1_reading" ).addClass('is-invalid');

        }else{
            $( ".mobile_1_reading" ).removeClass('is-invalid');
            $( ".mobile_1_reading" ).addClass('is-valid');
            mobile_1_reading = this.value - previous_reading;
        }
    });

    $('.mobile_2_reading').on('input', function()
    {
        var previous_reading =<?= (int)$data['fuel_entery']->mobile_2_reading ?>;
        if(this.value < previous_reading){
            var error = '<div id="validationServerUsernameFeedback" class="invalid-tooltip">Value must be equal or grater then previous value </div>';
	
            $( ".mobile_2_reading_group" ).append( error );
            $( ".mobile_2_reading" ).removeClass('is-valid');
            $( ".mobile_2_reading" ).addClass('is-invalid');

        }else{
            $( ".mobile_2_reading" ).removeClass('is-invalid');
            $( ".mobile_2_reading" ).addClass('is-valid');
            mobile_2_reading = this.value - previous_reading;
        }
    });

    $('.fuel_entery_mobile').on('input', function()
    {
        if(mobile_1_reading != '-1' && mobile_2_reading!= '-1'){
            mobile_fule_entery = mobile_2_reading + mobile_1_reading;
        }
        var previous_reading =<?= (int)$data['fuel_entery']->mobile_2_reading ?>;
        if( mobile_fule_entery == -1){
            var error = '<div id="validationServerUsernameFeedback" class="invalid-tooltip">Please first enter meter reading for non_mobile tanks  </div>';
	
            $( ".fuel_entery_mobile_group" ).append( error );
            $( ".fuel_entery_mobile" ).removeClass('is-valid');
            $( ".fuel_entery_mobile" ).addClass('is-invalid');
        }
        else if(this.value != mobile_fule_entery){
            var error = '<div id="validationServerUsernameFeedback" class="invalid-tooltip">Value must be equal to meter  difference value ( '+ mobile_fule_entery +' ) </div>';
	
            $( ".fuel_entery_mobile_group" ).append( error );
            $( ".fuel_entery_mobile" ).removeClass('is-valid');
            $( ".fuel_entery_mobile" ).addClass('is-invalid');

        }else{
            $( ".fuel_entery_mobile" ).removeClass('is-invalid');
            $( ".fuel_entery_mobile" ).addClass('is-valid');
            // mobile_2_reading = this.value;
        }
    });

    $('.fuel_entery_non_mobile').on('input', function()
    {
        if(non_mobile_1_reading != '-1' && non_mobile_2_reading!= '-1'){
            non_mobile_fule_entery = non_mobile_2_reading + non_mobile_1_reading;
        }
        var previous_reading =<?= (int)$data['fuel_entery']->mobile_2_reading ?>;
        if( non_mobile_fule_entery == -1){
            var error = '<div id="validationServerUsernameFeedback" class="invalid-tooltip">Please first enter meter reading for non_mobile tanks  </div>';
	
            $( ".fuel_entery_non_mobile_group" ).append( error );
            $( ".fuel_entery_non_mobile" ).removeClass('is-valid');
            $( ".fuel_entery_non_mobile" ).addClass('is-invalid');
        }
        else if(this.value != non_mobile_fule_entery){
            var error = '<div id="validationServerUsernameFeedback" class="invalid-tooltip">Value must be equal to meter  difference value ( '+ non_mobile_fule_entery +' ) </div>';
	
            $( ".fuel_entery_non_mobile_group" ).append( error );
            $( ".fuel_entery_non_mobile" ).removeClass('is-valid');
            $( ".fuel_entery_non_mobile" ).addClass('is-invalid');

        }else{
            $( ".fuel_entery_non_mobile" ).removeClass('is-invalid');
            $( ".fuel_entery_non_mobile" ).addClass('is-valid');
            // mobile_2_reading = this.value;
        }
    });

    $('.inte_transfer_amount').on('input', function()
    {
        var previous_reading =<?= (int)$data['fuel_entery']->inter_tank_transfer_amount ?>;
        if(this.value < previous_reading){
            var error = '<div id="validationServerUsernameFeedback" class="invalid-tooltip">Value must be equal or grater then previous value </div>';
	
            $( ".inte_transfer_amount_group" ).append( error );
            $( ".inte_transfer_amount" ).removeClass('is-valid');
            $( ".inte_transfer_amount" ).addClass('is-invalid');

        }else{
            $( ".inte_transfer_amount" ).removeClass('is-invalid');
            $( ".inte_transfer_amount" ).addClass('is-valid');
            console.log( $('.non_mobile_1_refill_from')[0].value);

            if( $('.non_mobile_1_refill_from')[0].value == '2'){
                var meter_difference = $('.inte_transfer_amount').val() - previous_reading;
                console.log($('.inte_transfer_amount').val() );
                console.log('meter_difference');

                if($('.non_mobile_1_refill_amount').val() != meter_difference ){
                    var error = '<div id="validationServerUsernameFeedback" class="invalid-tooltip">Refill Amount must be equal to meter difference '+ meter_difference +'</div>';
	
                    $( ".non_mobile_1_refill_amount_group" ).append( error );
                    $( ".non_mobile_1_refill_amount" ).removeClass('is-valid');
                    $( ".non_mobile_1_refill_amount" ).addClass('is-invalid');
                }
            }
        }

        
    });

    $('input[type=submit]').on('click', function(e) {
       
        
       
       var check_validation = 0;
       var names = $.map($("input"), function(e) {
           if(e.hasAttribute("class")){
               // console.log( e.classList);
               e.classList.forEach(function (element){ 
                   if(element == 'is-invalid'){
                       check_validation = 1;
                   }
               });
           }
           
       })
       if(check_validation == 1){
           e.preventDefault();
           e.stopPropagation();
       }
   });

    (function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
            }


            form.classList.add('was-validated')
        }, false)
        })
    })()

</script>