<style>
    .badge{
  font-size: 12px;
}
</style>
<div class="container">
    <div class="mb-5"> 
        <a href="{{ route( 'admin.hr_pro.existing_employee') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
    <div class="table-responsive">
        
        <table class="display table responsive nowrap  " style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Designation </th>
                    <th>Type </th>
                    <th>DOJ </th>

                    <th>Modified At </th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['employee'] as $employee)
                
                
                    @if( $employee->row_status == 'deleted')
                    
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->designation_actual }}</td>
                        <td><span class="badge badge-pill badge-success">{{ $employee->type }}</span></td>
                        <td><span class="badge badge-pill badge-success">{{ $employee->employee_doj }}</span></td>

                        <td><span class="badge badge-pill badge-warning">{{ $employee->updated_at }}</span> </td>
                        

                        <td>
                            <form action="{{ route( 'admin.hr_pro.view_employee') }}" method="post" class="d-inline">
                                @csrf
                                <input type="text" class="form-control d-none" name="id" value ="{{$employee->id}}" placeholder="Enter id" >
                                <button type="submit" class="border-0 bg-white">
                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                </button>
                            </form>
                            <a href="#" id="{{ $employee->id }}"  class="restore-file"  onclick="restore_fun(this.id)">
                                <!-- <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="34"> -->
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
                url:"{{ route( 'admin.hr_pro.restore_employee') }}",
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
            // responsive: true,
            buttons: [  
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                //'pdfHtml5'
            ]
        } );
    });
</script>