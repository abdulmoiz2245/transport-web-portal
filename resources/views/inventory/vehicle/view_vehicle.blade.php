<div class="container   ">

    <div class="mb-5"> 
        <a href="{{ route( 'user.inventory.vehicle') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
    <div class="row mb-3">
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Date of Added :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->created_at }}</p>  
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Vehicle Type :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->vechicle_type }}</p>  
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Make :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->make }}</p>  
                </div>
            </div>
        </div> 
       
        
        
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Model :</h5>
                </div>
                <div class="col-8">
                    <p> {{ $data['vehicle']->model }} </p>  
                </div>
            </div>
        </div> 
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Color :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->color }}</p>  
                </div>
            </div>
        </div>
        @if($data['vehicle']->vechicle_type == 'truck_head')
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Engine Number :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->engine_number }}</p>  
                </div>
            </div>
        </div>
        @endif
        
        
        @if($data['vehicle']->vechicle_type == 'trailer')
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Chassis no :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->chassis_no }}</p>  
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Trailer Type :</h5>
                </div>
                <div class="col-8">
                    <p> {{ $data['vehicle']->trailer_type }} </p>  
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Size :</h5>
                </div>
                <div class="col-8">
                    <p>{{$data['vehicle']->size  }}</p>  
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Axle :</h5>
                </div>
                <div class="col-8">
                    <p>{{$data['vehicle']->axle  }}</p>  
                </div>
            </div>
        </div>
        @endif
    </div>
</div>