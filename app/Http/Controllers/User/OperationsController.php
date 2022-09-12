<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Roles;
use App\Models\Company_name;
use App\Models\Modules;
use App\Models\Customer_info;
use App\Models\Sub_contractor_info;
use App\Models\Vehicle;
use App\Models\Vehicle_history;




use App\Models\Approvals;
use App\Models\Employee;
use App\Models\Employee_history;
use App\Models\Employee_edit_history;


use App\Models\Leave;
use App\Models\Leave_edit_history;
use App\Models\Leave_history;

use App\Models\Attendence;
use App\Models\Attendence_edit_history;
use App\Models\Attendence_history;

use App\Models\Absent;
use App\Models\Absent_edit_history;
use App\Models\Absent_history;
use Carbon\Carbon;

use App\Models\Complaints;
use App\Models\Complaints_edit_history;
use App\Models\Complaints_history;


use App\Models\Booking;
use App\Models\Booking_history;

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

// use App\Models\Employee;



use App\Models\vehicle_equipment_list;
use App\Models\vehicle_equipment_list_history;


use App\Models\Permissions;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Redirect;
use App\Models\Customer_rate_card;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use function PHPUnit\Framework\isEmpty;

class OperationsController extends Controller
{
    public function __construct() {
        $this->middleware('auth:user');
    }
    /////////////////////////////////////
    ///////// History Record ///////////
    /////////////////////////////////////

