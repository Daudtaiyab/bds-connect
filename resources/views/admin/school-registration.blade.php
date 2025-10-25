@extends('admin.layouts.layout')
    @section('content')
<div class="div-padding">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                <div class="status-box">
                                    <h1>{{$data['all_school']}}</h1>
                                    <h6>Registered Schools</h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                <div class="status-box peach">
                                    <h1>{{$data['active_active']}}</h1>
                                    <h6>Active Schools</h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                <div class="status-box green">
                                    <h1>{{$data['school_inactive']}}</h1>
                                    <h6>Inactive Schools</h6>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 mb-3">
                                <div class="status-box blue">
                                    <h1>{{$data['all_course']}}</h1>
                                    <h6>Courses</h6>
                                </div>
                            </div>
                        </div>
                        <div class="registration-form-outer">
                                
                        </div>
                    </div>

        @endsection
