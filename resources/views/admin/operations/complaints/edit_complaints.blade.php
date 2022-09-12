<div class="container">

    <div class="mb-5"> 
        <a href="{{ route('admin.operations.complaints') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
    <form action="{{ route('admin.operations.update_complaints') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" name="id" value="{{ $data['complaint']->id }}" class="d-none">
        <div class="row">
            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Admin Notes</label>
                    <textarea name="status_message" class="form-control form-control-rounded"  placeholder="Enter Admin Notes">{{ $data['complaint']->status_message }}</textarea>
                    
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
                        

                        <option value="{{ $employee->id }}" <?php if($data['complaint']->emp_id == $employee->id) echo 'selected="selected"' ?>> {{ $employee->name }}</option>
                          
                    @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-md-6 col-12">
                @if($data['complaint']->upload != NULL)
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
                        <a target="_blank" href="{{ asset('main_admin/hr_pro/employee/main')}}/{{$data['complaint']->upload}}">
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
           

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label>Compaints </label>
                    
                    
                    <textarea name="complaint" class="form-control" id="" cols="30" rows="10" required>
                    {{ $data['complaint'] ->complaint }}
                    </textarea>
                </div>
            </div>

           
           
            <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>