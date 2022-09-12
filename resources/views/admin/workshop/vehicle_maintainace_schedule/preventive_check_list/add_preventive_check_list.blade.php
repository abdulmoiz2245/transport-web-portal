
<div class="container">
    <div class="mb-4">
        <a href="{{ route( 'admin.workshop.job_card') }}">
            <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
        </a>
    </div>
</div>
<div class="container">
    <form action="{{ route('admin.workshop.save_preventive_check_list') }}" method="post"  enctype="multipart/form-data">
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

          

           <div class="col-md-6 col-12">
                <div class="form-group">
                    <label>Check list Upload</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Check List</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="check_list_copy">
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
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