@extends('layouts.admin')
@section('content') 
<style>



</style>
<div id="content" class="main-content">
	<div class="container">
		<div class="container">
			<div class="row layout-top-spacing">
				
				
				
				<div class="col-lg-9   layout-spacing">
					<div class="statbox widget box box-shadow">
						<div class="widget-header">                                
							<div class="row">
								<div class="col-xl-12 col-md-12 col-sm-12 col-12">
									<h4></h4>
								</div>
							</div>
						</div>
						<div class="widget-content widget-content-area">
							<form method="POST" action="{{url('/take-photo')}}">
								@csrf
								<div class="col-md-6">
									<div id="my_camera"></div>
									<br/>
									<center><input type=button value="Take Snapshot" onClick="take_snapshot()"></center>
									<hr>
									<input type="hidden" name="image" class="image-tag">
								</div>
								<div class="col-md-6">
									<div id="results">
									</div>
									<br/>
									<div class="form-group mb-4">
                                            <label for="formGroupExampleInput">Title</label>
                                            <input type="text" name="title" class="form-control" id="formGroupExampleInput" placeholder="Enter Title">
                                        </div>
									<div class="col-md-12 text-center">
										<br/>
										<button class="btn btn-success">Submit</button>
									</div>
								</div>
							</form>
							
							
						</div>
					</div>
				</div>
				
			</div>
			
		</div>
		
	</div>
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
	
	<script language="JavaScript">
		Webcam.set({
			width: 200,
			height: 200,
			image_format: 'jpeg',
			jpeg_quality: 90
		});
		
		Webcam.attach( '#my_camera' );
		
		function take_snapshot() {
			Webcam.snap( function(data_uri) {
				$(".image-tag").val(data_uri);
				document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
			} );
		}
	</script>
	
	
@endsection