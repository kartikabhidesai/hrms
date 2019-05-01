@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">



            <div class="ibox float-e-margins">
                <div class="ibox-title text-center">
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content" style="">

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="contact-box">
                                <a href="javascript:void(0);">
                                    <div class="col-sm-12 text-center">
                                        <span style="font-size: 60px;"><b>14</b></span>
                                        <span style="font-size: 15px;">days</span>
                                        <p style="font-size: 15px;">For the next salary</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="contact-box">
                                <a href="javascript:void(0);">
                                    <div class="col-sm-12 text-center">
                                        <span style="font-size: 60px;"><b>14</b></span>
                                        <span style="font-size: 15px;">days</span>
                                        <p style="font-size: 15px;">off</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="contact-box">
                                <a href="javascript:void(0);">
                                    <div class="col-sm-12 text-center">
                                        <span style="font-size: 60px;"><b>4.2</b></span>
                                        <span style="font-size: 15px;">/5</span>
                                        <p style="font-size: 15px;">Your completion rate of tasks</p>
                                    </div>
                                    <div class="clearfix"></div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Task name</h5>
                                </div>
                                <div class="panel-body text-center">
                                    <div class="col-lg-6 panel">
                                        Write a commnet
                                    </div>
                                    <div class="col-lg-6 panel">
                                        Upload media
                                    </div>
                                    <div class="col-lg-6 panel">
                                        Share location
                                    </div>
                                    <div class="col-lg-6 panel">
                                        Set statues
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">

                            <div class="col-lg-2">
                                <div class="panel panel-default">
                                    <a href="javascript:void(0);">
                                        <div class="text-center">
                                            <div style="font-size:50px;" class="text-center">
                                                <i class="fa fa-bank"></i>
                                            </div>
                                            <p>Bank info</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="panel panel-default">
                                    <a href="javascript:void(0);">
                                        <div class="text-center">
                                            <div style="font-size:50px;" class="text-center">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <p>Leave</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="panel panel-default">
                                    <a href="javascript:void(0);">
                                        <div class="text-center">
                                            <div style="font-size:50px;" class="text-center">
                                                <i class="fa fa-money"></i>
                                            </div>
                                            <p>Advanced Salary</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-2">
                                <div class="panel panel-default">
                                    <a href="javascript:void(0);">
                                        <div class="text-center">
                                            <div style="font-size:50px;" class="text-center">
                                                <i class="fa fa-id-badge"></i>
                                            </div>
                                            <p>Relocate</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </a>
                                </div>
                            </div>


                            <div class="col-lg-2">
                                <div class="panel panel-default">
                                    <a href="javascript:void(0);">
                                        <div class="text-center">
                                            <div style="font-size:50px;" class="text-center">
                                                <i class="fa fa-child"></i>
                                            </div>
                                            <p>Retirement</p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </a>
                                </div>
                            </div>

                        </div>    


                    </div>

                    {{-- <div class="panel-body">
                        <div class="panel-group" id="accordion">
                            @if($announcementList->count() == 0)
                            <div class="ibox-content">
                                <p>No Announcement present yet!</p>
                            </div>
                            @else
                            @foreach($announcementList as $list)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne_{{ $list->id }}" aria-expanded="true" class=""> <strong>Title: </strong>{{ $list->title }}<br></a>
                                    </h5>
                                </div>
                                <div id="collapseOne_{{ $list->id }}" class="panel-collapse collapse in" aria-expanded="true" style="">
                                    <div class="panel-body">
                                        <strong>Status:</strong> {{ $list->status }} <br/>
                                        <strong>Date:</strong> <span class="text-navy">{{ date('Y-m-d', strtotime($list->date)) }}</span><br>
                                        <strong>Expiry Date:</strong> <span class="text-navy">{{ $list->expiry_date ? $list->expiry_date : 'N.A.' }}</span><br>
                                        <strong>Time:</strong> <span class="text-navy">{{ $list->time }}</span>
                                        <p class="m-t">
                                            <strong>Conent: </strong>{{ $list->content }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div id="detialsModel" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Announcement Details</h3>
                        <form role="form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-4">
                                        <label><b>Content</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <label class="content"></label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-4">
                                        <label><b>Created At</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <label class="created_at"></label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-4">
                                        <label><b>Status</b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <label class="status"></label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-4">
                                        <span><b>Title</b></span>
                                    </div>
                                    <div class="col-lg-8">
                                        <label class="title"></label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> -->

@endsection
