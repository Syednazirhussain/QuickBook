@extends('layouts.admin')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
::-webkit-scrollbar {
    width: 5px;
}
::-webkit-scrollbar-track {
    box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}

::-webkit-scrollbar-thumb {
    background-color: #ffa066;
}
.zero-tabel-outer {
    height: 559px;
    overflow-x: hidden;
    overflow-y: scroll;
}
.fc-day-grid-event {
    width: 30px;
    margin: -11px 0px 0px 0px !important;
}
.widget .widget-heading .tabs .dropdown .dropdown-menu
{
    top: 150px !important;
    min-width: auto !important;
}
.fc-left h2 {
    font-size: 18px !important;
}
#calendar {
    height: 500px;
}
.fc-scroller {
    height: 400px !important;
}
.dropeown-left-btn {
    background-color: #ead6da;
    margin: 0px 0px 10px 0px;
    padding: 10px;
    border-radius: 5px;
}
.dropeown-left-btn ul.tabs
{
    margin: 0px;
}
.dropeown-left-btn .dropdown-menu {
    transform: translate(0px, 0px) !important;
    top: inherit !important;
}

.dropeown-left-btn .dropdown {
    display: inline-block;
}
#dropdown1 .dropdown-menu
{
    min-width: 5rem;
}
#dropdown2 .dropdown-menu
{
    min-width: 4rem;
}


td.fc-day-top.fc-past {
    position: relative;
}
span.fc-day-number {
    position: absolute;
    top: 0;
    z-index: 9999;
    width: 100%;
    height: 150px;
}

#sidebar ul.menu-categories {
    padding: 0px 0 20px 0;
    min-height: 390px;
    height: 390px;
    overflow-y: scroll;
}

@media screen and (max-width: 767px) {

    .widget {
        padding: 0px;
    }
    .widget-content-area {
        padding: 0px;
    }

}

.scrollbar-thin {
    scrollbar-width: thin;
    height: 150px;
    overflow-y: scroll;
}

.cus-success-msg {
    font-size:16px;
    font-weight:700;
}


</style>

@if(isset($_REQUEST['y']))
@php $month = 'Full Year';
$showCount = 'year';  @endphp
@else
@php
$showCount = 'test';  @endphp
@endif

