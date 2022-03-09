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

    public function add_own_new_vehicle(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
       

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         

        $data['page_title'] = "Add Own Vehicle
        ";
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

    }

    public function update_fuel_reading(Request $request){
      

     

      

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