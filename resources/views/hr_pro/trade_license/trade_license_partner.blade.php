<?php 
use App\Models\Company_name;
use App\Models\Customer_rate_card;
use App\Models\Customer_info;
use App\Models\Trade_license;   


use App\Models\User;


?>
<div class="container">
    <div class="d-flex mb-3" style="justify-content:space-between;">
        <div class="">
            <a href="{{route('user.hr_pro.trade_license__sponsors__partners') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
        </div>

        
        <div class=""> 
            <a href="{{route('user.hr_pro.trade_license__sponsors__partners_history') }}"target="_blank" class="ml-3">
                    <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="30">
            </a>

            <a href="{{route('user.hr_pro.trash_trade_license_partners') }}" class="ml-3" target="_blank">
                <img src="<?= asset('assets') ?>/images/trash.png" alt="" width="30">
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
                        <table class="display table  nowrap  " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Id Copy</th>
                                    <th>Visa Copy</th>
                                    <th>Passport Copy</th>
                                    <th>Other</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['trade_license_partners'] as $customer_rate_card)
                                @if($customer_rate_card->status == 'approved' && $customer_rate_card->row_status != 'deleted')
                                @if(Trade_license::find($customer_rate_card->trade_license_id) != null)
                                @if(Trade_license::find($customer_rate_card->trade_license_id)->row_status != 'deleted')
                                <tr>
                                    <td>{{ $customer_rate_card->id }}</td>
                                    
                                    <td>
                                        @if($customer_rate_card->id_copy != null)
                                        <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->id_copy}}">
                                            <button class="btn">View</button>
                                        </a>

                                        <a  download href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->id_copy}}">
                                            <button class="btn">Download</button>
                                        </a>
                                        @else
                                        No File
                                        @endif
                                    </td>

                                    <td>
                                        @if($customer_rate_card->visa_copy != null)
                                        <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->visa_copy}}">
                                            <button class="btn">View</button>
                                        </a>

                                        <a  download href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->visa_copy}}">
                                            <button class="btn">Download</button>
                                        </a>
                                        @else
                                        No File
                                        @endif
                                    </td>

                                    <td>
                                        @if($customer_rate_card->passport_copy != null)
                                        <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->passport_copy}}">
                                            <button class="btn">View</button>
                                        </a>

                                        <a  download href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->passport_copy}}">
                                            <button class="btn">Download</button>
                                        </a>
                                        @else
                                        No File
                                        @endif
                                    </td>

                                    <td>
                                        {{ $customer_rate_card->other }}
                                    </td>

                                    
                                    <td>
                                        
                                        <form action="{{route('user.hr_pro.edit_trade_license_partners') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$customer_rate_card->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
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
                        <table class="display table  nowrap  " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Id Copy</th>
                                    <th>Visa Copy</th>

                                    <th>Passport Copy</th>
                                    <th>Other</th>
                                    <th>User Action</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['trade_license_partners'] as $customer_rate_card)
                                @if($customer_rate_card->status == 'pending' && $customer_rate_card->row_status != 'deleted')
                                @if(Trade_license::find($customer_rate_card->trade_license_id) != null)
                                @if(Trade_license::find($customer_rate_card->trade_license_id)->row_status != 'deleted')
                                <tr>
                                    <td>{{ $customer_rate_card->id }}</td>
                                    
                                    <td>
                                        @if($customer_rate_card->id_copy != null)
                                        <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->id_copy}}">
                                            <button class="btn">View</button>
                                        </a>

                                        <a  download href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->id_copy}}">
                                            <button class="btn">Download</button>
                                        </a>
                                        @else
                                        No File
                                        @endif
                                    </td>

                                    <td>
                                        @if($customer_rate_card->visa_copy != null)
                                        <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->visa_copy}}">
                                            <button class="btn">View</button>
                                        </a>

                                        <a  download href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->visa_copy}}">
                                            <button class="btn">Download</button>
                                        </a>
                                        @else
                                        No File
                                        @endif
                                    </td>

                                    <td>
                                        @if($customer_rate_card->passport_copy != null)
                                        <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->passport_copy}}">
                                            <button class="btn">View</button>
                                        </a>

                                        <a  download href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->passport_copy}}">
                                            <button class="btn">Download</button>
                                        </a>
                                        @else
                                        No File
                                        @endif
                                    </td>

                                    <td>
                                        {{ $customer_rate_card->other }}
                                    </td>

                                    <td><span class="badge badge-pill badge-success p-2 m-1">{{$customer_rate_card->action }}</span></td>


                                    
                                    <td>
                                        
                                        <form action="{{route('user.hr_pro.edit_trade_license_partners') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$customer_rate_card->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
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
                        <table class="display table  nowrap  " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Id Copy</th>
                                    <th>Visa Copy</th>

                                    <th>Passport Copy</th>
                                    <th>Other</th>
                                    <th>User Action</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['trade_license_partners'] as $customer_rate_card)
                                @if($customer_rate_card->status == 'rejected' && $customer_rate_card->row_status != 'deleted')
                                @if(Trade_license::find($customer_rate_card->trade_license_id) != null)
                                @if(Trade_license::find($customer_rate_card->trade_license_id)->row_status != 'deleted')
                                <tr>
                                    <td>{{ $customer_rate_card->id }}</td>
                                    
                                    <td>
                                        @if($customer_rate_card->id_copy != null)
                                        <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->id_copy}}">
                                            <button class="btn">View</button>
                                        </a>

                                        <a  download href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->id_copy}}">
                                            <button class="btn">Download</button>
                                        </a>
                                        @else
                                        No File
                                        @endif
                                    </td>

                                    <td>
                                        @if($customer_rate_card->visa_copy != null)
                                        <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->visa_copy}}">
                                            <button class="btn">View</button>
                                        </a>

                                        <a  download href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->visa_copy}}">
                                            <button class="btn">Download</button>
                                        </a>
                                        @else
                                        No File
                                        @endif
                                    </td>

                                    <td>
                                        @if($customer_rate_card->passport_copy != null)
                                        <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->passport_copy}}">
                                            <button class="btn">View</button>
                                        </a>

                                        <a  download href="{{ asset('main_admin') }}/hr_pro/trade_license/{{$customer_rate_card->passport_copy}}">
                                            <button class="btn">Download</button>
                                        </a>
                                        @else
                                        No File
                                        @endif
                                    </td>
                                    <td>
                                        {{ $customer_rate_card->other }}
                                    </td>

                                    <td><span class="badge badge-pill badge-success p-2 m-1">{{$customer_rate_card->action }}</span></td>


                                    
                                    <td>
                                        
                                        <form action="{{route('user.hr_pro.edit_trade_license_partners') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$customer_rate_card->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
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
           
            buttons: [
              
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
            ]
        } );
    });

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
                url:"{{route('user.hr_pro.delete_trade_license_partners_status') }}",
                data:{id:file_id, _token :"{{ csrf_token() }}"},
                success:function(data){
                        if (data.status == 1) {
                            swal({
                                title: "Deleted!",
                                text: "Data has been mover to trash.",
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
    
    $("[type='date']").attr("min",new_date);

</script>