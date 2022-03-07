<?php
use App\Models\Company_name;
use App\Models\User;
use App\Models\Trade_license;
use App\Models\Office_Land_contract;
?>
<div class="container">
     <div class="mb-5"> 
        <a href="{{ route( 'admin.inventory.spare_parts.spare_parts_in_storage') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>

    <div class="table-responsive">
        <table class="display table responsive nowrap  " style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Part Description</th>
                    <th>Spare Part Condition</th>
                    <th>For </th>
                    <th>Brand Name</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['spare_parts'] as $sparepart)
                    @if($sparepart->row_status == 'deleted')
                    <tr> 
                        <td>{{ $sparepart->id }}</td>
                        <td>{{ $sparepart->part_description }}</td>
                        <td>{{ $sparepart->condition }}</td>
                        <td>{{ $sparepart->for }}</td>
                        <td>{{ $sparepart->brand_name }}</td>
                        <td>{{ $sparepart->quantity }}</td>
                        <td>
                            <a href="#" id="{{ $sparepart->id }}"  class="restore-file"  >
                                <button class="btn btn-success">Restore</button>
                            </a>
                        </td>
                        
                    </tr>
                    @endif
                @endforeach
            </tbody>         
        </table>
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

    $('.restore-file').click(function () {
        var file_id = this.id;
        swal({
            title: 'Are you sure?',
            text: "You want to Restore this Data .",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',  
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'
        }).then(function () {
            $.ajax({
                type:'POST',
                url:"{{ route( 'admin.inventory.spare_parts.restore_spare_parts') }}",
                data:{id:file_id, _token :"{{ csrf_token() }}"},
                success:function(data){
                        if (data.status == 1) {
                            swal({
                                title: "Restored!",
                                text: "Data has been Restored.",
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

    $('.delete-file').click(function () {
        var file_id = this.id;
        swal({
            title: 'Are you sure?',
            text: "You want to delete this Data Permanently.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',  
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function () {
            $.ajax({
                type:'POST',
                url:"{{ route( 'admin.hr_pro.delete_mobiles_trained_individual') }}",
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
function goBack() {
  window.history.back();
}

</script>