    <?php 
    use App\Models\Company_name;
    use App\Models\Trade_license;
    ?>
    <div class="container">
        <div class="d-flex" style="justify-content: space-between;">
            <div>
                <a href="{{ route( 'user.dashboard') }}" class="mr-3">
                    <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
                </a>
                <a href="{{ route( 'user.purchase.add_purchase') }}" class="">
                    <img  src="<?= asset('assets') ?>/images/add-button.png" alt="" width="30">
                </a>
            </div>

            <div class=""> 
                <a href="{{ route( 'user.purchase.purchase_history') }}"target="_blank" class="ml-3">
                        <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="34">
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
                            <table  class="display table table2  nowrap " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>TRN Number</th>
                                        <th>Material Data</th>
                                        <th>Delivery Date</th>
                                       

                                        
                                        <th style="display:none">Manager Visa</th>
                                        <th style="display:none">Sponsor Visa</th>
                                        <th style="display:none">Partners Visa</th>

                                        <th style="display:none"> Manager Passport</th>
                                        <th style="display:none"> Sponsor Passport</th>
                                        <th style="display:none"> Partners Passport</th>

                                        <th style="display:none"> Manager Id</th>
                                        <th style="display:none">Sponsor Id</th>
                                        <th style="display:none">Partners Id</th>

                                        <th style="display:none">Sponsor Page</th>
                                        <th style="display:none">Membership Certificate</th>
                                        <th style="display:none">Trade License Copy</th>


                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['trade_licenses'] as $trade_license)
                                    @if($trade_license->status == 'approved' && $trade_license->row_status != 'deleted')
                                    <tr>
                                        
                                        <td>{{ $trade_license->trade_name }}</td>
                                        <td>{{ $trade_license->license_number }}</td>
                                        
                                        <td>
                                            
                                            <?php if(Company_name::all()->count() > 0){ ?>
                                                <?php $check = 0; ?>
                                            @foreach($data['company_names'] as $company_name)
                                                @if($company_name->id == $trade_license->company_id)
                                                    <?php $check = 1 ?>
                                                    <span class="badge badge-pill badge-dark p-2 m-1">{{ $company_name->name}}</span>
                                                @endif
                                            @endforeach
                                            <?php if($check == 0){ ?>
                                                <span class="badge badge-pill badge-danger p-2 m-1">No Company Selected</span>
                                            <?php } ?>
                                    
                                        <?php }else{ ?>
                                                <span class="badge badge-pill badge-danger p-2 m-1">No Company Selected</span>
                                            <?php } ?>
                                        </td>

                                        <td>{{ $trade_license->expiary_date }}</td>

                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->manager_visa }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->sponsor_visa }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->partners_visa }}</td>

                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->manager_passport }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->sponsor_passport }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->partners_passport }}</td>

                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->manager_id_card }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->sponsor_id_card }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->partners_id_card }}</td>

                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->sponsor_page }}</td>

                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->member_ship_certificate }}</td>
                                        
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->trade_license_copy }}</td>

                                        <td>
                                            <form action="{{ route( 'user.purchase.view_purchase') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 .bg-white">
                                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                                </button>
                                            </form>

                                            <form action="{{ route( 'user.purchase.edit_purchase') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 .bg-white">
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
                    <div class="tab-pane fade show " id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="table-responsive">
                            <table   class="display table table1  nowrap " style="width:100%">
                                <thead>
                                    <tr>

                                        <th>Company</th>
                                        <th>TRN Number</th>
                                        <th>Material Data</th>
                                        <th>Delivery Date</th>
                                        <th>Action By</th>

                                        <th style="display:none">Manager Visa</th>
                                        <th style="display:none">Sponsor Visa</th>
                                        <th style="display:none">Partners Visa</th>

                                        <th style="display:none"> Manager Passport</th>
                                        <th style="display:none"> Sponsor Passport</th>
                                        <th style="display:none"> Partners Passport</th>

                                        <th style="display:none"> Manager Id</th>
                                        <th style="display:none">Sponsor Id</th>
                                        <th style="display:none">Partners Id</th>

                                        <th style="display:none">Sponsor Page</th>
                                        <th style="display:none">Membership Certificate</th>
                                        <th style="display:none">Trade License Copy</th>


                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['trade_licenses'] as $trade_license)
                                    @if($trade_license->status == 'pending'  && $trade_license->row_status != 'deleted')
                                    <tr>
                                        
                                        <td>{{ $trade_license->trade_name }}</td>
                                        <td>{{ $trade_license->license_number }}</td>
                                        
                                        <td>
                                            
                                            <?php if(Company_name::all()->count() > 0){ ?>
                                                <?php $check = 0; ?>
                                            @foreach($data['company_names'] as $company_name)
                                                @if($company_name->id == $trade_license->company_id)
                                                    <?php $check = 1 ?>
                                                    <span class="badge badge-pill badge-dark p-2 m-1">{{ $company_name->name}}</span>
                                                @endif
                                            @endforeach
                                            <?php if($check == 0){ ?>
                                                <span class="badge badge-pill badge-danger p-2 m-1">No Company Selected</span>
                                            <?php } ?>
                                    
                                        <?php }else{ ?>
                                                <span class="badge badge-pill badge-danger p-2 m-1">No Company Selected</span>
                                            <?php } ?>
                                        </td>

                                        <td>{{ $trade_license->expiary_date }}</td>
                                        <td><span class="badge badge-pill badge-success p-2 m-1">{{$trade_license->action }}</span></td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->manager_visa }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->sponsor_visa }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->partners_visa }}</td>

                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->manager_passport }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->sponsor_passport }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->partners_passport }}</td>

                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->manager_id_card }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->sponsor_id_card }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->partners_id_card }}</td>

                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->sponsor_page }}</td>

                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->member_ship_certificate }}</td>
                                        
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->trade_license_copy }}</td>

                                        <td>
                                            <form action="{{ route( 'user.purchase.view_purchase') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 .bg-white">
                                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                                </button>
                                            </form>

                                            <form action="{{ route( 'user.purchase.edit_purchase') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 .bg-white">
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
                            <table   class="display table table1  nowrap " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Company</th>
                                        <th>TRN Number</th>
                                        <th>Material Data</th>
                                        <th>Delivery Date</th>
                                        <th>Action By</th>

                                        <th style="display:none">Manager Visa</th>
                                        <th style="display:none">Sponsor Visa</th>
                                        <th style="display:none">Partners Visa</th>

                                        <th style="display:none"> Manager Passport</th>
                                        <th style="display:none"> Sponsor Passport</th>
                                        <th style="display:none"> Partners Passport</th>

                                        <th style="display:none"> Manager Id</th>
                                        <th style="display:none">Sponsor Id</th>
                                        <th style="display:none">Partners Id</th>

                                        <th style="display:none">Sponsor Page</th>
                                        <th style="display:none">Membership Certificate</th>
                                        <th style="display:none">Trade License Copy</th>


                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data['trade_licenses'] as $trade_license)
                                    @if($trade_license->status == 'rejected'  && $trade_license->row_status != 'deleted')
                                    <tr>
                                        
                                        <td>{{ $trade_license->trade_name }}</td>
                                        <td>{{ $trade_license->license_number }}</td>
                                        
                                        <td>
                                            
                                            <?php if(Company_name::all()->count() > 0){ ?>
                                                <?php $check = 0; ?>
                                            @foreach($data['company_names'] as $company_name)
                                                @if($company_name->id == $trade_license->company_id)
                                                    <?php $check = 1 ?>
                                                    <span class="badge badge-pill badge-dark p-2 m-1">{{ $company_name->name}}</span>
                                                @endif
                                            @endforeach
                                            <?php if($check == 0){ ?>
                                                <span class="badge badge-pill badge-danger p-2 m-1">No Company Selected</span>
                                            <?php } ?>
                                    
                                        <?php }else{ ?>
                                                <span class="badge badge-pill badge-danger p-2 m-1">No Company Selected</span>
                                            <?php } ?>
                                        </td>

                                        <td>{{ $trade_license->expiary_date }}</td>
                                        <td><span class="badge badge-pill badge-success p-2 m-1">{{$trade_license->action }}</span></td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->manager_visa }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->sponsor_visa }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->partners_visa }}</td>

                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->manager_passport }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->sponsor_passport }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->partners_passport }}</td>

                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->manager_id_card }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->sponsor_id_card }}</td>
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->partners_id_card }}</td>

                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->sponsor_page }}</td>

                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->member_ship_certificate }}</td>
                                        
                                        <td style="display:none">{{ asset('main_admin/hr_pro/trade_license/')}}/{{ $trade_license->trade_license_copy }}</td>

                                        <td>
                                            <form action="{{ route( 'user.purchase.view_purchase') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 .bg-white">
                                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                                </button>
                                            </form>

                                            <form action="{{ route( 'user.purchase.edit_purchase') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 .bg-white">
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
                buttons: [
                
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );
        

        
            $('.table1').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );
    

   
   
   
   
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
                        url:"{{ route( 'user.purchase.delete_purchase') }}",
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
});

 
</script>