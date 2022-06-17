@extends('layouts.admin')
@section('content') 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
	<div class="layout-px-spacing">
		
		<div class="row layout-top-spacing" id="cancel-row">
			
			<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
				
				<div class="widget-content widget-content-area br-12" style="">
					@if(Auth::user()->role_id == 2)
					<a href="{{url('/ExciseTax/create')}}" class="mt-4 btn btn-primary" style="float: right;margin-bottom: 13px;">Excise Taxes</a>
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
									<th>IFTA Tax Amount Due </th>
									<th>IFTA Tax Payment Confirmed</th>
									@if(Auth::user()->role_id == 2)
									<th>Action</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@php $i=1;  @endphp
								@foreach($excisetaxs as $excisetax)
								<tr>
									<td>{{ $i }}</td>
									@if(Auth::user()->role_id == 2)
									<td>{{ ucfirst($excisetax->first_name) }} {{ $excisetax->last_name }}</td>
									@endif
									<td>{{ $excisetax->quarter }}</td>
									<td>{{ number_format($excisetax->IFTATaxDue,2) }}</td>
									<td><input type="checkbox" @if($excisetax->IFTATaxPayment == 'yes') value="no" @else value="yes" @endif  id="paymentcheck" idval="{{$excisetax->id}}" {{$excisetax->IFTATaxPayment == 'yes' ? 'checked':''}} name="IFTATaxPayment"></td>
									@if(Auth::user()->role_id == 2)
									<td>
 											<form method="post" id="delete_form_{{$excisetax->id}}" action="{{url('ExciseTax/'.$excisetax->id)}}">
 												@csrf
 												@method('DELETE')
 												<a href="{{url('ExciseTax/'.$excisetax->id.'/edit')}}" class="btn edit-same" ><i class="fas fa-edit"></i></a>
									     <button type="button" id="{{$excisetax->id}}" class="btn btn-sm btn-danger delete_debtcase" ><i class="fas fa-trash-alt"></i></button>
 												
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
		
        
	</div>
	<!--  END CONTENT AREA  -->
	<script>
		$(document).ready(function(){
			$('.delete_debtcase').click(function(){
				var id = $(this).attr('id');
				var url = $(this).attr('url');
				
				bootbox.confirm({
					message: "Are You Want To Delete This Excise Tax",
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
    url: "{{url('/Ifta-Payment-Conformed-Update')}}",
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