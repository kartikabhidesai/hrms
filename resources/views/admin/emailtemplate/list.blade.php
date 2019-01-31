@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Manager Email Template</h5>
                    <div class="ibox-tools">
                        <a href="{{ route('add-email') }}" class="btn btn-primary dim" ><i class="fa fa-plus">   Create New Email Template</i></a>
                         
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-company" id="dataTables-company">
                            <thead>
                                <tr>
                                    <th>Template Name</th>
                                    <th>Type</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>                                    
                                <tr class="gradeU">
                                    <td>General Feedback</td>
                                    <td>Feedback</td>
                                    <td>2019-01-30 01:54:52</td>
                                    <td class="center">2019-01-30 01:54:52</td>
                                    <td class="center">
                                        <a href="{{ route('edit-email','1') }}" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" >
                                                <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#cmsModel" data-toggle="modal" data-id="#" class="link-black text-sm cmsModel" data-toggle="tooltip" data-original-title="Preview" > 
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        
                                        <a href="#deleteModel" data-toggle="modal" data-id="1" class="link-black text-sm CompanyDelete" data-original-title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                
                                <tr class="gradeU">
                                    <td>Review</td>
                                    <td>Review</td>
                                    <td>2019-01-29 01:54:52</td>
                                    <td class="center">2019-01-29 01:54:52</td>
                                    <td class="center">
                                        <a href="{{ route('edit-email','1') }}" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" >
                                                <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#cmsModel" data-toggle="modal" data-id="#" class="link-black text-sm cmsModel" data-toggle="tooltip" data-original-title="Preview" > 
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        
                                        <a href="#deleteModel" data-toggle="modal" data-id="1" class="link-black text-sm CompanyDelete" data-original-title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                
                                <tr class="gradeU">
                                    <td>Template Test</td>
                                    <td>Testing</td>
                                    <td>2019-01-28 01:54:52</td>
                                    <td class="center">2019-01-28 01:54:52</td>
                                    <td class="center">
                                        <a href="{{ route('edit-email','1') }}" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit" >
                                                <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="#cmsModel" data-toggle="modal" data-id="#" class="link-black text-sm cmsModel" data-toggle="tooltip" data-original-title="Preview" > 
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        
                                        <a href="#deleteModel" data-toggle="modal" data-id="1" class="link-black text-sm CompanyDelete" data-original-title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                            </tbody>
                            <!-- <tfoot>
                                    <tr>
                                            <th>Rendering engine</th>
                                            <th>Browser</th>
                                            <th>Platform(s)</th>
                                            <th>Engine version</th>
                                            <th>CSS grade</th>
                                    </tr>
                            </tfoot> -->
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
