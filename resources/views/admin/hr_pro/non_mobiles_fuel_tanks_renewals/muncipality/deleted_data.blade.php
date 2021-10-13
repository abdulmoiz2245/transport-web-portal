<?php
use App\Models\Company_name;
use App\Models\User;
use App\Models\Trade_license;
use App\Models\Office_Land_contract;
?>
<div class="container">
     <div class="mb-5 text-right"> 
        <a href="{{ route( 'admin.hr_pro.non_mobile_muncipality') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>

    


    <div class="table-responsive">
        <table class="display table responsive nowrap  " style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Document</th>
                    <th>Expiary Date</th>
                    <!-- <th>Username</th> -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($data['muncipality'] as $civil_defense)
            @if($civil_defense->row_status == 'deleted')
            <tr>
                
                <td>
                    <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/non_mobile_fuel_tank_renewals/{{$civil_defense->document}}">
                        <button class="btn">View</button>
                    </a>

                    <a  download href="{{ asset('main_admin') }}/hr_pro/non_mobile_fuel_tank_renewals/{{$civil_defense->document}}">
                        <button class="btn">Download</button>
                    </a>
                </td>
                <td>{{ $civil_defense->expiary_date }}</td>
                <td>
                    
                        @if($civil_defense->user_id == 0)
                            Admin
                        @else
                            @if(User::find($civil_defense->user_id))
                                {{ User::find($civil_defense->user_id)->username}}
                            @else
                                User Deleted
                            @endif
                        
                        @endif
                </td>
                    <!-- <td><span class="badge badge-pill badge-success p-2 m-1">{{$civil_defense->action }}</span></td> -->
                    <td>
                        <!-- <form action="{{ route( 'admin.hr_pro.view_trade_license__sponsors__partners') }}" method="post" class="d-inline">
                            @csrf
                            <input type="text" class="form-control d-none" name="id" value ="{{$civil_defense->id}}" placeholder="Enter id" >
                            <button type="submit" class="border-0 .bg-white">
                                <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                            </button>
                        </form> -->

                       
                            
                        <a href="#" id="{{ $civil_defense->id }}" class="delete-file">
                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                        </a>

                        <a href="#" id="{{ $civil_defense->id }}"  class="restore-file"  >
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
                url:"{{ route( 'admin.hr_pro.restore_non_mobile_muncipality') }}",
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
                url:"{{ route( 'admin.hr_pro.delete_non_mobile_muncipality') }}",
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