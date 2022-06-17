@extends('layouts.admin')
@section('content') 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<div id="content" class="main-content">
	<div class="container">
		<div class="container">
			<div class="row layout-top-spacing">
				<div class="col-lg-9   layout-spacing">
					<div class="statbox widget box box-shadow">
						<div class="widget-header">                                
							<div class="row">
								<div class="col-xl-12 col-md-12 col-sm-12 col-12">
									<h4>Excise Taxes</h4>
								</div>
							</div>
						</div>
						<div class="widget-content widget-content-area">
							<form enctype="multipart/form-data" action="{{url('/ExciseTax')}}" method="post">
								@csrf
								<div class="form-row mb-4">
									
									<div class="col">
										
										<label for="formGroupExampleInput">User Name</label>
										<select name="persion_id"  class="form-control">
											<option value="">Select</option>
											@foreach($users as $user)
										  <option value="{{$user->id}}">{{ucfirst($user->first_name)}} {{$user->last_name}}</option>
										   @endforeach
										</select>
										
									</div>
								</div>
								<div class="form-row mb-4">
									
									<div class="col">
										
										<label for="formGroupExampleInput">Quarter</label>
										<select name="quarter" id="quarter" onchange="persion_ids(this.value);" class="form-control">
											<option value="">Select</option>
										  <option value="First Quarter IFTA-April 30th">First Quarter IFTA-April 30th</option>
										  <option value="Second Quarter IFTA-July 31th">Second Quarter IFTA-July 31th</option>
										  <option value="Third Quarter IFTA-Oct 31st">Third Quarter IFTA-Oct 31st</option>
										  <option value="Fourth Quarter IFTA-Jun 31st Subsequent Year">Fourth Quarter IFTA-Jun 31st Subsequent Year</option>
										</select>
										
									</div>
								</div>
								<div class="form-row mb-4">
									
									<div class="col">
										
										<label for="formGroupExampleInput">IFTA Filled Date </label>
										<input type="text" name="IFTAFilledDate" value="{{date('m/d/Y')}}" class="form-control datepicker" placeholder="IFTA Filled Date">
									</div>
								</div>
								<div class="form-row mb-4">
									
									<div class="col">
										<label for="formGroupExampleInput">IFTA Acceptance Date </label>
										<input type="text" name="IFTAAcceptanceDate" value="{{date('m/d/Y')}}" class="form-control datepicker"  placeholder="IFTA Acceptance Date">
									</div>
								</div>
								<div class="form-row mb-4">
									
									<div class="col">
										<label for="formGroupExampleInput">IFTA Tax Amount Due </label>
										<input type="text" name="IFTATaxDue" class="form-control" placeholder="IFTA Tax Amount Due">
									</div>
								</div>
								<div class="form-row mb-4">
									
									<div class="col">
										<label for="formGroupExampleInput">IFTA Tax Paid </label>
										<input type="checkbox" name="IFTATaxPaid" value="yes">
									</div>
								</div>
								<div class="form-row mb-4">
									
									<div class="col">
										<label for="formGroupExampleInput">IFTA Tax Payment Confirmed </label>
										<input type="checkbox" name="IFTATaxPayment" value="yes">
									</div>
								</div>
								
                               <div class="secondpage" style="display: none;">
								<div class="form-row mb-4 ">
									<div class="col">
										<strong>Form 2290-August 31st </strong>
										<br/>
										<label for="formGroupExampleInput">Form 2290 Filled Date </label>
										<input type="text" name="FilledDate" value="{{date('m/d/Y')}}" class="form-control datepicker"  placeholder="IFTA Filled Date">
									</div>
								</div>
								<div class="form-row mb-4">
									
									<div class="col">
										<label for="formGroupExampleInput">Form 2290 Acceptance Date </label>
										<input type="text" name="AcceptanceDate" value="{{date('m/d/Y')}}" class="form-control datepicker"  placeholder="IFTA Acceptance Date">
									</div>
								</div>
								
								
								<div class="form-row mb-4">
									
									<div class="col">
										<label for="formGroupExampleInput">Form 2290 Payment Made </label>
										<input type="checkbox" name="PaymentMode" value="yes">
									</div>
								</div>

								<div class="form-row mb-4">
									
									<div class="col">
										<label for="formGroupExampleInput">Form 2290 Payment Confirmed </label>
										<input type="checkbox" name="PaymentConformed" value="yes">
									</div>
								</div>
								<div class="form-row mb-4">
									
									<div class="col">
										<label for="formGroupExampleInput">Form 2290 Schedule 1 Uploaded </label>
										<input type="checkbox" name="FormSchedule" value="yes">
									</div>
								</div>
								</div>

								<input type="submit" name="txt" class="btn btn-primary">
							</form>
							
						</div>
					</div>
				</div>
				
			</div>
			
		</div>
<script type="text/javascript">

	function persion_ids(val)
	{
		
  // var person = $('#persion_id').find(":selected").val();
  if(val == 'Second Quarter IFTA-July 31th')
  {
    $('.secondpage').show(2000);
  }
}
</script>		

	
@endsection