<?php

namespace App\Http\Controllers\Admin;
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

use App\Models\Emmployee_termination;
use App\Models\Emmployee_termination_history;
use App\Models\Emmployee_termination_edit_history;

use App\Models\Employee_suspension;
use App\Models\Emmployee_suspension_history;
use App\Models\Emmployee_suspension_edit_history;

use App\Models\Emmployee_renewals;
use App\Models\Emmployee_renewals_history;
use App\Models\Emmployee_renewals_edit_history;

use App\Models\Employee_increments;
use App\Models\Employee_increments_history;
use App\Models\Employee_increments_edit_history;

use App\Models\Funds_request;
use App\Models\Funds_request_history;
use App\Models\Funds_request_edit_history;

use App\Models\Employee_deduction;
use App\Models\Employee_deduction_history;
use App\Models\Employee_deduction_edit_history;

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




use Illuminate\Support\Facades\File;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class EmployeeController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
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

    public function employee(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        
        $data['page_title'] = "Employee";
        $data['view'] = 'admin.hr_pro.employee.employee';
        return view('layout', ["data"=>$data]);
    }

    public function existing_employee_detail(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        
        $data['page_title'] = "Employee";
        $data['view'] = 'admin.hr_pro.employee.existing_employee_detail';
        return view('layout', ["data"=>$data]);
    }
    
    public function add_employee(){
        $data['modules']= DB::table('modules')->get();

        $data['page_title'] = "Add Employee";
        $data['view'] = 'admin.hr_pro.employee.add_employee';
        return view('layout', ["data"=>$data]);
    }

    public function save_employee(Request $request){
        $employee = new Employee;

        if($request->input('type') != ''){
            $employee->type = $request->input('type');
        }

        if($request->input('name') != ''){
            $employee->name = $request->input('name');
        }

        if($request->input('designation') != ''){
            $employee->designation = $request->input('designation');
        }

        if($request->input('designation_actual') != ''){
            $employee->designation_actual = $request->input('designation_actual');
        }

        if($request->input('basic_salary_actual') != ''){
            $employee->basic_salary_actual = $request->input('basic_salary_actual');
        }
        if($request->input('designation_per_labour_contract') != ''){
            $employee->designation_per_labour_contract = $request->input('designation_per_labour_contract');
        }
        if($request->input('basic_salary_per_labour_contract') != ''){
            $employee->basic_salary_per_labour_contract = $request->input('basic_salary_per_labour_contract');
        }   

        if($request->input('nationality') != ''){
            $employee->nationality = $request->input('nationality');
        }  

        if($request->input('national_id_number') != ''){
            $employee->national_id_number = $request->input('national_id_number');
        } 


        if($request->input('national_id_exp') != ''){
            $employee->national_id_exp = $request->input('national_id_exp');
        }

        if($request->input('national_id_exp') != ''){
            $employee->national_id_exp = $request->input('national_id_exp');
        }

        if ($request->hasFile('national_id_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->national_id_copy->getClientOriginalName());
            $file = $request->file('national_id_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->national_id_copy = $name;

            }
            
        }

        if($request->input('passport_number') != ''){
            $employee->passport_number = $request->input('passport_number');
        }

        if($request->input('passport_exp') != ''){
            $employee->passport_exp = $request->input('passport_exp');
        }

        if ($request->hasFile('passport_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->passport_copy->getClientOriginalName());
            $file = $request->file('passport_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->passport_copy = $name;

            }
            
        }

        if($request->input('visa_number') != ''){
            $employee->visa_number = $request->input('visa_number');
        }

        if($request->input('visa_exp') != ''){
            $employee->visa_exp = $request->input('visa_exp');
        }

        if($request->input('visa_uuid') != ''){
            $employee->visa_uuid = $request->input('visa_uuid');
        }

        if ($request->hasFile('visa_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->visa_copy->getClientOriginalName());
            $file = $request->file('visa_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->visa_copy = $name;

            }
            
        }


        if($request->input('work_permit_number') != ''){
            $employee->work_permit_number = $request->input('work_permit_number');
        }

        if($request->input('work_permit_exp') != ''){
            $employee->work_permit_exp = $request->input('work_permit_exp');
        }

        if ($request->hasFile('work_permit_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->work_permit_copy->getClientOriginalName());
            $file = $request->file('work_permit_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->work_permit_copy = $name;

            }
            
        }


        if($request->input('noc_number') != ''){
            $employee->noc_number = $request->input('noc_number');
        }

        if($request->input('noc_exp') != ''){
            $employee->noc_exp = $request->input('noc_exp');
        }

        if ($request->hasFile('noc_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->noc_copy->getClientOriginalName());
            $file = $request->file('noc_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->noc_copy = $name;

            }
            
        }

        if($request->input('labour_contract_number') != ''){
            $employee->labour_contract_number = $request->input('labour_contract_number');
        }

        if($request->input('labour_contract_exp') != ''){
            $employee->labour_contract_exp = $request->input('labour_contract_exp');
        }

        if ($request->hasFile('labour_contract_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->labour_contract_copy->getClientOriginalName());
            $file = $request->file('labour_contract_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->labour_contract_copy = $name;

            }
            
        }


        if($request->input('company_contract_number') != ''){
            $employee->company_contract_number = $request->input('company_contract_number');
        }

        if($request->input('company_contract_exp') != ''){
            $employee->company_contract_exp = $request->input('company_contract_exp');
        }

        if ($request->hasFile('company_contract_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->company_contract_copy->getClientOriginalName());
            $file = $request->file('company_contract_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->company_contract_copy = $name;

            }
            
        }

        if($request->input('emirates_id') != ''){
            $employee->emirates_id = $request->input('emirates_id');
        }

        if($request->input('emirates_exp') != ''){
            $employee->emirates_exp = $request->input('emirates_exp');
        }

        if ($request->hasFile('emirates_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->emirates_copy->getClientOriginalName());
            $file = $request->file('emirates_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->emirates_copy = $name;

            }
            
        }

        $employee->status = 'pending';
        $employee->admin_status = '1';

        $employee->user_id = 0;


        if($employee->save()){
             $this->history_table('employee_histories', 'Add', $employee->user_id,  $employee->id, "hr_pro.view_employee");
             return \Redirect::route('admin.hr_pro.employee')->with('success', 'Data Added Sucessfully');
        }else{
            return \Redirect::route('admin.hr_pro.employee')->with('error', 'Data not added sucessfully');
        }

    }

    public function pending_employee(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $data['employees'] = Employee::where('status' ,'=' ,'pending')->get();
        $data['page_title'] = "Pending Employee";
        $data['view'] = 'admin.hr_pro.employee.pending_employee';
        return view('layout', ["data"=>$data]);
    }

    public function edit_employee (Request $request){
        $data['employee'] = Employee::find($request->input('id'));
        

        $data['employee_history'] = Employee_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();
        if($data['employee_history'] != null &&  $data['employee']->name != $data['employee_history']->name ){
            // dd($data['employee_history']->name );

        }
        if( $data['employee_history'] == null){
            $data['employee_history'] = null;
        }
        
        
        $data['modules']= DB::table('modules')->get();

        $data['page_title'] = "Edit Employee";
        $data['view'] = 'admin.hr_pro.employee.edit_employee';
        return view('layout', ["data"=>$data]);
    }

    public function view_employee (Request $request){
        $data['employee'] = Employee::find($request->input('id'));
        

        $data['employee_history'] = Employee_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();
        if($data['employee_history'] != null &&  $data['employee']->name != $data['employee_history']->name ){
            // dd($data['employee_history']->name );

        }
        if( $data['employee_history'] == null){
            $data['employee_history'] = null;
        }
        
        
        $data['modules']= DB::table('modules')->get();

        $data['page_title'] = "View Employee";
        $data['view'] = 'admin.hr_pro.employee.view_employee';
        return view('layout', ["data"=>$data]);
    }

    public function update_employee(Request $request){
        $id =  (int)$request->input('id');
        $employee = Employee::where('id' , $id)->first();

         $employee_edit_info = new Employee_edit_history;
        //customer edit history track
        $employee_edit_info->row_id = (int)$request->input('id');
        $employee_edit_info->type =  $employee->type;

        $employee_edit_info->company_id =  $employee->company_id;
        $employee_edit_info->name =  $employee->name;
        $employee_edit_info->designation =  $employee->designation;
        $employee_edit_info->designation_actual =  $employee->designation_actual;
        $employee_edit_info->basic_salary_actual =  $employee->basic_salary_actual;
        $employee_edit_info->designation_per_labour_contract =  $employee->designation_per_labour_contract;
        $employee_edit_info->basic_salary_per_labour_contract =  $employee->basic_salary_per_labour_contract;
        $employee_edit_info->nationality =  $employee->nationality;
        $employee_edit_info->national_id_number =  $employee->national_id_number;
        $employee_edit_info->national_id_exp =  $employee->national_id_exp;
        $employee_edit_info->national_id_copy =  $employee->national_id_copy;
        $employee_edit_info->passport_number =  $employee->passport_number;
        $employee_edit_info->passport_exp =  $employee->passport_exp;
        $employee_edit_info->passport_copy =  $employee->passport_copy;
        $employee_edit_info->visa_number =  $employee->visa_number;
        $employee_edit_info->visa_exp =  $employee->visa_exp;
        $employee_edit_info->visa_uuid =  $employee->visa_uuid;
        $employee_edit_info->visa_copy =  $employee->visa_copy;
        $employee_edit_info->work_permit_number =  $employee->work_permit_number;
        $employee_edit_info->work_permit_exp =  $employee->work_permit_exp;
        $employee_edit_info->work_permit_copy =  $employee->work_permit_copy;
        $employee_edit_info->noc_number =  $employee->noc_number;
        $employee_edit_info->noc_exp =  $employee->noc_exp;
        $employee_edit_info->noc_copy =  $employee->noc_copy;
        $employee_edit_info->labour_contract_number =  $employee->labour_contract_number;
        $employee_edit_info->labour_contract_exp =  $employee->labour_contract_exp;
        $employee_edit_info->labour_contract_copy =  $employee->labour_contract_copy;

        $employee_edit_info->company_contract_number =  $employee->company_contract_number;
        $employee_edit_info->company_contract_exp =  $employee->company_contract_exp;
        $employee_edit_info->company_contract_copy =  $employee->company_contract_copy;

        $employee_edit_info->emirates_id =  $employee->emirates_id;
        $employee_edit_info->emirates_exp =  $employee->emirates_exp;
        $employee_edit_info->emirates_copy =  $employee->emirates_copy;

        $employee_edit_info->jabel_ali_pass =  $employee->jabel_ali_pass;
        $employee_edit_info->jabel_ali_pass_exp =  $employee->jabel_ali_pass_exp;
        $employee_edit_info->jabel_ali_pass_copy =  $employee->jabel_ali_pass_copy;

        $employee_edit_info->emal_pass =  $employee->emal_pass;
        $employee_edit_info->emal_pass_exp =  $employee->emal_pass_exp;
        $employee_edit_info->emal_pass_copy =  $employee->emal_pass_copy;

        $employee_edit_info->kp_mina =  $employee->kp_mina;
        $employee_edit_info->kp_mina_exp =  $employee->kp_mina_exp;
        $employee_edit_info->kp_mina_copy =  $employee->kp_mina_copy;


        $employee_edit_info->driving_license =  $employee->driving_license;
        $employee_edit_info->driving_license_exp =  $employee->driving_license_exp;
        $employee_edit_info->driving_license_copy =  $employee->driving_license_copy;

        $employee_edit_info->health_insurance_policy_number =  $employee->health_insurance_policy_number;
        $employee_edit_info->health_insurance_policy_exp =  $employee->health_insurance_policy_exp;
        $employee_edit_info->health_insurance_policy_copy =  $employee->health_insurance_policy_copy;

        $employee_edit_info->deposit_amount =  $employee->deposit_amount;
        $employee_edit_info->deposit_way =  $employee->deposit_way;
        $employee_edit_info->deposit_upload =  $employee->deposit_upload;

        $employee_edit_info->incentives =  $employee->incentives;
        $employee_edit_info->incentives_upload =  $employee->incentives_upload;

        $employee_edit_info->save();

        if($request->input('type') != ''){
            $employee->type = $request->input('type');
        }

        if($request->input('name') != ''){
            $employee->name = $request->input('name');
        }
        if($request->input('company_id') != ''){
            $employee->company_id = $request->input('company_id');
        }

        if($request->input('designation') != ''){
            $employee->designation = $request->input('designation');
        }

        if($request->input('designation_actual') != ''){
            $employee->designation_actual = $request->input('designation_actual');
        }

        if($request->input('basic_salary_actual') != ''){
            $employee->basic_salary_actual = $request->input('basic_salary_actual');
        }
        if($request->input('designation_per_labour_contract') != ''){
            $employee->designation_per_labour_contract = $request->input('designation_per_labour_contract');
        }
        if($request->input('basic_salary_per_labour_contract') != ''){
            $employee->basic_salary_per_labour_contract = $request->input('basic_salary_per_labour_contract');
        }   

        if($request->input('nationality') != ''){
            $employee->nationality = $request->input('nationality');
        }  

        if($request->input('national_id_number') != ''){
            $employee->national_id_number = $request->input('national_id_number');
        } 


        

        if($request->input('national_id_exp') != ''){
            $employee->national_id_exp = $request->input('national_id_exp');
        }

        if ($request->hasFile('national_id_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->national_id_copy->getClientOriginalName());
            $file = $request->file('national_id_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->national_id_copy = $name;

            }
            
        }

        if($request->input('passport_number') != ''){
            $employee->passport_number = $request->input('passport_number');
        }

        if($request->input('passport_exp') != ''){
            $employee->passport_exp = $request->input('passport_exp');
        }

        if ($request->hasFile('passport_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->passport_copy->getClientOriginalName());
            $file = $request->file('passport_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->passport_copy = $name;

            }
            
        }

        if($request->input('visa_number') != ''){
            $employee->visa_number = $request->input('visa_number');
        }

        if($request->input('visa_exp') != ''){
            $employee->visa_exp = $request->input('visa_exp');
        }

        if($request->input('visa_uuid') != ''){
            $employee->visa_uuid = $request->input('visa_uuid');
        }

        if ($request->hasFile('visa_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->visa_copy->getClientOriginalName());
            $file = $request->file('visa_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->visa_copy = $name;

            }
            
        }


        if($request->input('work_permit_number') != ''){
            $employee->work_permit_number = $request->input('work_permit_number');
        }

        if($request->input('work_permit_exp') != ''){
            $employee->work_permit_exp = $request->input('work_permit_exp');
        }

        if ($request->hasFile('work_permit_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->work_permit_copy->getClientOriginalName());
            $file = $request->file('work_permit_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->work_permit_copy = $name;

            }
            
        }


        if($request->input('noc_number') != ''){
            $employee->noc_number = $request->input('noc_number');
        }

        if($request->input('noc_exp') != ''){
            $employee->noc_exp = $request->input('noc_exp');
        }

        if ($request->hasFile('noc_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->noc_copy->getClientOriginalName());
            $file = $request->file('noc_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->noc_copy = $name;

            }
            
        }

        if($request->input('labour_contract_number') != ''){
            $employee->labour_contract_number = $request->input('labour_contract_number');
        }

        if($request->input('labour_contract_exp') != ''){
            $employee->labour_contract_exp = $request->input('labour_contract_exp');
        }

        if ($request->hasFile('labour_contract_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->labour_contract_copy->getClientOriginalName());
            $file = $request->file('labour_contract_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->labour_contract_copy = $name;

            }
            
        }


        if($request->input('company_contract_number') != ''){
            $employee->company_contract_number = $request->input('company_contract_number');
        }

        if($request->input('company_contract_exp') != ''){
            $employee->company_contract_exp = $request->input('company_contract_exp');
        }

        if ($request->hasFile('company_contract_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->company_contract_copy->getClientOriginalName());
            $file = $request->file('company_contract_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->company_contract_copy = $name;

            }
            
        }

        if($request->input('emirates_id') != ''){
            $employee->emirates_id = $request->input('emirates_id');
        }

        if($request->input('emirates_exp') != ''){
            $employee->emirates_exp = $request->input('emirates_exp');
        }

        if ($request->hasFile('emirates_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->emirates_copy->getClientOriginalName());
            $file = $request->file('emirates_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->emirates_copy = $name;

            }
            
        }
        //jabel ali pass
        if($request->input('jabel_ali_pass') != ''){
            $employee->jabel_ali_pass = $request->input('jabel_ali_pass');
        }

        if($request->input('jabel_ali_pass_exp') != ''){
            $employee->jabel_ali_pass_exp = $request->input('jabel_ali_pass_exp');
        }

        if ($request->hasFile('jabel_ali_pass_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->jabel_ali_pass_copy->getClientOriginalName());
            $file = $request->file('jabel_ali_pass_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->jabel_ali_pass_copy = $name;

            }
            
        }

        //Emal 
        if($request->input('emal_pass') != ''){
            $employee->emal_pass = $request->input('emal_pass');
        }

        if($request->input('emal_pass_exp') != ''){
            $employee->emal_pass_exp = $request->input('emal_pass_exp');
        }

        if ($request->hasFile('emal_pass_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->emal_pass_copy->getClientOriginalName());
            $file = $request->file('emal_pass_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->emal_pass_copy = $name;

            }
            
        }

        //KP Mina pass 
        if($request->input('kp_mina') != ''){
            $employee->kp_mina = $request->input('kp_mina');
        }

        if($request->input('kp_mina_exp') != ''){
            $employee->kp_mina_exp = $request->input('kp_mina_exp');
        }

        if ($request->hasFile('kp_mina_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->kp_mina_copy->getClientOriginalName());
            $file = $request->file('kp_mina_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->kp_mina_copy = $name;

            }
            
        }

        //Driving License 
        if($request->input('driving_license') != ''){
            $employee->driving_license = $request->input('driving_license');
        }

        if($request->input('driving_license_exp') != ''){
            $employee->driving_license_exp = $request->input('driving_license_exp');
        }

        if ($request->hasFile('driving_license_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->driving_license_copy->getClientOriginalName());
            $file = $request->file('driving_license_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->driving_license_copy = $name;

            }
            
        }

        //Health Insurace Policy 
        if($request->input('health_insurance_policy_number') != ''){
            $employee->health_insurance_policy_number = $request->input('health_insurance_policy_number');
        }

        if($request->input('health_insurance_policy_exp') != ''){
            $employee->health_insurance_policy_exp = $request->input('health_insurance_policy_exp');
        }

        if ($request->hasFile('health_insurance_policy_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->health_insurance_policy_copy->getClientOriginalName());
            $file = $request->file('health_insurance_policy_copy');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->health_insurance_policy_copy = $name;

            }
            
        }

        if ($request->hasFile('submission_template')) {

            $name = time().'_'.str_replace(" ", "_", $request->submission_template->getClientOriginalName());
            $file = $request->file('submission_template');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->submission_template = $name;

            }
            
        }

        if ($request->hasFile('passport_handover')) {

            $name = time().'_'.str_replace(" ", "_", $request->passport_handover->getClientOriginalName());
            $file = $request->file('passport_handover');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->passport_handover = $name;

            }
            
        }

        if($request->input('deposit_amount') != ''){
            $employee->deposit_amount = $request->input('deposit_amount');
        }
        if($request->input('deposit_way') != ''){
            $employee->deposit_way = $request->input('deposit_way');
        }
        
        if ($request->hasFile('deposit_upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->deposit_upload->getClientOriginalName());
            $file = $request->file('deposit_upload');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->deposit_upload = $name;

            }
            
        }
        
        if($request->input('incentives') != ''){
            $employee->incentives = $request->input('incentives');
        }
        

        if ($request->hasFile('incentives_upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->incentives_upload->getClientOriginalName());
            $file = $request->file('incentives_upload');
            if($file->storeAs('/main_admin/employee/main/', $name , ['disk' => 'public_uploads'])){
                $employee->incentives_upload = $name;

            }
            
        }



        
        $employee->status_message = $request->input('status_message');
        // if( $employee->user_id != 0){
        //     $user_id  = $employee->user_id;
            
        // }else{
            $user_id  = 0;
        // }

        // if($employee->action == null || $employee->status == 'approved' || $employee->action == 'nill' ){
            $employee->action = 'edit';
        // }

        // $employee->status = $request->input('status');


        $employee->save();

        // if($request->input('status') == 'approved'){
        //     $this->remove_table_name('customer_info');
        // }
        // if($employee->status == 'approved' || $employee->user_id == 0 ){
            //  $this->history_table('customer_histories', $customer_info->action , $user_id, "route('admin.customer.view_customer')", $customer_info->id);
             $this->history_table('employee_histories',$request->input('section'). " info ". $employee->action , $user_id,  $employee->id, "hr_pro.view_employee");
        // }


        return response()->json(['status'=>'1']);
    }

    public function update_employee_status(Request $request){
        $id =  (int)$request->input('id');
        $employee = Employee::where('id' , $id)->first();
        $employee->admin_status = $request->input('admin_status');

        $employee->save();
            //  $this->history_table('employee_histories',$request->input('section'). " info " , 0,  $employee->id, "hr_pro.view_employee");
        
        return response()->json(['status'=>'1']);
    }

    public function add_salary_card(Request $request){
        $data['id'] =  (int)$request->input('id');
        $data['employee'] = Employee::where('id' , $data['id'])->first();

        $data['modules']= DB::table('modules')->get();

        $data['page_title'] = "Add Salary Card";
        $data['view'] = 'admin.hr_pro.employee.salary_card.add_salary_card';
        return view('layout', ["data"=>$data]);
    }

    public function pending_employee_for_joining(){
        
        $data['employee'] = Employee::all();
        foreach($data['employee'] as $employee){
            $employee->applicale_for_joining  = false;
            if($employee->type == 'permanent'){

                if($employee->work_permit_number == '' || $employee->work_permit_exp  == '' || $employee->work_permit_copy  == '' ){
                    $employee->applicale_for_joining  = false;
                    continue;
                }else if($employee->labour_contract_number == '' || $employee->labour_contract_exp  == '' || $employee->labour_contract_copy  == '' ){
                    $employee->applicale_for_joining  = false;
                     continue;

                }else if($employee->health_insurance_policy_number == '' || $employee->health_insurance_policy_exp  == '' || $employee->health_insurance_policy_copy  == '' ){
                    $employee->applicale_for_joining  = false;
                     continue;
                }

            }else if($employee->type == 'temporary'){
                if($employee->noc_number == '' || $employee->noc_exp  == '' || $employee->noc_copy  == ''){
                    $employee->applicale_for_joining  = false;
                     continue;
                }
               
            }

            if($employee->designation == 'driver'){
                if($employee->driving_license == '' || $employee->driving_license_exp  == '' || $employee->driving_license_copy  == '' ){
                    $employee->applicale_for_joining  = false;
                    continue;
                }
            }
            if($employee->jabel_ali_pass == '' || $employee->jabel_ali_pass_exp  == '' || $employee->jabel_ali_pass_copy  == '' ){
                $employee->applicale_for_joining  = false;
                 continue;
            }

            if($employee->emal_pass == '' || $employee->emal_pass_exp  == '' || $employee->emal_pass_copy  == '' ){
                $employee->applicale_for_joining  = false;
                 continue;
            }

            if($employee->kp_mina == '' || $employee->kp_mina_exp  == '' || $employee->kp_mina_copy  == '' ){
                $employee->applicale_for_joining  = false;
                continue;
            }
            $employee->applicale_for_joining = true;
           
        }

        // dd($data['employee'] );
        $data['modules']= DB::table('modules')->get();

        $data['page_title'] = "Joining Date";
        $data['view'] = 'admin.hr_pro.employee.employee_joining';
        return view('layout', ["data"=>$data]);
    }

    public function employee_doj(Request $request){
        $data['id'] =  (int)$request->input('id');
        $data['employee'] = Employee::where('id' , $data['id'])->first();
        $data['employee']->employee_doj = $request->input('employee_doj');
        $data['employee']->status = 'approved';

        $data['employee']->employee_current_status = 'active';
        $data['employee']->save();

        $this->history_table('employee_histories', "Employee Joined " , 0,  $data['employee']->id, "hr_pro.view_employee");
        
        return \Redirect::route('admin.hr_pro.employee')->with('success', 'Employee Joined  sucessfully');
    }

    public function existing_employee(){
        $data['employee'] = Employee::all();
        $data['modules']= DB::table('modules')->get();


        $data['page_title'] = "Existing Employee";
        $data['view'] = 'admin.hr_pro.employee.existing_employee';
        return view('layout', ["data"=>$data]);
    }

    public function delete_employee_status(Request $request){
        $id =  (int)$request->input('id');
        $employee = Employee::where('id' , $id)->first();
        
        $employee->status_message = $request->input('status_message');
        if( $employee->user_id != 0){
            $user_id  = $employee->user_id;
            
        }else{
            $user_id  = 0;
        }

        $employee->row_status = 'deleted';

       


            $employee->action = 'delete';

        
 
        if( $employee->save()){

            // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
            $this->history_table('employee_histories', $employee->action , $user_id , $employee->id , 'hr_pro.view_employee');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    /////////////////////////////////
    ///////// Employee termination /////////
    /////////////////////////////////

    public function employee_terminate(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        
        $data['terminate_employee'] = Emmployee_termination::all();
        $data['employees'] = Employee::all();
        $data['page_title'] = "Employee Termination";
        $data['view'] = 'admin.hr_pro.employee.termination.termination';
        return view('layout', ["data"=>$data]);
    }

    public function trash_employee_termination(){
        $data['modules']= DB::table('modules')->get();
        $data['terminate_employee'] = Emmployee_termination::all();
        $data['employees'] = Employee::all();

        // dd( $data['customer_info']);
        $data['page_title'] = "Employee Termination Trash";
        $data['view'] = 'admin.hr_pro.employee.termination.deleted_data';
        return view('layout', ["data"=>$data]);
    }

    public function employee_termination_history(){

        $data['modules']= DB::table('modules')->get();
        
        $data['employees'] = Employee::all();

        $data['trade_licenses_history']= Emmployee_termination_history::all();
        $data['table_name']= 'emmployee_termination_histories';

        $data['page_title'] = "History | Employee Termination ";
        $data['view'] = 'admin.hr_pro.history';
        return view('layout', ["data"=>$data]);
    }

    public function add_employee_termination(){
        $data['modules']= DB::table('modules')->get();

        
        $data['employee'] = Employee::all();
        $data['page_title'] = "Add  Employee Termination";
        $data['view'] = 'admin.hr_pro.employee.termination.add_termination';
        return view('layout', ["data"=>$data]);
    }

    public function view_employee_termination(Request $request){
        $data['terminate_employee'] = Emmployee_termination::find($request->input('id'));
        $data['employees'] = Employee::all();

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        
        $data['page_title'] = "  Employee Termination Request";
        $data['view'] = 'admin.hr_pro.employee.termination.view_termination';
        return view('layout', ["data"=>$data]);
    }

    public function edit_employee_termination (Request $request){
        $data['terminate_employee'] = Emmployee_termination::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();
        $data['employee'] = Employee::all();

        //dd($data['modules']);
        

        $data['page_title'] = "Edit Employee Termination Request";
        $data['view'] = 'admin.hr_pro.employee.termination.edit_termination';
        return view('layout', ["data"=>$data]);
    }

    public function save_employee_termination(Request $request){

        $employee_termination = new Emmployee_termination;
        $employee = Employee::find($request->input('emp_id'));
        $employee->employee_current_action = 'terminated';
        $employee->employee_current_status = 'approved';
        $employee->employee_current_status_reason = $request->input('remarks');
        $employee->save();
        $this->history_table('employee_histories','Employee Terminated' , 0 ,  $employee->id, "hr_pro.view_employee");

        if($request->input('emp_id') != ''){
            $employee_termination->emp_id = $request->input('emp_id');

        }
        if($request->input('remarks') != ''){
            $employee_termination->remarks = $request->input('remarks');

        }
        if($request->input('date') != ''){
            $employee_termination->date = $request->input('date');
        }

        if ($request->hasFile('upload')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $employee_termination->upload	 = $name;

            }
           

        }
        $employee_termination->status = 'approved';
 
        $employee_termination->user_id = 0;
       


        if($employee_termination->save()){
            $this->history_table('emmployee_termination_histories', 'Add' , 0 , $employee_termination->id , 'hr_pro.view_employee_termination');
            return \Redirect::route('admin.hr_pro.employee_terminate')->with('success', 'Data Added Sucessfully');
        }
        


    }

    public function update_employee_termination(Request $request){
        $id =  (int)$request->input('id');
        $employee_termination = Emmployee_termination::where('id' , $id)->first();

        if($request->input('remarks') != ''){
            $employee_termination->remarks = $request->input('remarks');

        }
        if($request->input('date') != ''){
            $employee_termination->date = $request->input('date');
        }

        if ($request->hasFile('upload')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $employee_termination->upload	 = $name;

            }
           

        }




        $employee_termination->status_message = $request->input('status_message');
        if( $employee_termination->user_id != 0){
            $user_id  = $employee_termination->user_id;
            
        }else{
            $user_id  = 0;
        }
        // dd($trade_license->action );

        if($employee_termination->action == null || $employee_termination->status == 'approved' ||$employee_termination->action == 'nill'){
            $employee_termination->action = 'edit';
        }

        $employee_termination->status = $request->input('status');


        $employee_termination->save();

        
        if($employee_termination->status == 'approved' || $user_id == 0 ){
            $employee = Employee::find($request->input('emp_id'));
            $employee->employee_current_action = 'terminated';
            $employee->employee_current_status = 'approved';
            $employee->employee_current_status_reason = $request->input('remarks');
            $employee->save();
            $this->history_table('employee_histories','Employee Terminated' , 0 ,  $employee->id, "hr_pro.view_employee");
            //  $this->history_table('trade_license_histories', $trade_license->action , $user_id);
             $this->history_table('emmployee_termination_histories', $employee_termination->action , $user_id , $employee_termination->id , 'hr_pro.view_employee_termination');
        }


        return \Redirect::route('admin.hr_pro.employee_terminate')->with('success', 'Data Updated Sucessfully');

    }

   
    public function delete_employee_termination_status(Request $request){
        $id =  (int)$request->input('id');
        $employee_termination = Emmployee_termination::where('id' , $id)->first();

        $employee = Employee::find( $employee_termination->emp_id);

        $employee->employee_current_action = '';
        $employee->employee_current_status = '';
        $employee->employee_current_status_reason = '';
        $employee->save();
        $this->history_table('employee_histories','Employee Termination Removed' , 0 ,  $employee->id, "hr_pro.view_employee");

        $employee_termination->status_message = $request->input('status_message');
        if( $employee_termination->user_id != 0){
            $user_id  = $employee_termination->user_id;
            
        }else{
            $user_id  = 0;
        }

        $employee_termination->row_status = 'deleted';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }

        // if($trade_license->action == null || $trade_license->status == 'approved'){
            $employee_termination->action = 'delete';
        // }

        
        $employee_termination->status = 'pending';
 
        if( $employee_termination->save()){

            // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
            $this->history_table('emmployee_termination_histories', $employee_termination->action , $user_id , $employee_termination->id , 'hr_pro.view_employee_termination');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_employee_termination(Request $request){
        $id =  (int)$request->input('id');
        $employee_termination = Emmployee_termination::where('id' , $id)->first();
        
        $employee_termination->status_message = $request->input('status_message');
        if( $employee_termination->user_id != 0){
                        
        }else{
            $user_id  = 0;
        }

        $employee_termination->row_status = 'active';

        $employee_termination->action = 'restored';
        
        $employee_termination->save();
        // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
        $this->history_table('emmployee_termination_histories', $employee_termination->action , $user_id , $employee_termination->id , 'hr_pro.view_employee_termination');
 
        $employee_termination->action = 'deleted';
        $employee_termination->save();
           
            return response()->json(['status'=>'1']);
        
    }

    /////////////////////////////////
    ///////// Employee Suspension /////////
    /////////////////////////////////

    public function employee_suspension(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        
        $data['employee_suspension'] = Employee_suspension::all();
        $data['employees'] = Employee::all();
        $data['page_title'] = "Employee Suspension";
        $data['view'] = 'admin.hr_pro.employee.suspension.suspension';
        return view('layout', ["data"=>$data]);
    }

    public function trash_employee_suspension(){
        $data['modules']= DB::table('modules')->get();
        $data['employee_suspension'] = Employee_suspension::all();
        $data['employees'] = Employee::all();

        // dd( $data['customer_info']);
        $data['page_title'] = "Employee suspension Trash";
        $data['view'] = 'admin.hr_pro.employee.suspension.deleted_data';
        return view('layout', ["data"=>$data]);
    }

    public function employee_suspension_history(){

        $data['modules']= DB::table('modules')->get();
        
        $data['employees'] = Employee::all();

        $data['trade_licenses_history']= Emmployee_suspension_history::all();
        $data['table_name']= 'emmployee_suspension_histories';

        $data['page_title'] = "History | Employee suspension ";
        $data['view'] = 'admin.hr_pro.history';
        return view('layout', ["data"=>$data]);
    }

    public function add_employee_suspension(){
        $data['modules']= DB::table('modules')->get();

        
        $data['employee'] = Employee::all();
        $data['page_title'] = "Add  Employee suspension";
        $data['view'] = 'admin.hr_pro.employee.suspension.add_suspension';
        return view('layout', ["data"=>$data]);
    }

    public function view_employee_suspension(Request $request){
        $data['employee_suspension'] = Employee_suspension::find($request->input('id'));
        $data['employees'] = Employee::all();

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        
        $data['page_title'] = "  Employee suspension Request";
        $data['view'] = 'admin.hr_pro.employee.suspension.view_suspension';
        return view('layout', ["data"=>$data]);
    }

    public function edit_employee_suspension (Request $request){
        $data['employee_suspension'] = Employee_suspension::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();
        $data['employee'] = Employee::all();

        //dd($data['modules']);
        

        $data['page_title'] = "Edit Employee Suspension Request";
        $data['view'] = 'admin.hr_pro.employee.suspension.edit_suspension';
        return view('layout', ["data"=>$data]);
    }

    public function save_employee_suspension(Request $request){

        $employee_suspension = new Employee_suspension;
        $employee = Employee::find($request->input('emp_id'));
        $employee->employee_current_action = 'suspended';
        $employee->employee_current_status = 'approved';
        $employee->employee_current_status_reason = $request->input('remarks');
        $employee->save();
        $this->history_table('employee_histories','Employee Suspended' , 0 ,  $employee->id, "hr_pro.view_employee");

        if($request->input('emp_id') != ''){
            $employee_suspension->emp_id = $request->input('emp_id');

        }
        if($request->input('remarks') != ''){
            $employee_suspension->remarks = $request->input('remarks');

        }
        if($request->input('date') != ''){
            $employee_suspension->date = $request->input('date');
        }

        if ($request->hasFile('upload')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $employee_suspension->upload	 = $name;

            }
           

        }
        $employee_suspension->status = 'approved';
 
        $employee_suspension->user_id = 0;
       


        if($employee_suspension->save()){
            $this->history_table('emmployee_suspension_histories', 'Add' , 0 , $employee_suspension->id , 'hr_pro.view_employee_suspension');
            return \Redirect::route('admin.hr_pro.employee_suspension')->with('success', 'Data Added Sucessfully');
        }
        


    }

    public function update_employee_suspension(Request $request){
        $id =  (int)$request->input('id');
        $employee_suspension = Employee_suspension::where('id' , $id)->first();

        if($request->input('remarks') != ''){
            $employee_suspension->remarks = $request->input('remarks');

        }
        if($request->input('date') != ''){
            $employee_suspension->date = $request->input('date');
        }

        if ($request->hasFile('upload')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $employee_suspension->upload	 = $name;

            }
           

        }




        $employee_suspension->status_message = $request->input('status_message');
        if( $employee_suspension->user_id != 0){
            $user_id  = $employee_suspension->user_id;
            
        }else{
            $user_id  = 0;
        }
        // dd($trade_license->action );

        if($employee_suspension->action == null || $employee_suspension->status == 'approved' ||$employee_suspension->action == 'nill'){
            $employee_suspension->action = 'edit';
        }

        $employee_suspension->status = $request->input('status');


        $employee_suspension->save();

        
        if($employee_suspension->status == 'approved' || $user_id == 0 ){
            $employee = Employee::find($request->input('emp_id'));
            $employee->employee_current_action = 'suspended';
            $employee->employee_current_status = 'approved';
            $employee->employee_current_status_reason = $request->input('remarks');
            $employee->save();
            $this->history_table('employee_histories','Employee Suspended' , 0 ,  $employee->id, "hr_pro.view_employee");
            //  $this->history_table('trade_license_histories', $trade_license->action , $user_id);
            
        }
        $this->history_table('emmployee_suspension_histories', $employee_suspension->action , $user_id , $employee_suspension->id , 'hr_pro.view_employee_suspension');


        return \Redirect::route('admin.hr_pro.employee_suspension')->with('success', 'Data Updated Sucessfully');

    }

   
    public function delete_employee_suspension_status(Request $request){
        $id =  (int)$request->input('id');
        $employee_suspension = Employee_suspension::where('id' , $id)->first();

        $employee = Employee::find( $employee_suspension->emp_id);

        $employee->employee_current_action = '';
        $employee->employee_current_status = '';
        $employee->employee_current_status_reason = '';
        $employee->save();
        $this->history_table('employee_histories','Employee Termination Removed' , 0 ,  $employee->id, "hr_pro.view_employee");

        $employee_suspension->status_message = $request->input('status_message');
        if( $employee_suspension->user_id != 0){
            $user_id  = $employee_suspension->user_id;
            
        }else{
            $user_id  = 0;
        }

        $employee_suspension->row_status = 'deleted';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }

        // if($trade_license->action == null || $trade_license->status == 'approved'){
            $employee_suspension->action = 'delete';
        // }

        
        $employee_suspension->status = 'pending';
 
        if( $employee_suspension->save()){

            // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
            $this->history_table('emmployee_suspension_histories', $employee_suspension->action , $user_id , $employee_suspension->id , 'hr_pro.view_employee_suspension');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_employee_suspension(Request $request){
        $id =  (int)$request->input('id');
        $employee_suspension = Employee_suspension::where('id' , $id)->first();
        
        $employee_suspension->status_message = $request->input('status_message');
        if( $employee_suspension->user_id != 0){
                        
        }else{
            $user_id  = 0;
        }

        $employee_suspension->row_status = 'active';
        $employee_suspension->status = 'pending';

        $employee_suspension->action = 'restored';
        
        $employee_suspension->save();
        // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
        $this->history_table('emmployee_suspension_histories', $employee_suspension->action , $user_id , $employee_suspension->id , 'hr_pro.view_employee_suspension');
 
        $employee_suspension->action = 'deleted';
        $employee_suspension->save();
           
            return response()->json(['status'=>'1']);
        
    }

    /////////////////////////////////
    ///////// Employee Renewals /////////
    /////////////////////////////////

    public function employee_renewals(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        
        $data['renew_employee'] = Emmployee_renewals::all();
        $data['employees'] = Employee::all();
        $data['page_title'] = "Employee Renewal";
        $data['view'] = 'admin.hr_pro.employee.renewals.renewals';
        return view('layout', ["data"=>$data]);
    }

    public function trash_employee_renewals(){
        $data['modules']= DB::table('modules')->get();
        $data['renew_employee'] = Emmployee_renewals::all();
        $data['employees'] = Employee::all();

        // dd( $data['customer_info']);
        $data['page_title'] = "Employee Renewals Trash";
        $data['view'] = 'admin.hr_pro.employee.renewals.deleted_data';
        return view('layout', ["data"=>$data]);
    }

    public function employee_renewals_history(){

        $data['modules']= DB::table('modules')->get();
        
        $data['employees'] = Employee::all();

        $data['trade_licenses_history']= Emmployee_renewals_history::all();
        $data['table_name']= 'emmployee_renewals_histories';

        $data['page_title'] = "History | Employee Renewals ";
        $data['view'] = 'admin.hr_pro.history';
        return view('layout', ["data"=>$data]);
    }

    public function add_employee_renewals(){
        $data['modules']= DB::table('modules')->get();

        
        $data['employee'] = Employee::all();
        $data['page_title'] = "Add  Employee Renewals";
        $data['view'] = 'admin.hr_pro.employee.renewals.add_renewals';
        return view('layout', ["data"=>$data]);
    }

    public function view_employee_renewals(Request $request){
        $data['renew_employee'] = Emmployee_renewals_history::find($request->input('id'));
        $data['employees'] = Employee::all();

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        
        $data['page_title'] = "  Employee Renewals Request";
        $data['view'] = 'admin.hr_pro.employee.renewals.view_renewals';
        return view('layout', ["data"=>$data]);
    }

    public function edit_employee_renewals (Request $request){
        $data['renew_employee'] = Emmployee_renewals::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();
        $data['employee'] = Employee::all();

        //dd($data['modules']);
        

        $data['page_title'] = "Edit Employee Renewal Request";
        $data['view'] = 'admin.hr_pro.employee.renewals.edit_renewals';
        return view('layout', ["data"=>$data]);
    }

    public function save_employee_renewals(Request $request){

        $employee_termination = new Emmployee_renewals;
        $employee = Employee::find($request->input('emp_id'));
        $employee->employee_current_action = 'renewal';
        $employee->employee_current_status = 'approved';
        $employee->employee_current_status_reason = $request->input('remarks');
        $employee->save();
        $this->history_table('employee_histories','Employee Renew' , 0 ,  $employee->id, "hr_pro.view_employee");

        if($request->input('emp_id') != ''){
            $employee_termination->emp_id = $request->input('emp_id');

        }
        if($request->input('remarks') != ''){
            $employee_termination->remarks = $request->input('remarks');

        }
        if($request->input('date') != ''){
            $employee_termination->date = $request->input('date');
        }

        if ($request->hasFile('upload')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $employee_termination->upload	 = $name;

            }
           

        }
        $employee_termination->status = 'approved';
 
        $employee_termination->user_id = 0;
       


        if($employee_termination->save()){
            $this->history_table('emmployee_renewals_histories', 'Add' , 0 , $employee_termination->id , 'hr_pro.view_employee_renewals');
            return \Redirect::route('admin.hr_pro.employee_renewals')->with('success', 'Data Added Sucessfully');
        }
        


    }

    public function update_employee_renewals(Request $request){
        $id =  (int)$request->input('id');
        $employee_termination = Emmployee_renewals::where('id' , $id)->first();

        if($request->input('remarks') != ''){
            $employee_termination->remarks = $request->input('remarks');

        }
        if($request->input('date') != ''){
            $employee_termination->date = $request->input('date');
        }

        if ($request->hasFile('upload')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $employee_termination->upload	 = $name;

            }
           

        }




        $employee_termination->status_message = $request->input('status_message');
        if( $employee_termination->user_id != 0){
            $user_id  = $employee_termination->user_id;
            
        }else{
            $user_id  = 0;
        }
        // dd($trade_license->action );

        if($employee_termination->action == null || $employee_termination->status == 'approved' ||$employee_termination->action == 'nill'){
            $employee_termination->action = 'edit';
        }

        $employee_termination->status = $request->input('status');


        $employee_termination->save();

        
        if($employee_termination->status == 'approved' || $user_id == 0 ){
            $employee = Employee::find($request->input('emp_id'));
            $employee->employee_current_action = 'terminated';
            $employee->employee_current_status = 'approved';
            $employee->employee_current_status_reason = $request->input('remarks');
            $employee->save();
            $this->history_table('employee_histories','Employee Renewal' , 0 ,  $employee->id, "hr_pro.view_employee");
            //  $this->history_table('trade_license_histories', $trade_license->action , $user_id);
             $this->history_table('emmployee_renewals_histories', $employee_termination->action , $user_id , $employee_termination->id , 'hr_pro.view_employee_renewals');
        }


        return \Redirect::route('admin.hr_pro.employee_renewals')->with('success', 'Data Updated Sucessfully');

    }

   
    public function delete_employee_renewals_status(Request $request){
        $id =  (int)$request->input('id');
        $employee_termination = Emmployee_renewals::where('id' , $id)->first();

        $employee = Employee::find( $employee_termination->emp_id);

        $employee->employee_current_action = '';
        $employee->employee_current_status = '';
        $employee->employee_current_status_reason = '';
        $employee->save();
        // $this->history_table('employee_histories','Employee R Removed' , 0 ,  $employee->id, "hr_pro.view_employee");

        $employee_termination->status_message = $request->input('status_message');
        if( $employee_termination->user_id != 0){
            $user_id  = $employee_termination->user_id;
            
        }else{
            $user_id  = 0;
        }

        $employee_termination->row_status = 'deleted';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }

        // if($trade_license->action == null || $trade_license->status == 'approved'){
            $employee_termination->action = 'delete';
        // }

        
        $employee_termination->status = 'pending';
 
        if( $employee_termination->save()){

            // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
            $this->history_table('emmployee_renewals_histories', $employee_termination->action , $user_id , $employee_termination->id , 'hr_pro.view_employee_renewals');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_employee_renewals(Request $request){
        $id =  (int)$request->input('id');
        $employee_termination = Emmployee_renewals::where('id' , $id)->first();
        
        $employee_termination->status_message = $request->input('status_message');
        if( $employee_termination->user_id != 0){
                        
        }else{
            $user_id  = 0;
        }

        $employee_termination->row_status = 'active';
        $employee_termination->status = 'pending';
        $employee_termination->action = 'restored';
        
        $employee_termination->save();
        // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
        $this->history_table('emmployee_renewals_histories', $employee_termination->action , $user_id , $employee_termination->id , 'hr_pro.view_employee_renewals');
 
        $employee_termination->action = 'deleted';
        $employee_termination->save();
           
            return response()->json(['status'=>'1']);
        
    }

    ///////////////////////////////////////
    ///////// Employee Increments /////////
    ///////////////////////////////////////

    public function employee_increments(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        
        $data['employee_increments'] = Employee_increments::all();
        $data['employees'] = Employee::all();
        $data['page_title'] = "Employee Increments";
        $data['view'] = 'admin.hr_pro.employee.increments.increments';
        return view('layout', ["data"=>$data]);
    }

    public function trash_employee_increments(){
        $data['modules']= DB::table('modules')->get();
        $data['employee_increments'] = Employee_increments::all();
        $data['employees'] = Employee::all();

        // dd( $data['customer_info']);
        $data['page_title'] = "Employee increments Trash";
        $data['view'] = 'admin.hr_pro.employee.increments.deleted_data';
        return view('layout', ["data"=>$data]);
    }

    public function employee_increments_history(){

        $data['modules']= DB::table('modules')->get();
        
        $data['employees'] = Employee::all();

        $data['trade_licenses_history']= Employee_increments_history::all();
        $data['table_name']= 'employee_increments_histories';

        $data['page_title'] = "History | Employee increments ";
        $data['view'] = 'admin.hr_pro.history';
        return view('layout', ["data"=>$data]);
    }

    public function add_employee_increments(){
        $data['modules']= DB::table('modules')->get();

        
        $data['employee'] = Employee::all();
        $data['page_title'] = "Add  Employee increments";
        $data['view'] = 'admin.hr_pro.employee.increments.add_increments';
        return view('layout', ["data"=>$data]);
    }

    public function view_employee_increments(Request $request){
        $data['employee_increments'] = Employee_increments::find($request->input('id'));
        $data['employees'] = Employee::all();

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        
        $data['page_title'] = "  Employee increments Request";
        $data['view'] = 'admin.hr_pro.employee.increments.view_increments';
        return view('layout', ["data"=>$data]);
    }

    public function edit_employee_increments (Request $request){
        $data['employee_increments'] = Employee_increments::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();
        $data['employee'] = Employee::all();

        //dd($data['modules']);
        

        $data['page_title'] = "Edit Employee Increment Request";
        $data['view'] = 'admin.hr_pro.employee.increments.edit_increments';
        return view('layout', ["data"=>$data]);
    }

    public function save_employee_increments(Request $request){

        $employee_termination = new Employee_increments;
        

        if($request->input('emp_id') != ''){
            $employee_termination->emp_id = $request->input('emp_id');

        }
        if($request->input('amount') != ''){
            $employee_termination->amount = $request->input('amount');

        }
        if($request->input('reason') != ''){
            $employee_termination->reason = $request->input('reason');

        }
        if($request->input('applicable_month') != ''){
            $employee_termination->applicable_month = $request->input('applicable_month');
        }

        if ($request->hasFile('upload')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $employee_termination->upload	 = $name;

            }
           

        }
        $employee_termination->status = 'approved';
 
        $employee_termination->user_id = 0;
       


        if($employee_termination->save()){
            $this->history_table('employee_increments_histories', 'Add' , 0 , $employee_termination->id , 'hr_pro.view_employee_increments');
            return \Redirect::route('admin.hr_pro.employee_increments')->with('success', 'Data Added Sucessfully');
        }
        


    }

    public function update_employee_increments(Request $request){
        $id =  (int)$request->input('id');
        $employee_termination = Employee_increments::where('id' , $id)->first();

        if($request->input('emp_id') != ''){
            $employee_termination->emp_id = $request->input('emp_id');

        }
        if($request->input('amount') != ''){
            $employee_termination->amount = $request->input('amount');

        }
        if($request->input('reason') != ''){
            $employee_termination->reason = $request->input('reason');

        }
        if($request->input('applicable_month') != ''){
            $employee_termination->applicable_month = $request->input('applicable_month');
        }

        if ($request->hasFile('upload')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $employee_termination->upload	 = $name;

            }
           

        }




        $employee_termination->status_message = $request->input('status_message');
        if( $employee_termination->user_id != 0){
            $user_id  = $employee_termination->user_id;
            
        }else{
            $user_id  = 0;
        }
        // dd($trade_license->action );

        if($employee_termination->action == null || $employee_termination->status == 'approved' ||$employee_termination->action == 'nill'){
            $employee_termination->action = 'edit';
        }

        $employee_termination->status = $request->input('status');


        $employee_termination->save();

        
        if($employee_termination->status == 'approved' || $user_id == 0 ){
            
            //  $this->history_table('trade_license_histories', $trade_license->action , $user_id);
             $this->history_table('employee_increments_histories', $employee_termination->action , $user_id , $employee_termination->id , 'hr_pro.view_employee_increments');
        }


        return \Redirect::route('admin.hr_pro.employee_increments')->with('success', 'Data Updated Sucessfully');

    }

   
    public function delete_employee_increments_status(Request $request){
        $id =  (int)$request->input('id');
        $employee_termination = Employee_increments::where('id' , $id)->first();

        $employee = Employee::find( $employee_termination->emp_id);

       
        // $this->history_table('employee_histories','Employee R Removed' , 0 ,  $employee->id, "hr_pro.view_employee");

        $employee_termination->status_message = $request->input('status_message');
        if( $employee_termination->user_id != 0){
            $user_id  = $employee_termination->user_id;
            
        }else{
            $user_id  = 0;
        }

        $employee_termination->row_status = 'deleted';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }

        // if($trade_license->action == null || $trade_license->status == 'approved'){
            $employee_termination->action = 'delete';
        // }

        
        $employee_termination->status = 'pending';
 
        if( $employee_termination->save()){

            // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
            $this->history_table('employee_increments_histories', $employee_termination->action , $user_id , $employee_termination->id , 'hr_pro.view_employee_increments');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_employee_increments(Request $request){
        $id =  (int)$request->input('id');
        $employee_termination = Employee_increments::where('id' , $id)->first();
        
        $employee_termination->status_message = $request->input('status_message');
        if( $employee_termination->user_id != 0){
                        
        }else{
            $user_id  = 0;
        }

        $employee_termination->row_status = 'active';
        $employee_termination->status = 'pending';
        $employee_termination->action = 'restored';
        
        $employee_termination->save();
        // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
        $this->history_table('employee_increments_histories', $employee_termination->action , $user_id , $employee_termination->id , 'hr_pro.view_employee_increments');
 
        $employee_termination->action = 'deleted';
        $employee_termination->save();
           
            return response()->json(['status'=>'1']);
        
    }

    ///////////////////////////////////////
    ///////// Employee Deduction /////////
    ///////////////////////////////////////

    public function employee_deduction(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        
        $data['employee_deduction'] = employee_deduction::all();
        $data['employees'] = Employee::all();
        $data['page_title'] = "Employee deduction";
        $data['view'] = 'admin.hr_pro.employee.deduction.deduction';
        return view('layout', ["data"=>$data]);
    }

    public function trash_employee_deduction(){
        $data['modules']= DB::table('modules')->get();
        $data['employee_deduction'] = employee_deduction::all();
        $data['employees'] = Employee::all();

        // dd( $data['customer_info']);
        $data['page_title'] = "Employee deduction Trash";
        $data['view'] = 'admin.hr_pro.employee.deduction.deleted_data';
        return view('layout', ["data"=>$data]);
    }

    public function employee_deduction_history(){

        $data['modules']= DB::table('modules')->get();
        
        $data['employees'] = Employee::all();

        $data['trade_licenses_history']= employee_deduction_history::all();
        $data['table_name']= 'employee_deduction_histories';

        $data['page_title'] = "History | Employee deduction ";
        $data['view'] = 'admin.hr_pro.history';
        return view('layout', ["data"=>$data]);
    }

    public function add_employee_deduction(){
        $data['modules']= DB::table('modules')->get();

        
        $data['employee'] = Employee::all();
        $data['page_title'] = "Add  Employee deduction";
        $data['view'] = 'admin.hr_pro.employee.deduction.add_deduction';
        return view('layout', ["data"=>$data]);
    }

    public function view_employee_deduction(Request $request){
        $data['employee_deduction'] = employee_deduction::find($request->input('id'));
        $data['employees'] = Employee::all();

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        
        $data['page_title'] = "  Employee deduction Request";
        $data['view'] = 'admin.hr_pro.employee.deduction.view_deduction';
        return view('layout', ["data"=>$data]);
    }

    public function edit_employee_deduction (Request $request){
        $data['employee_deduction'] = employee_deduction::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();
        $data['employee'] = Employee::all();

        //dd($data['modules']);
        

        $data['page_title'] = "Edit Employee Renewal Request";
        $data['view'] = 'admin.hr_pro.employee.deduction.edit_deduction';
        return view('layout', ["data"=>$data]);
    }

    public function save_employee_deduction(Request $request){

        $employee_termination = new employee_deduction;
        

        if($request->input('emp_id') != ''){
            $employee_termination->emp_id = $request->input('emp_id');

        }
        if($request->input('amount') != ''){
            $employee_termination->amount = $request->input('amount');

        }
        if($request->input('reason') != ''){
            $employee_termination->reason = $request->input('reason');

        }
        if($request->input('applicable_month') != ''){
            $employee_termination->applicable_month = $request->input('applicable_month');
        }

        if ($request->hasFile('upload')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $employee_termination->upload	 = $name;

            }
           

        }
        $employee_termination->status = 'approved';
 
        $employee_termination->user_id = 0;
       


        if($employee_termination->save()){
            $this->history_table('employee_deduction_histories', 'Add' , 0 , $employee_termination->id , 'hr_pro.view_employee_deduction');
            return \Redirect::route('admin.hr_pro.employee_deduction')->with('success', 'Data Added Sucessfully');
        }
        


    }

    public function update_employee_deduction(Request $request){
        $id =  (int)$request->input('id');
        $employee_termination = employee_deduction::where('id' , $id)->first();

        if($request->input('emp_id') != ''){
            $employee_termination->emp_id = $request->input('emp_id');

        }
        if($request->input('amount') != ''){
            $employee_termination->amount = $request->input('amount');

        }
        if($request->input('reason') != ''){
            $employee_termination->reason = $request->input('reason');

        }
        if($request->input('applicable_month') != ''){
            $employee_termination->applicable_month = $request->input('applicable_month');
        }

        if ($request->hasFile('upload')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $employee_termination->upload	 = $name;

            }
           

        }




        $employee_termination->status_message = $request->input('status_message');
        if( $employee_termination->user_id != 0){
            $user_id  = $employee_termination->user_id;
            
        }else{
            $user_id  = 0;
        }
        // dd($trade_license->action );

        if($employee_termination->action == null || $employee_termination->status == 'approved' ||$employee_termination->action == 'nill'){
            $employee_termination->action = 'edit';
        }

        $employee_termination->status = $request->input('status');


        $employee_termination->save();

        
        if($employee_termination->status == 'approved' || $user_id == 0 ){
            
            //  $this->history_table('trade_license_histories', $trade_license->action , $user_id);
             $this->history_table('employee_deduction_histories', $employee_termination->action , $user_id , $employee_termination->id , 'hr_pro.view_employee_deduction');
        }


        return \Redirect::route('admin.hr_pro.employee_deduction')->with('success', 'Data Updated Sucessfully');

    }

   
    public function delete_employee_deduction_status(Request $request){
        $id =  (int)$request->input('id');
        $employee_termination = employee_deduction::where('id' , $id)->first();

        $employee = Employee::find( $employee_termination->emp_id);

        
        // $this->history_table('employee_histories','Employee R Removed' , 0 ,  $employee->id, "hr_pro.view_employee");

        $employee_termination->status_message = $request->input('status_message');
        if( $employee_termination->user_id != 0){
            $user_id  = $employee_termination->user_id;
            
        }else{
            $user_id  = 0;
        }

        $employee_termination->row_status = 'deleted';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }

        // if($trade_license->action == null || $trade_license->status == 'approved'){
            $employee_termination->action = 'delete';
        // }

        
        $employee_termination->status = 'approved';
 
        if( $employee_termination->save()){

            // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
            $this->history_table('employee_deduction_histories', $employee_termination->action , $user_id , $employee_termination->id , 'hr_pro.view_employee_deduction');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_employee_deduction(Request $request){
        $id =  (int)$request->input('id');
        $employee_termination = employee_deduction::where('id' , $id)->first();
        
        $employee_termination->status_message = $request->input('status_message');
        if( $employee_termination->user_id != 0){
                        
        }else{
            $user_id  = 0;
        }

        $employee_termination->row_status = 'active';
        $employee_termination->status = 'approved';
        $employee_termination->action = 'restored';
        
        $employee_termination->save();
        // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
        $this->history_table('employee_deduction_histories', $employee_termination->action , $user_id , $employee_termination->id , 'hr_pro.view_employee_deduction');
 
        $employee_termination->action = 'deleted';
        $employee_termination->save();
           
            return response()->json(['status'=>'1']);
        
    }

    public function employee_attendence(){
        // $data['employee_deduction'] = employee_deduction::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();
        $data['employee'] = Employee::all();
        $data['attendance'] = Attendence::all();
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
        $data['view'] = 'admin.hr_pro.employee.attendance.attendance';
        return view('layout', ["data"=>$data]);
    }

     ///////////////////////////////////////
    ///////// Employee Leave /////////
    ///////////////////////////////////////

    public function employee_leave(){
        // $data['employee_deduction'] = employee_deduction::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();
        $data['employees'] = Employee::all();
        $data['leave'] = Leave::all();


        //dd($data['modules']);
        
        $data['page_title'] = "Leave Request";
        $data['view'] = 'admin.hr_pro.employee.attendance.leave.leave';
        return view('layout', ["data"=>$data]);
    }

    public function trash_employee_leave(){
        $data['modules']= DB::table('modules')->get();
        $data['leave'] = leave::all();
        $data['employees'] = Employee::all();
        // $data['leave'] = Leave::all();

        // dd( $data['customer_info']);
        $data['page_title'] = "Employee Leave Trash";
        $data['view'] = 'admin.hr_pro.employee.attendance.leave.deleted_data';
        return view('layout', ["data"=>$data]);
    }

    public function employee_leave_history(){

        $data['modules']= DB::table('modules')->get();
        
        $data['employees'] = Employee::all();


        $data['trade_licenses_history']= Leave_history::all();
        $data['table_name']= 'leave_histories';

        $data['page_title'] = "History | Employee Leave Request ";
        $data['view'] = 'admin.hr_pro.history';
        return view('layout', ["data"=>$data]);
    }

    public function add_employee_leave(){
        $data['modules']= DB::table('modules')->get();

        
        $data['employee'] = Employee::all();
        
        $data['page_title'] = "Add  Employee Leave";
        $data['view'] = 'admin.hr_pro.employee.attendance.leave.add_leave';
        return view('layout', ["data"=>$data]);
    }

    public function view_employee_leave(Request $request){
        $data['leave'] = leave::find($request->input('id'));
        $data['employees'] = Employee::all();

        $data['modules']= DB::table('modules')->get();

        
        $user = Auth::user();
        
        $data['page_title'] = "  Employee Leave Request";
        $data['view'] = 'admin.hr_pro.employee.attendance.leave.view_leave';
        return view('layout', ["data"=>$data]);
    }

    public function edit_employee_leave (Request $request){
        $data['leave'] = Leave::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();
        $data['employee'] = Employee::all();

        //dd($data['modules']);
        

        $data['page_title'] = "Edit Employee Leave";
        $data['view'] = 'admin.hr_pro.employee.attendance.leave.edit_leave';
        return view('layout', ["data"=>$data]);
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
        $leave->status = 'approved';
 
        $leave->user_id = 0;
       


        if($leave->save()){
            $this->history_table('leave_histories', 'Add' , 0 , $leave->id , 'hr_pro.view_employee_leave');
            return \Redirect::route('admin.hr_pro.employee_leave')->with('success', 'Data Added Sucessfully');
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




        $leave->status_message = $request->input('status_message');
        if( $leave->user_id != 0){
            $user_id  = $leave->user_id;
            
        }else{
            $user_id  = 0;
        }
        // dd($trade_license->action );

        if($leave->action == null || $leave->status == 'approved' ||$leave->action == 'nill'){
            $leave->action = 'edit';
        }

        $leave->status = $request->input('status');


        $leave->save();

        
        if($leave->status == 'approved' || $user_id == 0 ){
            
            //  $this->history_table('trade_license_histories', $trade_license->action , $user_id);
             $this->history_table('leave_histories', $leave->action , $user_id , $leave->id , 'hr_pro.view_employee_leave');
        }


        return \Redirect::route('admin.hr_pro.employee_leave')->with('success', 'Data Updated Sucessfully');

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

        $leave->row_status = 'deleted';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }

        // if($trade_license->action == null || $trade_license->status == 'approved'){
            $leave->action = 'delete';
        // }

        
        $leave->status = 'approved';
 
        if( $leave->save()){

            // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
            $this->history_table('leave_histories', $leave->action , $user_id , $leave->id , 'hr_pro.view_employee_leave');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_employee_leave(Request $request){
        $id =  (int)$request->input('id');
        $leave = leave::where('id' , $id)->first();
        
        $leave->status_message = $request->input('status_message');
        if( $leave->user_id != 0){
                        
        }else{
            $user_id  = 0;
        }

        $leave->row_status = 'active';
        $leave->status = 'pending';
        $leave->action = 'restored';
        
        $leave->save();
        // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
        $this->history_table('leave_histories', $leave->action , $user_id , $leave->id , 'hr_pro.view_employee_leave');
 
        $leave->action = 'deleted';
        $leave->save();
           
            return response()->json(['status'=>'1']);
        
    }

    public function employee_attendence_mark($date=null){
            // echo $date;
            $timestamp =  strtotime($date);
            // echo $date;
            $date = date('Y-m-d', $timestamp);
            // echo $date;
            
            $leave = leave::all();
        $data['modules']= DB::table('modules')->get();

            $data['employee'] = Employee::all();
            $data['date'] = $date;

        
            $data['page_title'] = "Attendance";
            $data['view'] = 'admin.hr_pro.employee.attendance.mark_attendance';
            return view('layout', ["data"=>$data]);
    }

    public function save_employee_attendance(Request $request){
        $str = $request->input('date');

        if (($timestamp = strtotime($str)) !== false)
        {
            $php_date = getdate($timestamp);
            // or if you want to output a date in year/month/day format:
            $date = date("Y/m/d", $timestamp); // see the date manual page for format options      
        }
        foreach($request->input('attendance') as $key => $value){
            $attendance = new Attendence;
            $attendance->emp_id = $key;
            $attendance->attendence_status = $value;
            $attendance->date = $date;
            $attendance->month =  date("m", $timestamp);
            $attendance->year =  date("Y", $timestamp);
            $attendance->marked_by = 'Admin';
            $attendance->row_status = 'active';
            $attendance->user_id = 0;

            if($value == 'a'){
                $attendance->status = 'pending'; 
                $absent  = new Absent;
                $absent->emp_id =  $key;
                $absent->date =  date("Y/m/d", $timestamp);
                $absent->status =  'pending';
                $absent->row_status = 'active';
                $absent->save();
                $this->history_table('absent_histories', 'add' , 0 , $absent->id , 'hr_pro.employee_attendence');

            }else{
                $attendance->status = 'approved'; 

            }
            $attendance->save();
            $this->history_table('attendence_histories', 'add' , 0 , $attendance->id , 'hr_pro.employee_attendence');

        }

        return \Redirect::route('admin.hr_pro.employee_attendence')->with('success', 'Data Added Sucessfully');

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

        $data['employee'] = Employee::all();
       
        $data['page_title'] = "Attendance Report";
        $data['view'] = 'admin.hr_pro.employee.attendance.attendance_report';
        return view('layout', ["data"=>$data]);
    }

    ///////////////////////////////////////
    ///////// Employee Funds Request /////////
    ///////////////////////////////////////

    public function employee_funds(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        
        $data['employee_funds'] = Funds_request::all();
        $data['employees'] = Employee::all();
        $data['page_title'] = "Funds Request";
        $data['view'] = 'admin.hr_pro.employee.funds.funds';
        return view('layout', ["data"=>$data]);
    }

    public function trash_employee_funds(){
        $data['modules']= DB::table('modules')->get();
        $data['employee_funds'] = Funds_request::all();
        $data['employees'] = Employee::all();

        // dd( $data['customer_info']);
        $data['page_title'] = "Funds Request Trash";
        $data['view'] = 'admin.hr_pro.employee.funds.deleted_data';
        return view('layout', ["data"=>$data]);
    }

    public function employee_funds_history(){

        $data['modules']= DB::table('modules')->get();
        
        $data['employees'] = Employee::all();

        $data['trade_licenses_history']= Funds_request_history::all();
        $data['table_name']= 'funds_request_histories';

        $data['page_title'] = "History | Funds Request ";
        $data['view'] = 'admin.hr_pro.history';
        return view('layout', ["data"=>$data]);
    }

    public function add_employee_funds(){
        $data['modules']= DB::table('modules')->get();

        
        $data['employee'] = Employee::all();
        $data['page_title'] = "New Funds Request";
        $data['view'] = 'admin.hr_pro.employee.funds.add_funds';
        return view('layout', ["data"=>$data]);
    }

    public function view_employee_funds(Request $request){
        $data['employee_funds'] = Funds_request::find($request->input('id'));
        $data['employees'] = Employee::all();

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        
        $data['page_title'] = "  Fund Request";
        $data['view'] = 'admin.hr_pro.employee.funds.view_funds';
        return view('layout', ["data"=>$data]);
    }

    public function edit_employee_funds (Request $request){
        $data['employee_funds'] = Funds_request::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();
        $data['employee'] = Employee::all();

        //dd($data['modules']);
        

        $data['page_title'] = "Edit Fund Request";
        $data['view'] = 'admin.hr_pro.employee.funds.edit_funds';
        return view('layout', ["data"=>$data]);
    }

    public function save_employee_funds(Request $request){

        $funds_request = new Funds_request;
        

        if($request->input('emp_id') != ''){
            $funds_request->emp_id = $request->input('emp_id');

        }
        if($request->input('amount') != ''){
            $funds_request->amount = $request->input('amount');

        }
        if($request->input('reason') != ''){
            $funds_request->reason = $request->input('reason');

        }
        

        if ($request->hasFile('proof')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->proof->getClientOriginalName());
            $file = $request->file('proof');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $funds_request->proof	 = $name;

            }
           

        }
        $funds_request->status = 'approved';
 
        $funds_request->user_id = 0;
       


        if($funds_request->save()){
            $this->history_table('funds_request_histories', 'Add' , 0 , $funds_request->id , 'hr_pro.view_employee_funds');
            return \Redirect::route('admin.hr_pro.employee_funds')->with('success', 'Data Added Sucessfully');
        }
        


    }

    public function update_employee_funds(Request $request){
        $id =  (int)$request->input('id');
        $funds_request = Funds_request::where('id' , $id)->first();

        if($request->input('emp_id') != ''){
            $funds_request->emp_id = $request->input('emp_id');

        }
        if($request->input('amount') != ''){
            $funds_request->amount = $request->input('amount');

        }
        if($request->input('reason') != ''){
            $funds_request->reason = $request->input('reason');

        }
       

        if ($request->hasFile('proof')) {

        
            $name = time().'_'.str_replace(" ", "_", $request->proof->getClientOriginalName());
            $file = $request->file('proof');
            if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
                $funds_request->proof	 = $name;

            }
           

        }




        $funds_request->status_message = $request->input('status_message');
        if( $funds_request->user_id != 0){
            $user_id  = $funds_request->user_id;
            
        }else{
            $user_id  = 0;
        }
        // dd($trade_license->action );

        if($funds_request->action == null || $funds_request->status == 'approved' ||$funds_request->action == 'nill'){
            $funds_request->action = 'edit';
        }

        $funds_request->status = $request->input('status');


        $funds_request->save();

        
        if($funds_request->status == 'approved' || $user_id == 0 ){
            
            //  $this->history_table('trade_license_histories', $trade_license->action , $user_id);
             $this->history_table('funds_request_histories', $funds_request->action , $user_id , $funds_request->id , 'hr_pro.view_employee_funds');
        }


        return \Redirect::route('admin.hr_pro.employee_funds')->with('success', 'Data Updated Sucessfully');

    }

   
    public function delete_employee_funds_status(Request $request){
        $id =  (int)$request->input('id');
        $employee_termination = Funds_request::where('id' , $id)->first();

        
        // $this->history_table('employee_histories','Employee R Removed' , 0 ,  $employee->id, "hr_pro.view_employee");

        $employee_termination->status_message = $request->input('status_message');
        if( $employee_termination->user_id != 0){
            $user_id  = $employee_termination->user_id;
            
        }else{
            $user_id  = 0;
        }

        $employee_termination->row_status = 'deleted';

       

      
        // if($trade_license->action == null || $trade_license->status == 'approved'){
            $employee_termination->action = 'delete';
        // }

        
        $employee_termination->status = 'pending';
 
        if( $employee_termination->save()){

            // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
            $this->history_table('funds_request_histories', $employee_termination->action , $user_id , $employee_termination->id , 'hr_pro.view_employee_funds');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_employee_funds(Request $request){
        $id =  (int)$request->input('id');
        $employee_termination = Funds_request::where('id' , $id)->first();
        
        $employee_termination->status_message = $request->input('status_message');
        if( $employee_termination->user_id != 0){
                        
        }else{
            $user_id  = 0;
        }

        $employee_termination->row_status = 'active';
        $employee_termination->status = 'pending';
        $employee_termination->action = 'restored';
        
        $employee_termination->save();
        // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
        $this->history_table('funds_request_histories', $employee_termination->action , $user_id , $employee_termination->id , 'hr_pro.view_employee_funds');
 
        $employee_termination->action = 'deleted';
        $employee_termination->save();
           
            return response()->json(['status'=>'1']);
        
    }

    //////////////////////////////////////
    ///////// Employee Complaints /////////
    ///////////////////////////////////////
    public function complaints(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        
        $data['complaints'] = Complaints::all();
        $data['employees'] = Employee::all();
        $data['page_title'] = "Complaints";
        $data['view'] = 'admin.hr_pro.employee.complaints.complaints';
        return view('layout', ["data"=>$data]);
    }

    public function trash_complaints(){
        $data['modules']= DB::table('modules')->get();
        $data['complaints'] = Complaints::all();
        $data['employees'] = Employee::all();

        // dd( $data['customer_info']);
        $data['page_title'] = "Complaints Trash";
        $data['view'] = 'admin.hr_pro.employee.complaints.deleted_data';
        return view('layout', ["data"=>$data]);
    }

    public function complaints_history(){

        $data['modules']= DB::table('modules')->get();
        
        $data['employees'] = Employee::all();

        $data['trade_licenses_history']= Complaints_history::all();
        $data['table_name']= 'complaints_histories';

        $data['page_title'] = "History | Complaints ";
        $data['view'] = 'admin.hr_pro.history';
        return view('layout', ["data"=>$data]);
    }

    public function add_complaints(){
        $data['modules']= DB::table('modules')->get();

        
        $data['employee'] = Employee::all();
        $data['page_title'] = "New Complaints";
        $data['view'] = 'admin.hr_pro.employee.complaints.add_complaints';
        return view('layout', ["data"=>$data]);
    }

    public function view_complaints(Request $request){
        $data['complaint'] = Complaints::find($request->input('id'));
        $data['employees'] = Employee::all();

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        
        $data['page_title'] = "View  Complaint";
        $data['view'] = 'admin.hr_pro.employee.complaints.view_complaints';
        return view('layout', ["data"=>$data]);
    }

    public function edit_complaints (Request $request){
        $data['complaint'] = Complaints::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();
        $data['employee'] = Employee::all();

        //dd($data['modules']);
        

        $data['page_title'] = "Edit Complaint";
        $data['view'] = 'admin.hr_pro.employee.complaints.edit_complaints';
        return view('layout', ["data"=>$data]);
    }

    public function save_complaints(Request $request){

        $Complaints = new Complaints;
        

        if($request->input('emp_id') != ''){
            $Complaints->emp_id = $request->input('emp_id');

        }
        if($request->input('admin_remarks') != ''){
            $Complaints->admin_remarks = $request->input('admin_remarks');

        }
         if($request->input('hr_remarks') != ''){
            $Complaints->hr_remarks = $request->input('hr_remarks');

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
        $Complaints->status = 'approved';
 
        $Complaints->user_id = 0;
       


        if($Complaints->save()){
            $this->history_table('complaints_histories', 'Add' , 0 , $Complaints->id , 'hr_pro.view_complaints');
            return \Redirect::route('admin.hr_pro.complaints')->with('success', 'Data Added Sucessfully');
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




        $Complaints->status_message = $request->input('status_message');
        if( $Complaints->user_id != 0){
            $user_id  = $Complaints->user_id;
            
        }else{
            $user_id  = 0;
        }
        // dd($trade_license->action );

        if($Complaints->action == null || $Complaints->status == 'approved' ||$Complaints->action == 'nill'){
            $Complaints->action = 'edit';
        }

        $Complaints->status = $request->input('status');


        $Complaints->save();

        
        if($Complaints->status == 'approved' || $user_id == 0 ){
            
            //  $this->history_table('trade_license_histories', $trade_license->action , $user_id);
             $this->history_table('Complaints_histories', $Complaints->action , $user_id , $Complaints->id , 'hr_pro.view_complaints');
        }


        return \Redirect::route('admin.hr_pro.complaints')->with('success', 'Data Updated Sucessfully');

    }

   
    public function delete_complaints_status(Request $request){
        $id =  (int)$request->input('id');
        $employee_termination = Complaints::where('id' , $id)->first();

        
        // $this->history_table('employee_histories','Employee R Removed' , 0 ,  $employee->id, "hr_pro.view_employee");

        $employee_termination->status_message = $request->input('status_message');
        if( $employee_termination->user_id != 0){
            $user_id  = $employee_termination->user_id;
            
        }else{
            $user_id  = 0;
        }

        $employee_termination->row_status = 'deleted';

       

      
        // if($trade_license->action == null || $trade_license->status == 'approved'){
            $employee_termination->action = 'delete';
        // }

        
        $employee_termination->status = 'pending';
 
        if( $employee_termination->save()){

            // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
            $this->history_table('complaints_histories', $employee_termination->action , $user_id , $employee_termination->id , 'hr_pro.view_complaints');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_complaints(Request $request){
        $id =  (int)$request->input('id');
        $employee_termination = Complaints::where('id' , $id)->first();
        
        $employee_termination->status_message = $request->input('status_message');
        if( $employee_termination->user_id != 0){
                        
        }else{
            $user_id  = 0;
        }

        $employee_termination->row_status = 'active';
        $employee_termination->status = 'pending';
        $employee_termination->action = 'restored';
        
        $employee_termination->save();
        // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
        $this->history_table('complaints_histories', $employee_termination->action , $user_id , $employee_termination->id , 'hr_pro.view_complaints');
 
        $employee_termination->action = 'deleted';
        $employee_termination->save();
           
            return response()->json(['status'=>'1']);
        
    }

    

}