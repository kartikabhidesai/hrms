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
                        </div>
                    </div>
                    <div class="ibox-content">
                    	<div class="table-responsive">
                    		<table class="table table-striped table-bordered table-hover dataTables-example" id="timeChangeRequestDatatables">
                    			<thead>
                    				<tr>
                                        <th>Name</th>
                    					<th>Type</th>
                    					<th>Hours Requested</th>
                    					<th>Hours Available</th>
                                        <th>Department</th>
                                        <th>Date Submitted</th>
                    					<th>Date Requested</th>
                    					<th>Status</th>
                    				</tr>
                    			</thead>
                    			<tbody>
                                    <tr>
                                        <td>Bill Weeks</td>
                                        <td>Standard or basic hours</td>
                                        <td>8h</td>
                                        <td>8h</td>
                                        <td>IT</td>
                                        <td>Sunday (Feb 2, 2019)</td>
                                        <td>From: Apr 03, 2019 To: Apr 04, 2019</td>
                                        <td>Pending</td>
                                    </tr>
                    			</tbody>
                    		</table>
                    	</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
