<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use DB;
use Hash;
use Validator;
use Auth;
use Redirect;
use Session;
use Mail;


class EventController extends Controller
{


	
	   
		public function store(Request $request)
		{  
		  $m = date('m',strtotime($request->start));
		  $y = date('Y',strtotime($request->start));

		$rate = DB::table('rates')->where('month','=',$m)->first();
		if($request->title == 'Full')
		{
			$price = $rate->fulldayrs; 
		}

		if($request->title == 'Inte..')
		{
			$price = $rate->Internationalrs; 
		}

		if($request->title == 'Half')
		{
			$price = $rate->halfdayrs; 
		}
          if($request->fullid)
		   {

		   	    $post = Event::where('id','=',$request->fullid)->first();
				$post->user_id =Auth::user()->id;
				$post->title = $request->title;
				$post->end = $request->start;
				$post->start = $request->start;
				$post->className = $request->color;
				$post->price = $price;
				$post->save();
		   }
		else {
				$post = New Event;
				$post->user_id =Auth::user()->id;
				$post->title = $request->title;
				$post->end = $request->start;
				$post->start = $request->start;
				$post->className = $request->color;
				$post->price = $price;
				$post->save();
             }
	         $events = $this->getEvent();
			 return json_encode($events);
		}

		// FOR UPDATE FULLCALENDER
		public function updateFullcalender(Request $request)
		{  
		  $m = date('m',strtotime($request->start));
		  $y = date('Y',strtotime($request->start));

		$rate = DB::table('rates')->where('month','=',$m)->first();
		if($request->title == 'Full')
		{
			$price = $rate->fulldayrs; 
		}

		if($request->title == 'Inte..')
		{
			$price = $rate->Internationalrs; 
		}

		if($request->title == 'Half')
		{
			$price = $rate->halfdayrs; 
		}

		   
			 $startdate = Event::where('id','=',$request->fullid)->first();

                 $startdate->title = $request->title;
                 $startdate->start = $request->start;
                 $startdate->end = $request->start;
                 $startdate->className = $request->color;
                 $startdate->price = $price;
                 $startdate->save();                
	         $events = $this->getEvent();
			 return json_encode($events);
		}
	public function deleteEvent(Request $request)
		{
		   	$startdate = Event::where('id','=',$request->event_id)->delete();
		    $events = $this->getEvent();
		 
			 return json_encode($events);
		}	
		
		public function start_date_check(Request $request)
		
		  {
             
		     if($request->start_date)
			 {
				$start_date = $request->start_date; 
			 }
			 else
			 {
			  	$start_date =date('Y-m-d'); 
			 }
		  
			$startdates = Event::where('start','=',$start_date)->where('user_id','=',Auth::user()->id)->first();
			
			return $startdates;
			}
		
		
	public function getEvent()
	{
	 return  DB::table('events')->select('title','start','end','className')->where('user_id','=',Auth::user()->id)->get();	
	}
	
	  
}