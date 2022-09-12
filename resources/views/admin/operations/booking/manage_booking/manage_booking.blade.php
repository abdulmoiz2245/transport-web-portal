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
            <a href="{{ route( 'admin.operations') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
            
    </div>
    <div class=""> 
            

            <a href="{{ route( 'admin.operations.booking_history') }}"target="_blank" class="ml-3">
                    <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="30">
            </a> 

            <a href="{{ route( 'admin.operations.trash_booking') }}" target="_blank" class="ml-3">
                <img  src="<?= asset('assets') ?>/images/trash.png" alt="" width="30">
            </a>
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
                            <th>Booking Staus</th>
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
                       
                        
                            @if( $booking->row_status != 'deleted'  && $booking->status == 'approved' )
                            
                            <tr>
                                <td>{{ $booking->id }}</td>
                                <td>{{ $booking->sr_no }}</td>
                                <td class='text-center'><span class="badge badge-success ">{{ $booking->booking_status }}</span></td>
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
                                    <div class="status_change"  data-toggle="modal" data-target="#status_model" id="{{ $booking->id }}" style="margin-left: 11px;">
                                        <i class="i-Pen-2" style="font-size: 19px;"></i>
                                    </div>
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
                                    <a href="#" id="{{ $booking->id }}" class="delete-file">
                                        <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                                    </a>
                                    
                                </td>
                            </tr>
                        
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="modal fade" id="status_model"  data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="{{ route('admin.operations.booking_status_update') }}" method="post" enctype="multipart/form-data">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Status Update</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <input type="number" name="booking_status_id"  id="booking_status_id" class="d-none">
                                    @csrf
                                
                                    <div class="col-md-12 form-group mb-3">
                                        <label for=" ">Status Update</label>
                                        <select name="status_update" id="status_update" class="form-control" placeholder="">
                                            <option value="" selected disabled></option>
                                           <option value="Vehicle in transit for loading"> Vehicle in transit for loading</option>
                                           <option value="Vehicle loaded">Vehicle loaded</option>
                                           <option value="Vehicle in transit to make delievery">Vehicle in transit to make delievery </option>
                                           <option value="Cargo off loaded">Cargo off loaded </option>
                                           <option value="Vehicle break down">Vehicle break down </option>
                                           <option value="Vehicle repaired">Vehicle repaired </option>

                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group mb-3" id="vehicle_break_status">
                                        <label for=" ">Break Down Intensity</label>
                                        <select name="vehicle_break_status"  class="form-control" placeholder="">
                                            <option value="minor">Minor</option>
                                            <option value="major">Major</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12 form-group mb-3" id="repair_person_name">
                                        <label for=" ">Breakdown Repair Person Name</label>
                                        <input type="text" class="form-control"  name="vehicle_break_repaier_person_name"  placeholder="">
                                    </div>
                                    
                                </div>    
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
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
                    url:"{{ route( 'admin.operations.delete_booking_status') }}",
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