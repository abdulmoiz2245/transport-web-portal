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
.badge{
    font-size:12px;
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

 .table_button.active{
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
  
  <button class="tablinks active" onclick="openCity(event, 'approved')"> Approved Approval </button>
  <button class="tablinks" onclick="openCity(event, 'pending')">Pending Approval Request</button>
  <button class="tablinks" onclick="openCity(event, 'rejected')">Rejected Approval Request</button>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex mt-3 mb-3" style="justify-content: space-between;">
            <div>
                <a href="{{ route( 'user.account') }}">
                    <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
                </a>
            </div>
                
        </div>
    
        <div id="approved" class="tabcontent" style="display: block;">
          
          <div class="table-responsive">
              <button class="table_button btn ml-3 mt-3 mb-3 active purchase_approved">
                  Purchase
              </button>
              <button class="btn ml-3 mt-3 mb-3 hr_approved">
                  Hr Funds
              </button>
              <button class="btn ml-3 mt-3 mb-3 petty_approved">
                  Petty Funds
              </button>
            <div id="purchase_approved_table" class="">
                <!-- Purchase Approval -->
                <table  class="display table  nowrap " style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Po Number</th>
                            <th>Amount</th>
                            <th>Purchase Date</th>
                            <th>Action</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['purchase'] as $purchase)
                        @if($purchase->status_account == 'approved'  && $purchase->row_status != 'deleted')
        
                        <tr>
                    
                            <td>
                                {{ $purchase->id }}
                            </td>
                            <td>{{ $purchase->po_number }}</td>
                            <td>{{ $purchase->total_amount }}</td>
                            <td><span class="badge badge-pill badge-warning">{{ $purchase->date }}</span></td>
                            <td>
                                <form action="{{ route( 'user.purchase.view_purchase') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="text" class="form-control d-none" name="id" value ="{{$purchase->id}}" placeholder="Enter id" >
                                    <button type="submit" class="border-0 .bg-white">
                                        <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                    </button>
                                </form>
                                
                                
                            </td>
                            
                        </tr>
                    
                        @endif
                        @endforeach
                    </tbody>         
                </table>
            </div>
            
            <div id="hr_approved_table" class="">
                <!-- Hr Approval -->
                <table   class="display table  nowrap " style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Reason</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Action</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['hr_funds'] as $hr_funds)
                        @if($hr_funds->status == 'approved'  && $hr_funds->row_status != 'deleted')
        
                        <tr>
                    
                            <td>
                                {{ $hr_funds->id }}
                            </td>
                            <td>{{ $hr_funds->reason }}</td>
                            <td>{{ $hr_funds->amount }}</td>
                            <td><span class="badge badge-pill badge-warning">{{ $hr_funds->type }}</span></td>
                            <td>
                                <form action="{{ route( 'user.hr_pro.view_employee_funds') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="text" class="form-control d-none" name="id" value ="{{$hr_funds->id}}" placeholder="Enter id" >
                                    <button type="submit" class="border-0 .bg-white">
                                        <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                    </button>
                                </form>
                                
                                
                            </td>
                            
                        </tr>
                    
                        @endif
                        @endforeach
                    </tbody>         
                </table>
            </div>

            <div id="petty_approved_table" class="">
                <!-- Petty Approval -->
                <table   class="display table  nowrap " style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Reason</th>
                            <th>Amount</th>
                            <th>Requested Date</th>
                            <th>Action</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['petty_funds'] as $petty_funds)
                        @if($petty_funds->status == 'approved'  && $petty_funds->row_status != 'deleted')
        
                        <tr>
                    
                            <td>
                                {{ $petty_funds->id }}
                            </td>
                            <td>{{ $petty_funds->reason }}</td>
                            <td>{{ $petty_funds->amount }}</td>
                            <td><span class="badge badge-pill badge-warning">{{ $petty_funds->date }}</span></td>
                            <td>
                                <form action="{{ route( 'user.petty.view_finance_request') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="text" class="form-control d-none" name="id" value ="{{$petty_funds->id}}" placeholder="Enter id" >
                                    <button type="submit" class="border-0 .bg-white">
                                        <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                    </button>
                                </form>
                                
                                
                            </td>
                            
                        </tr>
                    
                        @endif
                        @endforeach
                    </tbody>         
                </table>
            </div>
            
          </div>
        </div>
        <div id="pending" class="tabcontent" >
          <button class="table_button btn ml-3 mt-3 mb-3 active purchase_pending">
                Purchase
            </button>
            <button class="btn ml-3 mt-3 mb-3 hr_pending">
                Hr Funds
            </button>
            <button class="btn ml-3 mt-3 mb-3 petty_pending">
                  Petty Funds
            </button>
          <div class="table-responsive">
            <!-- Purchase Approval -->
            <div id="purchase_pending_table" class="">
                <table   class="display table  nowrap " style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Po Number</th>
                            <th>Amount</th>
                            <th>Purchase Date</th>
                            <th>Action</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['purchase'] as $purchase)
                        @if($purchase->status_admin == 'approved' && $purchase->status_account == 'pending'  && $purchase->row_status != 'deleted')
        
                        <tr>
                    
                            <td>
                                {{ $purchase->id }}
                            </td>
                            <td>{{ $purchase->po_number }}</td>
                            <td>{{ $purchase->total_amount }}</td>
                            <td><span class="badge badge-pill badge-warning">{{ $purchase->date }}</span></td>
                            <td>
                                <form action="{{ route( 'user.account.update_approval') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="text" class="form-control d-none" name="id" value ="{{$purchase->id}}" placeholder="Enter id" >
                                    <input type="text" class="form-control d-none" name="type" value ="purchase" >
                                    <input type="text" class="form-control d-none" name="status" value ="rejected" >
                                    <a href="">
                                    <button type="submit" class="btn btn-danger">
                                        Reject
                                    </button>
                                    </a>
                                </form>

                                <form action="{{ route( 'user.account.update_approval') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="text" class="form-control d-none" name="id" value ="{{$purchase->id}}" placeholder="Enter id" >
                                    <input type="text" class="form-control d-none" name="type" value ="purchase" >
                                    <input type="text" class="form-control d-none" name="status" value ="approved" >
                                    <a href="">
                                    <button type="submit" class="btn btn-success">
                                        Approve
                                    </button>
                                    </a>
                                </form>

                                

                                <form action="{{ route( 'user.purchase.view_purchase') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="text" class="form-control d-none" name="id" value ="{{$purchase->id}}" placeholder="Enter id" >
                                    <button type="submit" class="border-0 .bg-white">
                                        <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                    </button>
                                </form>
                                
                                
                            </td>
                            
                        </tr>
                    
                        @endif
                        @endforeach
                    </tbody>         
                </table>
            </div>
            
            <div  id="hr_pending_table" class="">
                <table  class="display table  nowrap " style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Reason</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Action</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['hr_funds'] as $hr_funds)
                        @if($hr_funds->status == 'pending'  && $hr_funds->row_status != 'deleted')
        
                        <tr>
                    
                            <td>
                                {{ $hr_funds->id }}
                            </td>
                            <td>{{ $hr_funds->reason }}</td>
                            <td>{{ $hr_funds->amount }}</td>
                            <td><span class="badge badge-pill badge-warning">{{ $hr_funds->type }}</span></td>
                            <td>
                                <form action="{{ route( 'user.account.update_approval') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="text" class="form-control d-none" name="id" value ="{{$hr_funds->id}}" placeholder="Enter id" >
                                    <input type="text" class="form-control d-none" name="type" value ="hr_funds" >
                                    <input type="text" class="form-control d-none" name="status" value ="rejected" >
                                    <a href="">
                                    <button type="submit" class="btn btn-danger">
                                        Reject
                                    </button>
                                    </a>
                                </form>

                                <form action="{{ route( 'user.account.update_approval') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="text" class="form-control d-none" name="id" value ="{{$hr_funds->id}}" placeholder="Enter id" >
                                    <input type="text" class="form-control d-none" name="type" value ="hr_funds" >
                                    <input type="text" class="form-control d-none" name="status" value ="approved" >
                                    <a href="">
                                    <button type="submit" class="btn btn-success">
                                        Approve
                                    </button>
                                    </a>
                                </form>
                                <form action="{{ route( 'user.hr_pro.view_employee_funds') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="text" class="form-control d-none" name="id" value ="{{$hr_funds->id}}" placeholder="Enter id" >
                                    <button type="submit" class="border-0 .bg-white">
                                        <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                    </button>
                                </form>
                                
                                
                            </td>
                            
                        </tr>
                    
                        @endif
                        @endforeach
                    </tbody>         
                </table>
            </div>
            
            <div id="petty_pending_table" class="">
                <!-- Petty Approval -->
                <table   class="display table  nowrap " style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Reason</th>
                            <th>Amount</th>
                            <th>Requested Date</th>
                            <th>Action</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['petty_funds'] as $petty_funds)
                        @if($petty_funds->status == 'pending'  && $petty_funds->row_status != 'deleted')
        
                        <tr>
                    
                            <td>
                                {{ $petty_funds->id }}
                            </td>
                            <td>{{ $petty_funds->reason }}</td>
                            <td>{{ $petty_funds->amount }}</td>
                            <td><span class="badge badge-pill badge-warning">{{ $petty_funds->date }}</span></td>
                            <td>
                                <form action="{{ route( 'user.account.update_approval') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="text" class="form-control d-none" name="id" value ="{{$petty_funds->id}}" placeholder="Enter id" >
                                    <input type="text" class="form-control d-none" name="type" value ="petty_funds" >
                                    <input type="text" class="form-control d-none" name="status" value ="rejected" >
                                    <a href="">
                                    <button type="submit" class="btn btn-danger">
                                        Reject
                                    </button>
                                    </a>
                                </form>

                                <form action="{{ route( 'user.account.update_approval') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="text" class="form-control d-none" name="id" value ="{{$petty_funds->id}}" placeholder="Enter id" >
                                    <input type="text" class="form-control d-none" name="type" value ="petty_funds" >
                                    <input type="text" class="form-control d-none" name="status" value ="approved" >
                                    <a href="">
                                    <button type="submit" class="btn btn-success">
                                        Approve
                                    </button>
                                    </a>
                                </form>

                                <form action="{{ route( 'user.petty.view_finance_request') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="text" class="form-control d-none" name="id" value ="{{$petty_funds->id}}" placeholder="Enter id" >
                                    <button type="submit" class="border-0 .bg-white">
                                        <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                    </button>
                                </form>
                                
                                
                            </td>
                            
                        </tr>
                    
                        @endif
                        @endforeach
                    </tbody>         
                </table>
            </div>
            
          </div>
        </div>
        <div id="rejected" class="tabcontent" >
            <button class="table_button btn ml-3 mt-3 mb-3 active purchase_rejected">
                Purchase
            </button>
            <button class="btn ml-3 mt-3 mb-3 hr_rejected">
                Hr Funds
            </button>
            <button class="btn ml-3 mt-3 mb-3 petty_rejected">
                Petty Funds
            </button>
          <div class="table-responsive">
            <!-- Purchase Approval -->
            <div id="purchase_rejected_table" >
                <table   class="display table  nowrap " style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Po Number</th>
                            <th>Amount</th>
                            <th>Purchase Date</th>
                            <th>Action</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['purchase'] as $purchase)
                        @if( $purchase->status_account == 'rejected'  && $purchase->row_status != 'deleted')
        
                        <tr>
                    
                            <td>
                                {{ $purchase->id }}
                            </td>
                            <td>{{ $purchase->po_number }}</td>
                            <td>{{ $purchase->total_amount }}</td>
                            <td><span class="badge badge-pill badge-warning">{{ $purchase->date }}</span></td>
                            <td>
                                <form action="{{ route( 'user.purchase.view_purchase') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="text" class="form-control d-none" name="id" value ="{{$purchase->id}}" placeholder="Enter id" >
                                    <button type="submit" class="border-0 .bg-white">
                                        <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                    </button>
                                </form>
                                
                                
                            </td>
                            
                        </tr>
                    
                        @endif
                        @endforeach
                    </tbody>         
                </table>
            </div>
            
            <div id="hr_rejected_table" class="">
                <table   class="display table  nowrap " style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Reason</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Action</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['hr_funds'] as $hr_funds)
                        @if($hr_funds->status == 'rejected'  && $hr_funds->row_status != 'deleted')
        
                        <tr>
                    
                            <td>
                                {{ $hr_funds->id }}
                            </td>
                            <td>{{ $hr_funds->reason }}</td>
                            <td>{{ $hr_funds->amount }}</td>
                            <td><span class="badge badge-pill badge-warning">{{ $hr_funds->type }}</span></td>
                            <td>
                                <form action="{{ route( 'user.hr_pro.view_employee_funds') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="text" class="form-control d-none" name="id" value ="{{$hr_funds->id}}" placeholder="Enter id" >
                                    <button type="submit" class="border-0 .bg-white">
                                        <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                    </button>
                                </form>
                                
                                
                            </td>
                            
                        </tr>
                    
                        @endif
                        @endforeach
                    </tbody>         
                </table>
            </div>
            
            <div id="petty_rejected_table" class="">
                <!-- Petty Approval -->
                <table   class="display table  nowrap " style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Reason</th>
                            <th>Amount</th>
                            <th>Requested Date</th>
                            <th>Action</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['petty_funds'] as $petty_funds)
                        @if($petty_funds->status == 'rejected'  && $petty_funds->row_status != 'deleted')
        
                        <tr>
                    
                            <td>
                                {{ $petty_funds->id }}
                            </td>
                            <td>{{ $petty_funds->reason }}</td>
                            <td>{{ $petty_funds->amount }}</td>
                            <td><span class="badge badge-pill badge-warning">{{ $petty_funds->date }}</span></td>
                            <td>
                                
                                <form action="{{ route( 'user.petty.view_finance_request') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="text" class="form-control d-none" name="id" value ="{{$petty_funds->id}}" placeholder="Enter id" >
                                    <button type="submit" class="border-0 .bg-white">
                                        <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                    </button>
                                </form>
                                
                                
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

