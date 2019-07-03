@extends('layouts.app')
@section('content')

@php

$designation=$detail->designation;
@endphp
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'department-edit' )) }}
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Edit Department</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','files' => true, 'id' => 'department-edit' )) }}
                        <div class="form-group"><label class="col-lg-2 control-label">Department Name</label>
                            <div class="col-lg-9">
                                {{ Form::text('department_name', $detail->department_name, array('placeholder'=>'Department Name', 'class' => 'form-control department_name' ,'required')) }}
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Manager Name</label>
                            <div class="col-lg-10">
                                    {{ Form::text('manager_name', $detail->manager_name, array('placeholder'=>'Manager Name', 'class' => 'form-control ' ,'required')) }}
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Co-Manager Name</label>
                            <div class="col-lg-10">
                                    {{ Form::text('comanager_name', $detail->co_manager_name, array('placeholder'=>'Co Manager Name', 'class' => 'form-control ' ,'required')) }}
                            </div>
                        </div>
                        
                        @for($i = 0 ;$i < count($designation); $i++)
                            @if($i == 0)
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Designation</label>
                                <div class="col-lg-10">
                                    <input placeholder="Designation" class="form-control designation" required="" name="designation[]" type="text" aria-required="true" value="{{ $designation[$i]['designation_name'] }}">
                                        
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Supervisor Name</label>
                                <div class="col-lg-10">
                                    <input placeholder="Supervisor Name" class="form-control" required="" name="supervisor_name[]" type="text" aria-required="true" value="{{ $designation[$i]['supervisor_name'] }}">
                                        
                                </div>
                            </div>
                            
                            @else
                                <div class="removediv">
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>
                                        <div class="col-lg-8">
                                                {{ Form::text('designation[]', $designation[$i]['designation_name'], array('placeholder'=>'Designation', 'class' => 'form-control designation' ,'required')) }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-2 control-label"></label>
                                        <div class="col-lg-8">
                                                {{ Form::text('supervisor_name[]', $designation[$i]['supervisor_name'], array('placeholder'=>'Supervisor Name', 'class' => 'form-control ' ,'required')) }}
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="button" class="red form-control removebtn" value="Remove">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endfor
                        {{ Form::hidden('edit_id', $detail->id, array('class' => '')) }}
                            <div class="add_designation_div">
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-8">
                                        <input class="btn btn-sm add_designation" type="button" value="Add More Designation">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-sm btn-primary" type="submit">Save Department</button>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>  
        </div>
    </div>
@endsection