<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.2.0/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.2.0/main.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.css" rel="stylesheet"/>
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing" id="test">

        @if(session()->has('quickbook'))
            <div class="alert alert-success text-center mt-3 d-inline-block cus-success-msg" role="alert">
                {{ session()->get('quickbook') }}
            </div>
        @endif

        <div class="row layout-top-spacing">
 @if(Auth::user()->role_id == 2)
             <div class="col-xl-4 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget-one widget">
                            <div class="widget-content">
                                <div class="w-numeric-value">
                                    <div class="w-icon">
                                        <span class="iconify" data-icon="ph:users-three-thin"></span>
                                    </div>
                                    <div class="w-content">
                                        @if(Auth::user()->role_id == 1)
                                        <span class="w-value">{{$countadmin}}</span>
                                         <span class="w-numeric-title">Total Admins</span>
                                        @endif
                                        @if(Auth::user()->role_id == 2)
                                        <span class="w-value">{{$countuser}}</span>
                                         <span class="w-numeric-title">Total Users</span>
                                        @endif


                                    </div>
                                </div>
                                <div class="w-chart">
                                    <div id="total-orders"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(Auth::user()->role_id == 1)
             <div class="col-xl-4 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">
                        <div class="widget-one widget">
                            <div class="widget-content">
                                <div class="w-numeric-value">
                                    <div class="w-icon">
                                        <span class="iconify" data-icon="ph:users-three-thin"></span>
                                    </div>
                                    <div class="w-content">
                                        @if(Auth::user()->role_id == 1)
                                        <span class="w-value">{{$countadmin}}</span>
                                         <span class="w-numeric-title">Total Admins</span>
                                        @endif
                                        @if(Auth::user()->role_id == 2)
                                        <span class="w-value">{{$countuser}}</span>
                                         <span class="w-numeric-title">Total Users</span>
                                        @endif


                                    </div>
                                </div>
                                <div class="w-chart">
                                    <div id="total-orders"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif


            <div class="col-lg-12 col-md-12">


    @if(Auth::user()->role_id == 3)

                @if(count($nextreminders) > 0)


                <div class="alert alert-arrow-left alert-icon-left alert-light-warning  mb-4" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="iconify" data-icon="clarity:bell-solid"></span></button>
                    <svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    @foreach($nextreminders as $nextreminder)
                    {{$nextreminder->title}}    :    {{date('m/d/Y',strtotime($nextreminder->datepicker))}} <br>
                    @endforeach

                </div>
                @endif



                @if(count($nextrepeats) > 0)
                <div class="alert alert-arrow-left alert-icon-left alert-light-warning  mb-4" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="iconify" data-icon="clarity:bell-solid"></span></button>
                    <svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>

                    @foreach($nextrepeats as $nextrepeat)
                    {{$nextrepeat->title}}    :    {{date('m/d/Y',strtotime($nextrepeat->datepicker))}} <br>
                    @endforeach

                </div>
                @endif


                <ul class="tabs tab-pills button-right dropeown-left-btn">

                    <form action="{{url('dashboard?d=2021')}}" method="POST" id="testForm" >

                        <div class="dropdown" id="dropdown1">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">{{$month}}
                            </button>
                            <div class="dropdown-menu scrollbar-thin">
                                <a class="dropdown-item"  href="{{url('/dashboard/'.$mon.'/'.$year.'?y='.$year)}}">Full Year</a>
                                <a class="dropdown-item"  href="{{url('dashboard/01/'.$year)}}">January</a>
                                <a class="dropdown-item" href="{{url('dashboard/02/'.$year)}}">February</a>
                                <a class="dropdown-item" href="{{url('dashboard/03/'.$year)}}">March</a>
                                <a class="dropdown-item" href="{{url('dashboard/04/'.$year)}}">April</a>
                                <a class="dropdown-item" href="{{url('dashboard/05/'.$year)}}">May</a>
                                <a class="dropdown-item" href="{{url('dashboard/06/'.$year)}}">June</a>
                                <a class="dropdown-item" href="{{url('dashboard/07/'.$year)}}">July</a>
                                <a class="dropdown-item" href="{{url('dashboard/08/'.$year)}}">August</a>
                                <a class="dropdown-item" href="{{url('dashboard/09/'.$year)}}">September</a>
                                <a class="dropdown-item" href="{{url('dashboard/10/'.$year)}}">October</a>
                                <a class="dropdown-item" href="{{url('dashboard/11/'.$year)}}">November</a>
                                <a class="dropdown-item" href="{{url('dashboard/12/'.$year)}}">December</a>
                            </div>
                        </div>


                        <div class="dropdown" id="dropdown2" >
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">{{$year}}
                            </button>
                            <div class="dropdown-menu scrollbar-thin">
                                @for($i = 2010; $i <= date('Y'); $i++)

                                <a class="dropdown-item" href="{{url('dashboard/'.$mon.'/'.$i)}}">{{$i}}</a>
                                @endfor
                            </div>

                        </div>
