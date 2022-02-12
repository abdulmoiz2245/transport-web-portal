<div class="container ">

    <div class="mb-5"> 
        <a href="{{ route( 'user.petty') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>

    <div class="row mb-3">
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold">Amount :</h5>

                </div>
                <div class="col-12 col-md-6">
                    <p>{{ $data['finance_request']->amount }}</p>
                </div>
            </div>
   
        </div>
        <div class="col-12 col-md-6">
        <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold">Reason :</h5>

                </div>
                <div class="col-12 col-md-6">
                    <p>{{ $data['finance_request']->reason }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row  mb-3">
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold">Requested Date :</h5>

                </div>
                <div class="col-12 col-md-6">
                    <p>{{ $data['finance_request']->date }}</p>
                </div>
            </div>
        </div>
       
    </div>
    <div class="row  mb-3">
        
        <div class="col-12 col-md-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold"> Documnet:</h5>

                </div>
                <div class="col-8">
                    @if( $data['finance_request']->upload == NULL)
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/petty/')}}/{{$data['finance_request']->upload}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a download href="{{ asset('main_admin/petty/')}}/{{$data['finance_request']->upload}}">
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