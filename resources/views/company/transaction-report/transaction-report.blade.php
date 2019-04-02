@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Transaction Report</h5>
                </div>
                <div class="ibox-content">
                   {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'transactionPDF' )) }}  
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Transaction Date</label>
                            <div class="col-sm-9">
                                <select class="form-control transaction" required="true"  id="transaction" name="transaction">
                                    <option value="All" selected>All Transaction</option>
                                    <option value="3_months">Last 3 Months Transaction</option>
                                    <option value="6_months">Last 6 Months Transaction</option>
                                    <option value="last_year">Last Year Transaction</option>
                                    <option value="specific_date">Or Choose by Specific Date</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group from_date"  style="display: none;">
                            <label class="col-lg-2 control-label">From Date</label>
                            <div class="col-sm-9">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="from_date"   placeholder="Select From Date" class="form-control" value="" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-group to_date" style="display: none;">
                            <label class="col-lg-2 control-label">To Date</label>
                            <div class="col-sm-9">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="to_date"  placeholder="Select To Date" class="form-control" value=""  autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <!-- <input type="hidden" name="emparray" id="emparray" class="emparray"> -->
                        <input type="hidden" name="downloadstatus" id="downloadstatus" class="downloadstatus">
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-sm btn-primary downloadPdf" type="submit">Download Pdf</button>
                            </div>
                        </div>
                </div>
            </div>
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Histort of Downloaded Report</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-company" >
                            <thead>
                                <tr>
                                    <th>Number Of Report</th>
                                    <th>Download Date</th>
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
