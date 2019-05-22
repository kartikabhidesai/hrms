@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <form action="{{url('')}}/admin/finance-report" method="post" id="pdfForm">
        {{ csrf_field() }}
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"></span>
                    <h5>For Time Period</h5>
                </div>
                <div class="ibox-content">
                    <select class="form-control monthreport" id="monthreport" name="monthreport">
                      <option value="">select</option>
                      <option value="1-months">1 Month</option>
                      <option value="3-months">3 Months</option>
                      <option value="6-months">6 Months</option>
                      <option value="1-year">Last Year</option>
                      <option value="custom">All</option>
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
                    <input type="submit" id="downloadPDF" class="btn btn-sm btn-primary" value="Download as PDF">
                </div>
            </div>
        </div>
        </form>

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
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-financeReport">
                            <thead>
                                <tr>
                                    <th>Number of Report</th>
                                    <th>Downloaded Report TimePeriod</th>
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
