<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Unassign / Vehicle</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/datatables.min.css">
        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/css/style.css">
        @yield('css')
        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/perfect-scrollbar.css">
        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/pickadate/classic.css">
        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/pickadate/classic.date.css">
        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/datatables.min.css">
        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/sweetalert2.min.css">
        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/bootstrap-datepicker.min.css">

        <link rel="stylesheet" href="<?= asset('assets') ?>\styles\vendor\smart.wizard\smart_wizard.min.css">

        <link rel="stylesheet" href="<?= asset('assets') ?>\styles\vendor\smart.wizard\smart_wizard_theme_arrows.min.css">

        <link rel="stylesheet" href="<?= asset('assets') ?>\styles\vendor\smart.wizard\smart_wizard_theme_circles.min.css">

        <link rel="stylesheet" href="<?= asset('assets') ?>\styles\vendor\smart.wizard\smart_wizard_theme_dots.min.css">

        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/toastr.css">

        <link rel="stylesheet" href="<?= asset('assets') ?>/styles/vendor/select2-bootstrap.min.css">
        <link rel="stylesheet" href="<?= asset('assets') ?>/fonts/fontawesome/css/all.min.css">

        
        
        <!-- <script src="<?= asset('assets') ?>/js/vendor/sweetalert2.js"></script> -->
        
        <script src="<?= asset('assets') ?>/js/vendor/sweetalert2.min.js"></script>
            <script src="<?= asset('assets') ?>/js/vendor/jquery-3.3.1.min.js"></script>
            
        <script src="<?= asset('assets') ?>/js/vendor/bootstrap.bundle.min.js"></script>
        
        <link rel="stylesheet" href="<?= asset('assets') ?>/include/jquery_ui/themes/start/jquery-ui.min.css">
        <!-- <script src="<?= asset('assets') ?>/include/jquery/jquery-1.12.4.min.js"></script> -->
        <script src="<?= asset('assets') ?>/include/jquery_ui/jquery-ui.min.js"></script>

        <script src="<?= asset('assets') ?>/js/vendor/jquery.mask.min.js"></script>
        <script src="<?= asset('assets') ?>\js\vendor\jquery.smartWizard.min.js"></script>
        <link rel="stylesheet" href="<?= asset('assets') ?>/js/vendor/tags/bootstrap_tagsinput.css">
        

        <script src="<?= asset('assets') ?>/js/vendor/tags/bootstrap_tagsinput.js"></script>
            <!-- Select2 CSS --> 
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> 

        <!-- jQuery <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>  -->

        <!-- Select2 JS --> 
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <style>
            .label{
                font-size:15px;
            }
        </style>
    </head>
    <body>
        <div class="container m-5">
            <h2>Unassign Vehicle/Trailer</h2>
            <div class="text-center">
                <form action="{{ route('admin.vehicle.unassign_vehicle_save') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="assign_id" value="{{ $data['assign_vehicle']->id }}" class="d-none">
                    <div class=" col-md-12 col-12">
                        <div class="form-group">
                            <label>Upload Submission Form</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Upload </span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input"   name="submission_form" required>
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
                                    <input type="file" class="custom-file-input"   name="unassign_vehicle_interior_photo" required>
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
                                    <input type="file" class="custom-file-input"   name="unassign_vehicle_exterior_photo" required>
                                    <label class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4>Check Recived Equipment </h4>
                    <div class="row" id="equipment_detail">
                        @if($data['vehicle']->medical_kit == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="medical_kit" id="medical_kit">
                                <label class="form-check-label" for="medical_kit">
                                    <p class="label">Medical Kit</p> 
                                </label>
                            </div>
                        </div>
                        @endif

                        @if($data['vehicle']->fire_ext == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="fire_ext" id="fire_ext">
                                <label class="form-check-label" for="fire_ext">
                                    <p class="label">Fire Extinguisher</p> 
                                </label>
                            </div>
                        </div>
                        @endif

                        @if($data['vehicle']->jack == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="jack" id="jack">
                                <label class="form-check-label" for="jack">
                                    <p class="label">Jack</p> 
                                </label>
                            </div>
                        </div>
                        @endif

                        <!-- Spare wheel -->

                        @if($data['vehicle']->extra_emergency_light == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="extra_emergency_light" id="extra_emergency_light">
                                <label class="form-check-label" for="extra_emergency_light">
                                    <p class="label">Extra Emergency light</p> 
                                </label>
                            </div>
                        </div>
                        @endif

                        @if($data['vehicle']->safety_shoes == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="safety_shoes" id="safety_shoes">
                                <label class="form-check-label" for="safety_shoes">
                                    <p class="label">Safety Shoes</p> 
                                </label>
                            </div>
                        </div>
                        @endif

                        @if($data['vehicle']->safety_helmet == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="safety_helmet" id="safety_helmet">
                                <label class="form-check-label" for="safety_helmet">
                                    <p class="label">Safety Helemt</p> 
                                </label>
                            </div>
                        </div>
                        @endif

                        @if($data['vehicle']->safety_gloves == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="safety_gloves" id="safety_gloves">
                                <label class="form-check-label" for="safety_gloves">
                                    <p class="label">Safety Gloves</p> 
                                </label>
                            </div>
                        </div>
                        @endif

                        @if($data['vehicle']->safety_jacket == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="safety_jacket" id="safety_jacket">
                                <label class="form-check-label" for="safety_jacket">
                                    <p class="label">Safety Jacket</p> 
                                </label>
                            </div>
                        </div>
                        @endif

                        @if($data['vehicle']->safety_ear_plug == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="safety_ear_plug" id="safety_ear_plug">
                                <label class="form-check-label" for="safety_ear_plug">
                                    <p class="label">Safety Ear Plug</p> 
                                </label>
                            </div>
                        </div>
                        @endif

                        @if($data['vehicle']->lashing_belt == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="lashing_belt" id="lashing_belt">
                                <label class="form-check-label" for="lashing_belt">
                                    <p class="label">Lashing Belt</p> 
                                </label>
                            </div>
                        </div>
                        @endif

                        @if($data['vehicle']->lashing_chain == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="lashing_chain" id="lashing_chain">
                                <label class="form-check-label" for="lashing_chain">
                                    <p class="label">Lashing Chain</p> 
                                </label>
                            </div>
                        </div>
                        @endif

                        @if($data['vehicle']->side_grill == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="side_grill" id="side_grill">
                                <label class="form-check-label" for="side_grill">
                                    <p class="label">Side Grill</p> 
                                </label>
                            </div>
                        </div>
                        @endif

                        @if($data['vehicle']->container_lock == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="container_lock" id="container_lock">
                                <label class="form-check-label" for="container_lock">
                                    <p class="label">Container Lock</p> 
                                </label>
                            </div>
                        </div>
                        @endif

                        @if($data['vehicle']->rope_seal == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="rope_seal" id="rope_seal">
                                <label class="form-check-label" for="rope_seal">
                                    <p class="label">Rope Seal</p> 
                                </label>
                            </div>
                        </div>
                        @endif

                        @if($data['vehicle']->lashing_angle == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="lashing_angle" id="lashing_angle">
                                <label class="form-check-label" for="lashing_angle">
                                    <p class="label">Lashing Angle</p> 
                                </label>
                            </div>
                        </div>
                        @endif

                        @if($data['vehicle']->tarpaulin == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tarpaulin" id="tarpaulin">
                                <label class="form-check-label" for="tarpaulin">
                                    <p class="label">Tarpaulin</p> 
                                </label>
                            </div>
                        </div>
                        @endif

                        @if($data['vehicle']->tail_lift == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="tail_lift" id="tail_lift">
                                <label class="form-check-label" for="tail_lift">
                                    <p class="label">Tail Lift</p> 
                                </label>
                            </div>
                        </div>
                        @endif

                        @if($data['vehicle']->trolly == '1')
                        <div class="form-group col-md-6 col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="trolly" id="trolly">
                                <label class="form-check-label" for="trolly">
                                    <p class="label">Trolly</p> 
                                </label>
                            </div>
                        </div>
                        @endif


                        
                        
                    </div>
                    <div class="text-center mt-5">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <script>
                var url = "<?= asset('assets') ?>/images";
                var base_url = "<?= url('/') ?>";
            </script>
            <script src="<?= asset('assets') ?>/js/vendor/jquery.mask.min.js"></script>
        

            <script src="<?= asset('assets') ?>/js/jquery.fileDownload.js"></script>

            <script src="<?= asset('assets') ?>/js/vendor/perfect-scrollbar.min.js"></script>
            <script src="<?= asset('assets') ?>/js/vendor/datatables.min.js"></script>
            <script src="<?= asset('assets') ?>/js/vendor/pickadate/picker.js"></script>
            <script src="<?= asset('assets') ?>/js/vendor/pickadate/picker.date.js"></script>
            <script src="<?= asset('assets') ?>/js/es5/script.min.js"></script>
            <script src="<?= asset('assets') ?>/js/vendor/datatables.min.js"></script>
            <script src="<?= asset('assets') ?>/js/vendor/toastr.min.js"></script>
            <script src="<?= asset('assets') ?>/js/vendor/dropzone.min.js"></script>
            <script src="<?= asset('assets') ?>/js/vendor/bootstrap-datepicker.min.js"></script>
            <script src="<?= asset('assets') ?>/js/scripts.js"></script>
            <script src="<?= asset('assets') ?>\js\sidebar.script.js"></script>
            <script>
                $(document).ready(function() {
                    $("#Material_Data").select2({
                        tags: true
                    });
                });

                $(document).ready(function() {
                    $(".Tyre_Serial_Nummber").select2({
                        tags: true
                    });
                });
            </script>
    </body>
</html>