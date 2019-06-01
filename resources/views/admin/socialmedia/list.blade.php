@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Social Media</h5>


                    <div class="ibox-tools">
                         <a href="{{ route('manage-account') }}" class="btn btn-default  dim" ><i class="fa fa-cog">   Manage Accounts</i></a>
                        {{--<a href="{{ url('').'/admin/social-media' }}" class="btn btn-default  dim" ><i class="fa fa-cog">   Manage Accounts</i></a>--}}
                        <a href="{{ route('new-post') }}" class="btn btn-success  dim" ><i class="fa fa-plus">   New Post</i></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-company" id="dataTables-social-media">
                            <thead>
                                <tr>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Delivery Date</th>
                                    <th>Delivery Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
