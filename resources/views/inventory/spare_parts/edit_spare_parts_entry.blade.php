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
        @if( true)
        <div class="row">
            <div class="col-12">
                <label>Replace Requisition Signed by Forman</label>
            </div>
            <div class="col-11 form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Upload Requisition</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input"   name="document">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="col-1 p-0 text-center">
                <a  target="_blank" href="">
                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                </a>
            </div>
        </div>
        @else
        <div class="form-group">
            <label>Upload Requisition Signed by Forman</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Upload Requisition</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input"   name="document">
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
        </div>
        @endif
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    // var date = new Date();
    // date.setDate(date.getDate() + 10);
    // var new_date = date.toLocaleDateString('en-CA');
    
    // console.log($("[type='date']").attr("min",new_date) );

</script>