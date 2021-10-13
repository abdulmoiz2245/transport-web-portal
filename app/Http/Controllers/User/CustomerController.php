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
use App\Models\Customer_info;
use App\Models\Customer_department;
use App\Models\Customer_rate_card;
use App\Models\Erp_department;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
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

    public function history_table($table_name , $action , $user_id){
        DB::table($table_name)->insert([
            'action' => $action,
            'date' => date("Y-m-d"),
            'user_id' => $user_id,

        ]);

        return true;
    }

    public function history_table_type($table_name , $action , $user_id , $type){
        DB::table($table_name)->insert([
            'action' => $action,
            'date' => date("Y-m-d"),
            'user_id' => $user_id,
            'type' => $type,
        ]);

        return true;
    }
 
    public function save_department(Request $request){
           
        $department_name = new Erp_department;
        $department_name->name = $request->input('new_dep_name');
        $department_name->save();

        $department_names =  Erp_department::all();
        $row = '';
        $row .= " <select name='department_name' class='form-control'>";
        foreach($department_names as $department){
            $row .= "<option value='".$department->id ."'>". $department->name . "</option>";
        }

        $row .= "</select>";

        
        return response()->json(['status'=>'1' , 'row'=> $row]);

    }

    public function customer(){

        $data['modules']= DB::table('modules')->get();
        $data['customer_info'] = DB::table('customer_info')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 2)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
            
        if($data['permissions']->status != 1 ){
            abort(403);
        }

        
        $data['page_title'] = "Customer";
        $data['view'] = 'customer.customer';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_customer(){
        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 2)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
            
        if($data['permissions']->status != 1 ){
            abort(403);
        };

         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Customer";
        $data['view'] = 'customer.add_customer';
        return view('users.layout', ["data"=>$data]);
    }

    public function view_customer(Request $request){

        $data['customer_info'] = Customer_info::find($request->input('id'));
        $data['customer_department'] = Customer_department::where('customer_id' ,'=' , $request->input('id'))->first();
        $data['customer_rate_card'] = Customer_rate_card::where('customer_id' ,'=' , $request->input('id'))->first();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 2)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
            
        if($data['permissions']->status != 1 ){
            abort(403);
        }


        $data['modules']= DB::table('modules')->get();
        $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "  Customer";
        $data['view'] = 'customer.view_customer';
        return view('users.layout', ["data"=>$data]);
    }
    
    public function edit_customer (Request $request){
        $data['customer_info'] = Customer_info::find($request->input('id'));
        $data['customer_department'] = Customer_department::where('customer_id' ,'=' , $request->input('id'))->first();
        $data['customer_rate_card'] = Customer_rate_card::where('customer_id' ,'=' , $request->input('id'))->first();

        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 2)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
            
        if($data['permissions']->status != 1 ){
            abort(403);
        }

        $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Customer";
        $data['view'] = 'customer.edit_customer';
        return view('users.layout', ["data"=>$data]);
    }

    public function save_customer_info(Request $request){

        $customer_info = new Customer_info;
        
        if($request->input('company_id') != ''){
            $customer_info->company_id = $request->input('company_id');
        }
        
        if($request->input('name') != ''){
            $customer_info->name = $request->input('name');
        }

        if($request->input('contract') != ''){
            $customer_info->contract = $request->input('contract');
        }
        
        if($request->input('address') != ''){
            $customer_info->address = $request->input('address');
        }

        if($request->input('city') != ''){
            $customer_info->city = $request->input('city');
        }
        
        if($request->input('country') != ''){
            $customer_info->country = $request->input('country');
        }

        if($request->input('tel_number') != ''){
            $customer_info->tel_number = $request->input('tel_number');
        }

        if($request->input('fax') != ''){
            $customer_info->fax = $request->input('fax');
        }

        if($request->input('mobile') != ''){
            $customer_info->mobile = $request->input('mobile');
        }

        if($request->input('email') != ''){
            $customer_info->email = $request->input('email');
        }

        if($request->input('contact_person') != ''){
            $customer_info->contact_person = $request->input('contact_person');
        }

        if($request->input('des') != ''){
            $customer_info->des = $request->input('des');
        }

        if($request->input('web') != ''){
            $customer_info->web = $request->input('web');
        }

        if($request->input('user') != ''){
            $customer_info->user = $request->input('user');
        }

        if($request->input('pw') != ''){
            $customer_info->pw = $request->input('pw');
        }

        if($request->input('pw') != ''){
            $customer_info->pw = $request->input('pw');
        }

        if($request->input('pw') != ''){
            $customer_info->pw = $request->input('pw');
        }

        if($request->input('credit_term') != ''){
            $customer_info->credit_term = $request->input('credit_term');
        }

        if($request->input('portal_login') != ''){
            $customer_info->portal_login = $request->input('portal_login');
        }

        if($request->input('remarks') != ''){
            $customer_info->remarks = $request->input('remarks');
        }

        if($request->input('trn') != ''){
            $customer_info->trn = $request->input('trn');
        }

        if($request->input('business_license_expiary_date') != ''){
            $customer_info->business_license_expiary_date = $request->input('business_license_expiary_date');
        }

        if($request->input('business_contract_expiary_date') != ''){
            $customer_info->business_contract_expiary_date = $request->input('business_contract_expiary_date');
        }
        
        if ($request->hasFile('trn_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->trn_copy->getClientOriginalName());
            $file = $request->file('trn_copy');
            if($file->storeAs('/main_admin/customer/', $name , ['disk' => 'public_uploads'])){
                $customer_info->trn_copy = $name;

            }
            
        }

        if ($request->hasFile('business_license_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->business_license_copy->getClientOriginalName());
            $file = $request->file('business_license_copy');
            if($file->storeAs('/main_admin/customer/', $name , ['disk' => 'public_uploads'])){
                $customer_info->business_license_copy = $name;

            }
            
        }

        if ($request->hasFile('business_contract_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->business_contract_copy->getClientOriginalName());
            $file = $request->file('business_contract_copy');
            if($file->storeAs('/main_admin/customer/', $name , ['disk' => 'public_uploads'])){
                $customer_info->business_contract_copy = $name;

            }
            
        }

        $this->add_aprovals('customer_info');

        $customer_info->status = 'pending';
        $customer_info->action = 'add';
        if($request->input('status_message') != ''){

            $customer_info->status_message = $request->input('status_message');

        }

        $customer_info->user_id = Auth::id();


        if($customer_info->save()){
            return response()->json(['status'=>'1' , 'id'=>$customer_info->id]);
        }else{
            return response()->json(['status'=>'0']);
        }

    }

    public function save_customer_department(Request $request){

        $customer_dep = new Customer_department;
        $customer_info = Customer_info::where('id' , $request->input('customer_id'))->first();
        if($request->input('customer_id') != ''){
            $customer_dep->customer_id = $request->input('customer_id');
        }
        
        if($request->input('department_name') != ''){
            $customer_dep->department_name = $request->input('department_name');
        }
        
        if($request->input('concerned_person_name') != ''){
            $customer_dep->concerned_person_name = $request->input('concerned_person_name');
        }
        
        if($request->input('concerned_person_designation') != ''){
            $customer_dep->concerned_person_designation = $request->input('concerned_person_designation');
        }

        if($request->input('tell') != ''){
            $customer_dep->tell = $request->input('tell');
        }

        if($request->input('mobile') != ''){
            $customer_dep->mobile = $request->input('mobile');
        }

        if($request->input('fax') != ''){
            $customer_dep->fax = $request->input('fax');
        }

        if($request->input('email') != ''){
            $customer_dep->email = $request->input('email');
        }

        $this->add_aprovals('customer_info');

        $customer_info->status = 'pending';
        $customer_info->action = 'add';
        if($request->input('status_message') != ''){

            $customer_info->status_message = $request->input('status_message');

        }

        $customer_info->user_id = Auth::id();

        if($customer_dep->save()){
            $customer_info->save();
            return response()->json(['status'=>'1']);
        }else{

            return response()->json(['status'=>'0']);
        }

    }

    public function save_customer_rate_card_old(Request $request){

        $customer_rate_card = new Customer_rate_card;
        $customer_info = Customer_info::where('id' , $request->input('customer_id'))->first();
        
        if($request->input('customer_id') != ''){
            $customer_rate_card->customer_id = $request->input('customer_id');
        }

        if($request->input('from') != ''){
            $customer_rate_card->from = $request->input('from');
        }
        if($request->input('to') != ''){
            $customer_rate_card->to = $request->input('to');

        }
        if($request->input('vechicle_type') != ''){
            $customer_rate_card->vechicle_type = $request->input('vechicle_type');

        }
        if($request->input('other_carges') != ''){
            $customer_rate_card->other_carges = $request->input('other_carges');

        }
        if($request->input('other_des') != ''){
            $customer_rate_card->other_des = $request->input('other_des');

        }

        if($request->input('driver_comission') != ''){
            if(date('l') == 'Friday'){
            $customer_rate_card->driver_comission = (int)$request->input('driver_comission') *1.5;
            }else{
            $customer_rate_card->driver_comission = (int)$request->input('driver_comission');
            }

        }

        if($request->input('rate') != ''){
            $customer_rate_card->rate = $request->input('rate');
        }

        if($request->input('rate_price') != ''){
            $customer_rate_card->rate_price = $request->input('rate_price');
        }

        if($request->input('detention') != ''){
            $customer_rate_card->detention = $request->input('detention');
        }


        if($request->input('time') != ''){
            $customer_rate_card->time = $request->input('time');
        }

        if($request->input('charges') != ''){
            $customer_rate_card->charges = $request->input('charges');
        }

        if($request->input('trip') != ''){
            $customer_rate_card->trip = $request->input('trip');
        }

        if($request->input('ap_km') != ''){
            $customer_rate_card->ap_km = $request->input('ap_km');
        }

        if($request->input('ap_diesel') != ''){
            $customer_rate_card->ap_diesel = $request->input('ap_diesel');
        }

        

        $this->add_aprovals('customer_info');

        $customer_info->status = 'pending';
        $customer_info->action = 'add';
        if($request->input('status_message') != ''){

            $customer_info->status_message = $request->input('status_message');

        }

        $customer_info->user_id = Auth::id();

        if($customer_rate_card->save()){
            $customer_info->save();

            return response()->json(['status'=>'1']);
        }else{

            return response()->json(['status'=>'0']);
        }


    }

    public function update_customer_info(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Customer_info::where('id' ,  $id )->first();

        if($request->input('company_id') != ''){
            $customer_info->company_id = $request->input('company_id');
        }

        if($request->input('contract') != ''){
            $customer_info->contract = $request->input('contract');
        }
        
        if($request->input('name') != ''){
            $customer_info->name = $request->input('name');
        }
        
        if($request->input('address') != ''){
            $customer_info->address = $request->input('address');
        }

        if($request->input('city') != ''){
            $customer_info->city = $request->input('city');
        }
        
        if($request->input('country') != ''){
            $customer_info->country = $request->input('country');
        }

        if($request->input('tel_number') != ''){
            $customer_info->tel_number = $request->input('tel_number');
        }

        if($request->input('fax') != ''){
            $customer_info->fax = $request->input('fax');
        }

        if($request->input('mobile') != ''){
            $customer_info->mobile = $request->input('mobile');
        }

        if($request->input('email') != ''){
            $customer_info->email = $request->input('email');
        }

        if($request->input('contact_person') != ''){
            $customer_info->contact_person = $request->input('contact_person');
        }

        if($request->input('des') != ''){
            $customer_info->des = $request->input('des');
        }

        if($request->input('web') != ''){
            $customer_info->web = $request->input('web');
        }

        if($request->input('user') != ''){
            $customer_info->user = $request->input('user');
        }

        if($request->input('pw') != ''){
            $customer_info->pw = $request->input('pw');
        }

        if($request->input('pw') != ''){
            $customer_info->pw = $request->input('pw');
        }

        if($request->input('pw') != ''){
            $customer_info->pw = $request->input('pw');
        }

        if($request->input('credit_term') != ''){
            $customer_info->credit_term = $request->input('credit_term');
        }

        if($request->input('portal_login') != ''){
            $customer_info->portal_login = $request->input('portal_login');
        }

        if($request->input('remarks') != ''){
            $customer_info->remarks = $request->input('remarks');
        }

        if($request->input('trn') != ''){
            $customer_info->trn = $request->input('trn');
        }

        if($request->input('business_license_expiary_date') != ''){
            $customer_info->business_license_expiary_date = $request->input('business_license_expiary_date');
        }

        if($request->input('business_contract_expiary_date') != ''){
            $customer_info->business_contract_expiary_date = $request->input('business_contract_expiary_date');
        }
        
        if ($request->hasFile('trn_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->trn_copy->getClientOriginalName());
            $file = $request->file('trn_copy');
            if($file->storeAs('/main_admin/customer/', $name , ['disk' => 'public_uploads'])){
                $customer_info->trn_copy = $name;

            }
            
        }

        if ($request->hasFile('business_license_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->business_license_copy->getClientOriginalName());
            $file = $request->file('business_license_copy');
            if($file->storeAs('/main_admin/customer/', $name , ['disk' => 'public_uploads'])){
                $customer_info->business_license_copy = $name;

            }
            
        }

        if ($request->hasFile('business_contract_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->business_contract_copy->getClientOriginalName());
            $file = $request->file('business_contract_copy');
            if($file->storeAs('/main_admin/customer/', $name , ['disk' => 'public_uploads'])){
                $customer_info->business_contract_copy = $name;

            }
            
        }


        $this->add_aprovals('customer_info');

        $customer_info->status = 'pending';
        $customer_info->action = 'edit';
        if($request->input('status_message') != ''){

            $customer_info->status_message = $request->input('status_message');

        }

        $customer_info->user_id = Auth::id();

        $customer_info->save();


        return response()->json(['status'=>'1']);
    }

    public function update_customer_department(Request $request){
        $id =  (int)$request->input('id');
        $customer_dep = Customer_department::where('id' , $id)->first();
        $customer_info = Customer_info::where('id' ,  $customer_dep->customer_id )->first();

        if($request->input('department_name') != ''){
            $customer_dep->department_name = $request->input('department_name');
        }
        
        if($request->input('concerned_person_name') != ''){
            $customer_dep->concerned_person_name = $request->input('concerned_person_name');
        }
        
        if($request->input('concerned_person_designation') != ''){
            $customer_dep->concerned_person_designation = $request->input('concerned_person_designation');
        }

        if($request->input('tell') != ''){
            $customer_dep->tell = $request->input('tell');
        }

        if($request->input('mobile') != ''){
            $customer_dep->mobile = $request->input('mobile');
        }

        if($request->input('fax') != ''){
            $customer_dep->fax = $request->input('fax');
        }

        if($request->input('email') != ''){
            $customer_dep->email = $request->input('email');
        }


        $this->add_aprovals('customer_info');

        $customer_info->status = 'pending';
        $customer_info->action = 'edit';
        if($request->input('status_message') != ''){

            $customer_info->status_message = $request->input('status_message');

        }

        $customer_info->user_id = Auth::id();

        $customer_dep->save();

        


        return response()->json(['status'=>'1']);

    }

    public function update_customer_rate_card_old(Request $request){
        $id =  (int)$request->input('id');
        $customer_rate_card = Customer_rate_card::where('id' , $id)->first();
        $customer_info = Customer_info::where('id' ,  $customer_rate_card->customer_id )->first();
       
        if($request->input('from') != ''){
            $customer_rate_card->from = $request->input('from');
        }
        if($request->input('to') != ''){
            $customer_rate_card->to = $request->input('to');

        }
        if($request->input('vechicle_type') != ''){
            $customer_rate_card->vechicle_type = $request->input('vechicle_type');

        }
        if($request->input('other_carges') != ''){
            $customer_rate_card->other_carges = $request->input('other_carges');

        }
        if($request->input('other_des') != ''){
            $customer_rate_card->other_des = $request->input('other_des');

        }

        if($request->input('driver_comission') != ''){
            if(date('l') == 'Friday'){
            $customer_rate_card->driver_comission = (int)$request->input('driver_comission') *1.5;
            }else{
            $customer_rate_card->driver_comission = (int)$request->input('driver_comission');
            }

        }

        if($request->input('rate') != ''){
            $customer_rate_card->rate = $request->input('rate');
        }

        if($request->input('rate_price') != ''){
            $customer_rate_card->rate_price = $request->input('rate_price');
        }

        if($request->input('detention') != ''){
            $customer_rate_card->detention = $request->input('detention');
        }


        if($request->input('time') != ''){
            $customer_rate_card->time = $request->input('time');
        }

        if($request->input('charges') != ''){
            $customer_rate_card->charges = $request->input('charges');
        }

        if($request->input('trip') != ''){
            $customer_rate_card->trip = $request->input('trip');
        }

        if($request->input('ap_km') != ''){
            $customer_rate_card->ap_km = $request->input('ap_km');
        }

        if($request->input('ap_diesel') != ''){
            $customer_rate_card->ap_diesel = $request->input('ap_diesel');
        }



        $this->add_aprovals('customer_info');

        $customer_info->status = 'pending';
        $customer_info->action = 'edit';
        if($request->input('status_message') != ''){

            $customer_info->status_message = $request->input('status_message');

        }

        $customer_info->user_id = Auth::id();

        $customer_rate_card->save();



        return response()->json(['status'=>'1']);

    }

    public function delete_customer(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Customer_info::where('id' , $id)->first();
        
        $customer_info->status = 'pending';
        $customer_info->status_message = $request->input('status_message');
        $customer_info->user_id = Auth::id();
        $customer_info->action = 'delete';

        if( $customer_info->save()){
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function customer_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     

        $data['trade_licenses_history']= DB::table('customer_histories')->get();
        $data['table_name']= 'customer_histories';

        $data['page_title'] = "History | Customer ";
        $data['view'] = 'admin.hr_pro.history';
        return view('users.layout', ["data"=>$data]);
    }

   /////


    public function customer_rate_card (){
        $data['customer_rate_cards'] = Customer_rate_card::All();
        // dd($data['customer_rate_cards']);
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Customer Rate Card";
        $data['view'] = 'customer.customer_rate_card';
        return view('user.layout', ["data"=>$data]);
    }

    public function trash_customer_rate_card(){
        $data['modules']= DB::table('modules')->get();
        $data['customer_rate_card'] = Customer_rate_card::All();
        // dd( $data['customer_info']);
        $data['page_title'] = "Customer Rate Card Trash";
        $data['view'] = 'customer.deleted_data_rate_card';
        return view('user.layout', ["data"=>$data]);
    }

    public function customer_rate_card_add(){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();
        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Customer Rate Card";
        $data['view'] = 'customer.add_customer_rate_card';
        return view('user.layout', ["data"=>$data]);
    }

    public function edit_customer_rate_card(Request $request){
        // $data['customer_info'] = Customer_info::find($request->input('id'));
        // $data['customer_department'] = Customer_department::where('customer_id' ,'=' , $request->input('id'))->first();
        $data['customer_rate_card'] = Customer_rate_card::where('id' ,'=' , $request->input('id'))->first();

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Customer Rate Card";
        $data['view'] = 'customer.edit_customer_rate_card';
        return view('user.layout', ["data"=>$data]);
    }

    public function save_customer_rate_card(Request $request){

        $customer_rate_card = new Customer_rate_card;
        
        if($request->input('customer_id') != ''){
            $customer_rate_card->customer_id = $request->input('customer_id');
        }

        if($request->input('from') != ''){
            $customer_rate_card->from = $request->input('from');
        }
        if($request->input('to') != ''){
            $customer_rate_card->to = $request->input('to');

        }
        if($request->input('vechicle_type') != ''){
            $customer_rate_card->vechicle_type = $request->input('vechicle_type');

        }
        if($request->input('other_carges') != ''){
            $customer_rate_card->other_carges = $request->input('other_carges');

        }
        if($request->input('other_des') != ''){
            $customer_rate_card->other_des = $request->input('other_des');

        }

        if($request->input('driver_comission') != ''){
            if(date('l') == 'Friday'){
            $customer_rate_card->driver_comission = (int)$request->input('driver_comission') *1.5;
            }else{
            $customer_rate_card->driver_comission = (int)$request->input('driver_comission');
            }

        }

        if($request->input('rate') != ''){
            $customer_rate_card->rate = $request->input('rate');
        }

        if($request->input('rate_price') != ''){
            $customer_rate_card->rate_price = $request->input('rate_price');
        }

        if($request->input('detention') != ''){
            $customer_rate_card->detention = $request->input('detention');
        }


        if($request->input('time') != ''){
            $customer_rate_card->time = $request->input('time');
        }

        if($request->input('charges') != ''){
            $customer_rate_card->charges = $request->input('charges');
        }

        if($request->input('trip') != ''){
            $customer_rate_card->trip = $request->input('trip');
        }

        if($request->input('ap_km') != ''){
            $customer_rate_card->ap_km = $request->input('ap_km');
        }

        if($request->input('ap_diesel') != ''){
            $customer_rate_card->ap_diesel = $request->input('ap_diesel');
        }

        $this->add_aprovals('customer_info');

        $customer_rate_card->status = 'pending';
        $customer_rate_card->action = 'add';
        if($request->input('status_message') != ''){

            $customer_rate_card->status_message = $request->input('status_message');

        }

        $customer_rate_card->user_id = Auth::id();

        if($customer_rate_card->save()){

            return \Redirect::route('user.customer.customer_rate_card')->with('success', 'Rate Card Added Sucessfully');
        }else{

        }


    }

    public function update_customer_rate_card(Request $request){
        $id =  (int)$request->input('id');
        $customer_rate_card = Customer_rate_card::where('id' , $id)->first();
        // $customer_info = Customer_info::where('id' , $customer_rate_card->customer_id)->first();

    
        if($request->input('from') != ''){
            $customer_rate_card->from = $request->input('from');
        }
        if($request->input('to') != ''){
            $customer_rate_card->to = $request->input('to');

        }
        if($request->input('vechicle_type') != ''){
            $customer_rate_card->vechicle_type = $request->input('vechicle_type');

        }
        if($request->input('other_carges') != ''){
            $customer_rate_card->other_carges = $request->input('other_carges');

        }
        if($request->input('other_des') != ''){
            $customer_rate_card->other_des = $request->input('other_des');

        }

        if($request->input('driver_comission') != ''){
            if(date('l') == 'Friday'){
            $customer_rate_card->driver_comission = (int)$request->input('driver_comission') *1.5;
            }else{
            $customer_rate_card->driver_comission = (int)$request->input('driver_comission');
            }

        }

        if($request->input('rate') != ''){
            $customer_rate_card->rate = $request->input('rate');
        }
        
        if($request->input('rate_price') != ''){
            $customer_rate_card->rate_price = $request->input('rate_price');
        }

        if($request->input('detention') != ''){
            $customer_rate_card->detention = $request->input('detention');
        }


        if($request->input('time') != ''){
            $customer_rate_card->time = $request->input('time');
        }

        if($request->input('charges') != ''){
            $customer_rate_card->charges = $request->input('charges');
        }

        if($request->input('trip') != ''){
            $customer_rate_card->trip = $request->input('trip');
        }

        if($request->input('ap_km') != ''){
            $customer_rate_card->ap_km = $request->input('ap_km');
        }

        if($request->input('ap_diesel') != ''){
            $customer_rate_card->ap_diesel = $request->input('ap_diesel');
        }
    
        $this->add_aprovals('customer_info');

            $customer_rate_card->status = 'pending';
            $customer_rate_card->action = 'edit';
            if($request->input('status_message') != ''){

                $customer_rate_card->status_message = $request->input('status_message');

            }

            $customer_rate_card->user_id = Auth::id();

            $customer_rate_card->save();


        
            return \Redirect::route('user.customer.customer_rate_card')->with('success', 'Rate Card Added Sucessfully');
        

    }



    public function delete_customer_rate_card(Request $request){
        $id =  (int)$request->input('id');
        $customer_rate_card = Customer_rate_card::where('id' , $id)->first();
        
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

}