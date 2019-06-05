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
                <div class="pull-right tooltip-demo">
                    <a href="{{url('')}}/company/compose?communication_id={{$cmpMailDetail->id}}" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Reply"><i class="fa fa-reply"></i> Reply</a>
                    <a href="#" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Print email"><i class="fa fa-print"></i> </a>
                    <a href="mailbox.html" class="btn btn-white btn-sm" data-toggle="tooltip" data-placement="top" title="Move to trash"><i class="fa fa-trash-o"></i> </a>
                </div>
                <h2>
                    View Message
                </h2>
                <div class="mail-tools tooltip-demo m-t-md">
                    <h3>
                        <span class="font-normal">Subject: </span>{{ $cmpMailDetail->subject ? $cmpMailDetail->subject : 'N.A.' }}
                    </h3>
                    <h5>
                        <span class="pull-right font-normal">{{ date('Y-m-d H:i A', strtotime($cmpMailDetail->created_at)) }}</span>
                        <span class="font-normal">From: </span>{{ $cmpMailDetail->email }}
                    </h5>
                </div>
            </div>
            <div class="mail-box">
                <div class="mail-body">
                    <!-- <p>
                        Hello Jonathan!
                        <br/>
                        <br/>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                        took a galley of type and scrambled it to make a type <strong>specimen book.</strong>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It has survived not only five centuries, but also the leap into electronic typesetting, remaining
                        essentially unchanged.
                        </p>
                    <p>
                        It was popularised in the 1960s with the release <a href="#" class="text-navy">Letraset sheets</a>  containing Lorem Ipsum passages, and more recently with desktop publishing software
                        like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                    <p>
                        There are many variations of passages of <strong>Lorem Ipsum</strong>Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of.
                    </p> -->
                    <p>{!! html_entity_decode($cmpMailDetail->message) !!}</p>
                </div>

                @if($cmpMailDetail->file)
                    <div class="mail-attachment">
                        <p>
                            <span><i class="fa fa-paperclip"></i> Attachments </span>
                            <!-- <a href="#">Download all</a>|<a href="#">View all images</a> -->
                        </p>
                        <div class="attachment">
                            <div class="file-box">
                                <div class="file">
                                    <a href="{{ url('/company/download-attachment/'.str_replace('/uploads/communication/', '', $cmpMailDetail->file)) }}">
                                        <span class="corner"></span>
                                        <div class="icon">
                                            <i class="fa fa-file"></i>
                                        </div>
                                        <div class="file-name">
                                            {{ str_replace('/uploads/communication/', '', $cmpMailDetail->file) }}
                                            <br/>
                                            <small>Added: {{ date('M d, Y', strtotime($cmpMailDetail->created_at)) }}</small>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                @endif
                <div class="mail-body text-right tooltip-demo">
                        <a class="btn btn-sm btn-white" href="{{url('')}}/company/compose?communication_id={{$cmpMailDetail->id}}"><i class="fa fa-reply"></i> Reply</a>
                        <a class="btn btn-sm btn-white" href="mail_compose.html"><i class="fa fa-arrow-right"></i> Forward</a>
                        <button title="" data-placement="top" data-toggle="tooltip" type="button" data-original-title="Print" class="btn btn-sm btn-white"><i class="fa fa-print"></i> Print</button>
                        <button title="" data-placement="top" data-toggle="tooltip" data-original-title="Trash" class="btn btn-sm btn-white"><i class="fa fa-trash-o"></i> Remove</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>


@endsection
