@extends("etravel.layout.main") 
@section("content")
<div class="alert alert-danger alert-dismissable" role="alert">
	<button class="close" type="button" data-dismiss="alert">&times;</button>
		<p class="lead">
			<strong>
				<span class="glyphicon glyphicon-alert"></span>
				Unregister User  With NeoID: '{{ $userName }}'
			</strong> 
		</p>
		<strong class="lead">Please Contact your local HR to register you on Etravel System Or <a href="{{url('auth/login')}}">ReLogin</a></strong>
</div>
@endsection