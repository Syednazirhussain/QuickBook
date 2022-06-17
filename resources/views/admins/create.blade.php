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
                                            <h4>Admin Details</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content widget-content-area">
                                    <form enctype="multipart/form-data" action="{{url('/storeadmin')}}" method="post">
									@csrf
									<div class="form-row mb-4">
									 
                                            <div class="col">
											<label for="formGroupExampleInput">Enter Fist Name </label>
                                              <input type="text" name="first_name" class="form-control" placeholder="First name">
                                            </div>
                                            <div class="col"><label for="formGroupExampleInput">Enter Last name</label>
                                              <input type="text" name="last_name" class="form-control" placeholder="Last name">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mb-4">
                                            <label for="formGroupExampleInput">Email</label>
                                            <input type="text" name="email" class="form-control" id="formGroupExampleInput" placeholder="Enter Email">
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="formGroupExampleInput2">Contact NUmber</label>
                                            <input type="number" class="form-control"  name="mobile_no" id="formGroupExampleInput2" placeholder="Enter Contact number">
                                        </div>
                                        <input type="submit" name="txt" class="btn btn-primary">
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