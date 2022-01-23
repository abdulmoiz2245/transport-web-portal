<?php
use App\Models\Company_name;
use App\Models\User;
use App\Models\Trade_license;
use App\Models\Office_Land_contract;
?>
<div class="container">
     <div class="mb-5"> 
        <a href="{{ route( 'admin.inventory.spare_parts.spare_parts_entry') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>

    


    <div class="table-responsive">
        <table class="display table  nowrap  " style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Part Description</th>
                    <th>Vehicle Number</th>
                    <th>Date</th>
                    <th>Spare Part Consumer</th>
                    <th>Driver Name</th>
                    <th>Forman Name</th>
                    <th>Requisition</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['spare_parts'] as $spare_parts)
                    @if($spare_parts->row_status == 'deleted')
                    <tr> 
                        <td>{{ $spare_parts->id }}</td>
                        <td>{{ $spare_parts->part_description_id }}</td>
                        <td>{{ $spare_parts->vechicle }}</td>
                        <td>{{ $spare_parts->date }}</td>
                        <td>{{ $spare_parts->person }}</td>
                        <td>{{ $spare_parts->driver_name }} </td>
                        <td>{{ $spare_parts->forman_name }} </td>
                        <td>
                            @if($spare_parts->requisition)
                            <a  target="_blank" href="{{ asset('main_admin\inventory\spare_part\requisition')}}/{{$spare_parts->requisition}}">
                                <button class="btn">View</button>
                            </a>

                            <a  download href="{{ asset('main_admin\inventory\spare_part\requisition')}}/{{$spare_parts->requisition}}">
                                <button class="btn">Download</button>
                            </a>
                            @else
                                NO File Found
                            @endif
                        </td>
                        <td>
                            <a href="#" id="{{ $spare_parts->id }}"  class="restore-file"  >
                                <button class="btn btn-success">Restore</button>
                            </a>
                        </td>
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
            // responsive: true,
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
                url:"{{ route( 'admin.inventory.spare_parts.restore_spare_parts_entry') }}",
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