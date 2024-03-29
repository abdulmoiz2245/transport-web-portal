<style>
    /* Style the tab */
.tab {
  /* overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1; */
  margin-bottom: 20px;
}

.badge{
  font-size: 12px;
}

/* Style the buttons inside the tab */
.tab button {
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 14px;
    border-radius: 9px;
    margin-right: 26px;
    background-color: #ddd;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #08c;
    color: #fff;
}

/* Style the tab content */
.tabcontent {
  display: none;
  /* padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none; */
}
    .sk-circle {
        margin: 100px auto;
    width: 40px;
    height: 40px;
    position: fixed;
    left: 50%;
}
.sk-circle .sk-child {
  width: 100%;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
}
.sk-circle .sk-child:before {
  content: '';
  display: block;
  margin: 0 auto;
  width: 15%;
  height: 15%;
  background-color: #333;
  border-radius: 100%;
  -webkit-animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
          animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;
}
.sk-circle .sk-circle2 {
  -webkit-transform: rotate(30deg);
      -ms-transform: rotate(30deg);
          transform: rotate(30deg); }
.sk-circle .sk-circle3 {
  -webkit-transform: rotate(60deg);
      -ms-transform: rotate(60deg);
          transform: rotate(60deg); }
.sk-circle .sk-circle4 {
  -webkit-transform: rotate(90deg);
      -ms-transform: rotate(90deg);
          transform: rotate(90deg); }
.sk-circle .sk-circle5 {
  -webkit-transform: rotate(120deg);
      -ms-transform: rotate(120deg);
          transform: rotate(120deg); }
.sk-circle .sk-circle6 {
  -webkit-transform: rotate(150deg);
      -ms-transform: rotate(150deg);
          transform: rotate(150deg); }
.sk-circle .sk-circle7 {
  -webkit-transform: rotate(180deg);
      -ms-transform: rotate(180deg);
          transform: rotate(180deg); }
.sk-circle .sk-circle8 {
  -webkit-transform: rotate(210deg);
      -ms-transform: rotate(210deg);
          transform: rotate(210deg); }
.sk-circle .sk-circle9 {
  -webkit-transform: rotate(240deg);
      -ms-transform: rotate(240deg);
          transform: rotate(240deg); }
.sk-circle .sk-circle10 {
  -webkit-transform: rotate(270deg);
      -ms-transform: rotate(270deg);
          transform: rotate(270deg); }
.sk-circle .sk-circle11 {
  -webkit-transform: rotate(300deg);
      -ms-transform: rotate(300deg);
          transform: rotate(300deg); }
.sk-circle .sk-circle12 {
  -webkit-transform: rotate(330deg);
      -ms-transform: rotate(330deg);
          transform: rotate(330deg); }
.sk-circle .sk-circle2:before {
  -webkit-animation-delay: -1.1s;
          animation-delay: -1.1s; }
.sk-circle .sk-circle3:before {
  -webkit-animation-delay: -1s;
          animation-delay: -1s; }
.sk-circle .sk-circle4:before {
  -webkit-animation-delay: -0.9s;
          animation-delay: -0.9s; }
.sk-circle .sk-circle5:before {
  -webkit-animation-delay: -0.8s;
          animation-delay: -0.8s; }
.sk-circle .sk-circle6:before {
  -webkit-animation-delay: -0.7s;
          animation-delay: -0.7s; }
.sk-circle .sk-circle7:before {
  -webkit-animation-delay: -0.6s;
          animation-delay: -0.6s; }
.sk-circle .sk-circle8:before {
  -webkit-animation-delay: -0.5s;
          animation-delay: -0.5s; }
.sk-circle .sk-circle9:before {
  -webkit-animation-delay: -0.4s;
          animation-delay: -0.4s; }
.sk-circle .sk-circle10:before {
  -webkit-animation-delay: -0.3s;
          animation-delay: -0.3s; }
.sk-circle .sk-circle11:before {
  -webkit-animation-delay: -0.2s;
          animation-delay: -0.2s; }
