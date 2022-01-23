<div class="container">
    <form action="{{ route('admin.setting.save_role') }}" method="post">
    @csrf
        <div class="form-group">
           
            <label for="exampleInputEmail1">Roll Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter Roll Name" required>
            
        </div>
        <div class="form-group">
            <label for="admin-status">Status</label>
            <select name="status" id="admin-status" class="form-control" required >
                <option value="1">Active</option>
                <option value="0">Inactive</option>

            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">Add Role</button>
    </form>
</div>