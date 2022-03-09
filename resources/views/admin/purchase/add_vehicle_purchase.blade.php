<?php 
use App\Models\Company_name;
use App\Models\Purchase_mertial_data;
use App\Models\Supplier_info;

?>
<div class="container">
   
    <div class="row mb-5">
        <div class="col-4">
            <a href="{{ route( 'admin.purchase.purchase') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
        </div>
    </div>
    <form action="{{route('admin.purchase.save_vechicle_purchase')}}" method="post"    enctype="multipart/form-data">
    @csrf

        <h2>LPO</h2>
        <div class="row">
            <div class="col-12 mt-3 mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="supplier_status" id="new_supplier" value="new" >
                    <label class="form-check-label" for="new_supplier">
                        New Supplier
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="supplier_status" id="existing_supplier" value="existing" checked>
                    <label class="form-check-label" for="existing_supplier">
                        Existing Supplier
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label >Date</label>
                    <input type="date" name="date" class="form-control form-control" id="" required>
                </div>
            </div>
            <div class="col-md-6 col-12 trn_number">
                <div class="form-group">
                    <label>TRN Number</label>
                    <input type="number" name="trn" class="form-control"  placeholder="Enter TRN Number" required>
                </div>
            </div>
       
            <!-- <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>LPO Ref No</label>
                    <input type="text" name="lpo_ref_num" class="form-control"  placeholder="Enter LPO Reference Number" required>
                </div>
            </div> -->

            <div class="col-md-6 col-12 select_company">
                <div class="form-group">
                    <label >Select Company</label>
                    <?php if(Company_name::all()->count() > 0){ ?>
                        <select name="company_id"  class="form-control "required >
                            
                            @foreach($data['company_names'] as $company_name)
                            <option value="{{ $company_name->id }}">{{ $company_name->name }}</option>
                            @endforeach
                        </select>
                    <?php } else{ ?>
                    <h5 class="text-danger">Please Add Company First </h5> 
                    <?php } ?>
                </div>
            </div>

            

            <div class="col-md-6 col-12 supplier_name">
                <div class="form-group">
                    <label>Supplier Name</label>
                    <input type="text" name="supplier_name" id="supplier_name" class="form-control " placeholder="Enter Supplier Name" >
                </div>
            </div>

            <div class="col-md-6 col-12 supplier_id">
                <div class="form-group">
                    <label>Select Supplier</label>
                    <select name="supplier_id" id="supplier_select" class="form-control as_supplier_id">
                        @foreach(Supplier_info::all() as $supplier)
                        @if($supplier->row_status != 'deleted')
                        @if($supplier->status == 'approved')

                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endif
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label >Type</label>
                    <select name="vechicle_type" id="vechicle_type" class="form-control "required placeholder="">
                        <option value="truck_head">Truck Head</option>
                        <option value="trailer">trailer</option>
                    </select>
                </div>
            </div>
            
            
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Delivery Date</label>
                    <input type="date" name="delivery_date" class="form-control" placeholder="Enter Delivery Date" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Make</label>
                    <input type="text" name="make" class="form-control" placeholder="Enter Make" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Model</label>
                    <input type="text" name="model" class="form-control" placeholder="Enter Model" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Color</label>
                    <input type="text" name="color" class="form-control" placeholder="Enter Color" required>
                </div>
            </div>
            <div class="col-md-6 col-12" id="engine_number">
                <div class="form-group">
                    <label>Engine Number </label>
                    <input type="text" name="engine_number" id="" class="form-control" placeholder="Enter Engine Number" >
                </div>
            </div>
            <div class="col-md-6 col-12" id="chassis_no">
                <div class="form-group">
                    <label>Chassis No</label>
                    <input type="text" name="chassis_no" id="" class="form-control" placeholder="Enter Chassis No" >
                </div>
            </div>

            <div class="col-md-6 col-12" id="trailer_type">
                <div class="form-group">
                    <label>Trailer Type</label>
                   
                    <select name="trailer_type" id="" class="form-control">
                        <option value="flat">Flat</option>
                        <option value="c_side">C side</option>
                        <option value="tipper">Tipper</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-12" id="size">
                <div class="form-group">
                    <label>Size</label>
                    <input type="text" name="size" id="" class="form-control" placeholder="Enter Size" >
                </div>
            </div>
            <div class="col-md-6 col-12" id="axle">
                <div class="form-group">
                    <label>Axle</label>
                    <input type="text" name="axle" id="" class="form-control" placeholder="Enter Sxle" >
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Vehicle suspension</label>
                    <select name="vehicle_suspension" id="" class="form-control" >
                        <option value="booster">Booster</option>
                        <option value="kamani">Kamani</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Is VAT</label>
                    <label class="switch pr-5 switch-dark mt-3"> 
                        <input type="checkbox" checked="checked" id="is_vat" name="is_vat"><span class="slider"></span>
                    </label>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" id="price" class="form-control" placeholder="Enter Total Amount">
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Total Amount</label>
                    <input type="number" name="total_amount" id="total_amount" class="form-control" placeholder="Enter Total Amount" readonly>
                </div>
            </div>
        </div>


        <div class="text-center mt-5">
            <input type="submit" class="btn btn-outline-secondary rounded-pill" value="Submit">
        </div>

    </form>
