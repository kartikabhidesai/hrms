@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Training List</h5>
                    <div class="ibox-tools">
                            <a href="{{ route('add-training') }}" class="btn btn-primary dim" ><i class="fa fa-plus"> Add</i></a>
                    </div>
                </div>
                
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="trainingTable">
                            <thead>
                                <tr>
                                    <th>Training ID</th>
                                    <th>training Name</th>
                                    <th>Assigned To</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                    <th>Complete Progress</th>
                                    <th>Info</th>
                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <tr>
                                    <td>1</td>
                                    <td>Design</td>
                                    <td>ABC</td>
                                    <td>High</td>
                                    <td>Pending</td>
                                    <td>50%</td>
                                    <td>Abcdef Abcdef Abcdef</td>
                                    <td>
                                        <a href="" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-eye"></i></a></td>
                                </tr>
                                
                                <tr>
                                    <td>2</td>
                                    <td>API</td>
                                    <td>ABC</td>
                                    <td>Normal</td>
                                    <td>Pending</td>
                                    <td>70%</td>
                                    <td>AbcdefAbcdefAbcdef Abcdef Abcdef</td>
                                    <td>
                                        <a href="" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-eye"></i></a></td>
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