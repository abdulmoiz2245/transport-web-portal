<?php 
use App\Models\Company_name;
use App\Models\Customer_info;

use App\Models\User;


?>
<div class="container">
    <div class="mb-5 text-right">
        <a href="{{ route('admin.customer.customer_rate_card') }}" class="mb-5">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
         </a>
    </div>
    <div class="table-responsive">
        <table class="display table responsive nowrap  " style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Customer Name</th>
                    <th>From</th>
                    <th>To</th>
                    <th>VEHICLE TYPE </th>
                    <th>Rate TYPE </th>
                    <th>Rate </th>
                    <th>Other Charges </th>
                    <th>Other Charges Description</th>
                    <th>Driver Comission </th>
                    <th>DETENTION </th>
                    <th>Days / Hours </th>
                    <th>Per Days Charges / Per Hours Charges</th>
                    <th>Trip Type </th>
                    <th>Ap Km as per trip: </th>
                    <th>Ap Diesel as per trip</th>


                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['customer_rate_card'] as $customer_rate_card)
                @if( $customer_rate_card->row_status == 'deleted')
                <tr>
                    <td>{{ $customer_rate_card->id }}</td>
                    <td>
                            @if($customer_rate_card->customer_id == 0)
                            Customer Deleted
                            @else
                                @if(Customer_info::find($customer_rate_card->customer_id))
                                    {{ Customer_info::find($customer_rate_card->customer_id)->name}}
                                @else
                                    Customer Deleted
                                @endif
                            
                            @endif
                    </td>
                    <!-- <td>{{ $customer_rate_card->customer_id }}</td> -->
                    <td>{{ $customer_rate_card->from }}</td>
                    <td>{{ $customer_rate_card->to }}</td>

                    <td>{{ $customer_rate_card->vechicle_type }}</td>
                    
                    <td>{{ $customer_rate_card->rate }}</td>
                    <td>{{ $customer_rate_card->rate_price }}</td>
                    <td>{{ $customer_rate_card->other_des }}</td>
                    <td>{{ $customer_rate_card->other_carges }}</td>
                    <td>{{ $customer_rate_card->driver_comission }}</td>
                    <td>{{ $customer_rate_card->detention }}</td>
                    <td>{{ $customer_rate_card->time }}</td>
                    <td>{{ $customer_rate_card->charges }}</td>
                    <td>{{ $customer_rate_card->trip }}</td>
                    <td>{{ $customer_rate_card->ap_km }}</td>
                    <td>{{ $customer_rate_card->ap_diesel }}</td>
                    <td>
                            
                        <a href="#" id="{{ $customer_rate_card->id }}" onclick="delete_fun(this.id)" class="delete-file">
                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                        </a>

                        <a href="#" id="{{ $customer_rate_card->id }}" onclick="restore_fun(this.id)" class="restore-file"  >
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

    function restore_fun(clicked_id) {

        console.log(clicked_id);
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
                url:"{{ route( 'admin.customer.restore_customer_rate_card') }}",
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

    function delete_fun(clicked_id) {

        console.log(clicked_id);
        var file_id = clicked_id;
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
                url:"{{ route( 'admin.customer.delete_customer_rate_card') }}",
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
    }
</script>