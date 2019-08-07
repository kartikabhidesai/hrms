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
                                        <span style="font-size: 60px;"><b>{{ $diff }}</b></span>
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
                                        <span style="font-size: 60px;"><b>{{ $totalLeave }}</b></span>
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
                                        @php
                                             $rate = ($totalCompletedTask * 10)/$totalTask;
                                        @endphp
                                        <span style="font-size: 60px;"><b>{{ $rate }}</b></span>
                                        <span style="font-size: 15px;">/{{ "10" }}</span>
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
                                    <h5 class="panel-title">
                                        @if(!is_null($latest_task))
                                            Task name : {{@$latest_task->task}}
                                        @else
                                            No task found!
                                        @endif
                                    </h5>
                                </div>
                                <div class="panel-body text-center">
                                    <div class="col-lg-6 panel">
                                        @if(!is_null($latest_task))
                                                <a href="#updateTaskModel" class="link-black text-sm updateTaskModel" data-toggle="modal" data-id="{{ $latest_task->id }}" title="Update" data-original-title="Update">Edit Task</i></a>
                                        @else
                                            Write a comment
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">

                            <div class="col-lg-2">
                                <div class="panel panel-default">
                                    <a href="javascript:void(0);" onclick="func_bank_details()">
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
                                    <a href="{{url('employee/employee-leave')}}">
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
                                    <a href="javascript:void(0);" onclick="func_advance_salary_request()">
                                        <div class="text-center">
                                            <div style="font-size:50px;" class="text-center">
                                                <i class="fa fa-money"></i>
                                            </div>
                                            <p>Advance Salary</p>
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
                </div>
                @if(count($announcementList) > 0)
                <div class="ibox-content" style="overflow-y: scroll; height:400px;">
                    <div class="ibox-title">
                        <h5>Announcement List</h5>
                    </div>
                            <div class="panel-body">
                                <div class="panel-group" id="accordion">
                                    @php 
                                        $i =0;
                                    @endphp
                                    @foreach($announcementList as $key => $value)
                                         @php 
                                            $i++;
                                        @endphp
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne{{ $i }}">
                                                <h5 class="panel-title">
                                                        {{ $value['title'] }}
                                                        <span class="pull-right">Date : {{ date("d-m-Y", strtotime($value['date'])) }}</span>
                                                </h5>
                                                </a>
                                            </div>
                                            <div id="collapseOne{{ $i }}" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    {{ $value['content'] }}<br><br>
                                                    <b>Expiry Date : {{ date("d-m-Y", strtotime($value['expiry_date'])) }}</b>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                @endif
            </div>
            
        </div>
    </div>
</div>

