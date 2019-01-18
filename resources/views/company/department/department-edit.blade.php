@extends('layouts.app')
@section('content')
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
                            <label class="col-lg-2 control-label">Designation</label>
                            <div class="col-lg-10 editRemovediv">
                                @foreach($detail->designation as $designation)
                                    <div class="col-lg-10">
                                        {{ Form::text('designation[]', $designation->designation_name, array('placeholder'=>'Designation', 'class' => 'form-control designation' ,'required', 'style' => 'margin-left:-15px')) }} 
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="button" class="red form-control editRemovebtn" value="Remove">
                                    </div>
                                    <br><br><br>
                                @endforeach
                            </div>
                        </div>
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