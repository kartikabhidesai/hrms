@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add New Role</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
        

                <div class="ibox-content">
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'editRole' )) }}
                    <div class="form-group"><label class="col-lg-2 control-label">User</label>
                        <div class="col-lg-9">
                            {{ Form::text('user_name', $roleArray['user_name'], array('class' => 'form-control' ,'required')) }}
                        </div>
                    </div>
                    <input type="hidden" name="role_id" value="{{ $roleArray['id'] }}">
                    <div class="form-group"><label class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-9">
                            {{ Form::text('email', $roleArray['email'], array('class' => 'form-control' ,'required')) }}
                        </div>
                    </div>  
                  <!--   <div class="form-group"><label class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-9">
                            {{ Form::text('password', null, array('class' => 'form-control' ,'required')) }}
                        </div>
                    </div> --> 

                    <div class="form-group"><label class="col-lg-2 control-label">Status</label>
                        <div class="col-lg-9">
                            {{ Form::select('status', $status, $roleArray['status'], array('class' => 'form-control', 'id' => 'status','required')) }}
                        </div>
                    </div>
                         
                    <div class="form-group"><label class="col-lg-2 control-label">Department</label>
                        <div class="col-lg-9">
                            {{ Form::select('department', $ArrDepartment, $roleArray['department'], array('class' => 'form-control', 'id' => 'status','required')) }}
                        </div>
                    </div>
                      
                    <div class="form-group"><label class="col-lg-2 control-label">Role</label>
                        <div class="col-lg-9">
                            {{ Form::select('role', $role, $roleArray['role'], array('class' => 'form-control', 'id' => 'status','required')) }}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-9">
                            <button class="btn btn-sm btn-primary" type="submit">Save</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection
