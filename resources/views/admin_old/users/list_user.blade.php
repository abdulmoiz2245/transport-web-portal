<?php
 use App\Models\Roles;
 ?><style>
    i{
        font-size:22px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-12 mb-5">
            @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif
            <a href="{{ route('admin.add_user') }}">
                <button class="btn btn-primary">
                    Generate New Email
                </button>
            </a>    
            
        </div>
        
        <br>
        <hr>
        <div class="col-12">
            <div class="table-responsive">
                <table id="deafult_ordering_table" class="display table  " style="width:100%">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Staus</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['users'] as $user)
                        <tr>
                            
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                    @if($user->status == 1)
                                    <span class="badge badge-pill badge-success p-2 m-1">
                                        Active
                                    </span>
                                    @else
                                    <span class="badge badge-pill badge-danger p-2 m-1">
                                        Inactive
                                    </span>
                                    @endif
                            </td>

                            <td>
                                
                                <?php if(Roles::all()->count() > 0){ ?>
                                    <?php $check = 0; ?>
                                @foreach($data['roles'] as $role)
                                    @if($role->id == $user->role_id)
                                        <?php $check = 1 ?>
                                        <span class="badge badge-pill badge-dark p-2 m-1">{{ $role->name}}</span>
                                    @endif
                                @endforeach
                                <?php if($check == 0){ ?>
                                    <span class="badge badge-pill badge-danger p-2 m-1">No Role Selected</span>
                                <?php } ?>
                                <!-- <span class="badge badge-pill badge-danger p-2 m-1">No Role Selected</span> -->
                               <?php }else{ ?>
                                    <span class="badge badge-pill badge-danger p-2 m-1">No Role Selected</span>
                                <?php } ?>
                            </td>
                            
                            <td>

                                <form action="{{ route ('admin.edit_user') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="text" class="form-control d-none" name="id" value ="{{$user->id}}" placeholder="Enter id" >
                                    <button type="submit" class="border-0 .bg-white">
                                            <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                    </button>
                                </form>
                                    
                               
                                <a href="#" id="{{ $user->id }}" class="delete-file">
                                       
                                       <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                               
                                </a>
                            </td>
                            
                        </tr>
                        @endforeach
                    </tbody>         
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $('.delete-file').click(function () {
            var file_id = this.id;
            swal({
                title: 'Are you sure?',
                text: "You want to delete this Email.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',  
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.ajax({
                    type:'POST',
                    url:"{{ route ('admin.delete_user') }}",
                    data:{id:file_id, _token :"{{ csrf_token() }}"},
                    success:function(data){
                            if (data.status == 1) {
                                swal({
                                    title: "Deleted!",
                                    text: "Email has been deleted.",
                                    type: "success"
                                }).then(function () {
                                    window.location.href = '';
                                });
                            }else{
                                toastr.error("Some thing went wrong. ");

                            }
                    }
                 });
                // $.post('/portal/admin/delete/'+ file_id,
                //         function (data, status) {
                //             console.log(data);
                //             if (status === 'success') {
                //                 swal({
                //                     title: "Deleted!",
                //                     text: "Admin has been deleted.",
                //                     type: "success"
                //                 }).then(function () {
                //                     window.location.href = '';
                //                 });
                //             }
                //         });

            })
    });

    
</script>