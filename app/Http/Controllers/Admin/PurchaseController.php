<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\User;
use App\Models\Roles;
use App\Models\Purchase;
use App\Models\Purchase_mertial_data;
use App\Models\Inventory_Tyre;
use App\Models\Inventory_spare_parts;
// use App\Models\Inventory_spare_parts_entery;
// use App\Models\Inventory_tools_entry;
use App\Models\Inventory_tools;
use App\Models\Fuel_transfer;
use App\Models\Inventory_uncategorized;

use App\Models\Supplier_info;
use App\Models\Purchase_edit_history;



use App\Models\Trade_license_history;

use App\Models\Permissions;
use App\Models\Login_password;

use App\Models\Modules;

use App\Models\Approvals;



use Illuminate\Support\Facades\File;
use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
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

        $data['purchase_edit'] = Purchase_edit_history::where('row_id' , $request->input('id'))->orderBy('created_at','desc')->first();


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
        
        $check = 0;
         if($request->input('supplier_id') != ''){
            $purchase->supplier_id = $request->input('supplier_id');
        }

        foreach(Purchase_mertial_data::all() as $purchase_material){
            if($purchase_material->id == $request->input('meterial_data_id_1')){
                $check = 1;
            }
        }
        
        // dd($request->input('meterial_data_id_1'));

        if($check != 1){
            $meterial = new Purchase_mertial_data;
            $meterial->name = $request->input('meterial_data_id_1');
            $meterial->save();

            $purchase->meterial_data_id = $meterial->id;

        }else{
            $purchase->meterial_data_id = $request->input('meterial_data_id_1');

        }

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
        // if(!$check){
        //     $purchase->meterial_data_id = $meterial->id;
        // }else{
        //     if($request->input('meterial_data_id') != ''){
        //         $purchase->meterial_data_id = $request->input('meterial_data_id');
        //     }
        // }
        
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
        // dd($request->input('total_amount'));
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
        

        $check = 0;
        foreach(Purchase_mertial_data::all() as $purchase_material){
        //     // echo $purchase_material->id;
        //     // echo '<br>';
        //     var_dump(  $request->input('meterial_data_id'));
        // die();
        
            if($purchase_material->id == $purchase->meterial_data_id){
                
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
        $purchase_edit->company_id =  $purchase->company_id;
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
        // if($check == 0){
        //     $purchase->meterial_data_id = $meterial->id;
        // }else{
        //     if($request->input('meterial_data_id') != ''){
        //         $purchase->meterial_data_id = $request->input('meterial_data_id');
        //     }
        // }
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
        $purchase->status_account = 'pending';

        $purchase->save();

        

        if($purchase->status_admin == 'approved' || $purchase->user_id == 0 ){
            $this->history_table('purchase_histories', $purchase->action , $user_id,  $purchase->id, "purchase.view_purchase");
        }

        if($purchase->status_admin == 'approved' && $purchase->status_account== 'approved'){
            $tyre_check =0;
            $spare_part_check  = 0;
            $tools_check  = 0;
            $not_fuel= 0;
            $fuel= 0;


            foreach(Purchase_mertial_data::all() as $material){
                if($material->id == $purchase->meterial_data_id  ){
                    var_dump( $material->name);
                    echo '<br>';
                    if($material->name == 'tyres' || $material->name == 'tyre' || $material->name == 'Tyre' || $material->name == 'Tyres'){
                        $tyre_check=  1;
                        break;
                    }

                     if($material->name == 'sparepart' || $material->name == 'spareparts' || $material->name == 'Sparepart' || $material->name == 'Spareparts'){
                        $spare_part_check=  1;
                        break;
                    }

                    else if($material->name == 'tool' || $material->name == 'tools' || $material->name == 'Tool' || $material->name == 'Tools'){
                        $tools_check=  1;
                        break;
                    }else if($material->name == 'fuel' || $material->name == 'fuels' || $material->name == 'Fuel' || $material->name == 'Fuels'){
                        // dd('fuel_callwd');
                        $fuel=  1;
                        $not_fuel=  1;
                       $total_remain =  Fuel_transfer::latest('date')->first()->total_fuel_remaining + $purchase->quantity;
                       $fuel_t =  Fuel_transfer::latest('date')->first();
                       $fuel_t->total_fuel_remaining = $total_remain;
                       $fuel_t->save();
                        break;
                    }
                    
                }
            }

            if($tyre_check == 1){
                $data = [ ];
                for($i=1 ; $i<=$purchase->quantity ;$i++ ){
                    array_push($data , ['row_status'=>'active' , 'status'=>'new']);
                }
                Inventory_Tyre::insert($data);
                $this->history_table('inventory__tyre_histories', $purchase->quanntity.' Tyres Added In  Storage (Po no: '.$purchase->po_number.')' ,   0 , -1 , 'inventory.tyres.new_used_tyres');
                
            }else if($spare_part_check == 1){

                $Inventory_spare_parts = new Inventory_spare_parts;
                $Inventory_spare_parts->part_description = $purchase->product_name;
                $Inventory_spare_parts->quantity = $purchase->quantity;
                $Inventory_spare_parts->save();

                $this->history_table('inventory_spare_parts_histories',$purchase->quanntity. ' Spare Part Added In  Storage (Po no: '.$purchase->po_number.')' ,   0 , $Inventory_spare_parts->id , 'inventory.spare_parts.edit_spare_parts_in_storage');
            }else if($tools_check == 1){
                $Inventory_tools = new Inventory_tools;
                $Inventory_tools->tools_description = $purchase->product_name;
                $Inventory_tools->quantity = $purchase->quantity;
                $Inventory_tools->brand = $purchase->brand;
                $Inventory_tools->unit = $purchase->unit;
                $Inventory_tools->po_number = $purchase->po_number;
                $Inventory_tools->created_at = date("Y-m-d H:i:s");
                $Inventory_tools->updated_at = date("Y-m-d H:i:s");

                $Inventory_tools->save();

                $this->history_table('inventory_tools_histories', $purchase->quanntity.' Tools Added In Storage (Po no: '.$purchase->po_number.')' ,   0 , $Inventory_tools->id , 'inventory.tools.view_tools_in_storage');
            }else if(  $fuel != 1 ) {
                // dd('fuel_not_callwd');
                $Inventory_uncategorized = new Inventory_uncategorized;
                $Inventory_uncategorized->product_name = $purchase->product_name;
                $Inventory_uncategorized->quantity = $purchase->quantity;
                $Inventory_uncategorized->brand = $purchase->brand;
                $Inventory_uncategorized->unit = $purchase->unit;
                $Inventory_uncategorized->made_in = $purchase->made_in;
                $Inventory_uncategorized->size = $purchase->size;

                $Inventory_uncategorized->po_number = $purchase->po_number;
                // $Inventory_uncategorized->date = date("Y-m-d");
                // $Inventory_uncategorized->created_at = date("Y-m-d H:i:s");
                // $Inventory_uncategorized->updated_at = date("Y-m-d H:i:s");

                $Inventory_uncategorized->save();

                $this->history_table('inventory_uncategorized_histories', 'Uncategorized Data Added In Storage (Po no: '.$purchase->po_number.')' ,   0 , $Inventory_uncategorized->id , 'inventory.uncategorized.view_uncategorized');
            }
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
}