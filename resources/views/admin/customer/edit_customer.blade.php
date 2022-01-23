<?php 
use App\Models\Company_name;
use App\Models\Erp_department;

?>
<style>
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
    <div class="mb-4 ">
        <a href="{{ route( 'admin.customer.customer') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
</div>
<div id="smartwizard">
    <ul class="nav">
       <li>
           <a class="nav-link" href="#step-1">
              Customer Info
           </a>
       </li>
       <li>
           <a class="nav-link" href="#step-2">
              Customer Department
           </a>
       </li>
       
    </ul>
 
    <div class="tab-content">
        
       <div id="step-1" class="tab-pane" role="tabpanel">
            <div class="container">
                
                <form action="" method="post" id="customer_info"  enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="id" value="{{ $data['customer_info']->id }}" class="d-none">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>Admin Notes</label>
                                <textarea name="status_message" class="form-control form-control-rounded"  placeholder="Enter Admin Notes">{{ $data['customer_info']->status_message }}</textarea>
                                
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value='pending' <?php if($data['customer_info']->status == 'pending') echo 'selected="selected"' ?> >Pending</option>
                                    <option value='approved' <?php if($data['customer_info']->status == 'approved') echo 'selected="selected"' ?> >Approved</option>
                                    <option value='rejected' <?php if($data['customer_info']->status == 'rejected') echo 'selected="selected"' ?>>Rejected</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class=" col-md-6 col-12 mb-3 ">
                            <div class="form-group">
                                <label >Select Company</label>
                                <?php if(Company_name::all()->count() > 0){ ?>
                                    <select name="company_id" class="form-control "required >
                                        
                                        @foreach($data['company_names'] as $company_name)
                                        <option value="{{ $company_name->id }}">{{ $company_name->name }}</option>
                                        @endforeach
                                    </select>
                                <?php } else{ ?>
                                <h5 class="text-danger">Please Add Company First </h5> 
                                <?php } ?>
                            </div>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            
                            <div class="d-flex">
                                <label >Customer Name</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->name != $data['customer_info_history']->name )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->name}} </div> 
                                @endif

                            </div>
                            <input type="text" name="name" value="{{ $data['customer_info']->name}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            
                            <div class="d-flex">
                                <label >Customer Address</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->address != $data['customer_info_history']->address )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->address}} </div> 
                                @endif

                            </div>
                            <input type="text" name="address" value="{{ $data['customer_info']->address}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                           
                            <div class="d-flex">
                                <label >Customer City</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->city != $data['customer_info_history']->city )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->city}} </div> 
                                @endif

                            </div>
                            <input type="text" name="city" value="{{ $data['customer_info']->city}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                           
                            <div class="d-flex">
                                <label >Customer Country</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->country != $data['customer_info_history']->country )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->country}} </div> 
                                @endif

                            </div>
                            <input type="text" name="country" value="{{ $data['customer_info']->country}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            
                            <div class="d-flex">
                                <label >Customer Telephone</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->tel_number != $data['customer_info_history']->tel_number )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->tel_number}} </div> 
                                @endif

                            </div>
                            <input type="text" name="tel_number" value="{{ $data['customer_info']->tel_number}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <div class="d-flex">
                                <label >Customer Fax</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->fax != $data['customer_info_history']->fax )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->fax}} </div> 
                                @endif
                            </div>
                            <input type="text" name="fax" value="{{ $data['customer_info']->fax}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            
                            <div class="d-flex">
                                <label >Customer Mobile</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->mobile != $data['customer_info_history']->mobile )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->mobile}} </div> 
                                @endif

                            </div>
                            <input type="text" name="mobile" value="{{ $data['customer_info']->mobile}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                           
                            <div class="d-flex">
                                <label >Customer Email</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->email != $data['customer_info_history']->email )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->email}} </div> 
                                @endif

                            </div>
                            <input type="text" name="email" value="{{ $data['customer_info']->email}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                           
                            <div class="d-flex">
                                <label >Contact Person</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->contact_person != $data['customer_info_history']->contact_person )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->contact_person}} </div>
                                @endif

                            </div>
                            <input type="text" name="contact_person" value="{{ $data['customer_info']->contact_person}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <div class="d-flex">
                                <label >Designation</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->des != $data['customer_info_history']->des )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->des}} </div> 
                                @endif

                            </div>
                            <input type="text" name="des" value="{{ $data['customer_info']->des}}" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <div class="d-flex">
                                <label >Website</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->web != $data['customer_info_history']->web )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->web}} </div>
                                @endif

                            </div>
                            
                            <input type="text" name="web" value="{{ $data['customer_info']->web}}" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            
                            <div class="d-flex">
                                <label >User</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->user != $data['customer_info_history']->user )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->user}} </div>
                                @endif

                            </div>
                            <input type="text" name="user"value="{{ $data['customer_info']->user}}" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <div class="d-flex">
                                <label >PW</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->pw != $data['customer_info_history']->pw )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->pw}} </div> 
                                @endif

                            </div>
                            <input type="text" name="pw" value="{{ $data['customer_info']->pw}}" class="form-control" >
                        </div>


                        <div class=" col-md-6 col-12 mb-3">
                           
                            <div class="d-flex">
                                <label >Credit Term</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->credit_term != $data['customer_info_history']->credit_term )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->credit_term}} </div> 
                                @endif

                            </div>
                            <input type="integer" name="credit_term" value="{{ $data['customer_info']->credit_term}}" class="form-control" >
                        </div>
                        
                         <div class="col-md-6 col-6">
                             
                         </div>         
                        <div class=" col-md-6 col-12 mb-3">
                           
                            <div class="d-flex">
                                <label >Portal Site Login</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->portal_login != $data['customer_info_history']->portal_login )
                                    <div class="edit-badge"> Edited </div> 
                            
                                @endif
                            </div>
                           
                            <textarea name="portal_login" cols="30" rows="10" class="form-control">{{ $data['customer_info']->portal_login}}</textarea>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <div class="d-flex">
                                <label >Remarks</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->remarks != $data['customer_info_history']->remarks )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->remarks}} </div> 
                                @endif
                            </div>
                            
                            <textarea name="remarks" cols="30" rows="10" class="form-control">{{ $data['customer_info']->remarks}}</textarea>
                        </div>

                        <div class="col-12">
                            <hr>
                            <h4 class="w-100">TRN </h4>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <div class="d-flex">
                                <label >Trn Number</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->trn != $data['customer_info_history']->trn )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->trn}} </div> 
                                @endif
                            </div>
                            <input type="integer" name="trn" value="{{ $data['customer_info']->trn}}" class="form-control" >
                        </div>

                        <div class="col-md-6 col-12">
                            @if( $data['customer_info']->trn_copy != null)
                                <!-- <div class="col-4">
                                    <h5 class=""><b> TRN Copy :</b></h5>
                                </div> -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex">
                                            <label>Replace TRN Copy</label>

                                            @if($data['customer_info_history'] != null && $data['customer_info']->trn_copy != $data['customer_info_history']->trn_copy )
                                                <div class="edit-badge"> Edited </div> 
                                                <div class="old-value"> Old file : 
                                                    <a target="_blank" href="{{ asset('main_admin/customer/')}}/{{$data['customer_info_history']->trn_copy}}" >
                                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                    </a>
                                                </div> 
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="col-11 form-group">  
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >Upload TRN Copy</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"   name="trn_copy">
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-1 p-0">
                                        <a target="_blank" href="{{ asset('main_admin/customer/')}}/{{$data['customer_info']->trn_copy}}" >
                                            <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                        </a>
                                        <!-- <a  href="{{ asset('main_admin/customer/')}}/{{$data['customer_info']->trn_copy}}" download>
                                            <button class="btn">
                                                Download Document
                                            </button>
                                        </a>                                    -->
                                    </div>
                                </div>
                            @else
                                <div class="form-group">
                                    <label>TRN Copy Upload</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload TRN Copy</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="trn_copy">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-12">
                            <hr>
                            <h4 class="w-100"> BUSINESS LICENCE </h4>
                        </div>

                        <div class="col-md-6 col-12">
                            @if( $data['customer_info']->business_license_copy != null)
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Replace BUSINESS LICENCE Copy</label>
                                        @if($data['customer_info_history'] != null && $data['customer_info']->business_license_copy != $data['customer_info_history']->business_license_copy )
                                            <div class="edit-badge"> Edited </div> 
                                            <div class="old-value"> Old file : 
                                                <a target="_blank" href="{{ asset('main_admin/customer/')}}/{{$data['customer_info_history']->business_license_copy}}" >
                                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                </a>
                                            </div> 
                                        @endif
                                    </div>
                                </div>
                                <div class="col-11 form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload BUSINESS LICENCE Copy</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="business_license_copy">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>  
                                <div col="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/customer')}}/{{$data['customer_info']->business_license_copy}}">
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div>
                            </div>
                            
                            @else
                                <div class="form-group">
                                    <label>BUSINESS LICENCE Upload</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload BUSINESS LICENCE Copy</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="business_license_copy">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <div class=" col-md-6 col-12 mb-3">
                            <div class="d-flex">
                                <label >Expiry Date ( BUSINESS LICENCE )</label>
                                @if($data['customer_info_history'] != null && $data['customer_info']->business_license_expiary_date != $data['customer_info_history']->business_license_expiary_date )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->business_license_expiary_date}} </div> 
                                @endif
                            </div>
                            <input type="date" value="{{ $data['customer_info']->business_license_expiary_date}}" name="business_license_expiary_date" class="form-control" >
                        </div>

                        <div class="col-12">
                            <hr>
                            <h4 class="w-100"> Customer Type </h4>
                        </div>
                        <div class=" col-md-6 col-12 mb-3">
                            <div class="d-flex">
                                <label >Select Type</label>

                                @if($data['customer_info_history'] != null && $data['customer_info']->contrct != $data['customer_info_history']->contrct )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_info_history']->contrct}} </div> 
                                @endif
                            </div>
                            <select name="contract" class="form-control" required>
                                <option value="contrct" <?php if($data['customer_info']->contrct == 'contract') echo 'selected="selected"' ?>> Contract Based</option>
                                <option value="project" <?php if($data['customer_info']->contrct == 'project') echo 'selected="selected"' ?>> Project Based</option>
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            @if( $data['customer_info']->business_contract_copy != null)
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex">
                                        <label>Replace  Contract/Project Based Copy</label>
                                        @if($data['customer_info_history'] != null && $data['customer_info']->business_contract_copy != $data['customer_info_history']->business_contract_copy )
                                            <div class="edit-badge"> Edited </div> 
                                            <div class="old-value"> Old file : 
                                                <a target="_blank" href="{{ asset('main_admin/customer/')}}/{{$data['customer_info_history']->business_contract_copy}}" >
                                                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                                </a>
                                            </div> 
                                        @endif
                                    </div>
                                </div>
                                <div class="col-11 form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload Contract/Project Based Copy</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="business_contract_copy">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/customer')}}/{{$data['customer_info']->business_contract_copy}}">
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div>

                            </div>
                            @else
                                <div class="form-group">
                                    <label>Upload Contract/Project Based Copy</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload Contract/Project Based Copy</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="business_contract_copy">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="text-center">
                        <input name="submit" type="submit" class="btn" value="Update">
                    </div>
                </form>
            </div>
            
          
       </div>

       <div id="step-2" class="tab-pane" role="tabpanel">
           <div class="container">
               @if($data['customer_department'] != null)
                <button type="button" class="btn btn-primary mb-3 mt-3" data-toggle="modal" data-target="#exampleModal" >
                    Add Department
                </button>
                <form action="" method="post" id="customer_dep">
                    @csrf
                    <input type="text" name="id" value="{{ $data['customer_department']->id }}" class="d-none">
                    <div class="row">
                        <div class=" col-md-6 col-12 mb-3">
                            <div class="d-flex">
                                <label >Select Department </label>
                                @if($data['customer_dep_history'] != null && $data['customer_department']->department_name != $data['customer_dep_history']->department_name )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_dep_history']->department_name}} </div> 
                                @endif
                            </div>
                            <select name="department_name" id="Select_Department_" class="form-control">
                                @foreach(Erp_department::all() as $department)
                                    <option value="{{ $department->id }}"  <?php if($data['customer_department']->department_name == $department->id) echo 'selected="selected"' ?>> {{ $department->name }} </option>
                                @endforeach
                            </select>
                            
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <div class="d-flex">
                                <label >CONCERNED PERSON NAME </label>
                                @if($data['customer_dep_history'] != null && $data['customer_department']->concerned_person_name != $data['customer_dep_history']->concerned_person_name )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_dep_history']->concerned_person_name}} </div> 
                                @endif
                            </div>
                            <input type="text" value="{{ $data['customer_department']->concerned_person_name}}" name="concerned_person_name" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <div class="d-flex">
                                <label >CONCERNED PERSON DESIGNATION </label>
                                @if($data['customer_dep_history'] != null && $data['customer_department']->concerned_person_designation != $data['customer_dep_history']->concerned_person_designation )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_dep_history']->concerned_person_designation}} </div> 
                                @endif
                            </div>
                            <input type="text" value="{{ $data['customer_department']->concerned_person_designation}}" name="concerned_person_designation" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <div class="d-flex">
                                <label >Tell</label>
                                @if($data['customer_dep_history'] != null && $data['customer_department']->tell != $data['customer_dep_history']->tell )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_dep_history']->tell}} </div> 
                                @endif
                            </div>
                            <input type="text" value="{{ $data['customer_department']->tell}}" name="tell" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Mobile</label>
                            <div class="d-flex">
                                <label >CONCERNED PERSON NAME </label>
                                @if($data['customer_dep_history'] != null && $data['customer_department']->mobile != $data['customer_dep_history']->mobile )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_dep_history']->mobile}} </div> 
                                @endif
                            </div>
                            <input type="text" value="{{ $data['customer_department']->mobile}}" name="mobile" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Fax</label>
                            <div class="d-flex">
                                <label >CONCERNED PERSON NAME </label>
                                @if($data['customer_dep_history'] != null && $data['customer_department']->mobile != $data['customer_dep_history']->mobile )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_dep_history']->mobile}} </div> 
                                @endif
                            </div>
                            <input type="text" value="{{ $data['customer_department']->fax}}" name="fax" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Email</label>
                            <div class="d-flex">
                                <label >CONCERNED PERSON NAME </label>
                                @if($data['customer_dep_history'] != null && $data['customer_department']->email != $data['customer_dep_history']->email )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old Value : {{ $data['customer_dep_history']->email}} </div> 
                                @endif
                            </div>
                            <input type="text" value="{{ $data['customer_department']->email}}" name="email" class="form-control" required>
                        </div>
                    
                        
                    </div>
                    <div class="text-center">
                        <input name="submit" type="submit" class="btn" value="Update">
                    </div>

                </form>
                @else
                <button type="button" class="btn btn-primary mb-3 mt-3" data-toggle="modal" data-target="#exampleModal" >
                    Add Department
                </button>
                <form action="" method="post" id="customer_dep_save">
                    @csrf
                    <div class="row">
                        <div class=" col-md-6 col-12 mb-3">
                            <label >Select Department </label>
                            <select name="department_name" id="Select_Department_" class="form-control">
                                @foreach(Erp_department::all() as $department)
                                    <option value="{{ $department->id }}"> {{ $department->name }} </option>
                                @endforeach
                            </select>
                            
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >CONCERNED PERSON NAME </label>
                            <input type="text" name="concerned_person_name" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >CONCERNED PERSON DESIGNATION </label>
                            <input type="text" name="concerned_person_designation" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Tell</label>
                            <input type="text" name="tell" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Mobile</label>
                            <input type="text" name="mobile" class="form-control"required >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Fax</label>
                            <input type="text" name="fax" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Email</label>
                            <input type="text" name="email" class="form-control" required>
                        </div>
                    
                        
                    </div>
                    <input name="submit" type="submit" class="btn" value="Save | Next">

                </form>
                @endif
                
           </div>
           <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="" method="post" id="department_add">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="form-group">
                                    <label for="">Department Name</label>
                                    <input type="text" name="new_dep_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn" value="Submit">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Save changes">
                        </div>
                        </form>
                    </div>
                </div>
            </div>
       </div>

       
    </div>
