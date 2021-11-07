<?php 
use App\Models\Company_name;
use App\Models\Customer_info;
use App\Models\Trade_license;   

use App\Models\User;


?>
<div class="container">
    <div class="mb-5">
        <a href="{{ route('admin.hr_pro.trade_license__sponsors__partners') }}" class="mb-5">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
         </a>
    </div>
    <div class="table-responsive">
        <table class="display table responsive nowrap  " style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Trade Name</th>
                    <th>Id Copy</th>
                    <th>Passport Copy</th>
                    <th>Visa Copy</th>
                    <th>Other</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['trade_license_partners'] as $customer_rate_card)
                @if( $customer_rate_card->row_status == 'deleted')
                <tr>
                    <td>{{ $customer_rate_card->id }}</td>

                    <td>
                            @if($customer_rate_card->customer_id == 0)
                            Trade Deleted
                            @else
                                @if(Trade_license::find($customer_rate_card->trade_license_id))
                                    {{ Trade_license::find($customer_rate_card->trade_license_id)->trade_name}}
                                @else
                                    Trade Deleted
                                @endif
                            
                            @endif
                    </td>

                    <td>
                        <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->document}}">
                            <button class="btn">View</button>
                        </a>

                        <a  download href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->document}}">
                            <button class="btn">Download</button>
                        </a>
                    </td>

                    <td>
                        <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->document}}">
                            <button class="btn">View</button>
                        </a>

                        <a  download href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->document}}">
                            <button class="btn">Download</button>
                        </a>
                    </td>

                    <td>
                        <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->document}}">
                            <button class="btn">View</button>
                        </a>

                        <a  download href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->document}}">
                            <button class="btn">Download</button>
                        </a>
                    </td>

                    <td>
                        {{ $customer_rate_card->other }}
                    </td>
                    
                    
                    <td>
                                

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
                url:"{{ route( 'admin.hr_pro.restore_trade_license_partners') }}",
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
                url:"{{ route( 'admin.hr_pro.delete_trade_license_partners') }}",
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