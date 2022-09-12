<?php 
use App\Models\Sub_contractor_info;
use App\Models\Vehicle_truck_type;
use App\Models\Vehicle_pickup_type;

?>
<div class="container mt-3">
    <div class="mb-5">
            <a href="{{route('user.vehicle.register_new_vehicle')}}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
    </div>
    <form action="{{ route('user.vehicle.save_vehicle') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="haired_sub_contractor_vehicle" value="1" class="d-none">

        <div class="row">
            <div class="form-group col-md-6 col-12">
                <label >Sub Contractor ID</label>
                <select name="sub_contractor_id" id="transfer" class="form-control" >
                @foreach(Sub_contractor_info::all() as $sub_contractor_info)
                        <option value="{{ $sub_contractor_info->id }}" >{{ $sub_contractor_info->name }}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group col-md-6 col-12" >
                <label >Registration Type</label>
                <select name="registration_type" id="registration_type" class="form-control" placeholder="" >
                        <option value="vehicle" >Vehicle</option>
                        <option value="trailer">Trailer</option>
                </select>
            </div>

            <div class="form-group col-md-6 col-12 vehicle_number">
                <label for="vehicle-number">Vehicle Number</label>
                <input type="text" name="vehicle_number" class="form-control" >
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="company-name">Company Name</label>
                <input type="text" name="company_name" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12 approx_value">
                <label for="approx-value">Approx. Value</label>
                <input type="text" name="approx_value" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="registration-date">Registration Date</label>
                <input type="date" name="registration_date" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="registration-expiry-date">Registration Expiry Date</label>
                <input type="date" name="registration_exp_date" class="form-control" required>
            </div>
            <div class=" col-md-6 col-12">
                <div class="form-group">
                    <label>Upload Registration</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" >Upload Registration</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"   name="regisration_form" required>
                            <label class="custom-file-label">Choose file</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6 col-12 make">
                <label for="make">Make</label>
                <input type="text" name="make" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12 model">
                <label for="model">Model</label>
                <input type="text" name="model" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12 color">
                <label for="colour">Color</label>
                <input type="text" name="colour" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12 engine_number">
                <label for="engine-number">Engine Number</label>
                <input type="text" name="engine_number" class="form-control" >
            </div>
            <div class="form-group col-md-6 col-12 chassis_number">
                <label for="chassis-number">Chassis Number</label>
                <input type="text" name="chassis_number" class="form-control" >
            </div>
            <div class="form-group col-md-6 col-12 vehicle_type">
                <label >Vehicle Type</label>
                <select name="vehicle_type" id="vehicle_type" class="form-control" >
                        <option value="truck" selected="selected">Truck</option>
                        <option value="pickup">Pickup</option>
                        <option value="car">Car</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 truck_type">
                <label >Truck</label>
                <select name="truck_type" id="truck_type" class="form-control" >
                    <option value="flatbed" >FLATBED</option>
                    <option value="curtain_side">Curtain Side</option>
                    <option value="tripper_2xl">Tipper 2XL</option>
                    <option value="tripper_3xl">Tipper 3XL</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 pickup_weight">
                <label >Pickup (weight)</label>
                <select name="pickup_weight" id="pickup_weight" class="form-control" >
                        <option value="1_tone" >1 Ton</option>
                        <option value="3_tone" >3 Ton</option>
                        <option value="7_tone">7 Ton</option>
                        <option value="10_tone">10 Ton</option>
                        <option value="15_tone">15 Ton</option>

                </select>
            </div>
            <div class="form-group col-md-6 col-12 pickup_shape">
                <label >Pickup (shape)</label>
                <select name="pickup_shape" id="pickup_weight" class="form-control" >
                        <option value="side_grill" >Side Grill</option>
                        <option value="dry_box">Dry Box</option>
                        <option value="chiller">Chiller</option>
                        <option value="freezer">Freezer</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 car_description">
                <label for="car-description">Car Description</label>
                <input type="text" name="car_description" class="form-control" >
            </div>
            <div class="form-group col-md-6 col-12 vehicle_suspension">
                <label >Vehicle  Suspension</label>
                <select name="vehicle_suspension" id="" class="form-control" >
                    <option value="booster" >Booster</option>
                    <option value="kamani">Kamani</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 salik">
                <label >Salik</label>
                <select name="salik" id="" class="form-control" >
                        <option value="0" selected="selected">Yes</option>
                        <option value="1">No</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 trailer_type">
                <label >Trailer Type</label>
                <select name="trailer_type" id="" class="form-control" >
                    <option value="flatbed" >FLATBED</option>
                    <option value="curtain_side">Curtain Side</option>
                    <option value="tripper_2xl">Tipper 2XL</option>
                    <option value="tripper_3xl">Tipper 3XL</option>

                </select>
            </div>
            <div class="form-group col-md-6 col-12 trailer_suspension">
                <label >Trailer  Suspension</label>
                <select name="trailer_suspension" id="" class="form-control" >
                        <option value="booster" >Booster</option>
                        <option value="kamani">Kamani</option>
                </select>
            </div>

            <div class="form-group col-md-6 col-12 size">
                <label for="size">Size(meter/feet)</label>
                <input type="text" name="size" class="form-control" >
            </div>
            <div class="form-group col-md-6 col-12 axle">
                <label >Axle</label>
                <input type="number" name="axle" class="form-control" >

            </div>
            <div class="form-group col-md-6 col-12 ton_capacity">
                <label for="ton-capacity">Maximum Ton Capacity</label>
                <input type="text" name="ton_capacity" class="form-control" >
            </div>
            
            <!-- <div class="form-group col-md-6 col-12 truck_type">
                <div class="row">
                    <div class="form-group col-md-10 col-10 truck_type">
                        <label >Truck Type</label>
                        <select name="truck_type" id="truck_type" class="form-control truck_type_vehicle" >
                        @foreach(Vehicle_truck_type::all() as $truck_type)
                            <option value="{{ $truck_type->id }}"> {{ $truck_type->name }} </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2 col-2 mt-4 truck_type">
                        <button class="btn" data-toggle="modal" data-target="#exampleModal1">Other</button>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6 col-12 pickup_weight">
                <label >Pickup (weight)</label>
                <select name="pickup_weight" id="pickup_weight" class="form-control" >
                        <option value="0" selected="selected">3 Ton</option>
                        <option value="1">7 Ton</option>
                        <option value="2">10 Ton</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 pickup_shape">
                <div class="row">
                    <div class="form-group col-md-10 col-10">
                        <label >Pickup (shape)</label>
                        <select name="pickup_shape" id="pickup_weight" class="form-control pickup_type_vehicle" >
                        @foreach(Vehicle_pickup_type::all() as $pickup_type)
                            <option value="{{ $pickup_type->id }}"> {{ $pickup_type->name }} </option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2 col-2 mt-4">
                        <button class="btn" data-toggle="modal" data-target="#exampleModal2">Other</button>
                    </div>

                </div>
                
            </div>
            <div class="form-group col-md-6 col-12 car_description">
                <label for="car-description">Car Description</label>
                <input type="text" name="car_description" class="form-control" required>
            </div> -->
        </div>

        <div class="text-center mt-5">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
    </form>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" class="vehicle_truck_type">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Truck Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group">
                            <label for="">Truck Type Name</label>
                            <input type="text" name="new_truck_type" class="form-control" required>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                    <input type="submit" class="btn" value="Submit">

                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="post" class="vehicle_pickup_type">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Pickup Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group">
                            <label for="">Truck Pickup Name</label>
                            <input type="text" name="new_pickup_type" class="form-control" required>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                    <input type="submit" class="btn" value="Submit">

                </div>
            </form>
        </div>
    </div>
