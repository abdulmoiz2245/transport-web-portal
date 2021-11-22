<div class="container">
    <div class="mb-5">
            <a href="{{ route( 'user.inventory.tyres.new_used_tyres') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
    </div>
    <form action="{{ route('user.inventory.tyres.save_new_used_tyres') }}" method="post" enctype="multipart/form-data">
    @csrf
    
        <div class="form-group">
            <label for="">Tyre Storage Location</label>
            <input type="text" name="storage_location" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Tyre Serial Number</label>
            <input type="text" name="tyre_serial" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Tyre Brand</label>
            <input type="text" name="brand" class="form-control" required>
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