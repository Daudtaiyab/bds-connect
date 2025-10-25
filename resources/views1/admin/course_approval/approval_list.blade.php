@extends('admin.layouts.layout')
    @section('content')
       <div class="div-padding">
                        <div class="admin-heading">
                            <h4>Course Approval Managment</h4>
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
                                <div class="col-md-10"></div>
                                <div class="col-md-2" style="display: none;">
                                    <a href="{{route('addLibrary')}}"><button class="btn btn-success w-100 h-100">Add Course Level</button></a>
                                </div>
                            </div>
                            @include('layouts.noftification')
                        </div>
                        <div class="table-structure">
                            <table id="edittable" class="table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>UserName</th>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                            @if(isset($approvalCourse) && !empty($approvalCourse))
                                                @foreach($approvalCourse as $row)
                                                <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$row['email']}}</td>
                                                <td>{{$row['phone_number']}}</td>
                                                <td>{{$row['full_name']}}</td>
                                                <td>

                                                    <div class="dropdown">
                                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                              </button>
                                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="{{route('viewApproval',$row['id'])}}"><i class="bi bi-pencil-square"></i> View Approve</a></li>
                                                 
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
            $('.delete_btn').click(function(){
                var data_id=$(this).attr('data-id');
                if(confirm('Are you sure want to delete record?'))
                {
                    document.location.href="{{route('delete_library')}}?data_id="+data_id;
                }
                else
                {
                    return false;
                }
                
            });
        });
    </script>        
    @endsection