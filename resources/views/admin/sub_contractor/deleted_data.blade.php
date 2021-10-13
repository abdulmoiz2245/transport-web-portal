<?php
use App\Models\User;
?>
<div class="container">
    <div class="mb-5">
        <a href="{{ route('admin.sub_contractor.sub_contractor') }}" class="mb-5">
            <button class="btn btn-primary">
                Back
            </button>
         </a>
    </div>
    <div class="table-responsive">
        <table class="display table responsive nowrap  " style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Sub Contractor Name</th>
                    <th>Sub Contractor Email</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['customer_info'] as $customer_info)
                @if($customer_info->status == 'approved')
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
                    <td>
                            
                        <a href="#" id="{{ $customer_info->id }}" class="delete-file">
                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                        </a>

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
                url:"{{ route( 'admin.sub_contractor.restore_sub_contractor') }}",
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
            text: "You want to delete this Data.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',  
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            $.ajax({
                type:'POST',
                url:"{{ route( 'admin.sub_contractor.delete_sub_contractor') }}",
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