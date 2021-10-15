<?php 
use App\Models\Company_name;
use App\Models\Customer_rate_card;
use App\Models\Customer_info;
use App\Models\Sub_contractor_info;



use App\Models\User;


?>
<div class="container">
    <div class="d-flex mb-3" style="justify-content: space-between;">
        <div class="">
            <a href="{{ route( 'user.sub_contractor') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
        </div>

        
        <div class=""> 
           

            <a href="{{ route( 'user.sub_contractor.sub_contractor_history') }}"target="_blank" class="ml-3">
                    <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="30">
            </a>

        </div>

        
    </div>
    
    <div class="row mt-3">
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
            <ul class="nav nav-tabs mt-3 mb-5" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="approved-tab" data-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="true"> <b>Approved </b> </a>
                </li>
                <li class="nav-item">
                    
                    <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">  <b>Pending </b> </a>
                </li>
                <li class="nav-item">
                    
                    <a class="nav-link" id="rejected-tab" data-toggle="tab" href="#rejected" role="tab" aria-controls="rejected" aria-selected="false">  <b>Rejected </b> </a>
                </li>
            </ul>
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                    <div class="table-responsive">
                        <table class="display table responsive nowrap  " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Sub Contractor</th>
                                    <th>Customer Name</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>VEHICLE TYPE </th>
                                    <th>Rate TYPE </th>
                                    <th>Rate </th>
                                    <th>Other Charges </th>
                                    <th>Other Charges Description</th>
                                    <th>Ap Km as per trip: </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['sub_contractor_rate_cards'] as $customer_rate_card)
                                @if($customer_rate_card->status == 'approved' && $customer_rate_card->row_status != 'deleted')
                                @if(Sub_contractor_info::find($customer_rate_card->sub_contractor_id) != null)
                                @if(Sub_contractor_info::find($customer_rate_card->sub_contractor_id)->row_status != 'deleted')
                                <tr>
                                    <td>{{ $customer_rate_card->id }}</td>
                                    <td>
                                            @if($customer_rate_card->sub_contractor_id == 0)
                                            Sub Contractor Deleted
                                            @else
                                               @if(Sub_contractor_info::find($customer_rate_card->sub_contractor_id))
                                                    {{ Sub_contractor_info::find($customer_rate_card->sub_contractor_id)->name}}
                                               @else
                                                    Sub Contractor Deleted
                                               @endif
                                            
                                            @endif
                                    </td>
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
                                    <td>{{ $customer_rate_card->ap_km }}</td>

                                    
                                    <td>
                                        <form action="{{ route( 'user.sub_contractor.edit_sub_contractor_rate_card') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$customer_rate_card->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 " style="background-color: #fff;">
                                                    <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                            </button>
                                        </form>
                                            
                                        <a href="#" id="{{ $customer_rate_card->id }}" class="delete-file" onclick="delete_fun(this.id)">
                                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                                        </a>
                                    </td>
                                    
                                </tr>
                                @endif
                                @endif
                                @endif
                                @endforeach
                            </tbody>         
                        </table>
                    </div>
                </div>
                
                <div class="tab-pane fade show " id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    <div class="table-responsive ">
                        <table class="display table responsive nowrap  " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Sub Contractor</th>
                                    <th>Customer Name</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>VEHICLE TYPE </th>
                                    <th>Rate TYPE </th>
                                    <th>Rate </th>
                                    <th>Other Charges </th>
                                    <th>Other Charges Description</th>
                                    <th>Ap Km as per trip: </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['sub_contractor_rate_cards'] as $customer_rate_card)
                                @if($customer_rate_card->status == 'pending' && $customer_rate_card->row_status != 'deleted')
                                @if(Sub_contractor_info::find($customer_rate_card->sub_contractor_id) != null)
                                @if(Sub_contractor_info::find($customer_rate_card->sub_contractor_id)->row_status != 'deleted')
                                <tr>
                                    <td>{{ $customer_rate_card->id }}</td>
                                    <td>
                                            @if($customer_rate_card->sub_contractor_id == 0)
                                            Sub Contractor Deleted
                                            @else
                                               @if(Sub_contractor_info::find($customer_rate_card->sub_contractor_id))
                                                    {{ Sub_contractor_info::find($customer_rate_card->sub_contractor_id)->name}}
                                               @else
                                                    Sub Contractor Deleted
                                               @endif
                                            
                                            @endif
                                    </td>
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
                                    <td>{{ $customer_rate_card->ap_km }}</td>

                                    
                                    <td>
                                        <form action="{{ route( 'user.sub_contractor.edit_sub_contractor_rate_card') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$customer_rate_card->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white" style="background-color: #fff;">
                                                    <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                            </button>
                                        </form>
                                            
                                        <a href="#" id="{{ $customer_rate_card->id }}" class="delete-file" onclick="delete_fun(this.id)">
                                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                                        </a>
                                    </td>
                                    
                                </tr>
                                @endif
                                @endif
                                @endif
                                @endforeach
                            </tbody>         
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade show " id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                    <div class="table-responsive">
                        <table class="display table responsive nowrap  " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Sub Contractor</th>
                                    <th>Customer Name</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>VEHICLE TYPE </th>
                                    <th>Rate TYPE </th>
                                    <th>Rate </th>
                                    <th>Other Charges </th>
                                    <th>Other Charges Description</th>
                                    <th>Ap Km as per trip: </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['sub_contractor_rate_cards'] as $customer_rate_card)
                                @if($customer_rate_card->status == 'rejected' && $customer_rate_card->row_status != 'deleted')
                                @if(Sub_contractor_info::find($customer_rate_card->sub_contractor_id) != null)
                                @if(Sub_contractor_info::find($customer_rate_card->sub_contractor_id)->row_status != 'deleted')
                                <tr>
                                    <td>{{ $customer_rate_card->id }}</td>
                                    <td>
                                            @if($customer_rate_card->sub_contractor_id == 0)
                                            Sub Contractor Deleted
                                            @else
                                               @if(Sub_contractor_info::find($customer_rate_card->sub_contractor_id))
                                                    {{ Sub_contractor_info::find($customer_rate_card->sub_contractor_id)->name}}
                                               @else
                                                    Sub Contractor Deleted
                                               @endif
                                            
                                            @endif
                                    </td>
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
                                    <td>{{ $customer_rate_card->ap_km }}</td>

                                    
                                    <td>
                                        <form action="{{ route( 'user.sub_contractor.edit_sub_contractor_rate_card') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$customer_rate_card->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white" style="background-color: #fff;">
                                                    <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                            </button>
                                        </form>
                                            
                                        <a href="#" id="{{ $customer_rate_card->id }}" class="delete-file" onclick="delete_fun(this.id)">
                                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                                        </a>
                                    </td>
                                    
                                </tr>
                                @endif
                                @endif
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
            responsive: true,
            buttons: [
              
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
            ]
        } );
    });

    function delete_fun(clicked_id) {
                var file_id = clicked_id;
                swal({
                    title: 'Are you sure?',
                    text: "You want to delete this Data.",
                    type: 'warning',
                    input:"text",
                    inputPlaceholder:"Admin Notes",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',  
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function (result) {
                    $.ajax({
                        type:'POST',
                        url:"{{ route( 'user.sub_contractor.delete_sub_contractor_rate_card') }}",
                        data:{id:file_id, _token :"{{ csrf_token() }}" ,status_message : result},
                        success:function(data){
                                if (data.status == 1) {
                                    swal({
                                        title: "Deleted! Request to Admin",
                                        text: "Request has been sent to Admin. You saw that in pending tab",
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
  
    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    
    console.log($("[type='date']").attr("min",new_date) );

</script>