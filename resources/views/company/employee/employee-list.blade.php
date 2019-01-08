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
                        	<a href="{{ route('employee-add') }}" class="btn btn-primary dim" ><i class="fa fa-plus"> Add</i></a>
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
                    		<table class="table table-striped table-bordered table-hover dataTables-example" id="employeeDatatables">
                    			<thead>
                    				<tr>
                                        <th>Email</th>
                    					<th>Name</th>
                    					<th>Last Name</th>
                    					<th>Gender</th>
                                        <th>DOJ</th>
                                        <th>Phone</th>
                    					<th>Employee Id</th>
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
