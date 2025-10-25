@extends('admin.layouts.layout')
    @section('content')
       <div class="div-padding">
                        <div class="admin-heading">
                            <h4>Course Lesson Managment</h4>
                            <div class="line"></div>
                        </div>
                        <div class="filter-data">
                             <div class="row mb-4">
                                <!-- <div class="col-md-4">
                                    <div class="form-floating">
                                      <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                        <option selected disbaled value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                      </select>
                                      <label for="floatingSelect">Status</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-warning w-100 h-100">Filter</button>
                                </div> -->
                                <div class="col-md-9"></div>
                                <div class="col-md-3">
                                    <a href="{{route('addLesson')}}"><button class="btn btn-success w-100 h-100">Add Course Lesson</button></a>
                                </div>
                            </div>
                            @include('layouts.noftification')
                        </div>
                        <div class="table-structure">
                            <table id="edittable" class="table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Lesson Title</th>
                                        <th>Level</th>
                                        <th>Teaching Option</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                            @if(isset($get_all_lesson) && !empty($get_all_lesson))
                                                @foreach($get_all_lesson as $all_lesson)
                                                <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$all_lesson['lesson_title']}}</td>
                                                <td>@if(!in_array($all_lesson['cat_id'],[\Config::get('constants.freeVideo'),\Config::get('constants.paidVideo')])) {{$all_lesson['level_name']}} @endif</td>
                                                <td>{{$all_lesson['option_name']}}</td>
                                                <td>{{$all_lesson['category_name']}}</td>
                                                <td>@if($all_lesson['status']==1){{"Active"}} @else{{"Inactive"}}@endif</td>
                                                <td>
                                                    <div class="dropdown">
                                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                              </button>
                                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="{{route('editLesson',$all_lesson['id'])}}"><i class="bi bi-pencil-square"></i> Edit</a></li>
                                                 <li><a class="dropdown-item delete_btn" href="#"  data-id="{{$all_lesson['id']}}"><i class="bi bi-trash3"></i> Delete</a></li>
                                                    <!--
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-arrow-return-right"></i> Assign</a></li> -->
                                              </ul>
                                            </div>
                                                </td>
                                            </tr>
                                                @endforeach
                                            @endif
                                            
                                       
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
             <script src="{{asset('public/asset/js')}}/jquery-3.6.1.min.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#edittable').DataTable({
                scrollY: true,
                scrollX: true,
            });

            // delete
            //$('.delete_btn').click(function(){
                $('#edittable').on('click', ".delete_btn", function(event){
                event.preventDefault();
                var data_id=$(this).attr('data-id');
                if(confirm('Are you sure want to delete record?'))
                {
                    document.location.href="{{route('DeleteCourse')}}?data_id="+data_id;
                }
                else
                {
                    return false;
                }
                
            });
        });
    </script>        
    @endsection