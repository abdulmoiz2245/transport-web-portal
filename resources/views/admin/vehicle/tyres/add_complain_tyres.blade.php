
<div class="container">
    <div class="mb-5">
            <a href="{{ route( 'admin.inventory.tyres.complain_tyres') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
    </div>
    <form action="{{ route('admin.inventory.tyres.save_complain_tyres') }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="">Tyre Serial Nummber</label>
            <select name="tyre_serial" id="" class="form-control">
                <?php foreach($data['tyres']  as $tyre){
                    if($tyre->is_complained != 1 && $tyre->tyre_serial != ''){ ?>
                <option value="{{ $tyre->id }}">{{ $tyre->tyre_serial }}</option>
                <?php } }?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="">Tyre Storage Location</label>
            <input type="text" name="storage_location" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="">Tyre Brand</label>
            <input type="text" name="brand" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Tyre Fitting Date</label>
            <input type="date" name="fitting_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Reason For Complain</label>
            <input type="text" name="complained" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    // var date = new Date();
    // date.setDate(date.getDate() + 10);
    // var new_date = date.toLocaleDateString('en-CA');
    
    // console.log($("[type='date']").attr("min",new_date) );

</script>