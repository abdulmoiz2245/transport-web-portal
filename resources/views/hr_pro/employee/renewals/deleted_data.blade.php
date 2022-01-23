<style>
    .badge{
  font-size: 12px;
}
</style>
<div class="container">
    <div class="mb-5"> 
        <a href="{{ route( 'user.hr_pro.employee_renewals') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
    <div class="table-responsive">
        <table id="trade_license"  class="display table  nowrap " style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Type</th>
                    <th>Reason</th>
                    <th>Modified Date</th>  
                    <th>Action</th>  
                </tr>
            </thead>
            <tbody>
            @foreach($data['renew_employee'] as $renew_employee)
                @if( $renew_employee->row_status == 'deleted')
                @foreach($data['employees'] as $employees)
                @if($employees->id ==  $renew_employee->emp_id)
                    
                <tr>
                
                <td>
                    {{ $renew_employee->id }}
                </td>
                <td>{{ $employees->name }}</td>
                <td>{{ $employees->designation_actual }}</td>
                <td><span class="badge badge-pill badge-success">{{ $employees->type }}</span></td>
                <td>{{ $renew_employee->remarks }}</td>
            
                <td><span class="badge badge-pill badge-warning">{{ $renew_employee->updated_at }}</span></td>
                <td>
                    <form action="{{ route( 'user.hr_pro.view_employee_renewals') }}" method="post" class="d-inline">
                        @csrf
                        <input type="text" class="form-control d-none" name="id" value ="{{$renew_employee->id}}" placeholder="Enter id" >
                        <button type="submit" class="border-0 .bg-white">
                            <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                        </button>
                    </form>
                    
                </td>
                    
                </tr>
                @endif
                @endforeach
                @endif
                @endforeach
            </tbody>         
        </table>
    </div>
</div>

<script>
    function restore_fun(clicked_id) {
        console.log(clicked_id);
        // $('.restore-file').click(function () {
        var file_id = clicked_id;
        swal({
            title: 'Are you sure?',
            text: "You want to Restore this Data.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',  
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore it!'
        }).then(function () {
            $.ajax({
                type:'POST',
                url:"{{ route( 'user.hr_pro.restore_employee_renewals') }}",
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
    }
    $(document).ready(function() {
        $('.table').DataTable( {
            dom: 'Bfrtip',
            responsive: true,
            buttons: [  
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                //'pdfHtml5'
            ]
        } );
    });
</script>