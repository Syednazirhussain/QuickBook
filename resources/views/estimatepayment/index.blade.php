@extends('layouts.admin')
@section('content') 


<style>
	#exampleModal123 .modal-body {
		border-bottom: 1px solid #dee2e6;
		margin-bottom: 20px;
	}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
	<div class="layout-px-spacing">
		
		<div class="row layout-top-spacing" id="cancel-row">
			
			<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
				
				<div class="widget-content widget-content-area br-12" style="">
					@if(Auth::user()->role_id == 2)
					<a href="javascript:void(0);" class="mt-4 btn btn-primary" data-toggle="modal" data-target="#exampleModal123" style="float: right;margin-bottom: 13px;">Estimate Payment Made</a>
					@endif
					<div class="table-responsive mb-4 mt-4">
						<table id="zero-config" class="table table-hover" style="width:100%">
							<thead>
								<tr>
									<th>Id</th>
									@if(Auth::user()->role_id == 2)
									<th>User Name</th>
									@endif
									<th>Quarter</th>
									<th>Amount</th>
									<th>Payment Confirmed</th>
									@if(Auth::user()->role_id == 2)
									<th>Action</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@php $i=1;  @endphp
								@foreach($EstimatePaymentModes as $EstimatePaymentMode)
								<tr>
									<td>{{ $i }}</td>
									@if(Auth::user()->role_id == 2)
									<td>{{ ucfirst($EstimatePaymentMode->first_name) }} {{ ucfirst($EstimatePaymentMode->last_name) }}</td>
									@endif
									<td>{{ $EstimatePaymentMode->quartertype }}</td>
									<td>{{ number_format($EstimatePaymentMode->amount,2) }}</td>
									<td><input type="checkbox" @if($EstimatePaymentMode->payment == 'yes') value="no" @else value="yes" @endif  id="paymentcheck" idval="{{$EstimatePaymentMode->id}}" {{$EstimatePaymentMode->payment == 'yes' ? 'checked':''}} name="payment"></td>
									@if(Auth::user()->role_id == 2)
									<td>
										<form method="post" id="delete_form_{{$EstimatePaymentMode->id}}" action="{{url('EstimatePayment/'.$EstimatePaymentMode->id)}}">

											@csrf
											@method('DELETE')
											<a href="{{url('EstimatePayment/'.$EstimatePaymentMode->id.'/edit')}}" class="btn edit-same" ><i class="fas fa-edit"></i></a>
											<button type="button" id="{{$EstimatePaymentMode->id}}" class="btn btn-sm btn-danger delete_debtcase" ><i class="fas fa-trash-alt"></i></button>

										</form>
									</td>
									@endif
								</tr>
								@php  $i++; @endphp
								@endforeach
							</tbody>
							
						</table>
					</div>
				</div>
			</div>
			
		</div>

		<!-- Estimate Payment Made Modal Add Start -->
		<div class="modal fade" id="exampleModal123" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Estimate Payment Made</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="widget-content widget-content-area">
							<form enctype="multipart/form-data" action="{{url('/EstimatePayment')}}" method="post">
								@csrf
								<div class="form-row mb-4">
									
									<div class="col">
										<label for="formGroupExampleInput">User Name</label>
										<select name="persion_id" class="form-control" id="exampleModalLabel">
											<option>Select</option>
											@foreach($users as $user)
											<option value="{{$user->id}}">{{ucfirst($user->first_name)}} {{$user->last_name}}</option>
											@endforeach
										</select>
										<br/>
										<label for="formGroupExampleInput">Quarter</label>
										<select name="quartertype" class="form-control" id="exampleModalLabel">
											<option>Select</option>
											<option value="First Quarter-April 15th">First Quarter-April 15th</option>
											<option value="Second Quarter-June 15th">Second Quarter-June 15th</option>
											<option value="Third Quarter-Sept. 15th">Third Quarter-Sept. 15th</option>
											<option value="Fourth Quarter-Jan. 15th Subsequent Year">Fourth Quarter-Jan. 15th Subsequent Year</option>
										</select>
										<br/>
										<label for="formGroupExampleInput">Amount</label>
										<input type="text" name="amount" class="form-control" placeholder="Amount">
										<br/>
										<label for="formGroupExampleInput">Payment Made</label>
										<input type="checkbox" value="yes" name="paymentmode" >
										<br/>
										<label for="formGroupExampleInput">Payment Confirmed</label>
										<input type="checkbox" value="yes" name="payment" >
									</div>
								</div>
							
						</div>
					</div>
					<div class="modal-footer">

						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Estimate Payment Made Modal End -->



		

	</div>
	<!--  END CONTENT AREA  -->
	<script>
		$(document).ready(function(){
			$('.delete_debtcase').click(function(){
				var id = $(this).attr('id');
				
				bootbox.confirm({
					message: "Are You Want To Delete This Estimate Payment",
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
						if (result == true) {
							
							$('#delete_form_'+id).submit();

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
	$('#paymentcheck').click(function(){
		var val = $(this).val();
		var id = $(this).attr('idval');

		 $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  }); 

  $.ajax({
    type: "post",
    url: "{{url('/Payment-Conformed-Update')}}",
    data:{val:val,id:id},
    success: function(res){
     if(res)
     {
      window. location. reload();
      	var session = "{{ Session::get('message') }}";
			if(session)
			{
				
				swal({
					title: session,
					type: 'success',
					padding: '2em'
				});
				
			}
    }
  }

});
	})

	</script>
	
	
	
	
	
	
	
	@endsection