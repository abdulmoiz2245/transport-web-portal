<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\User;
use App\Models\Roles;
use App\Models\Company_name;
use App\Models\Modules;

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

use App\Models\Permissions;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Redirect;
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


}