    public function history_table($table_name , $action , $user_id, $data_id, $route_name){
        DB::table($table_name)->insert([
            'action' => $action,
            'date' => date("Y-m-d  H:i:s"),
            'user_id' => $user_id,
            'route_name' => $route_name,
            'data_id' => $data_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return true;
    }

    public function history_table_type($table_name , $action , $user_id , $type , $data_id, $route_name){
        DB::table($table_name)->insert([
            'action' => $action,
            'date' => date("Y-m-d  H:i:s"),
            'user_id' => $user_id,
            'type' => $type,
            'route_name' => $route_name,
            'data_id' => $data_id,
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
    public function operations(){
        $user = Auth::user();
        $data['modules']= DB::table('modules')->get();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['page_title'] = "Operations";
        $data['view'] = 'operations.operations';
        return view('users.layout', ["data"=>$data]);
    }

    public function employee_attendence(){
        // $data['employee_deduction'] = employee_deduction::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();
        $data['employee'] = Employee::all();
        $data['attendance'] = Attendence::where('categorie' , '=' ,'driver')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $mark_dates = [];
        foreach( $data['attendance'] as $attendance){
            if(count($mark_dates) == 0){
                array_push($mark_dates , $attendance->date);
            }
            foreach($mark_dates as $dates){
              

                if($dates != $attendance->date){
                        array_push($mark_dates , $attendance->date);
                }
            }
            
        }

        // $data['mark_dates'] = array_unique($mark_dates);
        $data['mark_dates'] = $mark_dates;

        // dd($data['mark_dates']);
        $data['page_title'] = "Mark Employee Attendance";
        $data['view'] = 'operations.attendance.attendance';
        return view('users.layout', ["data"=>$data]);
    }

     ///////////////////////////////////////
    ///////// Employee Leave /////////
    ///////////////////////////////////////

    public function employee_leave(){
        // $data['employee_deduction'] = employee_deduction::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();
        $data['employees'] = Employee::all();
        $data['leave'] = Leave::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        //dd($data['modules']);
        
        $data['page_title'] = "Leave Request";
        $data['view'] = 'operations.attendance.leave.leave';
        return view('users.layout', ["data"=>$data]);
    }

    public function trash_employee_leave(){
        $data['modules']= DB::table('modules')->get();
        $data['leave'] = leave::all();
        $data['employees'] = Employee::all();
        // $data['leave'] = Leave::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "Employee Leave Trash";
        $data['view'] = 'operations.attendance.leave.deleted_data';
        return view('users.layout', ["data"=>$data]);
    }

    public function employee_leave_history(){

        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['employees'] = Employee::all();


        $data['trade_licenses_history']= Leave_history::all();
        $data['table_name']= 'leave_histories';

        $data['page_title'] = "History | Employee Leave Request ";
        $data['view'] = 'hr_pro.history';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_employee_leave(){
        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['employee'] = Employee::all();
        
        $data['page_title'] = "Add  Employee Leave";
        $data['view'] = 'operations.attendance.leave.add_leave';
        return view('users.layout', ["data"=>$data]);
    }

    public function view_employee_leave(Request $request){
        $data['leave'] = leave::find($request->input('id'));
        $data['employees'] = Employee::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['modules']= DB::table('modules')->get();

        
        $user = Auth::user();
        
        $data['page_title'] = "  Employee Leave Request";
        $data['view'] = 'operations.attendance.leave.view_leave';
        return view('users.layout', ["data"=>$data]);
    }

    public function edit_employee_leave (Request $request){
        $data['leave'] = Leave::find($request->input('id'));
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['modules']= DB::table('modules')->get();
        $data['employee'] = Employee::all();

        //dd($data['modules']);
        

        $data['page_title'] = "Edit Employee Leave";
        $data['view'] = 'operations.attendance.leave.edit_leave';
        return view('users.layout', ["data"=>$data]);
    }

    public function save_employee_leave(Request $request){

        $leave = new leave;
        

        if($request->input('emp_id') != ''){
            $leave->emp_id = $request->input('emp_id');

        }
        if($request->input('from') != ''){
            $leave->from = $request->input('from');

        }
        if($request->input('to') != ''){
            $leave->to = $request->input('to');

        }
        
        if($request->input('reason') != ''){
            $leave->reason = $request->input('reason');

        }
        

        if ($request->hasFile('upload')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $leave->upload	 = $name;

            }
           

        }
        $leave->status = 'pending';
 
        $leave->user_id = Auth::id();
       


        if($leave->save()){
            
            return \Redirect::route('user.operations.employee_leave')->with('success', 'Data Added Sucessfully');
        }
        


    }

    public function update_employee_leave(Request $request){
        $id =  (int)$request->input('id');
        $leave = leave::where('id' , $id)->first();

        if($request->input('emp_id') != ''){
            $leave->emp_id = $request->input('emp_id');

        }
        if($request->input('amount') != ''){
            $leave->amount = $request->input('amount');

        }
        if($request->input('reason') != ''){
            $leave->reason = $request->input('reason');

        }
        if($request->input('applicable_month') != ''){
            $leave->applicable_month = $request->input('applicable_month');
        }

        if ($request->hasFile('upload')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $leave->upload	 = $name;

            }
           

        }




        
        $leave->status = 'pending';

        $leave->user_id = Auth::id();
        $leave->action = 'edit';
        $leave->save();

        
        if($leave->status == 'approved'  ){
            
            //  $this->history_table('trade_license_histories', $trade_license->action , $user_id);
            
        }


        return \Redirect::route('user.operations.employee_leave')->with('success', 'Data Updated Sucessfully');

    }

   
    public function delete_employee_leave_status(Request $request){
        $id =  (int)$request->input('id');
        $leave = leave::where('id' , $id)->first();

        

        $leave->status_message = $request->input('status_message');
        if( $leave->user_id != 0){
            $user_id  = $leave->user_id;
            
        }else{
            $user_id  = 0;
        }

        $leave->row_status = 'active';

       

  
            $leave->action = 'delete';
        

        
        $leave->status = 'pending';

        $leave->user_id = Auth::id();
        $leave->action = 'delete';
 
        if( $leave->save()){

            // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
           

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    

    public function employee_attendence_mark($date=null){
            // echo $date;
            $timestamp =  strtotime($date);
            // echo $date;
            $date = date('Y-m-d', $timestamp);
            // echo $date;
            
            $leave = leave::all();
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
            $data['employee'] = Employee::where('designation', '=',"driver")->get();
            // dd($data['employee']);
            $data['date'] = $date;

        
            $data['page_title'] = "Attendance";
            $data['view'] = 'operations.attendance.mark_attendance';
            return view('users.layout', ["data"=>$data]);
    }

    public function save_employee_attendance(Request $request){
        $str = $request->input('date');
        // dd($str);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        if (($timestamp = strtotime($str)) !== false)
        {
            $php_date = getdate($timestamp);
            // or if you want to output a date in year/month/day format:
            $date = date("Y/m/d", $timestamp); // see the date manual page for format options      
        }
        foreach($request->input('attendance') as $key => $value){
            $attendance = new Attendence;
            $attendance->emp_id = str_replace('"', "", $key) ;
            $attendance->attendence_status = $value;
            $attendance->date = $date;
            $attendance->month =  date("m", $timestamp);
            $attendance->year =  date("Y", $timestamp);
            $attendance->marked_by = 'Admin';
            $attendance->categorie = 'driver';
            $attendance->row_status = 'active';
            $attendance->user_id = 0;

            if($value == 'a'){
                $attendance->status = 'pending'; 
                $absent  = new Absent;
                $absent->emp_id =  str_replace("'", "", $key) ;
                $absent->date =   $date;
                $absent->status =  'new';
                $absent->categorie = 'driver';

                $absent->row_status = 'active';
                $absent->save();
                $this->history_table('absent_histories', 'add' , 0 , $absent->id , 'hr_pro.employee_attendence');

            }else{
                $attendance->status = 'approved'; 

            }
            $attendance->save();
            $this->history_table('attendence_histories', 'add' , 0 , $attendance->id , 'hr_pro.employee_attendence');

        }

        return \Redirect::route('user.operations.employee_attendence')->with('success', 'Data Added Sucessfully');

    }

    public function employee_attendence_report(){
        if(!empty($_GET['month'])){
            $dateValue = strtotime($_GET['month']);                     

            $yr = date("Y", $dateValue) ." "; 
            $mon = date("m", $dateValue)." "; 
            $date = date("Y-m-d", $dateValue);

            $start_date = Carbon::parse($date)->toDateTimeString();
            $end_date = Carbon::parse($date)->lastOfMonth()->toDateTimeString();
            $data['attendance'] = Attendence::whereBetween('date',[$start_date,$end_date])->get(); 
            
        }else{
            $date = date("Y-m-d");
            $start_date = Carbon::parse($date)->startOfMonth()->toDateTimeString();
            $end_date = Carbon::parse($date)->lastOfMonth()->toDateTimeString();
            // dd($end_date );
            $data['attendance'] = Attendence::whereBetween('date',[$start_date,$end_date])->get(); 
            // dd( $data['attendace']);
        }


         leave::all();
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['employee'] = Employee::where('designation' , '=' , 'driver')->get();
       
        $data['page_title'] = "Attendance Report";
        $data['view'] = 'operations.attendance.attendance_report';
        return view('users.layout', ["data"=>$data]);
    }

    ///////////////////////////////////////
    ///////// Employee Complaints /////////
    ///////////////////////////////////////
    public function complaints(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['complaints'] = Complaints::all();
        $data['employees'] = Employee::all();
        $data['page_title'] = "Complaints";
        $data['view'] = 'operations.complaints.complaints';
        return view('users.layout', ["data"=>$data]);
    }

    public function trash_complaints(){
        $data['modules']= DB::table('modules')->get();
        $data['complaints'] = Complaints::all();
        $data['employees'] = Employee::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "Complaints Trash";
        $data['view'] = 'operations.complaints.deleted_data';
        return view('users.layout', ["data"=>$data]);
    }

    public function complaints_history(){

        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['employees'] = Employee::all();

        $data['trade_licenses_history']= Complaints_history::all();
        $data['table_name']= 'complaints_histories';

        $data['page_title'] = "History | Complaints ";
        $data['view'] = 'hr_pro.history';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_complaints(){
        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['employee'] = Employee::all();
        $data['page_title'] = "New Complaints";
        $data['view'] = 'operations.complaints.add_complaints';
        return view('users.layout', ["data"=>$data]);
    }

    public function view_complaints(Request $request){
        $data['complaint'] = Complaints::find($request->input('id'));
        $data['employees'] = Employee::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        
        $data['page_title'] = "View  Complaint";
        $data['view'] = 'operations.complaints.view_complaints';
        return view('users.layout', ["data"=>$data]);
    }

    public function edit_complaints (Request $request){
        $data['complaint'] = Complaints::find($request->input('id'));
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['modules']= DB::table('modules')->get();
        $data['employee'] = Employee::all();

        //dd($data['modules']);
        

        $data['page_title'] = "Edit Complaint";
        $data['view'] = 'operations.complaints.edit_complaints';
        return view('users.layout', ["data"=>$data]);
    }

    public function save_complaints(Request $request){

        $Complaints = new Complaints;
        

        if($request->input('emp_id') != ''){
            $Complaints->emp_id = $request->input('emp_id');

        }
        
        if($request->input('complaint') != ''){
            $Complaints->complaint = $request->input('complaint');

        }
        

        if ($request->hasFile('upload')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $Complaints->upload	 = $name;

            }
           

        }
        $Complaints->status = 'pending';
 
        $Complaints->user_id = Auth::id();
        
        $Complaints->action="Add";
       


        if($Complaints->save()){
            $this->history_table('complaints_histories', 'Add' , Auth::id() , $Complaints->id , 'hr_pro.view_complaints');
            return \Redirect::route('user.operations.complaints')->with('success', 'Data Added Sucessfully');
        }
        


    }

    public function update_complaints(Request $request){
        $id =  (int)$request->input('id');
        $Complaints = Complaints::where('id' , $id)->first();

        if($request->input('emp_id') != ''){
            $Complaints->emp_id = $request->input('emp_id');

        }
        if($request->input('complaint') != ''){
            $Complaints->complaint = $request->input('complaint');

        }
        if($request->input('admin_remarks') != ''){
            $Complaints->admin_remarks = $request->input('admin_remarks');

        }
        if($request->input('hr_remarks') != ''){
            $Complaints->hr_remarks = $request->input('hr_remarks');

        }
       
        if ($request->hasFile('upload')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $Complaints->upload	 = $name;

            }
           

        }




        $Complaints->status = 'pending';
 
        $Complaints->user_id = Auth::id();
        
        $Complaints->action="Edit";


        $Complaints->save();

        

        return \Redirect::route('user.operations.complaints')->with('success', 'Data Updated Sucessfully');

    }

   
    public function delete_complaints_status(Request $request){
        $id =  (int)$request->input('id');
        $employee_termination = Complaints::where('id' , $id)->first();

        
        $employee_termination->status = 'pending';
 
        $employee_termination->user_id = Auth::id();
        
        $employee_termination->action="Delete";

        if( $employee_termination->save()){

           
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }


    //Absent

       ///////////////////////////////////////
    ///////// Absent /////////
    ///////////////////////////////////////
    public function absent(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['absent'] = Absent::where('categorie' , '=' ,'driver')->get();
        $data['employees'] = Employee::all();
        $data['page_title'] = "Absent Employees";
        $data['view'] = 'operations.absent.absent';
        return view('users.layout', ["data"=>$data]);
    }

    public function trash_absent(){
        $data['modules']= DB::table('modules')->get();
        $data['absent'] = absent::all();
        $data['employees'] = Employee::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "Absent Trash";
        $data['view'] = 'operations.absent.deleted_data';
        return view('users.layout', ["data"=>$data]);
    }

    public function absent_history(){

        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['employees'] = Employee::all();

        $data['trade_licenses_history']= absent_history::all();
        $data['table_name']= 'abbsent_histories';

        $data['page_title'] = "History | Absent ";
        $data['view'] = 'hr_pro.history';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_absent(){
        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['absent'] = absent::all();
        $data['page_title'] = "New Absent";
        $data['view'] = 'operations.absent.add_absent';
        return view('users.layout', ["data"=>$data]);
    }

    public function view_absent(Request $request){
        $data['complaint'] = absent::find($request->input('id'));
        $data['employees'] = Employee::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        
        $data['page_title'] = "View  absent";
        $data['view'] = 'operations.absent.view_absent';
        return view('users.layout', ["data"=>$data]);
    }

    public function edit_absent (Request $request){
        $data['absent'] = absent::find($request->input('id'));
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['modules']= DB::table('modules')->get();
        $data['employee'] = Employee::all();

        //dd($data['modules']);
        

        $data['page_title'] = "Edit Absent";
        $data['view'] = 'operations.absent.edit_absent';
        return view('users.layout', ["data"=>$data]);
    }

    public function save_absent(Request $request){

        $absent = new absent;
        

        if($request->input('emp_id') != ''){
            $absent->emp_id = $request->input('emp_id');

        }
        
        if($request->input('reason') != ''){
            $absent->reason = $request->input('reason');

        }
        

        if ($request->hasFile('upload')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $absent->upload	 = $name;

            }
           

        }
        $absent->date =   date('y-m-d');
        $absent->status = 'pending';
 
        $absent->user_id = Auth::id();
        
        $absent->action="Add";
       


        if($absent->save()){
            $this->history_table('absent_histories', 'Add' , $absent->user_id , $absent->id , 'hr_pro.view_absent');
            return \Redirect::route('user.operations.absent')->with('success', 'Data Added Sucessfully');
        }
        


    }

    public function update_absent(Request $request){
        $id =  (int)$request->input('id');
        $absent = Absent::where('id' , $id)->first();

        // if($request->input('emp_id') != ''){
        //     $absent->emp_id = $request->input('emp_id');

        // }
        if($request->input('reason') != ''){
            $absent->reason = $request->input('reason');

        }
        // if($request->input('admin_remarks') != ''){
        //     $absent->admin_remarks = $request->input('admin_remarks');

        // }
        // if($request->input('hr_remarks') != ''){
        //     $absent->hr_remarks = $request->input('hr_remarks');

        // }
       
        if ($request->hasFile('upload')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $absent->upload	 = $name;

            }
           

        }




        $absent->status = 'pending';
 
        $absent->user_id = Auth::id();
        
        $absent->action="Edit";

        // dd( $absent->status);
        $absent->save();

        

        return \Redirect::route('user.operations.absent')->with('success', 'Data Updated Sucessfully');

    }

   
    public function delete_absent_status(Request $request){
        $id =  (int)$request->input('id');
        $absent = absent::where('id' , $id)->first();

        
        $absent->status = 'pending';
 
        $absent->user_id = Auth::id();
        
        $absent->action="Delete";

        if( $absent->save()){

           
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    //booking
    public function new_booking(){
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 37)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['modules']= DB::table('modules')->get();
        $data['customer'] = Customer_info::where('type' , '=' ,'permanent')->where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();
        $data['customer_rate_card'] = Customer_rate_card::where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();

        $data['page_title'] = "New Booking";
        $data['view'] = 'operations.booking.new_booking.new_booking';
        return view('users.layout', ["data"=>$data]);
    }

    public function new_normal_booking(Request $request){
        $user = Auth::user();
        $customer_id = (int)$request->input('customer_id');
        $customer_rate_card_id = (int)$request->input('customer_rate_card_id');

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 37)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['modules']= DB::table('modules')->get();

        $data['customer'] = Customer_info::where('id' , '=' ,$customer_id)->where('type' , '=' ,'permanent')->where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->first();
        $data['customer_rate_card'] = Customer_rate_card::where('id' , '=' ,$customer_rate_card_id)->where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->first();
        $data['sub_contractor'] = Sub_contractor_info::where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();
        //dd($data['modules']);
        $data['vehicle'] = Vehicle::where('registration_type' ,'=' , 'vehicle')->where('trailer_id' ,'!=' , '')->where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->where('booking_status' ,'=' , 'not_booked')->get();
        // dd($data['custome/r']);
        $data['sub_contractor_vehicle'] = Vehicle::where('registration_type' ,'=' , 'vehicle')->where('sub_contractor_id' ,'!=' , '')->where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();
        $data['trailer'] = Vehicle::where('registration_type' ,'=' , 'trailer')->where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();
        
            // $data['page']
        $data['page_title'] = "New Booking";
        $data['view'] = 'operations.booking.new_booking.new_normal_booking';
        return view('users.layout', ["data"=>$data]);

    }

    public function GetSerialCode() {
        $strings = '1234567890';
        $stringLength = strlen($strings);
        $newStrings = '';
        for ($i = 0; $i < 8; $i++) {
            $newStrings .= $strings[rand(0, $stringLength - 1)];
        }
        return $newStrings;
    }

    public function save_new_booking(Request $request){
        $booking = new Booking();
        $vehicle = Vehicle::find((int)$request->input('vehicle_id'));
        if($request->input('own_hired_vehicle') != ''){
            $booking->own_hired_vehicle = $request->input('own_hired_vehicle');

        }

        if($request->input('sub_contractor_id') != ''){
            $booking->sub_contractor_id = $request->input('sub_contractor_id');

        }

        if($request->input('company_id') != ''){
            $booking->company_id = $request->input('company_id');

        }

        if($request->input('customer_name') != ''){
            $booking->customer_name = $request->input('customer_name');

        }

        if($request->input('customer_id') != ''){
            $booking->customer_id = $request->input('customer_id');

        }
        
        if($request->input('rate_card_id') != ''){
            $booking->rate_card_id = $request->input('rate_card_id');

        }

        if($request->input('trn') != ''){
            $booking->trn = $request->input('trn');

        }

        if($request->input('booking_date') != ''){
            $booking->booking_date = $request->input('booking_date');

        }

        if($request->input('booking_date') != ''){
            $booking->booking_date = $request->input('booking_date');

        }

        if($request->input('vehicle_id') != ''){
            $booking->vehicle_id = $request->input('vehicle_id');

        }

        if($request->input('driver_id') != ''){
            $booking->driver_id = $request->input('driver_id');

        }

        if($request->input('driver_name') != ''){
            $booking->driver_name = $request->input('driver_name');

        }

        if($request->input('mobile_number') != ''){
            $booking->mobile_number = $request->input('mobile_number');

        }

        if($request->input('trailer_chassis_number') != ''){
            $booking->trailer_chassis_number = $request->input('trailer_chassis_number');

        }

        if($request->input('trailer_id') != ''){
            $booking->trailer_id = $request->input('trailer_id');

        }

        if($request->input('from_location') != ''){
            $booking->from_location = $request->input('from_location');

        }

        if($request->input('to_location') != ''){
            $booking->to_location = $request->input('to_location');

        }

        if($request->input('ap_km') != ''){
            $booking->ap_km = $request->input('ap_km');

        }

        if($request->input('ap_fuel') != ''){
            $booking->ap_fuel = $request->input('ap_fuel');

        }

        if($request->input('driver_comission') != ''){
            $booking->driver_comission = $request->input('driver_comission');

        }

        if($request->input('loading_date') != ''){
            $booking->loading_date = $request->input('loading_date');

        }

        if($request->input('offloading_date') != ''){
            $booking->offloading_date = $request->input('offloading_date');

        }

        $dateString = date('Ymd'); //Generate a datestring.
        $all_booking = booking::all();
        $receiptNumber = 1;  //You will query the last receipt in your database 
        //and get the last $receiptNumber for that branch and add 1 to it.;

        if($receiptNumber < 9999) {

            $receiptNumber = $receiptNumber + 1;

        }else{
            $receiptNumber = 1;
        }

        $booking->job_id = $dateString . '-' . $receiptNumber; 

        $booking->sr_no = $this->GetSerialCode(); 


        $booking->booking_status = 'open';
        // $booking->status_update = 'Vehicle in transit for loading'; 

        
        if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }

        $booking->user_id = $user_id;
        $booking->status = 'approved';

        $vehicle->booking_status = 'booked';


        $booking->action="Add";
       
        if($booking->save() && $vehicle->save()){
            $this->history_table('booking_histories', 'Add' , $booking->user_id , $booking->id , 'operations.view_booking');
            $this->history_table('vehicle_histories', 'Vehicle number ('. $vehicle->vehicle_numer .') Booked' , $user_id , $booking->id , 'operations.view_booking');
            
            return \Redirect::route('user.operations.manage_booking')->with('success', 'Data Added Sucessfully');
        }
        
    }

    public function update_new_booking(Request $request){
        $booking = Booking::find((int)$request->input('id'));
        $vehicle = Vehicle::find((int)$request->input('vehicle_id'));
        if($request->input('own_hired_vehicle') != ''){
            $booking->own_hired_vehicle = $request->input('own_hired_vehicle');

        }

        if($request->input('sub_contractor_id') != ''){
            $booking->sub_contractor_id = $request->input('sub_contractor_id');

        }

        if($request->input('company_id') != ''){
            $booking->company_id = $request->input('company_id');

        }

        if($request->input('customer_name') != ''){
            $booking->customer_name = $request->input('customer_name');

        }

        if($request->input('customer_id') != ''){
            $booking->customer_id = $request->input('customer_id');

        }

        if($request->input('trn') != ''){
            $booking->trn = $request->input('trn');

        }

        if($request->input('booking_date') != ''){
            $booking->booking_date = $request->input('booking_date');

        }

        if($request->input('booking_date') != ''){
            $booking->booking_date = $request->input('booking_date');

        }

        if($request->input('vehicle_id') != ''){
            $booking->vehicle_id = $request->input('vehicle_id');

        }

        if($request->input('driver_id') != ''){
            $booking->driver_id = $request->input('driver_id');

        }

        if($request->input('driver_name') != ''){
            $booking->driver_name = $request->input('driver_name');

        }

        if($request->input('mobile_number') != ''){
            $booking->mobile_number = $request->input('mobile_number');

        }

        if($request->input('trailer_chassis_number') != ''){
            $booking->trailer_chassis_number = $request->input('trailer_chassis_number');

        }

        if($request->input('trailer_id') != ''){
            $booking->trailer_id = $request->input('trailer_id');

        }

        if($request->input('from_location') != ''){
            $booking->from_location = $request->input('from_location');

        }

        if($request->input('to_location') != ''){
            $booking->to_location = $request->input('to_location');

        }

        if($request->input('ap_km') != ''){
            $booking->ap_km = $request->input('ap_km');

        }

        if($request->input('ap_fuel') != ''){
            $booking->ap_fuel = $request->input('ap_fuel');

        }

        if($request->input('driver_comission') != ''){
            $booking->driver_comission = $request->input('driver_comission');

        }

        if($request->input('loading_date') != ''){
            $booking->loading_date = $request->input('loading_date');

        }

        if($request->input('offloading_date') != ''){
            $booking->offloading_date = $request->input('offloading_date');

        }

        


        // $booking->booking_status = 'open';
        // $booking->status_update = 'Vehicle in transit for loading'; 

        if($request->input('status') != ''){
            $booking->status = $request->input('status');

        }

        if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }

        $booking->user_id = $user_id;
        $booking->status = 'approved';



        $booking->action="Update";
       
        if($booking->save()){
            $this->history_table('booking_histories', 'Update' , $booking->user_id , $booking->id , 'operations.view_booking');
            
            return \Redirect::route('user.operations')->with('success', 'Data Added Sucessfully');
        }
        
    }

    public function manage_booking(){
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 37)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['modules']= DB::table('modules')->get();
        $data['booking'] = booking::where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();
        // $data['customer_rate_card'] = Customer_rate_card::where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();
        $data['vehicle'] = vehicle::all();

        $data['page_title'] = "Manage Booking";
        $data['view'] = 'operations.booking.manage_booking.manage_booking';
        return view('users.layout', ["data"=>$data]);
    }

    public function booking_status_update(Request $request){
        $booking = booking::find((int)$request->input('booking_status_id'));
        $vehicle = Vehicle::find((int)$booking->vehicle_id);

        $offload= false;
        if($request->input('status_update') == 'Vehicle in transit for loading'){
            $booking->status_update = $request->input('status_update');
            $booking->vehicle_transit_loading_date = date('m/d/Y h:i:s a', time());


        }else if($request->input('status_update') == 'Vehicle loaded'){
            $booking->status_update = $request->input('status_update');
            $booking->vehicle_loaded_date = date('m/d/Y h:i:s a', time());

            
        }else if($request->input('status_update') == 'Vehicle in transit to make delievery'){
            $booking->status_update = $request->input('status_update');
            $booking->vehicle_transit_make_delivery_date = date('m/d/Y h:i:s a', time());
            
        }else if($request->input('status_update') == 'Cargo off loaded'){
            $booking->status_update = $request->input('status_update');
            $booking->cargo_off_loaded_date = date('m/d/Y h:i:s a', time());
            $offload = true;
            
        }else if($request->input('status_update') == 'Vehicle break down'){
            $booking->status_update = $request->input('status_update');
            $booking->vehicle_break_down_date = date('m/d/Y h:i:s a', time());

            $booking->vehicle_break_status = $request->input('vehicle_break_status');
            $booking->vehicle_break_repaier_person_name = $request->input('vehicle_break_repaier_person_name');

        }else if($request->input('status_update') == 'Vehicle repaired'){
            $booking->status_update = $request->input('status_update');
            $booking->vehicle_repaired_date = date('m/d/Y h:i:s a', time());
            
        }
        
        if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }

        if($offload){
            // dd('echo');
            $booking->booking_status = 'closed';
            $booking->status = 'pending';
            $vehicle->booking_status = 'not_booked';
            $vehicle->save();

            $this->history_table('booking_histories', 'Booking Closed' , $user_id , $booking->id , 'operations.view_booking');

        }

        
        if($booking->save()){
            $this->history_table('booking_histories', 'Booking status Updated' , $user_id , $booking->id , 'operations.view_booking');
            $booking->user_id = $user_id;
            return \Redirect::route('user.operations.manage_booking')->with('success', 'Status Updated Sucessfully');
        }


    }

    public function view_booking(Request $request){
        $user = Auth::user();
       
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 37)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['modules']= DB::table('modules')->get();

        $data['booking'] = booking::find((int)$request->input('id'));
        $data['vehicle'] = vehicle::all();
        $data['sub_contractor'] = sub_contractor_info::all();
        $data['company_names'] = company_name::all();

        $data['page_title'] = "View Booking";
        $data['view'] = 'operations.booking.view_booking';
        return view('users.layout', ["data"=>$data]);

    }

