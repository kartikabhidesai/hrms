@extends('layouts.app')


@section('content')
<script>
    function highlightStar(obj) {
        removeHighlight();
        $('li').each(function (index) {
            $(this).addClass('highlight');
            if (index == $("li").index(obj)) {
                return false;
            }
        });
    }

    function removeHighlight() {
        $('li').removeClass('selected');
        $('li').removeClass('highlight');
    }

    function addRating(obj) {
        $('li').each(function (index) {
            $(this).addClass('selected');
            $('#rating').val((index + 1));
            if (index == $("li").index(obj)) {
                return false;
            }
        });
    }

    function resetRating() {
        if ($("#rating").val()) {
            $('li').each(function (index) {
                $(this).addClass('selected');
                if ((index + 1) == $("#rating").val()) {
                    return false;
                }
            });
        }
    }
</script>
<style>
    .orange-checked {
        color: orange;
    }
    table li{display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:19px;}
    .highlight, .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
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
                <form name="add-user" id="performance" class="form-horizontal" action="{{ route('addperformance') }}" method="post">
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

                    <div class="col-lg-12s rating">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                <table width="100%">
                                    <tr>
                                        <td><b>Availability:</b> 
                                            <input type="hidden" name="rating" id="rating" />
                                            <ul onMouseOut="resetRating();">
                                                <li onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
                                                <li onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
                                                <li onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
                                                <li onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
                                                <li onmouseover="highlightStar(this);" onmouseout="removeHighlight();" onClick="addRating(this);">&#9733;</li>
                                            </ul>
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
                                        <textarea class="form-control" name="notes_and_details" cols="4" rows="5"></textarea>
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
                    <div>
                        <input type="hidden" name="employee_id" value="{{$singleemployee['employee_id']}}">
                        <input type="hidden" name="department" value="{{$singleemployee['department']}}">
                        <input type="hidden" name="date_of_joining" value="{{$singleemployee['date_of_joining']}}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
