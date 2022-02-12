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
  
  <a href="{{ route('admin.account.cheque_purchase') }}">
    <button class="tablinks " onclick="openCity(event, 'approved')"> Purchase </button>
  </a>
  
  <button class="tablinks">Employee Salaries</button>
  <button class="tablinks">3PL Services</button>


  <a  href="{{ route('admin.account.cheque_hr_fund') }}">
    <button class="tablinks active" >Hr Funds</button>
  </a>
</div>
<div class="d-flex mt-3 mb-3" style="justify-content: space-between;">
    <div>
        <a href="{{ route( 'admin.account.account') }}">
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
                <option value="cleard">Cleared</option>
                <option value="not_cleard">Wating</option>
                <option value="hold">On Hold</option>
            </select>
        </div>
        
    </div>
    <table id="filterTable"  class="display table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Hr Fund </th>
                <th>Cheque Number</th>
                <th>Cheque Amount</th>
                <th>Cheque Date</th>
                <th>Cheque Due Date</th>

                <th>Cheque Copy</th>
                <th>Receving Copy</th>
                <th>Receving Date</th>

                <th>Status</th>
                <th>Action</th>  
            </tr>
        </thead>
        <tbody>
            @foreach($data['cheque'] as $cheque)
            @if( $cheque->row_status != 'deleted' )
           
            <tr style="background-color:  <?php if(account_cheque::find($cheque->cheque_id)!= null) if(account_cheque::find($cheque->cheque_id)->status == 'not_cleared'){ ?> gold; <?php } ?>">
                
                <td><span class="badge badge-pill ">{{ $cheque->id }}</span> </td>
                <td><span class="badge badge-pill ">{{ $cheque->data_id }}</span></td>
                <td><span class="badge badge-pill ">{{ $cheque->cheque_number }}</span></td>
                <td><span class="badge badge-pill ">{{ $cheque->cheque_amount }}</span></td>
                <td><span class="badge badge-pill  badge-warning">{{ $cheque->date }}</span></td>
                <td><span class="badge badge-pill badge-warning">{{ $cheque->due_date }}</span></td>
                <td>
                    @if( $cheque->upload == null)
                                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/account/')}}/{{$cheque->upload}}">
                            <button class="btn">
                                View Document
                            </button>
                        </a>

                    @endif
                </td>

                <td>
                     @if(  $cheque->status == 'cleard')
                        @if( $cheque->reciving == null)
                            
                            <p>No File Found</p>
                        @else
                            <a target="_blank" href="{{ asset('main_admin/account/')}}/{{$cheque->reciving}}">
                                <button class="btn">
                                    View Document
                                </button>
                            </a>
                        @endif
                     @else
                     <span class="badge badge-pill  badge-warning"> Nill </span>
                     @endif

                </td>

                <td>
                     @if(  $cheque->status == 'cleard')
                     <span class="badge badge-pill  badge-warning ">  {{ $cheque->reciving_date }} </span>
                     @else
                     <span class="badge badge-pill  badge-warning"> Nill </span>
                     @endif

                </td>
               
                <td>
                    
                <span class="badge badge-pill  badge-warning"> {{ $cheque->status }} </span>
                                         
                </td>
                <td>
                    @if(  $cheque->status != 'cleard')
                    <button type="submit" id="{{ $cheque->id }}" class="btn btn-success edit_cheque" data-toggle="modal" data-target="#exampleModal">
                        Update Status
                    </button>
                    @endif
                    <form action="{{ route( 'admin.account.view_cheque') }}" method="post" class="d-inline">
                        @csrf
                        <input type="text" class="form-control d-none" name="id" value ="{{$cheque->id}}" placeholder="Enter id" >
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

<div class="modal fade  " id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Issue Cheque</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('admin.account.update_cheque') }}" enctype="multipart/form-data" method="post">
          @csrf
      <div class="modal-body">
        <input type="text" id="edit_id" class="form-control d-none" name="id" >
        <div class="row">
            
            <div class="col-12">
               <label for="cheque_status">Status</label>
               <select name="status" id="cheque_status" class="form-control" placeholder="status" required>
                  <option value="hold">Hold</option>
                  <option value="cleard">Cleard</option>
               </select>
            </div>
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
    $('#cheque_reciving').hide();
    $('#cheque_reciving_date').hide();
    $(".edit_cheque").click(function(){
        console.log( this.id);
        document.getElementById('edit_id').value = this.id;
        
    });
    $("#cheque_status").on('change'  ,function(evt){
          var e = document.getElementById("cheque_status");
          var strUser = e.value;
          console.log(strUser);

          if(strUser == 'cleard'){
            $('#cheque_reciving').show();
             $('#cheque_reciving_date').show();
          console.log('cleard');

          }else{
            $('#cheque_reciving').hide();
             $('#cheque_reciving_date').hide();
          console.log('not cleared');

          }
          
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
      var categoryIndex = 9;
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