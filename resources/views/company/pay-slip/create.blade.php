@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
      {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'paySlip' )) }}
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Pay Slip</h5>
                </div>
                <div class="ibox-content">
                  

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Department:</label>
                        <div class="col-sm-9">
                            {{ Form::select('department', $department , null, array('class' => 'form-control ', 'id' => 'department')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Employee Name:</label>
                        <div class="col-sm-9">
                           {{ Form::select('employee', ['' => 'Select employee'] + ['all' => 'All employee'] + $employee , null, array('class' => 'form-control ', 'id' => 'employee')) }}
                    </div>
                </div>
                <input type="hidden" name="emparray[]" id="emparray" class="emparray">
               
                <div class="form-group">
                    <label class="col-sm-2 control-label">Month</label>
                    <div class="col-sm-9">
                        {{ Form::select('months', $monthis , null, array('class' => 'form-control months', 'id' => 'months')) }}
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-2 control-label">Year</label>
                    <div class="col-sm-9">
                        <select class="form-control year" id="year" name="year">
                            @for($i = 2019;$i<= 2022;$i++)
                            <option value="{{  $i }}">{{  $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-sm btn-primary applyBtn" type="button">Apply</button>&nbsp;&nbsp;
                        <button class="btn btn-sm btn-default clearBtn" type="button">Clear</button>
                    </div>
                </div>
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
                        {{ Form::radio('empSelectionType', 'All', false , ['class' => ' empSelectionType','id' => 'empSelectionType']) }} All Employee
                 </label>
                    <label class="radio-inline">
                         {{ Form::radio('empSelectionType', 'Individual', true , ['class' => ' empSelectionType','id' => 'empSelectionType']) }} Selected Employees
                         </label>  
                    <!-- <label class="radio-inline"> -->
                    <!-- {{ Form::radio('gender', 'F', array('class' => 'form-control famale' ,'id'=>'famale')) }} Multiple Payslips</label> -->
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataTables-example" id="requestlist">
            <thead>
                <tr>
                    <td><input type="checkbox" class="checkAll" id="checkAll" name="checkAll"></td>
                    <th>Employee Name</th>
                    <th>Employee No</th>
                    <th>Remarks</th>
                    <!-- <th>Month</th>
                    <th>Year</th> -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach($employDetail as $row => $val)
                    <tr>
                        <td><input type="checkbox" value="{{ $val->emp_id }}" class="empId" id="empId" name="empchk[]"></td>
                        <td>{{ $val->name }}</td>
                        <td>{{ $val->employee_id }}</td>
                        <td>{{ $val->remarks ? $val->remarks : 'N.A.' }}</td>
                        <!-- <td>{{ $val->month }}</td>
                        <td>{{ $val->year }}</td> -->
                        <td><a href="#">Review</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="form-group col-lg-12">
            <label class="col-sm-1 control-label"></label>
            <div class="col-sm-9">
                <label class="radio-inline">
                    {{ Form::radio('generateType', 'PDF', true , ['class' => ' generateType','id' => 'generateType']) }} Consolidated Payslip as PDF
                </label>
                <label class="radio-inline">
                    {{ Form::radio('generateType', 'ZIP', false , ['class' => ' generateType','id' => 'generateType']) }} Multiple Payslip as Zip
                </label>  
            </div>
        </div>
        <div class="form-group col-lg-12">
            <label class="col-sm-1 control-label"></label>
            <div class="col-sm-9">
             <button class="btn btn-sm btn-primary downloadPdf" type="button">Download Pdf</button>
             <button class="btn btn-sm btn-primary " type="button">Send Mail</button>
            </div>
        </div>
    </div>
     {{ Form::close() }}
</div>
</div>

@endsection
