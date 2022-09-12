<?php 
use App\Models\Company_name;
use App\Models\Purchase_mertial_data;
use App\Models\Supplier_info;

?>
<div class="container   ">

    <div class="mb-5"> 
        <a href="{{ route( 'admin.operations.vehicle_fleet') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>

    <h2 class="mb-3">
        @if( $data['vehicle']->registration_type == 'trailer') 
            Trailer
        @elseif($data['vehicle']->registration_type == 'vehicle')
            Vehicle
        @endif
        Details
    </h2>
    <div class="row mb-3">
        @if($data['vehicle']->registration_type == 'vehicle')
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Vehicle Number : </h5>

                </div>
                <div class="col-6">
                    <p> {{ $data['vehicle']->vehicle_number }} </p>
                </div>
            </div>
        </div>
        @endif
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Company Name :</h5>

                </div>
                <div class="col-6">
                    @foreach(Company_name::all() as $company_name)
                        @if($company_name->id ==  $data['vehicle']->company_id)
                            <p>{{ $company_name->name }}</p>
                        @endif
                    @endforeach
                    
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Registration Date :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['vehicle']->registration_date }} </p>                   
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Registration Expiry :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['vehicle']->registration_exp_date }} </p>                   
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Registration Form  :</h5>

                </div>
                <div class="col-8">
                    @if( $data['vehicle']->regisration_form == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->regisration_form}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a  href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->regisration_form}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Make</h5>

                </div>
                <div class="col-6">
                    
                    <p>{{ $data['vehicle']->make }}</p>
                
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Model :</h5>
                </div>
                <div class="col-8"> 
                        <p>{{ $data['vehicle']->model }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Colour :</h5>
                </div>
                <div class="col-8"> 
                        <p>{{ $data['vehicle']->colour }}</p>
                </div>
            </div>
        </div>
        @if($data['vehicle']->registration_type == 'vehicle')
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Engine Number :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->engine_number }}</p>  
                </div>
            </div>
        </div>
        @elseif($data['vehicle']->registration_type == 'trailer')
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Chassis Number :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->chassis_no }}</p>  
                </div>
            </div>
        </div>
        @endif
        @if($data['vehicle']->registration_type == 'trailer')
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Trailer Type :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->trailer_type }}</p>  
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Trailer Suspension :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->trailer_suspension }}</p>  
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Trailer Size :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->trailer_size }}</p>  
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Axle  :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->axle }}</p>  
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Ton Capacity  :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->ton_capacity }}</p>  
                </div>
            </div>
        </div>
        @endif
        
        @if($data['vehicle']->vehicle_type == 'truck' && $data['vehicle']->registration_type == 'vehicle')
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Truck Type :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->trailer_type }}</p>  
                </div>
            </div>
        </div>

        @elseif($data['vehicle']->vehicle_type == 'pickup')
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Pickup Weight :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->pickup_weight }}</p>  
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Pickup Weight :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->pickup_shape }}</p>  
                </div>
            </div>
        </div>
        @elseif($data['vehicle']->vehicle_type == 'car')
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Car Description :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->car_description }}</p>  
                </div>
            </div>
        </div>
        @endif
        
        <div class="col-12">
            <hr>
            <h2 class="mb-3">
                PASS/TAG/INSURANCE DETAILS  
            </h2>
        </div>

        
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Vehicle Insurnce :</h5>
                </div>
                <div class="col-8">
                    <p> 
                        @if( $data['vehicle']->vehicle_insurance == '0' )
                            Yes
                        @else
                            No
                        @endif
                    </p>  
                </div>
            </div>
        </div> 
        @if( $data['vehicle']->vehicle_insurance == '0' )
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Vehicle Insurance Policy Number :</h5>
                </div>
                <div class="col-8">
                    <p>{{$data['vehicle']->insurance_policy_number}}</p>  
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Vehicle Insurance Expiry Date :</h5>
                </div>
                <div class="col-8">
                    <p>{{$data['vehicle']->insurance_expiry}}</p>  
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Vehicle Insurance  Form  :</h5>

                </div>
                <div class="col-8">
                    @if( $data['vehicle']->insurance_form == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->insurance_form}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a  href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->insurance_form}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
        @endif
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Other Insurnce :</h5>
                </div>
                <div class="col-8">
                    <p> 
                        @if( $data['vehicle']->other_insurance == '0' )
                            Yes
                        @else
                            No
                        @endif
                    </p>  
                </div>
            </div>
        </div> 
        @if( $data['vehicle']->other_insurance == '0' )
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Other Insurance Description :</h5>
                </div>
                <div class="col-8">
                    <p>{{$data['vehicle']->other_insurance_description}}</p>  
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Other Insurance  Expiry Date :</h5>
                </div>
                <div class="col-8">
                    <p>{{$data['vehicle']->other_insurance_exp_date}}</p>  
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Other Insurance  Form  :</h5>

                </div>
                <div class="col-8">
                    @if( $data['vehicle']->other_insurance_form == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->other_insurance_form}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a  href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->other_insurance_form}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
        @endif
      
        
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">J-Ali Tag :</h5>
                </div>
                <div class="col-8">
                    <p>
                        @if( $data['vehicle']->j_ali_tag == '0' )
                            Yes
                        @else
                        No
                        @endif
                        
                    </p>  
                </div>
            </div>
        </div>
        @if( $data['vehicle']->j_ali_tag == '0' )

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">J-Ali Expiry Date :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->j_ali_tag_expiry  }}</p>  
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> J-Ali  Document  :</h5>
                </div>
                <div class="col-8">
                    @if( $data['vehicle']->j_ali_tag_upload == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->j_ali_tag_upload}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a  href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->j_ali_tag_upload}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
        @endif
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Kp Tag :</h5>
                </div>
                <div class="col-8">
                    <p>
                        @if( $data['vehicle']->kp_tag == '0' )
                            Yes
                        @else
                        No
                        @endif
                        
                    </p>  
                </div>
            </div>
        </div>
        @if($data['vehicle']->kp_tag == '0' )

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">KP Tag Expiry Date :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->kp_tag_expiry  }}</p>  
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Kp Tag  Document  :</h5>
                </div>
                <div class="col-8">
                    @if( $data['vehicle']->kp_tag_upload == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->kp_tag_upload}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a  href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->kp_tag_upload}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
        @endif

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Other Tag :</h5>
                </div>
                <div class="col-8">
                    <p>
                        @if( $data['vehicle']->other_tag == '0' )
                            Yes
                        @else
                        No
                        @endif
                        
                    </p>  
                </div>
            </div>
        </div>
        @if( $data['vehicle']->other_tag == '0' )

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Other Tag Description :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->other_tag_description  }}</p>  
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Other Tag Expiry Date :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->other_tag_expiry  }}</p>  
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Other Tag  Document  :</h5>
                </div>
                <div class="col-8">
                    @if( $data['vehicle']->other_tag_upload == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->other_tag_upload}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a  href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->other_tag_upload}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
        @endif

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Sticker :</h5>
                </div>
                <div class="col-8">
                    <p>
                        @if( $data['vehicle']->sticker == '0' )
                            Yes
                        @else
                        No
                        @endif
                        
                    </p>  
                </div>
            </div>
        </div>
        @if( $data['vehicle']->sticker == '0' )

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Sticker Description :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->sticker_description  }}</p>  
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Other Sticker Description :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->describe_other_sticker  }}</p>  
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Sticker Validity :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->sticker_validity  }}</p>  
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Sticker  Document  :</h5>
                </div>
                <div class="col-8">
                    @if( $data['vehicle']->sticker_upload == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->sticker_upload}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a  href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->sticker_upload}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
        @endif

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Pass :</h5>
                </div>
                <div class="col-8">
                    <p>
                        @if($data['vehicle']->pass == '0' )
                            Yes
                        @else
                        No
                        @endif
                        
                    </p>  
                </div>
            </div>
        </div>
        @if( $data['vehicle']->pass == '0' )

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Pass Description :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->pass_description  }}</p>  
                </div>
            </div>
        </div>
        @if($data['vehicle']->pass_description == 'food_pass')
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Food Pass:</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->food_pass  }}</p>  
                </div>
            </div>
        </div>
        @elseif($data['vehicle']->pass_description == 'other')
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Other Pass Description:</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->describe_other_pass  }}</p>  
                </div>
            </div>
        </div>
        @endif

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Pass Validity :</h5>
                </div>
                <div class="col-8">
                    <p>{{ $data['vehicle']->pass_validity  }}</p>  
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Pass  Document  :</h5>
                </div>
                <div class="col-8">
                    @if( $data['vehicle']->pass_upload == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->pass_upload}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a  href="{{ asset('main_admin/vehicle/')}}/{{$data['vehicle']->pass_upload}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
        @endif

        
        <!-- <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Credit Days :</h5>
                </div>
                <div class="col-8">
                    <p> </p>  
                </div>
            </div>
        </div> -->
        <div class="col-md-6 col-12 mb-3">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Vehicle Suspension :</h5>
                </div>
                <div class="col-8">
                    <p>Booster</p>  
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>