</div>

<script>
   var data = {!! json_encode(Supplier_info::all(),JSON_FORCE_OBJECT) !!};
    
    
    $('.as_supplier_id').on('change', function()
    {
        var studentSelect = $('#Material_Data');

        
        $.ajax({
            type: 'GET',
            url: "{{ url( '/admin/supplier/get-supplier-products/') }}/"+this.value,
        }).then(function (data) {
            $("#Material_Data option").each(function() {
                $(this).remove();
            });
            // create the option and append to Select2
            data.supplier_product.forEach(function(e){ 
                    if(e != 'tyre' && e != 'tyres' && e != 'fuel' && e != 'fuels' && e != 'sparepart' && e != 'spareparts' && e != 'tools' && e != 'tool'){
                        var option = new Option(e, "" , true, true);
                        studentSelect.append(option).trigger('change');

                    }

            });

            data.supplier_services.forEach(function(e){ 
                    if(e != 'tyre' && e != 'tyres' && e != 'fuel' && e != 'fuels' && e != 'sparepart' && e != 'spareparts' && e != 'tools' && e != 'tool' && e != 'fuel' ){
                        var option = new Option(e, "" , true, true);
                        studentSelect.append(option).trigger('change');

                    }

            });

            <?php if(Purchase_mertial_data::all() != null) { ?>
                <?php $count =1; ?>
                <?php foreach(Purchase_mertial_data::all() as $purchase_meterial) { ?>
                    
                    var option_<?= $count ?> = new Option("{{$purchase_meterial->name}}", "{{$purchase_meterial->id}}" , true, true) ;

                    studentSelect.append(option_<?= $count ?>).trigger('change');


                    <?php $count = $count + 1; ?>

                <?php } ?>
            <?php } ?>

           

        });

        var supplier_id = $(this).val();
        var arrayLength = Object.keys(data).length;
        console.log(supplier_id);
   
        for (var i = 0; i < arrayLength; i++) {
            if(supplier_id == data[i].id){
                $('#trn_supplier').val(data[i].trn);
                $('.select_company select option').each(function() {
                    var selected = $(this)[0].value;
                    
                    if (selected == data[i].company_id) {
                        console.log("found");

                        $('.trn_number input').val(parseInt(data[i].trn));
                        $('.trn_number input').attr("readonly" ,"readonly"  );
                        $('.select_company select option[value="'+selected+'"]').removeAttr("readonly");       
                        $('.select_company select option[value="'+selected+'"]').attr("selected");     
                        
                        $('.select_company select').val( data[i].company_id);               

                    }else{
                        $('.select_company select option[value="'+selected+'"]').attr("disabled", "disabled");
                            $('.select_company select option[value="'+selected+'"]').removeAttr("selected"); 
                    }
                })
                break;
            }
            
        }
    });
    

    $('#vechicle_type').change(function(){
       if($('#vechicle_type').val() == 'trailer'){

            $('#engine_number').hide();
            $('#chassis_no').show();
            $('#trailer_type').show();
            $('#size').show();
            $('#axle').show();

       }
       else{

            $('#engine_number').show();
            $('#chassis_no').hide();
            $('#trailer_type').hide();
            $('#size').hide();
            $('#axle').hide();
       }
       
    });

    $('#engine_number').show();
    $('#chassis_no').hide();
    $('#trailer_type').hide();
    $('#size').hide();
    $('#axle').hide();
    
    $('#price').change(function(){
       
        if($('#is_vat').is(':checked')){
            $('#total_amount').val(parseInt($('#price').val())+(((parseInt($('#price').val()))/100)*5));
            
        }
        else{
            $('#total_amount').val(( parseInt($('#price').val())));
            
        }
        
    });

    $('#is_vat').change(function(){
       
        if($('#is_vat').is(':checked')){
            $('#total_amount').val(parseInt($('#price').val())+(((parseInt($('#price').val()))/100)*5));
            
        }
        else{
            $('#total_amount').val(parseInt($('#price').val()));
            
        }
        
    });

    $('#new_supplier').change(function()
    {
        if ($(this).is(':checked')) {
            $('.supplier_name').show();
            $('.supplier_id').hide();
            $('.trn_number input').removeAttr("readonly");
            $('.trn_number input').val("");

            $('.select_company').show();
        } 
        $('.select_company select option').each(function() {
            $('.select_company select option').removeAttr("selected"); 
            $('.select_company select option').removeAttr("disabled"); 

        });
       
    });

    $('#Select_Supplier').change(function(){
       

       
       
    });


    $('.supplier_name').hide();
    $('.supplier_id').show();
    $('.trn_number').show();
    $('.select_company').show();
    // $('.trn_number input').val(parseInt(data[0].trn));
    
    var supplier_id = $(".as_supplier_id").find("option:first-child").val();
    console.log(supplier_id);
    console.log($("#Select_Supplier"));

    var arrayLength = Object.keys(data).length;

    for (var i = 0; i < arrayLength; i++) {
        if(supplier_id == data[i].id){
            console.log('found');
            $('.trn_number input').val(parseInt(data[i].trn));
            $('.trn_number input').val(data[i].trn);
            
        }
    }
    $('.trn_number input').attr('readonly' , 'readonly');


    $('.select_company select option').each(function() {
            // $('.select_company select option').removeAttr("selected"); 
        $('.select_company select option').removeAttr("disabled"); 

    });
    

    $('#existing_supplier').change(function()
    {
        if ($(this).is(':checked')) {
            $('.supplier_name').hide();
            $('.supplier_id').show();
            $('.trn_number input').attr("readonly" ,"readonly"  );

            $('.trn_number_supplier').show();

            

            var supplier_id = $("#Select_Supplier").val();
            var arrayLength = Object.keys(data).length;
            console.log(supplier_id);
            for (var i = 0; i < arrayLength; i++) {
                if(supplier_id == data[i].id){
                    $('.trn_number input').val(data[i].trn);
                    // console.log(supplier_id);

                    $('.select_company select option').each(function() {
                        var selected = $(this)[0].value;
                    
                        if (selected == data[i].company_id) {
                            $('.select_company select option').removeAttr("disabled" );

                        }else{

                            $('.select_company select option').attr("disabled" ,"disabled"  );
                        }
                    });
                    $('.select_company select ').val(parseInt(data[i].company_id));

                }
            }
        } 

       
    });

    
</script>