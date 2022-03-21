<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\User;
use App\Models\Roles;
use App\Models\Purchase;
use App\Models\Purchase_mertial_data;
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
        $this->middleware('auth:admin');
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
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
        $data['purchases']= DB::table('purchases')->get();
        // $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Vehicle";
        $data['view'] = 'admin.vehicle.vehicle';
        return view('layout', ["data"=>$data]);
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
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

       
        $data['view'] = 'admin.vehicle.own_new_vehicle';
        return view('layout', ["data"=>$data]);
    }


    ///////////////////////////////////////////////////
    ///////////////// Vehicle - Register New Vehicle ////////////////
    ///////////////////////////////////////////////////

    
    public function register_new_vehicle(){
        $data['modules']= DB::table('modules')->get();

      
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        

        $data['page_title'] = "Register New Vehcile - Vehicle";
        $data['view'] = 'admin.vehicle.register_new_vehicle.register_new_vehicle';
        return view('layout', ["data"=>$data]);
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
       

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        //equipment
        {
            $data['equipment'] = [];

            //Medical Kit
            $data['equipment']['medical_kit'] = [];
            $equipment_medical_kit= Inventory_uncategorized::where('product_name' , '=' , 'Medical Kit')->get();
            if(!$equipment_medical_kit->isEmpty()){
                
                foreach($equipment_medical_kit as $medical_kit_quntity){
                    $data['equipment']['medical_kit'] =+ (int)$medical_kit_quntity->unit;
                } 
            }else{
                $data['equipment']['medical_kit'] = 0;
            }

            //Fire Extinguisher 
            $data['equipment']['fire_extinguisher'] = [];
            $equipment_fire_extinguisher= Inventory_uncategorized::where('product_name' , '=' , 'Fire Extinguisher')->get();
            
            if(!$equipment_fire_extinguisher->isEmpty()){
                
                foreach($equipment_fire_extinguisher as $fire_extinguisher_quntity){
                    $data['equipment']['fire_extinguisher'] =+ (int)$fire_extinguisher_quntity->unit;
                } 
            }else{
                
                $data['equipment']['fire_extinguisher'] = 0;
            }

            //safety_triangle 
            $data['equipment']['safety_triangle'] = [];
            $equipment_safety_triangle= Inventory_uncategorized::where('product_name' , '=' , 'Safety Triangle')->get();
            
            if(!$equipment_safety_triangle->isEmpty()){
                
                foreach($equipment_safety_triangle as $equipment_safety_triangle_quntity){
                    $data['equipment']['safety_triangle'] =+ (int)$equipment_safety_triangle_quntity->unit;
                } 
            }else{
                
                $data['equipment']['safety_triangle'] = 0;
            }

            //Jack 
            $data['equipment']['jack'] = [];
            $equipment_jack= Inventory_uncategorized::where('product_name' , '=' , 'Jack')->get();
            if(!$equipment_jack->isEmpty()){
                
                foreach($equipment_jack as $jack_quntity){
                    $data['equipment']['jack'] =+ (int)$jack_quntity->unit;
                } 
            }else{
                $data['equipment']['jack'] = 0;
            }

            //Safety Triangle 
            $data['equipment']['safetyt_riangle'] = [];
            $equipment_safetyt_riangle= Inventory_uncategorized::where('product_name' , '=' , 'Safety Triangle')->get();
            if(!$equipment_safetyt_riangle->isEmpty()){
                
                foreach($equipment_safetyt_riangle as $safetyt_riangle_quntity){
                    $data['equipment']['safetyt_riangle'] =+ (int)$safetyt_riangle_quntity->unit;
                } 
            }else{
                $data['equipment']['safetyt_riangle'] = 0;
            }

            //Emergency Light 
            $data['equipment']['emergency_light'] = [];
            $equipment_emergency_light= Inventory_uncategorized::where('product_name' , '=' , 'Emergency Light')->get();
            if(!$equipment_emergency_light->isEmpty()){
                
                foreach($equipment_emergency_light as $equipment_emergency_light_quntity){
                    $data['equipment']['emergency_light'] =+ (int)$safetyt_riangle_quntity->unit;
                } 
            }else{
                $data['equipment']['emergency_light'] = 0;
            }

            //Safety Shoes 
            $data['equipment']['safety_shoes'] = [];
            $equipment_safety_shoes= Inventory_uncategorized::where('product_name' , '=' , 'Safety Shoes')->get();
            if(!$equipment_safety_shoes->isEmpty()){
                
                foreach($equipment_safety_shoes as $safety_shoes_quntity){
                    $data['equipment']['safety_shoes'] =+ (int)$safety_shoes_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_shoes'] = 0;
            }

            //Safety Helemt 
            $data['equipment']['safety_helemt'] = [];
            $equipment_safety_helemt= Inventory_uncategorized::where('product_name' , '=' , 'Safety Helemt')->get();
            if(!$equipment_safety_helemt->isEmpty()){
                
                foreach($equipment_safety_helemt as $equipment_safety_helemt_quntity){
                    $data['equipment']['safety_helemt'] =+ (int)$equipment_safety_helemt_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_helemt'] = 0;
            }

            //Safety Gloves 
            $data['equipment']['safety_gloves'] = [];
            $equipment_safety_gloves= Inventory_uncategorized::where('product_name' , '=' , 'Safety Gloves')->get();
            if(!$equipment_safety_gloves->isEmpty()){
                
                foreach($equipment_safety_gloves as $equipment_safety_gloves_quntity){
                    $data['equipment']['safety_gloves'] =+ (int)$equipment_safety_gloves_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_gloves'] = 0;
            }

            //Safety Jacket 
            $data['equipment']['safety_jacket'] = [];
            $equipment_safety_jacket= Inventory_uncategorized::where('product_name' , '=' , 'Safety Jacket')->get();
            if(!$equipment_safety_jacket->isEmpty()){
                
                foreach($equipment_safety_jacket as $equipment_safety_jacket_quntity){
                    $data['equipment']['safety_jacket'] =+ (int)$equipment_safety_jacket_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_jacket'] = 0;
            }

            //Safety Ear Plug 
            $data['equipment']['safety_ear_plug'] = [];
            $equipment_safety_ear_plug= Inventory_uncategorized::where('product_name' , '=' , 'Safety Ear Plug')->get();
            if(!$equipment_safety_ear_plug->isEmpty()){
                
                foreach($equipment_safety_ear_plug as $equipment_safety_ear_plug_quntity){
                    $data['equipment']['safety_ear_plug'] =+ (int)$equipment_safety_ear_plug_quntity->unit;
                } 
            }else{
                $data['equipment']['safety_ear_plug'] = 0;
            }

            //Lashing Belt 
            $data['equipment']['lashing_belt_long'] = [];
            $equipment_lashing_belt_long= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Belt Long')->get();
            if(!$equipment_lashing_belt_long->isEmpty()){
                
                foreach($equipment_lashing_belt_long as $equipment_lashing_belt_long_quntity){
                    $data['equipment']['lashing_belt_long'] =+ (int)$equipment_lashing_belt_long_quntity->unit;
                } 
            }else{
                $data['equipment']['lashing_belt_long'] = 0;
            }

            $data['equipment']['lashing_belt_short'] = [];
            $equipment_lashing_belt_short= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Belt Short')->get();
            if(!$equipment_lashing_belt_short->isEmpty()){
                
                foreach($equipment_lashing_belt_short as $equipment_lashing_belt_short_quntity){
                    $data['equipment']['lashing_belt_short'] =+ (int)$equipment_lashing_belt_short_quntity->unit;
                } 
            }else{
                $data['equipment']['lashing_belt_short'] = 0;
            }

            //Lashing Chain 
            $data['equipment']['lashing_chain'] = [];
            $equipment_lashing_chain= Inventory_uncategorized::where('product_name' , '=' , 'Lashing Chain')->get();
            if(!$equipment_lashing_chain->isEmpty()){
                
                foreach($equipment_lashing_chain as $equipment_lashing_chain_quntity){
                    $data['equipment']['lashing_chain'] =+ (int)$equipment_lashing_chain_quntity->unit;
                } 
            }else{
                $data['equipment']['lashing_chain'] = 0;
            }

            //Side _Grill 
            $data['equipment']['side_grill'] = [];
            $equipment_side_grill= Inventory_uncategorized::where('product_name' , '=' , 'Side Grill')->get();
            if(!$equipment_side_grill->isEmpty()){
                
                foreach($equipment_side_grill as $equipment_side_grill_quntity){
                    $data['equipment']['side_grill'] =+ (int)$equipment_side_grill_quntity->unit;
                } 
            }else{
                $data['equipment']['side_grill'] = 0;
            }

            //Container Lock 
            $data['equipment']['container_lock'] = [];
            $equipment_container_lock= Inventory_uncategorized::where('product_name' , '=' , 'Container Lock')->get();
            if(!$equipment_container_lock->isEmpty()){
                
                foreach($equipment_container_lock as $equipment_container_lock_quntity){
                    $data['equipment']['container_lock'] =+ (int)$equipment_container_lock_quntity->unit;
                } 
            }else{
                $data['equipment']['container_lock'] = 0;
            }

            //Rope Seal 
            $data['equipment']['rope_seal'] = [];
            $equipment_rope_seal= Inventory_uncategorized::where('product_name' , '=' , 'Rope Seal')->get();
            if(!$equipment_rope_seal->isEmpty()){
                
                foreach($equipment_rope_seal as $equipment_rope_seal_quntity){
                    $data['equipment']['rope_seal'] =+ (int)$equipment_rope_seal_quntity->unit;
                } 
            }else{
                $data['equipment']['rope_seal'] = 0;
            }

            //lashing_angle 
            $data['equipment']['lashing_angle'] = [];
            $equipment_lashing_angle= Inventory_uncategorized::where('product_name' , '=' , 'Rope Seal')->get();
            if(!$equipment_lashing_angle->isEmpty()){
                
                foreach($equipment_lashing_angle as $equipment_lashing_angle_quntity){
                    $data['equipment']['lashing_angle'] =+ (int)$equipment_lashing_angle_quntity->unit;
                } 
            }else{
                $data['equipment']['lashing_angle'] = 0;
            }

            //Tarpaulin 
            $data['equipment']['tarpaulin'] = [];
            $equipment_tarpaulin= Inventory_uncategorized::where('product_name' , '=' , 'Tarpaulin')->get();
            if(!$equipment_tarpaulin->isEmpty()){
                
                foreach($equipment_tarpaulin as $equipment_tarpaulin_quntity){
                    $data['equipment']['tarpaulin'] =+ (int)$equipment_tarpaulin_quntity->unit;
                } 
            }else{
                $data['equipment']['tarpaulin'] = 0;
            }

            //Tail Lift 
            $data['equipment']['tail_lift'] = [];
            $equipment_tail_lift= Inventory_uncategorized::where('product_name' , '=' , 'Tail Lift')->get();
            if(!$equipment_tail_lift->isEmpty()){
                
                foreach($equipment_tail_lift as $equipment_tail_lift_quntity){
                    $data['equipment']['tail_lift'] =+ (int)$equipment_tail_lift_quntity->unit;
                } 
            }else{
                $data['equipment']['tail_lift'] = 0;
            }

            //Trolly 
            $data['equipment']['trolly'] = [];
            $equipment_trolly= Inventory_uncategorized::where('product_name' , '=' , 'Trolly')->get();
            if(!$equipment_trolly->isEmpty()){
                
                foreach($equipment_trolly as $equipment_trolly_quntity){
                    $data['equipment']['trolly'] =+ (int)$equipment_trolly_quntity->unit;
                } 
            }else{
                $data['equipment']['trolly'] = 0;
            }
        }
        

        // $data['page_title'] = "Add Own Vehicle
        // ";
        $data['view'] = 'admin.vehicle.register_new_vehicle.add_own_new_vehicle';
        return view('layout', ["data"=>$data]);
    }

    public function add_hired_sub_contractor_vehicle(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['page_title'] = "Add Hired Sub Contractor Vehicle
        ";
        $data['view'] = 'admin.vehicle.register_new_vehicle.add_hired_sub_contractor_vehicle';
        return view('layout', ["data"=>$data]);
    }

    public function view_vehicle(Request $request){
       
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Vehicles";
        $data['view'] = 'admin.vehicle.view_vehicle';
        return view('layout', ["data"=>$data]);
    }

    public function save_hired_sub_contractor_vehicle(Request $request){
        $employee = new Vehicle();

        //step 1

        if($request->input('haired_sub_contractor_vehicle') != ''){
            $employee->haired_sub_contractor_vehicle = $request->input('haired_sub_contractor_vehicle');
        }

        if($request->input('own_vehicle') != ''){
            $employee->own_vehicle = $request->input('own_vehicle');
        }

        if($request->input('register_vehicle') != ''){
            $employee->register_vehicle = $request->input('register_vehicle');
        }

        if($request->input('sub_contractor_id') != ''){
            $employee->sub_contractor_id = $request->input('sub_contractor_id');
        }
        
        if($request->input('vehicle_number') != ''){
            $employee->vehicle_number = $request->input('vehicle_number');
        }
        if($request->input('registration_date') != ''){
            $employee->registration_date = $request->input('registration_date');
        }
        if($request->input('registration_exp_date') != ''){
            $employee->registration_exp_date = $request->input('registration_exp_date');
        }
        if ($request->hasFile('regisration_form')) {

            $name = time().'_'.str_replace(" ", "_", $request->regisration_form->getClientOriginalName());
            $file = $request->file('regisration_form');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $employee->regisration_form = $name;

            }
            
        }
        if($request->input('make') != ''){
            $employee->make = $request->input('make');
        }
        if($request->input('colour') != ''){
            $employee->colour = $request->input('colour');
        }

        if($request->input('trailer_size') != ''){
            $employee->trailer_size = $request->input('trailer_size');
        }
        if($request->input('axle') != ''){
            $employee->axle = $request->input('axle');
        }
        if($request->input('model') != ''){
            $employee->model = $request->input('model');
        }
        if($request->input('engine_number') != ''){
            $employee->engine_number = $request->input('engine_number');
        }
        if($request->input('chassis_number') != ''){
            $employee->chassis_number = $request->input('chassis_number');
        }

        if($request->input('vehicle_type') != ''){
            $employee->vehicle_type = $request->input('vehicle_type');
        }
        if($request->input('truck_type') != ''){
            $employee->truck_type = $request->input('truck_type');
        }
        if($request->input('pickup_weight') != ''){
            $employee->pickup_weight = $request->input('pickup_weight');
        }
        if($request->input('pickup_shape') != ''){
            $employee->pickup_shape = $request->input('pickup_shape');
        }

        if($request->input('vehicle_suspension') != ''){
            $employee->vehicle_suspension = $request->input('vehicle_suspension');
        }

        if($request->input('salik') != ''){
            $employee->salik = $request->input('salik');
        }

        if($request->input('trailer_type') != ''){
            $employee->trailer_type = $request->input('trailer_type');
        }

        if($request->input('trailer_suspension') != ''){
            $employee->trailer_suspension = $request->input('trailer_suspension');
        }
        
        if($request->input('ton_capacity') != ''){
            $employee->ton_capacity = $request->input('ton_capacity');
        }

    
        //step 2
        if($request->input('vehicle_insurance') != ''){
            $employee->vehicle_insurance = $request->input('vehicle_insurance');
        }
        if($request->input('insurance_policy_number') != ''){
            $employee->insurance_policy_number = $request->input('insurance_policy_number');
        }
        if($request->input('insurance_expiry') != ''){
            $employee->insurance_expiry = $request->input('insurance_expiry');
        }
        if ($request->hasFile('insurance_form')) {

            $name = time().'_'.str_replace(" ", "_", $request->insurance_form->getClientOriginalName());
            $file = $request->file('insurance_form');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $employee->insurance_form = $name;

            }
            
        }
        if($request->input('other_insurance') != ''){
            $employee->other_insurance = $request->input('other_insurance');
        }
        if($request->input('other_insurance_policy_number') != ''){
            $employee->other_insurance_policy_number = $request->input('other_insurance_policy_number');
        }
        if($request->input('other_insurance_expiry') != ''){
            $employee->insurance_expiry = $request->input('insurance_expiry');
        }
        if ($request->hasFile('other_insurance_form')) {

            $name = time().'_'.str_replace(" ", "_", $request->other_insurance_form->getClientOriginalName());
            $file = $request->file('other_insurance_form');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $employee->other_insurance_form = $name;

            }
            
        }
        if($request->input('other_insurance_description') != ''){
            $employee->other_insurance_description = $request->input('other_insurance_description');
        }

        // j_ali tags 
        if($request->input('j_ali_tag') != ''){
            $employee->j_ali_tag = $request->input('j_ali_tag');
        }

        if($request->input('j_ali_tag_expiry') != ''){
            $employee->j_ali_tag_expiry = $request->input('j_ali_tag_expiry');
        }

        if ($request->hasFile('j_ali_tag_upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->j_ali_tag_upload->getClientOriginalName());
            $file = $request->file('j_ali_tag_upload');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $employee->j_ali_tag_upload = $name;

            }
            
        }

        //kp tag 
        if($request->input('kp_tag') != ''){
            $employee->kp_tag = $request->input('kp_tag');
        }

        if($request->input('kp_tag_expiry') != ''){
            $employee->kp_tag_expiry = $request->input('kp_tag_expiry');
        }

        
        if ($request->hasFile('kp_tag_upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->kp_tag_upload->getClientOriginalName());
            $file = $request->file('kp_tag_upload');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $employee->kp_tag_upload = $name;

            }
            
        }

        //Other tag 
        if($request->input('other_tag') != ''){
            $employee->other_tag = $request->input('other_tag');
        }

        if($request->input('other_tag_description') != ''){
            $employee->other_tag_description = $request->input('other_tag_description');
        }

        if($request->input('other_tag_expiry') != ''){
            $employee->other_tag_expiry = $request->input('other_tag_expiry');
        }
        
        if ($request->hasFile('other_tag_upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->other_tag_upload->getClientOriginalName());
            $file = $request->file('other_tag_upload');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $employee->other_tag_upload = $name;

            }
            
        }

        //Sticker 
        if($request->input('sticker') != ''){
            $employee->sticker = $request->input('sticker');
        }

        if($request->input('sticker_description') != ''){
            $employee->sticker_description = $request->input('sticker_description');
        }

        if($request->input('describe_other_sticker') != ''){
            $employee->describe_other_sticker = $request->input('describe_other_sticker');
        }

        if($request->input('sticker_validity') != ''){
            $employee->sticker_validity = $request->input('sticker_validity');
        }
        
        if ($request->hasFile('sticker_upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->sticker_upload->getClientOriginalName());
            $file = $request->file('sticker_upload');
            if($file->storeAs('/main_admin/vehicle/', $name , ['disk' => 'public_uploads'])){
                $employee->sticker_upload = $name;

            }
            
        }

        //pass
        if($request->input('pass') != ''){
            $employee->pass = $request->input('pass');
        }

        if($request->input('pass_description') != ''){
            $employee->pass_description = $request->input('pass_description');
        }

        if($request->input('describe_other_pass') != ''){
            $employee->describe_other_pass = $request->input('describe_other_pass');
        }

        //food pass
        if($request->input('food_pass') != ''){
            $employee->food_pass = $request->input('food_pass');
        }

        if($request->input('pass_validity') != ''){
            $employee->pass_validity = $request->input('pass_validity');
        }

        if($request->input('pass_upload') != ''){
            $employee->pass_upload = $request->input('pass_upload');
        }

        if($request->input('food_pass') != ''){
            $employee->food_pass = $request->input('food_pass');
        }


        
    }

    
    public function edit_own_new_vehicle(Request $request){
        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Own Vehicle
        ";
        $data['view'] = 'admin.vehicle.edit_vehicle.edit_own_new_vehicle';
        return view('layout', ["data"=>$data]);

    }

    public function edit_hired_sub_contractor_vehicle(Request $request){
        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Hired Sub Contractor Vehicle
        ";
        $data['view'] = 'admin.vehicle.edit_vehicle.edit_hired_sub_contractor_vehicle';
        return view('layout', ["data"=>$data]);

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

    

   
}