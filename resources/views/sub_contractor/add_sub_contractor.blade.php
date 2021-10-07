<?php 
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
       <li>
           <a class="nav-link" href="#step-3">
                Sub Contractor Rate Card
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
                            <label >Sub Contractor Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Sub Contractor Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Sub Contractor City</label>
                            <input type="text" name="city" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Sub Contractor Country</label>
                            <input type="text" name="country" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Sub Contractor Telephone</label>
                            <input type="text" name="tel_number" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Sub Contractor Fax</label>
                            <input type="text" name="fax" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Sub Contractor Mobile</label>
                            <input type="text" name="mobile" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Sub Contractor Email</label>
                            <input type="text" name="email" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Sub Contractor Person</label>
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
                            <label >Credit Term</label>
                            <input type="integer" name="credit_term" class="form-control" >
                        </div>
                        <div class="col-md-6 col-12 mb-3">
                             
                         </div> 

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Portal Site Login</label>
                            <textarea name="portal_login" cols="30" rows="10" class="form-control"></textarea>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Remarks</label>
                            <textarea name="remarks" cols="30" rows="10" class="form-control"></textarea>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <div class="form-group">
                                <label>NDA Upload</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Upload NDA </span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"   name="nda" required>
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
                                        <input type="file" class="custom-file-input"   name="trn_copy">
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
                                        <input type="file" class="custom-file-input"   name="business_license_copy">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class=" col-md-6 col-12 mb-3">
                            <label >Expiry Date ( BUSINESS LICENCE )</label>
                            <input type="date" name="business_license_expiary_date" class="form-control" >
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
                                        <input type="file" class="custom-file-input"   name="business_contract_copy">
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
                            <input type="text" name="concerned_person_name" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >CONCERNED PERSON DESIGNATION </label>
                            <input type="text" name="concerned_person_designation" class="form-control" >
                        </div> -->

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
          
       </div>

       <div id="step-3" class="tab-pane" role="tabpanel">
           <div class="container">
                <form action="" method="post" id="customer_rate_card">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Select Customer</label>
                                <select name="customer_id" class="form-control customer" required>
                                    @foreach($data['customer_infos'] as $customer)
                                    @if($customer->status == 'approved')
                                    <option value="{{ $customer->id }}"  >{{ $customer->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >From Location </label>
                                <input type="text" name="from" class="form-control customer_from" readonly required>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >To Location </label>
                                <input type="text" name="to" class="form-control customer_to" readonly required>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >VEHICLE TYPE </label>
                                <select name="vechicle_type" class="form-control" >
                                    <option value="flatbed">FLATBED</option>
                                    <option value="curtainside">CURTAINSIDE</option>
                                    <option value="tipper">TIPPER</option>
                                    <option value="3_ton_chiller">3TON CHILLER</option>
                                    <option value="7_ton">7TON</option>
                                    <option value="10_ton">10-TON</option>
                                    <option value="3_ton_grill">3TON GRILL</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Other Charges </label>
                                <input type="text" name="other_carges" class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Other Charges Description </label>
                                <input type="text" name="other_des" class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Rate Type</label>
                                <select name="rate" class="form-control" >
                                    <option value="per_ton">Per Ton</option>
                                    <option value="per_trip">Per Trip</option>
                                    <option value="per_day_12hr">Per Day 12hr</option>
                                    <option value="per_day_24hr">Per Day 24hr</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Rate </label>
                                <input type="text" name="rate_price" class="form-control" >
                            </div>
                        </div>

                        <!-- <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Driver Comission </label>
                                <input type="number" name="driver_comission" class="form-control" >
                            </div>
                        </div>

                        <div class="col-12">
                            <hr>
                            <h4 class="w-100">DETENTION CHARGE </h4>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Select Per Day / Per Hour</label>
                                <select name="detention" class="form-control" >
                                    <option value="per_day">Per Day</option>
                                    <option value="per_hour">Per Hour</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Days / Hours</label>
                                <input type="number" name="time" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Per Days Charges / Per Hours Charges</label>
                                <input type="number" name="charges" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Select Trip</label>
                                <select name="trip" class="form-control" >
                                    <option value="round_trip">ROUND TRIP </option>
                                    <option value="single_trip">SINGLE TRIP </option>
                                    <option value="return_trip">RETURN TRIP </option>
                                </select>
                            </div>
                        </div> -->

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Ap Km </label>
                                <input type="number" name="ap_km" class="form-control">
                            </div>
                        </div>

                        <!-- <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Ap Diesel as per trip</label>
                                <input type="number" name="ap_diesel" class="form-control">
                            </div>
                        </div> -->
                        
                    </div>
                    <input name="submit" type="submit" value="Submit">
                </form>
           </div>
          
       </div>
    </div>
</div>

<script>

    $(document).ready(function(){
        var id = 0;

        var customer_id = $('.customer').val();
        var customer = new FormData();
        customer.append('customer_id', customer_id);
        customer.append('_token', '{{ csrf_token() }}');


        $.ajax({
                type: 'post',
                url: "{{ route('user.sub_contractor.get_customer_rate_card') }}",
                data: customer,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data[0].to);
                    // document.getElementsByClassName('customer_to').value = "Something"; 
                    // $('.customer_to').val(data.to);
                    $('.customer_to').attr( 'value',data[0].to);
                    $('.customer_from').attr( 'value',data[0].from);
                    // $('.customer_from').val(data.from);
                    
                },
                error: function (){    
                    alert('Technical Error (contact to web master)');
                }
            });

       

        $('#customer_info').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($('#customer_info')[0]);
            
            $.ajax({
                type: 'post',
                url: "{{ route( 'user.sub_contractor.save_sub_contractor_info') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        id = data.id;
                        toastr.success("Sub Contractor Info Added Successfully");
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
                url: "{{ route( 'user.sub_contractor.save_sub_contractor_department') }}",
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

        $('#customer_rate_card').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($('#customer_rate_card')[0]);
            formData.append('sub_contractor_id', id);
            $.ajax({
                type: 'post',
                url: "{{ route( 'user.sub_contractor.save_sub_contractor_rate_card') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success("Sub Contractor Rate Card Added Successfully");
                        window.location.replace("{{ route( 'user.sub_contractor') }}");
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