@extends('admin.layouts.layout')
    @section('content')
       <div class="div-padding">
                        <div class="admin-heading">
                            <h4>Registered Schools</h4>
                            <div class="line"></div>
                        </div>
                        <div class="filter-data">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <div class="form-floating">
                                      <select class="form-select" id="status" name="status" aria-label="Floating label select example">
                                        <option selected disbaled value="">Select Status</option>
                                        <option value="1" @if(isset($_GET['status']) && $_GET['status']==1){{"selected"}}@endif>Active</option>
                                        <option value="2" @if(isset($_GET['status']) && $_GET['status']==2){{"selected"}}@endif>Inactive</option>
                                      </select>
                                      <label for="floatingSelect">Status</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-warning w-100 h-100" id="filter">Filter</button>
                                    
                                </div>
                                <div class="col-md-4">
                                    
                                    <?php 
                                     $statusU='';
                                    if(isset($_GET['status']) && !empty($_GET['status'])){
                                        $statusU=$_GET['status'];
                                    }
                                    ?>
                                    <a href="{{ route('downloadSchool')}}?status={{$statusU}}"><button class="btn btn-success w-100 h-100">Export</button></a>
                                </div>
                            </div>
                            @include('layouts.noftification')
                        </div>
                        <div class="table-structure">
                            <table id="edittable" class="table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Operations</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Courses</th>
                                        <th>Username</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($userList) && !empty($userList))
                                        @foreach($userList as $item)

                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    

                                                    <div class="dropdown">
                                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                              </button>
                                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="{{route('approvedSchool',$item['id'])}}"><i class="bi bi-pencil-square"></i> Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><a class="dropdown-item delete_btn" href="#"  data-id="{{$item['id']}}"><i class="bi bi-trash3"></i> Delete</a></li>
                                                <li><a class="dropdown-item" href="{{route('AssignCourseToUser',$item['id'])}}"><i class="bi bi-arrow-return-right"></i> Assign</a></li>
                                              </ul>
                                            </div>

                                                </td>
                                                <td class="table-name">{{$item['full_name']}}</td>
                                                
                                                <td>{{$item['email']}}</td>
                                                <td>{{$item['phone_number']}}</td>
                                                <td class="table-address">{{$item['address']}}</td>
                                                <td data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="{{$item['assigned_course'][0]['usercourse']}}" class="table-courses">{{strlen($item['assigned_course'][0]['usercourse'])>=20 ? substr($item['assigned_course'][0]['usercourse'], 0, 10)."....." : ''}}</td>
                                                
                                                <td>{{$item['username']}}</td>
                                                <td class="status @if($item['status']==1){{'active'}} @else {{'inactive'}} @endif"><span>@if($item['status']==1){{'Active'}} @else {{'Inactive'}} @endif</span></td>
                                                
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

            // filter
            $('#filter').on('click',function(){
                var status=$('#status').val();
                document.location.href="{{route('Registerschool')}}?status="+status;
            });

            // delete
            $('#edittable').on('click', ".delete_btn", function(event){
                event.preventDefault();

            //$('.delete_btn').click(function(){
                var data_id=$(this).attr('data-id');
                if(confirm('Are you sure want to delete record?'))
                {
                    document.location.href="{{route('userDelete')}}?data_id="+data_id;
                }
                else
                {
                    return false;
                } 
            });

        });
    </script>        
    @endsection