<!-- Modal -->
<div class="modal fade" id="edit_purchase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Approval</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="post" enctype="multipart/form-data">

        <div class="modal-body">
                <input  type="text" value="" name ="edit_id" class="form-control" id="edit_id" aria-describedby="namelHelp" placeholder="Enter Name" style="display:none">
                <div class="form-group">
                    <label  for="edit_invoice_number" >Invoice Number</label>
                    <input id = "edit_status" required type="text" name="invoice_number" class="form-control" id="name" aria-describedby="namelHelp" placeholder="Enter Invoice Number">
                </div>
                <div class="form-group" id="edit_vechicle_number">
                    <label  for="edit_vechicle_number" >Select Vechicle Number</label>
                    <?php if(!empty($vechicles)){  ?>
                    <select name="vechicle_number" id="vechicle_number_select_edit" class="form-control">
                    
                        <?php foreach ($vechicles as $vechicle) { ?>
                            <option value="<?= $vechicle->id ?>"><?= $vechicle->vechicle_number ?></option>
                        <?php } ?>
                    </select>
                    <?php } else { ?>
                        <b> Please Add Vechicles First </b>
                    <?php } ?>
                    <!-- <input id = "edit_vechicle_number" required type="text" name="vechicle_number" class="form-control" id="name" aria-describedby="namelHelp" placeholder="Enter Vechicle Number"> -->
                </div>
                <div class="form-group">
                    <label for="edit_date_start">Invoice Date Start</label>
                    <input value=""  id = "edit_date_start" required type="date" name="invoice_date_start" class="form-control" id=" " aria-describedby="emailHelp" placeholder="Enter Date">
                </div>
                <div class="form-group">
                    <label for="edit_date_end">Invoice Date End</label>
                    <input value=""  id = "edit_date_end" required type="date" name="invoice_date_end" class="form-control" id=" " aria-describedby="emailHelp" placeholder="Enter Date">
                </div>
                <div class="form-group">
                    <label for="edit_price">Price</label>
                    <input id = "edit_price" required type="text" name="price" class="form-control add_price" id=" " aria-describedby="emailHelp" placeholder="Enter Price" readonly>
                </div>
                <div class="form-group">
                    <label for="edit_price">Days</label>
                    <input id = "edit_days" required type="text" name="days" class="form-control" id=" " aria-describedby="emailHelp" placeholder="Enter Price">
                </div>
                <div class="form-group">
                    <label for=" ">Total Amount</label>
                    <input  required type="text" name="total_amount" class="form-control" id = "edit_total_amount" aria-describedby="emailHelp" placeholder="Enter Total Amount">
                </div>
                <div class="form-group">
                    <label for=" ">Other Charges</label>
                    <input  required type="text" name="other_charges" class="form-control" id="edit_other_charges" aria-describedby="emailHelp" placeholder="Other Charges">
                </div>
                <div class="form-group">
                    <label for=" ">Other Charges Description</label>
                    <input  required type="text" name="other_charges_description" class="form-control" id="edit_other_charges_description" aria-describedby="emailHelp" placeholder="Other Charges Description">
                </div>
                
                <div class="form-group">
                    <p class=" pass btn btn-success" id="change-password"> Upload Form</p>
                    <div class="input-group mb-3 change_pass">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input  type="file" name ="userfile" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                </div>
                
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <?php if(!empty($vechicles)){  ?>
            <button type="submit" class="btn btn-primary">Submit</button>
            <?php } ?>
        </div>
        </form>

        
        
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
                //'pdfHtml5'
            ]
        } );
    });

  $('#purchase_approved_table').show();
  $('#hr_approved_table').hide();
  $('#petty_approved_table').hide();

  $('.purchase_approved').click(function () {
    $('#purchase_approved_table').show();
    $('#hr_approved_table').hide();
    $('#petty_approved_table').hide();
    
  });
  $('.hr_approved').click(function () {
    $('#purchase_approved_table').hide();
    $('#petty_approved_table').hide();
    $('#hr_approved_table').show();
    
  });
  $('.petty_approved').click(function () {
    $('#purchase_approved_table').hide();
    $('#petty_approved_table').show();
    $('#hr_approved_table').hide();
    
  });

  $('#purchase_pending_table').show();
  $('#hr_pending_table').hide();
  $('#petty_pending_table').hide();

  $('.purchase_pending').click(function () {
    $('#purchase_pending_table').show();
    $('#hr_pending_table').hide();
    $('#petty_pending_table').hide();

  });
  $('.hr_pending').click(function () {
    $('#purchase_pending_table').hide();
    $('#hr_pending_table').show();
    $('#petty_pending_table').hide();
    
  });
  $('.petty_pending').click(function () {
    $('#purchase_pending_table').hide();
    $('#hr_pending_table').hide();
    $('#petty_pending_table').show();
    
  });

  $('#purchase_rejected_table').show();
  $('#hr_rejected_table').hide();
  $('#petty_rejected_table').hide();

  $('.purchase_rejected').click(function () {
    $('#purchase_rejected_table').show();
    $('#hr_rejected_table').hide();
    $('#petty_rejected_table').hide();

  });
  $('.hr_rejected').click(function () {
    $('#purchase_rejected_table').hide();
    $('#hr_rejected_table').show();
    $('#petty_rejected_table').hide();

  });
  $('.petty_rejected').click(function () {
    $('#purchase_rejected_table').hide();
    $('#hr_rejected_table').hide();
    $('#petty_rejected_table').show();

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
                    url:"{{ route( 'user.hr_pro.delete_employee_suspension_status') }}",
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
  function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      var ent = evt;
      $(".tab ").css("filter", "blur(8px)");
      $(".card ").css("filter", "blur(8px)");

      $(".loader").css('display' , 'block');
      setTimeout(function(ent) { 
      $(".tab ").css("filter", "blur(0px)");
      $(".card ").css("filter", "blur(0px)");

        $(".loader").css('display' , 'none');

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.path[0].className += " active";
        console.log('cale234d');

      }, 2000);
  }
</script>