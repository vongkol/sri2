<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Validator;
use Session;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            app()->setLocale(Session::get("lang"));
             return $next($request);
         });
    }
    // function to load profile view
    public  function index()
    {
        // if(!Right::check('User Account', 'l'))
        // {
        //     return view('403.setting');
        // }
        
        $data['users'] = DB::table('users')
            ->join("roles", "users.role_id","=", "roles.id")
            ->leftJoin('ngos', "users.ngo_id", "ngos.id")
            ->where('users.active',1)
            ->select("users.*", "roles.name as role_name", "ngos.name as ngo_name")
            ->paginate(12);
        if(Auth::user()->ngo_id>0)
        {
            $data['users'] = DB::table('users')
            ->join("roles", "users.role_id","=", "roles.id")
            ->leftJoin('ngos', "users.ngo_id", "ngos.id")
            ->where('users.active',1)
            ->where('users.ngo_id', Auth::user()->ngo_id)
            ->select("users.*", "roles.name as role_name", "ngos.name as ngo_name")
            ->paginate(12);
        }
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("users.index", $data);
    }
    // function to load user profile
    public function load_profile()
    {
        $data['roles'] = DB::table('roles')->where('active',1)->orderBy('name')->get();
        $data['components'] = DB::table('components')->where('active',1)->orderBy('name')->get();
        $data['user'] = DB::table('users')->where('id', Auth::user()->id)->first();
        return view('users.profile', $data);
    }
    // load create user form
    public function create()
    {

        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where("id", Auth::user()->ngo_id)->get();
            $data['roles'] = DB::table('roles')->where('active',1)->where('ngo_id', Auth::user()->ngo_id)->get();    
            //$data['components'] = DB::table('components')->where('active',1)->where('ngo_id',Auth::user()->ngo_id)->orderBy('name')->get();        
        }
        else{
            $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
            $data['roles'] = DB::table('roles')->where('active',1)->where('ngo_id',0)->get();
            //$data['components'] = DB::table('components')->where('active',1)->where('ngo_id',0)->orderBy('name')->get();
        }
        
        return view('users.create', $data);
    }
    public function edit($id)
    {
        $data['user'] = DB::table('users')->where('id', $id)->first();
        $data['roles'] = DB::table('roles')->where('active',1)->where('ngo_id', 0)->get();

        if(Auth::user()->ngo_id>0)
        {
            $data['roles'] = DB::table('roles')->where('active',1)->where('ngo_id', Auth::user()->ngo_id)->get();
            $data['ngos'] = DB::table('ngos')->where("id", Auth::user()->ngo_id)->get();
        }
        else{
            $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        }
       // $data['components'] = DB::table('components')->where('active',1)->where('ngo_id',0)->orderBy('name')->get();
        return view('users.edit', $data);
    }
    // delete a user by his/her id
    public function delete($id)
    {
        DB::table('users')->where('id', $id)->update(['active'=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/user?page='.$page);
        }
        return redirect('/user');
    }
    // function to upload photo
    public function update_profile(Request $r)
    {

        $lang = Auth::user()->language;
        if($lang=='kh')
        {
            $sms = "ពត៌មានប្រូហ្វាល់ត្រូវបានផ្លាស់ប្តូរដោយជោគជ័យ។";
            $sms1 = "ពត៌មានប្រូហ្វាល់មិនអាចធ្វើការផ្លាស់ប្តូរបានទេ, សូមត្រួតពិនិត្យម្តងទៀត!";
        }
        else{
            $sms = "All changes have been saved!";
            $sms1 = "Fail to save changes. Please check your entry again!";
        }
        if($r->hasFile('photo'))
        {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'profile/'; // usually in public folder
            $file->move($destinationPath, $file_name);
            // update data in table
            $data = array(
                'name' => $r->name,
                'email' => $r->email,
                'language' => $r->language,
                'role_id' => $r->role,
                'photo' => $file_name
            );
            $i = DB::table('users')->where('id', $r->id)->update($data);
            if ($i)
            {
                $r->session()->flash('sms', $sms);
                return redirect('/user/profile');
            }
            else
            {
                $r->session()->flash('sms1', $sms1);
                return redirect('/user/profile');
            }
        }
        else{
            $data = array(
                'name' => $r->name,
                'email' => $r->email,
                'language' => $r->language,
                'role_id' => $r->role
            );
            $i = DB::table('users')->where('id', $r->id)->update($data);
            if ($i)
            {
                $r->session()->flash('sms', $sms);
                return redirect('/user/profile');
            }
            else
            {
                $r->session()->flash('sms1', $sms1);
                return redirect('/user/profile');
            }
        }
    }
    // save user
    public function save(Request $r)
    {
        $count = DB::table('users')->where('username', $r->username)->count();
        if($count>0)
        {
            $r->session()->flash('sms1', "Username already exist. Please use a different one!");
            return redirect('/user/create')->withInput();
        }
        $r->validate([
            'password' => 'required|min:6',
        ]);
       $pass = $r->password;
       $cpass = $r->cpassword;
       if($pass!=$cpass)
       {
           $r->session()->flash("sms1", "The password and confirm passwor is not matched!");
           return redirect('/user/create')->withInput();
       }
        $data = array(
            'name' => $r->name,
            'email' => $r->email,
            'username' => $r->username,
            'gender' => $r->gender,
            'phone' => $r->phone,
            'position' => $r->position,
            'ngo_id' => $r->ngo,
            'password' => bcrypt($r->password),
            'role_id' => $r->role,
            'create_by' => Auth::user()->id
        );
        $i = DB::table('users')->insertGetId($data);
        if ($i)
        {
            // upload photo
            if ($r->hasFile("photo"))
            {
                $file = $r->file('photo');
                $file_name = $i . "-" .$file->getClientOriginalName();
                $destinationPath = 'uploads/users/';
                $file->move($destinationPath, $file_name);
                DB::table('users')->where("id", $i)->update(["photo"=>$file_name]);
            }
            $message = "<h3 style='color:#039'>Your new account has been created successfully!</h3>";
            $message .= "<hr>";
            $message .= "<p>Now you can login to SRI tool with the following account: </p>";
            $message .= "<p>Username: <strong>{$r->username}</strong></p>";
            $message .= "<p>Password: <strong>{$r->password}</strong></p>";
            $message .= "<hr>";
            $message .= "<p>If you have any problem with your account, please contact the system admin.<br>Thank you!</p>";
            Right::send_email($r->email, $message);
            $r->session()->flash('sms', 'New user has been created successfully!');
            return redirect('/user/create');
        }
        else
        {
            $r->session()->flash('sms1', 'Fail to create new user. Please check your inputs again!');
            return redirect('/user/create')->withInput();
        }
    }
    // update user
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'email' => $r->email,
            'username' => $r->username,
            'gender' => $r->gender,
            'phone' => $r->phone,
            'position' => $r->position,
            // 'component' => $r->component,
            'ngo_id' => $r->ngo,
            'role_id' => $r->role
        );
        if($r->password!=null)
        {
            $r->validate([
                'password' => 'required|min:6',
            ]);
            $pass = $r->password;
            $cpass = $r->cpassword;
            if($pass!=$cpass)
            {
                $r->session()->flash("sms1", "The password and confirm passwor is not matched!");
                return redirect('/user/create')->withInput();
            }
            $data['password'] = bcrypt($r->password);
        }
        if ($r->hasFile("photo"))
        {
            $file = $r->file('photo');
            $file_name = $r->id . "-" .$file->getClientOriginalName();
            $destinationPath = 'uploads/users/';
            $file->move($destinationPath, $file_name);
            $data["photo"] = $file_name;
        }
        $i = DB::table('users')->where('id', $r->id)->update($data);

        $r->session()->flash('sms', 'All changes have been saved successfully!');
        return redirect('/user/edit/'.$r->id);
    }
    // load reset password form
    public function reset_password()
    {
        return view('users.reset-password');
    }
    public function change_password(Request $r)
    {
        $id = Auth::user()->id;
        $new_password = $r->new_password;
        $confirm_password = $r->confirm_password;
       
        if($pass!=$cpass)
        {
            $r->session()->flash("sms1", "The password and confirm passwor is not matched!");
            return redirect('/user/create')->withInput();
        }
        if ($new_password!=$confirm_password)
        {
                $r->session()->flash('sms1',"The password is not matched, please check again.");
                return redirect('/user/update-password/'.$id)->withInput();
        }
        else{
            $data = array(
                'password' => bcrypt($new_password)
            );
            $i = DB::table('users')->where('id', $id)->update($data);
            if ($i)
            {
                $r->session()->flash('sms',"New password has been changed!");
                return redirect('/user/update-password/'.$id);
            }
           else{
               $r->session()->flash('sms1',"Fail to change password!");
               return redirect('/user/update-password/'.$id);
           }
        }
    }
    public function load_password($id)
    {
        $data['user'] = DB::table('users')->where('id', $id)->first();
        return view('users.change-password', $data);
    }
    // update password for other users by admin
    public function update_password(Request $r)
    {
        $id = $r->id;
        $lang = Auth::user()->language;
        $new_password = $r->new_password;
        $confirm_password = $r->confirm_password;
        $sms ="";
        $sms1 = "";
        $r->validate([
            'new_password' => 'required|min:6',
        ]);
        if ($lang=='kh')
        {
            $sms1 = "លេខសម្ងាត់ថ្មីមិនត្រឹមត្រូវទេ សូមពិនិត្យឡើងវិញ។";
            $sms = "លេខសម្ងាត់ ត្រូវបានផ្លាស់ប្តូរដោយជោគជ័យ។";
        }
        else{
            $sms = "The password has been changed successfully.";
            $sms1 = "The password is not matched. Please check again!";
        }
        if ($new_password!=$confirm_password)
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/user/update-password/'.$r->id)->withInput();
        }
        else{
            $data = array(
                'password' => bcrypt($new_password)
            );
            $i = DB::table('users')->where('id', $id)->update($data);
            $r->session()->flash('sms', $sms);
            return redirect('/user/update-password/'.$r->id);
        }
    }
    // load final page of change password success
    public function finish_page()
    {
        return view('users.finish-page');
    }
    // load branch for adding to each user
    public function branch($id)
    {
        $data['user'] = DB::table('users')
            ->join("roles", "users.role_id","=", "roles.id")
            ->where('users.id', $id)
            ->select("users.*", "roles.name as role_name")
            ->first();
        $data['branches'] = DB::table('branches')->where("active",1)->orderBy('name')->get();
        // get all branches for the current user
        $data['user_branches'] = DB::table('user_branches')
            ->join('users', "user_branches.user_id","=","users.id")
            ->join('branches', "user_branches.branch_id", "=", "branches.id")
            ->where("user_branches.user_id",$id)
            ->select("user_branches.*", "branches.name")
            ->get();
        return view("users.branches", $data);
    }
    public function add_branch(Request $r)
    {
        $data = array(
            'user_id' => $r->user_id,
            'branch_id' => $r->branch_id
        );
        $i = DB::table('user_branches')->insertGetId($data);
        return $i;
    }
    public function delete_branch($id)
    {
        $i = DB::table('user_branches')->where('id', $id)->delete();
        return $i;
    }
    public function getRole($id)
    {
        return DB::table('roles')->where('active',1)->where('ngo_id', $id)->orderBy('name')->get();
    }
    public function getComponent($id)
    {
        return DB::table('components')->where('active',1)->where('ngo_id',$id)->orderBy('name')->get();
    }
    public function get($id)
    {
        return DB::table('users')->where('active',1)->where('ngo_id', $id)->get();
    }
}
