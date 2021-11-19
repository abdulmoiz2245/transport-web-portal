<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\User;
use App\Models\Roles;
use App\Models\Purchase;
use App\Models\Purchase_mertial_data;

use App\Models\Trade_license_history;

use App\Models\Permissions;
use App\Models\Login_password;

use App\Models\Modules;

use App\Models\Approvals;



use Illuminate\Support\Facades\File;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
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
    ///////// Inventory /////////
    /////////////////////////////////

    public function inventory(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
          
        
        // if($data['permissions']->status != 1 ){
        //     abort(403);
        // }
        $data['purchases']= DB::table('purchases')->get();
        // $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Inventory";
        $data['view'] = 'admin.inventory.inventory';
        return view('layout', ["data"=>$data]);
    }

    public function trash_purchase(){
        $data['modules']= DB::table('modules')->get();
        $data['trade_licenses']= DB::table('purchases')->get();
        // $data['company_names']= DB::table('company_names')->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "Purchase Trash";
        $data['view'] = 'admin.purchase.deleted_data';
        return view('layout', ["data"=>$data]);
    }

    public function purchase_history(){

        $data['modules']= DB::table('modules')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     

        $data['purchase_history']= DB::table('purchase_histories')->get();
        $data['table_name']= 'purchase_histories';

        $data['page_title'] = "History | PURCHASE ";
        $data['view'] = 'admin.purchase.purchase_history';
        return view('layout', ["data"=>$data]);
    }

    public function add_purchase(){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();
         $data['material_data']= DB::table('purchase_mertial_datas')->get();

        $data['page_title'] = "Add Purchase";
        $data['view'] = 'admin.purchase.add_purchase';
        return view('layout', ["data"=>$data]);
    }

    public function view_purchase(Request $request){
        $data['purchase'] = Purchase::find($request->input('id'));
        $data['material_data']= DB::table('purchase_mertial_datas')->get();
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "PURCHASE";
        $data['view'] = 'admin.purchase.view_purchase';
        return view('layout', ["data"=>$data]);
    }

    public function edit_purchase (Request $request){
        $data['purchase'] = Purchase::find($request->input('id'));
        $data['material_data']= DB::table('purchase_mertial_datas')->get();
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Purchase";
        $data['view'] = 'admin.purchase.edit_purchase';
        return view('layout', ["data"=>$data]);
    }

    public function save_purchase(Request $request){

        $purchase = new Purchase;
        
        $check = false;
        foreach(Purchase_mertial_data::all() as $purchase_material){
            if($purchase_material->id == $request->input('material_data_id')){
                $check = true;
            }
        }

        if(!$check){
            $meterial = new Purchase_mertial_data;
            $meterial->name = $request->input('material_data_id');
            $meterial->save();
        }

        if($request->input('date') != ''){
            $purchase->date = $request->input('date');
        }
        if($request->input('trn') != ''){
            $purchase->trn = $request->input('trn');

        }
        if($request->input('company_name') != ''){
            $purchase->company_name = $request->input('company_name');

        }
        if($request->input('company_address') != ''){
            $purchase->company_address = $request->input('company_address');
        }
        if(!$check){
            $purchase->meterial_data_id = $meterial->id;
        }else{
            if($request->input('meterial_data_id') != ''){
                $purchase->meterial_data_id = $request->input('meterial_data_id');
            }
        }
        
        if($request->input('type') != ''){
            $purchase->type = $request->input('type');
        }
        if($request->input('made_in') != ''){
            $purchase->made_in = $request->input('made_in');

        }
        if($request->input('vechicle_num') != ''){
            $purchase->vechicle_num = $request->input('vechicle_num');
        }
        if($request->input('stock_description') != ''){
            $purchase->stock_description = $request->input('stock_description');

        }
        if($request->input('product_name') != ''){
            $purchase->product_name = $request->input('product_name');
        }

        if($request->input('brand') != ''){
            $purchase->brand = $request->input('brand');
        }

        if($request->input('size') != ''){
            $purchase->size = $request->input('size');
        }
        if($request->input('quantity') != ''){
            $purchase->quantity = $request->input('quantity');

        }
        if($request->input('unit') != ''){
            $purchase->unit = $request->input('unit');
        }

        if($request->input('unit_price') != ''){
            $purchase->unit_price = $request->input('unit_price');
        }
        if($request->input('delivery_date') != ''){
            $purchase->delivery_date = $request->input('delivery_date');

        }
        if($request->input('terms') != ''){
            $purchase->terms = $request->input('terms');
        }

        if($request->input('cerdit_days') != ''){
            $purchase->cerdit_days = $request->input('cerdit_days');
        }
        if($request->input('total_amount') != ''){
            $purchase->total_amount = $request->input('total_amount');

        }
        if($request->input('po_number') != ''){
            $purchase->po_number = $request->input('po_number');
        }

        if($request->input('lpo_ref_num') != ''){
            $purchase->lpo_ref_num = $request->input('lpo_ref_num');
        }

        if ($request->hasFile('delivery_proof_copy')) {
            
            $name = time().'_'.str_replace(" ", "_", $request->delivery_proof_copy->getClientOriginalName());
            $file = $request->file('delivery_proof_copy');
            if($file->storeAs('/main_admin/hr_pro/purchase/', $name , ['disk' => 'public_uploads'])){
                $purchase->delivery_proof_copy	 = $name;

            }

        }
        $digits = 5;
        $purchase->po_number = 'PO'.str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);


        $purchase->status_admin = 'approved';
        $purchase->status_account = 'pending';

 
        $purchase->user_id = 0;
        // dd('working');

        

        if($purchase->save()){

            $this->history_table('purchase_histories', 'Add' , 0,  $purchase->id , "purchase.view_purchase");
           
            return \Redirect::route('admin.purchase.purchase')->with('success', 'Data Added Sucessfully');
        }
    }

    public function update_purchase(Request $request){
        $id =  (int)$request->input('id');
        $purchase = Purchase::where('id' , $id)->first();
        // dd($request->input('meterial_data_id'));    

        $check = 0;
        foreach(Purchase_mertial_data::all() as $purchase_material){
        //     // echo $purchase_material->id;
        //     // echo '<br>';
        //     var_dump(  $request->input('meterial_data_id'));
        // die();

            if($purchase_material->id == $request->input('meterial_data_id')){

                $check = 1;
            }
            // echo '<br><br>';
        }

        if($check ==0){
            $meterial = new Purchase_mertial_data;
            $meterial->name = $request->input('meterial_data_id');
            $meterial->save();
        }

        if($request->input('date') != ''){
            $purchase->date = $request->input('date');
        }
        if($request->input('trn') != ''){
            $purchase->trn = $request->input('trn');

        }
        if($request->input('company_name') != ''){
            $purchase->company_name = $request->input('company_name');

        }
        if($request->input('company_address') != ''){
            $purchase->company_address = $request->input('company_address');
        }
        if($check == 0){
            $purchase->meterial_data_id = $meterial->id;
        }else{
            if($request->input('meterial_data_id') != ''){
                $purchase->meterial_data_id = $request->input('meterial_data_id');
            }
        }
        if($request->input('type') != ''){
            $purchase->type = $request->input('type');
        }
        if($request->input('made_in') != ''){
            $purchase->made_in = $request->input('made_in');

        }
        if($request->input('vechicle_num') != ''){
            $purchase->vechicle_num = $request->input('vechicle_num');
        }
        if($request->input('stock_description') != ''){
            $purchase->stock_description = $request->input('stock_description');

        }
        if($request->input('product_name') != ''){
            $purchase->product_name = $request->input('product_name');
        }

        if($request->input('brand') != ''){
            $purchase->brand = $request->input('brand');
        }

        if($request->input('size') != ''){
            $purchase->size = $request->input('size');
        }
        if($request->input('quantity') != ''){
            $purchase->quantity = $request->input('quantity');

        }
        if($request->input('unit') != ''){
            $purchase->unit = $request->input('unit');
        }

        if($request->input('unit_price') != ''){
            $purchase->unit_price = $request->input('unit_price');
        }
        if($request->input('delivery_date') != ''){
            $purchase->delivery_date = $request->input('delivery_date');

        }
        if($request->input('terms') != ''){
            $purchase->terms = $request->input('terms');
        }

        if($request->input('cerdit_days') != ''){
            $purchase->cerdit_days = $request->input('cerdit_days');
        }
        if($request->input('total_amount') != ''){
            $purchase->total_amount = $request->input('total_amount');

        }
        if($request->input('po_number') != ''){
            $purchase->po_number = $request->input('po_number');
        }

        if($request->input('lpo_ref_num') != ''){
            $purchase->lpo_ref_num = $request->input('lpo_ref_num');
        }

        if ($request->hasFile('delivery_proof_copy')) {
            
            $name = time().'_'.str_replace(" ", "_", $request->delivery_proof_copy->getClientOriginalName());
            $file = $request->file('delivery_proof_copy');
            if($file->storeAs('/main_admin/hr_pro/purchase/', $name , ['disk' => 'public_uploads'])){
                $purchase->delivery_proof_copy	 = $name;

            }

        }

        

        $purchase->status_message = $request->input('status_message');
        if( $purchase->user_id != 0){
            $user_id  = $purchase->user_id;
            
        }else{
            $user_id  = 0;
        }
        // dd($purchase->action );

        if($purchase->action == null || $purchase->status_admin == 'approved' || $purchase->action == 'nill'){
            $purchase->action = 'Admin Edit';
        }
        $purchase->status_admin = $request->input('status');


        $purchase->save();

        if($purchase->status_admin == 'approved' || $purchase->user_id == 0 ){
            $this->history_table('purchase_histories', $purchase->action , $user_id,  $purchase->id, "purchase.view_purchase");
       }

        


        return \Redirect::route('admin.purchase.purchase')->with('success', 'Data Edited Sucessfully');

    }

    public function delete_purchase(Request $request){
        $id =  (int)$request->input('id');
        $trade_license = Purchase::where('id' , $id)->first();

       

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

        $this->history_table('purchase_histories', $trade_license->action , $user_id ,  $trade_license->id, "purchase.view_purchase");

        //dd($trade_license->id); 
        if($trade_license->delete()){

            

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function delete_purchase_status(Request $request){
        $id =  (int)$request->input('id');
        $trade_license = Purchase::where('id' , $id)->first();
        
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

            $this->history_table('purchase_histories', $trade_license->action , $user_id ,  $trade_license->id, "purchase.view_purchase");

            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function restore_purchase(Request $request){
        $id =  (int)$request->input('id');
        $trade_license = Purchase::where('id' , $id)->first();
        
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
        $this->history_table('purchase_histories', $trade_license->action , $user_id ,  $trade_license->id, "purchase.view_purchase");
 
        $trade_license->action = 'deleted';
        $trade_license->save();
           
            return response()->json(['status'=>'1']);
        
    }


    ///////////////////////////////////////////////////
    ///////////////// Fuel - Inventory ////////////////
    ///////////////////////////////////////////////////

    //civil defence
    public function fuel(){
        $data['modules']= DB::table('modules')->get();

        // $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'mobile')->get();
        // //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Fuel - Inventory";
        $data['view'] = 'admin.inventory.fuel.fuel';
        return view('layout', ["data"=>$data]);
    }

     //purchased fuel - fuel - inventory
     public function purchased_fuel(){
        $data['modules']= DB::table('modules')->get();

        // $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'mobile')->get();
        // //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Purchased Fuel";
        $data['view'] = 'admin.inventory.fuel.purchased_fuel';
        return view('layout', ["data"=>$data]);
    }

     //readings - fuel - inventory
    public function readings(){
        $data['modules']= DB::table('modules')->get();

        // $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'mobile')->get();
        // //dd($data['modules']);
        $data['trade_licenses']= DB::table('trade_licenses')->get();
        // $data['company_names']= DB::table('company_names')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Readings";
        $data['view'] = 'admin.inventory.fuel.readings';
        return view('layout', ["data"=>$data]);
    }

    public function add_fuel_reading(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Fuel Reading
        ";
        $data['view'] = 'admin.inventory.fuel.add_fuel_reading';
        return view('layout', ["data"=>$data]);
    }

    public function edit_fuel_reading(Request $request){

        // $data['civil_defense'] = Civil_defense_documents::where('type', '=', 'mobile')->where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Fuel Reading
        ";
        $data['view'] = 'admin.inventory.fuel.edit_fuel_reading';
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

        $this->history_table_type('civil_defense_documents_histories', 'Add' ,   $civil_defense->user_id, 'mobile', $civil_defense->id , 'hr_pro.edit_mobile_civil_defence');

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

            $this->history_table_type('civil_defense_documents_histories', $civil_defense->action ,   $user_id, $civil_defense->type , $civil_defense->id , 'hr_pro.edit_mobile_civil_defence');

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

        $this->history_table_type('civil_defense_documents_histories', $civil_defense->action ,   $user_id, $civil_defense->type , $civil_defense->id , 'hr_pro.edit_mobile_civil_defence');


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

            $this->history_table_type('civil_defense_documents_histories', $office_contract->action ,   $user_id, $office_contract->type , $office_contract->id , 'hr_pro.edit_mobile_civil_defence');
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

        $this->history_table_type('civil_defense_documents_histories', $office_contract->action ,   $user_id, $office_contract->type , $office_contract->id , 'hr_pro.edit_mobile_civil_defence');
 
        $office_contract->action = 'nill';
        $office_contract->save();
           
            return response()->json(['status'=>'1']);
        
    }

    ///////////////////////////////////////////////////
    /////////////// Tyres - Inventory /////////////////
    ///////////////////////////////////////////////////

    //tyres
    public function tyres(){
        $data['modules']= DB::table('modules')->get();

        //$data['muncipality'] = Muncipality_documents::where('type', '=', 'mobile')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Tyres - Inventory
        ";
        $data['view'] = 'admin.inventory.tyres.tyres';
        return view('layout', ["data"=>$data]);
    }

     //new_tyres - tyres - inventory
     public function new_used_tyres(){
        $data['modules']= DB::table('modules')->get();

        // $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'mobile')->get();
        // //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "New/Used Tyres";
        $data['view'] = 'admin.inventory.tyres.new_used_tyres';
        return view('layout', ["data"=>$data]);
    }

    public function add_used_tyres(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Used Tyres
        ";
        $data['view'] = 'admin.inventory.tyres.add_used_tyres';
        return view('layout', ["data"=>$data]);

    }

    public function edit_used_tyres(Request $request){

        //$data['muncipality'] = Muncipality_documents::where('type', '=', 'mobile')->where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Used Tyres
        ";
        $data['view'] = 'admin.inventory.tyres.edit_used_tyres';
        return view('layout', ["data"=>$data]);

    }

     //complain_tyres - tyres - inventory
     public function complain_tyres(){
        $data['modules']= DB::table('modules')->get();

        // $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'mobile')->get();
        // //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Complain Tyres";
        $data['view'] = 'admin.inventory.tyres.complain_tyres';
        return view('layout', ["data"=>$data]);
    }

    public function add_complain_tyres(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Complain Tyres
        ";
        $data['view'] = 'admin.inventory.tyres.add_complain_tyres';
        return view('layout', ["data"=>$data]);

    }

    public function edit_complain_tyres(Request $request){

        //$data['muncipality'] = Muncipality_documents::where('type', '=', 'mobile')->where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Complain Tyres
        ";
        $data['view'] = 'admin.inventory.tyres.edit_complain_tyres';
        return view('layout', ["data"=>$data]);

    }

    //tyres entry - tyres - inventory
    public function tyres_entry(){
        $data['modules']= DB::table('modules')->get();

        // $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'mobile')->get();
        // //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Tyres Entry ";
        $data['view'] = 'admin.inventory.tyres.tyres_entry';
        return view('layout', ["data"=>$data]);
    }

    public function add_tyres_entry(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Tyres Entry
        ";
        $data['view'] = 'admin.inventory.tyres.add_tyres_entry';
        return view('layout', ["data"=>$data]);

    }

    public function edit_tyres_entry(Request $request){

        //$data['muncipality'] = Muncipality_documents::where('type', '=', 'mobile')->where('id' ,'=' , $request->input('id'))->first();
        $data['modules']= DB::table('modules')->get();
        // dd($data['civil_defense']->document );
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Tyres Entry
        ";
        $data['view'] = 'admin.inventory.tyres.edit_tyres_entry';
        return view('layout', ["data"=>$data]);

    }

    ///////////////////////////////////////////////////
    ///////////// Spare Parts - Inventory /////////////
    ///////////////////////////////////////////////////

    public function spare_parts(){
        $data['modules']= DB::table('modules')->get();

        //$data['muncipality'] = Muncipality_documents::where('type', '=', 'mobile')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Spare Parts - Inventory
        ";
        $data['view'] = 'admin.inventory.spare_parts.spare_parts';
        return view('layout', ["data"=>$data]);
    }

    //spare parts in storage - spare parts - inventory
    public function spare_parts_in_storage(){
        $data['modules']= DB::table('modules')->get();

        // $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'mobile')->get();
        // //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Spare Parts in Stoarge";
        $data['view'] = 'admin.inventory.spare_parts.spare_parts_in_storage';
        return view('layout', ["data"=>$data]);
    }

    public function add_spare_parts_in_storage(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Spare Part in Storage
        ";
        $data['view'] = 'admin.inventory.spare_parts.add_spare_parts_in_storage';
        return view('layout', ["data"=>$data]);

    }

    public function edit_spare_parts_in_storage(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Spare Part in Storage
        ";
        $data['view'] = 'admin.inventory.spare_parts.edit_spare_parts_in_storage';
        return view('layout', ["data"=>$data]);

    }

    //spare parts entry - spare parts - inventory
    public function spare_parts_entry(){
        $data['modules']= DB::table('modules')->get();

        // $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'mobile')->get();
        // //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Spare Parts Entry";
        $data['view'] = 'admin.inventory.spare_parts.spare_parts_entry';
        return view('layout', ["data"=>$data]);
    }

    public function add_spare_parts_entry(){
        $data['modules']= DB::table('modules')->get();

        // $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'mobile')->get();
        // //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Spare Parts Entry";
        $data['view'] = 'admin.inventory.spare_parts.add_spare_parts_entry';
        return view('layout', ["data"=>$data]);
    }

    public function edit_spare_parts_entry(){
        $data['modules']= DB::table('modules')->get();

        // $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'mobile')->get();
        // //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Spare Parts Entry";
        $data['view'] = 'admin.inventory.spare_parts.edit_spare_parts_entry';
        return view('layout', ["data"=>$data]);
    }

    ///////////////////////////////////////////////////
    ///////////// Tools - Inventory /////////////
    ///////////////////////////////////////////////////

    public function tools(){
        $data['modules']= DB::table('modules')->get();

        //$data['muncipality'] = Muncipality_documents::where('type', '=', 'mobile')->get();
        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Tools in Workshop - Inventory
        ";
        $data['view'] = 'admin.inventory.tools.tools';
        return view('layout', ["data"=>$data]);
    }

    public function add_tools(){

        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add Tools in Workshop
        ";
        $data['view'] = 'admin.inventory.tools.add_tools';
        return view('layout', ["data"=>$data]);

    }

    public function edit_tools(){
        $data['modules']= DB::table('modules')->get();

        // $data['civil_defenses'] = Civil_defense_documents::where('type', '=', 'mobile')->get();
        // //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         //$data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Tools";
        $data['view'] = 'admin.inventory.tools.edit_tools';
        return view('layout', ["data"=>$data]);
    }

}