<div class="container">
    <div class="mb-5">
            <a href="{{ route( 'admin.inventory.tools.tools_entry') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
    </div>
    <form action="{{ route('admin.inventory.tools.update_tools_entry') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="id" class="d-none" value="{{ $data['tools_entery']->id }}">
        <div class="form-group">
            <label for="">Date</label>
            <input type="date" name="date" class="form-control" value="{{ $data['tools_entery']->date }}" required>
        </div>
        
        <div class="form-group">
            <label > Assigned Person  Name</label>
            <input type="text" name="assign_person_name" class="form-control" value="{{ $data['tools_entery']->assign_person_name }}" required> 
        </div>
        <div class="form-group">
            <label > Assigned Person  Designation</label>
            <input type="text" name="assign_person_designation" class="form-control" value="{{ $data['tools_entery']->assign_person_designation }}" required> 
        </div>
        

        @if( $data['tools_entery']->reciving != null)
        <div class="row">
            <div class="col-12">
                <label>Replace Receiving of the person tools are given to</label>
            </div>
            <div class="col-11 form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Upload Receiving</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input"   name="reciving">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="col-1 p-0 text-center">
                <a  target="_blank" href="{{ asset('main_admin\inventory\tools\reciving')}}/{{$data['tools_entery']->reciving}}">
                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                </a>
            </div>
        </div>
        @else
        <div class="form-group">
            <label>Upload Receiving of the person tools are given to</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Upload Receiving</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input"   name="reciving">
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
        </div>
        @endif
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    // var date = new Date();
    // date.setDate(date.getDate() + 10);
    // var new_date = date.toLocaleDateString('en-CA');
    
    // console.log($("[type='date']").attr("min",new_date) );

</script>