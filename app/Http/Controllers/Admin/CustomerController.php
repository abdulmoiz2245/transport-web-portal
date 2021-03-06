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
use App\Models\Customer_info;
use App\Models\Customer_department;
use App\Models\Customer_rate_card;
use App\Models\Customer_edit_history;
use App\Models\Customer_department_edit_history;
use App\Models\Customer_rate_card_edit_history;
use App\Models\Erp_department;


use Illuminate\Support\Facades\File;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
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


    /////////////////////////////////
    ///////// Company Name /////////
    /////////////////////////////////


    // public function add_department(){
    //     $data['modules']= DB::table('modules')->get();
    //     //dd($data['modules']);
        
    //     $data['page_title'] = "Add Department Name";
    //     $data['view'] = 'admin.customer.department.add_department';
    //     return view('layout', ["data"=>$data]);
    // }

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

        $data['page_title'] = "Customer";
        $data['view'] = 'admin.customer.customer';
        return view('layout', ["data"=>$data]);
    }


    public function add_customer(){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();
         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Customer";
        $data['view'] = 'admin.customer.add_customer';
        return view('layout', ["data"=>$data]);
    }

    public function trash_customer(){
        $data['modules']= DB::table('modules')->get();
        $data['customer_info'] = DB::table('customer_info')->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "Customer Trash";
        $data['view'] = 'admin.customer.deleted_data';
        return view('layout', ["data"=>$data]);
    }

    public function view_customer(Request $request){

        $data['customer_info'] = Customer_info::find($request->input('id'));
        $data['customer_department'] = Customer_department::where('customer_id' ,'=' , $request->input('id'))->first();
        $data['customer_rate_card'] = Customer_rate_card::where('customer_id' ,'=' , $request->input('id'));

        $data['modules']= DB::table('modules')->get();
        $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "  Customer";
        $data['view'] = 'admin.customer.view_customer';
        return view('layout', ["data"=>$data]);
    }
    

    public function edit_customer (Request $request){
        $data['customer_info'] = Customer_info::find($request->input('id'));
        $data['customer_department'] = Customer_department::where('customer_id' ,'=' , $request->input('id'))->first();
        $data['customer_rate_card'] = Customer_rate_card::where('customer_id' ,'=' , $request->input('id'));


        $data['customer_info_history'] = Customer_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();

        $data['customer_dep_history'] = Customer_department_edit_history::where('customer_id' , $request->input('id'))->orderBy('created_at','desc')->first();
        
        
        
        
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Customer";
        $data['view'] = 'admin.customer.edit_customer';
        return view('layout', ["data"=>$data]);
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
        $customer_info->status = 'approved';
        $customer_info->user_id = 0;


        if($customer_info->save()){
             $this->history_table('customer_histories', 'Add', $customer_info->user_id,  $customer_info->id, "customer.view_customer");
            return response()->json(['status'=>'1' , 'id'=>$customer_info->id]);
        }else{
            return response()->json(['status'=>'0']);
        }

    }

    public function save_customer_department(Request $request){

        $customer_dep = new Customer_department;

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


        if($customer_dep->save()){

            return response()->json(['status'=>'1']);
        }else{

            return response()->json(['status'=>'0']);
        }

    }

    public function update_customer_info(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Customer_info::where('id' , $id)->first();

        $customer_edit_info = new Customer_edit_history;
        //customer edit history track
        $customer_edit_info->row_id = (int)$request->input('id');
        $customer_edit_info->company_id =  $customer_info->company_id;
        $customer_edit_info->name =  $customer_info->name;
        $customer_edit_info->address =  $customer_info->address;
        $customer_edit_info->city =  $customer_info->city;
        $customer_edit_info->country =  $customer_info->country;
        $customer_edit_info->tel_number =  $customer_info->tel_number;
        $customer_edit_info->fax =  $customer_info->fax;
        $customer_edit_info->mobile =  $customer_info->mobile;
        $customer_edit_info->email =  $customer_info->email;
        $customer_edit_info->contact_person =  $customer_info->contact_person;
        $customer_edit_info->des =  $customer_info->des;
        $customer_edit_info->web =  $customer_info->web;
        $customer_edit_info->credit_term =  $customer_info->credit_term;
        $customer_edit_info->remarks =  $customer_info->remarks;
        $customer_edit_info->portal_login =  $customer_info->portal_login;
        $customer_edit_info->user =  $customer_info->user	;
        $customer_edit_info->pw	 =  $customer_info->pw	;
        $customer_edit_info->trn	 =  $customer_info->trn	;
        $customer_edit_info->trn_copy	 =  $customer_info->trn_copy	;


        $customer_edit_info->business_license_copy	 =  $customer_info->business_license_copy	;
        $customer_edit_info->business_license_expiary_date =  $customer_info->business_license_expiary_date	;
        $customer_edit_info->business_contract_copy	 =  $customer_info->business_contract_copy	;
        $customer_edit_info->business_contract_expiary_date =  $customer_info->business_contract_expiary_date	;


        if(!$customer_edit_info->save()){
            return response()->json(['status'=>'0']);
        }

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




        $customer_info->status_message = $request->input('status_message');
        if( $customer_info->user_id != 0){
            $user_id  = $customer_info->user_id;
            
        }else{
            $user_id  = 0;
        }

        if($customer_info->action == null || $customer_info->status == 'approved' || $customer_info->action == 'nill' ){
            $customer_info->action = 'edit';
        }

        $customer_info->status = $request->input('status');


        $customer_info->save();

        if($request->input('status') == 'approved'){
            $this->remove_table_name('customer_info');
        }
        if($customer_info->status == 'approved' || $customer_info->user_id == 0 ){
            //  $this->history_table('customer_histories', $customer_info->action , $user_id, "route('admin.customer.view_customer')", $customer_info->id);
             $this->history_table('customer_histories', $customer_info->action , $user_id,  $customer_info->id, "customer.view_customer");
        }


        return response()->json(['status'=>'1']);
    }

    public function update_customer_department(Request $request){
        $id =  (int)$request->input('id');
        $customer_dep = Customer_department::where('id' , $id)->first();
        $customer_info = Customer_info::where('id' , $customer_dep->customer_id)->first();

        $customer_edit_dep = new Customer_department_edit_history();
        //customer edit history track
        $customer_edit_dep->row_id = $customer_dep->id;
        $customer_edit_dep->customer_id = $customer_dep->customer_id;

        $customer_edit_dep->department_name = $customer_dep->department_name;
        $customer_edit_dep->concerned_person_name = $customer_dep->concerned_person_name;
        $customer_edit_dep->concerned_person_designation = $customer_dep->concerned_person_designation;
        $customer_edit_dep->tell = $customer_dep->tell;
        $customer_edit_dep->mobile = $customer_dep->mobile;
        $customer_edit_dep->fax = $customer_dep->fax;
        $customer_edit_dep->email = $customer_dep->email;

        if(!$customer_edit_dep->save()){
            return response()->json(['status'=>'0']);
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


       


        
        if( $customer_info->user_id != 0){
            $user_id  = $customer_info->user_id;
            
        }else{
            $user_id  = 0;
        }

        if($customer_info->action == null || $customer_info->status == 'approved' || $customer_info->action == 'nill' ){

            $customer_info->action = 'edit';
        }

        $customer_dep->save();

        if($request->input('status') == 'customer_department'){
            $this->remove_table_name('customer_department');
        }
        // if($customer_info->status == 'approved' || $customer_info->user_id == 0 ){
        //     //  $this->history_table('customer_histories', $customer_info->action , $user_id );
        //     $this->history_table('customer_histories', $customer_info->action , $user_id,  $customer_info->id, "customer.view_customer");
        // }


        return response()->json(['status'=>'1']);

    }

    public function delete_customer(Request $request){
        $id =  $request->input('id');
        $customer_info = Customer_info::where('id' , $id)->first();
        $customer_department = Customer_department::where('customer_id' ,'=' , $request->input('id'))->first();
        $customer_rate_card = Customer_rate_card::where('customer_id' ,'=' , $request->input('id'))->first();
        // dd( $id);
       


        $customer_info->status_message = $request->input('status_message');
        if( $customer_info->user_id != 0){
            $user_id  = $customer_info->user_id;
            
        }else{
            $user_id  = 0;
        }

        

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }

       
            $customer_info->action = 'delete';
        
        $customer_info->save();

        // $this->history_table('customer_histories', $customer_info->action , $user_id);
        $this->history_table('customer_histories', $customer_info->action , $user_id,  $customer_info->id, "customer.view_customer");
 
        if($customer_info->delete() ){
            if($customer_department != null)
                $customer_department->delete();
            if($customer_rate_card != null)
                $customer_rate_card->delete();
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function delete_customer_status(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Customer_info::where('id' , $id)->first();
        
        $customer_info->status_message = $request->input('status_message');
        if( $customer_info->user_id != 0){
            $user_id  = $customer_info->user_id;
            
        }else{
            $user_id  = 0;
        }

        $customer_info->row_status = 'deleted';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }

       
            $customer_info->action = 'delete';
        

        // $this->history_table('customer_histories', $customer_info->action , $user_id);
        $this->history_table('customer_histories', $customer_info->action , $user_id,  $customer_info->id, "customer.view_customer");
 
        if( $customer_info->save()){
           
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_customer(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Customer_info::where('id' , $id)->first();
        
        $customer_info->status_message = $request->input('status_message');
        if( $customer_info->user_id != 0){
            $user_id  = $customer_info->user_id;
            
        }else{
            $user_id  = 0;
        }

        $customer_info->row_status = 'active';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }

        
            $customer_info->action = 'restored';
        
        $customer_info->save();
        // $this->history_table('customer_histories', $customer_info->action , $user_id);
        $this->history_table('customer_histories', $customer_info->action , $user_id,  $customer_info->id, "customer.view_customer");
        $customer_info->action = 'nill';
        $customer_info->save();
      
           
            return response()->json(['status'=>'1']);
        
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
        return view('layout', ["data"=>$data]);
    }

    //////

    public function customer_rate_card ($id){
        $data['customer_rate_cards'] = Customer_rate_card::where('customer_id' ,'=' ,$id)->get();
        // dd($data['customer_rate_cards']);
        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Customer Rate Card";
        $data['view'] = 'admin.customer.customer_rate_card';
        return view('layout', ["data"=>$data]);
    }

    public function trash_customer_rate_card(){
        $data['modules']= DB::table('modules')->get();
        $data['customer_rate_card'] = Customer_rate_card::All();
        // dd( $data['customer_rate_card']);
        $data['page_title'] = "Customer Rate Card Trash";
        $data['view'] = 'admin.customer.deleted_data_rate_card';
        return view('layout', ["data"=>$data]);
    }

    public function customer_rate_card_add($id){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();
         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();
         $data['customer_id'] = $id;
        $data['page_title'] = "Add Customer Rate Card";
        $data['view'] = 'admin.customer.add_customer_rate_card';
        return view('layout', ["data"=>$data]);
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
        $data['view'] = 'admin.customer.edit_customer_rate_card';
        return view('layout', ["data"=>$data]);
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


        if($request->input('detention_days') != ''){
            $customer_rate_card->detention_days = $request->input('detention_days');
        }

        if($request->input('detention_hours') != ''){
            $customer_rate_card->detention_hours = $request->input('detention_hours');
        }

        if($request->input('detention_charges_days') != ''){
            $customer_rate_card->detention_charges_days = $request->input('detention_charges_days');
        }

        if($request->input('detention_charges_hours') != ''){
            $customer_rate_card->detention_charges_hours = $request->input('detention_charges_hours');
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

        if($request->input('ap_fuel') != ''){
            $customer_rate_card->ap_fuel = $request->input('ap_fuel');
        }

        $customer_rate_card->status = 'approved';
        $customer_rate_card->user_id = 0;

        // $this->history_table('customer_histories', 'Add Rate Card' , 0);

        if($customer_rate_card->save()){

            return \Redirect::route('admin.customer.customer_rate_card' ,  
           $request->input('customer_id') )->with('success', 'Rate Card Added Sucessfully');
        }else{

        }


    }

    public function update_customer_rate_card(Request $request){
        $id =  (int)$request->input('id');
        $customer_rate_card = Customer_rate_card::where('id' , $id)->first();
        // $customer_info = Customer_info::where('id' , $customer_rate_card->customer_id)->first();
        $customer_edit_rate_card = new Customer_rate_card_edit_history();
        //customer edit history track
        $customer_edit_rate_card->row_id = $customer_rate_card->id;
        $customer_edit_rate_card->customer_id = $customer_rate_card->customer_id;
        $customer_edit_rate_card->from = $customer_rate_card->from;
        $customer_edit_rate_card->to = $customer_rate_card->to ;
        $customer_edit_rate_card->vechicle_type = $customer_rate_card->vechicle_type;
        $customer_edit_rate_card->rate = $customer_rate_card->rate;
        $customer_edit_rate_card->rate_price = $customer_rate_card->rate_price;
        $customer_edit_rate_card->driver_comission = $customer_rate_card->driver_comission;       $customer_edit_rate_card->other_carges = $customer_rate_card->other_carges;
        
        $customer_edit_rate_card->other_des = $customer_rate_card->other_des;
        $customer_edit_rate_card->detention = $customer_rate_card->detention;
        $customer_edit_rate_card->time = $customer_rate_card->time;
        $customer_edit_rate_card->charges	 = $customer_rate_card->charges	;
        $customer_edit_rate_card->detention_days = $customer_rate_card->detention_days;
        $customer_edit_rate_card->detention_hours = $customer_rate_card->detention_hours;
        $customer_edit_rate_card->detention_charges_days = $customer_rate_card->detention_charges_days;
        $customer_edit_rate_card->detention_charges_hours = $customer_rate_card->detention_charges_hours;
        $customer_edit_rate_card->trip = $customer_rate_card->trip;
        $customer_edit_rate_card->ap_km = $customer_rate_card->ap_km;
        $customer_edit_rate_card->ap_diesel = $customer_rate_card->ap_diesel;
        $customer_edit_rate_card->ap_fuel = $customer_rate_card->ap_fuel;
        


        
        if(!$customer_edit_rate_card->save()){
            return response()->json(['status'=>'0']);
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


        if($request->input('detention_days') != ''){
            $customer_rate_card->detention_days = $request->input('detention_days');
        }

        if($request->input('detention_hours') != ''){
            $customer_rate_card->detention_hours = $request->input('detention_hours');
        }

        if($request->input('detention_charges_days') != ''){
            $customer_rate_card->detention_charges_days = $request->input('detention_charges_days');
        }

        if($request->input('detention_charges_hours') != ''){
            $customer_rate_card->detention_charges_hours = $request->input('detention_charges_hours');
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

        if($request->input('ap_fuel') != ''){
            $customer_rate_card->ap_fuel = $request->input('ap_fuel');
        }
      
        if( $customer_rate_card->user_id != 0){
            $user_id  = $customer_rate_card->user_id;
            
        }else{
            $user_id  = 0;
        }
        $status = $customer_rate_card->status;
        $customer_rate_card->status = $request->input('status');
        
        

        
        if($customer_rate_card->action == null || $status == 'approved' || $customer_rate_card->action == 'nill' ){
           
            $customer_rate_card->action = 'edit';
        }
        

        // dd('sdsd');


        $customer_rate_card->save();

        if($request->input('status') == 'approved'){
            $this->remove_table_name('customer_rate_card');
        }
        if($customer_rate_card->status == 'approved' || $customer_rate_card->user_id == 0 ){
            //  $this->history_table('customer_histories', $customer_rate_card->action , $user_id);
        }


        
        return \Redirect::route('admin.customer.customer_rate_card',  $request->input('customer_id') )->with('success', 'Rate Card Edited Sucessfully');
        

    }

    public function delete_customer_rate_card(Request $request){
        $id =  $request->input('id');
    
        $customer_rate_card = Customer_rate_card::where('id' ,'=' , $request->input('id'))->first();
        // dd( $id);
        


        $customer_rate_card->status_message = $request->input('status_message');
        if( $customer_rate_card->user_id != 0){
            $user_id  = $customer_rate_card->user_id;
            
        }else{
            $user_id  = 0;
        }

        

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }

       
            $customer_rate_card->action = 'delete';
        
        $customer_rate_card->save();

        // $this->history_table('customer_histories', $customer_rate_card->action , $user_id);
 
        if($customer_rate_card->delete() ){
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function delete_customer_rate_card_status(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Customer_rate_card::where('id' , $id)->first();
        // dd( $customer_info);
        $customer_info->status_message = $request->input('status_message');
        if( $customer_info->user_id != 0){
            $user_id  = $customer_info->user_id;
            
        }else{
            $user_id  = 0;
        }

        $customer_info->row_status = 'deleted';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }

       
            $customer_info->action = 'delete';
        

        // $this->history_table('customer_histories', $customer_info->action , $user_id);
 
        if( $customer_info->save()){
           
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_customer_rate_card(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Customer_rate_card::where('id' , $id)->first();
        
        $customer_info->status_message = $request->input('status_message');
        if( $customer_info->user_id != 0){
            $user_id  = $customer_info->user_id;
            
        }else{
            $user_id  = 0;
        }

        $customer_info->row_status = 'active';

       

        if($request->input('status') == 'approved'){
            $this->remove_table_name('customer_infos');
        }

        
            $customer_info->action = 'restored';
        
        $customer_info->save();
        // $this->history_table('customer_histories', $customer_info->action , $user_id);
        $customer_info->action = 'nill';
        $customer_info->save();
      
           
            return response()->json(['status'=>'1']);
        
    }
}
