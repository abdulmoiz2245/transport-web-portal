<div class="container">
    <form action="{{ route('admin.setting.update_role') }}" method="post">
    @csrf
        <div class="form-group">
            <input type="text" class="form-control d-none" name="id" value ="{{$data['role']->id}}" placeholder="Enter id" >
            <label for="exampleInputEmail1">Roll Name</label>
            <input type="text" class="form-control"  value ="{{$data['role']->name}}"  name="name" placeholder="Enter Roll Name" required>
            
        </div>
        <div class="form-group">
            <label for="admin-status">Status</label>
            <select name="status" id="admin-status" class="form-control" required>
                <option value="1" <?php if ($data['role']->status == 1){ ?> selected="selected" <?php } ?> >Active</option>
                <option value="0" <?php if ($data['role']->status == 0){ ?> selected="selected" <?php } ?> >Inactive</option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Role</button>
    </form>
</div>