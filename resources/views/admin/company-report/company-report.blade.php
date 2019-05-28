@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <form action="{{ route('company-report') }}" method="post" id="pdfForm">
        {{ csrf_field() }}
        <div class="col-lg-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"></span>
                    <h5>Select Time Period</h5>
                </div>
                <div class="ibox-content">
                    <select class="form-control time_period" required="true" id="status" name="status">
                      <option value="">Status</option>
                      <option value="ACTIVE">Active</option>
                      <option value="DE-ACTIVE">DE-active</option>
                      <option value="All">All</option>
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
                    <button id="downloadPDF" class="btn btn-sm btn-primary" type="submit">Download as PDF</button>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
            </div>
        </div>
</form>
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>History of Downloaded Report</h5>
                    <div class="ibox-tools">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" id="dataTables-companyReport">
                            <thead>
                                <tr>
                                    <th>Number of Report</th>
                                    <th>Status</th>
                                    <th>Download Date</th>
                                    <th>Action</th>
                                </tr> 
                            </thead>
                            {{-- <tbody>
                                @foreach($companyReportArray as $row => $val)

                                    <tr>
                                        <td>{{ $val->company_report_number }}</td>
                                        <td>{{ $val->status }}</td>
                                        <td>{{ $val->download_date }}</td>
                                        <td class="center">
                                            <a href="javascript:;"  data-id="{{ $val->id }}"  data-department="{{ $val->id }}"  class="link-black text-sm singlePdfDownload" data-toggle="tooltip" data-original-title="View"><i class="fa fa-eye"></i>
                                            </a>
                                            <a href="#deleteModel" data-toggle="modal" data-id="{{ $val->id }}" class="link-black text-sm ticketDelete" data-original-title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody> --}}
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
