<div class="container">
    <div class="mb-4">
        <a href="{{ route( 'user.customer') }}">
            <button class="btn btn-primary">
                Back
            </button>
        </a>
    </div>
    <div id="smartwizard" class=" mb-2">
        <ul class="nav">
            <li>
                <a class="nav-link" href="#step-1">
                    <h4>Customer Info</h4>
                </a>
            </li>
            <li>
                <a class="nav-link" href="#step-2">
                    <h4>Customer Department</h4>
                </a>
            </li>
            <li>
                <a class="nav-link" href="#step-3">
                    <h4>  Customer Rate Card </h4>
                </a>
            </li>
        </ul>
    
        <div class="tab-content">
            <div id="step-1" class="tab-pane" role="tabpanel">
                <div class="container ">
                    <div class="row mt-5">
                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Company Name :</b></h5>

                                </div>
                                <div class="col-6">
                                    @foreach($data['company_names'] as $company_name)
                                        @if($company_name->id ==  $data['customer_info']->company_id)
                                            <p>{{ $company_name->name }}</p>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Customer Name :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->name }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Customer Name :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->name }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Customer Name :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->name }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Customer Address :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->address }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b> City :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->city }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b> Country :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->country }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Tell :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->tel_number }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Mobile Number :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->mobile }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Fax :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->fax }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Email :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Contact Person :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->contact_person }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Designation :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->des }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Website :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->web }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Credit Term :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->credit_term }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Portal Site Login :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->portal_login }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Remarks :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->remarks }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                                <hr>
                                <h4 class="w-100">TRN </h4>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>TRN Number :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->trn }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b> TRN Copy :</b></h5>

                                </div>
                                <div class="col-8">
                                    @if( $data['customer_info']->trn_copy == null)
                                    
                                        <p>No File Found</p>
                                    @else
                                        <a target="_blank" href="{{ asset('main_admin/customer/')}}/{{$data['customer_info']->trn_copy}}">
                                            <button class="btn">
                                                View Documennt
                                            </button>
                                        </a>

                                        <a  href="{{ asset('main_admin/customer/')}}/{{$data['customer_info']->trn_copy}}" download>
                                            <button class="btn">
                                                Download Documennt
                                            </button>
                                        </a>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                                <hr>
                                <h4 class="w-100">BUSINESS LICENCE </h4>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>BUSINESS LICENCE Expiry date :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->business_license_expiary_date }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>BUSINESS LICENCE Document:</b></h5>

                                </div>
                                <div class="col-8">
                                    @if( $data['customer_info']->business_license_copy == null)
                                    
                                        <p>No File Found</p>
                                    @else
                                        <a target="_blank" href="{{ asset('main_admin/customer')}}/{{$data['customer_info']->business_license_copy}}">
                                            <button class="btn">
                                                View Documennt
                                            </button>
                                        </a>

                                        <a  href="{{ asset('main_admin/customer')}}/{{$data['customer_info']->business_license_copy}}" download>
                                            <button class="btn">
                                                Download Documennt
                                            </button>
                                        </a>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                                <hr>
                                <h4 class="w-100">BUSINESS CONTRACT </h4>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>BUSINESS CONTRACT Expiry date :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_info']->business_contract_expiary_date }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>BUSINESS CONTRACT Document:</b></h5>

                                </div>
                                <div class="col-8">
                                    @if( $data['customer_info']->business_license_copy == null)
                                    
                                        <p>No File Found</p>
                                    @else
                                        <a target="_blank" href="{{ asset('main_admin/customer')}}/{{$data['customer_info']->business_contract_copy}}">
                                            <button class="btn">
                                                View Documennt
                                            </button>
                                        </a>

                                        <a  href="{{ asset('main_admin/customer')}}/{{$data['customer_info']->business_contract_copy}}" download>
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
                
            </div>
            <div id="step-2" class="tab-pane" role="tabpanel">
                @if($data['customer_department'] != null)
                <div class="container">
                    <div class="row mt-5">
                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Department Name :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_department']->department_name }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>CONCERNED PERSON NAME :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_department']->concerned_person_name }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>CONCERNED PERSON DESIGNATION:</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_department']->concerned_person_designation }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Tell :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_department']->tell }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Mobile :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_department']->mobile }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Fax :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_department']->fax }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Email :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_department']->email }}</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>

                @else

                @endif
            </div>
            <div id="step-3" class="tab-pane" role="tabpanel">
                @if($data['customer_rate_card'] != null)
                
                <div class="container">
                    <div class="row mt-5">
                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>From (Location) :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_rate_card']->from }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>To (Location) :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_rate_card']->to }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>VEHICLE TYPE :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_rate_card']->vechicle_type }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Other Charges :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_rate_card']->other_carges }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Other Charges Description :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_rate_card']->other_des }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Rate Type:</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_rate_card']->rate }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Rate :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_rate_card']->rate_price }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Driver Comission :</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_rate_card']->driver_comission }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <hr>
                           <h4>Detention CHARGE</h4> 
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>DETENTION:</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_rate_card']->detention }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Days / Hours:</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_rate_card']->time }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Per Days Charges / Per Hours Charges:</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_rate_card']->charges }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Trip:</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_rate_card']->trip }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Ap Km as per trip:</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_rate_card']->ap_km }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <h5 class=""><b>Ap Diesel as per trip:</b></h5>

                                </div>
                                <div class="col-6">
                                    <p>{{ $data['customer_rate_card']->ap_diesel }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @else

                @endif
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#smartwizard').smartWizard({
            theme: 'dots'
           
        });
    });
</script>