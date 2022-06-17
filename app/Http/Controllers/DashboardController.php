<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\Image;
use App\Models\Repeat;
use App\Models\Camera;
use App\Models\Reminder;
use Illuminate\Http\Request;
use App\Models\QuickBookToken;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{

	public function graphTax (Request $request) {

        $filter = [];
        if( $request->has('month') && $request->has('year') ){
            $myDate = $request->get('month').'/'.$request->get('year');
            $start_date = Carbon::createFromFormat('m/Y', $myDate)
            ->firstOfMonth()
            ->format('Y-m-d');

            $end_date = Carbon::createFromFormat('m/Y', $myDate)
            ->lastOfMonth()
            ->format('Y-m-d');

            $filter  = [
                'start_date' => $start_date,
                'end_date' => $end_date
            ];
        }
        if($request->has('y')){
            $filter  = [
                'start_date' => $request->y.'-01-01',
                'end_date' => $request->y.'-12-31'
            ];
        }
		$params = [
			"minorversion" => 14,
			"summarize_column_by" => "Month",
		];
        $params =  array_merge($params,$filter);


		$realmID = auth()->user()->quickbook_token->realm_id;
		// $url = "https://sandbox-quickbooks.api.intuit.com/v3/company/".$realmID."/reports/ProfitAndLoss?".http_build_query($params);
		$url = "https://".config("quickbooks.keys.sandbox_base_url")."/v3/company/".$realmID."/reports/ProfitAndLoss?".http_build_query($params);

		$response = Http::withHeaders([
						'Accept' => "application/json",
						'Authorization' => "Bearer ".auth()->user()->quickbook_token->access_token
					])->get($url);
		// if($response->status() == 400){
		// 	Auth::logout();
		// 	return response()->json([ 'redirect_url' => route('login') ], 400);
		// }
		// if($response->status() == 401){
		// 	return response()->json([ 'redirect_url' => route('token_refresh')], 400);
		// }

		return response()->json($response->json(), $response->status());
	}


	public function index(Request $request, $month, $year) {

		// $request->session()->flush();
		// dd($request->session()->all());

 		$USER  = Auth::user()->id;

		if($request->y)
		{

			// $rates = DB::table('events')->whereRaw('YEAR(start) = ?',[$request->y])->first()->sum(price);



          $date = $month;

			$halfdays = Event::where('title','=','Half')->where('user_id','=',Auth::user()->id)->whereRaw('YEAR(start) = ?',[$year])->count();
			$fullDays = Event::where('title','=','Full')->where('user_id','=',Auth::user()->id)->whereRaw('YEAR(start) = ?',[$year])->count();
			$internationals = Event::where('title','=','Inte..')->where('user_id','=',Auth::user()->id)->whereRaw('YEAR(start) = ?',[$year])->count();



           // $reminders = Reminder::with('repeats')->where('user_id','=',Auth::user()->id)->get();
           //   echo "<pre>";
           //   print_r($reminders); exit;

			 $reminders = Reminder::where('user_id','=',Auth::user()->id)->get();
       $repeats = Repeat::where('user_id','=',Auth::user()->id)->get();



		}
		else
		{
			$date = $month;
			$year = $year;

			// echo "$USER"; exit;


			$halfdays = Event::where('title','=','Half')->where('user_id','=',Auth::user()->id)->whereRaw('MONTH(start) = ?',[$date])->whereRaw('YEAR(start) = ?',[$year])->count();
			$fullDays = Event::where('title','=','Full')->where('user_id','=',Auth::user()->id)->whereRaw('MONTH(start) = ?',[$date])->whereRaw('YEAR(start) = ?',[$year])->count();
			$internationals = Event::where('title','=','Inte..')->where('user_id','=',Auth::user()->id)->whereRaw('MONTH(start) = ?',[$date])->whereRaw('YEAR(start) = ?',[$year])->count();

            $reminders = Reminder::where('user_id','=',Auth::user()->id)->whereRaw('MONTH(datepicker) = ?',[$date])->get();
            $repeats = Repeat::where('user_id','=',Auth::user()->id)->whereRaw('MONTH(datepicker) = ?',[$date])->get();




		}

           $ageFrom = date('Y-m-d');
         $adddays = date('Y-m-d');
        $adddays =  date('Y-m-d', strtotime($adddays. ' + 7 days'));

	   $events = DB::table('events')->select('id','title','start','end','className')->where('user_id','=',Auth::user()->id)->get();
       $rem = DB::table('reminders')->where('user_id','=',Auth::user()->id)->where('title','=','Medical Card Exam')->count();

         $nextreminders = Reminder::where('user_id','=',Auth::user()->id)->whereBetween('datepicker', [$ageFrom, $adddays])->get();
         $nextrepeats = Repeat::where('user_id','=',Auth::user()->id)->whereBetween('datepicker', [$ageFrom, $adddays])->get();


		$currentMonth = date('m');
		$total_users = User::where('id','!=','1')->count();
		$countadmin = User::where('role_id','=','2')->count();
		$countuser = User::where('user_id','=',Auth::user()->id)->where('role_id','=','3')->count();





		$full = number_format($fullDays*100/30,2);

		$half = number_format($halfdays*100/30,2);
		$inter = number_format($internationals*100/30,2);

		$monthNum  = $month;
		$dateObj   = DateTime::createFromFormat('!m', $monthNum);
		$monthName = $dateObj->format('F');
		$monthName = $monthName;
		$mon = $month;
		$month = $monthName;



		$year = $year;
$quer = "https://sandbox-quickbooks.api.intuit.com/v3/company/4620816365198291350/query?query=select * from Account where Metadata.CreateTime > '2021-12-31'&minorversion=62";

		return view('dashboard.index',compact('total_users','countadmin','countuser','events','reminders','halfdays','fullDays','internationals','full','half','inter','month','year','mon','rem','repeats','nextreminders','nextrepeats'));

	}


	public function showEvent(Request $request)
	{

		if($request->showCount == 'year')
		{
            $halfdaysum = Event::where('title','=','Half')->where('user_id','=',Auth::user()->id)->whereRaw('YEAR(start) = ?',[$request->year])->sum('price');
			$fullDaysum = Event::where('title','=','Full')->where('user_id','=',Auth::user()->id)->whereRaw('YEAR(start) = ?',[$request->year])->sum('price');
			$internationalsum = Event::where('title','=','Inte..')->where('user_id','=',Auth::user()->id)->whereRaw('YEAR(start) = ?',[$request->year])->sum('price');
            }
            else
           {
             $halfdaysum = Event::where('title','=','Half')->where('user_id','=',Auth::user()->id)->whereRaw('MONTH(start) = ?',[$request->month])->whereRaw('YEAR(start) = ?',[$request->year])->sum('price');
			$fullDaysum = Event::where('title','=','Full')->where('user_id','=',Auth::user()->id)->whereRaw('MONTH(start) = ?',[$request->month])->whereRaw('YEAR(start) = ?',[$request->year])->sum('price');
			$internationalsum = Event::where('title','=','Inte..')->where('user_id','=',Auth::user()->id)->whereRaw('MONTH(start) = ?',[$request->month])->whereRaw('YEAR(start) = ?',[$request->year])->sum('price');

           }

		 $total = array($fullDaysum,$internationalsum,$halfdaysum);
		echo  json_encode($total);
	}
    // SHOW EVENT FULLLCALENDER
	public function showFullcalender(Request $request)
	{

	    $events = DB::table('events')->select('id','title','start','end','className')->where('user_id','=',Auth::user()->id)->get();
      return json_encode($events);
  }



	public function file_index()
	{
		$photos = Camera::where('user_id','=',Auth::user()->id)->get();
		return view('fileupload.index',compact('photos'));

	}


	public function file_upld()
	{

		return view('fileupload.file');

	}

	public function edit_image($id)
	{
		$image= Image::find($id);
		return view('fileupload.edit',compact('image'));

	}



	public function store(Request $request)
	{
		$post= New Camera;
		if ($files = $request->image) {

			$img = time().'.'.$files->getClientOriginalExtension();
			$request->image->move(public_path('images'), $img);

			$image = $img;

		}

		else {
			$image ='default.jpg';

		}

		$post->title = $request->title;
		$post->picture = $image;
		$post->user_id =Auth::user()->id;
		$post->save();
		$request->session()->flash('message', 'File Uploaded Succesfully');
		return redirect('/image/index');

	}
	public function update_image(Request $request,$id)
	{

		$post= Image::find($id);
		if ($files = $request->image) {

			$img = time().'.'.$files->getClientOriginalExtension();
			$request->image->move(public_path('images'), $img);

			$image = $img;

		}

		else {
			$image =$post->image;

		}

		$post->note = $request->note;
		$post->image = $image;
		$post->user_id =Auth::user()->id;
		$post->save();
		$request->session()->flash('message', 'File Update Succesfully');
		return redirect('/image/index');

	}


		// CAMERA TAKE PHOTO
	public function take_photo()
	{

		return view('cameras.camera');

	}



	public function deletes(Request $request,$id)
	{
		$post= Image::find($id);
			// echo $post;exit;
		$post->delete();
		$request->session()->flash('message', 'File Delete Succesfully');
		return redirect('/image/index');
	}
///////////GET EVENT
	public function getEvent()
	{
		return  DB::table('events')->select('id','title','start','end','className')->where('user_id','=',Auth::user()->id)->get();
	}
 // FOR CALENDER

	public function calender(Request $request,$month,$year)
	{
		$mon = $month;
		$year = $year;
		return view('calender.index',compact('mon','year'));
	}


}
