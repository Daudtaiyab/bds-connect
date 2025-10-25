@if(isset($CourseCategory) && !empty($CourseCategory))
	<option value="">--Select Level Categroy--</option>
	@foreach($CourseCategory as $item)
		<option value="{{$item->id}}">{{$item->category_name}}</option>
	@endforeach
	
	@else
	<option value="">No data found</option>
@endif