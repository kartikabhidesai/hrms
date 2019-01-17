@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5>Add Department</h5>
					<div class="ibox-tools">
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</div>
				</div>
				<div class="ibox-content">
                    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'department-add' )) }}
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Department Name</label>
                            <div class="col-lg-10">
                                    {{ Form::text('department_name', null, array('placeholder'=>'Department Name', 'class' => 'form-control department_name' ,'required')) }}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Designation</label>
                            <div class="col-lg-10">
                                    {{ Form::text('designation[]', null, array('placeholder'=>'Designation', 'class' => 'form-control designation' ,'required')) }}
                            </div>
                        </div>
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