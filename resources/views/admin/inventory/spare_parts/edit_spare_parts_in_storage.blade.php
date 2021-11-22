<div class="container">
    <div class="mb-5">
            <a href="{{ route( 'admin.inventory.spare_parts.spare_parts_in_storage') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
    </div>
    <form action="{{ route('admin.inventory.spare_parts.update_spare_parts_in_storage') }}" method="post" enctype="multipart/form-data">
    @csrf
        <input type="text" name="id" value="{{ $data['spare_part']->id }}" class="form-control d-none" required>
        <div class="form-group">
            <label for="">Spare Part Condition</label>
            <select name="condition" id="for_condition" class="form-control" >
                    <option value="new" <?php  if( $data['spare_part']->condition == 'new' || $data['spare_part']->condition != null){ ?> selected="selected" <?php  }?> >New</option>
                    <option value="used" <?php  if( $data['spare_part']->condition != 'new' && $data['spare_part']->condition != null && $data['tyre']->condition == 'old'){ ?> selected="selected" <?php }?> >Used</option>
            </select>
        </div>
        <div class="form-group">
            <label >For</label>
            <select name="for" id="for_which" class="form-control" required>
                    <option value="vechicle" <?php  if( $data['spare_part']->for == 'vechicle'){ ?> selected="selected" <?php  }?>>Vehicle</option>
                    <option value="trailer"<?php  if( $data['spare_part']->for == 'trailer'){ ?> selected="selected" <?php  }?>>Trailer</option>
            </select>  
        </div>
       
        <div class="form-group">
            <label for="">Brand Name</label>
            <input type="text" name="brand_name" value="{{ $data['spare_part']->brand_name }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Part Description</label>
            <input type="text" name="part_description" value="{{ $data['spare_part']->part_description }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    // var date = new Date();
    // date.setDate(date.getDate() + 10);
    // var new_date = date.toLocaleDateString('en-CA');
    
    // console.log($("[type='date']").attr("min",new_date) );
    $('#for_which').on('change', function()
    {
        if(this.value == '2'){
            $('.other').show();
        }

        if(this.value == '0' || this.value == '1'){
            $('.other').val(null);
            $('.other').hide();
        }
        
    });

</script>