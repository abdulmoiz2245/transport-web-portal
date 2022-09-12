
<div class="container">
    <div class="mb-4">
        <a href="{{ route( 'admin.workshop.job_card') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
</div>
<div class="container">
    <form action="{{ route('admin.workshop.save_job_card') }}" method="post"  enctype="multipart/form-data">
        @csrf
        <div class="row">


            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Slelect Vehicle</label>
                    <select name="vehicle_id" id="vehicle_select" class="form-control" required placeholder="">
                        @foreach($data['vehicle'] as $vehicle)
                        <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }}</option>
                        @endforeach
                    </select>
                </div>
           </div>

           <hr>

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Slelect Mechanic</label>
                    <select name="mechanic_id" id="mechanic_select" class="form-control" required placeholder="">
                        @foreach($data['employee_workshop'] as $mechanic)
                        <option value="{{ $mechanic->id }}">{{ $mechanic->name }}</option>
                        @endforeach
                    </select>
                </div>
           </div>

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Slelect Electrcian</label>
                    <select name="electrician_id" id="electrician_select" class="form-control" required placeholder="">
                        @foreach($data['employee_workshop'] as $electrician)
                        <option value="{{ $electrician->id }}">{{ $electrician->name }}</option>
                        @endforeach
                    </select>
                </div>
           </div>

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Slelect Denter</label>
                    <select name="denter_id" id="denter_select" class="form-control" required placeholder="">
                        @foreach($data['employee_workshop'] as $denter)
                        <option value="{{ $denter->id }}">{{ $denter->name }}</option>
                        @endforeach
                    </select>
                </div>
           </div>

           
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Slelect Painter</label>
                    <select name="painter_id" id="painter_select" class="form-control" required placeholder="">
                        @foreach($data['employee_workshop'] as $painter)
                        <option value="{{ $painter->id }}">{{ $painter->name }}</option>
                        @endforeach
                    </select>
                </div>
           </div>

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Slelect Whelder</label>
                    <select name="whelder_id" id="whelder_select" class="form-control" required placeholder="">
                        @foreach($data['employee_workshop'] as $whelder)
                        <option value="{{ $whelder->id }}">{{ $whelder->name }}</option>
                        @endforeach
                    </select>
                </div>
           </div>

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Slelect Helper</label>
                    <select name="helper_id" id="helper_select" class="form-control" required placeholder="">
                        @foreach($data['employee_workshop'] as $helper)
                        <option value="{{ $helper->id }}">{{ $helper->name }}</option>
                        @endforeach
                    </select>
                </div>
           </div>

           <div class="col-12">
               <hr>
           </div>

           

           

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Job Description</label>
                    <select name="job_description" class="form-control" required placeholder="">
                        <option value="oil_change">Oil Change</option>
                        <option value="wheel_adjust">Wheel Adjust</option>
                        <option value="other">Other</option>

                    </select>
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Job Description</label>
                    <input name="other_job_description" class="form-control" type="text">
                </div>
           </div>
           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Driver Complinat</label>
                    <!-- <input name="driver_complaint" type="text"> -->
                    <textarea name="driver_complaint" id="" cols="30" class="form-control" rows="10" required></textarea>
                </div>
           </div>

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Workshop Findings</label>
                    <!-- <input name="" class="form-control" type="text"> -->
                    <textarea name="findings" id="" cols="30" class="form-control" rows="10" required></textarea>

                </div>
           </div>

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Job Card Upload</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Job Card</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="job_card_document">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
           </div>

           <div class="col-12">
               <hr>
           </div>

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Job Status</label>
                    <select name="issue_status" class="form-control" required placeholder="">
                        <option value="closed">Closed</option>

                        <option value="open">Open</option>
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