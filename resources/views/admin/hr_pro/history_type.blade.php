<?php
use App\Models\User;
?>
<div class="container">
    <!-- @if(Auth::guard('admin')->check())
    <div class="mb-5">
        <a class="delete-file">
            <button class="btn btn-danger"> Clean table </button>
        </a>
    </div>
    @endif -->
    
<div class="table-responsive">
    <table   class="display table responsive nowrap " style="width:100%">
        <thead>
            <tr>
                <th>Action </th>
                <th>Username</th>
                <th>Link</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['trade_licenses_history'] as $trade_licenses_history)
            <tr>
                
                <td>{{ ucfirst($trade_licenses_history->action) }}</td>

                <td>
                    @if($trade_licenses_history->user_id == 0)
                        Admin
                    @else
                    {{ User::find($trade_licenses_history->user_id)->username}}
                    @endif
                </td> 
                <td>
                    @if(Auth::guard('admin')->check())
                        <?php $route = 'admin.'.$trade_licenses_history->route_name?>
                    @endif

                    @if(Auth::guard('user')->check())
                        <?php $route = 'user.'.$trade_licenses_history->route_name?>
                    @endif

                    <form action="{{ route($route) }}" method="post" class="d-inline">
                        @csrf
                        <input type="text" class="form-control d-none" name="id" value ="{{$trade_licenses_history->data_id}}" placeholder="Enter id" >
                        <button type="submit" class="border-0 bg-white" style="
                            width: 30px;
                        ">
                            <img src="<?= asset('assets') ?>/images/export.png" alt="" >
                        </button>
                    </form>
                </td>

                <td>{{ $trade_licenses_history->date }}</td>

            </tr>
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

    $('.delete-file').click(function () {
            var file_id = this.id;
            swal({
                title: 'Are you sure?',
                text: "You want to Clean this History.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',  
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Clean it!'
            }).then(function () {
                $.ajax({
                    type:'POST',
                    url:"{{ route( 'admin.hr_pro.table_history_clear') }}",
                    data:{table_name:"{{  $data['table_name'] }}",type: "{{  $data['type'] }}" ,  _token :"{{ csrf_token() }}"},
                    success:function(data){
                            if (data.status == 1) {
                                swal({
                                    title: "Cleaned!",
                                    text: "History has been Cleaned.",
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