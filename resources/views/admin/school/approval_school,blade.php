@extends('admin.layouts.layout')
    @section('content')
<div class="div-padding">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                <div class="status-box">
                                    <h1>340</h1>
                                    <h6>Registered Schools</h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                <div class="status-box peach">
                                    <h1>320</h1>
                                    <h6>Active Schools</h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                <div class="status-box green">
                                    <h1>20</h1>
                                    <h6>Inactive Schools</h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                <div class="status-box blue">
                                    <h1>15+</h1>
                                    <h6>Courses</h6>
                                </div>
                            </div>
                        </div>
                        <div class="registration-form-outer">
                            <div class="login-form">
                                <h4>Registration</h4>
                                <div class="line"></div>
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="floatingInput" placeholder="abcdefghij" required>
                                              <label for="floatingInput">First Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="floatingPassword" placeholder="Password" required>
                                              <label for="floatingPassword">Last Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="floatingPassword" placeholder="Password" required>
                                              <label for="floatingPassword">Email Address</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="floatingPassword" placeholder="Password" required>
                                              <label for="floatingPassword">Phone Number</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="floatingPassword" placeholder="Password" required>
                                              <label for="floatingPassword">Username</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="floatingPassword" placeholder="Password" required>
                                              <label for="floatingPassword">Password</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="floatingPassword" placeholder="Password" required>
                                              <label for="floatingPassword">Confirm Password</label>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="checkboxes">
                                        <div>
                                            <label class="checkbox">
                                              <input type="checkbox">
                                              <span class="checkmark"></span>Codey Rocky Pre-assembled Edu robot
                                            </label>
                                        </div>    
                                        <div>
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
                                        </div>   
                                    </div> 
                                    <div class="d-flex justify-content-center align-items-center w-100">
                                        <button type="submit" name="submit" class="button">Register Now</button>
                                    </div>
                                </form>   
                            </div>    
                        </div>
                    </div>

        @endsection
