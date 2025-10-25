@extends('admin.layouts.layout')
    @section('content')
<div class="div-padding">
                        
                        <div class="registration-form-outer">
                            <div class="login-form">
                             @include('layouts.noftification')
                                <h4>Add Course</h4>
                                <div class="line"></div>
                                <form action="{{route('addCourse')}}" method="post" enctype="multipart/form-data">
                                  @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <select  class="form-control" id="teaching_id" name="teaching_id" required="">
                                                <option value="">--Select Teaching Option--</option>
                                                @if(isset($TeachingOtption) && !empty($TeachingOtption))
                                                  @foreach($TeachingOtption as $options)
                                                    <option value="{{$options['id']}}" selected="">{{$options['option_name']}}</option>
                                                  @endforeach
                                                @endif
                                              </select>
                                              <label for="floatingInput">Select Teaching Option</label>
                                              <span style="color: red;">{{$errors->first('teaching_id')}}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="course_name"  name="course_name" placeholder="Password" required value="{{old('course_name')}}">
                                              <label for="floatingPassword">Course Titile</label>
                                               <span style="color: red;">{{$errors->first('course_name')}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="file" class="form-control" id="course_img"  name="course_img" placeholder="Password" required value="{{old('course_name')}}">
                                              <label for="floatingPassword">Course Image</label>
                                               <span style="color: red;">{{$errors->first('course_img')}}</span>
                                            </div>
                                        </div>
                                        
                                          
                                    
                                    <div class="d-flex justify-content-center align-items-center w-100">
                                        <button type="submit" name="submit" class="button">Add Course</button>
                                    </div>
                                </form>   
                            </div>    
                        </div>
                    </div>

        @endsection
