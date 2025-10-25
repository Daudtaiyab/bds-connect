@extends('admin.layouts.layout')
    @section('content')
<div class="div-padding">
                        
                        <div class="registration-form-outer">
                            <div class="login-form">
                             @include('layouts.noftification')
                                <h4>Add Course Lesson</h4>
                                <div class="line"></div>
                                <form action="{{route('addLesson')}}" method="post" enctype="multipart/form-data">
                                  @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <select  class="form-control" id="teaching_id" name="teaching_id" required="">
                                                <option value="">--Select Teaching Option--</option>
                                                @if(isset($TeachingOtption) && !empty($TeachingOtption))
                                                  @foreach($TeachingOtption as $options)
                                                   @if(in_array($options['id'],[\Config::get('constants.paidOption')]))
                                                    <option value="{{$options['id']}}" selected="">{{$options['option_name']}}</option>
                                                    @endif
                                                  @endforeach
                                                @endif
                                              </select>
                                              <label for="floatingInput">Select Teaching Option</label>
                                              <span style="color: red;">{{$errors->first('teaching_id')}}</span>
                                            </div>
                                        </div>

                                         <div class="col-md-6" id="div_course">
                                            <div class="form-floating mb-3">
                                              <select  class="form-control" id="course_id" name="course_id">
                                                <option value="">--Select Course--</option>
                                                @if(isset($courseProduct) && !empty($courseProduct))
                                                  @foreach($courseProduct as $cdata)
                                                    <option value="{{$cdata->id}}">{{$cdata->course_name}}</option>
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
                                                  @foreach($CourseCategory as $clist)
                                                    <option value="{{$clist->id}}">{{$clist->category_name}}</option>
                                                  @endforeach
                                                @endif
                                              </select>
                                              <label for="floatingInput">Select Course Categroy</label>
                                              <span style="color: red;">{{$errors->first('course_cat_id')}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6" id="div_level1">
                                            <div class="form-floating mb-3">
                                              <select  class="form-control" id="level_id" name="level_id" >
                                                <option value="">--Select Level--</option>
                                              </select>
                                              <label for="floatingInput">Select Level</label>
                                              <span style="color: red;">{{$errors->first('level_id')}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="lesson_title"  name="lesson_title" placeholder="Password" required value="{{old('lesson_title')}}">
                                              <label for="floatingPassword">Lesson Title</label>
                                               <span style="color: red;">{{$errors->first('lesson_title')}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="lesson_subject"  name="lesson_subject" placeholder="Password" required value="{{old('lesson_subject')}}">
                                              <label for="floatingPassword">Lesson Subject</label>
                                               <span style="color: red;">{{$errors->first('lesson_subject')}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6" id="div_lesson_document" style="display: none;">
                                            <div class="form-floating mb-3">
                                              <input type="file" class="form-control" id="lesson_document"  name="lesson_document" placeholder="Password" value="{{old('lesson_document')}}">
                                              <label for="floatingPassword">Lesson Document</label>
                                               <span style="color: red;">{{$errors->first('lesson_document')}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6" id="div_lesson_video" style="display: none;">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="lesson_video"  name="lesson_video" placeholder="Password" value="{{old('lesson_video')}}">
                                              <label for="floatingPassword">Lesson Video</label>
                                               <span style="color: red;">{{$errors->first('lesson_video')}}</span>
                                            </div>
                                        </div>

                                        <div class="col-md-12" id="div_lesson_iframe_code" style="display: none;">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="lesson_iframe_code"  name="lesson_iframe_code" placeholder="Password" value="{{old('lesson_iframe_code')}}">
                                              <label for="floatingPassword">Lesson Iframe Code</label>
                                               <span style="color: red;">{{$errors->first('lesson_iframe_code')}}</span>
                                            </div>
                                        </div>

                                        <!-- multiple code cum library start-->
                                         <div class="panel panel-default" id="div_code_lib" style="display: none;">  
                                            <div class="panel-heading"> Add More Product Cum library product </div>  
                                            <div class="panel-body">  
                                                <div class="input-group control-group after-add-more">
                                                  <div class="col-md-6"> 
                                                  <input type="text" name="code_title[]" class="form-control" placeholder="Enter Name Here">
                                                  </div> 

                                                  <div class="col-md-6"> 
                                                  <input type="file" name="code_file[]" class="form-control" placeholder="Enter Name Here">
                                                  </div>   
                                                  <div class="input-group-btn">   
                                                    <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add New</button>  
                                                  </div> 

                                                </div>  
                                          
                                                  
                                          
                                                <!-- Copy Fields -->  
                                                <div class="copy hide">  
                                                  <div class="control-group input-group" style="margin-top:10px">  
                                                    <div class="col-md-6"> 
                                                  <input type="text" name="code_title[]" class="form-control" placeholder="Enter Name Here">
                                                  </div> 

                                                  <div class="col-md-6"> 
                                                  <input type="file" name="code_file[]" class="form-control" placeholder="Enter Name Here">
                                                  </div>  
                                                    <div class="input-group-btn">   
                                                      <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>  
                                                    </div>  
                                                  </div>  
                                                </div>  
                                          
                                            </div>  
                                          </div>
                                        <!-- multiple code cum library end -->
                                        
                                          
                                    
                                    <div class="d-flex justify-content-center align-items-center w-100">
                                        <button type="submit" name="submit" class="button">Add Lesson</button>
                                    </div>
                                </form>   
                            </div>    
                        </div>
                    </div>
          <script src="{{asset('public/asset/js')}}/jquery-3.6.1.min.js"></script>
          <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">   -->
      <script>
        $(document).ready(function(){
          $('#teaching_id').on('change',function(){
            var teaching_id=$(this).val();
            $.ajax({
              url:'{{route("ajax.getcategoryCourse")}}',
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

              //getlevel from course category
              $('#course_cat_id').on('change',function(){
                  var course_cat_id=$(this).val();
                  var teaching_id=$('#teaching_id').val();
                  var course_id=$('#course_id').val();
                  $.ajax({
                          url:'{{route("ajax.getcourseLevel")}}',
                          method:'post',
                          type:'html',
                          data:{'_token':'{{csrf_token()}}','course_cat_id':course_cat_id,'teaching_id':teaching_id,'course_id':course_id},
                          success:function(data)
                          {
                            $('#level_id').html(data);
                          }
                        });

                  var freePdf="{{\Config::get('constants.freePdf')}}";
                  var freeVideo="{{\Config::get('constants.freeVideo')}}";
                  var freeProject="{{\Config::get('constants.freeProject')}}";
                  var paidPdf="{{\Config::get('constants.paidPdf')}}";
                  var paidVideo="{{\Config::get('constants.paidVideo')}}";
                  var paidProject="{{\Config::get('constants.paidProject')}}";
                  //alert(freeProject);
                  if(course_cat_id==freePdf || course_cat_id==paidPdf)
                  {
                    $('#div_lesson_iframe_code').css('display','block');
                    $('#div_code_lib').css('display','none');
                    $('#div_lesson_video').css('display','none');
                    $('#div_level').css('display','block');
                  }

                  else if(course_cat_id==freeVideo || course_cat_id==paidVideo)
                  {
                    $('#div_lesson_iframe_code').css('display','none');
                    $('#div_code_lib').css('display','none');
                    $('#div_lesson_video').css('display','block');
                     $('#div_level').css('display','none'); 
                  }

                  else if(course_cat_id==freeProject || course_cat_id==paidProject)
                  {
                    $('#div_lesson_iframe_code').css('display','none');
                    $('#div_code_lib').css('display','block');
                    $('#div_lesson_video').css('display','none'); 
                     $('#div_level').css('display','block');
                  }
                  else
                  {
                    $('#div_lesson_iframe_code').css('display','none');
                    $('#div_code_lib').css('display','none');
                    $('#div_lesson_video').css('display','none'); 
                     $('#div_level').css('display','block');
                  }
              });
        });
        $(document).ready(function() {  
  
      $(".add-more").click(function(){   
          var html = $(".copy").html();  
          $(".after-add-more").after(html);  
      });  
  
      $("body").on("click",".remove",function(){   
          $(this).parents(".control-group").remove();  
      });  
  
    });  
      </script>
        @endsection
