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
							<form enctype="multipart/form-data" action="{{url('/EstimatePayment')}}" method="post">
								@csrf
								<div class="form-row mb-4">
									
									<div class="col">
										<h5>First Quarter-April 15th </h5>
										<br/>
										<label for="formGroupExampleInput">First Quarter Amount</label>
										<input type="text" name="Fistamount" class="form-control" placeholder="First Amount">
										<br/>
            					<label for="formGroupExampleInput">Payment Made</label>
										<input type="checkbox" value="yes" name="Fistpaymentmode" >
										<br/>
										<label for="formGroupExampleInput">Payment Confirmed</label>
										<input type="checkbox" value="yes" name="FistPayment" >
									</div>
								</div>
								<div class="form-row mb-4">
									
									<div class="col">
										<h5>Second Quarter-June 15th </h5>
										<br/>
										<label for="formGroupExampleInput">Second Quarter Amount </label>
										<input type="text" name="Secondamount" class="form-control" placeholder="Second Amount">
										<br/>
            					<label for="formGroupExampleInput">Payment Made</label>
										<input type="checkbox" value="yes" name="Secondpaymentmode" >
										<br/>
										<label for="formGroupExampleInput">Payment Confirmed</label>
										<input type="checkbox" value="yes" name="SecondPayment" >
									</div>
								</div>
								<div class="form-row mb-4">
									
									<div class="col">
										<h5>Third Quarter-Sept. 15th</h5>
										<br/>
										<label for="formGroupExampleInput">Third Quarter Amount</label>
										<input type="text" name="Thirdamount" class="form-control" placeholder="Third Amount">
										<br/>
            					<label for="formGroupExampleInput">Payment Made</label>
										<input type="checkbox" value="yes" name="Thirdpaymentmode" >
										<br/>
										<label for="formGroupExampleInput">Payment Confirmed</label>
										<input type="checkbox" value="yes" name="ThirdPayment">
									</div>
								</div>
								<div class="form-row mb-4">
									
									<div class="col">
										<h5>Fourth Quarter-Jan. 15th Subsequent Year</h5>
										<br/>
										<label for="formGroupExampleInput">Fourth Quarter Amount </label>
										<input type="text" name="Fourthamount" class="form-control" placeholder="Fourth Amount">
										<br/>
            					<label for="formGroupExampleInput">Payment Made</label>
										<input type="checkbox" value="yes" name="Fourthpaymentmode" >
										<br/>
										<label for="formGroupExampleInput">Payment Confirmed</label>
										<input type="checkbox" value="yes" name="FourthPayment" >
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