<?php 
use App\Models\Company_name;

?>

<div class="container">
    <div class="mb-4 text-right">
        <a href="{{ route( 'user.supplier') }}">
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
                    <div class="row">
                        <div class=" col-md-6 col-12 mb-3 ">
                            <div class="form-group">
                                <label >Select Company</label>
                                <?php if(Company_name::all()->count() > 0){ ?>
                                    <select name="company_id" class="form-control " required>
                                        
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
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group col-md-6 col-12 mb-3">
                            <label for="post_tag">Products</label>
                            <br>
                            <input type="text" name="product"  class="form-control w-100" value="" data-role="tagsinput" required>
                        </div>

                        <div class="form-group col-md-6 col-12 mb-3">
                            <label for="post_tag">Services</label>
                            <br>
                            <input type="text" name="services" value="" data-role="tagsinput"  class="form-control w-100" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Supplier Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Supplier City</label>
                            <input type="text" name="city" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Supplier Country</label>
                            <input type="text" name="country" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Supplier Telephone</label>
                            <input type="text" name="tel_number" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Supplier Fax</label>
                            <input type="text" name="fax" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Supplier Mobile</label>
                            <input type="text" name="mobile" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Supplier Email</label>
                            <input type="text" name="email" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Contact Person</label>
                            <input type="text" name="contact_person" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Designation</label>
                            <input type="text" name="des" class="form-control" >required
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Website</label>
                            <input type="text" name="web" class="form-control" required>
                        </div>

                        <!-- <div class=" col-md-6 col-12 mb-3">
                            <label >User</label>
                            <input type="text" name="user" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >PW</label>
                            <input type="text" name="pw" class="form-control" >
                        </div> -->


                        <div class=" col-md-6 col-12 mb-3">
                            <label >Credit Days</label>
                            <input type="number" name="credit_term" class="form-control" required>
                        </div>
                        

                        <!-- <div class=" col-md-6 col-12 mb-3">
                            <label >Portal Site Login</label>
                            <textarea name="portal_login" cols="30" rows="10" class="form-control"></textarea>
                        </div> -->

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Remarks</label>
                            <textarea name="remarks" cols="30" rows="10" class="form-control" required></textarea>
                        </div>

                        <div class="col-12">
                            <hr>
                            <h4 class="w-100"> GUARANTEE CHEQUE  </h4>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >GUARANTEE</label>
                            <select name="is_guaranty" id="guaranty" class="form-control" >
                                    <option value="0" selected="selected">No</option>
                                    <option value="1">Yes</option>
                            </select>
                        </div>

                        <div class="amount col-md-6 col-12 mb-3">
                            <label >Amount</label>
                            <input type="text" name="amount" class="form-control" >
                        </div>

                        <div class="cheque_copy col-md-6 col-12 mb-3">
                            <div class="form-group">
                                <label>UPLOAD CHEQUE COPY </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >UPLOAD CHEQUE COPY  </span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="guaranty_cheque" >
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="reciving_copy col-md-6 col-12 mb-3">
                            <div class="form-group">
                                <label>UPLOAD RECEIVING COPY </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >UPLOAD RECEIVING COPY </span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="guaranty_reciving" >
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr>
                            <h4 class="w-100">TRN </h4>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Trn Number</label>
                            <input type="number" name="trn" class="form-control" required>
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
                            <h4 class="w-100"> BUSINESS CONTRACT </h4>
                        </div>
                        <div class=" col-md-6 col-12 mb-3">
                            <div class="form-group">
                                <label>BUSINESS CONTRACT Upload</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload BUSINESS CONTRACT </span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="business_contract_copy" >
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class=" col-md-6 col-12 mb-3">
                            <label >Expiry Date (  BUSINESS CONTRACT )</label>
                            <input type="date" name="business_contract_expiary_date" class="form-control" >
                        </div>
                    </div>
                    <input class="btn  form-controll" name="submit" type="submit" value="Save | Next">
                </form>
            </div>
          
       </div>

       <div id="step-2" class="tab-pane" role="tabpanel">
           <div class="container">
                <form action="" method="post" id="customer_dep">
                    @csrf
                    <div class="row">
                        <div class=" col-md-6 col-12 mb-3">
                            <label >Account Name </label>
                            <input type="text" name="account_name"  class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Delivery/Order </label>
                            <input type="text" name="delivery_order"  class="form-control" required>
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
                            <input type="text" name="mobile" class="form-control" required>
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
        var id = 0;
       

        $('#customer_info').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($('#customer_info')[0]);
            
            $.ajax({
                type: 'post',
                url: "{{ route('user.supplier.save_supplier_info') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        id = data.id;
                        toastr.success("Supplier Info Added Successfully");
                        $('#smartwizard').smartWizard("next");
                    }
                },
                error: function (){    
                    toastr.error("Technical Error (contact to web master)");
                }
            });

        });

        $('#customer_dep').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($('#customer_dep')[0]);
            formData.append('supplier_id', id);
            $.ajax({
                type: 'post',
                url: "{{ route('user.supplier.save_supplier_department') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success("Supplier Department Added Successfully");
                        window.location.replace("{{ route('user.supplier') }}");
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