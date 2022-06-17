@extends('layouts.admin')
@section('content') 

 <link href="{{asset('assets/css/users/user-profile.css')}}" rel="stylesheet" type="text/css" />



 <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-spacing">

                    <!-- Content -->
                    <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

                        <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area">
                                <div class="d-flex justify-content-between">
                                    <h3 class=""> Driver Personal Info</h3>
                                    <a href="{{url('/update-profile')}}" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                                </div>
                                <div class="text-center user-info">
                                    <img src="{{asset('images/demo.jpg')}}" alt="avatar" style="height: 100px;">
                                    <p class="">{{ Auth::user()->first_name.' '.Auth::user()->last_name}}</p>
                                </div>
                                <div class="user-info-list">

                                    <div class="">
                                        <ul class="contacts-block list-unstyled">
                                            
                                            
                                            <li class="contacts-block__item">
                                                <a href="mailto:example@mail.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>{{ Auth::user()->email}}</a>
                                            </li>
                                            <li class="contacts-block__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> {{ Auth::user()->mobile_no}}
                                            <li class="contacts-block__item">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <div class="social-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                                                        </div>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <div class="social-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                                                        </div>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <div class="social-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                       

                        

                    </div>

                    <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

                       <div class="education layout-spacing ">
                            <div class="widget-content widget-content-area">
                                <h3 class="">Education</h3>
                                <div class="timeline-alter">
                                    <div class="item-timeline">
                                        <div class="t-meta-date">
                                            <p class="">04 Mar 2009</p>
                                        </div>
                                        <div class="t-dot">
                                        </div>
                                        <div class="t-text">
                                            <p>Royal Collage of Art</p>
                                            <p>Designer Illustrator</p>
                                        </div>
                                    </div>
                                    <div class="item-timeline">
                                        <div class="t-meta-date">
                                            <p class="">25 Apr 2014</p>
                                        </div>
                                        <div class="t-dot">
                                        </div>
                                        <div class="t-text">
                                            <p>Massachusetts Institute of Technology (MIT)</p>
                                            <p>Designer Illustrator</p>
                                        </div>
                                    </div>
                                    <div class="item-timeline">
                                        <div class="t-meta-date">
                                            <p class="">04 Apr 2018</p>
                                        </div>
                                        <div class="t-dot">
                                        </div>
                                        <div class="t-text">
                                            <p>School of Art Institute of Chicago (SAIC)</p>
                                            <p>Designer Illustrator</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					  <div class="work-experience layout-spacing ">
                            
                            <div class="widget-content widget-content-area">

                                <h3 class="">Work Experience</h3>
                                
                                <div class="timeline-alter">
                                
                                    <div class="item-timeline">
                                        <div class="t-meta-date">
                                            <p class="">04 Mar 2009</p>
                                        </div>
                                        <div class="t-dot">
                                        </div>
                                        <div class="t-text">
                                            <p>Netfilx Inc.</p>
                                            <p>Designer Illustrator</p>
                                        </div>
                                    </div>

                                    <div class="item-timeline">
                                        <div class="t-meta-date">
                                            <p class="">25 Apr 2014</p>
                                        </div>
                                        <div class="t-dot">
                                        </div>
                                        <div class="t-text">
                                            <p>Google Inc.</p>
                                            <p>Designer Illustrator</p>
                                        </div>
                                    </div>

                                    <div class="item-timeline">
                                        <div class="t-meta-date">
                                            <p class="">04 Apr 2018</p>
                                        </div>
                                        <div class="t-dot">
                                        </div>
                                        <div class="t-text">
                                            <p>Design Reset Inc.</p>
                                            <p>Designer Illustrator</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="bio layout-spacing ">
                            <div class="widget-content widget-content-area">
                                <h3 class="">Bio</h3>
                                <p>I'm Web Developer from California. I code and design websites worldwide. Mauris varius tellus vitae tristique sagittis. Sed aliquet, est nec auctor aliquet, orci ex vestibulum ex, non pharetra lacus erat ac nulla.</p>

                                <p>Sed vulputate, ligula eget mollis auctor, lectus elit feugiat urna, eget euismod turpis lectus sed ex. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ut velit finibus, scelerisque sapien vitae, pharetra est. Nunc accumsan ligula vehicula scelerisque vulputate.</p>

                                <div class="bio-skill-box">

                                    <div class="row">
                                        
                                        <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">
                                            
                                            <div class="d-flex b-skills">
                                                <div>
                                                </div>
                                                <div class="">
                                                    <h5>Sass Applications</h5>
                                                    <p>Duis aute irure dolor in reprehenderit in voluptate velit esse eu fugiat nulla pariatur.</p>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">
                                            
                                            <div class="d-flex b-skills">
                                                <div>
                                                </div>
                                                <div class="">
                                                    <h5>Github Countributer</h5>
                                                    <p>Ut enim ad minim veniam, quis nostrud exercitation aliquip ex ea commodo consequat.</p>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-12 col-xl-6 col-lg-12 mb-xl-0 mb-5 ">
                                            
                                            <div class="d-flex b-skills">
                                                <div>
                                                </div>
                                                <div class="">
                                                    <h5>Photograhpy</h5>
                                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia anim id est laborum.</p>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-12 col-xl-6 col-lg-12 mb-xl-0 mb-0 ">
                                            
                                            <div class="d-flex b-skills">
                                                <div>
                                                </div>
                                                <div class="">
                                                    <h5>Mobile Apps</h5>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do et dolore magna aliqua.</p>
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
        
        
       
       
        
        


		
@endsection