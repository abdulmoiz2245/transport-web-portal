<?php
use App\Models\Company_name;
use App\Models\User;
use App\Models\Trade_license;
use App\Models\Office_Land_contract;
?>
<div class="container">
    <div class="mb-5">
            <a href="{{ route( 'admin.inventory.fuel.readings') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
    </div>

    


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
                                    @if($fuel_transfer->row_status == 'deleted')
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
                                        <a href="#" id="{{ $fuel_transfer->id }}"  class="restore-file"  >
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
            // responsive: true, 
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
                url:"{{ route( 'admin.inventory.fuel.restore_fuel_reading') }}",
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
            text: "You want to delete this Data Permanently.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',  
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            $.ajax({
                type:'POST',
                url:"{{ route( 'admin.hr_pro.delete_mobile_civil_defence') }}",
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