<div class="container">
    <div class="mb-5">
            <a href="{{ route( 'admin.inventory.spare_parts.spare_parts_entry') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
    </div>
    <form action="{{ route('admin.inventory.spare_parts.save_spare_parts_entry') }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label >Part Description | Quantity</label>
            <select name="part_description_id" id="" class="form-control" required>
                    @foreach($data['spare_parts'] as $spare_part)
                    <option value="{{ $spare_part->id }}" selected="selected">{{ $spare_part->part_description }} | {{ $spare_part->quantity }}</option>
                    @endforeach
            </select>  
        </div>
        <div class="form-group" >
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        <div class="form-group" >
            <label>Vehicle Number</label>
            <input type="text" name="vechicle" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Spare Part Consumer</label>
            <select name="person" id="" class="form-control" >
                    <option value="mechanic" selected="selected">Mechanic</option>
                    <option value="helper">Helper</option>
                    <option value="electrician">Electrician</option>
                    <option value="bodyworks">Bodyworks</option>
            </select>
        </div>
        <div class="form-group" >
            <label>Driver Name</label>
            <input type="text" name="driver_name" class="form-control" required>
        </div>
        <div class="form-group" >
            <label>Forman Name</label>
            <input type="text" name="forman_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Upload Requisition Signed by Forman</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Upload Requisition</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input"   name="requisition" required>
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    

</script>