<div class="container">
    <div class="mb-5">
            <a href="{{ route( 'admin.inventory.tyres.complain_tyres') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
    </div>
    <form action="{{ route('admin.inventory.tyres.update_complain_tyres') }}" method="post" enctype="multipart/form-data">
    @csrf
        <input type="text" name="id" class="form-control d-none" value="{{ $data['tyre']->id }}" required>
        
        <div class="form-group">
            <label for="">Tyre Storage Location</label>
            <input type="text" name="storage_location" class="form-control" value="{{ $data['tyre']->storage_location }}" required>
        </div>
        <div class="form-group">
            <label for="">Tyre Serial Number</label>
            <input type="text" name="tyre_serial" class="form-control" value="{{ $data['tyre']->tyre_serial }}"  readonly>
        </div>
        <div class="form-group">
            <label for="">Tyre Brand</label>
            <input type="text" name="brand" class="form-control" value="{{ $data['tyre']->brand }}" required>
        </div>
        <div class="form-group">
            <label for="">Tyre Fitting Date</label>
            <input type="date" name="fitting_date" class="form-control" value="{{ $data['tyre']->fitting_date }}" required>
        </div>
        <div class="form-group">
            <label for="">Reason For Complain</label>
            <input type="text" name="reason_for_complain" value="{{ $data['tyre']->complained }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="">Status</label>
            
            <select name="action" class="form-control" >
                <option value="resolved" <?php if( $data['tyre']->action == 'resolved'){ ?> selected="selected" <?php }?>>Resolved</option>
                <option value="pendinng" <?php if( $data['tyre']->action == 'pendinng') { ?> selected="selected" <?php }?>>Pending</option>
                <option value="in progress" <?php if( $data['tyre']->action == 'in progress'){ ?> selected="selected" <?php }?>>In Progress</option>

            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    // var date = new Date();
    // date.setDate(date.getDate() + 10);
    // var new_date = date.toLocaleDateString('en-CA');
    
    // console.log($("[type='date']").attr("min",new_date) );

</script>