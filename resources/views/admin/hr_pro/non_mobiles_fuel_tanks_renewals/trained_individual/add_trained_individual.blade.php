<div class="container">
    <form action="{{ route('admin.hr_pro.save_non_mobile_trained_individual') }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="row">
           <div class="col-6">
                <div class="form-group">
                    <label>Card NUMBER</label>
                    <input type="text" name="card_number" class="form-control form-control-rounded"  placeholder="Enter Card NUMBER" >
                </div>
           </div>
           <div class="col-6">
                <div class="form-group">
                    <label>Employee Name</label>
                    <input name="employee_name" class="form-control" type="text">

                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-6">
                <div class="form-group">
                    <label>Expiary Date</label>
                    <input name="expiary_date" class="form-control" type="date">

                </div>
           </div>
           <div class="col-6">
                <div class="form-group">
                    <label>Pass/Card</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Pass/Card</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="pass_card">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
       </div>

       <div class="row">
           <div class="col-6">
                <div class="form-group">
                    <label>Front Pic</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Front Pic</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="front_pic">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>
           <div class="col-6">
                <div class="form-group">
                    <label>Back Pic</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Back Pic</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="back_pic">
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