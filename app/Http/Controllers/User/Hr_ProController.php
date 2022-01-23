<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\User;
use App\Models\Roles;
use App\Models\Company_name;
use App\Models\Trade_license;
use App\Models\Permissions;
use App\Models\Login_password;
use App\Models\Office_Land_contract;
use App\Models\Modules;
use App\Models\Civil_defense_documents;
use App\Models\Muncipality_documents;
use App\Models\Trained_individual;
use App\Models\Approvals;
use App\Models\Trade_license_partners;
use App\Models\Trade_license_edit_history;
use App\Models\Trade_license_partners_edit_history;
use App\Models\Office_land_contract_edit_history;

use App\Models\Trained_individual_edit_history;


use App\Models\Civil_defense_files_edit_history;
use App\Models\Muncipality_documents_edit_history;

use Illuminate\Support\Facades\File;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Hr_ProController extends Controller
{
    /*
        1. Trade License and sponsors        line_no: 90
        2. Company Names                     line_no: 58
        3. non_mobiles_fuel_tanks_renewals   line_no: 471
        4. non_mobiles_fuel_tanks_renewals   line_no: 720
        5. office contract land contact      line_no: 970
        6. Login Access and Password         line_no: 1450


    */
    
    public function __construct() {
        $this->middleware('auth:user');
    }

    public function hr_pro(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
          
        
        if($data['permissions']->status != 1 ){
            abort(403);
        }
    
       
        $data['page_title'] = "HR-PRO";
        $data['view'] = 'hr_pro.hr_pro';
        return view('users.layout', ["data"=>$data]);
    }

    /////////////////////////////////
    ///////// Company Name /////////
    /////////////////////////////////


    public function add_comany_name(){
        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
          
        
        
        
        $data['page_title'] = "Add Comany Name";
        $data['view'] = 'hr_pro.company_name.add_company';
        return view('users.layout', ["data"=>$data]);
    }

    public function save_company(Request $request){

        $Company_name = new Company_name;
        $Company_name->name = $request->input('name');
        $Company_name->save();

        return \Redirect::route('user.hr_pro.trade_license__sponsors__partners')->with('success', 'Data Added Sucessfully');

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
    ///////// Trade License /////////
    /////////////////////////////////

    public function trade_license(){

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

        $data['page_title'] = "TRADE LICENSE,SPONSORS, PARTNERS";
        $data['view'] = 'hr_pro.trade_license.trade_license';
        return view('users.layout', ["data"=>$data]);
    }

    public function trash_trade_license(){
        $data['modules']= DB::table('modules')->get();
        $data['trade_licenses']= DB::table('trade_licenses')->get();
        $data['company_names']= DB::table('company_names')->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "Trade License Trash";
        $data['view'] = 'admin.hr_pro.trade_license.deleted_data';
        return view('users.layout', ["data"=>$data]);
    }

    public function trade_license_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     

        $data['trade_licenses_history']= DB::table('trade_license_histories')->get();
        $data['table_name']= 'trade_license_histories';

        $data['page_title'] = "History | TRADE LICENSE,SPONSORS, PARTNERS ";
        $data['view'] = 'admin.hr_pro.history';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_trade_license(){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add TRADE LICENSE,SPONSORS, PARTNERS";
        $data['view'] = 'hr_pro.trade_license.add_trade_license';
        return view('users.layout', ["data"=>$data]);
    }

    public function view_trade_license(Request $request){
        $data['trade_license'] = Trade_license::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "  TRADE LICENSE,SPONSORS, PARTNERS";
        $data['view'] = 'hr_pro.trade_license.view_trade_license';
        return view('users.layout', ["data"=>$data]);
    }

    public function edit_trade_license (Request $request){
        $data['trade_license'] = Trade_license::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();
        $data['trade_license_edit_history'] = Trade_license_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();
        
        if( $data['trade_license_edit_history'] == null){
            $data['trade_license_edit_history'] = new Trade_license_edit_history;
        }
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit TRADE LICENSE,SPONSORS, PARTNERS";
        $data['view'] = 'hr_pro.trade_license.edit_trade_license';
        return view('users.layout', ["data"=>$data]);
    }

    public function save_trade_license(Request $request){

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

        if($request->input('company_other') != ''){
            $trade_license->company_other = $request->input('company_other');
        }

        if($request->input('manager_other') != ''){
            $trade_license->manager_other = $request->input('manager_other');
        }

        if($request->input('sponsor_other') != ''){
            $trade_license->sponsor_other = $request->input('sponsor_other');
        }

        if($request->input('partners_other') != ''){
            $trade_license->partners_other = $request->input('partners_other');
        }
        if($request->input('sponsorship_fee') != ''){
            $trade_license->sponsorship_fee = $request->input('sponsorship_fee');
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

        if($request->input('sponsorship_fee') != ''){
            $trade_license->sponsorship_fee = $request->input('sponsorship_fee');

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

    public function update_trade_license(Request $request){
        $id =  (int)$request->input('id');
        $trade_license = Trade_license::where('id' , $id)->first();

        $trade_license_edit = new Trade_license_edit_history;
        //customer edit history track
        $trade_license_edit->row_id = (int)$request->input('id');
        $trade_license_edit->company_id =  $trade_license->company_id;
        $trade_license_edit->member_ship_certificate =  $trade_license->member_ship_certificate;
        $trade_license_edit->sponsor_page =  $trade_license->sponsor_page;
        $trade_license_edit->trade_name =  $trade_license->trade_name;
        $trade_license_edit->license_number =  $trade_license->license_number;
        $trade_license_edit->trade_license_copy =  $trade_license->trade_license_copy;
        $trade_license_edit->manager_id_card =  $trade_license->manager_id_card;
        
        $trade_license_edit->sponsor_id_card =  $trade_license->sponsor_id_card;
        $trade_license_edit->partners_id_card =  $trade_license->partners_id_card;
        $trade_license_edit->manager_visa =  $trade_license->manager_visa;
        $trade_license_edit->sponsor_visa =  $trade_license->sponsor_visa;
        $trade_license_edit->partners_visa =  $trade_license->partners_visa;
        $trade_license_edit->manager_passport =  $trade_license->manager_passport;
        $trade_license_edit->sponsor_passport =  $trade_license->sponsor_passport;
        $trade_license_edit->partners_passport =  $trade_license->partners_passport;
        $trade_license_edit->company_other =  $trade_license->company_other	;
        $trade_license_edit->manager_other	 =  $trade_license->manager_other	;
        $trade_license_edit->sponsor_other	 =  $trade_license->sponsor_other	;
        $trade_license_edit->partners_other	 =  $trade_license->partners_other	;


        $trade_license_edit->sponsorship_fee	 =  $trade_license->sponsorship_fee	;
        


        if(!$trade_license_edit->save()){
            return response()->json(['status'=>'0']);
        }

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

        if($request->input('company_other') != ''){
            $trade_license->company_other = $request->input('company_other');
        }

        if($request->input('manager_other') != ''){
            $trade_license->manager_other = $request->input('manager_other');
        }

        if($request->input('sponsor_other') != ''){
            $trade_license->sponsor_other = $request->input('sponsor_other');
        }
        if($request->input('sponsorship_fee') != ''){
            $trade_license->sponsorship_fee = $request->input('sponsorship_fee');
        }
        if($request->input('partners_other') != ''){
            $trade_license->partners_other = $request->input('partners_other');
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

    //////
    public function trade_license_partners ($id){
        $data['trade_license_partners'] = Trade_license_partners::where('trade_license_id' ,'=' ,$id)->get();

        // dd( $data['trade_license_partners']);
       
        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        
        $data['page_title'] = "Trade License Partners";
        $data['view'] = 'hr_pro.trade_license.trade_license_partner';
        return view('users.layout', ["data"=>$data]);
    }

    public function trash_trade_license_partners(){
        $data['modules']= DB::table('modules')->get();
        $data['trade_license_partners'] = Trade_license_partners::All();
       
        $data['page_title'] = "Trade License Partners Trash";
        $data['view'] = 'hr_pro.trade_license.deleted_data_partners';
        return view('users.layout', ["data"=>$data]);
    }

    public function trade_license_partners_add($id){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();
        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['company_names']= DB::table('company_names')->get();
        $data['trade_id'] = $id;
        $data['page_title'] = "Add Trade License Partners";
        $data['view'] = 'hr_pro.trade_license.add_trade_license_partner';
        return view('users.layout', ["data"=>$data]);
    }

    public function edit_trade_license_partners(Request $request){
        $data['trade_license_partners'] = Trade_license_partners::where('id' ,'=' , $request->input('id'))->first();

        $data['modules']= DB::table('modules')->get();

        $data['trade_license_partners_edit'] = Trade_license_partners_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();
        
        if( $data['trade_license_partners_edit'] == null){
            $data['trade_license_partners_edit'] = new Trade_license_partners_edit_history;
        }
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Trade License Partnerss";
        $data['view'] = 'hr_pro.trade_license.edit_trade_license_partner';
        return view('users.layout', ["data"=>$data]);
    }

    public function save_trade_license_partners(Request $request){

        $customer_rate_card = new Trade_license_partners;
        // dd($request->input('other'));
        
        if($request->input('other') != ''){
            $customer_rate_card->other = $request->input('other');
        }

        if($request->input('trade_id') != ''){
            $customer_rate_card->trade_license_id = $request->input('trade_id');
        }

        if ($request->hasFile('id_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->id_copy->getClientOriginalName());
            $file = $request->file('id_copy');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $customer_rate_card->id_copy = $name;

            }  
        }

        if ($request->hasFile('visa_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->visa_copy->getClientOriginalName());
            $file = $request->file('visa_copy');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $customer_rate_card->visa_copy = $name;

            }  
        }

        if ($request->hasFile('passport_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->passport_copy->getClientOriginalName());
            $file = $request->file('passport_copy');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $customer_rate_card->passport_copy = $name;

            }  
        }

        // $this->add_aprovals('customer_info');

        $customer_rate_card->status = 'pending';
        $customer_rate_card->action = 'add';
        if($request->input('status_message') != ''){

            $customer_rate_card->status_message = $request->input('status_message');

        }

        $customer_rate_card->user_id = Auth::id();

        if($customer_rate_card->save()){

            return \Redirect::route('user.hr_pro.trade_license_partners' ,  
           $request->input('trade_id') )->with('success', 'Partner Added Sucessfully');
        }else{

        }


    }

    public function update_trade_license_partners(Request $request){
        $id =  (int)$request->input('id');
        $customer_rate_card = Trade_license_partners::where('id' , $id)->first();
        // $customer_info = Customer_info::where('id' , $customer_rate_card->customer_id)->first();
        $trade_license_edit = new Trade_license_partners_edit_history;
        //customer edit history track
        $trade_license_edit->row_id = (int)$request->input('id');
        $trade_license_edit->trade_license_id =  $customer_rate_card->trade_license_id;
        $trade_license_edit->passport_copy =  $customer_rate_card->passport_copy;

        $trade_license_edit->passport_copy =  $customer_rate_card->passport_copy;
        $trade_license_edit->visa_copy =  $customer_rate_card->visa_copy;
        $trade_license_edit->other =  $customer_rate_card->other;
        $trade_license_edit->save();
       
        if($request->input('other') != ''){
            $customer_rate_card->other = $request->input('other');
        }

        if ($request->hasFile('id_copy')) {
            $name = time().'_'.str_replace(" ", "_", $request->id_copy->getClientOriginalName());
            $file = $request->file('id_copy');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
               

                $customer_rate_card->id_copy = $name;
               
            }  
        }
        


        if ($request->hasFile('visa_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->visa_copy->getClientOriginalName());
            $file = $request->file('visa_copy');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $customer_rate_card->visa_copy = $name;

            }  
        }

        if ($request->hasFile('passport_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->passport_copy->getClientOriginalName());
            $file = $request->file('passport_copy');
            if($file->storeAs('/main_admin/hr_pro/trade_license/', $name , ['disk' => 'public_uploads'])){
                $customer_rate_card->passport_copy = $name;

            }  
        }
    
        // $this->add_aprovals('customer_info');

            $customer_rate_card->status = 'pending';
            $customer_rate_card->action = 'edit';
            if($request->input('status_message') != ''){

                $customer_rate_card->status_message = $request->input('status_message');

            }

            $customer_rate_card->user_id = Auth::id();
            DB::enableQueryLog();
            $customer_rate_card->save();
            dd(DB::getQueryLog());

        
            return \Redirect::route('user.hr_pro.trade_license_partners',  $request->input('trade_id') )->with('success', 'Partner Edited Sucessfully');
        

    }

    public function delete_trade_license_partners(Request $request){
        $id =  (int)$request->input('id');
        $customer_rate_card = Trade_license_partners::where('id' , $id)->first();
        
        $customer_rate_card->status = 'pending';
        $customer_rate_card->status_message = $request->input('status_message');
        $customer_rate_card->user_id = Auth::id();
        $customer_rate_card->action = 'delete';

        if( $customer_rate_card->save()){
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);
        }
    }

        
    ///////////////////////////////////////////////////
    ///////// office contract land contact ////////////
    ///////////////////////////////////////////////////

    public function office_contract_land_contract(){
        $data['modules']= DB::table('modules')->get();

       
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        
        $data['page_title'] = "OFFICE(s) CONTRACT,LAND CONTRACTS";
        $data['view'] = 'hr_pro.office_land_contract.office_land_contract';
        return view('users.layout', ["data"=>$data]);
    }

    //office
    public function office_contract(){
        $data['modules']= DB::table('modules')->get();
        $data['office_contract'] = Office_Land_contract::where('type', '=', 'office')->get();
       
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        
        $data['page_title'] = "OFFICE(s) CONTRACT";
        $data['view'] = 'hr_pro.office_land_contract.office_contract.office_contract';
        return view('users.layout', ["data"=>$data]);
    }

    public function office_contracts_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     

        $data['trade_licenses_history']= DB::table('office__land_contract_histories')->where('type' , '=' ,'office' )->orderBy('updated_at')->get();
        $data['table_name']= 'office__land_contract_histories';
        $data['type']= 'office';
        

        $data['page_title'] = "History | Office Contracts ";
        $data['view'] = 'admin.hr_pro.history_type';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_office_contract(){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add OFFICE CONTRACT";
        $data['view'] = 'hr_pro.office_land_contract.office_contract.add_office_contract';
        return view('users.layout', ["data"=>$data]);
    }

    public function edit_office_contract(Request $request){

        $data['office_contract'] = Office_Land_contract::where('type', '=', 'office')->where('id' ,'=' , $request->input('id'))->first();

        $data['modules']= DB::table('modules')->get();
        
        $data['office_edit'] =  Office_land_contract_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        //  $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit OFFICE CONTRACT";
        $data['view'] = 'hr_pro.office_land_contract.office_contract.edit_office_contract';
        return view('users.layout', ["data"=>$data]);

    }

    
    public function save_office_contract(Request $request){
        $office_contract = new Office_Land_contract;

        if($request->input('contract_number') != ''){
            $office_contract->contract_number = $request->input('contract_number');
        }

        if($request->input('plot_details') != ''){
            $office_contract->plot_details = $request->input('plot_details');
        }

        if($request->input('landloard_name') != ''){
            $office_contract->landloard_name = $request->input('landloard_name');
        }

        if($request->input('contract_expiary_date') != ''){
            $office_contract->contract_expiary_date = $request->input('contract_expiary_date');
        }

        if($request->input('ijari_number') != ''){
            $office_contract->ijari_number = $request->input('ijari_number');
        }
        
        if ($request->hasFile('lease_rent')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->lease_rent->getClientOriginalName());
            $file = $request->file('lease_rent');
            if($file->storeAs('/main_admin/hr_pro/office_land_contract/', $name , ['disk' => 'public_uploads'])){
                $office_contract->lease_rent = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('ijari_certificate')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->ijari_certificate->getClientOriginalName());
            $file = $request->file('ijari_certificate');
            if($file->storeAs('/main_admin/hr_pro/office_land_contract/', $name , ['disk' => 'public_uploads'])){
                $office_contract->ijari_certificate = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if($request->input('amount') != ''){
            $office_contract->amount = $request->input('amount');
        }

        $office_contract->type = 'office';

        
        $this->add_aprovals('office__land_contracts');

        $office_contract->status = 'pending';

        if($request->input('status_message') != ''){

            $office_contract->status_message = $request->input('status_message');

        }

        $office_contract->user_id = Auth::id();
        $office_contract->action = 'add';

        $office_contract->save();

        return \Redirect::route('user.hr_pro.office_contracts')->with('success', 'Data Added Sucessfully');

    }

    public function update_office_contract(Request $request){
        $office_contract = Office_Land_contract::find($request->input('id'));
        // dd($request->input('id'));
        $trade_license_edit = new Office_land_contract_edit_history;
        //customer edit history track
        $trade_license_edit->row_id = (int)$request->input('id');
        $trade_license_edit->contract_number =  $office_contract->contract_number;

        $trade_license_edit->plot_details =  $office_contract->plot_details;
        $trade_license_edit->landloard_name =  $office_contract->landloard_name;
        $trade_license_edit->contract_expiary_date =  $office_contract->contract_expiary_date;
        $trade_license_edit->ijari_number =  $office_contract->ijari_number;
        $trade_license_edit->lease_rent =  $office_contract->lease_rent;
        $trade_license_edit->ijari_certificate =  $office_contract->ijari_certificate;
        $trade_license_edit->type =  $office_contract->type;

        $trade_license_edit->save();

        if($request->input('contract_number') != ''){
            $office_contract->contract_number = $request->input('contract_number');
        }

        if($request->input('plot_details') != ''){
            $office_contract->plot_details = $request->input('plot_details');
        }

        if($request->input('landloard_name') != ''){
            $office_contract->landloard_name = $request->input('landloard_name');
        }

        if($request->input('contract_expiary_date') != ''){
            $office_contract->contract_expiary_date = $request->input('contract_expiary_date');
        }

        if($request->input('ijari_number') != ''){
            $office_contract->ijari_number = $request->input('ijari_number');
        }
        
        if ($request->hasFile('lease_rent')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->lease_rent->getClientOriginalName());
            $file = $request->file('lease_rent');
            if($file->storeAs('/main_admin/hr_pro/office_land_contract/', $name , ['disk' => 'public_uploads'])){
                $office_contract->lease_rent = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('ijari_certificate')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->ijari_certificate->getClientOriginalName());
            $file = $request->file('ijari_certificate');
            if($file->storeAs('/main_admin/hr_pro/office_land_contract/', $name , ['disk' => 'public_uploads'])){
                $office_contract->ijari_certificate = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        $office_contract->type = 'office';

        $this->add_aprovals('office__land_contracts');

        $office_contract->status = 'pending';

        if($request->input('status_message') != ''){

            $office_contract->status_message = $request->input('status_message');

        }

        $office_contract->user_id = Auth::id();
        $office_contract->action = 'edit';

        $office_contract->save();

        return \Redirect::route('user.hr_pro.office_contracts')->with('success', 'Data Added Sucessfully');

    }

    public function delete_office_contract(Request $request){
        $office_contract = Office_Land_contract::find($request->input('id'));
        
           
    
        $office_contract->status = 'pending';
        $office_contract->status_message = $request->input('status_message');
        $office_contract->user_id = Auth::id();
        $office_contract->action = 'delete';


        if( $office_contract->save()){
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
        
        

    }

    public function view_office_contract(Request $request){
        $data['office_contract'] = Office_Land_contract::where('type', '=', 'office')->where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        //  $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "View OFFICE CONTRACT";
        $data['view'] = 'hr_pro.office_land_contract.office_contract.view_office_contract';
        return view('users.layout', ["data"=>$data]);
    }
    

    //Land
    public function land_contract(){
        $data['modules']= DB::table('modules')->get();
        $data['land_contract'] = Office_Land_contract::where('type', '=', 'land')->get();
       
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        
        $data['page_title'] = "Land CONTRACT";
        $data['view'] = 'hr_pro.office_land_contract.land_contract.land_contract';
        return view('users.layout', ["data"=>$data]);
    }

    public function land_contracts_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     

        $data['trade_licenses_history']= DB::table('office__land_contract_histories')->where('type' , '=' ,'land' )->get();
        $data['table_name']= 'office__land_contract_histories';
        $data['type']= 'land';
        

        $data['page_title'] = "History | Land Contracts ";
        $data['view'] = 'admin.hr_pro.history_type';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_land_contract(){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Land CONTRACT";
        $data['view'] = 'hr_pro.office_land_contract.land_contract.add_land_contract';
        return view('users.layout', ["data"=>$data]);
    }

    public function edit_land_contract(Request $request){

        $data['land_contract'] = Office_Land_contract::where('type', '=', 'land')->where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();

        $data['land_edit'] =  Office_land_contract_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();
       

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        //  $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Land CONTRACT";
        $data['view'] = 'hr_pro.office_land_contract.land_contract.edit_land_contract';
        return view('users.layout', ["data"=>$data]);

    }

    
    public function save_land_contract(Request $request){
        $office_contract = new Office_Land_contract;

        if($request->input('contract_number') != ''){
            $office_contract->contract_number = $request->input('contract_number');
        }

        if($request->input('plot_details') != ''){
            $office_contract->plot_details = $request->input('plot_details');
        }

        if($request->input('landloard_name') != ''){
            $office_contract->landloard_name = $request->input('landloard_name');
        }

        if($request->input('contract_expiary_date') != ''){
            $office_contract->contract_expiary_date = $request->input('contract_expiary_date');
        }

        if($request->input('ijari_number') != ''){
            $office_contract->ijari_number = $request->input('ijari_number');
        }
        
        if ($request->hasFile('lease_rent')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->lease_rent->getClientOriginalName());
            $file = $request->file('lease_rent');
            if($file->storeAs('/main_admin/hr_pro/office_land_contract/', $name , ['disk' => 'public_uploads'])){
                $office_contract->lease_rent = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('ijari_certificate')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->ijari_certificate->getClientOriginalName());
            $file = $request->file('ijari_certificate');
            if($file->storeAs('/main_admin/hr_pro/office_land_contract/', $name , ['disk' => 'public_uploads'])){
                $office_contract->ijari_certificate = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if($request->input('amount') != ''){
            $office_contract->amount = $request->input('amount');
        }

        $office_contract->type = 'land';

        
        $this->add_aprovals('office__land_contracts');

        $office_contract->status = 'pending';

        if($request->input('status_message') != ''){

            $office_contract->status_message = $request->input('status_message');

        }

        $office_contract->user_id = Auth::id();
        $office_contract->action = 'add';

        $office_contract->save();

        return \Redirect::route('user.hr_pro.land_contracts')->with('success', 'Data Added Sucessfully');

    }

    public function update_land_contract(Request $request){
        $office_contract = Office_Land_contract::find($request->input('id'));

        $trade_license_edit = new Office_land_contract_edit_history;
        //customer edit history track
        $trade_license_edit->row_id = (int)$request->input('id');
        $trade_license_edit->contract_number =  $office_contract->contract_number;

        $trade_license_edit->plot_details =  $office_contract->plot_details;
        $trade_license_edit->landloard_name =  $office_contract->landloard_name;
        $trade_license_edit->contract_expiary_date =  $office_contract->contract_expiary_date;
        $trade_license_edit->ijari_number =  $office_contract->ijari_number;
        $trade_license_edit->lease_rent =  $office_contract->lease_rent;
        $trade_license_edit->ijari_certificate =  $office_contract->ijari_certificate;
        $trade_license_edit->type =  $office_contract->type;

        $trade_license_edit->save();
        if($request->input('contract_number') != ''){
            $office_contract->contract_number = $request->input('contract_number');
        }

        if($request->input('plot_details') != ''){
            $office_contract->plot_details = $request->input('plot_details');
        }

        if($request->input('landloard_name') != ''){
            $office_contract->landloard_name = $request->input('landloard_name');
        }

        if($request->input('contract_expiary_date') != ''){
            $office_contract->contract_expiary_date = $request->input('contract_expiary_date');
        }

        if($request->input('ijari_number') != ''){
            $office_contract->ijari_number = $request->input('ijari_number');
        }
        
        if ($request->hasFile('lease_rent')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->lease_rent->getClientOriginalName());
            $file = $request->file('lease_rent');
            if($file->storeAs('/main_admin/hr_pro/office_land_contract/', $name , ['disk' => 'public_uploads'])){
                $office_contract->lease_rent = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('ijari_certificate')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->ijari_certificate->getClientOriginalName());
            $file = $request->file('ijari_certificate');
            if($file->storeAs('/main_admin/hr_pro/office_land_contract/', $name , ['disk' => 'public_uploads'])){
                $office_contract->ijari_certificate = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        $office_contract->type = 'land';
        
        $this->add_aprovals('office__land_contracts');

        $office_contract->status = 'pending';

        if($request->input('status_message') != ''){

            $office_contract->status_message = $request->input('status_message');

        }

        $office_contract->user_id = Auth::id();
        $office_contract->action = 'edit';

        $office_contract->save();

        return \Redirect::route('user.hr_pro.land_contracts')->with('success', 'Data Added Sucessfully');

    }

    public function delete_land_contract(Request $request){
        $office_contract = Office_Land_contract::find($request->input('id'));
        
           
    
        
        
           
    
        $office_contract->status = 'pending';
        $office_contract->status_message = $request->input('status_message');
        $office_contract->user_id = Auth::id();
        $office_contract->action = 'delete';


        if( $office_contract->save()){
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
        
        

    }

    public function view_land_contract(Request $request){
        $data['land_contract'] = Office_Land_contract::where('type', '=', 'land')->where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        //  $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "View Land CONTRACT";
        $data['view'] = 'hr_pro.office_land_contract.land_contract.view_land_contract';
        return view('users.layout', ["data"=>$data]);
    }

 

    ///////////////////////////////////////////////////
    ///////// mobiles_fuel_tanks_renewals /////////////
    ///////////////////////////////////////////////////

    public function mobiles_fuel_tanks_renewals(){
        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
          
        
        // if($data['permissions']->status != 1 ){
        //     abort(403);
        // }
        //$data['trade_licenses']= DB::table('trade_licenses')->get();
        //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "MOBILES FUEL TANKS RENEWALS(CIVIL DEFENSE AND MUNCIPALITY)";
        $data['view'] = 'hr_pro.mobiles_fuel_tanks_renewals.mobiles_fuel_tanks_renewals';
        return view('users.layout', ["data"=>$data]);
    }
    //civil defence
    public function mobile_civil_defence(){
        $data['modules']= DB::table('modules')->get();

        $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'mobile')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "MOBILE FUEL TANK RENEWALS (CIVIL DEFENSE)
        ";
        $data['view'] = 'hr_pro.mobiles_fuel_tanks_renewals.civil_defense.civil_defense';
        return view('users.layout', ["data"=>$data]);
    }

    public function mobile_civil_defence_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     

        $data['trade_licenses_history']= DB::table('civil_defense_documents_histories')->where('type' , '=' ,'mobile' )->get();
        $data['table_name']= 'civil_defense_documents_histories';
        $data['type']= 'mobile';
        

        $data['page_title'] = "History | MOBILE FUEL TANK RENEWALS (Civial Defence)
        ";
        $data['view'] = 'admin.hr_pro.history_type';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_mobile_civil_defence(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add MOBILE FUEL TANK RENEWALS (CIVIL DEFENSE)
        ";
        $data['view'] = 'hr_pro.mobiles_fuel_tanks_renewals.civil_defense.add_civil_defense';
        return view('users.layout', ["data"=>$data]);

    }

    public function edit_mobile_civil_defence(Request $request){

        $data['civil_defense'] = Civil_defense_documents::where('type', '=', 'mobile')->where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();
        
        $data['civil_defense_edit'] = Civil_defense_files_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit MOBILE FUEL TANK RENEWALS (CIVIL DEFENSE)
        ";
        $data['view'] = 'hr_pro.mobiles_fuel_tanks_renewals.civil_defense.edit_civil_defense';
        return view('users.layout', ["data"=>$data]);

    }

    public function save_mobile_civil_defence(Request $request){
        $civil_defense = new Civil_defense_documents;

        if($request->input('expiary_date') != ''){
            $civil_defense->expiary_date = $request->input('expiary_date');
        }
        
        if ($request->hasFile('document')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->document->getClientOriginalName());
            $file = $request->file('document');
            if($file->storeAs('/main_admin/hr_pro/mobile_fuel_tank_renewals/', $name , ['disk' => 'public_uploads'])){
                $civil_defense->document = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }
        $civil_defense->type = 'mobile';

        $this->add_aprovals('civil_defense_files');

        $civil_defense->status = 'pending';

        if($request->input('status_message') != ''){

            $civil_defense->status_message = $request->input('status_message');

        }

        $civil_defense->user_id = Auth::id();
        $civil_defense->action = 'add';

        $civil_defense->save();

        return \Redirect::route('user.hr_pro.mobile_civil_defence')->with('success', 'Data Added Sucessfully');

    }

    public function update_mobile_civil_defence(Request $request){
        $civil_defense = Civil_defense_documents::find($request->input('id'));

        $trade_license_edit = new  Civil_defense_files_edit_history;
        //customer edit history track
        $trade_license_edit->row_id = (int)$request->input('id');
        $trade_license_edit->expiary_date =  $civil_defense->expiary_date;
        $trade_license_edit->document =  $civil_defense->document;
        
        $trade_license_edit->save();

        if($request->input('expiary_date') != ''){
            $civil_defense->expiary_date = $request->input('expiary_date');
        }
        
        if ($request->hasFile('document')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->document->getClientOriginalName());
            $file = $request->file('document');
            if($file->storeAs('/main_admin/hr_pro/mobile_fuel_tank_renewals/', $name , ['disk' => 'public_uploads'])){
                $civil_defense->document = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }
        $civil_defense->type = 'mobile';

        $this->add_aprovals('civil_defense_files');

        $civil_defense->status = 'pending';

        if($request->input('status_message') != ''){

            $civil_defense->status_message = $request->input('status_message');

        }

        $civil_defense->user_id = Auth::id();
        $civil_defense->action = 'edit';


        $civil_defense->save();

        return \Redirect::route('user.hr_pro.mobile_civil_defence')->with('success', 'Data Updated Sucessfully');
    }

    public function delete_mobile_civil_defence(Request $request){
        $civil_defense = Civil_defense_documents::find($request->input('id'));

        $civil_defense->status = 'pending';
        $civil_defense->status_message = $request->input('status_message');
        $civil_defense->user_id = Auth::id();
        $civil_defense->action = 'delete';

       if($civil_defense->save()){
           return response()->json(['status'=>'1']);
       }else{
           return response()->json(['status'=>'0']);
       }
    }

    //muncipality
    public function mobile_muncipality(){
        $data['modules']= DB::table('modules')->get();

        $data['muncipality'] = Muncipality_documents::where('type', '=', 'mobile')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "MOBILE FUEL TANK RENEWALS (Muncipality)
        ";
        $data['view'] = 'hr_pro.mobiles_fuel_tanks_renewals.muncipality.muncipality';
        return view('users.layout', ["data"=>$data]);
    }

    public function mobile_muncipality_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     

        $data['trade_licenses_history']= DB::table('muncipality_documents_histories')->where('type' , '=' ,'mobile' )->get();
        $data['table_name']= 'muncipality_documents_histories';
        $data['type']= 'mobile';
        

        $data['page_title'] = "History | MOBILE FUEL TANK RENEWALS (Muncipality)
        ";
        $data['view'] = 'admin.hr_pro.history_type';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_mobile_muncipality(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add MOBILE FUEL TANK RENEWALS (muncipality)
        ";
        $data['view'] = 'hr_pro.mobiles_fuel_tanks_renewals.muncipality.add_muncipality';
        return view('users.layout', ["data"=>$data]);

    }

    public function edit_mobile_muncipality(Request $request){

        $data['muncipality'] = Muncipality_documents::where('type', '=', 'mobile')->where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();
        
        $data['muncipality_edit'] = Muncipality_documents_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();


        
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit MOBILE FUEL TANK RENEWALS (Muncipality)
        ";
        $data['view'] = 'hr_pro.mobiles_fuel_tanks_renewals.muncipality.edit_muncipality';
        return view('users.layout', ["data"=>$data]);

    }

    public function save_mobile_muncipality(Request $request){
        $muncipality = new Muncipality_documents;

        if($request->input('expiary_date') != ''){
            $muncipality->expiary_date = $request->input('expiary_date');
        }
        
        if ($request->hasFile('document')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->document->getClientOriginalName());
            $file = $request->file('document');
            if($file->storeAs('/main_admin/hr_pro/mobile_fuel_tank_renewals/', $name , ['disk' => 'public_uploads'])){
                $muncipality->document = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }
        $muncipality->type = 'mobile';

        $this->add_aprovals('muncipality_documents');

        $muncipality->status = 'pending';

        if($request->input('status_message') != ''){

            $muncipality->status_message = $request->input('status_message');

        }

        $muncipality->user_id = Auth::id();
        $muncipality->action = 'add';

        $muncipality->save();

        return \Redirect::route('user.hr_pro.mobile_muncipality')->with('success', 'Data Added Sucessfully');

    }

    public function update_mobile_muncipality(Request $request){
        $muncipality = Muncipality_documents::find($request->input('id'));

        $trade_license_edit = new   Muncipality_documents_edit_history;
        //customer edit history track
        $trade_license_edit->row_id = (int)$request->input('id');
        $trade_license_edit->expiary_date =  $muncipality->expiary_date;
        $trade_license_edit->document =  $muncipality->document;
        
        $trade_license_edit->save();

        if($request->input('expiary_date') != ''){
            $muncipality->expiary_date = $request->input('expiary_date');
        }
        
        if ($request->hasFile('document')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->document->getClientOriginalName());
            $file = $request->file('document');
            if($file->storeAs('/main_admin/hr_pro/mobile_fuel_tank_renewals/', $name , ['disk' => 'public_uploads'])){
                $muncipality->document = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }
        $muncipality->type = 'mobile';

        $this->add_aprovals('muncipality_documents');

        $muncipality->status = 'pending';

        if($request->input('status_message') != ''){

            $muncipality->status_message = $request->input('status_message');

        }

        $muncipality->user_id = Auth::id();
        $muncipality->action = 'edit';

        $muncipality->save();

        return \Redirect::route('user.hr_pro.mobile_muncipality')->with('success', 'Data Updated Sucessfully');
    }
    public function delete_mobile_muncipality(Request $request){
        $civil_defense = Muncipality_documents::find($request->input('id'));

        $civil_defense->status = 'pending';
        $civil_defense->status_message = $request->input('status_message');
        $civil_defense->user_id = Auth::id();
        $civil_defense->action = 'delete';

       if($civil_defense->save()){
           return response()->json(['status'=>'1']);
       }else{
           return response()->json(['status'=>'0']);
       }
    }


    ///////////////////////////////////////////////////
    ///////// non_mobiles_fuel_tanks_renewals /////////
    ///////////////////////////////////////////////////

    public function non_mobiles_fuel_tanks_renewals(){
        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
          
        
        // if($data['permissions']->status != 1 ){
        //     abort(403);
        // }
        //$data['trade_licenses']= DB::table('trade_licenses')->get();
        //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "NON MOBILES FUEL TANKS RENEWALS(CIVIL DEFENSE AND MUNCIPALITY)";
        $data['view'] = 'hr_pro.non_mobiles_fuel_tanks_renewals.non_mobiles_fuel_tanks_renewals';
        return view('users.layout', ["data"=>$data]);
    }
    //civil defence
    public function non_mobile_civil_defence(){
        $data['modules']= DB::table('modules')->get();

        $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'non_mobile')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "NON MOBILE FUEL TANK RENEWALS (CIVIL DEFENSE)
        ";
        $data['view'] = 'hr_pro.non_mobiles_fuel_tanks_renewals.civil_defense.civil_defense';
        return view('users.layout', ["data"=>$data]);
    }

    public function non_mobile_civil_defence_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     

        $data['trade_licenses_history']= DB::table('civil_defense_documents_histories')->where('type' , '=' ,'non_mobile' )->get();
        $data['table_name']= 'civil_defense_documents_histories';
        $data['type']= 'non_mobile';
        

        $data['page_title'] = "History | NON MOBILE FUEL TANK RENEWALS (CIVIL DEFENSE)";
        $data['view'] = 'admin.hr_pro.history_type';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_non_mobile_civil_defence(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add NON MOBILE FUEL TANK RENEWALS (CIVIL DEFENSE)
        ";
        $data['view'] = 'hr_pro.non_mobiles_fuel_tanks_renewals.civil_defense.add_civil_defense';
        return view('users.layout', ["data"=>$data]);

    }

    public function edit_non_mobile_civil_defence(Request $request){

        $data['civil_defense'] = Civil_defense_documents::where('type', '=', 'non_mobile')->where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();
        
        $data['civil_defense_edit'] = Civil_defense_files_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();
        
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit NON MOBILE FUEL TANK RENEWALS (CIVIL DEFENSE)
        ";
        $data['view'] = 'hr_pro.non_mobiles_fuel_tanks_renewals.civil_defense.edit_civil_defense';
        return view('users.layout', ["data"=>$data]);

    }

    public function save_non_mobile_civil_defence(Request $request){
        $civil_defense = new Civil_defense_documents;

        if($request->input('expiary_date') != ''){
            $civil_defense->expiary_date = $request->input('expiary_date');
        }
        
        if ($request->hasFile('document')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->document->getClientOriginalName());
            $file = $request->file('document');
            if($file->storeAs('/main_admin/hr_pro/non_mobile_fuel_tank_renewals/', $name , ['disk' => 'public_uploads'])){
                $civil_defense->document = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        $civil_defense->type = 'non_mobile';

        $this->add_aprovals('civil_defense_files');

        $civil_defense->status = 'pending';

        if($request->input('status_message') != ''){

            $civil_defense->status_message = $request->input('status_message');

        }

        $civil_defense->user_id = Auth::id();
        $civil_defense->action = 'add';

        $civil_defense->save();

        return \Redirect::route('user.hr_pro.non_mobile_civil_defence')->with('success', 'Data Added Sucessfully');

    }

    public function update_non_mobile_civil_defence(Request $request){
        $civil_defense = Civil_defense_documents::find($request->input('id'));

        $trade_license_edit = new   Civil_defense_files_edit_history;
        //customer edit history track
        $trade_license_edit->row_id = (int)$request->input('id');
        $trade_license_edit->expiary_date =  $civil_defense->expiary_date;
        $trade_license_edit->document =  $civil_defense->document;
        
        $trade_license_edit->save();

        if($request->input('expiary_date') != ''){
            $civil_defense->expiary_date = $request->input('expiary_date');
        }
        
        if ($request->hasFile('document')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->document->getClientOriginalName());
            $file = $request->file('document');
            if($file->storeAs('/main_admin/hr_pro/non_mobile_fuel_tank_renewals/', $name , ['disk' => 'public_uploads'])){
                $civil_defense->document = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }
        $civil_defense->type = 'non_mobile';

        $this->add_aprovals('civil_defense_files');

        $civil_defense->status = 'pending';

        if($request->input('status_message') != ''){

            $civil_defense->status_message = $request->input('status_message');

        }

        $civil_defense->user_id = Auth::id();
        $civil_defense->action = 'edit';

        $civil_defense->save();

        return \Redirect::route('user.hr_pro.non_mobile_civil_defence')->with('success', 'Data Updated Sucessfully');
    }

    public function delete_non_mobile_civil_defence(Request $request){
        $civil_defense = Civil_defense_documents::find($request->input('id'));
        
        $civil_defense->status = 'pending';
        $civil_defense->status_message = $request->input('status_message');
        $civil_defense->user_id = Auth::id();
        $civil_defense->action = 'delete';

       if($civil_defense->save()){
           return response()->json(['status'=>'1']);
       }else{
           return response()->json(['status'=>'0']);
       }
    }

    //muncipality
    public function non_mobile_muncipality(){
        $data['modules']= DB::table('modules')->get();

        $data['muncipality'] = Muncipality_documents::where('type', '=', 'non_mobile')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "NON MOBILE FUEL TANK RENEWALS (Muncipality)
        ";
        $data['view'] = 'hr_pro.non_mobiles_fuel_tanks_renewals.muncipality.muncipality';
        return view('users.layout', ["data"=>$data]);
    }

    public function non_mobile_muncipality_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     

        $data['trade_licenses_history']= DB::table('muncipality_documents_histories')->where('type' , '=' ,'non_mobile' )->get();
        $data['table_name']= 'muncipality_documents_histories';
        $data['type']= 'non_mobile';
        

        $data['page_title'] = "History | NON MOBILE FUEL TANK RENEWALS (Muncipality)
        ";
        $data['view'] = 'admin.hr_pro.history_type';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_non_mobile_muncipality(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add NON MOBILE FUEL TANK RENEWALS (muncipality)
        ";
        $data['view'] = 'hr_pro.non_mobiles_fuel_tanks_renewals.muncipality.add_muncipality';
        return view('users.layout', ["data"=>$data]);

    }

    public function edit_non_mobile_muncipality(Request $request){

        $data['muncipality'] = Muncipality_documents::where('type', '=', 'non_mobile')->where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();
        
        $data['muncipality_edit'] = Muncipality_documents_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();
        
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit NON MOBILE FUEL TANK RENEWALS (Muncipality)
        ";
        $data['view'] = 'hr_pro.non_mobiles_fuel_tanks_renewals.muncipality.edit_muncipality';
        return view('users.layout', ["data"=>$data]);

    }

    public function save_non_mobile_muncipality(Request $request){
        $muncipality = new Muncipality_documents;

        if($request->input('expiary_date') != ''){
            $muncipality->expiary_date = $request->input('expiary_date');
        }
        
        if ($request->hasFile('document')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->document->getClientOriginalName());
            $file = $request->file('document');
            if($file->storeAs('/main_admin/hr_pro/non_mobile_fuel_tank_renewals/', $name , ['disk' => 'public_uploads'])){
                $muncipality->document = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }
        $muncipality->type = 'non_mobile';


        $this->add_aprovals('muncipality_documents');

        $muncipality->status = 'pending';

        if($request->input('status_message') != ''){

            $muncipality->status_message = $request->input('status_message');

        }

        $muncipality->user_id = Auth::id();
        $muncipality->action = 'add';

        $muncipality->save();

        return \Redirect::route('user.hr_pro.non_mobile_muncipality')->with('success', 'Data Added Sucessfully');

    }

    public function update_non_mobile_muncipality(Request $request){
        $muncipality = Muncipality_documents::find($request->input('id'));

        $trade_license_edit = new   Muncipality_documents_edit_history;
        //customer edit history track
        $trade_license_edit->row_id = (int)$request->input('id');
        $trade_license_edit->expiary_date =  $muncipality->expiary_date;
        $trade_license_edit->document =  $muncipality->document;
        
        $trade_license_edit->save();


        if($request->input('expiary_date') != ''){
            $muncipality->expiary_date = $request->input('expiary_date');
        }
        
        if ($request->hasFile('document')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->document->getClientOriginalName());
            $file = $request->file('document');
            if($file->storeAs('/main_admin/hr_pro/non_mobile_fuel_tank_renewals/', $name , ['disk' => 'public_uploads'])){
                $muncipality->document = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }
        $muncipality->type = 'non_mobile';

        $this->add_aprovals('muncipality_documents');

        $muncipality->status = 'pending';

        if($request->input('status_message') != ''){

            $muncipality->status_message = $request->input('status_message');

        }

        $muncipality->user_id = Auth::id();
        $muncipality->action = 'edit';


        $muncipality->save();

        return \Redirect::route('user.hr_pro.non_mobile_muncipality')->with('success', 'Data Updated Sucessfully');
    }

    public function delete_non_mobile_muncipality(Request $request){
        $civil_defense = Muncipality_documents::find($request->input('id'));

        $civil_defense->status = 'pending';
        $civil_defense->status_message = $request->input('status_message');
        $civil_defense->user_id = Auth::id();
        $civil_defense->action = 'delete';

       if($civil_defense->save()){
           return response()->json(['status'=>'1']);
       }else{
           return response()->json(['status'=>'0']);
       }
    }


    //////////////////////////////////////////
    /////////Login and  Password ////////////
    /////////////////////////////////////////
    public function login_password(){

        $data['modules']= DB::table('modules')->get();
        $data['land_contract'] = Office_Land_contract::where('type', '=', 'land')->get();
       
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        
        $data['page_title'] = "Login Access and  Password";
        $data['view'] = 'hr_pro.login_passwords.login_password';
        return view('users.layout', ["data"=>$data]);
    }

    public function save_login_password(Request $request){
        $old_login = Login_password::all();
        if($old_login != null){
           $old_login[0]->body =  $request->input('body');
           $old_login[0]->status =  'approved';
           $old_login[0]->user_id = 0;
           if($old_login[0]->save()){
              
   
               return \Redirect::route('admin.hr_pro.login_access_and_passwords')->with('success', 'Data Added Sucessfully');
             }else{
               return \Redirect::route('admin.hr_pro.login_access_and_passwords')->with('error', 'Something wrong');
             }
        }
        $login_password =  new Login_password;
        $login_password->body =   $request->input('body');

        $login_password->status = 'approved';

        $login_password->user_id = 0;


        if($login_password->save()){
         

          return \Redirect::route('admin.hr_pro.login_access_and_passwords')->with('success', 'Data Added Sucessfully');
        }else{
          return \Redirect::route('admin.hr_pro.login_access_and_passwords')->with('error', 'Something wrong');
        }
    }

    /////////////////////////////////////////////////////
    /////////Non Mobile Trained Individuals ////////////
    ///////////////////////////////////////////////////

    //trained indidulas
    public function non_mobile_trained_individual(){
        $data['modules']= DB::table('modules')->get();
        $data['trained_individual'] = Trained_individual::where('type', '=', 'non_mobile')->get();
        
       
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        
        $data['page_title'] = "Trained Individual Non Mobile Fuel Tank";
        $data['view'] = 'hr_pro.non_mobiles_fuel_tanks_renewals.trained_individual.trained_individual';
        return view('users.layout', ["data"=>$data]);
    }

    public function non_mobile_trained_individual_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     

        $data['trade_licenses_history']= DB::table('trained_individuals_histories')->where('type' , '=' ,'non_mobile' )->get();
        $data['table_name']= 'trained_individuals_histories';
        $data['type']= 'non_mobile';
        

        $data['page_title'] = "History | NON MOBILE FUEL TANK Trained Individual
        ";
        $data['view'] = 'admin.hr_pro.history_type';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_non_mobile_trained_individual(){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
       

        $data['page_title'] = "Add Trained Individual Non Mobile Fuel Tank";
        $data['view'] = 'hr_pro.non_mobiles_fuel_tanks_renewals.trained_individual.add_trained_individual';
        return view('users.layout', ["data"=>$data]);
    }

    public function edit_non_mobile_trained_individual(Request $request){

        $data['trained_individual'] = Trained_individual::where('id' ,'=' , $request->input('id'))->first();

        
        $data['modules']= DB::table('modules')->get();
        
        $data['trained_individual_edit'] = Trained_individual_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        //  $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Trained Individual Non Mobile Fuel Tank";
        $data['view'] = 'hr_pro.non_mobiles_fuel_tanks_renewals.trained_individual.edit_trained_individual';
        return view('users.layout', ["data"=>$data]);

    }

    
    public function save_non_mobile_trained_individual(Request $request){
        $trained_individual = new Trained_individual;

        if($request->input('card_number') != ''){
            $trained_individual->card_number = $request->input('card_number');
        }

        if($request->input('employee_name') != ''){
            $trained_individual->employee_name = $request->input('employee_name');
        }


        if($request->input('expiary_date') != ''){
            $trained_individual->expiary_date = $request->input('expiary_date');
        }

        
        
        if ($request->hasFile('front_pic')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->front_pic->getClientOriginalName());
            $file = $request->file('front_pic');
            if($file->storeAs('/main_admin/hr_pro/trained_individual/', $name , ['disk' => 'public_uploads'])){
                $trained_individual->front_pic = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('back_pic')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->back_pic->getClientOriginalName());
            $file = $request->file('back_pic');
            if($file->storeAs('/main_admin/hr_pro/trained_individual/', $name , ['disk' => 'public_uploads'])){
                $trained_individual->back_pic = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('pass_card')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->pass_card->getClientOriginalName());
            $file = $request->file('pass_card');
            if($file->storeAs('/main_admin/hr_pro/trained_individual/', $name , ['disk' => 'public_uploads'])){
                $trained_individual->pass_card = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        $this->add_aprovals('trained_individuals');

        $trained_individual->status = 'pending';

        if($request->input('status_message') != ''){

            $trained_individual->status_message = $request->input('status_message');

        }

        $trained_individual->user_id = Auth::id();
        $trained_individual->action = 'add';

        $trained_individual->type = 'non_mobile';
        $trained_individual->save();

        return \Redirect::route('user.hr_pro.non_mobile_trained_individual')->with('success', 'Data Added Sucessfully');

    }

    public function update_non_mobile_trained_individual(Request $request){
        $trained_individual = Trained_individual::find($request->input('id'));

        $trade_license_edit = new Trained_individual_edit_history;
        //customer edit history track
        $trade_license_edit->row_id = (int)$request->input('id');
        $trade_license_edit->card_number =  $trained_individual->card_number;
        $trade_license_edit->employee_name =  $trained_individual->employee_name;
        $trade_license_edit->pass_card =  $trained_individual->pass_card;
        $trade_license_edit->front_pic =  $trained_individual->front_pic;
        $trade_license_edit->expiary_date =  $trained_individual->expiary_date;
        $trade_license_edit->back_pic =  $trained_individual->back_pic;
        $trade_license_edit->save();

        if($request->input('card_number') != ''){
            $trained_individual->card_number = $request->input('card_number');
        }

        if($request->input('employee_name') != ''){
            $trained_individual->employee_name = $request->input('employee_name');
        }


        if($request->input('expiary_date') != ''){
            $trained_individual->expiary_date = $request->input('expiary_date');
        }

        
        
        if ($request->hasFile('front_pic')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->front_pic->getClientOriginalName());
            $file = $request->file('front_pic');
            if($file->storeAs('/main_admin/hr_pro/trained_individual/', $name , ['disk' => 'public_uploads'])){
                $trained_individual->front_pic = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('back_pic')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->back_pic->getClientOriginalName());
            $file = $request->file('back_pic');
            if($file->storeAs('/main_admin/hr_pro/trained_individual/', $name , ['disk' => 'public_uploads'])){
                $trained_individual->back_pic = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('pass_card')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->pass_card->getClientOriginalName());
            $file = $request->file('pass_card');
            if($file->storeAs('/main_admin/hr_pro/trained_individual/', $name , ['disk' => 'public_uploads'])){
                $trained_individual->pass_card = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }
        $trained_individual->type = 'non_mobile';

        $this->add_aprovals('trained_individuals');

        $trained_individual->status = 'pending';

        if($request->input('status_message') != ''){

            $trained_individual->status_message = $request->input('status_message');

        }

        $trained_individual->user_id = Auth::id();
        $trained_individual->action = 'edit';

        $trained_individual->save();

        return \Redirect::route('user.hr_pro.non_mobile_trained_individual')->with('success', 'Data Added Sucessfully');

    }

    public function delete_non_mobile_trained_individual(Request $request){
        $trained_individual = Trained_individual::find($request->input('id'));
        
        $trained_individual->status = 'pending';
        $trained_individual->status_message = $request->input('status_message');
        $trained_individual->user_id = Auth::id();
        $trained_individual->action = 'delete';
    
    
        if($trained_individual->save()){
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function view_non_mobile_trained_individual(Request $request){
        $data['trained_individual'] = Trained_individual::where('id' ,'=' , $request->input('id'))->first();

        
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        //  $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "View Trained Individual Non Mobile Fuel Tank";
        $data['view'] = 'hr_pro.non_mobiles_fuel_tanks_renewals.trained_individual.view_trained_individual';
        return view('users.layout', ["data"=>$data]);
    }

    /////////////////////////////////////////////////////
    ///////// Mobile Trained Individuals ////////////
    ///////////////////////////////////////////////////

    //trained indidulas
    public function mobiles_trained_individual(){
        $data['modules']= DB::table('modules')->get();
        $data['trained_individual'] = Trained_individual::where('type', '=', 'mobile')->get();
        
       
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        
        $data['page_title'] = "Trained Individual  Mobile Fuel Tank";
        $data['view'] = 'hr_pro.mobiles_fuel_tanks_renewals.trained_individual.trained_individual';
        return view('users.layout', ["data"=>$data]);
    }

    public function mobiles_trained_individual_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     

        $data['trade_licenses_history']= DB::table('trained_individuals_histories')->where('type' , '=' ,'mobile' )->get();
        $data['table_name']= 'trained_individuals_histories';
        $data['type']= 'mobile';
        

        $data['page_title'] = "History | MOBILE FUEL TANK Trained Individual
        ";
        $data['view'] = 'admin.hr_pro.history_type';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_mobiles_trained_individual(){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
       

        $data['page_title'] = "Add Trained Individual  Mobile Fuel Tank";
        $data['view'] = 'hr_pro.mobiles_fuel_tanks_renewals.trained_individual.add_trained_individual';
        return view('users.layout', ["data"=>$data]);
    }

    public function edit_mobiles_trained_individual(Request $request){

        $data['trained_individual'] = Trained_individual::where('id' ,'=' , $request->input('id'))->first();

        
        $data['modules']= DB::table('modules')->get();
        
        $data['trained_individual_edit'] = Trained_individual_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        //  $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Trained Individual  Mobile Fuel Tank";
        $data['view'] = 'hr_pro.mobiles_fuel_tanks_renewals.trained_individual.edit_trained_individual';
        return view('users.layout', ["data"=>$data]);

    }

    
    public function save_mobiles_trained_individual(Request $request){
        $trained_individual = new Trained_individual;

        if($request->input('card_number') != ''){
            $trained_individual->card_number = $request->input('card_number');
        }

        if($request->input('employee_name') != ''){
            $trained_individual->employee_name = $request->input('employee_name');
        }


        if($request->input('expiary_date') != ''){
            $trained_individual->expiary_date = $request->input('expiary_date');
        }

        
        
        if ($request->hasFile('front_pic')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->front_pic->getClientOriginalName());
            $file = $request->file('front_pic');
            if($file->storeAs('/main_admin/hr_pro/trained_individual/', $name , ['disk' => 'public_uploads'])){
                $trained_individual->front_pic = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('back_pic')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->back_pic->getClientOriginalName());
            $file = $request->file('back_pic');
            if($file->storeAs('/main_admin/hr_pro/trained_individual/', $name , ['disk' => 'public_uploads'])){
                $trained_individual->back_pic = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('pass_card')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->pass_card->getClientOriginalName());
            $file = $request->file('pass_card');
            if($file->storeAs('/main_admin/hr_pro/trained_individual/', $name , ['disk' => 'public_uploads'])){
                $trained_individual->pass_card = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }


        $this->add_aprovals('trained_individuals');

        $trained_individual->status = 'pending';

        if($request->input('status_message') != ''){

            $trained_individual->status_message = $request->input('status_message');

        }

        $trained_individual->user_id = Auth::id();
        $trained_individual->action = 'add';

        $trained_individual->type = 'mobile';
        $trained_individual->save();

        return \Redirect::route('user.hr_pro.mobile_trained_individual')->with('success', 'Data Added Sucessfully');

    }

    public function update_mobiles_trained_individual(Request $request){
        $trained_individual = Trained_individual::find($request->input('id'));

        $trade_license_edit = new Trained_individual_edit_history;
        //customer edit history track
        $trade_license_edit->row_id = (int)$request->input('id');
        $trade_license_edit->card_number =  $trained_individual->card_number;
        $trade_license_edit->employee_name =  $trained_individual->employee_name;
        $trade_license_edit->pass_card =  $trained_individual->pass_card;
        $trade_license_edit->front_pic =  $trained_individual->front_pic;
        $trade_license_edit->expiary_date =  $trained_individual->expiary_date;
        $trade_license_edit->back_pic =  $trained_individual->back_pic;
        $trade_license_edit->save();

        if($request->input('card_number') != ''){
            $trained_individual->card_number = $request->input('card_number');
        }

        if($request->input('employee_name') != ''){
            $trained_individual->employee_name = $request->input('employee_name');
        }


        if($request->input('expiary_date') != ''){
            $trained_individual->expiary_date = $request->input('expiary_date');
        }

        
        
        if ($request->hasFile('front_pic')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->front_pic->getClientOriginalName());
            $file = $request->file('front_pic');
            if($file->storeAs('/main_admin/hr_pro/trained_individual/', $name , ['disk' => 'public_uploads'])){
                $trained_individual->front_pic = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('back_pic')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->back_pic->getClientOriginalName());
            $file = $request->file('back_pic');
            if($file->storeAs('/main_admin/hr_pro/trained_individual/', $name , ['disk' => 'public_uploads'])){
                $trained_individual->back_pic = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }

        if ($request->hasFile('pass_card')) {
            
            // $request->validate([
            //     'trade_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);
            
            $name = time().'_'.str_replace(" ", "_", $request->pass_card->getClientOriginalName());
            $file = $request->file('pass_card');
            if($file->storeAs('/main_admin/hr_pro/trained_individual/', $name , ['disk' => 'public_uploads'])){
                $trained_individual->pass_card = $name;

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }
        $trained_individual->type = 'mobile';

        $this->add_aprovals('trained_individuals');

        $trained_individual->status = 'pending';

        if($request->input('status_message') != ''){

            $trained_individual->status_message = $request->input('status_message');

        }

        $trained_individual->user_id = Auth::id();
        $trained_individual->action = 'edit';

        $trained_individual->save();

        return \Redirect::route('user.hr_pro.mobile_trained_individual')->with('success', 'Data Added Sucessfully');

    }

    public function delete_mobiles_trained_individual(Request $request){
        $trained_individual = Trained_individual::find($request->input('id'));
    
        $trained_individual->status = 'pending';
        $trained_individual->status_message = $request->input('status_message');
        $trained_individual->user_id = Auth::id();
        $trained_individual->action = 'delete';

        if($trained_individual->save()){
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function view_mobiles_trained_individual(Request $request){
        $data['trained_individual'] = Trained_individual::where('id' ,'=' , $request->input('id'))->first();

        
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        //  $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "View Trained Individual  Mobile Fuel Tank";
        $data['view'] = 'hr_pro.mobiles_fuel_tanks_renewals.trained_individual.view_trained_individual';
        return view('users.layout', ["data"=>$data]);
    }

}