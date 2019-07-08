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
    body {
}

body {
  font-family:"Open Sans", Helvetica, Arial, sans-serif;
  color:#555;
  /*max-width:680px;*/
 /* margin:0 auto;
  padding:0 20px;*/
}

* {
  -webkit-box-sizing:border-box;
  -moz-box-sizing:border-box;
  box-sizing:border-box;
}

*:before, *:after {
-webkit-box-sizing: border-box;
-moz-box-sizing: border-box;
box-sizing: border-box;
}

.clearfix {
  clear:both;
}

.text-center {text-align:center;}

a {
  color: tomato;
  text-decoration: none;
}

a:hover {
  color: #2196f3;
}

pre {
display: block;
padding: 9.5px;
margin: 0 0 10px;
font-size: 13px;
line-height: 1.42857143;
color: #333;
word-break: break-all;
word-wrap: break-word;
background-color: #F5F5F5;
border: 1px solid #CCC;
border-radius: 4px;
}

.header {
  padding:20px 0;
  position:relative;
  margin-bottom:10px;
  
}

.header:after {
  content:"";
  display:block;
  height:1px;
  background:#eee;
  position:absolute; 
  left:30%; right:30%;
}

.header h2 {
  font-size:3em;
  font-weight:300;
  margin-bottom:0.2em;
}

.header p {
  font-size:14px;
}



#a-footer {
  margin: 20px 0;
}

.new-react-version {
  padding: 20px 20px;
  border: 1px solid #eee;
  border-radius: 20px;
  box-shadow: 0 2px 12px 0 rgba(0,0,0,0.1);
  
  text-align: center;
  font-size: 14px;
  line-height: 1.7;
}

.new-react-version .react-svg-logo {
  text-align: center;
  max-width: 60px;
  margin: 20px auto;
  margin-top: 0;
}

.success-box {
  margin:50px 0;
  padding:10px 10px;
  border:1px solid #eee;
  background:#f9f9f9;
}

.success-box img {
  margin-right:10px;
  display:inline-block;
  vertical-align:top;
}

.success-box > div {
  vertical-align:top;
  display:inline-block;
  color:#888;
}



/* Rating Star Widgets Style */
.rating-stars ul {
  list-style-type:none;
  padding:0;
  
  -moz-user-select:none;
  -webkit-user-select:none;
}
.rating-stars ul > li.star,li.product,li.know,li.qlt,li.work,li.honest,li.available {
  display:inline-block;
      font-size: 13px;
}

/* Idle State of the stars */
.rating-stars ul > li.star,li.product,li.know,li.qlt,li.work,li.honest,li.available > i.fa {
  color:#ccc; /* Color on idle state */
}

/* Hover state of the stars */
.rating-stars ul > li.star.hover,li.product.hover,li.know.hover,li.qlt.hover,li.work.hover,li.honest.hover,li.available.hover > i.fa {
  color:#FFCC36;
}

/* Selected state of the stars */
.rating-stars ul > li.star.selected, li.product.selected, li.know.selected, li.qlt.selected, li.work.selected, li.honest.selected, li.available.selected > i.fa {
  color:#FF912C;
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
 
<section class='rating-widget'>
  
  <!-- Rating Stars Box -->
 
  
  
</section>

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Performance: {{ $singleemployee['name'] }}</h5>
                    <div class="ibox-tools">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </div>
                </div>
                <form name="add-user" id="performance" enctype="multipart/form-data" class="form-horizontal" action="{{ route('addperformance') }}" method="post">
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
                                            <input type="hidden" name="availableVal" id="availableVal" />
                                            <input type="hidden" name="depandiablity" id="depandiablity" />
                                            <input type="hidden" name="jobKnow" id="jobKnow" />
                                            <input type="hidden" name="productivityVal" id="productivityVal" />
                                            <input type="hidden" name="qualityVal" id="qualityVal" />
                                            <input type="hidden" name="workingVal" id="workingVal" />
                                            <input type="hidden" name="honestyVal" id="honestyVal" />
                                         

                                            <div class='rating-stars text-center'>
                                                <ul id='availability'>
                                                  <li class='available' title='Poor' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='available' title='Fair' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='available' title='Good' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='available' title='Excellent' data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='available' title='WOW!!!' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                </ul>
                                              </div>

                                        </td>
                                        <td><b>Depandiablility:</b> 
                                            <div class='rating-stars text-center'>
                                                <ul id='stars'>
                                                  <li class='star' title='Poor' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Fair' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Good' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='Excellent' data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                  <li class='star' title='WOW!!!' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                  </li>
                                                </ul>
                                              </div>
                                        </td>
                                        <td><b>Job Knowledge:</b> 
                                            <div class='rating-stars text-center'>
                                            <ul id='knowledge' class="knowledge">
                                                <li class='know' title='Poor' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='know' title='Fair' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='know' title='Good' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='know' title='Excellent' data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='know' title='WOW!!!' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                            </ul>
                                        </div>
                                        </td>
                                        <td><b>Quality: </b>
                                            <ul id='quality' class="quality">
                                                <li class='qlt' title='Poor' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='qlt' title='Fair' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='qlt' title='Good' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='qlt' title='Excellent' data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='qlt' title='WOW!!!' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-top: 20px;">
                                            <b>Productivity:</b>
                                            <div class='rating-stars text-center'>
                                            <ul id='productivity' class="knowledge">
                                                <li class='product' title='Poor' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='product' title='Fair' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='product' title='Good' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='product' title='Excellent' data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='product' title='WOW!!!' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td style="padding-top: 20px;">
                                            <b>Working Relationship:</b>
                                           <div class='rating-stars text-center'>
                                            <ul id='working' class="knowledge">
                                                <li class='work' title='Poor' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='work' title='Fair' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='work' title='Good' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='work' title='Excellent' data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='work' title='WOW!!!' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                            </ul>
                                        </div>
                                        </td>
                                        <td style="padding-top: 20px;">
                                           <b>Honesty:</b>
                                           <div class='rating-stars text-center'>
                                            <ul id='honesty' class="knowledge">
                                                <li class='honest' title='Poor' data-value='1'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='honest' title='Fair' data-value='2'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='honest' title='Good' data-value='3'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='honest' title='Excellent' data-value='4'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                                <li class='honest' title='WOW!!!' data-value='5'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>
                                            </ul>
                                           </div>
                                        </td>
                                       <!--  <td style="padding-top: 20px;">
                                            <b>Quality:</b>
                                            <span class="fa fa-star orange-checked"></span>
                                            <span class="fa fa-star orange-checked"></span>
                                            <span class="fa fa-star orange-checked"></span>
                                            <span class="fa fa-star orange-checked"></span>
                                            <span class="fa fa-star orange-checked"></span>
                                        </td> -->
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12s">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Notes & Details</label>
                                    <div class="col-lg-9">
                                        <textarea class="form-control" name="notes_and_details" cols="4" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Attachment</label>
                                    <div class="col-lg-9">
                                        <input type="file" name="attachment" class="form-control">
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Year</label>
                                    <div class="col-sm-9">
                                        <select class="form-control year" id="year" name="year">
                                            @for($i = 2019;$i<= 2022;$i++)
                                            <option value="{{  $i }}">{{  $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Month</label>
                                    <div class="col-sm-9">
                                        {{ Form::select('months', $monthis , null, array('class' => 'form-control months', 'id' => 'months')) }}
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
                        <input type="hidden" name="employee_id" value="{{$empId}}">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
