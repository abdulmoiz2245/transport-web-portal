<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;

use App\Models\Roles;
use App\Models\Permissions;
use App\Models\Modules;

use App\Models\Company_name;
use App\Models\Trade_license;
use App\Models\Customer_info;
use App\Models\Supplier_info;
use App\Models\Sub_contractor_info;



use App\Models\Login_password;
use App\Models\Office_Land_contract;

use App\Models\Civil_defense_documents;
use App\Models\Muncipality_documents;
use App\Models\Trained_individual;

use App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    
    
    public function __construct() {
        $this->middleware('auth:user');
    }
    
    public function dashboard(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();

        //Hr/pro 
        $data['trade_license']=  Trade_license::count();
        $data['land_contract']=  Office_Land_contract::where('type', '=', 'land')->get();
        $data['office_contract']=  Office_Land_contract::where('type', '=', 'office')->get();
        $data['non_mobile_civil']=  Civil_defense_documents::where('type', '=', 'non_mobile')->get();
        $data['mobile_civil']=  Civil_defense_documents::where('type', '=', 'mobile')->get();
        $data['non_mobile_defence']=  Muncipality_documents::where('type', '=', 'non_mobile')->get();
        $data['mobile_defence']=  Muncipality_documents::where('type', '=', 'mobile')->get();
        $data['mobile_individules']=  Trained_individual::where('type', '=', 'non_mobile')->get();
        $data['non_mobile_individules']=  Trained_individual::where('type', '=', 'mobile')->get();

        //Customer
        $data['customer']=  Customer_info::count();
        //supplier
        $data['supplier']=  Supplier_info::count();
        //sub contractor
        $data['sub_contractor']=  Sub_contractor_info::count();


        

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
        // /dd($data['permission']->module_id);
        $data['page_title'] = "Dashboard";
        $data['view'] = 'users.dashboard';
        return view('users.layout', ["data"=>$data]);
    }

    

    public function purchaser(){

        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 4)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
          
        
        if($data['permissions']->status != 1 ){
            abort(403);
        }
    
       
        $data['page_title'] = "Purchaser";
        $data['view'] = 'purchaser.purchaser';
        return view('users.layout', ["data"=>$data]);
    }


    public function employee(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 6)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
          
        
        if($data['permissions']->status != 1 ){
            abort(403);
        }

        $data['page_title'] = "Employee";
        $data['view'] = 'employee.employee';
        return view('users.layout', ["data"=>$data]);
    }

    public function accounts(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 7)->first();

        $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
    
         
       
       if($data['permissions']->status != 1 ){
           abort(403);
       }

        $data['page_title'] = "Accounts";
        $data['view'] = 'accounts.accounts';
        return view('users.layout', ["data"=>$data]);
    }

    public function booking(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 12)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
          
        
        if($data['permissions']->status != 1 ){
            abort(403);
        }

        $data['page_title'] = "Booking";
        $data['view'] = 'booking.booking';
        return view('users.layout', ["data"=>$data]);
    }

    public function customer(){
        $data['modules']= DB::table('modules')->get();
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
    public function inventory(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 5)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
          
        
        if($data['permissions']->status != 1 ){
            abort(403);
        }
        $data['page_title'] = "Inventory";
        $data['view'] = 'inventory.inventory';
        return view('users.layout', ["data"=>$data]);
    }

    public function petty_cash(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 8)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
          
        
        if($data['permissions']->status != 1 ){
            abort(403);
        }

        $data['page_title'] = "Petty Cash";
        $data['view'] = 'petty_cash.petty_cash';
        return view('users.layout', ["data"=>$data]);
    }

    public function reports(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 13)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
          
        
        if($data['permissions']->status != 1 ){
            abort(403);
        }

        $data['page_title'] = "Reports";
        $data['view'] = 'reports.reports';
        return view('users.layout', ["data"=>$data]);
    }

    public function sub_contractor(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 11)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
          
        
        if($data['permissions']->status != 1 ){
            abort(403);
        }

        $data['page_title'] = "Sub Contractor";
        $data['view'] = 'sub_contractor.sub_contractor';
        return view('users.layout', ["data"=>$data]);
    }

    public function supplier(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 3)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
          
        
        if($data['permissions']->status != 1 ){
            abort(403);
        }

        $data['page_title'] = "Supplier";
        $data['view'] = 'supplier.supplier';
        return view('users.layout', ["data"=>$data]);
    }

    public function vehicles(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 9)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
          
        
        if($data['permissions']->status != 1 ){
            abort(403);
        }

        $data['page_title'] = "Vehicles";
        $data['view'] = 'vehicles.vehicles';
        return view('users.layout', ["data"=>$data]);
    }

    public function workshop(){
        $data['modules']= DB::table('modules')->get();
        $user = Auth::user();
        $data['permissions'] =  Permissions::where('role_id', '=', $user->role_id)->where('module_id' ,'=' , 10)->first();

         $data['permission'] =  Permissions::where('role_id', '=', $user->role_id)->get();
     
          
        
        if($data['permissions']->status != 1 ){
            abort(403);
        }
        $data['page_title'] = "Workshop";
        $data['view'] = 'workshop.workshop';
        return view('users.layout', ["data"=>$data]);
    }

   
}
