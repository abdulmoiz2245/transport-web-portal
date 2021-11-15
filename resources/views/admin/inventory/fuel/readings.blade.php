<?php 
use App\Models\Company_name;
use App\Models\User;
use App\Models\Trade_license;
use App\Models\Office_Land_contract;


  
?>
<div class="container">

    <div class="d-flex" style="justify-content: space-between;">
        <div>
            <a href="{{ route( 'admin.inventory.fuel') }}" class="ml-3">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
            <a href="{{ route( 'admin.inventory.fuel.readings.add_fuel_reading') }}" class="ml-3">
                <img  src="<?= asset('assets') ?>/images/add-button.png" alt="" width="30">
            </a>
        </div>
        

        <div class=""> 
            <a href="{{ route( 'admin.purchase.purchase_history') }}"target="_blank" class="ml-3">
                    <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="30">
            </a> 
            <a href="{{ route( 'admin.purchase.trash_purchase') }}" class="ml-3" target="_blank">
                <img  src="<?= asset('assets') ?>/images/trash.png" alt="" width="30">
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
                 <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="approved-tab">
                        <div class="table-responsive">
                            <table  class="display table table2  nowrap " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Daily Reading - Non Mobile Tank 01</th>
                                        <th>Refill Amount - Non Mobile Tank 01</th>
                                        <th>Daily Reading - Non Mobile Tank 02</th>
                                        <th>Refill Amount - Non Mobile Tank 02</th>
                                        <th>Daily Reading - Mobile Tank 01</th>
                                        <th>Refill Amount - Mobile Tank 01</th>
                                        <th>Daily Reading - Mobile Tank 02</th>
                                        <th>Refill Amount - Mobile Tank 02</th>
                                        <th>Action By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>22-02-2022</td>
                                        <td>000 Galans</td>
                                        <td>111 Galans</td>
                                        <td>000 Galans</td>
                                        <td>111 Galans</td>
                                        <td>000 Galans</td>
                                        <td>111 Galans</td>
                                        <td>000 Galans</td>
                                        <td>111 Galans</td>
                                        <td>Admin</td>
                                        <td>
                                            <form action="{{ route( 'admin.inventory.fuel.readings.edit_fuel_reading') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="" placeholder="Enter id" >
                                                <button type="submit" class="border-0 bg-white">
                                                        <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                                </button>
                                            </form>
                                                
                                        
                                            <a href="#" id="" class="delete-file">
                                                
                                                <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                                        
                                            </a>  
                                        </td>  
                                    </tr>
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
        });

        $(document).ready(function() {
            $('.table1').DataTable( {
                dom: 'Bfrtip',
                
            
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
                    url:"{{ route( 'admin.purchase.delete_purchase_status') }}",
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