<?php 
use App\Models\Company_name;
use App\Models\Purchase_mertial_data;
use App\Models\Supplier_info;

?>
<div class="container">
   
    <div class="row mb-5">
        <div class="col-1">
            <a href="{{ route( 'user.purchase') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
        </div>
        
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <a href="{{ route( 'user.purchase.add_vehicle_purchase') }}">
                        <button class="btn btn-primary">Add Vehicle</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <form action="{{route('user.purchase.save_purchase')}}" method="post"    enctype="multipart/form-data">
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
                    <label >Material Data</label>
                    <select name="meterial_data_id_1" id="Material_Data" class="form-control "required >
                        @if(Purchase_mertial_data::all() != null)
                        @foreach(Purchase_mertial_data::all() as $purchase_meterial)
                        <option value="{{$purchase_meterial->id}}">{{ $purchase_meterial->name }}</option>
                        @endforeach
                        @endif
                        <!-- <option value="sd">asa</option>
                        <option value="sd">asda</option> -->

                    </select>
                </div>
            </div>
            
            
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="product_name" class="form-control" placeholder="Enter Product Name" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Brand</label>
                    <input type="text" name="brand" class="form-control" placeholder="Enter Brand" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Size</label>
                    <input type="text" name="size" class="form-control" placeholder="Enter Size" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Unit</label>
                    <input type="number" name="unit" id="unit" class="form-control" placeholder="Enter Unit" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Unit Price</label>
                    <input type="number" name="unit_price" id="unit_price" class="form-control" placeholder="Enter Unit Price" required>
                </div>
            </div>
            <div class="col-md-6 col-12 type">
                <div class="form-group">
                    <label>Type</label>
                    <input type="text" name="type" class="form-control" placeholder="Enter Type" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Made In</label>
                    <input type="text" name="made_in" class="form-control" placeholder="Enter Made In" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Delivery Date</label>
                    <input type="date" name="delivery_date" class="form-control" placeholder="Enter Delivery Date" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Terms</label>
                    <input type="number" name="terms" class="form-control" placeholder="Enter Terms" required>
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

    // var date = new Date();
    // date.setDate(date.getDate() + 10);
    // var new_date = date.toLocaleDateString('en-CA');
 
    var data = {!! json_encode(Supplier_info::all(),JSON_FORCE_OBJECT) !!};
    
    
    $('.as_supplier_id').on('change', function()
    {
        var studentSelect = $('#Material_Data');

        
        $.ajax({
            type: 'GET',
            url: "{{ url( '/employee/supplier/get-supplier-products/') }}/"+this.value,
        }).then(function (data) {
            $("#Material_Data option").each(function() {
                $(this).remove();
            });
            console.log(data);
            // create the option and append to Select2
            data.supplier_product.forEach(function(e){ 
                    if(e != 'tyre' && e != 'tyres' && e != 'fuel' && e != 'fuels' && e != 'sparepart' && e != 'spareparts' && e != 'tools' && e != 'tool'){
                        console.log(e);
                        var option = new Option(e, e , true, true);
                        studentSelect.append(option).trigger('change');

                    }

            });

            data.supplier_services.forEach(function(e){ 
                    if(e != 'tyre' && e != 'tyres' && e != 'fuel' && e != 'fuels' && e != 'sparepart' && e != 'spareparts' && e != 'tools' && e != 'tool' && e != 'fuel' ){
                        var option = new Option(e, e , true, true);
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

           

            // // manually trigger the `select2:select` event
            // studentSelect.trigger({
            //     type: 'select2:select',
            //     params: {
            //         data: data
            //     }
            // });
        });

        var supplier_id = $(this).val();
        var arrayLength = Object.keys(data).length;
        
        

        for (var i = 0; i < arrayLength; i++) {
            if(supplier_id == data[i].id){
                $('#trn_supplier').val(data[i].trn);
                $('.select_company select option').each(function() {
                    var selected = $(this)[0].value;
                  
                    if (selected == data[i].company_id) {
                        

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
            //     $('.select_company select option').each(function() {
            //     $('.select_company select option').removeAttr("selected"); 
            //     $('.select_company select option').removeAttr("disabled"); 

            // });
        }
    });

    
    
    $('#unit_price').change(function(){
        var unit = $('#unit').val();
        var unit_price = $('#unit_price').val();
        if($('#is_vat').is(':checked')){
            $('#total_amount').val((unit*unit_price)+(((unit*unit_price)/100)*5));
        }
        else{
            $('#total_amount').val((unit*unit_price));
        }
        
    });

    $('#unit').change(function(){
        var unit = $('#unit').val();
        var unit_price = $('#unit_price').val();
        if($('#is_vat').is(':checked')){
            $('#total_amount').val((unit*unit_price)+(((unit*unit_price)/100)*5));
        }
        else{
            $('#total_amount').val((unit*unit_price));
        }
        
    });

    $('#is_vat').change(function(){
        var unit = $('#unit').val();
        var unit_price = $('#unit_price').val();
        if($('#is_vat').is(':checked')){
            $('#total_amount').val((unit*unit_price)+(((unit*unit_price)/100)*5));
        }
        else{
            $('#total_amount').val((unit*unit_price));
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