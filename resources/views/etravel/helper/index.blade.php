@extends("etravel.layout.main") 
@section("content")
<div class="container">
	<div class="row">
		<center>
			<object data="{{$filePath}}" type="application/pdf" width="800" height="600">
				alt :
				<a href="{{$filePath}}">{{$filePath}}</a>
			</object>
		</center>
	</div>
</div>
@endsection
