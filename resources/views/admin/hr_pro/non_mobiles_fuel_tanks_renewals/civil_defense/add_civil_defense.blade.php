<div class="container mt-3">
    <form action="{{ route('admin.hr_pro.save_non_mobile_civil_defence') }}" method="post" enctype="multipart/form-data">
    @csrf
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