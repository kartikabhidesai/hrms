<form method="POST" accept-charset="UTF-8" class="form-horizontal" id="addRole">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}">
                        <div class="hidden">
                            <input type="text" name="companyId" value="{{ $companyId }}">
                        </div>

                    <div class="form-group">
                        <label class="col-lg-2 control-label"></label>
                         <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" class="employeeType" value="existingEmployee" name="employeeType" checked="checked">&nbsp;Existing Employee
                                        </label>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="i-checks">
                                        <label>
                                            <input type="radio" class="employeeType" value="newEmployee" name="employeeType" >&nbsp;New Employee
                                        </label>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group"><label class="col-lg-2 control-label">Employee Name</label>
                        <div class="col-lg-9">
                            <select class="form-control" name="employeeId" id="employeeId">
                                <option value="">Select employee</option>
                                @foreach($employeeList as $key => $value)
                                <option value="{{ $value['user_id'] }}">{{ $value['name']  }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>

                    <div class="form-group"><label class="col-lg-2 control-label">Role</label>
                        <div class="col-lg-9">
                            @php
                            $count = 1;
                            @endphp
                            @for($i = 0 ;$i < count($masterPermission);$i++,$count++)
                                <div class="c-choice c-choice--checkbox col-lg-4">
                                    <input class="roleCheckbox" value="{{ $masterPermission[$i]->id }}" id="checkbox{{ $count }}" name="role[]" type="checkbox">
                                    <label class="c-choice__label" for="checkbox{{ $count }}">{{ $masterPermission[$i]->name }}</label>
                                </div>
                            @endfor
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-9">
                            <button class="btn btn-sm btn-primary" type="submit">Save</button>
                        </div>
                    </div>
           </form>