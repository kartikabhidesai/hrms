@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
   

	<div class="row">
		<div class="col-lg-12">
			{{ csrf_field() }}
			<div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Tickets Comments</h5>
                        <div class="ibox-tools">
                            
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-6">
                                Code : {{$ticket_details['code']}}
                            </div>
                            <div class="col-lg-6">
                                Subject : {{$ticket_details['subject']}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                Status : {{$ticket_details['status']}}
                            </div>
                            <div class="col-lg-6">
                                Priority : {{$ticket_details['priority']}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                             
                                Details : {{$ticket_details['details']}}
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
                                {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'addTicketComment' )) }}
                                <input type="hidden" class="form-control" required="" name="ticket_id" value="{{$ticket_details['id']}}">
                                
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
   
    @endsection
