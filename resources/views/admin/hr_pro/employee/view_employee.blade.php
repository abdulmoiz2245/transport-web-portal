<?php 
use App\Models\Company_name;
use App\Models\Erp_department;

?>
<style>
    .form-group.required .control-label:after {
        content:"*";
        color:red;
    }
    .edit-badge{    
        margin-left: 20px;
        border: #f26522;
        border-radius: 12px;
        padding-left: 9px;
        padding-right: 9px;
        padding-top: 0px;
        background: #f26522;
        color: white;
        margin-bottom: 8px;
    }
    .old-value{
        background: none;
        border: 1px solid;
        color: #f26522;
        color: #f26522 /*fallback*/;
        display: block;
        line-height: 16px;
        position: relative;
        text-decoration: none;
        vertical-align: middle;
        border-radius: 25px;
        font-size: 12px;
        font-weight: 500;
        padding: 5px 10px;
        white-space: nowrap;
        display: inline-block;
        transition: none;
        text-align: center;
        min-height: 28px;
        min-width: 60px;
    }
</style>
<div class="container">
    <div class="mb-4">
        <a  href="{{ route( 'admin.hr_pro.employee') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
</div>
<div id="smartwizard">
    <ul class="nav">
       <li>
           <a class="nav-link" href="#step-1">
              Basic Info
           </a>
       </li>
       <li>
           <a class="nav-link" href="#step-2">
              Detail 
           </a>
       </li>
       @if($data['employee']->designation == 'driver')
       <li>
           <a class="nav-link" href="#step-3">
              Salary Card
           </a>
       </li>
       <li>
           <a class="nav-link" href="#step-4">
              Comisson Rates
           </a>
       </li>
       @endif
       @if($data['employee']->type == 'permanent')
       <li>
           <a class="nav-link" href="#step-5">
              Incentives 
           </a>
       </li>
       @endif
       <li>
           <a class="nav-link" href="#step-6">
              Deposits 
           </a>
       </li>
       <li>
           <a class="nav-link" href="#step-7">
              Submission and Handover 
           </a>
       </li>
       
    </ul>
    <div class="tab-content">
        <div id="step-1" class="tab-pane" role="tabpanel">
            <div class="row">
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold">Name :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->name }}</p>
                        </div>
                    </div> 
                </div>

                <div class="col-12 col-md-6 mb-3" >
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold">Categorie :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->designation }}</p>
                        </div>
                    </div> 
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold">Actual Designation :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->designation_actual }}</p>
                        </div>
                    </div> 
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> Designation Per Labour Contract :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->designation_per_labour_contract }}</p>
                        </div>
                    </div> 
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> Nationality :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->nationality }}</p>
                        </div>
                    </div> 
                </div>

                <div class="col-12 col-md-6 mb-3">
                    
                    <div class="row">
                        <div class="col-4">
                            <h5 class="font-weight-bold"> Nationality Id Copy:</h5>

                        </div>
                        <div class="col-8">
                            @if( $data['employee']->national_id_copy == NULL)
                            
                                <p>No File Found</p>
                            @else
                                <a target="_blank" href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['employee']->national_id_copy}}">
                                    <button class="btn">
                                        View Documennt
                                    </button>
                                </a>

                                <a download href="{{ asset('main_admin/hr_pro/employee/main/')}}/{{$data['employee']->national_id_copy}}">
                                    <button class="btn">
                                        Download Documennt
                                    </button>
                                </a>
                            @endif
                            
                        </div>
                    </div> 
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> Nationality Id EXP :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->national_id_exp }}</p>
                        </div>
                    </div> 
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> Passport Number :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->passport_number }}</p>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> Passport EXP :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->passport_exp }}</p>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-4">
                            <h5 class="font-weight-bold"> Passport Copy:</h5>

                        </div>
                        <div class="col-8">
                            @if( $data['employee']->passport_copy == NULL)
                            
                                <p>No File Found</p>
                            @else
                                <a target="_blank" href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['employee']->passport_copy}}">
                                    <button class="btn">
                                        View Documennt
                                    </button>
                                </a>

                                <a download href="{{ asset('main_admin/hr_pro/employee/main/')}}/{{$data['employee']->passport_copy}}">
                                    <button class="btn">
                                        Download Documennt
                                    </button>
                                </a>
                            @endif
                            
                        </div>
                    </div>
                    
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> view_office_contracts Number :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->visa_number }}</p>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> Visa UUID :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->visa_uuid }}</p>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> Visa EXP :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->visa_exp }}</p>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-4">
                            <h5 class="font-weight-bold"> Visa Copy:</h5>

                        </div>
                        <div class="col-8">
                            @if( $data['employee']->visa_copy == NULL)
                            
                                <p>No File Found</p>
                            @else
                                <a target="_blank" href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['employee']->visa_copy}}">
                                    <button class="btn">
                                        View Documennt
                                    </button>
                                </a>

                                <a download href="{{ asset('main_admin/hr_pro/employee/main/')}}/{{$data['employee']->visa_copy}}">
                                    <button class="btn">
                                        Download Documennt
                                    </button>
                                </a>
                            @endif
                            
                        </div>
                    </div>
                    
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> NOC Number :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->noc_number }}</p>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> NOC EXP :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->noc_exp }}</p>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-4">
                            <h5 class="font-weight-bold"> NOC Copy:</h5>

                        </div>
                        <div class="col-8">
                            @if( $data['employee']->noc_copy == NULL)
                            
                                <p>No File Found</p>
                            @else
                                <a target="_blank" href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['employee']->noc_copy}}">
                                    <button class="btn">
                                        View Documennt
                                    </button>
                                </a>

                                <a download href="{{ asset('main_admin/hr_pro/employee/main/')}}/{{$data['employee']->noc_copy}}">
                                    <button class="btn">
                                        Download Documennt
                                    </button>
                                </a>
                            @endif
                            
                        </div>
                    </div>
                    
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> Work Permit Number :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->work_permit_number }}</p>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> Work Permit EXP :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->work_permit_exp }}</p>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-4">
                            <h5 class="font-weight-bold"> Work Permit Copy:</h5>

                        </div>
                        <div class="col-8">
                            @if( $data['employee']->work_permit_copy == NULL)
                            
                                <p>No File Found</p>
                            @else
                                <a target="_blank" href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['employee']->work_permit_copy}}">
                                    <button class="btn">
                                        View Documennt
                                    </button>
                                </a>

                                <a download href="{{ asset('main_admin/hr_pro/employee/main/')}}/{{$data['employee']->work_permit_copy}}">
                                    <button class="btn">
                                        Download Documennt
                                    </button>
                                </a>
                            @endif
                            
                        </div>
                    </div>
                    
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> Labour Contract Number :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->labour_contract_number }}</p>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> Labour Contract EXP :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->labour_contract_exp }}</p>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-4">
                            <h5 class="font-weight-bold"> Labour Contract Copy:</h5>

                        </div>
                        <div class="col-8">
                            @if( $data['employee']->labour_contract_copy == NULL)
                            
                                <p>No File Found</p>
                            @else
                                <a target="_blank" href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['employee']->labour_contract_copy}}">
                                    <button class="btn">
                                        View Documennt
                                    </button>
                                </a>

                                <a download href="{{ asset('main_admin/hr_pro/employee/main/')}}/{{$data['employee']->labour_contract_copy}}">
                                    <button class="btn">
                                        Download Documennt
                                    </button>
                                </a>
                            @endif
                            
                        </div>
                    </div>
                    
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> Company Contract Number :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->company_contract_number }}</p>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> Company Contract EXP :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->company_contract_exp }}</p>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-4">
                            <h5 class="font-weight-bold"> Company Contract Copy:</h5>

                        </div>
                        <div class="col-8">
                            @if( $data['employee']->company_contract_copy == NULL)
                            
                                <p>No File Found</p>
                            @else
                                <a target="_blank" href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['employee']->company_contract_copy}}">
                                    <button class="btn">
                                        View Documennt
                                    </button>
                                </a>

                                <a download href="{{ asset('main_admin/hr_pro/employee/main/')}}/{{$data['employee']->company_contract_copy}}">
                                    <button class="btn">
                                        Download Documennt
                                    </button>
                                </a>
                            @endif
                            
                        </div>
                    </div>
                    
                </div>

                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> Emirates Id :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->emirates_id }}</p>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> Emirates EXP :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->emirates_exp }}</p>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-4">
                            <h5 class="font-weight-bold"> Emirates Copy:</h5>

                        </div>
                        <div class="col-8">
                            @if( $data['employee']->emirates_copy == NULL)
                            
                                <p>No File Found</p>
                            @else
                                <a target="_blank" href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['employee']->emirates_copy}}">
                                    <button class="btn">
                                        View Documennt
                                    </button>
                                </a>

                                <a download href="{{ asset('main_admin/hr_pro/employee/main/')}}/{{$data['employee']->emirates_copy}}">
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

        <div id="step-2" class="tab-pane" role="tabpanel">
            <div class="row">
            <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> Labour Contract Number :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->labour_contract_number }}</p>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold"> Labour Contract EXP :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['employee']->labour_contract_exp }}</p>
                        </div>
                    </div> 
                </div>
                <div class="col-12 col-md-6 mb-3">
                    <div class="row">
                        <div class="col-4">
                            <h5 class="font-weight-bold"> Labour Contract Copy:</h5>

                        </div>
                        <div class="col-8">
                            @if( $data['employee']->labour_contract_copy == NULL)
                            
                                <p>No File Found</p>
                            @else
                                <a target="_blank" href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['employee']->labour_contract_copy}}">
                                    <button class="btn">
                                        View Documennt
                                    </button>
                                </a>

                                <a download href="{{ asset('main_admin/hr_pro/employee/main/')}}/{{$data['employee']->labour_contract_copy}}">
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

        <div id="step-3" class="tab-pane" role="tabpanel">
        </div>

        <div id="step-4" class="tab-pane" role="tabpanel">
        </div>

        <div id="step-5" class="tab-pane" role="tabpanel">
        </div>

        <div id="step-6" class="tab-pane" role="tabpanel">
        </div>

        <div id="step-7" class="tab-pane" role="tabpanel">
        </div>
    </div>
</div>

<script>
         $('#smartwizard').smartWizard({
            theme: 'default',
            toolbarSettings: {
                toolbarPosition: 'bottom', // none, top, bottom, both
                toolbarButtonPosition: 'right', // left, right, center
                showNextButton: false, // show/hide a Next button
                showPreviousButton: false, // show/hide a Previous button
                toolbarExtraButtons: [], // Extra buttons to show on toolbar, array of jQuery input/buttons elements
               
            },
            anchorSettings: {
                    anchorClickable: true, // Enable/Disable anchor navigation
                    enableAllAnchors: true, // Activates all anchors clickable all times
                    markDoneStep: true, // Add done css
                    markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                    removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                    enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                    },
                    enableURLhash: true,
        });

    $('#smartwizard').smartWizard("reset");

</script>