@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <a class="btn btn-block btn-primary compose-mail" href="{{route('compose')}}">Compose Mail</a>
                        <div class="space-25"></div>
                        <h5>Folders</h5>
                        <ul class="folder-list m-b-md" style="padding: 0">
                            <li><a href="{{ route('communication') }}"> <i class="fa fa-inbox "></i> Inbox <span class="label label-warning pull-right">16</span> </a></li>
                            <!-- <li><a href="mailbox.html"> <i class="fa fa-envelope-o"></i> Send Mail</a></li>
                            <li><a href="mailbox.html"> <i class="fa fa-certificate"></i> Important</a></li>
                            <li><a href="mailbox.html"> <i class="fa fa-file-text-o"></i> Drafts <span class="label label-danger pull-right">2</span></a></li> -->
                            <li><a href="#"> <i class="fa fa-trash-o"></i> Trash</a></li>
                            <li><a href="{{ route('send-mail') }}"> <i class="fa fa-reply"></i> Send</a></li>
                        </ul>
                       
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 animated fadeInRight">
            <div class="mail-box-header">

                <!-- <form method="get" action="index.html" class="pull-right mail-search">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm" name="search" placeholder="Search email">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-primary">
                                Search
                            </button>
                        </div>
                    </div>
                </form> -->
                <h2>
                    Inbox (16)
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <div class="btn-group pull-right">
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-left"></i></button>
                        <button class="btn btn-white btn-sm"><i class="fa fa-arrow-right"></i></button>

                    </div>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="left" title="" data-original-title="Refresh inbox"><i class="fa fa-refresh"></i> Refresh</button>
                    <!-- <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mark as read"><i class="fa fa-eye"></i> </button>
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Mark as important"><i class="fa fa-exclamation"></i> </button> -->
                    <button class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </button>

                </div>
            </div>
            <div class="mail-box">

                <table class="table table-hover table-mail">
                    <thead>
                        <tr>
                            <th class="text-center">To</th>
                            <th class="text-center">Subject</th>
                            <th class="text-center">Attachment</th>
                            <th class="text-center">Message</th>
                            <th class="text-center">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($cmpMails)
                            @foreach($cmpMails as $emailList)
                                <tr class="unread">
                                    <td>
                                        <input type="hidden" name="mail_id" value="{{ $emailList['id'] }}">
                                        <a href="#">{{ $emailList['recieve_emp_id'] == 0 || $emailList['recieve_emp_id'] == null ? $emailList['companyName'] : $emailList['employeeName'] }}</a>
                                    </td>
                                    <td>
                                        <a href="#">{{ $emailList['subject'] ? $emailList['subject'] : strip_tags($emailList['employeeName']) }}</a>
                                    </td>
                                    @if($emailList['file'])
                                        <td class=""><i class="fa fa-paperclip"></i></td>
                                    @else
                                        <td class=""></td>
                                    @endif
                                    <td>
                                        {{ strlen($emailList['message']) > 18 ? substr($emailList['message'],0,18)."..." : $emailList['message'] }}
                                    </td>
                                    <td class="text-right mail-date">
                                        {{ date('Y-m-d H:i A', strtotime($emailList['created_at'])) }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="unread">
                                <td class="check-mail">
                                    No Emails are present for you!
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>


@endsection
