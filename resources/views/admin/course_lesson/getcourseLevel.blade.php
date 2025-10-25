@if(isset($courseLevel) && !empty($courseLevel))
	<option value="">--Select Level-</option>
	@foreach($courseLevel as $item)
		<option value="{{$item->id}}">{{$item->name}}</option>
	@endforeach
	
	@else
	<option value="">No data found</option>
@endif