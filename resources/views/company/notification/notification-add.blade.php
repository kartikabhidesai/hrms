@extends('layouts.app')
@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
<!--    <div class="row">
       <div class="col-lg-12">  
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Sent Notification</h5>
            </div>
            <div class="ibox-content" style="height: 95px !important;">
                <div class="form-group">
                 <div class="col-lg-2">
                    Department 
                </div>
                <div class="col-sm-3">
                  SMS <input type="checkbox" name=""> <br/> 
                  Chat <input type="checkbox" name=""><br/> 
                  In system notify <input type="checkbox" name="">
              </div> 
              <div class="col-lg-2">
                 Purchases <input type="checkbox" name=""> <br/> 
                 Storage <input type="checkbox" name=""><br/> 
                 Finance <input type="checkbox" name=""> 
             </div>
             <div class="col-sm-3">
                 Business Deve. <input type="checkbox" name=""> <br/> 
                 Marketing <input type="checkbox" name=""><br/> 
                 Event And Planing <input type="checkbox" name="">
             </div>
             <div class="col-sm-2">
              Add More <a href="javascript:;" class="btn btn-xs btn-primary"><i class="fa fa-plus"></i> </a>
          </div>
      </div>
  </div>
</div>
</div>
</div>-->

<div class="row">

    <div class="col-lg-12">
        {{ csrf_field() }}
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Sent Notification List</h5>
                <div class="ibox-tools">
                    <!-- <a href="{{ route('add-demo') }}" class="btn btn-primary dim" ><i class="fa fa-plus"> Add</i></a> -->
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
                                <tr class="gradeU">
                                    <td>{{$row->notification_name}}</td>
                                    <td>{{$row->description}}</td>
                                    <td>{{$row->description}}</td>
                                    <td class="center">
                                    <input type="checkbox" class="custom-switch" <?php if($row->status==1){ echo "checked"; } ?> name="{{$row->id}}">
                                    </td>
                                </tr>
                                @endforeach
                                <!-- <tr class="gradeU">
                                    <td >Tihs onee is new addred task</td>
                                    <td>
                                        SMS <input type="checkbox" name=""> <br/> 
                                        Chat <input type="checkbox" name=""><br/> 
                                        In system notify <input type="checkbox" name="">
                                    </td>
                                    <td>To all Employee</td>
                                    <td class="center">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox"  class="onoffswitch-checkbox" id="example2">
                                                <label class="onoffswitch-label" for="example2">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="gradeU">
                                    <td >Reports <br/>Inform to employee when leave are accepted.</td>
                                    <td>
                                        SMS <input type="checkbox" name=""> <br/> 
                                        Chat <input type="checkbox" name=""><br/> 
                                        In system notify <input type="checkbox" name="">
                                    </td>
                                    <td>To all Employee</td>
                                    <td class="center">
                                        <div class="switch">
                                            <div class="onoffswitch">
                                                <input type="checkbox"  class="onoffswitch-checkbox" id="example3">
                                                <label class="onoffswitch-label" for="example3">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </td>
                                </tr> -->
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

