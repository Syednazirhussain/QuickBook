<?php

namespace App\Http\Controllers;

use App\Models\EstimatePaymentMode;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Session;
class EstimatePaymentModeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role_id == 2){
            
        $users = User::where('role_id','=',3)->where('user_id','=',Auth::user()->id)->get();
        $EstimatePaymentModes= EstimatePaymentMode::join('users','estimate_payment_modes.persion_id','=','users.id')
         ->select('users.first_name','users.last_name','estimate_payment_modes.*')
         ->where('estimate_payment_modes.user_id','=',Auth::user()->id)->get();
        
        return view('estimatepayment.index',compact('EstimatePaymentModes','users'));
    }
    else
    {
      $users = User::where('role_id','=',3)->where('user_id','=',Auth::user()->id)->get();
        $EstimatePaymentModes= EstimatePaymentMode::join('users','estimate_payment_modes.persion_id','=','users.id')
         ->select('users.first_name','users.last_name','estimate_payment_modes.*')
         ->where('estimate_payment_modes.persion_id','=',Auth::user()->id)->get();
        
        return view('estimatepayment.index',compact('EstimatePaymentModes','users'));   
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('estimatepayment.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = $request->all();
       $data['user_id'] = Auth::user()->id;
       $EstimatePaymentMode = new EstimatePaymentMode;
       $EstimatePaymentMode->create($data);
       return redirect('EstimatePayment')->with('message','Thank You, Your Process Is Complete Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EstimatePaymentMode  $estimatePaymentMode
     * @return \Illuminate\Http\Response
     */
    public function show(EstimatePaymentMode $estimatePaymentMode)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EstimatePaymentMode  $estimatePaymentMode
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::where('role_id','=',3)->where('user_id','=',Auth::user()->id)->get();
        $estimatePaymentMode = EstimatePaymentMode::find($id);
        return view('estimatepayment.edit',compact('estimatePaymentMode','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EstimatePaymentMode  $estimatePaymentMode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $data = $request->all();
       if($request->Fistpaymentmode)
        {$Fistpaymentmode = $request->Fistpaymentmode;}else{$Fistpaymentmode ='';};
       if($request->FistPayment)
        {$FistPayment = $request->FistPayment;}else{$FistPayment ='';};
     if($request->Secondpaymentmode)
        {$Secondpaymentmode = $request->Secondpaymentmode;}else{$Secondpaymentmode ='';};
       if($request->SecondPayment)
        {$SecondPayment = $request->SecondPayment;}else{$SecondPayment ='';};

    if($request->Thirdpaymentmode)
        {$Thirdpaymentmode = $request->Thirdpaymentmode;}else{$Thirdpaymentmode ='';};
       if($request->ThirdPayment)
        {$ThirdPayment = $request->ThirdPayment;}else{$ThirdPayment ='';};

    if($request->Fourthpaymentmode)
        {$Fourthpaymentmode = $request->Fourthpaymentmode;}else{$Fourthpaymentmode ='';};
       if($request->FourthPayment)
        {$FourthPayment = $request->FourthPayment;}else{$FourthPayment ='';};

       $data['Fistpaymentmode'] = $Fistpaymentmode;
       $data['FistPayment'] = $FistPayment;
       $data['Secondpaymentmode'] = $Secondpaymentmode;
       $data['SecondPayment'] = $SecondPayment;
       $data['Thirdpaymentmode'] = $Thirdpaymentmode;
       $data['ThirdPayment'] = $ThirdPayment;
       $data['Fourthpaymentmode'] = $Fourthpaymentmode;
       $data['FourthPayment'] = $FourthPayment;
       $EstimatePaymentMode = EstimatePaymentMode::find($id);
       $EstimatePaymentMode->update($data);
       return redirect('EstimatePayment')->with('message','Thank You, Your Process Is Complete Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EstimatePaymentMode  $estimatePaymentMode
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $EstimatePaymentMode = EstimatePaymentMode::find($id);
       $EstimatePaymentMode->delete();
       return redirect('EstimatePayment')->with('message','Thank You, Your Process Is Complete Successfully');
    }

 public function PaymentConformedUpdate(Request $request)
    {
       $EstimatePaymentMode = EstimatePaymentMode::where('id','=',$request->id)->first();
       $EstimatePaymentMode->payment = $request->val;
       $EstimatePaymentMode->save();
       return redirect('EstimatePayment')->with('message','Thank You, Your Process Is Complete Successfully');
    }



}
