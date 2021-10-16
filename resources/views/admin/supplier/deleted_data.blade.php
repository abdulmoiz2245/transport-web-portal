<?php
use App\Models\User;
?>
<div class="container">
    <div class="mb-5">
        <a href="{{ route('admin.supplier.supplier') }}" class="mb-5">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
         </a>
    </div>
    
    <div class="table-responsive">
        <table class="display table responsive nowrap  " style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Supplier Name</th>
                    <th>Supplier Email</th>
                    <th>Username</th>
                    <th>Date</th>
                    <!-- <th>User Action</th> -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['customer_info'] as $customer_info)
                @if($customer_info->row_status == 'deleted' )
                <tr>
                    <td>{{ $customer_info->id }}</td>
                    <td>{{ $customer_info->name }}</td>
                    <td>{{ $customer_info->email }}</td>
                    <td>
                    @if($customer_info->user_id == 0)
                                                Admin
                                            @else
                                               @if(User::find($customer_info->user_id))
                                                    {{ User::find($customer_info->user_id)->username}}
                                               @else
                                                    User Deleted
                                               @endif
                                            
                                            @endif
                    </td>
                    <!-- <td><span class="badge badge-pill badge-success p-2 m-1">{{$customer_info->action }}</span></td> -->
                    <!-- <td><span class="badge badge-pill badge-success p-2 m-1">{{$customer_info->action }}</span></td> -->
                    <td>{{ $customer_info->updated_at }}</td>
                    <td>
                        <form action="{{ route( 'admin.supplier.view_supplier') }}" method="post" class="d-inline">
                            @csrf
                            <input type="text" class="form-control d-none" name="id" value ="{{$customer_info->id}}" placeholder="Enter id" >
                            <button type="submit" class="border-0 .bg-white">
                                <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                            </button>
                        </form>

                        <!-- <form action="{{ route( 'admin.customer.edit_customer') }}" method="post" class="d-inline">
                            @csrf
                            <input type="text" class="form-control d-none" name="id" value ="{{$customer_info->id}}" placeholder="Enter id" >
                            <button type="submit" class="border-0 .bg-white">
                                    <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                            </button>
                        </form> -->
                            
                        <!-- <a href="#" id="{{ $customer_info->id }}" class="delete-file">
                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                        </a> -->

                        <a href="#" id="{{ $customer_info->id }}"  class="restore-file"  >
                            <!-- <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="34"> -->
                            <button class="btn btn-success">Restore</button>
                        </a>
                    </td>
                    
                </tr>
                @endif
                @endforeach
            </tbody>         
        </table>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.table').DataTable( {
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
              
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                // 'pdfHtml5'
            ]
        } );
    });

    $('.restore-file').click(function () {
        var file_id = this.id;
        swal({
            title: 'Are you sure?',
            text: "You want to Restore this Data.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',  
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'
        }).then(function () {
            $.ajax({
                type:'POST',
                url:"{{ route( 'admin.supplier.restore_supplier') }}",
                data:{id:file_id, _token :"{{ csrf_token() }}"},
                success:function(data){
                        if (data.status == 1) {
                            swal({
                                title: "Restored!",
                                text: "Data has been Restored.",
                                type: "success"
                            }).then(function () {
                                window.location.href = '';
                            });
                        }else{
                            toastr.error("Some thing went wrong. ");

                        }
                }
                });
            

        })
    });

    $('.delete-file').click(function () {
        var file_id = this.id;
        swal({
            title: 'Are you sure?',
            text: "You want to delete this Data Permenently.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',  
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            $.ajax({
                type:'POST',
                url:"{{ route( 'admin.supplier.delete_supplier') }}",
                data:{id:file_id, _token :"{{ csrf_token() }}"},
                success:function(data){
                        if (data.status == 1) {
                            swal({
                                title: "Deleted!",
                                text: "Data has been deleted.",
                                type: "success"
                            }).then(function () {
                                window.location.href = '';
                            });
                        }else{
                            toastr.error("Some thing went wrong. ");

                        }
                }
                });
            

        })
    });
</script>