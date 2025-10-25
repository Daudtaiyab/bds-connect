<div class="pdf-content">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="user-heading">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="w-100">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">{{$data['lessonData']->category_name}}</a></li>
                     @if(!in_array($data['lessonData']->cat_id,[\Config::get('constants.freeVideo'),\Config::get('constants.paidVideo'),]))<li class="breadcrumb-item"><a href="#">{{$data['lessonData']->level_name}}</a></li>@endif
                    <li class="breadcrumb-item active" aria-current="page">{{$data['lessonData']->lesson_title}}</li>
                  </ol>
                </nav>
                <h1>{{$data['lessonData']->lesson_title}}</h1>
                <div class="line"></div>
            </div>
            @if(in_array($data['lessonData']->cat_id,[\Config::get('constants.freePdf'),\Config::get('constants.paidPdf'),]))
                <div class="iframe-container">
                 @if($data['lessonData']->lesson_iframe_code=='')
                    <h1>{{\Config::get('constants.noData')}}</h1>
                  @else
                {!! $data['lessonData']->lesson_iframe_code !!}
                @endif
            </div>
            <div class="buttons">
                <div class="previousbutton">
                    @if(isset($data['preP']) && !empty($data['preP']))
                    <button class="button nextPrevious" id="{{$data['preP']}}" data-level="{{$data['lessonData']->level_id}}"><i class="bi bi-chevron-left"></i> Previous Topic</button>
                    @endif
                </div>
                <div class="nextbutton">
                    @if(isset($data['preP']) && !empty($data['nextP']))
                    <button class="button nextPrevious" id="{{$data['nextP']}}" data-level="{{$data['lessonData']->level_id}}">Next Topic <i class="bi bi-chevron-right"></i></button>
                    @endif
                </div>
                <input type="hidden" name="next_prev[]" value="{{$data['preP']}}" class="next_prev_{{$data['lessonData']->level_id}}" id="next_prev_{{$data['lessonData']->level_id}}">

                <input type="hidden" name="next_prev[]" value="{{$data['nextP']}}" class="next_prev_{{$data['lessonData']->level_id}}" id="next_prev_{{$data['lessonData']->level_id}}">

            </div>
            @elseif(in_array($data['lessonData']->cat_id,[\Config::get('constants.freeVideo'),\Config::get('constants.paidVideo'),]))
            <div class="iframe-container">
               @if($data['lessonData']->lesson_video=='')
                    <h1>{{\Config::get('constants.noData')}}</h1>
                  @else
                {!! $data['lessonData']->lesson_video !!}
                @endif
            </div>
            <div class="buttons">
                
                <div class="previousbutton">
                    @if(isset($data['preP']) && !empty($data['preP']))
                    <button class="button nextPrevious" id="{{$data['preP']}}" data-level="raja"><i class="bi bi-chevron-left"></i> Previous Topic</button>
                    @endif
                </div>
                
                <div class="nextbutton">
                    @if(isset($data['preP']) && !empty($data['nextP']))
                    <button class="button nextPrevious" id="{{$data['nextP']}}" data-level="raja">Next Topic <i class="bi bi-chevron-right"></i></button>
                    @endif
                </div>
                <input type="hidden" name="next_prev[]" value="{{$data['preP']}}" class="next_prev_raja" id="next_prev_{{$data['lessonData']->level_id}}">

                <input type="hidden" name="next_prev[]" value="{{$data['nextP']}}" class="next_prev_raja" id="next_prev_raja">

            </div>
            @endif
            
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<button  type="button" id="dropdownMenuButton1" data-bs-toggle="modal" data-bs-target="#editmodal">
    <div class="floating-query-btn">
        <div class="btn-text">
            <p>Send Query On Email</p>
        </div>
        <div class="btn-circle">
            <i class="bi bi-chat-right-text"></i>
        </div>
    </div>
</button>
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Your Query</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="google.com">
          <div class="modal-body">
            <div class="modal-form">
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">Question  <span style="color: green" id="smsg"></span></label>
                  <textarea class="form-control" id="question" rows="3" placeholder="Enter your Query Here..."></textarea>
                </div>

                <input type="hidden" name="subject" id="subject" value="{{$data['lessonData']->category_name}}  @if(!in_array($data['lessonData']->cat_id,[\Config::get('constants.freeVideo'),\Config::get('constants.paidVideo'),])) > {{$data['lessonData']->level_name}} @endif > {{$data['lessonData']->lesson_title}}">
                <div class="d-flex justify-content-center align-items-center">
                    <button type="button" class="button" id="send_query" name="send_query">Send Query</button>
                </div>

            </div>
          </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
    $('.nextPrevious').on('click',function(){
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
    });
</script>