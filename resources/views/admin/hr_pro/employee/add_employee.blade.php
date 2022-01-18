<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<style>
    .form-group.required .control-label:after {
        content:"*";
        color:red;
    }


    section {
  display: flex;
  flex-flow: row wrap;
}

section > div {
  flex: 1;
  padding: 0.5rem;
}

input[type=radio] {
  display: none;
}
input[type=radio]:not(:disabled) ~ label {
  cursor: pointer;
}
input[type=radio]:disabled ~ label {
  color: #bcc2bf;
  border-color: #bcc2bf;
  box-shadow: none;
  cursor: not-allowed;
}

section label {
  height: 100%;
  display: block;
  background: white;
  border: 2px solid #20df80;
  border-radius: 20px;
  padding: 1rem;
  margin-bottom: 1rem;
  text-align: center;
  box-shadow: 0px 3px 10px -2px rgba(161, 170, 166, 0.5);
  position: relative;
}

input[type=radio]:checked + label {
  background: #20df80;
  color: white;
  box-shadow: 0px 0px 20px rgba(0, 255, 128, 0.75);
}
input[type=radio]:checked + label::after {
  color: #3d3f43;
  font-family: FontAwesome;
  border: 2px solid #1dc973;
  content: "";
  font-size: 24px;
  position: absolute;
  top: -25px;
  left: 50%;
  transform: translateX(-50%);
  height: 50px;
  width: 50px;
  line-height: 50px;
  text-align: center;
  border-radius: 50%;
  background: white;
  box-shadow: 0px 2px 5px -2px rgba(0, 0, 0, 0.25);
}

input[type=radio]#control_05:checked + label {
  background: red;
  border-color: red;
}

p {
  font-weight: 900;
}

@media only screen and (max-width: 700px) {
  section {
    flex-direction: column;
  }
}



</style>

