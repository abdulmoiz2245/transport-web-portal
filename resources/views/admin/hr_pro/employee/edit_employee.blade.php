<?php 
use App\Models\Company_name;
use App\Models\Erp_department;

?>
<style>
    .form-group.required .control-label:after {
        content:"*";
        color:red;
    }
        .edit-badge {
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
        /* padding: 5px 10px; */
        white-space: nowrap;
        display: inline-block;
        transition: none;
        text-align: center;
        /* min-height: 28px; */
        min-width: 60px;
        margin-left: 4px;
        margin-bottom: 8px;
        padding-left: 8px;
        padding-right: 8px;
        padding-top: 2px;
        }
    .old-value img{
        width:14px
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
       <!-- <li>
           <a class="nav-link" href="#step-3">
              Salary Card
           </a>
       </li>
       <li>
           <a class="nav-link" href="#step-4">
              Comisson Rates
           </a>
       </li> -->
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
       <li>
            <a class="nav-link" href="#step-8">
              Admin Approvel <span class="badge badge-pill badge-warning"><?php if( $data['employee']->admin_status == 0){ ?> Not Approved <?php }else { ?> Approved <?php } ?></span>
            </a>
       </li>
    </ul>
    <div class="tab-content">
        
       <div id="step-1" class="tab-pane" role="tabpanel">
            <form action="{{ route('admin.hr_pro.update_employee') }}" method="post" enctype="multipart/form-data" id="basic_info_update">

            <div class="row">
                @csrf

                <input type="text" name="id" value="{{ $data['employee']->id }}" class="d-none">
                <div class="col-md-6 col-12">
                    <div class="form-group required name">
                        <div class="d-flex">
                                <label class="control-label">Name</label>
                                @if($data['employee_history'] != null &&  $data['employee']->name != $data['employee_history']->name )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->name}} </div> 
                                @endif
                        </div>
                        <input name="name" class="form-control name" value="{{ $data['employee']->name }}" type="text" required  >
                    </div>
                </div>
                <div class=" col-md-6 col-12 mb-3 ">
                    <div class="form-group">
                        <label >Select Company</label>
                        <?php if(Company_name::all()->count() > 0){ ?>
                            <select name="company_id" class="form-control "required >
                                
                                @foreach(Company_name::all() as $company_name)
                                <option value="{{ $company_name->id }}" <?php if($company_name->id == $data['employee']->company_id) { ?> selected <?php } ?>>{{ $company_name->name }}</option>
                                @endforeach
                            </select>
                        <?php } else{ ?>
                        <h5 class="text-danger">Please Add Company First </h5> 
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group required designation">
                        <div class="d-flex">
                                <label class="control-label">Categorie</label>
                                @if($data['employee_history'] != null &&  $data['employee']->designation != $data['employee_history']->designation )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->designation}} </div> 
                                @endif
                        </div>
                        <select name="designation"  required id="" class="form-control designation">
                            <option value="driver" <?php if( $data['employee']->designation == 'driver') { ?> selected <?php } ?>>Driver</option>
                            <option value="workshop" <?php if( $data['employee']->designation == 'workshop') { ?> selected <?php } ?>>Workshop</option>
                            <option value="office" <?php if( $data['employee']->designation == 'office') { ?> selected <?php } ?> >Office</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group required">
                        <div class="d-flex">
                                <label class="control-label">Actual Designation</label>
                                @if($data['employee_history'] != null &&  $data['employee']->designation_actual != $data['employee_history']->designation_actual )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->designation_actual}} </div> 
                                @endif
                        </div>
                        <input name="designation_actual" class="form-control" value="{{ $data['employee']->designation_actual }}" type="text" required>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group required">
                        <div class="d-flex">
                                <label class="control-label">Actual Salary</label>
                                @if($data['employee_history'] != null &&  $data['employee']->basic_salary_actual != $data['employee_history']->basic_salary_actual )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->basic_salary_actual}} </div> 
                                @endif
                        </div>
                        <input name="basic_salary_actual" value="{{ $data['employee']->basic_salary_actual }}" class="form-control" type="number" required>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group required">
                        <div class="d-flex">
                                <label class="control-label">Designation Per Contract</label>
                                @if($data['employee_history'] != null &&  $data['employee']->designation_per_labour_contract != $data['employee_history']->designation_per_labour_contract )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->designation_per_labour_contract}} </div> 
                                @endif
                        </div>
                        <input name="designation_per_labour_contract" value="{{ $data['employee']->designation_per_labour_contract }}" class="form-control" type="text" required>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group required">
                        <div class="d-flex">
                                <label class="control-label">Salary Per Contract</label>
                                @if($data['employee_history'] != null &&  $data['employee']->basic_salary_per_labour_contract != $data['employee_history']->basic_salary_per_labour_contract )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->basic_salary_per_labour_contract}} </div> 
                                @endif
                        </div>
                        <input name="basic_salary_per_labour_contract" class="form-control" type="number" value="{{ $data['employee']->basic_salary_per_labour_contract }}" required>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group required">
                        <div class="d-flex">
                                <label class="control-label">Mobile Number</label>
                                @if($data['employee_history'] != null &&  $data['employee']->mobile_number != $data['employee_history']->mobile_number )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->mobile_number}} </div> 
                                @endif
                        </div>
                        <input name="mobile_number" class="form-control" type="number" value="{{ $data['employee']->mobile_number }}" required>
                    </div>
                </div>
                <!-- Nationality -->
                <div class="col-md-6 col-12">
                    <div class="form-group required">
                        <div class="d-flex">
                                <label class="control-label">Nationality</label>
                                @if($data['employee_history'] != null &&  $data['employee']->nationality != $data['employee_history']->nationality )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->nationality}} </div> 
                                @endif
                        </div>
                        <input name="nationality" value="{{ $data['employee']->nationality }}" class="form-control" type="text" required>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group required">
                        <div class="d-flex">
                                <label class="control-label">Nationality Id Number</label>
                                @if($data['employee_history'] != null &&  $data['employee']->national_id_number != $data['employee_history']->national_id_number )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->national_id_number}} </div> 
                                @endif
                        </div>
                        <input name="national_id_number"   class="form-control" type="text" required value="{{ $data['employee']->national_id_number }}">
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group required">
                        <div class="d-flex">
                                <label class="control-label">Nationality Id Expiry</label>
                                @if($data['employee_history'] != null &&  $data['employee']->national_id_exp != $data['employee_history']->national_id_exp )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->national_id_exp}} </div> 
                                @endif
                        </div>
                        <input name="national_id_exp" value="{{ $data['employee']->national_id_exp }}" class="form-control" type="date" required>
                    </div>
                </div>

  

                <div class="col-md-6 col-12">
                    @if( $data['employee']->national_id_copy != null)
                        <!-- <div class="col-4">
                            <h5 class=""><b> TRN Copy :</b></h5>
                        </div> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <label>Replace National Id Copy</label>

                                    @if($data['employee_history'] != null &&  $data['employee']->national_id_copy != $data['employee_history']->national_id_copy )
                                        <div class="edit-badge"> Edited </div> 
                                        <div class="old-value"> Old file : 
                                            <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee_history']->national_id_copy}}" >
                                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                            </a>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-11 form-group">  
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload National Id Copy</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="national_id_copy">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 p-0">
                                <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee']->national_id_copy}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                                                            
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label>National Id Copy Upload</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload National Id Copy</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="national_id_copy">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Passport -->
                <div class="col-md-6 col-12">
                    <div class="form-group required">
                        <div class="d-flex">
                                <label class="control-label">Passport  Number</label>
                                @if($data['employee_history'] != null &&  $data['employee']->passport_number != $data['employee_history']->passport_number )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->passport_number}} </div> 
                                @endif
                        </div>
                        <input name="passport_number" value="{{ $data['employee']->passport_number }}" class="form-control" type="text" required>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group required">
                        <div class="d-flex">
                                <label class="control-label">Passport  Expiry</label>
                                @if($data['employee_history'] != null &&  $data['employee']->passport_exp != $data['employee_history']->passport_exp )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->passport_exp}} </div> 
                                @endif
                        </div>
                        <input name="passport_exp" value="{{ $data['employee']->passport_exp }}" class="form-control" type="date" required>
                    </div>
                </div>

               

                <div class="col-md-6 col-12">
                    @if( $data['employee']->passport_copy != null)
                        <!-- <div class="col-4">
                            <h5 class=""><b> TRN Copy :</b></h5>
                        </div> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <label>Replace Passport  Copy</label>

                                    @if($data['employee_history'] != null &&  $data['employee']->passport_copy != $data['employee_history']->passport_copy )
                                        <div class="edit-badge"> Edited </div> 
                                        <div class="old-value"> Old file : 
                                            <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee_history']->passport_copy}}" >
                                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                            </a>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-11 form-group">  
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Passport  Copy</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="passport_copy">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 p-0">
                                <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee']->passport_copy}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                                                            
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label>Passport  Copy Upload</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Passport  Copy Copy</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="passport_copy">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Visa -->
                <div class="col-md-6 col-12">
                    <div class="form-group required visa_number">
                        <div class="d-flex">
                                <label class="control-label">Visa  Number</label>
                                @if($data['employee_history'] != null &&  $data['employee']->visa_number != $data['employee_history']->visa_number )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->visa_number}} </div> 
                                @endif
                        </div>
                        <input name="visa_number" value="{{ $data['employee']->visa_number }}"  class="form-control visa_number"  type="text" required>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group required visa_exp">
                        <div class="d-flex">
                                <label class="control-label">Visa  Expiry</label>
                                @if($data['employee_history'] != null &&  $data['employee']->visa_exp != $data['employee_history']->visa_exp )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->visa_exp}} </div> 
                                @endif
                        </div>
                        <input name="visa_exp" value="{{ $data['employee']->visa_exp }}"  class="form-control visa_exp" type="date" required>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group required visa_uuid">
                        <div class="d-flex">
                                <label class="control-label">Visa  UUID</label>
                                @if($data['employee_history'] != null &&  $data['employee']->visa_uuid != $data['employee_history']->visa_uuid )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->visa_uuid}} </div> 
                                @endif
                        </div>
                        <input name="visa_uuid" value="{{ $data['employee']->visa_uuid }}" class="form-control visa_uuid" type="text" required>
                    </div>
                </div>

                
                <div class="col-md-6 col-12">
                    @if( $data['employee']->visa_copy != null)
                        <!-- <div class="col-4">
                            <h5 class=""><b> TRN Copy :</b></h5>
                        </div> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <label>Replace Visa Copy</label>

                                    @if($data['employee_history'] != null &&  $data['employee']->visa_copy != $data['employee_history']->visa_copy )
                                        <div class="edit-badge"> Edited </div> 
                                        <div class="old-value"> Old file : 
                                            <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee_history']->visa_copy}}" >
                                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                            </a>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-11 form-group">  
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Visa Copy</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="visa_copy">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 p-0">
                                <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee']->visa_copy}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                                                            
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label>Visa Copy Upload</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload Visa Copy</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="national_id_copy">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Work Permit -->
                <div class="col-md-6 col-12">
                    <div class="form-group required work_permit_number">
                        <div class="d-flex">
                                <label class="control-label">Work Permit  Number</label>
                                @if($data['employee_history'] != null &&  $data['employee']->work_permit_number != $data['employee_history']->work_permit_number )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->work_permit_number}} </div> 
                                @endif
                        </div>
                        <input name="work_permit_number" value="{{ $data['employee']->work_permit_number }}"  class="form-control work_permit_number" type="text" required>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group required work_permit_exp">
                        <div class="d-flex">
                                <label class="control-label">Work Permit  Expiry</label>
                                @if($data['employee_history'] != null &&  $data['employee']->work_permit_exp != $data['employee_history']->work_permit_exp )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->work_permit_exp}} </div> 
                                @endif
                        </div>
                        <input name="work_permit_exp" value="{{ $data['employee']->work_permit_exp }}" class="form-control work_permit_exp" type="date" required>
                    </div>
                </div>

               
                <div class="col-md-6 col-12">
                    @if( $data['employee']->work_permit_copy != null)
                        <!-- <div class="col-4">
                            <h5 class=""><b> TRN Copy :</b></h5>
                        </div> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <label>Replace Work Permit Copy</label>

                                    @if($data['employee_history'] != null &&  $data['employee']->work_permit_copy != $data['employee_history']->work_permit_copy )
                                        <div class="edit-badge"> Edited </div> 
                                        <div class="old-value"> Old file : 
                                            <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee_history']->work_permit_copy}}" >
                                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                            </a>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-11 form-group">  
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Work Permit Copy</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="work_permit_copy">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 p-0">
                                <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee']->work_permit_copy}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                                                            
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label>Work Permit Copy Upload</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload Work Permit Copy</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="work_permit_copy">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Noc -->
                <div class="col-md-6 col-12">
                    <div class="form-group required noc_number">
                        <div class="d-flex">
                                <label class="control-label">NOC  Number</label>
                                @if($data['employee_history'] != null &&  $data['employee']->noc_number != $data['employee_history']->noc_number )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->noc_number}} </div> 
                                @endif
                        </div>
                        <input name="noc_number" value="{{ $data['employee']->noc_number }}" class="form-control noc_number" type="text" required>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group required noc_exp">
                        <div class="d-flex">
                                <label class="control-label">NOC  Expiry</label>
                                @if($data['employee_history'] != null &&  $data['employee']->noc_exp != $data['employee_history']->noc_exp )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->noc_exp}} </div> 
                                @endif
                        </div>
                        <input name="noc_exp" value="{{ $data['employee']->noc_exp }}"  class="form-control noc_exp" type="date" required>
                    </div>
                </div>

                
                <div class="col-md-6 col-12">
                    @if( $data['employee']->noc_copy != null)
                        <!-- <div class="col-4">
                            <h5 class=""><b> TRN Copy :</b></h5>
                        </div> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <label>Replace NOC  Copy</label>

                                    @if($data['employee_history'] != null &&  $data['employee']->noc_copy != $data['employee_history']->noc_copy )
                                        <div class="edit-badge"> Edited </div> 
                                        <div class="old-value"> Old file : 
                                            <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee_history']->noc_copy}}" >
                                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                            </a>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-11 form-group">  
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload NOC Copy</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="noc_copy">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 p-0">
                                <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee']->noc_copy}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                                                            
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label>NOC Copy Upload</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload NOC Copy</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="noc_copy">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Labour Contract -->
                <div class="col-md-6 col-12">
                    <div class="form-group required labour_contract_number">
                        <div class="d-flex">
                                <label class="control-label">Labour Contract  Number</label>
                                @if($data['employee_history'] != null &&  $data['employee']->labour_contract_number != $data['employee_history']->labour_contract_number )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->labour_contract_number}} </div> 
                                @endif
                        </div>
                        <input name="labour_contract_number" class="form-control labour_contract_number" value="{{ $data['employee']->labour_contract_number }}" type="text" required>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group required labour_contract_exp">
                        <div class="d-flex">
                                <label class="control-label">Labour Contract  Expiry</label>
                                @if($data['employee_history'] != null &&  $data['employee']->labour_contract_exp != $data['employee_history']->labour_contract_exp )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->labour_contract_exp}} </div> 
                                @endif
                        </div>
                        <input name="labour_contract_exp"  value="{{ $data['employee']->labour_contract_exp }}" class="form-control labour_contract_exp" type="date" required>
                    </div>
                </div>


                <div class="col-md-6 col-12">
                    @if( $data['employee']->labour_contract_copy != null)
                        <!-- <div class="col-4">
                            <h5 class=""><b> TRN Copy :</b></h5>
                        </div> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <label>Replace Labour Contract  Copy</label>

                                    @if($data['employee_history'] != null &&  $data['employee']->labour_contract_copy != $data['employee_history']->labour_contract_copy )
                                        <div class="edit-badge"> Edited </div> 
                                        <div class="old-value"> Old file : 
                                            <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee_history']->labour_contract_copy}}" >
                                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                            </a>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-11 form-group">  
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Labour Contract  Copy</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="labour_contract_copy">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 p-0">
                                <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee']->labour_contract_copy}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                                                            
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label>Labour Contract  Copy Upload</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload Labour Contract  Copy</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="labour_contract_copy">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Company Contract-->
                <div class="col-md-6 col-12">
                    <div class="form-group required ">
                        <div class="d-flex">
                                <label class="control-label">Company Contract  Number</label>
                                @if($data['employee_history'] != null &&  $data['employee']->company_contract_number != $data['employee_history']->company_contract_number )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->company_contract_number}} </div> 
                                @endif
                        </div>
                        <input name="company_contract_number"  value="{{ $data['employee']->company_contract_number }}" class="form-control " type="text" required>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group required">
                        <div class="d-flex">
                                <label class="control-label">Company Contract  Expiry</label>
                                @if($data['employee_history'] != null &&  $data['employee']->company_contract_exp != $data['employee_history']->company_contract_exp )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->company_contract_exp}} </div> 
                                @endif
                        </div>
                        <input name="company_contract_exp" value="{{ $data['employee']->company_contract_exp }}" class="form-control" type="date" required>
                    </div>
                </div>

                
                <div class="col-md-6 col-12">
                    @if( $data['employee']->company_contract_copy != null)
                        <!-- <div class="col-4">
                            <h5 class=""><b> TRN Copy :</b></h5>
                        </div> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <label>Replace Company Contract Copy</label>

                                    @if($data['employee_history'] != null &&  $data['employee']->company_contract_copy != $data['employee_history']->company_contract_copy )
                                        <div class="edit-badge"> Edited </div> 
                                        <div class="old-value"> Old file : 
                                            <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee_history']->company_contract_copy}}" >
                                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                            </a>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-11 form-group">  
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Company Contract Copy</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="company_contract_copy">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 p-0">
                                <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee']->company_contract_copy}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                                                            
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label>Company Contract Copy Upload</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload Company Contract Copy</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="company_contract_copy">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Emirates Id-->
                <div class="col-md-6 col-12">
                    <div class="form-group required emirates_id">
                        <div class="d-flex">
                                <label class="control-label">Emirates ID</label>
                                @if($data['employee_history'] != null &&  $data['employee']->emirates_id != $data['employee_history']->emirates_id )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->emirates_id}} </div> 
                                @endif
                        </div>
                        <input name="emirates_id" value="{{ $data['employee']->emirates_id }}" class="form-control emirates_id" type="text" required>
                    </div>
                </div>

                <div class="col-md-6 col-12">
                    <div class="form-group required emirates_exp">
                        <div class="d-flex">
                                <label class="control-label">Emirates  Expiry</label>
                                @if($data['employee_history'] != null &&  $data['employee']->emirates_exp != $data['employee_history']->emirates_exp )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->emirates_exp}} </div> 
                                @endif
                        </div>
                        <input name="emirates_exp"  value="{{ $data['employee']->emirates_exp }}"  class="form-control emirates_exp" type="date" required>
                    </div>
                </div>

                
                <div class="col-md-6 col-12">
                    @if( $data['employee']->emirates_copy != null)
                        <!-- <div class="col-4">
                            <h5 class=""><b> TRN Copy :</b></h5>
                        </div> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <label>Replace Emirates Copy</label>

                                    @if($data['employee_history'] != null &&  $data['employee']->emirates_copy != $data['employee_history']->emirates_copy )
                                        <div class="edit-badge"> Edited </div> 
                                        <div class="old-value"> Old file : 
                                            <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee_history']->emirates_copy}}" >
                                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                            </a>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-11 form-group">  
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Emirates Copy</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="emirates_copy">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 p-0">
                                <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee']->emirates_copy}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                                                            
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label>Emirates Copy Upload</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload Emirates Copy</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="emirates_copy">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                
                <div class="">
                    <input type="submit" class="btn btn-primary" id="basic_info_update"  value="Update">
                </div>
            </div>
            </form>
       </div>

       <div id="step-2" class="tab-pane" role="tabpanel">
         <form action="{{ route('admin.hr_pro.update_employee') }}" method="post" enctype="multipart/form-data" id="detail_info_update">

         <div class="row">
                @csrf

                <input type="text" name="id" value="{{ $data['employee']->id }}" class="d-none">
             <!-- Jabel Ali  pass-->
            <div class="col-md-6 col-12">
                <div class="form-group required emirates_id">
                    <div class="d-flex">
                            <label class="control-label">JABEL ALI PASS No </label>
                            @if($data['employee_history'] != null &&  $data['employee']->jabel_ali_pass != $data['employee_history']->jabel_ali_pass )
                                <div class="edit-badge"> Edited </div> 
                                <div class="old-value"> Old Value : {{ $data['employee_history']->	jabel_ali_pass}} </div> 
                            @endif
                    </div>
                    <input name="jabel_ali_pass" value="{{ $data['employee']->jabel_ali_pass }}" class="form-control jabel_ali_pass" type="text">
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="form-group required emirates_exp">
                    <div class="d-flex">
                            <label class="control-label">JABEL ALI PASS Expiry</label>
                            @if($data['employee_history'] != null &&  $data['employee']->jabel_ali_pass_exp != $data['employee_history']->jabel_ali_pass_exp )
                                <div class="edit-badge"> Edited </div> 
                                <div class="old-value"> Old Value : {{ $data['employee_history']->jabel_ali_pass_exp}} </div> 
                            @endif
                    </div>
                    <input name="jabel_ali_pass_exp"  value="{{ $data['employee']->jabel_ali_pass_exp }}"  class="form-control emirates_exp" type="date" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                @if( $data['employee']->jabel_ali_pass_copy != null)
                    <!-- <div class="col-4">
                        <h5 class=""><b> TRN Copy :</b></h5>
                    </div> -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex">
                                <label>Replace JABEL ALI PASS Copy</label>

                                @if($data['employee_history'] != null &&  $data['employee']->jabel_ali_pass_copy != $data['employee_history']->jabel_ali_pass_copy )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old file : 
                                        <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee_history']->jabel_ali_pass_copy}}" >
                                            <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                        </a>
                                    </div> 
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-11 form-group">  
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload JABEL ALI PASS Copy</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="jabel_ali_pass_copy">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 p-0">
                            <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee']->jabel_ali_pass_copy}}" >
                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                            </a>
                                                        
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label>JABEL ALI PASS Copy Upload</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Upload JABEL ALI PASS Copy</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"   name="jabel_ali_pass_copy">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Emal   pass-->
            <div class="col-md-6 col-12">
                <div class="form-group required emirates_id">
                    <div class="d-flex">
                            <label class="control-label">Emal PASS No </label>
                            @if($data['employee_history'] != null &&  $data['employee']->emal_pass != $data['employee_history']->emal_pass )
                                <div class="edit-badge"> Edited </div> 
                                <div class="old-value"> Old Value : {{ $data['employee_history']->	emal_pass}} </div> 
                            @endif
                    </div>
                    <input name="emal_pass" value="{{ $data['employee']->emal_pass }}" class="form-control emal_pass" type="text">
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="form-group required emirates_exp">
                    <div class="d-flex">
                            <label class="control-label">Emal PASS Expiry</label>
                            @if($data['employee_history'] != null &&  $data['employee']->emal_pass_exp != $data['employee_history']->emal_pass_exp )
                                <div class="edit-badge"> Edited </div> 
                                <div class="old-value"> Old Value : {{ $data['employee_history']->emal_pass_exp}} </div> 
                            @endif
                    </div>
                    <input name="emal_pass_exp"  value="{{ $data['employee']->emal_pass_exp }}"  class="form-control emirates_exp" type="date" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                @if( $data['employee']->emal_pass_copy != null)
                    <!-- <div class="col-4">
                        <h5 class=""><b> TRN Copy :</b></h5>
                    </div> -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex">
                                <label>Replace EMAL PASS Copy</label>

                                @if($data['employee_history'] != null &&  $data['employee']->emal_pass_copy != $data['employee_history']->emal_pass_copy )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old file : 
                                        <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee_history']->emal_pass_copy}}" >
                                            <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                        </a>
                                    </div> 
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-11 form-group">  
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload EMAL PASS Copy</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="emal_pass_copy">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 p-0">
                            <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee']->emal_pass_copy}}" >
                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                            </a>
                                                        
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label>EMAL PASS Copy Upload</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Upload EMAL PASS Copy</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"   name="emal_pass_copy">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Kp mina   pass-->
            <div class="col-md-6 col-12">
                <div class="form-group required emirates_id">
                    <div class="d-flex">
                            <label class="control-label">KP MINA PASS No </label>
                            @if($data['employee_history'] != null &&  $data['employee']->kp_mina != $data['employee_history']->kp_mina )
                                <div class="edit-badge"> Edited </div> 
                                <div class="old-value"> Old Value : {{ $data['employee_history']->	kp_mina}} </div> 
                            @endif
                    </div>
                    <input name="kp_mina" value="{{ $data['employee']->kp_mina }}" class="form-control kp_mina" type="text">
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="form-group required emirates_exp">
                    <div class="d-flex">
                            <label class="control-label">KP MINA  PASS Expiry</label>
                            @if($data['employee_history'] != null &&  $data['employee']->kp_mina_exp != $data['employee_history']->kp_mina_exp )
                                <div class="edit-badge"> Edited </div> 
                                <div class="old-value"> Old Value : {{ $data['employee_history']->kp_mina_exp}} </div> 
                            @endif
                    </div>
                    <input name="kp_mina_exp"  value="{{ $data['employee']->kp_mina_exp }}"  class="form-control kp_mina_exp" type="date" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                @if( $data['employee']->kp_mina_copy != null)
                    <!-- <div class="col-4">
                        <h5 class=""><b> TRN Copy :</b></h5>
                    </div> -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex">
                                <label>Replace KP MINA PASS Copy</label>

                                @if($data['employee_history'] != null &&  $data['employee']->kp_mina_copy != $data['employee_history']->kp_mina_copy )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old file : 
                                        <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee_history']->kp_mina_copy}}" >
                                            <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                        </a>
                                    </div> 
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-11 form-group">  
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload KP MINA PASS Copy</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="kp_mina_copy">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 p-0">
                            <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee']->kp_mina_copy}}" >
                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                            </a>
                                                        
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label>KP MINA PASS Copy Upload</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Upload KP MINA PASS Copy</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"   name="kp_mina_copy">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Driving License-->
            <div class="col-md-6 col-12">
                <div class="form-group required emirates_id">
                    <div class="d-flex">
                            <label class="control-label">Driving license Number</label>
                            @if($data['employee_history'] != null &&  $data['employee']->driving_license != $data['employee_history']->driving_license )
                                <div class="edit-badge"> Edited </div> 
                                <div class="old-value"> Old Value : {{ $data['employee_history']->	driving_license}} </div> 
                            @endif
                    </div>
                    <input name="driving_license" value="{{ $data['employee']->driving_license }}" class="form-control driving_license" type="text">
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="form-group required emirates_exp">
                    <div class="d-flex">
                            <label class="control-label">Driving License Expiry</label>
                            @if($data['employee_history'] != null &&  $data['employee']->driving_license_exp != $data['employee_history']->driving_license_exp )
                                <div class="edit-badge"> Edited </div> 
                                <div class="old-value"> Old Value : {{ $data['employee_history']->driving_license_exp}} </div> 
                            @endif
                    </div>
                    <input name="driving_license_exp"  value="{{ $data['employee']->driving_license_exp }}"  class="form-control driving_license_exp" type="date" required>
                </div>
            </div>
            <div class="col-md-6 col-12">
                @if( $data['employee']->driving_license_copy != null)
                    <!-- <div class="col-4">
                        <h5 class=""><b> TRN Copy :</b></h5>
                    </div> -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex">
                                <label>Replace Driving License Copy</label>

                                @if($data['employee_history'] != null &&  $data['employee']->driving_license_copy != $data['employee_history']->driving_license_copy )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old file : 
                                        <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee_history']->driving_license_copy}}" >
                                            <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                        </a>
                                    </div> 
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-11 form-group">  
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload Driving License Copy</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="driving_license_copy">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 p-0">
                            <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee']->driving_license_copy}}" >
                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                            </a>
                                                        
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label>Driving License Upload</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Upload Driving License</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"   name="driving_license_copy">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- Health Insurance -->
            <div class="col-md-6 col-12">
                <div class="form-group required health_insurance_policy_number">
                        <div class="d-flex">
                                <label class="control-label">Health Insurance Policy Number</label>
                                @if($data['employee_history'] != null &&  $data['employee']->health_insurance_policy_number != $data['employee_history']->health_insurance_policy_number )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->health_insurance_policy_number}} </div> 
                                @endif
                        </div>
                        <input name="health_insurance_policy_number" class="form-control health_insurance_policy_number" value="{{ $data['employee']->health_insurance_policy_number }}" type="text" required>
                </div>
            </div>

            <div class="col-md-6 col-12">
                <div class="form-group required health_insurance_policy_exp" >
                        <label class="control-label">Health Insurance Policy  Expiry</label>
                        <div class="d-flex">
                                @if($data['employee_history'] != null &&  $data['employee']->health_insurance_policy_exp != $data['employee_history']->health_insurance_policy_exp )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['employee_history']->health_insurance_policy_exp}} </div> 
                                @endif
                        </div>
                        <input name="health_insurance_policy_exp" class="form-control health_insurance_policy_exp" type="date" value="{{ $data['employee']->health_insurance_policy_exp }}" required>
                </div>
            </div>

                
            <div class="col-md-6 col-12">
                    @if( $data['employee']->health_insurance_policy_copy != null)
                        <!-- <div class="col-4">
                            <h5 class=""><b> TRN Copy :</b></h5>
                        </div> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <label>Replace Health Insurance Policy  Copy</label>

                                    @if($data['employee_history'] != null &&  $data['employee']->health_insurance_policy_copy != $data['employee_history']->health_insurance_policy_copy )
                                        <div class="edit-badge"> Edited </div> 
                                        <div class="old-value"> Old file : 
                                            <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee_history']->health_insurance_policy_copy}}" >
                                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                            </a>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-11 form-group">  
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload  Copy</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="health_insurance_policy_copy">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 p-0">
                                <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee']->health_insurance_policy_copy}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                                                            
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label>Health Insurance Policy  Upload</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload  Copy</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="health_insurance_policy_copy">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    @endif
            </div>
            <div class="col-12">
                    <input type="submit" class="btn btn-primary" value="Update">

            </div>
         </div>
         </form>

       </div>
       @if($data['employee']->designation == 'driver')
       <div id="step-3" class="tab-pane container" role="tabpanel">
            <div class="d-flex mb-3" style="justify-content: space-between;">

                <div class="">
                    <!-- <a href="{{ route( 'admin.dashboard') }}" class="text-right">
                            <img src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
                    </a> -->
                    <a href="{{ route( 'admin.hr_pro.add_salary_card') }}" class="ml-3">
                    </a>
                    <form action="{{ route( 'admin.hr_pro.add_salary_card') }}" method="post" class="d-inline">
                        @csrf
                        <input type="text" class="form-control d-none" name="id" value ="{{$data['employee']->id}}" placeholder="Enter id" >
                        <button type="submit" class="border-0 bg-white">
                        <img src="<?= asset('assets') ?>/images/add-button.png" alt="" width="30">
                        </button>
                    </form>
                </div>

                <div class=""> 
                    

                    <a href="{{ route( 'admin.customer.customer_history') }}"target="_blank" class="ml-3">
                        <img src="<?= asset('assets') ?>/images/history_icon.png" alt="" width="30">
                    </a>

                    <a href="{{ route( 'admin.customer.trash_customer') }}" class="ml-3" target="_blank">
                        <img src="<?= asset('assets') ?>/images/trash.png" alt="" width="30">
                    </a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="display table nowrap  " style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Month</th>
                            <th>Flat Trip</th>
                            <th>Addded By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <tr>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                        </tr>
                        
                    </tbody>         
                </table>
            </div>
       </div>

       <div id="step-4" class="tab-pane" role="tabpanel">

       </div>
       @endif

       <div id="step-5" class="tab-pane" role="tabpanel">
            <form action="" id="incentives_update" method="post" enctype="multipart/form-data">

            <div class="row">
                @csrf

                <input type="text" name="id" value="{{ $data['employee']->id }}" class="d-none">
                <div class="col-md-6 col-12">
                    <div class="form-group  name">
                        <div class="d-flex">
                                <label class="control-label">Incentives</label>
                                @if($data['employee_history'] != null &&  $data['employee']->name != $data['employee_history']->name )
                                    <div class="edit-badge"> Edited </div> 
                     
                                @endif
                        </div>
                        <textarea name="incentives" class="form-control " cols="30" rows="10">{{ $data['employee']->incentives }}</textarea>
                        
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    @if( $data['employee']->incentives_upload != null)
                        <!-- <div class="col-4">
                            <h5 class=""><b> TRN Copy :</b></h5>
                        </div> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <label>Replace Incentives</label>

                                    @if($data['employee_history'] != null &&  $data['employee']->incentives_upload != $data['employee_history']->incentives_upload )
                                        <div class="edit-badge"> Edited </div> 
                                        <div class="old-value"> Old file : 
                                            <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee_history']->incentives_upload}}" >
                                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                            </a>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-11 form-group">  
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Incentives</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="incentives_upload">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 p-0">
                                <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee']->incentives_upload}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                                                            
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label>Incentives Upload</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload Incentives</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="incentives_upload">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-12">
                    <input type="submit" class="btn btn-primary"   value="Update">

                </div>
            </div>
            </form>             
       </div>

       <div id="step-6" class="tab-pane" role="tabpanel">
            <form action="" id="deposit_update"   method="post" enctype="multipart/form-data">

            <div class="row">
                @csrf

                <input type="text" name="id" value="{{ $data['employee']->id }}" class="d-none">
                <div class="col-md-6 col-12">
                    <div class="form-group required name">
                        <div class="d-flex">
                                <label class="control-label">Deposit Amount</label>
                                @if($data['employee_history'] != null &&  $data['employee']->name != $data['employee_history']->name )
                                    <div class="edit-badge"> Edited </div> 
                     
                                @endif
                        </div>
                        
                        <input name="deposit_amount" class="form-control name" value="{{ $data['employee']->deposit_amount }}" type="number"   >
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-group required name">
                        <div class="d-flex">
                                <label class="control-label">Deposit Way</label>
                                @if($data['employee_history'] != null &&  $data['employee']->name != $data['employee_history']->name )
                                    <div class="edit-badge"> Edited </div> 
                     
                                @endif
                        </div>
                        <select name="deposit_way"   id="" class="form-control deposit_way">
                            <option value="cash" <?php if( $data['employee']->deposit_way == 'cash') { ?> selected <?php } ?>>Cash</option>
                            <option value="check" <?php if( $data['employee']->deposit_way == 'check') { ?> selected <?php } ?>>Check</option>
                        </select>
                       
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    @if( $data['employee']->deposit_upload != null)
                        <!-- <div class="col-4">
                            <h5 class=""><b> TRN Copy :</b></h5>
                        </div> -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex">
                                    <label>Replace Deposit Copy</label>

                                    @if($data['employee_history'] != null &&  $data['employee']->deposit_upload != $data['employee_history']->deposit_upload )
                                        <div class="edit-badge"> Edited </div> 
                                        <div class="old-value"> Old file : 
                                            <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee_history']->deposit_upload}}">
                                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                            </a>
                                        </div> 
                                    @endif
                                </div>
                            </div>
                            
                            <div class="col-11 form-group">  
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Deposit</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="deposit_upload">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1 p-0">
                                <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee']->deposit_upload}}" >
                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                </a>
                                                            
                            </div>
                        </div>
                    @else
                        <div class="form-group">
                            <label>Deposit Upload</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload Deposit</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="deposit_upload">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-12">
                    <input type="submit" class="btn btn-primary" value="Update">

                </div>
            </div>
            </form>
       </div>

        <div id="step-7" class="tab-pane" role="tabpanel">
            <form action="" id="submission_update"   method="post" enctype="multipart/form-data">
                <input type="text" name="id" value="{{ $data['employee']->id }}" class="d-none">
                @csrf

                <div class="row">
                    <div class="col-md-6 col-12">
                        @if( $data['employee']->passport_handover != null)
                            <!-- <div class="col-4">
                                <h5 class=""><b> TRN Copy :</b></h5>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Replace Passport Handover</label>

                                        @if($data['employee_history'] != null &&  $data['employee']->passport_handover != $data['employee_history']->passport_handover )
                                            <div class="edit-badge"> Edited </div> 
                                            <div class="old-value"> Old file : 
                                                <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee_history']->passport_handover}}">
                                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                </a>
                                            </div> 
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-11 form-group">  
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload Passport Handover</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="passport_handover">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee']->passport_handover}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                                                
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Passport Handover Upload</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Passport Handover</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="passport_handover">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6 col-12">
                        @if( $data['employee']->submission_template != null)
                            <!-- <div class="col-4">
                                <h5 class=""><b> TRN Copy :</b></h5>
                            </div> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Replace Sumission Template</label>

                                        @if($data['employee_history'] != null &&  $data['employee']->submission_template != $data['employee_history']->submission_template )
                                            <div class="edit-badge"> Edited </div> 
                                            <div class="old-value"> Old file : 
                                                <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee_history']->submission_template}}">
                                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                </a>
                                            </div> 
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="col-11 form-group">  
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload Submission Template</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="submission_template">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/employee/main')}}/{{$data['employee']->submission_template}}" >
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                                                
                                </div>
                            </div>
                        @else
                            <div class="form-group">
                                <label>Submission Template Upload</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Submission Template </span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="submission_template">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <input type="submit" class="btn btn-primary" value="Update">
                </div>
            </form>
        </div>
        <div id="step-8" class="tab-pane" role="tabpanel">
            <form action="" id="admin_approvel"   method="post" enctype="multipart/form-data">
                <input type="text" name="id" value="{{ $data['employee']->id }}" class="d-none">

                <div class="row">
                    @csrf
                   
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="admin_status" class="form-control">
                                <option value='1' <?php if($data['employee']->admin_status == '1') echo 'selected="selected"' ?> >Approved</option>
                                <option value='0' <?php if($data['employee']->admin_status == '0') echo 'selected="selected"' ?>>Not Approved</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" class="btn btn-primary" value="Update">

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var value= "{{ $data['employee']->type }}" ;
    $('#basic_info_update').on('submit', function (e) {

        e.preventDefault();
        var formData = new FormData($('#basic_info_update')[0]);
        formData.append('employee_id', '{{ $data["employee"]->id }}');
        formData.append('section', 'Basic');
        $.ajax({
            type: 'post',
            url: "{{ route('admin.hr_pro.update_employee') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status == 1) {
                    id = data.id;
                    toastr.success("Employee Updated Successfully");
                    // $('#smartwizard').smartWizard("next");
                    // window.location.replace("{{ route('admin.customer.customer') }}");
                }
            },
            error: function (){    
                alert('Technical Error (contact to web master)');
            }
        });

    });

    $('#detail_info_update').on('submit', function (e) {

        e.preventDefault();
        var formData = new FormData($('#detail_info_update')[0]);
        formData.append('employee_id', '{{ $data["employee"]->id }}');
        formData.append('section', 'Detail');
        $.ajax({
            type: 'post',
            url: "{{ route('admin.hr_pro.update_employee') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status == 1) {
                    id = data.id;
                    toastr.success("Employee Updated Successfully");
                    // $('#smartwizard').smartWizard("next");
                    // window.location.replace("{{ route('admin.customer.customer') }}");
                }
            },
            error: function (){    
                alert('Technical Error (contact to web master)');
            }
        });
    });
    
    $('#incentives_update').on('submit', function (e) {

        e.preventDefault();
        var formData = new FormData($('#incentives_update')[0]);
        formData.append('employee_id', '{{ $data["employee"]->id }}');
        formData.append('section', 'Detail');
        $.ajax({
            type: 'post',
            url: "{{ route('admin.hr_pro.update_employee') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status == 1) {
                    id = data.id;
                    toastr.success("Employee Updated Successfully");
                    // $('#smartwizard').smartWizard("next");
                    // window.location.replace("{{ route('admin.customer.customer') }}");
                }
            },
            error: function (){    
                alert('Technical Error (contact to web master)');
            }
        });
    });

    $('#deposit_update').on('submit', function (e) {

        e.preventDefault();
        var formData = new FormData($('#deposit_update')[0]);
        formData.append('employee_id', '{{ $data["employee"]->id }}');
        formData.append('section', 'Detail');
        $.ajax({
            type: 'post',
            url: "{{ route('admin.hr_pro.update_employee') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status == 1) {
                    id = data.id;
                    toastr.success("Employee Updated Successfully");
                    // $('#smartwizard').smartWizard("next");
                    // window.location.replace("{{ route('admin.customer.customer') }}");
                }
            },
            error: function (){    
                alert('Technical Error (contact to web master)');
            }
        });
    });
    $('#submission_update').on('submit', function (e) {

        e.preventDefault();
        var formData = new FormData($('#submission_update')[0]);
        formData.append('employee_id', '{{ $data["employee"]->id }}');
        formData.append('section', 'Detail');
        $.ajax({
            type: 'post',
            url: "{{ route('admin.hr_pro.update_employee') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status == 1) {
                    id = data.id;
                    toastr.success("Employee Updated Successfully");
                    // $('#smartwizard').smartWizard("next");
                    // window.location.replace("{{ route('admin.customer.customer') }}");
                }
            },
            error: function (){    
                alert('Technical Error (contact to web master)');
            }
        });
    });
    $('#admin_approvel').on('submit', function (e) {

        e.preventDefault();
        var formData = new FormData($('#admin_approvel')[0]);
        formData.append('employee_id', '{{ $data["employee"]->id }}');
        formData.append('section', 'Detail');
        $.ajax({
            type: 'post',
            url: "{{ route('admin.hr_pro.update_employee_status') }}",
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                if (data.status == 1) {
                    id = data.id;
                    toastr.success("Employee Updated Successfully");
                    // $('#smartwizard').smartWizard("next");
                    window.location.replace("{{ route('admin.hr_pro.pending_employee') }}");
                }
            },
            error: function (){    
                alert('Technical Error (contact to web master)');
            }
        });
    });

    if( value == 'temporary'){
            // $('.health_insurance_policy_number').removeClass('required');
            // $('.health_insurance_policy_number').removeAttr('required');

            // $('.health_insurance_policy_copy').removeClass('required');
            // $('.health_insurance_policy_copy').removeAttr('required');

            // $('.health_insurance_policy_exp').removeClass('required');
            // $('.health_insurance_policy_exp').removeAttr('required');

            //work permit
            $('.work_permit_number').removeClass('required');
            $('.work_permit_number').removeAttr("required");

            $('.work_permit_copy').removeClass('required');
            $('.work_permit_copy').removeAttr("required");

            $('.work_permit_exp').removeClass('required');
            $('.work_permit_exp').removeAttr("required");

            //Labour contract
            $('.labour_contract_number').removeClass('required');
            $('.labour_contract_number').removeAttr("required",);
            $('.labour_contract_copy').removeClass('required');
            $('.labour_contract_copy').removeAttr("required");
            $('.labour_contract_exp').removeClass('required');
            $('.labour_contract_exp').removeAttr("required");

            //noc

            $('.noc_number').addClass('required');
            $('.noc_number').attr("required", true);
            $('.noc_copy').addClass('required');
            $('.noc_copy').attr("required", true);
            $('.noc_exp').addClass('required');
            $('.noc_exp').attr("required", true);

            //visa

            $('.visa_number').addClass('required');
            $('.visa_number').attr("required", true);
            $('.visa_copy').addClass('required');
            $('.visa_copy').attr("required", true);
             $('.visa_uuid').addClass('required');
            $('.visa_uuid').attr("required", true);
            $('.visa_exp').addClass('required');
            $('.visa_exp').attr("required", true);

            //emirates

            $('.emirates_id').addClass('required');
            $('.emirates_id').attr("required", true);
            $('.emirates_copy').addClass('required');
            $('.emirates_copy').attr("required", true);
            $('.emirates_exp').addClass('required');
            $('.emirates_exp').attr("required", true);

            //

        }else{
            // $('.health_insurance_policy_number').addClass('required');
            // $('.health_insurance_policy_number').attr("required", true);

            // $('.health_insurance_policy_copy').addClass('required');
            // $('.health_insurance_policy_copy').attr("required", true);

            // $('.health_insurance_policy_exp').addClass('required');
            // $('.health_insurance_policy_exp').attr("required", true);


            //work permit
            $('.work_permit_number').addClass('required');
            $('.work_permit_number').attr("required", true);

            $('.work_permit_copy').addClass('required');
            $('.work_permit_copy').attr("required", true);

            $('.work_permit_exp').addClass('required');
            $('.work_permit_exp').attr("required", true);

           

            //Labour contract
            $('.labour_contract_number').addClass('required');
            $('.labour_contract_number').attr("required");
            $('.labour_contract_copy').addClass('required');
            $('.labour_contract_copy').attr("required");
            $('.labour_contract_exp').addClass('required');
            $('.labour_contract_exp').attr("required");

             //noc

            $('.noc_number').removeClass('required');
            $('.noc_number').removeAttr("required");
            $('.noc_copy').removeClass('required');
            $('.noc_copy').removeAttr("required");
            $('.noc_exp').removeClass('required');
            $('.noc_exp').removeAttr("required");

            //visa

            $('.visa_number').removeClass('required');
            $('.visa_number').removeAttr("required");
            $('.visa_copy').removeClass('required');
            $('.visa_copy').removeAttr("required");
            $('.visa_uuid').removeClass('required');
            $('.visa_uuid').removeAttr("required");
            $('.visa_exp').removeClass('required');
            $('.visa_exp').removeAttr("required");

            //emirates

            $('.emirates_id').removeClass('required');
            $('.emirates_id').removeAttr("required");
            $('.emirates_copy').removeClass('required');
            $('.emirates_copy').removeAttr("required");
            $('.emirates_exp').removeClass('required');
            $('.emirates_exp').removeAttr("required");
        }
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