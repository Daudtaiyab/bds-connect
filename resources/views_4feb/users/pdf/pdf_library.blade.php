@extends('users.inc.layout')
    
    @section('content')
    <?php
    //echo"<pre>";print_r($sidebarArr);die;
    ?>
    <div class="div-padding" id="showRead">
        <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <div class="user-heading">
                <h1>Indexing</h1>
                <div class="line"></div>
            </div>
          <div class="indexing">
            <ul class="category">
              @if(isset($sidebarArr) && !empty($sidebarArr))
            @foreach($sidebarArr as $listArr)
              <li>
                <ul class="category-level">
                  @if(isset($listArr['cat_name']) && !empty($listArr['cat_name']))
                    @php $iii=0; @endphp
                    @foreach($listArr['cat_level'] as $key1 => $sub_level)
                        @if(!in_array($listArr['cat_id'],[\Config::get('constants.paidVideo'),\Config::get('constants.freeVideo')]))
                    
                  <li><span>{{$sub_level['level_name']}}</span>
                    <ul class="category-level-lesson">
                      @if(isset($sub_level['lesson_data']) && !empty($sub_level['lesson_data']))
                                @foreach($sub_level['lesson_data'] as $key => $less)
                      <li class="show_data" id="{{$less['lesson_id']}}" data-level="{{$sub_level['level_id']}}">{{$less['lesson_title']}}</li>

                      <input type="hidden" name="next_prev[]" value="{{$less['lesson_id']}}" class="next_prev_{{$sub_level['level_id']}}" id="next_prev_{{$sub_level['level_id']}}">
                       @endforeach
                            @endif
                    </ul>
                  </li>
                  @else
                  <!-- write code for Video -->
                    <li>
                    <ul class="category-level-lesson">
                      <li id="{{$sub_level['lesson_id']}}" data-level="raja" class="show_data">{{$sub_level['lesson_title']}}</li>
                    </ul>
                  </li>
                  <!-- write code for Video -->
                  <input type="hidden" name="next_prev[]" value="{{$sub_level['lesson_id']}}" class="next_prev_raja" id="next_prev_raja">
                  @endif 
                @php $iii++; @endphp
                    @endforeach
                @endif
                  
                </ul>
              </li>

              @endforeach
        @endif
              
              
            </ul>
          </div>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
    <script src="{{asset('public/asset/js')}}/jquery-3.6.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.show_data').click(function(){
                var lesson_id=$(this).attr('id');
                var data_level=$(this).attr('data-level');
                //alert(data_level);
                var myArr=[];
                $.each($("input[class=next_prev_"+data_level+"]"), function( index, item ) {
                  //What you want to do for every text input
                  myArr.push(item.value);
                });
                //alert(myArr);
               
                $.ajax({
                  url:'{{route("ajax.getLessonData")}}',
                  method:'post',
                  type:'html',
                  data:{'_token':'{{csrf_token()}}','lesson_id':lesson_id,'myArr':myArr},
                  success:function(data)
                  {
                    $('#showRead').html(data);
                  }
                });
            });

            // Next Previous logic start
              
            // Next Previous logic end


            //send query
            $('div').on('click','#send_query' ,function (event) {
            var subject=$('#subject').val();
            var question=$('#question').val();
            //console.log(subject);
            //console.log(question);

                $.ajax({
                      url:'{{route("ajax.senEnquiry")}}',
                      method:'post',
                      type:'html',
                      data:{'_token':'{{csrf_token()}}','subject':subject,'question':question},
                      success:function(data)
                      {
                        //$('#showRead').html(data);
                      }
                    });

            });
            //send enqury end
        });
    </script>
    
    @endsection