<div class="container mt-5">
    <div class="row mb-3">
        <div class="col-6">
            <div class="row">
                <div class="col-5">
                    <h5 class="font-weight-bold">Contract Number :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['office_contract']->contract_number }}</p>
                </div>
            </div>
            
            
        </div>
        <div class="col-6">
        <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold">Plot Details :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['office_contract']->plot_details }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row  mb-3">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold">Landloard Name :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['office_contract']->landloard_name }}</p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold">Contract Expiary Date :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['office_contract']->contract_expiary_date }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row  mb-3">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold">Ijari Number :</h5>

                </div>
                <div class="col-6">
                    <p>{{ $data['office_contract']->ijari_number }}</p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <h5 class="font-weight-bold"> Lease/Rent Documnet:</h5>

                </div>
                <div class="col-8">
                    @if( $data['office_contract']->lease_rent == NULL)
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/office_land_contract/')}}/{{$data['office_contract']->lease_rent}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a download href="{{ asset('main_admin/hr_pro/office_land_contract/')}}/{{$data['office_contract']->lease_rent}}">
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
                    <h5 class="font-weight-bold"> Ijari Certificate :</h5>

                </div>
                <div class="col-8">
                    @if( $data['office_contract']->ijari_certificate == NULL)
                    
                        <p>No File Found</p>
                    @else
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/office_land_contract/')}}/{{$data['office_contract']->ijari_certificate}}">
                            <button class="btn">
                                View Documennt
                            </button>
                        </a>

                        <a download href="{{ asset('main_admin/hr_pro/office_land_contract/')}}/{{$data['office_contract']->ijari_certificate}}">
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