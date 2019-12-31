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
                            <select class="form-control" name="department" id="department">
                                <option value="">Select department</option>
                                @foreach($department as $key => $value)
                                <option value="{{ $key }}" {{ $key == $selectdepartment ? 'selected="selected"' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Employee Name:</label>
                        <div class="col-sm-9">
                            {{ Form::select('employee', ['' => 'Select employee'] + ['all' => 'All employee'] + $employee , $selectemployee, array('class' => 'form-control ', 'id' => 'employee')) }}
                        </div>
                    </div>
                    <input type="hidden" name="emparray[]" id="emparray" class="emparray">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Month:</label>
                        <div class="col-sm-9">
                            <select class="form-control months" id="months" name="months">
                                <option value="">Select Month</option>
                                <option value="1" {{ $selectmonth == 1  ? 'selected="selected"' : '' }}>January</option>
                                <option value="2" {{ $selectmonth == 2  ? 'selected="selected"' : '' }}>February</option>
                                <option value="3" {{ $selectmonth == 3  ? 'selected="selected"' : '' }}>March</option>
                                <option value="4" {{ $selectmonth == 4  ? 'selected="selected"' : '' }}>April</option>
                                <option value="5" {{ $selectmonth == 5  ? 'selected="selected"' : '' }}>May</option>
                                <option value="6" {{ $selectmonth == 6  ? 'selected="selected"' : '' }}>Jun</option>
                                <option value="7" {{ $selectmonth == 7  ? 'selected="selected"' : '' }}>July</option>
                                <option value="8" {{ $selectmonth == 8  ? 'selected="selected"' : '' }}>August</option>
                                <option value="9" {{ $selectmonth == 9  ? 'selected="selected"' : '' }}>September</option>
                                <option value="10" {{ $selectmonth == 10  ? 'selected="selected"' : '' }}>October</option>
                                <option value="11" {{ $selectmonth == 11  ? 'selected="selected"' : '' }}>November</option>
                                <option value="12" {{ $selectmonth == 12  ? 'selected="selected"' : '' }}>December</option>
                            </select>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Year:</label>
                        <div class="col-sm-9">
                            <select class="form-control year" id="year" name="year">
                                @php 
                                $currentYear = date("Y");
                                @endphp
                                <option value="">Select Year</option>
                                @for($i = 2019;$i<= ($currentYear + 2);$i++)
                                <option value="{{  $i }}" {{ $i == $selectyear ? 'selected' : '' }}>{{  $i }}</option>
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

<!--                    @foreach($employDetail as $row => $val)
                    <tr>
                        <td><input type="checkbox" value="{{ $val->payrollId }}" class="empId" id="empId" name="empchk[]"></td>
                        <td>{{ $val->name }}</td>
                        <td>{{ $val->employee_id }}</td>
                        <td>{{ $val->remarks ? $val->remarks : 'N.A.' }}</td>
                         <td>{{ $val->month }}</td>
                        <td>{{ $val->year }}</td> 
                        <td class="text-center"><a data-toggle="modal" class="btn btn-primary review" data-id="{{ $val->emp_id }}" data-payrollId="{{$val->payrollId}}" data-year="{{$year}}" href="#modal-form">Review</a></td>

                    </tr>
                    @endforeach-->
                </tbody>
            </table>
            <div id="modal-form" class="modal fade" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12"><h2 class="m-t-none m-b"><b>HRMS</b></h2>
                                    <div class="col-lg-2"><p><b>Payslip</b></p></div>
                                    <div class="col-lg-10">
                                        <table class="table table-responsive text-center reviewdata">
                                            <thead>
                                            <th>Employee Name</th>
                                            <th>Company Name</th>
                                            <th>payroll Date </th>
                                            <th>Remark</th>
                                            <th>Salary Grade</th>
                                            <th>Over Time</th>

                                            </thead>
                                            <tbody class="employeemodaldata">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