</div>

<script>

    $(document).ready(function(){
        var id = {{ $data['customer_info']->id }};

        $('#customer_info').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($('#customer_info')[0]);
            
            $.ajax({
                type: 'post',
                url: "{{ route('admin.customer.update_customer_info') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        id = data.id;
                        toastr.success("Customer Info Updated Successfully");
                        $('#smartwizard').smartWizard("next");
                    }
                },
                error: function (){    
                    alert('Technical Error (contact to web master)');
                }
            });

        });

        $('#customer_dep').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($('#customer_dep')[0]);
            formData.append('customer_id', id);
            $.ajax({
                type: 'post',
                url: "{{ route('admin.customer.update_customer_department') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success("Customer Department Updated Successfully");
                        $('#smartwizard').smartWizard("next");
                        window.location.replace("{{ route('admin.customer.customer') }}");
                    }
                },
                error: function (){    
                    alert('Technical Error (contact to web master)');
                }
            });

        });

        $('#customer_dep_save').on('submit', function (e) {

                e.preventDefault();
                var formData = new FormData($('#customer_dep_save')[0]);
                formData.append('customer_id', '{{ $data['customer_info']->id }}');
                $.ajax({
                    type: 'post',
                    url: "{{ route('admin.customer.save_customer_department') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.status == 1) {
                            toastr.success("Customer Department Added Successfully");
                            $('#smartwizard').smartWizard("next");
                            window.location.replace("{{ route('admin.customer.customer') }}");
                        }
                    },
                    error: function (){    
                        alert('Technical Error (contact to web master)');
                    }
                });

        });



        $('#customer_rate_card').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($('#customer_rate_card')[0]);
            formData.append('customer_id', '{{ $data['customer_info']->id }}');
            $.ajax({
                type: 'post',
                url: "{{ route('admin.customer.update_customer_rate_card') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success("Customer Rate Card Updated Successfully");
                        window.location.replace("{{ route('admin.customer.customer') }}");
                    }
                },
                error: function (){    
                    alert('Technical Error (contact to web master)');
                }
            });

        });

        $('#customer_rate_card_save').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($('#customer_rate_card_save')[0]);
            formData.append('customer_id', '{{ $data['customer_info']->id }}');
            $.ajax({
                type: 'post',
                url: "{{ route('admin.customer.save_customer_rate_card') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success("Customer Rate Card Added Successfully");
                        window.location.replace("{{ route('admin.customer.customer') }}");
                    }
                },
                error: function (){    
                    alert('Technical Error (contact to web master)');
                }
            });

        });

        $('#department_add').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($('#department_add')[0]);
            // formData.append('customer_id', id);
            formData.append( '_token' , '{{ csrf_token() }}')
            $.ajax({
                type: 'post',
                url: "{{ route( 'admin.customer.save_customer_new_department') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        // console.log($("#    "));
                        $("#Select_Department_").html(data.row);
                        toastr.success("Customer Department Added Successfully");
                        // window.location.replace("{{ route( 'user.customer') }}");
                    }
                },
                error: function (){    
                    alert('Technical Error (contact to web master)');
                }
            });

        });

 
        $('#smartwizard').smartWizard({
            theme: 'default',
            toolbarSettings: {
                toolbarPosition: 'bottom', // none, top, bottom, both
                toolbarButtonPosition: 'right', // left, right, center
                showNextButton: true, // show/hide a Next button
                showPreviousButton: true, // show/hide a Previous button
                toolbarExtraButtons: [] // Extra buttons to show on toolbar, array of jQuery input/buttons elements
            }
        });

        $('#smartwizard').smartWizard("reset");

    });

    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    console.log($("[type='date']").attr("min",new_date) );
    
</script>