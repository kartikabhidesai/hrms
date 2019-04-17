@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Role list</h5>
                    <div class="ibox-tools">
                        <a href="{{ route('add-role') }}" class="btn btn-primary dim" ><i class="fa fa-plus">   Create New Role</i></a>
                         
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-company" id="dataTables-company">
                            <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Department</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>  
                            @foreach($roleArray as $row  => $val)
                                <tr class="gradeU">
                                    <td>{{ $val['user_name'] }} </td>
                                    <td>{{ $val['email'] }} </td>
                                    <td>{{ $val['status'] }} </td>
                                    <td>{{ $ArrDepartment[$val['department']] }} </td>
                                    <td>{{ $role[$val['role']] }} </td>
                                    <td class="center">
                                        <a href="{{ route('edit-role', $val['id']) }}" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" >
                                                <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#deleteModel" data-toggle="modal" data-id="{{  $val['id'] }}" class="link-black text-sm roleDelete" data-original-title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach    
                            </tbody>
                            
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
