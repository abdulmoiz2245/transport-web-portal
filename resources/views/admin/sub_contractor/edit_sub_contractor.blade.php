<?php 
use App\Models\Sub_contractor_new_department;
use App\Models\Company_name;

?>
<div id="smartwizard">
    <ul class="nav">
       <li>
           <a class="nav-link" href="#step-1">
              Sub Contractor Info
           </a>
       </li>
       <li>
           <a class="nav-link" href="#step-2">
                Sub Contractor Department
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
                            <label >Sub Contractor Name</label>
                            <input type="text" name="name" value="{{ $data['customer_info']->name}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Sub Contractor Address</label>
                            <input type="text" name="address" value="{{ $data['customer_info']->address}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Sub Contractor City</label>
                            <input type="text" name="city" value="{{ $data['customer_info']->city}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Sub Contractor Country</label>
                            <input type="text" name="country" value="{{ $data['customer_info']->country}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Sub Contractor Telephone</label>
                            <input type="text" name="tel_number" value="{{ $data['customer_info']->tel_number}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Sub Contractor Fax</label>
                            <input type="text" name="fax" value="{{ $data['customer_info']->fax}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Sub Contractor Mobile</label>
                            <input type="text" name="mobile" value="{{ $data['customer_info']->mobile}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Sub Contractor Email</label>
                            <input type="text" name="email" value="{{ $data['customer_info']->email}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Contact Person</label>
                            <input type="text" name="contact_person" value="{{ $data['customer_info']->contact_person}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Designation</label>
                            <input type="text" name="des" value="{{ $data['customer_info']->des}}" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Website</label>
                            <input type="text" name="web" value="{{ $data['customer_info']->web}}" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >User</label>
                            <input type="text" name="user"value="{{ $data['customer_info']->user}}" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >PW</label>
                            <input type="text" name="pw" value="{{ $data['customer_info']->pw}}" class="form-control" >
                        </div>


                        <div class=" col-md-6 col-12 mb-3">
                            <label >Credit Term</label>
                            <input type="integer" name="credit_term" value="{{ $data['customer_info']->credit_term}}" class="form-control" >
                        </div>
                        
                         <div class="col-md-6 col-6">
                             
                         </div>         
                        <div class=" col-md-6 col-12 mb-3">
                            <label >Portal Site Login</label>
                            <textarea name="portal_login" cols="30" rows="10" class="form-control">{{ $data['customer_info']->portal_login}}</textarea>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Remarks</label>
                            <textarea name="remarks" cols="30" rows="10" class="form-control">{{ $data['customer_info']->remarks}}</textarea>
                        </div>

                        <div class="col-md-6 col-12">
                            @if( $data['customer_info']->nda != null)
                            <div class="form-group">
                                <label>Replace NDA Copy</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload Nda Copy</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="nda">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            @else
                                <div class="form-group">
                                    <label>nda Copy Upload</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" >Upload Nda Copy</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input"   name="nda">
                                            <label class="custom-file-label">Choose file</label>
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
                            <input type="integer" name="trn" value="{{ $data['customer_info']->trn}}" class="form-control" >
                        </div>

                        <div class="col-md-6 col-12">
                            @if( $data['customer_info']->trn_copy != null)
                            <div class="form-group">
                                <label>Replace TRN Copy</label>
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
                            <div class="form-group">
                                <label>Replace BUSINESS LICENCE Copy</label>
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
                            <label >Expiry Date ( BUSINESS LICENCE )</label>
                            <input type="date" value="{{ $data['customer_info']->business_license_expiary_date}}" name="business_license_expiary_date" class="form-control" >
                        </div>

                        <div class="col-12">
                            <hr>
                            <h4 class="w-100"> BUSINESS CONTRACT </h4>
                        </div>
                        <div class="col-md-6 col-12">
                            @if( $data['customer_info']->business_contract_copy != null)
                            <div class="form-group">
                                <label>Replace BUSINESS CONTRACT Copy</label>
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
                            @else
                                <div class="form-group">
                                    <label>BUSINESS CONTRACT Upload</label>
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
                            <label >Select Department </label>
                            <select name="accountant_name" id="Select_Department_" class="form-control">
                                @foreach(Sub_contractor_new_department::all() as $department)
                                    <option value="{{ $department->id }}"  <?php if($data['customer_department']->accountant_name == $department->id) echo 'selected="selected"' ?>> {{ $department->name }} </option>
                                @endforeach
                            </select>
                            
                        </div>
                        
                        <!-- <div class=" col-md-6 col-12 mb-3">
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
                            <input type="text" value="{{ $data['customer_department']->fax}}" name="fax" class="form-control" >
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
                            <label >Accountant Name </label>
                            <input type="text" name="accountant_name" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Logistic Department Name </label>
                            <select name="logistic_department" class="form-control" required>
                                <option value="accounts">ACCOUNTS</option>
                                <option value="operations">OPERATIONS </option>
                            </select>
                        </div>

                        <!-- <div class=" col-md-6 col-12 mb-3">
                            <label >CONCERNED PERSON NAME </label>
                            <input type="text" name="concerned_person_name" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >CONCERNED PERSON DESIGNATION </label>
                            <input type="text" name="concerned_person_designation" class="form-control" required>
                        </div> -->

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
                                    <input type="text" name="new_dep_name" class="form-control">
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

    $(document).ready(function(){
        var id = {{ $data['customer_info']->id }};
       
        var customer_id = $('.customer').val();
        var customer = new FormData();
        customer.append('customer_id', customer_id);
        customer.append('_token', '{{ csrf_token() }}');

        


        $('#customer_info').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($('#customer_info')[0]);
            
            $.ajax({
                type: 'post',
                url: "{{ route('admin.sub_contractor.update_sub_contractor_info') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        id = data.id;
                        toastr.success("Sub Contractor Info Updated Successfully");
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
            formData.append('sub_contractor_id', id);
            $.ajax({
                type: 'post',
                url: "{{ route('admin.sub_contractor.update_sub_contractor_department') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success("Sub Contractor Department Updated Successfully");
                        $('#smartwizard').smartWizard("next");
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
            formData.append('sub_contractor_id', id);
            $.ajax({
                type: 'post',
                url: "{{ route('admin.sub_contractor.update_sub_contractor_rate_card') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success("Sub Contractor Rate Card Updated Successfully");
                        window.location.replace("{{ route('admin.sub_contractor.sub_contractor') }}");
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
            formData.append('sub_contractor_id', '{{ $data['customer_info']->id }}');
            $.ajax({
                type: 'post',
                url: "{{ route('admin.sub_contractor.save_sub_contractor_department') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success("Sub Contractor Department Added Successfully");
                        $('#smartwizard').smartWizard("next");
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
            formData.append('sub_contractor_id', '{{ $data['customer_info']->id }}');
            $.ajax({
                type: 'post',
                url: "{{ route('admin.sub_contractor.save_sub_contractor_rate_card') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success("Sub Contractor Rate Card Added Successfully");
                        window.location.replace("{{ route('admin.sub_contractor.sub_contractor') }}");
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
                url: "{{ route( 'admin.sub_contractor.save_sub_contractor_new_department') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        // console.log($("#    "));
                        $("#Select_Department_").html(data.row);
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

    });

    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    $("[type='date']").attr("min",new_date);
    

    $(".readonly").on('keydown paste focus mousedown', function(e){
        if(e.keyCode != 9) // ignore tab
            e.preventDefault();
    });
</script>