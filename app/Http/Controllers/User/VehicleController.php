<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\User;
use App\Models\Roles;
use App\Models\Purchase;
use App\Models\Purchase_mertial_data;
use App\Models\Purchase_vehicle;
use App\Models\Purchase_vehicle_edit_history;
use App\Models\Fuel_transfer;
use App\Models\Inventory_spare_parts;
use App\Models\Inventory_spare_parts_entery;
use App\Models\Inventory_spare_parts_entery_history;
use App\Models\Inventory_Tyre;
use App\Models\Inventory_tools_entry;
use App\Models\Inventory_tools;
use App\Models\Inventory_uncategorized;
use App\Models\Inventory_uncategorized_history;

use App\Models\Vehicle_truck_type;
use App\Models\Vehicle_pickup_type;

use App\Models\assign_unassign_vehicle;
use App\Models\assign_unassign_vehicle_history;
use App\Models\Equipment_dispute;

use App\Models\Employee;



use App\Models\vehicle_equipment_list;
use App\Models\vehicle_equipment_list_history;

use App\Models\Trade_license_history;
use App\Models\Permissions;
use App\Models\Login_password;
use App\Models\Modules;
use App\Models\Approvals;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Redirect;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VehicleController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth:user');
    }

    public function history_table($table_name , $action , $user_id, $data_id, $tab_name){
        DB::table($table_name)->insert([
            'action' => $action,
            'date' => date("Y-m-d  H:i:s"),
            'user_id' => $user_id,
            'route_name' => $tab_name,
            'data_id' => $data_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return true;
    }

    public function history_table_type($table_name , $action , $user_id , $type){
        DB::table($table_name)->insert([
            'action' => $action,
            'date' => date("Y-m-d  H:i:s"),
            'user_id' => $user_id,
            'type' => $type,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return true;
    }
    
    public function table_history_clear(Request $request){
        
        if(DB::table($request->input('table_name'))->truncate()){
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'1']);
        }
    }

    public function table_history_type_clear(Request $request){
        // die()
        if(DB::table($request->input('table_name'))->where('type' , '=' , $request->input('type'))->delete()){
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'1']);
        }
    }

    /////////////////////////////////
    ///////// Vehicle /////////
    /////////////////////////////////

    public function vehicle(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);     

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 9)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
        $data['purchases']= DB::table('purchases')->get();
        // $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Vehicle";
        $data['view'] = 'vehicle.vehicle';
        return view('users.layout', ["data"=>$data]);
    }

    public function own_new_vehicle(Request $request){
        if($request->input('vehicle_mode') == 'own_vehicle'){
            $data['vehicle_mode']= 'own_vechicle';
            $data['page_title'] = "Own Vehicle";
        }else{

            $data['vehicle_mode']= 'new_vechicle';
            $data['page_title'] = "New Vehicle";
        }

        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 9)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

       
        $data['view'] = 'vehicle.own_new_vehicle';
        return view('users.layout', ["data"=>$data]);
    }


    ///////////////////////////////////////////////////
    ///////////////// Vehicle - Register New Vehicle ////////////////
    ///////////////////////////////////////////////////

    
    public function register_new_vehicle(){
        $data['modules']= DB::table('modules')->get();

      
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 9)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        

        $data['page_title'] = "Register New Vehcile - Vehicle";
        $data['view'] = 'vehicle.register_new_vehicle.register_new_vehicle';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_own_new_vehicle(Request $request){

        if($request->input('vehicle_mode') == 'own_vehicle'){
            $data['vehicle_mode']= 'own_vechicle';
            $data['page_title'] = "Add Own Vehicle";
        }else{

            $data['vehicle_mode']= 'new_vechicle';
            $data['page_title'] = "Add New Vehicle";
        }

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['purchase_vehicle'] = Purchase_vehicle::all();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 9)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        //equipment
        {
            $data['equipment'] = [];

            //Medical Kit
            $data['equipment']['medical_kit'] = 0;
            $equipment_medical_kit= Inventory_uncategorized::where('product_name' , '=' , 'Medical Kit')->get();
            if(!$equipment_medical_kit->isEmpty()){
                
                foreach($equipment_medical_kit as $medical_kit_quntity){
                   

                    $data['equipment']['medical_kit'] += (int)$medical_kit_quntity->unit;
                } 
            }else{
                $data['equipment']['medical_kit'] = 0;
            }
        
            //Fire Extinguisher 
            $data['equipment']['fire_extinguisher'] = 0;
            $equipment_fire_extinguisher= Inventory_uncategorized::where('product_name' , '=' , 'Fire Extinguisher')->get();
            
            if(!$equipment_fire_extinguisher->isEmpty()){
                
                foreach($equipment_fire_extinguisher as $fire_extinguisher_quntity){
                    $data['equipment']['fire_extinguisher'] += (int)$fire_extinguisher_quntity->unit;
                } 
            }else{
                
                $data['equipment']['fire_extinguisher'] = 0;
            }

            //safety_triangle 
            $data['equipment']['safety_triangle'] = 0;
            $equipment_safety_triangle= Inventory_uncategorized::where('product_name' , '=' , 'Safety Triangle')->get();
            
            if(!$equipment_safety_triangle->isEmpty()){
                
                foreach($equipment_safety_triangle as $equipment_safety_triangle_quntity){
                    $data['equipment']['safety_triangle'] += (int)$equipment_safety_triangle_quntity->unit;
                } 
            }else{
                
                $data['equipment']['safety_triangle'] = 0;
            }

            //Jack 
            $data['equipment']['jack'] = 0;
            $equipment_jack= Inventory_uncategorized::where('product_name' , '=' , 'Jack')->get();
            if(!$equipment_jack->isEmpty()){
                
                foreach($equipment_jack as $jack_quntity){
                    $data['equipment']['jack'] += (int)$jack_quntity->unit;
                } 
            }else{
                $data['equipment']['jack'] = 0;
            }

            //Safety Triangle 
            $data['equipment']['safety_triangle'] = 0;
            $equipment_safety_triangle= Inventory_uncategorized::where('product_name' , '=' , 'Safety Triangle')->get();
            if(!$equipment_safety_triangle->isEmpty()){
                
                foreach($equipment_safety_triangle as $safety_triangle){
                    $data['equipment']['safety_triangle'] += (int)$safety_triangle->unit;
                } 
            }else{
                $data['equipment']['safety_triangle'] = 0;
            }

            //Emergency Light 
            $data['equipment']['emergency_light'] = 0;
            $equipment_emergency_light= Inventory_uncategorized::where('product_name' , '=' , 'Emergency Light')->get();
            if(!$equipment_emergency_light->isEmpty()){
                
                foreach($equipment_emergency_light as $equipment_emergency_light_quntity){
                    $data['equipment']['emergency_light'] += (int)$equipment_emergency_light_quntity->unit;
                } 
            }else{
                $data['equipment']['emergency_light'] = 0;
            }

            //Safety Shoes 
            $data['equipment']['safety_shoes'] = 0;
            $equipment_safety_shoes= Inventory_uncategorized::where('product_name' , '=' , 'Safety Shoes')->get();
            if(!$equipment_safety_shoes->isEmpty()){
                
                foreach($equipment_safety_shoes as $safety_shoes_quntity){
                    $data['equipment']['safety_shoes'] += (int)$safety_shoes_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_shoes'] = 0;
            }

            //Safety Helemt 
            $data['equipment']['safety_helemt'] = 0;
            $equipment_safety_helemt= Inventory_uncategorized::where('product_name' , '=' , 'Safety Helemt')->get();
            if(!$equipment_safety_helemt->isEmpty()){
                
                foreach($equipment_safety_helemt as $equipment_safety_helemt_quntity){
                    $data['equipment']['safety_helemt'] += (int)$equipment_safety_helemt_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_helemt'] = 0;
            }

            //Safety Gloves 
            $data['equipment']['safety_gloves'] = 0;
            $equipment_safety_gloves= Inventory_uncategorized::where('product_name' , '=' , 'Safety Gloves')->get();
            if(!$equipment_safety_gloves->isEmpty()){
                
                foreach($equipment_safety_gloves as $equipment_safety_gloves_quntity){
                    $data['equipment']['safety_gloves'] += (int)$equipment_safety_gloves_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_gloves'] = 0;
            }

            //Safety Jacket 
            $data['equipment']['safety_jacket'] = 0;
            $equipment_safety_jacket= Inventory_uncategorized::where('product_name' , '=' , 'Safety Jacket')->get();
            if(!$equipment_safety_jacket->isEmpty()){
                
                foreach($equipment_safety_jacket as $equipment_safety_jacket_quntity){
                    $data['equipment']['safety_jacket'] += (int)$equipment_safety_jacket_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_jacket'] = 0;
            }

            //Safety Ear Plug 
            $data['equipment']['safety_ear_plug'] = 0;
            $equipment_safety_ear_plug= Inventory_uncategorized::where('product_name' , '=' , 'Safety Ear Plug')->get();
            if(!$equipment_safety_ear_plug->isEmpty()){
                
                foreach($equipment_safety_ear_plug as $equipment_safety_ear_plug_quntity){
                    $data['equipment']['safety_ear_plug'] += (int)$equipment_safety_ear_plug_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_ear_plug'] = 0;
            }

            //Lashing Belt 
            $data['equipment']['lashing_belt_long'] = 0;
            $equipment_lashing_belt_long= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Belt Long')->get();
            if(!$equipment_lashing_belt_long->isEmpty()){
                
                foreach($equipment_lashing_belt_long as $equipment_lashing_belt_long_quntity){
                    $data['equipment']['lashing_belt_long'] += (int)$equipment_lashing_belt_long_quntity->unit;
                } 
            }else{
                $data['equipment']['lashing_belt_long'] = 0;
            }

            $data['equipment']['lashing_belt_short'] = 0;
            $equipment_lashing_belt_short= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Belt Short')->get();
            if(!$equipment_lashing_belt_short->isEmpty()){
                
                foreach($equipment_lashing_belt_short as $equipment_lashing_belt_short_quntity){
                    $data['equipment']['lashing_belt_short'] += (int)$equipment_lashing_belt_short_quntity->unit;
                } 
            }else{
                $data['equipment']['lashing_belt_short'] = 0;
            }

            //Lashing Chain 
            $data['equipment']['lashing_chain'] = 0;
            $equipment_lashing_chain= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Chain')->get();
            if(!$equipment_lashing_chain->isEmpty()){
                
                foreach($equipment_lashing_chain as $equipment_lashing_chain_quntity){
                    $data['equipment']['lashing_chain'] += (int)$equipment_lashing_chain_quntity->unit;
                } 
            }else{
                $data['equipment']['lashing_chain'] = 0;
            }

            //Side _Grill 
            $data['equipment']['side_grill'] = 0;
            $equipment_side_grill= Inventory_uncategorized::where('product_name' , '=' , 'Side Grill')->get();
            if(!$equipment_side_grill->isEmpty()){
                
                foreach($equipment_side_grill as $equipment_side_grill_quntity){
                    $data['equipment']['side_grill'] += (int)$equipment_side_grill_quntity->unit;
                } 
            }else{
                $data['equipment']['side_grill'] = 0;
            }

            //Container Lock 
            $data['equipment']['container_lock'] = 0;
            $equipment_container_lock= Inventory_uncategorized::where('product_name' , '=' , 'Container Lock')->get();
            if(!$equipment_container_lock->isEmpty()){
                
                foreach($equipment_container_lock as $equipment_container_lock_quntity){
                    $data['equipment']['container_lock'] += (int)$equipment_container_lock_quntity->unit;
                } 
            }else{
                $data['equipment']['container_lock'] = 0;
            }

            //Rope Seal 
            $data['equipment']['rope_seal'] = 0;
            $equipment_rope_seal= Inventory_uncategorized::where('product_name' , '=' , 'Rope Seal')->get();
            if(!$equipment_rope_seal->isEmpty()){
                
                foreach($equipment_rope_seal as $equipment_rope_seal_quntity){
                    $data['equipment']['rope_seal'] += (int)$equipment_rope_seal_quntity->unit;
                } 
            }else{
                $data['equipment']['rope_seal'] = 0;
            }

            //lashing_angle 
            $data['equipment']['lashing_angle'] = 0;
            $equipment_lashing_angle= Inventory_uncategorized::where('product_name' , '=' , 'Rope Seal')->get();
            if(!$equipment_lashing_angle->isEmpty()){
                
                foreach($equipment_lashing_angle as $equipment_lashing_angle_quntity){
                    $data['equipment']['lashing_angle'] += (int)$equipment_lashing_angle_quntity->unit;
                } 
            }else{
                $data['equipment']['lashing_angle'] = 0;
            }

            //Tarpaulin 
            $data['equipment']['tarpaulin'] = 0;
            $equipment_tarpaulin= Inventory_uncategorized::where('product_name' , '=' , 'Tarpaulin')->get();
            if(!$equipment_tarpaulin->isEmpty()){
                
                foreach($equipment_tarpaulin as $equipment_tarpaulin_quntity){
                    $data['equipment']['tarpaulin'] += (int)$equipment_tarpaulin_quntity->unit;
                } 
            }else{
                $data['equipment']['tarpaulin'] = 0;
            }

            //Tail Lift 
            $data['equipment']['tail_lift'] = 0;
            $equipment_tail_lift= Inventory_uncategorized::where('product_name' , '=' , 'Tail Lift')->get();
            if(!$equipment_tail_lift->isEmpty()){
                
                foreach($equipment_tail_lift as $equipment_tail_lift_quntity){
                    $data['equipment']['tail_lift'] += (int)$equipment_tail_lift_quntity->unit;
                } 
            }else{
                $data['equipment']['tail_lift'] = 0;
            }

            //Trolly 
            $data['equipment']['trolly'] = 0;
            $equipment_trolly= Inventory_uncategorized::where('product_name' , '=' , 'Trolly')->get();
            if(!$equipment_trolly->isEmpty()){
                
                foreach($equipment_trolly as $equipment_trolly_quntity){
                    $data['equipment']['trolly'] += (int)$equipment_trolly_quntity->unit;
                } 
            }else{
                $data['equipment']['trolly'] = 0;
            }
        }
        

        // $data['page_title'] = "Add Own Vehicle
        // ";
        $data['view'] = 'vehicle.register_new_vehicle.add_own_new_vehicle';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_hired_sub_contractor_vehicle(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 9)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['page_title'] = "Add Hired Sub Contractor Vehicle
        ";
        $data['view'] = 'vehicle.register_new_vehicle.add_hired_sub_contractor_vehicle';
        return view('users.layout', ["data"=>$data]);
    }

    public function view_vehicle(Request $request){
       
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 9)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();
        $data['vehicle'] = Vehicle::find((int)$request->input('id'));
        $data['page_title'] = "Vehicles";
        $data['view'] = 'vehicle.view_vehicle';
        return view('users.layout', ["data"=>$data]);
    }

    public function save_vehicle(Request $request){
        $vehicle = new Vehicle();

        //step 1

        if($request->input('registration_type') != ''){
            $vehicle->registration_type = $request->input('registration_type');
        }

        if($request->input('haired_sub_contractor_vehicle') != ''){
            $vehicle->haired_sub_contractor_vehicle = $request->input('haired_sub_contractor_vehicle');
        }

        if($request->input('approx_value') != ''){
            $vehicle->approx_value = $request->input('approx_value');
        }

        if($request->input('own_vehicle') != ''){
            $vehicle->own_vehicle = $request->input('own_vehicle');
        }

        if($request->input('register_vehicle') != ''){
            $vehicle->register_vehicle = $request->input('register_vehicle');
        }

        if($request->input('sub_contractor_id') != ''){
            $vehicle->sub_contractor_id = $request->input('sub_contractor_id');
        }
        
        if($request->input('vehicle_number') != ''){
            $vehicle->vehicle_number = $request->input('vehicle_number');
        }
        if($request->input('registration_date') != ''){
            $vehicle->registration_date = $request->input('registration_date');
        }
        if($request->input('registration_exp_date') != ''){
            $vehicle->registration_exp_date = $request->input('registration_exp_date');
        }
        if ($request->hasFile('regisration_form')) {

            $name = time().'_'.str_replace(" ", "_", $request->regisration_form->getClientOriginalName());
            $file = $request->file('regisration_form');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->regisration_form = $name;

            }
            
        }
        if($request->input('make') != ''){
            $vehicle->make = $request->input('make');
        }
        if($request->input('colour') != ''){
            $vehicle->colour = $request->input('colour');
        }

        if($request->input('trailer_size') != ''){
            $vehicle->trailer_size = $request->input('trailer_size');
        }
        if($request->input('axle') != ''){
            $vehicle->axle = $request->input('axle');
        }
        if($request->input('model') != ''){
            $vehicle->model = $request->input('model');
        }
        if($request->input('engine_number') != ''){
            $vehicle->engine_number = $request->input('engine_number');
        }
        if($request->input('chassis_number') != ''){
            $vehicle->chassis_number = $request->input('chassis_number');
        }

        if($request->input('vehicle_type') != ''){
            $vehicle->vehicle_type = $request->input('vehicle_type');
        }
        if($request->input('truck_type') != ''){
            $vehicle->truck_type = $request->input('truck_type');
        }
        if($request->input('pickup_weight') != ''){
            $vehicle->pickup_weight = $request->input('pickup_weight');
        }
        if($request->input('pickup_shape') != ''){
            $vehicle->pickup_shape = $request->input('pickup_shape');
        }

        if($request->input('vehicle_suspension') != ''){
            $vehicle->vehicle_suspension = $request->input('vehicle_suspension');
        }

        if($request->input('car_description') != ''){
            $vehicle->car_description = $request->input('car_description');
        }

        if($request->input('salik') != ''){
            $vehicle->salik = $request->input('salik');
        }

        if($request->input('trailer_type') != ''){
            $vehicle->trailer_type = $request->input('trailer_type');
        }

        if($request->input('trailer_suspension') != ''){
            $vehicle->trailer_suspension = $request->input('trailer_suspension');
        }
        
        if($request->input('ton_capacity') != ''){
            $vehicle->ton_capacity = $request->input('ton_capacity');
        }

    
        //step 2
        if($request->input('vehicle_insurance') != ''){
            $vehicle->vehicle_insurance = $request->input('vehicle_insurance');
        }
        if($request->input('insurance_policy_number') != ''){
            $vehicle->insurance_policy_number = $request->input('insurance_policy_number');
        }
        if($request->input('insurance_expiry') != ''){
            $vehicle->insurance_expiry = $request->input('insurance_expiry');
        }
        if ($request->hasFile('insurance_form')) {

            $name = time().'_'.str_replace(" ", "_", $request->insurance_form->getClientOriginalName());
            $file = $request->file('insurance_form');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->insurance_form = $name;

            }
            
        }
        if($request->input('other_insurance') != ''){
            $vehicle->other_insurance = $request->input('other_insurance');
        }
        if($request->input('other_insurance_policy_number') != ''){
            $vehicle->other_insurance_policy_number = $request->input('other_insurance_policy_number');
        }
        if($request->input('other_insurance_expiry') != ''){
            $vehicle->other_insurance_exp_date = $request->input('other_insurance_expiry');
        }
        if ($request->hasFile('other_insurance_form')) {

            $name = time().'_'.str_replace(" ", "_", $request->other_insurance_form->getClientOriginalName());
            $file = $request->file('other_insurance_form');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->other_insurance_form = $name;

            }
            
        }
        if($request->input('other_insurance_description') != ''){
            $vehicle->other_insurance_description = $request->input('other_insurance_description');
        }

        // j_ali tags 
        if($request->input('j_ali_tag') != ''){
            $vehicle->j_ali_tag = $request->input('j_ali_tag');
        }

        if($request->input('j_ali_tag_expiry') != ''){
            $vehicle->j_ali_tag_expiry = $request->input('j_ali_tag_expiry');
        }

        if ($request->hasFile('j_ali_tag_upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->j_ali_tag_upload->getClientOriginalName());
            $file = $request->file('j_ali_tag_upload');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->j_ali_tag_upload = $name;

            }
            
        }

        //kp tag 
        if($request->input('kp_tag') != ''){
            $vehicle->kp_tag = $request->input('kp_tag');
        }

        if($request->input('kp_tag_expiry') != ''){
            $vehicle->kp_tag_expiry = $request->input('kp_tag_expiry');
        }

        
        if ($request->hasFile('kp_tag_upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->kp_tag_upload->getClientOriginalName());
            $file = $request->file('kp_tag_upload');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->kp_tag_upload = $name;

            }
            
        }

        //Other tag 
        if($request->input('other_tag') != ''){
            $vehicle->other_tag = $request->input('other_tag');
        }

        if($request->input('other_tag_description') != ''){
            $vehicle->other_tag_description = $request->input('other_tag_description');
        }

        if($request->input('other_tag_expiry') != ''){
            $vehicle->other_tag_expiry = $request->input('other_tag_expiry');
        }
        
        if ($request->hasFile('other_tag_upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->other_tag_upload->getClientOriginalName());
            $file = $request->file('other_tag_upload');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->other_tag_upload = $name;

            }
            
        }

        //Sticker 
        if($request->input('sticker') != ''){
            $vehicle->sticker = $request->input('sticker');
        }

        if($request->input('sticker_description') != ''){
            $vehicle->sticker_description = $request->input('sticker_description');
        }

        if($request->input('describe_other_sticker') != ''){
            $vehicle->describe_other_sticker = $request->input('describe_other_sticker');
        }

        if($request->input('sticker_validity') != ''){
            $vehicle->sticker_validity = $request->input('sticker_validity');
        }
        
        if ($request->hasFile('sticker_upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->sticker_upload->getClientOriginalName());
            $file = $request->file('sticker_upload');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->sticker_upload = $name;

            }
            
        }

        //pass
        if($request->input('pass') != ''){
            $vehicle->pass = $request->input('pass');
        }

        if($request->input('pass_description') != ''){
            $vehicle->pass_description = $request->input('pass_description');
        }

        if($request->input('describe_other_pass') != ''){
            $vehicle->describe_other_pass = $request->input('describe_other_pass');
        }

        //food pass
        if($request->input('food_pass') != ''){
            $vehicle->food_pass = $request->input('food_pass');
        }

        if($request->input('pass_validity') != ''){
            $vehicle->pass_validity = $request->input('pass_validity');
        }

        if ($request->hasFile('pass_upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->pass_upload->getClientOriginalName());
            $file = $request->file('pass_upload');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->pass_upload = $name;

            }
            
        }

        

        //step 3 
        
        if($request->input('medical_kit') != 1){
            $equipment_medical_kit= Inventory_uncategorized::where('product_name' , '=' , 'Medical Kit')->get();
            foreach($equipment_medical_kit as $medical_kit){
                if($medical_kit->unit > 0 ){
                    $medical_kit->unit =  $medical_kit->unit - 1;
                    $medical_kit->save();   
                }

            }
            $vehicle->medical_kit = 1;
            
        }

        //fire_extinguisher
        if($request->input('fire_ext') != 1){
            $equipment_fire_extinguisher= Inventory_uncategorized::where('product_name' , '=' , 'Fire Extinguisher')->get();
            foreach($equipment_fire_extinguisher as $fire_extinguisher){
                if($fire_extinguisher->unit > 0 ){
                    $fire_extinguisher->unit =  $fire_extinguisher->unit - 1;
                    $fire_extinguisher->save();   
                }

            }
            $vehicle->fire_ext = 1;
            $vehicle->fire_ext_weight = $request->input('fire_ext_weight');
            $vehicle->fire_ext_expiry = $request->input('fire_ext_expiry');

        }

        //Jack
        if($request->input('jack') != 1){
            $equipment_jack= Inventory_uncategorized::where('product_name' , '=' , 'Jack')->get();
            foreach($equipment_jack as $jack){
                if($jack->unit > 0 ){
                    $jack->unit =  $jack->unit - 1;
                    $jack->save();   
                }

            }
            $vehicle->jack = 1;

            
        }

        //Safety Triangle
        if($request->input('safety_triangle') != 1){
            $equipment_safety_triangle= Inventory_uncategorized::where('product_name' , '=' , 'Safety Triangle')->get();
            foreach($equipment_safety_triangle as $safety_triangle){
                if($safety_triangle->unit > 0 ){
                    $safety_triangle->unit =  $safety_triangle->unit - 1;
                    $safety_triangle->save();   
                }

            }
            $vehicle->safety_triangle = 1;

            
        }

        //emergency_light
        if($request->input('emergency_light') != 1){
            $equipment_emergency_light= Inventory_uncategorized::where('product_name' , '=' , 'Emergency Light')->get();
            foreach($equipment_emergency_light as $emergency_light){
                if($emergency_light->unit > 0 ){
                    $emergency_light->unit =  $emergency_light->unit - 1;
                    $emergency_light->save();   
                }

            }
            $vehicle->extra_emergency_light = 1;

            
        }

        //Safety Shoes
        if($request->input('safety_shoes') != 1){
            $equipment_safety_shoes= Inventory_uncategorized::where('product_name' , '=' , 'Safety Shoes')->get();
            foreach($equipment_safety_shoes as $safety_shoes){
                if($safety_shoes->unit > 0 ){
                    $safety_shoes->unit =  $safety_shoes->unit - 1;
                    $safety_shoes->save();   
                }

            }
            $vehicle->safety_shoes = 1;

            
        }
        
        //Safety Helemt
        if($request->input('safety_helmet') != 1){
            $equipment_safety_helemt= Inventory_uncategorized::where('product_name' , '=' , 'Safety Helemt')->get();
            foreach($equipment_safety_helemt as $safety_helemt){
                if($safety_helemt->unit > 0 ){
                    $safety_helemt->unit =  $safety_helemt->unit - 1;
                    $safety_helemt->save();   
                }

            }
            $vehicle->safety_helmet = 1;

            
        }

        //safety_gloves
        if($request->input('safety_gloves') != 1){
            $equipment_safety_gloves= Inventory_uncategorized::where('product_name' , '=' , 'Safety Gloves')->get();
            foreach($equipment_safety_gloves as $safety_gloves){
                if($safety_gloves->unit > 0 ){
                    $safety_gloves->unit =  $safety_gloves->unit - 1;
                    $safety_gloves->save();   
                }

            }
            $vehicle->safety_gloves = 1;
        
        }
        
        //Safety Jacket
        if($request->input('safety_jacket') != 1){
            $equipment_safety_jacket= Inventory_uncategorized::where('product_name' , '=' , 'Safety Jacket')->get();
            foreach($equipment_safety_jacket as $safety_jacket){
                if($safety_jacket->unit > 0 ){
                    $safety_jacket->unit =  $safety_jacket->unit - 1;
                    $safety_jacket->save();   
                }

            }
            $vehicle->safety_jacket = 1;

        
        }

        //Safety Ear Plug
        if($request->input('safety_ear_plug') != 1){
            $equipment_safety_ear_plug= Inventory_uncategorized::where('product_name' , '=' , 'Safety Ear Plug')->get();
            foreach($equipment_safety_ear_plug as $safety_ear_plug){
                if($safety_ear_plug->unit > 0 ){
                    $safety_ear_plug->unit =  $safety_ear_plug->unit - 1;
                    $safety_ear_plug->save();   
                }

            }
            $vehicle->safety_ear_plug = 1;

        
        }

        //lashing_belt_long
        if($request->input('lashing_belt_quantity_long') > 0 ){
            $equipment_lashing_belt_long= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Belt Long')->get();
            foreach($equipment_lashing_belt_long as $lashing_belt_long){
                if($lashing_belt_long->unit > 0 ){
                    $lashing_belt_long->unit =  $lashing_belt_long->unit - (int)$request->input('lashing_belt_quantity_long');
                    $lashing_belt_long->save();   
                }

            }
            $vehicle->lashing_belts = 1;
            $vehicle->lashing_belt_long_quantity = (int)$request->input('lashing_belt_quantity_long');

        }

        //lashing_belt_short
        if($request->input('lashing_belt_quantity_short') > 0 ){
            $equipment_lashing_belt_short= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Belt Short')->get();
            foreach($equipment_lashing_belt_short as $lashing_belt_short){
                if($lashing_belt_short->unit > 0 ){
                    $lashing_belt_short->unit =  $lashing_belt_short->unit - (int)$request->input('lashing_belt_quantity_short');
                    $lashing_belt_short->save();   
                }

            }
            $vehicle->lashing_belts = 1;
            $vehicle->lashing_belt_short_quantity = (int)$request->input('lashing_belt_quantity_short');
        
        }

        //lashing_chain
        if($request->input('lashing_chain') != 1){
            $equipment_lashing_chain= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Chain')->get();
            foreach($equipment_lashing_chain as $lashing_chain){
                if($lashing_chain->unit > 0 ){
                    $lashing_chain->unit =  $lashing_chain->unit - (int)$request->input('lashing_chain_quantity');
                    $lashing_chain->save();   
                }

            }
            $vehicle->lashing_chain = 1;
            $vehicle->lashing_chain_quantity = (int)$request->input('lashing_chain_quantity');
        
        }

        
        //side_grill
        if($request->input('side_grill') != 1){
            $equipment_side_grill= Inventory_uncategorized::where('product_name' , '=' , 'Side Grill')->get();
            foreach($equipment_side_grill as $side_grill){
                if($side_grill->unit > 0 ){
                    $side_grill->unit =  $side_grill->unit - (int)$request->input('side_grill_quantity');
                    $side_grill->save();   
                }

            }
            $vehicle->side_grill = 1;
            $vehicle->side_grill_quantity = (int)$request->input('side_grill_quantity');
            $vehicle->side_grill_height = (int)$request->input('side_grill_height');

        }

         //container_lock
        if($request->input('container_lock') != 1){
            $equipment_container_lock= Inventory_uncategorized::where('product_name' , '=' , 'Container Lock')->get();
            foreach($equipment_container_lock as $container_lock){
                if($container_lock->unit > 0 ){
                    $container_lock->unit =  $container_lock->unit - 1;
                    $container_lock->save();   
                }

            }
            $vehicle->container_lock = 1;
        
        }
         //Rope Seal
        if($request->input('rope_seal') != 1){
            $equipment_rope_seal= Inventory_uncategorized::where('product_name' , '=' , 'Rope Seal')->get();
            foreach($equipment_rope_seal as $rope_seal){
                if($rope_seal->unit > 0 ){
                    $rope_seal->unit =  $rope_seal->unit - 1;
                    $rope_seal->save();   
                }

            }
            $vehicle->rope_seal = 1;
        
        }

        //Lashing Angle
        if($request->input('lashing_angle') != 1){
            $equipment_lashing_angle= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Angle')->get();
            foreach($equipment_lashing_angle as $lashing_angle){
                if($lashing_angle->unit > 0 ){
                    $lashing_angle->unit =  $lashing_angle->unit - (int)$request->input('lashing_angle_quantity');
                    $lashing_angle->save();   
                }

            }
            $vehicle->lashing_angle = 1;
            $vehicle->lashing_angle_quantity = (int)$request->input('lashing_angle_quantity');
            $vehicle->lashing_angle_size = (int)$request->input('lashing_angle_size');
        }

        

         //tarpaulin
         if($request->input('tarpaulin') != 1){
            $equipment_tarpaulin= Inventory_uncategorized::where('product_name' , '=' , 'Tarpaulin')->get();
            foreach($equipment_tarpaulin as $tarpaulin){
                if($tarpaulin->unit > 0 ){
                    $tarpaulin->unit =  $tarpaulin->unit - $request->input('tarpaulin_quantity');
                    $tarpaulin->save();   
                }

            }
        
            $vehicle->tarpaulin = 1;
        }
        
        //Tail Lift
        if($request->input('tail_lift') != 1){
            $equipment_tail_lift= Inventory_uncategorized::where('product_name' , '=' , 'Tail Lift')->get();
            foreach($equipment_tail_lift as $tail_lift){
                if($tail_lift->unit > 0 ){
                    $tail_lift->unit =  $tail_lift->unit -1;
                    $tail_lift->save();   
                }

            }
            $vehicle->tail_lift = 1;
        
        }

        //Trolly
        if($request->input('trolly') != 1){
            $equipment_trolly= Inventory_uncategorized::where('product_name' , '=' , 'Trolly')->get();
            foreach($equipment_trolly as $trolly){
                if($trolly->unit > 0 ){
                    $trolly->unit =  $trolly->unit -1;
                    $trolly->save();   
                }

            }
            $vehicle->trolly = 1;
        
        }

        //step 4

        if ($request->hasFile('front_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->front_photo->getClientOriginalName());
            $file = $request->file('front_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->front_photo = $name;

            }
            
        }

        if ($request->hasFile('left_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->left_photo->getClientOriginalName());
            $file = $request->file('left_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->left_photo = $name;

            }
            
        }

        if ($request->hasFile('right_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->right_photo->getClientOriginalName());
            $file = $request->file('right_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->right_photo = $name;

            }
            
        }

        if ($request->hasFile('back_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->back_photo->getClientOriginalName());
            $file = $request->file('back_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->back_photo = $name;

            }
            
        }

        //step 5
        if ($request->hasFile('equipment_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->equipment_photo->getClientOriginalName());
            $file = $request->file('equipment_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->equipment_photo = $name;

            }
            
        }

        $vehicle->status_message = $request->input('status_message');
       
        $vehicle->user_id  = Auth::id();

            $vehicle->action = 'Add';
        $vehicle->status = 'pending';
        $vehicle->row_status = 'active';





        $vehicle->save();

      


        return \Redirect::route('user.vehicle')->with('Success', 'Data Added Sucessfully');

    }

    public function update_vehicle(Request $request){
        $vehicle = Vehicle::find((int)$request->input('id'));

        //step 1

        $vehicle_edit_info = new Vehicle_edit_history;
        $vehicle_edit_info->row_id = (int)$request->input('id');
        $vehicle_edit_info->company_id = $vehicle->company_id;
        $vehicle_edit_info->registration_type = $vehicle->registration_type;
        $vehicle_edit_info->haired_sub_contractor_vehicle = $vehicle->haired_sub_contractor_vehiclecompany_id;
        $vehicle_edit_info->approx_value = $vehicle->approx_value;
        $vehicle_edit_info->own_vehicle = $vehicle->own_vehicle;
        $vehicle_edit_info->register_vehicle = $vehicle->register_vehicle;
        $vehicle_edit_info->sub_contractor_id = $vehicle->sub_contractor_id;
        $vehicle_edit_info->vehicle_number = $vehicle->vehicle_number;
        $vehicle_edit_info->registration_date = $vehicle->registration_date;
        $vehicle_edit_info->registration_exp_date = $vehicle->registration_exp_date;
        $vehicle_edit_info->make = $vehicle->make;
        $vehicle_edit_info->colour = $vehicle->colour;
        $vehicle_edit_info->trailer_size = $vehicle->trailer_size;
        $vehicle_edit_info->axle = $vehicle->axle;
        $vehicle_edit_info->model = $vehicle->model;
        $vehicle_edit_info->engine_number = $vehicle->engine_number;
        $vehicle_edit_info->vehicle_type = $vehicle->vehicle_type;
        $vehicle_edit_info->truck_type = $vehicle->truck_type;
        $vehicle_edit_info->pickup_weight = $vehicle->pickup_weight;
        $vehicle_edit_info->pickup_shape = $vehicle->pickup_shape;
        $vehicle_edit_info->vehicle_suspension = $vehicle->vehicle_suspension;
        $vehicle_edit_info->car_description = $vehicle->car_description;
        $vehicle_edit_info->trailer_type = $vehicle->trailer_type;
        $vehicle_edit_info->trailer_suspension = $vehicle->trailer_suspension;
        $vehicle_edit_info->ton_capacity = $vehicle->ton_capacity;
        $vehicle_edit_info->salik = $vehicle->salik;
        $vehicle_edit_info->regisration_form = $vehicle->regisration_form;


        //step 2
        $vehicle_edit_info->vehicle_insurance = $vehicle->vehicle_insurance;
        $vehicle_edit_info->insurance_policy_number = $vehicle->insurance_policy_number;
        $vehicle_edit_info->insurance_expiry = $vehicle->insurance_expiry;
        $vehicle_edit_info->insurance_form = $vehicle->insurance_form;
        $vehicle_edit_info->other_insurance = $vehicle->other_insurance;
        // $vehicle_edit_info->other_insurance_policy_number = $vehicle->other_insurance_policy_number;
        $vehicle_edit_info->other_insurance_expiry = $vehicle->other_insurance_expiry;
        $vehicle_edit_info->other_insurance_form = $vehicle->other_insurance_form;
        $vehicle_edit_info->other_insurance_description = $vehicle->other_insurance_description;
        $vehicle_edit_info->j_ali_tag = $vehicle->j_ali_tag;
        $vehicle_edit_info->j_ali_tag_expiry = $vehicle->j_ali_tag_expiry;
        $vehicle_edit_info->j_ali_tag_upload = $vehicle->j_ali_tag_upload;
        $vehicle_edit_info->kp_tag = $vehicle->kp_tag;
        $vehicle_edit_info->kp_tag_expiry = $vehicle->kp_tag_expiry;
        $vehicle_edit_info->kp_tag_upload = $vehicle->kp_tag_upload;
        $vehicle_edit_info->other_tag = $vehicle->other_tag;
        $vehicle_edit_info->other_tag_expiry = $vehicle->other_tag_expiry;
        $vehicle_edit_info->other_tag_upload = $vehicle->other_tag_upload;
        $vehicle_edit_info->other_tag_description = $vehicle->other_tag_description;

        $vehicle_edit_info->sticker = $vehicle->sticker;
        $vehicle_edit_info->sticker_description = $vehicle->sticker_description;
        $vehicle_edit_info->describe_other_sticker = $vehicle->describe_other_sticker;
        $vehicle_edit_info->sticker_validity = $vehicle->sticker_validity;
        $vehicle_edit_info->sticker_upload = $vehicle->sticker_upload;
        
        $vehicle_edit_info->pass = $vehicle->pass;
        $vehicle_edit_info->pass_description = $vehicle->pass_description;
        $vehicle_edit_info->describe_other_pass = $vehicle->describe_other_pass;
        $vehicle_edit_info->food_pass = $vehicle->food_pass;
        $vehicle_edit_info->pass_validity = $vehicle->pass_validity;
        $vehicle_edit_info->pass_upload = $vehicle->pass_upload;

        //step 4
        $vehicle_edit_info->front_photo = $vehicle->front_photo;
        $vehicle_edit_info->left_photo = $vehicle->left_photo;
        $vehicle_edit_info->back_photo = $vehicle->back_photo;
        $vehicle_edit_info->right_photo = $vehicle->right_photo;
        //step 4
        $vehicle_edit_info->equipment_photo = $vehicle->equipment_photo;


        $vehicle_edit_info->save();

        




        
        if($request->input('approx_value') != ''){
            $vehicle->approx_value = $request->input('approx_value');
        }

        
        if($request->input('vehicle_number') != ''){
            $vehicle->vehicle_number = $request->input('vehicle_number');
        }
        if($request->input('registration_date') != ''){
            $vehicle->registration_date = $request->input('registration_date');
        }
        if($request->input('registration_exp_date') != ''){
            $vehicle->registration_exp_date = $request->input('registration_exp_date');
        }
        if ($request->hasFile('regisration_form')) {

            $name = time().'_'.str_replace(" ", "_", $request->regisration_form->getClientOriginalName());
            $file = $request->file('regisration_form');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->regisration_form = $name;

            }
            
        }
        if($request->input('make') != ''){
            $vehicle->make = $request->input('make');
        }
        if($request->input('colour') != ''){
            $vehicle->colour = $request->input('colour');
        }

        if($request->input('trailer_size') != ''){
            $vehicle->trailer_size = $request->input('trailer_size');
        }
        if($request->input('axle') != ''){
            $vehicle->axle = $request->input('axle');
        }
        if($request->input('model') != ''){
            $vehicle->model = $request->input('model');
        }
        if($request->input('engine_number') != ''){
            $vehicle->engine_number = $request->input('engine_number');
        }
        if($request->input('chassis_number') != ''){
            $vehicle->chassis_number = $request->input('chassis_number');
        }

        if($request->input('vehicle_type') != ''){
            $vehicle->vehicle_type = $request->input('vehicle_type');
        }
        if($request->input('truck_type') != ''){
            $vehicle->truck_type = $request->input('truck_type');
        }
        if($request->input('pickup_weight') != ''){
            $vehicle->pickup_weight = $request->input('pickup_weight');
        }
        if($request->input('pickup_shape') != ''){
            $vehicle->pickup_shape = $request->input('pickup_shape');
        }

        if($request->input('vehicle_suspension') != ''){
            $vehicle->vehicle_suspension = $request->input('vehicle_suspension');
        }

        if($request->input('car_description') != ''){
            $vehicle->car_description = $request->input('car_description');
        }

        if($request->input('salik') != ''){
            $vehicle->salik = $request->input('salik');
        }

        if($request->input('trailer_type') != ''){
            $vehicle->trailer_type = $request->input('trailer_type');
        }

        if($request->input('trailer_suspension') != ''){
            $vehicle->trailer_suspension = $request->input('trailer_suspension');
        }
        
        if($request->input('ton_capacity') != ''){
            $vehicle->ton_capacity = $request->input('ton_capacity');
        }

    
        //step 2
        if($request->input('vehicle_insurance') != ''){
            $vehicle->vehicle_insurance = $request->input('vehicle_insurance');
        }
        if($request->input('insurance_policy_number') != ''){
            $vehicle->insurance_policy_number = $request->input('insurance_policy_number');
        }
        if($request->input('insurance_expiry') != ''){
            $vehicle->insurance_expiry = $request->input('insurance_expiry');
        }
        if ($request->hasFile('insurance_form')) {

            $name = time().'_'.str_replace(" ", "_", $request->insurance_form->getClientOriginalName());
            $file = $request->file('insurance_form');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->insurance_form = $name;

            }
            
        }
        if($request->input('other_insurance') != ''){
            $vehicle->other_insurance = $request->input('other_insurance');
        }
        if($request->input('other_insurance_policy_number') != ''){
            $vehicle->other_insurance_policy_number = $request->input('other_insurance_policy_number');
        }
        if($request->input('other_insurance_expiry') != ''){
            $vehicle->other_insurance_exp_date = $request->input('other_insurance_expiry');
        }
        if ($request->hasFile('other_insurance_form')) {

            $name = time().'_'.str_replace(" ", "_", $request->other_insurance_form->getClientOriginalName());
            $file = $request->file('other_insurance_form');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->other_insurance_form = $name;

            }
            
        }
        if($request->input('other_insurance_description') != ''){
            $vehicle->other_insurance_description = $request->input('other_insurance_description');
        }

        // j_ali tags 
        if($request->input('j_ali_tag') != ''){
            $vehicle->j_ali_tag = $request->input('j_ali_tag');
        }

        if($request->input('j_ali_tag_expiry') != ''){
            $vehicle->j_ali_tag_expiry = $request->input('j_ali_tag_expiry');
        }

        if ($request->hasFile('j_ali_tag_upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->j_ali_tag_upload->getClientOriginalName());
            $file = $request->file('j_ali_tag_upload');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->j_ali_tag_upload = $name;

            }
            
        }

        //kp tag 
        if($request->input('kp_tag') != ''){
            $vehicle->kp_tag = $request->input('kp_tag');
        }

        if($request->input('kp_tag_expiry') != ''){
            $vehicle->kp_tag_expiry = $request->input('kp_tag_expiry');
        }

        
        if ($request->hasFile('kp_tag_upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->kp_tag_upload->getClientOriginalName());
            $file = $request->file('kp_tag_upload');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->kp_tag_upload = $name;

            }
            
        }

        //Other tag 
        if($request->input('other_tag') != ''){
            $vehicle->other_tag = $request->input('other_tag');
        }

        if($request->input('other_tag_description') != ''){
            $vehicle->other_tag_description = $request->input('other_tag_description');
        }

        if($request->input('other_tag_expiry') != ''){
            $vehicle->other_tag_expiry = $request->input('other_tag_expiry');
        }
        
        if ($request->hasFile('other_tag_upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->other_tag_upload->getClientOriginalName());
            $file = $request->file('other_tag_upload');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->other_tag_upload = $name;

            }
            
        }

        //Sticker 
        if($request->input('sticker') != ''){
            $vehicle->sticker = $request->input('sticker');
        }

        if($request->input('sticker_description') != ''){
            $vehicle->sticker_description = $request->input('sticker_description');
        }

        if($request->input('describe_other_sticker') != ''){
            $vehicle->describe_other_sticker = $request->input('describe_other_sticker');
        }

        if($request->input('sticker_validity') != ''){
            $vehicle->sticker_validity = $request->input('sticker_validity');
        }
        
        if ($request->hasFile('sticker_upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->sticker_upload->getClientOriginalName());
            $file = $request->file('sticker_upload');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->sticker_upload = $name;

            }
            
        }

        //pass
        if($request->input('pass') != ''){
            $vehicle->pass = $request->input('pass');
        }

        if($request->input('pass_description') != ''){
            $vehicle->pass_description = $request->input('pass_description');
        }

        if($request->input('describe_other_pass') != ''){
            $vehicle->describe_other_pass = $request->input('describe_other_pass');
        }

        //food pass
        if($request->input('food_pass') != ''){
            $vehicle->food_pass = $request->input('food_pass');
        }

        if($request->input('pass_validity') != ''){
            $vehicle->pass_validity = $request->input('pass_validity');
        }

        if ($request->hasFile('pass_upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->pass_upload->getClientOriginalName());
            $file = $request->file('pass_upload');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->pass_upload = $name;

            }
            
        }

        // //step 3 
        
        // if($request->input('medical_kit') != 1){
        //     if($vehicle->medical_kit != 1){
        //         $equipment_medical_kit= Inventory_uncategorized::where('product_name' , '=' , 'Medical Kit')->get();
        //         foreach($equipment_medical_kit as $medical_kit){
        //             if($medical_kit->unit > 0 ){
        //                 $medical_kit->unit =  $medical_kit->unit - 1;
        //                 $medical_kit->save();   
        //             }
    
        //         }
                
        //         $vehicle->medical_kit = 1;
        //         $vehicle->medical_kit_expiry = $request->input('medical_kit_expiry');

        //     }
            
        // }

        // //fire_extinguisher
        // if($request->input('fire_ext') != 1){
        //     if($vehicle->fire_extinguisher != 1){
        //         $equipment_fire_extinguisher= Inventory_uncategorized::where('product_name' , '=' , 'Fire Extinguisher')->get();
        //         foreach($equipment_fire_extinguisher as $fire_extinguisher){
        //             if($fire_extinguisher->unit > 0 ){
        //                 $fire_extinguisher->unit =  $fire_extinguisher->unit - 1;
        //                 $fire_extinguisher->save();   
        //             }
    
        //         }
        //         $vehicle->fire_extinguisher = 1;
        //     }
            
            
        // }

        // //Jack
        // if($request->input('jack') != 1){
        //     if($vehicle->jack != 1){

        //         $equipment_jack= Inventory_uncategorized::where('product_name' , '=' , 'Jack')->get();
        //         foreach($equipment_jack as $jack){
        //             if($jack->unit > 0 ){
        //                 $jack->unit =  $jack->unit - 1;
        //                 $jack->save();   
        //             }

        //         }
        //         $vehicle->jack = 1;
        //     }
            
        // }

        // //Safety Triangle
        // if($request->input('safety_triangle') != 1){
        //     if($vehicle->safety_triangle != 1){

        //         $equipment_safety_triangle= Inventory_uncategorized::where('product_name' , '=' , 'Safety Triangle')->get();
        //         foreach($equipment_safety_triangle as $safety_triangle){
        //             if($safety_triangle->unit > 0 ){
        //                 $safety_triangle->unit =  $safety_triangle->unit - 1;
        //                 $safety_triangle->save();   
        //             }

        //         }
        //         $vehicle->safety_triangle = 1;
        //     }
            
        // }

        // //emergency_light
        // if($request->input('emergency_light') != 1){
        //     if($vehicle->emergency_light != 1){

        //         $equipment_emergency_light= Inventory_uncategorized::where('product_name' , '=' , 'Emergency Light')->get();
        //         foreach($equipment_emergency_light as $emergency_light){
        //             if($emergency_light->unit > 0 ){
        //                 $emergency_light->unit =  $emergency_light->unit - 1;
        //                 $emergency_light->save();   
        //             }

        //         }
        //         $vehicle->emergency_light = 1;
        //     }
        // }

        // //Safety Shoes
        // if($request->input('safety_shoes') != 1){
        //     if($vehicle->safety_shoes != 1){

        //         $equipment_safety_shoes= Inventory_uncategorized::where('product_name' , '=' , 'Safety Shoes')->get();
        //         foreach($equipment_safety_shoes as $safety_shoes){
        //             if($safety_shoes->unit > 0 ){
        //                 $safety_shoes->unit =  $safety_shoes->unit - 1;
        //                 $safety_shoes->save();   
        //             }

        //         }
        //         $vehicle->safety_shoes = 1;
        //     }
            
        // }
        
        // //Safety Helemt
        // if($request->input('safety_helmet') != 1){
        //     if($vehicle->safety_helmet != 1){

        //         $equipment_safety_helemt= Inventory_uncategorized::where('product_name' , '=' , 'Safety Helemt')->get();
        //         foreach($equipment_safety_helemt as $safety_helemt){
        //             if($safety_helemt->unit > 0 ){
        //                 $safety_helemt->unit =  $safety_helemt->unit - 1;
        //                 $safety_helemt->save();   
        //             }

        //         }
        //         $vehicle->safety_helmet = 1;
        //     }
            
        // }

        // //safety_gloves
        // if($request->input('safety_gloves') != 1){
        //     if($vehicle->safety_gloves != 1){

        //         $equipment_safety_gloves= Inventory_uncategorized::where('product_name' , '=' , 'Safety Gloves')->get();
        //         foreach($equipment_safety_gloves as $safety_gloves){
        //             if($safety_gloves->unit > 0 ){
        //                 $safety_gloves->unit =  $safety_gloves->unit - 1;
        //                 $safety_gloves->save();   
        //             }

        //         }
        //         $vehicle->safety_gloves = 1;
        //     }
        // }
        
        // //Safety Jacket
        // if($request->input('safety_jacket') != 1){
        //     if($vehicle->safety_jacket != 1){

        //         $equipment_safety_jacket= Inventory_uncategorized::where('product_name' , '=' , 'Safety Jacket')->get();
        //         foreach($equipment_safety_jacket as $safety_jacket){
        //             if($safety_jacket->unit > 0 ){
        //                 $safety_jacket->unit =  $safety_jacket->unit - 1;
        //                 $safety_jacket->save();   
        //             }

        //         }
        //         $vehicle->safety_jacket = 1;
        //     }
        
        // }

        // //Safety Ear Plug
        // if($request->input('safety_ear_plug') != 1){
        //     if($vehicle->safety_ear_plug != 1){

        //         $equipment_safety_ear_plug= Inventory_uncategorized::where('product_name' , '=' , 'Safety Ear Plug')->get();
        //         foreach($equipment_safety_ear_plug as $safety_ear_plug){
        //             if($safety_ear_plug->unit > 0 ){
        //                 $safety_ear_plug->unit =  $safety_ear_plug->unit - 1;
        //                 $safety_ear_plug->save();   
        //             }

        //         }
        //         $vehicle->safety_ear_plug = 1;
        //     }
        
        // }

        // //lashing_belt_long
        // if($request->input('lashing_belt_quantity_long') > 0){
        //     if($vehicle->lashing_belt != 1){

        //         $equipment_lashing_belt_long= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Belt Long')->get();
        //         foreach($equipment_lashing_belt_long as $lashing_belt_long){
        //             if($lashing_belt_long->unit > 0 ){
        //                 $lashing_belt_long->unit =  $lashing_belt_long->unit - (int)$request->input("lashing_belt_quantity_long");
        //                 $lashing_belt_long->save();   
        //             }

        //         }
        //         $vehicle->lashing_belt_long_quantity = (int)$request->input("lashing_belt_quantity_long");
        //         $vehicle->lashing_belts = 1;

        //     }
        
        // }

        // //lashing_belt_short
        // if($request->input('lashing_belt_quantity_short') > 0){
        //     if($vehicle->lashing_belt != 1){

        //         $equipment_lashing_belt_short= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Belt Short')->get();
        //         foreach($equipment_lashing_belt_short as $lashing_belt_short){
        //             if($lashing_belt_short->unit > 0 ){
        //                 $lashing_belt_short->unit =  $lashing_belt_short->unit - (int)$request->input("lashing_belt_quantity_short");

        //                 $lashing_belt_short->save();   
        //             }

        //         }
        //         $vehicle->lashing_belts = 1;
        //         $vehicle->lashing_belt_short_quantity = (int)$request->input("lashing_belt_quantity_short");
        //     }
            
        
        // }

        // //lashing_chain
        // if($request->input('lashing_chain') != 1){
        //     if($vehicle->lashing_chain != 1){

        //         $equipment_lashing_chain= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Chain')->get();
        //         foreach($equipment_lashing_chain as $lashing_chain){
        //             if($lashing_chain->unit > 0 ){
        //                 $lashing_chain->unit =  $lashing_chain->unit - (int)$request->input('lashing_chain_quantity');
        //                 $lashing_chain->save();   
        //             }

        //         }
        //         $vehicle->lashing_chain = 1;
        //         $vehicle->lashing_chain_quantity = (int)$request->input("lashing_chain_quantity");

        //     }
        
        // }

        
        // //side_grill
        // if($request->input('side_grill') != 1){
        //     if($vehicle->side_grill != 1){

        //         $equipment_side_grill= Inventory_uncategorized::where('product_name' , '=' , 'Side Grill')->get();
        //         foreach($equipment_side_grill as $side_grill){
        //             if($side_grill->unit > 0 ){
        //                 $side_grill->unit =  $side_grill->unit - (int)$request->input('side_grill_quantity');
        //                 $side_grill->save();   
        //             }

        //         }
        //         $vehicle->side_grill = 1;
        //         $vehicle->side_grill_quantity = (int)$request->input("side_grill_quantity");

        //     }
        // }


        //  //container_lock
        // if($request->input('container_lock') != 1){
        //     if($vehicle->container_lock != 1){

        //         $equipment_container_lock= Inventory_uncategorized::where('product_name' , '=' , 'Container Lock')->get();
        //         foreach($equipment_container_lock as $container_lock){
        //             if($container_lock->unit > 0 ){
        //                 $container_lock->unit =  $container_lock->unit - 1;
        //                 $container_lock->save();   
        //             }

        //         }
        //         $vehicle->container_lock = 1;

        //     }
        
        // }

        //  //Rope Seal
        // if($request->input('rope_seal') != 1){
        //     if($vehicle->rope_seal != 1){

        //         $equipment_rope_seal= Inventory_uncategorized::where('product_name' , '=' , 'Rope Seal')->get();
        //         foreach($equipment_rope_seal as $rope_seal){
        //             if($rope_seal->unit > 0 ){
        //                 $rope_seal->unit =  $rope_seal->unit - 1;
        //                 $rope_seal->save();   
        //             }

        //         }
        //         $vehicle->rope_seal = 1;

        //     }
        
        // }

        // //Lashing Angle
        // if($request->input('lashing_angle') != 1){
        //     if($vehicle->lashing_angle != 1){

        //         $equipment_lashing_angle= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Angle')->get();
        //         foreach($equipment_lashing_angle as $lashing_angle){
        //             if($lashing_angle->unit > 0 ){
        //                 $lashing_angle->unit =  $lashing_angle->unit - $request->input('lashing_angle_quantity');

        //                 $lashing_angle->save();   
        //             }

        //         }
        //         $vehicle->lashing_angle_quantity = (int)$request->input("lashing_angle_quantity");

        //         $vehicle->lashing_angle = 1;

        //     }
        // }


        // //tarpaulin
        // if($request->input('tarpaulin') != 1){
        //     if($vehicle->tarpaulin != 1){

        //         $equipment_tarpaulin= Inventory_uncategorized::where('product_name' , '=' , 'Tarpaulin')->get();
        //         foreach($equipment_tarpaulin as $tarpaulin){
        //             if($tarpaulin->unit > 0 ){
        //                 $tarpaulin->unit =  $tarpaulin->unit - 1;
        //                 $tarpaulin->save();   
        //             }

        //         }
        //         $vehicle->tarpaulin_type = $request->input("tarpaulin_type");

        //         $vehicle->tarpaulin = 1;

        //     }
        
        // }
        
        // //Tail Lift
        // if($request->input('tail_lift') != 1){
        //     if($vehicle->tail_lift != 1){

        //         $equipment_tail_lift= Inventory_uncategorized::where('product_name' , '=' , 'Tail Lift')->get();
        //         foreach($equipment_tail_lift as $tail_lift){
        //             if($tail_lift->unit > 0 ){
        //                 $tail_lift->unit =  $tail_lift->unit -1;
        //                 $tail_lift->save();   
        //             }

        //         }
        //         $vehicle->tail_lift = 1;

        //     }
        
        // }

        // //Trolly
        // if($request->input('trolly') != 1){
        //     if($vehicle->trolly != 1){

        //         $equipment_trolly= Inventory_uncategorized::where('product_name' , '=' , 'Trolly')->get();
        //         foreach($equipment_trolly as $trolly){
        //             if($trolly->unit > 0 ){
        //                 $trolly->unit =  $trolly->unit -1;
        //                 $trolly->save();   
        //             }

        //         }
        //         $vehicle->trolly = 1;

        //     }
        
        // }

        //step 4

        if ($request->hasFile('front_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->front_photo->getClientOriginalName());
            $file = $request->file('front_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->front_photo = $name;

            }
            
        }

        if ($request->hasFile('left_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->left_photo->getClientOriginalName());
            $file = $request->file('left_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->left_photo = $name;

            }
            
        }

        if ($request->hasFile('right_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->right_photo->getClientOriginalName());
            $file = $request->file('right_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->right_photo = $name;

            }
            
        }

        if ($request->hasFile('back_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->back_photo->getClientOriginalName());
            $file = $request->file('back_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->back_photo = $name;

            }
            
        }

        //step 5
        if ($request->hasFile('equipment_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->equipment_photo->getClientOriginalName());
            $file = $request->file('equipment_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $vehicle->equipment_photo = $name;

            }
            
        }

        $vehicle->status_message = $request->input('status_message');
        if( $vehicle->user_id != 0){
            $user_id  = $vehicle->user_id;
            
        }else{
            $user_id  = 0;
        }
        // dd($vehicle->action );

        

        $vehicle->status = 'pending';


        $vehicle->save();

        // if($request->input('status') == 'approved'){
        //     $this->remove_table_name('vehicles');
        // }
        if($vehicle->status == 'approved' || $vehicle->user_id == 0 ){
            //  $this->history_table('vehicle_histories', $vehicle->action , $user_id);
             $this->history_table('vehicle_histories', 'Edit' , $user_id , $vehicle->id , 'vehicle.view_vehicle');
        }


        return \Redirect::route('user.vehicle.vehicle')->with('success', 'Data Updated Sucessfully');
    }

    
    public function edit_own_new_vehicle(Request $request){
        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 9)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['company_names']= DB::table('company_names')->get();
        $data['vehicle']= vehicle::find((int)$request->input('id'));
        // $data['vehicle_history']= vehicle_edit_history::where('row_id' , '=' , (int)$request->input('id'))->first();
        $data['vehicle_history'] = vehicle_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();
        
        if( $data['vehicle_history'] == null){
            // $data['vehicle_history'] = new vehicle_edit_history;
        }
        // dd()
        //equipment
        {
            $data['equipment'] = [];

            //Medical Kit
            $data['equipment']['medical_kit'] = 0;
            $equipment_medical_kit= Inventory_uncategorized::where('product_name' , '=' , 'Medical Kit')->get();
            if(!$equipment_medical_kit->isEmpty()){
                
                foreach($equipment_medical_kit as $medical_kit_quntity){
                   

                    $data['equipment']['medical_kit'] += (int)$medical_kit_quntity->unit;
                } 
            }else{
                $data['equipment']['medical_kit'] = 0;
            }
        
            //Fire Extinguisher 
            $data['equipment']['fire_extinguisher'] = 0;
            $equipment_fire_extinguisher= Inventory_uncategorized::where('product_name' , '=' , 'Fire Extinguisher')->get();
            
            if(!$equipment_fire_extinguisher->isEmpty()){
                
                foreach($equipment_fire_extinguisher as $fire_extinguisher_quntity){
                    $data['equipment']['fire_extinguisher'] += (int)$fire_extinguisher_quntity->unit;
                } 
            }else{
                
                $data['equipment']['fire_extinguisher'] = 0;
            }

            //safety_triangle 
            $data['equipment']['safety_triangle'] = 0;
            $equipment_safety_triangle= Inventory_uncategorized::where('product_name' , '=' , 'Safety Triangle')->get();
            
            if(!$equipment_safety_triangle->isEmpty()){
                
                foreach($equipment_safety_triangle as $equipment_safety_triangle_quntity){
                    $data['equipment']['safety_triangle'] += (int)$equipment_safety_triangle_quntity->unit;
                } 
            }else{
                
                $data['equipment']['safety_triangle'] = 0;
            }

            //Jack 
            $data['equipment']['jack'] = 0;
            $equipment_jack= Inventory_uncategorized::where('product_name' , '=' , 'Jack')->get();
            if(!$equipment_jack->isEmpty()){
                
                foreach($equipment_jack as $jack_quntity){
                    $data['equipment']['jack'] += (int)$jack_quntity->unit;
                } 
            }else{
                $data['equipment']['jack'] = 0;
            }

            //Safety Triangle 
            $data['equipment']['safety_triangle'] = 0;
            $equipment_safety_triangle= Inventory_uncategorized::where('product_name' , '=' , 'Safety Triangle')->get();
            if(!$equipment_safety_triangle->isEmpty()){
                
                foreach($equipment_safety_triangle as $safety_triangle){
                    $data['equipment']['safety_triangle'] += (int)$safety_triangle->unit;
                } 
            }else{
                $data['equipment']['safety_triangle'] = 0;
            }

            //Emergency Light 
            $data['equipment']['emergency_light'] = 0;
            $equipment_emergency_light= Inventory_uncategorized::where('product_name' , '=' , 'Emergency Light')->get();
            if(!$equipment_emergency_light->isEmpty()){
                
                foreach($equipment_emergency_light as $equipment_emergency_light_quntity){
                    $data['equipment']['emergency_light'] += (int)$equipment_emergency_light_quntity->unit;
                } 
            }else{
                $data['equipment']['emergency_light'] = 0;
            }

            //Safety Shoes 
            $data['equipment']['safety_shoes'] = 0;
            $equipment_safety_shoes= Inventory_uncategorized::where('product_name' , '=' , 'Safety Shoes')->get();
            if(!$equipment_safety_shoes->isEmpty()){
                
                foreach($equipment_safety_shoes as $safety_shoes_quntity){
                    $data['equipment']['safety_shoes'] += (int)$safety_shoes_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_shoes'] = 0;
            }

            //Safety Helemt 
            $data['equipment']['safety_helemt'] = 0;
            $equipment_safety_helemt= Inventory_uncategorized::where('product_name' , '=' , 'Safety Helemt')->get();
            if(!$equipment_safety_helemt->isEmpty()){
                
                foreach($equipment_safety_helemt as $equipment_safety_helemt_quntity){
                    $data['equipment']['safety_helemt'] += (int)$equipment_safety_helemt_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_helemt'] = 0;
            }

            //Safety Gloves 
            $data['equipment']['safety_gloves'] = 0;
            $equipment_safety_gloves= Inventory_uncategorized::where('product_name' , '=' , 'Safety Gloves')->get();
            if(!$equipment_safety_gloves->isEmpty()){
                
                foreach($equipment_safety_gloves as $equipment_safety_gloves_quntity){
                    $data['equipment']['safety_gloves'] += (int)$equipment_safety_gloves_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_gloves'] = 0;
            }

            //Safety Jacket 
            $data['equipment']['safety_jacket'] = 0;
            $equipment_safety_jacket= Inventory_uncategorized::where('product_name' , '=' , 'Safety Jacket')->get();
            if(!$equipment_safety_jacket->isEmpty()){
                
                foreach($equipment_safety_jacket as $equipment_safety_jacket_quntity){
                    $data['equipment']['safety_jacket'] += (int)$equipment_safety_jacket_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_jacket'] = 0;
            }

            //Safety Ear Plug 
            $data['equipment']['safety_ear_plug'] = 0;
            $equipment_safety_ear_plug= Inventory_uncategorized::where('product_name' , '=' , 'Safety Ear Plug')->get();
            if(!$equipment_safety_ear_plug->isEmpty()){
                
                foreach($equipment_safety_ear_plug as $equipment_safety_ear_plug_quntity){
                    $data['equipment']['safety_ear_plug'] += (int)$equipment_safety_ear_plug_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_ear_plug'] = 0;
            }

            //Lashing Belt 
            $data['equipment']['lashing_belt_long'] = 0;
            $equipment_lashing_belt_long= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Belt Long')->get();
            if(!$equipment_lashing_belt_long->isEmpty()){
                
                foreach($equipment_lashing_belt_long as $equipment_lashing_belt_long_quntity){
                    $data['equipment']['lashing_belt_long'] += (int)$equipment_lashing_belt_long_quntity->unit;
                } 
            }else{
                $data['equipment']['lashing_belt_long'] = 0;
            }

            $data['equipment']['lashing_belt_short'] = 0;
            $equipment_lashing_belt_short= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Belt Short')->get();
            if(!$equipment_lashing_belt_short->isEmpty()){
                
                foreach($equipment_lashing_belt_short as $equipment_lashing_belt_short_quntity){
                    $data['equipment']['lashing_belt_short'] += (int)$equipment_lashing_belt_short_quntity->unit;
                } 
            }else{
                $data['equipment']['lashing_belt_short'] = 0;
            }

            //Lashing Chain 
            $data['equipment']['lashing_chain'] = 0;
            $equipment_lashing_chain= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Chain')->get();
            if(!$equipment_lashing_chain->isEmpty()){
                
                foreach($equipment_lashing_chain as $equipment_lashing_chain_quntity){
                    $data['equipment']['lashing_chain'] += (int)$equipment_lashing_chain_quntity->unit;
                } 
            }else{
                $data['equipment']['lashing_chain'] = 0;
            }

            //Side _Grill 
            $data['equipment']['side_grill'] = 0;
            $equipment_side_grill= Inventory_uncategorized::where('product_name' , '=' , 'Side Grill')->get();
            if(!$equipment_side_grill->isEmpty()){
                
                foreach($equipment_side_grill as $equipment_side_grill_quntity){
                    $data['equipment']['side_grill'] += (int)$equipment_side_grill_quntity->unit;
                } 
            }else{
                $data['equipment']['side_grill'] = 0;
            }

            //Container Lock 
            $data['equipment']['container_lock'] = 0;
            $equipment_container_lock= Inventory_uncategorized::where('product_name' , '=' , 'Container Lock')->get();
            if(!$equipment_container_lock->isEmpty()){
                
                foreach($equipment_container_lock as $equipment_container_lock_quntity){
                    $data['equipment']['container_lock'] += (int)$equipment_container_lock_quntity->unit;
                } 
            }else{
                $data['equipment']['container_lock'] = 0;
            }

            //Rope Seal 
            $data['equipment']['rope_seal'] = 0;
            $equipment_rope_seal= Inventory_uncategorized::where('product_name' , '=' , 'Rope Seal')->get();
            if(!$equipment_rope_seal->isEmpty()){
                
                foreach($equipment_rope_seal as $equipment_rope_seal_quntity){
                    $data['equipment']['rope_seal'] += (int)$equipment_rope_seal_quntity->unit;
                } 
            }else{
                $data['equipment']['rope_seal'] = 0;
            }

            //lashing_angle 
            $data['equipment']['lashing_angle'] = 0;
            $equipment_lashing_angle= Inventory_uncategorized::where('product_name' , '=' , 'Rope Seal')->get();
            if(!$equipment_lashing_angle->isEmpty()){
                
                foreach($equipment_lashing_angle as $equipment_lashing_angle_quntity){
                    $data['equipment']['lashing_angle'] += (int)$equipment_lashing_angle_quntity->unit;
                } 
            }else{
                $data['equipment']['lashing_angle'] = 0;
            }

            //Tarpaulin 
            $data['equipment']['tarpaulin'] = 0;
            $equipment_tarpaulin= Inventory_uncategorized::where('product_name' , '=' , 'Tarpaulin')->get();
            if(!$equipment_tarpaulin->isEmpty()){
                
                foreach($equipment_tarpaulin as $equipment_tarpaulin_quntity){
                    $data['equipment']['tarpaulin'] += (int)$equipment_tarpaulin_quntity->unit;
                } 
            }else{
                $data['equipment']['tarpaulin'] = 0;
            }

            //Tail Lift 
            $data['equipment']['tail_lift'] = 0;
            $equipment_tail_lift= Inventory_uncategorized::where('product_name' , '=' , 'Tail Lift')->get();
            if(!$equipment_tail_lift->isEmpty()){
                
                foreach($equipment_tail_lift as $equipment_tail_lift_quntity){
                    $data['equipment']['tail_lift'] += (int)$equipment_tail_lift_quntity->unit;
                } 
            }else{
                $data['equipment']['tail_lift'] = 0;
            }

            //Trolly 
            $data['equipment']['trolly'] = 0;
            $equipment_trolly= Inventory_uncategorized::where('product_name' , '=' , 'Trolly')->get();
            if(!$equipment_trolly->isEmpty()){
                
                foreach($equipment_trolly as $equipment_trolly_quntity){
                    $data['equipment']['trolly'] += (int)$equipment_trolly_quntity->unit;
                } 
            }else{
                $data['equipment']['trolly'] = 0;
            }
        }

        $data['page_title'] = "Edit Vehicle";
        $data['view'] = 'vehicle.edit_vehicle.edit_own_new_vehicle';
        return view('users.layout', ["data"=>$data]);

    }

    public function edit_hired_sub_contractor_vehicle(Request $request){
        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 9)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Hired Sub Contractor Vehicle
        ";
        $data['view'] = 'vehicle.edit_vehicle.edit_hired_sub_contractor_vehicle';
        return view('users.layout', ["data"=>$data]);

    }

    public function save_truck_type(Request $request){
           
        $truck_type_name = new Vehicle_truck_type;
        $truck_type_name->name = $request->input('new_truck_type');
        $truck_type_name->save();

        $truck_type_names =  Vehicle_truck_type::all();
        $row = '';
        $row .= " <select name='truck_type' class='form-control'>";
        foreach($truck_type_names as $truck_type){
            $row .= "<option value='".$truck_type->id ."'>". $truck_type->name . "</option>";
        }

        $row .= "</select>";

        
        return response()->json(['status'=>'1' , 'row'=> $row]);

    }

    public function save_pickup_type(Request $request){
           
        $pickup_type_name = new Vehicle_pickup_type;
        $pickup_type_name->name = $request->input('new_pickup_type');
        $pickup_type_name->save();

        $pickup_type_names =  Vehicle_pickup_type::all();
        $row = '';
        $row .= " <select name='pickup_shape' class='form-control'>";
        foreach($pickup_type_names as $pickup_type){
            $row .= "<option value='".$pickup_type->id ."'>". $pickup_type->name . "</option>";
        }

        $row .= "</select>";

        
        return response()->json(['status'=>'1' , 'row'=> $row]);

    }

    public function vehicle_fleet(){
        $data['modules']= DB::table('modules')->get();

      
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 9)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        
        $data['vehicle_info'] = Vehicle::where('registration_type', '=', 'vehicle')->get();
        $data['trailer'] = Vehicle::where('registration_type', '=', 'trailer')->get();

        // dd( $data['vehicle_info']); 
        $data['page_title'] = "Vehicle Fleet";
        $data['view'] = 'vehicle.fleet_vehicle';
        return view('users.layout', ["data"=>$data]);
    }

    public function trailer_fleet(){
        $data['modules']= DB::table('modules')->get();

      
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 9)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        
        $data['vehicle_info'] = Vehicle::where('registration_type', '=', 'trailer')->get();
        $data['trailer'] = Vehicle::where('registration_type', '=', 'vehicle')->get();

        // dd( $data['vehicle_info']); 
        $data['page_title'] = "Trailer Fleet";
        $data['view'] = 'vehicle.fleet_trailer';
        return view('users.layout', ["data"=>$data]);
    }

    public function assign_vehicle(){
        //equipment
        {
            $data['equipment'] = [];

            //Medical Kit
            $data['equipment']['medical_kit'] = 0;
            $equipment_medical_kit= Inventory_uncategorized::where('product_name' , '=' , 'Medical Kit')->get();
            if(!$equipment_medical_kit->isEmpty()){
                
                foreach($equipment_medical_kit as $medical_kit_quntity){
                   

                    $data['equipment']['medical_kit'] += (int)$medical_kit_quntity->unit;
                } 
            }else{
                $data['equipment']['medical_kit'] = 0;
            }
        
            //Fire Extinguisher 
            $data['equipment']['fire_extinguisher'] = 0;
            $equipment_fire_extinguisher= Inventory_uncategorized::where('product_name' , '=' , 'Fire Extinguisher')->get();
            
            if(!$equipment_fire_extinguisher->isEmpty()){
                
                foreach($equipment_fire_extinguisher as $fire_extinguisher_quntity){
                    $data['equipment']['fire_extinguisher'] += (int)$fire_extinguisher_quntity->unit;
                } 
            }else{
                
                $data['equipment']['fire_extinguisher'] = 0;
            }

            //safety_triangle 
            $data['equipment']['safety_triangle'] = 0;
            $equipment_safety_triangle= Inventory_uncategorized::where('product_name' , '=' , 'Safety Triangle')->get();
            
            if(!$equipment_safety_triangle->isEmpty()){
                
                foreach($equipment_safety_triangle as $equipment_safety_triangle_quntity){
                    $data['equipment']['safety_triangle'] += (int)$equipment_safety_triangle_quntity->unit;
                } 
            }else{
                
                $data['equipment']['safety_triangle'] = 0;
            }

            //Jack 
            $data['equipment']['jack'] = 0;
            $equipment_jack= Inventory_uncategorized::where('product_name' , '=' , 'Jack')->get();
            if(!$equipment_jack->isEmpty()){
                
                foreach($equipment_jack as $jack_quntity){
                    $data['equipment']['jack'] += (int)$jack_quntity->unit;
                } 
            }else{
                $data['equipment']['jack'] = 0;
            }

            

            //Emergency Light 
            $data['equipment']['emergency_light'] = 0;
            $equipment_emergency_light= Inventory_uncategorized::where('product_name' , '=' , 'Emergency Light')->get();
            if(!$equipment_emergency_light->isEmpty()){
                
                foreach($equipment_emergency_light as $equipment_emergency_light_quntity){
                    $data['equipment']['emergency_light'] += (int)$equipment_emergency_light_quntity->unit;
                } 
            }else{
                $data['equipment']['emergency_light'] = 0;
            }

            //Safety Shoes 
            $data['equipment']['safety_shoes'] = 0;
            $equipment_safety_shoes= Inventory_uncategorized::where('product_name' , '=' , 'Safety Shoes')->get();
            if(!$equipment_safety_shoes->isEmpty()){
                
                foreach($equipment_safety_shoes as $safety_shoes_quntity){
                    $data['equipment']['safety_shoes'] += (int)$safety_shoes_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_shoes'] = 0;
            }

            //Safety Helemt 
            $data['equipment']['safety_helemt'] = 0;
            $equipment_safety_helemt= Inventory_uncategorized::where('product_name' , '=' , 'Safety Helemt')->get();
            if(!$equipment_safety_helemt->isEmpty()){
                
                foreach($equipment_safety_helemt as $equipment_safety_helemt_quntity){
                    $data['equipment']['safety_helemt'] += (int)$equipment_safety_helemt_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_helemt'] = 0;
            }

            //Safety Gloves 
            $data['equipment']['safety_gloves'] = 0;
            $equipment_safety_gloves= Inventory_uncategorized::where('product_name' , '=' , 'Safety Gloves')->get();
            if(!$equipment_safety_gloves->isEmpty()){
                
                foreach($equipment_safety_gloves as $equipment_safety_gloves_quntity){
                    $data['equipment']['safety_gloves'] += (int)$equipment_safety_gloves_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_gloves'] = 0;
            }

            //Safety Jacket 
            $data['equipment']['safety_jacket'] = 0;
            $equipment_safety_jacket= Inventory_uncategorized::where('product_name' , '=' , 'Safety Jacket')->get();
            if(!$equipment_safety_jacket->isEmpty()){
                
                foreach($equipment_safety_jacket as $equipment_safety_jacket_quntity){
                    $data['equipment']['safety_jacket'] += (int)$equipment_safety_jacket_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_jacket'] = 0;
            }

            //Safety Ear Plug 
            $data['equipment']['safety_ear_plug'] = 0;
            $equipment_safety_ear_plug= Inventory_uncategorized::where('product_name' , '=' , 'Safety Ear Plug')->get();
            if(!$equipment_safety_ear_plug->isEmpty()){
                
                foreach($equipment_safety_ear_plug as $equipment_safety_ear_plug_quntity){
                    $data['equipment']['safety_ear_plug'] += (int)$equipment_safety_ear_plug_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_ear_plug'] = 0;
            }

            //Lashing Belt 
            $data['equipment']['lashing_belt_long'] = 0;
            $equipment_lashing_belt_long= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Belt Long')->get();
            if(!$equipment_lashing_belt_long->isEmpty()){
                
                foreach($equipment_lashing_belt_long as $equipment_lashing_belt_long_quntity){
                    $data['equipment']['lashing_belt_long'] += (int)$equipment_lashing_belt_long_quntity->unit;
                } 
            }else{
                $data['equipment']['lashing_belt_long'] = 0;
            }

            $data['equipment']['lashing_belt_short'] = 0;
            $equipment_lashing_belt_short= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Belt Short')->get();
            if(!$equipment_lashing_belt_short->isEmpty()){
                
                foreach($equipment_lashing_belt_short as $equipment_lashing_belt_short_quntity){
                    $data['equipment']['lashing_belt_short'] += (int)$equipment_lashing_belt_short_quntity->unit;
                } 
            }else{
                $data['equipment']['lashing_belt_short'] = 0;
            }

            //Lashing Chain 
            $data['equipment']['lashing_chain'] = 0;
            $equipment_lashing_chain= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Chain')->get();
            if(!$equipment_lashing_chain->isEmpty()){
                
                foreach($equipment_lashing_chain as $equipment_lashing_chain_quntity){
                    $data['equipment']['lashing_chain'] += (int)$equipment_lashing_chain_quntity->unit;
                } 
            }else{
                $data['equipment']['lashing_chain'] = 0;
            }

            //Side _Grill 
            $data['equipment']['side_grill'] = 0;
            $equipment_side_grill= Inventory_uncategorized::where('product_name' , '=' , 'Side Grill')->get();
            if(!$equipment_side_grill->isEmpty()){
                
                foreach($equipment_side_grill as $equipment_side_grill_quntity){
                    $data['equipment']['side_grill'] += (int)$equipment_side_grill_quntity->unit;
                } 
            }else{
                $data['equipment']['side_grill'] = 0;
            }

            //Container Lock 
            $data['equipment']['container_lock'] = 0;
            $equipment_container_lock= Inventory_uncategorized::where('product_name' , '=' , 'Container Lock')->get();
            if(!$equipment_container_lock->isEmpty()){
                
                foreach($equipment_container_lock as $equipment_container_lock_quntity){
                    $data['equipment']['container_lock'] += (int)$equipment_container_lock_quntity->unit;
                } 
            }else{
                $data['equipment']['container_lock'] = 0;
            }

            //Rope Seal 
            $data['equipment']['rope_seal'] = 0;
            $equipment_rope_seal= Inventory_uncategorized::where('product_name' , '=' , 'Rope Seal')->get();
            if(!$equipment_rope_seal->isEmpty()){
                
                foreach($equipment_rope_seal as $equipment_rope_seal_quntity){
                    $data['equipment']['rope_seal'] += (int)$equipment_rope_seal_quntity->unit;
                } 
            }else{
                $data['equipment']['rope_seal'] = 0;
            }

            //lashing_angle 
            $data['equipment']['lashing_angle'] = 0;
            $equipment_lashing_angle= Inventory_uncategorized::where('product_name' , '=' , 'Rope Seal')->get();
            if(!$equipment_lashing_angle->isEmpty()){
                
                foreach($equipment_lashing_angle as $equipment_lashing_angle_quntity){
                    $data['equipment']['lashing_angle'] += (int)$equipment_lashing_angle_quntity->unit;
                } 
            }else{
                $data['equipment']['lashing_angle'] = 0;
            }

            //Tarpaulin 
            $data['equipment']['tarpaulin'] = 0;
            $equipment_tarpaulin= Inventory_uncategorized::where('product_name' , '=' , 'Tarpaulin')->get();
            if(!$equipment_tarpaulin->isEmpty()){
                
                foreach($equipment_tarpaulin as $equipment_tarpaulin_quntity){
                    $data['equipment']['tarpaulin'] += (int)$equipment_tarpaulin_quntity->unit;
                } 
            }else{
                $data['equipment']['tarpaulin'] = 0;
            }

            //Tail Lift 
            $data['equipment']['tail_lift'] = 0;
            $equipment_tail_lift= Inventory_uncategorized::where('product_name' , '=' , 'Tail Lift')->get();
            if(!$equipment_tail_lift->isEmpty()){
                
                foreach($equipment_tail_lift as $equipment_tail_lift_quntity){
                    $data['equipment']['tail_lift'] += (int)$equipment_tail_lift_quntity->unit;
                } 
            }else{
                $data['equipment']['tail_lift'] = 0;
            }

            //Trolly 
            $data['equipment']['trolly'] = 0;
            $equipment_trolly= Inventory_uncategorized::where('product_name' , '=' , 'Trolly')->get();
            if(!$equipment_trolly->isEmpty()){
                
                foreach($equipment_trolly as $equipment_trolly_quntity){
                    $data['equipment']['trolly'] += (int)$equipment_trolly_quntity->unit;
                } 
            }else{
                $data['equipment']['trolly'] = 0;
            }
        }
        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 9)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['vehicle'] =  Vehicle::where('status' , '=' , 'approved')->get();

        
        $data['assign_vehicle'] = assign_unassign_vehicle::all();
        $data['driver'] = Employee::where('designation' , '=' , 'driver')->where('row_status' ,'!=' , 'deleted')->get();
        $data['page_title'] = "Assign/Unassign Vehicle";
        $data['view'] = 'vehicle.assign_unassign.assign_unassign_vehicle';
        return view('users.layout', ["data"=>$data]);
    }

    public function assign_vehicle_save(Request $request){
        $assign_vehicle = new assign_unassign_vehicle();
        $equipment_list = new vehicle_equipment_list();

        $vehicle = vehicle::find((int)$request->input('vehicle_id'));
        $driver = Employee::find((int)$request->input('driver_id'));
        //vehicle_id 
        if($request->input('vehicle_id') != ''){
            $assign_vehicle->vehicle_id = $request->input('vehicle_id');
        }

        if($request->input('driver_id') != ''){
            $assign_vehicle->driver_id = $request->input('driver_id');
        }
        
        if ($request->hasFile('handover_form')) {

            $name = time().'_'.str_replace(" ", "_", $request->handover_form->getClientOriginalName());
            $file = $request->file('handover_form');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $assign_vehicle->handover_form = $name;

            }
            
        }

        if ($request->hasFile('interior_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->interior_photo->getClientOriginalName());
            $file = $request->file('interior_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $assign_vehicle->assign_vehicle_interior_photo = $name;

            }
            
        }

        if ($request->hasFile('exterior_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->exterior_photo->getClientOriginalName());
            $file = $request->file('exterior_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $assign_vehicle->assign_vehicle_exterior_photo = $name;

            }
        }
        {
            //step 3 
            if($vehicle->medical_kit == 1 ){
                if($request->input('medical_kit') == 0){
                    $vehicle->medical_kit = 1;
                    $equipment_list->medical_kit = 1;
                }else{
                    $equipment_medical_kit= Inventory_uncategorized::where('product_name' , '=' , 'Medical Kit')->get();
                    foreach($equipment_medical_kit as $medical_kit){
                        if($medical_kit->unit > 0 ){
                            $medical_kit->unit =  $medical_kit->unit + 1;
                            $medical_kit->save();   
                        }

                    }
                    $vehicle->medical_kit = 0;
                    $equipment_list->medical_kit = 0;

                }


            }else{
                if($request->input('medical_kit') == 0){
                    $equipment_medical_kit= Inventory_uncategorized::where('product_name' , '=' , 'Medical Kit')->get();
                    foreach($equipment_medical_kit as $medical_kit){
                        if($medical_kit->unit > 0 ){
                            $medical_kit->unit =  $medical_kit->unit - 1;
                            $medical_kit->save();   
                        }

                    }
                    $vehicle->medical_kit = 1;
                    $equipment_list->medical_kit = 1;

                }else{
                    $vehicle->medical_kit = 0;
                    $equipment_list->medical_kit = 0;
                    
                }
            }

            //fire_extinguisher
            if($vehicle->fire_ext == 1 ){
                if($request->input('fire_ext') == 0){
                    $vehicle->fire_ext = 1;
                    $equipment_list->fire_ext = 1;

                    $vehicle->fire_ext_weight = $request->input('fire_ext_weight');
                    $vehicle->fire_ext_expiry = $request->input('fire_ext_expiry');

                }else{
                    $equipment_fire_ext= Inventory_uncategorized::where('product_name' , '=' , 'Fire Extinguisher')->get();
                    foreach($equipment_fire_ext as $fire_ext){
                        if($fire_ext->unit > 0 ){
                            $fire_ext->unit =  $fire_ext->unit + 1;
                            $fire_ext->save();   
                        }

                    }
                    $vehicle->fire_ext = 0;
                    $equipment_list->fire_ext = 0;

                    $vehicle->fire_ext_weight = $request->input('fire_ext_weight');
                    $vehicle->fire_ext_expiry = $request->input('fire_ext_expiry');
                }


            }else{
                if($request->input('fire_ext') == 0){
                    $equipment_fire_ext= Inventory_uncategorized::where('product_name' , '=' , 'Fire Extinguisher')->get();
                    foreach($equipment_fire_ext as $fire_ext){
                        if($fire_ext->unit > 0 ){
                            $fire_ext->unit =  $fire_ext->unit - 1;
                            $fire_ext->save();   
                        }

                    }
                    $vehicle->fire_ext = 1;
                    $equipment_list->fire_ext = 1;

                    $vehicle->fire_ext_weight = $request->input('fire_ext_weight');
                    $vehicle->fire_ext_expiry = $request->input('fire_ext_expiry');

                }else{
                    $vehicle->fire_ext = 0;
                    $equipment_list->fire_ext = 0;
                    
                    $vehicle->fire_ext_weight = $request->input('fire_ext_weight');
                    $vehicle->fire_ext_expiry = $request->input('fire_ext_expiry');
                    
                }
            }

            //Jack
            if($vehicle->jack == 1 ){
                if($request->input('jack') == 0){
                    $vehicle->jack = 1;
                    $equipment_list->jack = 1;
                    

                }else{
                    $equipment_jack= Inventory_uncategorized::where('product_name' , '=' , 'Jack')->get();
                    foreach($equipment_jack as $jack){
                        if($jack->unit > 0 ){
                            $jack->unit =  $jack->unit + 1;
                            $jack->save();   
                        }

                    }
                    $vehicle->jack = 0;
                    $equipment_list->jack = 0;
                   
                }


            }else{
                if($request->input('jack') == 0){
                    $equipment_jack= Inventory_uncategorized::where('product_name' , '=' , 'Jack')->get();
                    foreach($equipment_jack as $jack){
                        if($jack->unit > 0 ){
                            $jack->unit =  $jack->unit - 1;
                            $jack->save();   
                        }

                    }
                    $vehicle->jack = 1;
                    $equipment_list->jack = 1;
                    

                }else{
                    $vehicle->jack = 0;
                    $equipment_list->jack = 0;
                    
                    
                }
            }
            //Safety Triangle
            if($vehicle->safety_triangle == 1 ){
                if($request->input('safety_triangle') == 0){
                    $vehicle->safety_triangle = 1;
                    $equipment_list->safety_triangle = 1;
                    

                }else{
                    $equipment_safety_triangle= Inventory_uncategorized::where('product_name' , '=' , 'Safety Triangle')->get();
                    foreach($equipment_safety_triangle as $safety_triangle){
                        if($safety_triangle->unit > 0 ){
                            $safety_triangle->unit =  $safety_triangle->unit + 1;
                            $safety_triangle->save();   
                        }

                    }
                    $vehicle->safety_triangle = 0;
                    $equipment_list->safety_triangle = 0;
                    
                }


            }else{
                if($request->input('safety_triangle') == 0){
                    $equipment_safety_triangle= Inventory_uncategorized::where('product_name' , '=' , 'Safety Triangle')->get();
                    foreach($equipment_safety_triangle as $safety_triangle){
                        if($safety_triangle->unit > 0 ){
                            $safety_triangle->unit =  $safety_triangle->unit - 1;
                            $safety_triangle->save();   
                        }

                    }
                    $vehicle->safety_triangle = 1;
                    $equipment_list->safety_triangle = 1;
                    

                }else{
                    $vehicle->safety_triangle = 0;
                    $equipment_list->safety_triangle = 0;
                    
                    
                }
            }

            //emergency_light
            

            if($vehicle->emergency_light == 1 ){
                if($request->input('extra_emergency_light') == 0){
                    $vehicle->extra_emergency_light = 1;
                    $equipment_list->extra_emergency_light = 1;
                    

                }else{
                    $equipment_emergency_light= Inventory_uncategorized::where('product_name' , '=' , 'Emergency light')->get();
                    foreach($equipment_emergency_light as $emergency_light){
                        if($emergency_light->unit > 0 ){
                            $emergency_light->unit =  $emergency_light->unit + 1;
                            $emergency_light->save();   
                        }

                    }
                    $vehicle->extra_emergency_light = 0;
                    $equipment_list->extra_emergency_light = 0;
                   
                }


            }else{
                if($request->input('extra_emergency_light') == 0){
                    $equipment_emergency_light= Inventory_uncategorized::where('product_name' , '=' , 'Emergency light')->get();
                    foreach($equipment_emergency_light as $emergency_light){
                        if($emergency_light->unit > 0 ){
                            $emergency_light->unit =  $emergency_light->unit - 1;
                            $emergency_light->save();   
                        }

                    }
                    $equipment_list->extra_emergency_light = 1;
                    $vehicle->extra_emergency_light = 1;
                    

                }else{
                    $vehicle->extra_emergency_light = 0;
                    $equipment_list->extra_emergency_light = 0;
                    
                    
                }
            }

            //Safety Shoes
            if($vehicle->safety_shoes == 1 ){
                if($request->input('safety_shoes') == 0){
                    $vehicle->safety_shoes = 1;
                    $equipment_list->safety_shoes = 1;
                    

                }else{
                    $equipment_safety_shoes= Inventory_uncategorized::where('product_name' , '=' , 'Safety Shoes')->get();
                    foreach($equipment_safety_shoes as $safety_shoes){
                        if($safety_shoes->unit > 0 ){
                            $safety_shoes->unit =  $safety_shoes->unit + 1;
                            $safety_shoes->save();   
                        }

                    }
                    $vehicle->safety_shoes = 0;
                    $equipment_list->safety_shoes = 0;
                   
                }


            }else{
                if($request->input('safety_shoes') == 0){
                    $equipment_safety_shoes= Inventory_uncategorized::where('product_name' , '=' , 'Safety Shoes')->get();
                    foreach($equipment_safety_shoes as $safety_shoes){
                        if($safety_shoes->unit > 0 ){
                            $safety_shoes->unit =  $safety_shoes->unit - 1;
                            $safety_shoes->save();   
                        }

                    }
                    $vehicle->safety_shoes = 1;
                    $equipment_list->safety_shoes = 1;
                    

                }else{
                    $vehicle->safety_shoes = 0;
                    $equipment_list->safety_shoes = 0;
                    
                    
                }
            }
            
            //Safety Helemt
            if($vehicle->safety_helmet == 1 ){
                if($request->input('safety_helmet') == 0){
                    $vehicle->safety_helmet = 1;
                    $equipment_list->safety_helmet = 1;
                    

                }else{
                    $equipment_safety_helmet= Inventory_uncategorized::where('product_name' , '=' , 'Safety Helemt')->get();
                    foreach($equipment_safety_helmet as $safety_helmet){
                        if($safety_helmet->unit > 0 ){
                            $safety_helmet->unit =  $safety_helmet->unit + 1;
                            $safety_helmet->save();   
                        }

                    }
                    $vehicle->safety_helmet = 0;
                    $equipment_list->safety_helmet = 0;
                   
                }


            }else{
                if($request->input('safety_helmet') == 0){
                    $equipment_safety_helmet= Inventory_uncategorized::where('product_name' , '=' , 'Safety Helemt')->get();
                    foreach($equipment_safety_helmet as $safety_helmet){
                        if($safety_helmet->unit > 0 ){
                            $safety_helmet->unit =  $safety_helmet->unit - 1;
                            $safety_helmet->save();   
                        }

                    }
                    $vehicle->safety_helmet = 1;
                    $equipment_list->safety_helmet = 1;
                    

                }else{
                    $vehicle->safety_helmet = 0;
                    $equipment_list->safety_helmet = 0;
                    
                    
                }
            }

            //safety_gloves
            if($vehicle->safety_gloves == 1 ){
                if($request->input('safety_gloves') == 0){
                    $vehicle->safety_gloves = 1;
                    $equipment_list->safety_gloves = 1;
                    

                }else{
                    $equipment_safety_gloves= Inventory_uncategorized::where('product_name' , '=' , 'Safety Gloves')->get();
                    foreach($equipment_safety_gloves as $safety_gloves){
                        if($safety_gloves->unit > 0 ){
                            $safety_gloves->unit =  $safety_gloves->unit + 1;
                            $safety_gloves->save();   
                        }

                    }
                    $vehicle->safety_gloves = 0;
                    $equipment_list->safety_gloves = 0;
                   
                }


            }else{
                if($request->input('safety_gloves') == 0){
                    $equipment_safety_gloves= Inventory_uncategorized::where('product_name' , '=' , 'Safety Gloves')->get();
                    foreach($equipment_safety_gloves as $safety_gloves){
                        if($safety_gloves->unit > 0 ){
                            $safety_gloves->unit =  $safety_gloves->unit - 1;
                            $safety_gloves->save();   
                        }

                    }
                    $vehicle->safety_gloves = 1;
                    $equipment_list->safety_gloves = 1;
                    

                }else{
                    $equipment_list->safety_gloves = 0;
                    $vehicle->safety_gloves = 0;
                    
                    
                }
            }
            
            //Safety Jacket
           
            if($vehicle->safety_jacket == 1 ){
                if($request->input('safety_jacket') == 0){
                    $vehicle->safety_jacket = 1;
                    $equipment_list->safety_jacket = 1;
                    

                }else{
                    $equipment_safety_jacket= Inventory_uncategorized::where('product_name' , '=' , 'Safety Jacket')->get();
                    foreach($equipment_safety_jacket as $safety_jacket){
                        if($safety_jacket->unit > 0 ){
                            $safety_jacket->unit =  $safety_jacket->unit + 1;
                            $safety_jacket->save();   
                        }

                    }
                    $vehicle->safety_jacket = 0;
                    $equipment_list->safety_jacket = 0;
                   
                }


            }else{
                if($request->input('safety_jacket') == 0){
                    $equipment_safety_jacket= Inventory_uncategorized::where('product_name' , '=' , 'Safety Jacket')->get();
                    foreach($equipment_safety_jacket as $safety_jacket){
                        if($safety_jacket->unit > 0 ){
                            $safety_jacket->unit =  $safety_jacket->unit - 1;
                            $safety_jacket->save();   
                        }

                    }
                    $vehicle->safety_jacket = 1;
                    $equipment_list->safety_jacket = 1;
                    

                }else{
                    $vehicle->safety_jacket = 0;
                    $equipment_list->safety_jacket = 0;
                    
                    
                }
            }

            //Safety Ear Plug
            if($vehicle->safety_ear_plug == 1 ){
                if($request->input('safety_ear_plug') == 0){
                    $vehicle->safety_ear_plug = 1;
                    $equipment_list->safety_ear_plug = 1;
                    

                }else{
                    $equipment_safety_ear_plug= Inventory_uncategorized::where('product_name' , '=' , 'Safety Ear Plug')->get();
                    foreach($equipment_safety_ear_plug as $safety_ear_plug){
                        if($safety_ear_plug->unit > 0 ){
                            $safety_ear_plug->unit =  $safety_ear_plug->unit + 1;
                            $safety_ear_plug->save();   
                        }

                    }
                    $vehicle->safety_ear_plug = 0;
                    $equipment_list->safety_ear_plug = 0;
                   
                }


            }else{
                if($request->input('safety_ear_plug') == 0){
                    $equipment_safety_ear_plug= Inventory_uncategorized::where('product_name' , '=' , 'Safety Ear Plug')->get();
                    foreach($equipment_safety_ear_plug as $safety_ear_plug){
                        if($safety_ear_plug->unit > 0 ){
                            $safety_ear_plug->unit =  $safety_ear_plug->unit - 1;
                            $safety_ear_plug->save();   
                        }

                    }
                    $equipment_list->safety_ear_plug = 1;
                    $vehicle->safety_ear_plug = 1;
                    

                }else{
                    $vehicle->safety_ear_plug = 0;
                    $equipment_list->safety_ear_plug = 0;
                    
                    
                }
            }

            // //lashing_belt_long
            // if($request->input('lashing_belt_quantity_long') > 0 ){
            //     $equipment_lashing_belt_long= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Belt Long')->get();
            //     foreach($equipment_lashing_belt_long as $lashing_belt_long){
            //         if($lashing_belt_longs->unit > 0 ){
            //             $lashing_belt_long->unit =  $lashing_belt_long->unit - (int)$request->input('lashing_belt_quantity_long');
            //             $lashing_belt_long->save();   
            //         }

            //     }
            //     $vehicle->lashing_belts = 1;
            //     $vehicle->lashing_belt_long_quantity = (int)$request->input('lashing_belt_quantity_long');

            // }

            // //lashing_belt_short
            // if($request->input('lashing_belt_quantity_short') > 0 ){
            //     $equipment_lashing_belt_short= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Belt Short')->get();
            //     foreach($equipment_lashing_belt_short as $lashing_belt_short){
            //         if($lashing_belt_shorts->unit > 0 ){
            //             $lashing_belt_short->unit =  $lashing_belt_short->unit - (int)$request->input('lashing_belt_quantity_short');
            //             $lashing_belt_short->save();   
            //         }

            //     }
            //     $vehicle->lashing_belts = 1;
            //     $vehicle->lashing_belt_short_quantity = (int)$request->input('lashing_belt_quantity_short');
            
            // }

            //lashing_chain
            if($vehicle->lashing_chain == 1 ){
                if($request->input('lashing_chain') == 0){
                    $vehicle->lashing_chain = 1;
                    $vehicle->lashing_chain_quantity = (int)$request->input('lashing_chain_quantity');
                    $equipment_list->lashing_chain = 1;
                    

                }else{
                    $equipment_lashing_chain= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Chain')->get();
                    foreach($equipment_lashing_chain as $lashing_chain){
                        if($lashing_chain->unit > 0 ){
                            $lashing_chain->unit =  $lashing_chain->unit + 1;
                            $lashing_chain->save();   
                        }

                    }
                    $vehicle->lashing_chain = 0;
                    $equipment_list->lashing_chain = 0;

                    $vehicle->lashing_chain_quantity = (int)$request->input('lashing_chain_quantity');
                   
                }


            }else{
                if($request->input('lashing_chain') == 0){
                    $equipment_lashing_chain= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Chain')->get();
                    foreach($equipment_lashing_chain as $lashing_chain){
                        if($lashing_chain->unit > 0 ){
                            $lashing_chain->unit =  $lashing_chain->unit - 1;
                            $lashing_chain->save();   
                        }

                    }
                    $vehicle->lashing_chain_quantity = (int)$request->input('lashing_chain_quantity');
                    $vehicle->lashing_chain = 1;
                    $equipment_list->lashing_chain = 1;
                    

                }else{
                    $vehicle->lashing_chain_quantity = (int)$request->input('lashing_chain_quantity');
                    $vehicle->lashing_chain = 0;
                    
                    $equipment_list->lashing_chain = 0;
                    
                }
            }

            
            //side_grill
            if($vehicle->side_grill == 1 ){
                if($request->input('side_grill') == 0){
                    $vehicle->side_grill = 1;
                    $vehicle->side_grill_quantity = (int)$request->input('side_grill_quantity');
                    $vehicle->side_grill_height = (int)$request->input('side_grill_height');
                    $equipment_list->side_grill = 1;

                    

                }else{
                    $equipment_side_grill= Inventory_uncategorized::where('product_name' , '=' , 'Side Grill')->get();
                    foreach($equipment_side_grill as $side_grill){
                        if($side_grill->unit > 0 ){
                            $side_grill->unit =  $side_grill->unit + 1;
                            $side_grill->save();   
                        }

                    }
                    $vehicle->side_grill = 0;
                    $equipment_list->side_grill = 0;

                    $vehicle->side_grill_quantity = (int)$request->input('side_grill_quantity');
                    $vehicle->side_grill_height = (int)$request->input('side_grill_height');

                   
                }


            }else{
                if($request->input('side_grill') == 0){
                    $equipment_side_grill= Inventory_uncategorized::where('product_name' , '=' , 'Side Grill')->get();
                    foreach($equipment_side_grill as $side_grill){
                        if($side_grill->unit > 0 ){
                            $side_grill->unit =  $side_grill->unit - 1;
                            $side_grill->save();   
                        }

                    }
                    $vehicle->side_grill_quantity = (int)$request->input('side_grill_quantity');
                    $vehicle->side_grill_height = (int)$request->input('side_grill_height');

                    $vehicle->side_grill = 1;
                    $equipment_list->side_grill = 1;
                    

                }else{
                    $vehicle->side_grill_quantity = (int)$request->input('side_grill_quantity');
                    $vehicle->side_grill_height = (int)$request->input('side_grill_height');

                    $vehicle->side_grill = 0;
                    $equipment_list->side_grill = 0;
                    
                    
                }
            }

            //container_lock

            if($vehicle->container_lock == 1 ){
                if($request->input('container_lock') == 0){
                    $vehicle->container_lock = 1;
                    $equipment_list->container_lock = 1;


                }else{
                    $equipment_container_lock= Inventory_uncategorized::where('product_name' , '=' , 'Container Lock')->get();
                    foreach($equipment_container_lock as $container_lock){
                        if($container_lock->unit > 0 ){
                            $container_lock->unit =  $container_lock->unit + 1;
                            $container_lock->save();   
                        }

                    }
                    $vehicle->container_lock = 0;
                    $equipment_list->container_lock = 0;
                }


            }else{
                if($request->input('container_lock') == 0){
                    $equipment_container_lock= Inventory_uncategorized::where('product_name' , '=' , 'Container Lock')->get();
                    foreach($equipment_container_lock as $container_lock){
                        if($container_lock->unit > 0 ){
                            $container_lock->unit =  $container_lock->unit - 1;
                            $container_lock->save();   
                        }

                    }

                    $vehicle->container_lock = 1;
                    $equipment_list->container_lock = 1;


                }else{
                    $vehicle->container_lock = 0;
                    $equipment_list->container_lock = 0;
                }
            }


            //Rope Seal

            if($vehicle->rope_seal == 1 ){
                if($request->input('rope_seal') == 0){
                    $vehicle->rope_seal = 1;
                    $equipment_list->rope_seal = 1;

                }else{
                    $equipment_rope_seal= Inventory_uncategorized::where('product_name' , '=' , 'Rope Seal')->get();
                    foreach($equipment_rope_seal as $rope_seal){
                        if($rope_seal->unit > 0 ){
                            $rope_seal->unit =  $rope_seal->unit + 1;
                            $rope_seal->save();   
                        }

                    }
                    $vehicle->rope_seal = 0;
                    $equipment_list->rope_seal = 0;

                }


            }else{
                if($request->input('rope_seal') == 0){
                    $equipment_rope_seal= Inventory_uncategorized::where('product_name' , '=' , 'Rope Seal')->get();
                    foreach($equipment_rope_seal as $rope_seal){
                        if($rope_seal->unit > 0 ){
                            $rope_seal->unit =  $rope_seal->unit - 1;
                            $rope_seal->save();   
                        }

                    }

                    $vehicle->rope_seal = 1;
                    $equipment_list->rope_seal = 1;

                }else{
                    $vehicle->rope_seal = 0;
                    $equipment_list->rope_seal = 0;

                }
            }

            //Lashing Angle
            
            if($vehicle->lashing_angle == 1 ){
                if($request->input('lashing_angle') == 0){
                    $vehicle->lashing_angle = 1;
                    $equipment_list->lashing_angle = 1;

                    $vehicle->lashing_angle_quantity = (int)$request->input('lashing_angle_quantity');
                    $vehicle->lashing_angle_size = (int)$request->input('lashing_angle_size');

                }else{
                    $equipment_lashing_angle= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Angle')->get();
                    foreach($equipment_lashing_angle as $lashing_angle){
                        if($lashing_angle->unit > 0 ){
                            $lashing_angle->unit =  $lashing_angle->unit + 1;
                            $lashing_angle->save();   
                        }

                    }
                    $vehicle->lashing_angle = 0;
                    $equipment_list->lashing_angle = 0;

                    $vehicle->lashing_angle_quantity = (int)$request->input('lashing_angle_quantity');
                    $vehicle->lashing_angle_size = (int)$request->input('lashing_angle_size');  
                }


            }else{
                if($request->input('lashing_angle') == 0){
                    $equipment_lashing_angle= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Angle')->get();
                    foreach($equipment_lashing_angle as $lashing_angle){
                        if($lashing_angle->unit > 0 ){
                            $lashing_angle->unit =  $lashing_angle->unit - 1;
                            $lashing_angle->save();   
                        }

                    }

                    $vehicle->lashing_angle = 1;
                    $equipment_list->lashing_angle = 1;

                    $vehicle->lashing_angle_quantity = (int)$request->input('lashing_angle_quantity');
                    $vehicle->lashing_angle_size = (int)$request->input('lashing_angle_size');
                }else{
                    $vehicle->lashing_angle = 0;
                    $equipment_list->lashing_angle = 0;

                    $vehicle->lashing_angle_quantity = (int)$request->input('lashing_angle_quantity');
                    $vehicle->lashing_angle_size = (int)$request->input('lashing_angle_size');
                }
            }

            

            //tarpaulin
            
            if($vehicle->tarpaulin == 1 ){
                if($request->input('tarpaulin') == 0){
                    $equipment_list->tarpaulin = 1;
                    $vehicle->tarpaulin = 1;
                    

                }else{
                    $equipment_tarpaulin= Inventory_uncategorized::where('product_name' , '=' , 'Tarpaulin')->get();
                    foreach($equipment_tarpaulin as $tarpaulin){
                        if($tarpaulin->unit > 0 ){
                            $tarpaulin->unit =  $tarpaulin->unit + 1;
                            $tarpaulin->save();   
                        }

                    }
                    $vehicle->tarpaulin = 0;
                    $equipment_list->tarpaulin = 0;
                     
                }


            }else{
                if($request->input('tarpaulin') == 0){
                    $equipment_tarpaulin= Inventory_uncategorized::where('product_name' , '=' , 'Tarpaulin')->get();
                    foreach($equipment_tarpaulin as $tarpaulin){
                        if($tarpaulin->unit > 0 ){
                            $tarpaulin->unit =  $tarpaulin->unit - 1;
                            $tarpaulin->save();   
                        }

                    }

                    $vehicle->tarpaulin = 1;
                    $equipment_list->tarpaulin = 1;
                    
                }else{
                    $vehicle->tarpaulin = 0;
                    $equipment_list->tarpaulin = 0;
                   
                }
            }
            //Tail Lift
            if($vehicle->tail_lift == 1 ){
                if($request->input('tail_lift') == 0){
                    $vehicle->tail_lift = 1;
                    $equipment_list->tail_lift = 1;
                    

                }else{
                    $equipment_tail_lift= Inventory_uncategorized::where('product_name' , '=' , 'Tail Lift')->get();
                    foreach($equipment_tail_lift as $tail_lift){
                        if($tail_lift->unit > 0 ){
                            $tail_lift->unit =  $tail_lift->unit + 1;
                            $tail_lift->save();   
                        }

                    }
                    $vehicle->tail_lift = 0;
                    $equipment_list->tail_lift = 0;
                    
                }


            }else{
                if($request->input('tail_lift') == 0){
                    $equipment_tail_lift= Inventory_uncategorized::where('product_name' , '=' , 'Tail Lift')->get();
                    foreach($equipment_tail_lift as $tail_lift){
                        if($tail_lift->unit > 0 ){
                            $tail_lift->unit =  $tail_lift->unit - 1;
                            $tail_lift->save();   
                        }

                    }

                    $equipment_list->tail_lift = 1;
                    $vehicle->tail_lift = 1;
                    
                }else{
                    $vehicle->tail_lift = 0;
                    $equipment_list->tail_lift = 0;
                   
                }
            }

            //Trolly
            if($vehicle->trolly == 1 ){
                if($request->input('trolly') == 0){
                    $equipment_list->trolly = 1;
                    $vehicle->trolly = 1;
                    

                }else{
                    $equipment_trolly= Inventory_uncategorized::where('product_name' , '=' , 'Trolly')->get();
                    foreach($equipment_trolly as $trolly){
                        if($trolly->unit > 0 ){
                            $trolly->unit =  $trolly->unit + 1;
                            $trolly->save();   
                        }

                    }
                    $vehicle->trolly = 0;
                    
                }


            }else{
                if($request->input('trolly') == 0){
                    $equipment_trolly= Inventory_uncategorized::where('product_name' , '=' , 'Trolly')->get();
                    foreach($equipment_trolly as $trolly){
                        if($trolly->unit > 0 ){
                            $trolly->unit =  $trolly->unit - 1;
                            $trolly->save();   
                        }

                    }

                    $vehicle->trolly = 1;
                    $equipment_list->trolly = 1;
                    
                }else{
                    $vehicle->trolly = 0;
                    $equipment_list->trolly = 0;
                   
                }
            }

            

        }

        
        $assign_vehicle->vehicle_status = 'assigned';
        $assign_vehicle->assign_date = date("Y-m-d");
        $assign_vehicle->row_status = 'active';

        $vehicle->vehicle_status = 'assigned';
        $vehicle->driver_id = $driver->id;

        $driver->employee_status = 'assigned';


        if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }
        
        if($assign_vehicle->save()){
            $equipment_list->assign_unassign_id = $assign_vehicle->id;
            $equipment_list->vehicle_id = $vehicle->id;
            $equipment_list->assign_status = 1;

            $equipment_list->row_status = 'active';


            $vehicle->save();
            $driver->save();
            $equipment_list->save();

            $this->history_table('assign_unassign_vehicle_histories', "Vehicle Number (". $vehicle->vehicle_number . " ) assigned to Driver" , $user_id , $assign_vehicle->id , 'vehicle.view_assigned_unassigned_vehicle');
        
            return \Redirect::route('user.vehicle.assign_vehicle')->with('success', 'Vehicle Assigned Sucessfully');
    
        }
        
        
    }

    public function assign_trailer_save(Request $request){
        $assign_vehicle = assign_unassign_vehicle::find((int)$request->input('assign_id'));

        $vehicle = vehicle::find((int)$request->input('vehicle_id'));
        $trailer = vehicle::find((int)$request->input('trailer_id'));

        // $driver = Employee::find((int)$request->input('driver_id'));
        

        if($request->input('trailer_id') != ''){
            $assign_vehicle->trailer_id = $request->input('trailer_id');
        }
        

        // dd($trailer->vehicle_id);

        if ($request->hasFile('assign_trailer_front_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->assign_trailer_front_photo->getClientOriginalName());
            $file = $request->file('assign_trailer_front_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $assign_vehicle->assign_trailer_front_photo = $name;

            }
            
        }
        if ($request->hasFile('assign_trailer_back_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->assign_trailer_back_photo->getClientOriginalName());
            $file = $request->file('assign_trailer_back_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $assign_vehicle->assign_trailer_back_photo = $name;

            }
            
        }
        if ($request->hasFile('assign_trailer_left_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->assign_trailer_left_photo->getClientOriginalName());
            $file = $request->file('assign_trailer_left_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $assign_vehicle->assign_trailer_left_photo = $name;

            }
            
        }
        if ($request->hasFile('assign_trailer_right_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->assign_trailer_right_photo->getClientOriginalName());
            $file = $request->file('assign_trailer_right_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $assign_vehicle->assign_trailer_right_photo = $name;

            }
            
        }

        

        
        $assign_vehicle->vehicle_status = 'assigned';
        $assign_vehicle->assign_date = date("Y-m-d");
        $assign_vehicle->row_status = 'active';
        $trailer->vehicle_id = $request->input('vehicle_id');
        $trailer->vehicle_status = 'assigned';

        $vehicle->vehicle_status = 'assigned';
        $vehicle->trailer_id = $request->input('trailer_id');
      

        // $driver->employee_status = 'assigned';


        if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }
        
        if($assign_vehicle->save()){
            // $equipment_list->assign_unassign_id = $assign_vehicle->id;
            // $equipment_list->vehicle_id = $vehicle->id;
            // $equipment_list->row_status = 'active';


            $vehicle->save();
            $trailer->save();

            
            // $driver->save();
            // $equipment_list->save();

            $this->history_table('assign_unassign_vehicle_histories', "Trailer Chassis Number (".  $trailer->chassis_number . " ) assigned to Vehicle Number (" .$vehicle->vehicle_number. ")" , $user_id , $assign_vehicle->id , 'vehicle.view_assigned_unassigned_vehicle');
        
            return \Redirect::route('user.vehicle.assign_vehicle')->with('success', 'Vehicle Assigned Sucessfully');
    
        }
        
        
    }

    public function get_vehicle(){
        $id = $_GET['id'];
        $vehicle = Vehicle::find((int)$id);

        
        return response()->json($vehicle);
    }

    public function unassign_vehicle($assign_id = 0){
        $data['assign_vehicle'] = assign_unassign_vehicle::find((int)$assign_id);
        $data['modules'] = DB::table('modules')->get();
        $data['vehicle'] = vehicle::find((int)$data['assign_vehicle']->vehicle_id); 
        // dd($data['vehicle']->medical_kit);

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 9)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        // $data['vehicle'] =  Vehicle::all();
        
        return view('vehicle.assign_unassign.unassign_vehicle', ["data"=>$data]); 
    }

    public function unassign_vehicle_save(Request $request){
        $assign_vehicle = assign_unassign_vehicle::find((int)$request->input('assign_id'));
        $vehicle = vehicle::find((int)$assign_vehicle->vehicle_id);
        $trailer = vehicle::find((int)$assign_vehicle->trailer_id); 
        $driver = employee::find((int)$assign_vehicle->driver_id); 
        $equipment_list = new vehicle_equipment_list();


        // $assign_vehicle = $request->input('');

        if ($request->hasFile('submission_form')) {

            $name = time().'_'.str_replace(" ", "_", $request->submission_form->getClientOriginalName());
            $file = $request->file('submission_form');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $assign_vehicle->submission_form = $name;

            }
            
        }

        if ($request->hasFile('unassign_vehicle_interior_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->unassign_vehicle_interior_photo->getClientOriginalName());
            $file = $request->file('unassign_vehicle_interior_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $assign_vehicle->unassign_vehicle_interior_photo = $name;

            }
            
        }

        if ($request->hasFile('unassign_vehicle_exterior_photo')) {

            $name = time().'_'.str_replace(" ", "_", $request->unassign_vehicle_exterior_photo->getClientOriginalName());
            $file = $request->file('unassign_vehicle_exterior_photo');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $assign_vehicle->unassign_vehicle_exterior_photo = $name;

            }
            
        }

        {
            if($vehicle->medical_kit == 1){
                if($request->input('medical_kit') == 'on'){
                    $vehicle->medical_kit = 0;
    
                    $equipment_medical_kit= Inventory_uncategorized::where('product_name' , '=' , 'Medical Kit')->get();
                    foreach($equipment_medical_kit as $medical_kit){
                        if($medical_kit->unit > 0 ){
                            $medical_kit->unit =  $medical_kit->unit + 1;
                            $medical_kit->save();   
                        }
    
                    }
    
                    $equipment_list->medical_kit = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Medical Kit';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
    
                    $vehicle->medical_kit = 0;
                    $equipment_list->medical_kit = 0;
    
                }
            }

            if($vehicle->fire_ext == 1){
                if($request->input('fire_ext') == 'on'){
                    $vehicle->fire_ext = 0;
    
                    $equipment_fire_ext= Inventory_uncategorized::where('product_name' , '=' , 'Fire Extinguisher')->get();
                    foreach($equipment_fire_ext as $fire_ext){
                        if($fire_ext->unit > 0 ){
                            $fire_ext->unit =  $fire_ext->unit + 1;
                            $fire_ext->save();   
                        }
    
                    }
    
                    $equipment_list->fire_ext = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Fire Extinguisher';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
    
                    $vehicle->fire_ext = 0;
                    $equipment_list->fire_ext = 0;
    
                }
            }

            if($vehicle->jack == 1){
                if($request->input('jack') == 'on'){
                    $vehicle->jack = 0;
    
                    $equipment_jack= Inventory_uncategorized::where('product_name' , '=' , 'Jack')->get();
                    foreach($equipment_jack as $jack){
                        if($jack->unit > 0 ){
                            $jack->unit =  $jack->unit + 1;
                            $jack->save();   
                        }
    
                    }
    
                    $equipment_list->jack = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Jack';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
    
                    $vehicle->jack = 0;
                    $equipment_list->jack = 0;
    
                }
            }

            if($vehicle->extra_emergency_light == 1){
                if($request->input('extra_emergency_light') == 'on'){
                    $vehicle->extra_emergency_light = 0;
    
                    $equipment_extra_emergency_light= Inventory_uncategorized::where('product_name' , '=' , 'Emergency light')->get();
                    foreach($equipment_extra_emergency_light as $extra_emergency_light){
                        if($extra_emergency_light->unit > 0 ){
                            $extra_emergency_light->unit =  $extra_emergency_light->unit + 1;
                            $extra_emergency_light->save();   
                        }
    
                    }
    
                    $equipment_list->extra_emergency_light = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Emergency light';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
    
                    $vehicle->extra_emergency_light = 0;
                    $equipment_list->extra_emergency_light = 0;
    
                }
            }

            if($vehicle->safety_shoes == 1){
                if($request->input('safety_shoes') == 'on'){
                    $vehicle->safety_shoes = 0;
    
                    $equipment_safety_shoes= Inventory_uncategorized::where('product_name' , '=' , 'Safety Shoes')->get();
                    foreach($equipment_safety_shoes as $safety_shoes){
                        if($safety_shoes->unit > 0 ){
                            $safety_shoes->unit =  $safety_shoes->unit + 1;
                            $safety_shoes->save();   
                        }
    
                    }
    
                    $equipment_list->safety_shoes = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Safety Shoes';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
    
                    $vehicle->safety_shoes = 0;
                    $equipment_list->safety_shoes = 0;
    
                }
            }

            if($vehicle->safety_helmet == 1){
                if($request->input('safety_helmet') == 'on'){
                    $vehicle->safety_helmet = 0;
    
                    $equipment_safety_helmet= Inventory_uncategorized::where('product_name' , '=' , 'Safety Helemt')->get();
                    foreach($equipment_safety_helmet as $safety_helmet){
                        if($safety_helmet->unit > 0 ){
                            $safety_helmet->unit =  $safety_helmet->unit + 1;
                            $safety_helmet->save();   
                        }
    
                    }
    
                    $equipment_list->safety_helmet = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Safety Helemt';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
    
                    $vehicle->safety_helmet = 0;
                    $equipment_list->safety_helmet = 0;
    
                }
            }

            if($vehicle->safety_gloves == 1){
                if($request->input('safety_gloves') == 'on'){
                    $vehicle->safety_gloves = 0;
    
                    $equipment_safety_gloves= Inventory_uncategorized::where('product_name' , '=' , 'Safety Gloves')->get();
                    foreach($equipment_safety_gloves as $safety_gloves){
                        if($safety_gloves->unit > 0 ){
                            $safety_gloves->unit =  $safety_gloves->unit + 1;
                            $safety_gloves->save();   
                        }
    
                    }
    
                    $equipment_list->safety_gloves = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Safety Gloves';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
    
                    $vehicle->safety_gloves = 0;
                    $equipment_list->safety_gloves = 0;
    
                }
            }

            if($vehicle->safety_jacket == 1){
                if($request->input('safety_jacket') == 'on'){
                    $vehicle->safety_jacket = 0;
    
                    $equipment_safety_jacket= Inventory_uncategorized::where('product_name' , '=' , 'Safety Jacket')->get();
                    foreach($equipment_safety_jacket as $safety_jacket){
                        if($safety_jacket->unit > 0 ){
                            $safety_jacket->unit =  $safety_jacket->unit + 1;
                            $safety_jacket->save();   
                        }
    
                    }
    
                    $equipment_list->safety_jacket = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Safety Jacket';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
    
                    $vehicle->safety_jacket = 0;
                    $equipment_list->safety_jacket = 0;
    
                }
            }

            if($vehicle->safety_ear_plug == 1){
                if($request->input('safety_ear_plug') == 'on'){
                    $vehicle->safety_ear_plug = 0;
    
                    $equipment_safety_ear_plug= Inventory_uncategorized::where('product_name' , '=' , 'Safety Ear Plug')->get();
                    foreach($equipment_safety_ear_plug as $safety_ear_plug){
                        if($safety_ear_plug->unit > 0 ){
                            $safety_ear_plug->unit =  $safety_ear_plug->unit + 1;
                            $safety_ear_plug->save();   
                        }
    
                    }
    
                    $equipment_list->safety_ear_plug = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Safety Ear Plug';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
    
                    $vehicle->safety_ear_plug = 0;
                    $equipment_list->safety_ear_plug = 0;
    
                }
            }

            if($vehicle->lashing_belt == 1){
                if($request->input('lashing_belt') == 'on'){
                    $vehicle->lashing_belt = 0;
                    
                    if( (int)$vehicle->lashing_belt_short_quantity > 0){
                        $vehicle->lashing_belt_short_quantity = 0;

                        $equipment_lashing_belt_short= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Belt Short')->get();
                        foreach($equipment_lashing_belt_short as $lashing_belt_short){
                            if($lashing_belt_short->unit > 0 ){
                                $lashing_belt_short->unit =  $lashing_belt_short->unit + (int) $vehicle->lashing_belt_short_quantity;
                                $lashing_belt_short->save();   
                            }
        
                        }
                    }

                    if( (int)$vehicle->lashing_belt_long_quantity > 0){
                        $vehicle->lashing_belt_long_quantity = 0;

                        $equipment_lashing_belt_long= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Belt Long')->get();
                        foreach($equipment_lashing_belt_long as $lashing_belt_long){
                            if($lashing_belt_long->unit > 0 ){
                                $lashing_belt_long->unit =  $lashing_belt_long->unit +(int) $vehicle->lashing_belt_long_quantity;
                                $lashing_belt_long->save();   
                            }
        
                        }
                    }
                    
    
                    $equipment_list->lashing_belt = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Lashing Belt';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
    
                    $vehicle->lashing_belt = 0;
                    $vehicle->lashing_belt_short_quantity = 0;
                    $vehicle->lashing_belt_short_quantity = 0;
                    $equipment_list->lashing_belt = 0;
    
                }
            }

            if($vehicle->lashing_chain == 1){
                if($request->input('lashing_chain') == 'on'){
                    $vehicle->lashing_chain = 0;
                    $vehicle->lashing_chain_quantity =0;
                    $equipment_lashing_chain= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Chain')->get();
                    foreach($equipment_lashing_chain as $lashing_chain){
                        if($lashing_chain->unit > 0 ){
                            $lashing_chain->unit =  $lashing_chain->unit + (int)$vehicle->lashing_chain_quantity ;
                            $lashing_chain->save();   
                        }
    
                    }
    
                    $equipment_list->lashing_chain = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Lashing Chain';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
                    $vehicle->lashing_chain_quantity =0;
                    $vehicle->lashing_chain = 0;
                    $equipment_list->lashing_chain = 0;
    
                }
            }

            if($vehicle->side_grill == 1){
                if($request->input('side_grill') == 'on'){
                    $vehicle->side_grill = 0;
                    $vehicle->side_grill_quantity =0;
                    $equipment_side_grill= Inventory_uncategorized::where('product_name' , '=' , 'Side Grill')->get();
                    foreach($equipment_side_grill as $side_grill){
                        if($side_grill->unit > 0 ){
                            $side_grill->unit =  $side_grill->unit + (int)$vehicle->side_grill_quantity ;
                            $side_grill->save();   
                        }
    
                    }
    
                    $equipment_list->side_grill = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Side Grill';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
                    $vehicle->side_grill_quantity =0;
                    $vehicle->side_grill = 0;
                    $equipment_list->side_grill = 0;
    
                }
            }

            if($vehicle->lashing_angle == 1){
                if($request->input('lashing_angle') == 'on'){
                    $vehicle->lashing_angle = 0;
                    $vehicle->lashing_angle_quantity =0;
                    $equipment_lashing_angle= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Angle')->get();
                    foreach($equipment_lashing_angle as $lashing_angle){
                        if($lashing_angle->unit > 0 ){
                            $lashing_angle->unit =  $lashing_angle->unit + (int)$vehicle->lashing_angle_quantity ;
                            $lashing_angle->save();   
                        }
    
                    }
    
                    $equipment_list->lashing_angle = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Lashing Angle';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
                    $vehicle->lashing_angle_quantity =0;
                    $vehicle->lashing_angle = 0;
                    $equipment_list->lashing_angle = 0;
    
                }
            }

            if($vehicle->container_lock == 1){
                if($request->input('container_lock') == 'on'){
                    $vehicle->container_lock = 0;
    
                    $equipment_container_lock= Inventory_uncategorized::where('product_name' , '=' , 'Container Lock')->get();
                    foreach($equipment_container_lock as $container_lock){
                        if($container_lock->unit > 0 ){
                            $container_lock->unit =  $container_lock->unit + 1;
                            $container_lock->save();   
                        }
    
                    }
    
                    $equipment_list->container_lock = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Container Lock';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
    
                    $vehicle->container_lock = 0;
                    $equipment_list->container_lock = 0;
    
                }
            }

            if($vehicle->rope_seal == 1){
                if($request->input('rope_seal') == 'on'){
                    $vehicle->rope_seal = 0;
    
                    $equipment_rope_seal= Inventory_uncategorized::where('product_name' , '=' , 'Rope Seal')->get();
                    foreach($equipment_rope_seal as $rope_seal){
                        if($rope_seal->unit > 0 ){
                            $rope_seal->unit =  $rope_seal->unit + 1;
                            $rope_seal->save();   
                        }
    
                    }
    
                    $equipment_list->rope_seal = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Rope Seal';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
    
                    $vehicle->rope_seal = 0;
                    $equipment_list->rope_seal = 0;
    
                }
            }

            if($vehicle->tarpaulin == 1){
                if($request->input('tarpaulin') == 'on'){
                    $vehicle->tarpaulin = 0;
    
                    $equipment_tarpaulin= Inventory_uncategorized::where('product_name' , '=' , 'Tarpaulin')->get();
                    foreach($equipment_tarpaulin as $tarpaulin){
                        if($tarpaulin->unit > 0 ){
                            $tarpaulin->unit =  $tarpaulin->unit + 1;
                            $tarpaulin->save();   
                        }
    
                    }
    
                    $equipment_list->tarpaulin = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Tarpaulin';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
    
                    $vehicle->tarpaulin = 0;
                    $equipment_list->tarpaulin = 0;
    
                }
            }

            if($vehicle->tail_lift == 1){
                if($request->input('tail_lift') == 'on'){
                    $vehicle->tail_lift = 0;
    
                    $equipment_tail_lift= Inventory_uncategorized::where('product_name' , '=' , 'Tail Lift')->get();
                    foreach($equipment_tail_lift as $tail_lift){
                        if($tail_lift->unit > 0 ){
                            $tail_lift->unit =  $tail_lift->unit + 1;
                            $tail_lift->save();   
                        }
    
                    }
    
                    $equipment_list->tail_lift = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Tail Lift';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
    
                    $vehicle->tail_lift = 0;
                    $equipment_list->tail_lift = 0;
    
                }
            }

            if($vehicle->trolly == 1){
                if($request->input('trolly') == 'on'){
                    $vehicle->trolly = 0;
    
                    $equipment_trolly= Inventory_uncategorized::where('product_name' , '=' , 'Trolly')->get();
                    foreach($equipment_trolly as $trolly){
                        if($trolly->unit > 0 ){
                            $trolly->unit =  $trolly->unit + 1;
                            $trolly->save();   
                        }
    
                    }
    
                    $equipment_list->trolly = 1;
                }else{
    
                    $dispute = new Equipment_dispute;
                    $dispute->assign_id = $assign_vehicle->id;
                    $dispute->equipment_name = 'Trolly';
                    $dispute->dispute_status = 'open';
                    $dispute->dispute_date = date('Y-m-d');
    
                    $dispute->save();
    
                    $vehicle->trolly = 0;
                    $equipment_list->trolly = 0;
    
                }
            }
        }
        
        


        

        $assign_vehicle->vehicle_status = 'unassigned';
        $assign_vehicle->unassign_date = date('Y-m-d');

        $vehicle->vehicle_status = 'not_assigned';
        $vehicle->driver_id = '';
        $vehicle->trailer_id = '';

        $equipment_list->unassign_status =  1;
        $equipment_list->vehicle_id =  $vehicle->id;
        $equipment_list->assign_unassign_id =  $assign_vehicle->id;

 

        $trailer->vehicle_status = 'not_assigned';
        $trailer->vehicle_id = '';
        $trailer->driver_id = '';

        $driver->employee_status = 'not_assigned';

        if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }

        if( $assign_vehicle->save() &&  $vehicle->save() && $trailer->save() &&  $driver->save() && $equipment_list->save()){
            $this->history_table('vehicle_histories','Vehicle Unassigned From Driver ('.$driver->name .')' , $user_id,  $assign_vehicle->id, "vehicle.view_assigned_unassigned_vehicle");
            $this->history_table('vehicle_histories','Trailer Unassigned From Vehicle Number ('.$vehicle->vehicle_number .')' , $user_id,  $assign_vehicle->id, "vehicle.view_assigned_unassigned_vehicle");
            $this->history_table('employee_histories','Driver Unassigned From Vehicle Number ('.$vehicle->vehicle_number .')' , $user_id,  $assign_vehicle->id, "vehicle.view_assigned_unassigned_vehicle");

            echo "<script>
            window.opener.location.reload();
            window.close();
            </script>";
            // return \Redirect::route('user.vehicle.assign_vehicle')->with('Success', 'Data Added Sucessfully');

        }

            
        


    }
    
    public function view_assigned_unassigned_vehicle(Request $request){
        
        $data['assign_unassign_vehicle'] = assign_unassign_vehicle::find((int)$request->input('id'));
        $data['equipment_list_assign'] = vehicle_equipment_list::where('assign_unassign_id' , '=' , (int)$request->input('id'))->where('assign_status' , '=' , 1)->first();
        $data['equipment_list_unassign'] = vehicle_equipment_list::where('assign_unassign_id' , '=' , (int)$request->input('id'))->where('unassign_status' , '=' , 1)->first();

        // dd($data['equipment_list_unassign']);

        $data['modules'] = DB::table('modules')->get();
        $data['vehicle'] = vehicle::find((int)$data['assign_unassign_vehicle']->vehicle_id); 
        // dd($data['vehicle']->medical_kit);

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 9)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        // $data['vehicle'] =  Vehicle::all();
        $data['page_title'] = 'View Assign/Unassign Vehicle';
        $data['view'] = 'vehicle.assign_unassign.view_assign_unassign_vehicle';
        return view('users.layout', ["data"=>$data]);
        
    }

    public function delete_assign_unassign_vehicle(Request $request){
        $id =  (int)$request->input('id');
        $assign_unassign = assign_unassign_vehicle::where('id' , $id)->first();
        $vehicle = vehicle::find((int)$assign_unassign->vehicle_id);
        $trailer = vehicle::find((int)$assign_unassign->trailer_id); 
        $driver = employee::find((int)$assign_unassign->driver_id);

        $vehicle->vehicle_status = 'not_assigned';
        $vehicle->driver_id = '';
        $vehicle->trailer_id = '';

        $trailer->vehicle_status = 'not_assigned';
        $trailer->vehicle_id = '';
        $trailer->driver_id = '';

        $driver->employee_status = 'not_assigned';
        
        $assign_unassign->status_message = $request->input('status_message');
        if( $assign_unassign->user_id != 0){
            $user_id  = $assign_unassign->user_id;
            
        }else{
            $user_id  = 0;
        }

        $assign_unassign->row_status = 'deleted';

        $assign_unassign->vehicle_status = 'unassigned';
        $assign_unassign->unassign_date = date('Y-m-d');

        if($request->input('status') == 'approved'){
            $this->remove_table_name('assign_unassigns');
        }

        // if($assign_unassign->action == null || $assign_unassign->status == 'approved'){
            $assign_unassign->action = 'delete';
        // }

        
 
        if( $assign_unassign->save()){
            $vehicle->save();
            $trailer->save();
            $driver->save();
            $this->history_table('vehicle_histories','Vehicle Unassigned From Driver ('.$driver->name .')' , $user_id,  $assign_unassign->id, "vehicle.view_assigned_unassigned_vehicle");
            $this->history_table('vehicle_histories','Trailer Unassigned From Vehicle Number ('.$vehicle->vehicle_number .')' , $user_id,  $assign_unassign->id, "vehicle.view_assigned_unassigned_vehicle");
            $this->history_table('employee_histories','Driver Unassigned From Vehicle Number ('.$vehicle->vehicle_number .')' , $user_id,  $assign_unassign->id, "vehicle.view_assigned_unassigned_vehicle");

            // $this->history_table('assign_unassign_histories', $assign_unassign->action , $user_id);
            $this->history_table('assign_unassign_vehicle_histories', $assign_unassign->action , $user_id , $assign_unassign->id , 'vehicle.view_assigned_unassigned_vehicle');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_trade_license(Request $request){
        $id =  (int)$request->input('id');
        $trade_license = Trade_license::where('id' , $id)->first();
        
        $trade_license->status_message = $request->input('status_message');
        if( $trade_license->user_id != 0){
                        
        }else{
            $user_id  = 0;
        }

        $trade_license->row_status = 'active';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }

        
            $trade_license->action = 'restored';
        
        $trade_license->save();
        // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
        $this->history_table('trade_license_histories', $trade_license->action , $user_id , $trade_license->id , 'hr_pro.view_trade_license__sponsors__partners');
 
        $trade_license->action = 'deleted';
        $trade_license->save();
           
            return response()->json(['status'=>'1']);
        
    }

    public function trash_assign_unassign(){
        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 9)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['vehicle'] =  Vehicle::where('status' , '=' , 'approved')->get();

        
        $data['assign_vehicle'] = assign_unassign_vehicle::all();
        $data['driver'] = Employee::where('designation' , '=' , 'driver')->where('row_status' ,'!=' , 'deleted')->get();
        $data['page_title'] = "Assign/Unassign Vehicle Trash";
        $data['view'] = 'vehicle.assign_unassign.deleted_data';
        return view('users.layout', ["data"=>$data]);
    }

    public function vehicle_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 9)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     

        $data['trade_licenses_history']= DB::table('vehicle_histories')->get();
        $data['table_name']= 'vehicle_histories';

        $data['page_title'] = "History | Vehicle ";
        $data['view'] = 'hr_pro.history';
        return view('users.layout', ["data"=>$data]);
    }


    public function delete_vehicle_status(Request $request){
        $id =  (int)$request->input('id');
        $vehicle = vehicle::where('id' , $id)->first();
        

        $vehicle->vehicle_status = 'not_assigned';
        $vehicle->driver_id = '';
        $vehicle->trailer_id = '';

    
        
        $vehicle->status_message = $request->input('status_message');
        if( $vehicle->user_id != 0){
            $user_id  = $vehicle->user_id;
            
        }else{
            $user_id  = 0;
        }

        $vehicle->row_status = 'deleted';

        

        if($request->input('status') == 'approved'){
            $this->remove_table_name('assign_unassigns');
        }

        // if($assign_unassign->action == null || $assign_unassign->status == 'approved'){
            $vehicle->action = 'delete';
        // }

        
 
        if( $vehicle->save()){
            
            $this->history_table('vehicle_histories','Vehicle Deleted ' , $user_id,  $vehicle->id, "vehicle.view_vehicle");
           
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_vehicle(Request $request){
        $id =  (int)$request->input('id');
        $trade_license = vehicle::where('id' , $id)->first();
        
        $trade_license->status_message = $request->input('status_message');
        if( $trade_license->user_id != 0){
                        
        }else{
            $user_id  = 0;
        }

        $trade_license->row_status = 'active';
        $trade_license->action = 'restored';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }

        
            $trade_license->action = 'restored';
            $trade_license->status = 'pending';
        $trade_license->save();
        // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
        $this->history_table('vehicle_histories', $trade_license->action , $user_id , $trade_license->id , 'vehicle.view_vehicle');
 
        $trade_license->action = 'deleted';
        $trade_license->save();
           
            return response()->json(['status'=>'1']);
        
    }

    public function trash_vehicle(){
        $data['modules']= DB::table('modules')->get();

      
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 9)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        
        $data['vehicle_info'] = Vehicle::all();

        // dd( $data['vehicle_info']); 
        $data['page_title'] = "Trash Vehicle Fleet";
        $data['view'] = 'vehicle.deleted_data';
        return view('users.layout', ["data"=>$data]);
    }

    //
    public function get_vehicle_driver(){
        $id = $_GET['driver'];
        $driver = Employee::find((int)$id);
        return response()->json($driver);
    }


   
}