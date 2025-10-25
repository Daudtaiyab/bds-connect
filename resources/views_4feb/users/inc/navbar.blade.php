<div class="topnav-img">
            <img src="{{asset('public/user/img')}}/bds.png">
        </div>
        <div class="profile">
            <img src="{{asset('public/user/img')}}/admin-img.jpg">
            <p><span>Hello,</span> {{ Auth::user()->first_name }}</</p>
        </div>
        <div class="logout">
            <div class="dropdown options">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="options" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-three-dots-vertical"></i> 
              </button>
              <ul class="dropdown-menu" aria-labelledby="options">
                @if(Auth::user()->teach_id==\Config::get('constants.paidOption'))
                <li><a class="dropdown-item" href="{{ route('spritesForm') }}" onclick="event.preventDefault();
                                                     document.getElementById('sprites-form').submit();"><i class="bi bi-toggles2"></i> Switch to Sprites</a></li>

                

                <li><a class="dropdown-item" href="{{ route('deviceForm') }}?switch=2" onclick="event.preventDefault();
                                                     document.getElementById('device-form').submit();"><i class="bi bi-ui-checks-grid"></i> My Products</a></li>
                <li><a class="dropdown-item" href="{{ route('MoreProduct') }}" onclick="event.preventDefault();
                                                     document.getElementById('more-product').submit();"><i class="bi bi-ui-checks"></i> More Products</a></li>                                     
                @endif
                @if(Auth::user()->teach_id==\Config::get('constants.freeOption'))
                 <li><a class="dropdown-item" href="{{ route('deviceForm') }}?switch=1" onclick="event.preventDefault();
                                                     document.getElementById('device-form').submit();"><i class="bi bi-ui-checks-grid"></i> Switch to Device</a></li>
                @endif                                     

                <li><a  href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
              </ul>
            </div>
            <!--<a  href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
            </a>-->
            <form id="sprites-form" action="{{ route('spritesForm') }}" method="POST" class="d-none">
                                        @csrf
                                        <input type="hidden" name="teach_id" id="tech_id" value="1">
                                    </form>

            <form id="device-form" action="{{ route('deviceForm') }}" method="POST" class="d-none">
                                        @csrf
                                        <input type="hidden" name="teach_id" id="tech_id" value="2">
                                    </form>

             <form id="more-product" action="{{ route('MoreProduct') }}" method="POST" class="d-none">
                                        @csrf
                                        <input type="hidden" name="teach_id" id="tech_id" value="2">
                                    </form>                        

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
        </div>
        <div class="menubar">
            <i class="bi bi-list"></i>
        </div>