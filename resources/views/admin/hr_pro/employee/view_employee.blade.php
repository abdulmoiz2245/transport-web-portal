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
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="font-weight-bold">Contract Number :</h5>

                        </div>
                        <div class="col-6">
                            <p>{{ $data['land_contract']->contract_number }}</p>
                        </div>
                    </div> 
                </div>
            </div>
        </div>

        <div id="step-2" class="tab-pane" role="tabpanel">
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