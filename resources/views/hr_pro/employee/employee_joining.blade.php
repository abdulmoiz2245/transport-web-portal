<?php 
use App\Models\User;
?>
<div class="card">
    <div class="card-body">
        <div class="container">
            <div class="table-responsive ">
                <table class="display table responsive nowrap  " style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Designation </th>
                            <th>Enter DOJ </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data['employee'] as $employee)
                            @if($employee->applicale_for_joining === true && $employee->row_status != 'deleted' && $employee->admin_status == '1' && $employee->status == 'pending' )
                            
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->designation }}</td>
                                <td>
                                    <form action="{{ route( 'user.hr_pro.employee_doj') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$employee->id}}" placeholder="Enter id" >
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="date" required name="employee_doj" class="form-control">
                                            </div>
                                            <div class="col-">
                                            <button type="submit" class="border-0 btn btn-primary">
                                                Submit
                                            </button>
                                            </div>
                                        </div>
                                    
                                    </form>
                                </td>

                                <td>
                                    <form action="{{ route( 'user.hr_pro.view_employee') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="text" class="form-control d-none" name="id" value ="{{$employee->id}}" placeholder="Enter id" >
                                        <button type="submit" class="border-0 bg-white">
                                            <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                                        </button>
                                    </form>

                                    
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

<script>
    $(document).ready(function() {
        $('.table').DataTable( {
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
              
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
            ]
        } );
    });
</script>