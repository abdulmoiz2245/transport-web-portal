<div class="container">
    <form action="{{ route('admin.hr_pro.update_non_mobile_muncipality') }}" method="post" enctype="multipart/form-data">
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
        <div class="form-group">
            <label>Replace MUNCIPALITY DOCUMENT</label>
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