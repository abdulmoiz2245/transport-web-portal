<?php 
use App\Models\Company_name;
use App\Models\User;
use App\Models\Office_Land_contract;

  
?>
<div class="container">
    <a href="{{ route( 'admin.hr_pro.add_land_contracts') }}" class="mb-5">
        <button class="btn btn-primary">
            Add Land Contract
        </button>
    </a>
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
                    
                    <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">  <b>Pending ({{  Office_Land_contract::where('status', '=', 'pending')->where('type', '=', 'land')->count() }})</b> </a>
                </li>
                <li class="nav-item">
                    
                    <a class="nav-link" id="rejected-tab" data-toggle="tab" href="#rejected" role="tab" aria-controls="rejected" aria-selected="false">  <b>Rejected ({{  
                        Office_Land_contract::where('status', '=', 'rejected')->where('type', '=', 'land')->count() }})</b> </a>
                </li>
            </ul>
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                    <div class="table-responsive">
                        <table id="trade_license"  class="display table responsive nowrap " style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Contract Number</th>
                                    <th>Plot Details</th>
                                    <th>Landloard Name</th>
                                    <th>Contract Expiary Date</th>
                                    <th>Ijari Number</th>
                                    <th>Username</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['land_contract'] as $land_contract)
                                @if($land_contract->status == 'approved')
                                <tr>
                                    
                                <td>{{ $land_contract->id }}</td>
                                <td>{{ $land_contract->contract_number }}</td>
                                <td>{{ $land_contract->plot_details }}</td>
                                <td>{{ $land_contract->landloard_name }}</td>
                                <td>{{ $land_contract->contract_expiary_date }}</td>
                                <td>{{ $land_contract->ijari_number }}</td>
                                <td>
                                    @if($land_contract->user_id == 0)
                                                Admin
                                            @else
                                               @if(User::find($land_contract->user_id))
                                                    {{ User::find($land_contract->user_id)->username}}
                                               @else
                                                    User Deleted
                                               @endif
                                            
                                            @endif
                                </td>
                            

                                    
                                <td>
                                    <form action="{{ route( 'admin.hr_pro.view_land_contracts') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$land_contract->id}}" placeholder="Enter id" >
                                        <button type="submit" class="border-0 .bg-white">
                                            <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                        </button>
                                    </form>

                                    <form action="{{ route( 'admin.hr_pro.edit_land_contracts') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$land_contract->id}}" placeholder="Enter id" >
                                        <button type="submit" class="border-0 .bg-white">
                                                <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                        </button>
                                    </form>
                                        
                                    
                                    <a href="#" id="{{ $land_contract->id }}" class="delete-file">
                                        <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                                    </a>

                                    <a href="{{ route( 'admin.hr_pro.land_contracts_history') }}"target="_blank" >
                                            <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="34">
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
                        <table id="trade_license"  class="display table responsive nowrap " style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Contract Number</th>
                                    <th>Plot Details</th>
                                    <th>Landloard Name</th>
                                    <th>Contract Expiary Date</th>
                                    <th>Ijari Number</th>
                                    <th>Username</th>
                                    <th>User Action</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['land_contract'] as $land_contract)
                                @if($land_contract->status == 'pending')
                                <tr>
                                    
                                <td>{{ $land_contract->id }}</td>
                                <td>{{ $land_contract->contract_number }}</td>
                                <td>{{ $land_contract->plot_details }}</td>
                                <td>{{ $land_contract->landloard_name }}</td>
                                <td>{{ $land_contract->contract_expiary_date }}</td>
                                <td>{{ $land_contract->ijari_number }}</td>
                                <td>
                                    @if($land_contract->user_id == 0)
                                                Admin
                                            @else
                                               @if(User::find($land_contract->user_id))
                                                    {{ User::find($land_contract->user_id)->username}}
                                               @else
                                                    User Deleted
                                               @endif
                                            
                                            @endif
                                </td>
                                <td><span class="badge badge-pill badge-success p-2 m-1">{{$land_contract->action }}</span></td>

                                    
                                <td>
                                    <form action="{{ route( 'admin.hr_pro.view_land_contracts') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$land_contract->id}}" placeholder="Enter id" >
                                        <button type="submit" class="border-0 .bg-white">
                                            <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                        </button>
                                    </form>

                                    <form action="{{ route( 'admin.hr_pro.edit_land_contracts') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$land_contract->id}}" placeholder="Enter id" >
                                        <button type="submit" class="border-0 .bg-white">
                                                <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                        </button>
                                    </form>
                                        
                                    
                                    <a href="#" id="{{ $land_contract->id }}" class="delete-file">
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
                        <table id="trade_license"  class="display table responsive nowrap " style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Contract Number</th>
                                    <th>Plot Details</th>
                                    <th>Landloard Name</th>
                                    <th>Contract Expiary Date</th>
                                    <th>Ijari Number</th>
                                    <th>Username</th>
                                    <th>User Action</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['land_contract'] as $land_contract)
                                @if($land_contract->status == 'rejected')
                                <tr>
                                    
                                <td>{{ $land_contract->id }}</td>
                                <td>{{ $land_contract->contract_number }}</td>
                                <td>{{ $land_contract->plot_details }}</td>
                                <td>{{ $land_contract->landloard_name }}</td>
                                <td>{{ $land_contract->contract_expiary_date }}</td>
                                <td>{{ $land_contract->ijari_number }}</td>
                                <td>
                                    @if($land_contract->user_id == 0)
                                                Admin
                                            @else
                                               @if(User::find($land_contract->user_id))
                                                    {{ User::find($land_contract->user_id)->username}}
                                               @else
                                                    User Deleted
                                               @endif
                                            
                                            @endif
                                </td>
                                <td><span class="badge badge-pill badge-success p-2 m-1">{{$land_contract->action }}</span></td>

                                    
                                <td>
                                    <form action="{{ route( 'admin.hr_pro.view_land_contracts') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$land_contract->id}}" placeholder="Enter id" >
                                        <button type="submit" class="border-0 .bg-white">
                                            <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                        </button>
                                    </form>

                                    <form action="{{ route( 'admin.hr_pro.edit_land_contracts') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$land_contract->id}}" placeholder="Enter id" >
                                        <button type="submit" class="border-0 .bg-white">
                                                <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                        </button>
                                    </form>
                                        
                                    
                                    <a href="#" id="{{ $land_contract->id }}" class="delete-file">
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
        $('.table').DataTable( {
            dom: 'Bfrtip',
            responsive: true,
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
                    url:"{{ route( 'admin.hr_pro.delete_land_contracts') }}",
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