<!-- Tab panes -->
<form action="{{ route('admin.hr_pro.save_employee') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal show" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                

                <div class="modal-body pt-5">
                    <section>
                        <div>
                            <input type="radio" id="control_01" name="type" value="permanent" checked>
                            <label for="control_01">
                                <h2>Permanent</h2>
                                
                            </label>
                        </div>
                        <div>
                            <input type="radio" id="control_02" name="type" value="temporary">
                            <label for="control_02">
                                <h2>Temporary</h2>
                                
                            </label>
                        </div>
                    </section>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Next</button>
                    <!-- <button type="button" class="btn btn-primary">Next</button> -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="row">
        <div class="col-md-6 col-12">
            <div class="form-group required name">
                <label class="control-label">Name</label>
                <input name="name" class="form-control name " type="text" required  >
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group required designation">
                <label class="control-label ">Categorie</label>
                <select name="designation"  required id="" class="form-control designation">
                    <option value="driver">Driver</option>
                    <option value="workshop">Workshop</option>
                    <option value="office">Office</option>
                </select>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group required">
                <label class="control-label ">Upload photo </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Upload photo</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="photo" required>
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required">
                <label class="control-label">Actual Designation</label>
                <input name="designation_actual" class="form-control" type="text" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required">
                <label class="control-label">Actual Salary</label>
                <input name="basic_salary_actual" class="form-control" type="number" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required">
                <label class="control-label">Designation Per Contract</label>
                <input name="designation_per_labour_contract" class="form-control" type="text" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required">
                <label class="control-label">Salary Per Contract</label>
                <input name="basic_salary_per_labour_contract" class="form-control" type="number" required>
            </div>
        </div>
        <!-- Nationality -->
        <div class="col-md-6 col-12">
            <div class="form-group required">
                <label class="control-label">Nationality</label>
                <input name="nationality" class="form-control" type="text" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required">
                <label class="control-label">Nationality Id Number</label>
                <input name="national_id_number" class="form-control" type="text" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required">
                <label class="control-label">Nationality Id Expiry</label>
                <input name="national_id_exp" class="form-control" type="date" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required">
                <label class="control-label ">National Id Copy </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >National Id Copy</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="national_id_copy" required>
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Passport -->
        <div class="col-md-6 col-12">
            <div class="form-group required">
                <label class="control-label">Passport  Number</label>
                <input name="passport_number" class="form-control" type="text" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required">
                <label class="control-label">Passport  Expiry</label>
                <input name="passport_exp" class="form-control" type="date" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required">
                <label class="control-label">Passport Copy </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Passport  Copy</span>
                    </div>
                    <div 9class="custom-file">
                        <input type="file" class="custom-file-input" name="passport_copy">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visa -->
        <div class="col-md-6 col-12">
            <div class="form-group required visa_number">
                <label class="control-label">Visa  Number</label>
                <input name="visa_number" class="form-control visa_number"  type="text" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required visa_exp">
                <label class="control-label ">Visa  Expiry</label>
                <input name="visa_exp" class="form-control visa_exp" type="date" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required visa_uuid">
                <label class="control-label ">Visa  UUID</label>
                <input name="visa_uuid" class="form-control visa_uuid" type="text" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required visa_copy">
                <label class="control-label ">Visa Copy </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Visa  Copy</span>
                    </div>
                    <div 9class="custom-file">
                        <input type="file" class="custom-file-input" name="visa_copy">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Work Permit -->
        <div class="col-md-6 col-12">
            <div class="form-group required work_permit_number">
                <label class="control-label">Work Permit  Number</label>
                <input name="work_permit_number" class="form-control work_permit_number" type="text" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required work_permit_exp">
                <label class="control-label">Work Permit  Expiry</label>
                <input name="work_permit_exp" class="form-control work_permit_exp" type="date" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required work_permit_copy">
                <label class="control-label">Work Permit Copy </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Work Permit  Copy</span>
                    </div>
                    <div 9class="custom-file">
                        <input type="file" class="custom-file-input work_permit_copy" name="work_permit_copy">
                        <label class="custom-file-label ">Choose file</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Noc -->
        <div class="col-md-6 col-12">
            <div class="form-group required noc_number">
                <label class="control-label ">NOC  Number</label>
                <input name="noc_number" class="form-control noc_number" type="text" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required noc_exp">
                <label class="control-label">NOC  Expiry</label>
                <input name="noc_exp" class="form-control noc_exp" type="date" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required noc_copy">
                <label class="control-label">NOC Copy </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >NOC  Copy</span>
                    </div>
                    <div 9class="custom-file">
                        <input type="file" class="custom-file-input noc_copy " name="noc_copy">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Labour Contract -->
        <div class="col-md-6 col-12">
            <div class="form-group required labour_contract_number">
                <label class="control-label">Labour Contract  Number</label>
                <input name="labour_contract_number" class="form-control labour_contract_number" type="text" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required labour_contract_exp">
                <label class="control-label">Labour Contract  Expiry</label>
                <input name="labour_contract_exp" class="form-control labour_contract_exp" type="date" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required labour_contract_copy">
                <label class="control-label">Labour Contract Copy </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Labour Contract  Copy</span>
                    </div>
                    <div 9class="custom-file">
                        <input type="file" class="custom-file-input labour_contract_copy" name="labour_contract_copy">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Company Contract-->
        <div class="col-md-6 col-12">
            <div class="form-group required ">
                <label class="control-label">Company Contract  Number</label>
                <input name="company_contract_number" class="form-control " type="text" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required">
                <label class="control-label">Company Contract  Expiry</label>
                <input name="company_contract_exp" class="form-control" type="date" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required">
                <label class="control-label">Company Contract Copy </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Company Contract  Copy</span>
                    </div>
                    <div 9class="custom-file">
                        <input type="file" class="custom-file-input" name="company_contract_copy" required>
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Emirates Id-->
        <div class="col-md-6 col-12">
            <div class="form-group required emirates_id">
                <label class="control-label">Emirates ID</label>
                <input name="emirates_id" class="form-control emirates_id" type="text" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required emirates_exp">
                <label class="control-label">Emirates  Expiry</label>
                <input name="emirates_exp" class="form-control emirates_exp" type="date" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required emirates_copy">
                <label class="control-label">Emirates Copy </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Emirates  Copy</span>
                    </div>
                    <div 9class="custom-file">
                        <input type="file" class="custom-file-input emirates_copy" name="emirates_copy">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Health Insurance
        <div class="col-md-6 col-12">
            <div class="form-group required health_insurance_policy_number">
                <label class="control-label">Health Insurance Policy Number</label>
                <input name="health_insurance_policy_number" class="form-control health_insurance_policy_number" type="text" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required health_insurance_policy_exp" >
                <label class="control-label">Health Insurance Policy  Expiry</label>
                <input name="health_insurance_policy_exp" class="form-control health_insurance_policy_exp" type="date" required>
            </div>
        </div>

        <div class="col-md-6 col-12">
            <div class="form-group required health_insurance_policy_copy">
                <label class="control-label">Health Insurance Policy Copy </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Upload  Copy</span>
                    </div>
                    <div 9class="custom-file">
                        <input type="file" class="custom-file-input health_insurance_policy_copy" name="health_insurance_policy_copy">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
        </div> -->

        <input type="submit"  value="Save">
    </div>
</form>

<script type="text/javascript">
    $(window).on('load', function() {
        $('#myModal').modal('show');
    });

    $('input[type=radio]').change(function(){
        var value = $( 'input[name=type]:checked' ).val();
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
        
    });
</script>
