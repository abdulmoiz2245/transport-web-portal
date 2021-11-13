<div class="container">
    <div class="mb-5">
            <a href="{{ route( 'admin.hr_pro.mobile_muncipality') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
    </div>
    <form action="{{ route('admin.hr_pro.update_mobile_muncipality') }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Admin Notes</label>
                    <textarea name="status_message" class="form-control form-control-rounded"  placeholder="Enter Admin Notes">{{ $data['muncipality']->status_message }}</textarea>
                    
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value='pending' <?php if($data['muncipality']->status == 'pending') echo 'selected="selected"' ?> >Pending</option>
                        <option value='approved' <?php if($data['muncipality']->status == 'approved') echo 'selected="selected"' ?> >Approved</option>
                        <option value='rejected' <?php if($data['muncipality']->status == 'rejected') echo 'selected="selected"' ?>>Rejected</option>
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <input type="text" name="id" value="{{ $data['muncipality']->id }}" class="d-none">
        @if( $data['muncipality']->document != '')
        <div class="row">
            <div class="col-12">
                <label>Replace MUNCIPALITY DOCUMENT</label>
            </div>
            <div class="col-11 form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Replace MUNCIPALITY DOCUMENT</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input"   name="document">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="col-1 p-0">
                <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/mobile_fuel_tank_renewals/{{$data['muncipality']->document}}">
                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                </a>
            </div>
        </div>
        
        @else
        <div class="form-group">
            <label>MUNCIPALITY DOCUMENT Upload</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Upload MUNCIPALITY DOCUMENT</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input"   name="document">
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
        </div>
        @endif
        <div class="form-group">
            <label for="admin-status">Expiary Date</label>
            <input type="date" name="expiary_date" class="form-control" value="{{ $data['muncipality']->expiary_date }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    
    console.log($("[type='date']").attr("min",new_date) );

</script>