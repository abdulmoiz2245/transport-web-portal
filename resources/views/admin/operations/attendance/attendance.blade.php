
<div class="container card p-5">
    <div class="mb-3">
            <a href="{{ route('admin.operations') }}">
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
               
    </div>

</div>

<script>

    function getDaysInMonth(month, year) {
        var date = new Date(year, month, 1);
        var days = [];
        var marked_days = [];
         marked_days = @json( $data['mark_dates'] );
        console.log(marked_days);
        var count = 1;
        while (date.getMonth() === month) {
            var today = new Date(date);
            var year = today.getFullYear();
            var mes = (today.getMonth() + 1).toString().padStart(2, "0");
            var dia = today.getDate().toString().padStart(2, "0");
            
            var date1 =dia+"-"+mes+"-"+year;
            days.push(new Date(date));
            var marked = false;
            var date121 = ""+year+"-"+mes+"-"+dia+"";
            // console.log((date121));
            if(marked_days[0] == date121 ){
                // console.log(date121);

            }
            for(var i=0 ;i<marked_days.length;i++ ){
               

                if(marked_days[i] == date121){
                    // console.log('called');
                    marked = true;
                }
            }
            if(marked == true){
                var route = "{{ route('admin.operations.employee_attendence_mark',['date'=>' :id ']) }}";
                route = route.replace(':id', date1);
                $(".attendance").append('<div class="row mb-3"><div class="col-12"> <div class="d-flex justify-content-between"><div class="d-flex"><span class="mr-3" style=" border: 2px solid #a9a2a2;border-radius: 44px;height: 28px;width: 29px;padding-left: 4px;padding-top: 2px;">'+ count+'</span><p style="  font-weight: 700; font-size: 15px;         margin: 0;">   '+ today + ' </p>  </div> <div> <div class="badge badge-success" style=" font-size: 12px;  ">Marked</div>    </div>  </div> </div> </div>');
            }else{
                var route = "{{ route('admin.operations.employee_attendence_mark',['date'=>' :id ']) }}";
                route = route.replace(':id', date1);
                $(".attendance").append('<div class="row mb-3"><div class="col-12"> <div class="d-flex justify-content-between"><div class="d-flex"><span class="mr-3" style=" border: 2px solid #a9a2a2;border-radius: 44px;height: 28px;width: 29px;padding-left: 4px;padding-top: 2px;">'+ count+'</span><p style="  font-weight: 700; font-size: 15px;         margin: 0;color:blue">  <a href=" '+ route +'"> '+ today +'</a> </p>  </div> <div> <div class="badge badge-danger" style=" font-size: 12px;  ">Not Marked</div>    </div>  </div> </div> </div>');
            }
            // var date1 = new Date(date);
           
            date.setDate(date.getDate() + 1);
            count++;
        }
        return days;
    }
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

    getDaysInMonth(<?= $mon ?>-1,<?= $yr ?>);

    var set_month = <?= $_GET['month'] ?>;
    $(".month").html("<?= $mon_full ?>");
    $(".year").html("<?= $yr ?>");

    

    <?php }else{ ?>
    getDaysInMonth(month,year);
    $(".month").html("<?= date("F") ?>");
    $(".year").html("<?= date("Y") ?>");
    <?php } ?>

    
</script>