@extends('admin.layouts.layout')
    @section('content')
       <div class="div-padding">
                        <div class="admin-heading">
                            <h4>All Courses Request</h4>
                            <div class="line"></div>
                        </div>
                        <div class="row">

                                        
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="floatingInput" placeholder="abcdefghij" required value="{{$data['userDetail']->first_name}}" disabled="">
                                              <label for="floatingInput">First Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="floatingPassword" placeholder="Password" required value="{{$data['userDetail']->last_name}}" disabled="">
                                              <label for="floatingPassword">Last Name</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="floatingInput" placeholder="abcdefghij" required value="{{$data['userDetail']->email}}" disabled="">
                                              <label for="floatingInput">Email</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <input type="text" class="form-control" id="floatingPassword" placeholder="Password" required value="{{$data['userDetail']->phone_number}}" disabled="">
                                              <label for="floatingPassword">Phone Number</label>
                                            </div>
                                        </div>
                                       
                        </div> 
                        <form method="post" action="{{route('SaveApprovedRejectCourse')}}">
                            @csrf
                            <input type="hidden" name="editId" value="{{$data['userDetail']->id}}">
                            <div class="products">
                                <div class="row d-flex justify-content-center align-items-center">
                                    <!-- start loop -->
                                    @if(isset($data['approvalCourse']) && !empty($data['approvalCourse']))
                                        @foreach($data['approvalCourse'] as $coursedata)
                                    <div class="col-md-4 mb-4">
                                        <label for="codeyrockey_{{$coursedata['course_id']}}">
                                            <input type="checkbox" id="codeyrockey_{{$coursedata['course_id']}}" class="checkbox" value="{{$coursedata['course_id']}}" name="courseassign[]" >
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
                                    @endforeach
                                    @endif
                                    <div class="col-md-6">
                                            <div class="form-floating mb-3">
                                              <select name="is_approved" id="is_approved" class="form-control">
                                                  <option value="0">Pending</option>
                                                  <option value="1">Approved</option>
                                                  <option value="2">Reject</option>
                                              </select>
                                              <label for="floatingInput">First Name</label>
                                            </div>
                                        </div>
                                    <div class="d-flex justify-content-center align-items-center w-100 ">
                                        <button type="submit" name="submit" class="button">Submit Approval</button>
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