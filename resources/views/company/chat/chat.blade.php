@extends('layouts.app')
@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">

                    <strong>Chat room </strong> can be used to create chat room in your app.
                    You can also use a small chat in the right corner to provide live discussion.

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
           
            <div class="ibox chat-view">

                <div class="ibox-title">
                    <small class="pull-right text-muted">Last message:  Mon Jan 26 2015 - 18:39:23</small>
                    <span id="to_user_name" > Chat room panel <span > 
                </div>


                <div class="ibox-content">

                    <div class="row">

                        <div class="col-md-9 ">
                            <div class="chat-discussion chat-users user-message-list-div" style="margin-left: 0px">
                            <div class="user-message-list">
                            No data
                            </div>
                            </div>
                            
                        </div>
                        <div class="col-md-3">
                            <div class="chat-users">
                            <input type="text" class="form-control" name="search_user" id="search_user" placeholder="Search User" />
                                <div class="users-list">                                   
                                   
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">

                            
                                <form method="POST">
                                    <div class="col-md-9 ">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="to_user_id"  id="to_user_id" value="">
                                        <input type="hidden" name="page_no"  id="page_no" value="2">
                                        <div class="col-lg-12" style="padding-right:0px">
                                            <div class="chat-message-form">
                                                <div class="form-group">
                                                    <textarea class="form-control" style="width: 99.2%" rows="2" name="message" id="message" placeholder="Enter message text"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3"  style="margin-left: -37px;width: 27%;">
                                        <a class="btn btn-primary btn-block send_chat" style="height: 54px;padding-top: 20px"><i class="fa fa-reply" ></i> Send</a>
                                    </div>
                                </form>
                            
                        </div>
                    </div>
                    


                </div>

            </div>
        </div>

    </div>
</div>
@endsection

