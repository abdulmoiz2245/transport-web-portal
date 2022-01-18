<?php 
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
    <form action="{{route('admin.purchase.update_purchase')}}" method="post"    enctype="multipart/form-data">
    @csrf
    <input type="text" name="id" value="{{ $data['purchase']->id }}" class="d-none">

    

        <h2>LPO</h2>
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label >Date</label>
                    <input type="date" value="{{ $data['purchase']->date }}" name="date" class="form-control form-control" id="" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>TRN Number</label>
                    <input type="text" name="trn" class="form-control"  placeholder="Enter TRN Number" value="{{ $data['purchase']->trn }}" required>
                </div>
            </div>
        
    
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" value="{{ $data['purchase']->company_name }}" name="company_name" class="form-control" placeholder="Enter Company Name" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Company Address</label>
                    <input type="text" value="{{ $data['purchase']->company_address }}"  name="company_address" class="form-control" placeholder="Enter Company Address" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Select Supplier</label>
                    <select name="supplier_id" id=""class="form-control as_supplier_id">
                        @foreach(Supplier_info::all() as $supplier)
                        @if($supplier->row_status != 'deleted')
                        @if($supplier->status == 'approved')

                            <option value="{{ $supplier->id }}" <?php if($supplier->id == $data['purchase']->supplier_id) {?> selected='selected' <?php } ?>>{{ $supplier->name }}</option>
                        @endif
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label >Material Data</label>
                    <select name="meterial_data_id" id="Material_Data" class="form-control "required >
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
                    <input type="text" name="product_name"  value="{{ $data['purchase']->product_name }}"  class="form-control" placeholder="Enter Product Name" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Brand</label>
                    <input type="text" name="brand" value="{{ $data['purchase']->brand }}"  class="form-control" placeholder="Enter Brand" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Size</label>
                    <input type="text" name="size" value="{{ $data['purchase']->size }}" class="form-control" placeholder="Enter Size" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" name="quantity" value="{{ $data['purchase']->quantity }}" class="form-control" placeholder="Enter Quantity" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Unit</label>
                    <input type="text" name="unit" value="{{ $data['purchase']->unit }}"  class="form-control" placeholder="Enter Unit" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Unit Price</label>
                    <input type="text" name="unit_price"  value="{{ $data['purchase']->unit_price }}"  class="form-control" placeholder="Enter Unit Price" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Type</label>
                    <input type="text" name="type" value="{{ $data['purchase']->type }}" class="form-control" placeholder="Enter Type" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Made In</label>
                    <input type="text" name="made_in" value="{{ $data['purchase']->made_in }}" class="form-control" placeholder="Enter Made In" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Delivery Date</label>
                    <input type="date" value="{{ $data['purchase']->delivery_date }}"  name="delivery_date" class="form-control" placeholder="Enter Delivery Date" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Terms</label>
                    <input type="text" value="{{ $data['purchase']->terms }}"  name="terms" class="form-control" placeholder="Enter Terms" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Credit Days</label>
                    <input type="text" name="cerdit_days" value="{{ $data['purchase']->cerdit_days }}"  class="form-control" placeholder="Enter Credit Days" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Total Amount</label>
                    <input type="text" name="total_amount" value="{{ $data['purchase']->total_amount }}"  class="form-control" placeholder="Enter Total Amount" required>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Admin Notes</label>
                    <textarea name="status_message" class="form-control form-control-rounded"  placeholder="Enter Admin Notes">{{ $data['purchase']->status_message }}</textarea>
                    
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value='pending' <?php if($data['purchase']->status_admin == 'pending') echo 'selected="selected"' ?> >Pending</option>
                        <option value='approved' <?php if($data['purchase']->status_admin == 'approved') echo 'selected="selected"' ?> >Approved</option>
                        <option value='rejected' <?php if($data['purchase']->status_admin == 'rejected') echo 'selected="selected"' ?>>Rejected</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Accounts Status</label>
                    <select name="status_account" class="form-control">
                        <option value='pending' <?php if($data['purchase']->status_admin == 'pending') echo 'selected="selected"' ?> >Pending</option>
                        <option value='approved' <?php if($data['purchase']->status_admin == 'approved') echo 'selected="selected"' ?> >Approved</option>
                        <option value='rejected' <?php if($data['purchase']->status_admin == 'rejected') echo 'selected="selected"' ?>>Rejected</option>
                    </select>
                </div>
            </div>
        </div>



    <div class="text-center mt-5">
        <input type="submit" class="btn btn-outline-secondary rounded-pill" value="Update ">
    </div>

    </form>
</div>

<script>
// var date = new Date();
// date.setDate(date.getDate() + 10);
// var new_date = date.toLocaleDateString('en-CA');

// console.log($("[type='date']").attr("min",new_date) );

$('.as_supplier_id').on('change', function()
    {
        console.log(this.value);
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
                        var option = new Option(e, null , true, true);
                        studentSelect.append(option).trigger('change');

                    }

            });

            data.supplier_services.forEach(function(e){ 
                    if(e != 'tyre' && e != 'tyres' && e != 'fuel' && e != 'fuels' && e != 'sparepart' && e != 'spareparts' && e != 'tools' && e != 'tool'){
                        var option = new Option(e, null , true, true);
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
            $("#Material_Data option").each(function() {
                // alert(this.text + ' ' + this.value);
                if(this.value == "{{ $data['purchase']->meterial_data_id }}" ){
                    $('#Material_Data').find('option[value="'+ this.value +'"]').prop('selected', true);
                }
            });
           

            // // manually trigger the `select2:select` event
            // studentSelect.trigger({
            //     type: 'select2:select',
            //     params: {
            //         data: data
            //     }
            // });
        });
    });

$(document).ready(function() {

    $("#Material_Data").select2({
        tags: true
    });
    console.log($("#Material_Data").select2({
        tags: true
    }));

    $('#for_stock').on('change', function()
    {
        if(this.value == '0'){
            $('.vehicle_no').show();
            $('.description').show();
        }

        if(this.value == '1'){
            $('.vehicle_no').val(null);
            $('.vehicle_no').hide();
            $('.description').val(null);
            $('.description').hide();
        }
        
    });
});


</script>