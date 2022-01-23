<?php
use App\Models\Company_name;
use App\Models\User;
use App\Models\Trade_license;
use App\Models\Office_Land_contract;
?>
<div class="container">
     <div class="mb-5"> 
        <a href="{{ route( 'admin.inventory.tools.tools_entry') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>

    


    <div class="table-responsive">
        <table class="display table responsive nowrap  " style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Tool Description</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Assign person name </th>
                    <th>Assign person Designation </th>
                    <th>Receiving</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['tools_entry'] as $tools_entry)
                    @if($tools_entry->row_status == 'deleted')
                    <tr> 
                        <td>{{  $tools_entry->id }}</td>
                        <td>{{  $tools_entry->tools_description }}</td>
                        <td>{{  $tools_entry->date }}</td>
                        <td>{{  $tools_entry->quantity }}</td>
                        <td>{{  $tools_entry->assign_person_name }}</td>
                        <td>{{  $tools_entry->assign_person_designation }}</td>
                        <td>
                            @if($tools_entry->reciving)
                                <a  target="_blank" href="{{ asset('main_admin\inventory\tools\reciving')}}/{{$tools_entry->reciving}}">
                                    <button class="btn">View</button>
                                </a>

                                <a  download href="{{ asset('main_admin\inventory\tools\reciving')}}/{{$tools_entry->reciving}}">
                                    <button class="btn">Download</button>
                                </a>
                            @else
                                NO File
                            @endif
                        </td>
                        <td>

                            
                                <a href="#" id="{{ $tools_entry->id }}"  class="restore-file"  >
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
                url:"{{ route( 'admin.inventory.tools.restore_tools_entry') }}",
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