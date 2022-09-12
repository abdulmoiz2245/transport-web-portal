
<div class="container">
    <div class="mb-4">
        <a href="{{ route( 'admin.workshop.preventive_check_list') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
</div>
<div class="container">
    <form action="{{ route('admin.workshop.update_preventive_check_list') }}" method="post"  enctype="multipart/form-data">
        @csrf
        <input type="text" class="d-none" name="id" value="{{ $data['check_list']->id }}">
        <div class="row">


            <div class="col-md-6 col-12">
                <div class="form-group">
                    <div class="d-flex">
                        <label>Slelect Vehicle</label>

                        @if($data['check_list_history'] != null && $data['check_list']->vehicle_id != $data['check_list_history']->vehicle_id )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : Vehicle Id ( {{ $data['check_list_history']->vehicle_id}} )</div> 
                        @endif    
                    </div>
                    
                    <select name="vehicle_id" id="vehicle_select" class="form-control" required placeholder="">
                        @foreach($data['vehicle'] as $vehicle)
                        <option value="{{ $vehicle->id }}" <?php if($data['check_list']->vehicle_id == $vehicle->id){ ?> selected="selected" <?php } ?>>{{ $vehicle->vehicle_number }}</option>
                        @endforeach
                    </select>
                </div>
           </div>

           <div class="col-md-6 col-12">
                @if( $data['check_list']->check_list_copy != null)
                    <!-- <div class="col-4">
                        <h5 class=""><b> TRN Copy :</b></h5>
                    </div> -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex">
                                <label>Replace Check List </label>

                                @if($data['check_list_history'] != null && $data['check_list']->check_list_copy != $data['check_list_history']->check_list_copy )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old file : 
                                        <a target="_blank" href="{{ asset('main_admin/workshop/')}}/{{$data['check_list_history']->check_list_copy}}" >
                                            <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                        </a>
                                    </div> 
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-11 form-group">  
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload Check List</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="check_list_copy">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 p-0">
                            <a target="_blank" href="{{ asset('main_admin/workshop/')}}/{{$data['check_list']->check_list_copy}}" >
                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                            </a>
                                                              
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label>Upload Check List </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Upload Check List </span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"   name="check_list_copy">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
        <input name="submit" type="submit" value="Submit" class="btn ">
    </form>
</div>

