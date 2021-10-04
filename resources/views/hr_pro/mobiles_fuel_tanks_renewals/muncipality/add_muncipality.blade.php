<div class="container">
    <form action="{{ route('user.hr_pro.save_mobile_muncipality') }}" method="post" enctype="multipart/form-data">
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
        <div class="form-group">
            <label>MUNCIPALITY DOCUMENT Upload</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Upload MUNCIPALITY DOCUMENT</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input"   name="document" required>
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="admin-status">Expiary Date</label>
            <input type="date" name="expiary_date" class="form-control">
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