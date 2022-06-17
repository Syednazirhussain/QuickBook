@extends('layouts.admin')
@section('content') 
<link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/dt-global_style.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="row layout-top-spacing" id="cancel-row">
            
            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                
                <div class="widget-content widget-content-area br-6" style="width: 815px;">
                    <a href="{{url('reminder/create')}}" class="mt-4 btn btn-primary" style="float: right;margin-bottom: 13px;">Add Reminder</a>
                    <div class="table-responsive mb-4 mt-4">
                        <table id="zero-config" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1;  @endphp
                                @foreach($reminders as $reminder)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>
                                        @if($reminder->title){{ ucfirst($reminder->title)}}
                                        @else
                                        {{ ucfirst($reminder->repeats->titles)}}
                                        @endif
                                        
                                    </td>
                                    <td>
                                        @if($reminder->datepicker) {{ $reminder->datepicker}} 
                                        @else
                                        {{ $reminder->repeats->datepickers}}
                                        @endif
                                        
                                    </td>
                                    <td>
                                        <a href="{{url('reminder/'.$reminder->id.'/edit')}}" class="btn btn-primary"><i class="fas fa-pen-square"></i></a>
                                        
                                        <a href="javascript::void(0);" url="{{url('deleteReminders/'.$reminder->id)}}" id="{{$reminder->id}}" class="btn btn-danger delete"><i class="fas fa-trash"></i></a>
                                        
                                    </td>
                                </tr>
                                @php  $i++; @endphp
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div>
                
                
                
                <script>
                    $(document).ready(function(){
                    $('.delete').click(function(){
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
                    
                    location.href = url;
                    }
                    }
                    });
                    });
                    
                    
                    var session = "{{ Session::get('success') }}";
                    if(session)
                    {
                    
                    swal({
                    title:"{{ Session::get('success') }}",
                    padding: '2em'
                    });
                    
                    }
                    });
                </script>
                
            @endsection         