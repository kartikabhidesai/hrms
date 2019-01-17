@extends('layouts.app')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
	   <div class="row">
            <div class="col-lg-12">
			{{ csrf_field() }}
			    <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Department  List</h5>
                        <div class="ibox-tools">
                             <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        	<a href="{{ route('department-add') }}" class="btn btn-primary dim" ><i class="fa fa-plus"> Add</i></a>
                        </div>
                    </div>
                    <div class="ibox-content">
                    	<div class="table-responsive">
                    		<table class="table table-striped table-bordered table-hover dataTables-example" id="DepartmentDatatables">
                    			<thead>
                                    <tr>
                                        <th>Department Name</th>
                        				<th>Designation</th>
                        				<th>Total Employees</th>
                        				<th>Action</th>
                                    </tr>
                    			</thead>
                    			<tbody>
                    			</tbody>
                    		</table>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
