<?php 
use App\Models\Sub_contractor_info;
use App\Models\Vehicle_truck_type;
use App\Models\Vehicle_pickup_type;

?>
<div class="container mt-3">
    <div class="mb-5">
            <a href="{{route('admin.vehicle.register_new_vehicle')}}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" title="Back" width="30">
            </a>
    </div>
    <form action="{{ route('admin.vehicle.save_hired_sub_contractor_vehicle') }}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="row">
            <div class="form-group col-md-6 col-12">
                <label >Sub Contractor ID</label>
                <select name="sub_contractor_id" id="transfer" class="form-control" >
                @foreach(Sub_contractor_info::all() as $sub_contractor_info)
                        <option value="{{ $sub_contractor_info->id }}" >{{ $sub_contractor_info->name }}</option>
                @endforeach
                </select>
            </div>

            <div class="form-group col-md-6 col-12">
                <label for="vehicle-number">Vehicle Number</label>
                <input type="text" name="vehicle_number" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="registration-date">Registration Date</label>
                <input type="date" name="registration_date" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="registration-expiry-date">Registration Expiry Date</label>
                <input type="date" name="registration_exp_date" class="form-control" required>
            </div>

            <div class="form-group col-md-6 col-12">
                <label for="make">Make</label>
                <input type="text" name="make" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="model">Model</label>
                <input type="text" name="model" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="colour">Colour</label>
                <input type="text" name="colour" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="engine-number">Engine Number</label>
                <input type="text" name="engine_number" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label for="chassis-number">Chassis Number</label>
                <input type="text" name="chassis_number" class="form-control" required>
            </div>
            <div class="form-group col-md-6 col-12">
                <label >Vehicle Type</label>
                <select name="vehicle_type" id="vehicle_type" class="form-control" >
                        <option value="0" selected="selected">Truck</option>
                        <option value="1">Pickup</option>
                        <option value="2">Car</option>
                </select>
            </div>
            <div class="form-group col-md-6 col-12 truck_type">
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
            </div>
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
            if(this.value == '0'){
                $('.truck_type').show();
                $('.pickup_weight').val('')
                $('.pickup_weight').hide();
                $('.pickup_shape').val('')
                $('.pickup_shape').hide();
                $('.car_description').val('')
                $('.car_description').hide();
            }

            if(this.value == '1'){
                $('.pickup_weight').show();
                $('.pickup_shape').show();
                $('.truck_type').val('')
                $('.truck_type').hide();
                $('.car_description').val('')
                $('.car_description').hide();
            }
            if(this.value == '2'){
                $('.car_description').show();
                $('.pickup_weight').val('')
                $('.pickup_weight').hide();
                $('.pickup_shape').val('')
                $('.pickup_shape').hide();
                $('.truck_type').val('')
                $('.truck_type').hide();
            }
            
        });

        $('.vehicle_truck_type').on('submit', function (e) {

        e.preventDefault();
        var formData = new FormData($('.vehicle_truck_type')[0]);
        // formData.append('customer_id', id);
        formData.append( '_token' , '{{ csrf_token() }}')
        $.ajax({
                    type: 'post',
                    url: "{{ route( 'admin.vehicle.save_vehicle_new_truck_type') }}",
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
                    url: "{{ route( 'admin.vehicle.save_vehicle_new_pickup_type') }}",
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