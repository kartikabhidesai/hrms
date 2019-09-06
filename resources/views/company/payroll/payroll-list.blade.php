@extends('layouts.app')
@section('content')


<div class="wrapper wrapper-content animated fadeInRight">
    {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'paySlip' )) }}
    <div class="row">
        <div class="col-lg-12">
            {{ csrf_field() }}
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                   <h5>Payroll Employee List</h5>
               </div>
               <div class="ibox-content">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Department:</label>
                    <div class="col-sm-9">
                        {{ Form::select('department', ['all' => 'All Department'] +$department , isset($departmentId) ? $departmentId : null , array('class' => 'form-control ', 'id' => 'department')) }}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Employee Name:</label>
                    <div class="col-sm-9">
                        {{ Form::select('employee',['all' => 'All employee'] + $employee , isset($employeeId) ? $employeeId : '', array('class' => 'form-control ', 'id' => 'employee')) }}
                    </div>
                </div>
                <input type="hidden" name="emparray[]" id="emparray" class="emparray">

                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-sm btn-primary applyBtn" type="button">Apply</button>&nbsp;&nbsp;
                        <button class="btn btn-sm btn-default clearBtn" type="button">Clear</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="ibox-content">

    <div class="table-responsive">
       <table class="table table-striped table-bordered table-hover dataTables-example" id="payrollDatatables">
        <thead>
            <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Salary</th>
                <th>Grade</th>
                <th>DOJ</th>
                <th>Bank Info</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(count($allemployee) > 0)
            @foreach($allemployee as $singleemp)

            <tr>
                <td>{{$singleemp->name}}</td>
                <td>{{$singleemp->department_name}}</td>
                <td>{{$singleemp->basic_salary}}</td>
                <td>{{$singleemp->grade}}</td>
                <td>{{ date('d-m-Y',strtotime($singleemp->date_of_joining)) }}</td>
                <td> 
                    <a href="#updateBankModel" class="updateBankModel" data-toggle="modal" data-id="{{ $singleemp->id }}"  title="Update" data-toggle="tooltip" data-original-title="Update">Update</a></a>
                </td>
                <td> 
                    <a href="{{ route('payroll-emp-detail',array('id'=>$singleemp->id)) }}" class="link-black text-sm" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-eye"></i></a>
                </td>
            </tr>
            @endforeach
            @endif

        </tbody>
    </table>

</div>

{{ Form::close() }}
</div>
</div>
<div id="updateBankModel" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Bank Details</h4>
            </div>
            {{ Form::open( array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'updateBank' )) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Account Holder Name</label>
                            <div class="col-sm-9">
                                <input type="text" name="account_holder_name"  class="form-control account_holder_name">
                                <input type="hidden" name="empId"  class="form-control empId" id="empId">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Account Number</label>
                            <div class="col-sm-9">
                                <input type="text" name="account_number"  class="form-control account_number">
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-sm-2 control-label">Bank name</label>
                            <div class="col-sm-9">
                                <input type="text" name="bank_name"  class="form-control bank_name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Branch</label>
                            <div class="col-sm-9">
                                <input type="text" name="branch"  class="form-control branch" id="branch">
                            </div>
                         </div>
                     </div>
                 </div>
             </div>
              <div class="modal-footer">
            <div class="col-lg-offset-1 col-lg-11">
                &nbsp;&nbsp;&nbsp; 
                <button class="btn btn-sm btn-defaut pull-right m-l" data-dismiss="modal">Close</button>
                <button class="btn btn-sm btn-primary pull-right updatetask" type="submit">Update</button>
            </div>
        </div>
         {{ Form::close() }}
    </div>
</div>
</div>
@endsection