.sk-circle .sk-circle12:before {
  -webkit-animation-delay: -0.1s;
          animation-delay: -0.1s; }

@-webkit-keyframes sk-circleBounceDelay {
  0%, 80%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0);
  } 40% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
}

@keyframes sk-circleBounceDelay {
  0%, 80%, 100% {
    -webkit-transform: scale(0);
            transform: scale(0);
  } 40% {
    -webkit-transform: scale(1);
            transform: scale(1);
  }
}
</style>
<div class="sk-circle loader"style="display:none">
  <div class="sk-circle1 sk-child"></div>
  <div class="sk-circle2 sk-child"></div>
  <div class="sk-circle3 sk-child"></div>
  <div class="sk-circle4 sk-child"></div>
  <div class="sk-circle5 sk-child"></div>
  <div class="sk-circle6 sk-child"></div>
  <div class="sk-circle7 sk-child"></div>
  <div class="sk-circle8 sk-child"></div>
  <div class="sk-circle9 sk-child"></div>
  <div class="sk-circle10 sk-child"></div>
  <div class="sk-circle11 sk-child"></div>
  <div class="sk-circle12 sk-child"></div>
</div>

<div class="tab" >
  <!-- <button  class="tablinks "> <a href="{{ route('user.operations.add_absent') }}" style=""> Add New Complaint </a>  </button> -->
  <form action="" method="get">
    <input type="text" name="status" value="new" class="d-none">
    <button type="submit" class="tablinks"> New Absenties 
    </button>
  </form>
  <form action="" method="get">
    <input type="text" name="status" value="approved" class="d-none">
    <button type="submit" class="tablinks <?php 
      if (isset($_GET["status"])) {
        if($_GET["status"] == 'approved'){
          echo 'active';
        }
      }
      ?>" onclick="openCity(event, 'approved')"> Valid  Absents 
    </button>
  </form>
  <form action="" method="get">
    <input type="text" name="status" value="pending" class="d-none">
    <button type="submit" class="tablinks <?php 
      if (isset($_GET["status"])) {
        if($_GET["status"] == 'pending'){
          echo 'active';
        }
      }
      ?>" onclick="openCity(event, 'pending')">  Pending Absent 
    </button>
  </form>
  <form action="" method="get">
    <input type="text" name="status" value="rejected" class="d-none">
    <button class="mt-2" type="submit" class="tablinks <?php 
      if (isset($_GET["status"])) {
        if($_GET["status"] == 'rejected'){
          echo 'active';
        }
      }
      ?>" onclick="openCity(event, 'rejected')"> Rejected Absents 
    </button>
  </form>
  

