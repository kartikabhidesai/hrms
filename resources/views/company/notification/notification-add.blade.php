@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">

<div class="row">

    <div class="col-lg-12">
        {{ csrf_field() }}
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Sent Notification List</h5>
                <div class="ibox-tools">
                   
                </div>
            </div>
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" id="">
                        <thead>
                            <tr>
                               
                                <th>Name</th>
                                <th>Description</th>
                                <th>Notification Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            
                                @foreach($notifiactionList as $row)
                                @php 
                                $typearray=[];
                                $typearray=$row->type;
                             
                                @endphp
                                <tr class="gradeU">
                                    <td>{{$row->notification_name}}</td>
                                    
                                    <td>{{$row->description}}</td>
                                    <td>
                                        SMS <input type="checkbox" data-id="{{ $row->id }}" data-value="1" class="sentNoti" name="SMS" {{ (($typearray[0] == 1))? ' checked="checked"' : '' }}> <br/> 
                                        Email <input type="checkbox" data-id="{{ $row->id }}" data-value="2" class="sentNoti" name="Email" {{ (($typearray[1] == 1))? ' checked="checked"' : '' }}> <br/> 
                                        <!--Chat <input type="checkbox" data-id="{{ $row->id }}" data-value="3" class="sentNoti" name="Chat" {{ (($typearray[2] == 1))? ' checked="checked"' : '' }}><br/>--> 
                                        In system notify <input data-value="4" data-id="{{ $row->id }}" class="sentNoti" type="checkbox" {{ (($typearray[3] == 1))? ' checked="checked"' : '' }} name="system">
                                    </td> 
                                    <td class="center">
                                    <input type="checkbox" class="custom-switch" <?php if($row->status==1){ echo "checked"; } ?> name="{{$row->id}}">
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
<script type="text/javascript">

</script>

