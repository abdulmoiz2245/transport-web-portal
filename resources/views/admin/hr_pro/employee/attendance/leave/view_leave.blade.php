<style>
    .badge{
        font-size: 12px;
    }
</style>
<div class="container card mt-5">
    <div class="mb-5 pl-3 pt-3"> 
        <a href="{{ route( 'admin.hr_pro.employee_leave') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
    @foreach($data['employees'] as $employees)
        @if($employees->id ==  $data['leave']->emp_id && $employees->row_status != 'deleted')
    <div class="row mb-3">
        <div class="col-12 mb-3">
            <div class="row">
                <div class="col-2">
                    <h5 class="font-weight-bold">Employee Name</h5>

                </div>
                <div class="col-12 col-md-6">
                    <p>{{ $employees->name }}</p>
                </div>
            </div> 
        </div>
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold">From :</h5>

                </div>
                <div class="col-12 col-md-6">
                    <span class="badge badge-pill badge-warning">{{ $data['leave']->from }}</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-2">
                    <h5 class="font-weight-bold">To :</h5>

                </div>
                <div class="col-12 col-md-6">
                 <span class="badge badge-pill badge-warning">{{ $data['leave']->to }}</span>
                </div>
            </div>
        </div>
    </div>
        @endif
    @endforeach

    <div class="row  mb-3">
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold">Reason :</h5>

                </div>
                <div class="col-12 col-md-6">
                    <p>{{ $data['leave']->reason}}</p>
                </div>
            </div>
        </div>
    </div>


    <div class="row  mb-3">
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold"> Document :</h5>

                </div>
                <div class="col-8">
                    @if( $data['leave']->upload == NULL)
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['leave']->upload}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a download href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['leave']->upload}}">
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>

      
        
    </div>
</div>

<script>
   
</script>