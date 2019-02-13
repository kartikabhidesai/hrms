@extends('layouts.app')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                {{ csrf_field() }}
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Approved Advance Salary List</h5>
                        <input class="c-input" type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="approvedRequestlist">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Department Name</th>
                                        <th>Request Date</th>
                                        <th>Approval Date</th>
                                        <th>Comments</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <div class="col-lg-12">
                                        <button id="DownloadButton" type="button">Download as PDF</button>
                                    </div>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
