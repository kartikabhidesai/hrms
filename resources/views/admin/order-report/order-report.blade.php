@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        {{ csrf_field() }}
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"></span>
                    <h5>Plan</h5>
                </div>
                <div class="ibox-content">
                    <select class="form-control monthreport" id="status" name="status">
                      <option value="">select</option>
                      <option value="basic">Basic</option>
                      <option value="premium">Premium</option>
                      <option value="pro">Pro</option>
                      <option value="all">All</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"></span>
                </div>
                <div class="ibox-content">
                    <button id="downloadPDF" class="btn btn-sm btn-primary" type="button">Download as PDF</button>
                    <form action="{{url('')}}/company/client-report" method="post" id="pdfForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="form_time_period" name="time_period" value="">
                        <input type="hidden" id="form_date_period" name="date_period" value="">
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>History of Downloaded Report</h5>
                    <div class="ibox-tools">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-clientReport">
                            <thead>
                                <tr>
                                    <th>Number of Report</th>
                                    <th>Downloaded Time</th>
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
