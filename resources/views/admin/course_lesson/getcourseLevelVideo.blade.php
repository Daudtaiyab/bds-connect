@if(isset($courseLevel) && !empty($courseLevel))
	<option value="">--Select Level-</option>
	@foreach($courseLevel as $item)
		<option value="{{$item->id}}" selected="">{{$item->name}}</option>
	@endforeach
	
	@else
	<option value="1" selected="">No data found</option>
@endif