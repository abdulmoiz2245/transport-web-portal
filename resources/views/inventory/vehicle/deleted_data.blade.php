<?php
use App\Models\Company_name;
use App\Models\User;
use App\Models\Trade_license;
use App\Models\Office_Land_contract;
use App\Models\Purchase_vehicle;

?>
<div class="container">
     <div class="mb-5"> 
        <a href="{{ route( 'user.inventory.vehicle') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>

    <div class="table-responsive">
        <table class="display table  nowrap  " style="width:100%">
            <thead>
                <tr>
                    <tr>
                        <th>Id</th>
                        <th>Date </th>
                        <th>PO Number </th>
                        <th>Vehicle Type</th>
                        <th>Engine Number</th>
                        <th>Chassis Number</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Color</th>
                        <th>Action</th>
                    </tr>
                </tr>
            </thead>
            <tbody>
                @foreach($data['vehicle'] as $vehicle)
                @if($vehicle->row_status == 'deleted')
                <tr> 
                    <td>{{ $vehicle->id }}</td>
                    <td>{{ $vehicle->created_at }}</td>
                    <td> <?php 
                            if(Purchase_vehicle::all()->count() > 0){ ?>
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
                        <a href="#" id="{{ $vehicle->id }}"  class="restore-file"  >
                           
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
            text: "You want to Restore this Data .",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',  
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'
        }).then(function () {
            $.ajax({
                type:'POST',
                url:"{{ route( 'user.inventory.vehicle.restore_vehicle_entry') }}",
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

    
</script>

<script>
function goBack() {
  window.history.back();
}

</script>