</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex mt-3 mb-3" style="justify-content: space-between;">
            <div>
                <a href="{{ route( 'user.operations') }}">
                    <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
                </a>
                
        </div>
        <!-- <div class="mt-3 mb-3"> 
                
                <a href="{{ route( 'user.operations.absent_history') }}"target="_blank" class="ml-3">
                        <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="30">
                </a> 

                <a href="{{ route( 'user.operations.trash_absent') }}" target="_blank" class="ml-3">
                    <img  src="<?= asset('assets') ?>/images/trash.png" alt="" width="30">
                </a>
            </div> -->

            
        </div>
        <div id="new" class="tabcontent <?php 
          if (isset($_GET["status"])) {
            if($_GET["status"] == 'new'){
              echo 'active';
            }
          }else{
            echo 'active';
          }
          ?>" style="display: <?php 
          if (isset($_GET["status"])) {
            if($_GET["status"] == 'new'){
              echo 'block';
            }
          }else{
            echo 'block';
          }
          ?>;">
          <div class="table-responsive">
            <table id=""  class="display table  nowrap " style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee Name</th>
                        <th>Designation</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Modified Date</th>  
                        <th>Action</th>  
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['absent'] as $absent)
                    @if($absent->status == 'new'  && $absent->row_status != 'deleted')
                    @foreach($data['employees'] as $employees)
                    @if($employees->id ==  $absent->emp_id)
                        
                    <tr>
                   
                    <td>
                      {{ $absent->id }}
                    </td>
                    <td>{{ $employees->name }}</td>
                    <td>{{ $employees->designation_actual }}</td>
                    <td><span class="badge badge-pill badge-success">{{ $employees->type }}</span></td>
                    
                    <td><span class="badge badge-pill badge-warning">{{ $absent->date }}</span></td>

                    <td><span class="badge badge-pill badge-warning">{{ $absent->updated_at }}</span></td>
                    <td>
                      <form action="{{ route( 'user.operations.view_absent') }}" method="post" class="d-inline">
                            @csrf
                            <input type="text" class="form-control d-none" name="id" value ="{{$absent->id}}" placeholder="Enter id" >
                            <button type="submit" class="border-0 .bg-white">
                                <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                            </button>
                        </form>
                        <form action="{{ route( 'user.operations.edit_absent') }}" method="post" class="d-inline">
                            @csrf
                            <input type="text" class="form-control d-none" name="id" value ="{{$absent->id}}" placeholder="Enter id" >
                            <button type="submit" class="border-0 .bg-white">
                                <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                            </button>
                        </form>
                        <a href="#" id="{{ $absent->id }}" class="delete-file">
                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
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
        <div id="approved" class="tabcontent" style="display: <?php 
          if (isset($_GET["status"])) {
            if($_GET["status"] == 'approved'){
              echo 'block';
            }
          }else{
            echo 'none';
          }
          ?>;">
          <div class="table-responsive">
            <table id=""  class="display table  nowrap " style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee Name</th>
                        <th>Designation</th>
                        <th>Type</th>
                        <th>Reason</th>
                        <th>Hr Remarks</th>
                        <th>Date </th>  

                        <th>Modified Date</th>  
                        <th>Action</th>  
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['absent'] as $absent)
                    @if($absent->status == 'approved'  && $absent->row_status != 'deleted')
                    @foreach($data['employees'] as $employees)
                    @if($employees->id ==  $absent->emp_id)
                        
                    <tr>
                   
                    <td>
                      {{ $absent->id }}
                    </td>
                    <td>{{ $employees->name }}</td>
                    <td>{{ $employees->designation_actual }}</td>
                    <td><span class="badge badge-pill badge-success">{{ $employees->type }}</span></td>
                    <td>{{ $absent->reason }}</td>
                    <td>{{ $absent->hr_remarks }}</td>
                    <td><span class="badge badge-pill badge-warning">{{ $absent->date }}</span></td>

                    <td><span class="badge badge-pill badge-warning">{{ $absent->updated_at }}</span></td>
                    <td>
                      <form action="{{ route( 'user.operations.view_absent') }}" method="post" class="d-inline">
                            @csrf
                            <input type="text" class="form-control d-none" name="id" value ="{{$absent->id}}" placeholder="Enter id" >
                            <button type="submit" class="border-0 .bg-white">
                                <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                            </button>
                        </form>
                        <a href="#" id="{{ $absent->id }}" class="delete-file">
                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
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
        <div id="pending" class="tabcontent" style="display: <?php 
          if (isset($_GET["status"])) {
            if($_GET["status"] == 'pending'){
              echo 'block';
            }
          }else{
            echo 'none';
          }
          ?>;">
          <div class="table-responsive">
            <table id=""  class="display table  nowrap " style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee Name</th>
                        <th>Designation</th>
                        <th>Type</th>
                        <th>Reason</th>
                        <th>Date</th>  

                        <th>Modified Date</th>  
                        <th>Action</th>  
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['absent'] as $absent)
                    @if($absent->status == 'pending'  && $absent->row_status != 'deleted')
                    @foreach($data['employees'] as $employees)
                    @if($employees->id ==  $absent->emp_id)
                        
                    <tr>
                   
                    <td>
                      {{ $absent->id }}
                    </td>
                    <td>{{ $employees->name }}</td>
                    <td>{{ $employees->designation_actual }}</td>
                    <td><span class="badge badge-pill badge-success">{{ $employees->type }}</span></td>
                    <td>{{ $absent->reason }}</td>
                    <td><span class="badge badge-pill badge-warning">{{ $absent->date }}</span></td>

                    <td><span class="badge badge-pill badge-warning">{{ $absent->updated_at }}</span></td>
                    <td>
                      <form action="{{ route( 'user.operations.view_absent') }}" method="post" class="d-inline">
                            @csrf
                            <input type="text" class="form-control d-none" name="id" value ="{{$absent->id}}" placeholder="Enter id" >
                            <button type="submit" class="border-0 .bg-white">
                                <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                            </button>
                        </form>
                        <form action="{{ route( 'user.operations.edit_absent') }}" method="post" class="d-inline">
                            @csrf
                            <input type="text" class="form-control d-none" name="id" value ="{{$absent->id}}" placeholder="Enter id" >
                            <button type="submit" class="border-0 .bg-white">
                                <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                            </button>
                        </form>
                        <a href="#" id="{{ $absent->id }}" class="delete-file">
                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
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
       
        <div id="rejected" class="tabcontent" style="display: <?php 
          if (isset($_GET["status"])) {
            if($_GET["status"] == 'rejected'){
              echo 'block';
            }
          }else{
            echo 'none';
          }
          ?>;" >
          <div class="table-responsive">
            <table id=""  class="display table  nowrap " style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Employee Name</th>
                        <th>Designation</th>
                        <th>Type</th>
                        <th>Complaint</th>
                        <th>Hr Remarks</th>
                        <th>Date</th>
                        <th>Modified Date</th>  
                        <th>Action</th>  
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['absent'] as $absent)
                    @if($absent->status == 'rejected'  && $absent->row_status != 'deleted')
                    @foreach($data['employees'] as $employees)
                    @if($employees->id ==  $absent->emp_id)
                        
                    <tr>
                   
                    <td>
                      {{ $absent->id }}
                    </td>
                    <td>{{ $employees->name }}</td>
                    <td>{{ $employees->designation_actual }}</td>
                    <td><span class="badge badge-pill badge-success">{{ $employees->type }}</span></td>
                    <td>{{ $absent->reason }}</td>
                    <td>{{ $absent->hr_remarks }}</td>
                    <td><span class="badge badge-pill badge-warning">{{ $absent->date }}</span></td>

                    <td><span class="badge badge-pill badge-warning">{{ $absent->updated_at }}</span></td>
                    <td>
                        <form action="{{ route( 'user.operations.view_absent') }}" method="post" class="d-inline">
                            @csrf
                            <input type="text" class="form-control d-none" name="id" value ="{{$absent->id}}" placeholder="Enter id" >
                            <button type="submit" class="border-0 .bg-white">
                                <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" width="34">
                            </button>
                        </form>
                        <form action="{{ route( 'user.operations.edit_absent') }}" method="post" class="d-inline">
                            @csrf
                            <input type="text" class="form-control d-none" name="id" value ="{{$absent->id}}" placeholder="Enter id" >
                            <button type="submit" class="border-0 .bg-white">
                                <img src="<?= asset('assets') ?>/images/edit_icon.png" alt="" width="34">
                            </button>
                        </form>
                        <a href="#" id="{{ $absent->id }}" class="delete-file">
                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" width="34">
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
    </div>
</div>
<script>
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
                    url:"{{ route( 'user.operations.delete_absent_status') }}",
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
  function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      var ent = evt;
      $(".tab ").css("filter", "blur(8px)");
      $(".card ").css("filter", "blur(8px)");

      $(".loader").css('display' , 'block');

      setTimeout(function(ent) { 

        $(".tab ").css("filter", "blur(0px)");
        $(".card ").css("filter", "blur(0px)");

        $(".loader").css('display' , 'none');

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.path[0].className += " active";
        console.log('cale234d');

      }, 0);
  }
</script>