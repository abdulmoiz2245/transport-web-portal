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

     //own vehicle - register new vehicle - vehicle
     public function own_vehicle(){
        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Own Vehicle";
        $data['view'] = 'admin.vehicle.register_new_vehicle.own_vehicle';
        return view('layout', ["data"=>$data]);
    }

     //hired sub contractor vehicle - register new vehicle - vehicle
    public function hired_sub_contractor_vehicle(){
        $data['modules']= DB::table('modules')->get();

        $data['page_title'] = "Hired Sub Contractor Vehicle";
        $data['view'] = 'admin.vehicle.register_new_vehicle.hired_sub_contractor_vehicle';
        return view('layout', ["data"=>$data]);
    }

    //registration - register new vehicle - vehicle
    public function registration(){
      $data['modules']= DB::table('modules')->get();

      $data['page_title'] = "Registration";
      $data['view'] = 'admin.vehicle.register_new_vehicle.registration';
      return view('layout', ["data"=>$data]);
    }

    public function add_own_vehicle(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        if(!empty( Fuel_transfer::latest('date')->first())){
            $data['fuel_entery'] = Fuel_transfer::latest('date')->first(); 
        }

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Own Vehicle
        ";
        $data['view'] = 'admin.vehicle.register_new_vehicle.add_own_vehicle';
        return view('layout', ["data"=>$data]);
    }

    public function add_hired_sub_contractor_vehicle(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        if(!empty( Fuel_transfer::latest('date')->first())){
            $data['fuel_entery'] = Fuel_transfer::latest('date')->first(); 
        }

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Hired Sub Contractor Vehicle
        ";
        $data['view'] = 'admin.vehicle.register_new_vehicle.add_hired_sub_contractor_vehicle';
        return view('layout', ["data"=>$data]);
    }

    public function add_registration(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        if(!empty( Fuel_transfer::latest('date')->first())){
            $data['fuel_entery'] = Fuel_transfer::latest('date')->first(); 
        }

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Registration
        ";
        $data['view'] = 'admin.vehicle.register_new_vehicle.add_registration';
        return view('layout', ["data"=>$data]);
    }

    public function save_fuel_reading(Request $request){
        $fuel_reading = new  Fuel_transfer;
        $fuel_entery = Fuel_transfer::latest('date')->first(); 

        if($request->input('reading_date') != ''){
            $fuel_reading->date = $request->input('reading_date');
        }

        // dd($request->input('non_mobile_1_reading'));

        if($request->input('non_mobile_1_reading') != '' && $fuel_entery->non_mobile_1_reading <= $request->input('non_mobile_1_reading')){
            $fuel_reading->non_mobile_1_reading = $request->input('non_mobile_1_reading');
        }else{
            $fuel_reading->non_mobile_1_reading = $fuel_entery->non_mobile_1_reading;

        }

        if($request->input('non_mobile_2_reading') != '' && $fuel_entery->non_mobile_2_reading <= $request->input('non_mobile_2_reading')){
            $fuel_reading->non_mobile_2_reading = $request->input('non_mobile_2_reading');
        }else{
            $fuel_reading->non_mobile_2_reading = $fuel_entery->non_mobile_2_reading;
            
        }

        if($request->input('mobile_1_reading') != '' && $fuel_entery->mobile_1_reading <= $request->input('mobile_1_reading')){
            $fuel_reading->mobile_1_reading = $request->input('mobile_1_reading');
        }else{
            $fuel_reading->mobile_1_reading = $fuel_entery->mobile_1_reading;
            
        }

        if($request->input('mobile_2_reading') != '' && $fuel_entery->mobile_2_reading <= $request->input('mobile_2_reading')){
            $fuel_reading->mobile_2_reading = $request->input('mobile_2_reading');
        }else{
            $fuel_reading->mobile_2_reading = $fuel_entery->mobile_2_reading;
            
        }

        if($request->input('non_mobile_1_refill_from') != '' ){
            $fuel_reading->non_mobile_1_refill_from = $request->input('non_mobile_1_refill_from');
        }

        if($request->input('non_mobile_1_refill_amount') != '' ){
            $fuel_reading->non_mobile_1_refill_amount = $request->input('non_mobile_1_refill_amount');
        }else{
            $fuel_reading->non_mobile_1_refill_amount = 0;
        }

        if($request->input('non_mobile_2_refill_amount') != '' ){
            $fuel_reading->non_mobile_2_refill_amount = $request->input('non_mobile_2_refill_amount');
        }else{
            $fuel_reading->non_mobile_2_refill_amount = 0;
        }

        if($request->input('mobile_1_refill_amount') != '' ){
            $fuel_reading->mobile_1_refill_amount = $request->input('mobile_1_refill_amount');
        }else{
            $fuel_reading->mobile_1_refill_amount = 0;
        }

        if($request->input('mobile_2_refill_amount') != '' ){
            $fuel_reading->mobile_2_refill_amount = $request->input('mobile_2_refill_amount');
        }else{
            $fuel_reading->mobile_2_refill_amount = 0;
        }

        if($request->input('fuel_entery_mobile') != '' ){
            $fuel_reading->fuel_entery_mobile = $request->input('fuel_entery_mobile');
        }else{
            $fuel_reading->fuel_entery_mobile = 0;
        }

        if($request->input('fuel_entery_non_mobile') != '' ){
            $fuel_reading->fuel_entery_non_mobile = $request->input('fuel_entery_non_mobile');
        }else{
            $fuel_reading->fuel_entery_non_mobile = 0;
        } 

        

        if($request->input('inter_tank_transfer_from') != '' ){
            $fuel_reading->inter_tank_transfer_from = $request->input('inter_tank_transfer_from');
        }

        if($request->input('inter_tank_transfer_amount') != '' ){
            $fuel_reading->inter_tank_transfer_amount = $request->input('inter_tank_transfer_amount');
        }

        if( $request->input('non_mobile_1_refill_from') != 0){
            $total_refill_from_storage  =  $request->input('non_mobile_2_refill_amount')  ;
        }else{
            $total_refill_from_storage  = $request->input('non_mobile_1_refill_amount')  + $request->input('non_mobile_2_refill_amount')  ;

        }

       

        $fuel_reading->user_id = 0;
        $fuel_reading->row_status = 'active';

        if($fuel_reading->save()){
            // $this->history_table('fuel_entery_histories', 'Add' , 0 , $fuel_reading->id , 'hr_pro.edit_trade_license__sponsors__partners');
            
            $fuel_reading = Fuel_transfer::find($fuel_reading->id);
            $pre = $fuel_reading->previous();
            $fuel_reading->total_fuel_remaining = $pre->total_fuel_remaining - $total_refill_from_storage;

            $fuel_reading->total_fuel_consumed = $pre->total_fuel_consumed + $total_refill_from_storage;
            $fuel_reading->save();

            $this->history_table('fuel_transfer_histories', 'Add' ,   0 , $fuel_reading->id , 'inventory.fuel.readings.edit_fuel_reading');

            return \Redirect::route('admin.inventory.fuel.readings')->with('success', 'Data Added Sucessfully');
        }

    }

    public function update_fuel_reading(Request $request){
        $fuel_reading =Fuel_transfer::find((int)$request->input('id'));
        $fuel_entery = Fuel_transfer::latest('date')->first(); 

        if($request->input('reading_date') != ''){
            $fuel_reading->date = $request->input('reading_date');
        }

        // dd($request->input('non_mobile_1_reading'));

        if($request->input('non_mobile_1_reading') != '' && $fuel_entery->non_mobile_1_reading <= $request->input('non_mobile_1_reading')){
            $fuel_reading->non_mobile_1_reading = $request->input('non_mobile_1_reading');
        }else{
            $fuel_reading->non_mobile_1_reading = $fuel_entery->non_mobile_1_reading;

        }

        if($request->input('non_mobile_2_reading') != '' && $fuel_entery->non_mobile_2_reading <= $request->input('non_mobile_2_reading')){
            $fuel_reading->non_mobile_2_reading = $request->input('non_mobile_2_reading');
        }else{
            $fuel_reading->non_mobile_2_reading = $fuel_entery->non_mobile_2_reading;
            
        }

        if($request->input('mobile_1_reading') != '' && $fuel_entery->mobile_1_reading <= $request->input('mobile_1_reading')){
            $fuel_reading->mobile_1_reading = $request->input('mobile_1_reading');
        }else{
            $fuel_reading->mobile_1_reading = $fuel_entery->mobile_1_reading;
            
        }

        if($request->input('mobile_2_reading') != '' && $fuel_entery->mobile_2_reading <= $request->input('mobile_2_reading')){
            $fuel_reading->mobile_2_reading = $request->input('mobile_2_reading');
        }else{
            $fuel_reading->mobile_2_reading = $fuel_entery->mobile_2_reading;
            
        }

        if($request->input('non_mobile_1_refill_from') != '' ){
            $fuel_reading->non_mobile_1_refill_from = $request->input('non_mobile_1_refill_from');
        }

        if($request->input('non_mobile_1_refill_amount') != '' ){
            $fuel_reading->non_mobile_1_refill_amount = $request->input('non_mobile_1_refill_amount');
        }else{
            $fuel_reading->non_mobile_1_refill_amount = 0;
        }

        if($request->input('non_mobile_2_refill_amount') != '' ){
            $fuel_reading->non_mobile_2_refill_amount = $request->input('non_mobile_2_refill_amount');
        }else{
            $fuel_reading->non_mobile_2_refill_amount = 0;
        }

        if($request->input('mobile_1_refill_amount') != '' ){
            $fuel_reading->mobile_1_refill_amount = $request->input('mobile_1_refill_amount');
        }else{
            $fuel_reading->mobile_1_refill_amount = 0;
        }

        if($request->input('mobile_2_refill_amount') != '' ){
            $fuel_reading->mobile_2_refill_amount = $request->input('mobile_2_refill_amount');
        }else{
            $fuel_reading->mobile_2_refill_amount = 0;
        }

        if($request->input('fuel_entery_mobile') != '' ){
            $fuel_reading->fuel_entery_mobile = $request->input('fuel_entery_mobile');
        }else{
            $fuel_reading->fuel_entery_mobile = 0;
        }

        if($request->input('fuel_entery_non_mobile') != '' ){
            $fuel_reading->fuel_entery_non_mobile = $request->input('fuel_entery_non_mobile');
        }else{
            $fuel_reading->fuel_entery_non_mobile = 0;
        } 

        

        if($request->input('inter_tank_transfer_from') != '' ){
            $fuel_reading->inter_tank_transfer_from = $request->input('inter_tank_transfer_from');
        }

        if($request->input('inter_tank_transfer_amount') != '' ){
            $fuel_reading->inter_tank_transfer_amount = $request->input('inter_tank_transfer_amount');
        }

        if( $request->input('non_mobile_1_refill_from') != 0){
            $total_refill_from_storage  =  $request->input('non_mobile_2_refill_amount')  ;
        }else{
            $total_refill_from_storage  = $request->input('non_mobile_1_refill_amount')  + $request->input('non_mobile_2_refill_amount')  ;

        }

       

        $fuel_reading->user_id = 0;
        $fuel_reading->row_status = 'active';

        if($fuel_reading->save()){
            // $this->history_table('fuel_entery_histories', 'Add' , 0 , $fuel_reading->id , 'hr_pro.edit_trade_license__sponsors__partners');
            
            $fuel_reading = Fuel_transfer::find($fuel_reading->id);
            $pre = $fuel_reading->previous();
            $fuel_reading->total_fuel_remaining = $pre->total_fuel_remaining - $total_refill_from_storage;

            $fuel_reading->total_fuel_consumed = $pre->total_fuel_consumed + $total_refill_from_storage;
            $fuel_reading->save();

            $this->history_table('fuel_transfer_histories', 'Edited' ,   0 , $fuel_reading->id , 'inventory.fuel.readings.edit_fuel_reading');

            return \Redirect::route('admin.inventory.fuel.readings')->with('success', 'Data Added Sucessfully');
        }

    }

    public function edit_own_vehicle(Request $request){
        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Own Vehicle
        ";
        $data['view'] = 'admin.vehicle.register_new_vehicle.edit_own_vehicle';
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
        $data['view'] = 'admin.vehicle.register_new_vehicle.edit_hired_sub_contractor_vehicle';
        return view('layout', ["data"=>$data]);

    }

    public function edit_registration(Request $request){
        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Registration
        ";
        $data['view'] = 'admin.vehicle.register_new_vehicle.edit_registration';
        return view('layout', ["data"=>$data]);

    }

    public function view_own_vehicle(Request $request){
       
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "View Own Vehicle";
        $data['view'] = 'admin.vehicle.register_new_vehicle.view_own_vehicle';
        return view('layout', ["data"=>$data]);
    }

    public function view_hired_sub_contractor_vehicle(Request $request){
        $data['modules']= DB::table('modules')->get();


        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "View Hired Own Sub Contractor Vehicle";
        $data['view'] = 'admin.vehicle.register_new_vehicle.view_hired_sub_contractor_vehicle';
        return view('layout', ["data"=>$data]);
    }

    public function view_registration(Request $request){

        $data['modules']= DB::table('modules')->get();

      
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "View Registration";
        $data['view'] = 'admin.vehicle.register_new_vehicle.view_registration';
        return view('layout', ["data"=>$data]);
    }

    public function trash_register_new_vehicle(){
        $data['modules']= DB::table('modules')->get();
        
        $data['company_names']= DB::table('company_names')->get();
        
        $data['page_title'] = "Register New Vehicle | Trash";
        $data['view'] = 'admin.vehicle.register_new_vehicle.deleted_data';
        return view('layout', ["data"=>$data]);
    }

    public function register_new_vehicle_history (){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['page_title'] = "History | Register New Vehicle
        ";
        $data['view'] = 'admin.vehicle.register_new_vehicle.register_new_vehicle_history';
        return view('layout', ["data"=>$data]);
    }


    public function delete_fuel_reading_status(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Fuel_transfer::where('id' , $id)->first();
        // dd( $id);
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id  = $office_contract->user_id;
            
        }else{
            $user_id  = 0;
        }

        $office_contract->row_status = 'deleted';

            $office_contract->action = 'delete';

 
        if( $office_contract->save()){

            $this->history_table('fuel_transfer_histories', 'Delete' ,   0, $office_contract->id , 'inventory.fuel.readings.edit_fuel_reading');
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_fuel_reading(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Fuel_transfer::where('id' , $id)->first();
        
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id = $office_contract->user_id  ;              
        }else{
            $user_id  = 0;
        }

        $office_contract->row_status = 'active';

        
        $office_contract->action = 'restored';
        
        $office_contract->save();

        $this->history_table('fuel_transfer_histories', 'Restored' ,  0 , $office_contract->id , 'inventory.fuel.readings.edit_fuel_reading');
 
        $office_contract->action = 'nill';
        $office_contract->save();
           
            return response()->json(['status'=>'1']);
        
    }

    ///////////////////////////////////////////////////
    /////////////// Tyres - Inventory /////////////////
    ///////////////////////////////////////////////////

    //tyres
    public function tyres(){
        $data['modules']= DB::table('modules')->get();
        $data['tyres'] = Inventory_Tyre::all();
        $data['total_tyre'] = Inventory_Tyre::where('row_status' ,'!=' , 'deleted')->count();
        // dd($data['total_tyre']);
        $complain_tyre = 0;
        $tyre_enterd = 0;
        foreach(Inventory_Tyre::where('row_status' ,'!=' , 'deleted')->get() as $tyre){
            // dd($ $tyre);
            if($tyre->is_complained == '1'){
                $complain_tyre = $complain_tyre +1;
            }else if($tyre->tyre_entered == '1'){
                $tyre_enterd = $tyre_enterd+1;
            }
        }
        // dd($tyre_enterd);
        $data['tyre_enterd']  =  $tyre_enterd;
        $data['complain_tyre']  =  $complain_tyre;

        //$data['muncipality'] = Muncipality_documents::where('type', '=', 'mobile')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Tyres - Inventory
        ";
        $data['view'] = 'admin.inventory.tyres.tyres';
        return view('layout', ["data"=>$data]);
    }

     //new_tyres - tyres - inventory
     public function new_used_tyres(){
        $data['modules']= DB::table('modules')->get();

        // $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'mobile')->get();
        // //dd($data['modules']);
        $data['tyres'] = Inventory_Tyre::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "New/Used Tyres";
        $data['view'] = 'admin.inventory.tyres.new_used_tyres';
        return view('layout', ["data"=>$data]);
    }

    public function trash_used_tyres(){
        $data['modules']= DB::table('modules')->get();
        $data['tyres'] = Inventory_Tyre::all();
        $data['page_title'] = "Inventorty Tyre | Trash";
        $data['view'] = 'admin.inventory.tyres.deleted_data';
        return view('layout', ["data"=>$data]);
    }

    public function tyres_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['trade_licenses_history']= DB::table('inventory__tyre_histories')->get();
     
        // dd($route = 'admin.'. $data['trade_licenses_history'][0]->route_name);
        $data['table_name']= 'inventory__tyre_histories';

        $data['page_title'] = "History | Tyres ";
        $data['view'] = 'admin.hr_pro.history';
        return view('layout', ["data"=>$data]);
    }

    public function add_used_tyres(){

        $data['modules']= DB::table('modules')->get();

       
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Used Tyres
        ";
        $data['view'] = 'admin.inventory.tyres.add_used_tyres';
        return view('layout', ["data"=>$data]);

    }

    public function edit_used_tyres(Request $request){

        $data['tyre'] = Inventory_Tyre::find($request->input('id'));
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Used Tyres
        ";
        $data['view'] = 'admin.inventory.tyres.edit_used_tyres';
        return view('layout', ["data"=>$data]);

    }

    public function update_used_tyres(Request $request){
        $tyre = Inventory_Tyre::find($request->input('id'));
        if($request->input('storage_location') != ''){
            $tyre->storage_location = $request->input('storage_location');
        }
        if($request->input('brand') != ''){
            $tyre->brand = $request->input('brand');
        }
        if($request->input('tyre_serial') != ''){
            $tyre->tyre_serial = $request->input('tyre_serial');
        }

        
        if($tyre->save()){
            $this->history_table('inventory__tyre_histories', 'Edit' ,   0 , $tyre->id , 'inventory.tyres.edit_used_tyres');
            return \Redirect::route('admin.inventory.tyres.new_used_tyres')->with('success', 'Data Updated Sucessfully');
        }

    }

    public function save_used_tyres(Request $request){
        $tyre = new Inventory_Tyre;
        if($request->input('storage_location') != ''){
            $tyre->storage_location = $request->input('storage_location');
        }
        if($request->input('brand') != ''){
            $tyre->brand = $request->input('brand');
        }
        if($request->input('tyre_serial') != ''){
            $tyre->tyre_serial = $request->input('tyre_serial');
        }

        $tyre->status = 'old';
        if($tyre->save()){
            $this->history_table('inventory__tyre_histories', 'Add Used' ,   0 , $tyre->id , 'inventory.tyres.edit_used_tyres');
            return \Redirect::route('admin.inventory.tyres.new_used_tyres')->with('success', 'Data Added Sucessfully');
        }

    }

    public function delete_used_tyres_status(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Inventory_Tyre::where('id' , $id)->first();
        
        // $customer_info->status_message = $request->input('status_message');
       

        $customer_info->row_status = 'deleted';

    
        // $this->history_table('customer_histories', $customer_info->action , $user_id);
        $this->history_table('inventory__tyre_histories', 'Delete' ,   0 , $customer_info->id , 'inventory.tyres.edit_used_tyres');
 
        if( $customer_info->save()){
           
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_used_tyres(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Inventory_Tyre::where('id' , $id)->first();
       

        $customer_info->row_status = 'active';

        $customer_info->action = 'restored';
        
        $customer_info->save();

        $this->history_table('inventory__tyre_histories', 'Restored' ,   0 , $customer_info->id , 'inventory.tyres.edit_used_tyres');

        $customer_info->save();
            return response()->json(['status'=>'1']);
    }


     //complain_tyres - tyres - inventory
     public function complain_tyres(){
        $data['modules']= DB::table('modules')->get();
        $data['tyres'] = Inventory_Tyre::all();

        // $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'mobile')->get();
        // //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Complain Tyres";
        $data['view'] = 'admin.inventory.tyres.complain_tyres';
        return view('layout', ["data"=>$data]);
    }

    public function add_complain_tyres(){

        $data['modules']= DB::table('modules')->get();

        $data['tyres'] = Inventory_Tyre::all();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Complain Tyres
        ";
        $data['view'] = 'admin.inventory.tyres.add_complain_tyres';
        return view('layout', ["data"=>$data]);

    }

    public function edit_complain_tyres(Request $request){

        $data['tyre'] = Inventory_Tyre::find($request->input('id'));

        //  $data['tyres'] = Inventory_Tyre::all();
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Complain Tyres
        ";
        $data['view'] = 'admin.inventory.tyres.edit_complain_tyres';
        return view('layout', ["data"=>$data]);

    }

    public function update_complain_tyres(Request $request){
        $tyre = Inventory_Tyre::find($request->input('id'));
        if($request->input('storage_location') != ''){
            $tyre->storage_location = $request->input('storage_location');
        }
        if($request->input('brand') != ''){
            $tyre->brand = $request->input('brand');
        }
        // if($request->input('tyre_serial') != ''){
        //     $tyre->tyre_serial = $request->input('tyre_serial');
        // }

        if($request->input('fitting_date') != ''){
            $tyre->fitting_date = $request->input('fitting_date');
        }

        if($request->input('complained') != ''){
            $tyre->complained = $request->input('complained');
        }

        if($request->input('action') != ''){
            $tyre->action = $request->input('action');
        }

        if($tyre->action == 'resolved'){
            $tyre->is_complained = 0;
        }
       
        if($tyre->save()){
            $this->history_table('inventory__tyre_histories', 'Edit Complain ' ,   0 , $tyre->id , 'inventory.tyres.edit_used_tyres');
            return \Redirect::route('admin.inventory.tyres.complain_tyres')->with('success', 'Data Updated Sucessfully');
        }

    }

    public function save_complain_tyres(Request $request){
        $tyre =  Inventory_Tyre::find($request->input('tyre_serial'));
        if($request->input('storage_location') != ''){
            $tyre->storage_location = $request->input('storage_location');
        }
        if($request->input('brand') != ''){
            $tyre->brand = $request->input('brand');
        }
        // if($request->input('tyre_serial') != ''){
        //     $tyre->tyre_serial = $request->input('tyre_serial');
        // }

        if($request->input('fitting_date') != ''){
            $tyre->fitting_date = $request->input('fitting_date');
        }

        if($request->input('complained') != ''){
            $tyre->complained = $request->input('complained');
        }
        $tyre->is_complained = 1;
        // $tyre->status = 'old';
        $tyre->action = 'pending';
        if($tyre->save()){
            $this->history_table('inventory__tyre_histories', 'Add Complain' ,   0 , $tyre->id , 'inventory.tyres.edit_used_tyres');
            return \Redirect::route('admin.inventory.tyres.complain_tyres')->with('success', 'Data Added Sucessfully');
        }

    }

    //tyres entry - tyres - inventory
    public function tyres_entry(){
        $data['modules']= DB::table('modules')->get();
        $data['tyres'] = Inventory_Tyre::all();
        // $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'mobile')->get();
        // //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Tyres Entry ";
        $data['view'] = 'admin.inventory.tyres.tyres_entry';
        return view('layout', ["data"=>$data]);
    }

    public function add_tyres_entry(){

        $data['modules']= DB::table('modules')->get();
        $data['tyres'] = Inventory_Tyre::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Tyres Entry
        ";
        $data['view'] = 'admin.inventory.tyres.add_tyres_entry';
        return view('layout', ["data"=>$data]);

    }
    public function edit_tyres_entry(Request $request){


        $data['modules']= DB::table('modules')->get();
        $data['tyre'] = Inventory_Tyre::find($request->input('id'));
        $data['tyres'] = Inventory_Tyre::all();

     
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Tyres Entry
        ";
        $data['view'] = 'admin.inventory.tyres.edit_tyres_entry';
        return view('layout', ["data"=>$data]);

    }


    public function save_tyres_entry(Request $request){
        // $myArray = explode(',', $request->input('tyre_serial'));
        // dd( $request->input('tyre_serial'));
        foreach($request->input('tyre_serial') as $element )
        {
            $tyre =  Inventory_Tyre::find($element);

            if($request->input('storage_location') != ''){
                $tyre->storage_location = $request->input('storage_location');
            }

            if($request->input('fitting_date') != ''){
                $tyre->fitting_date = $request->input('fitting_date');
            }
    
            if($request->input('fitting_place') != ''){
                $tyre->fitting_place = $request->input('fitting_place');
            }

            if($request->input('vechicle_numner') != ''){
                $tyre->vechicle_numner = $request->input('vechicle_numner');
            }
            $tyre->status = 'old';
            $tyre->tyre_entered = 1;
           
            if($tyre->save()){
                $this->history_table('inventory__tyre_histories', 'Add Tyre Entery' ,   0 , $tyre->id , 'inventory.tyres.edit_used_tyres');
                
            }
        }

        return \Redirect::route('admin.inventory.tyres.tyres_entry')->with('success', 'Data Added Sucessfully');

    }

    public function update_tyres_entry(Request $request){
        // $myArray = explode(',', $request->input('tyre_serial'));
        // dd( $request->input('tyre_serial'));
       
            $tyre =  Inventory_Tyre::find($request->input('tyre_serial'));

            if($request->input('storage_location') != ''){
                $tyre->storage_location = $request->input('storage_location');
            }

            if($request->input('fitting_date') != ''){
                $tyre->fitting_date = $request->input('fitting_date');
            }
    
            if($request->input('fitting_place') != ''){
                $tyre->fitting_place = $request->input('fitting_place');
            }

            if($request->input('vechicle_numner') != ''){
                $tyre->vechicle_numner = $request->input('vechicle_numner');
            }

            $tyre->tyre_entered = 1;
            $tyre->status =  'old';
           
            if($tyre->save()){
                $this->history_table('inventory__tyre_histories', 'Edited Tyre Entery ' ,   0 , $tyre->id , 'inventory.tyres.edit_used_tyres');
                return \Redirect::route('admin.inventory.tyres.tyres_entry')->with('success', 'Data Added Sucessfully');
            }
       
    }


    //spare parts
    public function spare_parts(){
        $data['modules']= DB::table('modules')->get();
        $data['spare_part_in_storage']= Inventory_spare_parts::where('row_status' ,'!=' , 'deleted')->count();
        $data['spare_part_entry']= Inventory_spare_parts_entery::where('row_status' ,'!=' , 'deleted')->count();
        //$data['muncipality'] = Muncipality_documents::where('type', '=', 'mobile')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Spare Parts - Inventory
        ";
        $data['view'] = 'admin.inventory.spare_parts.spare_parts';
        return view('layout', ["data"=>$data]);
    }

    //spare parts in storage - spare parts - inventory
    public function spare_parts_in_storage(){
        $data['modules']= DB::table('modules')->get();
        $data['spareparts']= Inventory_spare_parts::all();
        // $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'mobile')->get();
        // //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Spare Parts in Stoarge";
        $data['view'] = 'admin.inventory.spare_parts.spare_parts_in_storage';
        return view('layout', ["data"=>$data]);
    }

    public function add_spare_parts_in_storage(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Spare Part in Storage
        ";
        $data['view'] = 'admin.inventory.spare_parts.add_spare_parts_in_storage';
        return view('layout', ["data"=>$data]);

    }

    public function edit_spare_parts_in_storage(Request $request){
        $data['spare_part'] = Inventory_spare_parts::find((int)$request->input('id'));
        $data['modules']= DB::table('modules')->get();
        // dd($data['spare_part']->part_description);

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Spare Part in Storage
        ";
        $data['view'] = 'admin.inventory.spare_parts.edit_spare_parts_in_storage';
        return view('layout', ["data"=>$data]);

    }

    public function update_spare_parts_in_storage(Request $request){
        $spare_part = Inventory_spare_parts::find($request->input('id'));
        if($request->input('condition') != ''){
            $spare_part->condition = $request->input('condition');
        }
        if($request->input('brand_name') != ''){
            $spare_part->brand_name = $request->input('brand_name');
        }

        if($request->input('for') != ''){
            $spare_part->for = $request->input('for');
        }

        if($request->input('part_description') != ''){
            $spare_part->part_description = $request->input('part_description');
        }

    
        if($spare_part->save()){
            $this->history_table('inventory_spare_parts_histories', 'Edit Spare Part In Storage ' ,   0 , $spare_part->id , 'inventory.spare_parts.edit_spare_parts_in_storage');
            return \Redirect::route('admin.inventory.spare_parts.spare_parts_in_storage')->with('success', 'Data Updated Sucessfully');
        }

    }

    public function delete_spare_parts_status(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Inventory_spare_parts::where('id' , $id)->first();
        
        // $customer_info->status_message = $request->input('status_message');
       

        $customer_info->row_status = 'deleted';

    
        // $this->history_table('customer_histories', $customer_info->action , $user_id);
        $this->history_table('inventory_spare_parts_histories', 'Delete' ,   0 , $customer_info->id , 'inventory.spare_parts.edit_spare_parts_in_storage');
 
        if( $customer_info->save()){
           
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_spare_parts(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Inventory_spare_parts::where('id' , $id)->first();
       

        $customer_info->row_status = 'active';

        $customer_info->action = 'restored';
        
        $customer_info->save();

        $this->history_table('inventory_spare_parts_histories', 'Restored' ,   0 , $customer_info->id , 'inventory.spare_parts.edit_spare_parts_in_storage');

        $customer_info->save();
            return response()->json(['status'=>'1']);
    }

    public function spare_parts_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['trade_licenses_history']= DB::table('inventory_spare_parts_histories')->get();
     
        // dd($route = 'admin.'. $data['trade_licenses_history'][0]->route_name);
        $data['table_name']= 'inventory_spare_parts_histories';

        $data['page_title'] = "History | Spare Parts ";
        $data['view'] = 'admin.hr_pro.history';
        return view('layout', ["data"=>$data]);
    }

    public function spare_parts_trash(){
        $data['modules']= DB::table('modules')->get();
        $data['spare_parts'] = Inventory_spare_parts::all();
        $data['page_title'] = "Inventorty Spare Part In Storage | Trash";
        $data['view'] = 'admin.inventory.spare_parts.deleted_data_in_storage';
        return view('layout', ["data"=>$data]);
    }

    //spare parts entry - spare parts - inventory
    public function spare_parts_entry(){
        $data['modules']= DB::table('modules')->get();
        $data['spare_parts'] = Inventory_spare_parts_entery::all();
        $data['spare_part'] = Inventory_spare_parts::all();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['page_title'] = "Spare Parts Entry";
        $data['view'] = 'admin.inventory.spare_parts.spare_parts_entry';
        return view('layout', ["data"=>$data]);
    }

    public function add_spare_parts_entry(){
        $data['modules']= DB::table('modules')->get();
        $data['spare_parts'] = Inventory_spare_parts::all();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Spare Parts Entry";
        $data['view'] = 'admin.inventory.spare_parts.add_spare_parts_entry';
        return view('layout', ["data"=>$data]);
    }

    public function save_spare_parts_entry(Request $request){

    

        $spare_part = Inventory_spare_parts::find((int)$request->input('part_description_id'));

        if($request->input('quantity') >= $spare_part->quantity ){
            return \Redirect::route('admin.inventory.spare_parts.spare_parts_entry')->with('error', 'Product you selected is low in inventory');
        }


        $spare_part_entery =  new Inventory_spare_parts_entery;
        if($request->input('person') != ''){
            $spare_part_entery->person = $request->input('person');
        }

        if($request->input('part_description_id') != ''){
            $spare_part_entery->part_description_id = $request->input('part_description_id');
        }

        if($request->input('vechicle') != ''){
            $spare_part_entery->vechicle = $request->input('vechicle');
        }

        if($request->input('date') != ''){
            $spare_part_entery->date = $request->input('date');
        }

        if($request->input('quantity') != ''){
            $spare_part_entery->quantity = $request->input('quantity');
        }

        if($request->input('driver_name') != ''){
            $spare_part_entery->driver_name = $request->input('driver_name');
        }

        if($request->input('forman_name') != ''){
            $spare_part_entery->forman_name = $request->input('forman_name');
        }

        if ($request->hasFile('requisition')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->requisition->getClientOriginalName());
            $file = $request->file('requisition');
            if($file->storeAs('/main_admin/inventory/spare_part/requisition/', $name , ['disk' => 'public_uploads'])){
                $spare_part_entery->requisition = $name;
            }
         
        }
        

    
        if($spare_part_entery->save()){
            $this->history_table('inventory_spare_parts_entery_histories', 'Sparepart Entery  Added' ,   0 , $spare_part->id , 'inventory.spare_parts.edit_spare_parts_entry');

            $spare_part->quantity = $spare_part->quantity - $spare_part_entery->quantity;
            $spare_part->save();

            $this->history_table('inventory_spare_parts_histories', $spare_part->quantity.' Sparepart given to driver' ,   0 , $spare_part->id , 'inventory.spare_parts.edit_spare_parts_in_storage');

            return \Redirect::route('admin.inventory.spare_parts.spare_parts_entry')->with('success', 'Data Added Sucessfully');
        }

    }

    public function update_spare_parts_entry(Request $request){

    

       
        $spare_part_entery =  Inventory_spare_parts_entery::find((int)$request->input('id'));
        if($request->input('person') != ''){
            $spare_part_entery->person = $request->input('person');
        }


        if($request->input('vechicle') != ''){
            $spare_part_entery->vechicle = $request->input('vechicle');
        }

        if($request->input('date') != ''){
            $spare_part_entery->date = $request->input('date');
        }

        

        if($request->input('driver_name') != ''){
            $spare_part_entery->driver_name = $request->input('driver_name');
        }

        if($request->input('forman_name') != ''){
            $spare_part_entery->forman_name = $request->input('forman_name');
        }

        if ($request->hasFile('requisition')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->requisition->getClientOriginalName());
            $file = $request->file('requisition');
            if($file->storeAs('/main_admin/inventory/spare_part/requisition/', $name , ['disk' => 'public_uploads'])){
                $spare_part_entery->requisition = $name;
            }
         
        }
        

    
        if($spare_part_entery->save()){
            $this->history_table('inventory_spare_parts_entery_histories', 'Sparepart Entery  Edited' ,   0 , $spare_part_entery->id , 'inventory.spare_parts.edit_spare_parts_entry');

            return \Redirect::route('admin.inventory.spare_parts.spare_parts_entry')->with('success', 'Data Updated Sucessfully');
        }

    }

    public function edit_spare_parts_entry(Request $request){

        $data['spare_part_entery'] =   Inventory_spare_parts_entery::find((int)$request->input('id'));

        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['page_title'] = "Edit Spare Parts Entry";
        $data['view'] = 'admin.inventory.spare_parts.edit_spare_parts_entry';
        return view('layout', ["data"=>$data]);
    }

    public function spare_parts_entry_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['trade_licenses_history']= DB::table('inventory_spare_parts_entery_histories')->get();
     
        // dd($route = 'admin.'. $data['trade_licenses_history'][0]->route_name);
        $data['table_name']= 'inventory_spare_parts_entery_histories';

        $data['page_title'] = "History | Spare Parts Entries";
        $data['view'] = 'admin.hr_pro.history';
        return view('layout', ["data"=>$data]);
    }

    public function delete_spare_parts_entry_status(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Inventory_spare_parts_entery::where('id' , $id)->first();
        
        // $customer_info->status_message = $request->input('status_message');
       

        $customer_info->row_status = 'deleted';

    
        // $this->history_table('customer_histories', $customer_info->action , $user_id);
        $this->history_table('inventory_spare_parts_entery_histories', 'Delete' ,   0 , $customer_info->id , 'inventory.spare_parts.edit_spare_parts_entry');
 
        if( $customer_info->save()){
           
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_spare_parts_entry(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Inventory_spare_parts_entery::where('id' , $id)->first();
       

        $customer_info->row_status = 'active';

        $customer_info->action = 'restored';
        
        $customer_info->save();

        $this->history_table('inventory_spare_parts_entery_histories', 'Restored' ,   0 , $customer_info->id , 'inventory.spare_parts.edit_spare_parts_entry');

        $customer_info->save();
            return response()->json(['status'=>'1']);
    }

    public function spare_parts_entry_trash(){
        $data['modules']= DB::table('modules')->get();
        $data['spare_parts'] = Inventory_spare_parts_entery::all();
        $data['page_title'] = "Inventorty Spare Parts Entery | Trash";
        $data['view'] = 'admin.inventory.spare_parts.deleted_data_entry';
        return view('layout', ["data"=>$data]);
    }

    //tools
    public function tools(){
        $data['modules']= DB::table('modules')->get();
        $data['tools_in_storage']= Inventory_tools::where('row_status' ,'!=' , 'deleted')->count();
        $data['tools_entry']= Inventory_tools_entry::where('row_status' ,'!=' , 'deleted')->count();

        //$data['muncipality'] = Muncipality_documents::where('type', '=', 'mobile')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Tools in Workshop - Inventory
        ";
        $data['view'] = 'admin.inventory.tools.tools';
        return view('layout', ["data"=>$data]);
    }



    //

    //Tools in storage - tools - inventory
    public function tools_in_storage(){
        $data['modules']= DB::table('modules')->get();
        $data['tools']= Inventory_tools::all();
        
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
       

        $data['page_title'] = "Tools in Stoarge";
        $data['view'] = 'admin.inventory.tools.tools_in_storage';
        return view('layout', ["data"=>$data]);
    }

    public function add_tools_in_storage(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Tools in Storage
        ";
        $data['view'] = 'admin.inventory.tools.add_tools_in_storage';
        return view('layout', ["data"=>$data]);

    }

    public function edit_tools_in_storage(Request $request){
        $data['spare_part'] = Inventory_tools::find((int)$request->input('id'));
        $data['modules']= DB::table('modules')->get();
        // dd($data['spare_part']->part_description);

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Tools in Storage
        ";
        $data['view'] = 'admin.inventory.tools.edit_tools_in_storage';
        return view('layout', ["data"=>$data]);

    }

    public function view_tools_in_storage(Request $request){
        $data['tools'] = Inventory_tools::find((int)$request->input('id'));
        $data['modules']= DB::table('modules')->get();
        // dd($data['spare_part']->part_description);

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "View Tools in Storage
        ";
        $data['view'] = 'admin.inventory.tools.view_tools_in_storage';
        return view('layout', ["data"=>$data]);

    }

    public function update_tools_in_storage(Request $request){
        $spare_part = Inventory_tools::find($request->input('id'));
        if($request->input('condition') != ''){
            $spare_part->condition = $request->input('condition');
        }
        if($request->input('brand_name') != ''){
            $spare_part->brand_name = $request->input('brand_name');
        }

        if($request->input('for') != ''){
            $spare_part->for = $request->input('for');
        }

        if($request->input('part_description') != ''){
            $spare_part->part_description = $request->input('part_description');
        }

    
        if($spare_part->save()){
            $this->history_table('inventory_tools_histories', 'Edit Spare Part In Storage ' ,   0 , $spare_part->id , 'inventory.tools.edit_tools_in_storage');
            return \Redirect::route('admin.inventory.tools.tools_in_storage')->with('success', 'Data Updated Sucessfully');
        }

    }

    public function delete_tools_status(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Inventory_tools::where('id' , $id)->first();
        
        // $customer_info->status_message = $request->input('status_message');
       

        $customer_info->row_status = 'deleted';

    
        
        $this->history_table('inventory_tools_histories', 'Delete' ,   0 , $customer_info->id , 'inventory.tools.view_tools_in_storage');
 
        if( $customer_info->save()){
           
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_tools(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Inventory_tools::where('id' , $id)->first();
       

        $customer_info->row_status = 'active';

        $customer_info->action = 'restored';
        
        $customer_info->save();

        $this->history_table('inventory_tools_histories', 'Restored' ,   0 , $customer_info->id , 'inventory.tools.view_tools_in_storage');

        $customer_info->save();
            return response()->json(['status'=>'1']);
    }

    public function tools_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['trade_licenses_history']= DB::table('inventory_tools_histories')->get();
     
        // dd($route = 'admin.'. $data['trade_licenses_history'][0]->route_name);
        $data['table_name']= 'inventory_tools_histories';

        $data['page_title'] = "History | Tools In Storage ";
        $data['view'] = 'admin.hr_pro.history';
        return view('layout', ["data"=>$data]);
    }

    public function tools_trash(){
        $data['modules']= DB::table('modules')->get();
        $data['tools'] = Inventory_tools::all();
        $data['page_title'] = "Inventorty Tools In Storage | Trash";
        $data['view'] = 'admin.inventory.tools.deleted_data_in_storage';
        return view('layout', ["data"=>$data]);
    }

    //tools entry - tools - inventory
    public function tools_entry(){
        $data['modules']= DB::table('modules')->get();
        $data['tools_entry'] = Inventory_tools_entry::all();
        $data['tools'] = Inventory_tools::all();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['page_title'] = "Tools Entry";
        $data['view'] = 'admin.inventory.tools.tools_entry';
        return view('layout', ["data"=>$data]);
    }

    public function add_tools_entry(){
        $data['modules']= DB::table('modules')->get();
        $data['tools'] = Inventory_tools::all();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Tools Entry";
        $data['view'] = 'admin.inventory.tools.add_tools_entry';
        return view('layout', ["data"=>$data]);
    }

    public function save_tools_entry(Request $request){
        $tool_in_storage = Inventory_tools::find((int)$request->input('tools_description'));
        // dd($tool_in_storage);
        if($request->input('quantity') > $tool_in_storage->quantity ){
            return \Redirect::route('admin.inventory.tools.tools_entry')->with('error', 'Product you selected is low in inventory');
        }


        $tools_entery =  new Inventory_tools_entry;

        if($request->input('tools_description') != ''){
            $tools_entery->tools_description = $request->input('tools_description');
        }

        if($request->input('date') != ''){
            $tools_entery->date = $request->input('date');
        }

        
        if($request->input('assign_person_name') != ''){
            $tools_entery->assign_person_name = $request->input('assign_person_name');
        }

        if($request->input('assign_person_designation') != ''){
            $tools_entery->assign_person_designation = $request->input('assign_person_designation');
        }

                

        if($request->input('quantity') != ''){
            $tools_entery->quantity = $request->input('quantity');
        }



        if ($request->hasFile('reciving')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->reciving->getClientOriginalName());
            $file = $request->file('reciving');
            if($file->storeAs('/main_admin/inventory/tools/reciving/', $name , ['disk' => 'public_uploads'])){
                $tools_entery->reciving = $name;
            }
         
        }
        

    
        if($tools_entery->save()){
            $this->history_table('inventory_tools_entry_histories', 'Tools Entery  Added' ,   0 , $tools_entery->id , 'inventory.tools.edit_tools_entry');

            $tool_in_storage->quantity = $tool_in_storage->quantity - $tools_entery->quantity;
            $tool_in_storage->save();

            $this->history_table('inventory_tools_histories', $tools_entery->quantity.' Tools given to ' .$tools_entery->assign_person_designation  ,   0 , $tool_in_storage->id , 'inventory.tools.view_tools_in_storage');

            return \Redirect::route('admin.inventory.tools.tools_entry')->with('success', 'Data Added Sucessfully');
        }

    }

    public function update_tools_entry(Request $request){
 
        $tools_entery = Inventory_tools_entry::find((int)$request->input('id'));

        // if($request->input('tool_descripiton') != ''){
        //     $tools_entery->tool_descripiton = $request->input('tool_descripiton');
        // }

        if($request->input('date') != ''){
            $tools_entery->date = $request->input('date');
        }

        
        if($request->input('assign_person_name') != ''){
            $tools_entery->assign_person_name = $request->input('assign_person_name');
        }

        if($request->input('assign_person_designation') != ''){
            $tools_entery->assign_person_designation = $request->input('assign_person_designation');
        }

        if ($request->hasFile('reciving')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->reciving->getClientOriginalName());
            $file = $request->file('reciving');
            if($file->storeAs('/main_admin/inventory/tools/reciving/', $name , ['disk' => 'public_uploads'])){
                $tools_entery->reciving = $name;
            }
         
        }
        

    
        if($tools_entery->save()){
            $this->history_table('inventory_tools_entry_histories', 'Tools Entery  Edited' ,   0 , $tools_entery->id , 'inventory.tools.edit_tools_entry');

        
            return \Redirect::route('admin.inventory.tools.tools_entry')->with('success', 'Data Updated Sucessfully');
        }


    }

    public function edit_tools_entry(Request $request){

        $data['tools_entery'] =   Inventory_tools_entry::find((int)$request->input('id'));

        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['page_title'] = "Edit Tools Entry";
        $data['view'] = 'admin.inventory.tools.edit_tools_entry';
        return view('layout', ["data"=>$data]);
    }

    public function tools_entry_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['trade_licenses_history']= DB::table('inventory_tools_entry_histories')->get();
     
        // dd($route = 'admin.'. $data['trade_licenses_history'][0]->route_name);
        $data['table_name']= 'inventory_tools_entry_histories';

        $data['page_title'] = "History | Tools Entries";
        $data['view'] = 'admin.hr_pro.history';
        return view('layout', ["data"=>$data]);
    }

    public function delete_tools_entry_status(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Inventory_tools_entry::where('id' , $id)->first();
        
        // $customer_info->status_message = $request->input('status_message');
       

        $customer_info->row_status = 'deleted';

    
        // $this->history_table('customer_histories', $customer_info->action , $user_id);
        $this->history_table('inventory_tools_entry_histories', 'Delete' ,   0 , $customer_info->id , 'inventory.tools.edit_tools_entry');
 
        if( $customer_info->save()){
           
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_tools_entry(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Inventory_tools_entry::where('id' , $id)->first();
       

        $customer_info->row_status = 'active';

        $customer_info->action = 'restored';
        
        $customer_info->save();

        $this->history_table('inventory_tools_entry_histories', 'Restored' ,   0 , $customer_info->id , 'inventory.tools.edit_tools_entry');

        $customer_info->save();
            return response()->json(['status'=>'1']);
    }

    public function tools_entry_trash(){
        $data['modules']= DB::table('modules')->get();
        $data['tools_entry'] = Inventory_tools_entry::all();
        $data['page_title'] = "Inventorty Tools Entery | Trash";
        $data['view'] = 'admin.inventory.tools.deleted_data_entry';
        return view('layout', ["data"=>$data]);
    }
    //
    public function uncategorized (){
        $data['modules']= DB::table('modules')->get();
        $data['uncategorized']= Inventory_uncategorized::all();
        
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 5)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
       

        $data['page_title'] = "Uncategorized Product ";
        $data['view'] = 'admin.inventory.uncategorized.uncategorized';
        return view('layout', ["data"=>$data]);
    }

    public function view_uncategorized(Request $request){
        $data['uncategorized'] = Inventory_uncategorized::find((int)$request->input('id'));
        $data['modules']= DB::table('modules')->get();
        // dd($data['spare_part']->part_description);

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 5)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "View uncategorized Data
        ";
        $data['view'] = 'admin.inventory.uncategorized.view_uncategorized';
        return view('layout', ["data"=>$data]);

    }

    public function delete_uncategorized_status(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Inventory_uncategorized::where('id' , $id)->first();
        
        // $customer_info->status_message = $request->input('status_message');
       

        $customer_info->row_status = 'deleted';

    
        
        $this->history_table('inventory_uncategorized_histories', 'Delete' ,   0 , $customer_info->id , 'inventory.uncategorized.view_uncategorized');
 
        if( $customer_info->save()){
           
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function uncategorized_tools(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Inventory_uncategorized::where('id' , $id)->first();
       

        $customer_info->row_status = 'active';

        $customer_info->action = 'restored';
        
        $customer_info->save();

        $this->history_table('inventory_tools_histories', 'Restored' ,   0 , $customer_info->id , 'inventory.uncategorized.view_uncategorized');

        $customer_info->save();
            return response()->json(['status'=>'1']);
    }

    public function uncategorized_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 5)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['trade_licenses_history']= DB::table('inventory_uncategorized_histories')->get();
     
        // dd($route = 'admin.'. $data['trade_licenses_history'][0]->route_name);
        $data['table_name']= 'inventory_uncategorized_histories';

        $data['page_title'] = "History | Uncategorized Data | Inventory ";
        $data['view'] = 'admin.hr_pro.history';
        return view('layout', ["data"=>$data]);
    }

    public function uncategorized_trash(){
        $data['modules']= DB::table('modules')->get();
        $data['uncategorized'] = Inventory_tools::all();
        $data['page_title'] = "Inventorty Uncategorized Data | Trash";
        $data['view'] = 'admin.inventory.uncategorized.deleted_data';
        return view('layout', ["data"=>$data]);
    }
}