<?php 
use App\Models\Company_name;
use App\Models\Muncipality_documents;
use App\Models\User;


?>
<div class="container">
    
    <div class="d-flex" style="justify-content: space-between;">
        <div>
            <a href="{{ route( 'admin.inventory.tyres') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
            <a href="{{ route( 'admin.inventory.tyres.add_used_tyres') }}" class="ml-3">
                <img src="<?= asset('assets') ?>/images/add-button.png" alt="" title="Add Used Tyres" width="30">
            </a>
        </div>

        <div class=""> 
            <a href="{{ route( 'admin.inventory.tyres.tyres_history') }}"target="_blank" class="ml-3">
                <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" title="History" width="30">
            </a>
            <a href="{{ route( 'admin.inventory.tyres.trash_used_tyres') }}" class="ml-3" title="Trash" target="_blank">
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
                                    <th>Tyre Serial Number</th>
                                    <th>Tyre Storage Location</th>
                                    <th>Tyre Brand</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['tyres'] as $tyre)
                                @if($tyre->row_status != 'deleted')
                                @if($tyre->is_complained == 0)

                                <tr> 
                                    <td>{{ $tyre->id }}</td>
                                    <td>{{ $tyre->tyre_serial }}</td>
                                    <td>{{ $tyre->storage_location }}</td>
                                    <td>{{ $tyre->brand }}</td>
                                    <td>{{ $tyre->status }}</td>
                                    <td>
                                        <form action="{{ route( 'admin.inventory.tyres.edit_used_tyres') }}" method="post" class="d-inline">
                                            @csrf
                                            <input type="text" class="form-control d-none" name="id" value ="{{ $tyre->id}}" placeholder="Enter id" >
                                            <button type="submit" class="border-0 " style="background-color: white;">
                                                    <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" title="Edit" width="34">
                                            </button>
                                        </form>

                                        <a href="#" id="{{$tyre->id }}" class="delete-file">
                                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" title="Delete" width="34">
                                        </a>
  
                                    </td>
                                    
                                </tr>

                                @endif
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
            // dom: 'Bfrtip',
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
                    url:"{{ route( 'admin.inventory.tyres.delete_used_tyres_status') }}",
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