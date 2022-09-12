
<div class="container">
    <div class="mb-4">
        <a href="{{ route( 'admin.workshop.job_card') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
</div>
<div class="container">
    <form action="{{ route('admin.workshop.update_job_card') }}" method="post"  enctype="multipart/form-data">
        @csrf
        <input type="text" class="d-none" name ="id" value="{{ $data['workshop']->id }}">
        <div class="row">


            <div class="col-md-6 col-12">
                <div class="form-group">
                    <div class="d-flex">
                        <label>Slelect Vehicle</label>

                        @if($data['workshop_history'] != null && $data['workshop']->vehicle_id != $data['workshop_history']->vehicle_id )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : Vehicle Id ( {{ $data['workshop_history']->vehicle_id}} )</div> 
                        @endif    
                    </div>
                    
                    <select name="vehicle_id" id="vehicle_select" class="form-control" required placeholder="">
                        @foreach($data['vehicle'] as $vehicle)
                        <option value="{{ $vehicle->id }}" <?php if($data['workshop']->vehicle_id == $vehicle->id){ ?> selected="selected" <?php } ?>>{{ $vehicle->vehicle_number }}</option>
                        @endforeach
                    </select>
                </div>
           </div>

           <hr>

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <div class="d-flex">
                        <label>Slelect Mechanic</label>
                        @if($data['workshop_history'] != null && $data['workshop']->mechanic_id != $data['workshop_history']->mechanic_id )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : Vehicle Id ( {{ $data['workshop_history']->mechanic_id}} )</div> 
                        @endif    
                    </div>
                    <select name="mechanic_id" id="mechanic_select" class="form-control" required placeholder="">
                        @foreach($data['employee'] as $mechanic)
                        <option value="{{ $mechanic->id }}" <?php if($data['workshop']->mechanic_id == $mechanic->id){ ?> selected="selected" <?php } ?>>{{ $mechanic->name }}</option>
                        @endforeach
                    </select>
                </div>
           </div>

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <div class="d-flex">
                        <label>Slelect Electrcian</label>
                        @if($data['workshop_history'] != null && $data['workshop']->electrician_id != $data['workshop_history']->electrician_id )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : Vehicle Id ( {{ $data['workshop_history']->electrician_id}} )</div> 
                        @endif    
                    </div>
                    <select name="electrician_id" id="electrician_select" class="form-control" required placeholder="">
                        @foreach($data['employee'] as $electrician)
                        <option value="{{ $electrician->id }}" <?php if($data['workshop']->electrician_id == $electrician->id){ ?> selected="selected" <?php } ?>>{{ $electrician->name }}</option>
                        @endforeach
                    </select>
                </div>
           </div>

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <div class="d-flex">
                        <label>Slelect painter</label>
                        @if($data['workshop_history'] != null && $data['workshop']->painter_id != $data['workshop_history']->denter_id )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : Vehicle Id ( {{ $data['workshop_history']->denter_id}} )</div> 
                        @endif    
                    </div>
                    <select name="denter_id" id="denter_select" class="form-control" required placeholder="">
                        @foreach($data['employee'] as $denter)
                        <option value="{{ $denter->id }}" <?php if($data['workshop']->denter_id == $denter->id){ ?> selected="selected" <?php } ?>>{{ $denter->name }}</option>
                        @endforeach
                    </select>
                </div>
           </div>

           
           

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <div class="d-flex">
                        <label>Slelect Whelder</label>
                        @if($data['workshop_history'] != null && $data['workshop']->whelder_id != $data['workshop_history']->whelder_id )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : Vehicle Id ( {{ $data['workshop_history']->whelder_id}} )</div> 
                        @endif    
                    </div>
                    <select name="whelder_id" id="whelder_select" class="form-control" required placeholder="">
                        @foreach($data['employee'] as $whelder)
                        <option value="{{ $whelder->id }}" <?php if($data['workshop']->whelder_id == $whelder->id){ ?> selected="selected" <?php } ?>>{{ $whelder->name }}</option>
                        @endforeach
                    </select>
                </div>
           </div>

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <div class="d-flex">
                        <label>Slelect Helper</label>
                        @if($data['workshop_history'] != null && $data['workshop']->helper_id != $data['workshop_history']->helper_id )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value : Vehicle Id ( {{ $data['workshop_history']->helper_id}} )</div> 
                        @endif    
                    </div>
                    <select name="helper_id" id="helper_select" class="form-control" required placeholder="">
                        @foreach($data['employee'] as $helper)
                        <option value="{{ $helper->id }}" <?php if($data['workshop']->helper_id == $helper->id){ ?> selected="selected" <?php } ?>>{{ $helper->name }}</option>
                        @endforeach
                    </select>
                </div>
           </div>

           <div class="col-12">
               <hr>
           </div>

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <div class="d-flex">
                        <label>Driver Complinat</label>
                        @if($data['workshop_history'] != null && $data['workshop']->driver_complaint != $data['workshop_history']->driver_complaint )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value :  {{ $data['workshop_history']->driver_complaint}} </div> 
                        @endif    
                    </div>
                    <input name="driver_complaint" value="{{ $data['workshop']->driver_complaint  }}" class="form-control" type="text">
                </div>
           </div>

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <div class="d-flex">
                        <label>Job Description</label>
                        @if($data['workshop_history'] != null && $data['workshop']->other_job_description != $data['workshop_history']->other_job_description )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value :  {{ $data['workshop_history']->other_job_description}} </div> 
                        @endif    
                    </div>
                    <input name="other_job_description" value="{{ $data['workshop']->other_job_description  }}" class="form-control" type="text">
                </div>
           </div>

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <div class="d-flex">
                        <label>Job Description</label>
                        @if($data['workshop_history'] != null && $data['workshop']->job_description != $data['workshop_history']->job_description )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value :  {{ $data['workshop_history']->job_description}} </div> 
                        @endif    
                    </div>
                    <select name="job_description" class="form-control" required placeholder="">
                        <option value="oil_change" <?php if($data['workshop']->job_description == 'oil_change'){ ?> selected="selected" <?php } ?>>Oil Change</option>
                        <option value="wheel_adjust" <?php if($data['workshop']->job_description == 'wheel_adjust'){ ?> selected="selected" <?php } ?>>Wheel Adjust</option>
                        <option value="other" <?php if($data['workshop']->job_description == 'other'){ ?> selected="selected" <?php } ?>>Wheel Adjust</option>
                    
                    </select>
                </div>
           </div>

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <div class="d-flex">
                        <label>Workshop Findings</label>

                        @if($data['workshop_history'] != null && $data['workshop']->findings != $data['workshop_history']->findings )
                            <div class="edit-badge"> Edited </div> 
                            <div class="old-value"> Old Value :  {{ $data['workshop_history']->findings}} </div> 
                        @endif    
                    </div>
                    <input name="findings" value="{{ $data['workshop']->findings  }}" class="form-control" type="text">
                </div>
           </div>

           <div class="col-md-6 col-12">
                @if( $data['workshop']->job_card_document != null)
                    <!-- <div class="col-4">
                        <h5 class=""><b> TRN Copy :</b></h5>
                    </div> -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex">
                                <label>Replace Job Card </label>

                                @if($data['workshop_history'] != null && $data['workshop']->job_card_document != $data['workshop_history']->job_card_document )
                                    <div class="edit-badge"> Edited </div> 
                                    <div class="old-value"> Old file : 
                                        <a target="_blank" href="{{ asset('main_admin/vehicle/')}}/{{$data['workshop_history']->job_card_document}}" >
                                            <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                                        </a>
                                    </div> 
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-11 form-group">  
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload Job Card</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="job_card_document">
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-1 p-0">
                            <a target="_blank" href="{{ asset('main_admin/workshop/')}}/{{$data['workshop']->job_card_document}}" >
                                <img  src="<?= asset('assets') ?>/images/export.png" alt="" title="View Document" width="30">
                            </a>
                                                              
                        </div>
                    </div>
                @else
                    <div class="form-group">
                        <label>Upload Job Card </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" >Upload Job Card </span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input"   name="job_card_document">
                                <label class="custom-file-label">Choose file</label>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

           <div class="col-12">
               <hr>
           </div>

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Job Status</label>
                    <select name="issue_status" class="form-control" required placeholder="">
                        <option value="open" <?php if($data['workshop']->issue_status == 'open'){ ?> selected="selected" <?php } ?>>Open</option>
                        <option value="closed" <?php if($data['workshop']->issue_status == 'closed'){ ?> selected="selected" <?php } ?>>Closed</option>
                    </select>
                </div>
           </div>

           
    
        

        </div>
        <input name="submit" type="submit" value="Submit" class="btn ">
    </form>
</div>

<script>

    $( document ).ready(function() {
        // $('#Ap_Fuel_as_per_trip').attr('required' , true);
        // $('#Ap_Km_as_per_trip').attr('required' , true);
        // $('#Ap_Diesel_as_per_trip').attr('required' , true);

        // $('#with_fuel').change(function() {
        //     if($(this).val() == 'with_fuel'){

        //         $('#Ap_Fuel_as_per_trip').attr('required' , true);
        //         $('#Ap_Km_as_per_trip').attr('required' , true);
        //         $('#Ap_Diesel_as_per_trip').attr('required' , true);

        //     }else if($(this).val() == 'without_fuel'){
        //         $('#Ap_Fuel_as_per_trip').attr('required' , false);
        //         $('#Ap_Km_as_per_trip').attr('required' , false);
        //         $('#Ap_Diesel_as_per_trip').attr('required' , false);
        //     }
        // });
    });

   
</script>