@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Employee List</h5>
                    <div class="ibox-tools">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           <!-- <a href="{{ route('employee-add') }}" class="btn btn-primary dim" ><i class="fa fa-plus"> Add</i></a> -->
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
<!--                                <tr>
                                    <td>mohmood</td>
                                    <td>IT</td>
                                    <td>10000 SR</td>
                                    <td>12,35.45</td>
                                    <td>80</td>
                                    <td>
                                        <a href="{{ route('payroll-emp-detail',array('id'=>1)) }}" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-eye"></i></a></td>
                                </tr>-->
                                @if(count($allemployee) > 0)
                                @foreach($allemployee as $singleemp)

                                <tr>
                                    <td>{{$singleemp->name}}</td>
                                    <td>{{$singleemp->department}}</td>
                                    <td>{{$singleemp->joining_salary}}</td>
                                    <td>Grade</td>
                                    <td>{{$singleemp->date_of_joining}}</td>
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
</div>
@endsection
