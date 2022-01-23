<div class="container">
    <div class="mb-5">
        <a href="{{ route( 'admin.inventory.tools') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>

    </div>
    <form action="{{ route('admin.hr_pro.update_mobiles_trained_individual') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label >Tool Assign To</label>
            <select name="" id="" class="form-control" required>
                    <option value="" selected="selected">Mechanic</option>
                    <option value="">Electrician</option>
                    <option value="">Denter</option>
                    <option value="">Painter</option>
                    <option value="">Welder</option>
                    <option value="">Helper</option>
                    <option value="">General Tools</option>
            </select>  
        </div>
        <div class="form-group" >
            <label>Tool Description</label>
            <input type="text" name="tool_descripiton" class="form-control">
        </div>
        <div class="form-group" >
            <label>Quantity</label>
            <input type="text" name="quantity" class="form-control">
        </div>
        <div class="form-group" >
            <label>Given To</label>
            <input type="text" name="given_to" class="form-control">
        </div>
        @if( true)
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
                        <input type="file" class="custom-file-input"   name="document">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="col-1 p-0 text-center">
                <a  target="_blank" href="">
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
                    <input type="file" class="custom-file-input"   name="document">
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
        </div>
        @endif
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
   
</script>