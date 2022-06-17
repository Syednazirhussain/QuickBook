<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Models\Repeat;
use Illuminate\Http\Request;
use Auth;
class ReminderController extends Controller
{
   public function addReminder(Request $request)
   {
        $count = count($request->datepicker);
        $datearray = $request->datepicker;
        array_shift($datearray);
      if($count > 1)
      {
      $dates = $request->datepicker[0];
         $Repeat = New Reminder;
         $Repeat->user_id = Auth::user()->id;
         $Repeat->title = $request->title;
         $Repeat->datepicker = date('Y-m-d',strtotime($dates));
         $Repeat->month = date('m',strtotime($dates));
         $Repeat->save();
 

      $i = 1;
      foreach($datearray as $date)
      {
      $reminder = New Repeat;
      $reminder->user_id = Auth::user()->id;
      $reminder->reminder_id = $Repeat->id;
      $reminder->title = $request->title;
      $reminder->datepicker = date('Y-m-d',strtotime($date));
      $reminder->month = date('m',strtotime($dates));
      $reminder->save();
      $i++;
     }
     
     
    } else
    {
         $dates = $request->datepicker[0];
         $Repeat = New Reminder;
         $Repeat->user_id = Auth::user()->id;
         $Repeat->title = $request->title;
         $Repeat->datepicker = date('Y-m-d',strtotime($dates));
         $Repeat->month = date('m',strtotime($dates));
         $Repeat->save();
    }
     return back();
   }

   public function eidtReminder(Request $request)
   {
      $reminder = Reminder::where('id','=',$request->id)->first();
      return $reminder;
   }

   public function updateReminder(Request $request)
   {
      $reminder =Reminder::find($request->id);
      $reminder->user_id = Auth::user()->id;
      $reminder->title = $request->title;
      $reminder->datepicker = date('Y-m-d',strtotime($request->datepicker));
      $reminder->month = date('m',strtotime($dates));
      $reminder->save();
      return "success";

   }

    public function deleteRemender(Request $request)
   {
      $reminder = Reminder::where('id','=',$request->id)->first();
      $reminder->deleted_at = 1;
      $reminder->save();
      return "success";
   }

// FOR INDEX PAGE SHOW
   public function index()
   {
      $year = date('Y');
      $currentMonth = date('m');
      $reminders = Reminder::with('repeats')->where('user_id','=',Auth::user()->id)
      ->whereRaw('YEAR(datepicker) = ?',[$year])
      ->get();

      return view('reminder.index',compact('reminders'));
   }

  // FOR SHOW INSERT DATA PAGE
  
  public function create()
  {
   return view('reminder.create');
  } 

  // STORE DATA 
  public function store(Request $request)
  {
   

     $count = count($request->datepicker);
     $datearray = $request->datepicker;
      array_shift($datearray);


      if($count > 1)
      {
         $dates = $request->datepicker[0];
         $Repeat = New Reminder;
         $Repeat->user_id = Auth::user()->id;
         $Repeat->title = $request->title;
         $Repeat->datepicker = date('Y-m-d',strtotime($dates));
         $Repeat->month = date('m',strtotime($dates));
         $Repeat->save();
 

        $i = 0;
         foreach($datearray as $date)
         {
         $reminder = New Repeat;
         $reminder->user_id = Auth::user()->id;
         $reminder->reminder_id = $Repeat->id;
         $reminder->title = $request->title;
         $reminder->datepicker = date('Y-m-d',strtotime($date));
         $reminder->month = date('m',strtotime($dates));
         $reminder->save();
         $i++;
        }
       } else
       {
         $dates = $request->datepicker[0];
         $Repeat = New Reminder;
         $Repeat->user_id = Auth::user()->id;
         $Repeat->title = $request->title;
         $Repeat->datepicker = date('Y-m-d',strtotime($dates));
         $Repeat->month = date('m',strtotime($dates));
         $Repeat->save();
    }
      return redirect('reminder')->with('success','Reminder Create Successfully');
  }

  // FOR SHOW EDIT PAGE

  public function edit ($id)
  {
    $reminder = Reminder::find($id);
    $repeats = Repeat::where('reminder_id','=',$id)->get();
    return view('reminder.edit',compact('reminder','repeats'));
  }

  // FOR UPDATE REMINDER

  public function update(Request $request)
  {

      Reminder::where('id','=',$request->id)->delete();
      Repeat::where('reminder_id','=',$request->id)->delete();
     $count = count($request->datepicker);
     $datearray = $request->datepicker;
      array_shift($datearray);


      if($count > 1)
      {
         $dates = $request->datepicker[0];
         $Repeat = New Reminder;
         $Repeat->user_id = Auth::user()->id;
         $Repeat->title = $request->title;
         $Repeat->datepicker = date('Y-m-d',strtotime($dates));
         $Repeat->month = date('m',strtotime($dates));
         $Repeat->save();
 

        $i = 0;
         foreach($datearray as $date)
         {
         $reminder = New Repeat;
         $reminder->user_id = Auth::user()->id;
         $reminder->reminder_id = $Repeat->id;
         $reminder->title = $request->title;
         $reminder->datepicker = date('Y-m-d',strtotime($date));
         $reminder->month = date('m',strtotime($dates));
         $reminder->save();
         $i++;
        }
       } else
       {
         $dates = $request->datepicker[0];
         $Repeat = New Reminder;
         $Repeat->user_id = Auth::user()->id;
         $Repeat->title = $request->title;
         $Repeat->datepicker = date('Y-m-d',strtotime($dates));
         $Repeat->month = date('m',strtotime($dates));
         $Repeat->save();
    }
      return redirect('reminder')->with('success','Reminder Update Successfully');
  }

  // REMINDER DELETE

  public function deleteReminders($id)
  {
    Reminder::find($id)->delete();
    Repeat::where('reminder_id','=',$id)->delete();
     return redirect('reminder')->with('success','Reminder Delete Successfully');
  }

  /////REPEAT DELETE

  public function deleteRepeat($id)
  {
     $reminder = Repeat::where('id','=',$id)->delete();
     return redirect()->back()->with('success','Reminder Delete Successfully');
  }

  public function AddMedicalcard(Request $request)
  {
     $AddMedicalcard = New Reminder;
     $AddMedicalcard->user_id = Auth::user()->id;
     $AddMedicalcard->title = 'Medical Card Exam';
     $AddMedicalcard->datepicker = date('Y-m-d',strtotime($request->Medical_Card));
     $AddMedicalcard->month = date('m',strtotime($request->Medical_Card));
     $AddMedicalcard->save();
     return $AddMedicalcard;
  }
}
