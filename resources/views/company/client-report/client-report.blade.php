@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        {{ csrf_field() }}
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"></span>
                    <h5>Select Time Period</h5>
                </div>
                <div class="ibox-content">
                    <select class="form-control time_period" id="time_period" name="time_period">
                      <option value="">select</option>
                      <option value="3-months">3 Months</option>
                      <option value="6-months">6 Months</option>
                      <option value="1-year">1 Year</option>
                      <option value="custom">Choose by date</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"></span>
                    <h5>Select Date</h5>
                </div>
                <div class="ibox-content input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="date_period" id="date_period"  class="form-control date" placeholder="Date" disabled="disabled">
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"></span>
                    <!-- <h5>Select Date</h5> -->
                </div>
                <div class="ibox-content">
                    <!-- <button class="btn btn-sm btn-primary" type="button">Check</button> -->&nbsp;&nbsp;
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
