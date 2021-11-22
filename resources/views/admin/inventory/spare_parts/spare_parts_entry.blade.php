<?php 
use App\Models\Company_name;
use App\Models\Muncipality_documents;
use App\Models\Inventory_spare_parts;


?>
<div class="container">
    <div class="d-flex" style="justify-content: space-between;">
        <div>
            <a href="{{ route( 'admin.inventory.spare_parts') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
            <a href="{{ route( 'admin.inventory.spare_parts.add_spare_parts_entry') }}" class="ml-3">
                <img src="<?= asset('assets') ?>/images/add-button.png" alt="" title="Add Spare Parts Entry" width="30">
            </a>
        </div>

        <div class=""> 
            <a href="{{ route( 'admin.inventory.spare_parts.spare_parts_entry_history') }}"target="_blank" class="ml-3">
                <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" title="History" width="30">
            </a>
            <a href="{{ route( 'admin.inventory.spare_parts.spare_parts_entry_trash') }}" class="ml-3" title="Trash" target="_blank">
                <img src="<?= asset('assets') ?>/images/trash.png" alt="" width="30">
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
                                @if($spare_parts->row_status != 'deleted')
                                <tr> 
                                    <td>{{ $spare_parts->id }}</td>
                                    <td>
                                    @if(Inventory_spare_parts::find($spare_parts->part_description_id) != null)
                                        {{Inventory_spare_parts::find($spare_parts->part_description_id)->part_description }}</td>
                                    @else
                                    Part Deleted
                                    @endif</td>
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

                                        <form action="{{ route( 'admin.inventory.spare_parts.edit_spare_parts_entry') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{ $spare_parts->id }}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
                                                    <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" title="Edit" width="34">
                                            </button>
                                        </form>
                                            
                                    
                                        <a href="#" id="{{ $spare_parts->id }}" class="delete-file">
                                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" title="Delete" width="34">
                                        </a>

                                    </td>
                                    @endif
                                    @endforeach
                                    
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
        $('.table').DataTable( {
            dom: 'Bfrtip',
            //responsive: true,
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
                    url:"{{ route( 'admin.inventory.spare_parts.delete_spare_parts_entry_status') }}",
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