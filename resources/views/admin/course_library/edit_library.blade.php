@extends('admin.layouts.layout')
    @section('content')
<div class="div-padding">
                        
                        <div class="registration-form-outer">
                            <div class="login-form">
                             @include('layouts.noftification')
                                <h4>Edit Course Level</h4>
                                <div class="line"></div>
                                <form action="{{route('editLibrary',$EditData->id)}}" method="post">
                                  @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <select  class="form-control" id="teaching_id" name="teaching_id" required="">
                                                <option value="">--Select Teaching Option--</option>
                                                @if(isset($TeachingOtption) && !empty($TeachingOtption))
                                                  @foreach($TeachingOtption as $options)
                                                    @if(in_array($options['id'],[\Config::get('constants.paidOption')]))
                                                    <option value="{{$options['id']}}" @if($EditData->teaching_id==$options['id']){{"selected"}} @endif>{{$options['option_name']}}</option>
                                                    @endif
                                                  @endforeach
                                                @endif
                                              </select>
                                              <label for="floatingInput">Select Teaching Option</label>
                                              <span style="color: red;">{{$errors->first('teaching_id')}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6" style="@if(\Config::get('constants.freeOption')==$EditData->teaching_id){{"display:none;"}}@endif" id="div_course">
                                            <div class="form-floating mb-3">
                                              <select  class="form-control" id="course_id" name="course_id">
                                                <option value="">--Select Course--</option>
                                                @if($EditData->teaching_id==\Config::get('constants.freeOption'))
                                                <option value="0" selected="">Free</option>
                                                @endif
                                                  @if(isset($CourseProduct) && !empty($CourseProduct))
                                                    @foreach($CourseProduct as $cproduct)
                                                      <option value="{{$cproduct['id']}}" @if($cproduct['id']==$EditData->course_id) {{"selected"}} @endif>{{$cproduct['course_name']}}</option>
                                                    @endforeach
                                                  @endif
                                              </select>
                                              <label for="floatingInput">Select Course</label>
                                              <span style="color: red;">{{$errors->first('course_id')}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <select  class="form-control" id="course_cat_id" name="course_cat_id" required="">
                                                <option value="">--Select Level Categroy--</option>
                                                @if(isset($CourseCategory) && !empty($CourseCategory))
                                                  @foreach($CourseCategory as $category)
                                                    <option value="{{$category['id']}}" @if($category['id']==$EditData->course_cat_id){{"selected"}} @endif>{{$category['category_name']}}</option>
                                                  @endforeach
                                                @endif
                                              </select>
                                              <label for="floatingInput">Select Course Categroy</label>
                                              <span style="color: red;">{{$errors->first('course_cat_id')}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6" id="level_div" style="@if(in_array($EditData->course_cat_id,[\Config::get('constants.freeVideo'),\Config::get('constants.paidVideo')])) {{'display: none;'}} @else {{'display:block;'}} @endif">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="name"  name="name" placeholder="Password"  value="{{$EditData->name}}">
                                              <label for="floatingPassword">Level Titile</label>
                                               <span style="color: red;">{{$errors->first('name')}}</span>
                                            </div>
                                        </div>
                                        
                                          
                                    
                                    <div class="d-flex justify-content-center align-items-center w-100">
                                        <button type="submit" name="submit" class="button">Update Level</button>
                                    </div>
                                </form>   
                            </div>    
                        </div>
                    </div>
          <script src="{{asset('public/asset/js')}}/jquery-3.6.1.min.js"></script>
      <script>
        $(document).ready(function(){
          $('#teaching_id').on('change',function(){
            var teaching_id=$(this).val();

            $.ajax({
              url:'{{route("ajax.getcategoryCoursePDFProject")}}',
              method:'post',
              type:'html',
              data:{'_token':'{{csrf_token()}}','teaching_id':teaching_id},
              success:function(data)
              {
                $('#course_cat_id').html(data);

                  $.ajax({
                      url:'{{route("ajax.getcourseProduct")}}',
                      method:'post',
                      type:'html',
                      data:{'_token':'{{csrf_token()}}','teaching_id':teaching_id},
                      success:function(data)
                      {
                        $('#course_id').html(data);
                      }
                    });
              }
            });

            //hide show
            var freeOption="{{\Config::get('constants.freeOption')}}";
            if(freeOption==teaching_id)
            {
              $('#div_course').css('display','none');
            }
            else
            {
              $('#div_course').css('display','block');
            }
            //hide show end
            
          });
        });

         $(document).ready(function(){

          freeVideo="{{\Config::get('constants.freeVideo')}}";
          paidVideo="{{\Config::get('constants.paidVideo')}}";

          $('#course_cat_id').on('click',function(){
            var course_cat_id=$(this).val();
            if(freeVideo==course_cat_id || paidVideo==course_cat_id)
            {
              $('#level_div').css('display','none');
            }
            else
            {
              $('#level_div').css('display','block');
            }

              
          });
        });

      </script>
        @endsection
