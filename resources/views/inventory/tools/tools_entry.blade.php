<?php 
use App\Models\Company_name;
use App\Models\Muncipality_documents;
use App\Models\User;


?>
<div class="container">
    <div class="d-flex" style="justify-content: space-between;">
        <div>
            <a href="{{ route( 'user.inventory.tools') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
            <a href="{{ route( 'user.inventory.tools.add_tools_entry') }}" class="ml-3">
                <img src="<?= asset('assets') ?>/images/add-button.png" alt="" title="Add Spare Parts Entry" width="30">
            </a>
        </div>

        <div class=""> 
            <a href="{{ route( 'user.inventory.tools.tools_entry_history') }}"target="_blank" class="ml-3">
                <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" title="History" width="30">
            </a>
            <a href="{{ route( 'user.inventory.tools.tools_entry_trash') }}" class="ml-3" title="Trash" target="_blank">
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
                                @if($tools_entry->row_status != 'deleted')
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

                                        <form action="{{ route( 'user.inventory.tools.edit_tools_entry') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{ $tools_entry->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 .bg-white">
                                                    <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" title="Edit" width="34">
                                            </button>
                                        </form>
                                            
                                    
                                        <a href="#" id="{{ $tools_entry->id}}" class="delete-file">
                                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" title="Delete" width="34">
                                        </a>

                        
                                    </td>
                                    
                                </tr>
                                @endif
                                @endforeach
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
                    url:"{{ route( 'user.inventory.tools.delete_tools_entry_status') }}",
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