<?php

namespace App\Http\Controllers\Admin;
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

class PurchaseController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth:admin');
    }

    // public function purchase(){

    //     $data['modules']= DB::table('modules')->get();
    //     //dd($data['modules']);
        
    //     $data['page_title'] = "Purchase";
    //     $data['view'] = 'admin.purchase.purchase';
    //     return view('layout', ["data"=>$data]);
    // }

    /////////////////////////////////
    ///////// Purchase /////////
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
        // $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Purchase";
        $data['view'] = 'admin.purchase.purchase';
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
     

        $data['trade_licenses_history']= DB::table('trade_license_histories')->get();
        $data['table_name']= 'trade_license_histories';

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

        // $this->history_table('trade_license_histories', 'add' , 0);

        if($purchase->save()){
           
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

        // $this->history_table('trade_license_histories', $trade_license->action , $user_id);

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

            // $this->history_table('trade_license_histories', $trade_license->action , $user_id);

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
        // $this->history_table('trade_license_histories', $trade_license->action , $user_id);
 
        $trade_license->action = 'deleted';
        $trade_license->save();
           
            return response()->json(['status'=>'1']);
        
    }
}