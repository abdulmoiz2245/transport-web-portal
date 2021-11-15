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
        </div>
    </div>

    <div class="row mt-4 mb-4">
        <!-- ICON BG-->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card o-hidden">
                <div class="card-body text-center">
                    <h4 class="card-title">Fuel in Storage</h4>   
                    <p class="text-primary text-24 line-height-1">205</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card o-hidden">
                <div class="card-body text-center">
                    <h4 class="card-title">Fuel Purchased</h4>   
                    <p class="text-primary text-24 line-height-1">205</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card o-hidden">
                <div class="card-body text-center">
                    <h4 class="card-title">Fuel Consumption</h4>   
                    <p class="text-primary text-24 line-height-1">205</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12"> 
                 <div class="tab-content profile-tab" id="myTabContent">
                    <div class="tab-pane fade show active" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                        <div class="table-responsive">
                            <table  class="display table2 table  nowrap " style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>PO Number</th>
                                        <th>Company Name</th>
                                        <th>TRN Number</th>
                                        <th>Delivery Date</th>
                                        <th>Action By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>01</td>
                                        <td>3422</td>
                                        <td>eklfwl</td>
                                        <td>erwr54345535</td>
                                        <td>24-01-2021</td>

                                        <td>admin</td>

                                        <td>
                                            <form action="{{ route( 'admin.purchase.view_purchase') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="01" placeholder="Enter id" >
                                                <button type="submit" class="border-0 bg-white">
                                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                                </button>
                                            </form>

                                            <form action="{{ route( 'admin.purchase.edit_purchase') }}" method="post" class="d-inline">
                                                @csrf
                                                <input type="text" class="form-control d-none" name="id" value ="01" placeholder="Enter id" >
                                                <button type="submit" class="border-0 bg-white">
                                                        <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                                </button>
                                            </form>
                                                
                                        
                                            <a href="#" id="01" class="delete-file">
                                                
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