@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>All Order list</h5>
                    
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-company" id="dataTables-orderLIst">
                            <thead>
                                <tr>
                                    <th>Order Number</th>
                                    <th>Company Name</th>
                                    <th>Date</th>
                                    <th>Subscription</th>
                                    <th>Request Type</th>
                                    <th>Payment</th>
                                    <th>Order Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
<!--                                <tr class="gradeU">
                                    <td>748478</td>
                                    <td>All Company</td>
                                    <td>21/12/2018</td>
                                    <td>Pro</td>
                                    <td>New</td>
                                    <td>Free Trial</td>
                                    <td><span style="color: green"> Accept </span> |<span style="color: red"> Reject</span></td>
                                    <td><a href="#" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit">
                                                <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#cmsModel" data-toggle="modal" data-id="#" class="link-black text-sm cmsModel" data-original-title="Preview"> 
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        
                                        <a href="#deleteModel" data-toggle="modal" data-id="1" class="link-black text-sm CompanyDelete" data-original-title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a></td>
                                </tr>
                                
                                
                                
                                <tr class="gradeU">
                                    <td>758478</td>
                                    <td>The Star</td>
                                    <td>30/04/2018</td>
                                    <td>Premium</td>
                                    <td>Renewal Subscription</td>
                                    <td>Visa</td>
                                    <td><span style="color: green"> Accept </span> |<span style="color: red"> Reject</span></td>
                                    <td><a href="#" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit">
                                                <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#cmsModel" data-toggle="modal" data-id="#" class="link-black text-sm cmsModel" data-original-title="Preview"> 
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        
                                        <a href="#deleteModel" data-toggle="modal" data-id="1" class="link-black text-sm CompanyDelete" data-original-title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a></td>
                                </tr>
                                
                                <tr class="gradeU">
                                    <td>748478</td>
                                    <td>All Company</td>
                                    <td>21/12/2018</td>
                                    <td>Pro</td>
                                    <td>New</td>
                                    <td>Free Trial</td>
                                    <td><span style="color: green"> Accept </span> |<span style="color: red"> Reject</span></td>
                                    <td><a href="#" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit">
                                                <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#cmsModel" data-toggle="modal" data-id="#" class="link-black text-sm cmsModel" data-original-title="Preview"> 
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        
                                        <a href="#deleteModel" data-toggle="modal" data-id="1" class="link-black text-sm CompanyDelete" data-original-title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a></td>
                                </tr>-->
                            </tbody>
                            
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
