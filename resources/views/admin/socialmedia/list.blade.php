@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Social Media</h5>
                    
                    <div class="ibox-tools">
                        <a href="{{ route('manage-account') }}" class="btn btn-default  dim" ><i class="fa fa-cog">   Manage Accounts</i></a>
                        <a href="{{ route('new-post') }}" class="btn btn-success  dim" ><i class="fa fa-plus">   New Post</i></a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-company" id="dataTables-company">
                            <thead>
                                <tr>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Delivery</th>
                                </tr>
                            </thead>
                            <tbody>  
                                <tr class="gradeU">
                                    <td>ABCDEF</td>
                                    <td><i class="fa fa-check" style="color:#1bb394;"></i> &nbsp; Sent</td>
                                    <td>2019-12-01 04:30:59 am</td>                                    
                                </tr>
                                
                                <tr class="gradeU">
                                    <td>PQRSTUV</td>
                                    <td><i class="fa fa-times" style="color:red;"></i> &nbsp; Failed</td>
                                    <td>2019-12-01 04:30:59 am</td>                                    
                                </tr>
                                
                                <tr class="gradeU">
                                    <td>ABCDEF</td>
                                    <td><i class="fa fa-exchange"  style="color:orange;"></i> &nbsp; Pending</td>
                                    <td>2019-12-01 04:30:59 am</td>                                    
                                </tr>
                                
                                <tr class="gradeU">
                                    <td>ABCDEF</td>
                                    <td><i class="fa fa-check" style="color:#1bb394;"></i> &nbsp; Sent</td>
                                    <td>2019-12-01 04:30:59 am</td>                                    
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
