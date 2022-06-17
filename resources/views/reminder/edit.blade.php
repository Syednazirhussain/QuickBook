@extends('layouts.admin')
@section('content') 
<style type="text/css">
    .date-btn
    {
        justify-content: flex-end;
    }
</style>
<div id="content" class="main-content">
    <div class="container">
        <div class="container">
            <div class="row layout-top-spacing">
                
                <div id="fuSingleFile" class="col-lg-8 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Reminder</h4>
                                    
                                </div>      
                            </div>
                        </div>
                        
                        <form enctype="multipart/form-data" id="formId" action="{{url('reminder/update/'.$reminder->id)}}" method="post" >
                            @csrf
                            
                            
                            <div class="form-group row">
                                <label for="image" class="col-sm-4 col-form-label">Title</label>
                                <div class="col-sm-8">
                                    <input type="text" id="title" value="{{$reminder->title}}" name="title" class="form-control">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label  class="col-sm-4 col-form-label">Date</label>
                                <div class="col-sm-6">
                                    <input id="datepicker" class="form-control datepicker" name="datepicker[]" value="{{date('m/d/Y',strtotime($reminder->datepicker))}}" type="text" placeholder="Select Date..">
                                </div>
                                <div class="col-sm-2">
                                   <i class="fas fa-plus-square fa-2x addMore" style="color: green;"></i>
                                </div>
                            </div>
                            @foreach($repeats as $repeat)
                            <div class="form-group row">
                                <label for="image" class="col-sm-4 col-form-label">Title</label>
                                <div class="col-sm-8">
                                    <input type="text" id="title" value="{{$repeat->title}}" name="title" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-4 col-form-label">Date</label>
                                <div class="col-sm-6">
                                    <input id="datepicker" class="form-control datepicker" name="datepicker[]" value="{{date('m/d/Y',strtotime($repeat->datepicker))}}" type="text" placeholder="Select Date..">
                                </div>
                                <div class="col-sm-2">
                                   <i class="fas fa-minus fa-2x removes" url="{{url('deleteRepeat/'.$repeat->id)}}" style="color: red;"></i>
                                </div>
                            </div>
                            @endforeach
                            <div class="dateClone">
                                
                                
                            </div>
                            
                            <div class="form-group row date-btn">
                                <input type="submit" name="txt" class="mt-4 btn btn-primary" style="margin-left:130px;">
                            </div>
                               </form>
                        </div>
                    </div>
             
         
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$('.addMore').click(function(){
       $('.dateClone').append('<div class="form-group row remDiv">'+
        '<label class="col-sm-4 col-form-label">Date</label>'+
             '<div class="col-sm-6">'+
                '<input id="datepicker" class="form-control datepicker" name="datepicker[]" value="{{date('m/d/Y')}}" type="text" placeholder="Select Date..">'+
             '</div>'+
             '<div class="col-sm-2">'+
                ' <i class="fas fa-minus fa-2x remove" style="color: red;"></i>'+
             '</div>'+
             '</div>');


    $('.remove').click(function() {
    $(this).closest('.remDiv').remove();
       });
           $('.datepicker').datepicker({
      autoclose: true,
       todayHighlight: true,
        dateFormat: 'mm/dd/yyyy'
    });

    });
 $(document).ready(function(){
    $('.datepicker').datepicker({
      autoclose: true,
       todayHighlight: true,
        dateFormat: 'mm/dd/yyyy'
    });


    $('.removes').click(function(){
                var url = $(this).attr('url');
                
            bootbox.confirm({
    message: "Are You Want To Delete This Reminder",
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
            window.location.href = url;
           // location.reload();
           // $("#formId").load(location.href + " #formId");
        }
    }
});
});    
 })

</script>
@endsection