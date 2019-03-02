@extends('layouts.app')
@section('content')
<!-- <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Payroll Employee List</h5>
                    <div class="ibox-tools">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="payrollDatatables">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Salary</th>
                                    <th>Grade</th>
                                    <th>DOJ</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($allemployee) > 0)
                                @foreach($allemployee as $singleemp)

                                <tr>
                                    <td>{{$singleemp->name}}</td>
                                    <td>{{$singleemp->department_name}}</td>
                                    <td>{{$singleemp->joining_salary}}</td>
                                    <td>Grade</td>
                                    <td>{{ date('d-m-Y',strtotime($singleemp->date_of_joining)) }}</td>
                                    <td> 
                                        <a href="{{ route('payroll-emp-detail',array('id'=>$singleemp->id)) }}" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-eye"></i></a></td>
                                </tr>
                                @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="wrapper wrapper-content animated fadeInRight">
    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'paySlip' )) }}
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                     <h5>Payroll Employee List</h5>
                </div>
                <div class="ibox-content">

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Department:</label>
                        <div class="col-sm-9">
                            {{ Form::select('department', ['all' => 'All Department'] +$department , isset($departmentId) ? $departmentId : null , array('class' => 'form-control ', 'id' => 'department')) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Employee Name:</label>
                        <div class="col-sm-9">
                            {{ Form::select('employee',['all' => 'All employee'] + $employee , isset($employeeId) ? $employeeId : '', array('class' => 'form-control ', 'id' => 'employee')) }}
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
       
        <div class="table-responsive">
             <table class="table table-striped table-bordered table-hover dataTables-example" id="payrollDatatables">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Salary</th>
                                    <th>Grade</th>
                                    <th>DOJ</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                <tbody>
                    @if(count($allemployee) > 0)
                                @foreach($allemployee as $singleemp)

                                <tr>
                                    <td>{{$singleemp->name}}</td>
                                    <td>{{$singleemp->department_name}}</td>
                                    <td>{{$singleemp->joining_salary}}</td>
                                    <td>Grade</td>
                                    <td>{{ date('d-m-Y',strtotime($singleemp->date_of_joining)) }}</td>
                                    <td> 
                                        <a href="{{ route('payroll-emp-detail',array('id'=>$singleemp->id)) }}" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-eye"></i></a></td>
                                </tr>
                                @endforeach
                                @endif
                   
                </tbody>
            </table>
            
        </div>
       
        {{ Form::close() }}
    </div>
</div>

@endsection
