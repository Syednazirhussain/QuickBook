@extends('layouts.admin')
@section('content') 
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.2.0/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.2.0/main.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing" id="cancel-row">

            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

             <div class="col-xl-12 col-lg-12 col-md-12"  id="calId">
                <div class="statbox widget box box-shadow">
                    <div class="widget-content widget-content-area">
                        <div class="calendar-upper-section">
                            <div class="row">
                                <div class="col-md-8 col-12">
                                    <div class="labels">
                                        <p class="label label-warning">Half Day</p>
                                        <p class="label label-success">Full Day</p>
                                        <p class="label label-primary">International</p>

                                    </div>
                                </div>                                                
                                <div class="col-md-4 col-12">
                                    <form  class="form-horizontal mt-md-0 mt-3 text-md-right text-center" style="display: none;">
                                        <button id="myBtn" class="btn btn-primary"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- The Modal -->
                <div id="addEventsModal" class="modal animated fadeIn" >

                    <div class="modal-dialog modal-dialog-centered" id="form_id">

                        <!-- Modal content -->
                        <div class="modal-content">

                            <div class="modal-body">

                                <span class="close">&nbsp;</span>

                                <div class="add-edit-event-box">
                                    <div class="add-edit-event-content">
                                        <h5 class="add-event-title modal-title">Add Events</h5>

                                        <form id="EventForm"   action="{{url('/addevent')}}" method="post">
                                            @csrf

                                            <div class="col-md-6 col-sm-6 col-12">
                                                <div class="form-group ">
                                                    <label for="" class="">Date:</label>
                                                    <div class="d-flex">
                                                        <input id="start_date" name="start_date" placeholder="Start Date" class="form-control" type="text">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="event-badge">
                                                        <p class="">Badge:</p>

                                                        <div class="d-sm-flex d-block">
                                                            <div class="n-chk">
                                                                <label class="new-control new-radio radio-warning">
                                                                  <input type="radio" class="new-control-input" name="title"  id="halfday" color="bg-warning" value="Half">
                                                                  <input type="hidden" class="new-control-input"  id="fullid">
                                                                  <span class="new-control-indicator"></span>Half Day
                                                              </label>
                                                          </div>

                                                          <div class="n-chk">
                                                            <label class="new-control new-radio radio-success">
                                                              <input type="radio" class="new-control-input add-event-title" color="bg-success" name="title" id="fullday" value="Full">
                                                              <span class="new-control-indicator"></span>Full Day
                                                          </label>
                                                      </div>

                                                      <div class="n-chk">
                                                        <label class="new-control new-radio radio-primary">
                                                          <input type="radio" color="bg-primary" class="new-control-input add-event-title" name="title" id="inter" value="Inte..">
                                                          <span class="new-control-indicator"></span>International
                                                      </label>
                                                  </div>

                                              </div>

                                          </div>
                                      </div>
                                  </div>

                              </form>
                          </div>
                      </div>

                  </div>

                  <div class="modal-footer">
                    <button id="discard" class="btn" data-dismiss="modal">Discard</button>
                    <button id="add-e"  class="btn btn-primary" data-dismiss="modal">Add</button>
                </div>

            </div>

        </div>

    </div>

    

<script type="text/javascript">
        $(document).ready(function(){

            showFullcalender();
        });
        function showFullcalender()
        {

           return   "{{url('/showFullcalender')}}";       

       }

    //////////FOR FULL CALENDER
    
    document.addEventListener('DOMContentLoaded', function() {

        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            height: 600,
            defaultDate: new Date(<?php echo $year; ?>,<?php echo $mon; ?>,0),
            plugins: [ 'dayGrid', 'interaction' ],
            showNonCurrentDates: false,
           eventLimit: true, // for all non-TimeGrid views
           nextDayThreshold: "00:00:00",
           views: {
            timeGrid: {
      eventLimit: 1 // adjust to 6 only for timeGridWeek/timeGridDay
  }
},
eventClick: function(info) {


    bootbox.confirm({
        message: "Are You Want To Delete This Event",
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

             var event_id = info.event.id;
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

             $.ajax({
                                url: "{{url('/deleteEvent')}}", //Define Post URL
                                type:"get",
                                data:{event_id:event_id},
                                success:function(res){
                                    showFullcalender();

                                    calendar.refetchEvents();   
                                    $(".NumberPerDiem").load(location.href + " .NumberPerDiem");         

                                }
                            }); 
         }
     }
 });

},
dateClick: function(info) {

    var date = info.dateStr
    var start_date = info.dateStr

    $('#start_date').val(date);
                        /////////////////////////// 
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        
                        $.ajax({
                            url: "{{url('/check-date')}}", //Define Post URL
                            type:"POST",
                            data:{start_date:start_date},

                            success:function(res){

                                $('#start_date').val(date);
                                if(res.title == 'Half')
                                {

                                    $("#halfday").attr('checked', 'checked');
                                    $("#fullid").val(res.id);
                                    // $('#editEventsModal').modal('show');
                                }
                                if(res.title == 'Full')
                                {
                                    $("#fullday").attr('checked', 'checked');
                                    $("#fullid").val(res.id);
                                    // $('#editEventsModal').modal('show');
                                }
                                if(res.title == 'Inte..')
                                {
                                    $("#inter").attr('checked', 'checked');
                                    $("#fullid").val(res.id);
                                    
                                }
                                if(res.daytype == '')
                                {
                                    $("#fullid").val('');
                                    
                                }
                                
                                $('#addEventsModal').modal('show'); 
                                
                            }
                            
                        });
                        
                        
                        
                        ////////////////////////////
                        
                        
                        
                        
                        $('#add-e').on('click',function(event){

                            event.preventDefault();


                            var title = $("input[name='title']:checked").val();
                            var color = $("input[name='title']:checked").attr('color');
                            var start = $("#start_date").val();
                            var fullid = $("#fullid").val();
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            
                            $.ajax({
                                url: "{{url('/addevent')}}", //Define Post URL
                                type:"POST",
                                data:{title:title,start:start,color:color,fullid:fullid},
                                success:function(res){
                                 
                                    showFullcalender();
                                    calendar.refetchEvents();
                                    $("#form_id").load(location.href + " #form_id");         
                                    $(".NumberPerDiem").load(location.href + " .NumberPerDiem");         

                                }
                            });
                        });
                       ////////// 




                   },


                   events: showFullcalender()


               });



$('#edit-event').off('click').on('click', function(event) {

                 // Get Alll Text Box Id's
                 var title = $("input[name='titleedit']:checked").val();
                 var color = $("input[name='titleedit']:checked").attr('color');
                 var start = $("#start_dateedit").val();
                 var fullid = $("#fullid").val();
                 $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                 $.ajax({
                                url: "{{url('/updateFullcalender')}}", //Define Post URL
                                type:"POST",
                                data:{title:title,start:start,color:color,fullid:fullid},
                                success:function(res){
                                   alert(res);

                                   uploadData();
                                   $('#calendar').fullCalendar('updateEvent', res);

                                   $(".NumberPerDiem").load(location.href + " .NumberPerDiem");         

                               }
                           });



             });

calendar.render();



});

</script>

@endsection