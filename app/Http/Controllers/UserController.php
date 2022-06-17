<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Reminder;
use App\Models\Repeat;
use Illuminate\Http\Request;
use DB;
use Hash;
use Config;
use Validator;
use Auth;
use Redirect;
use QuickBooksOnline\API\DataService\DataService;
use Session;
use Mail;
use Spinen\QuickBooks\Client as QuickBooks;

class UserController extends Controller
{


	public function login()
	{
	   return view('auth.login');
	}
	public function quickbookResponse(Request $request)
	{
		session_start();
		$dataService = DataService::Configure(array(
			'auth_mode' => 'oauth2',
			'ClientID' => Config::get('quickbooks.data_service.client_id'),
			'ClientSecret' =>  Config::get('quickbooks.data_service.client_secret'),
			'RedirectURI' => Config::get('quickbooks.data_service.oauth_redirect_uri'),
			'scope' => Config::get('quickbooks.data_service.scope'),
			'baseUrl' => "development"
		));
		$OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
		$authorizationCodeUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();
		$accessToken = $OAuth2LoginHelper->exchangeAuthorizationCodeForToken($request->code, $request->realmId);
		$_SESSION['sessionAccessToken'] = $accessToken;

		// $accessTokenValue = $accessToken->getAccessToken();

		// dd($accessToken);
	   return redirect('/ExciseTax');
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


		public function index() {

			$users = User::where('role_id', 3)
						->where('user_id', auth()->user()->id)
						->get();

			return view('users.index', compact('users'));
		}

			 
		
		 public function add_user()
		{
			
			return view('users.create');
			
		}
		
		
		
		public function store(Request $request)
		{  
			$password = rand(1000,99999);
			$post = New User;
			$post->first_name = $request->first_name;
			$post->last_name = $request->last_name;
			$post->email = $request->email;
			$post->mobile_no = $request->mobile_no;
			$post->user_id = Auth::user()->id;
			$post->password = hash::make($password);
			$post->role_id = '3';
			$post->save();
			$subject = 'User Details';
            Mail::to($request->email)->send(New \App\Mail\UserMail($request->name,$request->email,$password,$subject));


                     ///IFTA Filing Required
			         $dates = date('Y-01-31');
			         $Repeat = New Reminder;
			         $Repeat->user_id = $post->id;
			         $Repeat->title = "IFTA Filing Required";
			         $Repeat->datepicker = $dates;
			         $Repeat->month = '01';
			         $Repeat->save();

				      $reminder = New Repeat;
				      $reminder->user_id = $post->id;
				      $reminder->reminder_id = $Repeat->id;
				      $reminder->title = $Repeat->title;
				      $reminder->datepicker = date('Y-04-30');
				      $reminder->month = '04' ;
				      $reminder->save();

				      $reminder = New Repeat;
				      $reminder->user_id = $post->id;
				      $reminder->reminder_id = $Repeat->id;
				      $reminder->title = $Repeat->title;
				      $reminder->datepicker = date('Y-10-31');
				      $reminder->month = '10';
				      $reminder->save();

				      $reminder = New Repeat;
				      $reminder->user_id = $post->id;
				      $reminder->reminder_id = $Repeat->id;
				      $reminder->title = $Repeat->title;
				      $reminder->datepicker = date('Y-07-31');
				      $reminder->month = '07';
				      $reminder->save();
     
                     ///IFTA Application Renewal Required
			         $Renewal = New Reminder;
			         $Renewal->user_id = $post->id;
			         $Renewal->title = "IFTA Application Renewal Required";
			         $Renewal->datepicker = date('Y/12/31');
			         $Renewal->month = '12';
			         $Renewal->save();

			         //////Form 2290 Filing Required
                     
                     $Filing = New Reminder;
			         $Filing->user_id = $post->id;
			         $Filing->title = "Form 2290 Filing Required";
			         $Filing->datepicker = date('Y/08/31');
			         $Filing->month = '08';
			         $Filing->save();

			         //////Estimated Payments Required
              
                     $First = New Reminder;
			         $First->user_id = $post->id;
			         $First->title = "Fourth Quarter Estimated Payment Due";
			         $First->datepicker = date('Y/01/15');
			         $First->month = '01';
			         $First->save();

			          $First1 = New Repeat;
				      $First1->user_id = $post->id;
				      $First1->reminder_id = $First->id;
				      $First1->title = "First Estimated Payment Due";
				      $First1->datepicker = date('Y-04-15');
				      $First1->month = '04';
				      $First1->save();

				      $First2 = New Repeat;
				      $First2->user_id = $post->id;
				      $First2->reminder_id = $First->id;
				      $First2->title = "Second Estimated Payment Due";
				      $First2->datepicker = date('Y-06-15');
				      $First2->month = '06';
				      $First2->save();
                    
                      $First3 = New Repeat;
				      $First3->user_id = $post->id;
				      $First3->reminder_id = $First->id;
				      $First3->title = "Third Estimated Payment Due";
				      $First3->datepicker = date('Y-09-15');
				      $First3->month = '09';
				      $First3->save();

				      //////Tax Return Filing Required
              
                     $Return = New Reminder;
			         $Return->user_id = $post->id;
			         $Return->title = "Entity Returns without an extension";
			         $Return->datepicker = date('Y/03/15');
			         $Return->month = '03';
			         $Return->save();

			          $Return1 = New Repeat;
				      $Return1->user_id = $post->id;
				      $Return1->reminder_id = $Return->id;
				      $Return1->title = "Personal Returns without an extension";
				      $Return1->datepicker = date('Y-04-15');
				      $Return1->month = '04';
				      $Return1->save();

				      $Return2 = New Repeat;
				      $Return2->user_id = $post->id;
				      $Return2->reminder_id = $Return->id;
				      $Return2->title = "Entity Returns with an extension";
				      $Return2->datepicker = date('Y-09-15');
				      $Return2->month = '09';
				      $Return2->save();
                    
                      $Return3 = New Repeat;
				      $Return3->user_id = $post->id;
				      $Return3->reminder_id = $Return->id;
				      $Return3->title = "Personal Returns with an extension";
				      $Return3->datepicker = date('Y-10-15');
				      $Return3->month = '10';
				      $Return3->save();



			$request->session()->flash('message', 'User Added Succesfully');
			return redirect('/users');
			
	        
			
			
            // ->with('success', 'User Added successfull');
			
		}
		
		public function edit($id)
		{
			$user = User::find($id);
			return view('users.edit',compact('user'));
		 }
  public function update(Request $request,$id)
  {
	        
			$post->first_name = $request->first_name;
			$post->last_name = $request->last_name;
			$post->email = $request->email;
			$post->mobile_no = $request->mobile_no;
			$post->save();
			$request->session()->flash('message', 'User Updated Succesfully');
			return redirect('/users'); 
  }
  
 public function distroy(Request $request,$id)
 {
  $post = User::find($id);
  $post->delete();
  $request->session()->flash('message', 'User Delete Succesfully');
   return redirect('/users'); 
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
  
  
	public function logout(Request $request, QuickBooks $quickbooks) {
 		$quickbooks->deleteToken();
		Auth::logout();
		$request->session()->flush();

		return redirect('/login');
    }
	
}