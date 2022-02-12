
<style>
    .badge{
  font-size: 12px;
}
</style>
<div class="container card p-5">
    <div class="mb-3">
            <a href="{{ route( 'user.hr_pro.existing_employee_detail') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
            
    </div>
    <form action="" method="get">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="form-group d-flex">
                    <label style="
                        margin-right: 14px;
                        margin-top: 8px;
                        font-weight: 700;
                    ">Month/Year </label>
                    
                    <input type="month" name="month" class="form-control form-control-rounded w-70"  placeholder="Enter to"   required>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="form-group">
                    
                    <input type="submit" class="btn btn-primary " value="Search">
                </div>

            </div>
            <div class="col-12 col-md-5">
                <div class="d-flex">
                    <div class="mr-2">
                        <h3 class="month"></h3>
                    </div>
                    <div>
                        <h3 class="year"></h3>
                    </div>
                </div>

            </div>
        </div>
    </form>
    <hr>
    <div class="container attendance">
        <div class="table-responsive">
            <table id=""  class="display table  nowrap " style="width:100%">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        @for($i=1 ;$i<=31;$i++)
                        <th>{{$i}}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>
                @foreach($data['employee'] as $employee)
                    @if($employee->employee_doj != '' && $employee->status== 'approved' && $employee->row_status != 'deleted')
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        @for($i=1 ;$i<=31;$i++)
                        <td><?php 
                            foreach($data['attendance'] as $attendance){
                                $attendance->emp_id = str_replace("'", "", $attendance->emp_id);
                                if($attendance->emp_id == $employee->id){
                                    $dateValue = strtotime($attendance->date);
                                    if(date("d", $dateValue) == $i){ ?>

                                        
                                        <?php  if($attendance->attendence_status == 'a' || $attendance->attendence_status == 'l'){?>
                                        <span class="badge badge-pill badge-danger">{{ strtoupper($attendance->attendence_status) }}</span>
                                        <?php }else{ ?>
                                            <span class="badge badge-pill badge-success">{{ strtoupper($attendance->attendence_status) }}</span>
                                        <?php }
                                } else {?>
                                <span class=""></span>

                            <?php  } 
                                }
                            } ?>
                        </td>
                        
                        @endfor
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
            buttons: [
              
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        } );
    });

    var dt = new Date();
    var month = dt.getMonth();
    var year = dt.getFullYear();
    <?php if(!empty($_GET['month'])){ 
    $dateValue = strtotime($_GET['month']);                     

    $yr = date("Y", $dateValue) ." "; 
    $mon = date("m", $dateValue)." "; 
    $date = date("d", $dateValue); 
    $mon_full = date("F", $dateValue)." "; 

    ?>

    // getDaysInMonth(<?= $mon ?>-1,<?= $yr ?>);

    var set_month = <?= $_GET['month'] ?>;
    $(".month").html("<?= $mon_full ?>");
    $(".year").html("<?= $yr ?>");

    

    <?php }else{ ?>
    // getDaysInMonth(month,year);
    $(".month").html("<?= date("F") ?>");
    $(".year").html("<?= date("Y") ?>");
    <?php } ?>
</script>