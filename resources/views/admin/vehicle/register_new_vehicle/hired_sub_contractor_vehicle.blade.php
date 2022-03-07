<?php 
use App\Models\Company_name;
use App\Models\User;
use App\Models\Trade_license;
use App\Models\Office_Land_contract;


  
?>
<div class="container">

    <div class="d-flex" style="justify-content: space-between;">
        <div>
            <a href="{{ route( 'admin.vehicle.register_new_vehicle') }}" class="ml-3">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
            <a href="{{ route( 'admin.vehicle.register_new_vehicle.add_hired_sub_contractor_vehicle') }}" class="ml-3">
                <img  src="<?= asset('assets') ?>/images/add-button.png" alt="" width="30">
            </a>
        </div>
        
        <div class=""> 
            <a href="{{ route( 'admin.vehicle.register_new_vehicle.register_new_vehicle_history') }}"target="_blank" class="ml-3">
                    <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="30">
            </a> 
            <a href="{{ route( 'admin.vehicle.register_new_vehicle.trash_register_new_vehicle') }}" class="ml-3" target="_blank">
                <img  src="<?= asset('assets') ?>/images/trash.png" alt="" width="30">
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
                            <table  class="display table table2  nowrap " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Daily Reading - Non Mobile Tank 01</th>
                                        <th>Refill Amount - Non Mobile Tank 01</th>
                                        <th>Daily Reading - Non Mobile Tank 02</th>
                                        <th>Refill Amount - Non Mobile Tank 02</th>
                                        <th>Daily Reading - Mobile Tank 01</th>
                                        <th>Refill Amount - Mobile Tank 01</th>
                                        <th>Daily Reading - Mobile Tank 02</th>
                                        <th>Refill Amount - Mobile Tank 02</th>
                                        <th>Fuel Enter</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['fuel_transfers'] as $fuel_transfer)
                                    @if($fuel_transfer->row_status != 'deleted')
                                    <tr>
                                        <td class="">{{ $fuel_transfer->id }}</td>
                                        <td class="">{{ $fuel_transfer->date }}</td>
                                        <td class="text-center">
                                            <img src="<?= asset('assets') ?>/images/readings.png" alt=""style="
                                                    width: 23px;
                                                " >
                                            {{ $fuel_transfer->non_mobile_1_reading }}
                                        </td>
                                        <td class="text-center"> 
                                            <!-- <span style="background-color: forestgreen;"> -->
                                                <img src="<?= asset('assets') ?>/images/refilling.png" alt=""style="
                                                    width: 23px;
                                                " >
                                            <!-- </span> -->
                                            
                                            {{ $fuel_transfer->non_mobile_1_refill_amount }}
                                        </td>
                                        <td class="text-center">
                                            <img src="<?= asset('assets') ?>/images/readings.png" alt=""style="
                                                    width: 23px;
                                                " >
                                            {{ $fuel_transfer->non_mobile_2_reading }}
                                        </td>
                                        <td class="text-center">
                                            <img src="<?= asset('assets') ?>/images/refilling.png" alt=""style="
                                                    width: 23px;
                                                " >
                                            {{ $fuel_transfer->non_mobile_2_refill_amount }}
                                        </td>
                                        <td class="text-center">
                                            <img src="<?= asset('assets') ?>/images/readings.png" alt=""style="
                                                    width: 23px;
                                                " >
                                            {{ $fuel_transfer->mobile_1_reading }}
                                        </td>
                                        <td class="text-center">
                                            <img src="<?= asset('assets') ?>/images/refilling.png" alt=""style="
                                                    width: 23px;
                                                " >
                                            {{ $fuel_transfer->mobile_1_refill_amount }}
                                        </td>
                                        <td class="text-center">
                                            <img src="<?= asset('assets') ?>/images/readings.png" alt=""style="
                                                    width: 23px;
                                                " >
                                            {{ $fuel_transfer->mobile_2_reading }}
                                        </td>
                                        <td class="text-center">
                                            <img src="<?= asset('assets') ?>/images/refilling.png" alt=""style="
                                                    width: 23px;
                                                " >
                                            {{ $fuel_transfer->mobile_2_refill_amount }}
                                        </td>
                                        <td class="text-center">
                                            {{ $fuel_transfer->fuel_enter }}
                                        </td>

                                        <td>

                                            <form action="{{ route( 'admin.vehicle.register_new_vehicle.view_hired_sub_contractor_vehicle') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 bg-white">
                                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                                </button>
                                            </form>
                                            <form action="{{ route( 'admin.vehicle.register_new_vehicle.edit_hired_sub_contractor_vehicle') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{ $fuel_transfer->id }}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 bg-white">
                                                        <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                                </button>
                                            </form>
                                                
                                        
                                            <a href="#" id="{{ $fuel_transfer->id }}" class="delete-file">
                                                
                                                <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                                        
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
            $('.table2').DataTable( {
                dom: 'Bfrtip',
                
                
                buttons: [
                
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );
        });

        $(document).ready(function() {
            $('.table1').DataTable( {
                dom: 'Bfrtip',
                
            
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
                    url:"{{ route( 'admin.inventory.fuel.delete_fuel_reading_status') }}",
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

    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    
    console.log($("[type='date']").attr("min",new_date) );
</script>