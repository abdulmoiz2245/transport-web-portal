<?php 
use App\Models\Company_name;
  
?>
<div class="container">
    <a href="{{ route( 'user.hr_pro.add_trained_individual') }}" class="mb-5">
        <button class="btn btn-primary">
            Add Trained Individual  </button>
    </a>
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
            <div class="table-responsive">
                <table id="trade_license" class="display table  " style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>card_number</th>
                            <th>employee_name</th>
                            <th>expiary_date</th>
                            <th>pass_card</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['trained_individual'] as $trained_individual)
                        <tr>
                            
                        <td>{{ $trained_individual->id }}</td>
                        <td>{{ $trained_individual->card_number }}</td>
                        <td>{{ $trained_individual->employee_name }}</td>
                        <td>{{ $trained_individual->expiary_date }}</td>
                        <td>{{ $trained_individual->pass_card }}</td>
                        
                        
                            
                        <td>
                            <form action="{{ route( 'user.hr_pro.view_trained_individual') }}" method="post" class="d-inline">
                                @csrf
                                <input type="text" class="form-control d-none" name="id" value ="{{$trained_individual->id}}" placeholder="Enter id" >
                                <button type="submit" class="border-0 .bg-white">
                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                </button>
                            </form>

                            <form action="{{ route( 'user.hr_pro.edit_trained_individual') }}" method="post" class="d-inline">
                                @csrf
                                <input type="text" class="form-control d-none" name="id" value ="{{$trained_individual->id}}" placeholder="Enter id" >
                                <button type="submit" class="border-0 .bg-white">
                                        <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                                </button>
                            </form>
                                
                            
                            <a href="#" id="{{ $trained_individual->id }}" class="delete-file">
                                <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
                            </a>
                        </td>
                            
                        </tr>
                        @endforeach
                    </tbody>         
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#trade_license').DataTable( {
            dom: 'Bfrtip',
            buttons: [
              
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                // 'pdfHtml5'
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
                    url:"{{ route( 'user.hr_pro.delete_trained_individual') }}",
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