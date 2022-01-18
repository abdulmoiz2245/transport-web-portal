<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\User;
use App\Models\Roles;

use App\Models\Purchase_mertial_data;

use App\Models\Permissions;
use App\Models\Login_password;

use App\Models\Modules;

use App\Models\Approvals;




use Illuminate\Support\Facades\File;
use App\Http\Controllers\Redirect;
use App\Models\Purchase;
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
        $data['purchases']= DB::table('purchases')->get();
        $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "PURCHASE";
        $data['view'] = 'purchase.purchase';
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

    public function edit_purchase(Request $request){
        $data['purchase'] = Purchase::find($request->input('id'));

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

        // $this->add_aprovals('trade_licenses');

        $purchase->status_admin = 'pending';
        $purchase->status_account = 'pending';

        $purchase->action = 'add';
        if($request->input('status_message') != ''){
            $purchase->status_message = $request->input('status_message');
        }

        $purchase->user_id = Auth::id();
        $purchase->save();

       return \Redirect::route('user.purchase')->with('success', 'Data Added Sucessfully');

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

}

