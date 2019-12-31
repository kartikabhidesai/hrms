@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">

        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Payroll {{ $singleemployee['name'] }} List</h5>
                    <div class="ibox-tools">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a href="{{ route('payroll-add',array('id' => $empId)) }}" class="btn btn-primary dim" ><i class="fa fa-plus"> Add Payroll</i></a>
                        <!--  <a class="collapse-link">
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
                         </a> -->
                    </div>
                </div>
                {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','id' => '' )) }}
                <div class="col-lg-12s">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Employee Name : </label>
                                <div class="col-lg-3">
                                    <label class="m-t-xs">{{$singleemployee['name']}}</label>
                                </div>
                                <label class="col-lg-3 control-label">father Name : </label>
                                <div class="col-lg-3">
                                    <label class="m-t-xs">{{$singleemployee['father_name']}}</label>
                                </div>
                            </div> <div class="form-group">
                                <label class="col-lg-2 control-label">Date Of Birth : </label>
                                <div class="col-lg-3">
                                    <label class="m-t-xs">{{$singleemployee['date_of_birth']}}</label>
                                </div>
                                <label class="col-lg-3 control-label">Gender : </label>
                                <div class="col-lg-3">
                                    <label class="m-t-xs">{{$singleemployee['gender']}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="payrollEmployeeDatatables">
                            <thead>
                                <tr>
                                    <th>Basic Salary</th>
                                    <th>Month - Year</th>
                                    <th>Medical</th>
                                    <th>OverTime</th>
                                    <th>Transportation</th>
                                    <th>Status</th>
                                    <th>Travel</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
<!--                                @foreach($arrayPayroll as $tow => $val)
                                <tr>
                                  
                                    <td>{{ $val['basic_salary'] }}</td>
                                    <td>
                                        {{ $val['month'] == '1' ? 'January' : '' }} 
                                        {{ $val['month'] == '2' ? 'February' : '' }} 
                                        {{ $val['month'] == '3' ? 'March' : '' }} 
                                        {{ $val['month'] == '4' ? 'April' : '' }} 
                                        {{ $val['month'] == '5' ? 'May' : '' }} 
                                        {{ $val['month'] == '6' ? 'June' : '' }} 
                                        {{ $val['month'] == '7' ? 'July' : '' }} 
                                        {{ $val['month'] == '8' ? 'August' : '' }} 
                                        {{ $val['month'] == '9' ? 'September' : '' }} 
                                        {{ $val['month'] == '10' ? 'October' : '' }} 
                                        {{ $val['month'] == '11' ? 'November' : '' }} 
                                        {{ $val['month'] == '12' ? 'December' : '' }} 
                                        - {{ $val['year'] }}</td>
                                    <td>{{ $val['medical'] }}</td>
                                    <td>{{ $val['over_time'] }}</td>
                                    <td>{{$val['transportation']}}</td>
                                    <td>{{$singleemployee['status']}}</td>
                                    <td>{{$val['travel']}}</td>
                                    <td>
                                         <a href="{{ route('payroll-emp-detail',array('id'=>$singleemployee['id'])) }}" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-trash"></i></a> 
                                       <a href="{{ route('payroll-edit',array('id'=> $val['id'])) }}" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-edit"></i></a>
                                        <a href="#deleteModel" data-toggle="modal" data-id="{{ $val['id'] }}" class="link-black text-sm empDelete" data-toggle="tooltip" data-original-title="Delete" > <i class="fa fa-trash"></i></a>
                                        </td>
                                    </td>
                                    
                                </tr>
                                @endforeach-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
