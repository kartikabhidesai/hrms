@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Manage Task Report</h5>
                    
                </div>
                <div class="ibox-content">
                    
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'taskReportSystem' )) }}  
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Department</label>
                                <div class="col-sm-9">
                                    <select class="form-control dept_id"  id="dept_id" name="dept_id">
                                        <option value="" selected="">Select Department</option>
                                        @foreach($departments as $dept)
                                            <option value="{{ $dept->id }}">{{ $dept->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="emparray" id="emparray" class="emparray">
                            <input type="hidden" name="downloadstatus" id="downloadstatus" class="downloadstatus">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Employees</label>
                                <div class="col-sm-9">
                                    <select class="form-control emp_id" id="emp_id" name="emp_id">
                                        <option value="">Select Employee</option>
                                       <!--  <option value="All">Select All</option>
                                        @foreach($getAllEmpOfCompany as $emp)
                                            <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                        @endforeach -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-sm btn-primary downloadPdf" type="button">Download Pdf</button>
                                </div>
                            </div>
                        {{ Form::close() }}
                        <div class="ibox-tools">
                           
                    
                        
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Manage Task Report</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-company" id="taskReportTable">
                            <thead>
                                <tr>
                                <th>Id</th>
                                    <th>Task Report Number</th>
                                    <th>Date</th>
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
