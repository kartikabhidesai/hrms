@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Award List</h5>
                    <div class="ibox-tools">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('award-add') }}" class="btn btn-primary dim" ><i class="fa fa-plus"> Add</i></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="AwardDatatables">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Award</th>
                                    <th>Date</th>
                                    <th>Comment</th>
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

<div id="awardDetailsModel" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12"><h3 class="m-t-none m-b">Award Details</h3>
                        <br/>
                        <!-- <b>Employee Name: </b><span class="m-t-none m-b empName"></span><br/> -->
                        <div class="employeeDiv">
                            <b>Employee Name : </b><span class="m-t-none m-b employee"></span><br/>
                        </div>
                        <div class="departmentDiv">
                            <b>Department : </b><span class="m-t-none m-b department"></span><br/>
                        </div>
                        <div class="awardDiv">
                            <b>Award : </b><span class="m-t-none m-b"> $ </span><span class="m-t-none m-b award"></span><br/>
                        </div>
                        <div class="dateDiv">
                            <b>Date : </b><span class="m-t-none m-b date"></span><br/>
                        </div>
                        <div class="commentDiv">
                            <b>Comment : </b><span class="m-t-none m-b comment"></span><br/>
                        </div>
                        <div class="file_attachmentDiv">
                            <b>File Attachment : </b><span class="m-t-none m-b file_attachment"></span><br/>
                        </div>
                        <form role="form">
                            <div>
                                <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
