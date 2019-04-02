@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Collaps panels</h5>
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
                    <div class="panel-body">
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
                    </div>
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
