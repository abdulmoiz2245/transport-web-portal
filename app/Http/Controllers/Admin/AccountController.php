<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\User;
use App\Models\Roles;
use App\Models\Permissions;
use App\Models\Company_name;
use App\Models\Approvals;

use App\Models\account_hr;
use App\Models\account_hr_edit_history;
use App\Models\account_hr_history;

use App\Models\account_purchase;
use App\Models\account_purchase_edit_history;
use App\Models\account_purchase_history;

use App\Models\account_3pl;
use App\Models\account_3pl_edit_history;
use App\Models\account_3pl_history;
use App\Models\Petty_finance_request;

use App\Models\Account_petty;
use App\Models\Petty;




use App\Models\Employee;
use App\Models\account_cheque;

// account_cheques

use App\Models\Purchase;
use App\Models\Purchase_vehicle;

use App\Models\Funds_request;
use App\Models\Petty_purchase;
use App\Models\Petty_hr;




use App\Models\Erp_department;


use Illuminate\Support\Facades\File;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth:admin');
    }

      /////////////////////////////////////
    ///////// remove table name /////////
    /////////////////////////////////////

    public function remove_table_name($table_name){
        $check = false;
        foreach (DB::table($table_name)->get() as $table_entries) {
        // dd($table_entries);
           
            if($table_entries->status == 'pending' || $table_entries->status == 'rejected'){
                $check = true;
            }
        }
        
        if(!$check){
            $approvals_table = Approvals::all();
            foreach ($approvals_table as $approvals) {
                if( $approvals->table_name == $table_name){
                    $approvals->delete();
                }
               
            }
        }
        return true;
    }

     /////////////////////////////////////
    ///////// History Record ///////////
    /////////////////////////////////////

    public function table_history_clear(Request $request){
        
        if(DB::table($request->input('table_name'))->truncate()){
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'1']);
        }
    }

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

    public function account(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['page_title'] = "Account";
        $data['view'] = 'admin.account.account';
        return view('layout', ["data"=>$data]);
    }

    /////////////////////////////////
    ///////// Approvarls /////////
    /////////////////////////////////

    public function approval(){

        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $purchase = Purchase::where('row_status','!=' ,'deleted')->get();
        $purchase_vehicle = Purchase_vehicle::where('row_status','!=' ,'deleted')->get();
        $data['purchase'] = $purchase->merge($purchase_vehicle);
        // dd($purchase_vehicle);

        $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
        $data['petty_funds'] = Petty_finance_request::where('row_status','!=' ,'deleted')->get();

 

        $data['page_title'] = "Accout Approvals";
        $data['view'] = 'admin.account.approval.approval';
        return view('layout', ["data"=>$data]);
    }

    public function trash_approval(){
        $data['modules']= DB::table('modules')->get();
        $data['purchase'] = Purchase::where('row_status','!=' ,'deleted')->get();
        $data['purchase'] = Funds_request::where('row_status','!=' ,'deleted')->get();
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "Accout Approvals Trash";
        $data['view'] = 'admin.account.approval.deleted_data';
        return view('layout', ["data"=>$data]);
    }

    public function approval_history(){

        // $data['modules']= DB::table('modules')->get();
        
        // $data['employees'] = Employee::all();

        // $data['trade_licenses_history']= Emmployee_approval_history::all();
        // $data['table_name']= 'emmployee_approval_histories';

        // $data['page_title'] = "History | Employee approval ";
        // $data['view'] = 'admin.hr_pro.history';
        // return view('layout', ["data"=>$data]);
    }

    public function add_approval(){
        //     $data['modules']= DB::table('modules')->get();

            
        //     $data['employee'] = Employee::all();
        //     $data['page_title'] = "Add  Employee approval";
        //     $data['view'] = 'admin.account.approval.add_approval';
        //     return view('layout', ["data"=>$data]);
    }

    public function view_approval(Request $request){
        // $data['approval'] = approval::find($request->input('id'));
        // $data['employees'] = Employee::all();

        // $data['modules']= DB::table('modules')->get();

        // //dd($data['modules']);
        // $user = Auth::user();
        
        // $data['page_title'] = "  Employee approval Request";
        // $data['view'] = 'admin.account.approval.view_approval';
        // return view('layout', ["data"=>$data]);
    }

    public function edit_approval (Request $request){
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        if($request->input('type') == 'purchase' ){

            $data['approval'] = Purchase::find($request->input('id'));


        }else if($request->input('type') == 'hr_funds' ){
            $data['approval'] = Funds_request::find($request->input('id'));

        }
        

        $data['modules']= DB::table('modules')->get();
        $data['employee'] = Employee::all();

        //dd($data['modules']);
        

        $data['page_title'] = "Edit Account Approvals";
        $data['view'] = 'admin.account.approval.edit_approval';
        return view('layout', ["data"=>$data]);
    }

    public function save_approval(Request $request){

        // $approval = new approval;
        // $employee = Employee::find($request->input('emp_id'));
        // $employee->employee_current_action = 'suspended';
        // $employee->employee_current_status = 'approved';
        // $employee->employee_current_status_reason = $request->input('remarks');
        // $employee->save();
        // $this->history_table('employee_histories','Employee Suspended' , 0 ,  $employee->id, "hr_pro.view_employee");

        // if($request->input('emp_id') != ''){
        //     $approval->emp_id = $request->input('emp_id');

        // }
        // if($request->input('remarks') != ''){
        //     $approval->remarks = $request->input('remarks');

        // }
        // if($request->input('date') != ''){
        //     $approval->date = $request->input('date');
        // }

        // if ($request->hasFile('upload')) {

        
        //     $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
        //     $file = $request->file('upload');
        //     if($file->storeAs('/main_admin/hr_pro/employee/main', $name , ['disk' => 'public_uploads'])){
        //         $approval->upload	 = $name;

        //     }
           

        // }
        // $approval->status = 'approved';
 
        // $approval->user_id = 0;
       


        // if($approval->save()){
        //     $this->history_table('emmployee_approval_histories', 'Add' , 0 , $approval->id , 'hr_pro.view_approval');
        //     return \Redirect::route('user.hr_pro.approval')->with('success', 'Data Added Sucessfully');
        // }
        


    }

    public function update_approval(Request $request){
        $id =  (int)$request->input('id');

        if($request->input('type') == 'purchase' ){
            // dd('called');
            $data['approval'] = Purchase::find($request->input('id'));
            if($request->input('status') == 'approved'){
                if($request->input('method') == 'vehicle'){
                    $purchase = Purchase_vehicle::where('id' , $id)->first();

                }else{
                    $purchase = purchase::where('id' , $id)->first();

                }

                
                $account_purchase = new account_purchase();
                $account_purchase->po_number = $purchase->po_number;
                $account_purchase->po_id = $purchase->id;
                $account_purchase->company = $purchase->company_id;
                $account_purchase->total_amount = $purchase->total_amount;
                $account_purchase->amount_paid = 0;
                $account_purchase->amount_remaning	 =  $purchase->total_amount;
                $account_purchase->status = 'not_paid';
                $account_purchase->row_status = 'active';
                $account_purchase->date = $purchase->date;
                $account_purchase->user_id = 0;

                $account_purchase->save();

                $purchase->status_account = 'approved';
                $purchase->save();

                if($account_purchase->save()){
                    $this->history_table('account_purchase_histories', 'Add' , 0 , $account_purchase->id , 'account.view_approval');

                    $this->history_table('purchase_histories', 'Purchase Approve From Account ' , 0,  $purchase->id , "purchase.view_purchase");

                    return \Redirect::route('admin.account.approval')->with('success', 'Data Updated Sucessfully');
                }

            }else{
                $purchase = purchase::where('id' , $id)->first();

                $purchase->status_account = $request->input('status');
                
                $purchase->save();
                if($request->input('method') == 'vehicle'){
                    $this->history_table('purchase_vehicle_histories', 'Status Change From Account' , 0,  $purchase->id , "purchase.view_purchase");

                }else{
                    $this->history_table('purchase_histories', 'Status Change From Account' , 0,  $purchase->id , "purchase.view_purchase");

                }

                return \Redirect::route('admin.account.approval')->with('success', 'Data Updated Sucessfully');
            }
        }else if($request->input('type') == 'hr_funds' ){
            $data['approval'] = Funds_request::find($request->input('id'));
            if($request->input('status') == 'approved'){
                $fund = Funds_request::where('id' , $id)->first();

                $account_hr = new account_hr();
                $account_hr->hr_fund_id = $fund->id;
                $account_hr->user_id = 0;

                // $account_hr->po_id = $fund->id;
                // $account_hr->company = $fund->company_id;
                $account_hr->total_amount = $fund->amount;
                $account_hr->amount_paid = 0;
                $account_hr->amount_remaning	 =  $fund->amount;
                $account_hr->status = 'not_paid';
                $account_hr->row_status = 'active';
                $account_hr->date = $fund->created_at;

                $account_hr->save();

                $fund->status = 'approved';
                $fund->save();

                if($account_hr->save()){
                    $this->history_table('account_hr_histories', 'Add' , 0 , $account_hr->id , 'account.view_approval');

                    $this->history_table('funds_request_histories', 'Funds Approve From Account ' , 0,  $fund->id , "hr_pro.view_employee_funds");

                    return \Redirect::route('admin.account.approval')->with('success', 'Data Updated Sucessfully');
                }
            }else{
                $fund = Funds_request::where('id' , $id)->first();

                $fund->status = $request->input('status');
                
                $fund->save();

                $this->history_table('funds_request_histories', 'Status Change From Account' , 0,  $fund->id , "hr_pro.view_employee_funds");

                return \Redirect::route('admin.account.approval')->with('success', 'Data Updated Sucessfully');
            }
        }else if($request->input('type') == 'petty_funds' ){
            $data['approval'] = Petty_finance_request::find($request->input('id'));
            if($request->input('status') == 'approved'){
                $fund = Petty_finance_request::where('id' , $id)->first();

                $account_hr = new Account_petty();
                $account_hr->petty_request_id = $fund->id;
                $account_hr->user_id = 0;

                
                $account_hr->total_amount = $fund->amount;
                $account_hr->amount_paid = 0;
                $account_hr->amount_remaning	 =  $fund->amount;
                $account_hr->status = 'not_paid';
                $account_hr->row_status = 'active';
                $account_hr->date = $fund->created_at;

                $account_hr->save();

                $fund->status = 'approved';
                $fund->save();

                if($account_hr->save()){
                    // $this->history_table('account_hr_histories', 'Add' , 0 , $account_hr->id , 'account.view_approval');

                    $this->history_table('petty_finance_request_histories', 'Funds Approve From Account ' , 0,  $fund->id , "petty.view_finance_request");

                    return \Redirect::route('admin.account.approval')->with('success', 'Data Updated Sucessfully');
                }
            }else{
                $fund = Funds_request::where('id' , $id)->first();

                $fund->status = $request->input('status');
                
                $fund->save();

                $this->history_table('petty_finance_request_histories', 'Status Change From Account' , 0,  $fund->id , "petty.view_finance_request");

                return \Redirect::route('admin.account.approval')->with('success', 'Data Updated Sucessfully');
            }
        }

    }

   
   public function payable_purchase(){
    $data['modules']= DB::table('modules')->get();
        
    $data['purchase'] = account_purchase::where('row_status','!=' ,'deleted')->get();
    // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();

    $user = Auth::user();

    $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

    $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

    $data['page_title'] = "Accout Payable Purchase";
    $data['view'] = 'admin.account.payable.purchase_payable';
    return view('layout', ["data"=>$data]);
   }

   public function payable_hr_fund(){
    $data['modules']= DB::table('modules')->get();
        
    $data['hr_fund'] = account_hr::where('row_status','!=' ,'deleted')->get();
    // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
    $user = Auth::user();

    $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

    $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();


    $data['page_title'] = "Accout Payable Hr Funds";
    $data['view'] = 'admin.account.payable.hr_payable';
    return view('layout', ["data"=>$data]);
   }

   public function payable_petty_fund(){
    $data['modules']= DB::table('modules')->get();
        
    $data['petty_fund'] = Account_petty::where('row_status','!=' ,'deleted')->get();
    // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
    $user = Auth::user();

    $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

    $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();


    $data['page_title'] = "Accout Payable Petty Funds";
    $data['view'] = 'admin.account.payable.petty_payable';
    return view('layout', ["data"=>$data]);
   }

   public function cheque_issue_purchase(Request $request){
        $purchase = account_purchase::find($request->input('id'));
        
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $purchase->amount_paid = $request->input('cheque_amount');

        $purchase->amount_remaning = (int)$purchase->amount_remaning - (int)$request->input('cheque_amount');

        if($purchase->amount_remaning > 0  ){
            $purchase->status = 'partial_paid';

            $account_purchase = new account_purchase();
            $account_purchase->po_number = $purchase->po_number;
            $account_purchase->po_id = $purchase->po_id;
            $account_purchase->company = $purchase->company_id;
            $account_purchase->total_amount = $purchase->total_amount;
            $account_purchase->amount_paid = 0 ;
            $account_purchase->amount_remaning = $purchase->amount_remaning;
            $account_purchase->status = 'not_paid';
            $account_purchase->row_status = 'active';
            $account_purchase->date = date('Y-m-d ');
            $account_purchase->user_id = 0;
            $account_purchase->save();

        }else{
            $purchase->status = 'paid';
        }

        $cheque = new account_cheque();
        $cheque->account_name = $request->input('account_name');
        $cheque->account_number = $request->input('account_number');
        $cheque->cheque_amount = $request->input('cheque_amount');
        $cheque->cheque_number = $request->input('cheque_number');
        $cheque->date = $request->input('date');
        $cheque->due_date = $request->input('due_date');
        $cheque->data_id = $purchase->po_id;
        $cheque->issued_to = 'purchase';

        $cheque->row_status =  'active';
        $cheque->status =  'not_cleared';



        if ($request->hasFile('upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/account/', $name , ['disk' => 'public_uploads'])){
                $cheque->upload = $name;

            }
            
        }
        $cheque->save();
        $purchase->cheque_id =  $cheque->id;
        $purchase->pay_by =  'cheque';

        $purchase->save();

        $this->history_table('account_purchase_histories', 'Cheque Id ( '. $cheque->id.' )  Issued' , 0 , $cheque->id , 'account.view_cheque');

        return \Redirect::route('admin.account.payable_purchase')->with('success', 'Cheque Issued');


   }

    public function cheque_issue_hr_fund(Request $request){
        $hr_fund = account_hr::find($request->input('id'));
        
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $hr_fund->amount_paid = $request->input('cheque_amount');

        $hr_fund->amount_remaning = (int)$hr_fund->amount_remaning - (int)$request->input('cheque_amount');

        if($hr_fund->amount_remaning > 0  ){
            $hr_fund->status = 'partial_paid';

            $account_hr_fund = new account_hr();
            $account_hr_fund->hr_fund_id = $hr_fund->hr_fund_id;
            $account_hr_fund->total_amount = $hr_fund->total_amount;
            $account_hr_fund->amount_paid = 0 ;
            $account_hr_fund->amount_remaning = $hr_fund->amount_remaning;
            $account_hr_fund->status = 'not_paid';
            $account_hr_fund->row_status = 'active';
            $account_hr_fund->date = $hr_fund->date;
            $account_hr_fund->user_id = 0;

            $account_hr_fund->save();

        }else{
            $hr_fund->status = 'paid';
        }

        $cheque = new account_cheque();
        $cheque->account_name = $request->input('account_name');
        $cheque->account_number = $request->input('account_number');
        $cheque->cheque_amount = $request->input('cheque_amount');
        $cheque->cheque_number = $request->input('cheque_number');
        $cheque->data_id = $hr_fund->hr_fund_id;
        $cheque->issued_to = 'hr_fund';


        $cheque->row_status =  'active';
        $cheque->status =  'not_cleared';
        $cheque->date = $request->input('date');
        $cheque->due_date = $request->input('due_date');



        if ($request->hasFile('upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/account/', $name , ['disk' => 'public_uploads'])){
                $cheque->upload = $name;

            }
            
        }
        $cheque->save();
        $hr_fund->cheque_id =  $cheque->id;
        $hr_fund->pay_by =  'cheque';
        $hr_fund->save();

        $this->history_table('account_hr_histories', 'Cheque Id ( '. $cheque->id.' )  Issued' , 0 , $cheque->id , 'account.view_cheque');

        return \Redirect::route('admin.account.payable_hr_fund')->with('success', 'Cheque Issued');


   }

   public function cheque_issue_petty_fund(Request $request){
        $petty_fund = Account_petty::find($request->input('id'));
        
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $petty_fund->amount_paid = $request->input('cheque_amount');

        $petty_fund->amount_remaning = (int)$petty_fund->amount_remaning - (int)$request->input('cheque_amount');

        if($petty_fund->amount_remaning > 0  ){
            $petty_fund->status = 'partial_paid';

            $account_petty_fund = new Account_petty();
            $account_petty_fund->petty_request_id
            = $petty_fund->petty_request_id
            ;
            $account_petty_fund->total_amount = $petty_fund->total_amount;
            $account_petty_fund->amount_paid = 0 ;
            $account_petty_fund->amount_remaning = $petty_fund->amount_remaning;
            $account_petty_fund->status = 'not_paid';
            $account_petty_fund->row_status = 'active';
            $account_petty_fund->date = $petty_fund->date;
            $account_petty_fund->user_id = 0;

            $account_petty_fund->save();

        }else{
            $petty_fund->status = 'paid';
        }

        $cheque = new account_cheque();
        $cheque->account_name = $request->input('account_name');
        $cheque->account_number = $request->input('account_number');
        $cheque->cheque_amount = $request->input('cheque_amount');
        $cheque->cheque_number = $request->input('cheque_number');
        $cheque->data_id = $petty_fund->petty_request_id;
        $cheque->issued_to = 'petty_fund';


        $cheque->row_status =  'active';
        $cheque->status =  'not_cleared';
        $cheque->date = $request->input('date');
        $cheque->due_date = $request->input('due_date');



        if ($request->hasFile('upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/account/', $name , ['disk' => 'public_uploads'])){
                $cheque->upload = $name;

            }
            
        }
        $cheque->save();
        $petty_fund->cheque_id =  $cheque->id;
        $petty_fund->save();

        $this->history_table('account_petty_histories', 'Cheque Id ( '. $cheque->id.' )  Issued' , 0 , $cheque->id , 'account.view_cheque');

        return \Redirect::route('admin.account.payable_petty_fund')->with('success', 'Cheque Issued');


   }

   

   //Cheque
    public function cheque(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['page_title'] = "Cheque";
        $data['view'] = 'admin.account.cheque.cheque';
        return view('layout', ["data"=>$data]);
    }

    public function cheque_purchase(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();
        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['cheque'] = account_cheque::where('row_status','!=' ,'deleted')->where('issued_to','=','purchase')->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();

        $data['page_title'] = "Cheque For Purchase";
        $data['view'] = 'admin.account.cheque.purchase_cheque';
        return view('layout', ["data"=>$data]);
    }

    public function cheque_petty(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();
        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['cheque'] = account_cheque::where('row_status','!=' ,'deleted')->where('issued_to','=','petty_fund')->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();

        $data['page_title'] = "Cheque For Petty";
        $data['view'] = 'admin.account.cheque.petty_cheque';
        return view('layout', ["data"=>$data]);
    }

    public function cheque_hr_fund(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['cheque'] = account_cheque::where('row_status','!=' ,'deleted')->where('issued_to','=','hr_fund')->get();

        
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();

        $data['page_title'] = "Cheque For Hr Funds";
        $data['view'] = 'admin.account.cheque.hr_cheque';
        return view('layout', ["data"=>$data]);
    }

    public function update_cheque(Request $request){
        $id =  (int)$request->input('id');
        $cheque = account_cheque::where('id' , $id)->first();

        if($request->input('type') == 'petty'){
           if($request->input('status') == 'cleard'){
               $petty = Petty::latest()->first();
               if($petty != null){
                   $new_petty = new Petty();
                   $new_petty->recived_amount  =  $cheque->cheque_amount;
                   $new_petty->total_amount  =  (float)$petty->total_amount + (float)$cheque->cheque_amount;

                   $new_petty->date  =  date('Y-m-d');
                   $new_petty->status  =  'approved';

                   $new_petty->row_status  =  'active';
                   $new_petty->user_id  =  0;
                   $new_petty->save();

               }else{

                    $new_petty = new Petty();
                    $new_petty->recived_amount  =  $cheque->cheque_amount;
                    $new_petty->total_amount  =  $new_petty->recived_amount;

                    $new_petty->date  =  date('Y-m-d');
                    $new_petty->status  =  'approved';

                    $new_petty->row_status  =  'active';
                    $new_petty->user_id  =  0;
                    $new_petty->save();
               }
           }
        }

        if($request->input('status') != ''){
            $cheque->status = $request->input('status');
        }

        if($request->input('reciving_date') != ''){
            $cheque->reciving_date = $request->input('reciving_date');
        }

        if ($request->hasFile('reciving')) {

            $name = time().'_'.str_replace(" ", "_", $request->reciving->getClientOriginalName());
            $file = $request->file('reciving');
            if($file->storeAs('/main_admin/account/', $name , ['disk' => 'public_uploads'])){
                $cheque->reciving = $name;

            }
            
        }
        $cheque->save();
        return \Redirect::route('admin.account.cheque')->with('success', 'Cheque Update');
    }

    public function  pay_by_petty_purchase(Request $request){
        $account_purchase = account_purchase::find($request->input('id'));
        
        $petty_purchase = new Petty_purchase();
        $petty_purchase->po_number = $account_purchase->po_number;
        $petty_purchase->po_id = $account_purchase->po_id;
        $petty_purchase->account_id = $account_purchase->id;
        $petty_purchase->date = $account_purchase->date;

        $petty_purchase->total_amount = $account_purchase->total_amount;
        $petty_purchase->amount_paid = $account_purchase->amount_paid;
        $petty_purchase->amount_remaning = $account_purchase->amount_remaning;
        $petty_purchase->status = 'not_paid';
        $petty_purchase->action = 'Add';
        $petty_purchase->row_status = 'active';

        $petty_purchase->user_id = 0;
        $petty_purchase->save();

        $account_purchase->status = 'paid';
        $account_purchase->pay_by = 'petty';

        if( $account_purchase->save()){
           
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }

        
    }

    public function  pay_by_petty_hr(Request $request){
        $account_purchase = account_hr::find($request->input('id'));
        
        $petty_purchase = new Petty_hr();
        $petty_purchase->hr_fund_id = $account_purchase->hr_fund_id;
        $petty_purchase->account_id = $account_purchase->id;
        $petty_purchase->date = $account_purchase->date;
        $petty_purchase->total_amount = $account_purchase->total_amount;
        $petty_purchase->amount_paid = $account_purchase->amount_paid;
        $petty_purchase->amount_remaning = $account_purchase->amount_remaning;
        $petty_purchase->status = 'not_paid';
        $petty_purchase->action = 'Add';
        $petty_purchase->row_status = 'active';

        $petty_purchase->user_id = 0;
        $petty_purchase->save();

        $account_purchase->status = 'paid';
        $account_purchase->pay_by = 'petty';

        if( $account_purchase->save()){
           
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }

        
    }

    public function view_cheque(Request $request){
        $id =  (int)$request->input('id');
        $data['cheque'] = account_cheque::where('id' , $id)->first();

        $data['modules']= DB::table('modules')->get();
            
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['page_title'] = "View Cheque ";
        $data['view'] = 'admin.account.cheque.view_cheque';
        return view('layout', ["data"=>$data]);
        
    } 

    //paid account
    public function paid_purchase(){
        $data['modules']= DB::table('modules')->get();
            
        $data['purchase'] = account_purchase::where('row_status','!=' ,'deleted')->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();

        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['page_title'] = "Accout Paid Purchase";
        $data['view'] = 'admin.account.paid.purchase_paid';
        return view('layout', ["data"=>$data]);
    }
    
    public function paid_hr_fund(){
        $data['modules']= DB::table('modules')->get();
            
        $data['hr_fund'] = account_hr::where('row_status','!=' ,'deleted')->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();


        $data['page_title'] = "Accout Paid Hr Funds";
        $data['view'] = 'admin.account.paid.hr_paid';
        return view('layout', ["data"=>$data]);
    }
}