<?php 
use App\Models\Company_name;
use App\Models\Supplier_new_department;


?>
<div class="container">
    <div class="mb-4">
        <a href="{{ route( 'admin.supplier.supplier') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
</div>
<div id="smartwizard">
    
    <ul class="nav">
       <li>
           <a class="nav-link" href="#step-1">
              Supplier Info
           </a>
       </li>
       <li>
           <a class="nav-link" href="#step-2">
              Supplier Department
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
                            <label >Supplier Name</label>
                            <input type="text" name="name" value="{{ $data['customer_info']->name}}" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6 col-12 mb-3">
                            <label for="post_tag">Products</label>
                            <input type="text " value="{{ $data['customer_info']->product}}" name="product" value="" data-role="tagsinput" >
                        </div>

                        <div class="form-group col-md-6 col-12 mb-3">
                            <label for="post_tag">Services</label>
                            <input type="text" value="{{ $data['customer_info']->services}}" name="services" value="" data-role="tagsinput" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Supplier Address</label>
                            <input type="text" name="address" value="{{ $data['customer_info']->address}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Supplier City</label>
                            <input type="text" name="city" value="{{ $data['customer_info']->city}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Supplier Country</label>
                            <input type="text" name="country" value="{{ $data['customer_info']->country}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Supplier Telephone</label>
                            <input type="text" name="tel_number" value="{{ $data['customer_info']->tel_number}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Supplier Fax</label>
                            <input type="text" name="fax" value="{{ $data['customer_info']->fax}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Supplier Mobile</label>
                            <input type="text" name="mobile" value="{{ $data['customer_info']->mobile}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Supplier Email</label>
                            <input type="text" name="email" value="{{ $data['customer_info']->email}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Contact Person</label>
                            <input type="text" name="contact_person" value="{{ $data['customer_info']->contact_person}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Designation</label>
                            <input type="text" name="des" value="{{ $data['customer_info']->des}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Website</label>
                            <input type="text" name="web" value="{{ $data['customer_info']->web}}" class="form-control" required>
                        </div>

                        <!-- <div class=" col-md-6 col-12 mb-3">
                            <label >User</label>
                            <input type="text" name="user"value="{{ $data['customer_info']->user}}" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >PW</label>
                            <input type="text" name="pw" value="{{ $data['customer_info']->pw}}" class="form-control" >
                        </div> -->


                        <div class=" col-md-6 col-12 mb-3">
                            <label >Credit Days</label>
                            <input type="number" name="credit_term" value="{{ $data['customer_info']->credit_term}}" class="form-control" required>
                        </div>
                        
                         <div class="col-md-6 col-6">
                             
                         </div>         
                        <!-- <div class=" col-md-6 col-12 mb-3">
                            <label >Portal Site Login</label>
                            <textarea name="portal_login" cols="30" rows="10" class="form-control">{{ $data['customer_info']->portal_login}}</textarea>
                        </div> -->

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Remarks</label>
                            <textarea name="remarks" cols="30" rows="10" class="form-control" required>{{ $data['customer_info']->remarks}}</textarea>
                        </div>

                        <div class="col-12">
                            <hr>
                            <h4 class="w-100"> GUARANTEE CHEQUE  </h4>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >GUARANTEE</label>
                            <select name="is_guaranty" id="guaranty" class="form-control" >
                                    <option value="0" <?php if($data['customer_info']->is_guaranty == '0') echo 'selected="selected"' ?>>No</option>
                                    <option value="1" <?php if($data['customer_info']->is_guaranty == '1') echo 'selected="selected"' ?>>Yes</option>
                            </select>
                        </div>

                        <div class="amount col-md-6 col-12 mb-3">
                            <label >Amount</label>
                            <input type="text" name="amount" class="form-control" value="{{$data['customer_info']->guaranty_amount}}" >
                        </div>

                        <div class="cheque_copy col-md-6 col-12 mb-3">
                            @if($data['customer_info']->guaranty_cheque != null)
                            <div class="row">
                                <div class="col-12">
                                    <label>Replace CHEQUE COPY </label>
                                </div>
                                <div class="col-11 form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Replace CHEQUE COPY</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="guaranty_cheque" >
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/supplier/')}}/{{$data['customer_info']->guaranty_cheque}}">
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div>
                            </div>
                            @else
                            <div class="form-group"> 
                                <label>UPLOAD CHEQUE COPY </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >UPLOAD CHEQUE COPY</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="guaranty_cheque" >
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="reciving_copy col-md-6 col-12 mb-3">
                            @if($data['customer_info']->guaranty_reciving != null)
                            <div class="row">
                                <div class="col-12">
                                    <label>Replace RECEIVING COPY </label>
                                </div>
                                <div class="col-11 form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Replace RECEIVING COPY</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="guaranty_reciving" >
                                            <label class="custom-file-label" >Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/supplier/')}}/{{$data['customer_info']->guaranty_reciving}}">
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div>
                            </div>
                            @else
                            <div class="form-group"> 
                                <label>UPLOAD RECEIVING COPY </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >UPLOAD RECEIVING COPY</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="guaranty_reciving" >
                                        <label class="custom-file-label" >Choose file</label>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="col-12">
                            <hr>
                            <h4 class="w-100">TRN </h4>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Trn Number</label>
                            <input type="integer" name="trn" value="{{ $data['customer_info']->trn}}" class="form-control" required>
                        </div>

                        <div class="col-md-6 col-12">
                            @if( $data['customer_info']->trn_copy != null)
                            <div class="row">
                                <div class="col-12">
                                    <label>Replace TRN Copy</label>
                                </div>
                                <div class="col-11 form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload TRN Copy</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="trn_copy" >
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/supplier/')}}/{{$data['customer_info']->trn_copy}}">
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
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
                                            <input type="file" class="custom-file-input"   name="trn_copy" >
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
                                    <label>Replace BUSINESS LICENCE Copy</label>
                                </div>
                                <div class="col-11 form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload BUSINESS LICENCE Copy</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="business_license_copy" >
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/supplier')}}/{{$data['customer_info']->business_license_copy}}">
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
                                        <input type="file" class="custom-file-input"   name="business_license_copy" >
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <div class=" col-md-6 col-12 mb-3">
                            <label >Expiry Date ( BUSINESS LICENCE )</label>
                            <input type="date" value="{{ $data['customer_info']->business_license_expiary_date}}" name="business_license_expiary_date" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <hr>
                            <h4 class="w-100"> BUSINESS CONTRACT </h4>
                        </div>
                        <div class="col-md-6 col-12">
                            @if( $data['customer_info']->business_contract_copy != null)
                            <div class="row">
                                <div class="col-12">
                                    <label>Replace BUSINESS CONTRACT Copy</label>
                                </div>
                                <div class="col-11 form-group">  
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload BUSINESS CONTRACT Copy</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="business_contract_copy">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-1 p-0">
                                    <a target="_blank" href="{{ asset('main_admin/supplier')}}/{{$data['customer_info']->business_contract_copy}}">
                                        <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                    </a>
                                </div>
                            </div>
                            @else
                                <div class="form-group">
                                    <label>BUSINESS CONTRACT Upload Copy</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload  Copy</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="business_contract_copy">
                                            <label class="custom-file-label">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <div class=" col-md-6 col-12 mb-3">
                            <label >Expiry Date (  BUSINESS CONTRACT )</label>
                            <input type="date" value="{{ $data['customer_info']->business_contract_expiary_date}}" name="business_contract_expiary_date" class="form-control" >
                        </div>
                    </div>
                    <div class="text-center">
                        <input name="submit" type="submit" class="btn" value="Update">
                    </div>
                </form>
            </div> 
       </div>

       <div id="step-2" class="tab-pane" role="tabpanel">
            <button type="button" class="btn btn-primary mb-3 mt-3" data-toggle="modal" data-target="#exampleModal" >
                Add Department
            </button>
           <div class="container">
                @if($data['customer_department'] != null)
                <form action="" method="post" id="customer_dep">
                    @csrf
                    <input type="text" name="id" value="{{ $data['customer_department']->id }}" class="d-none">
                    <div class="row">
                        <!-- <div class=" col-md-6 col-12 mb-3">
                            <label >Account Name </label>
                            <input type="text" name="account_name" value="{{ $data['customer_department']->account_name}}" class="form-control" required>
                        </div> -->

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Select Department </label>
                            <select name="account_name" id="Select_Department_" class="form-control">
                                @foreach(Supplier_new_department::all() as $department)
                                    <option value="{{ $department->id }}"  <?php if($data['customer_department']->account_name == $department->id) echo 'selected="selected"' ?>> {{ $department->name }} </option>
                                @endforeach
                            </select>
                            
                        </div>

                        <!-- <div class=" col-md-6 col-12 mb-3">
                            <label >Delivery/Order </label>
                            <input type="text" name="delivery_order" value="{{ $data['customer_department']->delivery_order}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >CONCERNED PERSON NAME </label>
                            <input type="text" value="{{ $data['customer_department']->concerned_person_name}}" name="concerned_person_name" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >CONCERNED PERSON DESIGNATION </label>
                            <input type="text" value="{{ $data['customer_department']->concerned_person_designation}}" name="concerned_person_designation" class="form-control" required>
                        </div> -->

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Tell</label>
                            <input type="text" value="{{ $data['customer_department']->tell}}" name="tell" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Mobile</label>
                            <input type="text" value="{{ $data['customer_department']->mobile}}" name="mobile" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Fax</label>
                            <input type="text" value="{{ $data['customer_department']->fax}}" name="fax" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Email</label>
                            <input type="text" value="{{ $data['customer_department']->email}}" name="email" class="form-control" required>
                        </div>
                    
                        
                    </div>
                    <div class="text-center">
                        <input name="submit" type="submit" class="btn" value="Update">
                    </div>
                </form>
                @else
                <form action="" method="post" id="customer_dep_save">
                    @csrf
                    <div class="row">
                        <div class=" col-md-6 col-12 mb-3">
                            <label >Select Department </label>
                            <select name="account_name" id="Select_Department_1" class="form-control">
                                @foreach(Supplier_new_department::all() as $department)
                                    <option value="{{ $department->id }}"> {{ $department->name }} </option>
                                @endforeach
                            </select>
                            
                        </div>

                        <!-- <div class=" col-md-6 col-12 mb-3">
                            <label >CONCERNED PERSON NAME </label>
                            <input type="text" name="concerned_person_name" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >CONCERNED PERSON DESIGNATION </label>
                            <input type="text" name="concerned_person_designation" class="form-control" required >
                        </div> -->

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Tell</label>
                            <input type="text" name="tell" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Mobile</label>
                            <input type="text" name="mobile" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Fax</label>
                            <input type="text" name="fax" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Email</label>
                            <input type="text" name="email" class="form-control"required >
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
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <div class="form-group" href='#'>
                                    <input type="submit" class="btn" value="Submit">
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
 
          
       </div>
    </div>
