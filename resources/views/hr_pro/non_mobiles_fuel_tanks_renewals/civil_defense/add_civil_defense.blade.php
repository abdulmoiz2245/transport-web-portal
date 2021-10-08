<div class="container mt-3">
<div class="mb-4">
        <a href="{{ route( 'admin.hr_pro.non_mobiles_fuel_tanks_renewals') }}">
            <button class="btn btn-primary">
                Back
            </button>
        </a>

    </div>
    <form action="{{ route('user.hr_pro.save_non_mobile_civil_defence') }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Admin Notes</label>
                    <textarea name="status_message" class="form-control form-control-rounded"  placeholder="Enter Admin Notes"></textarea>
                    
                </div>
            </div>
        </div>
        <hr>
        <div class="form-group col-md-6 col-12">
            <label>CIVIL DEFENSE DOCUMENT Upload</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Upload CIVIL DEFENSE DOCUMENT</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="document">
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
        </div>
        <div class="form-group col-md-6 col-12">
            <label for="admin-status">Expiary Date</label>
            <input type="date" name="expiary_date" class="form-control">
        </div>
        <div class="form-group col-md-6 col-12">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
<script>
    var date = new Date();
    date.setDate(date.getDate() + 10);
    var new_date = date.toLocaleDateString('en-CA');
    
    console.log($("[type='date']").attr("min",new_date) );

</script>