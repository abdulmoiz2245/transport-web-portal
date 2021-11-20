<div class="container">
    <div class="mb-5">
            <a href="{{ route( 'user.inventory.spare_parts.spare_parts_in_storage') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
    </div>
    <form action="{{ route('admin.hr_pro.save_mobile_muncipality') }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Spare Part Condition</label>
            <select name="for_condition" id="for_condition" class="form-control" >
                    <option value="">New</option>
                    <option value=""  selected="selected">Used</option>
            </select>
        </div>
        <div class="form-group">
            <label >For</label>
            <select name="for_which" id="for_which" class="form-control" required>
                    <option value="0" selected="selected">Vehicle</option>
                    <option value="1">Trailer</option>
                    <option value="2">Others</option>
            </select>  
        </div>
        <div class="form-group other" >
            <label>Other</label>
            <input type="text" name="other" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Brand Name</label>
            <input type="text" name="brand" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Part Description</label>
            <input type="text" name="part_description" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Quantity</label>
            <input type="text" name="quantity" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    // var date = new Date();
    // date.setDate(date.getDate() + 10);
    // var new_date = date.toLocaleDateString('en-CA');
    
    // console.log($("[type='date']").attr("min",new_date) );
    $('#for_which').on('change', function()
    {
        if(this.value == '2'){
            $('.other').show();
        }

        if(this.value == '0' || this.value == '1'){
            $('.other').val(null);
            $('.other').hide();
        }
        
    });

</script>