</div>

<script>
    $('.amount').hide();
    $('.cheque_copy').hide();
    $('.reciving_copy').hide();

    $('#guaranty').on('change', function()
    {
        if(this.value == '1'){
            $('.amount').show();
            $('.cheque_copy').show();
            $('.reciving_copy').show();
        }

        if(this.value == '0'){
            $('.amount').val('')
            $('.amount').hide();
            $('.cheque_copy').val(null);
            $('.cheque_copy').hide();
            $('.reciving_copy').val(null);
            $('.reciving_copy').hide();
        }
        
    });

    document.addEventListener('keypress', function (e) {
            if (e.keyCode === 13 || e.which === 13) {
                e.preventDefault();
                return false;
            }
            
        });

    $(document).ready(function(){
        var id = {{ $data['customer_info']->id }};
       

        $('#customer_info').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($('#customer_info')[0]);
            
            $.ajax({
                type: 'post',
                url: "{{ route('admin.supplier.update_supplier_info') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        id = data.id;
                        toastr.success("Supplier Info Updated Successfully");
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
            formData.append('supplier_id',  {{ $data['customer_info']->id }});
            $.ajax({
                type: 'post',
                url: "{{ route('admin.supplier.update_supplier_department') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success("Supplier Department Updated Successfully");
                        window.location.replace("{{ route('admin.supplier.supplier') }}");
                        // $('#smartwizard').smartWizard("next");
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
            formData.append('supplier_id', id);
            $.ajax({
                type: 'post',
                url: "{{ route('admin.supplier.save_supplier_department') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success("Supplier Department Added Successfully");
                        window.location.replace("{{ route('admin.supplier.supplier') }}");
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
                url: "{{ route( 'admin.supplier.save_supplier_new_department') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        // console.log($("#    "));
                        $("#Select_Department_").html(data.row);
                        $("#Select_Department_1").html(data.row);

                        toastr.success("Customer Department Added Successfully");
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
        var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    
    console.log($("[type='date']").attr("min",new_date) );
    });
</script>