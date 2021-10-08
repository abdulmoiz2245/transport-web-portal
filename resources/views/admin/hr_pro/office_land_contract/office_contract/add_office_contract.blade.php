<div class="container">
    <div class="mb-5"> 
        <a href="{{ route( 'admin.hr_pro.office_contracts') }}">
            <button class="btn btn-primary">
                Back
            </button>
        </a>
    </div>
    <form action="{{ route('admin.hr_pro.save_office_contracts') }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="row">
           <div class="col-6">
                <div class="form-group">
                    <label>CONTRACT NUMBER</label>
                    <input type="text" name="contract_number" class="form-control form-control-rounded"  placeholder="Enter CONTRACT NUMBER" >
                </div>
           </div>
           <div class="col-6">
                <div class="form-group">
                    <label>Plot Details</label>
                    <input name="plot_details" class="form-control" type="text">

                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-6">
                <div class="form-group">
                    <label>Landloard Name</label>
                    <input type="text" name="landloard_name" class="form-control form-control-rounded"  placeholder="Enter Landloard Name" >
                </div>
           </div>
           <div class="col-6">
                <div class="form-group">
                    <label>Contract Expiary Date</label>
                    <input name="contract_expiary_date" class="form-control" type="date">

                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-6">
                <div class="form-group">
                    <label>Ijari Number</label>
                    <input type="text" name="ijari_number" class="form-control form-control-rounded"  placeholder="Enter Ijari Number" >
                </div>
           </div>
           <div class="col-6">
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
           <div class="col-6">
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