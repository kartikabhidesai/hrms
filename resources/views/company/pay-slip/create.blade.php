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
                                @for($i = 1 ; $i <= count($department) ; $i++)
                                    <option value="{{ $i }}">{{ $department[$i] }}</option>
                                @endfor
                            </select>
                            
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
                           
                            {{ Form::select('months', $monthis , $month, array('class' => 'form-control months', 'id' => 'months')) }}
                          
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Year</label>
                        <div class="col-sm-9">
                            <select class="form-control year" id="year" name="year">
                                @for($i = 2019;$i<= 2022;$i++)
                                <option value="{{  $i }}" {{ $i == $year ? 'selected' : '' }}>{{  $i }}</option>
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
                        <td class="text-center"><a data-toggle="modal" class="btn btn-primary review" data-id="{{ $val->emp_id }}" data-month="{{$month}}" data-year="{{$year}}" href="#modal-form">Review</a></td>

                    </tr>
                    @endforeach
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
