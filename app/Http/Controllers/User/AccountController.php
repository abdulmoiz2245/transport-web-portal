<?php

namespace App\Http\Controllers\User;
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

use App\Models\account_invoice;
use App\Models\account_invoice_history;


use App\Models\account_3pl;
use App\Models\account_3pl_edit_history;
use App\Models\account_3pl_history;
use App\Models\Petty_finance_request;
use App\Models\Purchase_mertial_data;
use App\Models\Account_petty;
use App\Models\Petty;
use App\Models\Booking;

use App\Models\account_booking;
use App\Models\Petty_booking;




use App\Models\Fuel_transfer;
use App\Models\Inventory_spare_parts;
use App\Models\Inventory_spare_parts_entery;
use App\Models\Inventory_spare_parts_entery_history;
use App\Models\Inventory_Tyre;
use App\Models\Inventory_tools_entry;
use App\Models\Inventory_tools;
use App\Models\Inventory_uncategorized;
use App\Models\Inventory_uncategorized_history;
use App\Models\Inventory_vehicle;



use App\Models\Vehicle;

use App\Models\Employee;
use App\Models\Customer_info;
use App\Models\Customer_rate_card;


use App\Models\account_cheque;
// use App\Models\account_booking;
use App\Models\account_booking_history;


// account_cheques

use App\Models\Purchase;
use App\Models\Purchase_vehicle;

use App\Models\Funds_request;
use App\Models\Petty_purchase;
use App\Models\Petty_hr;

//invoice
use App\Models\invoice;
use App\Models\invoice_history;
use App\Models\invoice_location;




use App\Models\Erp_department;


