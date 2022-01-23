<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="mb-5"> 
                <a href="{{ route( 'user.hr_pro.employee') }}">
                    <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
                </a>
            </div>
            <form action="{{ route('user.hr_pro.save_employee_termination') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="form-group">
                        <label>Admin Notes</label>
                        <input type="text" name="status_message" class="form-control" id="" placeholder="Enter Admin Notes">
                       
                        
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Select Employee </label>
                        <select name="emp_id" class="form-control" required>
                        @foreach($data['employee'] as $employee)
                            <?php
                                $check = false;
                                if($employee->employee_current_action== 'terminated'){
                                    if($employee->employee_current_status== 'approved'){
                                        $check = false;
                                    }
                                }else{
                                    $check = true;
                                    
                                }
                            ?>
                            @if($employee->employee_doj != '' && $employee->status== 'approved' && $check == true)

                            <option value="{{ $employee->id }}"> {{ $employee->name }}</option>
                                @endif
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Remarks </label>
                        
                        <input type="text" name="remarks" class="form-control form-control-rounded"  placeholder="Enter Remmark" required>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Date </label>
                        <input type="date" name="date" class="form-control form-control-rounded"  placeholder="Enter date" required>
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
                                <input type="file" class="custom-file-input"  required  name="upload">
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