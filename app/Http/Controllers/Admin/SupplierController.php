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
use App\Models\Supplier_info;
use App\Models\Supplier_department;
use App\Models\Supplier_new_department;


use Illuminate\Support\Facades\File;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
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

    public function history_table($table_name , $action , $user_id){
        DB::table($table_name)->insert([
            'action' => $action,
            'date' => date("Y-m-d  H:i:s"),
            'user_id' => $user_id,
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

    public function supplier(){

        $data['modules']= DB::table('modules')->get();
        $data['customer_info'] = DB::table('supplier_infos')->get();

        $data['page_title'] = "Supplier";
        $data['view'] = 'admin.supplier.supplier';
        return view('layout', ["data"=>$data]);
    }
    public function trash_supplier(){
        $data['modules']= DB::table('modules')->get();
        $data['customer_info'] = DB::table('supplier_infos')->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "Supplier Trash";
        $data['view'] = 'admin.supplier.deleted_data';
        return view('layout', ["data"=>$data]);
    }

    public function add_supplier(){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();
         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Supplier";
        $data['view'] = 'admin.supplier.add_supplier';
        return view('layout', ["data"=>$data]);
    }

    public function view_supplier(Request $request){

        $data['customer_info'] = Supplier_info::find($request->input('id'));
        $data['customer_department'] = Supplier_department::where('supplier_id' ,'=' , $request->input('id'))->first();
        

        $data['modules']= DB::table('modules')->get();
        $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "  Supplier";
        $data['view'] = 'admin.supplier.view_supplier';
        return view('layout', ["data"=>$data]);
    }
    

    public function edit_supplier (Request $request){
        $data['customer_info'] = Supplier_info::find($request->input('id'));
        $data['customer_department'] = Supplier_department::where('supplier_id' ,'=' , $request->input('id'))->first();
        

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Supplier";
        $data['view'] = 'admin.supplier.edit_supplier';
        return view('layout', ["data"=>$data]);
    }

    public function save_supplier_info(Request $request){

        $customer_info = new Supplier_info;
        
        if($request->input('company_id') != ''){
            $customer_info->company_id = $request->input('company_id');
        }
        
        if($request->input('name') != ''){
            $customer_info->name = $request->input('name');
        }

        if($request->input('product') != ''){
            $customer_info->product = $request->input('product');
        }

        if($request->input('services') != ''){
            $customer_info->services = $request->input('services');
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

        if($request->input('is_guaranty') != ''){
            $customer_info->is_guaranty = $request->input('is_guaranty');
        }

        if($request->input('amount') != ''){
            $customer_info->guaranty_amount = $request->input('amount');
        }

        if ($request->hasFile('guaranty_cheque')) {

            $name = time().'_'.str_replace(" ", "_", $request->guaranty_cheque->getClientOriginalName());
            $file = $request->file('guaranty_cheque');
            if($file->storeAs('/main_admin/supplier/', $name , ['disk' => 'public_uploads'])){
                $customer_info->guaranty_cheque = $name;

            }
            
        }

        if ($request->hasFile('guaranty_reciving')) {

            $name = time().'_'.str_replace(" ", "_", $request->guaranty_reciving->getClientOriginalName());
            $file = $request->file('guaranty_reciving');
            if($file->storeAs('/main_admin/supplier/', $name , ['disk' => 'public_uploads'])){
                $customer_info->guaranty_reciving = $name;

            }
            
        }
        
        if ($request->hasFile('trn_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->trn_copy->getClientOriginalName());
            $file = $request->file('trn_copy');
            if($file->storeAs('/main_admin/supplier/', $name , ['disk' => 'public_uploads'])){
                $customer_info->trn_copy = $name;

            }
            
        }

        if ($request->hasFile('business_license_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->business_license_copy->getClientOriginalName());
            $file = $request->file('business_license_copy');
            if($file->storeAs('/main_admin/supplier/', $name , ['disk' => 'public_uploads'])){
                $customer_info->business_license_copy = $name;

            }
            
        }

        if ($request->hasFile('business_contract_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->business_contract_copy->getClientOriginalName());
            $file = $request->file('business_contract_copy');
            if($file->storeAs('/main_admin/supplier/', $name , ['disk' => 'public_uploads'])){
                $customer_info->business_contract_copy = $name;

            }
            
        }
        $customer_info->status = 'approved';
        $customer_info->user_id = 0;

        

        if($customer_info->action == null){
            $customer_info->action = 'Add';
        }

       
        


        if($customer_info->save()){

            if($customer_info->status == 'approved' || $customer_info->user_id == 0 ){
                $this->history_table('supplier_histories', $customer_info->action , $customer_info->user_id);
            }

            return response()->json(['status'=>'1' , 'id'=>$customer_info->id]);
        }else{
            return response()->json(['status'=>'0']);
        }

    }

    public function save_supplier_department(Request $request){

        $customer_dep = new Supplier_department;

        if($request->input('supplier_id') != ''){
            $customer_dep->supplier_id = $request->input('supplier_id');
        }
        
        if($request->input('account_name') != ''){
            $customer_dep->account_name = $request->input('account_name');
        }
        
        if($request->input('delivery_order') != ''){
            $customer_dep->delivery_order = $request->input('delivery_order');
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

   

    public function update_supplier_info(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Supplier_info::where('id' , $id)->first();

        if($request->input('company_id') != ''){
            $customer_info->company_id = $request->input('company_id');
        }
        
        if($request->input('name') != ''){
            $customer_info->name = $request->input('name');
        }

        if($request->input('product') != ''){
            $customer_info->product = $request->input('product');
        }

        if($request->input('services') != ''){
            $customer_info->services = $request->input('services');
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

        if($request->input('amount') != ''){
            $customer_info->guaranty_amount = $request->input('amount');
        }

        if($request->input('guaranty_amount') != ''){
            $customer_info->guaranty_amount = $request->input('guaranty_amount');
        }

        if ($request->hasFile('guaranty_cheque')) {

            $name = time().'_'.str_replace(" ", "_", $request->guaranty_cheque->getClientOriginalName());
            $file = $request->file('guaranty_cheque');
            if($file->storeAs('/main_admin/supplier/', $name , ['disk' => 'public_uploads'])){
                $customer_info->guaranty_cheque = $name;

            }
            
        }

        if ($request->hasFile('guaranty_reciving')) {

            $name = time().'_'.str_replace(" ", "_", $request->guaranty_reciving->getClientOriginalName());
            $file = $request->file('guaranty_reciving');
            if($file->storeAs('/main_admin/supplier/', $name , ['disk' => 'public_uploads'])){
                $customer_info->guaranty_reciving = $name;

            }
            
        }
        
        if ($request->hasFile('trn_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->trn_copy->getClientOriginalName());
            $file = $request->file('trn_copy');
            if($file->storeAs('/main_admin/supplier/', $name , ['disk' => 'public_uploads'])){
                $customer_info->trn_copy = $name;

            }
            
        }

        if ($request->hasFile('business_license_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->business_license_copy->getClientOriginalName());
            $file = $request->file('business_license_copy');
            if($file->storeAs('/main_admin/supplier/', $name , ['disk' => 'public_uploads'])){
                $customer_info->business_license_copy = $name;

            }
            
        }

        if ($request->hasFile('business_contract_copy')) {

            $name = time().'_'.str_replace(" ", "_", $request->business_contract_copy->getClientOriginalName());
            $file = $request->file('business_contract_copy');
            if($file->storeAs('/main_admin/supplier/', $name , ['disk' => 'public_uploads'])){
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
            $this->remove_table_name('supplier_infos');
        }
        if($customer_info->status == 'approved' || $customer_info->user_id == 0 ){
             $this->history_table('supplier_histories', $customer_info->action , $user_id);
        }


        return response()->json(['status'=>'1']);
    }

    public function update_supplier_department(Request $request){
        $id =  (int)$request->input('id');
        $customer_dep = Supplier_department::where('id' , $id)->first();
         $customer_info = Supplier_info::where('id' , (int)$request->input('supplier_id'))->first();

         

        if($request->input('account_name') != ''){
            $customer_dep->account_name = $request->input('account_name');
        }
        
        if($request->input('delivery_order') != ''){
            $customer_dep->delivery_order = $request->input('delivery_order');
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
            $this->remove_table_name('supplier_department');
        }
        if($customer_info->status == 'approved' || $customer_info->user_id == 0 ){
             $this->history_table('supplier_histories', $customer_info->action , $user_id );
        }


        return response()->json(['status'=>'1']);

    }

    

    public function delete_supplier(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Supplier_info::where('id' , $id)->first();
        $customer_department = Supplier_department::where('supplier_id' ,'=' , $request->input('id'))->first();
    

        if($customer_info->trn_copy != null){
            
            $path = public_path().'/main_admin/supplier/'.$customer_info->trn_copy;
            // echo $path;
            if(File::exists($path)){
               unlink($path);
                //$trade_license->id_card = 'null';
            }

        }

        if($customer_info->business_license_copy != null){
            
            $path = public_path().'/main_admin/supplier/'.$customer_info->business_license_copy;
            // echo $path;
            if(File::exists($path)){
               unlink($path);
                //$trade_license->id_card = 'null';
            }

        }

        if($customer_info->business_contract_copy != null){
            
            $path = public_path().'/main_admin/supplier/'.$customer_info->business_contract_copy;
            // echo $path;
            if(File::exists($path)){
               unlink($path);
                //$trade_license->id_card = 'null';
            }

        }


        $customer_info->status_message = $request->input('status_message');
        if( $customer_info->user_id != 0){
            $user_id  = $customer_info->user_id;
            
        }else{
            $user_id  = 0;
        }

        $customer_info->save();

        if($request->input('status') == 'approved'){
            $this->remove_table_name('trade_licenses');
        }

        if($customer_info->action == null){
            $customer_info->action = 'delete';
        }

        $this->history_table('supplier_histories', $customer_info->action , $user_id);
 
        if($customer_info->delete() ){
            if($customer_department != null)
                $customer_department->delete();
        
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function delete_supplier_status(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Supplier_info::where('id' , $id)->first();
        
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
        

        $this->history_table('customer_histories', $customer_info->action , $user_id);
 
        if( $customer_info->save()){
           
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_supplier(Request $request){
        $id =  (int)$request->input('id');
        $customer_info = Supplier_info::where('id' , $id)->first();
        
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
        $this->history_table('customer_histories', $customer_info->action , $user_id);
        $customer_info->action = 'nill';
        $customer_info->save();
      
           
            return response()->json(['status'=>'1']);
        
    }

    public function supplier_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     

        $data['trade_licenses_history']= DB::table('supplier_histories')->get();
        $data['table_name']= 'supplier_histories';

        $data['page_title'] = "History | Supplier ";
        $data['view'] = 'admin.hr_pro.history';
        return view('layout', ["data"=>$data]);
    }

    public function save_department(Request $request){
           
        $department_name = new Supplier_new_department;
        $department_name->name = $request->input('new_dep_name');
        $department_name->save();

        $department_names =  Supplier_new_department::all();
        $row = '';
        $row .= " <select name='department_name' class='form-control'>";
        foreach($department_names as $department){
            $row .= "<option value='".$department->id ."'>". $department->name . "</option>";
        }

        $row .= "</select>";

        
        return response()->json(['status'=>'1' , 'row'=> $row]);

    }
}