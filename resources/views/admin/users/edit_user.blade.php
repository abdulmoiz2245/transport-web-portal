<?php
 use App\Models\Roles;
 ?>
<div class="container">
   <form action="{{ route('admin.update.user') }}" method="post">
        @csrf
        <input type="text" name="id" value="{{ $data['user']->id }}" class="d-none">
        <div class="form-group">
            <label >Username</label>
            <input type="text" name="username" class="form-control "  placeholder="Enter Username" value="{{ $data['user']->username }}" required>
        </div>
        <div class="form-group">
            <label >Email</label>
            <input type="email" name="email" class="form-control"  placeholder="Enter email" value="{{ $data['user']->email }}" required>
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
            <select name="status" id="admin-status" class="form-control"required >
                <option value="1" <?php if ($data['user']->status == 1){ ?> selected="selected" <?php } ?> >Active</option>
                <option value="0" <?php if ($data['user']->status == 0){ ?> selected="selected" <?php } ?> >Inactive</option>
            </select>
        </div>
        <div class="form-group">
            <p class=" pass btn btn-primary" id="change-password"> Change Password</p>
            <div class="change_pass">
                <div class="form-group">
                    <label for="edit_password">Password</label>
                    <input type="text" name = "password" class="form-control"  placeholder="Enter Password" >
                    <small>If you leave this field then the previous password remains in record</small>
                </div>
                <div class="form-group">
                    <label>Repeate Password</label>
                    <input type="text" name="repeate_password" class="form-control "  placeholder="Repeate Password">
                    <small>If you leave this field then the previous password remains in record</small>
                </div>
            </div>
            
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

<script>
        $(".change_pass").hide();

    $(document).ready(function(){
        $('select option[value="{{  $data['user']->role_id }}"]').attr("selected",true);

        $(".pass").click(function(){
            $(".pass").hide();
            $(".change_pass").show();
        });
    });
    
</script>