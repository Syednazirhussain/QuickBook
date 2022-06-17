 <!--  BEGIN MAIN CONTAINER  -->
 <style type="text/css">
     .sidebar-wrapper .profile-info .user-info {
    text-align: center;
    padding: 50px 0 0 0;
    height: auto;
}
#sidebar ul.menu-categories {
    padding: 0px 0 20px 0;
}

@php 
$m = date('m');
@endphp
@php 
$y = date('Y');
@endphp
 </style>
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">
            
            <nav id="sidebar">
                <div class="profile-info">
                    <figure class="user-cover-image"></figure>
                    <div class="user-info">
                        <img src="{{asset('images/demo.jpg')}}" alt="avatar">
                        <h6 class="">
                            <a href="{{url('/user-profile')}}" aria-expanded="false" class="dropdown-toggle">
							{{ Auth::user()->first_name}} {{ Auth::user()->last_name}}
							</a>
							</h6>
                       
                    </div>
                </div>
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    
                     <li class="menu">
                        <a href="{{url('/dashboard/'.$m.'/'.$y)}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                               <span class="iconify" data-icon="carbon:home"></span>
                                <span>Dashboard</span>
                            </div>
                        </a>
                    </li>
                    @if(Auth::user()->role_id == 1)
                     <li class="menu">
                        <a href="{{url('/admins')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span class="iconify" data-icon="carbon:user-multiple"></span>
                                <span>Admins</span>
                            </div>
                        </a>
                    </li>
                @endif
             @if(Auth::user()->role_id == 2)
                       <li class="menu">
                        <a href="{{url('/admin/users')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span class="iconify" data-icon="carbon:user-multiple"></span>
                                <span>Users</span>
                            </div>
                        </a>
                    </li>
                    @endif
                   @if(Auth::user()->role_id == 2 || Auth::user()->role_id == 3)
                       <li class="menu">
                        <a href="{{url('/EstimatePayment')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span class="iconify" data-icon="fluent:currency-dollar-rupee-16-filled"></span>
                                <span>Estimate Payment</span>
                            </div>
                        </a>
                    </li>

                    <li class="menu">
                        <a href="{{url('/ExciseTax')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span class="iconify" data-icon="fluent:currency-dollar-rupee-16-filled"></span>
                                <span>Excise Taxes</span>
                            </div>
                        </a>
                    </li>
					
                    @endif  

                    @if(Auth::user()->role_id == 3)
                    <li class="menu">
                        <a href="{{url('/calender/'.$m.'/'.$y)}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                               <span class="iconify" data-icon="akar-icons:calendar"></span>
                                <span>Per Diem Calendar</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="{{url('/reminder')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                               <span class="iconify" data-icon="fluent:clipboard-task-list-rtl-20-filled"></span>
                                <span>Add a Reminder</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a target="_blank" href="https://www.legacytaxresolutionservices.com/blog/category/truck-drivers" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                             <span class="iconify" data-icon="fa-solid:blog"></span>
                                <span>Blogs</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="https://www.ttnews.com/events" target="_blank" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                               <span class="iconify" data-icon="bpmn:user"></span>
                                <span>Suggested Trucker Events</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="{{url('/image/index')}}" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <span class="iconify" data-icon="akar-icons:file"></span>
                                <span>File Upload</span>
                            </div>
                        </a>
                    </li>
                    
                    <li class="menu">
                        <a href="" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                               <span class="iconify" data-icon="bpmn:user"></span>
                                <span>Additional Trucker App 1</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                               <span class="iconify" data-icon="bpmn:user"></span>
                                <span>Additional Trucker App 2</span>
                            </div>
                        </a>
                    </li>
                     <li class="menu">
                        <a href="" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                               <span class="iconify" data-icon="bpmn:user"></span>
                                <span>Vehicle Maintenance Reminders</span>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                               <span class="iconify" data-icon="bpmn:user"></span>
                                <span>Additional Trucker App 3</span>
                            </div>
                        </a>
                    </li>

                    
                @endif


					
                </ul>
                
            </nav>

        </div>
        <!--  END SIDEBAR  -->