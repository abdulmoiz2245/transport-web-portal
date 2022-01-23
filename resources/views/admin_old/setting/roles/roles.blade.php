<?php //dd( $data['roles']) ?><style>
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
            <a href="{{ route('admin.setting.add_role') }}">
                <button class="btn btn-primary">
                    Add new Roles
                </button>
            </a>
            
        </div>
        
        <br>
        <hr>
        <div class="col-12">
            <div class="table-responsive">
                    <table id="deafult_ordering_table" class="display table table-striped " style="width:100%">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['roles'] as $role)
                            <tr>
                                
                                <td>{{ $role->name }}</td>
                                <td>
                                     @if($role->status == 1)
                                    <span class="badge badge-pill badge-success p-2 m-1">
                                        Active
                                    </span>
                                    @else
                                    <span class="badge badge-pill badge-danger p-2 m-1">
                                        Inactive
                                    </span>
                                    @endif
                                </td>
                                <td><a href=""></a>
                                    <form action="{{ route ('admin.setting.permission') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$role->id}}" placeholder="Enter id" >
                                        <button type="submit" class="border-0 .bg-white">
                                            <i class="i-Receipt-4"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
  
                                    <form action="{{ route ('admin.setting.edit_role') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$role->id}}" placeholder="Enter id" >
                                        <button type="submit" class="border-0 .bg-white">
                                                <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                        </button>
                                    </form>
                                    <a href="#" id="{{$role->id}}" class="delete-file">
                                       
                                       <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                               
                                    </a>
                                    <!-- <form action="{{ route ('admin.setting.delete_role') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$role->id}}" placeholder="Enter id" >
                                        <button type="submit" class="border-0 .bg-white">
                                                <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                                        </button>
                                    </form> -->
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
                text: "You want to delete this Role.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',  
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.ajax({
                    type:'POST',
                    url:"{{ route ('admin.setting.delete_role') }}",
                    data:{id:file_id, _token :"{{ csrf_token() }}"},
                    success:function(data){
                            if (data.status == 1) {
                                swal({
                                    title: "Deleted!",
                                    text: "Role has been deleted.",
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