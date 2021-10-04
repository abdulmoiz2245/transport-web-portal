<?php
 use App\Models\Roles;
 ?>
<div class="container">
   <form action="{{ route('admin.save_user') }}" method="post">
        @csrf
        <div class="form-group">
            <label >Username</label>
            <input type="text" name="username" class="form-control form-control-rounded"  placeholder="Enter Username" required>
        </div>
        <div class="form-group">
            <label >Email</label>
            <input type="email" name="email" class="form-control form-control-rounded"  placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label >Select Role</label>
            <?php if(Roles::all()->count() > 0){ ?>
                <select name="role" class="form-control "required >
                    
                    @foreach($data['roles'] as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            <?php } else{ ?>
               <h5 class="text-danger">Please Add Role First </h5> 
            <?php } ?>
        </div>
        <div class="form-group">
            <label for="admin-status">Status</label>
            <select name="status" id="admin-status" class="form-control" required>
                <option value="1"  >Active</option>
                <option value="0"  >Inactive</option>
            </select>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="text" name="password" class="form-control form-control-rounded"  placeholder="Enter Password">
        </div>
        <?php if(Roles::all()->count() > 0){ ?>
        <div class="text-center mt-5">
            <input type="submit" class="btn btn-outline-secondary rounded-pill" value="Submit">
        </div>
        <?php } else{ ?>
        <div class="text-center mt-5">
            <h5 class="text-danger">Please Add Role First </h5> 
        </div>

            <?php } ?>
   </form>
    
</div>