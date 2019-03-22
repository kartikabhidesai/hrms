@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    Announcement Details
                </div>
                @if($announcementList->count() == 0)
                    <div class="ibox-content">
                        <p>No Announcement present yet!</p>
                    </div>
                @else
                    <div class="ibox-content">
                        <div class="panel-group payments-method" id="accordion">
                        @foreach($announcementList as $list)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <!-- <div class="pull-right">
                                            <i class="fa fa-cc-paypal text-success"></i>
                                        </div> -->
                                        <h5 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#{{ $list->id }}_collapseOne">{{ $list->title }}</a>
                                        </h5>
                                    </div>
                                    <div id="{{ $list->id }}_collapseOne" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <strong>Title: </strong>{{ $list->title }}<br>
                                                    <strong>Status:</strong> {{ $list->status }} <br/>
                                                    <strong>End Date:</strong> <span class="text-navy">{{ date('Y-m-d', strtotime($list->date)) }}</span><br>
                                                    <strong>Time:</strong> <span class="text-navy">{{ $list->time }}</span>
                                                    <p class="m-t">
                                                        <strong>Conent: </strong>{{ $list->content }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
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
