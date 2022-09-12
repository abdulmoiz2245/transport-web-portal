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
use App\Models\Employee;
use App\Models\workshop;

use App\Models\workshop_edit_history;
use App\Models\workshop_history;

use App\Models\workshop_preventive_check_list;
use App\Models\workshop_preventive_check_list_history;
use App\Models\workshop_preventive_check_list_edit_history;



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

class WorkshopController extends Controller
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
    ///////// Workshop /////////
    /////////////////////////////////

    public function workshop(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);     

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
        $data['purchases']= DB::table('purchases')->get();
        // $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Workshop";
        $data['view'] = 'admin.workshop.workshop';
        return view('layout', ["data"=>$data]);
    }

      /////////////////////////////////
    /////////  job_card /////////
    /////////////////////////////////

    public function job_card(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        
        $data['workshop'] = workshop::all();
        $data['employee'] = Employee::all();
        $data['vehicle'] = Vehicle::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 10)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['page_title'] = "Job Card";
        $data['view'] = 'admin.workshop.job_card.job_card';
        return view('layout', ["data"=>$data]);
    }

    public function trash_job_card(){
        $data['modules']= DB::table('modules')->get();
        $data['workshop'] = workshop::all();
        $data['employee'] = Employee::all();
        $data['vehicle'] = Vehicle::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 10)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "Workshop jobs Trash";
        $data['view'] = 'admin.workshop.job_card.deleted_data';
        return view('layout', ["data"=>$data]);
    }

    public function job_card_history(){

        $data['modules']= DB::table('modules')->get();
        
        $data['employees'] = Employee::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 10)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['trade_licenses_history']= workshop_history::all();
        $data['table_name']= 'workshop_histories';

        $data['page_title'] = "History | Workshop ";
        $data['view'] = 'admin.hr_pro.history';
        return view('layout', ["data"=>$data]);
    }

    public function add_job_card(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 10)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['employee'] = Employee::all();
        $data['vehicle'] = Vehicle::where('registration_type' , '!=' , 'trailer')->get();

        $data['employee_workshop'] = Employee::where('designation' ,'=' , 'workshop')->where('row_status' , '!=' , 'deleted')->get();
        $data['page_title'] = "Add  Job Card";
        $data['view'] = 'admin.workshop.job_card.add_job_card';
        return view('layout', ["data"=>$data]);
    }

    public function view_job_card(Request $request){
        $data['workshop'] = workshop::find($request->input('id'));
        $data['employee'] = Employee::all();
        $data['vehicle'] = Vehicle::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 10)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['employee_workshop'] = Employee::where('designation' ,'=' , 'workshop')->where('row_status' , '!=' , 'deleted');

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        
        $data['page_title'] = "View Job Card ";
        $data['view'] = 'admin.workshop.job_card.view_job_card';
        return view('layout', ["data"=>$data]);
    }

    public function edit_job_card (Request $request){
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 10)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['workshop'] = workshop::find((int)$request->input('id'));
        $data['workshop_history'] = workshop_edit_history::where('row_id' , (int)$request->input('id'))->orderBy('created_at','desc')->first();
        
        if( $data['workshop_history'] == null){
            // $data['vehicle_history'] = new vehicle_edit_history;
        }

        $data['modules']= DB::table('modules')->get();
        $data['employee'] = Employee::all();
        $data['vehicle'] = Vehicle::all();

        $data['employee_workshop'] = Employee::where('designation' ,'=' , 'workshop')->where('row_status' , '!=' , 'deleted');
        //dd($data['modules']);
        

        $data['page_title'] = "Edit job Card";
        $data['view'] = 'admin.workshop.job_card.edit_job_card';
        return view('layout', ["data"=>$data]);
    }

    public function save_job_card(Request $request){

        $job_card = new workshop;
        $vehicle = vehicle::find((int)$request->input('vehicle_id'));
        // $employee->employee_current_action = 'suspended';
      
        $job_card->driver_id = $vehicle->driver_id;

        if($request->input('vehicle_id') != ''){
            $job_card->vehicle_id = $request->input('vehicle_id');

        }
        if($request->input('helper_id') != ''){
            $job_card->helper_id = $request->input('helper_id');

        }

        if($request->input('electrician_id') != ''){
            $job_card->electrician_id = $request->input('electrician_id');

        }
        if($request->input('denter_id') != ''){
            $job_card->denter_id = $request->input('denter_id');

        }
        if($request->input('painter_id') != ''){
            $job_card->painter_id = $request->input('painter_id');

        }
        if($request->input('whelder_id') != ''){
            $job_card->whelder_id = $request->input('whelder_id');

        }
        if($request->input('mechanic_id') != ''){
            $job_card->mechanic_id = $request->input('mechanic_id');

        }
        if($request->input('driver_complaint') != ''){
            $job_card->driver_complaint = $request->input('driver_complaint');

        }
        if($request->input('other_job_description') != ''){
            $job_card->other_job_description = $request->input('other_job_description');

        }
        if($request->input('job_description') != ''){
            $job_card->job_description = $request->input('job_description');

        }
        if($request->input('findings') != ''){
            $job_card->findings = $request->input('findings');

        }
        // 
        // if($request->input('date') != ''){
            $job_card->date = date('Y-m-d');
        // }

        if ($request->hasFile('job_card_document')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->job_card_document->getClientOriginalName());
            $file = $request->file('job_card_document');
            if($file->storeAs('/main_admin/workshop/', $name , ['disk' => 'public_uploads'])){
                $job_card->job_card_document	 = $name;

            }
           

        }
        if($request->input('issue_status') != ''){
            $job_card->issue_status = $request->input('issue_status');

        }
        $job_card->status = 'approved';
 
         if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }
        $job_card->user_id = $user_id;
        
       


        if($job_card->save()){
            $this->history_table('workshop_histories', 'Add' , 0 , $job_card->id , 'workshop.view_job_card');
            return \Redirect::route('admin.workshop.job_card')->with('success', 'Data Added Sucessfully');
        }
        


    }

    public function update_job_card(Request $request){
        $job_card = workshop::where('id' , (int)$request->input('id') )->first();

        $vehicle = vehicle::find((int)$request->input('vehicle_id'));
  
        $job_card->driver_id = $vehicle->driver_id;

        if($request->input('vehicle_id') != ''){
            $job_card->vehicle_id = $request->input('vehicle_id');

        }
        if($request->input('helper_id') != ''){
            $job_card->helper_id = $request->input('helper_id');

        }

        if($request->input('electrician_id') != ''){
            $job_card->electrician_id = $request->input('electrician_id');

        }
        if($request->input('denter_id') != ''){
            $job_card->denter_id = $request->input('denter_id');

        }
        if($request->input('painter_id') != ''){
            $job_card->painter_id = $request->input('painter_id');

        }
        if($request->input('whelder_id') != ''){
            $job_card->whelder_id = $request->input('whelder_id');

        }
        if($request->input('mechanic_id') != ''){
            $job_card->mechanic_id = $request->input('mechanic_id');

        }
        if($request->input('driver_complaint') != ''){
            $job_card->driver_complaint = $request->input('driver_complaint');

        }
        if($request->input('other_job_description') != ''){
            $job_card->other_job_description = $request->input('other_job_description');

        }
        if($request->input('job_description') != ''){
            $job_card->job_description = $request->input('job_description');

        }
        if($request->input('findings') != ''){
            $job_card->findings = $request->input('findings');

        }
        // 
        // if($request->input('date') != ''){
            // $job_card->date = date('Y-m-d');
        // }

        if ($request->hasFile('job_card_document')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->job_card_document->getClientOriginalName());
            $file = $request->file('job_card_document');
            if($file->storeAs('/main_admin/workshop/', $name , ['disk' => 'public_uploads'])){
                $job_card->job_card_document	 = $name;

            }
           

        }
        if($request->input('issue_status') != ''){
            $job_card->issue_status = $request->input('issue_status');

        }
        $job_card->status = 'approved';
 
         if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }
        $job_card->user_id = $user_id;

        if($job_card->save()){
            $this->history_table('workshop_histories', 'Edit' , 0 , $job_card->id , 'workshop.view_job_card');
            return \Redirect::route('admin.workshop.job_card')->with('success', 'Data Updated Sucessfully');
        }

    }

   
    public function delete_job_card_status(Request $request){
        $id =  (int)$request->input('id');
        $job_card = workshop::where('id' , $id)->first();

        // $job_card->status_message = $request->input('status_message');
        if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }

        $job_card->row_status = 'deleted';
        
        $job_card->action = 'delete';
        
        $job_card->status = 'pending';
 
        if( $job_card->save()){

            $this->history_table('workshop_histories', $job_card->action , $user_id , $job_card->id , 'workshop.view_job_card');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_job_card(Request $request){
        $id =  (int)$request->input('id');
        $job_card = workshop::where('id' , $id)->first();
        
        if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }

        $job_card->row_status = 'active';
        $job_card->status = 'approved';

        $job_card->action = 'Restored';
        
        $job_card->save();

        $this->history_table('workshop_histories', $job_card->action , $user_id , $job_card->id , 'workshop.view_job_card');
 
        $job_card->action = 'deleted';
        $job_card->save();
           
        return response()->json(['status'=>'1']);
        
    }

    //vehicle maintinance
    public function vehicle_maintainace_schedule(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 10)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['page_title'] = "Vehicle Maintainace Schedule";
        $data['view'] = 'admin.workshop.vehicle_maintainace_schedule.vehicle_maintainace_schedule';
        return view('layout', ["data"=>$data]);
    }

    public function vehicle_oil_change_detail(){

        $data['modules']= DB::table('modules')->get();
         
        $data['workshop'] = workshop::where('job_description' , '=' , 'oil_change')->get();
        $data['employee'] = Employee::all();
        $data['vehicle'] = Vehicle::all();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 10)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['page_title'] = "Vehicle Oil Change Detail";
        $data['view'] = 'admin.workshop.vehicle_maintainace_schedule.vehicle_oil_change_detail';
        return view('layout', ["data"=>$data]);
    }

    //vehicle check list
    public function preventive_check_list(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        
        $data['workshop'] = workshop_preventive_check_list::all();
        $data['employee'] = Employee::all();
        $data['vehicle'] = Vehicle::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 10)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['page_title'] = "Vehicle Preventive Check List";
        $data['view'] = 'admin.workshop.vehicle_maintainace_schedule.preventive_check_list.preventive_check_list';
        return view('layout', ["data"=>$data]);
    }

    public function trash_preventive_check_list(){
        $data['modules']= DB::table('modules')->get();
        $data['workshop'] = workshop_preventive_check_list::all();
        $data['employee'] = Employee::all();
        $data['vehicle'] = Vehicle::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 10)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "Preventive Check list Trash";
        $data['view'] = 'admin.workshop.vehicle_maintainace_schedule.preventive_check_list.deleted_data';
        return view('layout', ["data"=>$data]);
    }

    public function preventive_check_list_history(){

        $data['modules']= DB::table('modules')->get();
        
        $data['employees'] = Employee::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 10)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['trade_licenses_history']= workshop_preventive_check_list_history::all();
        $data['table_name']= 'workshop_preventive_check_list_histories';

        $data['page_title'] = "History | Preventive Check List ";
        $data['view'] = 'admin.hr_pro.history';
        return view('layout', ["data"=>$data]);
    }

    public function add_preventive_check_list(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 10)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['employee'] = Employee::all();
        $data['vehicle'] = Vehicle::where('registration_type' , '!=' , 'trailer')->get();

        $data['employee_workshop'] = Employee::where('designation' ,'=' , 'workshop')->where('row_status' , '!=' , 'deleted')->get();
        $data['page_title'] = "Add Preventive Check list";
        $data['view'] = 'admin.workshop.vehicle_maintainace_schedule.preventive_check_list.add_preventive_check_list';
        return view('layout', ["data"=>$data]);
    }

    public function view_preventive_check_list(Request $request){
        $data['workshop'] = workshop_preventive_check_list::find($request->input('id'));
        $data['employee'] = Employee::all();
        $data['vehicle'] = Vehicle::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 10)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['employee_workshop'] = Employee::where('designation' ,'=' , 'workshop')->where('row_status' , '!=' , 'deleted');

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        
        $data['page_title'] = "View Preventive Check list ";
        $data['view'] = 'admin.workshop.vehicle_maintainace_schedule.preventive_check_list.view_preventive_check_list';
        return view('layout', ["data"=>$data]);
    }

    public function edit_preventive_check_list (Request $request){
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 10)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['check_list'] = workshop_preventive_check_list::find((int)$request->input('id'));
        $data['check_list_history'] = workshop_preventive_check_list_edit_history::where('row_id' , (int)$request->input('id'))->orderBy('created_at','desc')->first();
        
        if( $data['check_list_history'] == null){
            // $data['vehicle_history'] = new vehicle_edit_history;
        }

        $data['modules']= DB::table('modules')->get();
        $data['employee'] = Employee::all();
        $data['vehicle'] = Vehicle::all();

        $data['employee_workshop'] = Employee::where('designation' ,'=' , 'workshop')->where('row_status' , '!=' , 'deleted');
        //dd($data['modules']);
        

        $data['page_title'] = "Edit Preventive Check list";
        $data['view'] = 'admin.workshop.vehicle_maintainace_schedule.preventive_check_list.edit_preventive_check_list';
        return view('layout', ["data"=>$data]);
    }

    public function save_preventive_check_list(Request $request){

        $preventive_check_list = new workshop_preventive_check_list;
        $vehicle = vehicle::find((int)$request->input('vehicle_id'));
        // $employee->employee_current_action = 'suspended';
      
        $preventive_check_list->driver_id = $vehicle->driver_id;

        if($request->input('vehicle_id') != ''){
            $preventive_check_list->vehicle_id = $request->input('vehicle_id');

        }
        
        $preventive_check_list->date = date('Y-m-d');

        if ($request->hasFile('check_list_copy')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->check_list_copy->getClientOriginalName());
            $file = $request->file('check_list_copy');
            if($file->storeAs('/main_admin/workshop/', $name , ['disk' => 'public_uploads'])){
                $preventive_check_list->check_list_copy	 = $name;

            }
           

        }
        

        $preventive_check_list->status = 'approved';
 
         if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }
        $preventive_check_list->user_id = $user_id;
        
       


        if($preventive_check_list->save()){
            $this->history_table('workshop_preventive_check_list_histories', 'Add' , 0 , $preventive_check_list->id , 'workshop.view_preventive_check_list');
            return \Redirect::route('admin.workshop.preventive_check_list')->with('success', 'Data Added Sucessfully');
        }
        


    }

    public function update_preventive_check_list(Request $request){
        $preventive_check_list = workshop_preventive_check_list::where('id' , (int)$request->input('id') )->first();

        $vehicle = vehicle::find((int)$request->input('vehicle_id'));
        $preventive_check_list->driver_id = $vehicle->driver_id;

        if($request->input('vehicle_id') != ''){
            $preventive_check_list->vehicle_id = $request->input('vehicle_id');

        }
        
        // $preventive_check_list->date = date('Y-m-d');

        if ($request->hasFile('check_list_copy')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->check_list_copy->getClientOriginalName());
            $file = $request->file('check_list_copy');
            if($file->storeAs('/main_admin/workshop/', $name , ['disk' => 'public_uploads'])){
                $preventive_check_list->check_list_copy	 = $name;

            }
           

        }

        $preventive_check_list->status = 'approved';
 
         if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }
        $preventive_check_list->user_id = $user_id;

        if($preventive_check_list->save()){
            $this->history_table('workshop_preventive_check_list_histories', 'Edit' , 0 , $preventive_check_list->id , 'workshop.view_preventive_check_list');
            return \Redirect::route('admin.workshop.preventive_check_list')->with('success', 'Data Updated Sucessfully');
        }

    }

   
    public function delete_preventive_check_list_status(Request $request){
        $id =  (int)$request->input('id');
        $preventive_check_list = workshop_preventive_check_list::where('id' , $id)->first();

        // $preventive_check_list->status_message = $request->input('status_message');
        if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }

        $preventive_check_list->row_status = 'deleted';
        
        $preventive_check_list->action = 'delete';
        
        $preventive_check_list->status = 'pending';
 
        if( $preventive_check_list->save()){

            $this->history_table('workshop_preventive_check_list_histories', $preventive_check_list->action , $user_id , $preventive_check_list->id , 'workshop.view_preventive_check_list');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_preventive_check_list(Request $request){
        $id =  (int)$request->input('id');
        $preventive_check_list = workshop_preventive_check_list::where('id' , $id)->first();
        
        if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }

        $preventive_check_list->row_status = 'active';
        $preventive_check_list->status = 'approved';

        $preventive_check_list->action = 'Restored';
        
        $preventive_check_list->save();

        $this->history_table('workshop_preventive_check_list_histories', $preventive_check_list->action , $user_id , $preventive_check_list->id , 'workshop.view_preventive_check_list');
 
        $preventive_check_list->action = 'deleted';
        $preventive_check_list->save();
           
        return response()->json(['status'=>'1']);
        
    }

    public function vehicle_maintenance_detail(){
        $data['workshop'] = workshop::all();
        $data['employee'] = Employee::all();
        $data['vehicle'] = Vehicle::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 10)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['employee_workshop'] = Employee::where('designation' ,'=' , 'workshop')->where('row_status' , '!=' , 'deleted');

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        
        $data['page_title'] = "Vehicle Maintenance Detail ";
        $data['view'] = 'admin.workshop.job_card.vehicle_maintenance_detail';
        return view('layout', ["data"=>$data]);
    }
}