@extends('layouts.app')
@section('content')

<div class="wrapper wrapper-content animated fadeInRight">
    
    @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @endif

	<div class="row">
		<div class="col-lg-12">
			{{ csrf_field() }}
			<div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Tickets Comments</h5>
                        <div class="ibox-tools">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-6">
                                Task : {{$taskDetails[0]['task']}}
                            </div>
                            <div class="col-lg-6">
                                Priority : {{$taskDetails[0]['department_name']}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                Employee Name : {{ $taskDetails[0]['name'] }} {{ $taskDetails[0]['father_name'] }}
                            </div>
                            <div class="col-lg-6">
                                Assign Date : {{ date("d-m-Y",strtotime($taskDetails[0]['assign_date'])) }}
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                Department Name : {{ $taskDetails[0]['department_name'] }}
                            </div>
                            <div class="col-lg-6">
                                Manager Name : {{ $taskDetails[0]['manager_name']}}
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                Priority : {{ $taskDetails[0]['priority'] }}
                            </div>
                            <div class="col-lg-6">
                                Location : {{ $taskDetails[0]['location']}}
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                Complete Progress : {{ $taskDetails[0]['complete_progress'] }}%
                            </div>
                            <div class="col-lg-6">
                                Task Status : {{ $taskprocess[$taskDetails[0]['task_status']] }}
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12">
                                About Task : {{ $taskDetails[0]['about_task']}}
                            </div>
                        </div>
                   
                         <div class="row">
                                <div class="col-lg-12">
                                    <h2>Comments:</h2>
                                        @foreach($ticket_comment as $row)
                                            <div class="social-feed-box">
                                                <div class="social-avatar">
                                                    <a href="" class="pull-left">
                                                        @if(!empty($row['photo']))
                                                        <img alt="image" src="{{ asset('uploads/client/'.$row['photo']) }}">
                                                        @else
                                                        <img alt="image" src="{{ asset('img/profile_small.jpg') }}">
                                                        @endif
                                                    </a>
                                                    <div class="media-body">
                                                        <a href="#">
                                                            {{$row['name']}}
                                                        </a>
                                                        <small class="text-muted">{{ date('d-m-Y h:i a', strtotime($row['created_at'])) }}</small>
                                                    </div>
                                                </div>
                                                <div class="social-body">
                                                    <p>
                                                        {{ $row['comments'] }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                </div>
                                {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'addEmpTaskComment' )) }}
                                    <input type="hidden" class="form-control" required="" name="task_id" value="{{ $taskDetails[0]['id']}}">

                                    <div class="col-lg-12">
                                        <textarea class="form-control" required="" name="comments"  placeholder="Comments"></textarea>
                                    <div>

                                    <div class="col-lg-offset-11 col-lg-1" style="padding-top:5px">
                                        <button class="btn btn-sm btn-primary" type="submit">Send</button>
                                    </div>
                                {{ Form::close() }}
                            </div>
                        
                    </div>
                </div>
                          
            </div>
        </div>
    </div>
  </div></div>
@endsection