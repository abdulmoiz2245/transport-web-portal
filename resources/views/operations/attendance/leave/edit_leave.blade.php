<div class="container">

    <div class="mb-5"> 
        <a href="{{ route( 'user.operations.employee_leave') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
    <form action="{{ route('user.operations.update_employee_leave') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="id" value="{{ $data['leave']->id }}" class="d-none">
        
        <hr>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label>Select Employee </label>
                    <select name="emp_id" class="form-control" required>
                    @foreach($data['employee'] as $employee)
                        @if($employee->employee_doj != '' && $employee->status== 'approved')

                        <option value="{{ $employee->id }}" <?php if($data['leave']->emp_id == $employee->id) echo 'selected="selected"' ?>> {{ $employee->name }}</option>
                            @endif
                    @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label>From </label>
                    
                    <input type="date" name="from" class="form-control form-control-rounded"  placeholder="Enter from" value="{{ $data['leave']->from }}" required>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label>To </label>
                    
                    <input type="date" name="to" class="form-control form-control-rounded"  placeholder="Enter to"  value="{{ $data['leave']->to }}"  required>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label>Reason </label>
                    <input type="text"  name="reason" class="form-control form-control-rounded"  placeholder="Enter date" value="{{ $data['leave']->reason }}"  required>
                </div>
            </div>

           
            <div class="col-md-6 col-12">
                @if($data['leave']->upload != NULL)
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
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['leave']->upload}}">
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