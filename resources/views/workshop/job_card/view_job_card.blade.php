<div class="container   ">

    <div class="mb-5"> 
        <a href="{{ route( 'user.workshop.job_card') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>

    <div class="row mb-3">

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Job Card Id :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['workshop']->id }} </p>                   

                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Job Status :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['workshop']->issue_status }} </p>                   

                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Date :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['workshop']->date }} </p>                   
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Vehicle Number :</h5>

                </div>
                <div class="col-6">
                    @foreach($data['vehicle'] as $vehicle)
                        @if($vehicle->id ==  $data['workshop']->vehicle_id)
                            <p>{{ $vehicle->vehicle_number }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Driver Name:</h5>
                </div>
                <div class="col-6">
                    @foreach($data['employee'] as $driver)
                        @if($driver->id ==  $data['workshop']->driver_id)
                            <p>{{ $driver->name }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Mechanic Name:</h5>
                </div>
                <div class="col-6">
                    @foreach($data['employee'] as $mechanic)
                        @if($mechanic->id ==  $data['workshop']->mechanic_id)
                            <p>{{ $mechanic->name }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Denter Name:</h5>
                </div>
                <div class="col-6">
                    @foreach($data['employee'] as $denter)
                        @if($denter->id ==  $data['workshop']->denter_id)
                            <p>{{ $denter->name }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Painter Name:</h5>
                </div>
                <div class="col-6">
                    @foreach($data['employee'] as $painter)
                        @if($painter->id ==  $data['workshop']->painter_id)
                            <p>{{ $painter->name }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Whelder Name:</h5>
                </div>
                <div class="col-6">
                    @foreach($data['employee'] as $whelder)
                        @if($whelder->id ==  $data['workshop']->whelder_id)
                            <p>{{ $whelder->name }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Helper Name:</h5>
                </div>
                <div class="col-6">
                    @foreach($data['employee'] as $helper)
                        @if($helper->id ==  $data['workshop']->helper_id)
                            <p>{{ $helper->name }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-12 mb-3">
            <hr>
        </div>
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Driver Complaint :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['workshop']->driver_complaint }} </p>                   
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Job Description :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['workshop']->job_description }} </p>                   
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Other Job Description :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['workshop']->other_job_description }} </p>                   
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Workshop Findings :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['workshop']->findings }} </p>                   
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Job Card  :</h5>

                </div>
                <div class="col-8">
                    @if( $data['workshop']->job_card_document == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/workshop/')}}/{{$data['workshop']->job_card_document}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a  href="{{ asset('main_admin/workshop/')}}/{{$data['workshop']->job_card_document}}" download>
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
