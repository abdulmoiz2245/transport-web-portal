<?php 
use App\Models\Company_name;
use App\Models\Muncipality_documents;
use App\Models\User;
use App\Models\Purchase_vehicle;



?>
<div class="container">
    <div class="d-flex" style="justify-content: space-between;">
        <div>
            <a href="{{ route( 'user.inventory') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
        </div>

        <div class=""> 
            <a href="{{ route( 'user.inventory.vehicle.vehicle_history') }}"target="_blank" class="ml-3">
                <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" title="History" width="30">
            </a>

            <a href="{{ route( 'user.inventory.vehicle.vehicle_trash') }}" class="ml-3" title="Trash" target="_blank">
                <img src="<?= asset('assets') ?>/images/trash.png" alt="" width="30">
            </a>
           
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
                                    <th>Id</th>
                                    <th>Date Added </th>
                                    <th>PO Number </th>
                                    <th>Vehicle Type</th>
                                    <th>Engine Number</th>
                                    <th>Chassis Number</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Color</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['vehicle'] as $vehicle)
                                @if($vehicle->row_status != 'deleted')
                                <tr> 
                                    <td>{{ $vehicle->id }}</td>
                                    <td>{{ $vehicle->created_at }}</td>
                                    <td>
                                            
                                            <?php if(Purchase_vehicle::all()->count() > 0){ ?>
                                                <?php $check = 0; ?>
                                            @foreach(Purchase_vehicle::all() as $purchase)
                                                @if($purchase->id == $vehicle->purchase_id)
                                                    <?php $check = 1 ?>
                                                    <span class="badge badge-pill badge-dark p-2 m-1">{{ $purchase->po_number}}</span>
                                                @endif
                                            @endforeach
                                            <?php if($check == 0){ ?>
                                                <span class="badge badge-pill badge-danger p-2 m-1">No PO Found</span>
                                            <?php } ?>
                                    
                                        <?php }else{ ?>
                                                <span class="badge badge-pill badge-danger p-2 m-1">No PO Found</span>
                                            <?php } ?>
                                    </td>

                                    <td>{{ $vehicle->vechicle_type }}</td>
                                    <td>{{ $vehicle->engine_number }}</td>
                                    <td>{{ $vehicle->chassis_no }}</td>
                                    <td>{{ $vehicle->make }}</td>
                                    <td>{{ $vehicle->model }}</td>
                                    <td>{{ $vehicle->color }}</td>
                                    <td>
                                        <form action="{{ route( 'user.inventory.vehicle.view_vehicle') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{ $vehicle->id }}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
                                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" title="View" width="34">
                                            </button>
                                        </form>
                                        <a href="#" id="{{  $vehicle->id }}" class="delete-file">
                                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" title="Delete" width="34">
                                        </a>

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
                    url:"{{ route( 'user.inventory.vehicle.delete_vehicle_status') }}",
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