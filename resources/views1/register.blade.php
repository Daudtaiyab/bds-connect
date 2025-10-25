<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bds Frontend | Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <<link href="{{asset('public/asset/css')}}/bootstrap.min.css" rel="stylesheet">
    <script src="{{asset('public/asset/js')}}/bootstrap.bundle.min.js"></script>
    <link href="{{asset('public/asset/css')}}/style.css" rel="stylesheet">
</head>
<body>
    <div class="main-wrapper">
        <div class="white-box">
           <div class="registration-outer">
               <div class="container p-0 m-0">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <div class="registration-side-content">
                                <h4><span>Tech</span><br>yourself before you<br><span>wreck</span><br> yourself</h4>
                                <img src="{{asset('public/asset/img')}}/codey-robot.gif" width="100%">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="registration-form-outer">
                              @include('layouts.noftification')
                                <div class="login-form">
                                    <h4>Registration</h4>
                                    <div class="line"></div>
                                    <form action="{{ route('userregister') }}" method="post">
                                      @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="abcdefghij" required value="{{old('first_name')}}">
                                                  <label for="floatingInput">First Name</label>
                                                  <span style="color:red;">{{ $errors->first('first_name') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Password" required value="{{old('last_name')}}">
                                                  <label for="floatingPassword">Last Name</label>
                                                  <span style="color:red;">{{ $errors->first('last_name') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                  <input type="email" class="form-control" id="email" name="email" placeholder="Password" required value="{{old('email')}}">
                                                  <label for="floatingPassword">Email Address</label>
                                                  <span style="color: red;">{{$errors->first('email')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                  <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Password" required value="{{old('phone_number')}}">
                                                  <label for="floatingPassword">Phone Number</label>
                                                   <span style="color: red;">{{$errors->first('phone_number')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                  <input type="text" class="form-control" id="username" name="username" placeholder="Password" required value="{{old('username')}}">
                                                  <label for="floatingPassword">Username</label>
                                                  <span style="color: red;">{{$errors->first('username')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                  <input type="password" class="form-control" id="password"  name="password" placeholder="Password" required>
                                                  <label for="floatingPassword">Password</label>
                                                  <span style="color: red;">{{$errors->first('password')}}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3">
                                                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Password" required>
                                                  <label for="floatingPassword">Confirm Password</label>
                                                  <span style="color: red;">{{$errors->first('password_confirmation')}}</span>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-floating mb-3">
                                                  <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                                                  <label for="floatingPassword">Address</label>
                                                  <span style="color: red;">{{$errors->first('address')}}</span>
                                                </div>
                                            </div>

                                        </div>  
                                        <!-- <div class="checkboxes">
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
                                        </div>  --> 
                                        <div class="d-flex justify-content-center align-items-center w-100">
                                            <button type="submit" name="submit" class="button">Register Now</button>&nbsp;
                                            <a href="{{route('login')}}"><button type="button" name="submit" class="button">Login</button></a>
                                        </div>
                                    </form>   
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
           </div>                 
        </div>
    </div>
</body>
</html>