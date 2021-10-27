<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;

use App\Models\Roles;
use App\Models\Permissions;
use App\Models\Modules;


use App\Models\Company_name;
use App\Models\Trade_license;

use App\Models\Login_password;
use App\Models\Office_Land_contract;

use App\Models\Civil_defense_documents;
use App\Models\Muncipality_documents;
use App\Models\Trained_individual;
use App\Models\Customer_info;
use App\Models\Supplier_info;
use App\Models\Sub_contractor_info;


use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    
    // default constructor
    public function __construct() {
        $this->middleware('auth:admin');
    }
    
    public function dashboard(){
        $data['modules']= DB::table('modules')->get();
        $data['page_title'] = "Dashboard";
        $data['view'] = 'admin.dashboard';

        $data['users'] = User::all();
        $data['roles'] = Roles::all();

        $total_user = 0;
        $active_user = 0;
        $inactive_user = 0;
        $online_user = 0;
        foreach($data['users'] as $user){
            if($user->status == 1){
                $active_user++;
            }elseif($user->status == 0){
                $inactive_user ++;
            }

            if($user->isOnline()){
                $online_user++;
            }
        }
        if(isset($data['users'])){
            $data['total_user'] = count($data['users']);

        }
        if(isset($data['roles'])){
            $data['total_roles'] = count($data['roles']);

        }
        $data['active_user']  = $active_user ;
        $data['inactive_user'] = $inactive_user ;
        $data['online_user'] = $online_user ;

        //Hr-pro
        $data['trade_license']=  Trade_license::where('row_status', '!=', 'deleted')->count();
        $data['land_contract']=  Office_Land_contract::where('type', '=', 'land')->where('row_status', '!=', 'deleted')->get();

        // $data['land_contract']= DB::table('office__land_contracts')->where('type', '=', 'land')->where('row_status', '!=', 'deleted')->get();
        // dd($data['trade_license']);
        $data['office_contract']=  Office_Land_contract::where('type', '=', 'office')->where('row_status', '!=', 'deleted')->get();
        $data['non_mobile_civil']=  Civil_defense_documents::where('type', '=', 'non_mobile')->where('row_status', '!=', 'deleted')->get();
        $data['mobile_civil']=  Civil_defense_documents::where('type', '=', 'mobile')->where('row_status', '!=', 'deleted')->get();
        $data['non_mobile_defence']=  Muncipality_documents::where('type', '=', 'non_mobile')->where('row_status', '!=', 'deleted')->get();
        $data['mobile_defence']=  Muncipality_documents::where('type', '=', 'mobile')->where('row_status', '!=', 'deleted')->get();
        $data['mobile_individules']=  Trained_individual::where('type', '=', 'mobile')->where('row_status', '!=', 'deleted')->get();
        $data['non_mobile_individules']=  Trained_individual::where('type', '=', 'non_mobile')->where('row_status', '!=', 'deleted')->get();

        $data['trade_license_pending']=  Trade_license::where('status' , '=', 'pending')->where('row_status', '!=', 'deleted')->count();
        $data['land_contract_pending']=  Office_Land_contract::where('type', '=', 'land')->where('row_status', '!=', 'deleted')->where('status' , '=', 'pending')->count();
        $data['office_contract_pending']=  Office_Land_contract::where('type', '=', 'office')->where('row_status', '!=', 'deleted')->where('status' , '=', 'pending')->count();
        $data['non_mobile_civil_pending']=  Civil_defense_documents::where('type', '=', 'non_mobile')->where('status' , '=', 'pending')->where('row_status', '!=', 'deleted')->count();
        $data['mobile_civil_pending']=  Civil_defense_documents::where('type', '=', 'mobile')->where('status' , '=', 'pending')->where('row_status', '!=', 'deleted')->count();
        $data['non_mobile_defence_pending']=  Muncipality_documents::where('type', '=', 'non_mobile')->where('status' , '=', 'pending')->where('row_status', '!=', 'deleted')->count();
        $data['mobile_defence_pending']=  Muncipality_documents::where('type', '=', 'mobile')->where('status' , '=', 'pending')->where('row_status', '!=', 'deleted')->count();
        $data['mobile_individules_pending']=  Trained_individual::where('type', '=', 'non_mobile')->where('status' , '=', 'pending')->where('row_status', '!=', 'deleted')->count();
        $data['non_mobile_individules_pending']=  Trained_individual::where('type', '=', 'non_mobile')->where('status' , '=', 'pending')->where('row_status', '!=', 'deleted')->count();

        $data['total_pending'] = $data['trade_license_pending'] + $data['land_contract_pending'] + $data['office_contract_pending'] +   $data['non_mobile_civil_pending'] + $data['mobile_civil_pending'] + $data['non_mobile_defence_pending'] + $data['mobile_defence_pending'] + $data['mobile_individules_pending'] ;

       


        $data['trade_license_rejected']=  Trade_license::where('status' , '=', 'rejected')->where('row_status', '!=', 'deleted')->count();
        $data['land_contract_rejected']=  Office_Land_contract::where('type', '=', 'land')->where('status' , '=', 'rejected')->where('row_status', '!=', 'deleted')->count();
        $data['office_contract_rejected']=  Office_Land_contract::where('type', '=', 'office')->where('status' , '=', 'rejected')->where('row_status', '!=', 'deleted')->count();
        $data['non_mobile_civil_rejected']=  Civil_defense_documents::where('type', '=', 'non_mobile')->where('status' , '=', 'rejected')->where('row_status', '!=', 'deleted')->count();
        $data['mobile_civil_rejected']=  Civil_defense_documents::where('type', '=', 'mobile')->where('status' , '=', 'rejected')->where('row_status', '!=', 'deleted')->count();
        $data['non_mobile_defence_rejected']=  Muncipality_documents::where('type', '=', 'non_mobile')->where('status' , '=', 'rejected')->where('row_status', '!=', 'deleted')->count();
        $data['mobile_defence_rejected']=  Muncipality_documents::where('type', '=', 'mobile')->where('status' , '=', 'rejected')->where('row_status', '!=', 'deleted')->count();
        $data['mobile_individules_rejected']=  Trained_individual::where('type', '=', 'mobile')->where('status' , '=', 'rejected')->where('row_status', '!=', 'deleted')->count();
        $data['non_mobile_individules_rejected']=  Trained_individual::where('type', '=', 'non_mobile')->where('status' , '=', 'rejected')->where('row_status', '!=', 'deleted')->count();

        $data['total_rejected'] = $data['trade_license_rejected'] + $data['land_contract_rejected'] + $data['office_contract_rejected'] +   $data['non_mobile_civil_rejected'] + $data['mobile_civil_rejected'] + $data['non_mobile_defence_rejected'] + $data['mobile_defence_rejected'] + $data['mobile_individules_rejected'] ;


        //Customer
        $data['total_rejected_customer'] = Customer_info::where('status' , '=', 'rejected')->where('row_status', '!=', 'deleted')->count();
        $data['total_pending_customer'] = Customer_info::where('status' , '=', 'pending')->where('row_status', '!=', 'deleted')->count();
        $data['total_customer'] = Customer_info::where('row_status', '!=', 'deleted')->count();

        //suplllier
        $data['total_rejected_supplier'] = Supplier_info::where('status' , '=', 'rejected')->where('row_status', '!=', 'deleted')->where('row_status', '!=', 'deleted')->count();
        $data['total_pending_supplier'] = Supplier_info::where('status' , '=', 'pending')->where('row_status', '!=', 'deleted')->where('row_status', '!=', 'deleted')->count();
        $data['total_supplier'] = Supplier_info::where('row_status', '!=', 'deleted')->count();

        //sub_contractor
        $data['total_rejected_sub_contractor'] = Sub_contractor_info::where('status' , '=', 'rejected')->where('row_status', '!=', 'deleted')->count();
        $data['total_pending_sub_contractor'] = Sub_contractor_info::where('status' , '=', 'pending')->where('row_status', '!=', 'deleted')->count();
        $data['total_sub_contractor'] = Sub_contractor_info::where('row_status', '!=', 'deleted')->count();

        return view('layout', ["data"=>$data]);
    }

    public function admin_profile(){
        $data['modules']= DB::table('modules')->get();

        $data['page_title'] = "Profile";
        $data['view'] = 'admin.setting.profile';
        return view('layout', ["data"=>$data]);
    }

    public function update_profile(Request $request){

        $id = Auth::user()->id;
        $admin = Admin::find($id);

        
        //Password Validation
        if($request->input('old_password') && $request->input('old_password') && $request->input('old_password') ){

            if (password_verify($request->input('old_password'), $admin->password)){
                if($request->input('new_password') === $request->input('repeat_new_password')){

                    $admin->password =  Hash::make($request->input('new_password'));
                    
                    $request->session()->flash('success', 'Password was updated successful!');

                }else{
                    return redirect('/admin/setting/profile')->with('error', 'New Password Not Match');
                }
            }else{
                return redirect('/admin/setting/profile')->with('error', 'Old Password Not Match');
            }
        }



        if ($request->hasFile('image')) {

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        
            $name = time().'_'.$request->image->getClientOriginalName();
            $file = $request->file('image');
            if($file->move('main_admin/profile' , $name)){
                $admin->profile_pic = time().'_'.$request->image->getClientOriginalName();

            }
            //$filePath = $request->file('image')->storeAs('admin', $name, 'public');

        }


        $admin->username = $request->input('username');
        $admin->f_name =  $request->input('first_name');
        $admin->l_name =  $request->input('last_name');
        $admin->email =  $request->input('email');
        $admin->save();

        return \Redirect::route('admin.setting.profile');
    }

    //Setting
    public function roles(){
        $data['modules']= DB::table('modules')->get();

        $data['roles'] = Roles::all();
        $data['page_title'] = "Roles And Permission";
        $data['view'] = 'admin.setting.roles.roles';
        return view('layout', ["data"=>$data]);
    }

    public function add_role(){
        $data['modules']= DB::table('modules')->get();
        
        $data['page_title'] = "Add Roles";
        $data['view'] = 'admin.setting.roles.add_roles';
        return view('layout', ["data"=>$data]);

        

    }

    public function edit_role(Request $request){
        $data['modules']= DB::table('modules')->get();
        //dd($request->input('id'));
        $id =  (int)$request->input('id');
        //dd($id);
        $data['role'] = Roles::where('id' , $id)->first();
        //dd($data['role']);
        $data['page_title'] = "Edit Roles";
        $data['view'] = 'admin.setting.roles.edit_roles';
        return view('layout', ["data"=>$data]);
    }

    public function update_role(Request $request){
        $id =  (int)$request->input('id');
        $roles = Roles::where('id' , $id)->first();
        $roles->name = $request->input('name');
        $roles->status = $request->input('status');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        if(  $roles->save()){
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return \Redirect::route('admin.setting.role')->with('success', 'Role Updated Sucessfully');

        }
    }

    public function delete_role(Request $request){
        $id =  (int)$request->input('id');
        $roles = Roles::find($id);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        if($roles->delete()){
            $users = User::where('role_id', '=',  $id);
            $permission  = Permissions::where('role_id', '=',  $id);
            if($permission->delete()){
              
                    // $users->role_id = ' ';
                    // $users->status = 0;
                    // $users->save();


               
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                return response()->json(['status'=>'1']);
            }
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return response()->json(['status'=>'0']);
            // return \Redirect::route('admin.setting.role')->with('success', 'Role Deleted Sucessfully');
        }else{
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return response()->json(['status'=>'0']);

            // return \Redirect::route('admin.setting.role')->with('error', 'Role not Deleted Sucessfully');
        }
    }

    public function save_role(Request $request){
        $roles = new Roles;
        $roles->name = $request->input('name');
        $roles->status = $request->input('status');

        
        if(  $roles->save()){

            DB::table('permissions')->insert([
                ['module_id' => '1',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],

                ['module_id' => '2',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '3',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '4',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '5',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '6',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '7',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '8',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '9',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '10',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '11',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '12',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '13',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],

                ['module_id' => '27',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '28',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '29',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '30',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '31',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '32',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '33',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '34',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],

                ['module_id' => '35',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0],
                 
                ['module_id' => '36',
                'role_id' =>  $roles->id ,
                'operation' => 'view' ,
                'status' => 0]
                 
                
            ]);


            return \Redirect::route('admin.setting.role')->with('success', 'Role Added Sucessfully');

        }
      
    }

    public function permission(Request $request){
        $data['modules']= DB::table('modules')->get();
        $roll_id = $request->input('id');
        $data['permission'] =  Permissions::where('role_id', '=',  $roll_id)->get();
        $data['modules1'] = Modules::all();
        //  foreach($data['modules1'] as $sub_module){
        //      //var_dump ($sub_module->name);
        //  }
         //die();
         
        
        $data['role_name'] = Roles::find($roll_id);

        $data['page_title'] = "Permissions";
        $data['view'] = 'admin.setting.permissions.permission';
        return view('layout', ["data"=>$data]);
    }

    public function permission_update(Request $request){
        $roll_id = $request->input('role_id');
        $module_id = $request->input('module_id');
        $operation = $request->input('operation');
        $status = $request->input('status');

                              
        $permission = Permissions::where('role_id', '=',  $roll_id)->where('module_id', '=',  $module_id)->where('operation', '=',  $operation)->first();
                    //  var_dump ($permission->id);
                    //  die();

        $permission->status = $status;
        if($permission->save()){
            return response()->json(['status'=>'1']);
        }else{
            return response()->json(['status'=>'0']);
        }

    }


    //users
    public function list_users(){
        $data['modules']= DB::table('modules')->get();
        $data['roles'] = Roles::all();
        $data['users'] = User::all();

        $data['page_title'] = "Emails";
        $data['view'] = 'admin.users.list_user';
        return view('layout', ["data"=>$data]);
    }
    public function add_user(){
        $data['modules']= DB::table('modules')->get();
        $data['roles'] = Roles::all();
        $data['page_title'] = "Generate Email";
        $data['view'] = 'admin.users.add_user';
        return view('layout', ["data"=>$data]);
    }

    public function edit_user(Request $request){
        $data['modules']= DB::table('modules')->get();
        //dd($request->input('id'));
        $id =  (int)$request->input('id');
        $data['roles'] = Roles::all();
        $data['user'] = User::where('id' , $id)->first();
        
        
        $data['page_title'] = "Edit Emails";
        $data['view'] = 'admin.users.edit_user';
        return view('layout', ["data"=>$data]);
    }

    public function update_user(Request $request){
        $id =  (int)$request->input('id');
        $user = User::where('id' , $id)->first();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role');
        $user->status = $request->input('status');


        if(!($request->input('password') == '')){
            if($request->input('password') == $request->input('repeate_password')){
                $user->password = Hash::make($request->input('password'));

            }else{
                return \Redirect::route('admin.add_user')->with('error', 'Password not match');
                
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        if(  $user->save()){
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return \Redirect::route('admin.users')->with('success', 'Email Updated Sucessfully');

        }
    }

    public function save_user(Request $request){
        $user = new User;
        $user->username = $request->input('username');
        $user->role_id = $request->input('role');
        $user->email = $request->input('email');
        $user->status = $request->input('status');

        $user->password = Hash::make($request->input('password'));
        if($user->save()){
            return \Redirect::route('admin.users')->with('success', 'Email Generated Sucessfully');
        }

    }

    public function delete_user(Request $request){
        $id =  (int)$request->input('id');
        $roles = User::find($id);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        if($roles->delete()){
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

             return response()->json(['status'=>'1']);
        }else{
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            return response()->json(['status'=>'0']);
        }
    }
}
