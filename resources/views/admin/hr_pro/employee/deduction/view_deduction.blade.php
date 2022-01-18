<div class="container card mt-5">
    <div class="mb-5 pl-3 pt-3"> 
        <a href="{{ route( 'admin.hr_pro.employee_deduction') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
    @foreach($data['employees'] as $employees)
        @if($employees->id ==  $data['employee_deduction']->emp_id)
    <div class="row mb-3">
        <div class="col-6">
            <div class="row">
                <div class="col-5">
                    <h5 class="font-weight-bold">Employee Name :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $employees->name }}</p>
                </div>
            </div> 
        </div>
        <div class="col-6">
        <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold">Amount :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['employee_deduction']->amount}}</p>
                </div>
            </div>
        </div>
    </div>
        @endif
    @endforeach

    <div class="row  mb-3">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold">Reason :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['employee_deduction']->reason}}</p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold">Applicable Month :</h5>

                </div>
                <div class="col-6">
                    <p>{{  $data['employee_deduction']->applicable_month }}</p>
                </div>
            </div>
        </div>
    </div>


    <div class="row  mb-3">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold"> Document :</h5>

                </div>
                <div class="col-8">
                    @if( $data['employee_deduction']->upload == NULL)
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['employee_deduction']->upload}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a download href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['employee_deduction']->upload}}">
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