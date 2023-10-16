<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DB;

class CustomAuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }  
      
    public function customLogin(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('notes')
                        ->withSuccess('Signed in');
        }
  
        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration(){
        return view('auth.registration');
    }
      
    public function customRegistration(Request $request){  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("notes")->withSuccess('You have signed-in');
    }

    public function create(array $data){
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    } 
    
    public function editUser(Request $request){
      $request->validate([
        'email' => 'required|email',
        'name' => 'required',
        'password' => 'required|min:6',
        'newPassword' => 'required|min:6',
        'confirmPassword' => 'required|min:6',  
      ]);

      $id = $request -> id;
      $email = $request -> email;
      $name = $request -> name;
      $password = $request -> password;
      $newPassword = $request -> newPassword;
      $confirmPassword = $request -> confirmPassword;
      
      try {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
          DB::table('users')
          ->where('id', $id)
          ->update([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($newPassword),
        ]);
        }
        return redirect("notes")->withSuccess('Success');
      } catch (Throwable $th) {
        return redirect("notes")->withSuccess('Unsuccessful');
      }
     
      return redirect("login")->withSuccess('Unautharized');
     }
  
     public function getUser($id){
      $user = DB::select('select * from users where id = ?',[$id]);
      
      return view("user_update",['user'=>$user[0]]);
     }
    
    public function dashboard()
    {
        if(Auth::check()){
            return view('notes');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}