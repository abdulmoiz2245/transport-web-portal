<?php 
use App\Models\Company_name;

?>
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
       <li>
           <a class="nav-link" href="#step-3">
              Customer Rate Card
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
                            <label >Customer Name</label>
                            <input type="text" name="name" value="{{ $data['customer_info']->name}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Customer Address</label>
                            <input type="text" name="address" value="{{ $data['customer_info']->address}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Customer City</label>
                            <input type="text" name="city" value="{{ $data['customer_info']->city}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Customer Country</label>
                            <input type="text" name="country" value="{{ $data['customer_info']->country}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Customer Telephone</label>
                            <input type="text" name="tel_number" value="{{ $data['customer_info']->tel_number}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Customer Fax</label>
                            <input type="text" name="fax" value="{{ $data['customer_info']->fax}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Customer Mobile</label>
                            <input type="text" name="mobile" value="{{ $data['customer_info']->mobile}}" class="form-control" required>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Customer Email</label>
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
                            <label >Credit Term</label>
                            <input type="integer" name="credit_term" value="{{ $data['customer_info']->credit_term}}" class="form-control" >
                        </div>
                        
                         <div class="col-md-6 col-12 mb-3">
                             
                         </div>         
                        <div class=" col-md-6 col-12 mb-3">
                            <label >Portal Site Login</label>
                            <textarea name="portal_login" cols="30" rows="10" class="form-control">{{ $data['customer_info']->portal_login}}</textarea>
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Remarks</label>
                            <textarea name="remarks" cols="30" rows="10" class="form-control">{{ $data['customer_info']->remarks}}</textarea>
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
                <form action="" method="post" id="customer_dep">
                    @csrf
                    <input type="text" name="id" value="{{ $data['customer_department']->id }}" class="d-none">
                    <div class="row">
                        <div class=" col-md-6 col-12 mb-3">
                            <label >Department Name </label>
                            <input type="text" name="department_name" value="{{ $data['customer_department']->department_name}}" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >CONCERNED PERSON NAME </label>
                            <input type="text" value="{{ $data['customer_department']->concerned_person_name}}" name="concerned_person_name" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >CONCERNED PERSON DESIGNATION </label>
                            <input type="text" value="{{ $data['customer_department']->concerned_person_designation}}" name="concerned_person_designation" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Tell</label>
                            <input type="text" value="{{ $data['customer_department']->tell}}" name="tell" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Mobile</label>
                            <input type="text" value="{{ $data['customer_department']->mobile}}" name="mobile" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Fax</label>
                            <input type="text" value="{{ $data['customer_department']->fax}}" name="fax" class="form-control" >
                        </div>

                        <div class=" col-md-6 col-12 mb-3">
                            <label >Email</label>
                            <input type="text" value="{{ $data['customer_department']->email}}" name="email" class="form-control" >
                        </div>
                    
                        
                    </div>
                    <div class="text-center">
                        <input name="submit" type="submit" class="btn" value="Update">
                    </div>

                </form>
                
           </div>
          
       </div>

       <div id="step-3" class="tab-pane" role="tabpanel">
           <div class="container">
                <form action="" method="post" id="customer_rate_card">
                    @csrf
                    <input type="text" name="id" value="{{ $data['customer_rate_card']->id }}" class="d-none">

                    <div class="row">
                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >From Location </label>
                                <input type="text" value="{{ $data['customer_rate_card']->from}}" name="from" class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >To Location </label>
                                <input type="text" value="{{ $data['customer_rate_card']->to}}" name="to" class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >VEHICLE TYPE </label>
                                <select name="vechicle_type" class="form-control" >
                                    <option value="flatbed" <?php if($data['customer_rate_card']->vechicle_type == 'flatbed') echo 'selected' ?>>FLATBED</option>
                                    <option value="curtainside" <?php if($data['customer_rate_card']->vechicle_type == 'curtainside') echo 'selected' ?>>CURTAINSIDE</option>
                                    <option value="tipper" <?php if($data['customer_rate_card']->vechicle_type == 'tipper') echo 'selected' ?>>TIPPER</option>
                                    <option value="3_ton_chiller" <?php if($data['customer_rate_card']->vechicle_type == '3_ton_chiller') echo 'selected' ?>>3TON CHILLER</option>
                                    <option value="7_ton" <?php if($data['customer_rate_card']->vechicle_type == '7_ton') echo 'selected' ?>>7TON</option>
                                    <option value="10_ton" <?php if($data['customer_rate_card']->vechicle_type == '10_ton') echo 'selected' ?>>10-TON</option>
                                    <option value="3_ton_grill" <?php if($data['customer_rate_card']->vechicle_type == '3_ton_grill') echo 'selected' ?>>3TON GRILL</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Other Charges </label>
                                <input type="text" value="{{ $data['customer_rate_card']->other_carges}}" name="other_carges" class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Other Charges Description </label>
                                <input type="text"  value="{{ $data['customer_rate_card']->other_des}}"name="other_des" class="form-control" >
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Rate </label>
                                <select name="rate" class="form-control" >
                                    <option value="per_ton" <?php if($data['customer_rate_card']->rate == 'per_ton') echo 'selected' ?>>Per Ton</option>
                                    <option value="per_trip" <?php if($data['customer_rate_card']->rate == 'per_trip') echo 'selected' ?>>Per Trip</option>
                                    <option value="per_day_12hr" <?php if($data['customer_rate_card']->rate == 'per_day_12hr') echo 'selected' ?>>Per Day 12hr</option>
                                    <option value="per_day_24hr" <?php if($data['customer_rate_card']->rate == 'per_day_24hr') echo 'selected' ?>>Per Day 24hr</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Driver Comission </label>
                                <input type="number" value="{{ $data['customer_rate_card']->driver_comission}}" name="driver_comission" class="form-control" >
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
                                    <option value="per_day"  <?php if($data['customer_rate_card']->detention == 'per_day') echo 'selected' ?>>Per Day</option>
                                    <option value="per_hour"  <?php if($data['customer_rate_card']->detention == 'per_hour') echo 'selected' ?>>Per Hour</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Days / Hours</label>
                                <input  type="number"  value="{{ $data['customer_rate_card']->time}}" name="time" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Per Days Charges / Per Hours Charges</label>
                                <input type="number"  value="{{ $data['customer_rate_card']->charges}}" name="charges" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Select Trip</label>
                                <select name="trip" class="form-control" >
                                    <option value="round_trip" <?php if($data['customer_rate_card']->trip == 'round_trip') echo 'selected' ?>>ROUND TRIP </option>
                                    <option value="single_trip" <?php if($data['customer_rate_card']->trip == 'single_trip') echo 'selected' ?>>SINGLE TRIP </option>
                                    <option value="return_trip" <?php if($data['customer_rate_card']->trip == 'return_trip') echo 'selected' ?>>RETURN TRIP </option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Ap Km as per trip</label>
                                <input type="number"  value="{{ $data['customer_rate_card']->ap_km}}" name="ap_km" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-12 mb-3">
                            <div class=" col-md-6 col-12 mb-3">
                                <label >Ap Diesel as per trip</label>
                                <input type="number"  value="{{ $data['customer_rate_card']->ap_diesel}}" name="ap_diesel" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <div class="text-center">
                        <input name="submit" type="submit" class="btn" value="Update">
                    </div>
                </form>
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
                url: "{{ route( 'user.customer.update_customer_info') }}",
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
                url: "{{ route( 'user.customer.update_customer_department') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success("Customer Department Updated Successfully");
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
            formData.append('customer_id', id);
            $.ajax({
                type: 'post',
                url: "{{ route( 'user.customer.update_customer_rate_card') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        toastr.success("Customer Rate Card Updated Successfully");
                        window.location.replace("{{ route( 'user.customer') }}");
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
</script>