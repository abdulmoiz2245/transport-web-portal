<?php 
use App\Models\Company_name;
use App\Models\Customer_info;
use App\Models\Customer_rate_card;


use App\Models\User;
?>

<div class="container">
    

    <div class="d-flex mb-3" style="justify-content: space-between;">
        <div class="">
            <a href="{{ route( 'user.dashboard') }}">
                    <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
            <a href="{{ route( 'user.customer.add_customer') }}" class="ml-3">
                <img src="<?= asset('assets') ?>/images/add-button.png" alt="" width="30">
            </a>
            
        </div>
        
        
        <div class=""> 
            
            <a href="{{ route( 'user.customer.customer_history') }}"target="_blank" class="ml-3">
                    <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="30">
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
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Username</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['customer_info'] as $customer_info)
                                @if($customer_info->status == 'approved' && $customer_info->row_status != 'deleted')
                                <tr>
                                    <td>{{ $customer_info->id }}</td>
                                    <td>{{ $customer_info->name }}</td>
                                    <td>{{ $customer_info->email }}</td>
                                    <td>
                                    @if($customer_info->user_id == 0)
                                                Admin
                                            @else
                                               @if(User::find($customer_info->user_id))
                                                    {{ User::find($customer_info->user_id)->username}}
                                               @else
                                                    User Deleted
                                               @endif
                                            
                                            @endif
                                    <td>
                                        <form action="{{ route( 'user.customer.view_customer') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$customer_info->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
                                                <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                            </button>
                                        </form>
                                        <form action="{{ route( 'user.customer.edit_customer') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$customer_info->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
                                                    <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                            </button>
                                        </form>
                                            
                                        <a href="#" id="{{ $customer_info->id }}" class="delete-file">
                                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                                        </a>

                                        <button class="p-0 btn bg-white _r_btn border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php
                                                $check = 0;
                                                foreach(Customer_rate_card::where('customer_id' ,'=',$customer_info->id)->where('row_status' , '!=' , 'deleted')->get() as $rate){
                                                    if($rate->status == 'pending'){
                                                        $check = 1;
                                                    }
                                                }
                                            
                                            ?>
                                            @if($check == 1)
                                            <img src="<?= asset('assets') ?>/images/rate-card-red.png" alt="" width="40">
                                            @else
                                            <img src="<?= asset('assets') ?>/images/rate-card.png" alt="" width="40">
                                            @endif
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="{{ route('user.customer.customer_rate_card_add', $customer_info->id  ) }}">Add Rate Card</a>
                                            <a class="dropdown-item" href="{{ route('user.customer.customer_rate_card',  $customer_info->id  ) }}">View Rate Card</a>
                                        </div>

                    
                                    </td>
                                    
                                </tr>
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
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Username</th>
                                    <th>User Action</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['customer_info'] as $customer_info)
                                @if($customer_info->status == 'pending' && $customer_info->row_status != 'deleted')
                                <tr>
                                    <td>{{ $customer_info->id }}</td>
                                    <td>{{ $customer_info->name }}</td>
                                    <td>{{ $customer_info->email }}</td>
                                    <td>
                                    @if($customer_info->user_id == 0)
                                                Admin
                                            @else
                                               @if(User::find($customer_info->user_id))
                                                    {{ User::find($customer_info->user_id)->username}}
                                               @else
                                                    User Deleted
                                               @endif
                                            
                                            @endif
                                    </td>
                                    <td><span class="badge badge-pill badge-success p-2 m-1">{{$customer_info->action }}</span></td>
                                    <td>
                                        <form action="{{ route( 'user.customer.view_customer') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$customer_info->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
                                                <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                            </button>
                                        </form>

                                        <form action="{{ route( 'user.customer.edit_customer') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$customer_info->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
                                                    <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                            </button>
                                        </form>
                                            
                                        <a href="#" id="{{ $customer_info->id }}" class="delete-file">
                                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                                        </a>

                                        <button class="p-0 btn bg-white _r_btn border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php
                                                $check = 0;
                                                foreach(Customer_rate_card::where('customer_id' ,'=',$customer_info->id)->where('row_status' , '!=' , 'deleted')->get() as $rate){
                                                    if($rate->status == 'pending'){
                                                        $check = 1;
                                                    }
                                                }
                                            
                                            ?>
                                            @if($check == 1)
                                            <img src="<?= asset('assets') ?>/images/rate-card-red.png" alt="" width="40">
                                            @else
                                            <img src="<?= asset('assets') ?>/images/rate-card.png" alt="" width="40">
                                            @endif
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="{{ route('user.customer.customer_rate_card_add', $customer_info->id  ) }}">Add Rate Card</a>
                                            <a class="dropdown-item" href="{{ route('user.customer.customer_rate_card',  $customer_info->id  ) }}">View Rate Card</a>
                                        </div>

                                       
                                    </td>
                                    
                                </tr>
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
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Username</th>
                                    <th>User Action</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['customer_info'] as $customer_info)
                                @if($customer_info->status == 'rejected' && $customer_info->row_status != 'deleted')
                                <tr>
                                    <td>{{ $customer_info->id }}</td>
                                    <td>{{ $customer_info->name }}</td>
                                    <td>{{ $customer_info->email }}</td>
                                    <td>
                                        @if($customer_info->user_id == 0)
                                            Admin
                                        @else
                                            @if(User::find($customer_info->user_id))
                                                {{ User::find($customer_info->user_id)->username}}
                                            @else
                                                User Deleted
                                            @endif
                                        
                                        @endif
                                    </td>
                                    <td><span class="badge badge-pill badge-success p-2 m-1">{{$customer_info->action }}</span></td>
                                    <td>
                                        <form action="{{ route( 'user.customer.view_customer') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$customer_info->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
                                                <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                            </button>
                                        </form>

                                        <form action="{{ route( 'user.customer.edit_customer') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$customer_info->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
                                                    <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                            </button>
                                        </form>
                                            
                                        <a href="#" id="{{ $customer_info->id }}" class="delete-file">
                                            <?php
                                                $check = 0;
                                                foreach(Customer_rate_card::where('customer_id' ,'=',$customer_info->id)->where('row_status' , '!=' , 'deleted')->get() as $rate){
                                                    if($rate->status == 'pending'){
                                                        $check = 1;
                                                    }
                                                }
                                            
                                            ?>
                                            @if($check == 1)
                                            <img src="<?= asset('assets') ?>/images/rate-card-red.png" alt="" width="40">
                                            @else
                                            <img src="<?= asset('assets') ?>/images/rate-card.png" alt="" width="40">
                                            @endif
                                        </a>

                                        <button class="p-0 btn bg-white _r_btn border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="<?= asset('assets') ?>/images/rate-card.png" alt="" width="40">
                                        </button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                            <a class="dropdown-item" href="{{ route('user.customer.customer_rate_card_add', $customer_info->id  ) }}">Add Rate Card</a>
                                            <a class="dropdown-item" href="{{ route('user.customer.customer_rate_card',  $customer_info->id  ) }}">View Rate Card</a>
                                        </div>

                                        
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
            responsive: true,
            buttons: [
              
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
            ]
        } );
    });

  

    $('.delete-file').click(function () {
                var file_id = this.id;
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
                        url:"{{ route( 'user.customer.delete_customer') }}",
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
    });

 
</script>