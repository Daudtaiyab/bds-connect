@php
$ActiveRoute=\Request::route()->getName();
@endphp
<i class="bi bi-x-lg"></i>
                    <div class="sidebar-logo">
                        <img src="{{asset('public/asset/img')}}/bds.png">
                    </div>
                    <div class="sidebar-list">
                        <ul>
                            <a href="{{url('/dashboard')}}" class="{{ in_array($ActiveRoute,['home']) ? 'active' : '' }}">
                                <li>
                                    <i class="flaticon-school"></i> <span>School Registration</span>
                                </li>
                            </a>
                            <!-- <a href="#">
                                <li>
                                    <i class="flaticon-archives"></i> <span>Create Schools</span>
                                </li>
                            </a> -->

                            <a href="{{route('GelallLibrary')}}" class="{{ in_array($ActiveRoute,['addLibrary','editLibrary','GelallLibrary']) ? 'active' : '' }}">
                                <li>
                                    <i class="flaticon-edit"></i> <span>Course Level Management</span>
                                </li>
                            </a>
                            
                            <a href="{{route('getallCourse')}}" class="{{ in_array($ActiveRoute,['getallCourse','addCourse','editCourse']) ? 'active' : '' }}">
                                <li>
                                    <i class="flaticon-edit"></i> <span>Course Management</span>
                                </li>
                            </a>
                            

                             <a href="{{route('GetallLesson')}}" class="{{ in_array($ActiveRoute,['addLesson','editLesson','GetallLesson']) ? 'active' : '' }}">
                                <li>
                                    <i class="flaticon-edit"></i> <span>Course Lesson Management</span>
                                </li>
                            </a>

                             {{-- <a href="{{route('approvalCourse')}}" class="{{ in_array($ActiveRoute,['approvalCourse']) ? 'active' : '' }}">
                                <li>
                                    <i class="flaticon-add-user"></i> <span>Pending Course Request</span>
                                </li>
                            </a> --}}
                            <a href="{{route('Registerschool')}}" class="{{ in_array($ActiveRoute,['Registerschool','downloadSchool','approvedSchool','AssignCourseToUser','AssignCourseToUserSave']) ? 'active' : '' }}">
                                <li>
                                    <i class="flaticon-verify"></i> <span>Registered Schools</span>
                                </li>
                            </a>
                        </ul>
                    </div>