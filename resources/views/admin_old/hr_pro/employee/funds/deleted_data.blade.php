<style>
    .badge{
  font-size: 12px;
}
</style>
<div class="container">
    <div class="mb-5"> 
        <a href="{{ route( 'admin.hr_pro.employee_funds') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
    <div class="table-responsive">
        <table id="trade_license"  class="display table  nowrap " style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee Name</th>
                    <th>Designation</th>
                    <th>Type</th>
                    <th>Reason</th>
                    <th>Amount</th>
                    <th>Modified Date</th>  
                    <th>Action</th>   
                </tr>
            </thead>
            <tbody>
            @foreach($data['employee_funds'] as $employee_funds)
                @if( $employee_funds->row_status == 'deleted')
                @foreach($data['employees'] as $employees)
                @if($employees->id ==  $employee_funds->emp_id)
                    
                <tr>
                
                <td>
                    {{ $employee_funds->id }}
                </td>
                <td>{{ $employees->name }}</td>
                <td>{{ $employees->designation_actual }}</td>
                <td><span class="badge badge-pill badge-success">{{ $employees->type }}</span></td>
                <td>{{ $employee_funds->reason }}</td>
                <td>{{ $employee_funds->amount }}</td>
              
            
                <td><span class="badge badge-pill badge-warning">{{ $employee_funds->updated_at }}</span></td>
                <td>
                    <a href="#" id="{{ $employee_funds->id }}"  class="restore-file"  onclick="restore_fun(this.id)">
                        <!-- <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="34"> -->
                        <button class="btn btn-success">Restore</button>
                    </a>
                    
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
                url:"{{ route( 'admin.hr_pro.restore_employee_funds') }}",
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