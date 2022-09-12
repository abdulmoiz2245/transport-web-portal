<?php 
use App\Models\Company_name;
use App\Models\Purchase_mertial_data;
use App\Models\Supplier_info;

?>
<div class="container">
   
    <div class="row mb-5">
        <div class="col-1">
            <a href="{{ route( 'admin.operations') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>
        </div>
    </div>

    <form action="{{route('admin.operations.save_new_booking')}}" method="post"    enctype="multipart/form-data">
    @csrf

        <div class="row">
            <div class="col-md-6 col-12 select_company">
                <div class="form-group">
                    <label >Select Company</label>
                    <?php if(Company_name::all()->count() > 0){ ?>
                        <select name="company_id"  class="form-control "required >
                            
                            @foreach(Company_name::all() as $company_name)
                            <option value="{{ $company_name->id }}">{{ $company_name->name }}</option>
                            @endforeach
                        </select>
                    <?php } else{ ?>
                    <h5 class="text-danger">Please Add Company First </h5> 
                    <?php } ?>
                </div>
            </div>
            <input type="text" name="customer_id"  class="d-none" value="{{ $data['customer']->id }}">
            <input type="text" name="rate_card_id"  class="d-none" value="{{ $data['customer_rate_card']->id }}">

            <div class="col-md-6 col-12">
                <div class="form-group">
                    <label >Customer Name</label>
                    <input type="text" name="customer_name" class="form-control form-control" value="{{$data['customer']->name}}" readonly placeholder="" required>
                </div>
            </div>
            <div class="col-md-6 col-12 trn_number">
                <div class="form-group">
                    <label>TRN Number</label>
                    <input type="number" name="trn" class="form-control" readonly placeholder="Enter TRN Number" value="{{ $data['customer']->trn }}" required>
                </div>
            </div>
            <div class="col-md-6 col-12 trn_number">
                <div class="form-group">
                    <label>Booking Date</label>
                    <input type="datetime-local" name="booking_date" class="form-control"  placeholder="Select date"  required>
                </div>
            </div>

            <div class="col-md-6 col-12 trn_number">
                <div class="form-group">
                    <label>Loading Date</label>
                    <input type="datetime-local" name="loading_date" class="form-control"  placeholder="Select date"  required>
                </div>
            </div>

            <div class="col-md-6 col-12 trn_number">
                <div class="form-group">
                    <label>Off Loading Date</label>
                    <input type="datetime-local" name="offloading_date" class="form-control"  placeholder="Select date"  required>
                </div>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-6 col-12 ">
                <div class="form-group">
                    <label class="form-check-label" for="own_hired_vehicle">
                        Own / Hired Vehicle
                    </label>
                    <select name="own_hired_vehicle"  class="form-control "required >
                        <option value="own">Own</option>
                        <option value="hired">Hired</option>

                    </select>
                </div>
            </div>
            <div class="col-md-6 col-12 select_company">
                <div class="form-group">
                    <label >Select Sub Contractor</label>
                    <?php if($data['sub_contractor']->count() > 0){ ?>
                        <select name="sub_contractor_id" id="select_sub_contractor" placeholder="" class="form-control "required >
                            
                            @foreach($data['sub_contractor'] as $sub_contractor)
                            <option value="{{ $sub_contractor->id }}">{{ $sub_contractor->name }}</option>
                            @endforeach
                        </select>
                    <?php } else{ ?>
                    <h5 class="text-danger">Please Add Sub Contractor First </h5> 
                    <?php } ?>
                </div>
            </div>
            
            <div class="col-md-6 col-12 select_company">
                <div class="form-group">
                    <label for="select_vehicle">Select Vehicle</label>
                    <?php if($data['vehicle']->count() > 0){ ?>
                        <select name="vehicle_id" id="select_vehicle" placeholder="" class="form-control "required >
                            
                            @foreach($data['vehicle'] as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ $vehicle->vehicle_number }}</option>
                            @endforeach
                        </select>
                    <?php } else{ ?>
                    <h5 class="text-danger">Please Add Vehicle or Assign  First </h5> 
                    <?php } ?>
                </div>
            </div>
            <input type="text" class="d-none" name="driver_id" id="driver_id">
            <div class="col-md-6 col-12 trn_number">
                <div class="form-group">
                    <label>Driver Name</label>
                    <input id="driver_name" type="text" name="driver_name" class="form-control" readonly placeholder="Enter Driver Name" value="" required>
                </div>
            </div>
            <div class="col-md-6 col-12 trn_number">
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input id="mobile_number" type="text" name="mobile_number" class="form-control" readonly placeholder="Enter Mobile Number" value="" required>
                </div>
            </div>
            <input type="text" class="d-none" name="trailer_id" id="trailer_id">

            <div class="col-md-6 col-12 trn_number">
                <div class="form-group">
                    <label>Trailer Chassis Number</label>
                    <input id="trailer_number" type="text" name="trailer_chassis_number" class="form-control" readonly placeholder="Enter Trailer number" value="" required>
                </div>
            </div>
            <div class="col-12">
                <hr>
            </div>
            <div class="col-md-6 col-12 trn_number">
                <div class="form-group">
                    <label>From  Location</label>
                    <input id="from_location" type="text" name="from_location" class="form-control" readonly placeholder="Enter From Location" value="<?php if($data['customer']->type == 'temporary'){ ?>
                        {{  $data['customer']->from }}
                     <?php }else{ ?>
                        {{ $data['customer_rate_card']->from }}
                    <?php  } ?>" required>
                </div>
            </div>
            <div class="col-md-6 col-12 trn_number">
                <div class="form-group">
                    <label>To  Location</label>
                    <input id="to_location" type="text" name="to_location" class="form-control" readonly placeholder="Enter To Location" value="<?php if($data['customer']->type == 'temporary'){ ?>
                        {{  $data['customer']->to }}
                     <?php }else{ ?>
                        {{ $data['customer_rate_card']->to }}
                    <?php  } ?>" required>
                </div>
            </div>
            <div class="col-md-6 col-12 trn_number">
                <div class="form-group">
                    <label>Ap Fuel</label>
                    <input id="ap_fuel" type="text" name="ap_fuel" class="form-control" readonly placeholder="Enter Ap Fuel" value="<?php if($data['customer']->type == 'temporary'){ ?>
                        {{  $data['customer']->ap_fuel }}
                     <?php }else{ ?>
                        {{ $data['customer_rate_card']->ap_fuel }}
                    <?php  } ?>" required>
                </div>
            </div>
            <div class="col-md-6 col-12 trn_number">
                <div class="form-group">
                    <label>Ap Km</label>
                    <input id="ap_km" type="text" name="ap_km" class="form-control" readonly placeholder="Enter Ap KM" value="<?php if($data['customer']->type == 'temporary'){ ?>
                        {{  $data['customer']->ap_km }}
                     <?php }else{ ?>
                        {{ $data['customer_rate_card']->ap_km }}
                    <?php  } ?>" required>
                </div>
            </div>
            <div class="col-md-6 col-12 trn_number">
                <div class="form-group">
                    <label>Driver Comission</label>
                    <input id="driver_comission" type="text" name="driver_comission" class="form-control" readonly placeholder="Enter Driver Comission" value="<?php if($data['customer']->type == 'temporary'){ ?>
                        {{  $data['customer']->driver_comission }}
                     <?php }else{ ?>
                        {{ $data['customer_rate_card']->driver_comission }}
                    <?php  } ?>" required>
                </div>
            </div>
            <div class="col-12">
                <div class="text-center">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $( document ).ready(function() {
        var sub_contractor_vehicle = <?php echo json_encode($data['sub_contractor_vehicle']); ?>;
        var vehicle = <?php echo json_encode($data['vehicle']); ?>;
        var trailer = <?php echo json_encode($data['trailer']); ?>;



        setTimeout(
        function() 
        {
            $('#select_sub_contractor').on('change', function() {
                $("#select_vehicle").empty();
                sub_contractor_vehicle.forEach(
                    (element) => {
                        if(this.value == element.id){
                            var o = new Option("Vehicle Number: "+element.vehicle_number, element.id);
                            $("#select_vehicle").append(o);
                        }
                });
            });
        }, 500);

        $( "#select_vehicle" ).change(function() 
        {
           var  driver_id = null;
           var  trailer_id = null;
            vehicle.forEach(
                (element) => {
                    console.log(element);

                    if(this.value == element.id){
                        console.log(this.value);

                        driver_id = element.driver_id;
                        trailer_id = element.trailer_id;
                        trailer.forEach(
                            (trailer1) => {
                                if(trailer_id == trailer1.id){
                                    $('#trailer_number').val('');
                                    $('#trailer_number').val(trailer1.chassis_number);
                                    $('#trailer_id').val(trailer1.id);

                                }
                        });
                    }
            });
            $.ajax({
                    url: "{{ route('admin.vehicle.get_vehicle_driver') }}",
                    type: 'GET',
                    data: { id: $(this).val(),
                            driver:  driver_id},
                    success: function(data)
                    {
                        $('#driver_name').val(data.name);
                        $('#driver_id').val(data.id);

                        $('#mobile_number').val(data.mobile_number);

                    }
            })
        });

    });
</script>