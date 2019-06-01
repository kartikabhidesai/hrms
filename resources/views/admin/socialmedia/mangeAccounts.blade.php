@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h2>Manage Social Accounts</h2>
                        </div>
                        @php
                        if(isset($_COOKIE['twitterSuccess'])){
                         @endphp
                        <div class="alert alert-success">
                            <strong>Success!</strong> Twitter authentication successful done.
                        </div>
                        @php
                            } else if(isset($_COOKIE['twittererror'])){
                        @endphp
                        <div class="alert alert-success">
                            <strong>Error!</strong> Something wrong happen please tra again.
                        </div>
                        @php
                            }else if(isset($_COOKIE['facebooksuccess'])){
                        @endphp
                        <div class="alert alert-success">
                            <strong>Success!</strong> Facebook authentication successfully done.
                        </div>
                        @php
                            }else if(isset($_COOKIE['facebook_user_page_error'])){
                        @endphp
                        <div class="alert alert-success">
                            <strong>Error!</strong> Something wrong happen please tra again.
                        </div>
                        @php
                            }
                        @endphp

                        <div class="ibox-content">

                             <ul class="sortable-list connectList agile-list" id="todo">
                                <li class="success-element" id="task2">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book
                                   
                                </li>
                            </ul>
                            <p class="agile-detail">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book
                            </p>
                            <div class="ibox-content forum-container">

                           
                                <div class="forum-item active">
                                     <a href="{{url('/social-media/twitter')}}" class="forum-item-title">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h2><span class="fa fa-twitter-square"></span> &nbsp; Twitter</h2>
                                            </div>
                                            <div class="col-md-3 forum-info">
                                                <a href="{{url('/social-media/twitter')}}" class="btn btn-w-m btn-primary">Connect account</a>
                                            </div>
                                        </div>
                                     </a>
                                </div>
                           
                                
                            <div class="forum-item active">
                                     <a href="{{url('/social-media/facebook')}}" class="forum-item-title">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h2><span class="fa fa-facebook-official"></span> &nbsp; Facebook</h2>
                                            </div>
                                            <div class="col-md-3 forum-info">
                                                <a href="{{url('/social-media/facebook')}}" class="btn btn-w-m btn-primary btn-facebook">Connect Page</a>
                                            </div>
                                        </div>
                                     </a>
                                </div>
                                
                                <div class="forum-item active">
                                     <a href="forum_post.html" class="forum-item-title">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h2><span class="fa fa-linkedin-square"></span> &nbsp; Linkedin</h2></a>
                                            </div>
                                            <div class="col-md-3 forum-info">
                                                <button type="button" class="btn btn-w-m btn-primary">Connect account</button>
                                            </div>
                                        </div>
                                     </a>
                                </div>  
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
