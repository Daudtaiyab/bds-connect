<div class="menu-logo">
        <img src="{{asset('public/user/img')}}/bds.png">
        <i class="bi bi-x-lg"></i>
    </div>
    <?php
    //echo"<pre>";print_r($sidebarArr);die;
    ?>
    <ul class="cd-accordion cd-accordion--animated margin-top-lg margin-bottom-lg">
        <!-- start lopp -->
        @if(isset($sidebarArr) && !empty($sidebarArr))
            @foreach($sidebarArr as $listArr)

        <li class="cd-accordion__item cd-accordion__item--has-children">
            <input class="cd-accordion__input" type="checkbox" name ="group-{{$listArr['cat_id']}}" id="group-{{$listArr['cat_id']}}" @if(in_array($listArr['cat_id'],[\Config::get('constants.paidPdf'),\Config::get('constants.freePdf')])){{'checked'}}@endif>
            <!--<label class="cd-accordion__label cd-accordion__label--icon-folder pdf" for="group-{{$listArr['cat_id']}}"><span><i class="bi bi-file-earmark-pdf"></i> {{$listArr['cat_name']}}</span></label>-->
            <ul class="cd-accordion__sub cd-accordion__sub--l1">
                
                @if(isset($listArr['cat_name']) && !empty($listArr['cat_name']))
                @php $iii=0; @endphp
                    @foreach($listArr['cat_level'] as $key1 => $sub_level)
                        @if(!in_array($listArr['cat_id'],[\Config::get('constants.paidVideo'),\Config::get('constants.freeVideo')]))
                        <li class="cd-accordion__item cd-accordion__item--has-children">
                    <input class="cd-accordion__input" type="checkbox" name ="sub-group-{{$sub_level['level_id']}}" id="sub-group-{{$sub_level['level_id']}}"  @if(in_array($listArr['cat_id'],[\Config::get('constants.paidPdf'),\Config::get('constants.freePdf')]) && $iii==0){{'checked'}}@endif>
                    <label class="cd-accordion__label cd-accordion__label--icon-folder" for="sub-group-{{$sub_level['level_id']}}"><span>{{$sub_level['level_name']}}</span></label>
                    <ul class="cd-accordion__sub cd-accordion__sub--l2">
                            @if(isset($sub_level['lesson_data']) && !empty($sub_level['lesson_data']))
                                @foreach($sub_level['lesson_data'] as $key => $less)
                                <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img show_data" href="#" id="{{$less['lesson_id']}}" data-level="{{$sub_level['level_id']}}"><span>{{$less['lesson_title']}}</span></a></li>
                                <input type="hidden" name="next_prev[]" value="{{$less['lesson_id']}}" class="next_prev_{{$sub_level['level_id']}}" id="next_prev_{{$sub_level['level_id']}}">
                                

                                @endforeach
                            @endif
                        
                        

                    </ul>
                </li>
                 @else
                <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img show_data" href="#" id="{{$sub_level['lesson_id']}}" data-level="raja"><span>{{$sub_level['lesson_title']}}</span></a></li>

                <input type="hidden" name="next_prev[]" value="{{$sub_level['lesson_id']}}" class="next_prev_raja" id="next_prev_raja">
                
                @endif 
                @php $iii++; @endphp
                    @endforeach
                @endif
                
            </ul>
        </li>
         @endforeach
        @endif
        <!-- end loop here............ -->
        <!-- <li class="cd-accordion__item cd-accordion__item--has-children">
            <input class="cd-accordion__input" type="checkbox" name ="group-2" id="group-2">
            <label class="cd-accordion__label cd-accordion__label--icon-folder video" for="group-2"><span><i class="bi bi-camera-video"></i> Video Library</span></label>
            <ul class="cd-accordion__sub cd-accordion__sub--l1">
                <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Image</span></a></li>
                <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Image</span></a></li>
            </ul>
        </li>
        <li class="cd-accordion__item cd-accordion__item--has-children">
            <input class="cd-accordion__input" type="checkbox" name ="group-3" id="group-3" checked>
            <label class="cd-accordion__label cd-accordion__label--icon-folder code" for="group-3"><span><i class="bi bi-file-earmark-code"></i> Code Library</span></label>
            <ul class="cd-accordion__sub cd-accordion__sub--l1">
                <li class="cd-accordion__item cd-accordion__item--has-children">
                    <input class="cd-accordion__input" type="checkbox" name ="sub-group-7" id="sub-group-7">
                    <label class="cd-accordion__label cd-accordion__label--icon-folder" for="sub-group-7"><span> Basic Scratch based Coding.</span></label>
                    <ul class="cd-accordion__sub cd-accordion__sub--l2">
                        <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Motivation of children to Coding.</span></a></li>
                        <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Introduction to Scratch.</span></a></li>
                        <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Image</span></a></li>
                    </ul>
                </li>
                
                <li class="cd-accordion__item cd-accordion__item--has-children video">
                    <input class="cd-accordion__input" type="checkbox" name ="sub-group-8" id="sub-group-8">
                    <label class="cd-accordion__label cd-accordion__label--icon-folder" for="sub-group-8"><span> Advance Scratch based Coding.</span></label>
                    <ul class="cd-accordion__sub cd-accordion__sub--l2">
                        <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Image</span></a></li>
                        <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Image</span></a></li>
                        <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Image</span></a></li>
                        <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Image</span></a></li>
                        <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Image</span></a></li>
                    </ul>
                </li>
                <li class="cd-accordion__item cd-accordion__item--has-children video">
                    <input class="cd-accordion__input" type="checkbox" name ="sub-group-9" id="sub-group-9">
                    <label class="cd-accordion__label cd-accordion__label--icon-folder" for="sub-group-9"><span> Migration from Scratch to Python.</span></label>
                    <ul class="cd-accordion__sub cd-accordion__sub--l2">
                        <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Image</span></a></li>
                        <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Image</span></a></li>
                        <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Image</span></a></li>
                        <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Image</span></a></li>
                        <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Image</span></a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="cd-accordion__item cd-accordion__item--has-children">
            <input class="cd-accordion__input" type="checkbox" name ="group-4" id="group-4">
            <label class="cd-accordion__label cd-accordion__label--icon-folder quiz" for="group-4"><span><i class="bi bi-question-square"></i> Consolidation Quiz</span></label>
            <ul class="cd-accordion__sub cd-accordion__sub--l1">
                <li class="cd-accordion__item cd-accordion__item--has-children">
                    <input class="cd-accordion__input" type="checkbox" name ="sub-group-4" id="sub-group-4">
                    <label class="cd-accordion__label cd-accordion__label--icon-folder" for="sub-group-4"><span>Sub Group 3</span></label>
                    <ul class="cd-accordion__sub cd-accordion__sub--l2">
                        <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Image</span></a></li>
                        <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Image</span></a></li>
                    </ul>
                </li>
                <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Image</span></a></li>
                <li class="cd-accordion__item"><a class="cd-accordion__label cd-accordion__label--icon-img" href="#0"><span>Image</span></a></li>
            </ul>
        </li> -->
    </ul>