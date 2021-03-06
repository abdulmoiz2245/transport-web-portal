<?php 
use App\Models\Company_name;
use App\Models\User;
use App\Models\Trade_license;
use App\Models\Office_Land_contract;
use App\Models\Trade_license_partners;



  
?>
<style>
    /* Style the tab */
.tab {
  /* overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1; */
  margin-bottom: 20px;
}

.badge{
  font-size: 12px;
}

/* Style the buttons inside the tab */
.tab button {
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 14px;
    border-radius: 9px;
    margin-right: 26px;
    background-color: #ddd;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #08c;
    color: #fff;
}

/* Style the tab content */
.tabcontent {
  display: none;
  /* padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none; */
}
    .sk-circle {
        margin: 100px auto;
    width: 40px;
    height: 40px;
    position: fixed;
    left: 50%;
}
.sk-circle .sk-child {
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
}
.sk-circle .sk-child:before {
  content: '';
  display: block;
  margin: 0 auto;
  width: 15%;
  height: 15%;
  background-color: #333;
  border-radius: 100%;
  -webkit-animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
          animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
}
.sk-circle .sk-circle2 {
  -webkit-transform: rotate(30deg);
      -ms-transform: rotate(30deg);
          transform: rotate(30deg); }
.sk-circle .sk-circle3 {
  -webkit-transform: rotate(60deg);
      -ms-transform: rotate(60deg);
          transform: rotate(60deg); }
.sk-circle .sk-circle4 {
  -webkit-transform: rotate(90deg);
      -ms-transform: rotate(90deg);
          transform: rotate(90deg); }
.sk-circle .sk-circle5 {
  -webkit-transform: rotate(120deg);
      -ms-transform: rotate(120deg);
          transform: rotate(120deg); }
.sk-circle .sk-circle6 {
  -webkit-transform: rotate(150deg);
      -ms-transform: rotate(150deg);
          transform: rotate(150deg); }
.sk-circle .sk-circle7 {
  -webkit-transform: rotate(180deg);
      -ms-transform: rotate(180deg);
          transform: rotate(180deg); }
.sk-circle .sk-circle8 {
  -webkit-transform: rotate(210deg);
      -ms-transform: rotate(210deg);
          transform: rotate(210deg); }
.sk-circle .sk-circle9 {
  -webkit-transform: rotate(240deg);
      -ms-transform: rotate(240deg);
          transform: rotate(240deg); }
.sk-circle .sk-circle10 {
  -webkit-transform: rotate(270deg);
      -ms-transform: rotate(270deg);
          transform: rotate(270deg); }
.sk-circle .sk-circle11 {
  -webkit-transform: rotate(300deg);
      -ms-transform: rotate(300deg);
          transform: rotate(300deg); }
.sk-circle .sk-circle12 {
  -webkit-transform: rotate(330deg);
      -ms-transform: rotate(330deg);
          transform: rotate(330deg); }
.sk-circle .sk-circle2:before {
  -webkit-animation-delay: -1.1s;
          animation-delay: -1.1s; }
.sk-circle .sk-circle3:before {
  -webkit-animation-delay: -1s;
          animation-delay: -1s; }
.sk-circle .sk-circle4:before {
  -webkit-animation-delay: -0.9s;
          animation-delay: -0.9s; }
.sk-circle .sk-circle5:before {
  -webkit-animation-delay: -0.8s;
          animation-delay: -0.8s; }
.sk-circle .sk-circle6:before {
  -webkit-animation-delay: -0.7s;
          animation-delay: -0.7s; }
.sk-circle .sk-circle7:before {
  -webkit-animation-delay: -0.6s;
          animation-delay: -0.6s; }
.sk-circle .sk-circle8:before {
  -webkit-animation-delay: -0.5s;
          animation-delay: -0.5s; }
.sk-circle .sk-circle9:before {
  -webkit-animation-delay: -0.4s;
          animation-delay: -0.4s; }
.sk-circle .sk-circle10:before {
  -webkit-animation-delay: -0.3s;
          animation-delay: -0.3s; }
.sk-circle .sk-circle11:before {
  -webkit-animation-delay: -0.2s;
          animation-delay: -0.2s; }
.sk-circle .sk-circle12:before {
  -webkit-animation-delay: -0.1s;
          animation-delay: -0.1s; }

