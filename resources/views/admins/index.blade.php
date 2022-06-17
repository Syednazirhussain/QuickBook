@extends('layouts.admin')
@section('content') 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
	<div class="layout-px-spacing">
		
		<div class="row layout-top-spacing" id="cancel-row">
			
			<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
				<div class="widget-content widget-content-area br-12" style="">
					
					<a href="{{url('/addadmin')}}" class="mt-4 btn btn-primary" style="float: right;margin-bottom: 13px;">Add Admin</a>
					<div class="table-responsive mb-4 mt-4">
						<table id="zero-config" class="table table-hover" style="width:100%">
							<thead>
								<tr>
									<th>Id</th>
									<th>User Name</th>
									<th>Email</th>
									<th>Contact Number</th>
									<th>Action</th>
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
									
									<!-- <td>
										<a href="{{url('show-photo/'.$driver->id)}}" class="btn btn-primary"><i class="fas fa-image"></i></a>
										
										
									</td> -->
									<td> 
									    <form method="post" id="" action="" class="activy-form-btn" >
									          @csrf
									     <a href="{{url('admin/'.$driver->id.'/edit')}}" class="btn edit-same" ><i class="fas fa-edit"></i></a>
									     <a href="javascript:void(0)" class="btn deleterow delet-same" url="{{url('destroy')}}" id="{{$driver->id}}"><i class="fas fa-trash-alt"></i></a>
									 	</form>          
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


<script>

 ////////////DELETE ROW
 $('.deleterow').click(function(){
  var id = $(this).attr('id');
  var url = $(this).attr('url');
  var url = url+'/'+id;

  bootbox.confirm({
    message: "Do you want to Delete This Admin",
    buttons: {
      confirm: {
        label: 'Delete',
        className: 'btn-blue'
      },
      cancel: {
        label: 'Cancel',
        className: 'btn-blue btn-orange'
      }
    },
    callback: function (result) {
      if (result === true) {    

        location.href = url;
      }
    }
  });
}); 

	</script>
	
	
	
	
	
	
	
@endsection