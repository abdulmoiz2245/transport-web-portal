<style>
    .badge {
  display: inline-block;
  font-size: 13px;
  font-weight: 600;
  /* padding: 3px 6px; */
  border: 1px solid transparent;
  /* min-width: 10px; */
  /* line-height: 1; */
  color: #000;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  border-radius: 99999px
}

.badge.badge-default {
  background-color: #B0BEC5
}

.badge.badge-primary {
  background-color: #2196F3
}

.badge.badge-secondary {
  background-color: #323a45
}

.badge.badge-success {
  background-color: #64DD17
}

.badge.badge-warning {
  background-color: #FFD600
}

.badge.badge-info {
  background-color: #29B6F6
}

.badge.badge-danger {
  background-color: #ef1c1c
}

.badge.badge-outlined {
  background-color: transparent
}

.badge.badge-outlined.badge-default {
  border-color: #B0BEC5;
  color: #000
}

.badge.badge-outlined.badge-primary {
  border-color: #2196F3;
  color: #000
}

.badge.badge-outlined.badge-secondary {
  border-color: #323a45;
  color: #000
}

.badge.badge-outlined.badge-success {
  border-color: #64DD17;
  color: #000
}

.badge.badge-outlined.badge-warning {
  border-color: #FFD600;
  color: #000;
}

.badge.badge-outlined.badge-info {
  border-color: #29B6F6;
  color: #000;
}

.badge.badge-outlined.badge-danger {
  border-color: #ef1c1c;
  color: #000
}
</style>
<div class="card">
    <div class="container pt-3">

    
    <div class="d-flex" style="justify-content: space-between;">
        <div>
            <a href="{{ route( 'admin.operations.manage_booking') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
            
    </div>
    <div class=""> 
            

            <a href="{{ route( 'admin.operations.booking_history') }}"target="_blank" class="ml-3">
                    <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="30">
            </a> 

            <!-- <a href="{{ route( 'admin.operations.trash_booking') }}" target="_blank" class="ml-3">
                <img  src="<?= asset('assets') ?>/images/trash.png" alt="" width="30">
            </a> -->
        </div>

        
    </div>
    <div class="card-body">
        <div class="container">
            @if (session('success'))
            <div class="alert alert-success mb-3" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger mb-3" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @endif
            <div class="table-responsive ">
                <table class="display table  nowrap  " style="width:100%">
                    <thead>
                        <tr>
                            <th>Job Id</th>
                            <th>Sr No</th>
                            <!-- <th>Booking Staus</th> -->
                            <th>Customer Name</th>
                            <th>Vehicle Number</th>
                            <th>Status Update</th>
                            <th>From </th>
                            <th>To</th>
                            <th>Booking Date</th>
                            <th>Loading Date</th>
                            <th>Off Loading Date</th>
                            <th>Modified At </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['booking'] as $booking)
                       
                        
                            @if( $booking->row_status == 'deleted' )
                            
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->sr_no }}</td>
                                <!-- <td class='text-center'><span class="badge badge-success ">{{ $booking->booking_status }}</span></td> -->
                                <td>{{ $booking->customer_name }}</td>
                                <td>
                                            
                                        <?php if($data['vehicle']->count() > 0){ ?>
                                            <?php $check = 0; ?>
                                        @foreach($data['vehicle'] as $vehicle)
                                            @if($vehicle->id == $booking->vehicle_id)
                                                <?php $check = 1 ?>
                                                <span class="badge badge-success badge-outlined ">{{ $vehicle->vehicle_number}}</span>
                                            @endif
                                        @endforeach
                                        <?php if($check == 0){ ?>
                                            <span class="badge badge-danger badge-outlined ">No Vehicle Selected</span>
                                        <?php } ?>
                                
                                    <?php }else{ ?>
                                            <span class="badge badge-danger badge-outlined ">No Vehicle Selected</span>
                                        <?php } ?>
                                </td>

                                <td class="d-flex">
                                    <span class="badge badge-success badge-outlined ">{{ $booking->status_update }}</span>
                                </td>
                                <td><span class="badge badge-pill badge-warning">{{ $booking->from_location }}</span></td>

                                <td><span class="badge badge-pill badge-warning">{{ $booking->to_location }}</span> </td>
                                
                                <td>{{ $booking->booking_date }}</td>
                                <td>{{ $booking->loading_date }}</td>
                                <td>{{ $booking->offloading_date }}</td>
                                <td>{{ $booking->updated_at }}</td>

                                <td>
                                    <form action="{{ route( 'admin.operations.view_booking') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$booking->id}}" placeholder="Enter id" >
                                        <button type="submit" class="border-0 bg-white">
                                            <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                        </button>
                                    </form>
                                    <!-- <a href="#" id="{{ $booking->id }}" onclick="restore_fun(this.id)" class="restore-file"  >
                                        <button class="btn btn-success">Restore</button>
                                    </a> -->
                                    
                                </td>
                            </tr>
                        
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>        
    </div>
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
            ]
        } );

        $('.status_change').click(function (event) {
            var file_id = this.id;
            console.log(this.id);
            // console.log(event.target.getAttribute("vehicle_id"));

            document.getElementById('booking_status_id').value = this.id;
            // document.getElementById('vehicle_id').value = event.target.getAttribute("vehicle_id");

        });

        $('#status_update').on('change', function(){
            if(this.value == "Vehicle break down"){
                $('#vehicle_break_status').show();
                $('#repair_person_name').show();

            }else{
                $('#vehicle_break_status').hide();
                $('#repair_person_name').hide();
            }
        });

        $('#vehicle_break_status').hide();
        $('#repair_person_name').hide();
    });

    function restore_fun(clicked_id) {
        console.log(clicked_id);
        // $('.restore-file').click(function () {
        var file_id = clicked_id;
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
                url:"{{ route('admin.operations.restore_booking') }}",
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
    }

</script>