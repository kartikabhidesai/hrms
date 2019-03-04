@extends('layouts.app')


@section('content')
<style>
    .orange-checked {
        color: orange;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-2">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-info pull-right"></span>
                    <h5>Performance</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">90%</h1>
                    <h1 class="no-margins">Excellent</h1>
                    <div class="stat-percent font-bold text-info"></div>
                    <small></small>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Performance: {{ $singleemployee['name'] }}</h5>
                    <div class="ibox-tools">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                </div>
                {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal','id' => '' )) }}
                {{ csrf_field() }}
                <div class="col-lg-12s">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <table width="100%">
                                <tr>
                                    <td><b>Name:</b> {{$singleemployee['name']}}</td>
                                    <td><b>Department:</b> {{$singleemployee['department_name']}}</td>
                                    <td><b>Started Date:</b> {{$singleemployee['date_of_joining']}}</td>
                                    <td><b>Employeement Level: </b>80</td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 20px;"><b>Supervisor:</b> Abbas Ahmad</td>
                                    <td style="padding-top: 20px;"><b>Branch:</b> Riyad</td>
                                    <td style="padding-top: 20px;"><b>Date:</b> 09/09/2018</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12s">
                    <div class="ibox float-e-margins">
                        <div class="ibox-content">
                            <table width="100%">
                                <tr>
                                    <td><b>Availability:</b> 
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                    </td>
                                    <td><b>Depandiablility:</b> 
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                    </td>
                                    <td><b>Job Knowledge:</b> 
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                    </td>
                                    <td><b>Quality: </b>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding-top: 20px;">
                                        <b>Productivity:</b>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                    </td>
                                    <td style="padding-top: 20px;">
                                        <b>Working Relationship:</b>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                    </td>
                                    <td style="padding-top: 20px;">
                                        <b>Honesty:</b>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                    </td>
                                    <td style="padding-top: 20px;">
                                        <b>Quality:</b>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                        <span class="fa fa-star orange-checked"></span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12s">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <div class="form-group">
                                <label class="col-lg-1 control-label">Notes & Details</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control" cols="4" rows="5"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-1 control-label">Attachment</label>
                                <div class="col-lg-9">
                                    <input type="file" name="attachment" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-1 col-lg-10">
                                    <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
