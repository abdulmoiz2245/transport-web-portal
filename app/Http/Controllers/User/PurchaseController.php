<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\User;
use App\Models\Roles;

use App\Models\Purchase_mertial_data;
use App\Models\Purchase_vehicle;
use App\Models\Purchase_vehicle_edit_history;
use App\Models\Permissions;
use App\Models\Login_password;

use App\Models\Modules;

use App\Models\Approvals;


use Illuminate\Support\Facades\File;
use App\Http\Controllers\Redirect;
use App\Models\Purchase;
use App\Models\Purchase_edit_history;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
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
     
        $data['purchases_vechicle']= Purchase_vehicle::all();
          
        
        // if($data['permissions']->status != 1 ){
        //     abort(403);
        // }
        $data['purchases']= DB::table('purchases')->get();
        $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "PURCHASE";
        $data['view'] = 'purchase.purchase';
        return view('users.layout', ["data"=>$data]);
    }

    public function trash_purchase(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();

        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['trade_licenses']= DB::table('purchases')->get();
        // $data['company_names']= DB::table('company_names')->get();
        // dd( $data['customer_info']);
        $data['page_title'] = "Purchase Trash";
        $data['view'] = 'purchase.deleted_data';
        return view('users.layout', ["data"=>$data]);
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
        return view('users.layout', ["data"=>$data]);
    }

    public function add_purchase(){
        $data['modules']= DB::table('modules')->get();

        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Add PURCHASE";
        $data['view'] = 'purchase.add_purchase';
        return view('users.layout', ["data"=>$data]);
    }

    public function add_vehicle_purchase(){
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        $data['company_names']= DB::table('company_names')->get();
        $data['material_data']= DB::table('purchase_mertial_datas')->get();

        $data['page_title'] = "Add Purchase";
        $data['view'] = 'purchase.add_vehicle_purchase';
        return view('users.layout', ["data"=>$data]);
    }

    public function view_purchase(Request $request){
        $data['purchase'] = Purchase::find($request->input('id'));

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

    public function view_vehicle_purchase(Request $request){
        $data['purchase'] = Purchase_vehicle::find($request->input('id'));
        $data['material_data']= DB::table('purchase_mertial_datas')->get();
        $data['modules']= DB::table('modules')->get();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "PURCHASE";
        $data['view'] = 'purchase.view_vehicle_purchase';
        return view('users.layout', ["data"=>$data]);
    }

    public function edit_purchase(Request $request){
        $data['purchase'] = Purchase::find($request->input('id'));

        $data['modules']= DB::table('modules')->get();

        $data['purchase_edit'] = Purchase_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();

        //dd($data['modules']);
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit PURCHASE";
        $data['view'] = 'purchase.edit_purchase';
        return view('users.layout', ["data"=>$data]);
    }
    public function edit_vehicle_purchase (Request $request){
        $data['purchase'] = Purchase_vehicle::find($request->input('id'));
        $data['material_data']= DB::table('purchase_mertial_datas')->get();
        $data['modules']= DB::table('modules')->get();

        $data['purchase_edit'] = Purchase_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();


        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 1)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
         $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Edit Purchase";
        $data['view'] = 'purchase.edit_vehicle_purchase';
        return view('users.layout', ["data"=>$data]);
    }

    public function save_purchase(Request $request){

        $purchase = new Purchase;
        $check = 0;
        foreach(Purchase_mertial_data::all() as $purchase_material){
            if($purchase_material->id == $request->input('meterial_data_id_1')){
                $check = 1;
                $check_id_name = $request->input('meterial_data_id_1');
                break;
            }else if($purchase_material->name == $request->input('meterial_data_id_1')){
                $check = 1;
                $check_id_name = $purchase_material->id;
                break;
            }
        }
        
        // dd($request->input('meterial_data_id_1'));

        if($check != 1){
            $meterial = new Purchase_mertial_data;
            $meterial->name = $request->input('meterial_data_id_1');
            $meterial->save();

            $purchase->meterial_data_id = $meterial->id;

        }else{
            $purchase->meterial_data_id = $check_id_name;

        }

        // dd( $purchase->meterial_data_id);
        
        if($request->input('supplier_id') != ''){
            $purchase->supplier_id = $request->input('supplier_id');
        }
        if($request->input('supplier_name') != ''){
            $purchase->supplier_name = $request->input('supplier_name');
        }

        if($request->input('supplier_status') != ''){
            $purchase->supplier_status = $request->input('supplier_status');
        }

        if($request->input('is_vat') != ''){
            $purchase->is_vat = $request->input('is_vat');
        }
        if($request->input('company_id') != ''){
            $purchase->company_id = $request->input('company_id');

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

        // $this->add_aprovals('trade_licenses');

        $purchase->status_admin = 'pending';
        $purchase->status_account = 'pending';
        $purchase->row_status = 'active';


        $purchase->action = 'add';
        if($request->input('status_message') != ''){
            $purchase->status_message = $request->input('status_message');
        }

        $purchase->user_id = Auth::id();
        $purchase->save();

       return \Redirect::route('user.purchase')->with('success', 'Data Added Sucessfully');

    }

    public function save_vechicle_purchase(Request $request){

        $purchase = new Purchase_vehicle();
        
        $check = 0;
         if($request->input('supplier_id') != ''){
            $purchase->supplier_id = $request->input('supplier_id');
        }

        foreach(Purchase_mertial_data::all() as $purchase_material){
            if($purchase_material->id == $request->input('meterial_data_id_1')){
                $check = 1;
            }
        }
 

        $purchase->meterial_data_id = 'vehicle';

        

        if($request->input('supplier_id') != ''){
            $purchase->supplier_id = $request->input('supplier_id');
        }
        if($request->input('supplier_name') != ''){
            $purchase->supplier_name = $request->input('supplier_name');
        }

        if($request->input('supplier_status') != ''){
            $purchase->supplier_status = $request->input('supplier_status');
        }

        if($request->input('is_vat') != ''){
            $purchase->is_vat = $request->input('is_vat');
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

        if($request->input('company_id') != ''){
            $purchase->company_id = $request->input('company_id');

        }
        

        
        if($request->input('vechicle_type') != ''){
            $purchase->vechicle_type = $request->input('vechicle_type');
        }
        if($request->input('make') != ''){
            $purchase->make = $request->input('make');

        }
        if($request->input('model') != ''){
            $purchase->model = $request->input('model');
        }
        if($request->input('color') != ''){
            $purchase->color = $request->input('color');

        }
        if($request->input('engine_number') != ''){
            $purchase->engine_number = $request->input('engine_number');
        }

        if($request->input('trailer_type') != ''){
            $purchase->trailer_type = $request->input('trailer_type');
        }

        if($request->input('size') != ''){
            $purchase->size = $request->input('size');
        }

        if($request->input('axle') != ''){
            $purchase->axle = $request->input('axle');
        }

        if($request->input('chassis_no') != ''){
            $purchase->chassis_no = $request->input('chassis_no');
        }

        if($request->input('vehicle_suspension') != ''){
            $purchase->vehicle_suspension = $request->input('vehicle_suspension');
        }
        if($request->input('quantity') != ''){
            $purchase->quantity = $request->input('quantity');

        }
        
        if($request->input('delivery_date') != ''){
            $purchase->delivery_date = $request->input('delivery_date');

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


        $purchase->status_admin = 'pending';
        $purchase->status_account = 'pending';

        $purchase->action = 'pending';
        $purchase->user_id = 0;
        // dd('working');

        

        if($purchase->save()){
           

            $this->history_table('purchase_vehicle_histories', 'Add' , 0,  $purchase->id , "purchase.view_vehicle_purchase");
           
            return \Redirect::route('user.purchase')->with('success', 'Data Added Sucessfully');
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

        $purchase_edit = new Purchase_edit_history;
        //customer edit history track
        $purchase_edit->row_id = (int)$request->input('id');
        $purchase_edit->date =  $purchase->date;
        $purchase_edit->trn =  $purchase->trn;
        $purchase_edit->lpo_ref_num =  $purchase->lpo_ref_num;
        $purchase_edit->company_name =  $purchase->company_name;
        $purchase_edit->company_address =  $purchase->company_address; 
        $purchase_edit->company_id =  $purchase->company_id;
        $purchase_edit->meterial_data_id =  $purchase->meterial_data_id; 
        $purchase_edit->type =  $purchase->type;
        $purchase_edit->made_in =  $purchase->made_in; 
        $purchase_edit->vechicle_num =  $purchase->vechicle_num;
        $purchase_edit->stock_description =  $purchase->stock_description; $purchase_edit->product_name =  $purchase->product_name;
        $purchase_edit->brand =  $purchase->brand; 
        $purchase_edit->size =  $purchase->size;
        $purchase_edit->quantity =  $purchase->quantity;
         $purchase_edit->unit =  $purchase->unit;
        $purchase_edit->unit_price =  $purchase->unit_price;
        $purchase_edit->delivery_date =  $purchase->delivery_date;
        $purchase_edit->terms =  $purchase->terms;
        $purchase_edit->cerdit_days =  $purchase->cerdit_days;
        $purchase_edit->total_amount =  $purchase->total_amount;
        $purchase_edit->po_number =  $purchase->po_number;
        $purchase_edit->delivery_proof_copy =  $purchase->delivery_proof_copy;
        $purchase_edit->delivery_notes =  $purchase->delivery_notes;
        $purchase_edit->for_stock =  $purchase->for_stock;
        $purchase_edit->supplier_name =  $purchase->supplier_name;
        $purchase_edit->is_vat =  $purchase->is_vat;
        $purchase_edit->supplier_status =  $purchase->supplier_status;
        $purchase_edit->supplier_id =  $purchase->supplier_id;

        
        $purchase_edit->save();
        if($request->input('supplier_id') != ''){
            $purchase->supplier_id = $request->input('supplier_id');
        }
        if($request->input('supplier_name') != ''){
            $purchase->supplier_name = $request->input('supplier_name');
        }

        if($request->input('supplier_status') != ''){
            $purchase->supplier_status = $request->input('supplier_status');
        }

        if($request->input('is_vat') != ''){
            $purchase->is_vat = $request->input('is_vat');
        }
        if($request->input('company_id') != ''){
            $purchase->company_id = $request->input('company_id');

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

        // $this->add_aprovals('trade_licenses');

        $purchase->status_admin = 'pending';
        $purchase->status_account = 'pending';

        if($request->input('status_message') != ''){

            $purchase->status_message = $request->input('status_message');

        }

        $purchase->user_id = Auth::id();
        $purchase->action = 'edit';

        $purchase->save();

        return \Redirect::route('user.purchase')->with('success', 'Data Edited Sucessfully');

    }

    public function update_vehicle_purchase(Request $request){
        $id =  (int)$request->input('id');
        $purchase = Purchase_vehicle::where('id' , $id)->first();
        

        

        $purchase_edit = new Purchase_vehicle_edit_history;
        //customer edit history track
        $purchase_edit->row_id = (int)$request->input('id');
        $purchase_edit->date =  $purchase->date;
        $purchase_edit->trn =  $purchase->trn;
        $purchase_edit->lpo_ref_num =  $purchase->lpo_ref_num;
        $purchase_edit->company_name =  $purchase->company_name;
        $purchase_edit->company_id =  $purchase->company_id;
        $purchase_edit->company_address =  $purchase->company_address; 
        $purchase_edit->company_id =  $purchase->company_id;
        $purchase_edit->meterial_data_id =  'vehicle'; 
        $purchase_edit->make =  $purchase->make;
        $purchase_edit->model =  $purchase->model; 
        $purchase_edit->color =  $purchase->color;
        $purchase_edit->engine_number =  $purchase->engine_number;
        $purchase_edit->chassis_no =  $purchase->chassis_no;
        $purchase_edit->vechicle_type =  $purchase->vechicle_type; 
        $purchase_edit->trailer_type =  $purchase->trailer_type;
        $purchase_edit->size =  $purchase->size;
         $purchase_edit->axle =  $purchase->axle;
        $purchase_edit->delivery_date =  $purchase->delivery_date;
        $purchase_edit->total_amount =  $purchase->total_amount;
        $purchase_edit->po_number =  $purchase->po_number;
        $purchase_edit->supplier_name =  $purchase->supplier_name;
        $purchase_edit->is_vat =  $purchase->is_vat;
        $purchase_edit->supplier_status =  $purchase->supplier_status;
        $purchase_edit->supplier_id =  $purchase->supplier_id;



        $purchase_edit->save();

        if($request->input('supplier_id') != ''){
            $purchase->supplier_id = $request->input('supplier_id');
        }
        if($request->input('supplier_name') != ''){
            $purchase->supplier_name = $request->input('supplier_name');
        }

        if($request->input('supplier_status') != ''){
            $purchase->supplier_status = $request->input('supplier_status');
        }

        if($request->input('is_vat') != ''){
            $purchase->is_vat = $request->input('is_vat');
        }
        if($request->input('company_id') != ''){
            $purchase->company_id = $request->input('company_id');

        }
        if($request->input('date') != ''){
            $purchase->date = $request->input('date');
        }
        if($request->input('supplier_id') != ''){
            $purchase->supplier_id = $request->input('supplier_id');
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
        if($request->input('vechicle_type') != ''){
            $purchase->vechicle_type = $request->input('vechicle_type');
        }
        if($request->input('make') != ''){
            $purchase->make = $request->input('make');

        }
        if($request->input('model') != ''){
            $purchase->model = $request->input('model');
        }
        if($request->input('color') != ''){
            $purchase->color = $request->input('color');

        }
        if($request->input('engine_number') != ''){
            $purchase->engine_number = $request->input('engine_number');
        }

        if($request->input('trailer_type') != ''){
            $purchase->trailer_type = $request->input('trailer_type');
        }

        if($request->input('size') != ''){
            $purchase->size = $request->input('size');
        }

        if($request->input('axle') != ''){
            $purchase->axle = $request->input('axle');
        }

        if($request->input('chassis_no') != ''){
            $purchase->chassis_no = $request->input('chassis_no');
        }

        if($request->input('vehicle_suspension') != ''){
            $purchase->vehicle_suspension = $request->input('vehicle_suspension');
        }

        if($request->input('delivery_date') != ''){
            $purchase->delivery_date = $request->input('delivery_date');

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
        
        // dd($purchase->action );

        if($purchase->action == null || $purchase->status_admin == 'approved' || $purchase->action == 'nill'){
            $purchase->action = 'Admin Edit';
        }
        $purchase->user_id = Auth::id();
        $purchase->status_admin = 'pending';
        // $purchase->status_account = 'pending';

        $purchase->save();


        return \Redirect::route('user.purchase')->with('success', 'Data Edited Sucessfully');

    }
    
    public function delete_purchase(Request $request){
        $id =  (int)$request->input('id');
        $trade_license = Purchase::where('id' , $id)->first();

        $trade_license->status_admin = 'pending';
        $trade_license->status_account = 'pending';

        $trade_license->status_message = $request->input('status_message');
        $trade_license->user_id = Auth::id();
        $trade_license->action = 'delete';


        if( $trade_license->save()){
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    public function delete_vehicle_purchase(Request $request){
        $id =  (int)$request->input('id');
        $trade_license = Purchase_vehicle::where('id' , $id)->first();

        $trade_license->status_admin = 'pending';
        $trade_license->status_account = 'pending';

        $trade_license->status_message = $request->input('status_message');
        $trade_license->user_id = Auth::id();
        $trade_license->action = 'delete';


        if( $trade_license->save()){
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);

        }
    }

    

    public function get_purchase_vehicle(){
        $id = $_GET['id'];
        $purchase_vehicle = Purchase_vehicle::find((int)$id);
        return response()->json($purchase_vehicle);
    }

}