@-webkit-keyframes sk-circleBounceDelay {
  0%, 80%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0);
  } 40% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
}

@keyframes sk-circleBounceDelay {
  0%, 80%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0);
  } 40% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
}
</style>
<div class="sk-circle loader"style="display:none">
  <div class="sk-circle1 sk-child"></div>
  <div class="sk-circle2 sk-child"></div>
  <div class="sk-circle3 sk-child"></div>
  <div class="sk-circle4 sk-child"></div>
  <div class="sk-circle5 sk-child"></div>
  <div class="sk-circle6 sk-child"></div>
  <div class="sk-circle7 sk-child"></div>
  <div class="sk-circle8 sk-child"></div>
  <div class="sk-circle9 sk-child"></div>
  <div class="sk-circle10 sk-child"></div>
  <div class="sk-circle11 sk-child"></div>
  <div class="sk-circle12 sk-child"></div>
</div>

<div class="tab" >
  <button  class="tablinks "> <a href="{{ route('admin.hr_pro.add_trade_license__sponsors__partners') }}" style=""> Add New Trade License </a>  </button>
  <form action="" method="get">
    <input type="text" name="status" value="approved" class="d-none">
    <button type="submit" class="tablinks <?php 
      if (isset($_GET["status"])) {
        if($_GET["status"] == 'approved'){
          echo 'active';
        }
      }
      ?>" onclick="openCity(event, 'approved')"> Approved / Existing Trade License 
    </button>
  </form>
  <form action="" method="get">
    <input type="text" name="status" value="pending" class="d-none">
    <button type="submit" class="tablinks <?php 
      if (isset($_GET["status"])) {
        if($_GET["status"] == 'pending'){
          echo 'active';
        }
      }
      ?>" onclick="openCity(event, 'pending')">  Pending Trade License 
    </button>
  </form>

  <form action="" method="get">
    <input type="text" name="status" value="rejected" class="d-none">
    <button class="mt-2" type="submit" class="tablinks <?php 
      if (isset($_GET["status"])) {
        if($_GET["status"] == 'rejected'){
          echo 'active';
        }
      }
      ?>" onclick="openCity(event, 'rejected')"> Rejected Trade License 
    </button>
  </form>

</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex mt-3 mb-3" style="justify-content: space-between;">
            <div>
                <a href="{{ route( 'admin.hr_pro.employee') }}">
                    <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
                </a>
                
        </div>
        <div class="mt-3 mb-3"> 
                
                <a href="{{ route( 'admin.hr_pro.complaints_history') }}"target="_blank" class="ml-3">
                        <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="30">
                </a> 

                <a href="{{ route( 'admin.hr_pro.trash_complaints') }}" target="_blank" class="ml-3">
                    <img  src="<?= asset('assets') ?>/images/trash.png" alt="" width="30">
                </a>
            </div>

            
        </div>
        @if (session('success'))
            <div class="alert alert-success mb-3" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">??</span>
                </button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger mb-3" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">??</span>
                </button>
            </div>
            @endif
        <div id="approved" class="tabcontent" style="display: <?php 
          if (isset($_GET["status"])) {
            if($_GET["status"] == 'approved'){
              echo 'block';
            }
          }else{
            echo 'block';
          }
          ?>;">
        </div>

        <div id="pending" class="tabcontent" style="display: <?php 
          if (isset($_GET["status"])) {
            if($_GET["status"] == 'pending'){
              echo 'block';
            }
          }else{
            echo 'block';
          }
          ?>;">
        </div>

        <div id="rejected" class="tabcontent" style="display: <?php 
          if (isset($_GET["status"])) {
            if($_GET["status"] == 'rejected'){
              echo 'block';
            }
          }else{
            echo 'block';
          }
          ?>;">
        </div>
    </div>
</div>
          