</div>

<script>
    
    $('#vehicle_type').on('change', function()

    {
        if(this.value == 'truck'){
            $('.truck_type').show();
            $('.pickup_weight').val('');
            $('.pickup_weight').hide();
            $('.pickup_shape').val('');
            $('.pickup_shape').hide();
            $('.car_description').val('');
            $('.car_description').hide();
        }

        if(this.value == 'pickup'){
            $('.pickup_weight').show();
            $('.pickup_shape').show();
            $('.truck_type').val('');
            $('.truck_type').hide();
            $('.car_description').val('');
            $('.car_description').hide();
        }
        if(this.value == 'car'){
            $('.car_description').show();
            $('.pickup_weight').val('');
            $('.pickup_weight').hide();
            $('.pickup_shape').val('');
            $('.pickup_shape').hide();
            $('.truck_type').val('');
            $('.truck_type').hide();
        }
        
    });

    $('#registration_type').on('change', function()
    {
        if(this.value == 'vehicle'){
            $('#equipment_detail').show();
            $('.vehicle_number').show();
            
            $('.engine_number').show();
            $('.vehicle_type').show();
            $('.truck_type').show();
            $('.pickup_weight').show();
            $('.pickup_shape').show();
            $('.car_description').show();
            $('.vehicle_suspension').show();
            $('.salik').show();
            $('.trailer_type').val('');
            $('.trailer_type').hide();
            $('.trailer_suspension').val('');
            $('.trailer_suspension').hide();
            $('.size').val('');
            $('.size').hide();
            $('.axle').val('');
            $('.axle').hide();
            $('.ton_capacity').val('');
            $('.ton_capacity').hide();
            $('.vehicle_insurance').show();
            $('.policy_number').show();
            $('.insurance_expiry').show();
            $('.insurance_form').show();
            $('.other_insurance').show();
            $('.other_insurance_expiry').show();
            $('.other_insurance_form').show();
            $('.other_insurance_description').show();
        }

        if(this.value == 'trailer'){
            $('#equipment_detail').hide();

            $('.vehicle_number').val('');
            $('.vehicle_number').hide();
            
            $('.engine_number').val('');
            $('.engine_number').hide();
            $('.vehicle_type').val('');
            $('.vehicle_type').hide();
            $('.truck_type').val('');
            $('.truck_type').hide();
            $('.pickup_weight').val('');
            $('.pickup_weight').hide();
            $('.pickup_shape').val('');
            $('.pickup_shape').hide();
            $('.car_description').val('');
            $('.car_description').hide();
            $('.vehicle_suspension').val('');
            $('.vehicle_suspension').hide();
            $('.salik').val('');
            $('.salik').hide();
            $('.trailer_type').show();
            $('.trailer_suspension').show();
            $('.size').show();
            $('.axle').show();
            $('.ton_capacity').show();
            $('.vehicle_insurance').val('');
            $('.vehicle_insurance').hide();
            $('.policy_number').val('');
            $('.policy_number').hide();
            $('.insurance_expiry').val('');
            $('.insurance_expiry').hide();
            $('.insurance_form').val('');
            $('.insurance_form').hide();
            $('.other_insurance').val('');
            $('.other_insurance').hide();
            $('.other_insurance_expiry').val('');
            $('.other_insurance_expiry').hide();
            $('.other_insurance_form').val('');
            $('.other_insurance_form').hide();
            $('.other_insurance_description').val('');
            $('.other_insurance_description').hide();
        }
    });


        $('.vehicle_truck_type').on('submit', function (e) {

        e.preventDefault();
        var formData = new FormData($('.vehicle_truck_type')[0]);
        // formData.append('customer_id', id);
        formData.append( '_token' , '{{ csrf_token() }}')
        $.ajax({
                    type: 'post',
                    url: "{{ route( 'user.vehicle.save_vehicle_new_truck_type') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data.status == 1) {
                            // console.log($("#    "));
                            $(".truck_type_vehicle").html(data.row);
                            toastr.success("Truck Type Added Successfully");
                            // window.location.replace("{{ route( 'user.customer') }}");
                        }
                    },
                    error: function (){    
                        alert('Technical Error (contact to web master)');
                    }
                });

        });

        $('.vehicle_pickup_type').on('submit', function (e) {

            e.preventDefault();
            var formData = new FormData($('.vehicle_pickup_type')[0]);
            // formData.append('customer_id', id);
            formData.append( '_token' , '{{ csrf_token() }}')
            $.ajax({
                type: 'post',
                url: "{{ route( 'user.vehicle.save_vehicle_new_pickup_type') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == 1) {
                        // console.log($("#    "));
                        $(".pickup_type_vehicle").html(data.row);
                        toastr.success("Pickup Type Added Successfully");
                        // window.location.replace("{{ route( 'user.customer') }}");
                    }
                },
                error: function (){    
                    alert('Technical Error (contact to web master)');
                }
            });

        });

</script>