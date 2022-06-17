@extends('layouts.admin')
@section('content') 
	<style>
.card.component-card_2 {
    width: 100%;
}
div#card_2 {
    margin-top: 100px;
}
.card.component-card_2 .box-images {
    margin: 10px;
    background-color: #fff;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0px 0px 10px #e4e4e4;
}
</style>



<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing" id="cancel-row">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
					
                        <div class="widget-content widget-content-area br-6">
						<a href="{{url('upload-file')}}" class="btn btn-primary" style="float: right;margin-bottom: 13px;"><span class="iconify" data-icon="foundation:upload"></span> UPLOAD PHOTO</a>
						
						<a href="{{url('/take-photo')}}" class="btn btn-dark" style="float: right;margin-right: 12px;"><span class="iconify" data-icon="ant-design:camera-outlined"> </span> TAKE PHOTO</a>
						
                            
							<div id="card_2" class="col-sm-12 layout-spacing">
                            
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            
                                        </div>
                                    </div>
                                </div>
                                
                                 
                                    <div class="card component-card_2">
									<div class="row">
									 @foreach($photos as $pic)
									 
									 <div class="col-sm-4">
									 <div class="box-images">
                                        <img src="{{asset('images/'.$pic->picture)}}" class="card-img-top" alt="widget-card-2" style="height: 217px;">
                                        <div class="card-body">
                                            <h5 class="card-title">Title :{{$pic->title}}</h5>
                                            <h5 class="card-title">Date : {{date('Y-m-d',strtotime($pic->created_at))}}</h5>
                                            
                                        </div>
										</div>
										</div>
									
										@endforeach
                                    </div>
									</div>
									
									

                             
                            
                        </div>
							
                        </div>
                    </div>

 </div>

                </div>
        
	
		
		<script>
		$(document).ready(function(){
			$('.delete').click(function(){
				var id = $(this).attr('id');
				var url = $(this).attr('url');
				
			bootbox.confirm({
    message: "Are You Want To Delete This File",
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
      title:"{{ Session::get('message') }}",
      padding: '2em'
    });
 
		}
});
		</script>
		
		@endsection