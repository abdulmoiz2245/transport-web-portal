<?php 
use App\Models\Company_name;

?>
<div class="container">
   
    <div class="row mb-5">
        <div class="col-4">
            <a href="{{ route( 'admin.hr_pro.trade_license__sponsors__partners') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>

            <a href="{{ route( 'admin.hr_pro.add_comany_name') }}" class="ml-3">
                <button class="btn btn-primary">Add Company</button>
            </a>
        </div>
    </div>
    <form action="{{route('admin.hr_pro.save_trade_license__sponsors__partners')}}" method="post"    enctype="multipart/form-data">
    @csrf

        <h2>Company</h2>
        <div class="row">
            <div class="col-md-6 col-12">
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
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Trade Name</label>
                    <input type="text" name="trade_name" class="form-control form-control-rounded"  placeholder="Enter Trade Name" required>
                </div>
            </div>
        </div>
       <div class="row">
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>License Number</label>
                    <input type="text" name="license_number" class="form-control form-control-rounded"  placeholder="Enter License number" required>
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Expiary Date</label>
                    <input name="expiary_date" class="form-control" type="date">

                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Trade License Copy Upload</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Trade License</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="trade_license">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Other</label>
                    <input name="company_other" class="form-control" type="text">
                </div>
           </div>

           
       </div>
       
       <div class="row">
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Membership Certificate Upload</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Membership Certificate</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="membership_certificate">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Sponsor Page Upload</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Sponsor Page</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="sponsor_page">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
       </div>

       <hr>
       <h2>Manager</h2>
       <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Upload ID</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload ID</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="manager_id_card">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Passport Upload</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Passport</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="manager_passport">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Visa Upload</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload visa</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="manager_visa">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Other</label>
                    <input name="manager_other" class="form-control" type="text">
                </div>
           </div>
       </div>

       <hr>
       <h2>Sponsor</h2>
       <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Upload ID</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload ID</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="sponsor_id_card">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Passport Upload</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Passport</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="sponsor_passport">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Visa Upload</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload visa</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="sponsor_visa">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Sponsorship Fee</label>
                    <input name="sponsorship_fee" class="form-control" type="text">

                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Other</label>
                    <input name="sponsor_other" class="form-control" type="text">
                </div>
           </div>
       </div>
       
       <!-- <hr>
       <h2>Partners</h2>
       <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Upload ID</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload ID</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="partners_id_card">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Passport Upload</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Passport</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="partners_passport">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Visa Upload</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload visa</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="partners_visa">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Other</label>
                    <input name="partners_other" class="form-control" type="text">
                </div>
           </div>
       </div> -->

        
        
        <div class="text-center mt-5">
            <input type="submit" class="btn btn-outline-secondary rounded-pill" value="Submit">
        </div>

    </form>
</div>

<script>
    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    
    console.log($("[type='date']").attr("min",new_date) );

</script>