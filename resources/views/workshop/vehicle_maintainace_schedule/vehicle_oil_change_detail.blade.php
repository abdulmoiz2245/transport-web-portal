<?php 
use App\Models\Company_name;
use App\Models\Muncipality_documents;
use App\Models\User;


?>
<style>
    .badge{
        font-size:12px;
    }
</style>
<div class="container">
    <div class="d-flex" style="justify-content: space-between;">
        <div>
            <a href="{{ route( 'user.workshop.vehicle_maintainace_schedule') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
        </div>

        <div class=""> 
            <!-- <a href="{{ route( 'user.workshop.job_card_history') }}"target="_blank" class="ml-3">
                <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" title="History" width="30">
            </a>

            <a href="{{ route( 'user.workshop.trash_job_card') }}" class="ml-3" title="Trash" target="_blank">
                <img src="<?= asset('assets') ?>/images/trash.png" alt="" width="30">
            </a> -->
           
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
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
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="approved-tab">
                    <div class="table-responsive">
                        <table class="display table  nowrap  " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Job Card Number</th>
                                    <th>Vehicle Number </th>
                                    <th>Driver Name </th>
                                    <th>Mechanic Name</th>
                                    <!-- <th>Ap Km</th> -->
                                    <!-- <th>Findings</th> -->
                                    <!-- <th>Status</th> -->
                                    <th>Date </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['workshop'] as $workshop)
                                @if($workshop->row_status != 'deleted')
                                <tr> 
                                    <td>{{ $workshop->id }}</td>
                                    <td>
                                                 
                                        <?php if($data['vehicle']->count() > 0){ ?>
                                                    <?php $check = 0; ?>
                                                @foreach($data['vehicle'] as $vehicle)
                                                    @if($vehicle->id == $workshop->vehicle_id)
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
                                   
                                    <td>
                                                
                                        <?php if($data['employee']->count() > 0){ ?>
                                            <?php $check = 0; ?>
                                        @foreach($data['employee'] as $driver)
                                            @if($driver->id == $workshop->driver_id)
                                                <?php $check = 1 ?>
                                                <span class="badge badge-success badge-outlined ">{{ $driver->name}}</span>
                                            @endif
                                        @endforeach
                                        <?php if($check == 0){ ?>
                                            <span class="badge badge-danger badge-outlined ">Driver Not Exist</span>
                                        <?php } ?>
                                
                                            <?php }else{ ?>
                                            <span class="badge badge-danger badge-outlined ">Driver Not Exist</span>
                                        <?php } ?>
                                    </td>

                                    <td>
                                                
                                        <?php if($data['employee']->count() > 0){ ?>
                                            <?php $check = 0; ?>
                                        @foreach($data['employee'] as $employee)
                                            @if($employee->id == $workshop->mechanic_id)
                                                <?php $check = 1 ?>
                                                <span class="badge badge-success badge-outlined ">{{ $employee->name}}</span>
                                            @endif
                                        @endforeach
                                        <?php if($check == 0){ ?>
                                            <span class="badge badge-danger badge-outlined ">employee Not Exist</span>
                                        <?php } ?>
                                
                                            <?php }else{ ?>
                                            <span class="badge badge-danger badge-outlined ">employee Not Exist</span>
                                        <?php } ?>
                                    </td>
                                    
                                    <td>{{ $workshop->date }}</td>


                                    <td>
                                        <form action="{{ route( 'user.workshop.view_job_card') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{ $workshop->id }}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
                                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" title="View" width="34">
                                            </button>
                                        </form>
                                        <!-- <form action="{{ route( 'user.workshop.edit_job_card') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$workshop->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 bg-white">
                                                    <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                            </button>
                                        </form> -->
                                        <!-- <a href="#" id="{{  $workshop->id }}" class="delete-file">
                                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" title="Delete" width="34">
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
</div>

<script>
    $(document).ready(function() {
        $('.table').DataTable( {
            dom: 'Bfrtip',
            //responsive: true,
            buttons: [
              
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        } );
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
                    url:"{{ route( 'user.workshop.delete_job_card_status') }}",
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
    
    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');  
    console.log($("[type='date']").attr("min",new_date) );
 
</script>