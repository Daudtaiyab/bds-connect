<div class="top-nav">

    <div class="topnav-img">
        <img src="{{ asset('user/img/bds.png') }}">
    </div>
    <div>
        <a onclick="history.back()" style="cursor:pointer;"><i class="bi bi-arrow-left"></i> Back</a>
    </div>
    <div class="profile">
        <img src="{{ asset('user/img/admin-img.jpg') }}">
        <p>Hello, <span> {{ Auth::user()->first_name }}</span></p>
    </div>
    <div class="logout">
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
    <div class="menubar">
        <i class="bi bi-list"></i>
        <!-- <i class="bi bi-x-lg"></i> -->
    </div>
</div>