<div class="container">
    <!-- <a href="{{ route( 'admin.hr_pro.add_trade_license__sponsors__partners') }}" class="mb-5">
        <button class="btn btn-primary">
            Add Trade License
        </button>
    </a> -->

    <div class="d-flex" style="justify-content: space-between;">
        <div>
            <a href="{{ route( 'admin.dashboard') }}" class="ml-3">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
            <a href="{{ route( 'admin.hr_pro.add_trade_license__sponsors__partners') }}" class="ml-3">
                <img  src="<?= asset('assets') ?>/images/add-button.png" alt="" width="30">
            </a>
        </div>
        

        <div class=""> 
            <a href="{{ route( 'admin.hr_pro.trade_license__sponsors__partners_history') }}"target="_blank" class="ml-3">
                    <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" title="History" width="30">
            </a> 
            <a href="{{ route( 'admin.hr_pro.trash_trade_license__sponsors__partners') }}" class="ml-3" target="_blank">
                <img  src="<?= asset('assets') ?>/images/trash.png" alt="" title="Trash" width="30">
            </a>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            @if (session('success'))
            <div class="alert alert-success mb-3" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">??</span>
                </button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger mb-3" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">??</span>
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
                            <table  class="display table2 table responsive nowrap " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Trade Name</th>
                                        <th>License Number</th>
                                        <th>Company</th>
                                        <th>Expiary Date</th>
                                        <th>User Name</th>

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
                                        <td>{{ $trade_license->id }}</td>
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
                                            <form action="{{ route( 'admin.hr_pro.view_trade_license__sponsors__partners') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 bg-white">
                                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" title="View" width="34">
                                                </button>
                                            </form>

                                            <form action="{{ route( 'admin.hr_pro.edit_trade_license__sponsors__partners') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 bg-white">
                                                        <img src="<?= asset('assets') ?>/images/edit_icon.png" title="Edit" alt="" width="34">
                                                </button>
                                            </form>
                                                
                                        
                                            <a href="#" id="{{ $trade_license->id }}" class="delete-file">
                                                
                                                <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" title="Delete" width="34">
                                        
                                            </a>
                                            <button class="p-0 btn bg-white _r_btn border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?php
                                                    $check = 0;
                                                    foreach(Trade_license_partners::where('trade_license_id' ,'=',$trade_license->id)->where('row_status' , '!=' , 'deleted')->get() as $rate){
                                                        if($rate->status == 'pending'){
                                                            $check = 1;
                                                        }
                                                    }
                                                
                                                ?>
                                                @if($check == 1)
                                                <img src="<?= asset('assets') ?>/images/partner-red.png" alt="" title="Pending Partners" width="40">
                                                @else
                                                <img src="<?= asset('assets') ?>/images/partner.png" alt="" title="Partners" width="40">
                                                @endif
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item" href="{{ route('admin.hr_pro.trade_license_partners_add',  $trade_license->id  ) }}">Add Partner</a>
                                                <a class="dropdown-item" href="{{ route('admin.hr_pro.trade_license_partners', $trade_license->id ) }}">View Partner</a>
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
                        <div class="table-responsive">
                            <table   class="display table1 table responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Trade Name</th>
                                        <th>License Number</th>
                                        <th>Company</th>
                                        <th>Expiary Date</th>
                                        <th>Username</th>
                                        <th>User Action</th>

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
                                    @if($trade_license->status == 'pending' && $trade_license->row_status != 'deleted')
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
                                            <form action="{{ route( 'admin.hr_pro.view_trade_license__sponsors__partners') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 bg-white">
                                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" title="View" width="34">
                                                </button>
                                            </form>

                                            <form action="{{ route( 'admin.hr_pro.edit_trade_license__sponsors__partners') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 bg-white">
                                                        <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" title="Edit" width="34">
                                                </button>
                                            </form>
                                                
                                        
                                            <a href="#" id="{{ $trade_license->id }}" class="delete-file">
                                                
                                                <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" title="Delete" width="34">
                                        
                                            </a>
                                            <button class="p-0 btn bg-white _r_btn border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?php
                                                    $check = 0;
                                                    foreach(Trade_license_partners::where('trade_license_id' ,'=',$trade_license->id)->where('row_status' , '!=' , 'deleted')->get() as $rate){
                                                        if($rate->status == 'pending'){
                                                            $check = 1;
                                                        }
                                                    }
                                                
                                                ?>
                                                @if($check == 1)
                                                <img src="<?= asset('assets') ?>/images/partner-red.png" alt="" title="Pending Partners" width="40">
                                                @else
                                                <img src="<?= asset('assets') ?>/images/partner.png" alt="" title="Partners" width="40">
                                                @endif
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item" href="{{ route('admin.hr_pro.trade_license_partners_add',  $trade_license->id  ) }}">Add Partner</a>
                                                <a class="dropdown-item" href="{{ route('admin.hr_pro.trade_license_partners', $trade_license->id ) }}">View Partner</a>
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
                            <table   class="display table1 table responsive nowrap " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Trade Name</th>
                                        <th>License Number</th>
                                        <th>Company</th>
                                        <th>Expiary Date</th>
                                        <th>Username</th>
                                        <th>User Action</th>

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
                                    @if($trade_license->status == 'rejected' && $trade_license->row_status != 'deleted')
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
                                            <form action="{{ route( 'admin.hr_pro.view_trade_license__sponsors__partners') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 bg-white">
                                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" title="View" width="34">
                                                </button>
                                            </form>

                                            <form action="{{ route( 'admin.hr_pro.edit_trade_license__sponsors__partners') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="{{$trade_license->id}}" placeholder="Enter id" >
                                                <button type="submit" class="border-0 bg-white">
                                                        <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" title="Edit" width="34">
                                                </button>
                                            </form>
                                                
                                        
                                            <a href="#" id="{{ $trade_license->id }}" class="delete-file">
                                                
                                                <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" title="Delete" width="34">
                                        
                                            </a>
                                            <button class="p-0 btn bg-white _r_btn border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?php
                                                    $check = 0;
                                                    foreach(Trade_license_partners::where('trade_license_id' ,'=',$trade_license->id)->where('row_status' , '!=' , 'deleted')->get() as $rate){
                                                        if($rate->status == 'pending'){
                                                            $check = 1;
                                                        }
                                                    }
                                                
                                                ?>
                                                @if($check == 1)
                                                <img src="<?= asset('assets') ?>/images/partner-red.png" alt="" title="Pending Partners" width="40">
                                                @else
                                                <img src="<?= asset('assets') ?>/images/partner.png" alt="" title="Partners" width="40">
                                                @endif
                                            </button>
                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                <a class="dropdown-item" href="{{ route('admin.hr_pro.trade_license_partners_add',  $trade_license->id  ) }}">Add Partner</a>
                                                <a class="dropdown-item" href="{{ route('admin.hr_pro.trade_license_partners', $trade_license->id ) }}">View Partner</a>
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
            $('.table2').DataTable( {
                dom: 'Bfrtip',
                "columnDefs": [
                    {
                        "targets": [ 6 ],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "targets": [ 7 ],
                        "visible": false
                    },
                    {
                        "targets": [ 8 ],
                        "visible": false
                    },
                    {
                        "targets": [ 9 ],
                        "visible": false
                    },
                    {
                        "targets": [ 10 ],
                        "visible": false
                    },
                    {
                        "targets": [ 11 ],
                        "visible": false
                    },
                    {
                        "targets": [ 12 ],
                        "visible": false
                    },
                    {
                        "targets": [ 13 ],
                        "visible": false
                    },
                    {
                        "targets": [ 14 ],
                        "visible": false
                    },
                    {
                        "targets": [ 15 ],
                        "visible": false
                    },
                    {
                        "targets": [ 16 ],
                        "visible": false
                    },
                    {
                        "targets": [ 17 ],
                        "visible": false
                    }
                ],
                responsive: true,
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
                "columnDefs": [
                    
                    {
                        "targets": [ 6 ],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "targets": [ 6 ],
                        "visible": false,
                        "searchable": false
                    },
                    {
                        "targets": [ 7 ],
                        "visible": false
                    },
                    {
                        "targets": [ 8 ],
                        "visible": false
                    },
                    {
                        "targets": [ 9 ],
                        "visible": false
                    },
                    {
                        "targets": [ 10 ],
                        "visible": false
                    },
                    {
                        "targets": [ 11 ],
                        "visible": false
                    },
                    {
                        "targets": [ 12 ],
                        "visible": false
                    },
                    {
                        "targets": [ 13 ],
                        "visible": false
                    },
                    {
                        "targets": [ 14 ],
                        "visible": false
                    },
                    {
                        "targets": [ 15 ],
                        "visible": false
                    },
                    {
                        "targets": [ 16 ],
                        "visible": false
                    },
                    {
                        "targets": [ 17 ],
                        "visible": false
                    }
                ],
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
                    url:"{{ route( 'admin.hr_pro.delete_trade_license__sponsors__partners_status') }}",
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