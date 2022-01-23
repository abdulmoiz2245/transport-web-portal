<div class="container">
    <div class="mb-5">
            <a href="{{ route( 'admin.inventory.spare_parts.spare_parts_entry') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
    </div>
    <form action="{{ route('admin.inventory.spare_parts.save_spare_parts_entry') }}" method="post" enctype="multipart/form-data">
    @csrf
        <input type="number" name="id" class="form-control d-none" value="{{ $data['spare_part_entery']->id}}" required>
        <div class="form-group">
            <label for="">Date</label>
            <input type="date" name="date" class="form-control" value="{{ $data['spare_part_entery']->date}}" required>
        </div>
        <!-- <div class="form-group">
            <label >Part Description</label>
            <select name="" id="" class="form-control" required>
                    <option value="0" selected="selected">Spare Part 1</option>
                    <option value="1">Spare Part 2</option>
                    <option value="2">Spare Part 3</option>
            </select>  
        </div> -->
        <div class="form-group" >
            <label>Vehicle Number</label>
            <input type="text" name="vechicle" value="{{ $data['spare_part_entery']->vechicle}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Spare Part Consumer</label>
            <select name="person" id="" class="form-control" >
                    <option value="mechanic" <?php  if( $data['spare_part_entery']->person == 'mechanic'){ ?> selected="selected" <?php  }?>>Mechanic</option>
                    <option value="helper" <?php  if( $data['spare_part_entery']->person == 'helper'){ ?> selected="selected" <?php  }?>>Helper</option>
                    <option value="electrician" <?php  if( $data['spare_part_entery']->person == 'electrician'){ ?> selected="selected" <?php  }?>>Electrician</option>
                    <option value="bodyworks" <?php  if( $data['spare_part_entery']->person == 'selected'){ ?> selected="selected" <?php  }?>>Bodyworks</option>
            </select>
        </div>
        <div class="form-group" >
            <label>Driver Name</label>
            <input type="text" name="driver_name" value="{{ $data['spare_part_entery']->driver_name}}" class="form-control">
        </div>
        <div class="form-group" >
            <label>Forman Name</label>
            <input type="text" name="forman_name" value="{{ $data['spare_part_entery']->forman_name}}" class="form-control">
        </div>
        @if( $data['spare_part_entery']->requisition != null)
        <div class="row">
            <div class="col-12">
                <label>Replace Requisition Signed by Forman</label>
            </div>
            <div class="col-11 form-group">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" >Re Upload Requisition</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input"   name="requisition">
                        <label class="custom-file-label">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="col-1 p-0 text-center">
                <a  target="_blank" href="{{ asset('main_admin\inventory\spare_part\requisition')}}/{{$data['spare_part_entery']->requisition}}">
                    <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                </a>
            </div>
        </div>
        @else
        <div class="form-group">
            <label>Upload Requisition Signed by Forman</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" >Upload Requisition</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input"   name="requisition">
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
        </div>
        @endif
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    // var date = new Date();
    // date.setDate(date.getDate() + 10);
    // var new_date = date.toLocaleDateString('en-CA');
    
    // console.log($("[type='date']").attr("min",new_date) );

</script>