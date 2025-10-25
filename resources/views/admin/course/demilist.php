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
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success w-100 h-100">Export</button>
                                </div>
                            </div>
                            @include('layouts.noftification')
                        </div>
                        <div class="table-structure">
                            <table id="edittable" class="table-striped">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Teaching Option</th>
                                        <th>Course Title</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="table-name"></td>
                                                <td></td>
                                                <td class="status active"><span>Active</span></td>
                                                
                                            </tr>
                                       
                                    
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
        });
    </script>        
    @endsection