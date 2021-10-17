<?php 
use App\Models\Company_name;
use App\Models\Erp_department;

?>

<div class="container">
    <div class="mb-4">
        <a href="{{ route( 'user.customer') }}">
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
                            <label >Customer Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Customer Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Customer City</label>
                            <input type="text" name="city" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Customer Country</label>
                            <input type="text" name="country" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Customer Telephone</label>
                            <input type="text" name="tel_number" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Customer Fax</label>
                            <input type="text" name="fax" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Customer Mobile</label>
                            <input type="text" name="mobile" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Customer Email</label>
                            <input type="text" name="email" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Contact Person</label>
                            <input type="text" name="contact_person" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Designation</label>
                            <input type="text" name="des" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Website</label>
                            <input type="text" name="web" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Credit Days</label>
                            <input type="number" name="credit_term" class="form-control" required>
                        </div>
                        <div class="col-md-12 col-12 mb-3">
                            
                         </div> 

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Portal Site Login</label>
                            <textarea name="portal_login" cols="30" rows="10" class="form-control"></textarea>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Remarks</label>
                            <textarea name="remarks" cols="30" rows="10" class="form-control"></textarea>
                        </div>

                        <div class="col-12">
                            <hr>
                            <h4 class="w-100">TRN </h4>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Trn Number</label>
                            <input type="integer" name="trn" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <div class="form-group">
                                <label>TRN Copy Upload</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload TRN </span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="trn_copy" required>
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr>
                            <h4 class="w-100"> BUSINESS LICENCE </h4>
                        </div>
                        <div class=" col-md-6 col-12 mb-3">
                            <div class="form-group">
                                <label>BUSINESS LICENCE Upload</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload BUSINESS LICENCE </span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="business_license_copy" required>
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class=" col-md-6 col-12 mb-3">
                            <label >Expiry Date ( BUSINESS LICENCE )</label>
                            <input type="date" name="business_license_expiary_date" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <hr>
                            <h4 class="w-100"> Customer Type </h4>
                        </div>
                        <div class=" col-md-6 col-12 mb-3">
                                <label >Select Type</label>
                                <select name="contract" class="form-control" required>
                                    <option value="contrct"> Contract Based</option>
                                    <option value="project"> Project Based</option>
                                </select>
                        </div>
                        <div class=" col-md-6 col-12 mb-3">
                            
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
                        </div>
                        
                        
                    </div>
                    <input class="btn  form-controll" name="submit" type="submit" value="Save | Next">
                </form>
            </div>
          
       </div>

       <div id="step-2" class="tab-pane" role="tabpanel">
           <div class="container">
                <button type="button" class="btn btn-primary mb-3 mt-3" data-toggle="modal" data-target="#exampleModal" >
                    Add Department
                </button>

                <form action="" method="post" id="customer_dep">
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
                            <input type="text" name="concerned_person_name" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >CONCERNED PERSON DESIGNATION </label>
                            <input type="text" name="concerned_person_designation" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Tell</label>
                            <input type="text" name="tell" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Mobile</label>
                            <input type="text" name="mobile" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Fax</label>
                            <input type="text" name="fax" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Email</label>
                            <input type="text" name="email" class="form-control" >
                        </div>
                    
                        
                    </div>
                    <input name="submit" type="submit" class="btn" value="Save | Next">

                </form>
                
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
                                <!-- <div class="form-group">
                                    <input type="submit" class="btn" value="Submit">
                                </div> -->
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
        var id = 0;
       

        $('#customer_info').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($('#customer_info')[0]);
            
            $.ajax({
                type: 'post',
                url: "{{ route( 'user.customer.save_customer_info') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        id = data.id;
                        toastr.success("Customer Info Added Successfully");
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
                url: "{{ route( 'user.customer.save_customer_department') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success("Customer Department Added Successfully");
                        $('#smartwizard').smartWizard("next");
                        window.location.replace("{{ route( 'user.customer') }}");
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
                url: "{{ route( 'user.customer.save_customer_new_department') }}",
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
                showNextButton: false, // show/hide a Next button
                showPreviousButton: false, // show/hide a Previous button
                toolbarExtraButtons: [] // Extra buttons to show on toolbar, array of jQuery input/buttons elements
            }
        });

        $('#smartwizard').smartWizard("reset");

    });
    
</script>
<script>
    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    
    console.log($("[type='date']").attr("min",new_date) );

</script>