    public function booking_history(){

        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 37)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['employees'] = Employee::all();


        $data['trade_licenses_history']= Booking_history::all();
        $data['table_name']= 'booking_histories';

        $data['page_title'] = "History | Booking ";
        $data['view'] = 'hr_pro.history';
        return view('users.layout', ["data"=>$data]);
    }

    public function pending_booking(){
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 37)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['modules']= DB::table('modules')->get();
        $data['booking'] = booking::where('row_status' ,'=' , 'active')->where('status' ,'=' , 'pending')->get();
        // $data['customer_rate_card'] = Customer_rate_card::where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();
        $data['vehicle'] = vehicle::all();

        $data['page_title'] = "Pending Booking";
        $data['view'] = 'operations.booking.manage_booking.pending_booking';
        return view('users.layout', ["data"=>$data]);
    }

    public function rejected_booking(){
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 37)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['modules']= DB::table('modules')->get();
        $data['booking'] = booking::where('row_status' ,'=' , 'active')->where('status' ,'=' , 'rejected')->get();
        // $data['customer_rate_card'] = Customer_rate_card::where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();
        $data['vehicle'] = Vehicle::all();

        $data['page_title'] = "Rejected Booking";
        $data['view'] = 'operations.booking.manage_booking.rejected_booking';
        return view('users.layout', ["data"=>$data]);
    }

    public function save_booking_document(Request $request){
        $booking = booking::find((int)$request->input('booking_status_id'));
        $vehicle = Vehicle::find((int)$booking->vehicle_id);

        if($request->input('shipment_number') != ''){
            $booking->shipment_number = $request->input('shipment_number');

        }

        
        if($request->input('contract_number') != ''){
            $booking->contract_number = $request->input('contract_number');

        }
        if($request->input('toll_charges') != ''){
            $booking->toll_charges = $request->input('toll_charges');
        }
        if($request->input('gate_charges') != ''){
            $booking->gate_charges = $request->input('gate_charges');
        }

        if($request->input('labour_charges') != ''){
            $booking->labour_charges = $request->input('labour_charges');
        }

        if($request->input('border_charges') != ''){
            $booking->border_charges = $request->input('border_charges');
        }

        if($request->input('other_charges') != ''){
            $booking->other_charges = $request->input('other_charges');
        }
        if($request->input('other_charges_description') != ''){
            $booking->other_charges_description = $request->input('other_charges_description');
        }

        if ($request->hasFile('pod')) {

            $name = time().'_'.str_replace(" ", "_", $request->pod->getClientOriginalName());
            $file = $request->file('pod');
            if($file->storeAs('/main_admin/booking', $name , ['disk' => 'public_uploads'])){
                $booking->pod = $name;

            }
        }

        if ($request->hasFile('document')) {

            $name = time().'_'.str_replace(" ", "_", $request->document->getClientOriginalName());
            $file = $request->file('document');
            if($file->storeAs('/main_admin/booking', $name , ['disk' => 'public_uploads'])){
                $booking->document = $name;

            }
        }

        if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }

        $booking->pending_by = 'account';
        $booking->status = 'pending';


        if($booking->save()){

            $this->history_table('booking_histories', 'Booking document uploaded send for account approval ' , $user_id , $booking->id , 'operations.view_booking');
            $booking->user_id = $user_id;

            return \Redirect::route('user.operations.pending_booking')->with('success', 'Booking Updated Sucessfully');
        }
    }

    public function processed_booking(){
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 37)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['modules']= DB::table('modules')->get();
        $data['booking'] = booking::where('row_status' ,'=' , 'active')->get();
        // $data['customer_rate_card'] = Customer_rate_card::where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();
        $data['vehicle'] = vehicle::all();

        $data['page_title'] = "Processed Booking";
        $data['view'] = 'operations.booking.processed_booking.processed_booking';
        return view('users.layout', ["data"=>$data]);
    }

    public function get_booking(){
        $id = $_GET['id'];
        $booking = Booking::find((int)$id);
        return response()->json($booking);
    }

    public function trash_booking(){
        $data['modules']= DB::table('modules')->get();
        $data['complaints'] = Complaints::all();
        $data['booking'] = booking::all();
        $data['vehicle'] = vehicle::all();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 37)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "Booking Trash";
        $data['view'] = 'operations.booking.deleted_data';
        return view('users.layout', ["data"=>$data]);
    }

    public function delete_booking_status(Request $request){
        $id =  (int)$request->input('id');
        $booking = booking::where('id' , $id)->first();
        $vehicle = Vehicle::find((int)$booking->vehicle_id);

        
        // $employee_termination->status = 'pending';
 
        $booking->booking_status = 'closed';
        // $booking->status_update = 'Vehicle in transit for loading'; 

        
        if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }

        $booking->user_id = $user_id;
        // $booking->status = 'approved';

        $vehicle->booking_status = 'not_booked';


        $booking->action="Delete";
        $booking->row_status="deleted";


           

        if( $booking->save() && $vehicle->save()){

            $this->history_table('booking_histories', 'Delete' , $booking->user_id , $booking->id , 'operations.view_booking');
            $this->history_table('vehicle_histories', 'Vehicle number ('. $vehicle->vehicle_numer .') UnBooked' , $user_id , $booking->id , 'operations.view_booking');
    
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    //assign unassign vehicle
    public function vehicle_fleet(){
        $data['modules']= DB::table('modules')->get();

      
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 37)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        
        $data['vehicle_info'] = Vehicle::where('registration_type', '=', 'vehicle')->get();
        $data['trailer'] = Vehicle::where('registration_type', '=', 'trailer')->get();

        // dd( $data['vehicle_info']); 
        $data['page_title'] = "Vehicle Fleet";
        $data['view'] = 'operations.vehicle.fleet_vehicle';
        return view('users.layout', ["data"=>$data]);
    }

    public function trailer_fleet(){
        $data['modules']= DB::table('modules')->get();

      
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 37)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        
        $data['vehicle_info'] = Vehicle::where('registration_type', '=', 'trailer')->get();
        $data['trailer'] = Vehicle::where('registration_type', '=', 'vehicle')->get();

        // dd( $data['vehicle_info']); 
        $data['page_title'] = "Trailer Fleet";
        $data['view'] = 'operations.vehicle.fleet_trailer';
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
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 37)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['vehicle'] =  Vehicle::where('status' , '=' , 'approved')->get();

        
        $data['assign_vehicle'] = assign_unassign_vehicle::all();
        $data['driver'] = Employee::where('designation' , '=' , 'driver')->where('row_status' ,'!=' , 'deleted')->get();
        $data['page_title'] = "Assign/Unassign Vehicle";
        $data['view'] = 'operations.vehicle.assign_unassign.assign_unassign_vehicle';
        return view('users.layout', ["data"=>$data]);
    }

    public function assign_vehicle_save(Request $request){
        $assign_vehicle = new assign_unassign_vehicle();
        $equipment_list = new vehicle_equipment_list();

        $vehicle = Vehicle::find((int)$request->input('vehicle_id'));
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
        
            return \Redirect::route('user.operations.vehicle.assign_vehicle')->with('success', 'Vehicle Assigned Sucessfully');
    
        }
        
        
    }

    public function assign_trailer_save(Request $request){
        $assign_vehicle = assign_unassign_vehicle::find((int)$request->input('assign_id'));

        $vehicle = Vehicle::find((int)$request->input('vehicle_id'));
        $trailer = Vehicle::find((int)$request->input('trailer_id'));

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
        
            return \Redirect::route('user.operations.vehicle.assign_vehicle')->with('success', 'Vehicle Assigned Sucessfully');
    
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
        $data['vehicle'] = Vehicle::find((int)$data['assign_vehicle']->vehicle_id); 
        // dd($data['vehicle']->medical_kit);

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 37)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        // $data['vehicle'] =  Vehicle::all();
        
        return view('admin.operations.vehicle.assign_unassign.unassign_vehicle', ["data"=>$data]); 
    }

    public function unassign_vehicle_save(Request $request){
        $assign_vehicle = assign_unassign_vehicle::find((int)$request->input('assign_id'));
        $vehicle = Vehicle::find((int)$assign_vehicle->vehicle_id);
        $trailer = Vehicle::find((int)$assign_vehicle->trailer_id); 
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
        $data['vehicle'] = Vehicle::find((int)$data['assign_unassign_vehicle']->vehicle_id); 
        // dd($data['vehicle']->medical_kit);

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 37)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        // $data['vehicle'] =  Vehicle::all();
        $data['page_title'] = 'View Assign/Unassign Vehicle';
        $data['view'] = 'vehicle.assign_unassign.view_assign_unassign_vehicle';
        return view('users.layout', ["data"=>$data]);
        
    }

    public function view_vehicle(Request $request){
       
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 37)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();
        $data['vehicle'] = Vehicle::find((int)$request->input('id'));
        $data['page_title'] = "Vehicles";
        $data['view'] = 'operations.vehicle.view_vehicle';
        return view('users.layout', ["data"=>$data]);
    }

    public function delete_assign_unassign_vehicle(Request $request){
        $id =  (int)$request->input('id');
        $assign_unassign = assign_unassign_vehicle::where('id' , $id)->first();
        $vehicle = Vehicle::find((int)$assign_unassign->vehicle_id);
        $trailer = Vehicle::find((int)$assign_unassign->trailer_id); 
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


}