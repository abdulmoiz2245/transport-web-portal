<div class="container   ">

    <div class="mb-5"> 
        <a href="{{ route( 'user.workshop.preventive_check_list') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>

    <div class="row mb-3">

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Id :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['workshop']->id }} </p>                   

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
                    <h5 class=""> Preventive Check List  :</h5>

                </div>
                <div class="col-8">
                    @if( $data['workshop']->check_list_copy == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/workshop/')}}/{{$data['workshop']->check_list_copy}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a  href="{{ asset('main_admin/workshop/')}}/{{$data['workshop']->check_list_copy}}" download>
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
