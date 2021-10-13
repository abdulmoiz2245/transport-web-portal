<?php 
use App\Models\Company_name;
use App\Models\Civil_defense_documents;

?>
<div class="container">
    <div class="d-flex" style="justify-content: space-between;">
        <a href="{{ route( 'user.hr_pro.add_non_mobile_civil_defence') }}" class="">
            <img src="<?= asset('assets') ?>/images/add-button.png" alt="" width="30">
        </a>

        
        <div class=""> 
            <a href="{{ route( 'user.hr_pro.non_mobiles_fuel_tanks_renewals') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>

            <a href="{{ route( 'user.hr_pro.non_mobile_civil_defence_history') }}"target="_blank" class="ml-3">
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
                    <a class="nav-link active" id="approved-tab" data-toggle="tab" href="#approved" role="tab" aria-controls="approved" aria-selected="true"> <b>Approved ({{  
                        Civil_defense_documents::where('status', '=', 'approved')->where('type', '=', 'non_mobile')->count() }})</b> </a>
                </li>
                <li class="nav-item">
                    
                    <a class="nav-link" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="false">  <b>Pending ({{  Civil_defense_documents::where('status', '=', 'pending')->where('type', '=', 'non_mobile')->count() }})</b> </a>
                </li>
                <li class="nav-item">
                    
                    <a class="nav-link" id="rejected-tab" data-toggle="tab" href="#rejected" role="tab" aria-controls="rejected" aria-selected="false">  <b>Rejected ({{  
                        Civil_defense_documents::where('status', '=', 'rejected')->where('type', '=', 'non_mobile')->count() }})</b> </a>
                </li>
            </ul>
            <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                    <div class="table-responsive">
                        <table class="display table responsive nowrap  " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Document</th>
                                    <th>Expiary Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['civil_defenses'] as $civil_defense)
                                @if($civil_defense->status == 'approved' && $civil_defense->row_status != 'deleted')
                                <tr>
                                    
                                    <td>
                                        <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/mobile_fuel_tank_renewals/{{$civil_defense->document}}">
                                            <button class="btn">View</button>
                                        </a>

                                        <a  download href="{{ asset('main_admin') }}/hr_pro/non_mobile_fuel_tank_renewals/{{$civil_defense->document}}">
                                            <button class="btn">Download</button>
                                        </a>
                                    </td>
                                    <td>{{ $civil_defense->expiary_date }}</td>
                                    <td>
                                        <!-- <form action="{{ route( 'user.hr_pro.edit_non_mobile_civil_defence') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$civil_defense->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
                                                <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                            </button>
                                        </form> -->

                                        <form action="{{ route( 'user.hr_pro.edit_non_mobile_civil_defence') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$civil_defense->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
                                                    <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                            </button>
                                        </form>
                                            
                                    
                                        <a href="#" id="{{ $civil_defense->id }}" class="delete-file">
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
                    <div class="table-responsive responsive nowrap ">
                        <table  class="display table  " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Document</th>
                                    <th>Expiary Date</th>
                                    <th>User Action</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['civil_defenses'] as $civil_defense)
                                @if($civil_defense->status == 'pending' && $civil_defense->row_status != 'deleted')
                                <tr>
                                    
                                    <td>
                                        <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/mobile_fuel_tank_renewals/{{$civil_defense->document}}">
                                            <button class="btn">View</button>
                                        </a>

                                        <a  download href="{{ asset('main_admin') }}/hr_pro/non_mobile_fuel_tank_renewals/{{$civil_defense->document}}">
                                            <button class="btn">Download</button>
                                        </a>
                                    </td>
                                    <td>{{ $civil_defense->expiary_date }}</td>
                                    <td><span class="badge badge-pill badge-success p-2 m-1">{{$civil_defense->action }}</span></td>
                                    <td>
                                        <!-- <form action="{{ route( 'user.hr_pro.edit_non_mobile_civil_defence') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$civil_defense->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
                                                <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                            </button>
                                        </form> -->

                                        <form action="{{ route( 'user.hr_pro.edit_non_mobile_civil_defence') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$civil_defense->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
                                                    <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                            </button>
                                        </form>
                                            
                                    
                                        <a href="#" id="{{ $civil_defense->id }}" class="delete-file">
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
                        <table id="trade_license" class="display table responsive nowrap  " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Document</th>
                                    <th>Expiary Date</th>
                                    <th>User Action</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['civil_defenses'] as $civil_defense)
                                @if($civil_defense->status == 'rejected' && $civil_defense->row_status != 'deleted')
                                <tr>
                                    
                                    <td>
                                        <a  target="_blank" href="{{ asset('main_admin') }}/hr_pro/mobile_fuel_tank_renewals/{{$civil_defense->document}}">
                                            <button class="btn">View</button>
                                        </a>

                                        <a  download href="{{ asset('main_admin') }}/hr_pro/non_mobile_fuel_tank_renewals/{{$civil_defense->document}}">
                                            <button class="btn">Download</button>
                                        </a>
                                    </td>
                                    <td>{{ $civil_defense->expiary_date }}</td>
                                    <td><span class="badge badge-pill badge-success p-2 m-1">{{$civil_defense->action }}</span></td>
                                    <td>
                                        <!-- <form action="{{ route( 'user.hr_pro.edit_non_mobile_civil_defence') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$civil_defense->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
                                                <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                            </button>
                                        </form> -->

                                        <form action="{{ route( 'user.hr_pro.edit_non_mobile_civil_defence') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{$civil_defense->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
                                                    <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                            </button>
                                        </form>
                                            
                                    
                                        <a href="#" id="{{ $civil_defense->id }}" class="delete-file">
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
                    input:"text",
                    inputPlaceholder:"Admin Notes",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',  
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then(function (result) {
                    $.ajax({
                        type:'POST',
                        url:"{{ route( 'user.hr_pro.delete_non_mobile_civil_defence') }}",
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