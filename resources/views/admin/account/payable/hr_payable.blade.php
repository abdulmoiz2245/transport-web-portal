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
  <a href="{{ route('admin.account.payable_booking') }}">
    <button class="tablinks " onclick="openCity(event, 'approved')"> Booking </button>
  </a>
  
  <a href="{{ route( 'admin.account.payable_purchase') }}">
    <button class="tablinks " onclick="openCity(event, 'approved')"> Purchase </button>
  </a>
  
  <button class="tablinks">Employee Salaries</button>
  <a href="{{ route( 'admin.account.payable_petty_fund') }}">
        <button class="tablinks">Petty Cash</button>
  </a>

  <a  href="{{ route( 'admin.account.payable_hr_fund') }}">
    <button class="tablinks active" >Hr Funds</button>
  </a>
  
</div>
<div class="d-flex mt-3 mb-3" style="justify-content: space-between;">
    <div>
        <a href="{{ route( 'admin.account') }}">
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
                <th>Hr Fund Id</th>
                <th>Total Amount</th>

                <th>Amount Remaning</th>
                <th>Amount Paid</th>
                <th>Requested Date</th>
                <th>Payment Status</th>
                <th>Payment Process</th>
                <!-- <th>Action</th>   -->
            </tr>
        </thead>
        <tbody>
            @foreach($data['hr_fund'] as $hr_fund)
            @if( $hr_fund->row_status != 'deleted' )
            @if( $hr_fund->status != 'paid')
            <?php $check = true;
             if( $hr_fund->status == 'partial_paid') {
                if(account_cheque::find($hr_fund->cheque_id)!= null){
                    if(account_cheque::find($hr_fund->cheque_id)->status == 'not_cleared'){
                        $check = true;
                    }else{
                        $check = false;

                    }
                }   
            }
            ?>
            @if($check == true)
            <tr style="background-color:  <?php if(account_cheque::find($hr_fund->cheque_id)!= null) if(account_cheque::find($hr_fund->cheque_id)->status == 'not_cleared'){ ?> gold; <?php } ?>">
                
                <td><span class="badge badge-pill ">{{ $hr_fund->id }}</span> </td>
                <td><span class="badge badge-pill ">{{ $hr_fund->hr_fund_id }}</span></td>
                <td><span class="badge badge-pill ">{{ $hr_fund->total_amount }}</span></td>
                <td><span class="badge badge-pill ">{{ $hr_fund->amount_remaning }}</span></td>
                <td><span class="badge badge-pill ">{{ $hr_fund->amount_paid }}</span></td>
                <td><span class="badge badge-pill badge-warning">{{ $hr_fund->date }}</span></td>
                <td>
                    @if($hr_fund->amount_remaning > 0 && $hr_fund->amount_paid > 0)
                        partial_paid
                    @endif
                    @if($hr_fund->amount_remaning == 0 &&   $hr_fund->amount_paid == $hr_fund->total_amount )
                    paid
                    @endif
                    @if( $hr_fund->amount_paid == 0)
                            not_paid
                    @endif
                </td>
                <td>
                    @if( $hr_fund->pay_by == 'cheque')
                      @if( $hr_fund->pay_by == 'cheque' && $hr_fund->amount_paid > 0)
                      <form action="{{ route( 'admin.account.view_cheque') }}" method="post" class="d-inline">
                          @csrf
                          <input type="text" class="form-control d-none" name="id" value ="{{ $hr_fund->cheque_id }}" placeholder="Enter id" >
                          <button type="submit" id="{{ $hr_fund->cheque_id }}" class="btn btn-success edit_cheque" data-toggle="" data-target="">
                              View Cheque
                          </button>
                      </form>
                      @else
                      <button type="submit" id="{{ $hr_fund->id }}" class="btn btn-primary edit_cheque" data-toggle="modal" data-target="#exampleModal" style=" background-color: #08c;">
                          Issue Cheque
                      </button>
                      @endif
                    @else
                        <select name="pay_by" id="{{ $hr_fund->id }}" class="form-control pay_by">
                            <option >Select</option>
                            <option value="cheque">Cheque</option>
                            <option value="petty">Petty</option>
                        </select>
                    @endif                        
                </td>
                <!-- <td>

                    <form action="{{ route( 'admin.hr_pro.view_employee_funds') }}" method="post" class="d-inline">
                        @csrf
                        <input type="text" class="form-control d-none" name="id" value ="{{$hr_fund->po_id}}" placeholder="Enter id" >
                        <button type="submit" class="border-0 .bg-white">
                            <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                        </button>
                    </form>
                    
                    
                </td> -->
                
            </tr>
            @endif

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
      <form action="{{ route( 'admin.account.cheque_issue_hr_fund') }}" enctype="multipart/form-data" method="post">
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
      //This tells datatables what column to filter on when a admin selects a value from the dropdown.
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
      //a admin selects a new filter.
      $("#categoryFilter").change(function (e) {
        table.draw();
      });
      table.draw();

      $(".pay_by").on('change', function(){
          // console.log(this.value);
          var file_id = this.id;
          if(this.value == 'cheque'){
            document.getElementById('edit_id').value = this.id;
            $('#exampleModal').modal('show');
          }else if(this.value == 'petty'){
            swal({
                title: 'Are you sure?',
                text: "You want to Pay this By Petty.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',  
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Pay it!'
            }).then(function () {
                $.ajax({
                    type:'POST',
                    url:"{{ route( 'admin.account.pay_by_petty_hr') }}",
                    data:{id:file_id, _token :"{{ csrf_token() }}" ,pay_by:"petty"},
                    success:function(data){
                            if (data.status == 1) {
                                swal({
                                    title: "",
                                    text: "Data has been moved to Petty.",
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
      });
    });
  </script>