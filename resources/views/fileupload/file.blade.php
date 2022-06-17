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
									<h4>File Upload</h4>
								</div>
							</div>
						</div>
						<div class="widget-content widget-content-area">
							<form enctype="multipart/form-data" action="{{url('imagesave')}}" method="post" >
								@csrf
								
								
								<div class="form-group row">
									<label for="image" class="col-sm-4 col-form-label">Upload image</label>
									<div class="col-sm-8">
										<input type="file" accept="image/*" id="image" name="image" class="form-control" onchange="loadFile(event)">
										<img id="output"/ width="70px" style="margin-top: 10px;">
									</div>
								</div>
								
								<div class="form-group row">
									<label for="image" class="col-sm-4 col-form-label">Add Note</label>
									<div class="col-sm-8">
										<textarea id="t-text" name="title" placeholder="Add Some Note Here...." class="form-control" required></textarea>
									</div>
									<input type="submit" name="txt" class="mt-4 btn btn-primary" style="margin-left:130px;">
								</div>
								
								
								
							</div>
						</div>
					</form>
					
					
				</div>
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