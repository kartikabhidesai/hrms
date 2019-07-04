@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'addPayroll' )) }}
        <div class="row">
            <div class="col-12">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Salary Template</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Salary Grade</label>
                                <div class="col-lg-9">
                                    {{ Form::number('salary_grade', isset($arrayPayroll) ? $arrayPayroll['salary_grade'] : '', array('placeholder'=>'Salary Grade', 'class' => 'form-control' ,'required')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label">Basic Salary</label>
                                <div class="col-lg-9">
                                    {{ Form::number('basic_salary', isset($arrayPayroll) ? $arrayPayroll['basic_salary'] : '', array('placeholder'=>'Basic Salary', 'class' => 'form-control' ,'required')) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label">OverTime</label>
                                <div class="col-lg-9">
                                    {{ Form::number('over_time', isset($arrayPayroll) ? $arrayPayroll['over_time'] : '', array('placeholder'=>'OverTime', 'class' => 'form-control' ,'required')) }}
                                </div>
                            </div>                  

                            <div class="form-group" id="data_1">
                                <label class="col-sm-3 control-label">Due Date</label>
                                <div class="col-sm-9"> 
                                    <div class="input-group date">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value="<?=  isset($arrayPayroll) ? $arrayPayroll['due_date']: '' ?>" name="due_date" id="" placeholder="Select Date of joingng" class="form-control" value="">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Month</label>
                                <div class="col-sm-9">
                                    {{ Form::select('months', $monthis , isset( $arrayPayroll['month']) ? $arrayPayroll['month'] : '', array('class' => 'form-control months', 'id' => 'months')) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Year</label>
                                <div class="col-sm-9">
                                    <select class="form-control year" id="year" name="year">
                                        @for($i = 2019;$i<= 2022;$i++)
                                        <option <?=  isset($arrayPayroll) && $arrayPayroll['year'] == $i ? 'selected="selected"'  : '' ?> value="{{  $i }}">{{  $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" name="empId" value="{{@$employee['id']}}" id="empId">
                            <input type="hidden" name="companyId" value="{{@$employee['company_id']}}" id="companyId">

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Remarks</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="remarks" name="remarks" cols="4" rows="3">{{ isset($arrayPayroll['remarks']) ? $arrayPayroll['remarks'] : ''}}</textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>	
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Allowances</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Housing:</label>
                            <div class="col-lg-8">
                                {{ Form::text('housing',  isset($arrayPayroll) ? $arrayPayroll['housing'] : '', array('placeholder'=>'Housing', 'class' => 'form-control' ,'required')) }}
                            </div>
                            <label class="col-lg-1 control-label">SAR</label>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Medical:</label>
                            <div class="col-lg-8">
                                {{ Form::text('medical',  isset($arrayPayroll) ? $arrayPayroll['medical'] : '', array('placeholder'=>'Medical', 'class' => 'form-control' ,'required')) }}
                            </div>
                            <label class="col-lg-1 control-label">SAR</label>
                        </div>	
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Transportation:</label>
                            <div class="col-lg-8">
                                {{ Form::text('transportation',  isset($arrayPayroll) ? $arrayPayroll['transportation'] : '', array('placeholder'=>'Transportation', 'class' => 'form-control last_name' ,'required')) }}
                            </div>
                            <label class="col-lg-1 control-label">SAR</label>
                        </div>	
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Travel:</label>
                            <div class="col-lg-8">
                                {{ Form::text('travel',  isset($arrayPayroll) ? $arrayPayroll['travel'] : '', array('placeholder'=>'Travel', 'class' => 'form-control last_name' ,'required')) }}
                                {{ Form::hidden('editId',  isset($arrayPayroll) ? $arrayPayroll['id'] : '', array('placeholder'=>'Travel')) }}
                            </div>
                            <label class="col-lg-1 control-label">SAR</label>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Award:</label>
                            <div class="col-lg-8">
                                {{ Form::text('award',  isset($arrayPayroll) ? $arrayPayroll['award'] : '', array('placeholder'=>'Award', 'class' => 'form-control award','readonly'=>'readonly','id'=>'award')) }}
                            </div>
                            <label class="col-lg-1 control-label">SAR</label>
                        </div>

                        @if(isset($decodeJsonOfAllowance))
                            @foreach($decodeJsonOfAllowance as $key => $value)
                                <div class="form-group removediv">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">{{ $key }}</label>
                                        <div class="col-lg-8">
                                            <input name="extraallowance{{$value}}" class="form-control" value="{{ $value }}" readonly>
                                        </div>
                                        <div class="col-lg-1 control-label">
                                            <a class="link-black text-sm removebtn"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="form-group add_designation_div">
                            <div class="form-group">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-3 col-lg-9">
                                <a href="#addMoreAllowanceModel" data-toggle="modal" class="btn btn-sm btn-primary add_more_btn" type="button">Add New Allowance</a>
                            </div>
                        </div>
                        {{ Form::hidden('empId',  isset($arrayPayroll) ?$arrayPayroll['employee_id'] : '', array('placeholder'=>'empId')) }}
                        <div class="form-group">
                            <label class="col-lg-3 control-label">&nbsp;</label>
                            <div class="col-lg-8">
                                &nbsp;
                            </div>
                        </div>	
                    </div><br><br>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Deduction</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>

                        <div class="ibox-content">
                            @if(isset($decodeJsonOfDeduction))
                                @foreach($decodeJsonOfDeduction as $key => $value)
                                    <div class="form-group removedeductiondiv">
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">{{ $key }}</label>
                                            <div class="col-lg-8">
                                                <input name="extradeduction{{$value}}" class="form-control" value="{{ $value }}" readonly>
                                            </div>
                                            <div class="col-lg-1 control-label">
                                                <a class="link-black text-sm removeDeductionbtn"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif  
                            <div class="form-group add_deduction_div">
                                <div class="form-group">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-3 control-label"></label>
                                <div class="col-lg-3 m-t-sm">
                                    <a href="#addDeductionModel" data-toggle="modal" class="btn btn-sm btn-primary add_more_btn" type="button">Add New Deduction</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Hourly Template</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Amount per:</label>
                                <div class="col-lg-9 m-t-sm">
                                    10 Hours
                                </div>
                            </div>
                          <!--   <div class="form-group">
                                <label class="col-lg-3 control-label">Department:</label>
                                <div class="col-lg-9">
                                </div>
                            </div>	 -->
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Status:</label>
                                <div class="col-lg-8 m-t-sm">
                                    {{ $employee->status }}
                                </div>

                            </div>	
                            <div class="form-group">
                                <label class="col-lg-3 control-label">Employee:</label>
                                <div class="col-lg-8">{{ $employee->name }}
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
        <div class="col-12">
                <center><button class="btn btn-primary  btn-block" type="submit">Save</button></center>
            </div>
        
        {{ Form::close() }}

        <!-- Allowance Modal -->
        <div id="addMoreAllowanceModel" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add New Allowance</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form role="form">
                                <div class="form-group">
                                    <label class="control-label">Allowance Name</label>
                                    <input type="text" name="allowance" placeholder="Enter New Allowance" class="form-control allowance" value="">
                                </div>
                                <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-sm btn-danger pull-right add_allowance m-l" type="button"><strong>Add</strong></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deduction Modal -->
        <div id="addDeductionModel" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add New Deduction</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <form role="form">
                                <div class="form-group">
                                    <label class="control-label">Deduction Name</label>
                                    <input type="text" name="deduction" placeholder="Enter New Deduction" class="form-control deduction" value="">
                                </div>
                                <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Cancel</button>
                                <button class="btn btn-sm btn-danger pull-right add_deduction m-l" type="button"><strong>Add</strong></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection