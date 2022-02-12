<?php 
use App\Models\account_cheque;
use App\Models\Company_name;
use App\Models\User;

?>

<?php 
use App\Models\Petty;
use App\Models\Petty_hr;

use App\Models\Petty_bills;
use App\Models\Petty_purchase;
$petty = Petty::latest()->first();
$circulating_cash = 0;

if($petty!= null){
    $avalible_cash = $petty->total_amount;
    
    foreach(Petty_purchase::all() as $purchase){
        if($purchase->amount_paid > 0 && $purchase->reciving_date ==''){
            $circulating_cash += $purchase->amount_paid;
        }
    }

    foreach(Petty_hr::all() as $purchase){
        if($purchase->amount_paid > 0 && $purchase->reciving_date ==''){
            $circulating_cash += $purchase->amount_paid;
        }
    }

    foreach(Petty_bills::all() as $purchase){
        if($purchase->amount > 0 && $purchase->reciving_date ==''){
            $circulating_cash += $purchase->amount;
        }
    }

}else{
    $avalible_cash = 0;
}
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
</style>


<div class="d-flex mt-3 mb-3" style="justify-content: space-between;">
    <div>
        <a href="{{ route( 'admin.petty') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
        
</div>

<div class="row mt-4 mb-4">
        <!-- ICON BG-->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card o-hidden">
                <div class="card-body text-center">
                    <h4 class="card-title"> Avalible Cash</h4>   
                    <p class="text-primary text-24 line-height-1">{{ $avalible_cash }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card o-hidden">
                <div class="card-body text-center">
                    <h4 class="card-title">Circulating Cash</h4>   
                    <p class="text-primary text-24 line-height-1">{{ $circulating_cash}} </p>
                </div>
            </div>
        </div>
        
    </div>
    
<div class="">
  
    <table id="filterTable"  class="display table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Company Name</th>

                <th>Decsription</th>
                <th>Amount Paid</th>

                <th>Amount Recivied</th>
                <th>Balance</th>
                <th>User Id</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['purchase'] as $purchase)
            @if( $purchase->row_status != 'deleted' )

            
            <tr>
                
                <td><span class="badge badge-pill ">{{ $purchase->id }}</span> </td>
                <td><span class="badge badge-pill badge-warning">
                        <?php if(Company_name::all()->count() > 0){ ?>
                            <?php $check = 0; ?>
                        @foreach(Company_name::all() as $company_name)
                            @if($company_name->id == $purchase->company_id)
                                <?php $check = 1 ?>
                                {{ $company_name->name}}
                            @endif
                        @endforeach
                        <?php if($check == 0){ ?>
                            Nill
                        <?php } ?>
                
                    <?php }else{ ?>
                            Nill
                        <?php } ?>
                </span></td>
                <td><span class="badge badge-pill ">{{ $purchase->description }}</span></td>
                <td><span class="badge badge-pill ">{{ $purchase->paid_amount }}</span></td>
                <td><span class="badge badge-pill ">{{ $purchase->recived_amount }}</span></td>
                <td><span class="badge badge-pill badge-warning">{{ $purchase->total_amount }}</span></td>
                <td><span class="badge badge-pill badge-warning">
                    @if($purchase->user_id == 0)
                        Admin
                    @else
                        @if(User::find($purchase->user_id))
                            {{ User::find($purchase->user_id)->username}}
                        @else
                            User Deleted
                        @endif
                    
                    @endif</span>
                </td>
                <td><span class="badge badge-pill badge-warning">{{ $purchase->date }}</span></td>
                
            </tr>

            
            @endif

            @endforeach
        </tbody>         
    </table>
</div>

<div class="modal fade  " id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Issue Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.petty.issue_purchase_payment') }}" enctype="multipart/form-data" method="post">
          @csrf
      <div class="modal-body">
        <input type="text" id="edit_id" class="form-control d-none" name="id" >
        <input type="text" id="" class="form-control d-none" name="pay_by" value="cheque">

        <div class="row">
            
            <div class="col-12  ">
                <label >Amount</label>
                <input type="number" min="0" name="amount" class="form-control" required>
            </div>
            <div class=" col-12 mb-3">
                <div class="form-group">
                    <label>Upload </label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" > </span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="upload" required>
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade  " id="status" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.petty.update_purchase_status') }}" enctype="multipart/form-data" method="post">
          @csrf
      <div class="modal-body">
        <input type="text" id="edit_status_id" class="form-control d-none" name="id" >
        <div class="row">
            
            <div class="col-12 mb-3" id="cheque_reciving">
                <div class="form-group">
                    <label>Upload Reciving</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" > </span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="reciving" required>
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12" id="cheque_reciving_date">
                <label for="">Reciving  Date</label>
                <input type="date" name="reciving_date" class="form-control" required>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
//     $.fn.dataTable.ext.search.push(
//         function( settings, data, dataIndex ) {
//             var min = parseInt( $('#min').val(), 10 );
//             var max = parseInt( $('#max').val(), 10 );
//             var age = parseFloat( data[3] ) || 0; // use data for the age column
    
//             if ( ( isNaN( min ) && isNaN( max ) ) ||
//                 ( isNaN( min ) && age <= max ) ||
//                 ( min <= age   && isNaN( max ) ) ||
//                 ( min <= age   && age <= max ) )
//             {
//                 return true;
//             }
//             return false;
//         }
//     );

//   $(document).ready(function() {
//     var table =  $('.table').DataTable( {
//             dom: 'Bfrtip',
//             responsive: true,
//             buttons: [  
//                 'copyHtml5',
//                 'excelHtml5',
//                 'csvHtml5',
//                 //'pdfHtml5'
//             ]
//         } );
//     });

//     $('#min, #max').keyup( function() {
//         table.draw();
//     } );

    $(".edit_cheque").click(function(){
        document.getElementById('edit_id').value = this.id;
        
    });

    $(".edit_status").click(function(){
        document.getElementById('edit_status_id').value = this.id;
        
    });


</script>


  <script>
    $("document").ready(function () {
      $("#filterTable").dataTable({
        "searching": true
      });
      

     
     

    });
  </script>