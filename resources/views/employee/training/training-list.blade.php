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
                          
                    </div>
                </div>
                
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="trainingTable">
                            <thead>
                                <tr>
                                    <th>Training Location</th>
                                    <th>Budget</th>
                                    <th>Requirement</th>
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

<div id="trainingDetailsModel" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View Training Details</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        {{ Form::open( array('method' => 'post','files' => true, 'class' => 'form-horizontal', 'id' => 'taskDetailsModel' )) }}
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="col-sm-4 control-label">Location Name : </label>
                                <div class="col-sm-8">
                                    <span class="location_name"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="col-sm-4 control-label"> Department Name : </label>
                                <div class="col-sm-8">
                                    <span class="dept_name"></span>
                                </div>
                            </div>
                        </div>
                          <div class="form-group">
                            <div class="col-sm-12">
                                <label class="col-sm-4 control-label"> Budget : </label>
                                <div class="col-sm-8">
                                    <span class="budget"></span>
                                </div>
                            </div>
                        </div>
                          <div class="form-group">
                            <div class="col-sm-12">
                                <label class="col-sm-4 control-label"> Requirement : </label>
                                <div class="col-sm-8">
                                    <span class="requirement"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="col-sm-4 control-label"> Number : </label>
                                <div class="col-sm-8">
                                    <span class="number"></span>
                                </div>
                            </div>
                        </div>
                       
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form role="form">
                    <button class="btn btn-sm btn-primary pull-right m-l" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection