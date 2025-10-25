@extends('admin.layouts.layout')
    @section('content')
    <?php
    $statusArr=[1=>'Active',0=>'Inactive'];
    ?>
<div class="div-padding">
                        <div class="registration-form-outer">
                            <div class="login-form">
                                <h4>Registration Approval</h4>
                                <div class="line"></div>
                                <form action="{{route('SaveApproval')}}" method="post">
                                  @csrf
                                  <input type="hidden" name="editId" value="{{$userData->id}}">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="floatingInput" placeholder="abcdefghij" required value="{{$userData->first_name}}" name="first_name">
                                              <label for="floatingInput">First Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="floatingPassword" placeholder="Password" required value="{{$userData->last_name}}" name="last_name">
                                              <label for="floatingPassword">Last Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                              <input type="email" class="form-control" id="floatingPassword" placeholder="Password" required value="{{$userData->email}}" name="email">
                                              <label for="floatingPassword">Email Address</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="floatingPassword" placeholder="Password" required value="{{$userData->phone_number}}" name="phone_number">
                                              <label for="floatingPassword">Phone Number</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="floatingPassword" placeholder="Password" required value="{{$userData->username}}" name="username">
                                              <label for="floatingPassword">Username</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="floatingPassword" placeholder="Password" required value="{{$userData->wifi_address}}" name="wifi_address">
                                              <label for="floatingPassword">Wifi Address</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <select id="status" name="status" class="form-control" required="">
                                                @foreach($statusArr as $skey=>$svalue)
                                                  <option value="{{$skey}}" @if($skey==$userData->status) {{"selected"}} @endif>{{$svalue}}</option>
                                                @endforeach
                                                
                                              </select>
                                              <label for="floatingPassword">Status</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                  <input type="text" class="form-control" id="address" name="address" placeholder="Address" required value="{{$userData->address}}">
                                                  <label for="floatingPassword">Address</label>
                                                  <span style="color: red;">{{$errors->first('address')}}</span>
                                                </div>
                                            </div>
                                       
                                    </div>  
                                     {{-- <div class="checkboxes">
                                      @if(isset($CourseList) && !empty($CourseList))
                                        @foreach($CourseList as $coursedata)
                                         <div>
                                            <label class="checkbox">
                                              <input type="checkbox" value="{{$coursedata['id']}}" name="courseassign[]" @if(in_array($coursedata['id'],$AssignUserCourse)) {{'checked'}} @endif>
                                              <span class="checkmark"></span>{{$coursedata['course_name']}}
                                            </label>
                                        </div>
                                        @endforeach
                                      @endif 
                                           
                                        <!-- <div>
                                            <label class="checkbox">
                                              <input type="checkbox">
                                              <span class="checkmark"></span>Codey Rocky Neuron Classroom kit
                                            </label>
                                        </div>    
                                        <div>
                                            <label class="checkbox">
                                              <input type="checkbox">
                                              <span class="checkmark"></span>mBot Basic DIY Robotic Edu kit 
                                            </label>
                                        </div>    
                                        <div>
                                            <label class="checkbox">
                                              <input type="checkbox">
                                              <span class="checkmark"></span>Add-on pack Perception Gizmo for mBot
                                            </label>
                                        </div>    
                                        <div>
                                            <label class="checkbox">
                                              <input type="checkbox">
                                              <span class="checkmark"></span>Add-on pack Variety Gizmo for mBot
                                            </label>
                                        </div>    
                                        <div>
                                            <label class="checkbox">
                                              <input type="checkbox">
                                              <span class="checkmark"></span>Halo Code DIY STEM Edu kit
                                            </label>
                                        </div>    
                                        <div>
                                            <label class="checkbox">
                                              <input type="checkbox">
                                              <span class="checkmark"></span>Cyber Pi Go Practical Python Edu kit
                                            </label>
                                        </div>    
                                        <div>
                                            <label class="checkbox">
                                              <input type="checkbox">
                                              <span class="checkmark"></span>Snap-on Electronic Edu kit 390 experiments
                                            </label>
                                        </div>    
                                        <div>
                                            <label class="checkbox">
                                              <input type="checkbox">
                                              <span class="checkmark"></span>Airblock Edu kit for Drones and Air propelled Vehicles.
                                            </label>
                                        </div> -->   
                                    </div> 
                                     --}}
                                    <div class="d-flex justify-content-center align-items-center w-100">
                                        <button type="submit" name="submit" class="button">Approve Now</button>
                                    </div>
                                </form>   
                            </div>    
                        </div>
                    </div>

        @endsection