@if(Session::has('cart'))
                        <a href="{{ url()->previous() }}" class="btn btn-danger" style="float: right;" >Back to admin</a>

                   @endif

                </ul>

            </div>


            <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-one">
                    <div class="widget-heading">
                        <h5 class="">Revenue</h5>
                        <ul class="tabs tab-pills">
                            <li><a href="javascript:void(0);" id="tb_1" class="tabmenu">Monthly</a></li>
                        </ul>
                    </div>

                    <div class="widget-content">
                        <div class="tabs tab-content">
                            <div id="content_1" class="tabcontent">
                                <div id="revenueMonthly"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-two">
                    <div class="widget-heading">
                        <h5 class="">Per Diem Tax Deduction</h5>
                    </ul>
                </div>
                <div class="widget-content">
                    <div id="chart-2"></div>
                </div>
            </div>
        </div>
        <div class="col-col-xl-12 col-lg-12">
            <div class="row">

                <div class="col-col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                    <div class="NumberPerDiem">
                        <div class="widget-three">
                            <div class="widget-heading">
                                <h5 class="">Number of Per Diem Days</h5>

                            </div>
                            <div class="widget-content">

                                <div class="order-summary">
                                    <div class="summary-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg>
                                        </div>
                                        <div class="w-summary-details">

                                            <div class="w-summary-info">
                                                <h6>Full Day</h6>
                                                <p class="summary-count">{{$fullDays}} Days</p>
                                            </div>

                                            <div class="w-summary-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar" style="width: {{$full}}%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="summary-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                                        </div>
                                        <div class="w-summary-details">

                                            <div class="w-summary-info">
                                                <h6>International</h6>
                                                <p class="summary-count">{{$internationals}} Days</p>
                                            </div>

                                            <div class="w-summary-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: {{$inter}}%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="summary-list">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                        </div>
                                        <div class="w-summary-details">

                                            <div class="w-summary-info">
                                                <h6>Half Days</h6>
                                                <p class="summary-count">{{$halfdays}} Days</p>
                                            </div>

                                            <div class="w-summary-stats">
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: {{$half}}%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                    <div class="widget-three">
                        <div class="widget-heading">
                            <h5 class="">Profit/Loss Overview</h5>
                        </div>
                        <div class="widget-content">

                            <div class="order-summary">

                                <div class="summary-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                                    </div>
                                    <div class="w-summary-details">

                                        <div class="w-summary-info">
                                            <h6>Income</h6>
                                            <p class="summary-count" id="overview-income">$92,600</p>
                                        </div>

                                        <div class="w-summary-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="summary-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                                    </div>
                                    <div class="w-summary-details">

                                        <div class="w-summary-info">
                                            <h6>Expenses</h6>
                                            <p class="summary-count" id="overview-expense">$55,085</p>
                                        </div>

                                        <div class="w-summary-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="summary-list">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg>
                                    </div>
                                    <div class="w-summary-details">

                                        <div class="w-summary-info">
                                            <h6>Profit</h6>
                                            <p class="summary-count" id="overview-profit">$37,515</p>
                                        </div>

                                        <div class="w-summary-stats">
                                            <div class="progress">
                                                <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>

                                    </div>

                                </div>



                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div  class="layout-px-spacing">
            <div class="row layout-top-spacing" id="cancel-row">
                <div class="col-xl-6 col-lg-12 col-md-12"  id="calId">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <div class="calendar-upper-section">
                                <div class="row">
                                    <div class="col-md-8 col-12">
                                        <div class="labels">

                                            <p class="label label-success">Full Day</p>
                                            <p class="label label-primary">International</p>
                                            <p class="label label-warning">Half Day</p>

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
                                            <h5 class="add-event-title modal-title addevent">Add Events</h5>

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
                                                                <div class="n-chk">
                                                                    <label class="new-control new-radio radio-warning">
                                                                        <input type="radio" class="new-control-input" name="title"  id="halfday" color="bg-warning" value="Half">
                                                                        <input type="hidden" class="new-control-input"  id="fullid">
                                                                        <span class="new-control-indicator"></span>Half Day
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

                                <div class="modal-footer deletebutton">

                                    <button id="discard" class="btn" data-dismiss="modal">Close</button>
                                    <button id="delete" class="btn" style=" display:none;" data-dismiss="modal">Delete</button>
                                    <button id="add-e"  class="btn btn-primary eventadd" data-dismiss="modal" >Add</button>
                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="col-xl-6 col-lg-6">

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                            <div class="widget widget-chart-one">
                                <div class="widget-heading">
                                    <h5 class="">Personal Reminders</h5>
                                    <ul class="tabs tab-pills">
                                        <li><a href="javascript:void(0);" id="tb_1" class="tabmenu " data-toggle="modal" data-target="#exampleModal">Add Reminder</a></li>
                                    </ul>
                                </div>

                                <div class="widget-content">
                                    <div class="tabs tab-content">
                                        <div id="content_1" class="tabcontent">
                                            <div class="table-responsive mb-4 mt-4">
                                                <div class="zero-tabel-outer">
                                                    <table id="zero-config" class="table table-hover" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Id</th>
                                                                <th>Title</th>
                                                                <th>Date</th>
                                                                <!--<th>Action</th>-->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $i=1;

                                                            @endphp




                                                            @foreach($reminders as $reminder)

                                                            @php $date = date('m/d/',strtotime($reminder->datepicker))   @endphp
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ ucfirst($reminder->title)}}</td>
                                                                <td>{{ $date.$year }}</td>


                                                            </tr>
                                                            @php  $i++; @endphp
                                                            @endforeach
                                                            @foreach($repeats as $repeat)
                                                            @php $repeatdate = date('m/d/',strtotime($repeat->datepicker))   @endphp
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ ucfirst($repeat->title)}}</td>
                                                                <td>{{ $repeatdate.$year }}</td>
                                                                <td></td>
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


                        </div>
