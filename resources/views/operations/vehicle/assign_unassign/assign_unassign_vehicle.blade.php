
<?php 
use App\Models\account_cheque;
?>
<style>
    /* Style the tab */
.tab {
  /* overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1; */
  margin-bottom: 20px;
}

.badge{
  font-size: 12px;
}

/* Style the buttons inside the tab */
.tab button {
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 14px;
    border-radius: 9px;
    margin-right: 26px;
    background-color: #ddd;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #08c;
    color: #fff;
}

/* Style the tab content */
.tabcontent {
  display: none;
  /* padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none; */
}

._dot {
    width: 5px;
    height: 5px;
    background-color: #fff;
    border-radius: 50%;
}
._inline-dot {
    display: inline-block;
}
</style>

<div class="tab" >
    
  <!-- <a href="{{ route('user.account.paid_purchase') }}">
    <button class="tablinks active" onclick="openCity(event, 'approved')"> Assign / Unassign Vehicle </button>
  </a> -->
  
  <!-- <button class="tablinks">Assign/Unassign Trailer</button> -->
  <!-- <button class="tablinks">History/Detail</button> -->

</div>

<div class="container">
    <div class="d-flex mt-3 mb-3" style="justify-content: space-between;">
        <div>
            <a href="{{ route( 'user.operations') }}">
                <img  src="<?= asset('assets') ?>/images/back-button.png" alt="" width="30">
            </a>

            <a href="#" class="ml-3" data-toggle="modal" data-target="#assign_vehicle_driver">
                <button class="btn btn-primary">
                    <img  src="<?= asset('assets') ?>/images/success-check-mark.png" alt="" width="20" class="mr-2">    
                    Assign Vehicle to Driver
                </button>
                
            </a>
            
    </div>
    <div class=""> 
            
            
    </div>

        
    </div>
    <div class="table-responsive">
        <table class="display table  nowrap  " style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Vehicle Number </th>
                    <th>Trailer Chassis Number</th>
                    <th>Driver Name</th>
                    <th>Status</th>
                    <th>Assign Date</th>
                    <th>Unassign Date</th>
                    <th>Edited At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['assign_vehicle'] as $assign_vehicle)
                @if($assign_vehicle->row_status != 'deleted')
                <tr> 
                    <td>{{ $assign_vehicle->id }}</td>
                    <td>
                        @foreach($data['vehicle'] as $vehicle)
                            @if($vehicle->id == $assign_vehicle->vehicle_id)
                                {{ $vehicle->vehicle_number }}
                            @else
                                
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($data['vehicle'] as $vehicle)
                            @if($vehicle->id == $assign_vehicle->trailer_id)
                                {{ $vehicle->chassis_number }}
                            @else
                                
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($data['driver'] as $driver)
                            @if($driver->id == $assign_vehicle->driver_id)
                                {{ $driver->name }}
                            @else
                               
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if($assign_vehicle->vehicle_status == 'assigned')
                        <span class="badge badge-pill badge-success">{{ $assign_vehicle->vehicle_status }}</span>
                        @else($assign_vehicle->vehicle_status == 'unassigned')
                        <span class="badge badge-pill badge-danger">{{ $assign_vehicle->vehicle_status }}</span>

                        @endif
                    </td>
                    <td> <span class="badge badge-pill badge-success"></span> {{ $assign_vehicle->assign_date }}</td>
                    <td>{{ $assign_vehicle->unassign_date }}</td>
                    <td>{{ $assign_vehicle->updated_at }}
                    
                    </td>


                    <td>
                        <form action="{{ route( 'user.operations.view_assigned_unassigned_vehicle') }}" method="post" class="d-inline">
                            @csrf
                            <input type="text" class="form-control d-none" name="id" value ="{{ $assign_vehicle->id }}" placeholder="Enter id" >
                            <button type="submit" class="border-0 .bg-white">
                                    <img src="<?= asset('assets') ?>/images/eye_icon.png" alt="" title="View" width="34">
                            </button>
                        </form>
                        <a   >
                           
                        </a>
                        <a href="#" id="{{  $assign_vehicle->id }}" class="delete-file">
                            <img src="<?= asset('assets') ?>/images/delete_icon.png" alt="" title="Delete" width="34">
                        </a>
                        <button class="btn bg-white _r_btn border-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="_dot _inline-dot bg-primary"></span><span class="_dot _inline-dot bg-primary"></span><span class="_dot _inline-dot bg-primary"></span></button>
                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(645px, 144px, 0px);">
                            @if($assign_vehicle->trailer_id == '' )
                            <a class="dropdown-item ul-widget__link--font add_trailer" vehicle_id = "{{  $assign_vehicle->vehicle_id }}" id ="{{  $assign_vehicle->id  }}"  data-toggle="modal" data-target="#add_trailer" href="#">
                                <i class="i-Data-Save"> </i>
                                Assign Trailer
                            </a>
                            @endif

                            @if($assign_vehicle->vehicle_status == 'assigned' && $assign_vehicle->trailer_id !='')
                            <a href="{{ route('user.operations.unassign_vehicle',['assign_id'=>$assign_vehicle->id ]) }}" class="dropdown-item ul-widget__link--font unassign_vehicle"  vehicle_id = "{{  $assign_vehicle->vehicle_id }}" id ="{{  $assign_vehicle->id  }}"  onclick="window.open(this.href,'targetWindow',
                                                                `toolbar=no,
                                                                    location=no,
                                                                    status=no,
                                                                    menubar=no,
                                                                    scrollbars=yes,
                                                                    resizable=yes,
                                                                    width=1060,
                                                                    height=600`);
                                return false;">
                                <i class="i-Data-Save"> </i>
                                Unassign Vehicle/Trailer
                            </a>

                            
                            @endif
                            
                        </div>
                        

                    </td>
                    
                    
                </tr>
                @endif
                @endforeach
            </tbody>         
        </table>
        <form action="{{ route('user.operations.assign_vehicle_save') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="assign_vehicle_driver" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Assign Driver</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 form-group mb-3">
                                    <label for=" ">Select Vehicle</label>
                                    <select name="vehicle_id" class="form-control" id="vehicle_assign" placeholder="" required>
                                        @foreach($data['vehicle'] as $vehicle)
                                        @if($vehicle->registration_type == 'vehicle' && $vehicle->vehicle_status == 'not_assigned' 
                                        && $vehicle->row_status != 'deleted')
                                        <option value="{{ $vehicle->id }}"> Vehicle Number :  {{ $vehicle->vehicle_number }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label for=" ">Select Driver</label>
                                    <select name="driver_id" class="form-control" required>
                                        @foreach($data['driver'] as $driver)
                                        @if($driver->employee_status == 'not_assigned')
                                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class=" col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Upload Handover Form</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >Upload </span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"   name="handover_form" required>
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class=" col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Upload Vehicle Interior Photo</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >Upload </span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"   name="interior_photo" required>
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Upload Vehicle Exterior Photo</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >Upload </span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"   name="exterior_photo" required>
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-12 col-12">
                                    <a data-toggle="modal" href="#equipment_list" class="btn btn-primary">Select Equipment</a>
                                </div>
                            </div>    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Assign</button>
                        </div>
                </div>
            </div>
        </div>

        <div class="modal fade rotate" id="equipment_list"  data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Equipment List</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Medical Kit</label>

                                    @if($data['equipment']['medical_kit'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['medical_kit'] }} </div> 
                                    @endif
                                </div>
                                <select name="medical_kit" id="medical_kit" class="form-control" >
                                        <option value="0">Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12 medical_kit_expiry">
                                <label for="medical-kit-expiry">Medical Kit Expiry Date</label>
                                <input type="date" name="medical_kit_expiry" id="medical_kit_expiry" class="form-control" >
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Fire Extinguisher</label>
                                    @if($data['equipment']['fire_extinguisher'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['fire_extinguisher'] }} </div> 
                                    @endif
                                </div>
                                <select name="fire_ext" id="fire_ext" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12 fire_ext_weight">
                                <label for="fire-ext-weight">Fire Extinguisher Weight</label>
                                <input type="text" name="fire_ext_weight" id="fire_ext_weight" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-12 col-12 fire_ext_expiry">
                                <label for="fire-ext-expiry">Fire Extinguisher Expiry Date</label>
                                <input type="date" name="fire_ext_expiry"  id="fire_ext_expiry" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Jack</label>

                                    @if($data['equipment']['jack'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['jack'] }} </div> 
                                    @endif
                                </div>
                                <select name="jack" id="jack" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1">No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label >Spare Wheel</label>
                                
                                <select name="spare_wheel" id="spare_wheel" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12 spare_wheel_quantity">
                                <label for="spare-wheel-quantity">Spare Wheel Quantity</label>
                                <input type="text" name="spare_wheel_quantity" id= "spare_wheel_quantity" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-12 col-12 spare_wheel_size">
                                <label for="spare-wheel-size">Spare Wheel Size</label>
                                <input type="text"  name="spare_wheel_size" id="spare_wheel_size" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Safety Triangle</label>

                                    @if($data['equipment']['safety_triangle'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['safety_triangle'] }} </div> 
                                    @endif
                                </div>
                                <select name="safety_triangle" id="safety_triangle" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Extra Emergency Light</label>

                                    @if($data['equipment']['emergency_light'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['emergency_light'] }} </div> 
                                    @endif
                                </div>
                                <select name="extra_emergency_light" id="extra_emergency_light" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Safety Shoes</label>

                                    @if($data['equipment']['safety_shoes'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['safety_shoes'] }} </div> 
                                    @endif
                                </div>
                                <select name="safety_shoes" id="safety_shoes" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Safety Helemt</label>


                                    @if($data['equipment']['safety_helemt'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['safety_helemt'] }} </div> 
                                    @endif
                                </div>
                                <select name="safety_helmet" id="safety_helmet" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Safety Gloves</label>


                                    @if($data['equipment']['safety_gloves'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['safety_gloves'] }} </div> 
                                    @endif
                                </div>
                                <select name="safety_gloves" id="safety_gloves" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Safety Jacket</label>



                                    @if($data['equipment']['safety_jacket'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['safety_jacket'] }} </div> 
                                    @endif
                                </div>
                                <select name="safety_jacket" id="safety_jacket" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Safety Ear Plug</label>



                                    @if($data['equipment']['safety_ear_plug'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['safety_ear_plug'] }} </div> 
                                    @endif
                                </div>
                                <select name="safety_ear_plug" id="safety_ear_plug" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Lashing Belt</label>



                                    @if($data['equipment']['lashing_belt_long'] >-1 || $data['equipment']['lashing_belt_short'] >-1)
                                        <div class="edit-badge"> Inventory (Long) </div> 
                                        <div class="old-value"> {{ $data['equipment']['lashing_belt_long'] }} </div> 

                                        <div class="edit-badge"> Inventory (Short) </div> 
                                        <div class="old-value"> {{ $data['equipment']['lashing_belt_short'] }} </div>
                                    @endif
                                </div>
                                <select name="lashing_belt" id="lashing_belt" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12 lashing_belt_quantity_long">
                                <label for="lashing-belt-quantity-long">Lashing Belt Quantity (Long)</label>
                                <input type="text" name="lashing_belt_quantity_long" id="lashing_belt_quantity_long" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-12 col-12 lashing_belt_quantity_short">
                                <label for="lashing-belt-quantity-short">Lashing Belt Quantity (Short)</label>
                                <input type="text" name="lashing_belt_quantity_short" id="lashing_belt_quantity_short" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Lashing Chain</label>

                                    @if($data['equipment']['lashing_chain'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['lashing_chain'] }} </div> 
                                    @endif
                                </div>
                                <select name="lashing_chain" id="lashing_chain" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12 lashing_chain_quantity">
                                <div class="d-flex">
                                    <label for="lashing-chain-quantity">Lashing Chain Quantity</label>
                                </div>
                                <input type="text" id="lashing_chain_quantity" name="lashing_chain_quantity" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Side Grill</label>


                                    @if($data['equipment']['side_grill'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['side_grill'] }} </div> 
                                    @endif
                                </div>
                                <select name="side_grill" id="side_grill" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12 side_grill_quantity">
                                <label for="side-grill-quantity">Side Grill Quantity</label>
                                <input type="text" id= "side_grill_quantity" name="side_grill_quantity" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-12 col-12 side_grill_height">
                                <label for="side-grill-height">Side Grill Height</label>
                                <input type="text" name="side_grill_height" id="side_grill_height" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Container Lock</label>

                                    @if($data['equipment']['container_lock'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['container_lock'] }} </div> 
                                    @endif
                                </div>
                                <select name="container_lock" id="container_lock" class="form-control" >
                                        <option value="0">Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Rope Seal</label>

                                    @if($data['equipment']['rope_seal'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['rope_seal'] }} </div> 
                                    @endif
                                </div>
                                <select name="rope_seal" id="rope_seal" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Lashing Angle</label>

                                    @if($data['equipment']['lashing_angle'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['lashing_angle'] }} </div> 
                                    @endif
                                </div>
                                <select name="lashing_angle" id="lashing_angle" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12 lashing_angle_quantity">
                                <label for="lashing-angle-quantity">Lashing Angle Quantity</label>
                                <input type="text" name="lashing_angle_quantity" id="lashing_angle_quantity" class="form-control"placeholder="">
                            </div>
                            <div class="form-group col-md-12 col-12 lashing_angle_size">
                                <label for="lashing-angle-size">Lashing Angle Size</label>
                                <input type="text" name="lashing_angle_size" id="lashing_angle_size" class="form-control" placeholder="">
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Tarpaulin</label>

                                    @if($data['equipment']['tarpaulin'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['tarpaulin'] }} </div> 
                                    @endif
                                </div>
                                <select name="tarpaulin" id="tarpaulin" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12 tarpaulin_type">
                                <label for="tarpaulin-type">Tarpaulin Type</label>
                                <input type="text" name="tarpaulin_type"  id="tarpaulin_type"class="form-control" >
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <div class="d-flex">
                                    <label >Tail Lift</label>

                                    @if($data['equipment']['tail_lift'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['tail_lift'] }} </div> 
                                    @endif
                                </div>
                                <select name="tail_lift" id="tail_lift" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 col-12">
                            <div class="d-flex">
                                    <label >Trolly</label>

                                    @if($data['equipment']['trolly'] >-1)
                                        <div class="edit-badge"> Inventory </div> 
                                        <div class="old-value"> {{ $data['equipment']['trolly'] }} </div> 
                                    @endif
                                </div>
                                <select name="trolly" id="trolly" class="form-control" >
                                        <option value="0" >Yes</option>
                                        <option value="1" >No</option>
                                </select>
                            </div>  
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Save List</button>
                            <!-- <button type="submit" class="btn btn-primary">Save List</button> -->
                        </div>
                </div>
            </div>
        </div>
        </form>
        
        <div class="modal fade" id="add_trailer"  data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('user.operations.assign_trailer_save') }}" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Asssign Trailer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <input type="number" name="assign_id"  id="assign_id" class="d-none">
                                <input type="number" name="vehicle_id"  id="vehicle_id" class="d-none">
                                @csrf
                            
                                <div class="col-md-12 form-group mb-3">
                                    <label for=" ">Select Trailer</label>
                                    <select name="trailer_id" class="form-control" >
                                         @foreach($data['vehicle'] as $vehicle)
                                        @if($vehicle->registration_type == 'trailer' && $vehicle->vehicle_id == '' 
                                        && $vehicle->row_status != 'deleted')
                                        <option value="{{ $vehicle->id }}"> Chassis Number :  {{ $vehicle->chassis_number }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class=" col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Trailer Front Photo</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >Upload </span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"   name="assign_trailer_front_photo" required>
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Trailer Back Photo</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >Upload </span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"   name="assign_trailer_back_photo" required>
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Trailer Left Photo</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >Upload </span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"   name="assign_trailer_left_photo" required>
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class=" col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Trailer Right Photo</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" >Upload </span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input"   name="assign_trailer_right_photo" required>
                                                <label class="custom-file-label">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>    
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Assign Trailer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        

        

    </div>
</div>



<script defer>
    $(document).ready(function() {

        $('.table').DataTable( {
                dom: 'Bfrtip',
                
                // responsive: true,
                buttons: [
                
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            } );

        $('.delete-file').click(function () {
            var file_id = this.id;
            swal({
                title: 'Are you sure?',
                text: "You want to delete this Data.",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',  
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.ajax({
                    type:'POST',
                    url:"{{ route( 'user.operations.delete_assign_unassign_vehicle') }}",
                    data:{id:file_id, _token :"{{ csrf_token() }}"},
                    success:function(data){
                            if (data.status == 1) {
                                swal({
                                    title: "Deleted!",
                                    text: "Data has been moved to trash.",
                                    type: "success"
                                }).then(function () {
                                    window.location.href = '';
                                });
                            }else{
                                toastr.error("Some thing went wrong. ");

                            }
                    }
                });
            

            })
        });

        $( "#vehicle_assign" ).change(function() {
            $.ajax({
                    url: "{{ route('user.operations.get_vehicle') }}",
                    type: 'GET',
                    data: { id: $(this).val() },
                    success: function(data)
                    {
                        if(data.medical_kit != 1){
                            @if($data['equipment']['medical_kit'] <1)
                                $('#medical_kit option[value="0"]').attr("disabled", true);


                            @endif
                            $('#medical_kit option[value="1"]').prop('selected', true);

                        }else if(data.medical_kit == 1){

                            $('#medical_kit option[value="0"]').prop('selected', true);
                            $('#Medical_Kit_Expiry_Date').val(data.medical_kit_expiry);

                        }

                        //fire_ext
                        if(data.fire_ext != 1){
                            @if($data['equipment']['fire_extinguisher'] < 1 )
                                $('#fire_ext option[value="0"]').attr("disabled", true);

                            @endif
                            $('#fire_ext option[value="1"]').prop('selected', true);

                        }else if(data.fire_ext == 1){

                            $('#fire_ext option[value="0"]').prop('selected', true);
                            $('#fire_ext_weight').val(data.fire_ext_weight);
                            $('#fire_ext_expiry').val(data.fire_ext_expiry);

                        }

                        //jack
                        if(data.jack != 1){
                            @if($data['equipment']['jack'] < 1 )
                                $('#jack option[value="0"]').attr("disabled", true);

                            @endif

                            $('#jack option[value="1"]').prop('selected', true);

                        }else if(data.jack == 1){

                            $('#jack option[value="0"]').prop('selected', true);
                        }

                        // //Spare Wheel
                        // if(data.spare_wheel != 1){
                        //     @if($data['equipment']['jack'] < 1 )
                        //         $('#spare_wheel option[value="0"]').attr("disabled", true);
                        //     @endif
                        // }else if(data.spare_wheel == 1){

                        //     $('#spare_wheel option[value="0"]').prop('selected', true);
                        //     $('#spare_wheel_quantity').val(data.spare_wheel_quantity);
                        //     $('#spare_wheel_size').val(data.spare_wheel_size);
                        // }

                        //safety_triangle
                        if(data.safety_triangle != 1){
                            @if($data['equipment']['safety_triangle'] < 1 )
                                $('#safety_triangle option[value="0"]').attr("disabled", true);

                            @endif
                            $('#safety_triangle option[value="1"]').prop('selected', true);

                        }else if(data.safety_triangle == 1){

                            $('#safety_triangle option[value="0"]').prop('selected', true);
                        }

                        //emergency_light
                        if(data.extra_emergency_light != 1){
                            @if($data['equipment']['emergency_light'] < 1 )
                                $('#extra_emergency_light option[value="0"]').attr("disabled", true);

                            @endif
                            $('#extra_emergency_light option[value="1"]').prop('selected', true);

                        }else if(data.extra_emergency_light == 1){

                            $('#extra_emergency_light option[value="0"]').prop('selected', true);
                        }

                        //safety_shoes
                        if(data.safety_shoes != 1){
                            @if($data['equipment']['safety_shoes'] < 1 )
                                $('#safety_shoes option[value="0"]').attr("disabled", true);

                            @endif
                            $('#safety_shoes option[value="1"]').prop('selected', true);

                        }else if(data.safety_shoes == 1){

                            $('#safety_shoes option[value="0"]').prop('selected', true);
                        }

                        //safety_helemt
                        if(data.safety_helmet != 1){
                            @if($data['equipment']['safety_helemt'] < 1 )
                                $('#safety_helmet option[value="0"]').attr("disabled", true);

                            @endif
                            $('#safety_helmet option[value="1"]').prop('selected', true);

                        }else if(data.safety_helmet == 1){

                            $('#safety_helmet option[value="0"]').prop('selected', true);
                        }

                        //safety_gloves
                        if(data.safety_gloves != 1){
                            @if($data['equipment']['safety_gloves'] < 1 )
                                $('#safety_gloves option[value="0"]').attr("disabled", true);

                            @endif
                            $('#safety_gloves option[value="1"]').prop('selected', true);

                        }else if(data.safety_gloves == 1){

                            $('#safety_gloves option[value="0"]').prop('selected', true);
                        }

                        //safety_jacket
                        if(data.safety_jacket != 1){
                            @if($data['equipment']['safety_jacket'] < 1 )
                                $('#safety_jacket option[value="0"]').attr("disabled", true);

                            @endif
                            $('#safety_jacket option[value="1"]').prop('selected', true);

                        }else if(data.safety_jacket == 1){

                            $('#safety_jacket option[value="0"]').prop('selected', true);
                        }

                        //safety_ear_plug
                        if(data.safety_ear_plug != 1){
                            @if($data['equipment']['safety_ear_plug'] < 1 )
                                $('#safety_ear_plug option[value="0"]').attr("disabled", true);

                            @endif
                            $('#safety_ear_plug option[value="1"]').prop('selected', true);

                        }else if(data.safety_ear_plug == 1){

                            $('#safety_ear_plug option[value="0"]').prop('selected', true);
                        }

                        //lashing_belts
                        if(data.lashing_belts != 1){
                            @if($data['equipment']['lashing_belt_long'] < 1  && $data['equipment']['lashing_belt_short'] < 1)
                                $('#lashing_belt option[value="0"]').attr("disabled", true);
                            
                            @endif   
                            $('#lashing_belt option[value="1"]').prop('selected', true);


                            @if($data['equipment']['lashing_belt_long'] < 1 )     
                                $('#lashing_belt_quantity_long').attr("disabled", true);
                                $('#lashing_belt_quantity_long').val(0);

                            @endif
                            @if($data['equipment']['lashing_belt_short'] < 1 )
                                $('#lashing_belt_quantity_short').attr("disabled", true);
                                $('#lashing_belt_quantity_short').val(0);
                            @endif
                        }else {
                                $('#lashing_belt_quantity_long').val(data.lashing_belt_long_quantity);
                                
                                $('#lashing_belt_quantity_short').val(data.lashing_belt_short_quantity);
                                
                        }

                        //lashing_chain
                        if(data.lashing_chain != 1){
                            @if($data['equipment']['lashing_chain'] < 1 )
                                $('#lashing_chain option[value="0"]').attr("disabled", true);

                            @endif
                            $('#lashing_chain option[value="1"]').prop('selected', true);

                        }else if(data.lashing_chain == 1){

                            $('#lashing_chain option[value="0"]').prop('selected', true);
                            $('#lashing_chain_quantity').val(data.lashing_chain_quantity);

                        }

                        //side_grill
                        if(data.side_grill != 1){
                            @if($data['equipment']['side_grill'] < 1 )
                                $('#side_grill option[value="0"]').attr("disabled", true);

                            @endif
                            $('#side_grill option[value="1"]').prop('selected', true);

                        }else if(data.side_grill == 1){

                            $('#side_grill option[value="0"]').prop('selected', true);
                            $('#side_grill_quantity').val(data.side_grill_quantity);
                            $('#side_grill_height').val(data.side_grill_height);

                        }

                        //container_lock
                        if(data.container_lock != 1){
                            @if($data['equipment']['container_lock'] < 1 )
                                $('#container_lock option[value="0"]').attr("disabled", true);

                            @endif
                            $('#container_lock option[value="1"]').prop('selected', true);
                            
                        }else if(data.container_lock == 1){

                            $('#container_lock option[value="0"]').prop('selected', true);
                        }

                        //rope_seal
                        if(data.rope_seal != 1){
                            @if($data['equipment']['rope_seal'] < 1 )
                                $('#rope_seal option[value="0"]').attr("disabled", true);

                            @endif
                            $('#rope_seal option[value="1"]').prop('selected', true);

                        }else if(data.rope_seal == 1){

                            $('#rope_seal option[value="0"]').prop('selected', true);
                        }

                        //lashing_angle
                        if(data.lashing_angle != 1){
                            @if($data['equipment']['lashing_angle'] < 1 )
                                $('#lashing_angle option[value="0"]').attr("disabled", true);

                            @endif
                            $('#lashing_angle option[value="1"]').prop('selected', true);

                        }else if(data.lashing_angle == 1){

                            $('#lashing_angle option[value="0"]').prop('selected', true);
                            $('#lashing_angle_quantity').val(data.lashing_angle_quantity);
                            $('#lashing_angle_size').val(data.lashing_angle_size);
                        }

                        //tarpaulin
                        if(data.tarpaulin != 1){
                            @if($data['equipment']['tarpaulin'] < 1 )
                                $('#tarpaulin option[value="0"]').attr("disabled", true);

                            @endif
                            $('#tarpaulin option[value="1"]').prop('selected', true);
                            
                        }else if(data.tarpaulin == 1){

                            $('#tarpaulin option[value="0"]').prop('selected', true);
                            $('#tarpaulin_type').val(data.tarpaulin_type);
                        }

                        //tail_lift
                        if(data.tail_lift != 1){
                            @if($data['equipment']['tail_lift'] < 1 )
                                $('#tail_lift option[value="0"]').attr("disabled", true);

                            @endif
                            $('#tail_lift option[value="1"]').prop('selected', true);

                        }else if(data.tail_lift == 1){

                            $('#tail_lift option[value="0"]').prop('selected', true);
                        }

                        //trolly
                        if(data.trolly != 1){
                            @if($data['equipment']['trolly'] < 1 )
                                $('#trolly option[value="0"]').attr("disabled", true);

                            @endif
                            $('#trolly option[value="1"]').prop("selected", true);

                        }else if(data.trolly == 1){

                            $('#trolly option[value="0"]').prop('selected', true);
                        }


                    }
                });
        });

        $('.add_trailer').click(function (event) {
            var file_id = this.id;
            console.log(this.id);
            console.log(event.target.getAttribute("vehicle_id"));

            document.getElementById('assign_id').value = this.id;
            document.getElementById('vehicle_id').value = event.target.getAttribute("vehicle_id");


        });

        


        // $('#tarpaulin').trigger("change");

        $('#openBtn').click(() => $('#myModal').modal({
            show: true
        }));

        $(document).on('show.bs.modal', '.modal', function() {
            const zIndex = 1040 + 10 * $('.modal:visible').length;
            $(this).css('z-index', zIndex);
            setTimeout(() => $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack'));
        });

    });


    setTimeout(function(){
        $('#medical_kit').on('change', function()
        {
            if(this.value == '0'){         
                $('.medical_kit_expiry').show();
            }
            else{          
                $('.medical_kit_expiry').val('');
                $('.medical_kit_expiry').hide();
            }
        });
        $('.medical_kit_expiry').hide();


        $('#fire_ext').on('change', function()
        {
            if(this.value == '0'){         
                $('.fire_ext_weight').show();
                $('.fire_ext_expiry').show();
            }
            else{          
                $('.fire_ext_weight').val('');
                $('.fire_ext_weight').hide();
                $('.fire_ext_expiry').val('');
                $('.fire_ext_expiry').hide();
            }
        });

        $('.fire_ext_weight').hide();
        $('.fire_ext_expiry').hide();


        $('#spare_wheel').on('change', function()
        {
            if(this.value == '0'){         
                $('.spare_wheel_quantity').show();
                $('.spare_wheel_size').show();
            }
            else{          
                $('.spare_wheel_quantity').val('');
                $('.spare_wheel_quantity').hide();
                $('.spare_wheel_size').val('');
                $('.spare_wheel_size').hide();
            }
        });

        $('.spare_wheel_quantity').hide();
         $('.spare_wheel_size').hide();

        $('#lashing_belt').on('change', function()
        {
            if(this.value == '0'){         
                $('.lashing_belt_quantity_long').show();
                $('.lashing_belt_quantity_short').show();
            }
            else{          
                $('.lashing_belt_quantity_long').val('');
                $('.lashing_belt_quantity_long').hide();
                $('.lashing_belt_quantity_short').val('');
                $('.lashing_belt_quantity_short').hide();
            }
        });

        $('.lashing_belt_quantity_long').hide();
        $('.lashing_belt_quantity_short').hide();
    

        $('#lashing_chain').on('change', function()
        {
            if(this.value == '0'){         
                $('.lashing_chain_quantity').show();
            }
            else{          
                $('.lashing_chain_quantity').val('');
                $('.lashing_chain_quantity').hide();
            }
        });

        $('.lashing_chain_quantity').hide();



        $('#side_grill').on('change', function()
        {
            if(this.value == '0'){         
                $('.side_grill_quantity').show();
                $('.side_grill_height').show();
            }
            else{          
                $('.side_grill_quantity').val('');
                $('.side_grill_quantity').hide();
                $('.side_grill_height').val('');
                $('.side_grill_height').hide();
            }
        });

        $('.side_grill_quantity').hide();
        $('.side_grill_height').hide();


        $('#lashing_angle').on('change', function()
        {
            if(this.value == '0'){         
                $('.lashing_angle_quantity').show();
                $('.lashing_angle_size').show();
            }
            else{          
                $('.lashing_angle_quantity').val('');
                $('.lashing_angle_quantity').hide();
                $('.lashing_angle_size').val('');
                $('.lashing_angle_size').hide();
            }
        });

        $('.lashing_angle_quantity').hide();
        $('.lashing_angle_size').hide();


        $('#tarpaulin').on('change', function()
        {
            if(this.value == '0'){         
                $('.tarpaulin_type').show();
            }
            else{          
                $('.tarpaulin_type').val('');
                $('.tarpaulin_type').hide();
            }
        });

        $('.tarpaulin_type').hide();
    },500);

</script>