@if(session()->get('success'))
<div class="alert alert-success">{{session()->get('success')}}</div>
@endif

@if(session()->get('fail'))
<div class="alert alert-danger">{{session()->get('fail')}}</div>
@endif

