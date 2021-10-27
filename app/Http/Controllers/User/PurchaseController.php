<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\User;
use App\Models\Roles;

use App\Models\Trade_license;
use App\Models\Permissions;
use App\Models\Login_password;

use App\Models\Modules;

use App\Models\Approvals;




use Illuminate\Support\Facades\File;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth:user');
    }

      
    ///////////////////////////////////////////////
    ///////// Add table name to approvals /////////
    ///////////////////////////////////////////////

    public function add_aprovals($table_name){
        $check = false;
        foreach (Approvals::all() as $approvals_table) {
           
            if($approvals_table->table_name == $table_name){
                $check = true;
            }
        }
        
        if(!$check){
            $approvals_table = new Approvals;
            $approvals_table->table_name = $table_name;
            $approvals_table->save();
        }
        return true;
    }

    /////////////////////////////////
    /////////    Purchase   /////////
    /////////////////////////////////

    public function purchase(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
          
        
        // if($data['permissions']->status != 1 ){
        //     abort(403);
        // }
        $data['trade_licenses']= DB::table('trade_licenses')->get();
        $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "PURCHASE";
        $data['view'] = 'purchase.purchase';
        return view('users.layout', ["data"=>$data]);
    }

    // public function trash_trade_license(){
    //     $data['modules']= DB::table('modules')->get();
    //     $data['trade_licenses']= DB::table('trade_licenses')->get();
    //     $data['company_names']= DB::table('company_names')->get();
    //     // dd( $data['customer_info']);
    //     $data['page_title'] = "Trade License Trash";
    //     $data['view'] = 'admin.hr_pro.trade_license.deleted_data';
    //     return view('users.layout', ["data"=>$data]);
    // }

    public function purchase_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     

        $data['trade_licenses_history']= DB::table('trade_license_histories')->get();
        $data['table_name']= 'trade_license_histories';

        $data['page_title'] = "History | PURCHASE ";
        $data['view'] = 'admin.purchase.purchase_history';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_purchase(){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add PURCHASE";
        $data['view'] = 'purchase.add_purchase';
        return view('users.layout', ["data"=>$data]);
    }

    public function view_purchase(Request $request){
        $data['trade_license'] = Trade_license::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "PURCHASE";
        $data['view'] = 'purchase.view_purchase';
        return view('users.layout', ["data"=>$data]);
    }

    public function edit_purchase(Request $request){
        $data['trade_license'] = Trade_license::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit PURCHASE";
        $data['view'] = 'purchase.edit_purchase';
        return view('users.layout', ["data"=>$data]);
    }

    public function save_purchase(Request $request){

        $trade_license = new Trade_license;
        if($request->input('company_id') != ''){
            $trade_license->company_id = $request->input('company_id');
        }
        if($request->input('trade_name') != ''){
            $trade_license->trade_name = $request->input('trade_name');

        }
        if($request->input('license_number') != ''){
            $trade_license->license_number = $request->input('license_number');

        }
        if($request->input('expiary_date') != ''){
            $trade_license->expiary_date = $request->input('expiary_date');
        }

        if ($request->hasFile('trade_license')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
             ;
            $name = time().'_'.str_replace(" ", "_", $request->trade_license->getClientOriginalName());
            $file = $request->file('trade_license');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->trade_license_copy	 = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('membership_certificate')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->membership_certificate->getClientOriginalName());
            $file = $request->file('membership_certificate');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->member_ship_certificate	 = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('sponsor_page')) {

           
            $name = time().'_'.str_replace(" ", "_", $request->sponsor_page->getClientOriginalName());
            $file = $request->file('sponsor_page');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->sponsor_page =$name;

            }
           

        }

        if ($request->hasFile('manager_id_card')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->manager_id_card->getClientOriginalName());
            $file = $request->file('manager_id_card');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->manager_id_card	 = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('sponsor_id_card')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->sponsor_id_card->getClientOriginalName());
            $file = $request->file('sponsor_id_card');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->sponsor_id_card	 = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('partners_id_card')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->partners_id_card->getClientOriginalName());
            $file = $request->file('partners_id_card');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->partners_id_card = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('manager_passport')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->manager_passport->getClientOriginalName());
            $file = $request->file('manager_passport');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->manager_passport = $name;
            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('sponsor_passport')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->sponsor_passport->getClientOriginalName());
            $file = $request->file('sponsor_passport');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->sponsor_passport = $name;
            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('partners_passport')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->partners_passport->getClientOriginalName());
            $file = $request->file('partners_passport');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->partners_passport = $name;
            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('manager_visa')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->manager_visa->getClientOriginalName());
            $file = $request->file('manager_visa');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->manager_visa	 = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('sponsor_visa')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->sponsor_visa->getClientOriginalName());
            $file = $request->file('sponsor_visa');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->sponsor_visa = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('partners_visa')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->partners_visa->getClientOriginalName());
            $file = $request->file('partners_visa');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->partners_visa = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        $this->add_aprovals('trade_licenses');

        $trade_license->status = 'pending';
        $trade_license->action = 'add';
        if($request->input('status_message') != ''){

            $trade_license->status_message = $request->input('status_message');

        }

        $trade_license->user_id = Auth::id();
        $trade_license->save();

        return \Redirect::route('user.hr_pro.trade_license__sponsors__partners')->with('success', 'Data Added Sucessfully');

    }

    public function update_purchase(Request $request){
        $id =  (int)$request->input('id');
        $trade_license = Trade_license::where('id' , $id)->first();

        if($request->input('company_id') != ''){
            $trade_license->company_id = $request->input('company_id');
        }
        if($request->input('trade_name') != ''){
            $trade_license->trade_name = $request->input('trade_name');

        }
        if($request->input('license_number') != ''){
            $trade_license->license_number = $request->input('license_number');

        }
        if($request->input('expiary_date') != ''){
            $trade_license->expiary_date = $request->input('expiary_date');
        }

        if ($request->hasFile('trade_license')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
             ;
            $name = time().'_'.str_replace(" ", "_", $request->trade_license->getClientOriginalName());
            $file = $request->file('trade_license');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->trade_license_copy	 = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('membership_certificate')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->membership_certificate->getClientOriginalName());
            $file = $request->file('membership_certificate');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->member_ship_certificate	 = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('sponsor_page')) {

           
            $name = time().'_'.str_replace(" ", "_", $request->sponsor_page->getClientOriginalName());
            $file = $request->file('sponsor_page');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->sponsor_page =$name;

            }
           

        }

        if ($request->hasFile('manager_id_card')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->manager_id_card->getClientOriginalName());
            $file = $request->file('manager_id_card');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->manager_id_card	 = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('sponsor_id_card')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->sponsor_id_card->getClientOriginalName());
            $file = $request->file('sponsor_id_card');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->sponsor_id_card	 = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('partners_id_card')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->partners_id_card->getClientOriginalName());
            $file = $request->file('partners_id_card');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->partners_id_card = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('manager_passport')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->manager_passport->getClientOriginalName());
            $file = $request->file('manager_passport');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->manager_passport = $name;
            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('sponsor_passport')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->sponsor_passport->getClientOriginalName());
            $file = $request->file('sponsor_passport');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->sponsor_passport = $name;
            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('partners_passport')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->partners_passport->getClientOriginalName());
            $file = $request->file('partners_passport');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->partners_passport = $name;
            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('manager_visa')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->manager_visa->getClientOriginalName());
            $file = $request->file('manager_visa');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->manager_visa	 = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('sponsor_visa')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->sponsor_visa->getClientOriginalName());
            $file = $request->file('sponsor_visa');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->sponsor_visa = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('partners_visa')) {

            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
        
            $name = time().'_'.str_replace(" ", "_", $request->partners_visa->getClientOriginalName());
            $file = $request->file('partners_visa');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $trade_license->partners_visa = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        $this->add_aprovals('trade_licenses');

        $trade_license->status = 'pending';

        if($request->input('status_message') != ''){

            $trade_license->status_message = $request->input('status_message');

        }

        $trade_license->user_id = Auth::id();
        $trade_license->action = 'edit';

        $trade_license->save();

        return \Redirect::route('user.hr_pro.trade_license__sponsors__partners')->with('success', 'Data Edited Sucessfully');

    }

    public function delete_trade_license(Request $request){
        $id =  (int)$request->input('id');
        $trade_license = Trade_license::where('id' , $id)->first();

        $trade_license->status = 'pending';
        $trade_license->status_message = $request->input('status_message');
        $trade_license->user_id = Auth::id();
        $trade_license->action = 'delete';


        if( $trade_license->save()){
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

}

