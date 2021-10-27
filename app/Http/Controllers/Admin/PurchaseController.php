<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\User;
use App\Models\Roles;
use App\Models\Trade_license;
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
        $data['trade_licenses']= DB::table('trade_licenses')->get();
        $data['company_names']= DB::table('company_names')->get();

        $data['page_title'] = "Purchase";
        $data['view'] = 'admin.purchase.purchase';
        return view('layout', ["data"=>$data]);
    }

    public function trash_purchase(){
        $data['modules']= DB::table('modules')->get();
        $data['trade_licenses']= DB::table('trade_licenses')->get();
        $data['company_names']= DB::table('company_names')->get();
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

        $data['page_title'] = "Add Purchase";
        $data['view'] = 'admin.purchase.add_purchase';
        return view('layout', ["data"=>$data]);
    }

    public function view_purchase(Request $request){
        $data['trade_license'] = Trade_license::find($request->input('id'));

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
        $data['trade_license'] = Trade_license::find($request->input('id'));

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

        $trade_license->status = 'approved';
 
        $trade_license->user_id = 0;
        // dd('working');

        $this->history_table('trade_license_histories', 'add' , 0);

        if($trade_license->save()){
           
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
             $this->history_table('trade_license_histories', $trade_license->action , $user_id);
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

        $this->history_table('trade_license_histories', $trade_license->action , $user_id);

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

            $this->history_table('trade_license_histories', $trade_license->action , $user_id);

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
        $this->history_table('trade_license_histories', $trade_license->action , $user_id);
 
        $trade_license->action = 'deleted';
        $trade_license->save();
           
            return response()->json(['status'=>'1']);
        
    }
}