use Illuminate\Support\Facades\File;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth:user');
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
        $data['view'] = 'account.account';
        return view('users.layout', ["data"=>$data]);
    }

    /////////////////////////////////
    ///////// Approvarls /////////
    /////////////////////////////////

    public function approval(){

        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['purchase'] = Purchase::where('row_status','!=' ,'deleted')->get();
        $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
        $data['petty_funds'] = Petty_finance_request::where('row_status','!=' ,'deleted')->get();
        $data['booking'] = Booking::where('row_status','!=' ,'deleted')->get();

 

        $data['page_title'] = "Accout Approvals";
        $data['view'] = 'account.approval.approval';
        return view('users.layout', ["data"=>$data]);
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
        $data['view'] = 'account.approval.deleted_data';
        return view('users.layout', ["data"=>$data]);
    }

    public function approval_history(){

        // $data['modules']= DB::table('modules')->get();
        
        // $data['employees'] = Employee::all();

        // $data['trade_licenses_history']= Emmployee_approval_history::all();
        // $data['table_name']= 'emmployee_approval_histories';

        // $data['page_title'] = "History | Employee approval ";
        // $data['view'] = 'hr_pro.history';
        // return view('users.layout', ["data"=>$data]);
    }

    public function add_approval(){
        //     $data['modules']= DB::table('modules')->get();

            
        //     $data['employee'] = Employee::all();
        //     $data['page_title'] = "Add  Employee approval";
        //     $data['view'] = 'account.approval.add_approval';
        //     return view('users.layout', ["data"=>$data]);
    }

    public function view_approval(Request $request){
        // $data['approval'] = approval::find($request->input('id'));
        // $data['employees'] = Employee::all();

        // $data['modules']= DB::table('modules')->get();

        // //dd($data['modules']);
        // $user = Auth::user();
        
        // $data['page_title'] = "  Employee approval Request";
        // $data['view'] = 'account.approval.view_approval';
        // return view('users.layout', ["data"=>$data]);
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
        $data['view'] = 'account.approval.edit_approval';
        return view('users.layout', ["data"=>$data]);
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
                $purchase = purchase::where('id' , $id)->first();

                
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
                $account_purchase->user_id = Auth::id();

                $account_purchase->save();

                $purchase->status_account = 'approved';
                $purchase->save();

                if($account_purchase->save()){
                    $this->history_table('account_purchase_histories', 'Add' , Auth::id() , $account_purchase->id , 'account.view_approval');

                    $this->history_table('purchase_histories', 'Purchase Approve From Account ' , Auth::id(),  $purchase->id , "purchase.view_purchase");

                    return \Redirect::route('user.account.approval')->with('success', 'Data Updated Sucessfully');
                }

            }else{
                $purchase = purchase::where('id' , $id)->first();

                $purchase->status_account = $request->input('status');
                
                $purchase->save();

                $this->history_table('purchase_histories', 'Status Change From Account' , Auth::id(),  $purchase->id , "purchase.view_purchase");

                return \Redirect::route('user.account.approval')->with('success', 'Data Updated Sucessfully');
            }
        }else if($request->input('type') == 'hr_funds' ){
            $data['approval'] = Funds_request::find($request->input('id'));
            if($request->input('status') == 'approved'){
                $fund = Funds_request::where('id' , $id)->first();

                $account_hr = new account_hr();
                $account_hr->hr_fund_id = $fund->id;
                $account_hr->user_id = Auth::id();

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
                    $this->history_table('account_hr_histories', 'Add' , Auth::id() , $account_hr->id , 'account.view_approval');

                    $this->history_table('funds_request_histories', 'Funds Approve From Account ' , Auth::id(),  $fund->id , "hr_pro.view_employee_funds");

                    return \Redirect::route('user.account.approval')->with('success', 'Data Updated Sucessfully');
                }
            }else{
                $fund = Funds_request::where('id' , $id)->first();

                $fund->status = $request->input('status');
                
                $fund->save();

                $this->history_table('funds_request_histories', 'Status Change From Account' , Auth::id(),  $fund->id , "hr_pro.view_employee_funds");

                return \Redirect::route('user.account.approval')->with('success', 'Data Updated Sucessfully');
            }
        }else if($request->input('type') == 'petty_funds' ){
            $data['approval'] = Petty_finance_request::find($request->input('id'));
            if($request->input('status') == 'approved'){
                $fund = Petty_finance_request::where('id' , $id)->first();

                $account_hr = new Account_petty();
                $account_hr->petty_request_id = $fund->id;
                $account_hr->user_id = Auth::id();

                
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

                    $this->history_table('petty_finance_request_histories', 'Funds Approve From Account ' , Auth::id(),  $fund->id , "petty.view_finance_request");

                    return \Redirect::route('user.account.approval')->with('success', 'Data Updated Sucessfully');
                }
            }else{
                $fund = Funds_request::where('id' , $id)->first();

                $fund->status = $request->input('status');
                
                $fund->save();

                $this->history_table('petty_finance_request_histories', 'Status Change From Account' , Auth::id(),  $fund->id , "petty.view_finance_request");

                return \Redirect::route('user.account.approval')->with('success', 'Data Updated Sucessfully');
            }
        }else if($request->input('type') == 'booking' ){
            $data['approval'] = booking::find($request->input('id'));
            if($request->input('status') == 'approved'){
                $fund = booking::where('id' , $id)->first();

                if($fund->toll_charges > 0){
                    $account_booking = new account_booking();
                    // $account_booking->hr_fund_id = $fund->id;
                    $account_booking->user_id = 0;
                    $account_booking->type = 'toll_charges';
    
                    $account_booking->total_amount = $fund->toll_charges;
                    $account_booking->amount_paid = 0;
                    $account_booking->amount_remaning	 =  $fund->toll_charges;
                    $account_booking->status = 'not_paid';
                    $account_booking->row_status = 'active';
                    $account_booking->booking_date = $fund->booking_date;
                    $account_booking->job_id = $fund->id;
    
                    $account_booking->save();
                }
                if($fund->gate_charges > 0){
                    $account_booking = new account_booking();
                    // $account_booking->hr_fund_id = $fund->id;
                    $account_booking->user_id = 0;
                    $account_booking->type = 'gate_charges';
                    $account_booking->job_id = $fund->id;
    
                    $account_booking->total_amount = $fund->gate_charges;
                    $account_booking->amount_paid = 0;
                    $account_booking->amount_remaning	 =  $fund->gate_charges;
                    $account_booking->status = 'not_paid';
                    $account_booking->row_status = 'active';
                    $account_booking->booking_date = $fund->booking_date;
    
                    $account_booking->save();
                }
                if($fund->labour_charges > 0){
                    $account_booking = new account_booking();
                    // $account_booking->hr_fund_id = $fund->id;
                    $account_booking->user_id = 0;
                    $account_booking->type = 'labour_charges';
                    $account_booking->job_id = $fund->id;
    
                    $account_booking->total_amount = $fund->labour_charges;
                    $account_booking->amount_paid = 0;
                    $account_booking->amount_remaning	 =  $fund->labour_charges;
                    $account_booking->status = 'not_paid';
                    $account_booking->row_status = 'active';
                    $account_booking->booking_date = $fund->booking_date;
    
                    $account_booking->save();
                }
                if($fund->border_charges > 0){
                    $account_booking = new account_booking();
                    // $account_booking->hr_fund_id = $fund->id;
                    $account_booking->user_id = 0;
                    $account_booking->type = 'border_charges';
                    $account_booking->job_id = $fund->id;
    
                    $account_booking->total_amount = $fund->border_charges;
                    $account_booking->amount_paid = 0;
                    $account_booking->amount_remaning	 =  $fund->border_charges;
                    $account_booking->status = 'not_paid';
                    $account_booking->row_status = 'active';
                    $account_booking->booking_date = $fund->booking_date;
    
                    $account_booking->save();
                }
                if($fund->other_charges > 0){
                    $account_booking = new account_booking();
                    // $account_booking->hr_fund_id = $fund->id;
                    $account_booking->user_id = 0;
                    $account_booking->type = 'other_charges';
                    $account_booking->job_id = $fund->id;
    
                    $account_booking->total_amount = $fund->other_charges;
                    $account_booking->amount_paid = 0;
                    $account_booking->amount_remaning	 =  $fund->other_charges;
                    $account_booking->status = 'not_paid';
                    $account_booking->row_status = 'active';
                    $account_booking->booking_date = $fund->booking_date;
    
                    $account_booking->save();
                }

                $fund->status = 'approved';
                $fund->pending_by = 'clear';

                $fund->save();

                if($account_booking->save()){
                    $this->history_table('account_booking_histories', 'Add' , 0 , $account_booking->id , 'account.view_approval');

                    $this->history_table('booking_histories', 'Booking Approved From Account ' , 0,  $fund->id , "operations.view_booking");

                    return \Redirect::route('account.approval')->with('success', 'Data Updated Sucessfully');
                }
            }else{
                $fund = booking::where('id' , $id)->first();

                $fund->status = $request->input('status');
                
                $fund->save();

                $this->history_table('booking_histories', 'Status Change From Account' , 0,  $fund->id , "operations.view_booking");

                return \Redirect::route('account.approval')->with('success', 'Data Updated Sucessfully');
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
    $data['view'] = 'account.payable.purchase_payable';
    return view('users.layout', ["data"=>$data]);
   }

   public function payable_booking(){
    $data['modules']= DB::table('modules')->get();
        
    $data['booking'] = account_booking::where('row_status','!=' ,'deleted')->get();
    // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();

    $user = Auth::user();

    $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

    $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

    $data['page_title'] = "Accout Payable Booking";
    $data['view'] = 'account.payable.booking_payable';
    return view('users.layout', ["data"=>$data]);
   }

   public function payable_hr_fund(){
    $data['modules']= DB::table('modules')->get();
        
    $data['hr_fund'] = account_hr::where('row_status','!=' ,'deleted')->get();
    // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
    $user = Auth::user();

    $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

    $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();


    $data['page_title'] = "Accout Payable Hr Funds";
    $data['view'] = 'account.payable.hr_payable';
    return view('users.layout', ["data"=>$data]);
   }

   public function payable_petty_fund(){
    $data['modules']= DB::table('modules')->get();
        
    $data['petty_fund'] = Account_petty::where('row_status','!=' ,'deleted')->get();
    // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
    $user = Auth::user();

    $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

    $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();


    $data['page_title'] = "Accout Payable Petty Funds";
    $data['view'] = 'account.payable.petty_payable';
    return view('users.layout', ["data"=>$data]);
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
            $account_purchase->user_id = Auth::id();
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

        return \Redirect::route('user.account.payable_purchase')->with('success', 'Cheque Issued');


   }

   public function cheque_issue_booking(Request $request){
        $purchase = account_booking::find($request->input('id'));
        
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $purchase->amount_paid = $request->input('cheque_amount');

        $purchase->amount_remaning = (int)$purchase->amount_remaning - (int)$request->input('cheque_amount');

        if($purchase->amount_remaning > 0  ){
            $purchase->status = 'partial_paid';

            $account_purchase = new account_booking();
            $account_purchase->job_id = $purchase->job_id;
            // $account_purchase->po_id = $purchase->po_id;
            // $account_purchase->company = $purchase->company_id;
            $account_purchase->total_amount = $purchase->total_amount;
            $account_purchase->amount_paid = 0 ;
            $account_purchase->booking_date = $purchase->booking_date ;

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
        $cheque->data_id = $purchase->job_id;
        $cheque->issued_to = 'booking';

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

        $this->history_table('account_booking_histories', 'Cheque Id ( '. $cheque->id.' )  Issued' , 0 , $cheque->id , 'account.view_cheque');

        return \Redirect::route('user.account.payable_booking')->with('success', 'Cheque Issued For Booking');


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
            $account_hr_fund->user_id = Auth::id();

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

        return \Redirect::route('user.account.payable_hr_fund')->with('success', 'Cheque Issued');


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
            $account_petty_fund->user_id = Auth::id();

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

        $this->history_table('account_petty_histories', 'Cheque Id ( '. $cheque->id.' )  Issued' , Auth::id() , $cheque->id , 'account.view_cheque');

        return \Redirect::route('user.account.payable_petty_fund')->with('success', 'Cheque Issued');


   }

   

    //Cheque
    public function cheque(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['page_title'] = "Cheque";
        $data['view'] = 'account.cheque.cheque';
        return view('users.layout', ["data"=>$data]);
    }

    public function cheque_purchase(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();
        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['cheque'] = account_cheque::where('row_status','!=' ,'deleted')->where('issued_to','=','purchase')->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();

        $data['page_title'] = "Cheque For Purchase";
        $data['view'] = 'account.cheque.purchase_cheque';
        return view('users.layout', ["data"=>$data]);
    }

    public function cheque_booking(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();
        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['cheque'] = account_cheque::where('row_status','!=' ,'deleted')->where('issued_to','=','booking')->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();

        $data['page_title'] = "Cheque For Booking";
        $data['view'] = 'account.cheque.booking_cheque';
        return view('users.layout', ["data"=>$data]);
    }

    public function cheque_petty(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();
        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['cheque'] = account_cheque::where('row_status','!=' ,'deleted')->where('issued_to','=','petty_fund')->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();

        $data['page_title'] = "Cheque For Petty";
        $data['view'] = 'account.cheque.petty_cheque';
        return view('users.layout', ["data"=>$data]);
    }

    public function cheque_hr_fund(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['cheque'] = account_cheque::where('row_status','!=' ,'deleted')->where('issued_to','=','hr_fund')->get();

        
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();

        $data['page_title'] = "Cheque For Hr Funds";
        $data['view'] = 'account.cheque.hr_cheque';
        return view('users.layout', ["data"=>$data]);
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
                   $new_petty->user_id  =  Auth::id();
                   $new_petty->save();

               }else{

                    $new_petty = new Petty();
                    $new_petty->recived_amount  =  $cheque->cheque_amount;
                    $new_petty->total_amount  =  $new_petty->recived_amount;

                    $new_petty->date  =  date('Y-m-d');
                    $new_petty->status  =  'approved';

                    $new_petty->row_status  =  'active';
                    $new_petty->user_id  =  Auth::id();
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
        return \Redirect::route('user.account.cheque')->with('success', 'Cheque Update');
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

        $petty_purchase->user_id = Auth::id();
        $petty_purchase->save();

        $account_purchase->status = 'paid';
        $account_purchase->pay_by = 'petty';

        if( $account_purchase->save()){
           
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }

        
    }

    public function  pay_by_petty_booking(Request $request){
        $account_booking = account_booking::find($request->input('id'));
        
        $petty_booking = new Petty_booking();
        $petty_booking->job_id = $account_booking->job_id;
        // $petty_booking->po_id = $account_booking->po_id;
        $petty_booking->account_id = $account_booking->id;
        $petty_booking->booking_date = $account_booking->booking_date;

        $petty_booking->total_amount = $account_booking->total_amount;
        $petty_booking->amount_paid = $account_booking->amount_paid;
        $petty_booking->amount_remaning = $account_booking->amount_remaning;
        $petty_booking->status = 'not_paid';
        $petty_booking->action = 'Add';
        $petty_booking->row_status = 'active';

        $petty_booking->user_id = 0;
        $petty_booking->save();

        $account_booking->status = 'paid';
        $account_booking->pay_by = 'petty';

        if( $account_booking->save()){
           
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

        $petty_purchase->user_id = Auth::id();
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
        $data['view'] = 'account.cheque.view_cheque';
        return view('users.layout', ["data"=>$data]);
        
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
        $data['view'] = 'account.paid.purchase_paid';
        return view('users.layout', ["data"=>$data]);
    }
    
    public function paid_hr_fund(){
        $data['modules']= DB::table('modules')->get();
            
        $data['hr_fund'] = account_hr::where('row_status','!=' ,'deleted')->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();


        $data['page_title'] = "Accout Paid Hr Funds";
        $data['view'] = 'account.paid.hr_paid';
        return view('users.layout', ["data"=>$data]);
    }

    //invoice

    public function invoice(){
        $data['modules']= DB::table('modules')->get();
            
        $data['purchase'] = account_purchase::where('row_status','!=' ,'deleted')->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();

        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['customer'] = Customer_info::where('type' , '=' ,'permanent')->where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();

        $data['page_title'] = "Invoice";
        $data['view'] = 'account.invoice.invoice';
        return view('users.layout', ["data"=>$data]);
    }

    public function all_invoice(){
        $data['modules']= DB::table('modules')->get();
            
        $data['purchase'] = account_purchase::where('row_status','!=' ,'deleted')->get();
        $data['invoice'] = invoice::where('row_status','!=' ,'deleted')->get();
        $data['vehicle'] = vehicle::where('row_status','!=' ,'deleted')->get();
        $data['company_names'] = Company_name::all();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();

        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['customer'] = Customer_info::where('type' , '=' ,'permanent')->where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();

        $data['page_title'] = "All Invoice";
        $data['view'] = 'account.invoice.all_invoice';
        return view('users.layout', ["data"=>$data]);
    }

    public function invoice_approval(){
        $data['modules']= DB::table('modules')->get();
            
        $data['invoice'] = invoice::where('row_status','!=' ,'deleted')->get();
        // dd($data['invoice']);
        $data['vehicle'] = vehicle::where('row_status','!=' ,'deleted')->get();
        $data['company_names'] = Company_name::all();

        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['customer'] = Customer_info::where('type' , '=' ,'permanent')->where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();

        $data['page_title'] = "Invoice Approval";
        $data['view'] = 'account.invoice.invoice_approval';
        return view('users.layout', ["data"=>$data]);
    }

    public function new_invoice(Request $request){
        $user = Auth::user();
        $customer_id = (int)$request->input('customer_id');
        $customer_rate_card_id = (int)$request->input('customer_rate_card_id');

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 37)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['modules']= DB::table('modules')->get();
        
        $data['company_names'] =  Company_name::all();


        $data['customer'] = Customer_info::where('id' , '=' ,$customer_id)->where('type' , '=' ,'permanent')->where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->first();

        $data['booking'] = booking::where('customer_id' , '=' , $customer_id )->where('row_status' , '!=' , 'deleted')->where('booking_date' , '>='  ,$request->input('start_date'))->where('booking_date', '<=' , $request->input('end_date') )
        ->where('booking_status' , '=' , 'closed')->where('pending_by' ,'=', 'clear')->where('invoice_status' , '0')->get();

        $data['from_date'] = $request->input('start_date');
        $data['to_date'] = $request->input('end_date');


        $data['customer_rate_card'] = Customer_rate_card::where('customer_id' , '=' ,$customer_id)->get();
        // dd( $data['customer_rate_card']);

        // $data['sub_contractor'] = Sub_contractor_info::where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();
        //dd($data['modules']);
        $data['vehicle'] = Vehicle::where('registration_type' ,'=' , 'vehicle')->where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();
        // dd($data['custome/r']);
        // $data['sub_contractor_vehicle'] = Vehicle::where('registration_type' ,'=' , 'vehicle')->where('sub_contractor_id' ,'!=' , '')->where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();
        $data['trailer'] = Vehicle::where('registration_type' ,'=' , 'trailer')->where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();
        
        // $data['page']

        $data['page_title'] = "New Invoice";
        $data['view'] = 'account.invoice.new_invoice';
        return view('users.layout', ["data"=>$data]);

    } 

    public function view_invoice(Request $request){
        $user = Auth::user();
        $invoice_id = (int)$request->input('id');
        $data['invoice'] = invoice::find( $invoice_id);
        $customer_id = $data['invoice']->customer_id ;
        $data['customer'] = customer_info::find( $invoice_id);


        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 37)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['modules']= DB::table('modules')->get();
        
        $data['company_names'] =  Company_name::all();



        $data['booking'] = invoice_location::where('invoice_id' , '=' , $invoice_id )->get();

        $data['vehicle'] = Vehicle::where('registration_type' ,'=' , 'vehicle')->where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();
        $data['trailer'] = Vehicle::where('registration_type' ,'=' , 'trailer')->where('row_status' ,'=' , 'active')->where('status' ,'=' , 'approved')->get();
        

        $data['page_title'] = "New Invoice";
        $data['view'] = 'account.invoice.view_invoice';
        return view('users.layout', ["data"=>$data]);

    } 

    public function save_invoice(Request $request){
        // dd($request->input('job_id'));
        $invoice = new invoice();

        if($request->input('invoice_no') != ''){
            $invoice->invoice_no = $request->input('invoice_no');
        }
        if($request->input('company_id') != ''){
            $invoice->company_id = $request->input('company_id');
        }

        $invoice->date = date('Y-m-d');

        if($request->input('customer_id') != ''){
            $invoice->customer_id = $request->input('customer_id');
        }

        if($request->input('customer_name') != ''){
            $invoice->customer_name = $request->input('customer_name');
        }

        if($request->input('trn') != ''){
            $invoice->trn = $request->input('trn');
        }

        if($request->input('from_date') != ''){
            $invoice->from_date = $request->input('from_date');
        }

        if($request->input('to_date') != ''){
            $invoice->to_date = $request->input('to_date');
        }

        if($request->input('sub_total_amount') != ''){
            $invoice->sub_total_amount = $request->input('sub_total_amount');
        }

        if($request->input('vat_amount') != ''){
            $invoice->vat_amount = $request->input('vat_amount');
        }
        
        if($request->input('grand_total') != ''){
            $invoice->grand_total = $request->input('grand_total');
        }

        
        

        $invoice->remaning_amount = (int)$request->input('grand_total');
        $invoice->recived_amount = 0;
        $invoice->invoice_status = 0;
        $invoice->row_status = 'active';


        if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }

        $invoice->status = 'pending';
        $invoice->user_id = $user_id;

        $invoice->account_status = '0';


        if($invoice->save()){
            for($i=0 ; $i < count($request->input('job_id')) ; $i++){
                $invoice_location = new invoice_location();
                $invoice_location->invoice_id = $invoice->id;
                $invoice_location->job_id = $request->input('job_id')[$i];
                $invoice_location->from_location = $request->input('from_location')[$i];
                $invoice_location->to_location = $request->input('to_location')[$i];
                $invoice_location->loading_date = $request->input('loading_date')[$i];
                $invoice_location->offloading_date = $request->input('offloading_date')[$i];
                $invoice_location->booking_date = $request->input('offloading_date')[$i];
                $invoice_location->vehicle_id = $request->input('vehicle_id')[$i];
                $invoice_location->detention_type = $request->input('detention_type')[$i];
                $invoice_location->detention_rate = $request->input('detention_rate')[$i];
                $invoice_location->detention_duration = $request->input('detention_duration')[$i];
               
                $invoice_location->toll_charges = $request->input('toll_charges')[$i];
                $invoice_location->gate_charges = $request->input('gate_charges')[$i];
                $invoice_location->labour_charges = $request->input('labour_charges')[$i];
                $invoice_location->border_charges = $request->input('border_charges')[$i];
                $invoice_location->other_charges = $request->input('other_charges')[$i];
                $invoice_location->other_charges_description = $request->input('other_charges_description')[$i];
                $invoice_location->job_price = $request->input('job_price')[$i];
                $invoice_location->total_amount = $request->input('total_amount')[$i];
                $invoice_location->row_status = 'active';


                if($invoice_location->save()){
                    $booking = booking::find($request->input('job_id')[$i]);
                    $booking->invoice_status = 1;

                    
                    // dd($booking);
                    if($booking->save()){
                        $this->history_table('booking_histories', 'Invoice Id ( '. $invoice->id.' )  Created against Job Id ('. $invoice_location->job_id .')' , $user_id , $invoice->id , 'account.view_invoice');

                    }

                }


            }
                $account_invoice = new account_invoice();
                $account_invoice->invoice_id = $invoice->id;
                $account_invoice->invoice_no = $invoice->invoice_no;

                $account_invoice->user_id = 0;

                // $account_invoice->po_id = $fund->id;
                // $account_invoice->company = $fund->company_id;
                $account_invoice->total_amount = $invoice->grand_total;
                $account_invoice->amount_recived = 0;
                $account_invoice->amount_remaning	 =  $invoice->grand_total;
                $account_invoice->status = 'not_recived';
                $account_invoice->row_status = 'active';
                $account_invoice->date = $invoice->date;

                $account_invoice->save();


            $this->history_table('invoice_histories', 'Invoice Id ( '. $invoice->id.' )  Created' , $user_id , $invoice->id , 'account.view_invoice');
            return \Redirect::route('user.account.invoice')->with('success', 'Cheque Issued');
        }

        return \Redirect::route('user.account.invoice')->with('Error', 'Invoice Not Created');


    }

    public function update_invoice(Request $request){
        // dd($request->input('job_id'));
        $invoice =  invoice::find((int)$request->input('invoice_id'));
        #
        $check = false;
        if($request->input('invoice_no') != '' && $request->input('invoice_no') !=  $invoice->invoice_no ){
            $invoice->invoice_no = $request->input('invoice_no');
            $check = true;
        }
        if($request->input('company_id') != ''){
            $invoice->company_id = $request->input('company_id');
        }

        if($request->input('date') != ''){
            $invoice->date = $request->input('date');
        }


        if($request->input('customer_id') != ''){
            $invoice->customer_id = $request->input('customer_id');

        }

        if($request->input('customer_name') != ''){
            $invoice->customer_name = $request->input('customer_name');

        }

        if($request->input('trn') != ''){
            $invoice->trn = $request->input('trn');
        }

        if($request->input('from_date') != ''){
            $invoice->from_date = $request->input('from_date');
        }

        if($request->input('to_date') != ''){
            $invoice->to_date = $request->input('to_date');
        }

        if($request->input('sub_total_amount') != ''){
            $invoice->sub_total_amount = $request->input('sub_total_amount');
        }

        if($request->input('vat_amount') != ''){
            $invoice->vat_amount = $request->input('vat_amount');
        }
        
        if($request->input('grand_total') != ''){
            $invoice->grand_total = $request->input('grand_total');
        }

        
        

        $invoice->remaning_amount = (int)$request->input('grand_total');
        $invoice->recived_amount = 0;
        $invoice->invoice_status = 0;
        $invoice->row_status = 'active';


        if(Auth::guard('user')->check()){
            $user_id = Auth::id();
        }else{
            $user_id = 0;
        }

        $invoice->status = 'approved';
        $invoice->user_id = $user_id;

        $invoice->account_status = '0';


        if($invoice->save()){
            for($i=0 ; $i < count($request->input('job_id')) ; $i++){
                $invoice_location = new invoice_location();
                $invoice_location->invoice_id = $invoice->id;
                $invoice_location->job_id = $request->input('job_id')[$i];
                $invoice_location->from_location = $request->input('from_location')[$i];
                $invoice_location->to_location = $request->input('to_location')[$i];
                $invoice_location->loading_date = $request->input('loading_date')[$i];
                $invoice_location->offloading_date = $request->input('offloading_date')[$i];
                $invoice_location->booking_date = $request->input('offloading_date')[$i];
                $invoice_location->vehicle_id = $request->input('vehicle_id')[$i];
                $invoice_location->detention_type = $request->input('detention_type')[$i];
                $invoice_location->detention_rate = $request->input('detention_rate')[$i];
                $invoice_location->detention_duration = $request->input('detention_duration')[$i];
               
                $invoice_location->toll_charges = $request->input('toll_charges')[$i];
                $invoice_location->gate_charges = $request->input('gate_charges')[$i];
                $invoice_location->labour_charges = $request->input('labour_charges')[$i];
                $invoice_location->border_charges = $request->input('border_charges')[$i];
                $invoice_location->other_charges = $request->input('other_charges')[$i];
                $invoice_location->other_charges_description = $request->input('other_charges_description')[$i];
                $invoice_location->job_price = $request->input('job_price')[$i];
                $invoice_location->total_amount = $request->input('total_amount')[$i];
                $invoice_location->row_status = 'active';


                if($invoice_location->save()){
                    $booking = booking::find($request->input('job_id')[$i]);
                    $booking->invoice_status = 1;
                    // dd($booking);
                    if($booking->save()){
                        $this->history_table('booking_histories', 'Invoice Id ( '. $invoice->id.' )  Created against Job Id ('. $invoice_location->job_id .')' , $user_id , $invoice->id , 'account.view_invoice');

                    }

                }


            }

            $this->history_table('invoice_histories', 'Invoice Id ( '. $invoice->id.' )  Created' , $user_id , $invoice->id , 'account.view_invoice');
            return \Redirect::route('user.account.invoice')->with('success', 'Cheque Issued');
        }

        return \Redirect::route('user.account.invoice')->with('Error', 'Invoice Not Created');


    }

    public function update_invoice_approval(Request $request){
        $id =  (int)$request->input('id');

        if($request->input('type') == 'invoice' ){
            $data['approval'] = invoice::find($request->input('id'));
            if($request->input('status') == 'approved'){
                $fund = invoice::where('id' , $id)->first();

                $account_invoice = new account_invoice();
                $account_invoice->invoice_id = $fund->id;
                $account_invoice->invoice_no = $fund->invoice_no;

                $account_invoice->user_id = 0;

                // $account_invoice->po_id = $fund->id;
                // $account_invoice->company = $fund->company_id;
                $account_invoice->total_amount = $fund->grand_total;
                $account_invoice->amount_recived = 0;
                $account_invoice->amount_remaning	 =  $fund->grand_total;
                $account_invoice->status = 'not_recived';
                $account_invoice->row_status = 'active';
                $account_invoice->date = $fund->date;

                $account_invoice->save();

                $fund->status = 'approved';
                $fund->save();

                if($account_invoice->save()){
                    $this->history_table('account_invoice_histories', 'Add' , 0 , $account_invoice->id , 'account.view_approval');

                    $this->history_table('invoice_histories', 'Invoice Approve From Account ' , 0,  $fund->id , "account.view_invoice");

                    return \Redirect::route('user.account.invoice_approval')->with('success', 'Data Updated Sucessfully');
                }
            }else{
                $fund = invoice::where('id' , $id)->first();

                $fund->status = $request->input('status');
                
                $fund->save();

                $this->history_table('invoice_histories', 'Status Change From Account' , 0,  $fund->id , "account.view_invoice");

                return \Redirect::route('user.account.invoice_approval')->with('success', 'Data Updated Sucessfully');
            }
        }

    } 

    public function discard_invoice(Request $request){

    }

    //Reciveable

    public function reciveable_invoice(){
        $data['modules']= DB::table('modules')->get();
            
        $data['purchase'] = account_invoice::where('row_status','!=' ,'deleted')->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
    
        $user = Auth::user();
    
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();
    
        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
    
        $data['page_title'] = "Accout Reciveable Invioce";
        $data['view'] = 'account.reciveable.invoice_reciveable';
        return view('users.layout', ["data"=>$data]);
    }

    public function reciveable_invoice_over_due(){
        $data['modules']= DB::table('modules')->get();
            
        // $data['purchase'] = account_invoice::where('row_status','!=' ,'deleted')->whereBetween('date', [$from, $to])->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
        $data['purchase'] = account_invoice::where('row_status','!=' ,'deleted')->get();
    
        $user = Auth::user();
    
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();
    
        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
    
        $data['page_title'] = "Accout Reciveable Invioce Over Due";
        $data['view'] = 'account.reciveable.invoice_reciveable_over_due';
        return view('users.layout', ["data"=>$data]);
    }

    public function recived_invoice(){
        $data['modules']= DB::table('modules')->get();
            
        // $data['purchase'] = account_invoice::where('row_status','!=' ,'deleted')->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
        $data['purchase'] = account_invoice::where('row_status','!=' ,'deleted')->get();
        // dd($data['purchase']);
        $user = Auth::user();
    
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();
    
        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
    
        $data['page_title'] = "Accout Reciveable Invioce";
        $data['view'] = 'account.reciveable.invoice_recived';
        return view('users.layout', ["data"=>$data]);
    }

    public function reciveable(){
        $data['modules']= DB::table('modules')->get();
            
        $data['invoice'] = account_invoice::where('row_status','!=' ,'deleted')->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
    
        $user = Auth::user();
    
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();
    
        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
    
        $data['page_title'] = "Accout Reciveable ";
        $data['view'] = 'account.reciveable.reciveable';
        return view('users.layout', ["data"=>$data]);
    }

    public function recive_invoice_payment(Request $request){
        $purchase = account_invoice::find($request->input('id'));
        $invoice = invoice::find($purchase->invoice_id);
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $purchase->amount_recived = (int)$request->input('amount');

        $purchase->amount_remaning = (int)$purchase->amount_remaning - $purchase->amount_recived;
        // dd($purchase->amount_remaning);
        if($purchase->amount_remaning > 0  ){
            $purchase->status = 'partial_recived';

            $account_purchase = new account_invoice();
            $account_purchase->invoice_no = $purchase->invoice_no;
            $account_purchase->invoice_id = $purchase->invoice_id;
            // $account_purchase->company = $purchase->company_id;
            $account_purchase->total_amount = $purchase->total_amount;
            $account_purchase->amount_recived = 0 ;
            $account_purchase->amount_remaning = $purchase->amount_remaning;
            $account_purchase->status = 'not_recived';
            $account_purchase->row_status = 'active';
            $account_purchase->date = date('Y-m-d ');
            $account_purchase->user_id = 0;
            $account_purchase->save();

        }else{
            $purchase->status = 'recived';
        }

        
        if($request->input('payment_advice_note') != ''){
            $purchase->payment_advice_note = $request->input('payment_advice_note');
        }

        if ($request->hasFile('upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/account/', $name , ['disk' => 'public_uploads'])){
                $purchase->upload = $name;


            }
            
        }

        

        
        if($purchase->save()){
            $all_account_invoice = account_invoice::where('invoice_id' , '=' , $invoice->id)->where('row_status' , '!=' , 'deleted')->get();
            $amount_recived = 0;
            foreach($all_account_invoice as $account_invoice){
                if($account_invoice != 'not_recived'){
                    $amount_recived += $account_invoice->amount_recived;
                }
            }
            $invoice->recived_amount = $amount_recived;
            if($invoice->recived_amount >= $invoice->grand_total ){
                $invoice->invoice_status = 1;
            }
            $invoice->save();
        }

        $this->history_table('account_invoice_histories', 'Payment Recived' , 0 , $purchase->invoice_id , 'account.view_invoice');

        return \Redirect::route('user.account.reciveable_invoice')->with('success', 'Cheque Issued');


    }

    public function invoice_history(){

        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['employees'] = Employee::all();


        $data['trade_licenses_history']= invoice_history::all();
        $data['table_name']= 'invoice_histories';

        $data['page_title'] = "History | Invoice ";
        $data['view'] = 'hr_pro.history';
        return view('layout', ["data"=>$data]);
    }
}