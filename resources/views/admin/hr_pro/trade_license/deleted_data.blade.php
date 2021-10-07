<?php
use App\Models\Company_name;
use App\Models\User;
use App\Models\Trade_license;
use App\Models\Office_Land_contract;
?>
<div class="container">
     <div class="mb-5"> 
        <a href="{{ route( 'admin.hr_pro.trade_license__sponsors__partners') }}">
            <button class="btn btn-primary">
                Back
            </button>
        </a>
    </div>

    


    <div class="table-responsive">
        <table class="display table responsive nowrap  " style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Trade Name</th>
                    <th>License Number</th>
                    <th>Company</th>
                    <th>Expiary Date</th>
                    <th>User Name</th>
                    <!-- <th>User Action</th> -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['trade_licenses'] as $trade_license)
                @if($trade_license->row_status == 'deleted')
                <tr>
                    <td>{{ $trade_license->id }}</td>
                    <td>{{ $trade_license->trade_name }}</td>
                    <td>{{ $trade_license->license_number }}</td>
                    
                    <td>
                        
                        <?php if(Company_name::all()->count() > 0){ ?>
                            <?php $check = 0; ?>
                        @foreach($data['company_names'] as $company_name)
                            @if($company_name->id == $trade_license->company_id)
                                <?php $check = 1 ?>
                                <span class="badge badge-pill badge-dark p-2 m-1">{{ $company_name->name}}</span>
                            @endif
                        @endforeach
                        <?php if($check == 0){ ?>
                            <span class="badge badge-pill badge-danger p-2 m-1">No Company Selected</span>
                        <?php } ?>
                
                    <?php }else{ ?>
                            <span class="badge badge-pill badge-danger p-2 m-1">No Company Selected</span>
                        <?php } ?>
                    </td>

                    <td>{{ $trade_license->expiary_date }}</td>

                    <td>
                        @if($trade_license->user_id == 0)
                            Admin
                        @else
                            @if(User::find($trade_license->user_id))
                                {{ User::find($trade_license->user_id)->username}}
                            @else
                                User Deleted
                            @endif
                        
                        @endif
                    </td>
                    <!-- <td><span class="badge badge-pill badge-success p-2 m-1">{{$trade_license->action }}</span></td> -->
                    <td>
                        <form action="{{ route( 'admin.hr_pro.view_trade_license__sponsors__partners') }}" method="post" class="d-inline">
                            @csrf
                            <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                            <button type="submit" class="border-0 .bg-white">
                                <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                            </button>
                        </form>

                       
                            
                        <a href="#" id="{{ $trade_license->id }}" class="delete-file">
                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                        </a>

                        <a href="#" id="{{ $trade_license->id }}"  class="restore-file"  >
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
                url:"{{ route( 'admin.hr_pro.restore_trade_license__sponsors__partners') }}",
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
                url:"{{ route( 'admin.hr_pro.delete_trade_license__sponsors__partners') }}",
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

<script>
function goBack() {
  window.history.back();
}

</script>