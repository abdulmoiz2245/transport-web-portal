<?php 
use App\Models\Company_name;
use App\Models\User;
use App\Models\Trade_license;
use App\Models\Office_Land_contract;


  
?>
<div class="container">

    <div class="d-flex" style="justify-content: space-between;">
        <div>
            <a href="{{ route( 'admin.dashboard') }}" class="ml-3">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
            <a href="{{ route( 'admin.purchase.add_purchase') }}" class="ml-3">
                <img  src="<?= asset('assets') ?>/images/add-button.png" alt="" width="30">
            </a>
        </div>
        

        <div class=""> 
            <a href="{{ route( 'admin.purchase.purchase_history') }}"target="_blank" class="ml-3">
                    <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="30">
            </a> 
            <a href="{{ route( 'admin.purchase.trash_purchase') }}" class="ml-3" target="_blank">
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
                <ul class="nav nav-tabs mt-3 mb-5" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="approved-tab" data-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="true"> <b>Approved</b> </a>
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
                            <table  class="display table2 table  nowrap " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>PO Number</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Total Amount</th>

                                        <th>TRN Number</th>
                                        <th>Delivery Date</th>
                                        <th>Action By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['purchases'] as $trade_license)
                                    @if($trade_license->status_admin == 'approved' && $trade_license->status_account == 'approved' && $trade_license->row_status != 'deleted')
                                    <tr>
                                        <td>{{ $trade_license->id }}</td>
                                        <td>{{ $trade_license->po_number }}</td>
                                        <td>{{ $trade_license->product_name }}</td>
                                        <td>{{ $trade_license->quantity }}</td>

                                        <td>{{ $trade_license->total_amount }}</td>
                                        <td>{{ $trade_license->trn }}</td>
                                        <td>{{ $trade_license->delivery_date }}</td>

                                        <td>
                                            @if($trade_license->user_id == 0)
                                                Admin
                                            @else
                                               @if(User::find($trade_license->user_id))
                                                    {{ User::find($trade_license->user_id)->username}}
                                               @else
                                                    User Deleted
                                               @endif
                                            
                                            @endif
                                        </td>

                                        <td>
                                            <form action="{{ route( 'admin.purchase.view_purchase') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 bg-white">
                                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                                </button>
                                            </form>

                                            <!-- <form action="{{ route( 'admin.purchase.edit_purchase') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 bg-white">
                                                        <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                                </button>
                                            </form> -->
                                                
                                        
                                            <a href="#" id="{{ $trade_license->id }}" class="delete-file">
                                                
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
                    <div class="tab-pane fade show " id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="table-responsive">
                            <table   class="display table1 table  nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>PO Number</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Total Amount</th>

                                        <th>TRN Number</th>
                                        <th>Delivery Date</th>
                                        <th>Action By</th>
                                        <th>Pending By</th>

                                        <!-- <th>User Action</th> -->

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['purchases'] as $trade_license)
                                    <?php 
                                       $check = false;
                                       if($trade_license->status_admin != 'rejected' && $trade_license->status_account != 'rejected')
                                            $check = true;
                                    ?>
                                    @if( $check == true && ($trade_license->status_admin == 'pending' || $trade_license->status_account == 'pending'  ) && $trade_license->row_status != 'deleted')
                                    <tr>
                                        <td>{{ $trade_license->id }}</td>
                                        <td>{{ $trade_license->po_number }}</td>
                                        <td>{{ $trade_license->product_name }}</td>
                                        <td>{{ $trade_license->quantity }}</td>

                                        <td>{{ $trade_license->total_amount }}</td>
                                        <td>{{ $trade_license->trn }}</td>
                                        <td>{{ $trade_license->delivery_date }}</td>
                                        <td>
                                            @if($trade_license->user_id == 0)
                                                Admin
                                            @else
                                               @if(User::find($trade_license->user_id))
                                                    {{ User::find($trade_license->user_id)->username}}
                                               @else
                                                    User Deleted
                                               @endif
                                            
                                            @endif
                                        </td>
                                        <td>
                                            @if($trade_license->status_admin == 'pending')
                                            <span class="badge badge-pill badge-success p-2 m-1">Admin</span>
                                            @elseif($trade_license->status_account == 'pending')
                                                
                                                <span class="badge badge-pill badge-success p-2 m-1">Accounts</span>
                                            @endif
                                        </td>

                                        
                                        
                                        

                                        <td>
                                            <form action="{{ route( 'admin.purchase.view_purchase') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 bg-white">
                                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                                </button>
                                            </form>

                                            <form action="{{ route( 'admin.purchase.edit_purchase') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 bg-white">
                                                        <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                                </button>
                                            </form>
                                                
                                        
                                            <a href="#" id="{{ $trade_license->id }}" class="delete-file">
                                                
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
                    <div class="tab-pane fade show " id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                        <div class="table-responsive">
                            <table   class="display table1 table  nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>TRN Number</th>
                                        <th>Company Name</th>
                                        <th>Delivery Date</th>
                                        <th>Action By</th>
                                        <th>Pending By</th>

                                        <!-- <th>User Action</th> -->

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['purchases'] as $trade_license)
                                    <?php 
                                       $check = false;
                                       if($trade_license->status_admin != 'rejected' && $trade_license->status_account != 'rejected')
                                            $check = true;
                                    ?>
                                    @if( $check == true && ($trade_license->status_admin == 'rejected' || $trade_license->status_account == 'rejected') && $trade_license->row_status != 'deleted')
                                    <tr>
                                        <td>{{ $trade_license->id }}</td>
                                        <td>{{ $trade_license->trn }}</td>
                                        <td>{{ $trade_license->company_name }}</td>
                                        <td>{{ $trade_license->delivery_date }}</td>
                                        <td>
                                            @if($trade_license->user_id == 0)
                                                Admin
                                            @else
                                               @if(User::find($trade_license->user_id))
                                                    {{ User::find($trade_license->user_id)->username}}
                                               @else
                                                    User Deleted
                                               @endif
                                            
                                            @endif
                                        </td>
                                        <td>
                                            @if($trade_license->status_admin == 'pending')
                                            <span class="badge badge-pill badge-success p-2 m-1">Admin</span>
                                            @elseif($trade_license->status_account == 'pending')
                                                
                                                <span class="badge badge-pill badge-success p-2 m-1">Accounts</span>
                                            @endif
                                        </td>

                                        
                                        
                                        

                                        <td>
                                            <form action="{{ route( 'admin.purchase.view_purchase') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 bg-white">
                                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                                </button>
                                            </form>

                                            <form action="{{ route( 'admin.purchase.edit_purchase') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 bg-white">
                                                        <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                                </button>
                                            </form>
                                                
                                        
                                            <a href="#" id="{{ $trade_license->id }}" class="delete-file">
                                                
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
                
                // responsive: true,
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
                
                // responsive: true,
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
                    url:"{{ route( 'admin.purchase.delete_purchase_status') }}",
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