@endif
                    </div>

                    <!-- Model Start-->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title"><b>Reminder</b></h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{url('addReminder')}}">
                                        @csrf
                                        <div class="form-group row">
                                            <label  class="col-sm-4 col-form-label">Title</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="title" name="title" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label  class="col-sm-4 col-form-label">Date</label>
                                            <div class="col-sm-6">
                                                <input id="datepicker" class="form-control datepicker" name="datepicker[]" value="{{date('m/d/Y')}}" type="text" placeholder="Select Date..">
                                            </div>
                                            <div class="col-sm-2">
                                                <i class="fas fa-plus-square fa-2x addMore" style="color: green;"></i>
                                            </div>
                                        </div>
                                        <div class="dateClone">


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
                    <!-- Modal End -->
                    <!-- Edit Modal Start-->
                    <!-- Model Start-->
                    <div class="modal fade" id="eidtexampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title"><b>Reminder</b></h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="edit-remender">

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="updateReminder">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal End -->
                    <!-- Edit Modal End-->

                    <!-- FOR SHOW MODAL -->
                    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Medical Card Exam</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <div class="form-group row">
                            <label  class="col-sm-4 col-form-label">Date</label>
                            <div class="col-sm-6">
                                <input id="Medical_Card" class="form-control datepicker"  value="{{date('m/d/Y')}}" type="text" placeholder="Select Date..">
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="modical" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
   $remcount ="<?php echo $rem; ?>";

   var eventsArray = [];
   $(document).ready(function(){




    uploadData();
    showFullcalender();
    $('.datepicker').datepicker({
        autoclose: true,
        todayHighlight: true,
        dateFormat: 'yyyy-mm-dd'
    });



    if($remcount == 0)
    {
      $('#exampleModal2').modal('toggle');

   }


   $('#modical').on('click',function(event){

   event.preventDefault();
   // Get Alll Text Box Id's
   var Medical_Card = $("#Medical_Card").val();
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
   });

   $.ajax({
    url: "{{url('/AddMedicalcard')}}", //Define Post URL
    type:"POST",
    data:{Medical_Card:Medical_Card},
    success:function(res){
        if(res.id)
        {
            $('#exampleModal2').modal('hide');
        }

    }
   });
   });
   });

   /////////for upload data in chart

   function uploadData()
   {
   var month = "{{$mon}}";
   var year = "{{$year}}";
   var showCount = "{{$showCount}}";

   $.ajaxSetup({
   headers: {
   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   }
   });
   $.ajax({
            url: "{{url('/showEvent')}}", //Define Post URL
            type:"get",
            data:{month:month,year:year,showCount:showCount},
            success:function(res){



            }
        });

   var url = "{{url('/showEvent')}}";

   $.getJSON(url,{month:month,year:year,showCount:showCount}, function(response) {


   chart.updateSeries(response);
   });

   }

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
                            $('.addevent').html('Update Event');
                            $('.eventadd').html('Update');
                            $('#delete').removeAttr("style");

                        }
                        if(res.title == 'Full')
                        {
                            $("#fullday").attr('checked', 'checked');
                            $("#fullid").val(res.id);
                            $('.addevent').html('Update Event');
                            $('.eventadd').html('Update');
                            $('#delete').removeAttr("style");

                        }
                        if(res.title == 'Inte..')
                        {
                            $("#inter").attr('checked', 'checked');
                            $("#fullid").val(res.id);
                            $('.addevent').html('Update Event');
                            $('.eventadd').html('Update');
                            $('#delete').removeAttr("style");


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
                            eventsArray.push({
                                title: title,
                                start: start,
                                className: color

                            });

                            uploadData();
                            showFullcalender();
                            calendar.refetchEvents();
                            $("#form_id").load(location.href + " #form_id");
                            $(".NumberPerDiem").load(location.href + " .NumberPerDiem");

                        }
                    });
                });
               ////////// DELETE EVENT

               $('#delete').on('click',function(event){
                  $('#addEventsModal').modal('hide');
                event.preventDefault();
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

                         var event_id = $('#fullid').val();
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

                            uploadData();
                            calendar.refetchEvents();
                             $("#form_id").load(location.href + " #form_id");
                            $(".NumberPerDiem").load(location.href + " .NumberPerDiem");

                        }
                    });
                     }
                 }
             });
            });






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


   /////////////////ADD REMINDER
   $('#reminder').on('click',function(event){

   event.preventDefault();
        // Get Alll Text Box Id's
        var title = $("#title").val();
        var datepicker = $("#datepicker").val();
        var repeat = $("#repeat option:selected").val();;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{url('/addReminder')}}", //Define Post URL
            type:"POST",
            data:{title:title,datepicker:datepicker,repeat:repeat},
            success:function(res){
                window.location.reload();
                $('#exampleModal').modal('hide');

            }
        });
    });
    /////////////////EDIT REMINDER
    function editRemender(val){
        var id = val;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{url('/eidtReminder')}}", //Define Post URL
            type:"GET",
            data:{id:id},
            success:function(res){
                var datepicker = moment(res.datepicker).format('MM/DD/YYYY');

                $('.edit-remender').html('<div class="form-group row">'+
                    '<label  class="col-sm-4 col-form-label">Title</label>'+
                    '<div class="col-sm-8">'+
                    '<input type="text" id="title1" name="title" value="'+res.title+'" class="form-control">'+
                    '<input type="hidden" id="id" value="'+res.id+'" class="form-control">'+
                    '</div>'+
                    '</div>'+
                    '<div class="form-group row">'+
                    '<label  class="col-sm-4 col-form-label">Date</label>'+
                    '<div class="col-sm-8">'+
                    '<input id="datepicker1" class="form-control datepicker1" type="text" value="'+datepicker+'" placeholder="Select Date..">'+
                    '</div>'+
                    '</div>'+
                    '</div>');
                $('.datepicker1').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    dateFormat: 'yyyy-mm-dd'
                });

                $('#repeats option[value="'+res.repeat+'"]').prop('selected', true);
                $('#eidtexampleModal').modal('show');

            }
        });
    }
    //////////Update Reminder
    $('#updateReminder').on('click',function(event){

        event.preventDefault();
        // Get Alll Text Box Id's
        var id = $("#id").val();
        var title = $("#title1").val();
        var datepicker = $("#datepicker1").val();
        var repeat = $("#repeats").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{url('/updateReminder')}}", //Define Post URL
            type:"POST",
            data:{id:id,title:title,datepicker:datepicker,repeat:repeat},
            success:function(res){
                window.location.reload();
                $('#exampleModal').modal('hide');

            }
        });
    });
    ///////////Delete Remender
    function deleteRemender(id){
        var id = id;
        var url =$('.deleteRemender').attr('deleteurl');

        bootbox.confirm({
            message: "Are You Want To Delete This Row",
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

                    location.href = url;
                    window.location.reload();
                }
            }
        });
    }




    /////////////////addEvent
    $('.addMore').click(function(){
        $('.dateClone').append('<div class="form-group row remDiv">'+
            '<label class="col-sm-4 col-form-label">Date</label>'+
            '<div class="col-sm-6">'+
            '<input id="datepicker" class="form-control datepicker" name="datepicker[]" value="{{date('m/d/Y')}}" type="text" placeholder="Select Date..">'+
            '</div>'+
            '<div class="col-sm-2">'+
            '<i class="fas fa-minus fa-2x remove" style="color: red;"></i>'+
            '</div>'+
            '</div>');


        $('.remove').click(function() {
            $(this).closest('.remDiv').remove();
        });
        $('.datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            dateFormat: 'yyyy-mm-dd'
        });

    });



    $('.dropdown-menu').on('change', function() {
        e.preventDefault();
        $("#testForm").submit();
    });

