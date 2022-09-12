
<?php 
use App\Models\account_cheque;
?>
<style>
    /* Style the tab */
.tab {
  /* overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1; */
  margin-bottom: 20px;
}

.badge{
  font-size: 12px;
}

/* Style the buttons inside the tab */
.tab button {
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 14px;
    border-radius: 9px;
    margin-right: 26px;
    background-color: #ddd;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #08c;
    color: #fff;
}

/* Style the tab content */
.tabcontent {
  display: none;
  /* padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none; */
}

._dot {
    width: 5px;
    height: 5px;
    background-color: #fff;
    border-radius: 50%;
}
._inline-dot {
    display: inline-block;
}
</style>

<div class="tab" >
<!--     
  <a href="{{ route('admin.account.paid_purchase') }}">
    <button class="tablinks active" onclick="openCity(event, 'approved')"> Assign / Unassign Vehicle </button>
  </a> -->
  
  <!-- <button class="tablinks">Assign/Unassign Trailer</button> -->
  <!-- <button class="tablinks">History/Detail</button> -->

</div>

<div class="container">
    <div class="d-flex mt-3 mb-3" style="justify-content: space-between;">
        <div>
            <a href="{{ route( 'admin.vehicle.assign_vehicle') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
        </div>

            
    </div>
   
    <div class="table-responsive">
        <table class="display table  nowrap  " style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Vehicle Number </th>
                    <th>Trailer Chassis Number</th>
                    <th>Driver Name</th>
                    <th>Status</th>
                    <th>Assign Date</th>
                    <th>Unassign Date</th>
                    <th>Edited At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['assign_vehicle'] as $assign_vehicle)
                @if($assign_vehicle->row_status == 'deleted')
                <tr> 
                    <td>{{ $assign_vehicle->id }}</td>
                    <td>
                        @foreach($data['vehicle'] as $vehicle)
                            @if($vehicle->id == $assign_vehicle->vehicle_id)
                                {{ $vehicle->vehicle_number }}
                            @else
                                
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($data['vehicle'] as $vehicle)
                            @if($vehicle->id == $assign_vehicle->trailer_id)
                                {{ $vehicle->chassis_number }}
                            @else
                                
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($data['driver'] as $driver)
                            @if($driver->id == $assign_vehicle->driver_id)
                                {{ $driver->name }}
                            @else
                               
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if($assign_vehicle->vehicle_status == 'assigned')
                        <span class="badge badge-pill badge-success">{{ $assign_vehicle->vehicle_status }}</span>
                        @else($assign_vehicle->vehicle_status == 'unassigned')
                        <span class="badge badge-pill badge-danger">{{ $assign_vehicle->vehicle_status }}</span>

                        @endif
                    </td>
                    <td> <span class="badge badge-pill badge-success"></span> {{ $assign_vehicle->assign_date }}</td>
                    <td>{{ $assign_vehicle->unassign_date }}</td>
                    <td>{{ $assign_vehicle->updated_at }}</td>


                    <td>
                        <form action="{{ route( 'admin.vehicle.view_assigned_unassigned_vehicle') }}" method="post" class="d-inline">
                            @csrf
                            <input type="text" class="form-control d-none" name="id" value ="{{ $assign_vehicle->id }}" placeholder="Enter id" >
                            <button type="submit" class="border-0 .bg-white">
                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" title="View" width="34">
                            </button>
                        </form>
                    
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
                
                // responsive: true,
                buttons: [
                
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );

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
                    url:"{{ route( 'admin.vehicle.delete_assign_unassign_vehicle') }}",
                    data:{id:file_id, _token :"{{ csrf_token() }}"},
                    success:function(data){
                            if (data.status == 1) {
                                swal({
                                    title: "Deleted!",
                                    text: "Data has been moved to trash.",
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

       

    });
</script>