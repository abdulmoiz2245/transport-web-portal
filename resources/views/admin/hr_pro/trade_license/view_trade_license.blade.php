<div class="container   ">

    <div class="mb-5"> 
        <a href="{{ route( 'admin.hr_pro.trade_license__sponsors__partners') }}">
            <button class="btn btn-primary">
                Back
            </button>
        </a>
    </div>

    <h2>Company</h2>
    <div class="row mb-3">
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Trade Name :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['trade_license']->trade_name }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Company Name :</h5>

                </div>
                <div class="col-6">
                    @foreach($data['company_names'] as $company_name)
                        @if($company_name->id ==  $data['trade_license']->company_id)
                            <p>{{ $company_name->name }}</p>
                        @endif
                    @endforeach
                    
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">License Number :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['trade_license']->license_number }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class="">Expiary Date :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['trade_license']->expiary_date }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Sponsor Page :</h5>

                </div>
                <div class="col-8">
                    @if( $data['trade_license']->sponsor_page == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->sponsor_page}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a  href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->sponsor_page}}" download>
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
                    <h5 class=""> Trade License Copy:</h5>

                </div>
                <div class="col-8">
                    @if( $data['trade_license']->trade_license_copy == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->trade_license_copy}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->trade_license_copy}}" download>
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
                    <h5 class=""> Membership Certificate :</h5>

                </div>
                <div class="col-8">
                    @if( $data['trade_license']->member_ship_certificate == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->member_ship_certificate}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a download href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->member_ship_certificate}}">
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>     
    </div>

    <hr>
    <h2>Manager</h2>
    <div class="row  mb-3">
        <div class="col-md-6 col-12 mb-2">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> ID Card:</h5>

                </div>
                <div class="col-8">
                    @if( $data['trade_license']->manager_id_card == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->manager_id_card}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a download href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->manager_id_card}}">
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-2">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Visa:</h5>

                </div>
                <div class="col-8">
                    @if( $data['trade_license']->manager_visa == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->manager_visa}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a download href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->manager_visa}}">
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-2">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Passport:</h5>

                </div>
                <div class="col-8">
                    @if( $data['trade_license']->manager_passport == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->manager_passport}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a  href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->manager_passport }}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>

    <hr>
    <h2>Sponsor</h2>
    <div class="row  mb-3">
        <div class="col-md-6 col-12 mb-2">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> ID Card:</h5>

                </div>
                <div class="col-8">
                    @if( $data['trade_license']->sponsor_id_card == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->sponsor_id_card}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a download href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->sponsor_id_card}}">
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-2">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Visa:</h5>

                </div>
                <div class="col-8">
                    @if( $data['trade_license']->sponsor_visa == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->sponsor_visa}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a download href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->sponsor_visa}}">
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-2">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Passport:</h5>

                </div>
                <div class="col-8">
                    @if( $data['trade_license']->sponsor_passport == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->sponsor_passport}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a  href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->sponsor_passport }}" download>
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>

    <hr>
    <h2>Partners</h2>
    <div class="row  mb-3">
        <div class="col-md-6 col-12 mb-2">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> ID Card:</h5>

                </div>
                <div class="col-8">
                    @if( $data['trade_license']->partners_id_card == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->partners_id_card}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a download href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->partners_id_card}}">
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-2">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Visa:</h5>

                </div>
                <div class="col-8">
                    @if( $data['trade_license']->partners_visa == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->partners_visa}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a download href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->partners_visa}}">
                            <button class="btn">
                                Download Documennt
                            </button>
                        </a>
                    @endif
                    
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-2">
            <div class="row">
                <div class="col-4">
                    <h5 class=""> Passport:</h5>

                </div>
                <div class="col-8">
                    @if( $data['trade_license']->partners_passport == 'null')
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->partners_passport}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a  href="{{ asset('main_admin/hr_pro/trade_license/')}}/{{$data['trade_license']->partners_passport }}" download>
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
    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    
    console.log($("[type='date']").attr("min",new_date) );

</script>