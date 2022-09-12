<?php 
use App\Models\account_cheque;
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

<div class="tab" >

  <a href="{{ route('user.account.payable_booking') }}">
    <button class="tablinks " onclick="openCity(event, 'approved')"> Booking </button>
  </a>
  
  <a href="{{ route('user.account.payable_purchase') }}">
    <button class="tablinks " onclick="openCity(event, 'approved')"> Purchase </button>
  </a>
  
  <button class="tablinks">Employee Salaries</button>

  <a href="{{ route('user.account.payable_petty_fund') }}">
        <button class="tablinks active">Petty Cash</button>
  </a>

  <a  href="{{ route('user.account.payable_hr_fund') }}">
    <button class="tablinks " >Hr Funds</button>
  </a>
  
</div>
<div class="d-flex mt-3 mb-3" style="justify-content: space-between;">
    <div>
        <a href="{{ route( 'user.account') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
        
</div>
<div class="">
    <!-- Purchase Approval -->
    <div class="category-filter" style="display:flex">
        <div  style="display:flex">
            <label for="" style="
                
                margin-left: 12px;
            ">Type:</label>
            <select id="categoryFilter" class="form-control" style="
                    height: 27px;
                    margin-left: 5px;
                ">
                <option value="">Show All</option>
                <option value="partial_paid">Partial paid</option>
                <option value="paid">Paid</option>
                <option value="not_paid">Not Paid</option>
            </select>
        </div>
        
    </div>
    <table id="filterTable"  class="display table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Request Id</th>
                <th>Total Amount</th>

                <th>Amount Remaning</th>
                <th>Amount Paid</th>
                <th>Request Date</th>
                <th>Payment Status</th>

                <th>Issue Cheque</th>
                <th>Action</th>  
            </tr>
        </thead>
        <tbody>
            @foreach($data['petty_fund'] as $petty_fund)
            @if( $petty_fund->row_status != 'deleted' )

            @if( $petty_fund->status != 'paid')
            <tr style="background-color:  <?php if(account_cheque::find($petty_fund->cheque_id)!= null) if(account_cheque::find($petty_fund->cheque_id)->status == 'not_cleared'){ ?> gold; <?php } ?>">
                
                <td><span class="badge badge-pill ">{{ $petty_fund->id }}</span> </td>
                <td><span class="badge badge-pill ">{{ $petty_fund->petty_request_id
 }}</span></td>
                <td><span class="badge badge-pill ">{{ $petty_fund->total_amount }}</span></td>
                <td><span class="badge badge-pill ">{{ $petty_fund->amount_remaning }}</span></td>
                <td><span class="badge badge-pill ">{{ $petty_fund->amount_paid }}</span></td>
                <td><span class="badge badge-pill badge-warning">{{ $petty_fund->date }}</span></td>

                <td>
                    @if($petty_fund->amount_remaning > 0 && $petty_fund->amount_paid > 0)
                        partial_paid
                    @endif
                    @if($petty_fund->amount_remaning == 0 &&   $petty_fund->amount_paid == $petty_fund->total_amount )
                    paid
                    @endif
                    @if( $petty_fund->amount_paid == 0)
                            not_paid
                    @endif
                </td>
               
                <td>
                     @if(  $petty_fund->amount_paid > 0)
                     <form action="{{ route( 'user.account.view_cheque') }}" method="post" class="d-inline">
                        @csrf
                        <input type="text" class="form-control d-none" name="id" value ="{{ $petty_fund->cheque_id }}" placeholder="Enter id" >
                        <button type="submit" id="{{ $petty_fund->cheque_id }}" class="btn btn-success edit_cheque" data-toggle="" data-target="">
                            View Cheque
                        </button>
                     </form>
                    @else
                    <button type="submit" id="{{ $petty_fund->id }}" class="btn btn-primary edit_cheque" data-toggle="modal" data-target="#exampleModal" style=" background-color: #08c;">
                        Issue Cheque
                    </button>
                    @endif                        
                </td>
                <td>

                    <form action="{{ route( 'user.petty.view_finance_request') }}" method="post" class="d-inline">
                        @csrf
                        <input type="text" class="form-control d-none" name="id" value ="{{$petty_fund->petty_request_id
}}" placeholder="Enter id" >
                        <button type="submit" class="border-0 .bg-white">
                            <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                        </button>
                    </form>
                    
                    
                </td>
                
            </tr>

            @endif
            @endif

            @endforeach
        </tbody>         
    </table>
</div>

<div class="modal fade  " id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Issue Cheque</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('user.account.cheque_issue_petty_fund') }}" enctype="multipart/form-data" method="post">
          @csrf
      <div class="modal-body">
        <input type="text" id="edit_id" class="form-control d-none" name="id" >
        <div class="row">
            <div class="col-12  ">
                <label >Cheque Number</label>
                <input type="text" name="cheque_number" class="form-control" required>
            </div>
            <div class="col-12  ">
                <label >Cheque Amount</label>
                <input type="number" min='0' name="cheque_amount" class="form-control" required>
            </div>
            <div class="col-12  ">
                <label >Cheque Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="col-12  ">
                <label >Cheque Due Date</label>
                <input type="date" name="due_date" class="form-control" required>
            </div>
            <div class="col-12  ">
                <label >Account Name</label>
                <input type="text" name="account_name" class="form-control" required>
            </div>
            <div class="col-12  ">
                <label >Account Number</label>
                <input type="text" name="account_number" class="form-control" required>
            </div>
            <div class="   col-12 mb-3">
                <div class="form-group">
                    <label>Upload Cheque</label>
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
        console.log( this.id);
        document.getElementById('edit_id').value = this.id;
        
    });


</script>


  <script>
    $("document").ready(function () {
      $("#filterTable").dataTable({
        "searching": true
      });
      //Get a reference to the new datatable
      var table = $('#filterTable').DataTable();
      //Take the category filter drop down and append it to the datatables_filter div. 
      //You can use this same idea to move the filter anywhere withing the datatable that you want.
      $("#filterTable_filter ").append($("#categoryFilter"));
      $("#filterTable_filter ").css("display" , "flex");
      //Get the column index for the Category column to be used in the method below ($.fn.dataTable.ext.search.push)
      //This tells datatables what column to filter on when a user selects a value from the dropdown.
      //It's important that the text used here (Category) is the same for used in the header of the column to filter
      var categoryIndex = 6;
      $("#filterTable th").each(function (i) {
        if ($($(this)).html() == "Category") {
          categoryIndex = i; return false;
        }
      });
      //Use the built in datatables API to filter the existing rows by the Category column
      $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
          var selectedItem = $('#categoryFilter').val()
          var category = data[categoryIndex];
          if (selectedItem === "" || category.includes(selectedItem)) {
            return true;
          }
          return false;
        }
      );
      //Set the change event for the Category Filter dropdown to redraw the datatable each time
      //a user selects a new filter.
      $("#categoryFilter").change(function (e) {
        table.draw();
      });
      table.draw();
    });
  </script>