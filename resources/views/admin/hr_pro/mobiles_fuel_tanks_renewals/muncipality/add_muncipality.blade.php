<div class="container">
    <form action="{{ route('admin.hr_pro.save_mobile_muncipality') }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label>MUNCIPALITY DOCUMENT Upload</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Upload MUNCIPALITY DOCUMENT</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input"   name="document">
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