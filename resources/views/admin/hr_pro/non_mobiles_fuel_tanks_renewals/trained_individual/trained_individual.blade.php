<?php 
use App\Models\Company_name;
use App\Models\Trained_individual;
use App\Models\User;
  
?>
<div class="container">
    <!-- <a href="{{ route( 'admin.hr_pro.add_non_mobile_trained_individual') }}" class="mb-5">
        <button class="btn btn-primary">
            Add Trained Individual  </button>
    </a> -->

    <div class="d-flex" style="justify-content: space-between;">
        <a href="{{ route( 'admin.hr_pro.add_non_mobile_trained_individual') }}" class="">
            <button class="btn btn-primary">
                Add Trained Individua
            </button>
        </a>

        

        <div class=""> 
            <a href="{{ route( 'admin.hr_pro.non_mobiles_fuel_tanks_renewals') }}">
                <button class="btn btn-primary">
                    Back
                </button>
            </a>

            <a href="{{ route( 'admin.hr_pro.non_mobile_trained_individual_history') }}"target="_blank" class="ml-3">
                    <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="34">
            </a>

            <a href="{{ route( 'admin.hr_pro.trash_non_mobiles_trained_individual') }}" class="ml-3" target="_blank">
                <button class="btn btn-primary">
                Trained Individua Trash
                </button>
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
                        <table id="trade_license" class="display table responsive nowrap  " style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Card Number</th>
                                    <th>Employee Name</th>
                                    <th>Expiary Date</th>
                                    <th class="d-none">Pass Card</th>
                                    <th class="d-none">Front Pic</th>
                                    <th class="d-none">Back Pic</th>
                                    <th>Username</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['trained_individual'] as $trained_individual)
                                @if($trained_individual->status == 'approved' && $trained_individual->status != 'deleted')
                                <tr>
                                    
                                <td>{{ $trained_individual->id }}</td>
                                <td>{{ $trained_individual->card_number }}</td>
                                <td>{{ $trained_individual->employee_name }}</td>
                                <td>{{ $trained_individual->expiary_date }}</td>
                                <td class="d-none" >{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$trained_individual->pass_card}}</td>
                                <td class="d-none" >{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$trained_individual->front_pic}}</td>
                                <td class="d-none" >{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$trained_individual->back_pic}}</td>
                                
                                <td>
                                    @if($trained_individual->user_id == 0)
                                                Admin
                                            @else
                                               @if(User::find($trained_individual->user_id))
                                                    {{ User::find($trained_individual->user_id)->username}}
                                               @else
                                                    User Deleted
                                               @endif
                                            
                                            @endif
                                </td>
                                    
                                <td>
                                    <form action="{{ route( 'admin.hr_pro.view_non_mobile_trained_individual') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$trained_individual->id}}" placeholder="Enter id" >
                                        <button type="submit" class="border-0 .bg-white">
                                            <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                        </button>
                                    </form>

                                    <form action="{{ route( 'admin.hr_pro.edit_non_mobile_trained_individual') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$trained_individual->id}}" placeholder="Enter id" >
                                        <button type="submit" class="border-0 .bg-white">
                                                <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                        </button>
                                    </form>
                                        
                                    
                                    <a href="#" id="{{ $trained_individual->id }}" class="delete-file">
                                        <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                                    </a>

                                    <!-- <a href="{{ route( 'admin.hr_pro.non_mobile_trained_individual_history') }}"target="_blank" >
                                            <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="34">
                                    </a> -->
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
                        <table id="trade_license" class="display table responsive nowrap  " style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Card Number</th>
                                    <th>Employee Name</th>
                                    <th>Expiary Date</th>
                                    <th class="d-none">Pass Card</th>
                                    <th class="d-none">Front Pic</th>
                                    <th class="d-none">Back Pic</th>
                                    <th>Username</th>
                                    <th>User Action</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['trained_individual'] as $trained_individual)
                                @if($trained_individual->status == 'pending' && $trained_individual->status != 'deleted')
                                <tr>
                                    
                                <td>{{ $trained_individual->id }}</td>
                                <td>{{ $trained_individual->card_number }}</td>
                                <td>{{ $trained_individual->employee_name }}</td>
                                <td>{{ $trained_individual->expiary_date }}</td>
                                <td class="d-none" >{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$trained_individual->pass_card}}</td>
                                <td class="d-none" >{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$trained_individual->front_pic}}</td>
                                <td class="d-none" >{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$trained_individual->back_pic}}</td>
                                <td>
                                    @if($trained_individual->user_id == 0)
                                                Admin
                                            @else
                                               @if(User::find($trained_individual->user_id))
                                                    {{ User::find($trained_individual->user_id)->username}}
                                               @else
                                                    User Deleted
                                               @endif
                                            
                                            @endif
                                </td>
                                <td><span class="badge badge-pill badge-success p-2 m-1">{{$trained_individual->action }}</span></td>
                                    
                                <td>
                                    <form action="{{ route( 'admin.hr_pro.view_non_mobile_trained_individual') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$trained_individual->id}}" placeholder="Enter id" >
                                        <button type="submit" class="border-0 .bg-white">
                                            <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                        </button>
                                    </form>

                                    <form action="{{ route( 'admin.hr_pro.edit_non_mobile_trained_individual') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$trained_individual->id}}" placeholder="Enter id" >
                                        <button type="submit" class="border-0 .bg-white">
                                                <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                        </button>
                                    </form>
                                        
                                    
                                    <a href="#" id="{{ $trained_individual->id }}" class="delete-file">
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
                                    <th>ID</th>
                                    <th>Card Number</th>
                                    <th>Employee Name</th>
                                    <th>Expiary Date</th>
                                    <th class="d-none">Pass Card</th>
                                    <th class="d-none">Front Pic</th>
                                    <th class="d-none">Back Pic</th>
                                    <th>Username</th>
                                    <th>User Action</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['trained_individual'] as $trained_individual)
                                @if($trained_individual->status == 'rejected' && $trained_individual->status != 'deleted')
                                <tr>
                                    
                                <td>{{ $trained_individual->id }}</td>
                                <td>{{ $trained_individual->card_number }}</td>
                                <td>{{ $trained_individual->employee_name }}</td>
                                <td>{{ $trained_individual->expiary_date }}</td>
                                <td class="d-none" >{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$trained_individual->pass_card}}</td>
                                <td class="d-none" >{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$trained_individual->front_pic}}</td>
                                <td class="d-none" >{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$trained_individual->back_pic}}</td>
                                <td>
                                    @if($trained_individual->user_id == 0)
                                                Admin
                                            @else
                                               @if(User::find($trained_individual->user_id))
                                                    {{ User::find($trained_individual->user_id)->username}}
                                               @else
                                                    User Deleted
                                               @endif
                                            
                                            @endif
                                </td>
                                <td><span class="badge badge-pill badge-success p-2 m-1">{{$trained_individual->action }}</span></td>
                                    
                                <td>
                                    <form action="{{ route( 'admin.hr_pro.view_non_mobile_trained_individual') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$trained_individual->id}}" placeholder="Enter id" >
                                        <button type="submit" class="border-0 .bg-white">
                                            <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                        </button>
                                    </form>

                                    <form action="{{ route( 'admin.hr_pro.edit_non_mobile_trained_individual') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$trained_individual->id}}" placeholder="Enter id" >
                                        <button type="submit" class="border-0 .bg-white">
                                                <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                        </button>
                                    </form>
                                        
                                    
                                    <a href="#" id="{{ $trained_individual->id }}" class="delete-file">
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
                // 'pdfHtml5'
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
                    url:"{{ route( 'admin.hr_pro.delete_non_mobiles_trained_individual_status') }}",
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
    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    
    console.log($("[type='date']").attr("min",new_date) );

</script>