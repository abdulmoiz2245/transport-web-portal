<?php 
use App\Models\Company_name;

?>
<div class="container">
    <div class="mb-5">
        <a href="{{ route( 'user.purchase.purchase') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">      
        </a>
    </div>
    <form action="{{route('user.purchase.save_purchase')}}" method="post" enctype="multipart/form-data">
    @csrf
    <h2>LPO</h2>
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label >Date</label>
                    <input type="date" name="comp_date" class="form-control form-control" id="" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>TRN Number</label>
                    <input type="text" name="trn_number" class="form-control"  placeholder="Enter TRN Number" required>
                </div>
            </div>
        
       
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>LPO Ref No</label>
                    <input type="text" name="lpo_ref_num" class="form-control"  placeholder="Enter LPO Reference Number" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" name="comp_name" class="form-control" placeholder="Enter Company Name" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Company Address</label>
                    <input type="text" name="comp_address" class="form-control" placeholder="Enter Company Address" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label >Material Data</label>
                    <select name="material_data" class="form-control "required >
                        <option value="">Spare parts 1</option>
                        <option value="">Spare parts 2</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-12">
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
            <div class="col-12">
                <hr>
                <h4 class="w-100">FOR STOCK</h4>
            </div>

            <div class=" col-md-6 col-12">
                <div class="form-group">
                    <label >For Stock</label>
                    <select name="for_stock" id="for_stock" class="form-control" >
                            <option value="0">No</option>
                            <option value="1"  selected="selected">Yes</option>
                    </select>
                </div>   
            </div>
            <div class="col-md-6 col-12 vehicle_no">
                <div class="form-group">
                    <label>Vehicle Number</label>
                    <input type="text" name="vehicle_no" class="form-control" placeholder="Enter Vehicle Number" required>
                </div>
            </div>
            <div class="col-md-6 col-12 description">
                <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="description" class="form-control" placeholder="Enter Description" required>
                </div>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="prod_name" class="form-control" placeholder="Enter Product Name" required>
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
                    <label>Quantity</label>
                    <input type="text" name="quantity" class="form-control" placeholder="Enter Quantity" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Unit</label>
                    <input type="text" name="unit" class="form-control" placeholder="Enter Unit" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Unit Price</label>
                    <input type="text" name="unit_price" class="form-control" placeholder="Enter Unit Price" required>
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
                    <input type="text" name="terms" class="form-control" placeholder="Enter Terms" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Credit Days</label>
                    <input type="text" name="credit_days" class="form-control" placeholder="Enter Credit Days" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Total Amount</label>
                    <input type="text" name="total_amount" class="form-control" placeholder="Enter Total Amount" required>
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
    
    // console.log($("[type='date']").attr("min",new_date) );

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

</script>