<div class="container">

    <div class="mb-5"> 
        <a href="{{ route( 'admin.hr_pro.employee_suspension') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
    <form action="{{ route('admin.hr_pro.update_employee_suspension') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="id" value="{{ $data['employee_suspension']->id }}" class="d-none">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Admin Notes</label>
                    <textarea name="status_message" class="form-control form-control-rounded"  placeholder="Enter Admin Notes">{{ $data['employee_suspension']->status_message }}</textarea>
                    
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value='pending' <?php if($data['employee_suspension']->status == 'pending') echo 'selected="selected"' ?> >Pending</option>
                        <option value='approved' <?php if($data['employee_suspension']->status == 'approved') echo 'selected="selected"' ?> >Approved</option>
                        <option value='rejected' <?php if($data['employee_suspension']->status == 'rejected') echo 'selected="selected"' ?>>Rejected</option>
                    </select>
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
                        @if($employee->employee_doj != '' && $employee->status== 'approved' && $employee->row_status != 'deleted')

                        <option value="{{ $employee->id }}" <?php if($data['employee_suspension']->emp_id == $employee->id) echo 'selected="selected"' ?>> {{ $employee->name }}</option>
                            @endif
                    @endforeach
                    </select>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label>Remarks </label>
                    
                    <input type="text" name="remarks" class="form-control form-control-rounded"  placeholder="Enter Remmark" value="{{ $data['employee_suspension']->remarks }}" >
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label>Date </label>
                    <input type="date" name="date" class="form-control form-control-rounded"  placeholder="Enter date" value="{{ $data['employee_suspension']->date }}" >
                </div>
            </div>

           
            <div class="col-md-6 col-12">
                @if($data['employee_suspension']->upload != NULL)
                <div class="row">
                    <div class="col-12">
                        <label>Replace Upload Document</label>
                    </div>
                    <div class="col-11 form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Replace Upload Document</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"   name="upload">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 p-0">
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['employee_suspension']->upload}}">
                            <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                        </a>
                    </div>
                </div>
                @else
                <div class="form-group">
                    <label>Upload Document</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Document</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="upload">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>