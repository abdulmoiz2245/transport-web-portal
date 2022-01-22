<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="mb-5"> 
                <a href="{{ route( 'admin.hr_pro.employee_funds') }}">
                    <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
                </a>
            </div>
            <form action="{{ route('admin.hr_pro.save_employee_funds') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Select Employee </label>
                        <select name="emp_id" class="form-control" required>
                        @foreach($data['employee'] as $employee)
                           
                            <option value="{{ $employee->id }}"> {{ $employee->name }}</option>
                            
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Amount </label>
                        
                        <input type="text" name="amount" class="form-control form-control-rounded"  placeholder="Enter Amount" required>
                    </div>
                </div>

                
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Reason </label>
                        
                        <input type="text" name="reason" class="form-control form-control-rounded"  placeholder="Enter Remmark" required>
                    </div>
                </div>

                
                <div class="col-12 col-md-6" >
                    <div class="form-group">
                        <label>Upload</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"  required  name="proof">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    var date = new Date();
    date.setDate(date.getMonth() + 1);
    var new_date = date.toLocaleDateString('en-CA');
    
    console.log($("[type='month']").attr("min",new_date) );
</script>