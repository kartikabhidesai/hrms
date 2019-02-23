@extends('layouts.app')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
         <div class="row">
            <div class="col-lg-12">
            {{ csrf_field() }}
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Attendance Report</h5>
                    </div>
                    <div class="ibox-content">
                        {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'showReport' )) }}

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Year</label>
                            <div class="col-sm-9"> 
                                <select class="form-control year" id="year" name="year">
                                    <option value="" selected="">Select Year</option>
                                        @for ($year=2015; $year <= 2099; $year++)
                                            <option value="{{ $year }}" >{{ $year }}</option>
                                        @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Month</label>
                            <div class="col-sm-9"> 
                                <select class="form-control month" id="month" name="month">
                                    <option value="" selected="">Select Month</option>
                                    @if(isset($getAttedanceReport))
                                        <option value="1" {{ ($get_month == 'January' ? 'selected="selected"' : '') }}>January</option>
                                        <option value="2" {{ ($get_month == 'February' ? 'selected="selected"' : '') }}>February</option>
                                        <option value="3" {{ ($get_month == 'March' ? 'selected="selected"' : '') }}>March</option>
                                        <option value="4" {{ ($get_month == 'April' ? 'selected="selected"' : '') }}>April</option>
                                        <option value="5" {{ ($get_month == 'May' ? 'selected="selected"' : '') }}>May</option>
                                        <option value="6" {{ ($get_month == 'June' ? 'selected="selected"' : '') }}>June</option>
                                        <option value="7" {{ ($get_month == 'July' ? 'selected="selected"' : '') }}>July</option>
                                        <option value="8" {{ ($get_month == 'August' ? 'selected="selected"' : '') }}>August</option>
                                        <option value="9" {{ ($get_month == 'September' ? 'selected="selected"' : '') }}>September</option>
                                        <option value="10" {{ ($get_month == 'October' ? 'selected="selected"' : '') }}>October</option>
                                        <option value="11" {{ ($get_month == 'November' ? 'selected="selected"' : '') }}>November</option>
                                        <option value="12" {{ ($get_month == 'December' ? 'selected="selected"' : '') }}>December</option>
                                    @else
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                 <button id="applyBtn" class="btn btn-sm btn-primary applyBtn" type="button">Filter</button>
                                 <button id="clearBtn" class="btn btn-sm btn-default clearBtn" type="button">Clear</button>
                                 <button id="DownloadButton" class="btn btn-sm btn-primary " type="button">Download as PDF</button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>

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
                            <table class="table table-striped table-bordered table-hover dataTables-example" id="approvedRequestlist1">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Department Name</th>
                                        <th>Request Date</th>
                                        <th>Approval Date</th>
                                        <th>Comments</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datalist as $row => $val)
        
                                    <tr>
                                        <td><input type="checkbox" class="approved_chk_id" name="approved_chk_id" value="{{ $val['id'] }}"></td>
                                        <td>{{ $val['name'] }}</td>
                                        <td>{{ $val['department_name'] }}</td>
                                        <td>{{ date('d-m-Y',strtotime($val['date_of_submit'])) }}</td>
                                        <td>{{ date('d-m-Y',strtotime($val['updated_at'])) }}</td>
                                        <td>{{ $val['comments'] }}</td>
                                        <td>
                                            @if($val["status"] == 'approve') 
                                                <span class="label label-success">Approved</span>
                                            @else
                                                {{ $val["status"] }}
                                             @endif    
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
