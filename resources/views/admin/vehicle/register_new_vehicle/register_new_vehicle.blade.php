<?php 
use App\Models\Company_name;
use App\Models\Civil_defense_documents;
use App\Models\User;


?>
<div class="card">
    <div class="card-body">
    <div class="container">
    <div class="d-flex" style="justify-content: space-between;">
        <div>
            <a href="{{ route( 'admin.vehicle.vehicle') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
        </div>
    </div>

    <div class="row mt-4">
    <form action="{{ route( 'admin.vehicle.register_new_vehicle.own_vehicle') }}" method="post" class="d-inline">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('admin.vehicle.register_new_vehicle.own_vehicle') }}">
                <div class="card card-icon mb-4">
                    <div class="card-body text-center">
                        <img src="<?= asset('assets') ?>/images/fuel.png" class="mb-1" alt="" width="35">
                        <input type="hidden" name="vehicle_mode" value="own_vehicle">
                        <button class="btn" class="mt-2 mb-2"><strong>Own Vehicle</strong></button>
                        <p class="lead text-22 m-0"></p>
                    </div>
                </div>
            </a>
        </div>
    </form>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <a href="{{ route('admin.vehicle.register_new_vehicle.hired_sub_contractor_vehicle') }}">
                <div class="card card-icon mb-4">
                    <div class="card-body text-center">
                        <img src="<?= asset('assets') ?>/images/readings.png"  alt="" width="40">
                        <h4 class="mt-2 mb-2"><strong>Hired Sub Contractor Vehicle</strong></h4>
                        <p class="lead text-22 m-0"></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
        <form action="{{ route( 'admin.vehicle.register_new_vehicle.own_vehicle') }}" method="post" class="d-inline">
            <a href="{{ route('admin.vehicle.register_new_vehicle.own_vehicle') }}">
                <div class="card card-icon ">
                    <div class="card-body text-center">
                        <img src="<?= asset('assets') ?>/images/readings.png"  alt="" width="40">
                        <input type="hidden" name="vehicle_mode" value="own_vehicle">
                        <a class="mt-2 mb-2"><strong>Registration</strong></a>
                        <p class="lead text-22 m-0"></p>
                    </div>
                </div>
            </a>
        </form>
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
                url:"{{ route( 'admin.hr_pro.delete_mobile_civil_defence_status') }}",
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

    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');  
    console.log($("[type='date']").attr("min",new_date) );
 
</script>