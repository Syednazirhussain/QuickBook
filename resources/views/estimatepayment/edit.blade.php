@extends('layouts.admin')
@section('content') 
<div id="content" class="main-content">
	<div class="container">
		<div class="container">
			<div class="row layout-top-spacing">
				<div class="col-lg-9   layout-spacing">
					<div class="statbox widget box box-shadow">
						<div class="widget-header">                                
							<div class="row">
								<div class="col-xl-12 col-md-12 col-sm-12 col-12">
									<h4>Estimate Payment Made</h4>
								</div>
							</div>
						</div>
						<div class="widget-content widget-content-area">
							<form enctype="multipart/form-data" action="{{url('/EstimatePayment/'.$estimatePaymentMode->id)}}" method="post">
								@csrf
								@method('put')
								
								
								
								<div class="form-row mb-4">
									
									<div class="col">
										<label for="formGroupExampleInput">User Name</label>
										<select name="persion_id" class="form-control" id="exampleModalLabel">
											<option>Select</option>
											@foreach($users as $user)
											<option value="{{$user->id}}" {{$estimatePaymentMode->persion_id == $user->id ? 'selected':''}}>{{ucfirst($user->first_name)}} {{$user->last_name}}</option>
											@endforeach
										</select>
										<br/>
										<label for="formGroupExampleInput">Quarter</label>
										<select name="quartertype" class="form-control" id="exampleModalLabel">
											<option>Select</option>
											<option value="First Quarter-April 15th" {{$estimatePaymentMode->quartertype == 'First Quarter-April 15th' ? 'selected':''}}>First Quarter-April 15th</option>
											<option value="Second Quarter-June 15th" {{$estimatePaymentMode->quartertype == 'Second Quarter-June 15th' ? 'selected':''}}>Second Quarter-June 15th</option>
											<option value="Third Quarter-Sept. 15th" {{$estimatePaymentMode->quartertype == 'Third Quarter-Sept. 15th' ? 'selected':''}}>Third Quarter-Sept. 15th</option>
											<option value="Fourth Quarter-Jan. 15th Subsequent Year" {{$estimatePaymentMode->quartertype == 'Fourth Quarter-Jan. 15th Subsequent Year' ? 'selected':''}}>Fourth Quarter-Jan. 15th Subsequent Year</option>
										</select>
										<br/>
										<label for="formGroupExampleInput">Amount</label>
										<input type="text" name="amount" value="{{$estimatePaymentMode->amount}}" class="form-control" placeholder="Amount">
										<br/>
										<label for="formGroupExampleInput">Payment Made</label>
										<input type="checkbox" value="yes" {{$estimatePaymentMode->paymentmode =='yes' ? 'checked':''}} name="paymentmode" >
										<br/>
										<label for="formGroupExampleInput">Payment Confirmed</label>
										<input type="checkbox" value="yes" {{$estimatePaymentMode->payment =='yes' ? 'selected':''}} name="payment" >
									</div>
								</div>
								
								<input type="submit" name="txt" class="btn btn-primary">
							</form>
							
						</div>
					</div>
				</div>
				
			</div>
			
		</div>
		
	
	
	<script>
		var loadFile = function(event) {
			var output = document.getElementById('output');
			output.src = URL.createObjectURL(event.target.files[0]);
			output.onload = function() {
				URL.revokeObjectURL(output.src) // free memory
			}
		};
	</script>
	
@endsection