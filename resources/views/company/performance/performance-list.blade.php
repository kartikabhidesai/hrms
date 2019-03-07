@extends('layouts.app')
@section('content')
    <div class="ibox-content">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" id="payrollDatatables">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Department</th>
                        <!-- <th>Salary</th> -->
                        <th>DOJ</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($allEmployee) > 0)
                        @foreach($allEmployee as $singleemp)
                            <tr>
                                <td>{{$singleemp->name}}</td>
                                <td>{{$singleemp->department_name}}</td>
                                <!-- <td>{{$singleemp->joining_salary}}</td> -->
                                <td>{{ date('d-m-Y',strtotime($singleemp->date_of_joining)) }}</td>
                                <td>
                                    <a href="{{ route('employee-performance-list',array('id'=>$singleemp->id)) }}" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
