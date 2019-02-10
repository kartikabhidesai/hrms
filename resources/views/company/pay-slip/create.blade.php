@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Manage Attendance History</h5>
                </div>
                <div class="ibox-content">
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'attendanceHistory' )) }}

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Department:</label>
                        <div class="col-sm-9">
                            <select class="form-control department_id" name="department_id">
                                @for($i = 2018;$i<= 2022;$i++)
                                <option value="{{  $i }}">Dep {{  $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Employee Name:</label>
                        <div class="col-sm-9">
                           <select class="form-control department_id" name="department_id">
                            @for($i = 2018;$i<= 2022;$i++)
                            <option value="{{  $i }}">Emp {{  $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Year</label>
                    <div class="col-sm-9">
                        <select class="form-control department_id" name="department_id">
                            @for($i = 2018;$i<= 2022;$i++)
                            <option value="{{  $i }}">{{  $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Month</label>
                    <div class="col-sm-9">
                        {{ Form::select('months',  array('L' => 'Large', 'S' => 'Small') , null, array('class' => 'form-control m-b', 'id' => 'test')) }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-sm btn-primary getAttedanceReport" type="submit">Apply</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<div class="ibox-content">
    <div class="row">
        <div class="form-group col-lg-12">
            <label class="col-sm-1 control-label"></label>
            <div class="col-sm-9">
                    <label class="radio-inline">
                    {{ Form::radio('gender', 'M', array('class' => 'form-control male' ,'id'=>'male')) }} All Employee</label>
                    <label class="radio-inline">
                    {{ Form::radio('gender', 'F', array('class' => 'form-control famale' ,'id'=>'famale')) }} Selected Employees</label>  
                    <label class="radio-inline">
                    {{ Form::radio('gender', 'F', array('class' => 'form-control famale' ,'id'=>'famale')) }} Multiple Payslips</label>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataTables-example" id="requestlist">
            <thead>
                <tr>
                    <td><input type="checkbox" name="checkone"></td>
                    <th>Employee Name</th>
                    <th>Employee No</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                 @for($i = 1;$i<= 9;$i++)
                    <tr>
                        <td><input type="checkbox" name="checkone"></td>
                        <td>tess</td>
                        <td>12 {{ $i }}</td>
                        <td></td>
                        <td><a href="#">Review</a></td>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="form-group col-lg-12">
            <label class="col-sm-1 control-label"></label>
            <div class="col-sm-9">
                    <label class="radio-inline">
                    {{ Form::radio('gender', 'M', array('class' => 'form-control male' ,'id'=>'male')) }} Consolidated Payslip as PDF</label>
                    <label class="radio-inline">
                    {{ Form::radio('gender', 'F', array('class' => 'form-control famale' ,'id'=>'famale')) }} Multiple Payslip as Zip</label>  
            </div>
        </div>
        <div class="form-group col-lg-12">
            <label class="col-sm-1 control-label"></label>
            <div class="col-sm-9">
             <button class="btn btn-sm btn-primary " type="button">Download Pdf</button>
             <button class="btn btn-sm btn-primary " type="button">Send Mail</button>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