<div id="task_write_comment_modal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Write Task Comment</h4>
            </div>
            <form action="{{url('employee/employee-task-comment')}}" method="POST" class="form-horizontal" id="addTaskCommentForm">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        {{ csrf_field() }}
                        <input type="hidden" name="task_id" value="{{@$latest_task->id}}">
                        <div class="form-group">
                            <label for="task_comment" class="form-control-label">Comment:</label>
                            <input type="text" class="form-control task_comment" name="task_comment" id="task_comment" placeholder="Task Comment" value="{{@$latest_task->about_task}}" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary m-l addTaskComment" type="submit">Submit</button>
                <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div id="task_upload_media_modal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Task Media</h4>
            </div>
            <form action="{{url('employee/employee-upload-file')}}" method="POST" class="form-horizontal" id="addUploadMediaForm" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        {{ csrf_field() }}
                        <input type="hidden" name="task_id" value="{{@$latest_task->id}}">

                        @if(!is_null($latest_task) && $latest_task->file != '')
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-download dwnltaskfileBtn"><a href="{{url('/uploads/tasks/'.$latest_task->file)}}" target="_blank" name="downloadfileName" class="downloadfileName dwnltaskfile" id="downloadfileName">Download</a></button>
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="upload_file" class="form-control-label">File upload:</label>
                            <input type="file" class="form-control upload_file" name="upload_file" id="upload_file" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary m-l addTaskComment" type="submit">Submit</button>
                <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div id="task_set_status_modal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Set Task status</h4>
            </div>
            <form action="{{url('employee/employee-set-status')}}" method="POST" class="form-horizontal" id="addSetStatusForm">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        {{ csrf_field() }}
                        <input type="hidden" name="task_id" value="{{@$latest_task->id}}">
                        <div class="form-group">
                            <label for="task_status" class="form-control-label">Status:</label>
                            <select type="text" class="form-control task_status" name="task_status" id="task_status" required>
                                <option value="">Select</option>
                                <option value="0" {{@$latest_task->task_status == '0' ? 'selected':''}}>In Progress</option>
                                <option value="1" {{@$latest_task->task_status == '1' ? 'selected':''}}>Pending</option>
                                <option value="2" {{@$latest_task->task_status == '2' ? 'selected':''}}>Complete</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary m-l addTaskComment" type="submit">Submit</button>
                <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div id="bank-detail-modal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bank Details</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                        <form role="form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-4">
                                        <label><b>Account Holder Name : </b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <label class="account_holder_name">{{$employee_data->account_holder_name}}</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-4">
                                        <label><b>Bank Name : </b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <label class="bank_name">{{$employee_data->bank_name}}</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-4">
                                        <label><b>Brnach : </b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        <label class="branch">{{$employee_data->branch}}</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-4">
                                        <span><b>Account Number : </b></span>
                                    </div>
                                    <div class="col-lg-8">
                                        <label class="account_number">{{$employee_data->account_number}}</label>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="advance-salary-request-modal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Advance Salary Request</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                        <form role="form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-4">
                                        <label><b>Date of Submit : </b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        @if(isset($advance_salary_request->date_of_submit))
                                            <label class="date_of_submit">{{ $advance_salary_request->date_of_submit }}</label>
                                        @else
                                            <label class="date_of_submit"> N/A </label>
                                        @endif
                                        
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-4">
                                        <span><b>Status : </b></span>
                                    </div>
                                    <div class="col-lg-8">
                                        @if(isset($advance_salary_request->status))
                                            <label class="date_of_submit">{{ $advance_salary_request->status }}</label>
                                        @else
                                            <label class="date_of_submit"> N/A </label>
                                        @endif
                                       
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-4">
                                        <label><b>Comments : </b></label>
                                    </div>
                                    <div class="col-lg-8">
                                        @if(isset($advance_salary_request->comments))
                                            <label class="date_of_submit">{{$advance_salary_request->comments}}</label>
                                        @else
                                            <label class="date_of_submit"> N/A </label>
                                        @endif
                                        
                                        <label class="comments"></label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="col-lg-4">
                                        <label><b>Uploaded File : </b></label>
                                    </div>

                                    @if(!is_null($advance_salary_request) && $advance_salary_request->file_name != '')
                                        <div class="form-group col-lg-8">
                                            <button class="btn btn-download dwnltaskfileBtn"><a href="{{url('/uploads/employee/advance_salary_request/'.$advance_salary_request->file_names)}}" target="_blank">Download</a></button>
                                        </div>
                                    @else
                                        <div class="col-lg-8">
                                            <label class="branch">No file found.</label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div id="updateTaskModel" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Task Details</h4>
            </div>
            {{ Form::open( array('method' => 'post','files' => true, 'class' => 'form-horizontal', 'id' => 'updateTaskDash' )) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                         <input type="hidden" class="form-control task_id" name="task_id" id="task_id">
                        <div class="form-group">

                            <label class="col-sm-2 control-label">Complete Progress</label>
                            <div class="col-sm-9">
                                {{ Form::select('complete_progress', $task_progress , null, array('class' => 'form-control m-b c-select complete_progress', 'id' => 'complete_progress')) }}
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Task Status</label>
                            <div class="col-sm-9">
                                <select class="form-control m-b c-select task_status" id="task_status" name="task_status" >
                                    <option value="1">In_Progress</option>
                                    <option value="2">Pending</option>
                                    <option value="3">Complete</option>
                                </select>
                               
                            </div>
                        </div>
                         
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Location</label>
                            <div class="col-sm-9">
                               {{ Form::text('location' , null, array('class' => 'form-control m-b c-select location', 'id' => 'location')) }}
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group" style="margin-left: 1px;margin-right: 1px">
                                <label class="col-lg-2 control-label">Files</label>
                                <div class="col-lg-9">
                                    <input type="file" class="form-control emp_updated_file" name="emp_updated_file" id="emp_updated_file">
                                    <a href="javascript:;" target="_blank" name="fileName" class="fileName" id="fileName">View File</a>
                                </div>
                            </div>
                        </div>
                         
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form role="form">
                    <button class="btn btn-sm btn-default pull-right m-l " data-dismiss="modal">Close</button>
                    <button class="btn btn-sm btn-primary pull-right updatetask m-l" type="submit">Update</button>
                </form>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<script type="text/javascript">
    function func_write_comment()
    {
        $('#task_write_comment_modal').modal('show');
    }
    function func_upload_media()
    {
        $('#task_upload_media_modal').modal('show');
    }
    function func_set_status()
    {
        $('#task_set_status_modal').modal('show');
    }
    function func_bank_details()
    {
        $('#bank-detail-modal').modal('show');
    }
    function func_advance_salary_request()
    {
        $('#advance-salary-request-modal').modal('show');
    }
</script>

@endsection
