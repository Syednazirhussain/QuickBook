@extends('layouts.admin')
@section('content') 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
	<div class="layout-px-spacing">
		<div class="row layout-top-spacing" id="cancel-row">
			<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
				<div class="widget-content widget-content-area br-12" style="">
					<a href="{{url('/adduser')}}" class="mt-4 btn btn-primary" style="float: right;margin-bottom: 13px;">Add User</a>
					<div class="table-responsive mb-4 mt-4">
						<table id="zero-config" class="table table-hover" style="width:100%">
							<thead>
								<tr>
									<th>Id</th>
									<th>User Name</th>
									<th>Email</th>
									<th>Contact Number</th>
									<th>Bypass Login </th>
									<th>Photo</th>
								</tr>
							</thead>
							<tbody>
								@php $i=1;  @endphp
								@foreach($users as $driver)
								<tr>
									<td>{{ $i }}</td>
									<td>{{ ucfirst($driver->first_name).' '.ucfirst($driver->last_name)}}</td>
									<td>{{ $driver->email}}</td>
									<td>{{ $driver->mobile_no}}</td>
									<td>
									<form method="post" action="{{url('bypasslogin')}}" >
										@csrf
										<input name="email" value="{{ $driver->email}}" type="hidden" >
										<button type="submit" class="btn btn-danger">Login</button>
									</form>
									</td>
									<td>
									<a href="{{url('show-photo/'.$driver->id)}}" class="btn btn-primary"><i class="fas fa-image"></i></a>
									</td>
								</tr>
								@php  $i++; @endphp
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	<!--  END CONTENT AREA  -->
	<script>
		$(document).ready(function(){
			$('.delete').click(function(){
				var id = $(this).attr('id');
				var url = $(this).attr('url');
				
				bootbox.confirm({
					message: "Are You Want To Delete This User",
					buttons: {
						confirm: {
							label: 'Confirm',
							className: 'btn-success'
						},
						cancel: {
							label: 'Cancel',
							className: 'btn-danger'
						}
					},
					callback: function (result) {
						if (result === true) {
							
							location.href = url;
						}
					}
				});
			});
			
			var session = "{{ Session::get('message') }}";
			if(session)
			{
				
				swal({
					  title: session,
                      type: 'success',
                      padding: '2em'
				});
				
			}
		});
		
	</script>
@endsection