</script>

@endsection

@push('quickbook_script')

<script type="text/javascript">
    // Optionally provide a date for the starting month
function getMonthNames(date = new Date()) {
  // Copy input date so don't modify it
  let d = new Date(+date);
  // Set to 1st of month
  d.setDate(1);
  let result = [];
  // Get 12 month names, starting with current month
  for (let i=0; i<12; i++) {
    result.push(d.toLocaleString('default',{month:'short'}));
    d.setMonth(d.getMonth() + 1);
  }
  return result;
}


    // let x = [15000, 12000, 15000, 12000, 15000, 12000, 15000, 12000, 15000, 12000, 15000, 12000]
    let incomeArray = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
    let expenseArray = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
    var url = window.location.href

    var segments = url.split( '/' );
    var month = segments[4];
    var year = segments[5];
    var segment = year.split( '?' );
    year = segment[0];
    var full_year = segment[1]
    var  $query = full_year ? "?"+full_year : '?month='+month+'&year='+year

    $.ajax({
        url: "{{ route('graph_tax') }}"+$query,
        type: "GET",
        headers: { "Accept": "application/json" },
        beforeSend: function () {
        },
    }).done(function (response) {

        var data = JSON.parse(JSON.stringify(response.Rows.Row))
        var ColumnData = [];
        var TotalIncome = 0;
        var TotalInc = null;
        data.forEach(iter1 => {
           if(['COGS','GrossProfit'].includes(iter1.group)){
               ColumnData = JSON.parse(JSON.stringify(iter1.Summary.ColData));
               ColumnData.splice(0,1);
               ColumnData.pop();
               ColumnData.forEach((element,index) => {
                   incomeArray[index] += parseFloat(element.value);
               });
            }
            if(["Expenses","OtherExpenses"].includes(iter1.group)){
                ColumnData = JSON.parse(JSON.stringify(iter1.Summary.ColData));
                ColumnData.splice(0,1);
                ColumnData.pop();
                ColumnData.forEach((element,index) => {
                    expenseArray[index] += parseFloat(element.value);
                });
            }
            if(["NetIncome"].includes(iter1.group)){
                ColumnData = JSON.parse(JSON.stringify(iter1.Summary.ColData));
                // ColumnData.splice(0,5);
                ColumnData.forEach((element,index) => {
                    TotalIncome = parseFloat(element.value);
                });
            }
        });
        expenseArray =expenseArray.map((res=>{
            return res = res.toFixed(2);
        }))
        incomeArray =incomeArray.map((res=>{
            return res = res.toFixed(2);
        }))
        var totalSum =  incomeArray.reduce((partialSum, a) => partialSum + parseFloat(a), 0);
        $('#overview-expense').text("$"+(totalSum - TotalIncome).toFixed(2));
        $('#overview-income').text("$"+totalSum);
        $('#overview-profit').text("$"+TotalIncome);
        var label = []
        if(full_year ==  undefined){
            var date_range =  year+"-"+month+"-01";
            date_range = new Date(date_range);
            label =getMonthNames(date_range);
        }
        renderchart(TotalIncome,incomeArray,expenseArray,label);

    }).catch(function (error) {
        // if(error.status == 400){
        //     window.location.href = error.responseJSON.redirect_url
        //     return null
        // }

        $.ajax({
            url: "{{ route('token_refresh') }}",
            type: "GET",
            headers: { "Accept": "application/json" }
        }).done(function (response) {
            if (response.error == 0) {
                alertify.success(response.message)

                setTimeout(() => {
                    window.location.reload()
                }, 2000);
            }
        }).catch(function (error) {
            if (response.error == 1) {
                alertify.error(response.message)
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        })

        if (error.statusText == 'Unauthorized' && 1==2) {

            alertify.confirm('Quickbook Session', 'Quickbook session has expired. Do you want to re-generate.?',
                function() {

                    $.ajax({
                        url: "{{ route('token_refresh') }}",
                        type: "GET",
                        headers: { "Accept": "application/json" }
                    }).done(function (response) {
                        if (response.error == 0) {
                            alertify.success(response.message)

                            setTimeout(() => {
                                window.location.reload()
                            }, 2000);
                        }
                    }).catch(function (error) {
                        if (response.error == 1) {
                            alertify.error(response.message)
                        }
                    })
                },
                function() {
                    // alertify.error('Cancel')
                }
            );
        }
    })

</script>

@endpush
