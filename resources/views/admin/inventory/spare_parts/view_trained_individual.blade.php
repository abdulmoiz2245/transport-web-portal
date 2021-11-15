<div class="container">
    <div class="mb-5">
        <a href="{{ route( 'admin.hr_pro.mobiles_trained_individual') }}">
            <img src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>

    </div>
    <div class="row mb-3">
        <div class="col-6">
            <div class="row">
                <div class="col-5">
                    <h5 class="font-weight-bold">Card NUMBER :</h5>

                </div>
                <div class="col-6">
                    <p>{{$data['trained_individual']->card_number}}</p>
                </div>
            </div>
            
            
        </div>
        <div class="col-6">
        <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold">Employee Name :</h5>

                </div>
                <div class="col-6">
                    <p>{{$data['trained_individual']->employee_name}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row  mb-3">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold">Expiary Date :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['trained_individual']->expiary_date }}</p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold"> Back Pic:</h5>

                </div>
                <div class="col-8">
                    @if( $data['trained_individual']->back_pic == NULL)
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$data['trained_individual']->back_pic}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a download href="{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$data['trained_individual']->back_pic}}">
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row  mb-3">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold"> Pass/Card :</h5>

                </div>
                <div class="col-8">
                    @if( $data['trained_individual']->pass_card == NULL)
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$data['trained_individual']->pass_card}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a download href="{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$data['trained_individual']->pass_card}}">
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold"> Front Pic:</h5>

                </div>
                <div class="col-8">
                    @if( $data['trained_individual']->front_pic == NULL)
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$data['trained_individual']->front_pic}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a download href="{{ asset('main_admin/hr_pro/trained_individual/')}}/{{$data['trained_individual']->front_pic}}">
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row  mb-3">

        
        
        
    </div>
</div>

<script>
    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    console.log($("[type='date']").attr("min",new_date) );

</script>