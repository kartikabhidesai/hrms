@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <form action="{{url('')}}/admin/plan-package-report" method="post" id="pdfForm">
        {{ csrf_field() }}
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"></span>
                    <h5>Plan</h5>
                </div>
                <div class="ibox-content">
                    <select class="form-control monthreport" id="subcription" name="subcription" required="required">
                        @if(isset($planmanagement))
                            <option value="">Select</option>
                            @foreach($planmanagement as $value)
                                <option value="{{$value->code}}">{{$value->title}}</option>
                            @endforeach
                        @endif
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
                    <button type="submit" id="downloadPDF" class="btn btn-sm btn-primary" type="button">Download as PDF</button>
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
                        <table class="table table-striped table-bordered table-hover" id="dataTables-planAndPackageReport">
                            <thead>
                                <tr>
                                    <th>Number of Report</th>
                                    <th>Downloaded Report Subscription</th>
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
