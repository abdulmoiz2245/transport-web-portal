<div class="container card mt-5">
    <div class="mb-5 pl-3 pt-3"> 
        <a href="{{ route( 'user.operations.complaints') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
    @foreach($data['employees'] as $employees)
        @if($employees->id ==  $data['complaint']->emp_id)
    <div class="row mb-3">
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-5">
                    <h5 class="font-weight-bold">Employee Name :</h5>

                </div>
                <div class="col-12 col-md-6">
                    <p>{{ $employees->name }}</p>
                </div>
            </div> 
        </div>
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold">Status :</h5>

                </div>
                <div class="col-12 col-md-6">
                    <p>{{ $data['complaint']->status}}</p>
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
                    <h5 class="font-weight-bold">Complaint :</h5>

                </div>
                <div class="col-12 col-md-6">
                    <p>{{ $data['complaint']->complaint}}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold">Admin Remarks :</h5>

                </div>
                <div class="col-12 col-md-6">
                    <p>{{ $data['complaint']->admin_remarks}}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold">Hr Remarks :</h5>

                </div>
                <div class="col-12 col-md-6">
                    <p>{{ $data['complaint']->hr_remarks}}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold"> Document :</h5>

                </div>
                <div class="col-8">
                    @if( $data['complaint']->upload == NULL)
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['complaint']->upload}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a download href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['complaint']->upload}}">
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