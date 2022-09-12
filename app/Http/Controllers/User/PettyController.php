<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\User;
use App\Models\Roles;
use App\Models\Company_name;
use App\Models\Modules;

use Carbon\Carbon;

use App\Models\Account_petty;
use App\Models\Account_petty_edit_history;
use App\Models\Account_petty_history;

use App\Models\Account_hr;
use App\Models\Petty_hr;
use App\Models\petty_booking;

use App\Models\Petty_bill;



use App\Models\Petty_finance_request;
use App\Models\Petty_finance_request_history;
use App\Models\Petty_finance_request_edit_history;
use App\Models\Petty;

use App\Models\Purchase;


use App\Models\Permissions;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Redirect;
use App\Models\Petty_bills;
use App\Models\Petty_purchase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class PettyController extends Controller
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


    public function petty(){
        $user = Auth::user();
        $data['modules']= DB::table('modules')->get();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 8)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['page_title'] = "Petty Cash";
        $data['view'] = 'petty.petty';
        return view('users.layout', ["data"=>$data]);
    }


    public function finance_request(){
        $data['modules']= DB::table('modules')->get();
        $data['finance_request'] = Petty_finance_request::all();
       
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 8)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        
        $data['page_title'] = "Finance Request";
        $data['view'] = 'petty.finance_request.finance_request';
        return view('users.layout', ["data"=>$data]);
    }

    public function finance_request_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 8)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     

        $data['trade_licenses_history']= DB::table('petty_finance_request_histories')->orderBy('updated_at')->get();
        $data['table_name']= 'petty_finance_request_histories';
        

        $data['page_title'] = "History | Finance Request ";
        $data['view'] = 'admin.hr_pro.history';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_finance_request(){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 8)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Finance Request";
        $data['view'] = 'petty.finance_request.add_finance_request';
        return view('users.layout', ["data"=>$data]);
    }

    public function edit_finance_request(Request $request){

        $data['finance_request'] = Petty_finance_request::where('id' ,'=' , $request->input('id'))->first();

        $data['modules']= DB::table('modules')->get();
        
        $data['finance_request_edit'] =  Petty_finance_request_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 8)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        //  $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Finance Request";
        $data['view'] = 'petty.finance_request.edit_finance_request';
        return view('users.layout', ["data"=>$data]);

    }

    
    public function save_finance_request(Request $request){
        $finance_request = new Petty_finance_request;

        if($request->input('reason') != ''){
            $finance_request->reason = $request->input('reason');
        }

        $finance_request->date = date('Y-m-d');

        if($request->input('amount') != ''){
            $finance_request->amount = $request->input('amount');
        }
        
        if ($request->hasFile('upload')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/petty/', $name , ['disk' => 'public_uploads'])){
                $finance_request->upload = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }


        $finance_request->status = 'pending';
        $finance_request->row_status = 'active';

        if($request->input('status_message') != ''){

            $finance_request->status_message = $request->input('status_message');

        }

        $finance_request->user_id = Auth::id();
        $finance_request->action = 'Add';

        $finance_request->save();

        $this->history_table('petty_finance_request_histories', 'Add' , Auth::id(),  $finance_request->id , "petty.view_finance_request");

        return \Redirect::route('user.petty.finance_request')->with('success', 'Data Added Sucessfully');

    }

    public function update_finance_request(Request $request){
        $finance_request = Petty_finance_request::find($request->input('id'));
        // dd($request->input('id'));
        $finance_request_edit = new Petty_finance_request_edit_history();
        //customer edit history track
        $finance_request_edit->row_id = (int)$request->input('id');
        $finance_request_edit->reason =  $finance_request->reason;
        $finance_request_edit->amount =  $finance_request->amount;

        $finance_request_edit->upload =  $finance_request->upload;
    

        $finance_request_edit->save();

        if($request->input('reason') != ''){
            $finance_request->reason = $request->input('reason');
        }

        if($request->input('amount') != ''){
            $finance_request->amount = $request->input('amount');
        }
        
        if ($request->hasFile('upload')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/petty/', $name , ['disk' => 'public_uploads'])){
                $finance_request->upload = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }
      
        $finance_request->status = 'pending';

        if($request->input('status_message') != ''){

            $finance_request->status_message = $request->input('status_message');

        }

        $finance_request->user_id = Auth::id();
        $finance_request->action = 'edit';

        $finance_request->save();
        $this->history_table('petty_finance_request_histories', 'Update' , Auth::id(),  $finance_request->id , "petty.view_finance_request");

        return \Redirect::route('user.petty.finance_request')->with('success', 'Data Updated Sucessfully');

    }

    public function delete_finance_request(Request $request){
        $finance_request = Petty_finance_request::find($request->input('id'));

        $finance_request->status = 'pending';
        $finance_request->status_message = $request->input('status_message');
        $finance_request->user_id = Auth::id();
        $finance_request->action = 'delete';

        $this->history_table('petty_finance_request_histories', 'Delete' , Auth::id(),  $finance_request->id , "petty.view_finance_request");

        if( $finance_request->save()){
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }

    }

    public function view_finance_request(Request $request){
        $data['finance_request'] = Petty_finance_request::where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();
        
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 8)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();

        $data['page_title'] = "View Finance Request";
        $data['view'] = 'petty.finance_request.view_finance_request';
        return view('users.layout', ["data"=>$data]);
    }

    //Payable purchase
    public function payable_purchase(){
        $data['modules']= DB::table('modules')->get();
            
        $data['purchase'] = Petty_purchase::where('row_status','!=' ,'deleted')->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
    
        $user = Auth::user();
    
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 8)->first();
    
        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
    
        $data['page_title'] = "Petty Payable Purchase";
        $data['view'] = 'petty.petty_entery.purchase_entery';
        return view('users.layout', ["data"=>$data]);
    }

    public function issue_purchase_payment(Request $request){
       
        $purchase = Petty_purchase::find($request->input('id'));
        if($purchase != null){
            

            $purchase->amount_remaning = (float)$purchase->amount_remaning - (float)$request->input('amount');

            $purchase->amount_paid = $request->input('amount');
            // dd($purchase->amount_paid );
            $purchase->date = date('Y-m-d');


            $petty = Petty::latest()->first();
            if($petty != null){

                $new_petty = new Petty();
                $new_petty->paid_amount  = (float)$request->input('amount');

                if((float)$petty->total_amount - (float)$request->input('amount') < 0){

                    return \Redirect::route('user.petty.payable_purchase')->with('error', 'Not Enough Blanace');
                }

                $new_petty->total_amount  =  (float)$petty->total_amount - (float)$request->input('amount');

                $new_petty->date  =  date('Y-m-d');
                $new_petty->status  =  'approved';
                $new_petty->description  =  'Cash Paid to Purchase (Po Number:'.$purchase->po_number .')';

                $purchase_old = Purchase::find($purchase->po_id);

                $new_petty->company_id  =  $purchase_old->company_id;


                $new_petty->row_status  =  'active';
                $new_petty->user_id  =  Auth::id();
                $new_petty->save();
            }else{
                return \Redirect::route('user.petty.payable_purchase')->with('error', 'Not Enough Blanace');
            }

            

            if($purchase->amount_remaning > 0  ){
                $purchase->status = 'partial_paid';
    
                $account_purchase = new Petty_purchase();
                $account_purchase->po_number = $purchase->po_number;
                $account_purchase->po_id = $purchase->po_id;
                $account_purchase->company = $purchase->company_id;
                $account_purchase->total_amount = $purchase->total_amount;
                $account_purchase->amount_paid = 0 ;
                $account_purchase->amount_remaning = $purchase->amount_remaning;
                $account_purchase->status = 'not_paid';
                $account_purchase->row_status = 'active';
                $account_purchase->user_id = Auth::id();
                $account_purchase->save();
    
            }else{
                // dd('called');
                $purchase->status = 'paid';
            }

            $purchase->save();
            
             return \Redirect::route('user.petty.payable_purchase')->with('success', 'Data Updated Successfully');
        }

        return \Redirect::route('user.petty.payable_purchase')->with('error', 'Field Not Found or Deleted');
    }

    public function update_purchase_status(Request $request){
        $purchase = Petty_purchase::find($request->input('id'));
        if($purchase != null){

            if($request->input('reciving_date') != ''){
                $purchase->reciving_date = $request->input('reciving_date');
            }
    
            if ($request->hasFile('reciving')) {
    
                $name = time().'_'.str_replace(" ", "_", $request->reciving->getClientOriginalName());
                $file = $request->file('reciving');
                if($file->storeAs('/main_admin/petty/', $name , ['disk' => 'public_uploads'])){
                    $purchase->reciving = $name;
    
                }
                
            }

            $purchase->save();
        }

        return \Redirect::route('user.petty.payable_purchase')->with('success', 'Reciving Updated');

    }

    //Payable Booking
    public function payable_booking(){
        $data['modules']= DB::table('modules')->get();
            
        $data['booking'] = Petty_booking::where('row_status','!=' ,'deleted')->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
    
        $user = Auth::user();
    
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 8)->first();
    
        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
    
        $data['page_title'] = "Petty Payable Booking";
        $data['view'] = 'petty.petty_entery.booking_entery';
        return view('users.layout', ["data"=>$data]);
    }

    public function issue_booking_payment(Request $request){
       
        $purchase = Petty_booking::find($request->input('id'));
        if($purchase != null){
            

            $purchase->amount_remaning = (float)$purchase->amount_remaning - (float)$request->input('amount');

            $purchase->amount_paid = $request->input('amount');
            // dd($purchase->amount_paid );
            $purchase->date = date('Y-m-d');


            $petty = Petty::latest()->first();
            if($petty != null){

                $new_petty = new Petty();
                $new_petty->paid_amount  = (float)$request->input('amount');

                if((float)$petty->total_amount - (float)$request->input('amount') < 0){

                    return \Redirect::route('petty.payable_booking')->with('error', 'Not Enough Blanace');
                }

                $new_petty->total_amount  =  (float)$petty->total_amount - (float)$request->input('amount');

                $new_petty->date  =  date('Y-m-d');
                $new_petty->status  =  'approved';
                $new_petty->description  =  'Cash Paid to Booking (Job Id:'.$purchase->job_id .')';

                $purchase_old = Purchase::find($purchase->job_id);

                // $new_petty->company_id  =  $purchase_old->company_id;


                $new_petty->row_status  =  'active';
                $new_petty->user_id  =  0;
                $new_petty->save();
            }else{
                return \Redirect::route('petty.payable_booking')->with('error', 'Not Enough Blanace');
            }

            

            if($purchase->amount_remaning > 0  ){
                $purchase->status = 'partial_paid';
    
                $account_purchase = new Petty_booking();
                $account_purchase->job_id = $purchase->job_id;
                // $account_purchase->po_id = $purchase->po_id;
                // $account_purchase->company = $purchase->company_id;
                $account_purchase->total_amount = $purchase->total_amount;
                $account_purchase->amount_paid = 0 ;
                $account_purchase->amount_remaning = $purchase->amount_remaning;
                $account_purchase->status = 'not_paid';
                $account_purchase->row_status = 'active';
                $account_purchase->user_id = 0;
                $account_purchase->save();
    
            }else{
                // dd('called');
                $purchase->status = 'paid';
            }

            $purchase->save();
            
             return \Redirect::route('petty.payable_booking')->with('success', 'Data Updated Successfully');
        }

        return \Redirect::route('petty.payable_booking')->with('error', 'Field Not Found or Deleted');
    }

    public function update_booking_status(Request $request){
        $purchase = Petty_booking::find($request->input('id'));
        if($purchase != null){

            if($request->input('reciving_date') != ''){
                $purchase->reciving_date = $request->input('reciving_date');
            }
    
            if ($request->hasFile('reciving')) {
    
                $name = time().'_'.str_replace(" ", "_", $request->reciving->getClientOriginalName());
                $file = $request->file('reciving');
                if($file->storeAs('/main_admin/petty/', $name , ['disk' => 'public_uploads'])){
                    $purchase->reciving = $name;
    
                }
                
            }

            $purchase->save();
        }

        return \Redirect::route('petty.payable_booking')->with('success', 'Reciving Updated');

    }

    //Payable Hr
    public function payable_hr(){
        $data['modules']= DB::table('modules')->get();
            
        $data['purchase'] = Petty_hr::where('row_status','!=' ,'deleted')->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
    
        $user = Auth::user();
    
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 8)->first();
    
        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
    
        $data['page_title'] = "Petty Payable Hr";
        $data['view'] = 'petty.petty_entery.hr_entery';
        return view('users.layout', ["data"=>$data]);
    }

    public function issue_hr_payment(Request $request){
       
        $purchase = Petty_hr::find($request->input('id'));
        if($purchase != null){
            

            $purchase->amount_remaning = (float)$purchase->amount_remaning - (float)$request->input('amount');

            $purchase->amount_paid = $request->input('amount');
            // dd($purchase->amount_paid );
            $purchase->date = date('Y-m-d');


            $petty = Petty::latest()->first();
            if($petty != null){

                $new_petty = new Petty();
                $new_petty->paid_amount  = (float)$request->input('amount');

                if((float)$petty->total_amount - (float)$request->input('amount') < 0){

                    return \Redirect::route('user.petty.payable_purchase')->with('error', 'Not Enough Blanace');
                }

                $new_petty->total_amount  =  (float)$petty->total_amount - (float)$request->input('amount');

                $new_petty->date  =  date('Y-m-d');
                $new_petty->status  =  'approved';
                $new_petty->description  =  'Cash Paid to Hr (Hr Rrequest Id:'.$purchase->hr_fund_id .')';

               


                $new_petty->row_status  =  'active';
                $new_petty->user_id  =  Auth::id();
                $new_petty->save();
            }else{
                return \Redirect::route('user.petty.payable_hr')->with('error', 'Not Enough Blanace');
            }

            

            if($purchase->amount_remaning > 0  ){
                $purchase->status = 'partial_paid';
    
                $account_purchase = new Petty_hr();
                $account_purchase->hr_fund_id = $purchase->hr_fund_id;
                $account_purchase->account_id = $purchase->account_id;

                // $account_purchase->po_id = $purchase->po_id;
                // $account_purchase->company = $purchase->company_id;
                $account_purchase->total_amount = $purchase->total_amount;
                $account_purchase->amount_paid = 0 ;
                $account_purchase->amount_remaning = $purchase->amount_remaning;
                $account_purchase->status = 'not_paid';
                $account_purchase->row_status = 'active';
                $account_purchase->user_id = Auth::id();
                $account_purchase->save();
    
            }else{
                // dd('called');
                $purchase->status = 'paid';
            }

            $purchase->save();
            
             return \Redirect::route('user.petty.payable_hr')->with('success', 'Data Updated Successfully');
        }

        return \Redirect::route('user.petty.payable_hr')->with('error', 'Field Not Found or Deleted');
    }

    public function update_hr_status(Request $request){
        $purchase = Petty_hr::find($request->input('id'));
        if($purchase != null){

            if($request->input('reciving_date') != ''){
                $purchase->reciving_date = $request->input('reciving_date');
            }
    
            if ($request->hasFile('reciving')) {
    
                $name = time().'_'.str_replace(" ", "_", $request->reciving->getClientOriginalName());
                $file = $request->file('reciving');
                if($file->storeAs('/main_admin/petty/', $name , ['disk' => 'public_uploads'])){
                    $purchase->reciving = $name;
    
                }
                
            }

            $purchase->save();
        }

        return \Redirect::route('user.petty.payable_hr')->with('success', 'Reciving Updated');

    }


    //bills
    public function payable_bill(){
        $data['modules']= DB::table('modules')->get();
            
        $data['purchase'] = Petty_bills::where('row_status','!=' ,'deleted')->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
    
        $user = Auth::user();
    
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 8)->first();
    
        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
    
        $data['page_title'] = "Petty Payable Hr";
        $data['view'] = 'petty.petty_entery.bill_entery';
        return view('users.layout', ["data"=>$data]);
    }

    // public function add_payable_bill(){
    //     $data['modules']= DB::table('modules')->get();
            
    //     $data['purchase'] = Petty_bills::where('row_status','!=' ,'deleted')->get();
    //     // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
    
    //     $user = Auth::user();
    
    //     $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where    ('module_id' ,'=' , 8)->first();
    
    //     $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
    
    //     $data['page_title'] = "Petty Payable Hr";
    //     $data['view'] = 'petty.petty_entery.add_bill_entery';
    //     return view('users.layout', ["data"=>$data]);
    // }

    public function save_payable_bill(Request $request){
         $petty_bill =  new Petty_bills();

         if($request->input('amount') != ''){
            $petty_bill->amount = $request->input('amount');
        }

        if($request->input('description') != ''){
            $petty_bill->description = $request->input('description');
        }

        if($request->input('bill_name') != ''){
            $petty_bill->bill_name = $request->input('bill_name');
        }

        if ($request->hasFile('upload')) {

            $name = time().'_'.str_replace(" ", "_", $request->upload->getClientOriginalName());
            $file = $request->file('upload');
            if($file->storeAs('/main_admin/petty/', $name , ['disk' => 'public_uploads'])){
                $petty_bill->upload = $name;

            }  
        }

        $petty_bill->row_status = 'active';
        $petty_bill->date = date('Y-m-d');

        $petty_bill->status = 'not_paid';
        $petty_bill->user_id = Auth::id();


        $petty = Petty::latest()->first();
            if($petty != null){
                $new_petty = new Petty();
                $new_petty->paid_amount  = (float)$request->input('amount');
        
                if((float)$petty->total_amount - (float)$request->input('amount') < 0){
        
                    return \Redirect::route('user.petty.payable_bill')->with('error', 'Not Enough Blanace');
                }
        
                $new_petty->total_amount  =  (float)$petty->total_amount - (float)$request->input('amount');
        
                $new_petty->date  =  date('Y-m-d');
                $new_petty->status  =  'approved';
                $new_petty->description  =  'Cash Paid For Bill (Bill Name:'.$petty_bill->bill_name .')';
        
                $new_petty->row_status  =  'active';
                $new_petty->user_id  =  Auth::id();
                $new_petty->save();
            }else{
                return \Redirect::route('user.petty.payable_bill')->with('error', 'Not Enough Blanace');
            }


            $petty_bill->save();
        

       

        return \Redirect::route('user.petty.payable_bill')->with('success', 'Data Added Successfully');

    }

    public function update_bill_status(Request $request){
        $purchase = Petty_bills::find($request->input('id'));
        if($purchase != null){

            if($request->input('reciving_date') != ''){
                $purchase->reciving_date = $request->input('reciving_date');
            }
    
            if ($request->hasFile('reciving')) {
    
                $name = time().'_'.str_replace(" ", "_", $request->reciving->getClientOriginalName());
                $file = $request->file('reciving');
                if($file->storeAs('/main_admin/petty/', $name , ['disk' => 'public_uploads'])){
                    $purchase->reciving = $name;
    
                }
            }

            $purchase->save();
        }

        return \Redirect::route('user.petty.payable_bill')->with('success', 'Reciving Updated');

    }
    //
    public function petty_detail(){
        $data['modules']= DB::table('modules')->get();
            
        $data['purchase'] = Petty::where('row_status','!=' ,'deleted')->get();
        // $data['hr_funds'] = Funds_request::where('row_status','!=' ,'deleted')->get();
    
        $user = Auth::user();
    
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 8)->first();
    
        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
    
        $data['page_title'] = "Petty Detail";
        $data['view'] = 'petty.petty_detail';
        return view('users.layout', ["data"=>$data]);
    }
}