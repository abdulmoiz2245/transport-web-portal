<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\User;
use App\Models\Roles;
use App\Models\Company_name;
use App\Models\Trade_license;
use App\Models\Trade_license_history;

use App\Models\Permissions;
use App\Models\Login_password;
use App\Models\Office_Land_contract;
use App\Models\Modules;
use App\Models\Civil_defense_documents;
use App\Models\Muncipality_documents;
use App\Models\Trained_individual;
use App\Models\Approvals;



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
        $this->middleware('auth:admin');
    }

    public function hr_pro(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        
        $data['page_title'] = "HR-PRO";
        $data['view'] = 'admin.hr_pro.hr_pro';
        return view('layout', ["data"=>$data]);
    }

    

    /////////////////////////////////
    ///////// Company Name /////////
    /////////////////////////////////


    public function add_comany_name(){
        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        
        $data['page_title'] = "Add Comany Name";
        $data['view'] = 'admin.hr_pro.company_name.add_company';
        return view('layout', ["data"=>$data]);
    }

    public function save_company(Request $request){

        $Company_name = new Company_name;
        $Company_name->name = $request->input('name');
        $Company_name->save();

        return \Redirect::route('admin.hr_pro.trade_license__sponsors__partners')->with('success', 'Data Added Sucessfully');

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
        $data['view'] = 'admin.hr_pro.trade_license.trade_license';
        return view('layout', ["data"=>$data]);
    }

    public function trash_trade_license(){
        $data['modules']= DB::table('modules')->get();
        $data['trade_licenses']= DB::table('trade_licenses')->get();
        $data['company_names']= DB::table('company_names')->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "Trade License Trash";
        $data['view'] = 'admin.hr_pro.trade_license.deleted_data';
        return view('layout', ["data"=>$data]);
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
        return view('layout', ["data"=>$data]);
    }

    public function add_trade_license(){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add TRADE LICENSE,SPONSORS, PARTNERS";
        $data['view'] = 'admin.hr_pro.trade_license.add_trade_license';
        return view('layout', ["data"=>$data]);
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
        $data['view'] = 'admin.hr_pro.trade_license.view_trade_license';
        return view('layout', ["data"=>$data]);
    }

    public function edit_trade_license (Request $request){
        $data['trade_license'] = Trade_license::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit TRADE LICENSE,SPONSORS, PARTNERS";
        $data['view'] = 'admin.hr_pro.trade_license.edit_trade_license';
        return view('layout', ["data"=>$data]);
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

        if($request->input('sponsorship_fee') != ''){
            $trade_license->sponsorship_fee = $request->input('sponsorship_fee');

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

        $trade_license->status = 'approved';
 
        $trade_license->user_id = 0;
        // dd('working');

        // $this->history_table('trade_license_histories', 'add' , 0);
        


        if($trade_license->save()){
            $this->history_table('trade_license_histories', 'Add' , 0 , $trade_license->id , 'hr_pro.view_trade_license__sponsors__partners');
            return \Redirect::route('admin.hr_pro.trade_license__sponsors__partners')->with('success', 'Data Added Sucessfully');
        }
        


    }

    public function update_trade_license(Request $request){
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


        

        $trade_license->status_message = $request->input('status_message');
        if( $trade_license->user_id != 0){
            $user_id  = $trade_license->user_id;
            
        }else{
            $user_id  = 0;
        }
        // dd($trade_license->action );

        if($trade_license->action == null || $trade_license->status == 'approved' ||$trade_license->action == 'nill'){
            $trade_license->action = 'edit';
        }
        $trade_license->status = $request->input('status');


        $trade_license->save();

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }
        if($trade_license->status == 'approved' || $trade_license->user_id == 0 ){
            //  $this->history_table('trade_license_histories', $trade_license->action , $user_id);
             $this->history_table('trade_license_histories', $trade_license->action , $user_id , $trade_license->id , 'hr_pro.view_trade_license__sponsors__partners');
        }


        return \Redirect::route('admin.hr_pro.trade_license__sponsors__partners')->with('success', 'Data Added Sucessfully');

    }

    public function delete_trade_license(Request $request){
        $id =  (int)$request->input('id');
        $trade_license = Trade_license::where('id' , $id)->first();

        if($trade_license->manager_id_card != 'null'){
            
            $path = public_path().'/main_admin/hr_pro/trade_license/'.$trade_license->manager_id_card;
            // echo $path;
            if(File::exists($path)){
               unlink($path);
                //$trade_license->id_card = 'null';
            }

        }

        if($trade_license->sponsor_id_card != 'null'){
            
            $path = public_path().'/main_admin/hr_pro/trade_license/'.$trade_license->sponsor_id_card;
            // echo $path;
            if(File::exists($path)){
               unlink($path);
                //$trade_license->id_card = 'null';
            }

        }

        if($trade_license->partners_id_card != 'null'){
            
            $path = public_path().'/main_admin/hr_pro/trade_license/'.$trade_license->partners_id_card;
            // echo $path;
            if(File::exists($path)){
               unlink($path);
                //$trade_license->id_card = 'null';
            }

        }

        if($trade_license->manager_visa != 'null'){
            
            $path = public_path().'/main_admin/hr_pro/trade_license/'.$trade_license->manager_visa;
                if(File::exists($path)){
                unlink($path);
                //$trade_license->visa = 'null';

            }
        }

        if($trade_license->sponsor_visa != 'null'){
            
            $path = public_path().'/main_admin/hr_pro/trade_license/'.$trade_license->sponsor_visa;
                if(File::exists($path)){
                unlink($path);
                //$trade_license->visa = 'null';

            }
        }

        if($trade_license->partners_visa != 'null'){
            
            $path = public_path().'/main_admin/hr_pro/trade_license/'.$trade_license->partners_visa;
                if(File::exists($path)){
                unlink($path);
                //$trade_license->visa = 'null';

            }
        }

        if($trade_license->manager_passport != 'null'){
            
            $path = public_path().'/main_admin/hr_pro/trade_license/'.$trade_license->manager_passport;
                if(File::exists($path)){
                    unlink($path);
                //$trade_license->passport = 'null';

            }
        }

        if($trade_license->sponsor_passport != 'null'){
            
            $path = public_path().'/main_admin/hr_pro/trade_license/'.$trade_license->sponsor_passport;
                if(File::exists($path)){
                    unlink($path);
                //$trade_license->passport = 'null';

            }
        }

        if($trade_license->partners_passport != 'null'){
            
            $path = public_path().'/main_admin/hr_pro/trade_license/'.$trade_license->partners_passport;
                if(File::exists($path)){
                    unlink($path);
                //$trade_license->passport = 'null';

            }
        }


        if($trade_license->member_ship_certificate != 'null'){
            
            $path = public_path().'/main_admin/hr_pro/trade_license/'.$trade_license->member_ship_certificate;
                if(File::exists($path)){
                unlink($path);
                //$trade_license->member_ship_certificate = 'null';
            }
        }

        
        if($trade_license->sponsor_page != 'null'){
            
            $path = public_path().'/main_admin/hr_pro/trade_license/'.$trade_license->sponsor_page;
                if(File::exists($path)){
                    unlink($path);
                //$trade_license->sponsor_page = 'null';

            }
        }
        
        if($trade_license->trade_license_copy != 'null'){
            
            $path = public_path().'/main_admin/hr_pro/trade_license/'.$trade_license->trade_license_copy;
                if(File::exists($path)){
                    unlink($path);
                //$trade_license->trade_license_copy = 'null';

            }
        }

        $trade_license->status_message = $request->input('status_message');
        if( $trade_license->user_id != 0){
            $user_id  = $trade_license->user_id;
            
        }else{
            $user_id  = 0;
        }

        $trade_license->save();

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }

        if($trade_license->action == null){
            $trade_license->action = 'add';
        }

        // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
        $this->history_table('trade_license_histories', $trade_license->action , $user_id , $trade_license->id , 'hr_pro.view_trade_license__sponsors__partners');
        //dd($trade_license->id); 
        if($trade_license->delete()){

            

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function delete_trade_license_status(Request $request){
        $id =  (int)$request->input('id');
        $trade_license = Trade_license::where('id' , $id)->first();
        
        $trade_license->status_message = $request->input('status_message');
        if( $trade_license->user_id != 0){
            $user_id  = $trade_license->user_id;
            
        }else{
            $user_id  = 0;
        }

        $trade_license->row_status = 'deleted';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }

        // if($trade_license->action == null || $trade_license->status == 'approved'){
            $trade_license->action = 'delete';
        // }

        
 
        if( $trade_license->save()){

            // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
            $this->history_table('trade_license_histories', $trade_license->action , $user_id , $trade_license->id , 'hr_pro.view_trade_license__sponsors__partners');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_trade_license(Request $request){
        $id =  (int)$request->input('id');
        $trade_license = Trade_license::where('id' , $id)->first();
        
        $trade_license->status_message = $request->input('status_message');
        if( $trade_license->user_id != 0){
                        
        }else{
            $user_id  = 0;
        }

        $trade_license->row_status = 'active';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }

        
            $trade_license->action = 'restored';
        
        $trade_license->save();
        // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
        $this->history_table('trade_license_histories', $trade_license->action , $user_id , $trade_license->id , 'hr_pro.view_trade_license__sponsors__partners');
 
        $trade_license->action = 'deleted';
        $trade_license->save();
           
            return response()->json(['status'=>'1']);
        
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
        $data['view'] = 'admin.hr_pro.office_land_contract.office_land_contract';
        return view('layout', ["data"=>$data]);
    }

    //office
    public function office_contract(){
        $data['modules']= DB::table('modules')->get();
        $data['office_contract'] = Office_Land_contract::where('type', '=', 'office')->get();
       
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        
        $data['page_title'] = "OFFICE(s) CONTRACT";
        $data['view'] = 'admin.hr_pro.office_land_contract.office_contract.office_contract';
        return view('layout', ["data"=>$data]);
    }

    public function trash_office_contracts(){
        $data['modules']= DB::table('modules')->get();
        $data['office_contract'] = Office_Land_contract::where('type', '=', 'office')->get();
       
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['company_names']= DB::table('company_names')->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "OFFICE(s) CONTRACT Trash";
        $data['view'] = 'admin.hr_pro.office_land_contract.office_contract.deleted_data';
        return view('layout', ["data"=>$data]);
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
        return view('layout', ["data"=>$data]);
    }

    public function add_office_contract(){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add OFFICE CONTRACT";
        $data['view'] = 'admin.hr_pro.office_land_contract.office_contract.add_office_contract';
        return view('layout', ["data"=>$data]);
    }

    public function edit_office_contract(Request $request){

        $data['office_contract'] = Office_Land_contract::where('type', '=', 'office')->where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        //  $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit OFFICE CONTRACT";
        $data['view'] = 'admin.hr_pro.office_land_contract.office_contract.edit_office_contract';
        return view('layout', ["data"=>$data]);

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
        $office_contract->status = 'approved';
        $office_contract->user_id = 0;
        // $this->history_table_type('office__land_contract_histories', 'add' , 0 ,'office');
        

        $office_contract->action = 'Add';
        $office_contract->type = 'office';
        $office_contract->save();

        $this->history_table_type('office__land_contract_histories', $office_contract->action ,  $office_contract->user_id , $office_contract->type , $office_contract->id , 'hr_pro.view_office_contracts');

        return \Redirect::route('admin.hr_pro.office_contracts')->with('success', 'Data Added Sucessfully');

    }

    public function update_office_contract(Request $request){
        $office_contract = Office_Land_contract::find($request->input('id'));
        // dd($request->input('id'));

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


        

        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id  = $office_contract->user_id;
            
        }else{
            $user_id  = 0;
        }

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('office__land_contracts');
        }

        
        $office_contract->type = 'office';
        // dd($office_contract->status);
        if($office_contract->action == null || $office_contract->status == 'approved' ||  $office_contract->action== 'nill')  {
            $office_contract->action = 'edit';
        }

        $office_contract->status = $request->input('status');
        $office_contract->save();


        if($office_contract->status == 'approved' || $office_contract->user_id == 0 ){
            // $this->history_table_type('office__land_contract_histories', $office_contract->action , $user_id , 'office');

            $this->history_table_type('office__land_contract_histories', $office_contract->action ,  $office_contract->user_id , $office_contract->type , $office_contract->id , 'hr_pro.view_office_contracts');

        }

        return \Redirect::route('admin.hr_pro.office_contracts')->with('success', 'Data Added Sucessfully');

    }

    public function delete_office_contract(Request $request){
        $office_contract = Office_Land_contract::find($request->input('id'));
        
           
    
            if($office_contract->ijari_certificate != NULL){
                
                $path = public_path().'/main_admin/hr_pro/office_land_contract/'.$office_contract->ijari_certificate;
                // echo $path;
                if(File::exists($path)){
                   unlink($path);
                    //$trade_license->id_card = 'null';
                }
    
            }

            if($office_contract->lease_rent != NULL){
                
                $path = public_path().'/main_admin/hr_pro/office_land_contract/'.$office_contract->ijari_certificate;
                // echo $path;
                if(File::exists($path)){
                   unlink($path);
                    //$trade_license->id_card = 'null';
                }
    
            }
    
            $office_contract->status_message = $request->input('status_message');
            if( $office_contract->user_id != 0){
                $user_id  = $office_contract->user_id;
                
            }else{
                $user_id  = 0;
            }
    
            $office_contract->save();
            
            // if($office_contract->action == null){
                $office_contract->action = 'delete';
            // }

            if($request->input('status') == 'approved'){
                $this->remove_table_name('office__land_contracts');
            }
    
            // $this->history_table_type('office__land_contract_histories', $office_contract->action , $user_id ,'office');

            $this->history_table_type('office__land_contract_histories', $office_contract->action ,  $office_contract->user_id , $office_contract->type , $office_contract->id , 'hr_pro.view_office_contracts');

            if($office_contract->delete()){
                return response()->json(['status'=>'1']);
            }else{
                return response()->json(['status'=>'0']);
    
            }
        
        

    }
    
    public function delete_office_contracts_status(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Office_Land_contract::where('id' , $id)->first();
        
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id  = $office_contract->user_id;
            
        }else{
            $user_id  = 0;
        }

        $office_contract->row_status = 'deleted';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('office__land_contracts');
        }

    
            $office_contract->action = 'deleted';
        
        // dd($office_contract->action );
        $office_contract->type = 'office';
 
        if( $office_contract->save()){
            // dd($office_contract->action);
            // $this->history_table_type('office__land_contract_histories', $office_contract->action , $user_id ,'office');

            $this->history_table_type('office__land_contract_histories', $office_contract->action ,  $office_contract->user_id , $office_contract->type , $office_contract->id , 'hr_pro.view_office_contracts');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_office_contract(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Office_Land_contract::where('id' , $id)->first();
        
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id = $office_contract->user_id  ;   
        }else{
            $user_id  = 0;
        }
      
        $office_contract->row_status = 'active';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('office__land_contracts');
        }

        
            $office_contract->action = 'restored';
        
        $office_contract->save();
        // $this->history_table_type('office__land_contract_histories', $office_contract->action , $user_id ,'office');

        $this->history_table_type('office__land_contract_histories', $office_contract->action ,  $office_contract->user_id , $office_contract->type , $office_contract->id , 'hr_pro.view_office_contracts');

        $office_contract->action = 'nill';
        $office_contract->save();
      
           
            return response()->json(['status'=>'1']);
        
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
        $data['view'] = 'admin.hr_pro.office_land_contract.office_contract.view_office_contract';
        return view('layout', ["data"=>$data]);
    }
    

    //Land
    public function land_contract(){
        $data['modules']= DB::table('modules')->get();
        $data['land_contract'] = Office_Land_contract::where('type', '=', 'land')->get();
       
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        
        $data['page_title'] = "Land CONTRACT";
        $data['view'] = 'admin.hr_pro.office_land_contract.land_contract.land_contract';
        return view('layout', ["data"=>$data]);
    }

    public function trash_land_contract(){
        $data['modules']= DB::table('modules')->get();
        $data['land_contract'] = Office_Land_contract::where('type', '=', 'land')->get();
       
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['company_names']= DB::table('company_names')->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "OFFICE(s) CONTRACT Trash";
        $data['view'] = 'admin.hr_pro.office_land_contract.land_contract.deleted_data';
        return view('layout', ["data"=>$data]);
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
        return view('layout', ["data"=>$data]);
    }

    public function add_land_contract(){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Land CONTRACT";
        $data['view'] = 'admin.hr_pro.office_land_contract.land_contract.add_land_contract';
        return view('layout', ["data"=>$data]);
    }

    public function edit_land_contract(Request $request){

        $data['land_contract'] = Office_Land_contract::where('type', '=', 'land')->where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        //  $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Land CONTRACT";
        $data['view'] = 'admin.hr_pro.office_land_contract.land_contract.edit_land_contract';
        return view('layout', ["data"=>$data]);

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

        $office_contract->status = 'approved';
 
        $office_contract->user_id = 0;

        $office_contract->type = 'land';
        $office_contract->save();

        // $this->history_table_type('office__land_contract_histories', 'add' , 0 ,'land');
        $this->history_table_type('office__land_contract_histories', 'Add' ,  $office_contract->user_id , $office_contract->type , $office_contract->id , 'hr_pro.view_land_contracts');

        return \Redirect::route('admin.hr_pro.land_contracts')->with('success', 'Data Added Sucessfully');

    }

    public function update_land_contract(Request $request){
        $office_contract = Office_Land_contract::find($request->input('id'));

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

   
        if($office_contract->action == null || $office_contract->status == 'approved' ||  $office_contract->action== 'nill'){
            $office_contract->action = 'edit';
        }

        $office_contract->status = $request->input('status');

        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id  = $office_contract->user_id;
            
        }else{
            $user_id  = 0;
        }

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('office__land_contracts');
        }

        
        $office_contract->type = 'land';
        $office_contract->save();

        if($office_contract->action == null || $office_contract->status == 'approved' ||  $office_contract->action== 'nill')  {
            $office_contract->action = 'none';
        }
        if($office_contract->status == 'approved' || $office_contract->user_id == 0 ){
            // $this->history_table_type('office__land_contract_histories', $office_contract->action , $user_id , 'land');

            $this->history_table_type('office__land_contract_histories', $office_contract->action ,   $user_id, $office_contract->type , $office_contract->id , 'hr_pro.view_land_contracts');

        }

        return \Redirect::route('admin.hr_pro.land_contracts')->with('success', 'Data Added Sucessfully');

    }

    public function delete_land_contract(Request $request){
        $office_contract = Office_Land_contract::find($request->input('id'));
        
           
    
            if($office_contract->ijari_certificate != NULL){
                
                $path = public_path().'/main_admin/hr_pro/office_land_contract/'.$office_contract->ijari_certificate;
                // echo $path;
                if(File::exists($path)){
                   unlink($path);
                    //$trade_license->id_card = 'null';
                }
    
            }

            if($office_contract->lease_rent != NULL){
                
                $path = public_path().'/main_admin/hr_pro/office_land_contract/'.$office_contract->ijari_certificate;
                // echo $path;
                if(File::exists($path)){
                   unlink($path);
                    //$trade_license->id_card = 'null';
                }
    
            }
            // if($office_contract->action == null){
                $office_contract->action = 'delete';
            // }
    
            $office_contract->status_message = $request->input('status_message');
            if( $office_contract->user_id != 0){
                $user_id  = $office_contract->user_id;
                
            }else{
                $user_id  = 0;
            }
    
            $office_contract->save();
    
            if($request->input('status') == 'approved'){
                $this->remove_table_name('office__land_contracts');
            }
    
            // $this->history_table_type('office__land_contract_histories', $office_contract->action , $user_id ,'land');

            $this->history_table_type('office__land_contract_histories', $office_contract->action ,   $user_id, $office_contract->type , $office_contract->id , 'hr_pro.view_land_contracts');
            if($office_contract->delete()){
                return response()->json(['status'=>'1']);
            }else{
                return response()->json(['status'=>'0']);
    
            }
        
        

    }

    public function delete_land_contract_status(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Office_Land_contract::where('id' , $id)->first();
        
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id  = $office_contract->user_id;
            
        }else{
            $user_id  = 0;
        }

        $office_contract->row_status = 'deleted';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('office__land_contracts');
        }

        // if($office_contract->action == null || $office_contract->status == 'approved' ||  $office_contract->action== 'nill')  {
            $office_contract->action = 'delete';
        // }

        
 
        if( $office_contract->save()){

            // $this->history_table_type('office__land_contract_histories', $office_contract->action , $user_id ,'land');

            $this->history_table_type('office__land_contract_histories', $office_contract->action ,   $user_id, $office_contract->type , $office_contract->id , 'hr_pro.view_land_contracts');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_land_contract(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Office_Land_contract::where('id' , $id)->first();
        
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id = $office_contract->user_id  ;     
        }else{
            $user_id  = 0;
        }

        $office_contract->row_status = 'active';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('office__land_contracts');
        }

        
            $office_contract->action = 'restored';
        
        $office_contract->save();

        // $this->history_table_type('office__land_contract_histories', $office_contract->action , $user_id ,'land');

        $this->history_table_type('office__land_contract_histories', $office_contract->action ,   $user_id, $office_contract->type , $office_contract->id , 'hr_pro.view_land_contracts');

        $office_contract->action = 'nill';
        $office_contract->save();
      
           
            return response()->json(['status'=>'1']);
        
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
        $data['view'] = 'admin.hr_pro.office_land_contract.land_contract.view_land_contract';
        return view('layout', ["data"=>$data]);
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
        $data['view'] = 'admin.hr_pro.non_mobiles_fuel_tanks_renewals.non_mobiles_fuel_tanks_renewals';
        return view('layout', ["data"=>$data]);
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
        $data['view'] = 'admin.hr_pro.non_mobiles_fuel_tanks_renewals.civil_defense.civil_defense';
        return view('layout', ["data"=>$data]);
    }

    public function trash_non_mobile_civil_defence(){
        $data['modules']= DB::table('modules')->get();
        $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'non_mobile')->get();
        $data['company_names']= DB::table('company_names')->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "NON MOBILE FUEL TANK RENEWALS (CIVIL DEFENSE) Trash";
        $data['view'] = 'admin.hr_pro.non_mobiles_fuel_tanks_renewals.civil_defense.deleted_data';
        return view('layout', ["data"=>$data]);
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
        return view('layout', ["data"=>$data]);
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
        $data['view'] = 'admin.hr_pro.non_mobiles_fuel_tanks_renewals.civil_defense.add_civil_defense';
        return view('layout', ["data"=>$data]);

    }

    public function edit_non_mobile_civil_defence(Request $request){

        $data['civil_defense'] = Civil_defense_documents::where('type', '=', 'non_mobile')->where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit NON MOBILE FUEL TANK RENEWALS (CIVIL DEFENSE)
        ";
        $data['view'] = 'admin.hr_pro.non_mobiles_fuel_tanks_renewals.civil_defense.edit_civil_defense';
        return view('layout', ["data"=>$data]);

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

        $civil_defense->status = 'approved';
 
        $civil_defense->user_id = 0;

        $civil_defense->save();
        
        // $this->history_table_type('civil_defense_documents_histories', 'add' , 0 ,'non_mobile');

        $this->history_table_type('civil_defense_documents_histories', 'Add' ,   $civil_defense->user_id, 'non_mobile', $civil_defense->id , 'hr_pro.view_non_mobile_civil_defence');

        return \Redirect::route('admin.hr_pro.non_mobile_civil_defence')->with('success', 'Data Added Sucessfully');

    }

    public function update_non_mobile_civil_defence(Request $request){
        $civil_defense = Civil_defense_documents::find($request->input('id'));

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


        
        if($civil_defense->action == null || $civil_defense->status == 'approved' || $civil_defense->action == 'nill'){
            $civil_defense->action = 'edit';
        }

        $civil_defense->status = $request->input('status');


        $civil_defense->status_message = $request->input('status_message');
        if( $civil_defense->user_id != 0){
            $user_id  = $civil_defense->user_id;
            
        }else{
            $user_id  = 0;
        }

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('civil_defense_files');
        }

        $civil_defense->type = 'non_mobile';
        $civil_defense->save();

        if($civil_defense->status == 'approved' || $civil_defense->user_id == 0 ){
            // $this->history_table_type('civil_defense_documents_histories', $civil_defense->action , $user_id , 'non_mobile');

            $this->history_table_type('civil_defense_documents_histories', $civil_defense->action ,   $user_id, $civil_defense->type , $civil_defense->id , 'hr_pro.view_non_mobile_civil_defence');

        }

        return \Redirect::route('admin.hr_pro.non_mobile_civil_defence')->with('success', 'Data Updated Sucessfully');
    }

    public function delete_non_mobile_civil_defence(Request $request){
        $civil_defense = Civil_defense_documents::find($request->input('id'));

        $civil_defense->status_message = $request->input('status_message');
        if( $civil_defense->user_id != 0){
            $user_id  = $civil_defense->user_id;
            
        }else{
            $user_id  = 0;
        }

        $civil_defense->save();
        
        // if($civil_defense->action == null){
            $civil_defense->action = 'delete';
        // }

        if($request->input('status') == 'approved'){
            $this->remove_table_name('civil_defense_files');
        }

        // $this->history_table_type('civil_defense_documents_histories', $civil_defense->action , $user_id ,'non_mobile');

        $this->history_table_type('civil_defense_documents_histories', $civil_defense->action ,   $user_id, $civil_defense->type , $civil_defense->id , 'hr_pro.view_non_mobile_civil_defence');

       if($civil_defense->delete()){
           return response()->json(['status'=>'1']);
       }else{
           return response()->json(['status'=>'0']);
       }
    }

    public function delete_non_mobile_civil_defence_status(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Civil_defense_documents::where('id' , $id)->first();
        
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id  = $office_contract->user_id;
            
        }else{
            $user_id  = 0;
        }

        $office_contract->row_status = 'deleted';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('civil_defense_files');
        }

        // if($office_contract->action == null || $office_contract->status == 'approved' ||  $office_contract->action== 'nill')  {
            $office_contract->action = 'delete';
        // }

        
 
        if( $office_contract->save()){

            // $this->history_table_type('civil_defense_documents_histories', $office_contract->action , $user_id ,'non_mobile');

            $this->history_table_type('civil_defense_documents_histories', $office_contract->action ,   $user_id, $office_contract->type , $office_contract->id , 'hr_pro.view_non_mobile_civil_defence');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_non_mobile_civil_defence(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Civil_defense_documents::where('id' , $id)->first();
        
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id = $office_contract->user_id  ;      
        }else{
            $user_id  = 0;
        }

        $office_contract->row_status = 'active';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('civil_defense_files');
        }

        
            $office_contract->action = 'restored';
        
        $office_contract->save();
        // $this->history_table_type('civil_defense_documents_histories', $office_contract->action , $user_id ,'non_mobile');

        $this->history_table_type('civil_defense_documents_histories', $office_contract->action ,   $user_id, $office_contract->type , $office_contract->id , 'hr_pro.view_non_mobile_civil_defence');
 
        $office_contract->action = 'nill';
        $office_contract->save();
           
            return response()->json(['status'=>'1']);
        
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
        $data['view'] = 'admin.hr_pro.non_mobiles_fuel_tanks_renewals.muncipality.muncipality';
        return view('layout', ["data"=>$data]);
    }

    public function trash_non_mobile_muncipality(){
        $data['modules']= DB::table('modules')->get();
        $data['muncipality'] = Muncipality_documents::where('type', '=', 'non_mobile')->get();
        $data['company_names']= DB::table('company_names')->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "NON MOBILE FUEL TANK RENEWALS (Muncipality)";
        $data['view'] = 'admin.hr_pro.non_mobiles_fuel_tanks_renewals.muncipality.deleted_data';
        return view('layout', ["data"=>$data]);
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
        return view('layout', ["data"=>$data]);
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
        $data['view'] = 'admin.hr_pro.non_mobiles_fuel_tanks_renewals.muncipality.add_muncipality';
        return view('layout', ["data"=>$data]);

    }

    public function edit_non_mobile_muncipality(Request $request){

        $data['muncipality'] = Muncipality_documents::where('type', '=', 'non_mobile')->where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit NON MOBILE FUEL TANK RENEWALS (Muncipality)
        ";
        $data['view'] = 'admin.hr_pro.non_mobiles_fuel_tanks_renewals.muncipality.edit_muncipality';
        return view('layout', ["data"=>$data]);

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

        $muncipality->status = 'approved';
 
        $muncipality->user_id = 0;

        $muncipality->save();

        // $this->history_table_type('muncipality_documents_histories', 'add' , 0 ,'non_mobile');

        $this->history_table_type('muncipality_documents_histories', 'Add',   $muncipality->user_id , $muncipality->type , $muncipality->id , 'hr_pro.view_non_mobile_muncipality');

        return \Redirect::route('admin.hr_pro.non_mobile_muncipality')->with('success', 'Data Added Sucessfully');

    }

    public function update_non_mobile_muncipality(Request $request){
        $muncipality = Muncipality_documents::find($request->input('id'));

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


        
        if($muncipality->action == null || $muncipality->status == 'approved' || $muncipality->action == 'nill'){
            $muncipality->action = 'edit';
        }
        $muncipality->status = $request->input('status');


        $muncipality->status_message = $request->input('status_message');
        if( $muncipality->user_id != 0){

            $user_id  = $muncipality->user_id;
            
        }else{

            $user_id  = 0;
        }
        if($request->input('status') == 'approved' ){
            $this->remove_table_name('muncipality_documents');
        }

        $muncipality->type = 'non_mobile';
        $muncipality->save();

        if($muncipality->status == 'approved' || $muncipality->user_id == 0 ){
            // $this->history_table_type('muncipality_documents_histories', $muncipality->action , $user_id , 'non_mobile');

            $this->history_table_type('muncipality_documents_histories', $muncipality->action ,   $user_id, $muncipality->type , $muncipality->id , 'hr_pro.view_non_mobile_muncipality');

            

        }

        return \Redirect::route('admin.hr_pro.non_mobile_muncipality')->with('success', 'Data Updated Sucessfully');
    }

    public function delete_non_mobile_muncipality(Request $request){
        $civil_defense = Muncipality_documents::find($request->input('id'));

        $civil_defense->status_message = $request->input('status_message');
        if( $civil_defense->user_id != 0){
            $user_id  = $civil_defense->user_id;
            
        }else{
            $user_id  = 0;
        }

        $civil_defense->save();
        
        // if($civil_defense->action == null){
            $civil_defense->action = 'delete';
        // }

        if($request->input('status') == 'approved'){
            $this->remove_table_name('muncipality_documents');
        }

        // $this->history_table_type('muncipality_documents_histories', $civil_defense->action , $user_id ,'non_mobile');

        $this->history_table_type('muncipality_documents_histories', $civil_defense->action ,   $user_id, $civil_defense->type , $civil_defense->id , 'hr_pro.view_non_mobile_muncipality');

       if($civil_defense->delete()){
           return response()->json(['status'=>'1']);
       }else{
           return response()->json(['status'=>'0']);
       }
    }

    public function delete_non_mobile_muncipality_status(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Muncipality_documents::where('id' , $id)->first();
        
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id  = $office_contract->user_id;
            
        }else{
            $user_id  = 0;
        }

        $office_contract->row_status = 'deleted';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('muncipality_documents');
        }

        // if($office_contract->action == null || $office_contract->status == 'approved' ||  $office_contract->action== 'nill')  {
            $office_contract->action = 'delete';
        // }

        
 
        if( $office_contract->save()){

            // $this->history_table_type('muncipality_documents_histories', $office_contract->action , $user_id ,'non_mobile');

            $this->history_table_type('muncipality_documents_histories', $office_contract->action ,   $user_id, $office_contract->type , $office_contract->id , 'hr_pro.view_non_mobile_muncipality');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_non_mobile_muncipality(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Muncipality_documents::where('id' , $id)->first();
        
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id = $office_contract->user_id  ;        
        }else{
            $user_id  = 0;
        }

        $office_contract->row_status = 'active';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('muncipality_documents');
        }

        
            $office_contract->action = 'restored';
        
        $office_contract->save();
        // $this->history_table_type('muncipality_documents_histories', $office_contract->action , $user_id ,'non_mobile');

        $this->history_table_type('muncipality_documents_histories', $office_contract->action ,   $user_id, $office_contract->type , $office_contract->id , 'hr_pro.view_non_mobile_muncipality');
 
        $office_contract->action = 'nill';
        $office_contract->save();
           
            return response()->json(['status'=>'1']);
        
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
        $data['view'] = 'admin.hr_pro.mobiles_fuel_tanks_renewals.mobiles_fuel_tanks_renewals';
        return view('layout', ["data"=>$data]);
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
        $data['view'] = 'admin.hr_pro.mobiles_fuel_tanks_renewals.civil_defense.civil_defense';
        return view('layout', ["data"=>$data]);
    }

    public function trash_mobile_civil_defence(){
        $data['modules']= DB::table('modules')->get();
        $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'mobile')->get();
        $data['company_names']= DB::table('company_names')->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "MOBILE FUEL TANK RENEWALS (CIVIL DEFENSE) Trash";
        $data['view'] = 'admin.hr_pro.mobiles_fuel_tanks_renewals.civil_defense.deleted_data';
        return view('layout', ["data"=>$data]);
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
        return view('layout', ["data"=>$data]);
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
        $data['view'] = 'admin.hr_pro.mobiles_fuel_tanks_renewals.civil_defense.add_civil_defense';
        return view('layout', ["data"=>$data]);

    }

    public function edit_mobile_civil_defence(Request $request){

        $data['civil_defense'] = Civil_defense_documents::where('type', '=', 'mobile')->where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit MOBILE FUEL TANK RENEWALS (CIVIL DEFENSE)
        ";
        $data['view'] = 'admin.hr_pro.mobiles_fuel_tanks_renewals.civil_defense.edit_civil_defense';
        return view('layout', ["data"=>$data]);

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

        $civil_defense->status = 'approved';
 
        $civil_defense->user_id = 0;

        // $this->history_table_type('civil_defense_documents_histories', 'add' , 0 ,'mobile');

        

        $civil_defense->save();

        $this->history_table_type('civil_defense_documents_histories', 'Add' ,   $civil_defense->user_id, 'mobile', $civil_defense->id , 'hr_pro.view_mobile_civil_defence');

        return \Redirect::route('admin.hr_pro.mobile_civil_defence')->with('success', 'Data Added Sucessfully');

    }

    public function update_mobile_civil_defence(Request $request){
        $civil_defense = Civil_defense_documents::find($request->input('id'));

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


        
        if($civil_defense->action == null || $civil_defense->status == 'approved' || $civil_defense->action == 'nill'){
            $civil_defense->action = 'edit';
        }
        $civil_defense->status = $request->input('status');


        $civil_defense->status_message = $request->input('status_message');
        if( $civil_defense->user_id != 0){
            $user_id  = $civil_defense->user_id;
            
        }else{
            $user_id  = 0;
        }

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('civil_defense_files');
        }

        $civil_defense->type = 'mobile';
        $civil_defense->save();
        if($civil_defense->status == 'approved' || $civil_defense->user_id == 0 ){
            // $this->history_table_type('civil_defense_documents_histories', $civil_defense->action , $user_id , 'mobile');

            $this->history_table_type('civil_defense_documents_histories', $civil_defense->action ,   $user_id, $civil_defense->type , $civil_defense->id , 'hr_pro.view_mobile_civil_defence');

        }

        return \Redirect::route('admin.hr_pro.mobile_civil_defence')->with('success', 'Data Updated Sucessfully');
    }
    
    public function delete_mobile_civil_defence(Request $request){
        $civil_defense = Civil_defense_documents::find($request->input('id'));

        $civil_defense->status_message = $request->input('status_message');
        if( $civil_defense->user_id != 0){
            $user_id  = $civil_defense->user_id;
            
        }else{
            $user_id  = 0;
        }

        $civil_defense->save();
        
        // if($civil_defense->action == null){
            $civil_defense->action = 'delete ';
        // }

        if($request->input('status') == 'approved'){
            $this->remove_table_name('civil_defense_files');
        }

        // $this->history_table_type('civil_defense_documents_histories', $civil_defense->action , $user_id ,'mobile');

        $this->history_table_type('civil_defense_documents_histories', $civil_defense->action ,   $user_id, $civil_defense->type , $civil_defense->id , 'hr_pro.view_mobile_civil_defence');


       if($civil_defense->delete()){
           return response()->json(['status'=>'1']);
       }else{
           return response()->json(['status'=>'0']);
       }
    }

    public function delete_mobile_civil_defence_status(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Civil_defense_documents::where('id' , $id)->first();
        // dd( $id);
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id  = $office_contract->user_id;
            
        }else{
            $user_id  = 0;
        }

        $office_contract->row_status = 'deleted';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('civil_defense_files');
        }

        // if($office_contract->action == null || $office_contract->status == 'approved' ||  $office_contract->action== 'nill')  {
            $office_contract->action = 'delete';
        // }

        
 
        if( $office_contract->save()){

            // $this->history_table_type('civil_defense_documents_histories', $office_contract->action , $user_id ,'mobile');

            $this->history_table_type('civil_defense_documents_histories', $office_contract->action ,   $user_id, $office_contract->type , $office_contract->id , 'hr_pro.view_mobile_civil_defence');
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_mobile_civil_defence(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Civil_defense_documents::where('id' , $id)->first();
        
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id = $office_contract->user_id  ;              
        }else{
            $user_id  = 0;
        }

        $office_contract->row_status = 'active';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('civil_defense_files');
        }

        
            $office_contract->action = 'restored';
        
        $office_contract->save();
        // $this->history_table_type('civil_defense_documents_histories', $office_contract->action , $user_id ,'mobile');

        $this->history_table_type('civil_defense_documents_histories', $office_contract->action ,   $user_id, $office_contract->type , $office_contract->id , 'hr_pro.view_mobile_civil_defence');
 
        $office_contract->action = 'nill';
        $office_contract->save();
           
            return response()->json(['status'=>'1']);
        
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
        $data['view'] = 'admin.hr_pro.mobiles_fuel_tanks_renewals.muncipality.muncipality';
        return view('layout', ["data"=>$data]);
    }

    public function trash_mobile_muncipality(){
        $data['modules']= DB::table('modules')->get();
        $data['muncipality'] = Muncipality_documents::where('type', '=', 'mobile')->get();
        $data['company_names']= DB::table('company_names')->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "MOBILE FUEL TANK RENEWALS (Muncipality) Trash";
        $data['view'] = 'admin.hr_pro.mobiles_fuel_tanks_renewals.muncipality.deleted_data';
        return view('layout', ["data"=>$data]);
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
        return view('layout', ["data"=>$data]);
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
        $data['view'] = 'admin.hr_pro.mobiles_fuel_tanks_renewals.muncipality.add_muncipality';
        return view('layout', ["data"=>$data]);

    }

    public function edit_mobile_muncipality(Request $request){

        $data['muncipality'] = Muncipality_documents::where('type', '=', 'mobile')->where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit MOBILE FUEL TANK RENEWALS (Muncipality)
        ";
        $data['view'] = 'admin.hr_pro.mobiles_fuel_tanks_renewals.muncipality.edit_muncipality';
        return view('layout', ["data"=>$data]);

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

        $muncipality->status = 'approved';
 
        $muncipality->user_id = 0;

        $muncipality->save();

        // $this->history_table_type('muncipality_documents_histories', 'add' , 0 ,'mobile');

        $this->history_table_type('muncipality_documents_histories', 'Add',   $muncipality->user_id , $muncipality->type , $muncipality->id , 'hr_pro.view_mobile_muncipality');

        return \Redirect::route('admin.hr_pro.mobile_muncipality')->with('success', 'Data Added Sucessfully');

    }

    public function update_mobile_muncipality(Request $request){
        $muncipality = Muncipality_documents::find($request->input('id'));

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


        
        if($muncipality->action == null || $muncipality->status == 'approved' || $muncipality->action == 'nill'){
            $muncipality->action = 'edit';
        }
        $muncipality->status = $request->input('status');


        $muncipality->status_message = $request->input('status_message');
        if( $muncipality->user_id != 0){
            $user_id  = $muncipality->user_id;
            
        }else{
            $user_id  = 0;
        }

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('muncipality_documents');
        }

        $muncipality->type = 'mobile';
        $muncipality->save();

        if($muncipality->status == 'approved' || $muncipality->user_id == 0 ){
            // $this->history_table_type('muncipality_documents_histories', $muncipality->action , $user_id , 'mobile');

            $this->history_table_type('muncipality_documents_histories', $muncipality->action ,   $user_id, $muncipality->type , $muncipality->id , 'hr_pro.view_mobile_muncipality');

        }


        return \Redirect::route('admin.hr_pro.mobile_muncipality')->with('success', 'Data Updated Sucessfully');
    }

    public function delete_mobile_muncipality(Request $request){
        $civil_defense = Muncipality_documents::find($request->input('id'));

        $civil_defense->status_message = $request->input('status_message');
        if( $civil_defense->user_id != 0){
            $user_id  = $civil_defense->user_id;
            
        }else{
            $user_id  = 0;
        }

        $civil_defense->save();
        
        // if($civil_defense->action == null){
            $civil_defense->action = 'delete';
        // }

        if($request->input('status') == 'approved'){
            $this->remove_table_name('muncipality_documents');
        }

        // $this->history_table_type('muncipality_documents_histories', $civil_defense->action , $user_id ,'mobile');

        $this->history_table_type('muncipality_documents_histories', $civil_defense->action ,   $user_id, $civil_defense->type , $civil_defense->id , 'hr_pro.view_mobile_muncipality');

       if($civil_defense->delete()){
           return response()->json(['status'=>'1']);
       }else{
           return response()->json(['status'=>'0']);
       }
    }

    public function delete_mobile_muncipality_status(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Muncipality_documents::where('id' , $id)->first();
        
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id  = $office_contract->user_id;
            
        }else{
            $user_id  = 0;
        }

        $office_contract->row_status = 'deleted';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('muncipality_documents');
        }

        // if($office_contract->action == null || $office_contract->status == 'approved' ||  $office_contract->action== 'nill')  {
            $office_contract->action = 'delete';
        // }

        
 
        if( $office_contract->save()){

            // $this->history_table_type('muncipality_documents_histories', $office_contract->action , $user_id ,'mobile');

            $this->history_table_type('muncipality_documents_histories', $office_contract->action ,   $user_id, $office_contract->type , $office_contract->id , 'hr_pro.view_mobile_muncipality');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_mobile_muncipality(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Muncipality_documents::where('id' , $id)->first();
        
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id = $office_contract->user_id  ;   
        }else{
            $user_id  = 0;
        }

        $office_contract->row_status = 'active';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('muncipality_documents');
        }

        
            $office_contract->action = 'restored';
        
        $office_contract->save();
        // $this->history_table_type('muncipality_documents_histories', $office_contract->action , $user_id ,'mobile');

        
        $this->history_table_type('muncipality_documents_histories', $office_contract->action ,   $user_id, $office_contract->type , $office_contract->id , 'hr_pro.view_mobile_muncipality');

        
        $office_contract->action = 'nill';
        $office_contract->save();
 
      
           
            return response()->json(['status'=>'1']);
        
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
        $data['view'] = 'admin.hr_pro.login_passwords.login_password';
        return view('layout', ["data"=>$data]);
    }

    public function save_login_password(Request $request){
          $old_login = Login_password::all();
          if($old_login != null){
             $old_login[0]->body =  $request->input('body');
             $old_login[0]->status =  'approved';
             $old_login[0]->user_id = 0;
             if($old_login[0]->save()){
                //$this->history_table('muncipality_documents_histories', 'add' , 0 );
     
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
           //$this->history_table('muncipality_documents_histories', 'add' , 0 );

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
        $data['view'] = 'admin.hr_pro.non_mobiles_fuel_tanks_renewals.trained_individual.trained_individual';
        return view('layout', ["data"=>$data]);
    }

    public function trash_non_mobile_trained_individual(){
        $data['modules']= DB::table('modules')->get();
        $data['trained_individual'] = Trained_individual::where('type', '=', 'non_mobile')->get();
        $data['company_names']= DB::table('company_names')->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "Trained Individual Non Mobile Fuel Tank Trash";
        $data['view'] = 'admin.hr_pro.non_mobiles_fuel_tanks_renewals.trained_individual.deleted_data';
        return view('layout', ["data"=>$data]);
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
        return view('layout', ["data"=>$data]);
    }

    public function add_non_mobile_trained_individual(){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
       

        $data['page_title'] = "Add Trained Individual Non Mobile Fuel Tank";
        $data['view'] = 'admin.hr_pro.non_mobiles_fuel_tanks_renewals.trained_individual.add_trained_individual';
        return view('layout', ["data"=>$data]);
    }

    public function edit_non_mobile_trained_individual(Request $request){

        $data['trained_individual'] = Trained_individual::where('id' ,'=' , $request->input('id'))->first();

        
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        //  $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Trained Individual Non Mobile Fuel Tank";
        $data['view'] = 'admin.hr_pro.non_mobiles_fuel_tanks_renewals.trained_individual.edit_trained_individual';
        return view('layout', ["data"=>$data]);

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

        $trained_individual->type = 'non_mobile';

        $trained_individual->status = 'approved';
 
        $trained_individual->user_id = 0;

        $trained_individual->save();

        // $this->history_table_type('trained_individuals_histories', 'add' , 0 ,'non_mobile');

        
        $this->history_table_type('trained_individuals_histories', 'Add',  0 , $trained_individual->type , $trained_individual->id , 'hr_pro.view_non_mobile_trained_individual');


        return \Redirect::route('admin.hr_pro.non_mobile_trained_individual')->with('success', 'Data Added Sucessfully');

    }

    public function update_non_mobile_trained_individual(Request $request){
        $trained_individual = Trained_individual::find($request->input('id'));

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


        
        if($trained_individual->action == null || $trained_individual->status == 'approved' || $trained_individual->action == 'nill' ){
            $trained_individual->action = 'edit';
        }
        $trained_individual->status = $request->input('status');

        $trained_individual->status_message = $request->input('status_message');
        if( $trained_individual->user_id != 0){
            $user_id  = $trained_individual->user_id;
            
        }else{
            $user_id  = 0;
        }

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trained_individuals');
        }

        $trained_individual->type = 'non_mobile';
        $trained_individual->save();

        if($trained_individual->status == 'approved' || $trained_individual->user_id == 0 ){
            // $this->history_table_type('trained_individuals_histories', $trained_individual->action , $user_id , 'non_mobile');

            $this->history_table_type('trained_individuals_histories', $trained_individual->action , $user_id , $trained_individual->type , $trained_individual->id , 'hr_pro.view_non_mobile_trained_individual');

        }

        return \Redirect::route('admin.hr_pro.non_mobile_trained_individual')->with('success', 'Data Added Sucessfully');

    }

    public function delete_non_mobile_trained_individual(Request $request){
        $trained_individual = Trained_individual::find($request->input('id'));
        
           
    
            if($trained_individual->pass_card != NULL){
                
                $path = public_path().'/main_admin/hr_pro/trained_individual/'.$trained_individual->pass_card;
                // echo $path;
                if(File::exists($path)){
                   unlink($path);
                    //$trade_license->id_card = 'null';
                }
    
            }

            if($trained_individual->back_pic != NULL){
                
                $path = public_path().'/main_admin/hr_pro/trained_individual/'.$trained_individual->back_pic;
                // echo $path;
                if(File::exists($path)){
                   unlink($path);
                    //$trade_license->id_card = 'null';
                }
    
            }

            if($trained_individual->front_pic != NULL){
                
                $path = public_path().'/main_admin/hr_pro/trained_individual/'.$trained_individual->front_pic;
                // echo $path;
                if(File::exists($path)){
                   unlink($path);
                    //$trade_license->id_card = 'null';
                }
    
            }

            $trained_individual->status_message = $request->input('status_message');
            if( $trained_individual->user_id != 0){
                $user_id  = $trained_individual->user_id;
                
            }else{
                $user_id  = 0;
            }
    
            $trained_individual->save();
            
            // if($trained_individual->action == null){
                $trained_individual->action = 'delete';
            // }
    
            if($request->input('status') == 'approved'){
                $this->remove_table_name('trained_individuals');
            }
    
            // $this->history_table_type('trained_individuals_histories', $trained_individual->action , $user_id ,'non_mobile');

            $this->history_table_type('trained_individuals_histories', $trained_individual->action , $user_id , $trained_individual->type , $trained_individual->id , 'hr_pro.view_non_mobile_trained_individual');
    
            if($trained_individual->delete()){
                return response()->json(['status'=>'1']);
            }else{
                return response()->json(['status'=>'0']);
    
            }
    }

    public function delete_non_mobile_trained_individual_status(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Trained_individual::where('id' , $id)->first();
        
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id  = $office_contract->user_id;
            
        }else{
            $user_id  = 0;
        }

        $office_contract->row_status = 'deleted';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trained_individuals');
        }

        // if($office_contract->action == null || $office_contract->status == 'approved' ||  $office_contract->action== 'nill')  {
            $office_contract->action = 'delete';
        // }

        
 
        if( $office_contract->save()){

            // $this->history_table_type('trained_individuals_histories', $office_contract->action , $user_id ,'non_mobile');

            $this->history_table_type('trained_individuals_histories', $office_contract->action , $user_id , $office_contract->type , $office_contract->id , 'hr_pro.view_non_mobile_trained_individual');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_non_mobile_trained_individual(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Trained_individual::where('id' , $id)->first();
        
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id = $office_contract->user_id  ;   
        }else{
            $user_id  = 0;
        }

        $office_contract->row_status = 'active';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trained_individuals');
        }

        
            $office_contract->action = 'restored';
        
        $office_contract->save();
        // $this->history_table_type('trained_individuals_histories', $office_contract->action , $user_id ,'non_mobile');


        $this->history_table_type('trained_individuals_histories', $office_contract->action , $user_id , $office_contract->type , $office_contract->id , 'hr_pro.view_non_mobile_trained_individual');

        $office_contract->action = 'nill';
        $office_contract->save();
      
           
            return response()->json(['status'=>'1']);
        
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
        $data['view'] = 'admin.hr_pro.non_mobiles_fuel_tanks_renewals.trained_individual.view_trained_individual';
        return view('layout', ["data"=>$data]);
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
        $data['view'] = 'admin.hr_pro.mobiles_fuel_tanks_renewals.trained_individual.trained_individual';
        return view('layout', ["data"=>$data]);
    }

    public function trash_mobiles_trained_individual(){
        $data['modules']= DB::table('modules')->get();
        $data['trained_individual'] = Trained_individual::where('type', '=', 'mobile')->get();
        $data['company_names']= DB::table('company_names')->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "Trained Individual Mobile Fuel Tank Trash";
        $data['view'] = 'admin.hr_pro.mobiles_fuel_tanks_renewals.trained_individual.deleted_data';
        return view('layout', ["data"=>$data]);
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
        return view('layout', ["data"=>$data]);
    }

    public function add_mobiles_trained_individual(){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
       

        $data['page_title'] = "Add Trained Individual  Mobile Fuel Tank";
        $data['view'] = 'admin.hr_pro.mobiles_fuel_tanks_renewals.trained_individual.add_trained_individual';
        return view('layout', ["data"=>$data]);
    }

    public function edit_mobiles_trained_individual(Request $request){

        $data['trained_individual'] = Trained_individual::where('id' ,'=' , $request->input('id'))->first();

        
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        //  $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Trained Individual  Mobile Fuel Tank";
        $data['view'] = 'admin.hr_pro.mobiles_fuel_tanks_renewals.trained_individual.edit_trained_individual';
        return view('layout', ["data"=>$data]);

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

        $trained_individual->type = 'mobile';

        $trained_individual->status = 'approved';
 
        $trained_individual->user_id = 0;

        $trained_individual->save();

        // $this->history_table_type('trained_individuals_histories', 'add' , 0 ,'mobile');

        $this->history_table_type('trained_individuals_histories', 'Add' ,0 , $trained_individual->type , $trained_individual->id , 'hr_pro.view_mobile_trained_individual');

        return \Redirect::route('admin.hr_pro.mobiles_trained_individual')->with('success', 'Data Added Sucessfully');

    }

    public function update_mobiles_trained_individual(Request $request){
        $trained_individual = Trained_individual::find($request->input('id'));

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


        
        if($trained_individual->action == null || $trained_individual->status == 'approved' ||  $trained_individual->action == 'nill'){
            $trained_individual->action = 'edit';
        }

        $trained_individual->status = $request->input('status');


        $trained_individual->status_message = $request->input('status_message');
        if( $trained_individual->user_id != 0){
            $user_id  = $trained_individual->user_id;
            
        }else{
            $user_id  = 0;
        }

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trained_individuals');
        }

        $trained_individual->type = 'mobile';
        $trained_individual->save();

        if($trained_individual->status == 'approved' || $trained_individual->user_id == 0 ){
            // $this->history_table_type('trained_individuals_histories', $trained_individual->action , $user_id , 'mobile');

            $this->history_table_type('trained_individuals_histories', $trained_individual->action , $user_id , $trained_individual->type , $trained_individual->id , 'hr_pro.view_mobile_trained_individual');

        }

        return \Redirect::route('admin.hr_pro.mobiles_trained_individual')->with('success', 'Data Added Sucessfully');

    }

    public function delete_mobiles_trained_individual(Request $request){
             $trained_individual = Trained_individual::find($request->input('id'));
        
           
    
            if($trained_individual->pass_card != NULL){
                
                $path = public_path().'/main_admin/hr_pro/trained_individual/'.$trained_individual->pass_card;
                // echo $path;
                if(File::exists($path)){
                   unlink($path);
                    //$trade_license->id_card = 'null';
                }
    
            }

            if($trained_individual->back_pic != NULL){
                
                $path = public_path().'/main_admin/hr_pro/trained_individual/'.$trained_individual->back_pic;
                // echo $path;
                if(File::exists($path)){
                   unlink($path);
                    //$trade_license->id_card = 'null';
                }
    
            }

            if($trained_individual->front_pic != NULL){
                
                $path = public_path().'/main_admin/hr_pro/trained_individual/'.$trained_individual->front_pic;
                // echo $path;
                if(File::exists($path)){
                   unlink($path);
                    //$trade_license->id_card = 'null';
                }
    
            }
            $trained_individual->status_message = $request->input('status_message');
            if( $trained_individual->user_id != 0){
                $user_id  = $trained_individual->user_id;
                
            }else{
                $user_id  = 0;
            }
    
            $trained_individual->save();
            
            // if($trained_individual->action == null){
                $trained_individual->action = 'delete';
            // }
    
            if($request->input('status') == 'approved'){
                $this->remove_table_name('trained_individuals');
            }
    
            // $this->history_table_type('trained_individuals_histories', $trained_individual->action , $user_id ,'mobile');

            $this->history_table_type('trained_individuals_histories', $trained_individual->action , $user_id , $trained_individual->type , $trained_individual->id , 'hr_pro.view_mobile_trained_individual');
    
            if($trained_individual->delete()){
                return response()->json(['status'=>'1']);
            }else{
                return response()->json(['status'=>'0']);
    
            }
    }

    public function delete_mobiles_trained_individual_status(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Trained_individual::where('id' , $id)->first();
        
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id  = $office_contract->user_id;
            
        }else{
            $user_id  = 0;
        }

        $office_contract->row_status = 'deleted';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trained_individuals');
        }

        // if($office_contract->action == null || $office_contract->status == 'approved' ||  $office_contract->action== 'nill')  {
            $office_contract->action = 'delete';
        // }

        
 
        if( $office_contract->save()){

            // $this->history_table_type('trained_individuals_histories', $office_contract->action , $user_id ,'mobile');

            $this->history_table_type('trained_individuals_histories', $office_contract->action , $user_id , $office_contract->type , $office_contract->id , 'hr_pro.view_mobile_trained_individual');

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_mobiles_trained_individual(Request $request){
        $id =  (int)$request->input('id');
        $office_contract = Trained_individual::where('id' , $id)->first();
        
        $office_contract->status_message = $request->input('status_message');
        if( $office_contract->user_id != 0){
            $user_id = $office_contract->user_id  ;          
        }else{
            $user_id  = 0;
        }

        $office_contract->row_status = 'active';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trained_individuals');
        }

        
            $office_contract->action = 'restored';
        
        $office_contract->save();
        // $this->history_table_type('trained_individuals_histories', $office_contract->action , $user_id ,'mobile');

        $this->history_table_type('trained_individuals_histories', $office_contract->action , $user_id , $office_contract->type , $office_contract->id , 'hr_pro.view_mobile_trained_individual');


        $office_contract->action = 'nill';
        $office_contract->save();
 
      
           
            return response()->json(['status'=>'1']);
        
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
        $data['view'] = 'admin.hr_pro.mobiles_fuel_tanks_renewals.trained_individual.view_trained_individual';
        return view('layout', ["data"=>$data]);
    }

    

}