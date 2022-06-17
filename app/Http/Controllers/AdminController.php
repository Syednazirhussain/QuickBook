<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Admin;
use App\Models\Reminder;
use App\Models\Repeat;
use Illuminate\Http\Request;
use DB;
use Hash;
use Validator;
use Auth;
use Redirect;
use Session;
use Mail;


class AdminController extends Controller
{



    /////////Usr Bypass Login

	public function byassLogin(Request $request)
	{
		if(!empty($_POST))
		{
			$users = User::where(['email'=>$request->email,'role_id'=>3])->select('*')->selectRaw("'yes' as buy_pass")->first();



			$user = $users;

			Auth::logout();

			Auth::login($user);

			$product = collect(['buy_pass' => 'yes']);

      // $product = array('buy_pass' => 'yes']);

			Session::put('cart','buy_pass');

			$month = date('m');
			$year = date('Y');

			if (Auth::user()->id)
			{     
				return redirect('dashboard/'.$month.'/'.$year);
			}

			else
			{
				Session::flash('message', 'Invalid email and password'); 
			}
		}

	}

	public function backLogin()
	{

		return redirect()->back();
	}



	public function login()
	{
		return view('auth.login');
	}
	
	
	
	
	
	public function dologin(Request $request)
	{
		$m = date('m');
		$y = date('Y');
		if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
		{

			return redirect('/dashboard/'.$m.'/'.$y);
		}
		else{

			return back()->with('error_message','Invalid email or password');
		}


	}


	public function index()
	{


		$users = User::where('role_id','=',2)->get();
		return view('admins.index',compact('users'));

	}

	public function add_admin()
	{

		return view('admins.create');

	}



	public function store(Request $request)
	{  
		$password = rand(1000,99999);
		$post = New User;
		$post->first_name = $request->first_name;
		$post->last_name = $request->last_name;
		$post->email = $request->email;
		$post->mobile_no = $request->mobile_no;
		$post->password = hash::make($password);
		$post->role_id = '2';
		$post->save();
		$subject = 'User Details';
		Mail::to($request->email)->send(New \App\Mail\UserMail($request->name,$request->email,$password,$subject));



		$request->session()->flash('message', 'Admin Added Succesfully');
		return redirect('/admins');


	}

	public function editAdmin($id)
	{
		$user = User::find($id);
		return view('admins.edit',compact('user'));
	}
	public function update(Request $request,$id)
	{
		$post =User::find($id);
		$post->first_name = $request->first_name;
		$post->last_name = $request->last_name;
		$post->email = $request->email;
		$post->mobile_no = $request->mobile_no;
		$post->save();
		$request->session()->flash('message', 'admin Updated Succesfully');
		return redirect('/admins'); 
	}

	public function destroy(Request $request,$id)
	{
		$post = User::find($request->id);
		$post->delete();
		$request->session()->flash('message', 'Admin Delete Succesfully');
		return redirect()->back();
	}





  //FOROT PASSWORD

	public function forgot_password(Request $request)
	{	
		return view('auth.forgotpassword');
	}
	
	public function forgotpasswordmailsend(Request $request)
	{
		$password = rand(1000,99999);

		$user_emai =User::where('email',$request->email)->count();
		if($user_emai > 0)
		{
			$update_data = User::where('email',$request->email)->first();
			$update_data->password = bcrypt($password);
			$update_data->save();
			Mail::to($request->email)->send(New \App\Mail\ForgotMail($request->name,$password));
			return redirect('/login')->with('message','Please Check Your Mail');
		}
		else{return redirect('forgot-password')->with('message','E-Mail Address Not Found');}
	}
	

    //PROFILE

	public function user_profile()
	{	
		return view('users.userprofile');
	}

  //update User Profile

	public function update_profile()
	{	
		
		return view('users.updateprofile');
	}

	public function update_Profil(Request $request,$id)
	{

		$update_data = User::find($id);
		$update_data->first_name = $request->first_name;
		$update_data->last_name = $request->last_name;
		$update_data->email = $request->email;
		$update_data->mobile_no = $request->mobile_no;
		$update_data->save();

		return redirect()->back()->with('message',' Profile Updated Successfully');
	}


	public function logout()
	{
		Auth::logout();
		return redirect('/login');
	}
	
	

}