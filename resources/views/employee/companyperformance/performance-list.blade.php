@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'performanceStatus' )) }}
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                
               <div class="ibox-content">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Department:</label>
                    <div class="col-sm-9">
                        {{ Form::select('department', ['' => 'All Department'] +$department , isset($departmentId) ? $departmentId : null , array('class' => 'form-control ', 'id' => 'department')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Employee Name:</label>
                    <div class="col-sm-9">
                        {{ Form::select('employee',['' => 'All employee'] + $employee , isset($employeeId) ? $employeeId : '', array('class' => 'form-control ', 'id' => 'employee')) }}
                    </div>
                </div>
                <input type="hidden" name="emparray[]" id="emparray" class="emparray">

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
                    
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" id="performanceTable">
                <thead>
                    <tr>
                    <td><input type="checkbox" class="checkAll" id="checkAll" name="checkAll"></td>
                        <th>Name</th>
                        <th>Department</th>
                        <!-- <th>Salary</th> -->
                        <th>DOJ</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- @if(count($allEmployee) > 0)
                        @foreach($allEmployee as $singleemp)
                            <tr>
                                <td>{{$singleemp->name}}</td>
                                <td>{{$singleemp->department_name}}</td>
                             
                                <td>{{ date('d-m-Y',strtotime($singleemp->date_of_joining)) }}</td>
                                <td>
                                    <a href="{{ route('employee-performance-list',array('id'=>$singleemp->id)) }}" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif -->
                </tbody>
            </table>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <!-- <a href="{{ route('performance-download-pdf') }}" class="btn btn-primary dim" > Download as PDF</a> -->
                <button class="btn btn-sm btn-primary downloadPdf" type="button">Download Pdf</button>
                </div>
            </div>
        </div>
        {{ Form::close() }}
    </div></div>
@endsection
