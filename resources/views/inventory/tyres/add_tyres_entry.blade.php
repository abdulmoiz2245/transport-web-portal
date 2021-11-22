
<div class="container">
    <div class="mb-5">
            <a href="{{ route( 'user.inventory.tyres.complain_tyres') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
    </div>
    <form action="{{ route('user.inventory.tyres.save_tyres_entry') }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="">Tyre Serial Nummber</label>
            <select name="tyre_serial[]" id="" class="form-control Tyre_Serial_Nummber" multiple="multiple">
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
        
        <!-- <div class="form-group">
            <label for="">Tyre Brand</label>
            <input type="text" name="brand" class="form-control" required>
        </div> -->
        <div class="form-group">
            <label for="">Tyre Fitting Date</label>
            <input type="date" name="fitting_date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Tyre Fitting Place</label>
            <input type="text" name="fitting_place" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="">Vechicle Number</label>
            <input type="text" name="vechicle_numner" class="form-control" required>
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