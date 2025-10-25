@if(isset($courseProduct) && !empty($courseProduct))
	<option value="">--Select Course--</option>
	@foreach($courseProduct as $item)

		<option value="{{$item['id']}}" @if($item['teaching_id']==1){{"selected"}}@endif>{{$item['course_name']}}</option>
	@endforeach
	
	@else
	<option value="">No data found</option>
@endif