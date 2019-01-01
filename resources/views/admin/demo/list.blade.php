@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-lg-12">
			{{ csrf_field() }}
			<div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Demo Datatables</h5>
                        <div class="ibox-tools">
                        	<a href="{{ route('add-demo') }}" class="btn btn-primary dim" ><i class="fa fa-plus"> Add</i></a>
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
                    		<table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-example">
                    			<thead>
                    				<tr>
                    					<th>#id</th>
                    					<th>First Name</th>
                    					<th>Last Name</th>
                    					<th>Gender</th>
                    					<th>Date</th>
                    					<th>Action</th>
                    				</tr>
                    			</thead>
                    			<tbody>
                    				<!-- <tr class="gradeU">
                    					<td>Other browsers</td>
                    					<td>All others</td>
                    					<td>-</td>
                    					<td class="center">-</td>
                    					<td class="center">U</td>
                    				</tr> -->
                    			</tbody>
                    			<!-- <tfoot>
                    				<tr>
                    					<th>Rendering engine</th>
                    					<th>Browser</th>
                    					<th>Platform(s)</th>
                    					<th>Engine version</th>
                    					<th>CSS grade</th>
                    				</tr>
                    			</tfoot> -->
                    		</table>
                    	</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    <script type="text/javascript">

    </script>