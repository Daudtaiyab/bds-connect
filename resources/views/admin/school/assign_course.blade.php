@extends('admin.layouts.layout')
    @section('content')
       <div class="div-padding">
                        <div class="admin-heading">
                            <h4>All Courses</h4>
                            <div class="line"></div>
                        </div>
                        <form method="post" action="{{route('AssignCourseToUserSave')}}">
                            @csrf
                            <input type="hidden" name="editId" value="{{$userData->id}}">
                            <div class="products">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <!-- start loop -->
                                    @php
                                        $oldArr=[];
                                    @endphp
                                    @if(isset($CourseList) && !empty($CourseList))
                                        @foreach($CourseList as $coursedata)
                                    <div class="col-md-4 mb-4">
                                        <label for="codeyrockey_{{$coursedata['id']}}">
                                            <input type="checkbox" id="codeyrockey_{{$coursedata['id']}}" class="checkbox" value="{{$coursedata['id']}}" name="courseassign[]" @if(in_array($coursedata['id'],$AssignUserCourse)) {{'checked'}} {{'disabled'}} @endif>
                                            
                                            @if(in_array($coursedata['id'],$AssignUserCourse))
                                                <input type="hidden" id="codeyrockey_{{$coursedata['id']}}" class="checkbox" value="{{$coursedata['id']}}" name="courseassign[]">
                                            @endif
                                            
                                            <div class="card">
                                                <div class="card-img">
                                                    <img src="{{asset('public/uploads/product')}}/{{$coursedata['course_img']}}" width="100%">
                                                </div>
                                                <div class="card-info">
                                                    <p class="text-title">{{$coursedata['course_name']}} </p>
                                                    <div class="button no-border">Assign Course</div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    @if(in_array($coursedata['id'],$AssignUserCourse)) 
                                    
                                        <input type="hidden" name="OldCourse[]" value="{{$coursedata['id']}}">
                                     @endif
                                    @endforeach
                                    @endif
                                    
                                    <div class="d-flex justify-content-center align-items-center w-100">
                                        <button type="submit" name="submit" class="button">Assign Course</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>    
                    </div>
             <script src="{{asset('public/asset/js')}}/jquery-3.6.1.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#edittable').DataTable({
                scrollY: true,
                scrollX: true,
            });
        });
    </script>        
    @endsection