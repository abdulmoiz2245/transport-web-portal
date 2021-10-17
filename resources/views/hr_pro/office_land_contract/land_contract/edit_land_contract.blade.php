<div class="container">

    <div class="mb-5"> 
        <a href="{{ route( 'user.hr_pro.land_contracts') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
    <form action="{{ route('user.hr_pro.update_land_contracts') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="id" value="{{ $data['land_contract']->id }}" class="d-none">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Admin Notes</label>
                    <textarea name="status_message" class="form-control form-control-rounded"  placeholder="Enter Admin Notes">{{ $data['land_contract']->status_message }}</textarea>
                    
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>CONTRACT NUMBER</label>
                    <input type="text" name="contract_number" class="form-control form-control-rounded"  placeholder="Enter CONTRACT NUMBER" value="{{ $data['land_contract']->contract_number }}">
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Plot Details</label>
                    <input name="plot_details" class="form-control" type="text" value="{{ $data['land_contract']->plot_details }}">

                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Landloard Name</label>
                    <input type="text" name="landloard_name" class="form-control form-control-rounded"  placeholder="Enter Landloard Name" value="{{ $data['land_contract']->landloard_name }}" >
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Contract Expiary Date</label>
                    <input name="contract_expiary_date" class="form-control" type="date" value="{{ $data['land_contract']->contract_expiary_date }}">

                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Ijari Number</label>
                    <input type="text" name="ijari_number" class="form-control form-control-rounded"  placeholder="Enter Ijari Number"value="{{ $data['land_contract']->ijari_number }}" >
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Lease/Rent Copy</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Lease/Rent Copy</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="lease_rent">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Ijari Certificate</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Ijari Certificate</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="ijari_certificate">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
       </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    
    console.log($("[type='date']").attr("min",new_date) );

</script>