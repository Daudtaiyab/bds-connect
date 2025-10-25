<div class="code-library">
    		<div class="row">
                @if(isset($data['lessonData']) && !empty($data['lessonData']))
                    @foreach($data['lessonData'] as $codeLib)
                        <div class="col-md-3">
                            <div class="codebox-outer">
                                <div class="code-box">
                                    <img src="{{asset('public/user/img')}}/mblock-logo.png">
                                    <h6>{{$codeLib['code_title']}}</h6>
                                    <div class="line"></div>
                                    <a href="{{asset('public/uploads/code_lib')}}/{{$codeLib['code_file']}}" download=""><button class="download-btn"><span>Download</span> <i class="bi bi-download"></i></button></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @else
                   <div class="col-md-3">
                            <div class="codebox-outer">
                                <div class="code-box">
                                    <img src="{{asset('public/user/img')}}/mblock-logo.png">
                                    <h6>No Data Found</h6>
                                    <div class="line"></div>
                                    <a href="#" download=""><button class="download-btn"><span>No Data Found</span> <i class="bi bi-download"></i></button></a>
                                </div>
                            </div>
                        </div>
                @endif
    			
    		</div>
    	</div>