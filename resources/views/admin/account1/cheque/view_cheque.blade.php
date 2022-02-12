<div class="container   ">

    <div class="mb-5"> 
        <a href="{{ route( 'admin.account.cheque') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>

    <h2>Company</h2>
    <div class="row mb-3">
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Issued For :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['cheque']->issued_to }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Accounnt Name :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['cheque']->account_name }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Accounnt Number :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['cheque']->account_number }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Cheque Number :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['cheque']->cheque_number }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Cheque Amount :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['cheque']->cheque_amount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Cheque Date :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['cheque']->date }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Cheque Due Date :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['cheque']->due_date }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Cheque Copy :</h5>

                </div>
                <div class="col-8">
                    @if( $data['cheque']->upload == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/account/')}}/{{$data['cheque']->upload}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a  href="{{ asset('main_admin/account/')}}/{{$data['cheque']->upload}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Reciving Copy :</h5>

                </div>
                <div class="col-8">
                    @if( $data['cheque']->reciving == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/account/')}}/{{$data['cheque']->reciving}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a  href="{{ asset('main_admin/account/')}}/{{$data['cheque']->reciving}}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Reciving Date :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['cheque']->reciving_date }}</p>
                </div>
            </div>
        </div>
    </div>
</div>