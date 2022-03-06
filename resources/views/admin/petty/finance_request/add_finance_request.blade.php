<div class="container">

    <div class="mb-5"> 
        <a href="{{ route( 'admin.petty') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>

    <form action="{{ route('admin.petty.save_finance_request') }}" method="post" enctype="multipart/form-data">
    @csrf
    
       
        <div class="row">
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Amount</label>
                    <input type="text" name="amount" class="form-control form-control-rounded"  placeholder="Enter Amount" >
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Reason</label>
                    <input name="reason" class="form-control" type="text">

                </div>
           </div>
       </div>

       <div class="row">
           
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Upload Document (If any)</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="upload">
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