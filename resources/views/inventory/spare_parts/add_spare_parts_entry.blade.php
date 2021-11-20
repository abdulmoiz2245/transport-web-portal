<div class="container">
    <div class="mb-5">
            <a href="{{ route( 'user.inventory.spare_parts.spare_parts_entry') }}">
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
            <label >Part Description</label>
            <select name="" id="" class="form-control" required>
                    <option value="0" selected="selected">Spare Part 1</option>
                    <option value="1">Spare Part 2</option>
                    <option value="2">Spare Part 3</option>
            </select>  
        </div>
        <div class="form-group" >
            <label>Vehicle Number</label>
            <input type="text" name="vehcile_no" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Spare Part Consumer</label>
            <select name="" id="" class="form-control" >
                    <option value="" selected="selected">Mechanic</option>
                    <option value="">Helper</option>
                    <option value="">Electrician</option>
                    <option value="">Bodyworks</option>
                    <option value="">Other</option>
            </select>
        </div>
        <div class="form-group" >
            <label>Driver Name</label>
            <input type="text" name="driver_name" class="form-control">
        </div>
        <div class="form-group" >
            <label>Forman Name</label>
            <input type="text" name="forman_name" class="form-control">
        </div>
        <div class="form-group">
            <label>Upload Requisition Signed by Forman</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Upload Requisition</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input"   name="requisition">
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    

</script>